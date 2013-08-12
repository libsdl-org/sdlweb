<!DOCTYPE html>
<html>
    <head>        
        <title>Simple DirectMedia Layer - Games</title>
        <?php require_once("include/meta.inc.php"); ?><?php $current_page = basename(__FILE__, '.php'); ?>
    </head>
    <body>        
        <div id="wrapper">
            <?php require_once("include/header.inc.php"); ?>
            <div id="left">
                <?php require_once("include/sidebar.inc.php"); ?>
            </div>
            <div id="content">
                <h1>Games</h1>

                <form action="/games.php" method="get">
                    <div class="box">

                        <label class="inline" for="order">Sort by: </label>
                        <select class="inline" name="order" id="order">
                            <option value="name" selected="">name</option>
                            <option value="time">recently updated</option>
                        </select>

                        <label class="inline" for="category">Category:</label> 
                        <select class="inline" name="category" id="category">
                            <option value="-1" selected="">any</option>
                            <option value="1">Other</option><option value="5">3D Shooter</option>
                            <option value="6">Strategy</option><option value="7">Arcade</option>
                            <option value="8">Puzzle</option><option value="9">Educational</option>
                            <option value="15">RTS</option><option value="16">RPG</option>
                            <option value="17">MMORPG</option><option value="18">Vehicle Sim</option>
                        </select>

                        <label class="inline" for="completed">Completed: </label>
                        <select class="inline" name="completed" id="completed">
                            <option value="0" selected="">0%</option>
                            <option value="25">25%</option>
                            <option value="50">50%</option>
                            <option value="75">75%</option>
                            <option value="100">100%</option>
                        </select> on 
                        <select class="inline" name="os">
                            <option value="-1" selected="selected">Any OS</option>
                            <option value="13">AmigaOS</option>
                            <option value="17">Android</option>
                            <option value="3">BeOS</option>
                            <option value="9">FreeBSD</option>
                            <option value="18">iOS</option>
                            <option value="6">IRIX</option>
                            <option value="1">Linux</option>
                            <option value="4">Mac OS</option>
                            <option value="5">Mac OS X</option>
                            <option value="11">NetBSD</option>
                            <option value="10">OpenBSD</option>
                            <option value="8">QNX</option>
                            <option value="16">RISC OS</option>
                            <option value="7">Solaris</option>
                            <option value="19">webOS</option>
                            <option value="2">Windows</option>
                            <option value="14">Windows CE</option>
                        </select>

                        <label for="match_name" id="match_name" style="padding-left: 4em;">Named: </label>
                        <input type="text" size="25" value="" class="inline" name="match_name">
                        <button type="submit">Filter</button>
                    </div>
                    <div class="clearer small"></div> 
                    <div class="col left">
                        <label>Showing 1-25 out of 711 games:</label>
                    </div>
                    <div class="col right" style="text-align: right;">
                        <label for="perpage" id="perpage">Show: </label>
                        <select name="perpage"><option value="10">10</option><option value="25" selected="">25</option><option value="50">50</option><option value="100">100</option><option value="-1">all</option></select> games on one page

                        <input type="submit" value="Show"> 
                    </div>

                </form>
                <div class="clearer"></div>
                <table class="list" border="0">
                    <colgroup>
                        <col />
                        <col width="90" />
                        <col />
                        <col />
                        <col />
                        <col />
                    </colgroup>
                    <thead>
                        <tr><th colspan="1">Title &amp; description</th>
                            <th colspan="1">Contact</th>
                            <th colspan="3">OS / Status</th><th>License</th></tr>
                    </thead>
                    <tbody>

                        <?php for ($i = 0; $i < 10; $i++): ?>
                            <tr<?php if ($i % 2 == 0) echo " class=\"even\""; ?>><td>
                                    <strong><a name="2140">"TetriCrisis 4 110% A.I."</a></strong> <br />

                                    - Free open-source cross-platform multi-player Tetris game using SDL 1.2+OpenGL(R) &amp; Artificial Intelligence - 
                                    Visit site for complete source code!
                                </td>
                                <td align="center"><a href="http://16bitsoft.com/V2/TetriCrisis4.htm" title="http://16bitsoft.com/V2/TetriCrisis4.htm"><img src="media/www.png" alt="WWW" /></a><a href="mailto:JessePalser@gmail.com" title="JessePalser@GMail.com"><img src="media/mail.png" alt="mail"/></a></td>
                                <td class="center">
                                    <img width="32" height="32" src="media/platforms/macosx.png" alt=" macosx ">
                                    <img width="32" height="4" src="media/25-small.png" alt="work in progress">
                                </td>
                                <td class="center">
                                    <img width="32" height="32" src="media/platforms/linux.png" alt=" linux ">
                                    <img width="32" height="4" src="media/100-small.png" alt="fully functional">
                                </td>
                                <td class="center">
                                    <img width="32" height="32" src="media/platforms/win32.png" alt=" win32 ">
                                    <img width="32" height="4" src="media/100-small.png" alt="fully functional">
                                </td>
                                <td>GNU GPL</td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
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