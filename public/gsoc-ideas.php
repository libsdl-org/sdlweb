<?PHP
 include ("../include/login.inc.php");
 include ($header_filename);
?>
<h1>SDL Summer of Code Ideas</h1>

<blockquote style="color: #414141">

<p>
This page is a scratch pad of ideas for the <a href="http://code.google.com/soc/2008/">Google Summer of Code</a>.  These ideas are things that would help advance the SDL 1.3 development, but is not an exhaustive list.  If you have an idea you'd like to see that isn't listed, <a href="mailto:slouken@libsdl.org">please let me know</a>!
</p>

<h3> General Ideas </h3>
<ul>
<li> New Platforms <br>
	<ul>
	<li> Port SDL 1.3 to the iPhone / iPod Touch
	<li> Port SDL 1.3 to the XBox using XNA
	<li> Add your favorite platform here!
	</ul>
</li>
<br>
<!--
<li> Documentation <br>
	Every project needs more documentation, and SDL is no exception.  SDL 1.3 uses doxygen to convert code comments into useful documentation.  We can use a detail oriented individual to go over the code and make sure the API functions are well documented in a consistent way, taking advantage of the features of doxygen for the best presentation possible.
</li>
<br>
<li> Licensing <br>
	Do you like playing with words and figuring out what all those software licenses REALLY mean?  Have you thought about or are currently studying to be a lawyer? Then you might be interested in working on the commercial licensing terms for SDL 1.3.  I have the idea behind the commercial license in broad strokes, but haven't drafted a formal license.  Your job would be to research software licenses for SDL's type of product and help draft the official commercial license.
</li>
-->
</ul>

<h3> Input Ideas </h3>
<ul>
<li>  Force Feedback <br>
	Have you ever wanted your players to actually feel the rumble of the tank treads under them, the bump and shake as the vehicle tilts over rubble, the blast of the explosion as it trundles over a mine?  Force feedback has been an often requested feature and is planned for SDL 1.3.  Now's your chance to research, design, and implement a force feedback API from the ground up.
</li>
<br>
<li> Touch Input <br>
	Nothing is as smooth and intuitive as touch input.  For years artists have used pressure sensitive tablets for digital media, and more recently the iPhone has revolutionized the industry with an intuitive multi-touch gesture interface.  If touch excites you, then you can design and implement a touch/gesture API from the ground up.
</li>
<br>
<li> International Input <br>
	SDL 1.3 has a clean API for receiving Unicode character input, however there is currently no Input Method Editor (IME) support implemented.  If you consider yourself an International Woman of Mystery, you might consider traveling to remote climes and helping them input exotic languages into games.  You could pick any of Windows, XFree86, and Mac OS X and check the status of their IME support and implement the necessary code to convert user input into Unicode characters.
</li>
<br>
<li> Many Mice! <br>
	SDL 1.3 has architectural support for multiple simultaneous mouse and keyboard input devices, but most operating systems make you jump through hoops to actually use them.  Ryan "icculus" Gordon has written a library called <a href="http://www.icculus.org/manymouse">ManyMouse</a> that nicely hides these hoops.  If multiple input devices is what gets you going, you can look at this library and decide how best to integrate multiple mouse and keyboard support into the driver layer of the SDL library.
</li>
</ul>

<h3> Audio Ideas </h3>
<ul>
<li> Recording <br>
	SDL 1.3 API has support for recording, but not all implementations support it.  If you like to groove into a mic, you can evaluate the current API to make sure it meets the needs of games and add any necessary audio code to support recording with the various drivers.  <br>
	A nice capstone for this idea might be a simple example of VOIP (Voice Over IP) that records an audio stream, encodes it in a voice codec, and sends it over the network to be decoded and played back using SDL.
</li>
<br>
<li> Resampling <br>
	SDL currently only supports power of two resampling, which is great for converting 11025 Hz audio to 44100 Hz audio, but not so great converting to 48 KHz.  The reason for this limitation is that many DMA based audio drivers require the final buffer size to be a power of two.  A good project for someone interested in audio algorithms and buffer management is to work out the best algorithm for real-time audio resampling and how to manage the stream between the application and the sound card.
</li>
<br>
<li> Pitch Shifting <br>
	A frequently requested feature is real-time pitch shifting, e.g. simulating the sound of a train whistle or siren as it approaches and passes.  This hadn't originally been implemented because the algorithms to do this weren't suitable for the power of computers at the time.  However, if you like audio and algorithms, adding pitch shifting to SDL_mixer might be the project for you!
</li>
</ul>

<h3> Video Ideas </h3>
<ul>
<li> Multi-Display Support <br>
	The SDL 1.3 API is designed to allow games that take advantage of multiple monitors, however none of the video drivers currently support it.  If you're a two-headed ogre, or just a cyclops with a broad mind, you might want to pick from Windows, X11 Xinerama, or Mac OS X and add the necessary code to expose multiple monitors to the application level.
</li>
<br>
<li> 2D Video Drivers <br>
	SDL 1.3 is designed to work efficiently on 3D hardware, and OpenGL and Direct3D have been the primary focus for development.  However, because of this there are only two 2D drivers implemented, one for Windows GDI, and one for rendering to images to disk.  If you love old computers or have a retro bent, you might like to tackle implementing some of the 2D drivers that need love.  You can pick from X11 (XImage, MIT-SHM, XRender), SVGAlib, DirectFB, PS/2 framebuffer, Atari framebuffer, etc.
</li>
<br>
</ul>

<h3> Miscellaneous Ideas </h3>
<ul>
<li>New API Functionality <br>
	There are many aspects of game functionality that are unofficially supported in SDL 1.2 via environment variables.  This includes things like mouse acceleration, whether to use various OS features, specifying the OpenGL library, etc.  The plan for SDL 1.3 is to add official API support for these.  If you're interested, you could collect these tidbits and expose the functionality in the official SDL 1.3 API.
</li>
<br>
<li>Desktop Integration <br>
	There are desktop services that many multimedia applications use, like drag-n-drop support, clipboard access, etc. that can be exposed in the SDL API.  If you love making applications work well in the desktop environment, you can evaluate these technologies and design and implement APIs that allow applications to access these services.
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
