<?php
// GitHub POSTs to this script whenever any repository in the libsdl-org
//  Organization is pushed to. This lets us do several things:
//  - Tweet new commits via @sdl_commits.
//  - Post commit notifications to Discourse.
//  - Fire up the buildbot (EDIT: this is handled in a different webhook).
//  - Update the website by pulling from the sdlweb repo.
//  - etc.

header('Content-Type: text/plain; charset=utf-8');

// Stole some of this from https://github.com/dintel/php-github-webhook/blob/master/src/Handler.php
function validateSignature($gitHubSignatureHeader, $payload)
{
    $secret = rtrim(file_get_contents('/webspace/github-webhook-secret.txt'));
    list ($algo, $gitHubSignature) = explode("=", $gitHubSignatureHeader);

    if (($algo !== 'sha256') && ($algo !== 'sha1')) {
        // see https://developer.github.com/webhooks/securing/
        return false;
    }

    $payloadHash = hash_hmac($algo, $payload, $secret);
    return ($payloadHash === $gitHubSignature);
}

$signature = isset($_SERVER['HTTP_X_HUB_SIGNATURE_256']) ? $_SERVER['HTTP_X_HUB_SIGNATURE_256'] : NULL;
$event = isset($_SERVER['HTTP_X_GITHUB_EVENT']) ? $_SERVER['HTTP_X_GITHUB_EVENT'] : NULL;
$delivery = isset($_SERVER['HTTP_X_GITHUB_DELIVERY']) ? $_SERVER['HTTP_X_GITHUB_DELIVERY'] : NULL;

if (!isset($signature, $event, $delivery)) {
    print("BAD SIGNATURE\n");
    exit(0);
}

$payload = file_get_contents('php://input');

// Check if the payload is json or urlencoded.
if (strpos($payload, 'payload=') === 0) {
    $payload = substr(urldecode($payload), 8);
}

if (!validateSignature($signature, $payload)) {
    print("BAD SIGNATURE\n");
    exit(0);
}

print("SIGNATURE OK\n");
print("GITHUB EVENT: $event\n");

if ($event == 'push') {
    $basedir = '/webspace/sdl_commit_events';
    $dirs = scandir($basedir, SCANDIR_SORT_NONE);
    if ($dirs === false) {
        print("FAILED TO SCANDIR BASE DIRECTORY.\n");
        exit(0);
    }

    foreach ($dirs as $d) {
        if (substr($d, 0, 1) == '.') { continue; }  // skip "." and ".." and other magic files.

        // Use an advisory lock to make sure we don't race against other webhook handlers
        //  or the consumers of this data.
        $lockfname = "$basedir/$d/.github_webhook_lock";
        $lockfp = fopen($lockfname, 'c+');
        if ($lockfp === false) {
            print("LOCKFILE '$lockfname' DID NOT OPEN.  :O\n");  // going on and praying to avoid race by sheer luck  :/
        } else if (flock($lockfp, LOCK_EX) === false) {
            print("LOCKFILE '$lockfname' DID NOT LOCK.  :O\n");  // going on and praying to avoid race by sheer luck  :/
        }

        // Tell the cronjobs there's work to do. Dump the json payload where they can find it.
        $fnameid = time();
        $fp = false;
        $fname = '';
        do {
            $fname = "$basedir/$d/$fnameid";
            $fnameid++;
        } while (($fp = @fopen($fname, 'x')) === false);  // 'x' so we make sure other hook handlers don't compete for the file name.

        fwrite($fp, $payload);
        fclose($fp);

        if ($lockfp !== false) {
            flock($lockfp, LOCK_UN);
            fclose($lockfp);
        }

        print("PUSH INFO SAVED TO: $fname\n");
    }

    if ($repo == 'sdlweb') {
        // !!! FIXME: update the website.
    }
}

// handle other events we care about here.

print("OK\n\n");
exit(0);

?>

