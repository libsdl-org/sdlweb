<?PHP
 include ("../include/login.inc.php");
 include ($header_filename);
?>
<h1><font color="#414141"><strong>
SDL source snapshots
</strong></font></h1>

<p>
The latest development version of SDL is available via Subversion.
Subversion allows you to get up-to-the-minute fixes and enhancements;
as a developer works on a source tree, you can use svn to mirror that
source tree instead of waiting for an official release. Please look
at the Subversion website ( http://subversion.tigris.org/ ) for more
information on using svn, where you can also download software for
MacOS, Windows, and Unix systems.
</p>
<p>
<blockquote>
<pre>
svn checkout svn://libsdl.org/trunk/SDL
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
There is a web interface to the subversion repository at:<br>
<a href="http://www.libsdl.org/cgi/viewvc.cgi">
         http://www.libsdl.org/cgi/viewvc.cgi</a>
</p>

<hr>

<p><font color="#414141">
Source snapshot for SDL 1.2 (Updated
Thu Apr 27
)</p>
<blockquote>
<a href="tmp/SDL-1.2.tar.gz">SDL-1.2.tar.gz</a><br/>
<a href="tmp/SDL-1.2.zip">SDL-1.2.zip</a>
</blockquote>
<strong>Note: These are not official releases and may be unstable!</strong>
<hr>
<?PHP
 include ("footer.inc.php");
?>
