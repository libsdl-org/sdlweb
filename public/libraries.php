<?PHP
	include ("../include/login.inc");
	include ("header.inc");

	$projecttype = 4;
	$projecttypetextpc = "Libraries";	// endings: p = plural / s = singular / c = capitalized
	$projecttypetextp = "libraries";
	$projecttypetextsc = "Library";
	$projecttypetexts = "library";

	BeginContent($projecttypetextpc);
	include ("../include/projects.inc");
	CloseContent();

	include ("footer.inc");
?>
