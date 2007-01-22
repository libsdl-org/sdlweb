<?PHP
	include ("../include/login.inc.php");
	include ("header.inc.php");

	BeginContent("OS");
	
	if (!$userprivileges['manageoses']) {
		print "You are not permitted to access this page !<br>\n";
		exit();
	}

	$fields_def = array(
		'id' => array('type' => 'integer'),
		'shortname' => array('type' => 'char', 'size' => 10, 'required' => True),
		'name' => array('type' => 'char', 'size' => 30, 'required' => True) 
	);
	
	$id = $_GET['id'];
	
	switch ($action) {
		case "addos":
			echo <<<EOT
<form method="post" action="{$_SERVER['PHP_SELF']}?action=insertos">
<p>name<br><input type="text" name="name" size="50" maxlength="30"></p>
<p>shortname (will be used in the path of the OS image)<br><input type="text" name="shortname" size="50" maxlength="10"></p>
<p><input type="submit" value="Submit"></p>
</form>
<br>
<a href="{$_SERVER['PHP_SELF']}">back</a>

EOT;
			break;

		case "insertos":
			//--- check everything is valid ---//
			
			$nbrerrors = 0;

			$required = array("name", "shortname");
			while (list($key,$varname)=each($required))
				$nbrerrors += isempty($varname, $_POST[$varname]);

			$notags = array("name", "shortname");
			while (list($key,$varname)=each($notags))
				$nbrerrors += containtag($varname, $_POST[$varname]);

			if ($nbrerrors)
				break;

			//--- insert new OS ---//

			$query = "insert into oses(shortname, name) values('{$_POST['shortname']}','{$_POST['name']}')";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			//--- fetch the id of the os ---//

			$query = "select max(id) as id from oses";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$osid = mysql_result($result, 0, "id");

			//--- add a new status for every project in the database ---//

			$query = "insert into projectstatus (select id, $osid, 0 from projects)";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			//------//

			echo <<<EOT
OS added !<br>
<br>
<a href="{$_SERVER['PHP_SELF']}">back</a>

EOT;
			break;

		case "editos":
			$query = "select * from oses where id=$id";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$row = mysql_fetch_array($result, MYSQL_ASSOC);

			//--- print the form ---//

			echo <<<EOT
<form method="post" action="{$_SERVER['PHP_SELF']}?action=updateos&amp;id=$id">
<p>name<br><input type="text" name="name" value="{$row['name']}" size="50" maxlength="30"></p>
<p>shortname (will be used in the path of the OS image)<br><input type="text" name="shortname" value="{$row['shortname']}" size="50" maxlength="10"></p>
<p><input type="submit" value="Submit"></p>
</form>
<br>
<a href="{$_SERVER['PHP_SELF']}">back</a>

EOT;
			break;

		case "updateos":
			//--- check everything is valid ---//
			
			$nbrerrors = 0;

			$required = array("name", "shortname");
			while (list($key,$varname)=each($required))
				$nbrerrors += isempty($varname, $_POST[$varname]);

			$notags = array("name", "shortname");
			while (list($key,$varname)=each($notags))
				$nbrerrors += containtag($varname, $_POST[$varname]);

			if ($nbrerrors)
				break;

			//--- update the os in the database ---//

			$query  = "update oses set shortname='{$_POST['shortname']}', name='{$_POST['name']}' where id=$id";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			echo <<<EOT
<i>Updated !</i><br>
<br>
<a href="{$_SERVER['PHP_SELF']}">back</a>

EOT;
			break;

		case "removeos":
			$query = "select name from oses where id=$id";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$name = mysql_result($result, 0, "name");

			echo <<<EOT
Are you sure you want to delete the $name os ?<br>
<br>
<table>
<tr>
<td>
<form method="post" action="{$_SERVER['PHP_SELF']}?action=deleteos&amp;id=$id">
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

		case "deleteos":
			//--- delete the project status entries referring to that os ---//

			$query = "delete from projectstatus where os=$id";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			//--- remove the os from the database ---//

			$query = "delete from oses where id=$id";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			echo <<<EOT
Deleted !<br>
<br>
<a href="{$_SERVER['PHP_SELF']}">back</a>

EOT;
			break;

		default:
			//--- fetch oses ---//

			$query = "select * from oses order by name";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			//--- print oses ---//

			echo '<table cellpadding="5">', "\n";

			while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
				echo <<<EOT
<tr>
	<td>{$row['name']}</td>
	<td>{$row['shortname']}</td>
	<td><a href="{$_SERVER['PHP_SELF']}?action=editos&amp;id={$row['id']}">edit</a></td>
	<td><a href="{$_SERVER['PHP_SELF']}?action=removeos&amp;id={$row['id']}">delete</a></td>
</tr>

EOT;
			print "</table>\n";

			//--- add the new os button ---//

			echo <<<EOT
<form method="post" action="{$_SERVER['PHP_SELF']}?action=addos">
<input type="submit" value="new os">
</form>

EOT;
	}

	CloseContent();

	include ("footer.inc.php");
?>
