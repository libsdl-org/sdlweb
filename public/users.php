<?PHP
	include ("../include/login.inc.php");
	include ("header.inc.php");

	BeginContent("Users");

	switch ($action) 
	{
		case "createuser":
			print "<FORM method=post action=\"$PHP_SELF?action=insertuser\">\n";

			print "<I>All fields are required</I><BR>\n";
			print "<P>Login (case sensitive)<BR><INPUT type=text name=newlogin size=50 maxlength=100></P>\n";
			print "<P>Password<BR><INPUT type=password name=newpass1 size=50 maxlength=100></P>\n";
			print "<P>Password confirmation<BR><INPUT type=password name=newpass2 size=50 maxlength=100></P>\n";
			print "<P>Name<BR><INPUT type=text value=\"\" name=newname size=50 maxlength=100></P>\n";
			print "<P>Email<BR><INPUT type=text value=\"\" name=newemail size=50 maxlength=100></P>\n";
			print "<P><INPUT type=submit value=Submit></P>\n";

			print "</FORM>\n";
			print "<P>Note that the information submitted here is kept completely private.</P>";
			break;

		case "insertuser":
			//--- check his data is valid ---//

			if (($newlogin=="") ||
			    ($newpass1=="") ||
			    ($newpass2=="") ||
			    ($newname=="") ||
			    ($newemail=="") ) {
				print "You are missing required fields!<BR>\n";
				break;
			}

			if (($newlogin!=strip_tags($newlogin)) ||
				($newnickname!=strip_tags($newnickname)) ||
				($newname!=strip_tags($newname)) ||
				($newemail!=strip_tags($newemail))) {
				print "You may not use HTML nor PHP tags in any field !<BR>\n";
				break;
			}

			if ($newpass1!=$newpass2) {
				print "Your confirmation password is not the same than your password !<BR>\n";
				break;
			}

			//--- check his login is not already used by someone else ---//

			$query = "select login from users where login='$newlogin'";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			if ( pg_numrows($result) != 0) {
				print "That login is used by someone else. Please choose another one...<BR>\n";
				break;
			}

			//--- insert him in the user table ---//

			$newpassword = md5($newpass1);

			$query = "insert into users (groupid,login,password,nickname,name,email)
				values(2,'$newlogin','$newpassword','$newnickname','$newname','$newemail')";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			//--- mail user ---//

			$mail_login = $newlogin;
			$mail_password = $newpass1;
			include("../include/mail-newuser.inc.php");
			mail("$newemail", $subject, $body, "from: $from");

			//--- mail webmaster ---//

			mail($webadmin, "New user registered on libsdl.org !", "login: $newlogin\nnick: $newnickname\nname: $newname\nemail: $newemail\n", "from: $webadmin");

			print "You are now registered... Click <A href=\"index.php?action=showloginform\">here</A> to login !\n";
			break;

		case "changepwd":

			if (!$userprivileges[manageusers])
				if  (($userid!=$id) || ($userid<1)) {
					print "You are not permitted to access this page !<BR>\n";
					break;
				}

			//--- get his login ---//

			$query = "select login from users where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$login = pg_result($result,0,"login");

			print "<FORM method=post action=\"$PHP_SELF?action=updatepwd&id=$id\">\n";

			print "<P><I>change password for $login</I></P>\n";

			if (!$userprivileges[manageusers])
				print "<P>old password<BR><INPUT type=password name=oldpass size=25 maxlength=100></P>\n";

			print "<P>new password<BR><INPUT type=password name=newpass1 size=25 maxlength=100></P>\n";
			print "<P>new password<BR><INPUT type=password name=newpass2 size=25 maxlength=100></P>\n";
			print "<P><INPUT type=submit value=Submit></P>\n";

			print "</FORM>\n";
			print "<A href=\"users.php?action=edituser&id=$id\">back</A>";
			break;

		case "updatepwd": 
			// Note that some variables are initialized in login.inc

			//--- check everything is valid ---//

			if (!$userprivileges[manageusers]) {
				if (($userid!=$id) || ($userid<1)) {
					print "You are not permitted to access this page !<BR>\n";
					break;
				}

				if ($oldpassword!=$userpassword) {
					print "Wrong password !<BR>\n";
					break;
				}
			}

			if ($newpass1=="") {
				print "You may not use an empty password !<BR>\n";
				break;
			}

			if ($newpass1!=$newpass2) {
				print "Your confirmation password is not the same than your password !<BR>\n";
				break;
			}

			//--- update his password ---//

			$query = "update users set password='$newpassword' where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			//--- mail user ---//

			//--- get his email address ---//

			$query = "select login, email from users where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$login = pg_result($result,0,"login");
			$email = pg_result($result,0,"email");

			//--- send the mail ---//

			$mail_login = $login;
			$mail_password = $newpass1;
			include("../include/mail-changedpassword.inc.php");
			mail("$email", $subject, $body, "from: $from");

			print "<I>Updated !</I><BR>\n";

			print "<BR>\n";
			print "<A href=\"users.php?action=edituser&id=$id\">back</A>";
			break;

		case "updateuser":
			if (!$userprivileges[manageusers])
				if  (($userid!=$id) || ($userid<1)) {
					print "You are not permitted to access this page !<BR>\n";
					break;
				}

			//--- check his data is valid ---//

			if (($newlogin!=strip_tags($newlogin)) ||
				($newnickname!=strip_tags($newnickname)) ||
				($newname!=strip_tags($newname)) ||
				($newemail!=strip_tags($newemail))) {
				print "You may not use HTML nor PHP tags in any field !<BR>\n";
				break;
			}

			//--- update his infos ---//

			if ($userprivileges[manageusers])
				$query = "update users set groupid=$newgroup, nickname='$newnickname', name='$newname', email='$newemail' where id=$id";
			else
				$query = "update users set nickname='$newnickname', name='$newname', email='$newemail' where id=$id";

			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "<I>Updated !</I><BR>\n";

		case "edituser":
			if (!$userprivileges[manageusers])
				if  (($userid!=$id) || ($userid<1)) {
					print "You are not permitted to access this page !<BR>\n";
					break;
				}

			// fetch his current infos

			$query = "select * from users where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			$row = pg_fetch_array($result, 0, PGSQL_ASSOC);

			// print his infos

			print "<P><B>login</B><BR><I>$row[login]</I></P>\n";

			print "<FORM method=post action=\"$PHP_SELF?action=changepwd&id=$id\">\n";
			print "<P>password<BR><INPUT type=submit value=change></P>\n";
			print "</FORM>\n";

			print "<FORM method=post action=\"$PHP_SELF?action=updateuser&id=$id\">\n";
			print "<P>name<BR><INPUT type=text value=\"$row[name]\" name=newname size=25 maxlength=100></P>\n";
			print "<P>email<BR><INPUT type=text value=\"$row[email]\" name=newemail size=25 maxlength=100></P>\n";
			if ($userprivileges[manageusers]) {
				$groupid = $row[groupid];

				print "<P>group<BR><SELECT name=newgroup>";

				$query = "select id, name from groups where id>=0";
				$result = pg_exec($DBconnection, $query)
					or die ("Could not execute query !");
				$number = pg_numrows($result);

				$i=0;
				while ($i < $number) {
					$row = pg_fetch_array($result, $i, PGSQL_ASSOC);
					if ($row[id]==$groupid)
						print "<OPTION selected value=$row[id]>$row[name]";
					else
						print "<OPTION value=$row[id]>$row[name]";

					$i++;
				}

				print "</SELECT></P>\n";
			}
			print "<P><INPUT type=submit value=submit></P>\n";

			print "</FORM>\n";

			if (!$userprivileges[manageusers]) {
				print "<FORM method=post action=\"$PHP_SELF?action=removeuser&id=$id\">\n";
				print "<INPUT type=submit value=\"delete account\">\n";
				print "</FORM>\n";
			}

			if ($userid!=$id) 
				print "<A href=\"users.php\">back</A>";
			else
				print "<A href=\"index.php\">back</A>";
			break;

		case "removeuser":
			if (!$userprivileges[manageusers])
				if  (($userid!=$id) || ($userid<=0)) {
					print "You are not permitted to access this page !<BR>\n";
					break;
				}

			$query = "select login from users where id=$id";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");
			$login = pg_result($result, 0, "login");

			print "Are you sure you want to delete $login account?<BR>\n";
			print "<BR>\n";
			print "<TABLE>\n";
			print "<TR>\n";
			print "<TD>";
			print "<FORM method=post action=\"$PHP_SELF?action=deleteuser&id=$id\">";
			print "<INPUT type=submit value=delete>";
			print "</FORM>";
			print "</TD>\n";
			print "<TD>";

			if ($userid!=$id) 
				print "<FORM method=post action=\"users.php\">";
			else
				print "<FORM method=post action=\"users.php?action=edituser&id=$id\">";

			print "<INPUT type=submit value=cancel>";
			print "</FORM>";
			print "</TD>\n";
			print "</TR>\n";
			print "</TABLE>\n";
			break;

		case "deleteuser":

			if (!$userprivileges[manageusers])
				if  (($userid!=$id) || ($userid<1)) {
					print "You are not permitted to access this page !<BR>\n";
					break;
				}

			//--- set his news items' author to the special 'deleted' user ---//

			$query = "update news set userid=-1 where userid=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			//--- set his projects'  to the special 'deleted' user ---//

			$query = "update projects set userid=-1 where userid=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			//--- remove him from user list ---//

			$query = "delete from users where id=$id";
			pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			print "Deleted !<BR>\n";
			print "<BR>\n";
			if ($userid!=$id) 
				print "<A href=\"users.php\">back</A>";
			else
				print "<A href=\"index.php\">back</A>";
			break;

		default: // list users
			if (!$userprivileges[manageusers])
				if  (($userid!=$id) || ($userid<1)) {
					print "You are not permitted to access this page !<BR>\n";
					break;
				}

			//--- fetch users infos ---//

			$query  = "select users.id as id, login, nickname, users.name as username, email, groups.name as groupname ";
			$query .= "from users,groups ";
			$query .= "where (users.groupid=groups.id) and (users.id>0) order by username";
			$result = pg_exec($DBconnection, $query)
				or die ("Could not execute query !");

			$number = pg_numrows($result);

			//--- print users infos ---//

			print "<TABLE cellpadding=4>\n";

			$i=0;
			while ($i < $number) {
				$row = pg_fetch_array($result, $i, PGSQL_ASSOC);
				print "<TD>$row[username]</TD><TD><A href=\"mailto:$row[email]\">$row[email]</A></TD><TD>$row[groupname]</TD><TD><A href=\"$PHP_SELF?action=edituser&id=$row[id]\">edit</A></TD><TD><A href=\"$PHP_SELF?action=removeuser&id=$row[id]\">delete</A></TD></TR>\n";
				$i++;
			}

			print "</TABLE>\n";
	}

	CloseContent();

	include ("footer.inc.php");
?>
