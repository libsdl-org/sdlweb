<DL>
<DT><FONT color="#414141" size=4>&nbsp;&nbsp;&nbsp;<STRONG>Site Actions</STRONG></FONT> 
<?PHP
	if ($userid==0) { 	// not logged in yet -- getting user login & pass 
		print "<DD><A href=\"/index.php?action=showloginform\"><FONT color=\"#414141\"><STRONG>Login</STRONG></FONT></A>";
		print "<DD><A href=\"/users.php?action=createuser\"><FONT color=\"#414141\"><STRONG>New Account</STRONG></FONT></A>";
	} else {
		print "<DD><FONT color=\"#414141\"><STRONG>Login:</STRONG></FONT> <I>$userlogin</I></DD>";
		print "<DD><A href=\"/users.php?action=edituser&id=$userid\"><FONT color=\"#414141\"><STRONG>Edit Account</STRONG></FONT></A>";
		if ($userprivileges[manageoses])
			print "<DD><A href=\"/oses.php\"><FONT color=\"#414141\"><STRONG>Manage OSes</STRONG></FONT></A>";
		if ($userprivileges[manageusers])
			print "<DD><A href=\"/users.php\"><FONT color=\"#414141\"><STRONG>Manage Users</STRONG></FONT></A>";
		if ($userprivileges[managegroups])
			print "<DD><A href=\"/groups.php\"><FONT color=\"#414141\"><STRONG>Manage Groups</STRONG></FONT></A>";
		print "<DD><A href=\"/index.php?action=logout\"><FONT color=\"#414141\"><STRONG>Logout</STRONG></FONT></A>";
	}
?>
</DL>
