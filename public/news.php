<?PHP
include ("../include/login.inc.php");
include ("header.inc.php");

//-------------------------------------------------------------------------------------------------
function show_motd() {
	echo <<<EOT

EOT;
}

//-------------------------------------------------------------------------------------------------
// Use the correct "header" for the page, depending on the action

switch ($action) {
	case "addnews":
	case "insertnews":
	case "editnews":
	case "updatenews":
	case "removenews":
	case "deletenews":
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
		break;
//-------------------------------------------------------------------------------------------------

	default: 
		echo <<<EOT

		<!-- News -->
		<font face="Verdana" size="5"><b>
			News
		</b></font>
		<br><br>
		<!-- End News -->

		<!-- News Table -->
		<table width="90%" align="center">
		<tr>
			<td>

			<!-- News Entry -->
			<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
			<tr>
				<td colspan="2">
				<font face="Verdana">
EOT;
}

//-------------------------------------------------------------------------------------------------
// Execute the action (default is "show news")

switch ($action) {
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

	default: 

		//-------------------------------------------------------------------------------------------------
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
	
		//-------------------------------------------------------------------------------------------------
		$i=0;
		while ($i < $number) {
			$row = pg_fetch_array($result, $i, PGSQL_ASSOC);

			sscanf($row[timestamp], "%d-%d-%d %d:%d", &$Y, &$M, &$D, &$h, &$m);
			$date = sprintf("%s %s, %s - %d:%02d", $months[$M], $D, $Y, $h, $m);

			//---------------------------------------------------------------------------------------------
			echo <<<EOT
	<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
	<tr>
		<td><font face="Verdana" size="3">
EOT;

			//---------------------------------------------------------------------------------------------
			print "<b>$date</b>\n";

			//---------------------------------------------------------------------------------------------
			echo <<<EOT
		</font></td>
		<td align="right">
EOT;

			//---------------------------------------------------------------------------------------------
			// news actions
			$mayeditnews	= ($userprivileges[editnews])	|| ($userid==$row[userid]);
			$mayremovenews	= ($userprivileges[removenews]) || ($userid==$row[userid]);

			if ($mayeditnews && $mayremovenews)
				print "<A href=\"$PHP_SELF?action=editnews&id=$row[id]\" border=0><img src=\"images/editnews.png\" border=0></A><A href=\"$PHP_SELF?action=removenews&id=$row[id]\" border=0><img src=\"images/deletenews.png\" border=0></A><BR>\n";
			else if ($mayeditnews)
				print "<A href=\"$PHP_SELF?action=editnews&id=$row[id]\" border=0><img src=\"images/editnews.png\" border=0></A><BR>\n";
			else if ($mayremovenews)
				print "<A href=\"$PHP_SELF?action=removenews&id=$row[id]\" border=0><img src=\"images/deletenews.png\" border=0></A><BR>\n";

			//---------------------------------------------------------------------------------------------
			echo <<<EOT
		</td>
	</tr>
	<tr>
		<td><font face="Verdana" size="3">
EOT;

			//---------------------------------------------------------------------------------------------
			// the news in itself
			print "$row[text]\n";

			//---------------------------------------------------------------------------------------------
			echo <<<EOT
		</font></td>
	</tr>
	</table>
EOT;

			//---------------------------------------------------------------------------------------------
			//Print out a Horizontal ruler
			if($i != ($number - 1))
				print "<hr height=\"1\" width=\"50%\" color=\"#D0F7FA\">";
			//---------------------------------------------------------------------------------------------

			$i++;
		}

		//-------------------------------------------------------------------------------------------------

		//--- add the submit news button ---//

		if ($userprivileges[addnews]) { 
			print "<FORM method=post action=\"$PHP_SELF?action=addnews\">\n";
			print "<INPUT type=submit value=\"submit news\">\n";
			print "</FORM>\n";
		}
	
		print "</BLOCKQUOTE>\n";
	
		include ("../include/jokes.inc.php");

		//-------------------------------------------------------------------------------------------------

		echo <<<EOT

				<p></font>
				</td>
			</tr>
			</table>
			<!-- End News Entry -->

			<!-- Next / Prev Buttons -->
			<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
			<tr>
				<td align="left" background="images/newsbarbg.png">
EOT;

		//--- show the "previous page" link if needed ---//
		
		$next = $start + $step;

		if ($start>0) {
			$prev = $start - $step; 

			if ($prev<0)		// this can only happen if the user went manually to a start not dividable by step 
				$prev = 0;

			print "<A href=\"$PHP_SELF?start=$prev\" border=0><img src=\"images/prev.png\" border=0></A>";
		}

		//-------------------------------------------------------------------------------------------------				
		echo <<<EOT
				</td>
				<td align="right" background="images/newsbarbg.png">
EOT;
				
		//-------------------------------------------------------------------------------------------------
		//--- show the "next page" link if needed ---//
		if ($next<$total)
			print "<A href=\"$PHP_SELF?start=$next\" border=0><img src=\"images/next.png\" border=0></A>";

}

//-------------------------------------------------------------------------------------------------
// Use the correct "footer" for the page, depending on the action

switch ($action) {
	case "addnews":
	case "insertnews":
	case "editnews":
	case "updatenews":
	case "removenews":
	case "deletenews":
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
		break;

//-------------------------------------------------------------------------------------------------
		
	default:
		echo <<<EOT
				</td>
			</tr>
			</table>
			<!-- End Next / Prev Buttons -->

			</td>
		</tr>
		</table>
		<!-- End News Table-->
		<br>

EOT;
}

include ("footer.inc.php");

?>
