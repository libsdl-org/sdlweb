<!DOCTYPE html>
<html>
    <head>        
        <title>Simple DirectMedia Layer<?php /* - TITLE */ ?></title>
        <?php require_once("include/meta.inc.php"); ?><?php $current_page = basename(__FILE__, '.php'); ?>
    </head>
    <body>        
        <div id="wrapper">
            <?php require_once("include/header.inc.php"); ?>
            <div id="left">
                <?php require_once("include/sidebar.inc.php"); ?>
            </div>
            <div id="content">
<h1>SDL Announcement List</h1>

This mailing list is very low volume, and is used for announcing news and
new versions of SDL:
<br>
<!-- Details found here:
     http://wiki.dreamhost.com/index.php/KB_/_Web_Programming_/_CGI%2C_PHP_%26_Databases_/_Announcement_Mailing_List
-->
<form method="post" action="http://scripts.dreamhost.com/add_list.cgi">
<input type="hidden" name="list" value="sdl-announce" />
<input type="hidden" name="domain" value="libsdl.org" />
<input type="hidden" name="url" value="" /> 
<input type="hidden" name="unsuburl" value="" />
<input type="hidden" name="alreadyonurl" value="" />
<input type="hidden" name="notonurl" value="" />
<input type="hidden" name="invalidurl" value="" />
<input type="hidden" name="emailconfirmurl" value="" />
Name: <input name="name" /> E-mail: <input name="email" /><p />
<input type="submit" name="submit" value="Join!" />
<input type="submit" name="unsub" value="Unsubscribe" />
</form>
            <div class="clearer"></div>            
        </div>
        <?php require_once("include/footer.inc.php"); ?> 

    </body>
</html>
