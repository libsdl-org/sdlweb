<?PHP
 include ("../include/login.inc.php");
 include ($header_filename);
?>
<h1>SDL Google Summer of Code Ideas</h1>
<p>
This page is a scratch pad of ideas for <a href="http://www.google-melange.com/">Google Summer of Code (GSOC) 2013</a>.
</p>

<p>
With the SDL2.0 ABI freeze in place, the general theme this year is creating a top quality SDL 2.0 release!
</p>

<blockquote style="color: #414141">

<h3>
Project Idea #1: Interactive and Visual Test Automation for SDL 2.0
</h3>
<p>
Did you know that testsprite2 has 26 commandline parameters with thousands of valid combination?
Hey, and you thought we check them all before releasing SDL onto the world ...
We need a great student to fully automate this puppy. Write some test code that will be running through
<strong>all</strong> of the command line options and interactive command sequences of testsprite2
while verifying the resulting behavior.
This could be on any platform chosen by the student, but success would require complete automated
testing and verification on at least one platform.
This can have any additional dependencies that are necessary for this to work.
If time allows, a stretch goal could be extending that to a second or even third platform, of any kind.
</p>
<p>
We are interested in:
<ul>
<li>Researching existing testing frameworks that can help automate this.
<li>Extending the SDL test automation framework if needed.
<li>Hand roll a script that could potentially become an open source test system on its own.
</ul>

This project will expose you to:
<ul>
<li>Cross-platform testing (Windows, Linux, OS X, Android, iOS).
<li>Interative test tools and image based test validation.
<li>All the fantastic window parameters that SDL 2.0 supports.
</ul>

Programming skills needed:
<ul>
<li>Student should have medium to expert experience in C/C++, and
<li>experience in a scripting language like Python, perl or lua.
<li>Previous experience with user interface testing or test-frameworks would definitely help as well.
</ul>

Difficulty level:
<ul>
<li>medium to difficult
<li>research and prototyping required
</ul>

Potential mentors:
<ul>
<li>Andreas Schiffler
<li>Gabriel Jacobo (backup)
</ul>

    
    
<h3>
Project Idea #2: Multi platform meta-build system for SDL 2.0
</h3>

<p>
SDL's current build system is based on autotools as well as hand crafted Visual Studio and XCode project files.
We need a <strong>build hero</strong> to help us investigate several possible alternatives and hopefully
get rid of the <i>chore</i> (see mailing list debate Feb-Mar 2013) of editing build-artifacts once and for all.
In a nutshell, SDL needs a meta-build solution that will generate a build solution for *nix system,
as well as Visual Studio and XCode project files, out of a "as minimal and generic as possible" configuration.
The goal should be full project generation for all supported platforms.
As a stretch goal, if this "new solution" is successful, it can be expanded to the other SDL_* libraries.
</p>

We are interested in researching the following alternatives in order to accomplish this objective:
<ul>
<li>CMake (<a href="http://www.cmake.org">www.cmake.org</a>)
<li>premake (<a href="http://industriousone.com/premake">industriousone.com/premake</a>)
<li>gyp (<a href="https://code.google.com/p/gyp/">code.google.com/p/gyp/</a>)
<li>Hand rolled script that could potentially become an open source build system on its own.
</ul>

This project will expose you to:
<ul>
<li>Auto tools based build systems (as in configure;make;make install), Visual Studio, XCode.
<li>Cross platform builds (Windows, Linux, OS X, Android, iOS).
<li>Scripting languages (possibly Lua or Python).
</ul>

Programming skills needed:
<ul>
<li>Student should have medium to expert experience in C/C++, and
<li>Python (buildbot), and
<li>the scripting language used by the target framework.
<li>Previous experience with cross-platform builds would definitely help as well.
</ul>

Difficulty level:
<ul>
<li>medium to difficult
<li>research and prototyping required
</ul>

Potential mentors:
<ul>
<li>Gabriel Jacobo
<li>Andreas Schiffler (backup)
</ul>

</blockquote>
<?PHP
 include ("footer.inc.php");
?>
