<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
<title>Simple DirectMedia Layer</title>
<meta content="text/html; charset=iso-8859-1" http-equiv="content-type">
<link rel="stylesheet" href="sdlweb.css" type="text/css">
</head>

<body>

<!-- Title -->
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
	<td background="images/titlebg.png" colspan="2"><a href="/index.php"><img src="images/title.png" width="181" height="73" alt="SDL" border="0"></a></td>
	<td background="images/titlebg.png" rowspan="2" valign="bottom">

	<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
	<form method="post" action="/search.php">
		<td><img src="images/searchbarleft.png" alt="" width="5" height="30" ></td>
		<td valign="middle" background="images/searchbarbg.png"><input type="text" name="keywords" size="12"></td>
		<td><input type="image" value="Search Site" src="images/go.png"></td>
	</form>
	</tr>
	</table>

	</td>
</tr>
<!-- End Title -->

<!-- Top Bar -->
<tr>
	<td background="images/topbarbg.png" width="100%"><a href="http://www.libsdl.de/"><img src="images/germanbutton.png" alt="German Site" width="82" height="20"></a></td>
	<td background="images/topbarbg.png" align="right"><img src="images/searchsite.png" alt="Search Site:" width="58" height="20"></td>
</tr>
</table>
<!-- End Top Bar -->

<!-- Main -->
<table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#B0D7FA">
<tr>

	<!-- Side Bar-->
	<td background="images/barbg.png" valign="top">

	<!-- Main -->
	<img src="images/main.png" width="180" height="31" alt="Main"><br>
	<ul class="menu">
	<li><a href="/index.php">About</a></li>
	<li><a href="/news.php">News</a></li>
	<li><a href="/license.php">Licensing</a></li>
	<li><a href="http://www.cafepress.com/libsdl">Merchandise</a></li>
	<li><a href="/credits.php">Credits</a></li>
	<li><a href="mailto:slouken@libsdl.org">Feedback</a></li>
	</ul>
	<!-- End Main -->

	<!-- Documentation -->
	<img src="images/documentation.png" width="180" height="31" alt="Documentation"><br>
	<ul class="menu">
	<li><a href="/docs.php">Downloadable</a></li>
	<li><a href="/intro.php">Introduction</a></li>
	<li><a href="/tutorials.php">Tutorials</a></li>
	<li><a href="/articles.php">Articles</a></li>
	<li><a href="/books.php">Books</a></li>
	<li><a href="http://sdldoc.csn.ul.ie/">Doc Project</a></li>
	<li><a href="/faq.php">FAQs</a></li>
	<li><a href="/opengl/index.php">OpenGL</a></li>
	<li><a href="/mailing-list.php">Mailing Lists</a></li>
	<li><a href="http://news.gmane.org/thread.php?group=gmane.comp.lib.sdl">Newsgroup</a></li>
	</ul>
	<!-- End Documentation -->

	<!-- Download -->
	<img src="images/download.png" width="180" height="32" alt="Download"><br>
	<ul class="menu">
	<li><a href="/download-1.0.php">SDL 1.0</a></li>
	<li><a href="/download-1.2.php">SDL 1.2</a></li>
	<li><a href="/cvs.php">SDL CVS</a></li>
	<li><a href="/games.php">Games</a></li>
	<li><a href="/demos.php">Demos</a></li>
	<li><a href="/applications.php">Applications</a></li>
	<li><a href="/libraries.php">Libraries</a></li>
	<li><a href="/languages.php">Languages</a></li>
	<li><a href="http://www.libsdl.de/logo/">Logos</a></li>
	</ul>
	<!-- End Download -->

	<!-- Site Actions -->
	<img src="images/siteactions.png" width="180" height="32" alt="Site Actions"><br>
	<ul class="menu">
<?PHP
	if ($userid==0) { 	// not logged in yet -- getting user login & pass 
		print "<li><a href=\"/index.php?action=showloginform\">Login</a></li>";
		print "<li><a href=\"/users.php?action=createuser\">New Account</a></li>";
	} else {
		print "<li>Login: <i>$userlogin</i><br>";
		print "<li><a href=\"/users.php?action=edituser&id=$userid\">Edit Account</a></li>";
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

	<!-- Other -->
	<img src="images/other.png" width="180" height="32" alt="Other"><br>
	<ul class="menu">
	<li><a href="/finances.php">SDL Finances</a></li>
	</ul>
	<!-- End Other -->

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
