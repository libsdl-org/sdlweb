<?PHP
	include ("../include/login.inc");
	include ("header.inc");

	$projecttype = 3;
	$projecttypetextpc = "Applications";	// endings: p = plural / s = singular / c = capitalized
	$projecttypetextp = "applications";
	$projecttypetextsc = "Application";
	$projecttypetexts = "application";

	BeginContent($projecttypetextpc);
	include ("../include/projects.inc");
	CloseContent();

	include ("footer.inc");
?>
