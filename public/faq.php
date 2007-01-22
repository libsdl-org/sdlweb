<?PHP
	include("../include/login.inc.php");
	if (!$printer_friendly)
		include("header.inc.php");

	$title = "Frequently Asked Questions";
		
	$input = validateinput($_GET, array('category'=>array('type'=>'integer')), array('category'));
	if ($input === False)
		break;
	
	if ($input['category']) {
		$query = "select name from faqcategories where id = {$input['category']}";
		$result = mysql_query($query, $DBconnection)
			or die ("Could not execute query !");
		$name = mysql_result($result, 0, "name");
		$title = "$title: $name";
	}

	BeginContent($title);

	$faq_categories_fields_def = array(
		'id'=>array('type'=>'integer', 'required'=>True),
		'name'=>array('type'=>'char', 'size'=>20, 'required'=>True),
		'description'=>array('type'=>'char', 'size'=>255, 'required'=>True),
		'sorted'=>array('type'=>'float', 'required'=>True),
	);

	$faq_entries_fields_def = array(
		'id'=>array('type'=>'integer', 'required'=>True),
		'category'=>array('type'=>'integer', 'required'=>True),
		'question'=>array('type'=>'char', 'required'=>True),
		'answer'=>array('type'=>'char', 'required'=>True),
		'sorted'=>array('type'=>'float', 'required'=>True),
	);
	
	switch ($action) {
		case "addentry":
			if (!$userprivileges['addfaqentry'])  {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			$input = validateinput($_GET, $faq_entries_fields_def, array('category'));
			if (!$input)
				break;

			echo <<<EOT
<form method="post" action="{$_SERVER['PHP_SELF']}?action=insertentry&amp;category={$input['category']}">
<p>question<br><textarea name="question" cols="60" rows="2" wrap="soft"></textarea></p> 
<p>answer<br><textarea name="answer" cols="60" rows="10" wrap="soft"></textarea></p>
<p><input type="submit" value="Submit"></p>
<input type="hidden" name="category" value="{$input['category']}"> 
</form>
<a href="{$_SERVER['PHP_SELF']}?action=listentries&amp;category={$input['category']}">back</a>

EOT;
			break;

		case "insertentry":
			if (!$userprivileges['addfaqentry'])  {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			$input = validateinput($_POST, $faq_entries_fields_def, array('category', 'question', 'answer'));
			if (!$input)
				break;

			$query = "insert into faqentries(category,question,answer)";
			$query .= " values({$input['category']}, '{$input['question']}', '{$input['answer']}')";

			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			$query = "select max(id) as id from faqentries";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$id = mysql_result($result, 0, "id");

			$query = "update faqentries set sorted=$id where id=$id";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			echo <<<EOT
Entry added !<br>
<br>
<a href="{$_SERVER['PHP_SELF']}?action=listentries&amp;category={$input['category']}">back</a>

EOT;
			break;

		case "updateentry":
			if (!$userprivileges['editfaqentry'])  {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			$input = validateinput($_GET, $faq_entries_fields_def, array('id'));
			if (!$input)
				break;
				
			$id = $input['id'];

			$input = validateinput($_POST, $faq_entries_fields_def, array('question', 'answer', 'sorted'));
			if (!$input)
				break;

			$query = "update faqentries set question='{$input['question']}', answer='{$input['answer']}', sorted={$input['sorted']} where id=$id";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			print "<i>Updated !</i><br>\n";

		case "editentry":
			if (!$userprivileges['editfaqentry'])  {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			$input = validateinput($_GET, $faq_entries_fields_def, array('id', 'category'));
			if (!$input)
				break;
				
			$query = "select * from faqentries where id={$input['id']}";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$row = mysql_fetch_array($result, MYSQL_ASSOC);

			echo <<<EOT
<form method="post" action="{$_SERVER['PHP_SELF']}?action=updateentry&amp;id={$input['id']}&amp;category={$input['category']}">
<p>question<br><textarea name="question" cols="60" rows="2" wrap="soft">{$row['question']}</textarea></p> 
<p>answer<br><textarea name="answer" cols="60" rows="10" wrap="soft">{$row['answer']}</textarea></p>
<p>Sorted at: <input type="text" name="sorted" value="{$row['sorted']}" size="8" maxlength="8"></p>
<p><input type="submit" value="Submit"></p>
</form>
<a href="{$_SERVER['PHP_SELF']}?action=listentries&amp;category={$input['category']}">back</a>

EOT;
			break;

		case "removeentry":
			if (!$userprivileges['removefaqentry']) {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			$input = validateinput($_GET, $faq_entries_fields_def, array('id', 'category'));
			if (!$input)
				break;

			$query = "select question from faqentries where id={$input['id']}";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$question = mysql_result($result, 0, "question");

			echo <<<EOT
Are you sure you want to delete this entry ?
<p>$question</p>
<table>
<tr>
<td>
<form method="post" action="{$_SERVER['PHP_SELF']}?action=deleteentry&amp;id={$input['id']}&amp;category={$input['category']}">
<input type="submit" value="delete">
</form>
</td>
<td>
<form method="post" action="{$_SERVER['PHP_SELF']}?action=listentries&amp;category={$input['category']}">
<input type="submit" value="cancel">
</form>
</td>
</tr>
</table>

EOT;
			break;

		case "deleteentry":
			if (!$userprivileges['removefaqentry'])  {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			$input = validateinput($_GET, $faq_entries_fields_def, array('id', 'category'));
			if (!$input)
				break;

			//--- remove entry from the database ---//

			$query = "delete from faqentries where id={$input['id']}";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			echo <<<EOT
Deleted !<br>
<br>
<a href="{$_SERVER['PHP_SELF']}?action=listentries&amp;category={$input['category']}">back</a>

EOT;
			break;

		case "listentries":
			if ($input['category'] == "") {
				print "Invalid category !<br>\n";
				break;
			}

			//--- fetch entries ---//

			$query = "select * from faqentries where category={$input['category']} order by sorted";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			//--- print ToC ---//

			$questions = '';
			$entries = '';
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$questions .= "<li><a href='#{$row['id']}'>{$row['question']}</a>\n";

				$entryactions = '';
				if ($userprivileges['editfaqentry'])
					$entryactions .= <<<EOT
Sorted: {$row['sorted']}&nbsp;
<a href="{$_SERVER['PHP_SELF']}?action=editentry&amp;id={$row['id']}&amp;category={$input['category']}">edit</a>&nbsp;

EOT;
				if ($userprivileges['removefaqentry'])
					$entryactions .= <<<EOT
<a href="{$_SERVER['PHP_SELF']}?action=removeentry&amp;id={$row['id']}&amp;category={$input['category']}">delete</a>&nbsp;

EOT;
				$entries .= <<<EOT
<table cellpadding="5">
<tr><td valign="top"><b>Q:</b></td><td><a name="{$row['id']}"><b>{$row['question']}</b></a></td></tr>
<tr><td valign="top"><b>A:</b></td><td>{$row['answer']}</td></tr>
</table>
$entryactions
<hr>

EOT;
			}
			
			// output the whole thing	
			echo <<<EOT
<h3>Table Of Contents</h3>
<ul>
$questions
</ul>

<hr width="100%">

$entries

EOT;

			//--- add the add entry button ---//

			if ($userprivileges['addfaqentry'])
				echo <<<EOT
<form method="post" action="{$_SERVER['PHP_SELF']}?action=addentry&amp;category={$input['category']}">
<input type="submit" value="add entry">
</form>

EOT;

			if (!$printer_friendly)
				print "<a href=\"{$_SERVER['PHP_SELF']}\">back</a>\n";
			break;

		//----------------------------------------------------------------------------------//
		//----------------------------------------------------------------------------------//
		//----------------------------------------------------------------------------------//

		case "addcategory":
			if (!$userprivileges['managefaqcategories'])  {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			echo <<<EOT
<form method="post" action="{$_SERVER['PHP_SELF']}?action=insertcategory">
<p>name<br><input type="text" name="name" size="50" maxlength="20"></p>
<p>description<br><input type="text" name="description" size="50" maxlength="255"></p>
<p><input type="submit" value="Submit"></p>
</form>
<a href="{$_SERVER['PHP_SELF']}">back</a>

EOT;
			break;

		case "insertcategory":
			if (!$userprivileges['managefaqcategories'])  {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			$input = validateinput($_POST, $faq_categories_fields_def, array('name', 'description'));
			if (!$input)
				break;

			$query  = "insert into faqcategories(name, description)";
			$query .= " values('{$input['name']}','{$input['description']}')";

			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			$query = "select max(id) as id from faqcategories";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$id = mysql_result($result, 0, "id");

			$query = "update faqcategories set sorted=$id where id=$id";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			echo <<<EOT
Category added !<br>
<br>
<a href="{$_SERVER['PHP_SELF']}">back</a>

EOT;
			break;

		case "updatecategory":
			if (!$userprivileges['managefaqcategories'])  {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			$input = validateinput($_GET, $faq_categories_fields_def, array('id'));
			if (!$input)
				break;
				
			$id = $input['id'];

			$input = validateinput($_POST, $faq_categories_fields_def, array('name', 'description', 'sorted'));
			if (!$input)
				break;

			$query = "update faqcategories set name='{$input['name']}', description='{$input['description']}', sorted={$input['sorted']} where id=$id";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			print "<i>Updated !</i><br>\n";

		case "editcategory":
			if (!$userprivileges['managefaqcategories'])  {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			$input = validateinput($_GET, $faq_categories_fields_def, array('id'));
			if (!$input)
				break;

			$query = "select * from faqcategories where id={$input['id']}";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$row = mysql_fetch_array($result, MYSQL_ASSOC);

			echo <<<EOT
<form method="post" action="{$_SERVER['PHP_SELF']}?action=updatecategory&amp;id={$input['id']}">
<p>name<br><input type="text" name="name" value="{$row['name']}" size="50" maxlength="20"></p>
<p>description<br><input type="text" name="description" value="{$row['description']}" size="50" maxlength="255"></p>
<p>Sorted at: <input type="text" name="sorted" value="{$row['sorted']}" size="8" maxlength="8"></p>
<p><input type="submit" value="Submit"></p>
</form>
<a href="{$_SERVER['PHP_SELF']}">back</a>

EOT;
			break;

		case "removecategory":
			if (!$userprivileges['managefaqcategories']) {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			$input = validateinput($_GET, $faq_categories_fields_def, array('id'));
			if (!$input)
				break;

			$query = "select name from faqcategories where id={$input['id']}";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			$name = mysql_result($result, 0, "name");
	
			echo <<<EOT
Are you sure you want to delete the $name category ? (this will delete all entries within this category)<br>
<br>
<table>
<tr>
<td>
<form method="post" action="{$_SERVER['PHP_SELF']}?action=deletecategory&amp;id={$input['id']}">
<input type="submit" value="delete">
</form
</td>
<td
<form method="post" action="{$_SERVER['PHP_SELF']}">
<input type="submit" value="cancel">
</form>
</td>
</tr>
</table>

EOT;
			break;

		case "deletecategory":
			if (!$userprivileges['managefaqcategories'])  {
				print "You are not permitted to access this page !<br>\n";
				break;
			}

			$input = validateinput($_GET, $faq_categories_fields_def, array('id'));
			if (!$input)
				break;

			//--- delete all entries in that category ---//

			$query = "delete from faqentries where category={$input['id']}";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			//--- remove category from the database ---//

			$query = "delete from faqcategories where id={$input['id']}";
			mysql_query($query, $DBconnection)
				or die ("Could not execute query !");
			
			echo <<<EOT
Deleted !<br>
<br>
<a href="{$_SERVER['PHP_SELF']}">back</a>

EOT;
			break;

		default:
			//--- fetch category list ---//

			$query  = "select * from faqcategories order by sorted";
			$result = mysql_query($query, $DBconnection)
				or die ("Could not execute query !");

			//--- print categories ---//

			print "<table cellpadding=\"5\">\n";

			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				if ($userprivileges['managefaqcategories'])
					$actions = <<<EOT
<td>{$row['sorted']}</td>
<td><a href="{$_SERVER['PHP_SELF']}?action=editcategory&amp;id={$row['id']}">edit</a></td>
<td><a href="{$_SERVER['PHP_SELF']}?action=removecategory&amp;id={$row['id']}">delete</a></td>

EOT;
				else
					$actions = "";

				echo <<<EOT
<tr>
<td><b><a href="{$_SERVER['PHP_SELF']}?action=listentries&amp;category={$row['id']}">{$row['name']}</a></b></td>
<td>{$row['description']}</td>
$actions
</tr>

EOT;
			}

			print "</table>\n";

			//--- add the add category button ---//

			if ($userprivileges['managefaqcategories']) 
				echo <<<EOT
<form method="post" action="{$_SERVER['PHP_SELF']}?action=addcategory">
<input type="submit" value="add category">
</form>

EOT;
			echo <<<EOT
<hr width="100%">
<a href="index.php">back</a>

EOT;
	}

	CloseContent();

	if (!$printer_friendly)
		include ("footer.inc.php");
?>
