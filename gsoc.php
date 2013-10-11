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
                <h1>
SDL Google Summer of Code 2013
                </h1>
                
SDL gains meta-build and visual-test capabilities from Google Summer of Code 2013 
</p>
<p>
After a break in 2012, SDL was a member organization in Google Summer of Code again in 2013. The proposed GSoC projects were guided by the statement: ''With the SDL 2.0 ABI freeze in place, the general theme this year is creating a top quality SDL 2.0 release!'' Early in the year, the call attracted several students who wanted to hone their coding skills on several proposed ideas related to our favorite open source multimedia library.
</p>
<p>
The SDL maintainers, GSoC org admin and potential GSoC mentors selected Apoorv Upreti and Ben Henning to work on two projects.
</p>
<p>
Project Idea #1 <em>Interactive and Visual Test Automation for SDL 2.0</em> was geared to further improve the test coverage of SDL by adding a new harness that could perform graphics-level testing against SDL-based applications such as testsprite2. This project was mentored by Andreas Schiffler.
</p>
<p>
Project Idea #2 <em>Multi-platform meta-build system for SDL 2.0</em> was designed to alleviate the chore of having to create and maintain the many cross-platform build artifacts present in SDL by creating a simple, programmatic meta-build system. This project was mentored by Gabriel Jacobo.
</p>
<p>
The first of SDL's 2013 GSOC projects was a visual test harness that enables validation of a final SDL application at the graphical level build by Apoorv Upreti. Sam asked for this after running into some interesting event-behavior bugs in the lead up to the SDL 2.0 release. We had the plan to create a new test harness that can launch an SDL application process using any number of parameters, control it via actions such mouse events, and verify the state and output visually through screenshots. The work was broken down into 5 themes that build on each other: Design and Core Infrastructure, Variation of SUT Command-line Options, Action Based Testing and Core Test, User Interaction Actions, Screenshot Analysis and Visual Oracle. Using a mini-Scrum process, we broke these themes further down into over 20 user stories such as "As a SDL tester, I want to be able to run the harness so that it tries all possible SUT options." which themselves were split into individual coding tasks. Needless to say, to build such a system is a tall order - regardless of process. Apoorv got through most of it and produced a well documented and usable new harness that can - for example - launch "testsprite2" with all possible command-line variations to check for crashes, or validate the rendering system for a set of blend modes against manually verified "gold standard" images. Unfortunately, the project did run out of time at the Google mandated "pencil's down" date and some features, including the interactive mouse and keyboard actions, were not fully completed yet. However, since a solid foundation was build by Apoorv, these additions should be easy to make by him or the community over time.
</p>
<p>
Apoorv's code (soon to be merged into mainline SDL) can be found here:
<br/>
<a href="https://www.dropbox.com/s/izkv9mdh22u6pgi/Apoorv_Upreti.tar.gz">https://www.dropbox.com/s/izkv9mdh22u6pgi/Apoorv_Upreti.tar.gz</a>
<br/>
Apoorv's final blog post has some details on usage:
<br/>
<a href="http://blog.apoorv.me/gsoc-2013-finishing-up.html">http://blog.apoorv.me/gsoc-2013-finishing-up.html</a>
</p>
<p>
The second of SDL's 2013 GSOC projects was a build system developed by Ben Henning using premake.
</p>
<p>
The necessity for this comes from the fact that SDL provides a hand crafted selection of Visual Studio Solutions and XCode project files, which are used both by SDL devs to build binary releases and by users wishing to compile the library on their own. On top of this, SDL supports the traditional *nix method of configure && make, and even a CMake based solution. In the interest of reducing maintenance tasks related to this wide variety of build systems (a typical single file addition to SDL's code base would imply editing perhaps a dozen or more files), we wanted to develop a build system that could take a minimal number of configuration files, and based on them build as many of the aforementioned solutions and projects automatically. Thanks to Ben, we now have such a system, based on a slightly tweaked premake 5 system. While we set out to replace just our Visual Studio and XCode projects, we ended up with a few extra bonuses, such as iOS projects generation, some preliminary Linux support, etc.
</p>
<p>
Ben's code (also soon to be merged into mainline SDL) can be found here:
<br/>
<a href="https://www.dropbox.com/s/gpaeiayrz2p7hpn/GSoC2013.SDL2.metabuild.project.gz">https://www.dropbox.com/s/gpaeiayrz2p7hpn/GSoC2013.SDL2.metabuild.project.gz</a>
<br/>
Ben's blog, where he gives insight on the GSOC experience as well as technical details on the project, is at:
<br/>
<a href="http://gsocben.blogspot.com/2013/09/end-of-google-summer-of-code-project.html">http://gsocben.blogspot.com/2013/09/end-of-google-summer-of-code-project.html</a>
</p>
<p>
Thanks goes out to all the students who applied for SDL's GSoC projects, Ben and Apoorv for participating in GSoC 2013 this year, Andreas and Gabriel for mentoring, Sam and Ryan for the support, and Google for their support of open source software in this way.
</p>
<p>
Now its time for the SDL community to take over. Happy testing and building!
</p>
                 </div>
            <div class="clearer"></div>            
        </div>
        <?php require_once("include/footer.inc.php"); ?> 

    </body>
</html>
