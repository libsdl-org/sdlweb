<!DOCTYPE html>
<html>
    <head>        
        <title>Simple DirectMedia Layer - News</title>
        <?php require_once("include/meta.inc.php"); ?><?php $current_page = basename(__FILE__, '.php'); ?>
    </head>
    <body>        
        <div id="wrapper">
            <?php require_once("include/header.inc.php"); ?>
            <div id="left">
                <?php require_once("include/sidebar.inc.php"); ?>
            </div>
            <div id="content">
                <h1>News</h1>
                    
               <?php for ($i = 0; $i < 10; $i++): ?>
                       
                <div class="news<?php if ($i % 2 == 0) echo " even"; ?>">
                    <span class="date">June 10, 2013 - 13</span>
                    <strong><a href="#">"TetriStory 2 100% A.I."</a></strong><br />
                    Open-source cross-platform multi-player Tetris using SDL 1.2 & OpenGL, has been added to the games page.
                </div>
                
                <?php endfor; ?>
                <p class="navigation">     

                    <a class="active" href="games.php?&amp;page=0">
                        1
                    </a>

                    <a href="games.php?&amp;page=1">
                        2
                    </a>

                    <a href="games.php?&amp;page=2">
                        3
                    </a>

                    <a href="games.php?&amp;page=3">
                        4
                    </a>

                    <a href="games.php?&amp;page=4">
                        5
                    </a>

                    <a href="games.php?&amp;page=5">
                        6
                    </a>

                    <a href="games.php?&amp;page=6">
                        7
                    </a>

                    <a href="games.php?&amp;page=7">
                        8
                    </a>

                    <a href="games.php?&amp;page=8">
                        9
                    </a>

                    <a href="games.php?&amp;page=9">
                        10
                    </a>

                    <a href="games.php?&amp;page=10">
                        11
                    </a>

                    <a href="games.php?&amp;page=11">
                        12
                    </a>

                    <a href="games.php?&amp;page=12">
                        13
                    </a>

                    <a href="games.php?&amp;page=13">
                        14
                    </a>

                    <a href="games.php?&amp;page=14">
                        15
                    </a>

                    <a href="games.php?&amp;page=1">
                        »
                    </a> 

                </p>
            </div>
            <div class="clearer"></div>            
        </div>
        <?php require_once("include/footer.inc.php"); ?> 

    </body>
</html>