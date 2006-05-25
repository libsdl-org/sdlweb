<?PHP
	include ("../include/login.inc.php");
	include ("header.inc.php");

	define(PROJECTTYPE, 4);
	define(PROJECTTYPETEXTPC, "Libraries");	// endings: p = plural / s = singular / c = capitalized
	define(PROJECTTYPETEXTP, "libraries");
	define(PROJECTTYPETEXTSC, "Library");
	define(PROJECTTYPETEXTS, "library");

	BeginContent(PROJECTTYPETEXTPC);
	include ("../include/projects.inc.php");
	CloseContent();

	include ("footer.inc.php");
?>
