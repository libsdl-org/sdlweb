<?PHP
	include ("../include/login.inc.php");
	include ("header.inc.php");

	BeginContent("OS");

	function checkbox($text,$value)
	{
		if ($value=="t")
			print "<INPUT type=checkbox name=$text value=yes checked>$text";
		else
			print "<INPUT type=checkbox name=$text value=yes>$text";
	}

	function containtag($name,$value)
	{
		if ($value!=strip_tags($value)) {
			print "You may not use HTML nor PHP tags in the $name field !<BR>\n";
			return 1;
		} else
			return 0;
	}

	function isempty($name,$value)
	{
		if ($value=="") {
			print "The $name field is required !<BR>\n";
			return 1;
		} else
			return 0;
	}

	if (!$userprivileges[manageoses]) {
		print "You are not permitted to access this page !<BR>\n";
		exit();
	}

	switch ($action) {
		case "addos":
			print "<FORM method=post action=\"$PHP_SELF?action=insertos\">\n";
			print "<P>name<BR><INPUT type=text name=name size=50 maxlength=30></P>\n";
			print "<P>shortname (will be used in the path of the OS image)<BR><INPUT type=text name=shortname size=50 maxlength=10></P>\n";
			print "<P><INPUT type=submit value=Submit></P>\n";
			print "</FORM>\n";
			print "<BR>\n";
			print "<A href=\"$PHP_SELF\">back</A>\n";
			break;

		case "insertos":
			//--- check everything is valid ---//
			
			$nbrerrors = 0;

			$required = array("name", "shortname");
			while (list($key,$varname)=each($required))
				$nbrerrors += isempty($varname,$$varname);

			$notags = array("name", "shortname");
			while (list($key,$varname)=each($notags))
				$nbrerrors += containtag($varname,$$varname);

			if ($nbrerrors)
				break;

			//--- insert new OS ---//

			$query = "insert into oses(shortname, name) values('$shortname','$name')";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			//--- fetch the id of the os ---//

			$query = "select max(id) as id from oses";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$osid = pg_result($result, 0, "id");

			//--- add a new status for every project in the database ---//

			$query = "select id from projects";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$number = pg_numrows($result);

			for ($i=0; $i < $number; $i++) {
				$projectid = pg_result($result, $i, "id");
				$query  = "insert into projectstatus values($projectid,$osid,0)";
				pg_exec($DBconnection, $query)
					or die ("Could not execute query !");
			}

			//------//

			print "OS added !<BR>\n";
			print "<BR>\n";
			print "<A href=\"$PHP_SELF\">back</A>\n";
			break;

		case "editos":
			$query = "select * from oses where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$row = pg_fetch_array($result, 0, PGSQL_ASSOC);

			//--- print the form ---//

			print "<FORM method=post action=\"$PHP_SELF?action=updateos&id=$id\">\n";
			print "<P>name<BR><INPUT type=text name=name value=\"$row[name]\" size=50 maxlength=30></P>\n";
			print "<P>shortname (will be used in the path of the OS image)<BR><INPUT type=text name=shortname value=\"$row[shortname]\" size=50 maxlength=10></P>\n";
			print "<P><INPUT type=submit value=Submit></P>\n";
			print "</FORM>\n";
			print "<BR>\n";
			print "<A href=\"$PHP_SELF\">back</A>\n";
			break;

		case "updateos":
			//--- check everything is valid ---//
			
			$nbrerrors = 0;

			$required = array("name", "shortname");
			while (list($key,$varname)=each($required))
				$nbrerrors += isempty($varname,$$varname);

			$notags = array("name", "shortname");
			while (list($key,$varname)=each($notags))
				$nbrerrors += containtag($varname,$$varname);

			if ($nbrerrors)
				break;

			//--- update the os in the database ---//

			$query  = "update oses set shortname='$shortname', name='$name' where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "<I>Updated !</I><BR>\n";
			print "<BR>\n";
			print "<A href=\"$PHP_SELF\">back</A>\n";
			break;

		case "removeos":
			$query = "select name from oses where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$name = pg_result($result, 0, "name");

			print "Are you sure you want to delete the $name os ?<BR>\n";
			print "<BR>\n";
			print "<TABLE>\n";
			print "<TR>\n";
			print "<TD>";
			print "<FORM method=post action=\"$PHP_SELF?action=deleteos&id=$id\">";
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

		case "deleteos":
			//--- delete the project status entries referring to that os ---//

			$query = "delete from projectstatus where os=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			//--- remove the os from the database ---//

			$query = "delete from oses where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "Deleted !<BR>\n";
			print "<BR>\n";
			print "<A href=\"$PHP_SELF\">back</A>\n";
			break;

		default:
			//--- fetch oses ---//

			$query = "select * from oses order by name";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			$number = pg_numrows($result);

			//--- print oses ---//

			print "<TABLE cellpadding=5>\n";

			for ($i=0; $i < $number; $i++) {
				$row = pg_fetch_array($result, $i, PGSQL_ASSOC);
				print "<TR><TD>$row[name]</TD><TD>$row[shortname]</TD><TD><A href=\"$PHP_SELF?action=editos&id=$row[id]\">edit</A></TD><TD><A href=\"$PHP_SELF?action=removeos&id=$row[id]\">delete</A></TD></TR>";
			}

			print "</TABLE>\n";

			//--- add the new os button ---//

			print "<FORM method=post action=\"$PHP_SELF?action=addos\">\n";
			print "<INPUT type=submit value=\"new os\">\n";
			print "</FORM>\n";
	}

	CloseContent();

	include ("footer.inc.php");
?>
