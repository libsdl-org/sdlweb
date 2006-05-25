<?PHP
	include ("../include/login.inc.php");
	include ("header.inc.php");

	define(PROJECTTYPE, 1);
	define(PROJECTTYPETEXTPC, "Games");	// endings: p = plural / s = singular / c = capitalized
	define(PROJECTTYPETEXTP, "games");
	define(PROJECTTYPETEXTSC, "Game");
	define(PROJECTTYPETEXTS, "game");

	BeginContent(PROJECTTYPETEXTPC);
	include ("../include/projects.inc.php");
	CloseContent();

	include ("footer.inc.php");
?>
