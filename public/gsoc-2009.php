<?PHP
 include ("../include/login.inc.php");
 include ($header_filename);
?>
<h1>SDL Summer of Code Projects <A HREF="gsoc-2008.php">2008</A>, 2009</h1>

<blockquote style="color: #414141">

<p>
I'd like to thank everybody who applied, and congratulate everyone who was selected for the <a href="http://socghop.appspot.com/">Google Summer of Code</a>!
</p>

<p>
The following projects were accepted for the Google Summer of Code: 
<ul>

<li>
 <div class=extern_app>
 <div>
 <a href="http://socghop.appspot.com/student_project/show/google/gsoc2009/sdl/t124024853848">
 International Input (Mac OS X)
 </a>
 </div>
 <div>
 <small>by Jiang Jiang, mentored by Ryan C. Gordon</small>
 </div>
 </div>
</li> 

<!-- Simeon dropped out at midterm, sadly.
<li>
 <div class=extern_app>
 <div>
 <a href="http://socghop.appspot.com/student_project/show/google/gsoc2009/sdl/t124024854219">
 International Input (X11)
 </a>
 </div>
 <div>
 <small>by Simeon Xenitellis, mentored by Ryan C. Gordon</small>
 </div>
 </div>
</li>
-->

<li>
 <div class=extern_app>
 <div>
 <a href="http://socghop.appspot.com/student_project/show/google/gsoc2009/sdl/t124024854746">
 Automated Testing Suite for SDL
 </a>
 </div>
 <div>
 <small>by Edgar Simo, mentored by Sam Lantinga</small>
 </div>
 </div>
</li>

<li>
 <div class=extern_app>
 <div>
 <a href="http://socghop.appspot.com/student_project/show/google/gsoc2009/sdl/t124024855295">
 Playstation3 Port
 </a>
 </div>
 <div>
 <small>by Martin Lowinski, mentored by Sam Lantinga</small>
 </div>
 </div>
</li>

</ul>

Presenting the Google Summer of Code 2009 "work complete" snapshot!
<p>
<a href="http://www.libsdl.org/tmp/SDL-GSoC-2009.zip">
http://www.libsdl.org/tmp/SDL-GSoC-2009.zip</a>
<p>
I want to thank all of these students for the excellent work they contributed!
<p>
Please feel free to download the snapshot and check out their work!
<br>
If you run into any bugs, please enter them in the <a href="http://bugzilla.libsdl.org/">SDL bug tracking system</a>.
<br>
If you have any questions, please ask on the <a href="http://www.libsdl.org/mailng-list.php">mailing list</a> or the <a href="http://forums.libsdl.org/">forums</a>.
<p>
Here is more detailed information on each of the projects:
<p>

<h3> Automated Tests </h3>
The initial version of the Automated Testing Framework has been already merged with SDL 1.3:
<br>
<a href="http://www.libsdl.org/cgi/viewvc.cgi/trunk/SDL/test/automated/">
http://www.libsdl.org/cgi/viewvc.cgi/trunk/SDL/test/automated/</a>
<p>
Basic functionality it has now serves to test the following subsystems:
<ul>
<li> RWops - all the builtin rwops stuff
<li> platform - endianness and the likes
<li> surface - surface manipulation
<li> render - different rendering drivers/renderers (not working 100% since
<li> the readpixels function isn't implement)
<li> audio - only in verbose mode
</ul>
<p>
The framework is there and documented to add more functionality or testcases.  There is both <a href="http://www.libsdl.org/cgi/viewvc.cgi/trunk/SDL/test/automated/README?view=markup">user</a> and <a href="http://www.libsdl.org/cgi/viewvc.cgi/trunk/SDL/test/automated/SDL_at.h?view=markup">developer</a> documentation.
<p>
The manual testcases weren't implemented due to lack of time and increase complexity the brought (needing to change to autotools, use SDL_ttf [if found] to display text, etc...), so currently they are all automated.
<p>
You can also use the verbosity flag to see what your system supports as far as renderers/drivers are concerned. More is explained with the documentation.
<p>

<h3> Playstation 3 </h3>
Martin was porting the ps3 video driver from SDL 1.2 to SDL 1.3. Basically the ps3 driver in 1.3 provides the same functionality (but improved) as in 1.2, which means:
<ul>
<li> All videomodes the ps3 comes with are supported (420p, 720p, 1080p, WXGA, SXGA, WUXGA)
<li> Scaling (bilinear YV12/IYUV), converting (YV12/IYUV) and copying the frame to the framebuffer are accelerated by <a href="http://en.wikipedia.org/wiki/Cell_%28microprocessor%29">SPEs</a>.
<li> Easy way to build the needed ps3libs by running "make ps3libs"
</ul>
<p>
The API to manage programs running on a SPE is <a href="http://www.libsdl.org/cgi/viewvc.cgi/trunk/SDL/src/video/ps3/SDL_ps3spe_c.h?view=markup">documented</a> and provides an easy way to use different/faster scaler or converter.
<p>
Installation and ideas to extend the ps3 driver are <a href="http://www.libsdl.org/cgi/viewvc.cgi/trunk/SDL/README.PS3?view=markup">documented</a>.
<p>

<h3> IME on Mac OS X </h3>
Jiang added three new API functions to manage text input in SDL 1.3:
<br>
SDL_StartTextInput() - Enable text input events
<br>
SDL_SetTextInputRect() - Set the area where the IME will display
<br>
SDL_StopTextInput() - Disable text input events
<p>
There is also a new event that is triggered when partially composed text is available:
<code><pre>
struct SDL_TextEditingEvent
{
    Uint8 type;             /**< SDL_TEXTEDITING */
    char text[];            /**< The editing text */
    int start;              /**< The start cursor of selected editing text */
    int length;             /**< The length of selected editing text */
};
</pre></code>
<p>

</blockquote>

<?PHP
 include ("footer.inc.php");
?>
