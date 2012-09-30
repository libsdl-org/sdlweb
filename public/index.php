<?PHP
	include ("../include/login.inc.php");
	include ($header_filename);

//-------------------------------------------------------------------------------------------------
	if ($wrong_login_or_password)
		$action = "showloginform";

	if (!$DBconnection)
		echo "<p class='warning'>Warning: Could not connect to the database ! All dynamic features of the site are unavailable!</p>\n";

	//---------------------------------------------------------------------------------------------
	switch ($action) {
		case "showloginform":
			if ($wrong_login_or_password)
				echo "<p class='warning'>Wrong Login / Password!</p>\n";

			// not logged in yet -- getting user login & pass
			if ($userid == 0) { 	
				echo <<<EOT
					<form method="post" action="{$_SERVER['PHP_SELF']}?action=login">
					<p>Login<br><input type="text" name="userlogin" size="16" maxlength="20"></p>
					<p>Password<br><input type="password" name="userpassword" size="16" maxlength="50"></p>
					<p><input type="checkbox" name="userpersist" value="yes">remember me</p>
					<input type="submit" value="login">
					</form>
					<a href="{$_SERVER['PHP_SELF']}?action=showresetform">Recover Password</a><br>
					<a href="users.php?action=createuser">Create new Account</a>

EOT;
			} else {
				echo <<<EOT
					<p class="warning">You are already logged in as $userlogin</p>
					<p><a href="index.php">Back to main page.</a></p>

EOT;
			}
			break;

		case "showresetform":
			echo <<<EOT
				<form method="post" action="users.php?action=resetpwd">
				<p>Login or e-mail address<br><input type="text" name="reset" size="50" maxlength="64"></p>
				<input type="submit" value="Reset">
				</form>
EOT;
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
		SDL is written in C, but works with C++ natively, and has bindings to several other languages, including Ada, C#, D, Eiffel, Erlang, Euphoria, Go, Guile, Haskell, Java, Lisp, Lua, ML, Oberon/Component Pascal, Objective C, Pascal, Perl, PHP, Pike, Pliant, Python, Ruby, Smalltalk, and Tcl.
		</p>
		<p>
		SDL is distributed under GNU LGPL version 2.  This license allows you to use SDL freely in commercial programs as long as you link with the dynamic library.
		</p>
		<hr>
		<P>Welcome to the last planned release for SDL 1.2!
		<br>
		<a href="http://www.libsdl.org/download-1.2.php">http://www.libsdl.org/download-1.2.php</a>
		</P>
		<P>
		This release is intended to clean up the bug list for SDL 1.2 and let us focus on new development for SDL 2.0!
		</P>
		<P>
		I would like to thank everybody who contributed bug reports and fixes for this release!
		</P>
		</div>
		<!-- End Intro -->

EOT;
	}
	
	include ("footer.inc.php");
?>
