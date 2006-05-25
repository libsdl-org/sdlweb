<?PHP
	include ("../include/login.inc.php");
	include ("header.inc.php");

	define(PROJECTTYPE, 2);
	define(PROJECTTYPETEXTPC, "Demos");	// endings: p = plural / s = singular / c = capitalized
	define(PROJECTTYPETEXTP, "demos");
	define(PROJECTTYPETEXTSC, "Demo");
	define(PROJECTTYPETEXTS, "demo");

	BeginContent(PROJECTTYPETEXTPC);
	include ("../include/projects.inc.php");
	CloseContent();

	include ("footer.inc.php");
?>
