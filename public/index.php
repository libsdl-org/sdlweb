<?PHP
	include ("../include/login.inc");


//-------------------------------------------------------------------------------------------------
	function show_motd()
	{
			echo <<< EOT

EOT;
	}

//-------------------------------------------------------------------------------------------------
	if ($wrong_login_or_password)
		$action = "showloginform";
	include ("header.inc");

//-------------------------------------------------------------------------------------------------
//Make sure we have an appropriate action to show the form
switch ($action) {
	case "showloginform":
	case "addnews":
	case "insertnews":
	case "editnews":
	case "updatenews":
	case "removenews":
	case "deletenews":

//-------------------------------------------------------------------------------------------------
echo <<<EOT

		<!-- Forms -->
		<table cellpadding="0" cellspacing="0" border="0" width="90%" align="center">
		<tr>
			</td>
			<font face="Verdana" size="5"><b>
			NewsAdmin
			</b></font>
			</td>
		<tr>
		</table>
		<!-- End Forms -->

		<!-- Forms Table -->
		<table cellpadding="0" cellspacing="0" border="1" bordercolorlight="black" bordercolordark="white" 		bgcolor="#B0D7FA" width="90%" align="center">
		<tr>
			<td>

			<!-- Form Options -->
			<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
			<tr>
				<td colspan="2">
				<font face="Verdana">
EOT;

//-------------------------------------------------------------------------------------------------
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

		case "addnews":
			if (!$userprivileges[addnews]) {
				print "You are not permitted to access this page!<BR>\n";
				break;
			}

			print "<FORM method=post action=\"$PHP_SELF?action=insertnews\">\n";
			print "<TEXTAREA name=newstext cols=60 rows=15 wrap=\"soft\"></TEXTAREA>\n"; 
			print "<P>\n";
			print "<INPUT type=submit value=Submit>\n";
			print "</P>\n";
			print "</FORM>\n";
			print "<A href=\"$PHP_SELF\">Back</A>\n";
			break;

		case "insertnews":
			if (!$userprivileges[addnews]) {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if ($newstext=="") {
				print "Please enter some text!<BR>\n";
				break;
			}

			$query = "insert into news (userid,timestamp,text)
				values($userid,CURRENT_TIMESTAMP,'$newstext')";

			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "News posted !<BR>\n";
			print "<BR>\n";
			print "<A href=\"$PHP_SELF\">Back</A>\n";
			break;

		case "editnews":
			$query = "select * from news where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$row = pg_fetch_array($result, 0, PGSQL_ASSOC);

			if (!$userprivileges[editnews]) {
				if (($userid!=$row[userid]) || ($userid<1)) {
					print "You are not permitted to access this page!<BR>\n";
					break;
				}
			}

			print "<FORM method=post action=\"$PHP_SELF?action=updatenews&id=$id\">\n";
			print "<TEXTAREA name=newstext cols=60 rows=15 wrap=soft>$row[text]</TEXTAREA>\n"; 
			print "<P>\n";
			print "<INPUT type=submit value=Submit>\n";
			print "</P>\n";
			print "</FORM>\n";
			break;

		case "updatenews":
			$query = "select userid from news where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$writerid = pg_result($result, 0, "userid");

			if (!$userprivileges[editnews]) {
				if (($userid!=$writerid) || ($userid<1)) {
					print "You are not permitted to access this page!<BR>\n";
					break;
				}
			}

			if ($newstext=="") {
				print "Please enter some text!<BR>\n";
				break;
			}

			$query = "update news set text='$newstext' where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query!");

			print "<I>Updated!</I><BR>\n";
			print "<BR>\n";
			print "<A href=$PHP_SELF>Back</A>\n";
			break;

		case "removenews":
			$query = "select * from news where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$row = pg_fetch_array($result, 0, PGSQL_ASSOC);

			if (!$userprivileges[removenews]) {
				if (($userid!=$row[userid]) || ($userid<1)) {
					print "You are not permitted to access this page!<BR>\n";
					break;
				}
			}

			print "Are you sure you want to delete the following news?\n";
			print "<P>\n";
			print "$row[text]\n"; 
			print "</P>\n";
			print "<TABLE>\n";
			print "<TR>\n";
			print "<TD>";
			print "<FORM method=post action=\"$PHP_SELF?action=deletenews&id=$id\">";
			print "<INPUT type=submit value=delete>";
			print "</FORM>";
			print "</TD>\n";
			print "<TD>";
			print "<FORM method=post action=\"$PHP_SELF\">";
			print "<INPUT type=submit value=cancel>";
			print "</FORM>";
			print "</TD>\n";
			print "</TR>\n";
			print "</TABLE>\n";
			break;

		case "deletenews":
			$query = "select userid from news where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$writerid = pg_result ($result, 0, "userid");

			if (!$userprivileges[removenews]) {
				if (($userid!=$writerid) || ($userid<1)) {
					print "You are not permitted to access this page!<BR>\n";
					break;
				}
			}

			$query = "delete from news where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "Deleted!<BR>\n";
			print "<BR>\n";
			print "<A href=index.php>Back</A>\n";
			break;
		default: //Do nothing
	}

//-------------------------------------------------------------------------------------------------
echo <<<EOT

				<p></font>
				</td>
			</tr>
			</table>
			<!-- End Form Options -->

			</td>
		</tr>
		</table><p>
		<!-- End Forms Table-->

EOT;

//-------------------------------------------------------------------------------------------------
	default: 
echo <<<EOT

		<!-- Intro -->
		<img src="/images/SDL_logo.gif" alt="SDL Logo">
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
