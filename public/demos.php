<?PHP
	include ("../include/login.inc");
	include ("header.inc");

	$projecttype = 2;
	$projecttypetextpc = "Demos";	// endings: p = plural / s = singular / c = capitalized
	$projecttypetextp = "demos";
	$projecttypetextsc = "Demo";
	$projecttypetexts = "demo";

	BeginContent($projecttypetextpc);
	include ("../include/projects.inc");
	CloseContent();

	include ("footer.inc");
?>
