<?PHP
	//------------ layout variables ---------------//
	$webadmin = "slouken@libsdl.org";

	//------------ layout functions ---------------//
	// These functions go here instead of header.inc because
	// header.inc is included by raw HTML code, and it's hard
	// output PHP code in raw HTML and have it parse correctly.
	function BeginContent($title)
	{
		echo <<<EOT
<H1><FONT color="#414141"><STRONG>$title</STRONG></FONT></H1>
<BR>
<BLOCKQUOTE>
EOT;
	}
	function CloseContent()
	{
		echo <<<EOT
</BLOCKQUOTE>
EOT;
	}

	//------------ database connection ------------//
	$DBconnection = pg_connect("dbname=sdlweb user=sdlweb")
		or die ("Could not connect to the database !");

	//------------ cookies functions --------------//

	function RemoveCookies()
	{
		setcookie("sdlweb","",time()-3600);
	}

	function SetCookies($login,$password,$persist)
	{
		if ( $persist == "yes" ) {
			$expirationtime = time()+60*60*24*365;	// 1 year
		} else {
			$expirationtime = time()+60*15;		// 15 minutes
		}
		setcookie("sdlweb","$login:$password:$persist",$expirationtime);
	}

	//----------- login/logout -------------------//

	switch ($action) {
		case "logout":
			$userlogin = "anonymous";
			$userpassword = "";
			break;

		case "login":
			$userpassword = md5($userpassword);
			break;

		default:
			list($userlogin,$userpassword,$userpersist) = explode(":",$sdlweb);
	}

	if ($userlogin=="")
		$userlogin = "anonymous";

	//--------------- get user id -----------------//

	$userid = 0;
	$usergroup = 0;
	$usernick = "Anonymous";

	if ($userlogin!="anonymous") {
		$query = "select id,groupid,email from users where login='$userlogin' and password='$userpassword'";
		$result = pg_exec($DBconnection, $query)
			or die ("Could not execute query !");

		if ( pg_numrows($result) < 1) {				// could be 0 (no row) or -1 (pg_numrows error)
			$wrong_login_or_password = 1;
		} else {
			$userid = pg_result ($result, 0, "id");
			$usergroup = pg_result ($result, 0, "groupid");
			$useremail = pg_result ($result, 0, "email");
		}
	}

	//------------ get user privileges ------------//

	$query = "select * from groups where id=$usergroup";
	$result = pg_exec($DBconnection, $query)
		or die ("Could not execute query !");
	$row = pg_fetch_array($result, 0, PGSQL_ASSOC);

	//-- translate them into more usefull values --//

	reset ($row);
	while (list ($key, $val) = each ($row))
		$userprivileges[$key] = ($val=='t');

	//-------------- change passwd ----------------//

	switch ($action) {
		case "updatepwd": //oldpass,newpass = not crypted <> password = crypted
			$newpassword = "";
			if (($newpass1!="") && ($newpass1==$newpass2))
				if (!$userprivileges[manageusers]) {
					$oldpassword = md5($oldpass);
					if ($oldpassword==$userpassword)
						$newpassword = md5($newpass1);
				} else {
					$newpassword = md5($newpass1);
				}
			break;
	}

	//-------------- cookies stuff ---------------//

	if ($wrong_login_or_password)
		RemoveCookies();

	switch ($action) {
		case "logout":
			RemoveCookies();
			break;

		case "deleteuser":	
			if ($userid==$id)
				RemoveCookies();
			break;

		case "updatepwd":
			if (($userid==$id) && ($newpassword!=""))
				SetCookies($userlogin,$newpassword,$userpersist);
			break;

		default:
			// Refresh the cookie so it doesn't time out
			if ($userid!=0)
				SetCookies($userlogin,$userpassword,$userpersist);
			break;
	}
/* Debugging aids:
echo "userlogin = $userlogin<br>";
echo "userpassword = $userpassword<br>";
echo "userpersist = $userpersist<br>";
echo "userid = $userid<br>";
*/
?>
