<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>

<HEAD>
<TITLE>Simple DirectMedia Layer</TITLE>
<META content="text/html; charset=iso-8859-1" http-equiv=Content-Type>
<META content="handmade PHP code" name=GENERATOR>
<STYLE type="text/css">
<!--
INPUT, TEXTAREA { font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif; }
-->
</STYLE>
</HEAD>

<body topmargin="0" leftmargin="0" bottommargin="0" rightmargin="0">

<!-- Title -->
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
	<td background="/images/titlebg.png" colspan="2"><a href="/index.php" border="0"><img src="/images/title.png" alt="SDL" border="0"></td>
	<td background="/images/titlebg.png" rowspan="2" valign="bottom">

	<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
	<FORM method="post" action="/search.php">
		<td><img src="/images/searchbarleft.png"></td>
		<td valign="middle" background="/images/searchbarbg.png"><INPUT type="text" name="keywords" size="12"></td>
		<td><INPUT type="image" value="Search Site" src="/images/go.png"></td>
	</form>
	</tr>
	</table>

	</td>
</tr>
<!-- End Title -->

<!-- Top Bar -->
<tr>
	<td background="/images/topbarbg.png" width="100%"><a href="http://www.libsdl.de/" border="0"><img src="/images/germanbutton.png" border="0"></a></td>
	<td background="/images/topbarbg.png" align="right"><img src="/images/searchsite.png" alt="Search:"></td>
</tr>
</table>
<!-- End Top Bar -->

<!-- Main -->
<table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#B0D7FA">
<tr>

	<!-- Side Bar-->
	<td background="/images/barbg.png" valign="top">
	<font face="Verdana" size="2"><b>

	<!-- Main -->
	<img src="/images/main.png"><br>
	<img src="/images/bullet.png"><a href="/index.php">About</a><br>
	<img src="/images/bullet.png"><a href="/news.php">News</a><br>
	<img src="/images/bullet.png"><a href="/license.php">Licensing</a><br>
	<img src="/images/bullet.png"><a href="http://www.cafepress.com/libsdl">Merchandise</a><br>
	<img src="/images/bullet.png"><a href="/credits.php">Credits</a><br>
	<img src="/images/bullet.png"><a href="mailto:slouken@libsdl.org">Feedback</a><br>
	<br>
	<!-- End Main -->

	<!-- Documentation -->
	<img src="/images/documentation.png"><br>
	<img src="/images/bullet.png"><a href="/docs.php">Downloadable</a><br>
	<img src="/images/bullet.png"><a href="/intro.php">Introduction</a><br>
	<img src="/images/bullet.png"><a href="/tutorials.php">Tutorials</a><br>
	<img src="/images/bullet.png"><a href="/articles.php">Articles</a><br>
	<img src="/images/bullet.png"><a href="/books.php">Books</a><br>
	<img src="/images/bullet.png"><a href="http://sdldoc.csn.ul.ie/">Doc Project</a><br>
	<img src="/images/bullet.png"><a href="/faq.php">FAQs</a><br>
	<img src="/images/bullet.png"><a href="/opengl/index.php">OpenGL</a><br>
	<img src="/images/bullet.png"><a href="/mailing-list.php">Mailing Lists</a><br>
	<img src="/images/bullet.png"><a href="http://news.gmane.org/thread.php?group=gmane.comp.lib.sdl">Newsgroup</a><br>
	<br>
	<!-- End Documentation -->

	<!-- Download -->
	<img src="/images/download.png" alt="Download"><br>
	<img src="/images/bullet.png"><a href="/download-1.0.php">SDL 1.0</a><br>
	<img src="/images/bullet.png"><a href="/download-1.2.php">SDL 1.2</a><br>
	<img src="/images/bullet.png"><a href="/cvs.php">SDL CVS</a><br>
	<img src="/images/bullet.png"><a href="/games.php">Games</a><br>
	<img src="/images/bullet.png"><a href="/demos.php">Demos</a><br>
	<img src="/images/bullet.png"><a href="/applications.php">Applications</a><br>
	<img src="/images/bullet.png"><a href="/libraries.php">Libraries</a><br>
	<img src="/images/bullet.png"><a href="/languages.php">Languages</a><br>
	<img src="/images/bullet.png"><a href="http://www.libsdl.de/logo/">Logos</a><br>
	<br>
	<!-- End Download -->

	<!-- Site Actions -->
	<img src="/images/siteactions.png" alt="Site Actions"><br>
<?PHP
	if ($userid==0) { 	// not logged in yet -- getting user login & pass 
		print "<img src=\"/images/bullet.png\"><a href=\"/index.php?action=showloginform\">Login</a><br>";
		print "<img src=\"/images/bullet.png\"><a href=\"/users.php?action=createuser\">New Account</a><br>";
	} else {
		print "<img src=\"/images/bullet.png\">Login: <I>$userlogin</I><br>";
		print "<img src=\"/images/bullet.png\"><a href=\"/users.php?action=edituser&id=$userid\">Edit Account</a><br>";
		if ($userprivileges[manageoses])
			print "<img src=\"/images/bullet.png\"><a href=\"/oses.php\">Manage OSes</a><br>";
		if ($userprivileges[manageusers])
			print "<img src=\"/images/bullet.png\"><a href=\"/users.php\">Manage Users</a><br>";
		if ($userprivileges[managegroups])
			print "<img src=\"/images/bullet.png\"><a href=\"/groups.php\">Manage Groups</a><br>";
		print "<img src=\"/images/bullet.png\"><a href=\"/index.php?action=logout\">Logout</a><br>";
	}
?>
	<br>
	<!-- End Site Actions -->

	<!-- Other -->
	<img src="/images/other.png" alt="Other"><br>
	<img src="/images/bullet.png"><a href="/finances.php">SDL Finances</a><p>
	<br>
	<!-- End Other -->

	</b></font>
	</td>
	<!-- End Side Bar -->

	<!-- Body -->
	<td width="100%" valign="top">

	<!-- Body Table -->
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>

		<!-- Left Body -->
		<td width="80%">
			<table cellpadding="16" cellspacing="0">
			<tr>
				<td>
