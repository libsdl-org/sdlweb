<?PHP
 include ("../include/login.inc.php");
 include ($header_filename);
?>
<h1>SDL Summer of Code Ideas</h1>

<blockquote style="color: #414141">

<p>
This page is a scratch pad of ideas for the <a href="http://socghop.appspot.com/program/home/google/gsoc2009">Google Summer of Code</a>.  These ideas are things that would help advance the SDL 1.3 development, but is not an exhaustive list.  If you have an idea you'd like to see that isn't listed, <a href="mailto:slouken@libsdl.org">please let me know</a>!
</p>

<h3> General Ideas </h3>
<ul>
<li> New Platforms <br>
	Do you have a platform or device that you want to see SDL 1.3 ported to?  SDL is widely cross-platform and it's always great to see ports to new systems.
</li>
<br>
<li> Unit Tests <br>
	As software becomes more complex it becomes more and more important to create systems for testing them.  A battery of simple tests can be used to catch bugs before they go live and to verify functionality of new ports.  If making perfect software gives you a thrill, this may be the project for you!
</li>
<br>
</ul>

<h3> Input Ideas </h3>
<ul>
<li> Touch Input <br>
	Nothing is as smooth and intuitive as touch input.  For years artists have used pressure sensitive tablets for digital media, and more recently the iPhone has revolutionized the industry with an intuitive multi-touch gesture interface.  If touch excites you, then you can design and implement a touch/gesture API from the ground up.
</li>
<br>
<li> International Input <br>
	SDL 1.3 has a clean API for receiving Unicode character input, however there is currently no Input Method Editor (IME) support implemented.  If you consider yourself an International Woman of Mystery, you might consider traveling to remote climes and helping them input exotic languages into games.  You could pick any of Windows, XFree86, and Mac OS X and check the status of their IME support and implement the necessary code to convert user input into Unicode characters.
</li>
<br>
</ul>

<h3> Audio Ideas </h3>
<ul>
<li> Recording <br>
	SDL 1.3 API has support for recording, but not all implementations support it.  If you like to groove into a mic, you can evaluate the current API to make sure it meets the needs of games and add any necessary audio code to support recording with the various drivers.  <br>
	A nice capstone for this idea might be a simple example of VOIP (Voice Over IP) that records an audio stream, encodes it in a voice codec, and sends it over the network to be decoded and played back using SDL.
</li>
<br>
</ul>

<h3> Video Ideas </h3>
<ul>
<li> Multi-Display Support <br>
	The SDL 1.3 API is designed to allow games that take advantage of multiple monitors, however none of the video drivers currently support it.  If you're a two-headed ogre, or just a cyclops with a broad mind, you might want to pick from Windows, X11 Xinerama, or Mac OS X and add the necessary code to expose multiple monitors to the application level.
</li>
<br>
<li> XRender Support <br>
	The SDL 1.3 API has been designed with the capabilities of the XRender X11 extension in mind, but they haven't yet been integrated into the SDL X11 video driver.  If you want to bring X11 video capabilities to a whole new level, this is the project for you!
</li>
<br>
<li> 2D Video Drivers <br>
	SDL 1.3 is designed to work efficiently on 3D hardware, and OpenGL and Direct3D have been the primary focus for development.  If you love old computers or have a retro bent, you might like to tackle implementing some of the 2D drivers that need love.  You can pick from SVGAlib, Linux framebuffer console, PS/2 framebuffer, Atari framebuffer, etc.
</li>
<li> PlayStation 3 SPE Support <br>
	The Cell CPU has 6 cores, one is a common PowerPC core and the five other cores are special synergetic processing cores (SPE). That means, you can run SDL on the PS3 with the fbdev video driver. But fbdev only uses one core, the  PowerPC core, so it's not using the full power the Cell CPU provides, which is a lot more.  You could create an SDL video driver that uses the SPEs to do bilinear scaling, yuv-to-rgb converting and copying the picture to the framebuffer.
<br>
</ul>

<h3> Miscellaneous Ideas </h3>
<ul>
<li> Desktop Integration <br>
	There are desktop services that many multimedia applications use, like drag-n-drop support, clipboard access, etc. that can be exposed in the SDL API.  If you love making applications work well in the desktop environment, you can evaluate these technologies and design and implement APIs that allow applications to access these services.
</li>
<br>
<li> Shaped Window Support <br>
	One of the commonly requested features is the ability to create uniquely shaped and themed windows.  This project would involve researching how to create shaped windows on Linux, Mac OS X and Windows, and then design and implement a clean API for using them.
</li>
<br>
<li> Enhanced Cursor Support <br>
	One of the planned features for SDL 1.3 is support for fully animated color cursors.  This project would involve building new cursor functionality from the ground up on Linux, Mac OS X and Windows, to bring games and applications to life!
</li>
<br>
<li>Your Idea Here! <br>
	You're smart!  What would you like to do?
</li>
</ul>

</blockquote>

<?PHP
 include ("footer.inc.php");
?>
