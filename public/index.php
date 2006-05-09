<?PHP
	include ("../include/login.inc.php");
	include ($header_filename);

//-------------------------------------------------------------------------------------------------
	if ($wrong_login_or_password)
		$action = "showloginform";

	if (!$DBconnection)
		echo "<P class='warning'>Warning: Could not connect to the database ! All dynamic features of the site are unavailable!</P>\n";

	//---------------------------------------------------------------------------------------------
	switch ($action) {
		case "showloginform":
			if ($wrong_login_or_password)
				echo "<P class='warning'>Wrong Login / Password!</P>\n";

			// not logged in yet -- getting user login & pass
			if ($userid == 0) { 	
				echo <<<EOT
					<FORM method=post action="$PHP_SELF?action=login">
					<P>Login<BR><INPUT type=text name=userlogin size=16 maxlength=20></P>
					<P>Password<BR><INPUT type=password name=userpassword size=16 maxlength=50></P>
					<P><INPUT type=checkbox name=userpersist value=yes>remember me</P>
					<INPUT type=submit value=login>
					</FORM>
					<A href="users.php?action=createuser">Create new Account</A>

EOT;
			} else {
				echo <<<EOT
					<P class="warning">You are already logged in as $userlogin</P>
					<P><A href="index.php">Back to main page.</A></P>

EOT;
			}
			break;

		default:
			// Stupid Internet Explorer...
			if (eregi("MSIE.[56]", $_SERVER["HTTP_USER_AGENT"])) {
				$logo = "SDL_logo.gif";
			} else {
				$logo = "SDL_logo.png";
			}
			echo <<<EOT
		<!-- Intro -->
		<img src="images/$logo" alt="SDL" width="457" height="266">
		<br><br>
		<div style="font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif">
		<p>
		Simple DirectMedia Layer is a cross-platform multimedia library designed to provide low level access to audio, keyboard, mouse, joystick, 3D hardware via OpenGL, and 2D video framebuffer. It is used by MPEG playback software, emulators, and many popular games, including the award winning Linux port of "Civilization: Call To Power."
		</p>
		<p>
		SDL supports Linux, Windows, Windows CE, BeOS, MacOS, Mac OS X, FreeBSD, NetBSD, OpenBSD, BSD/OS, Solaris, IRIX, and QNX.  The code contains support for AmigaOS, Dreamcast, Atari, AIX, OSF/Tru64, RISC OS, SymbianOS, and OS/2, but these are not officially supported.
		</p>
		<p>
		SDL is written in C, but works with C++ natively, and has bindings to several other languages, including Ada, C#, Eiffel, Erlang, Euphoria, Guile, Haskell, Java, Lisp, Lua, ML, Objective C, Pascal, Perl, PHP, Pike, Pliant, Python, Ruby, and Smalltalk.
		</p>
		<p>
		SDL is distributed under GNU LGPL version 2.  This license allows you to use SDL freely in commercial programs as long as you link with the dynamic library.
		</p>
		</div>
		<!-- End Intro -->

EOT;
	}
	
	include ("footer.inc.php");
?>
