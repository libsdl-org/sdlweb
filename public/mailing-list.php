<?PHP
 include ("../include/login.inc.php");
 include ($header_filename);
?>
<h1>SDL Mailing Lists</h1>

<p><font color="#414141"><strong>
Announcement Mailing List:
</strong>
<br>
This mailing list is very low volume, and is used for announcing news and
new versions of SDL:
<br>
<!-- Details found here:
     http://wiki.dreamhost.com/index.php/KB_/_Web_Programming_/_CGI%2C_PHP_%26_Databases_/_Announcement_Mailing_List
-->
<form method="post" action="http://scripts.dreamhost.com/add_list.cgi">
<input type="hidden" name="list" value="sdl-announce" />
<input type="hidden" name="domain" value="libsdl.org" />
<input type="hidden" name="url" value="" /> 
<input type="hidden" name="unsuburl" value="" />
<input type="hidden" name="alreadyonurl" value="" />
<input type="hidden" name="notonurl" value="" />
<input type="hidden" name="invalidurl" value="" />
<input type="hidden" name="emailconfirmurl" value="" />
Name: <input name="name" /> E-mail: <input name="email" /><br />
<input type="submit" name="submit" value="Join!" />
<input type="submit" name="unsub" value="Unsubscribe" />
</form>
</font>
</p>

<p><font color="#414141"><strong>
Development Mailing List:
</strong>
<br>
This is a high volume list for discussion of SDL development and issues
related to SDL:
<br>
<a href="http://lists.libsdl.org/listinfo.cgi/sdl-libsdl.org">
         http://lists.libsdl.org/listinfo.cgi/sdl-libsdl.org</a>
<br>
Subscribing to this list automatically subscribes you to the SDL-announce list.
</font>
</p>

<p><font color="#414141"><strong>
Job Mailing List:
</strong>
<br>
This is a low volume list for employers to post job opportunities and for people who are looking for SDL work to post their resumes:
<br>
<a href="http://lists.libsdl.org/listinfo.cgi/jobs-libsdl.org">
         http://lists.libsdl.org/listinfo.cgi/jobs-libsdl.org</a>
</font>
</p>

<p><font color="#414141"><strong>
SVN Mailing List:
</strong>
<br>
This is a moderated list where subversion repository changes are sent:
<br>
<a href="http://lists.libsdl.org/listinfo.cgi/svn-libsdl.org">
         http://lists.libsdl.org/listinfo.cgi/svn-libsdl.org</a>
</font>
</p>

<?PHP
 include ("footer.inc.php");
?>
