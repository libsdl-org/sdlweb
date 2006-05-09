	<!-- Site Actions -->
	<img src="/images/siteactions.png" width="180" height="32" alt="Site Actions"><br>
	<ul class="menu">
<?PHP
	if ($userid==0) { 	// not logged in yet -- getting user login & pass 
		print "<li><a href=\"/index.php?action=showloginform\">Login</a></li>";
		print "<li><a href=\"/users.php?action=createuser\">New Account</a></li>";
	} else {
		print "<li>Login: <i>$userlogin</i><br>";
		print "<li><a href=\"/users.php?action=edituser&amp;id=$userid\">Edit Account</a></li>";
		if ($userprivileges[manageoses])
			print "<li><a href=\"/oses.php\">Manage OSes</a></li>";
		if ($userprivileges[manageusers])
			print "<li><a href=\"/users.php\">Manage Users</a></li>";
		if ($userprivileges[managegroups])
			print "<li><a href=\"/groups.php\">Manage Groups</a></li>";
		print "<li><a href=\"/index.php?action=logout\">Logout</a></li>";
	}
?>
	</ul>
	<!-- End Site Actions -->
