<!DOCTYPE html>
<html>
    <head>        
        <title>Simple DirectMedia Layer - Login</title>
        <?php require_once("include/meta.inc.php"); ?><?php $current_page = basename(__FILE__, '.php'); ?>
    </head>
    <body>        
        <div id="wrapper">
            <?php require_once("include/header.inc.php"); ?>
            <div id="left">
                <?php require_once("include/sidebar.inc.php"); ?>
            </div>
            <div id="content">
                <h1>Login</h1>
                <div class="col left">

                    <form action="login.php?action=login" method="post">
                        <p>Login<br><input type="text" maxlength="20" size="16" name="userlogin" /></p>
                        <p>Password<br><input type="password" maxlength="50" size="16" name="userpassword" /></p>
                        <p><input type="checkbox" value="yes" name="userpersist" />remember me</p>
                        <input type="submit" value="login">
                    </form>
                    <a href="/index.php?action=showresetform">Recover Password</a><br>
                    <a href="users.php?action=createuser">Create new Account</a>

                </div>                
            </div>
            <div class="clearer"></div>            
        </div>
        <?php require_once("include/footer.inc.php"); ?> 

    </body>
</html>