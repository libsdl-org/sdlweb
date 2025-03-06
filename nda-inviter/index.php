<?php

// this is the script that invites people's GitHub accounts to NDA'd forks.
include('config.php');

//config.php should have this:
//$title = 'SDL NDA Inviter';
//$user_agent = 'sdl-nda-inviter.php/0.1';
//$base_url = 'https://libsdl.org/nda-inviter/';
//$github_oauth_clientid = 'sdfsdfkjsdfksdjf';
//$github_oauth_secret = 'sdfksdjfksdjfksdjfk';
//$github_invite_token = 'ghp_ksdjfksdjfksdjf';
//$logins = array('user1' => 'password1', 'user2' => 'password2', etc);
//$repos = array('user1' => array('libsdl-org/SDL-platform', 'libsdl-org/SDL3-platform', etc));

// most of this support code is from ghwikipp.
function fail($response, $msg, $url=NULL)
{
    global $title;
    if ($response != NULL) {
        header("HTTP/1.0 $response");
        header("Content-Type: text/html; charset=utf-8");
        if ($url != NULL) { header("Location: $url"); }
    }

    print("\n<html><head><title>$title</title></head><body>\n<p><h1>$response</h1></p>\n<p>$msg</p>\n</body></html>\n\n");
    exit(0);
}

function fail400($msg) { fail('400 Bad Request', $msg); }
function fail404($msg) { fail('404 Not Found', $msg); }
function fail503($msg) { fail('503 Service Unavailable', $msg); }

function redirect($url, $msg=NULL)
{
    if ($msg == NULL) {
        $msg = "We need your browser to go here now: <a href='$url'>$url</a>";
    }
    fail('302 Found', $msg, $url);
}

function require_session()
{
    if (!session_id()) {
        if (!session_start()) {
            fail503('Session failed to start, please try again later.');
        }
    }
}

function handle_oauth_error()
{
    if (isset($_REQUEST['error'])) {  // this is probably a failure from GitHub's OAuth page.
        require_session();
        if (isset($_SESSION['github_oauth_state'])) { unset($_SESSION['github_oauth_state']); }
        $reason = isset($_REQUEST['error_description']) ? $_REQUEST['error_description'] : 'unknown error';
        fail400("GitHub auth error, try again later?<ul><li>error: " . $_REQUEST['error'] . "</li>\n<li>reason: $reason</li></ul>\n");
    }
}

function call_github_api($url, $args=NULL, $token=NULL, $method='GET', $failonerror=true)
{
//print("CALL_GITHUB_API url='$url'\n");

    global $user_agent;
    $isget = ($method == 'GET');

    if ($isget && ($args != NULL) && (!empty($args)) ) {
        $url .= '?' . http_build_query($args);
    }

    $reqheaders = array(
        "User-Agent: $user_agent",
        'Accept: application/json'
    );

    if ($token != NULL) {
        $reqheaders[] = 'Authorization: token ' . $token;
    }

    if (!$isget) {
        $reqheaders[] = 'Content-Type: application/json; charset=utf-8';
    }

    $curl = curl_init($url);
    $curlopts = array(
        CURLOPT_AUTOREFERER => TRUE,
        CURLOPT_FOLLOWLOCATION => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => $reqheaders
    );

    if ($method == 'POST') {
        $curlopts[CURLOPT_POST] = TRUE;
        $curlopts[CURLOPT_POSTFIELDS] = json_encode(($args == NULL) ? array() : $args);
    } else if ($method == 'PUT') {
        $curlopts[CURLOPT_CUSTOMREQUEST] = 'PUT';
        $curlopts[CURLOPT_POSTFIELDS] = json_encode(($args == NULL) ? array() : $args);
    }

     //print("CURLOPTS:\n"); print_r($curlopts);
     //print("REQHEADERS:\n"); print_r($reqheaders);

     curl_setopt_array($curl, $curlopts);
     $responsejson = curl_exec($curl);
     $curlfailed = ($responsejson === false);
     $curlerr = $curlfailed ? curl_error($curl) : NULL;
     $httprc = $curlfailed ? 0 : curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
     curl_close($curl);
     unset($curl);

     //print("RESPONSE:\n"); print_r(json_decode($responsejson, TRUE));

     if ($curlfailed) {
         fail503("Couldn't talk to GitHub API, try again later ($curlerr)");
     } else if ($httprc == 204) {
         return array( 'httprc' => 204 );
     } else if (($httprc != 200) && ($httprc != 201)) {
         if (!$failonerror) {
             return NULL;
         }
         fail503("GitHub API reported error $httprc, try again later:<br/>\n<br/>\n" . print_r($responsejson, true) . "\n\n");
     }

     $retval = json_decode($responsejson, TRUE);
     if ($retval == NULL) {
         fail503('GitHub API sent us bogus JSON, try again later.');
     }

     $retval['httprc'] = $httprc;
     return $retval;
}


function authorize_with_github($force=false)
{
    global $github_oauth_clientid;
    global $github_oauth_secret;
    global $blocked_data, $trusted_data, $admin_data, $always_admin, $base_url;

    require_session();

    handle_oauth_error();  // die now if we think GitHub refused to auth user.

    //print_r($_SESSION);

    // $force==true means we're being asked to make sure GitHub is still cool
    //  with this session, which we do before requests that make changes, like
    //  committing an edit. If the user auth'd with GitHub but then logged
    //  out over there since our last check, we might be letting the user do
    //  things they shouldn't be allowed to do anymore. For the basic workflow
    //  we don't care if they are still _actually_ logged in at every step,
    //  though.

    if ( !$force &&
         isset($_SESSION['github_user']) &&
         isset($_SESSION['github_access_token']) &&
         isset($_SESSION['last_auth_time']) &&
         isset($_SESSION['expected_ipaddr']) &&
         ( (time() - $_SESSION['last_auth_time']) < (60 * 60) ) &&
         ($_SESSION['expected_ipaddr'] == $_SERVER['REMOTE_ADDR']) ) {
        //print("ALREADY LOGGED IN\n");
        return;  // we're already logged in.

    // if there's a "code" arg, this is probably a redirect back from GitHub's OAuth page.
    //  make sure this isn't the user just reloading the page before using it again, as that will fail; we'll reauth to get a new code in that case.
    } else if ( isset($_REQUEST['code']) && (!isset($_SESSION['github_last_used_oauth_code']) || ($_SESSION['github_last_used_oauth_code'] != $_REQUEST['code'])) ) {
        if ( !isset($_REQUEST['state']) || !isset($_SESSION['github_oauth_state']) ) {
            fail400('GitHub authorization appears to be confused, please try again.');
        } else if ($_SESSION['github_oauth_state'] != $_REQUEST['state']) {
            fail400('This appears to be a bogus attempt to authorize with GitHub. If in error, please try again.');
        }

        $_SESSION['github_last_used_oauth_code'] = $_REQUEST['code'];

        $tokenurl = 'https://github.com/login/oauth/access_token';
        $response = call_github_api($tokenurl, [
            'client_id' => $github_oauth_clientid,
            'client_secret' => $github_oauth_secret,
            'state' => $_REQUEST['state'],
            'code' => $_REQUEST['code']
        ]);

        //print("\n<pre>\n"); print_r($response); print("\n</pre>\n\n");
        if (!isset($response['access_token'])) {
            fail503("GitHub OAuth didn't provide an access token! Please try again later.");
        }

        $token = $response['access_token'];
        $_SESSION['github_access_token'] = $token;
    }

    // If we already have an access token (or just got one, above), see if
    //  it's still valid. If it isn't, force a full reauth. If it still
    //  works, GitHub still thinks we're cool.
    if (isset($_SESSION['github_access_token']))
    {
        $response = call_github_api('https://api.github.com/user', NULL, $_SESSION['github_access_token'], 'GET', false);

        if ($response != NULL) {
            //print("\n<pre>\nGITHUB USER API RESPONSE:\n"); print_r($response); print("\n</pre>\n\n");

            if ( !isset($response['login']) ) {
                unset($_SESSION['github_access_token']);
                fail503("GitHub didn't tell us everything we need to know about you to give you access. Please try again later.");
            }

            $_SESSION['expected_ipaddr'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['last_auth_time'] = time();
            $_SESSION['github_user'] = $response['login'];

            //print("SESSION:\n"); print_r($_SESSION);

            //print("AUTH TO GITHUB VALID AND READY\n");
            // logged in, verified, and good to go!

            if (isset($_REQUEST['code'])) {   //Force a redirect to dump the code and state URL args.
                redirect($base_url, 'Reloading to finish login!');
            }

            return;  // logged in and ready to go as-is.
        }

        // still here? We'll try reauthing, below.
    }


    // we're starting authorization from scratch.

    // kill any lingering state.
    unset($_SESSION['github_user']);
    unset($_SESSION['github_access_token']);
    unset($_SESSION['expected_ipaddr']);
    unset($_SESSION['last_auth_time']);

    // !!! FIXME: no idea if this is a good idea.
    $_SESSION['github_oauth_state'] = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);

    $github_authorize_url = 'https://github.com/login/oauth/authorize';
    redirect($github_authorize_url . '?' . http_build_query([
        'client_id' => $github_oauth_clientid,
        'redirect_uri' => $base_url,
        'state' => $_SESSION['github_oauth_state'],
        //'scope' => 'user'
    ]), 'Sending you to GitHub to log in...');

    // if everything goes okay, GitHub will redirect the user back to our
    //  same URL and we can try again, this time with authorization.
}

function force_authorize_with_github()
{
    authorize_with_github(true);
}


// mainline!

// always force to SSL.
if (!isset($_SERVER['HTTPS'])) {
    redirect('https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
}

require_session();

// Incorrect or no login? Spit out a prompt and quit.
$user = isset($_REQUEST['form_user']) ? $_REQUEST['form_user'] : ($_SESSION['username'] ? $_SESSION['username'] : '');
$pass = isset($_REQUEST['form_pass']) ? $_REQUEST['form_pass'] : ($_SESSION['password'] ? $_SESSION['password'] : '');

if (!isset($logins[$user]) || ($pass != $logins[$user])) {
    echo <<<EOF
    <html><head><title>$title</title></head><body>
    <center>
    <p><h1>SDL NDA Inviter</h1></p>
    <p>
      <form name="loginform" method="post">
        username: <input type="text" name="form_user" value="$user" /><br/>
        password: <input type="password" name="form_pass" value="" /><br/>
        <input type="submit" name="form_login" value="Login" />
      </form>
    </p>
    <p>A successful login will redirect you to GitHub for authorization,
       then back here, so we'll know your GitHub username. We don't access
       any data other than your GitHub username.</p>
    </p></center>
    </body></html>
EOF;
    exit(0);
}

// valid login, save it to the session since GitHub will redirect away and we'll need the same login credentials after.
$_SESSION['username'] = $user;
$_SESSION['password'] = $pass;

// see if we can hook up with GitHub to get a username.
force_authorize_with_github();

// still here? Add the github user to the repos.
$invites = $repos[$user];
foreach ($invites as $repo) {
     //print("repo: $repo\n\n\n");
     $response = call_github_api("https://api.github.com/repos/$repo/collaborators/" . $_SESSION['github_user'], [ 'permission' => 'pull' ], $github_invite_token, 'PUT');
     //print("RESPONSE($repo):\n"); print_r($response); print("\n\n\n");
}

// reset these in case they want to get invites for a different platform.
$_SESSION['username'] = '';
$_SESSION['password'] = '';

echo <<<EOF
<html><head><title>$title</title></head><body>
<p>Okay, you should have invitation(s) waiting for you for the following repositories:</p>
<p><ul>

EOF;

foreach ($invites as $repo) {
    print("<li>$repo</li>\n");
}

echo <<<EOF
</ul></p>

<p>Please check wherever GitHub sends you email.</p>
<p>Once you accept the invitations, you'll have access.</p>
<p>If you have problems, please <a href="mailto:icculus@icculus.org">ask Ryan for help</a>.</p>
<p>Otherwise, you can close this browser tab now.</p>
<p><a href="$base_url">Click here</a> to go back to the login prompt, if you have access to other invites.</p>
</body></html>

EOF;

?>
