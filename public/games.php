<?PHP
	include ("../include/login.inc");
	include ("header.inc");

	$projecttype = 1;
	$projecttypetextpc = "Games";	// endings: p = plural / s = singular / c = capitalized
	$projecttypetextp = "games";
	$projecttypetextsc = "Game";
	$projecttypetexts = "game";

	BeginContent($projecttypetextpc);
	include ("../include/projects.inc");
	CloseContent();

	include ("footer.inc");
?>
