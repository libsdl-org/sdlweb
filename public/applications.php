<?PHP
	include ("../include/login.inc.php");
	include ("header.inc.php");

	define(PROJECTTYPE, 3);
	define(PROJECTTYPETEXTPC, "Applications");	// endings: p = plural / s = singular / c = capitalized
	define(PROJECTTYPETEXTP, "applications");
	define(PROJECTTYPETEXTSC, "Application");
	define(PROJECTTYPETEXTS, "application");

	BeginContent(PROJECTTYPETEXTPC);
	include ("../include/projects.inc.php");
	CloseContent();

	include ("footer.inc.php");
?>
