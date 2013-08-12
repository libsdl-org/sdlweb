<!DOCTYPE html>
<html>
    <head>        
        <title>Simple DirectMedia Layer - Users</title>
        <?php require_once("include/meta.inc.php"); ?><?php $current_page = basename(__FILE__, '.php'); ?>
    </head>
    <body>        
        <div id="wrapper">
            <?php require_once("include/header.inc.php"); ?>
            <div id="left">
                <?php require_once("include/sidebar.inc.php"); ?>
            </div>
            <div id="content">
                <h1>Users</h1>
                <div class="col left">

                    <form action="/users.php?action=insertuser" method="post">
                        <i>All fields are required</i><br>
                        <p>Login (case sensitive)<br><input type="text" maxlength="20" size="16" value="" name="login" /></p>
                        <p>Name<br><input type="text" maxlength="64" size="50" value="" name="name" /></p>
                        <p>Email<br><input type="text" maxlength="64" size="50" value="" name="email" /></p>
                        <p><input type="submit" value="Submit" /></p>
                    </form>

                </div>                
            </div>
            <div class="clearer"></div>            
        </div>
        <?php require_once("include/footer.inc.php"); ?> 

    </body>
</html>