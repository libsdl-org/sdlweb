<?PHP
	include ("../include/login.inc.php");
	if (!$printer_friendly)
		include ("header.inc.php");

	$title = "Frequently Asked Questions";
	if ( $category ) {
		$query  = "select name from faqcategories where id = $category";
		$result = pg_exec($DBconnection, $query)
			or die ("Could not execute query !");
		$name = pg_result($result, 0, "name");
		$title = "$title: $name";
	}
	BeginContent($title);

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

	switch ($action) {
		case "addentry":
			if (!$userprivileges[addfaqentry])  {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if ($category=="") {
				print "Invalid category !<BR>\n";
				break;
			}

			print "<FORM method=post action=\"$PHP_SELF?action=insertentry&category=$category\">\n";
			print "<P>question<BR><TEXTAREA name=question cols=60 rows=2 wrap=\"soft\"></TEXTAREA></P>\n"; 
			print "<P>answer<BR><TEXTAREA name=answer cols=60 rows=10 wrap=\"soft\"></TEXTAREA></P>\n";
			print "<P><INPUT type=submit value=Submit></P>\n";
			print "</FORM>\n";
			print "<A href=\"$PHP_SELF?action=listentries&category=$category\">back</A>\n";
			break;

		case "insertentry":
			if (!$userprivileges[addfaqentry])  {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if ($category=="") {
				print "Invalid category !<BR>\n";
				break;
			}

			$required = array("question", "answer");
			while (list($key,$varname)=each($required))
				$nbrerrors += isempty($varname,$$varname);

			$notags = array("question");
			while (list($key,$varname)=each($notags))
				$nbrerrors += containtag($varname,$$varname);

			if ($nbrerrors)
				break;

			$query  = "insert into faqentries(category,question,answer)";
			$query .= " values($category,'$question','$answer')";

			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			$query = "select max(id) as id from faqentries";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$id = pg_result($result, 0, "id");

			$query  = "update faqentries set sorted=$id where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "Entry added !<BR>\n";
			print "<BR>\n";
			print "<A href=\"$PHP_SELF?action=listentries&category=$category\">back</A>\n";
			break;

		case "updateentry":
			if (!$userprivileges[editfaqentry])  {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if ($id=="") {
				print "Invalid entry !<BR>\n";
				break;
			}

			$required = array("question", "answer", "sorted");
			while (list($key,$varquestion)=each($required))
				$nbrerrors += isempty($varquestion,$$varquestion);

			$notags = array("question", "sorted");
			while (list($key,$varquestion)=each($notags))
				$nbrerrors += containtag($varquestion,$$varquestion);

			if ($nbrerrors)
				break;

			$query  = "update faqentries set question='$question', answer='$answer', sorted=$sorted where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "<I>Updated !</I><BR>\n";

		case "editentry":
			if (!$userprivileges[editfaqentry])  {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if ($id=="") {
				print "Invalid entry !<BR>\n";
				break;
			}

			$query = "select * from faqentries where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$row = pg_fetch_array($result, 0, PGSQL_ASSOC);

			print "<FORM method=post action=\"$PHP_SELF?action=updateentry&id=$id&category=$category\">\n";
			print "<P>question<BR><TEXTAREA name=question cols=60 rows=2 wrap=\"soft\">$row[question]</TEXTAREA></P>\n"; 
			print "<P>answer<BR><TEXTAREA name=answer cols=60 rows=10 wrap=\"soft\">$row[answer]</TEXTAREA></P>\n";
			print "<P>Sorted at: <INPUT type=text name=sorted value=\"$row[sorted]\" size=8 maxlength=8></P>\n";
			print "<P><INPUT type=submit value=Submit></P>\n";
			print "</FORM>\n";
			print "<A href=\"$PHP_SELF?action=listentries&category=$category\">back</A>\n";
			break;

		case "removeentry":
			if (!$userprivileges[removefaqentry]) {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if ($id=="") {
				print "Invalid entry !<BR>\n";
				break;
			}

			$query = "select question from faqentries where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$question = pg_result($result, 0, "question");

			print "Are you sure you want to delete this entry ?\n";
			print "<P>$question</P>\n";
			print "<TABLE>\n";
			print "<TR>\n";
			print "<TD>";
			print "<FORM method=post action=\"$PHP_SELF?action=deleteentry&id=$id&category=$category\">";
			print "<INPUT type=submit value=delete>";
			print "</FORM>";
			print "</TD>\n";
			print "<TD>";
			print "<FORM method=post action=\"$PHP_SELF?action=listentries&category=$category\">";
			print "<INPUT type=submit value=cancel>";
			print "</FORM>";
			print "</TD>\n";
			print "</TR>\n";
			print "</TABLE>\n";
			break;

		case "deleteentry":
			if (!$userprivileges[removefaqentry])  {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if ($id=="") {
				print "Invalid entry !<BR>\n";
				break;
			}

			//--- remove entry from the database ---//

			$query = "delete from faqentries where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "Deleted !<BR>\n";
			print "<BR>\n";
			print "<A href=\"$PHP_SELF?action=listentries&category=$category\">back</A>\n";
			break;

		case "listentries":

			if ($category=="") {
				print "Invalid category !<BR>\n";
				break;
			}

			//--- fetch entries ---//

			$query  = "select * from faqentries where category=$category order by sorted";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			$number = pg_numrows($result);

			//--- print ToC ---//

			print "<H3>Table Of Contents</H3>\n";
			print "<UL>\n";

			$i=0;
			while ($i < $number) {
				$row = pg_fetch_array($result, $i, PGSQL_ASSOC);

				print "<LI><A href=\"#$row[id]\">$row[question]</A>\n";
				$i++;
			}
			print "</UL>\n";
			print "<HR width=\"100%\">\n";

			//--- print entries ---//

			$i=0;
			while ($i < $number) {
				$row = pg_fetch_array($result, $i, PGSQL_ASSOC);

				print "<TABLE cellpadding=5>\n";
				print "<TR><TD valign=top><B>Q:</B></TD><TD><A name=$row[id]><B>$row[question]</B></A></TD></TR>\n";
				print "<TR><TD valign=top><B>A:</B></TD><TD>$row[answer]</TD></TR>\n";
				print "</TABLE>\n";

				if ($userprivileges[editfaqentry])
					print "Sorted: $row[sorted] &nbsp;<A href=\"$PHP_SELF?action=editentry&id=$row[id]&category=$category\">edit</A>&nbsp\n";
				if ($userprivileges[deletefaqentry])
					print "<A href=\"$PHP_SELF?action=removeentry&id=$row[id]&category=$category\">delete</A>&nbsp\n";
				
				print "<HR>\n";

				$i++;
			}

			//--- add the add entry button ---//

			if ($userprivileges[addfaqentry]) { 
				print "<FORM method=post action=\"$PHP_SELF?action=addentry&category=$category\">\n";
				print "<INPUT type=submit value=\"add entry\">\n";
				print "</FORM>\n";
			}

			if (!$printer_friendly)
				print "<A href=\"$PHP_SELF\">back</A>\n";
			break;

		//----------------------------------------------------------------------------------//
		//----------------------------------------------------------------------------------//
		//----------------------------------------------------------------------------------//

		case "addcategory":
			if (!$userprivileges[managefaqcategories])  {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			print "<FORM method=post action=\"$PHP_SELF?action=insertcategory\">\n";
			print "<P>name<BR><INPUT type=text name=name size=50 maxlength=20></P>\n";
			print "<P>description<BR><INPUT type=text name=description size=50 maxlength=255></P>\n";
			print "<P><INPUT type=submit value=Submit></P>\n";
			print "</FORM>\n";
			print "<A href=\"$PHP_SELF\">back</A>\n";
			break;

		case "insertcategory":
			if (!$userprivileges[managefaqcategories])  {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			$required = array("name", "description");
			while (list($key,$varname)=each($required))
				$nbrerrors += isempty($varname,$$varname);

			$notags = array("name");
			while (list($key,$varname)=each($notags))
				$nbrerrors += containtag($varname,$$varname);

			if ($nbrerrors)
				break;

			$query  = "insert into faqcategories(name,description)";
			$query .= " values('$name','$description')";

			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			$query = "select max(id) as id from faqcategories";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$id = pg_result($result, 0, "id");

			$query  = "update faqcategories set sorted=$id where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "Category added !<BR>\n";
			print "<BR>\n";
			print "<A href=\"$PHP_SELF\">back</A>\n";
			break;

		case "updatecategory":
			if (!$userprivileges[managefaqcategories])  {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if ($id=="") {
				print "Invalid category !<BR>\n";
				break;
			}

			$required = array("name", "description", "sorted");
			while (list($key,$varname)=each($required))
				$nbrerrors += isempty($varname,$$varname);

			$notags = array("name", "sorted");
			while (list($key,$varname)=each($notags))
				$nbrerrors += containtag($varname,$$varname);

			if ($nbrerrors)
				break;

			$query  = "update faqcategories set name='$name', description='$description', sorted=$sorted where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "<I>Updated !</I><BR>\n";

		case "editcategory":
			if (!$userprivileges[managefaqcategories])  {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if ($id=="") {
				print "Invalid category !<BR>\n";
				break;
			}

			$query = "select * from faqcategories where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$row = pg_fetch_array($result, 0, PGSQL_ASSOC);

			print "<FORM method=post action=\"$PHP_SELF?action=updatecategory&id=$id\">\n";
			print "<P>name<BR><INPUT type=text name=name value=\"$row[name]\" size=50 maxlength=20></P>\n";
			print "<P>description<BR><INPUT type=text name=description value=\"$row[description]\" size=50 maxlength=255></P>\n";
			print "<P>Sorted at: <INPUT type=text name=sorted value=\"$row[sorted]\" size=8 maxlength=8></P>\n";
			print "<P><INPUT type=submit value=Submit></P>\n";
			print "</FORM>\n";
			print "<A href=\"$PHP_SELF\">back</A>\n";
			break;

		case "removecategory":
			if (!$userprivileges[managefaqcategories]) {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if ($id=="") {
				print "Invalid category !<BR>\n";
				break;
			}

			$query = "select name from faqcategories where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$name = pg_result($result, 0, "name");

			print "Are you sure you want to delete the $name category ? (this will delete all entries within this category)<BR>\n";
			print "<BR>\n";
			print "<TABLE>\n";
			print "<TR>\n";
			print "<TD>";
			print "<FORM method=post action=\"$PHP_SELF?action=deletecategory&id=$id\">";
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

		case "deletecategory":
			if (!$userprivileges[managefaqcategories])  {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if ($id=="") {
				print "Invalid category !<BR>\n";
				break;
			}

			//--- delete all entries in that category ---//

			$query = "delete from faqentries where category=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			//--- remove category from the database ---//

			$query = "delete from faqcategories where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "Deleted !<BR>\n";
			print "<BR>\n";
			print "<A href=\"$PHP_SELF\">back</A>\n";
			break;

		default:
			//--- fetch categories list ---//

			$query  = "select * from faqcategories order by sorted";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			$number = pg_numrows($result);

			//--- print categories ---//

			print "<TABLE cellpadding=5>\n";

			$i=0;
			while ($i < $number) {
				$row = pg_fetch_array($result, $i, PGSQL_ASSOC);

				print "<TR>";
				print "<TD><B><A href=\"$PHP_SELF?action=listentries&category=$row[id]\">$row[name]</A></B></TD>";
				print "<TD>$row[description]</TD>";
				if ($userprivileges[managefaqcategories]) {
					print "<TD>$row[sorted]</TD>";
					print "<TD><A href=\"$PHP_SELF?action=editcategory&id=$row[id]\">edit</A></TD>";
					print "<TD><A href=\"$PHP_SELF?action=removecategory&id=$row[id]\">delete</A></TD>";
				}
				print "</TR>\n";

				$i++;
			}

			print "</TABLE>\n";

			//--- add the add category button ---//

			if ($userprivileges[managefaqcategories]) { 
				print "<FORM method=post action=\"$PHP_SELF?action=addcategory\">\n";
				print "<INPUT type=submit value=\"add category\">\n";
				print "</FORM>\n";
			}

			print "<HR width=\"100%\">\n";
			print "<A href=\"index.php\">back</A>\n";
	}

	CloseContent();

	if (!$printer_friendly)
		include ("footer.inc.php");
?>
