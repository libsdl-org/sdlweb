<?PHP
	include("updaterss.inc.php");

	define(MINVERSIONMAJOR, 1); define(MAXVERSIONMAJOR, 1); define(DEFAULTVERSIONMAJOR, 1);
	define(MINVERSIONMINOR, 2); define(MAXVERSIONMINOR, 2); define(DEFAULTVERSIONMINOR, 2);
	define(MINVERSIONPATCH, 0); define(MAXVERSIONPATCH, 10); define(DEFAULTVERSIONPATCH, 0);

	if ((PROJECTTYPE < 1) || (PROJECTTYPE > 4)) {
		print "Invalid project type !<br>\n";
		break;
	}

	$fields_def = array(
		'id'=>array('type'=>'integer', 'required'=>True),
#		'userid'=>array('type'=>'integer', 'required'=>True),
#		'type'=>array('type'=>'integer', 'required'=>True),
		'category'=>array('type'=>'integer', 'required'=>True),
		'name'=>array('type'=>'char', 'size'=>30, 'required'=>True),
		'description'=>array('type'=>'char', 'size'=>255, 'required'=>True),
#		'versionrequired'=>array('type'=>'integer', 'required'=>True),
		'versionreqmajor'=>array('type'=>'integer', 'required'=>True, 'min'=>MINVERSIONMAJOR, 'max'=>MAXVERSIONMAJOR),
		'versionreqminor'=>array('type'=>'integer', 'required'=>True, 'min'=>MINVERSIONMINOR, 'max'=>MAXVERSIONMINOR),
		'versionreqpatch'=>array('type'=>'integer', 'required'=>True, 'min'=>MINVERSIONPATCH, 'max'=>MAXVERSIONPATCH),
		'url'=>array('type'=>'char', 'size'=>100 , 'required'=>True),
		'contact'=>array('type'=>'char', 'size'=>64),
#		'reviewed'=>array('type'=>'bool', 'required'=>True),
#		'timestamp'=>TIMESTAMP , 'required'=>True),
		'license'=>array('type'=>'char', 'size'=>32, 'required'=>True),
	);

	$query_fields_def = array(
		'category'=>array('type'=>'integer'),
		'match_name'=>array('type'=>'char'),
		'match_id'=>array('type'=>'integer'),
		'os'=>array('type'=>'integer'),
		'completed'=>array('type'=>'integer'),
		'perpage'=>array('type'=>'integer'),
		'start'=>array('type'=>'integer'),
		'match_userid'=>array('type'=>'char'),
		'order'=>array('type'=>'char'),
	);

	$categ_fields_def = array(
		'id'=>array('type'=>'integer', 'required'=>True),
		'name'=>array('type'=>'char', 'size'=>40, 'required'=>True),
		'description'=>array('type'=>'char', 'size'=>255),
	);

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

	switch ($action) {
		case "addproject":
			if (!$userprivileges['addproject']) {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

#TODO: fetch user email here instead in login.inc.php

			print "<form method=post action=\"{$_SERVER['PHP_SELF']}?action=insertproject\">\n";
			print "<p><i>The fields marked with (*) are required</i></p>\n";

			# --- misc info ---

			print "<p>name (*)<br><input type=text name=name size=50 maxlength=30></p>\n";
			print "<p>description (a single sentence without trailing period) (*)<br><input type=text name=description size=50 maxlength=255></p>\n";
			print "<p>url (*)<br><input type=text name=url value=\"http://\" size=50 maxlength=100></p>\n";
			print "<p>contact email<br><input type=text name=contact value=\"$useremail\" size=50 $maxlength=64></p>\n";

			# --- select min version req ---

			print "<p>minimum SDL version required<br>\n";
			print "<select name=versionreqmajor>";
			print MINVERSIONMAJOR." ".MAXVERSIONMAJOR;
			for ($i=MINVERSIONMAJOR; $i<=MAXVERSIONMAJOR; $i++)
				OPTION($i, DEFAULTVERSIONMAJOR, $i);
			print "</select>\n";
			print "<select name=versionreqminor>";
			for ($i=MINVERSIONMINOR; $i<=MAXVERSIONMINOR; $i++)
				OPTION($i, DEFAULTVERSIONMINOR, $i);
			print "</select>\n";
			print "<select name=versionreqpatch>";
			for ($i=MINVERSIONPATCH; $i<=MAXVERSIONPATCH; $i++)
				OPTION($i, DEFAULTVERSIONPATCH, $i);
			print "</select>\n";
			print "</p>\n";

			# --- select category ---
		
			print "<p>category<br>\n";
			print "<select name=category>";

			$query = "select id, name from projectcategories where type=".PROJECTTYPE;
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				OPTION($row['id'],$category,$row['name']);
			}

			print "</select>\n";
			print "</p>\n";

			# --- select license ---
		
			print "<p>license<br>\n";
			print "<select name=license>";
			for ($i=0; $licenses[$i]; $i++) {
				$db_license = str_replace(" ", "_", $licenses[$i]);
				OPTION($db_license,$licenses[0],$licenses[$i]);
			}
			print "</select>\n";
			print "</p>\n";

			# --- select os status ---

			$query = "select * from oses order by name";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			$ratinglist = array(0, 25, 50, 75, 100);

            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				print "<p>{$row['name']} status<br>\n";
				print "<select name=\"{$row['shortname']}status\">";
				reset($ratinglist);
				while (list($ratingnbr,$rating)=each($ratinglist))
					OPTION($rating,0,"$rating%");
				print "</select>\n";
				print "</p>\n";
			}

			# --- submit button ---

			print "<p><input type=submit value=Submit></p>\n";
			print "</form>\n";
			print "<a href=\"{$_SERVER['PHP_SELF']}\">back</a>\n";
			break;

		case "insertproject":
			if (!$userprivileges['addproject']) {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			# --- fetch os list ---

			$query = "select id,shortname from oses order by name";
			$oslist = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$numberos = mysql_num_rows($oslist);

			# --- check everything is valid ---

			// list of fields to check
			$fieldlist = array('category', 'name', 'description', 'versionreqmajor', 'versionreqminor', 'versionreqpatch', 'url', 'contact', 'license');

			// add oses status fields to the fields definition array
			// and to the list of fields to check
			for ($i=0; $i < $numberos; $i++) {
				$shortname = mysql_result($oslist, $i, "shortname");
				$fieldname = "{$shortname}status";
				$fields_def[$fieldname] = array('type'=>'integer', 'required'=>True);
				$fieldlist[] = $fieldname;
			}
			
			$input = validateinput($_POST, $fields_def, $fieldlist);
			if (!$input)
				break;

			# --- add project to the database ---

			$license = $input['license'];
			if ($license == $licenses[0])
				$license = "";
			$versionrequired = 
				$input['versionreqmajor'] * 1000 + 
				$input['versionreqminor'] * 100 + 
				$input['versionreqpatch'];
			$description = rtrim($input['description'], " \t,.");

			$query  = "insert into projects (userid,type,category,name,description,versionrequired,url,contact,reviewed,timestamp,license)";
			$query .= " values($userid, ".PROJECTTYPE.", {$input['category']}, '{$input['name']}', '$description', $versionrequired, '{$input['url']}', '{$input['contact']}', FALSE, CURRENT_TIMESTAMP, '$license')";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			# --- fetch the id of the project ---

			$query = "select max(id) as id from projects";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$projectid = mysql_result($result, 0, "id");

			# --- add project's status to the database ---

            while ($row = mysql_fetch_array($oslist, MYSQL_ASSOC)) {
				$value = $input["{$row['shortname']}status"];
				$query = "insert into projectstatus values($projectid, {$row['id']}, $value)";
				mysql_query($query, $DBconnection)
					or die ("Could not execute query !");
			}

			# --- post a news about it ---

			$query = "insert into news (userid,timestamp,text)";
			$query .= " values(-2, CURRENT_TIMESTAMP, '<a href=\"{$_SERVER['PHP_SELF']}?match_id=$projectid\">{$input['name']}</a>, {$input['description']}, has been added to the ".PROJECTTYPETEXTP." page.')";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			UpdateRSS($DBconnection);

			echo PROJECTTYPETEXTSC. <<<EOT
 added (and news posted about it) !<br>
<br>
<a href="{$_SERVER['PHP_SELF']}">back</a>

EOT;
			break;

		case "maintainproject":
			$input = validateinput($_GET, $fields_def, array('id'));
			if (!$input)
				break;
				
			$query = "select name from projects where id={$input['id']}";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$name = mysql_result($result, 0, "name");

			echo <<<EOT
Are you sure you are the maintainer of the $name project ?<br>
<br>
<table>
<tr>
<td>
<form method="post" action="{$_SERVER['PHP_SELF']}?action=maintainconfirmed&amp;id={$input['id']}">
<input type="submit" value="maintain">
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

		case "maintainconfirmed":
			$input = validateinput($_GET, $fields_def, array('id'));
			if (!$input)
				break;
				
			$query = "select userid from projects where id={$input['id']}";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$ownerid = mysql_result($result, 0, "userid");

			if (($userid <= 0) || ($ownerid > 0)) {
				print "You are not permitted to maintain this project!<br>\n";
				break;
			}

			$query = "update projects set userid=$userid where id={$input['id']}";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			
			echo <<<EOT
<i>Updated !</i><br>
<br>
<a href="{$_SERVER['PHP_SELF']}?action=editproject&amp;id={$input['id']}">edit</a>&nbsp;<a href="{$_SERVER['PHP_SELF']}">back</a>

EOT;
			break;

		case "disownproject":
			$input = validateinput($_GET, $fields_def, array('id'));
			if (!$input)
				break;

			$query = "select userid from projects where id={$input['id']}";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$ownerid = mysql_result($result, 0, "userid");

			if (($userid != $ownerid) || ($userid < 1)) {
				print "You are not permitted to disown this project!<br>\n";
				break;
			}

			$query = "update projects set userid=-1 where id={$input['id']}";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			echo <<<EOT
<i>Updated !</i><br>
<br>
<a href="{$_SERVER['PHP_SELF']}">back</a>

EOT;
			break;

		case "updateproject":
			$input = validateinput($_GET, $fields_def, array('id'));
			if (!$input)
				break;
				
			$id = $input['id'];

			$query = "select userid from projects where id=$id";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$ownerid = mysql_result($result, 0, "userid");

			if (!$userprivileges['editproject']) 
				if (($userid != $ownerid) || ($userid < 1)) {
					print "You are not permitted to access this page !<br>\n";
					break;
				}

			# --- fetch os list ---

			$query = "select id,shortname from oses order by name";
			$oslist = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$numberos = mysql_num_rows($oslist);

			# --- check everything is valid ---

			// list of fields to check
			$fieldlist = array('category', 'name', 'description', 'versionreqmajor', 'versionreqminor', 'versionreqpatch', 'url', 'contact', 'license');

			// add oses status fields to the fields definition array
			// and to the list of fields to check
			for ($i=0; $i < $numberos; $i++) {
				$shortname = mysql_result($oslist, $i, "shortname");
				$fieldname = "{$shortname}status";
				$fields_def[$fieldname] = array('type'=>'integer', 'required'=>True);
				$fieldlist[] = $fieldname;
			}

			$input = validateinput($_POST, $fields_def, $fieldlist);
			if (!$input)
				break;

			# --- update project in the database ---
			
			$license = $input['license'];
			if ($license == $licenses[0])
				$license = "";
			$versionrequired = 
				$input['versionreqmajor'] * 1000 + 
				$input['versionreqminor'] * 100 + 
				$input['versionreqpatch'];
			$description = rtrim($input['description'], " \t,.");

			$query  = "update projects "; 
			$query .= "set category={$input['category']}, name='{$input['name']}', description='$description', versionrequired=$versionrequired, url='{$input['url']}', contact='{$input['contact']}', timestamp=CURRENT_TIMESTAMP, license='$license' ";
			$query .= "where id=$id";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			# --- update project status in the database ---

            while ($row = mysql_fetch_array($oslist, MYSQL_ASSOC)) {
				$value = $input["{$row['shortname']}status"];
				$query = "update projectstatus set status=$value where project=$id and os={$row['id']}";
				mysql_query($query, $DBconnection)
					or die ("Could not execute query !");
			}

			echo <<<EOT
<i>Updated !</i><br>
<br>
<a href="{$_SERVER['PHP_SELF']}?match_id=$id">back</a>

EOT;
			break;

		case "editproject":
			$input = validateinput($_GET, $fields_def, array('id'));
			if (!$input)
				break;
				
			$id = $input['id'];

			$query = "select * from projects where id=$id";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$row = mysql_fetch_array($result, MYSQL_ASSOC);

			if (!$userprivileges['editproject']) 
				if (($userid != $row['userid']) || ($userid < 1)) {
					print "You are not permitted to access this page !<br>\n";
					break;
				}

			print "<form method=post action=\"{$_SERVER['PHP_SELF']}?action=updateproject&amp;id=$id\">\n";
			
			# --- misc info ---

			print "<p>name<br><input type=text name=name value=\"{$row['name']}\" size=50 maxlength=30></p>\n";
			print "<p>description (a single sentence without trailing period)<br><input type=text name=description value=\"{$row['description']}\" size=50 maxlength=255></p>\n";
			print "<p>url<br><input type=text name=url value=\"{$row['url']}\" size=50 maxlength=100></p>\n";
			print "<p>contact email<br><input type=text name=contact value=\"{$row['contact']}\" size=50 maxlength=64></p>\n";

			# --- select min version req ---

			$versionreqmajor = ($row['versionrequired'] / 1000) % 10;
			$versionreqminor = ($row['versionrequired'] / 100) % 10;
			$versionreqpatch = $row['versionrequired'] % 100;

			print "<p>minimum SDL version required<br>\n";
			print "<select name=versionreqmajor>";
			for ($i=MINVERSIONMAJOR; $i<=MAXVERSIONMAJOR; $i++)
				OPTION($i,$versionreqmajor,$i);
			print "</select>\n";
			print "<select name=versionreqminor>";
			for ($i=MINVERSIONMINOR; $i<=MAXVERSIONMINOR; $i++)
				OPTION($i,$versionreqminor,$i);
			print "</select>\n";
			print "<select name=versionreqpatch>";
			for ($i=MINVERSIONPATCH; $i<=MAXVERSIONPATCH; $i++)
				OPTION($i,$versionreqpatch,$i);
			print "</select>\n";
			print "</p>\n";

			# --- select category ---

			print "<p>category<br>\n";
			print "<select name=category>";

			$query = "select id, name from projectcategories where type=".PROJECTTYPE;
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

            while ($categ = mysql_fetch_array($result, MYSQL_ASSOC)) {
				OPTION($categ['id'],$row['category'],$categ['name']);
			}

			print "</select>\n";
			print "</p>\n";

			# --- select license ---

			print "<p>license<br>\n";
			print "<select name=license>";

			for ($i=0; $licenses[$i]; $i++) {
				$db_license = str_replace(" ", "_", $licenses[$i]);
				OPTION($db_license,$row['license'],$licenses[$i]);
			}

			print "</select>\n";
			print "</p>\n";

			# --- select os status ---

			$query = "select * from oses, projectstatus where projectstatus.os=oses.id and project=$id order by name";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			$ratinglist = array(0, 25, 50, 75, 100);

            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				print "<p>{$row['name']} status<br>\n";
				print "<select name={$row['shortname']}"."status>";
				reset($ratinglist);
				while (list($ratingnbr,$rating)=each($ratinglist))
					OPTION($rating,$row['status'],"$rating%");
				print "</select>\n";
				print "</p>\n";
			}

			# --- submit button ---

			print "<p><input type=submit value=Submit></p>\n";
			print "</form>\n";
			print "<a href=\"{$_SERVER['PHP_SELF']}\">back</a>\n";
			break;

		case "removeproject":
			$input = validateinput($_GET, $fields_def, array('id'));
			if (!$input)
				break;
				
			$id = $input['id'];
			
			$query = "select name,userid from projects where id=$id";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$row = mysql_fetch_array($result, MYSQL_ASSOC);

			if (!$userprivileges['removeproject'])
				if (($userid!=$row['userid']) || ($userid<1)) {
					print "You are not permitted to delete that project !<br>\n";
					break;
				}

			echo <<<EOT
Are you sure you want to delete the {$row['name']} project ?<br>
<br>
<table>
<tr>
<td>
<form method="post" action="{$_SERVER['PHP_SELF']}?action=deleteproject&amp;id=$id">
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

		case "deleteproject":
			$input = validateinput($_GET, $fields_def, array('id'));
			if (!$input)
				break;
				
			$id = $input['id'];

			$query = "select userid from projects where id=$id";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$ownerid = mysql_result($result, 0, "userid");

			if (!$userprivileges['removeproject']) 
				if (($userid!=$ownerid) || ($userid<1)) {
					print "You are not permitted to access this page !<br>\n";
					break;
				}

#### Old deletion code...
#			# --- delete project status referring to this project in the database ---
#
#			$query = "delete from projectstatus where project=$id";
#			mysql_query($query, $DBconnection)
#				or die ("Could not execute query !");
#
#			# --- delete project from the database ---
#
#			$query = "delete from projects where id=$id";
#			mysql_query($query, $DBconnection)
#				or die ("Could not execute query !");
#
#### New deletion code...
			$query = "update projects set deleted = 1 where id=$id";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			echo <<<EOT
Deleted !<br>
<br>
<a href="{$_SERVER['PHP_SELF']}">back</a>
EOT;
			break;

		# ------------------------
		# ------------------------
		# ------ CATEGORIES ------
		# ------------------------
		# ------------------------

		case "addcategory":
			if (!$userprivileges['addprojectcategory']) {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			echo <<<EOT
<form method="post" action="{$_SERVER['PHP_SELF']}?action=insertcategory">
<p>name<br><input type="text" name="name" size="50" maxlength="40"></p>
<p>description<br><input type="text" name="description" size="50" maxlength="255"></p>
<p><input type="submit" value="Submit"></p>
</form>
<a href="{$_SERVER['PHP_SELF']}?action=listcategories">back</a>
EOT;
			break;

		case "insertcategory":
			if (!$userprivileges['addprojectcategory']) {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			$input = validateinput($_POST, $categ_fields_def, array('name', 'description'));
			if (!$input)
				break;

			$query  = "insert into projectcategories(type,name,description)";
			$query .= " values(".PROJECTTYPE.",'{$input['name']}','{$input['description']}')";

			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			echo <<<EOT
Category added !<br>
<br>
<a href="{$_SERVER['PHP_SELF']}?action=listcategories">back</a>
EOT;
			break;

		case "updatecategory":
			if (!$userprivileges['editprojectcategory']) {
				print "You are not permitted to access this page !<br>\n";
				break;
			}
			
			$input = validateinput($_GET, $categ_fields_def, array('id'));
			if (!$input)
				break;
				
			$id = $input['id'];

			$input = validateinput($_POST, $categ_fields_def, array('name', 'description'));
			if (!$input)
				break;

			$query = "update projectcategories set name='{$input['name']}', description='{$input['description']}' where id=$id";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			print "<i>Updated !</i><br>\n";
			// no break !

		case "editcategory":
			if (!$userprivileges['editprojectcategory']) {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			$input = validateinput($_GET, $fields_def, array('id'));
			if (!$input)
				break;
				
			$id = $input['id'];

			$query = "select * from projectcategories where id=$id";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$row = mysql_fetch_array($result, MYSQL_ASSOC);

			echo <<<EOT
<form method=post action="{$_SERVER['PHP_SELF']}?action=updatecategory&amp;id=$id">
<p>name<br><input type=text name=name value="{$row['name']}" size=50 maxlength=40></p>
<p>description<br><input type=text name=description value="{$row['description']}" size=50 maxlength=255></p>
<p><input type=submit value=Submit></p>
</form>
<a href="{$_SERVER['PHP_SELF']}?action=listcategories">back</a>
EOT;
			break;

		case "removecategory":
			if (!$userprivileges['removeprojectcategory']) {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			$input = validateinput($_GET, $fields_def, array('id'));
			if (!$input)
				break;
				
			$id = $input['id'];

			if ($id < 5) {
				print "You can't delete this category !<br>\n";
				break;
			}

			$query = "select name from projectcategories where id=$id";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$name = mysql_result($result, 0, "name");

			echo <<<EOT
Are you sure you want to delete the $name category ?<br>
<br>
<table>
<tr>
<td>
<form method=post action="{$_SERVER['PHP_SELF']}?action=deletecategory&amp;id=$id">
<input type=submit value=delete>
</form>
</td>
<td>
<form method=post action="{$_SERVER['PHP_SELF']}?action=listcategories">
<input type=submit value=cancel>
</form>
</td>
</tr>
</table>
EOT;
			break;

		case "deletecategory":
			if (!$userprivileges['removeprojectcategory'])  {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			$input = validateinput($_GET, $fields_def, array('id'));
			if (!$input)
				break;
				
			$id = $input['id'];

			if ($id < 5) {
				print "You can't delete this category !<br>\n";
				break;
			}

			# --- set projects' using this category to the 'Other' category ---

			$query = "update projects set category=".PROJECTTYPE." where category=$id";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			# --- remove it from the database ---

			$query = "delete from projectcategories where id=$id";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
	
			echo <<<EOT
Deleted !<br>
<br>
<a href="{$_SERVER['PHP_SELF']}?action=listcategories">back</a>

EOT;
			break;

		case "listcategories":
			# --- fetch categories list ---

			$query = "select * from projectcategories where type=".PROJECTTYPE." order by name";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			# --- print infos ---

			print "<table cellpadding=5>\n";

            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				print "<tr>";
				print "<td><b>{$row['name']}</b></td>";
				print "<td>{$row['description']}</td>";
				if ($userprivileges['editprojectcategory'])
					print "<td><a href=\"{$_SERVER['PHP_SELF']}?action=editcategory&amp;id={$row['id']}\">edit</a></td>";
				if ($userprivileges['removeprojectcategory'] && $row['id']>4)
					print "<td><a href=\"{$_SERVER['PHP_SELF']}?action=removecategory&amp;id={$row['id']}\">delete</a></td>";
				print "</tr>\n";
			}

			print "</table>\n";

			# --- add the add category button ---

			if ($userprivileges['addprojectcategory']) { 
				print "<form method=post action=\"{$_SERVER['PHP_SELF']}?action=addcategory\">\n";
				print "<input type=submit value=\"submit category\">\n";
				print "</form>\n";
			}

			print "<a href=\"{$_SERVER['PHP_SELF']}\">back</a>\n";
			break;

		# ---------------------------
		# ---------------------------
		# ------ LIST PROJECTS ------
		# ---------------------------
		# ---------------------------

		default:
			# --- validate input ---
			
			// match_userid and order are pretty safe but it doesn't hurt to
			// validate them anyway
			$input = validateinput($_GET, $query_fields_def, array(
				'category', 'match_name', 'match_id', 'os', 'completed', 
				'perpage', 'start', 'match_userid', 'order'));
				
			if ($input === False)
				break;

			# --- fetch os list ---

			$query = "select * from oses order by name";
			$oslist = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$numberos = mysql_num_rows($oslist);

			# --- set filters default values ---

			$category = isset($input['category']) ? $input['category'] : '-1';
			$match_name = $input['match_name'];
			$match_id = $input['match_id'];
			$os = isset($input['os']) ? $input['os'] : '-1';
			$completed = isset($input['completed']) ? $input['completed'] : 0;
			$perpage = isset($input['perpage']) ? $input['perpage'] : 50;
			$start = isset($input['start']) ? $input['start'] : 0;
			$match_userid = $input['match_userid'];
			$order = isset($input['order']) ? $input['order'] : 'name';

			# --- show the different filters ---

			print "<form method=get action=\"{$_SERVER['PHP_SELF']}\">\n";

			print "<table>\n";

			# --- sort by name/last updated ---

			print "<tr>\n";
			print "<td>Sort by: ";
			print "<td>";
			print "<select name=order>";
			OPTION("name",$order,"name");
			OPTION("time",$order,"recently updated");
			print "</select>\n";

			# --- category ---

			print "<tr>\n";
			print "<td>Category: ";
			print "<td>";
			print "<select name=category>";
			OPTION(-1, $category, "any");

			$query = "select id, name from projectcategories where type=".PROJECTTYPE;
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				OPTION($row['id'], $category, $row['name']);
			}
			print "</select>\n";

			# --- license ---

/*
			print "<tr>\n";
			print "<td>License: ";
			print "<td>";
			print "<select name=match_license>";
			OPTION("",$match_license,"any");

			for ($i=0; $licenses[$i]; $i++) {
				$db_license = str_replace(" ", "_", $licenses[$i]);
				OPTION($db_license,$match_license,$licenses[$i]);
			}
			print "</select></td>\n";
*/

			# --- completed ... on ... ---

			print "<tr>\n";
			print "<td>Completed: ";
			print "<td>";
			print "<select name=completed>";
			$ratinglist = array(0, 25, 50, 75, 100);
			while (list($elemnbr,$elemvalue)=each($ratinglist))
				OPTION($elemvalue,$completed,"$elemvalue%");
			print "</select>";
			print " on ";
			print "<select name=os>";
			OPTION(-1, $os, "Any OS");
            while ($row = mysql_fetch_array($oslist, MYSQL_ASSOC)) {
				OPTION($row['id'], $os, $row['name']);
			}
			print "</select>\n";

			# --- named ... ---

			print "<tr>\n";
			print "<td>Named: ";
			print "<td>";
			print "<input type=text name=match_name value=\"$match_name\" size=8>\n";

			# --- limit to ... per page ---

			print "<tr>\n";
			print "<td>Show: ";
			print "<td>";
			print "<select name=perpage>";
			$perpagelist = array(10, 25, 50, 100);
			foreach ($perpagelist as $elemvalue)
				OPTION($elemvalue, $perpage, "$elemvalue");
			OPTION(-1, $perpage, "all");
			print "</select> ".PROJECTTYPETEXTP." on one page\n";

			print "</table>\n";

			# --- only own projects ---

			if ($userid > 0)
				print "<input type=checkbox name=match_userid value=checked $match_userid> Show only my projects<br>\n";

			# -----

			print "<input type=submit value=\"Show\"> ";

			print "</form>\n";

			# --- set up the query condition --
			$querycondition = "where deleted = 0 and type = ".PROJECTTYPE;

			if ($category != "-1")
				$querycondition .= " and category = $category";

			if ($match_name)
				$querycondition .= " and name REGEXP '$match_name'";

			if ($match_userid)
				$querycondition .= " and userid = $userid";

			if ($match_id)
				$querycondition .= " and id = $match_id";

			if ($os != "-1") {
				if ($completed == 0)
					$completed = 1;
				$querycondition .= " and id in (select project from projectstatus where os=$os and status>=$completed)";
			} else
			if ($completed != 0) 
				$querycondition .= " and id in (select distinct project from projectstatus where status>=$completed)";

			# --- count projects ---

			$query = "select count(*) as total from projects $querycondition";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			$total = mysql_result($result, 0, "total");

			# --- fetch projects info ---

			$query = "select * from projects $querycondition";
			if ($order=="time")
				$query .= " order by timestamp desc";
			else
				$query .= " order by name";

			if ($perpage != "-1") 
				$query .= " limit $perpage offset $start";

			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			$number = mysql_num_rows($result);

			# --- print infos ---

			if ($number == $total) {
				if ($total == 1) {
					print "<p>Showing $total ".PROJECTTYPETEXTS.":</p>";
				} else {
					print "<p>Showing $total ".PROJECTTYPETEXTP.":</p>";
				}
			} else {
				$showstart = $start + 1;
				$showstop = $start + $perpage;
				if ($showstop > $total) {
					$showstop = $total;
				}
				print "<p>Showing $showstart-$showstop out of $total ".PROJECTTYPETEXTP.":</p>";
			}

			$ratingstring = array(25=>"work in progress", 50=>"work in progress", 75=>"ready for testing", 100=>"fully functional");

            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				print "<p>\n";
				print "<b><a name={$row['id']}>{$row['name']}</a></b> - {$row['description']}<br>\n";

				print "<a href=\"{$row['url']}\">{$row['url']}</a><br>\n";

				if ($userid > 0)
					$contact = "<a href=\"mailto:{$row['contact']}\">{$row['contact']}</a>";
				else
					$contact = str_replace("@", " ", $row['contact']);

				print "Contact: $contact<br>\n";

				$query = "select status,shortname from projectstatus,oses where os=oses.id and project={$row['id']} and status > 0";
				$status = mysql_query($query, $DBconnection)
					or die ("Could not execute query !");
				$numberos = mysql_num_rows($status);

				for ($j=0; $j < $numberos; $j++) {
					$shortname = mysql_result($status, $j, "shortname");
					print "<img alt=\" $shortname \" src=\"images/platforms/$shortname.png\" width=32 height=32>";
					print "<img alt=\"\" src=\"images/sep.gif\" width=4 height=32>";
				}
				if ($numberos)
					print "<br>\n";

				for ($j=0; $j < $numberos; $j++) {
					$rating = mysql_result($status, $j, "status");
					print "<img alt=\"{$ratingstring[$rating]}\" src=\"images/$rating-small.png\" width=32 height=4>";
					print "<img alt=\"\" src=\"images/sep-small.gif\" width=4 height=4>";
				}

				if ($numberos)
					print "<br>\n";

				if ($row['license']) {
					$license = str_replace("_", " ", $row['license']);
				} else {
					$license = $licenses[0];
				}
				print "License: $license<br>\n";

				$mayeditproject = ($userprivileges['editproject']) || ($userid==$row['userid']);
				$mayremoveproject = ($userprivileges['removeproject']) || ($userid==$row['userid']);

				if ($mayeditproject && $mayremoveproject)
					print "<a href=\"{$_SERVER['PHP_SELF']}?action=editproject&amp;id={$row['id']}\">edit</a>&nbsp;<a href=\"{$_SERVER['PHP_SELF']}?action=removeproject&amp;id={$row['id']}\">delete</a>";
				else if ($mayeditproject)
					print "<a href=\"{$_SERVER['PHP_SELF']}?action=editproject&amp;id={$row['id']}\">edit</a>";
				else if ($mayremoveproject)
					print "<a href=\"{$_SERVER['PHP_SELF']}?action=removeproject&amp;id={$row['id']}\">delete</a>";
				if ($userid == $row['userid'])
					print "&nbsp;<a href=\"{$_SERVER['PHP_SELF']}?action=disownproject&amp;id={$row['id']}\">disown</a>";
				if ($mayeditproject || $mayremoveproject || ($userid == $row['userid']))
					print "<br>\n";

				if ($userid > 0) {
					if ($row['userid'] == -1) {
						print "<a href=\"{$_SERVER['PHP_SELF']}?action=maintainproject&amp;id={$row['id']}\">maintain project</a><br>\n";
					} else if ($userprivileges['editproject']) {
						$query  = "select name, email from users ";
						$query .= "where id = {$row['userid']}";
						$users = mysql_query($query, $DBconnection)
							or die ("Could not execute query !");
						$name = mysql_result($users, 0, "name");
						$email = mysql_result($users, 0, "email");
						print "Maintained by: $name (<a href=\"mailto:$email\">$email</a>)<br>\n";
					}
				}
				print "</p>\n";
			}

			# --- show the "previous page"/"next page" links if needed ---

			$next = $start + $perpage;

			if (($perpage != -1) && (($start > 0) || ($next < $total))) {
				print "<p>\n";

				$match_infos .= "order=$order&amp;category=$category&amp;completed=$completed&amp;os=$os&amp;match_name=$match_name&amp;perpage=$perpage";

				if ($start > 0) {
					$prev = $start - $perpage; 

					if ($prev < 0)		// this can only happen if the user went manually to a start not dividable by step 
						$prev = 0;

					print "<a href=\"{$_SERVER['PHP_SELF']}?start=$prev&amp;$match_infos\">previous page</a>&nbsp";
				}

				if ($next < $total)
					print "<a href=\"{$_SERVER['PHP_SELF']}?start=$next&amp;$match_infos\">next page</a>";

				print "</p>\n";
			}

			# --- add the add project button ---

			if ($userprivileges['addproject']) {
				print "<form method=post action=\"{$_SERVER['PHP_SELF']}?action=addproject\">\n";
				print "<input type=submit value=\"submit ".PROJECTTYPETEXTS."\">\n";
				print "</form>\n";
			}

			# --- add the list project categories link ---

			print "<a href=\"{$_SERVER['PHP_SELF']}?action=listcategories\">list ".PROJECTTYPETEXTS." categories</a>\n";
	}
?>

