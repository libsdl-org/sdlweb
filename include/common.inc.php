<?PHP
	# ------------ layout functions ---------------
	# These functions go here instead of header.inc because
	# header.inc is included by raw HTML code, and it's hard
	# output PHP code in raw HTML and have it parse correctly.
	function BeginContent($title) {
		echo <<<EOT
<h1><font color="#414141"><strong>$title</strong></font></h1>
<br>
<blockquote>
EOT;
	}
	
	function CloseContent() {
		echo <<<EOT
</blockquote>
EOT;
	}

	function OPTIONSTR($value, $selectedvalue, $text) {
		$isselected = ($value == $selectedvalue) ? ' selected' : '';
		return "<option$isselected value=$value>$text</option>";
	}

	function containtag($name, $value) {
		if ($value!=strip_tags($value)) {
			print "You may not use HTML nor PHP tags in the $name field !<br>\n";
			return 1;
		} else
			return 0;
	}

	function isempty($name, $value) {
		if ($value=="") {
			print "The $name field is required !<br>\n";
			return 1;
		} else
			return 0;
	}

	function checkbox($text, $value) {
		if ($value == "t")
			print "<input type=\"checkbox\" name=\"$text\" value=\"yes\" checked>$text";
		else
			print "<input type=\"checkbox\" name=\"$text\" value=\"yes\">$text";
	}
	
	function OPTION($value, $selectedvalue, $text) {
		if ($value == $selectedvalue)
			print "<option selected value=\"$value\">$text";
		else
			print "<option value=\"$value\">$text";
	}

	function validate_field($name, &$value, $field_def) {
		if ($field_def['required'] and $value == "") {
			print "The $name field is required !<BR>";
			return False;
		}
			
		if ($field_def['type'] == 'char') {
			$allowed_tags = $field_def['allowed_tags'];
			if ($value != strip_tags($value, $allowed_tags)) {
				print "You are using unallowed tags in the $name field !<br>\n";
				return False;
			} else {
				# We do not need to go through htmlspecialchars since 
				# offending tags have already been taken care of by the 
				# strip_tags test above, and other tags need to be left 
				# intact.
#				$newvalue = htmlspecialchars($value);
				$newvalue = $value;

				# Truncate string if needed.
				if ($field_def['size'])
					$newvalue = substr($newvalue, 0, $field_def['size']);

				# Make sure the string is properly quoted.
				if (get_magic_quotes_gpc())
					$newvalue = stripslashes($newvalue);

				# check if this function exists
				if (function_exists("pg_escape_string"))
					$newvalue = pg_escape_string($newvalue);
				else
					$newvalue = addslashes($newvalue);
			}
		} else if ($field_def['type'] == 'integer') {
			$newvalue = (int)($value);
		} else if ($field_def['type'] == 'float') {
			$newvalue = (float)($value);
		} else {
			print "Invalid type used for field $name ({$field_def['type']})<BR>\n";
			
			return False;
		}
		$value = $newvalue;
		return True;
	}
	
	function validateinput($input, $fields_def, $field_list) {
		$validated = array();
		$nberrors = 0;
		foreach ($field_list as $field_name) {
			$field_value = $input[$field_name];
			if (!array_key_exists($field_name, $fields_def)) {
				print "No definition found for field $field_name<BR>\n";
				$nberrors++;
			} else if (validate_field($field_name, $field_value, $fields_def[$field_name])) {
				# required fields are already handled at this point, 
				# so if the field is not set it's alright not to copy 
				# it over
				if (isset($input[$field_name]))
					$validated[$field_name] = $field_value;
			} else {
				$nberrors++;
			}
		}
		if ($nberrors) {
			return False;
		} else
			return $validated;
	}
?>
