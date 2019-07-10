<!DOCTYPE html>
<html>
    <head>        
        <title>Simple DirectMedia Layer - Mailing Lists</title>
        <?php require_once("include/meta.inc.php"); ?><?php $current_page = basename(__FILE__, '.php'); ?>
    </head>
    <body>        
        <div id="wrapper">
            <?php require_once("include/header.inc.php"); ?>
            <div id="left">
                <?php require_once("include/sidebar.inc.php"); ?>
            </div>
            <div id="content">
                <h1>SDL Mailing Lists</h1>
                <div class="col left">

                    <p><strong>
                            Announcement Mailing List:
                        </strong>
                        <br />
                        This mailing list is very low volume, and is used for announcing news and
                        new versions of SDL:
                        <br />
                        <a href="http://www.libsdl.org/announce-list.php">
                            http://www.libsdl.org/announce-list.php</a>
                        <br />
                    </p>

                    <p><strong>
                            Development Discussion:
                        </strong>
                        <br />
                        This is a discussion forum for SDL development and issues related to SDL:
                        <br />
                        <a href="https://discourse.libsdl.org/c/sdl-development">
                            https://discourse.libsdl.org/c/sdl-development</a>
                        <br />
                    </p>

                    <p><strong>
                            Documentation Mailing List:
                        </strong>
                        <br />
                        This is a low volume list for discussing the SDL documentation.  It is used for requesting access to contribute, reporting errata, sharing documentation tips, etc.
                        <br />
                        <a href="http://lists.libsdl.org/listinfo.cgi/docs-libsdl.org">
                            http://lists.libsdl.org/listinfo.cgi/docs-libsdl.org</a>

                    </p>
                </div><div class="col right">
                    <p><strong>
                            Commits Mailing List:
                        </strong>
                        <br />
                        This is a moderated list where changes posted to the revision control repository are sent:
                        <br />
                        <a href="http://lists.libsdl.org/listinfo.cgi/commits-libsdl.org">
                            http://lists.libsdl.org/listinfo.cgi/commits-libsdl.org</a>
                        <br />
                    </p>
                </div>   
            </div>
            <div class="clearer"></div>            
        </div>
        <?php require_once("include/footer.inc.php"); ?> 

    </body>
</html>
