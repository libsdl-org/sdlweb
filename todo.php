<!DOCTYPE html>
<html>
    <head>        
        <?php
            require_once('include/nextver.inc.php');
            // This URL should always work, assuming you've created the appropriate "target-X.Y.Z" keywork in Bugzilla and tagged some bugs with it.
            $url = "https://bugzilla.libsdl.org/buglist.cgi?bug_status=UNCONFIRMED&bug_status=NEW&bug_status=WAITING&bug_status=RESPONDED&bug_status=ASSIGNED&bug_status=REOPENED&keywords=target-$next_sdl_version&keywords_type=allwords&known_name=$next_sdl_version%20TODO&order=Bug%20Number&query_format=advanced";
        ?>
        <title>Simple DirectMedia Layer - Next release's TODO list!</title>
        <meta http-equiv="Refresh" content="0; url=<?php print($url)?>">
        <?php require_once("include/meta.inc.php"); ?><?php $current_page = basename(__FILE__, '.php'); ?>
    </head>
    <body>        
        <div id="wrapper">
            <?php require_once("include/header.inc.php"); ?>
            <div id="left">
                <?php require_once("include/sidebar.inc.php"); ?>
            </div>
            <div id="content">
                <h1>SDL <?php print($sdl_next_version); ?> TODO list</h1>
                    <p>
                        The next release of SDL is
                        <strong><?php print($next_sdl_version) ?>.</strong>
                    </p>

                    <p>
                        We are redirecting you to the TODO buglist for this
                        version now. If you aren't sent there automtically,
                        you can click <a href="<?php print($url); ?>">here</a>
                        instead.
                    </p>
            </div>
            <div class="clearer"></div>            
        </div>
        <?php require_once("include/footer.inc.php"); ?>      
    </body>
</html>

