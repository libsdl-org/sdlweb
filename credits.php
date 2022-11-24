<!DOCTYPE html>
<html>
    <head>        
        <title>Simple DirectMedia Layer - Credits</title>
        <?php require_once("include/meta.inc.php"); ?><?php $current_page = basename(__FILE__, '.php'); ?>
    </head>
    <body>        
        <div id="wrapper">
            <?php require_once("include/header.inc.php"); ?>
            <div id="left">
                <?php require_once("include/sidebar.inc.php"); ?>
            </div>
            <div id="content">
                <h1>SDL Credits</h1>
                    <p>
                        It's impossible to list the hundreds of people who have contributed
                        directly and indirectly to the Simple DirectMedia Layer project.
                        Many thanks to everybody who has contributed over the years... you guys rock!
                    </p>

                    <p>
                        <strong>Special thanks go out to:</strong>
                    </p>
                <div class="col left">

                    <ul>
                        <li>Cliff Matthews, for giving me a reason to start this project. :)
                        </li>
                        <li>Ryan Gordon for helping everybody out and keeping the dream alive. :)
                        </li>
                        <li>Gabriel Jacobo for his work on the Android port and generally helping out all around.
                        </li>
                        <li>Philipp Wiesemann for his attention to detail reviewing the entire SDL code base and proposes patches.
                        </li>
                        <li>Andreas Schiffler for his dedication to unit tests, Visual Studio projects, and managing the Google Summer of Code.
                        </li>
                        <li>Mike Sartain for incorporating SDL into Team Fortress 2 and cheering me on at Valve.
                        </li>
                        <li>Alfred Reynolds for the game controller API and general (in)sanity.
                        </li>
                        <li>Jørgen Tjernø for numerous magical macOS fixes.
                        </li>
                        <li>Pierre-Loup Griffais for his deep knowledge of OpenGL drivers.
                        </li>
                    </ul>
                </div>   

                <div class="col right">
                    <ul>
                        <li><a href="http://julianwinter.de">Julian Winter</a> for the SDL 2.0 website.
                        </li>
                        <li>Sheena Smith for many months of great work on the SDL wiki creating the API documentation and style guides.
                        </li>
                        <li>Paul Hunkin for his port of SDL to Android during the Google Summer of Code 2010.
                        </li>
                        <li>Eli Gottlieb for his work on shaped windows during the Google Summer of Code 2010.
                        </li>
                        <li>Jim Grandpre for his work on multi-touch and gesture recognition during the Google Summer of Code 2010.
                        </li>
                        <li>Edgar "bobbens" Simo for his force feedback API development during the Google Summer of Code 2008.
                        </li>
                        <li>Aaron Wishnick for his work on audio resampling and pitch shifting during the Google Summer of Code 2008.
                        </li>
                        <li>Holmes Futrell for port of SDL to the iPhone and iPod Touch during the Google Summer of Code 2008.
                        </li>
                        <li>Jon Atkins for SDL_image, SDL_mixer and SDL_net documentation.
                        </li>
                        <li>Everybody at Loki Software, Inc. for their great contributions!
                        </li>
                    </ul>
                </div>
            </div>
            <div class="clearer"></div>            
        </div>
        <?php require_once("include/footer.inc.php"); ?>      
    </body>
</html>
