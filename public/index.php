<?PHP
	include ("../include/login.inc");

	function show_motd()
	{
			echo <<< EOT
EOT;
	}

	if ($wrong_login_or_password)
		$action = "showloginform";

	switch ($action) {
		case "showloginform":
		case "addnews":
		case "insertnews":
		case "editnews":
		case "updatenews":
		case "removenews":
		case "deletenews":
			include ("header.inc");
			break;
		default:
			$mainpage = true;
			include ("header.inc");
			echo <<<EOT
<!-- TITLE LOGO -->
<TABLE border=2>
<TBODY>
<TR>
<TD>
<IMG alt="SDL Logo" height=307 src="images/SDL_title.jpg" width=588>
</TD>
</TR>
</TBODY>
</TABLE>
<!-- CONTENT, ALIGNED WITH LOGO -->
<TABLE border=0 cellPadding=15 width=600>
<TBODY>
<TR>
<TD bgColor="#fff8dc" vAlign=top>
EOT;
	}

	switch ($action) {
		case "showloginform":
		case "addnews":
		case "insertnews":
		case "editnews":
		case "updatenews":
		case "removenews":
		case "deletenews":
			break;
		default:
			echo <<<EOT
<P>
<FONT color="#414141" size=4><STRONG>
&nbsp;&nbsp;&nbsp;&nbsp;Simple DirectMedia Layer is a cross-platform multimedia library designed to provide level access to audio, keyboard, mouse, joystick, 3D hardware via OpenGL, and 2D video framebuffer. It is used by MPEG playback software, emulators, and many popular games, including the award winning Linux port of "Civilization: Call To Power."
</STRONG></FONT>
</P>
<FONT color="#414141" size=4><STRONG>
Simple DirectMedia Layer supports Linux, Windows, BeOS, MacOS Classic, MacOS X, FreeBSD, OpenBSD, BSD/OS, Solaris, IRIX, and QNX.  There is also code, but no official support, for Windows CE, AmigaOS, Dreamcast, Atari, NetBSD, AIX, OSF/Tru64, and SymbianOS.
<P>
<FONT color="#414141" size=4><STRONG>
</STRONG></FONT>
</P>
<P>
<FONT color="#414141" size=4><STRONG>
SDL is written in C, but works with C++ natively, and has bindings to several other languages, including Ada, Eiffel, Java, Lua, ML, Perl, PHP, Pike, Python, and Ruby. 
</STRONG></FONT>
</P>
EOT;
	}

	if ($action=="showloginform")
		print "<H1><FONT color=\"#414141\">Login:</FONT></H1>\n";
	else
		print "<H1><FONT color=\"#414141\">News:</FONT></H1>\n";

	print "<BLOCKQUOTE>\n";

	switch ($action) {
		case "showloginform":
			if ($wrong_login_or_password)
				print "<I>Wrong login/password !</I>\n";

			if ($userid==0) { 	// not logged in yet -- getting user login & pass
				print "<FORM method=post action=\"$PHP_SELF?action=login\">\n";
				print "<P>login<BR><INPUT type=text name=userlogin size=16 maxlength=20></P>\n";
				print "<P>password<BR><INPUT type=password name=userpassword size=16 maxlength=50></P>\n";
				print "<P><INPUT type=checkbox name=userpersist value=yes>remember me</P>\n";
				print "<INPUT type=submit value=login>\n";
				print "</FORM>\n";
				print "<A href=\"users.php?action=createuser\">create new account</A>\n";
			} else {
				print "You are already logged as $userlogin\n";
				print "<P><A href=\"index.php\">back to main page</A></P>\n";
			}
			break;

		case "addnews":
			if (!$userprivileges[addnews]) {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			print "<FORM method=post action=\"$PHP_SELF?action=insertnews\">\n";
			print "<TEXTAREA name=newstext cols=60 rows=15 wrap=\"soft\"></TEXTAREA>\n"; 
			print "<P>\n";
			print "<INPUT type=submit value=Submit>\n";
			print "</P>\n";
			print "</FORM>\n";
			print "<A href=\"$PHP_SELF\">back</A>\n";
			break;

		case "insertnews":
			if (!$userprivileges[addnews]) {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if ($newstext=="") {
				print "Please enter some text !<BR>\n";
				break;
			}

			$query = "insert into news (userid,timestamp,text)
				values($userid,CURRENT_TIMESTAMP,'$newstext')";

			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "News posted !<BR>\n";
			print "<BR>\n";
			print "<A href=\"$PHP_SELF\">back</A>\n";
			break;

		case "editnews":
			$query = "select * from news where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$row = pg_fetch_array($result, 0, PGSQL_ASSOC);

			if (!$userprivileges[editnews]) 
				if (($userid!=$row[userid]) || ($userid<1)) {
					print "You are not permitted to access this page !<BR>\n";
					break;
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

			if (!$userprivileges[editnews]) 
				if (($userid!=$writerid) || ($userid<1)) {
					print "You are not permitted to access this page !<BR>\n";
					break;
				}

			if ($newstext=="") {
				print "Please enter some text !<BR>\n";
				break;
			}

			$query = "update news set text='$newstext' where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "<I>Updated !</I><BR>\n";
			print "<BR>\n";
			print "<A href=$PHP_SELF>back</A>\n";
			break;

		case "removenews":
			$query = "select * from news where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$row = pg_fetch_array($result, 0, PGSQL_ASSOC);

			if (!$userprivileges[removenews]) 
				if (($userid!=$row[userid]) || ($userid<1)) {
					print "You are not permitted to access this page !<BR>\n";
					break;
				}

			print "Are you sure you want to delete the following news ?\n";
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

			if (!$userprivileges[removenews]) 
				if (($userid!=$writerid) || ($userid<1)) {
					print "You are not permitted to access this page !<BR>\n";
					break;
				}

			$query = "delete from news where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "Deleted !<BR>\n";
			print "<BR>\n";
			print "<A href=index.php>back</A>\n";
			break;

		default:
			// Temporary notices:
			show_motd();

			if (!isset($step))
				$step = 8;		// max number news items to show at one time

			if (!isset($start))
				$start = 0;		// number news items to skip

			//--- calculate number of news items ---//

			$query = "select count(*) as count from news";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			$total = pg_result ($result, 0, "count");

			//--- fetch news ---//

			$query = "select * from news order by id desc limit $step offset $start";
			$result = pg_exec($DBconnection, $query)
					or die ("Could not execute query !");

			$number = pg_numrows($result);

			//--- print news ---//
			$months = array(
				"Unused",
				"January",
				"February",
				"March",
				"April",
				"May",
				"June",
				"July",
				"August",
				"September",
				"October",
				"November",
				"December",
			);

			$i=0;
			while ($i < $number) {
				$row = pg_fetch_array($result, $i, PGSQL_ASSOC);
 
				// the news in itself

				sscanf($row[timestamp], "%d-%d-%d %d:%d", &$Y, &$M, &$D, &$h, &$m);
				$date = sprintf("%s %s, %s - %d:%02d", $months[$M], $D, $Y, $h, $m);

				print "<P>\n";
				print "$date<br>\n";
				print "<FONT color=\"#414141\" size=4><STRONG>\n";
				print "$row[text]\n";
				print "</STRONG></FONT></P>\n";

				// optional actions

				$mayeditnews = ($userprivileges[editnews]) || ($userid==$row[userid]);
				$mayremovenews = ($userprivileges[removenews]) || ($userid==$row[userid]);

				if ($mayeditnews && $mayremovenews)
					print "<A href=\"$PHP_SELF?action=editnews&id=$row[id]\">edit</A>&nbsp<A href=\"$PHP_SELF?action=removenews&id=$row[id]\">delete</A><BR>\n";
				else if ($mayeditnews)
					print "<A href=\"$PHP_SELF?action=editnews&id=$row[id]\">edit</A><BR>\n";
				else if ($mayremovenews)
					print "<A href=\"$PHP_SELF?action=removenews&id=$row[id]\">delete</A><BR>\n";

				$i++;
			}

			//--- show the "previous page" link if needed ---//

			$next = $start + $step;

			if (($start>0) || ($next<$total))
				print "<P>\n";

			if ($start>0) {
				$prev = $start - $step; 

				if ($prev<0)		// this can only happend if the user went manually to a start not dividable by step 
					$prev = 0;

				print "<A href=\"$PHP_SELF?start=$prev\">previous page</A>&nbsp";
			}

			//--- show the "next page" link if needed ---//
		
			if ($next<$total)
				print "<A href=\"$PHP_SELF?start=$next\">next page</A>";

			if (($start>0) || ($next<$total))
				print "</P>\n";

			//--- add the submit news button ---//

			if ($userprivileges[addnews]) { 
				print "<FORM method=post action=\"index.php?action=addnews\">\n";
				print "<INPUT type=submit value=\"submit news\">\n";
				print "</FORM>\n";
			}
	
			print "</BLOCKQUOTE>\n";
	
			include ("../include/jokes.inc");
	}

	switch ($action) {
		case "showloginform":
		case "addnews":
		case "insertnews":
		case "editnews":
		case "updatenews":
		case "removenews":
		case "deletenews":
			print "</BLOCKQUOTE>\n";
			break;
		default:
	}

	include ("footer.inc");
?>
