<?PHP
include ("../include/login.inc");
include ("header.inc");

//-------------------------------------------------------------------------------------------------
	function show_motd()
	{
			echo <<< EOT

EOT;
	}

//-------------------------------------------------------------------------------------------------
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
	// the news in itself
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
	//News Actions
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
	print "$row[text]\n";

	//---------------------------------------------------------------------------------------------
echo <<<EOT
		</font></td>
	</tr>
	</table>
EOT;

	//---------------------------------------------------------------------------------------------
	//Print out a Horizontal ruler
	if($i != ($number - 1)) {
		print "<hr height=\"1\" width=\"50%\" color=\"#D0F7FA\">";
	}
	//---------------------------------------------------------------------------------------------

	$i++;
}

//-------------------------------------------------------------------------------------------------
			//--- add the submit news button ---//

			if ($userprivileges[addnews]) { 
				print "<FORM method=post action=\"index.php?action=addnews\">\n";
				print "<INPUT type=submit value=\"submit news\">\n";
				print "</FORM>\n";
			}
	
			print "</BLOCKQUOTE>\n";
	
			include ("../include/jokes.inc");

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

//-------------------------------------------------------------------------------------------------
			//--- show the "previous page" link if needed ---//
			$next = $start + $step;

			if ($start>0) {
				$prev = $start - $step; 

				if ($prev<0)		// this can only happend if the user went manually to a start not dividable by step 
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

//-------------------------------------------------------------------------------------------------
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

include ("footer.inc");

?>
