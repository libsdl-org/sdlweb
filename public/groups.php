<?PHP
	include ("../include/login.inc.php");
	include ("header.inc.php");

	echo <<<EOT
<H1>Groups</H1>
<BR>
<BLOCKQUOTE>
EOT;

	$privilegelist = array(	"addproject", "reviewproject", "editproject", "removeproject",
							"addprojectcategory", "editprojectcategory", "removeprojectcategory",
							"addnews", "editnews", "removenews",
							"addarticle", "editarticle", "removearticle",
							"addfaqentry", "editfaqentry", "removefaqentry",
							"managefaqcategories", "manageoses", "managegroups", "manageusers" );

	function checkbox($text,$value)
	{
		if ($value=="t")
			print "<INPUT type=checkbox name=$text value=yes checked>$text";
		else
			print "<INPUT type=checkbox name=$text value=yes>$text";
	}

	if (!$userprivileges[managegroups]) {
		print "You are not permitted to access this page !<BR>\n";
	}
	else
	{
		switch ($action) {
			case "addgroup":
				print "<FORM method=post action=\"$PHP_SELF?action=insertgroup\">\n";
				print "<P>name<BR><INPUT type=text name=name size=50 maxlength=30></P>\n";
				reset($privilegelist);
				while (list($key,$privilegename)=each($privilegelist))
					print "<INPUT type=checkbox name=$privilegename value=yes>$privilegename\n";
				print "<P><INPUT type=submit value=Submit></P>\n";
				print "</FORM>\n";
				print "<A href=\"$PHP_SELF\">back</A>\n";
				break;

			case "insertgroup":
				if ($name=="") {
					print "Invalid name !<BR>\n";
					break;
				}

				//--- generate insertion query ---//

				$query  = "insert into groups (name,";

				reset($privilegelist);
				while (list($key,$privilegename)=each($privilegelist))
					$query .= "$privilegename,";
				$query  = substr ($query, 0, -1); // remove the last comma

				$query .= ") values('$name',";

				reset($privilegelist);
				while (list($key,$privilegename)=each($privilegelist)) {
					$privilegevalue = $$privilegename;

					if ($privilegevalue=="yes")
						$query .= "TRUE,";
					else
						$query .= "FALSE,";
				}
				$query  = substr ($query, 0, -1); // remove the last comma

				$query .= ")";

				//--- execute query ---//

				pg_exec($DBconnection, $query)
					or die ("Could not execute query !");

				print "Group added !<BR>\n";
				print "<BR>\n";
				print "<A href=\"$PHP_SELF\">back</A>\n";
				break;

			case "editgroup":
				if ($id<2) 
					print "Notice: You can only modify the name of this group !<BR>\n";

				$query = "select * from groups where id=$id";
				$result = pg_exec($DBconnection, $query)
					or die ("Could not execute query !");
				$row = pg_fetch_array($result, 0, PGSQL_ASSOC);

				//--- print the form ---//

				print "<FORM method=post action=\"$PHP_SELF?action=updategroup&amp;id=$id\">\n";
				print "<P>name<BR><INPUT type=text name=name value=\"$row[name]\" size=50 maxlength=30></P>\n";

				reset($privilegelist);
				while (list($key,$privilegename)=each($privilegelist))
					checkbox("$privilegename",$row[$privilegename]);

				print "<P><INPUT type=submit value=Submit></P>\n";
				print "</FORM>\n";
				print "<BR>\n";
				print "<A href=\"$PHP_SELF\">back</A>\n";
				break;

			case "updategroup":
				if ($name=="") {
					print "Invalid name !<BR>\n";
					break;
				}

				//--- generate update query ---//

				if ($id<2)
					$query = "update groups set	name='$name' where id=$id";
				else {

					$query  = "update groups set name='$name',";

					reset($privilegelist);
					while (list($key,$privilegename)=each($privilegelist)) {
						$privilegevalue = $$privilegename;
						if ($privilegevalue=="yes")
							$query .= "$privilegename=TRUE,";
						else
							$query .= "$privilegename=FALSE,";
					}
					$query  = substr ($query, 0, -1); // remove the last comma

					$query .= " where id=$id";
				}

				//--- execute query ---//

				pg_exec($DBconnection, $query)
					or die ("Could not execute query !");

				if ($id<2) 
					print "Only the name was updated because it would be stupid to update anything else about this group !<BR>\n";
				else
					print "<I>Updated !</I><BR>\n";

				print "<BR>\n";
				print "<A href=\"$PHP_SELF\">back</A>\n";
				break;

			case "removegroup":
				if ($id<3) {
					print "Sorry, but I can't let you do that !<BR>\n";
					break;
				}

				$query = "select name from groups where id=$id";
				$result = pg_exec($DBconnection, $query)
					or die ("Could not execute query !");
				$name = pg_result($result, 0, "name");

				echo <<<EOT
Are you sure you want to delete the $name group ?<BR>
(all users in this group will be moved to the 'Normal rights' group)<BR>
<BR>
<TABLE>
<TR>
<TD>
<FORM method=post action="$PHP_SELF?action=deletegroup&amp;id=$id">
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

			case "deletegroup":
				if ($id < 3) {
					print "Sorry, but I can't let you do that !<BR>\n";
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

				print "Deleted !<BR>\n";
				print "<BR>\n";
				print "<A href=\"$PHP_SELF\">back</A>\n";
				break;

			default:

				//--- fetch groups ---//

				$query = "select * from groups where id>=0 order by name";
				$result = pg_exec($DBconnection, $query)
					or die ("Could not execute query !");

				$number = pg_numrows($result);

				//--- print groups ---//

				print "<TABLE cellpadding=5>\n";

				$i=0;
				while ($i < $number) {
					$row = pg_fetch_array($result, $i, PGSQL_ASSOC);

					if ($row[id]>2)
						print "<TR><TD>$row[name]</TD><TD><A href=\"$PHP_SELF?action=editgroup&amp;id=$row[id]\">edit</A></TD><TD><A href=\"$PHP_SELF?action=removegroup&amp;id=$row[id]\">delete</A></TD></TR>";
					else
						print "<TR><TD>$row[name]</TD><TD colspan=2><A href=\"$PHP_SELF?action=editgroup&amp;id=$row[id]\">edit</A></TD></TR>";

					$i++;
				}

				print "</TABLE>\n";

				//--- add the new group button ---//
				echo <<<EOT
<FORM method=post action="$PHP_SELF?action=addgroup">
<INPUT type=submit value="new group">
</FORM>
EOT;
		}
	}

	CloseContent();

	include ("footer.inc.php");
?>
