<?PHP
	include ("../include/login.inc.php");
	include ("header.inc.php");

	$projecttype = 2;
	$projecttypetextpc = "Demos";	// endings: p = plural / s = singular / c = capitalized
	$projecttypetextp = "demos";
	$projecttypetextsc = "Demo";
	$projecttypetexts = "demo";

	BeginContent($projecttypetextpc);
	include ("../include/projects.inc.php");
	CloseContent();

	include ("footer.inc.php");
?>
