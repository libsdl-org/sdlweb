<?PHP
	include ("../include/login.inc.php");
	include ("header.inc.php");

	$projecttype = 3;
	$projecttypetextpc = "Applications";	// endings: p = plural / s = singular / c = capitalized
	$projecttypetextp = "applications";
	$projecttypetextsc = "Application";
	$projecttypetexts = "application";

	BeginContent($projecttypetextpc);
	include ("../include/projects.inc.php");
	CloseContent();

	include ("footer.inc.php");
?>
