<?PHP
 include ("../include/login.inc.php");
 include ($header_filename);
?>
<h1>SDL source snapshots</h1>

<p>
The latest development version of SDL is available via <a href="http://mercurial.selenic.com/">Mercurial</a>.
</p>
<p>
Mercurial ("hg") allows you to get up-to-the-minute fixes and enhancements;
as a developer works on a source tree, you can use hg to mirror that
source tree instead of waiting for an official release.
</p>
<p>
If you're new to Mercurial, check out the great tutorial at <a href="http://hginit.com">hginit.com</a>!
</p>

<p>
SDL 1.2:
<blockquote>
<pre>
hg clone -u SDL-1.2 http://hg.libsdl.org/SDL SDL-1.2
</pre>
</blockquote>
</p>

<blockquote>
<p>
If you are building SDL with an IDE, you will need to copy the file
include/SDL_config.h.default to include/SDL_config.h before building.
</p>

<p>
If you are building SDL via configure, you will need to run autogen.sh
before running configure.
</p>
</blockquote>

<p>
SDL 2.0 (<b>WARNING: UNDER CONSTRUCTION</b>):
<blockquote>
<pre>
hg clone http://hg.libsdl.org/SDL
</pre>
</blockquote>
</p>

<blockquote>
<p>
You can build directly from a fresh clone of SDL 2.0.
</p>
</blockquote>

<p>
There is a web interface to the Mercurial repository at:<br>
<a href="http://hg.libsdl.org/">http://hg.libsdl.org/</a>
</p>

<hr>

<p><font color="#414141">
Source snapshot for SDL 1.2 (Updated
<!-- SDL 1.2 DATE --> Fri Jan 20
)</p>
<blockquote>
<a href="tmp/SDL-1.2.tar.gz">SDL-1.2.tar.gz</a><br/>
<a href="tmp/SDL-1.2.zip">SDL-1.2.zip</a>
</blockquote>

<p><font color="#414141">
Source snapshot for SDL 2.0 (Updated
<!-- SDL 2.0 DATE --> Sun Mar 24
)</p>
<b>WARNING: UNDER CONSTRUCTION</b>
<blockquote>
<a href="tmp/SDL-2.0.tar.gz">SDL-2.0.tar.gz</a><br/>
<a href="tmp/SDL-2.0.zip">SDL-2.0.zip</a>
</blockquote>

<strong>Note: These are not official releases and may be unstable!</strong>

<hr>

<?PHP
 include ("footer.inc.php");
?>
