<?PHP
	include ("../include/login.inc.php");
	include ("header.inc.php");

	BeginContent("Groups");

	$fields_def = array(
		'id'=>array('type'=>'integer', 'required'=>True),
		'name'=>array('type'=>'char', 'size'=>30, 'required'=>True),
	);

	$id = $_GET['id'];

	$privilegelist = array(	"addproject", "reviewproject", "editproject", "removeproject",
							"addprojectcategory", "editprojectcategory", "removeprojectcategory",
							"addnews", "editnews", "removenews",
							"addarticle", "editarticle", "removearticle",
							"addfaqentry", "editfaqentry", "removefaqentry",
							"managefaqcategories", "manageoses", "managegroups", "manageusers" );

	if (!$userprivileges['managegroups'])
		print "You are not permitted to access this page !<br>\n";
	else {
		switch ($action) {
			case "addgroup":
				$privilegeboxes = "";
				reset($privilegelist);
				while (list($key,$privilegename)=each($privilegelist))
					$privilegeboxes .= "<input type=\"checkbox\" name=\"$privilegename\" value=\"yes\">$privilegename\n";

				echo <<<EOT
<form method="post" action="{$_SERVER['PHP_SELF']}?action=insertgroup">
<p>name<br><input type="text" name="name" size="50" maxlength="30"></p>
$privilegeboxes
<p><input type="submit" value="Submit"></p>
</form>
<a href="{$_SERVER['PHP_SELF']}">back</a>

EOT;
				break;

			case "insertgroup":
				if ($_POST['name'] == "") {
					print "Invalid name !<br>\n";
					break;
				}

				//--- generate insertion query ---//

				$query = "insert into groups (name,";

				reset($privilegelist);
				while (list($key,$privilegename)=each($privilegelist))
					$query .= "$privilegename,";
				$query = substr($query, 0, -1); // remove the last comma

				$query .= ") values('{$_POST['name']}',";

				reset($privilegelist);
				while (list($key,$privilegename)=each($privilegelist)) {
					if ($_POST[$privilegename] == "yes")
						$query .= "TRUE,";
					else
						$query .= "FALSE,";
				}
				$query = substr($query, 0, -1); // remove the last comma

				$query .= ")";

				//--- execute query ---//

				pg_exec($DBconnection, $query)
					or die ("Could not execute query !");

				echo <<<EOT
Group added !<br>
<br>
<a href="{$_SERVER['PHP_SELF']}">back</a>
EOT;
				break;

			case "editgroup":
				if ($id < 2) 
					print "Notice: You can only modify the name of this group !<br>\n";

				$query = "select * from groups where id=$id";
				$result = pg_exec($DBconnection, $query)
					or die ("Could not execute query !");
				$row = pg_fetch_array($result, 0, PGSQL_ASSOC);

				//--- print the form ---//

				echo <<<EOT
<form method="post" action="{$_SERVER['PHP_SELF']}?action=updategroup&amp;id=$id">
<p>name<br><input type="text" name="name" value="$row[name]" size="50" maxlength="30"></p>

EOT;
				reset($privilegelist);
				while (list($key,$privilegename)=each($privilegelist))
					checkbox("$privilegename",$row[$privilegename]);

				echo <<<EOT
<p><input type="submit" value="Submit"></p>
</form>
<br>
<a href="{$_SERVER['PHP_SELF']}">back</a>

EOT;
				break;

			case "updategroup":
				if ($_POST['name'] == "") {
					print "Invalid name !<br>\n";
					break;
				}

				//--- generate update query ---//

				if ($id < 2)
					$query = "update groups set	name='{$_POST['name']}' where id=$id";
				else {
					$query = "update groups set name='{$_POST['name']}',";

					reset($privilegelist);
					while (list($key,$privilegename)=each($privilegelist)) {
						if ($_POST[$privilegename] == "yes")
							$query .= "$privilegename=TRUE,";
						else
							$query .= "$privilegename=FALSE,";
					}
					$query = substr($query, 0, -1); // remove the last comma

					$query .= " where id=$id";
				}

				//--- execute query ---//

				pg_exec($DBconnection, $query)
					or die ("Could not execute query !");

				$message = ($id < 2) ? "Only the name was updated because it would be stupid to update anything else about this group !" : "<i>Updated !</i>";

				echo <<<EOT
$message<br>
<br>
<a href="{$_SERVER['PHP_SELF']}">back</a>
EOT;
				break;

			case "removegroup":
				if ($id < 3) {
					print "Sorry, but I can't let you do that !<br>\n";
					break;
				}

				$query = "select name from groups where id=$id";
				$result = pg_exec($DBconnection, $query)
					or die ("Could not execute query !");
				$name = pg_result($result, 0, "name");

				echo <<<EOT
Are you sure you want to delete the $name group ?<br>
(all users in this group will be moved to the 'Normal rights' group)<br>
<br>
<table>
<tr>
<td>
<form method="post" action="{$_SERVER['PHP_SELF']}?action=deletegroup&amp;id=$id">
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

			case "deletegroup":
				if ($id < 3) {
					print "Sorry, but I can't let you do that !<br>\n";
					break;
				}

				//--- change the group of the users that were in this group ---//

				$query = "update users set groupid=2 where groupid=$id";
				pg_exec($DBconnection, $query)
					or die ("Could not execute query !");

				//--- remove the group from the database ---//

				$query = "delete from groups where id=$id";
				pg_exec($DBconnection, $query)
					or die ("Could not execute query !");

				echo <<<EOT
Deleted !<br>
<br>
<a href="{$_SERVER['PHP_SELF']}">back</a>
EOT;
				break;

			default:

				//--- fetch groups ---//

				$query = "select * from groups where id>=0 order by name";
				$result = pg_exec($DBconnection, $query)
					or die ("Could not execute query !");

				//--- print groups ---//

				print "<table cellpadding=\"5\">\n";

				while (($row = pg_fetch_array($result, NULL, PGSQL_ASSOC)) != FALSE) {
					if ($row['id'] > 2)
						$removelink = "<a href=\"{$_SERVER['PHP_SELF']}?action=removegroup&amp;id={$row['id']}\">delete</a>";
					else
						$removelink = "&nbsp;";

					echo <<<EOT
<tr>
<td>{$row['name']}</td>
<td><a href="{$_SERVER['PHP_SELF']}?action=editgroup&amp;id={$row['id']}">edit</a></td>
<td>$removelink</td>
</tr>

EOT;
				}

				print "</table>\n";

				//--- add the new group button ---//
				echo <<<EOT
<form method="post" action="{$_SERVER['PHP_SELF']}?action=addgroup">
<input type="submit" value="new group">
</form>
EOT;
		}
	}

	CloseContent();

	include ("footer.inc.php");
?>
