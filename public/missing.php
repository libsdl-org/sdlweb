<?PHP
 header("Status: 404");
 include ("../include/login.inc.php");
 include ($header_filename);
?>
<h1>Missing Page</h1>
<p>
The page you were looking for couldn't be found.  Did you look on the navigation bar on the left?
</p>
<?PHP
 include ("footer.inc.php");
?>
