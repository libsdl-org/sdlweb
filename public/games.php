<?PHP
	include ("../include/login.inc.php");
	include ("header.inc.php");

	$projecttype = 1;
	$projecttypetextpc = "Games";	// endings: p = plural / s = singular / c = capitalized
	$projecttypetextp = "games";
	$projecttypetextsc = "Game";
	$projecttypetexts = "game";

	BeginContent($projecttypetextpc);
	include ("../include/projects.inc.php");
	CloseContent();

	include ("footer.inc.php");
?>
