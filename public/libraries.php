<?PHP
	include ("../include/login.inc.php");
	include ("header.inc.php");

	$projecttype = 4;
	$projecttypetextpc = "Libraries";	// endings: p = plural / s = singular / c = capitalized
	$projecttypetextp = "libraries";
	$projecttypetextsc = "Library";
	$projecttypetexts = "library";

	BeginContent($projecttypetextpc);
	include ("../include/projects.inc.php");
	CloseContent();

	include ("footer.inc.php");
?>
