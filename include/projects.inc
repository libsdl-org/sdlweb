<?PHP
	$minversionmajor = 1; $maxversionmajor = 1;
	$minversionminor = 2; $maxversionminor = 2;
	$minversionpatch = 0; $maxversionpatch = 5;

	$licenses = array(
		"Unknown",
		"Commercial",
		"GNU GPL",
		"GNU LGPL",
		"BSD-style",
		"Freeware",
		"Other Open Source",
		"Other Closed Source",
	);

	function OPTION($value,$selectedvalue,$text)
	{
		if ($value==$selectedvalue)
			print "<OPTION selected value=$value>$text";
		else
			print "<OPTION value=$value>$text";
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

	switch ($action) {
		case "addproject":
			if (!$userprivileges[addproject]) {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			print "<FORM method=post action=\"$PHP_SELF?action=insertproject\">\n";
			print "<P><I>The fields marked with (*) are required</I></P>\n";

			//--- misc info ---//

			print "<P>name (*)<BR><INPUT type=text name=name size=50 maxlength=30></P>\n";
			print "<P>description (a single sentence without trailing period) (*)<BR><INPUT type=text name=description size=50 maxlength=255></P>\n";
			print "<P>url (*)<BR><INPUT type=text name=url value=\"http://\" size=50 maxlength=100></P>\n";
			print "<P>contact email<BR><INPUT type=text name=contact value=\"$useremail\" size=50 $maxlength=64></P>\n";

			//--- select min version req ---//

			print "<P>minimum SDL version required<BR>\n";
			print "<SELECT name=versionreqmajor>";
			for ($i=$minversionmajor; $i<=$maxversionmajor; $i++)
				OPTION($i,1,$i);
			print "</SELECT>\n";
			print "<SELECT name=versionreqminor>";
			for ($i=$minversionminor; $i<=$maxversionminor; $i++)
				OPTION($i,2,$i);
			print "</SELECT>\n";
			print "<SELECT name=versionreqpatch>";
			for ($i=$minversionpatch; $i<=$maxversionpatch; $i++)
				OPTION($i,0,$i);
			print "</SELECT>\n";
			print "</P>\n";

			//--- select category ---//
		
			print "<P>category<BR>\n";
			print "<SELECT name=category>";

			$query = "select id, name from projectcategories where type=$projecttype";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$number = pg_numrows($result);

			for ($i=0; $i < $number; $i++) {
				$row = pg_fetch_array($result, $i, PGSQL_ASSOC);
				OPTION($row[id],$category,$row[name]);
			}

			print "</SELECT>\n";
			print "</P>\n";

			//--- select license ---//
		
			print "<P>license<BR>\n";
			print "<SELECT name=license>";
			for ($i=0; $licenses[$i]; $i++) {
				$db_license = str_replace(" ", "_", $licenses[$i]);
				OPTION($db_license,$licenses[0],$licenses[$i]);
			}
			print "</SELECT>\n";
			print "</P>\n";

			//--- select os status ---//

			$query = "select * from oses order by name";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$number = pg_numrows($result);

			$ratinglist = array(0, 25, 50, 75, 100);

			for ($i=0; $i < $number; $i++) {
				$row = pg_fetch_array($result, $i, PGSQL_ASSOC);
				print "<P>$row[name] status<BR>\n";
				print "<SELECT name=$row[shortname]"."status>";
				reset($ratinglist);
				while (list($ratingnbr,$rating)=each($ratinglist))
					OPTION($rating,0,"$rating%");
				print "</SELECT>\n";
				print "</P>\n";
			}

			//--- submit button ---//

			print "<P><INPUT type=submit value=Submit></P>\n";
			print "</FORM>\n";
			print "<A href=\"$PHP_SELF\">back</A>\n";
			break;

		case "insertproject":
			if (!$userprivileges[addproject]) {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			//--- fetch os list ---//

			$query = "select id,shortname from oses order by name";
			$oslist = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$numberos = pg_numrows($oslist);

			//--- check everything is valid ---//

			$nbrerrors = 0;

			$required = array( "userid", "name", "description", "category", "license", "versionreqmajor", "versionreqminor", "versionreqpatch", "url");
			while (list($key,$varname)=each($required))
				$nbrerrors += isempty($varname,$$varname);

			for ($i=0; $i < $numberos; $i++) {
				$shortname = pg_result($oslist, $i, "shortname");
				$varname = $shortname."status";
				$nbrerrors += isempty($varname,$$varname);
			}

			$notags = array( "name", "description", "license", "url", "contact" );
			while (list($key,$varname)=each($notags))
				$nbrerrors += containtag($varname,$$varname);

			if (($versionreqmajor<$minversionmajor) || ($versionreqmajor>$maxversionmajor) ||
				($versionreqminor<$minversionminor) || ($versionreqminor>$maxversionminor) ||
				($versionreqpatch<$minversionpatch) || ($versionreqpatch>$maxversionpatch)) {
				print "Invalid SDL version required !<BR>\n";
				$nbrerrors++;
			}

			if ($nbrerrors)
				break;

			if ($license==$licenses[0])
				$license="";

			//--- add project to the database ---//

			$versionrequired = $versionreqmajor*1000 + $versionreqminor * 100 + $versionreqpatch;
			$description = rtrim($description," \t,.");

			$query  = "insert into projects (userid,type,category,name,description,versionrequired,url,contact,reviewed,timestamp,license)";
			$query .= " values($userid,$projecttype,$category,'$name','$description',$versionrequired,'$url','$contact',FALSE,CURRENT_TIMESTAMP,'$license')";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			//--- fetch the id of the project ---//

			$query = "select max(id) as id from projects";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$projectid = pg_result($result, 0, "id");

			//--- add project's status to the database ---//

			for ($i=0; $i < $numberos; $i++) {
				$row = pg_fetch_array($oslist, $i, PGSQL_ASSOC);
				$varname = $row[shortname]."status";
				$value = $$varname;
				$query  = "insert into projectstatus values($projectid,$row[id],$value)";
				pg_exec($DBconnection, $query)
					or die ("Could not execute query !");
			}

			//--- post a news about it ---//

			$query  = "insert into news (userid,timestamp,text)";
			$query .= " values(-2,CURRENT_TIMESTAMP,'<A href=$projecttypetextp.php?match_id=$projectid>$name</A>, $description, has been added to the $projecttypetextp page.')";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "$projecttypetextsc added (and news posted about it) !<BR>\n";
			print "<BR>\n";
			print "<A href=\"$PHP_SELF\">back</A>\n";
			break;

		case "maintainproject":
			$query = "select name from projects where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$name = pg_result ($result, 0, "name");

			print "Are you sure you are the maintainer of the $name project ?<BR>\n";
			print "<BR>\n";
			print "<TABLE>\n";
			print "<TR>\n";
			print "<TD>";
			print "<FORM method=post action=\"$PHP_SELF?action=maintainconfirmed&id=$id\">";
			print "<INPUT type=submit value=maintain>";
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

		case "maintainconfirmed":
			$query = "select userid from projects where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$ownerid = pg_result($result, 0, "userid");

			if ( ($userid <= 0) || ($ownerid > 0) ) {
				print "You are not permitted to maintain this project!<BR>\n";
				break;
			}

			$query  = "update projects set userid=$userid where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "<I>Updated !</I><BR>\n";
			print "<BR>\n";
			print "<A href=\"$PHP_SELF?action=editproject&id=$id\">edit</A>&nbsp;<A href=\"$PHP_SELF\">back</A>\n";
			break;

		case "disownproject":
			$query = "select userid from projects where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$ownerid = pg_result($result, 0, "userid");

			if (($userid!=$ownerid) || ($userid<1)) {
				print "You are not permitted to disown this project!<BR>\n";
				break;
			}

			$query  = "update projects set userid=-1 where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "<I>Updated !</I><BR>\n";
			print "<BR>\n";
			print "<A href=$PHP_SELF>back</A>\n";
			break;

		case "updateproject":
			$query = "select userid from projects where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$ownerid = pg_result($result, 0, "userid");

			if (!$userprivileges[editproject]) 
				if (($userid!=$ownerid) || ($userid<1)) {
					print "You are not permitted to access this page !<BR>\n";
					break;
				}

			//--- fetch os list ---//

			$query = "select id,shortname from oses order by name";
			$oslist = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$numberos = pg_numrows($oslist);

			//--- check everything is valid ---//

			$nbrerrors = 0;

			$required = array("category", "name", "description", "versionreqmajor", "versionreqminor", "versionreqpatch", "url");
			while (list($key,$varname)=each($required))
				$nbrerrors += isempty($varname,$$varname);

			for ($i=0; $i < $numberos; $i++) {
				$shortname = pg_result($oslist, $i, "shortname");
				$varname = $shortname."status";
				$nbrerrors += isempty($varname,$$varname);
			}

			$notags = array( "name", "description", "license", "url", "contact" );
			while (list($key,$varname)=each($notags))
				$nbrerrors += containtag($varname,$$varname);

			if (($versionreqmajor<$minversionmajor) || ($versionreqmajor>$maxversionmajor) ||
				($versionreqminor<$minversionminor) || ($versionreqminor>$maxversionminor) ||
				($versionreqpatch<$minversionpatch) || ($versionreqpatch>$maxversionpatch)) {
				print "Invalid SDL version required !<BR>\n";
				$nbrerrors++;
			}

			if ( $license == $licenses[0] ) {
				$license = "";
			}

			if ($nbrerrors)
				break;

			//--- update project in the database ---//

			$versionrequired = $versionreqmajor*1000 + $versionreqminor * 100 + $versionreqpatch;

			$query  = "update projects "; 
			$query .= "set category=$category, name='$name', description='$description', versionrequired=$versionrequired, url='$url', contact='$contact', timestamp=CURRENT_TIMESTAMP, license='$license' ";
			$query .= "where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			//--- update project status in the database ---//

			for ($i=0; $i < $numberos; $i++) {
				$row = pg_fetch_array($oslist, $i, PGSQL_ASSOC);
				$varname = $row[shortname]."status";
				$value = $$varname;
				$query = "update projectstatus set status=$value where project=$id and os=$row[id]";
				pg_exec($DBconnection, $query)
					or die ("Could not execute query !");
			}

			print "<I>Updated !</I><BR>\n";
			print "<BR>\n";
			print "<A href=\"$PHP_SELF?match_id=$id\">back</A>\n";
			break;

		case "editproject":
			$query = "select * from projects where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$row = pg_fetch_array($result, 0, PGSQL_ASSOC);

			if (!$userprivileges[editproject]) 
				if (($userid!=$row[userid]) || ($userid<1)) {
					print "You are not permitted to access this page !<BR>\n";
					break;
				}

			print "<FORM method=post action=\"$PHP_SELF?action=updateproject&id=$id\">\n";
			
			//--- misc info ---//

			print "<P>name<BR><INPUT type=text name=name value=\"$row[name]\" size=50 maxlength=30></P>\n";
			print "<P>description (a single sentence without trailing period)<BR><INPUT type=text name=description value=\"$row[description]\" size=50 maxlength=255></P>\n";
			print "<P>url<BR><INPUT type=text name=url value=\"$row[url]\" size=50 maxlength=100></P>\n";
			print "<P>contact email<BR><INPUT type=text name=contact value=\"$row[contact]\" size=50 maxlength=64></P>\n";

			//--- select min version req ---//

			$versionreqmajor = ($row[versionrequired] / 1000) % 10;
			$versionreqminor = ($row[versionrequired] / 100) % 10;
			$versionreqpatch = ($row[versionrequired]) % 100;

			print "<P>minimum SDL version required<BR>\n";
			print "<SELECT name=versionreqmajor>";
			for ($i=$minversionmajor; $i<=$maxversionmajor; $i++)
				OPTION($i,$versionreqmajor,$i);
			print "</SELECT>\n";
			print "<SELECT name=versionreqminor>";
			for ($i=$minversionminor; $i<=$maxversionminor; $i++)
				OPTION($i,$versionreqminor,$i);
			print "</SELECT>\n";
			print "<SELECT name=versionreqpatch>";
			for ($i=$minversionpatch; $i<=$maxversionpatch; $i++)
				OPTION($i,$versionreqpatch,$i);
			print "</SELECT>\n";
			print "</P>\n";

			//--- select category ---//

			print "<P>category<BR>\n";
			print "<SELECT name=category>";

			$query = "select id, name from projectcategories where type=$projecttype";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$number = pg_numrows($result);

			for ($i=0; $i < $number; $i++) {
				$categ = pg_fetch_array($result, $i, PGSQL_ASSOC);
				OPTION($categ[id],$row[category],$categ[name]);
			}

			print "</SELECT>\n";
			print "</P>\n";

			//--- select license ---//

			print "<P>license<BR>\n";
			print "<SELECT name=license>";

			for ($i=0; $licenses[$i]; $i++) {
				$db_license = str_replace(" ", "_", $licenses[$i]);
				OPTION($db_license,$row[license],$licenses[$i]);
			}

			print "</SELECT>\n";
			print "</P>\n";

			//--- select os status ---//

			$query = "select * from oses, projectstatus where projectstatus.os=oses.id and project=$id order by name";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$number = pg_numrows($result);

			$ratinglist = array(0, 25, 50, 75, 100);

			for ($i=0; $i < $number; $i++) {
				$row = pg_fetch_array($result, $i, PGSQL_ASSOC);
				print "<P>$row[name] status<BR>\n";
				print "<SELECT name=$row[shortname]"."status>";
				reset($ratinglist);
				while (list($ratingnbr,$rating)=each($ratinglist))
					OPTION($rating,$row[status],"$rating%");
				print "</SELECT>\n";
				print "</P>\n";
			}

			//--- submit button ---//

			print "<P><INPUT type=submit value=Submit></P>\n";
			print "</FORM>\n";
			print "<A href=\"$PHP_SELF\">back</A>\n";
			break;

		case "removeproject":
			$query = "select name,userid from projects where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$row = pg_fetch_array($result, $i, PGSQL_ASSOC);

			if (!$userprivileges[removeproject])
				if (($userid!=$row[userid]) || ($userid<1)) {
					print "You are not permitted to delete that project !<BR>\n";
					break;
				}

			print "Are you sure you want to delete the $row[name] project ?<BR>\n";
			print "<BR>\n";
			print "<TABLE>\n";
			print "<TR>\n";
			print "<TD>";
			print "<FORM method=post action=\"$PHP_SELF?action=deleteproject&id=$id\">";
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

		case "deleteproject":
			$query = "select userid from projects where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$ownerid = pg_result ($result, 0, "userid");

			if (!$userprivileges[removeproject]) 
				if (($userid!=$ownerid) || ($userid<1)) {
					print "You are not permitted to access this page !<BR>\n";
					break;
				}

			//--- delete project status referring to this project in the database ---//

			$query = "delete from projectstatus where project=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			//--- delete project from the database ---//

			$query = "delete from projects where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "Deleted !<BR>\n";
			print "<BR>\n";
			print "<A href=\"$PHP_SELF\">back</A>\n";
			break;

		//------------------------//
		//------------------------//
		//------ CATEGORIES ------//
		//------------------------//
		//------------------------//

		case "addcategory":
			if (!$userprivileges[addprojectcategory]) {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if (($projecttype<1) || ($projecttype>4)) {
				print "Invalid category !<BR>\n";
				break;
			}

			print "<FORM method=post action=\"$PHP_SELF?action=insertcategory\">\n";
			print "<P>name<BR><INPUT type=text name=name size=50 maxlength=40></P>\n";
			print "<P>description<BR><INPUT type=text name=description size=50 maxlength=255></P>\n";
			print "<P><INPUT type=submit value=Submit></P>\n";
			print "</FORM>\n";
			print "<A href=\"$PHP_SELF?action=listcategories\">back</A>\n";
			break;

		case "insertcategory":
			if (!$userprivileges[addprojectcategory]) {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if (($projecttype<1) || ($projecttype>4)) {
				print "Invalid category !<BR>\n";
				break;
			}

			if ($name=="") {
				print "A non-empty name is required !<BR>\n";
				break;
			}

			if (($name!=strip_tags($name)) ||
				($description!=strip_tags($description))) {
				print "You may not use HTML nor PHP tags in any field !<BR>\n";
				break;
			}

			$query  = "insert into projectcategories(type,name,description)";
			$query .= " values($projecttype,'$name','$description')";

			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "Category added !<BR>\n";
			print "<BR>\n";
			print "<A href=\"$PHP_SELF?action=listcategories\">back</A>\n";
			break;

		case "updatecategory":
			if (!$userprivileges[editprojectcategory]) {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if ($id=="") {
				print "Invalid category !<BR>\n";
				break;
			}

			if ($name=="") {
				print "A non-empty name is required !<BR>\n";
				break;
			}

			if (($name!=strip_tags($name)) ||
				($description!=strip_tags($description))) {
				print "You may not use HTML nor PHP tags in any field !<BR>\n";
				break;
			}

			$query  = "update projectcategories set name='$name', description='$description' where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "<I>Updated !</I><BR>\n";

		case "editcategory":
			if (!$userprivileges[editprojectcategory]) {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if ($id=="") {
				print "Invalid category !<BR>\n";
				break;
			}

			$query = "select * from projectcategories where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$row = pg_fetch_array($result, 0, PGSQL_ASSOC);

			print "<FORM method=post action=\"$PHP_SELF?action=updatecategory&id=$id\">\n";
			print "<P>name<BR><INPUT type=text name=name value=\"$row[name]\" size=50 maxlength=40></P>\n";
			print "<P>description<BR><INPUT type=text name=description value=\"$row[description]\" size=50 maxlength=255></P>\n";
			print "<P><INPUT type=submit value=Submit></P>\n";
			print "</FORM>\n";
			print "<A href=\"$PHP_SELF?action=listcategories\">back</A>\n";
			break;

		case "removecategory":
			if (!$userprivileges[removeprojectcategory]) {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if ($id=="") {
				print "Invalid category !<BR>\n";
				break;
			}

			if ($id<5) {
				print "You can't delete this category !<BR>\n";
				break;
			}

			$query = "select name from projectcategories where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$name = pg_result($result, 0, "name");

			print "Are you sure you want to delete the $name category ?<BR>\n";
			print "<BR>\n";
			print "<TABLE>\n";
			print "<TR>\n";
			print "<TD>";
			print "<FORM method=post action=\"$PHP_SELF?action=deletecategory&id=$id\">";
			print "<INPUT type=submit value=delete>";
			print "</FORM>";
			print "</TD>\n";
			print "<TD>";
			print "<FORM method=post action=\"$PHP_SELF?action=listcategories\">";
			print "<INPUT type=submit value=cancel>";
			print "</FORM>";
			print "</TD>\n";
			print "</TR>\n";
			print "</TABLE>\n";
			break;

		case "deletecategory":
			if (!$userprivileges[removeprojectcategory])  {
				print "You are not permitted to access this page !<BR>\n";
				break;
			}

			if ($id=="") {
				print "Invalid category !<BR>\n";
				break;
			}

			if ($id<5) {
				print "You can't delete this category !<BR>\n";
				break;
			}

			//--- set projects' using this category to the 'Other' category ---//

			$query = "update projects set category=$projecttype where category=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			//--- remove it from the database ---//

			$query = "delete from projectcategories where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "Deleted !<BR>\n";
			print "<BR>\n";
			print "<A href=\"$PHP_SELF?action=listcategories\">back</A>\n";
			break;

		case "listcategories":
			//--- fetch categories list ---//

			$query  = "select * from projectcategories where type=$projecttype order by name";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			$number = pg_numrows($result);

			//--- print infos ---//

			print "<TABLE cellpadding=5>\n";

			$i=0;
			while ($i < $number) {
				$row = pg_fetch_array($result, $i, PGSQL_ASSOC);

				print "<TR>";
				print "<TD><B>$row[name]</B></TD>";
				print "<TD>$row[description]</TD>";
				if ($userprivileges[editprojectcategory])
					print "<TD><A href=\"$PHP_SELF?action=editcategory&id=$row[id]\">edit</A></TD>";
				if ($userprivileges[removeprojectcategory] && $row[id]>4)
					print "<TD><A href=\"$PHP_SELF?action=removecategory&id=$row[id]\">delete</A></TD>";
				print "</TR>\n";

				$i++;
			}

			print "</TABLE>\n";

			//--- add the add category button ---//

			if ($userprivileges[addprojectcategory]) { 
				print "<FORM method=post action=\"$PHP_SELF?action=addcategory\">\n";
				print "<INPUT type=submit value=\"submit category\">\n";
				print "</FORM>\n";
			}

			print "<A href=\"$PHP_SELF\">back</A>\n";
			break;

		//---------------------------//
		//---------------------------//
		//------ LIST PROJECTS ------//
		//---------------------------//
		//---------------------------//

		default:
			//--- show the top table with explanations ---//

			$query = "select * from oses order by name";
			$oslist = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$numberos = pg_numrows($oslist);

			//--- set filters default values ---//

			if ($order=="")
				$order = "name";

			if ($category=="")
				$category = "any";

			if ($completed=="")
				$completed = 0;

			if ($os=="")
				$os = "any";

			if ($perpage=="")
				$perpage = "50";

			if ($start=="")
				$start = 0;

			//--- show the different filters ---//

			print "<FORM method=get action=\"$PHP_SELF\">\n";
//			print "<INPUT type=hidden name=form_submit value=true>\n";

			print "<TABLE><TBODY>\n";

			//--- sort by name/last updated ---//

			print "<TR>\n";
			print "<TD>Sort by: ";
			print "<TD>";
			print "<SELECT name=order>";
			OPTION("name",$order,"name");
			OPTION("time",$order,"recently updated");
			print "</SELECT>\n";

			//--- category ---//

			print "<TR>\n";
			print "<TD>Category: ";
			print "<TD>";
			print "<SELECT name=category>";
			OPTION("any",$category,"any");

			$query = "select id, name from projectcategories where type=$projecttype";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$number = pg_numrows($result);

			$i=0;
			while ($i < $number) {
				$row = pg_fetch_array($result, $i, PGSQL_ASSOC);
				OPTION($row[id],$category,$row[name]);
				$i++;
			}
			print "</SELECT>\n";

			//--- license ---//

/*
			print "<TR>\n";
			print "<TD>License: ";
			print "<TD>";
			print "<SELECT name=match_license>";
			OPTION("",$match_license,"any");

			for ($i=0; $licenses[$i]; $i++) {
				$db_license = str_replace(" ", "_", $licenses[$i]);
				OPTION($db_license,$match_license,$licenses[$i]);
			}
			print "</SELECT></TD>\n";
*/

			//--- completed ... on ... ---//

			print "<TR>\n";
			print "<TD>Completed: ";
			print "<TD>";
			print "<SELECT name=completed>";
			$ratinglist = array(0, 25, 50, 75, 100);
			while (list($elemnbr,$elemvalue)=each($ratinglist))
				OPTION($elemvalue,$completed,"$elemvalue%");
			print "</SELECT>";
			print " on ";
			print "<SELECT name=os>";
			OPTION("any",$os,"Any OS");
			for ($i=0; $i < $numberos; $i++) {
				$row = pg_fetch_array($oslist, $i, PGSQL_ASSOC);
				OPTION($row[id],$os,"$row[name]");
			}
			print "</SELECT>\n";

			//--- named ... ---//

			print "<TR>\n";
			print "<TD>Named: ";
			print "<TD>";
			print "<INPUT type=text name=match_name value=\"$match_name\" size=8>\n";

			//--- limit to ... per page ---//

			print "<TR>\n";
			print "<TD>Show: ";
			print "<TD>";
			print "<SELECT name=perpage>";
			$perpagelist = array(10, 25, 50, 100, "all");
			while (list($elemnbr,$elemvalue)=each($perpagelist))
				OPTION($elemvalue,$perpage,"$elemvalue");
			print "</SELECT>";
			print " $projecttypetextp on one page\n";

			print "</TABLE>\n";

			//--- only own projects ---//

			if ( $userid > 0 ) {
				print "<INPUT type=checkbox name=match_userid value=checked $match_userid> Show only my projects<BR>\n";
			}

			print "<INPUT type=submit value=\"Show\"> ";

			print "</FORM>\n";

			//--- set up the query condition --//
			$querycondition = "where type = $projecttype";

			if ($category!="any")
				$querycondition .= " and category=$category";

			if ($match_name!="")
				$querycondition .= " and name ~* '$match_name'";

			if ($match_userid!="")
				$querycondition .= " and userid = $userid";

			if ($match_id)
				$querycondition .= " and id = $match_id";

			if ($os!="any") 
				$querycondition .= " and id in (select project from projectstatus where os=$os and status>=$completed)";
			else
			if ($completed!=0) 
				$querycondition .= " and id in (select distinct project from projectstatus where status>=$completed)";

			//--- count projects ---//

			$query = "select count(*) as total from projects $querycondition";

			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			$total = pg_result ($result, 0, "total");

			//--- fetch projects info ---//

			$query  = "select * from projects $querycondition";
			if ($order=="time")
				$query .= " order by timestamp desc";
			else
				$query .= " order by name";

			if ($perpage!="all") 
				$query .= " limit $perpage offset $start";


			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			$number = pg_numrows($result);

			//--- print infos ---//

			if ($number == $total) {
				if ( $total == 1 ) {
					print "<P>Showing $total $projecttypetexts:</P>";
				} else {
					print "<P>Showing $total $projecttypetextp:</P>";
				}
			} else {
				$showstart = $start + 1;
				$showstop  = $start + $perpage;
				if ( $showstop > $total ) {
					$showstop = $total;
				}
				print "<P>Showing $showstart-$showstop out of $total $projecttypetextp:</P>";
			}

			$ratingstring = array(25=>"work in progress", 50=>"work in progress", 75=>"ready for testing", 100=>"fully functional");

			for ($i=0; $i < $number; $i++) {
				$row = pg_fetch_array($result, $i, PGSQL_ASSOC);

				print "<P>\n";
				print "<B><A name=$row[id]>$row[name]</A></B> - $row[description]<BR>\n";

				print "<A href=\"$row[url]\">$row[url]</A><BR>\n";

				if ($userid>0)
					$contact = "<A href=\"mailto:$row[contact]\">$row[contact]</A>";
				else
					$contact = str_replace("@", " ", $row[contact]);

				print "Contact: $contact<BR>\n";

				$query = "select status,shortname from projectstatus,oses where os=oses.id and project=$row[id] and status > 0";
				$status = pg_exec($DBconnection, $query)
					or die ("Could not execute query !");
				$numberos = pg_numrows($status);

				for ($j=0; $j < $numberos; $j++) {
					$shortname = pg_result($status, $j, "shortname");
					print "<IMG alt=\" $shortname \" src=\"images/$shortname.gif\" width=32 height=32>";
					print "<IMG alt=\"\" src=\"images/sep.gif\" width=4 height=32>";
				}
				if ($numberos) print "<BR>\n";
				for ($j=0; $j < $numberos; $j++) {
					$rating = pg_result($status, $j, "status");
					print "<IMG alt=\" $ratingstring[$rating] \" src=\"images/$rating-small.gif\" width=32 height=4>";
					print "<IMG alt=\"\" src=\"images/sep-small.gif\" width=4 height=4>";
				}
				if ($numberos) print "<BR>\n";

				if ( $row[license] ) {
					$license = str_replace("_", " ", $row[license]);
				} else {
					$license = $licenses[0];
				}
				print "License: $license<BR>\n";

				$mayeditproject = ($userprivileges[editproject]) || ($userid==$row[userid]);
				$mayremoveproject = ($userprivileges[removeproject]) || ($userid==$row[userid]);

				if ($mayeditproject && $mayremoveproject)
					print "<A href=\"$PHP_SELF?action=editproject&id=$row[id]\">edit</A>&nbsp;<A href=\"$PHP_SELF?action=removeproject&id=$row[id]\">delete</A>";
				else if ($mayeditproject)
					print "<A href=\"$PHP_SELF?action=editproject&id=$row[id]\">edit</A>";
				else if ($mayremoveproject)
					print "<A href=\"$PHP_SELF?action=removeproject&id=$row[id]\">delete</A>";
				if ($userid == $row[userid])
					print "&nbsp;<A href=\"$PHP_SELF?action=disownproject&id=$row[id]\">disown</A>";
				if ($mayeditproject || $mayremoveproject || ($userid == $row[userid]))
					print "<BR>\n";

				if ($userid > 0) {
					if ($row[userid] == -1) {
						print "<A href=\"$PHP_SELF?action=maintainproject&id=$row[id]\">maintain project</A><BR>\n";
					} else if ($userprivileges[editproject]) {
						$query  = "select name, email from users ";
						$query .= "where id = $row[userid]";
						$users = pg_exec($DBconnection, $query)
							or die ("Could not execute query !");
						$name = pg_result ($users, 0, "name");
						$email = pg_result ($users, 0, "email");
						print "Maintained by: $name (<A href=\"mailto:$email\">$email</A>)<BR>\n";
					}
				}
				print "</P>\n";
			}

			//--- show the "previous page"/"next page" links if needed ---//

			$next = $start + $perpage;

			if (($perpage!="all") && (($start>0) || ($next<$total))) {
				print "<P>\n";

				$match_infos .= "order=$order&category=$category&completed=$completed&os=$os&match_name=$match_name&perpage=$perpage";

				if ($start>0) {
					$prev = $start - $perpage; 

					if ($prev<0)		// this can only happen if the user went manually to a start not dividable by step 
						$prev = 0;

					print "<A href=\"$PHP_SELF?start=$prev&$match_infos\">previous page</A>&nbsp";
				}

				if ($next<$total)
					print "<A href=\"$PHP_SELF?start=$next&$match_infos\">next page</A>";

				print "</P>\n";
			}

			//--- add the add project button ---//

			if ($userprivileges[addproject]) {
				print "<FORM method=post action=\"$PHP_SELF?action=addproject\">\n";
				print "<INPUT type=submit value=\"submit $projecttypetexts\">\n";
				print "</FORM>\n";
			}

			//--- add the list project categories link ---//

			print "<A href=\"$PHP_SELF?action=listcategories\">list $projecttypetexts categories</A>\n";
	}
?>

