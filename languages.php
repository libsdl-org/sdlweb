<!DOCTYPE html>
<html>
    <head>        
        <title>Simple DirectMedia Layer - Language Bindings</title>
        <?php require_once("include/meta.inc.php"); ?><?php $current_page = basename(__FILE__, '.php'); ?>
    </head>
    <body>   
       
        <div id="wrapper">
            <?php require_once("include/header.inc.php"); ?>
            <div id="left">
                <?php require_once("include/sidebar.inc.php"); ?>
            </div>
            <div id="content"><h1>SDL 3.0 Language Bindings</h1>
                <p class="intro">
                        The Simple DirectMedia Layer library has bindings to many different
                        programming languages.  While SDL is written in C, it works well with
                        C++ and many people like to use it with various scripting languages
                        and special purpose programming languages.
                </p>
                <p>
                        SDL 2.0 language bindings are available <a href="languages-2.0.php">here</a>.
                </p>

                <div class="clearer"></div>
                <div class="col left">
                   
                    <blockquote>
                        <ul>
                            <li> <strong>
                                    Beef
                                </strong>
                                <br/>
                                SDL3-Beef -
                                <a href="https://github.com/Booklordofthedings/SDL3-Beef">https://github.com/Booklordofthedings/SDL3-Beef</a>
                            </li>
                            <li> <strong>
                                    D
                                </strong>
                                <br/>
                                BindBC-SDL -
                                <a href="https://github.com/BindBC/bindbc-sdl">https://github.com/BindBC/bindbc-sdl</a>
                            </li>
                            <li> <strong>
                                    Rust
                                </strong>
                                <br/>
                                sdl3 -
                                <a href="https://crates.io/crates/sdl3">https://crates.io/crates/sdl3</a>
                            </li>
                        </ul>
                    </blockquote>

                </div>                
            </div>
            <div class="clearer"></div>            
        </div>
        <?php require_once("include/footer.inc.php"); ?> 

    </body>
</html>
