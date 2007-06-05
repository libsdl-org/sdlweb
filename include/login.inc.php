<?PHP
	include('common.inc.php');

	# ------------ layout variables ---------------
	define(WEBADMIN, 'slouken@libsdl.org');
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	# ------------ database connection ------------

    // This should have the following lines, minus comments:
    //
    //  $dbuser = 'username';
    //  $dbpass = 'password';
    //
    // Obviously, those should be a real username and password for the database.
    require_once '/home/sdlweb/dbpasswd.php';
    $DBconnection = mysql_connect('mysql.libsdl.org', $dbuser, $dbpass);
    if (!$DBconnection)
    {
		$header_filename = "header-static.inc.php";
        $DBConnection = NULL;
		return;
    } // if

    if (!mysql_select_db('sdlweb'))
    {
		$header_filename = "header-static.inc.php";
        $DBConnection = NULL;
		return;
    } // if

	$header_filename = "header.inc.php";

/*  ...old postgres code...
	$DBconnection = pg_connect("dbname=sdlweb user=sdlweb");
	if (!$DBconnection) {
		$header_filename = "header-static.inc.php";
		return;
	} else
		$header_filename = "header.inc.php";
*/

	# ------------ cookies functions --------------

	function RemoveCookies() {
		setcookie("sdlweb", "", time()-3600);
	}

	function SetCookies($login, $password, $persist) {
		if ($persist == "yes")
			$expirationtime = time()+60*60*24*365;	# 1 year
		else
			$expirationtime = time()+60*15;			# 15 minutes
		setcookie("sdlweb", "$login:$password:$persist", $expirationtime);
	}

	# ----------- login/logout -------------------

	switch ($action) {
		case "logout":
			$userlogin = "anonymous";
			$userpassword = "";
			$userpersist = "";
			break;

		case "login":
			$userlogin = $_POST['userlogin'];
			$userpassword = md5($_POST['userpassword']);
			$userpersist = $_POST['userpersist'];
			break;

		default:
			list($userlogin, $userpassword, $userpersist) = explode(":", $_COOKIE['sdlweb']);
	}

	if ($userlogin == "")
		$userlogin = "anonymous";

	# --------------- get user id -----------------

	$userid = 0;
	$usergroup = 0;
	if ($userlogin != "anonymous") {
		# We need to validate userpassword even if it is crypted at this point
		# in a normal usecase because it can be coming directly from the cookie
		# and thus could be forged.
		# Tags are not allowed in the password field at this point since the 
		# crypted version of the password should be an hexadecimal string and 
		# as such not contain any tag.
		$fields_def = array(
			'login'=>array('type'=>'char', 'size'=>20, 'required'=>True),
			'password'=>array('type'=>'char', 'size'=>32, 'required'=>True),
		);
		$login_input = validateinput(
			array('login'=>$userlogin, 'password'=>$userpassword), 
			$fields_def, 
			array('login', 'password'));
			
		if (!$login_input)
			$wrong_login_or_password = 1;
		else {
			$query = "select id,groupid,email from users where login='{$login_input['login']}' and password='{$login_input['password']}'";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			if (mysql_num_rows($result) < 1) {				# could be 0 (no row) or -1 (error)
				$wrong_login_or_password = 1;
			} else {
				$userid = mysql_result($result, 0, "id");
				$usergroup = mysql_result($result, 0, "groupid");
				$useremail = mysql_result($result, 0, "email");

				$query = "update users set lastlogin = CURRENT_TIMESTAMP where id=$userid";
				mysql_query($query, $DBconnection)
					or die ("Could not execute query !");
			}
		}
	}

	# ------------ get user privileges ------------

	$query = "select * from groups where id=$usergroup";
	$result = mysql_query($query, $DBconnection)
		or die ("Could not execute query !");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);


	# -- translate them into more useful values --

	reset($row);
	while (list ($key, $val) = each ($row)) {
		$userprivileges[$key] = ($val==1);
	}

	# -------------- change passwd ----------------

	switch ($action) {
		case "updatepwd": 
			# oldpass, newpass1 and newpass2 are not crypted
			# userpassword and newpassword are crypted
			
			# Note: we don't need to validate newpassword even though it'll
			# be used in an SQL query since it goes through md5
			$newpassword = $oldpassword = "";
			if (($_POST['pass1'] != "") && ($_POST['pass1'] == $_POST['pass2']))
				if (!$userprivileges['manageusers']) {
					$oldpassword = md5($_POST['oldpass']);
					if ($oldpassword == $userpassword)
						$newpassword = md5($_POST['pass1']);
				} else {
					$newpassword = md5($_POST['pass1']);
				}					
			break;
	}

	# -------------- cookies stuff ---------------

	if ($wrong_login_or_password)
		RemoveCookies();

	switch ($action) {
		case "logout":
			RemoveCookies();
			break;

		case "deleteuser":	
			if ($userid == $_GET['id'])
				RemoveCookies();
			break;

		case "updatepwd":
			if (($userid == $_GET['id']) && ($newpassword != ""))
				SetCookies($userlogin, $newpassword, $userpersist);
			break;

		default:
			# Refresh the cookie so it doesn't time out
			if ($userid != 0)
				SetCookies($userlogin, $userpassword, $userpersist);
			break;
	}
/*
# Debugging aids: 
echo "userlogin = $userlogin<br>";
echo "userpassword = $userpassword<br>";
echo "userpersist = $userpersist<br>";
echo "userid = $userid<br>";
*/
?>
