<?PHP
 include ("../include/login.inc.php");
 include ($header_filename);
?>
<h1><font color="#414141"><strong>
SDL source snapshots
</strong></font></h1>

<p>
<strong>Warning: This code is unstable and may be broken at any time</strong>
<br>This code is for testing only - DO NOT REDISTRIBUTE!
</p>
<hr>

<p>
Getting and building SDL via
<a href="http://subversion.tigris.org/">Subversion</a>:
</p>
<blockquote>
<pre>
svn checkout svn://libsdl.org/trunk/SDL
cd SDL; ./autogen.sh; ./configure; make; make install
# periodically run "make distclean; svn update"
</pre>
</blockquote>
<p>
You can also browse the repository online at:
<br>
<a href="http://www.libsdl.org/wsvn"
        >http://www.libsdl.org/wsvn</a>
</p>

<hr>

<blockquote>
  <p><font color="#414141"><strong>
    Source snapshot for SDL 1.2 (Updated
Wed Apr 26
  )</p>
 <a href="tmp/SDL-1.2.tar.gz">SDL-1.2.tar.gz</a><br/>
 <a href="tmp/SDL-1.2.zip">SDL-1.2.zip</a>
</blockquote>
<hr>
<?PHP
 include ("footer.inc.php");
?>
