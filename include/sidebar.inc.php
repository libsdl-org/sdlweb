<a href="/index.php" title="to homepage" id="logo"><img src="/media/SDL_logo.png" alt="SDL Logo" /></a>
<div class="box gray">
    <h4>Main</h4>
    <ul>
        <li<?php if($current_page=="index") echo" class=\"active\"";?>><a href="/index.php">About</a></li>
        <li><a href="http://bugzilla.libsdl.org/">Bugs <span class="extern">&nbsp;</span></a></li>
        <li<?php if($current_page=="license") echo" class=\"active\"";?>><a href="/license.php">Licensing</a></li>
        <li<?php if($current_page=="credits") echo" class=\"active\"";?>><a href="/credits.php">Credits</a></li>
        <li><a href="mailto:slouken@libsdl.org">Feedback</a></li>
    </ul>
</div>
<div class="box lightblue">
    <h4>Documentation</h4>
    <ul class="menu">
        <li><a href="http://wiki.libsdl.org/FrontPage">Wiki <span class="extern">&nbsp;</span></a></li>
        <li><a href="http://discourse.libsdl.org/">Forums <span class="extern">&nbsp;</span></a></li>
        <li<?php if($current_page=="mailing-list") echo" class=\"active\"";?>><a href="/mailing-list.php">Mailing Lists</a></li>
    </ul>
</div>
<div class="box blue">
    <h4>Download</h4>
    <ul class="menu">
        <li<?php if($current_page=="download-2.0") echo" class=\"active\"";?>><a href="https://github.com/libsdl-org/SDL/releases/latest">SDL Releases</a></li>
        <!--<li<?php if($current_page=="download-1.2") echo" class=\"active\"";?>><a href="/download-1.2.php">SDL 1.2</a></li>-->
        <li<?php if($current_page=="git") echo" class=\"active\"";?>><a href="https://github.com/libsdl-org/">SDL GitHub</a></li>
        <li<?php if($current_page=="languages") echo" class=\"active\"";?>><a href="/languages.php">Language Bindings</a></li>
    </ul>
</div>
