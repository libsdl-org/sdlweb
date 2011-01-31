<?PHP
include("../include/login.inc.php");
include("../include/updaterss.inc.php");
include("header.inc.php");

//-------------------------------------------------------------------------------------------------
function show_motd() {
	//phpinfo();
	echo <<<EOT

EOT;
}

$id = $_GET['id'];

$fields_def = array(
	'id'=>array('type'=>'integer', 'required'=>True),
//	'userid'=>array('type'=>'integer', 'required'=>True),
//	'timestamp'=>TIMESTAMP , 'required'=>True),
	'newstext'=>array('type'=>'char', 'allowed_tags'=>'<a><p><br><h3><h4><ul><li><strong><em>'),
);

$query_fields_def = array(
	'step'=>array('type'=>'integer'),
	'start'=>array('type'=>'integer'),
);

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

EOT;
		break;
		
	//-------------------------------------------------------------------------

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
		if (!$userprivileges['addnews']) {
			print "You are not permitted to access this page!<br>\n";
			break;
		}

		echo <<<EOT
<form method="post" action="{$_SERVER['PHP_SELF']}?action=insertnews">
<textarea name="newstext" cols="60" rows="15" wrap="soft"></textarea>
<p>
<input type="submit" value="Submit">
</p>
</form>
<a href="{$_SERVER['PHP_SELF']}">Back</a>

EOT;
		break;

	case "insertnews":
		if (!$userprivileges['addnews']) {
			print "You are not permitted to access this page !<br>\n";
			break;
		}

		$input = validateinput($_POST, $fields_def, array('newstext'));
		if (!$input)
			break;

		$query = "insert into news (userid,timestamp,text)
			values($userid, CURRENT_TIMESTAMP, '{$input['newstext']}')";
		mysql_query($query, $DBconnection)
			or die ("Could not execute query !");

		UpdateRSS($DBconnection);

		echo <<<EOT
News posted !<br>
<br>
<a href="{$_SERVER['PHP_SELF']}">Back</a>
		
EOT;
		break;

	case "editnews":
		$input = validateinput($_GET, $fields_def, array('id'));
		if (!$input)
			break;
			
		$query = "select * from news where id={$input['id']}";
		$result = mysql_query($query, $DBconnection)
			or die ("Could not execute query !");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);

		if (!$userprivileges['editnews']) {
			if (($userid != $row['userid']) || ($userid < 1)) {
				print "You are not permitted to access this page!<br>\n";
				break;
			}
		}

		echo <<<EOT
<form method="post" action="{$_SERVER['PHP_SELF']}?action=updatenews&amp;id={$input['id']}">
<textarea name="newstext" cols="60" rows="15" wrap="soft">{$row['text']}</textarea>
<p>
<input type="submit" value="Submit">
</p>
</form>
EOT;
		break;

	case "updatenews":
		$input = validateinput($_GET, $fields_def, array('id'));
		if (!$input)
			break;
				
		$id = $input['id'];

		$query = "select userid from news where id=$id";
		$result = mysql_query($query, $DBconnection)
			or die ("Could not execute query !");
		$writerid = mysql_result($result, 0, "userid");

		if (!$userprivileges['editnews']) {
			if (($userid != $writerid) || ($userid < 1)) {
				print "You are not permitted to access this page!<br>\n";
				break;
			}
		}

		$input = validateinput($_POST, $fields_def, array('newstext'));
		if (!$input)
			break;
			
		$query = "update news set text='{$input['newstext']}' where id=$id";
		mysql_query($query, $DBconnection)
			or die ("Could not execute query!");
		UpdateRSS($DBconnection);

		echo <<<EOT
<i>Updated!</i><br>
<br>
<a href="{$_SERVER['PHP_SELF']}">Back</a>
EOT;
		break;

	case "removenews":
		$input = validateinput($_GET, $fields_def, array('id'));
		if (!$input)
			break;
				
		$query = "select * from news where id={$input['id']}";
		$result = mysql_query($query, $DBconnection)
			or die ("Could not execute query !");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);

		if (!$userprivileges['removenews']) {
			if (($userid != $row['userid']) || ($userid < 1)) {
				print "You are not permitted to access this page!<br>\n";
				break;
			}
		}

		echo <<<EOT
Are you sure you want to delete the following news?
<p>
{$row['text']}
</p>
<table>
<tr>
<td>
<form method="post" action="{$_SERVER['PHP_SELF']}?action=deletenews&amp;id={$input['id']}">
<input type="submit" value="delete">
</form>
</td>
<td>
<form method="post" action="{$_SERVER['PHP_SELF']}">
<input type="submit" value="cancel">
</form>
</td>
</tr>
</table>
EOT;
		break;

	case "deletenews":
		$input = validateinput($_GET, $fields_def, array('id'));
		if (!$input)
			break;
			
		$query = "select userid from news where id={$input['id']}";
		$result = mysql_query($query, $DBconnection)
			or die ("Could not execute query !");
		$writerid = mysql_result($result, 0, "userid");

		if (!$userprivileges['removenews']) {
			if (($userid != $writerid) || ($userid < 1)) {
				print "You are not permitted to access this page!<br>\n";
				break;
			}
		}

		$query = "delete from news where id={$input['id']}";
		mysql_query($query, $DBconnection)
			or die ("Could not execute query !");
		UpdateRSS($DBconnection);

		echo <<<EOT
Deleted!<br>
<br>
<a href="{$_SERVER['PHP_SELF']}">Back</a>
EOT;
		break;

	//---------------------------------------------------------------------
	
	default: 
		//--- Show temporary notices ---//

		show_motd();

		//--- validate input ---//

		$input = validateinput($_GET, $query_fields_def, 
			array('step', 'start'));
				
		if ($input === False)
			break;

		//--- set input default values ---//

		// max number news items to show at one time
		$step = isset($input['step']) ? $input['step'] : 8;

		// number news items to skip
		$start = isset($input['start']) ? $input['start'] : 0;

		//--- compute number of news items ---//

		$query = "select count(*) as count from news";
		$result = mysql_query($query, $DBconnection)
			or die ("Could not execute query !");

		$total = mysql_result($result, 0, "count");

		//--- fetch news ---//

		$query = "select * from news order by id desc limit $step offset $start";
		$result = mysql_query($query, $DBconnection)
			or die ("Could not execute query !");

		$number = mysql_num_rows($result);

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
		for ($i=0; $i < $number; $i++) {
			$row = mysql_fetch_array($result, MYSQL_ASSOC);

			//---------------------------------------------------------------------------------------------
			// date

			list($Y, $M, $D, $h, $m) = sscanf($row[timestamp], "%d-%d-%d %d:%d");
			$date = sprintf("%s %s, %s - %d:%02d", $months[$M], $D, $Y, $h, $m);

			//---------------------------------------------------------------------------------------------
			// news actions

			$mayeditnews = ($userprivileges['editnews']) || ($userid == $row['userid']);
			$mayremovenews = ($userprivileges['removenews']) || ($userid == $row['userid']);

			$newsactionstring = "";
			if ($mayeditnews)
				$newsactionstring .= "<a href=\"{$_SERVER['PHP_SELF']}?action=editnews&amp;id={$row['id']}\"><img src=\"images/editnews.png\" border=\"0\" alt=\"edit\"></a>";
			if ($mayremovenews)
				$newsactionstring .= "<a href=\"{$_SERVER['PHP_SELF']}?action=removenews&amp;id={$row['id']}\"><img src=\"images/deletenews.png\" border=\"0\" alt=\"delete\"></a>";
				
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
		}

		//-------------------------------------------------------------------------------------------------

		//--- add the submit news button ---//

		if ($userprivileges['addnews']) {
			echo <<<EOT
			<br>
			<form method="post" action="{$_SERVER['PHP_SELF']}?action=addnews">
			<input type="submit" value="submit news">
			</form>

EOT;
		}
	
		include ("../include/jokes.inc.php");

		//-------------------------------------------------------------------------------------------------
		// prev/next page links

		echo <<<EOT
			<!-- Next / Prev Buttons -->
			<p/>
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

			print "<a href=\"{$_SERVER['PHP_SELF']}?start=$prev\"><img src=\"images/prev.png\" border=\"0\" alt=\"Previous\"></a>\n";
		}

		//-------------------------------------------------------------------------------------------------				
		echo <<<EOT
				</td>
				<td style="background-image: url(images/newsbarbg.png)" align="right">

EOT;

		//--- show the "next page" link if needed ---//
		if ($next < $total)
			print "<a href=\"{$_SERVER['PHP_SELF']}?start=$next\"><img src=\"images/next.png\" border=\"0\" alt=\"Next\"></a>\n";

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
			</td>
		</tr>
		</table><p>
		<!-- End Forms Table -->

EOT;
		break;

	//-------------------------------------------------------------------------
		
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
