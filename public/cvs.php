<?PHP
 include ("../include/login.inc.php");
 include ($header_filename);
?>
<h1><font color="#414141"><strong>
SDL CVS snapshots
</strong></font></h1>

<p>
<strong>Warning: This code is unstable and may be broken at any time</strong>
<br>This code is for testing only - DO NOT REDISTRIBUTE!
</p>
<hr>

<a name="SDL_1_2_0"></a>
<p>
Getting and building SDL 1.2.0 via
<a href="http://en.wikipedia.org/wiki/Concurrent_Versions_System">CVS</a>:
</p>
<blockquote>
<pre>cvs -d :pserver:guest@libsdl.org:/home/sdlweb/libsdl.org/cvs login
# Hit &lt;return&gt; when prompted for a password
cvs -z3 -d :pserver:guest@libsdl.org:/home/sdlweb/libsdl.org/cvs checkout SDL12
cd SDL12; ./autogen.sh; ./configure; make; make install
# periodically run "make distclean; cvs -z3 update -d"
</pre>
</blockquote>
<p>
You can also browse the CVS repository online at:
<br>
<a href="http://www.libsdl.org/cgi/cvsweb.cgi"
        >http://www.libsdl.org/cgi/cvsweb.cgi</a>
</p>

<hr>

<blockquote>
  <p><font color="#414141"><strong>
    Source snapshot for SDL 1.2 (Updated
Sat Apr 22
  )</p>
 <a href="cvs/SDL-1.2.tar.gz">SDL-1.2.tar.gz</a><br/>
 <a href="cvs/SDL-1.2.zip">SDL-1.2.zip</a>
</blockquote>
<hr>
<?PHP
 include ("footer.inc.php");
?>
