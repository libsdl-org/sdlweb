<?PHP
 include ("../include/login.inc.php");
 include ($header_filename);
?>
<h1>SDL source snapshots</h1>

<p>
The latest development version of SDL is available via Mercurial.
Mercurial ("hg") allows you to get up-to-the-minute fixes and enhancements;
as a developer works on a source tree, you can use hg to mirror that
source tree instead of waiting for an official release. Please look
at the <a href="http://mercurial.selenic.com/">Mercurial website</a> for more
information on using hg, where you can also download software for
Mac OS X, Windows, and Unix systems.
</p>

<p>
SDL 1.2:
<blockquote>
<pre>
hg clone -u SDL-1.2 http://hg.libsdl.org/SDL SDL-1.2
</pre>
</blockquote>
</p>

<p>
SDL 1.3 (<b>WARNING: UNDER CONSTRUCTION</b>):
<blockquote>
<pre>
hg clone http://hg.libsdl.org/SDL
</pre>
</blockquote>
</p>

<p>
If you are building SDL with an IDE, you will need to copy the file
include/SDL_config.h.default to include/SDL_config.h before building.
</p>

<p>
If you are building SDL via configure, you will need to run autogen.sh
before running configure.
</p>

<p>
There is a web interface to the Mercurial repository at:<br>
<a href="http://hg.libsdl.org/">http://hg.libsdl.org/</a>
</p>

<hr>

<p><font color="#414141">
Source snapshot for SDL 1.2 (Updated
Thu Nov  6
)</p>
<blockquote>
<a href="tmp/SDL-1.2.tar.gz">SDL-1.2.tar.gz</a><br/>
<a href="tmp/SDL-1.2.zip">SDL-1.2.zip</a>
</blockquote>

<p><font color="#414141">
Source snapshot for SDL 1.3 (Updated
Mon Nov 24
)</p>
<b>WARNING: UNDER CONSTRUCTION</b>
<blockquote>
<a href="tmp/SDL-1.3.tar.gz">SDL-1.3.tar.gz</a><br/>
<a href="tmp/SDL-1.3.zip">SDL-1.3.zip</a>
</blockquote>

<strong>Note: These are not official releases and may be unstable!</strong>

<hr>

<?PHP
 include ("footer.inc.php");
?>
