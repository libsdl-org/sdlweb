<?PHP
	include ("../include/login.inc");

//-------------------------------------------------------------------------------------------------
	if ($wrong_login_or_password)
		$action = "showloginform";

	include ("header.inc");

	//---------------------------------------------------------------------------------------------
	switch ($action) {
		case "showloginform":
			if ($wrong_login_or_password)
				print "<center>Wrong Login / Password!</center>\n";

			// not logged in yet -- getting user login & pass
			if ($userid == 0) { 	
				print "<FORM method=post action=\"$PHP_SELF?action=login\">\n";
				print "<P>Login<BR><INPUT type=text name=userlogin size=16 maxlength=20></P>\n";
				print "<P>Password<BR><INPUT type=password name=userpassword size=16 maxlength=50></P>\n";
				print "<P><INPUT type=checkbox name=userpersist value=yes>remember me</P>\n";
				print "<INPUT type=submit value=login>\n";
				print "</FORM>\n";
				print "<A href=\"users.php?action=createuser\"><center>Create new Account</center></A>\n";
			} else {
				print "You are already logged in as $userlogin\n";
				print "<P><A href=\"index.php\">Back to main page.</A></P>\n";
			}
			break;

		default:
			// Stupid Internet Explorer...
			if (eregi("MSIE.[56]", $_ENV["HTTP_USER_AGENT"])) {
				$logo = "SDL_logo.gif";
			} else {
				$logo = "SDL_logo.png";
			}
			echo <<<EOT
		<!-- Intro -->
		<img src="images/$logo" alt="SDL" width="457" height="266">
		<br><br>
		<font face="Verdana">
		Simple DirectMedia Layer is a cross-platform multimedia library designed to provide level access to audio, keyboard, mouse, joystick, 3D hardware via OpenGL, and 2D video framebuffer. It is used by MPEG playback software, emulators, and many popular games, including the award winning Linux port of "Civilization: Call To Power."<p>
		Simple DirectMedia Layer supports Linux, Windows, BeOS, MacOS Classic, MacOS X, FreeBSD, OpenBSD, BSD/OS, Solaris, IRIX, and QNX. There is also code, but no official support, for Windows CE, AmigaOS, Dreamcast, Atari, NetBSD, AIX, OSF/Tru64, and SymbianOS.<p>
		SDL is written in C, but works with C++ natively, and has bindings to several other languages, including Ada, Eiffel, Java, Lua, ML, Perl, PHP, Pike, Python, and Ruby. <br>
		</font>
		<!-- End Intro -->

EOT;
	}
	
	include ("footer.inc");
?>
