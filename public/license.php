<?PHP
 include ("../include/login.inc");
 include ("header.inc");
?>
<h1><font color="#414141"><strong>
Licensing the Simple DirectMedia Layer library
</strong></font></h1>

<blockquote>
  <p><font color="#414141">
<p>
The Simple DirectMedia Layer library is currently available under the 
GNU Lesser General Public License (LGPL) version 2 or newer.  This license
allows you to link with the library in such a way that users can modify
the library and have your application use the new version.
</p>
<p>
The GNU LGPL license can be found online at:<br>
<a href="http://www.gnu.org/copyleft/lgpl.html"
        >http://www.gnu.org/copyleft/lgpl.html</a>
</p>
<p>
To comply with this license, you must give prominent notice that you use
the Simple DirectMedia Layer library, and that it is included under the
terms of the LGPL license.  You must include a copy of the LGPL license.
<br>
You must also do <strong>one</strong> of the following:
<ol>

<li> Include the source code for the version of SDL that you link with, as
     well as the full source or object code to your application so that the
     user can relink your application,
<br>
<strong>or</strong>
<li> Include a written offer, valid for at least three years, to provide the
     materials listed in option 1, charging no more than the cost of providing
     this distribution,
<br>
<strong>or</strong>
<li> Make the materials listed in option 1 available from the same place that
     your application is available.

</ol>
<p>
The most common way to comply with the license is to dynamically link with
SDL, and then include the SDL source code and appropriate notices with your
application.
</p>
<p>
<b>Embedded Use</b>:<br>
Personally, I don't have a problem with anybody statically linking SDL
for use with embedded environments that don't already have an open
development environment. (i.e. the users can't relink programs anyway)
However, this does technically violate the LGPL, so be cautioned.
</p>
     </font></p>
</blockquote>
<?PHP
 include ("footer.inc");
?>
