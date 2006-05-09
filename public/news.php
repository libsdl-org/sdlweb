<?PHP
include ("../include/login.inc.php");
include ("../include/updaterss.inc.php");
include ("header.inc.php");

//-------------------------------------------------------------------------------------------------
function show_motd() {
	//phpinfo();
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
		<h1>NewsAdmin</h1>

		<!-- Forms Table -->
		<table cellpadding="0" cellspacing="0" border="0" width="90%" align="center">
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
		<h1>News</h1>

		<!-- News Table -->
		<table width="90%" align="center">
		<tr>
			<td>

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

		echo <<<EOT
		<FORM method=post action="$PHP_SELF?action=insertnews">
		<TEXTAREA name=newstext cols=60 rows=15 wrap="soft"></TEXTAREA>
		<P>
		<INPUT type=submit value=Submit>
		</P>
		</FORM>
		<A href="$PHP_SELF">Back</A>
EOT;
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
		UpdateRSS($DBconnection);

		echo <<<EOT
		News posted !<BR>
		<BR>
		<A href="$PHP_SELF">Back</A>
EOT;
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

		echo <<<EOT
		<FORM method=post action="$PHP_SELF?action=updatenews&amp;id=$id">
		<TEXTAREA name=newstext cols=60 rows=15 wrap=soft>$row[text]</TEXTAREA>
		<P>
		<INPUT type=submit value=Submit>
		</P>
		</FORM>
EOT;
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
		UpdateRSS($DBconnection);

		echo <<<EOT
		<I>Updated!</I><BR>
		<BR>
		<A href="$PHP_SELF">Back</A>
EOT;
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

		echo <<<EOT
		Are you sure you want to delete the following news?
		<P>
		$row[text]
		</P>
		<TABLE>
		<TR>
		<TD>
		<FORM method=post action="$PHP_SELF?action=deletenews&amp;id=$id">
		<INPUT type=submit value=delete>
		</FORM>
		</TD>
		<TD>
		<FORM method=post action="$PHP_SELF">
		<INPUT type=submit value=cancel>
		</FORM>
		</TD>
		</TR>
		</TABLE>
EOT;
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
		UpdateRSS($DBconnection);

		echo <<<EOT
		Deleted!<BR>
		<BR>
		<A href="index.php">Back</A>
EOT;
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

			//---------------------------------------------------------------------------------------------
			// date

			sscanf($row['timestamp'], "%d-%d-%d %d:%d", &$Y, &$M, &$D, &$h, &$m);
			$date = sprintf("%s %s, %s - %d:%02d", $months[$M], $D, $Y, $h, $m);

			//---------------------------------------------------------------------------------------------
			// news actions

			$mayeditnews	= ($userprivileges["editnews"])	|| ($userid==$row["userid"]);
			$mayremovenews	= ($userprivileges["removenews"]) || ($userid==$row["userid"]);

			$newsactionstring = "";
			if ($mayeditnews)
				$newsactionstring .= "<A href=\"$PHP_SELF?action=editnews&amp;id=$row[id]\"><img src=\"images/editnews.png\" border=\"0\" alt=\"edit\"></A>";
			if ($mayremovenews)
				$newsactionstring .= "<A href=\"$PHP_SELF?action=removenews&amp;id=$row[id]\"><img src=\"images/deletenews.png\" border=\"0\" alt=\"delete\"></A>";
				
			//---------------------------------------------------------------------------------------------
			echo <<<EOT
	<!-- News Entry -->
	<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
	<tr>
		<td><span class="newsdate">
		$date
		</span></td>
		<td align="right">
		$newsactionstring
		</td>
	</tr>
	<tr>
		<td><div class="newstext">
		{$row['text']}
		</div></td>
		<td/>
	</tr>
	</table>
	<!-- End News Entry -->

EOT;

			//---------------------------------------------------------------------------------------------
			// Print out a Horizontal ruler
			if ($i != $number - 1)
				echo '	<hr class="newssep">', "\n";
			//---------------------------------------------------------------------------------------------

			$i++;
		}

		//-------------------------------------------------------------------------------------------------

		//--- add the submit news button ---//

		if ($userprivileges[addnews]) {
			echo <<<EOT
			<br>
			<FORM method=post action="$PHP_SELF?action=addnews">
			<INPUT type=submit value="submit news">
			</FORM>

EOT;
		}
	
		include ("../include/jokes.inc.php");

		//-------------------------------------------------------------------------------------------------
		// prev/next page links

		echo <<<EOT
			<!-- Next / Prev Buttons -->
			<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
			<tr>
				<td style="background-image: url(images/newsbarbg.png)" align="left">

EOT;

		//--- show the "previous page" link if needed ---//
		
		$next = $start + $step;

		if ($start>0) {
			$prev = $start - $step; 

			if ($prev<0)
				// this can only happen if the user went manually to a start not dividable by step 
				$prev = 0;

			print "<A href=\"$PHP_SELF?start=$prev\"><img src=\"images/prev.png\" border=\"0\" alt=\"Previous\"></A>\n";
		}

		//-------------------------------------------------------------------------------------------------				
		echo <<<EOT
				</td>
				<td style="background-image: url(images/newsbarbg.png)" align="right">

EOT;

		//--- show the "next page" link if needed ---//
		if ($next < $total)
			print "<A href=\"$PHP_SELF?start=$next\"><img src=\"images/next.png\" border=\"0\" alt=\"Next\"></A>\n";

		echo <<<EOT
				</td>
			</tr>
			</table>
			<!-- End Next / Prev Buttons -->

EOT;

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
		<!-- End Forms Table -->

EOT;
		break;

//-------------------------------------------------------------------------------------------------
		
	default:
		echo <<<EOT

			</td>
		</tr>
		</table>
		<!-- End News Table -->

EOT;
}

include ("footer.inc.php");

?>
