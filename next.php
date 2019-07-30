<!DOCTYPE html>
<html>
    <head>        
        <?php
            require_once('include/nextver.inc.php');
        ?>
        <title>Simple DirectMedia Layer - Next release's TODO list!</title>
        <?php require_once("include/meta.inc.php"); ?><?php $current_page = basename(__FILE__, '.php'); ?>
    </head>
    <body>        
        <div id="wrapper">
            <?php require_once("include/header.inc.php"); ?>
            <div id="left">
                <?php require_once("include/sidebar.inc.php"); ?>
            </div>
            <div id="content">
                <h1>SDL <?php print($sdl_next_version); ?> release schedule</h1>
                    <p>
                        The next release of SDL is
                        <strong><?php print($next_sdl_version) ?></strong>.
                    </p>

                    <p>
                        Our personal deadline for the release is:
                    </p>

                    <p>
                        <h1><strong><div id="countdown"/></div></strong></h1>
                    </p>

                    <p>
                        Please help us meet this goal by testing or fixing
                        issues on the <a href="todo.php"><?php print($next_sdl_version) ?> TODO list</a>!
                    </p>
            </div>
            <div class="clearer"></div>            
        </div>

        <!-- this code was originally from https://www.w3schools.com/howto/howto_js_countdown.asp -->
        <script type="application/javascript">
            var duedate = "<?php print($next_sdl_version_duedate) ?>";
            var countDownDate = new Date(duedate).getTime();

            // Update the count down every 1 second
            var countdown_function = function() {
                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="countdown"
                var elem = document.getElementById("countdown");
                if (distance < 0) {
                    distance = now - countDownDate;
                    days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    elem.innerHTML = "<font color='#FF0000'>PAST DUE BY " + days + " days, " + hours + " hours, " + minutes + " minutes, and " + seconds + " seconds!</font>";
                } else {
                    elem.innerHTML = days + " days, " + hours + " hours, " + minutes + " minutes, and " + seconds + " seconds!";
                }
            }
            setInterval(countdown_function, 1000);
        </script>

        <?php require_once("include/footer.inc.php"); ?>      
    </body>
</html>

