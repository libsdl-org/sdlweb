<?PHP
 include ("../include/login.inc");
 include ("header.inc");
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
<a href="http://www.loria.fr/~molli/cvs-index.html">CVS</a>:
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
    Source snapshot version 1.2 (
Sun Feb 15
  )</p>
  <p><a href="cvs/SDL-1.2.tar.gz">SDL-1.2.tar.gz</a></p>
  <p>Changes for Sun Feb 15:</p>
     <ul>
	<LI> 1.2.7: Added fullscreen toggle support in testwm for Windows, etc.
	<LI> 1.2.7: Fixed mouse focus events after resetting video mode on Windows
	<LI> 1.2.7: Removed debugging print statements in DirectX driver
	<LI> 1.2.7: Re-added Objective-C export symbols for SDL_QuartzWindow
	<LI> 1.2.7: Added colorkey blit tests to testvidinfo (thanks Mike!)
	<LI> 1.2.7: Added video hardware acceleration support on QNX (thanks Mike!)
	<LI> 1.2.7: Fixed video crash on some Atari systems (thanks Patrice!)
	<LI> 1.2.7: SDL no longer sets a fatal signal handler for SIGPIPE
     </ul>
  <p>Changes for Fri Feb 13:</p>
     <ul>
	<LI> 1.2.7: Fixed typos in DirectFB video driver
	<LI> 1.2.7: Fixed modifier key state on MacOS X (thanks Max!)
     </ul>
  <p>Changes for Thu Feb 12:</p>
     <ul>
	<LI> 1.2.7: Use sigaction instead of signal to preserve handler flags (thanks Matthew!)
	<LI> 1.2.7: Added support for remote XVideo (thanks Frederic!)
	<LI> 1.2.7: Try to use higher refresh rate by default in DirectX driver (thanks Dmitry!)
	<LI> 1.2.7: Fixed ring 0 video flip busy wait on some versions of Windows (thanks Dmitry!)
	<LI> 1.2.7: Fixed static linking on MacOS X (thanks Max!)
	<LI> 1.2.7: Detect new XFree86 mode switch key on german keyboards (thanks Jens!)
     </ul>
  <p>Changes for Tue Feb 10:</p>
     <ul>
	<LI> 1.2.7: Fixed typos in the HTML documentation 
	<LI> 1.2.7: Various Atari video driver improvements (thanks Patrice!)
	<LI> 1.2.7: Fixed compiling with broken Linux 2.6 headers
	<LI> 1.2.7: Added SDL_HasMMXExt(), SDL_Has3DNowExt(), and SDL_HasSSE2()
	<LI> 1.2.7: Added Altivec detection support Linux/PPC
	<LI> 1.2.7: Updated aclocal macros for new version of automake
     </ul>
  <p>Changes for Tue Jan 13:</p>
     <ul>
	<LI> 1.2.7: Updated Visual C++ 7 projects with new API files
	<LI> 1.2.7: Fixed mouse cursor visibility and focus events on MacOS X (thanks Max!)
	<LI> 1.2.7: Added Altivec detection support for MacOS X (thanks Max!)
	<LI> 1.2.7: Added support for /dev/joy* on Free/Net/OpenBSD (thanks Christian!)
	<LI> 1.2.7: Fixed problems with CD-ROM audio playback on MacOS X 10.1
	<LI> 1.2.7: Added dynamic GL library loading to MacOS Carbon support (thanks Anders!)
     </ul>
  <p>Changes for Sun Jan 4:</p>
     <ul>
	<LI> 1.2.7: Updated copyright information for 2004 (Happy New Year!)
	<LI> 1.2.7: Added the ability to hide the cursor in the DirectFB driver (thanks Pete!)
	<LI> 1.2.7: Added minor cleanup for Embedded Visual C++ 3.0 (thanks Andy!)
	<LI> 1.2.7: Fixed high CPU usage with ALSA audio driver (thanks Michel!)
	<LI> 1.2.7: Added function to create RWops from const memory: SDL_RWFromConstMem()
	<LI> 1.2.7: Fixed YUV surface creation when video surface is OpenGL, but target is not
     </ul>
  <p>Changes for Tue Dec 16:</p>
     <ul>
	<LI> 1.2.7: Fixed compiling with ALSA 1.0 (thanks Stephane!)
	<LI> 1.2.7: Added YUV overlay support on BeOS (thanks Andrew!)
     </ul>
  <p>Changes for Sat Dec 13:</p>
     <ul>
	<LI> 1.2.7: Fixed "dist" make target for newer versions of automake
	<LI> 1.2.7: Fixed sound skipping on Tru64 (thanks Hayashi)
	<LI> 1.2.7: Lots of non-critical QNX improvements (thanks Mike!)
     </ul>
  <p>Changes for Mon Nov 24:</p>
     <ul>
	<LI> 1.2.7: Updated Visual C++ project with CPU feature API
	<LI> 1.2.7: Simplified CPU feature code and added SDL_HasRDTSC()
	<LI> 1.2.7: Fixed configure.in problem with Cygwin32
     </ul>
  <p>Changes for Tue Nov 18:</p>
     <ul>
	<LI> 1.2.7: Fixed MacOS X libtool framework support (thanks Max!)
	<LI> 1.2.7: Added SDL_HasMMX(), SDL_Has3DNow(), SDL_HasSSE() in SDL_cpuinfo.h
	<LI> 1.2.7: Fixed illegal instruction crash using 3DNow on Intel processors
	<LI> 1.2.7: Fixed asm issues with mmx.h and gcc 3.3 (thanks Stephane!)
	<LI> 1.2.7: Updated libtool support so Mingw32 builds work.
	<LI> 1.2.7: MGA CRTC2 support for DirectFB target (thanks Thomas!)
	<LI> 1.2.7: Disable screen saver in Windows DIB video driver
	<LI> 1.2.7: Added Atari CD-ROM support (thanks Patrice!)
     </ul>
  <p>Changes for Sun Sep 21:</p>
     <ul>
	<LI> 1.2.7: Fixed crash calling app defined window proc (thanks Scott!)
	<LI> 1.2.7: Fixed NAS include file detection (thanks Stephane!)
	<LI> 1.2.7: Fixed long long constant warnings in GCC 3.3.1 (thanks Stephane!)
	<LI> 1.2.7: Added configure.in support for K*BSD (thanks Robert!)
	<LI> 1.2.7: Added QNX package and audio fixes (thanks Mike!)
     </ul>
  <p>Changes for Fri Sep 5:</p>
     <ul>
	<LI> 1.2.7: Fixed joystick open problems on BSD (thanks SUGIMOTO!)
	<LI> 1.2.7: Fixed X11 mode line crash with only one video mode (thanks Alan!)
     </ul>
  <p>Changes for Sat Aug 30:</p>
     <ul>
	<LI> 1.2.6: Updated Visual C++, CodeWarrior, and MPW projects
	<LI> 1.2.6: Fixed video bugs using the Nano-X video driver
	<LI> 1.2.6: Fixed some bugs in the Atari audio driver (thanks Patrice!)
     </ul>
  <p>Changes for Sat Aug 23:</p>
     <ul>
	<LI> 1.2.6: Fixed use of SDL with XInitThreads()
	<LI> 1.2.6: Added MMX and 3DNow! optimized alpha blitters (thanks Stephane!)
     </ul>
  <p>Changes for Sat Aug 9:</p>
     <ul>
	<LI> 1.2.6: Fixed automake warnings about Objective C dependencies
	<LI> 1.2.6: Turned dynamic loading of ESD and aRts on by default
	<LI> 1.2.6: Added a second test program for YUV overlays (thanks Mike!)
	<LI> 1.2.6: Fixed fullscreen mouse click bug in Quartz events (thanks Max!)
	<LI> 1.2.6: Massive updates to the QNX support (thanks Mike!)
	<LI> 1.2.6: Added an environment variable SDL_VIDEO_WINDOW_POS for MacOS X
     </ul>
  <p>Changes for Tue Jul 22:</p>
     <ul>
	<LI> 1.2.6: Added SDL_GL_MULTISAMPLEBUFFERS and SDL_GL_MULTISAMPLESAMPLES for FSAA support (thanks Shawn and Ryan!)
	<LI> 1.2.6: Added audio and CD-ROM support for OSF/Tru64 (thanks Hayashi!)
	<LI> 1.2.6: Added SDL_LoadObject(), SDL_LoadFunction(), and SDL_UnloadObject()
	<LI> 1.2.6: Added new Atari audio drivers (thanks Patrice!)
	<LI> 1.2.6: Improved BSD joystick HID support
     </ul>
  <p>Changes for Wed May 28:</p>
     <ul>
	<LI> 1.2.6: Added more-than-three mouse button support for the Quartz target
	<LI> 1.2.6: Enabled the "enums size of ints" option for the Borland projects
	<LI> 1.2.6: Fixed compile problem in SDL_stretch.c with gcc 3.3
	<LI> 1.2.6: Added initial support for RISC OS (thanks Peter and Alan!)
     </ul>
  <p>Changes for Sat Apr 19:</p>
     <ul>
	<LI> 1.2.6: Improved video mode selection under XFree86 (thanks Despair!)
	<LI> 1.2.6: Fixed building thread code under BSD/OS (thanks Steven!)
	<LI> 1.2.6: Added support for HID sliders wheels and dials on MacOS X
	<LI> 1.2.6: Moved dummy driver detection to the end of the video driver list
	<LI> 1.2.6: Added m68k assembly routines for audio mixing (thanks Patrice!)
	<LI> 1.2.6: Updated FreeBSD joystick USBHID support (thanks Matthew!)
	<LI> 1.2.6: Fixed video intitialization problem on Qtopia (thanks David!)
	<LI> 1.2.6: Added MacOS X CD-ROM audio support (thanks Max and Darrell)
	<LI> 1.2.6: Fixed refresh rate issue with XFree86 4.3.0 (thanks Stephen!)
	<LI> 1.2.6: Fixed lost cursor bug under MacOS X (thanks Darrell!)
     </ul>
  <p>Changes for Sat Feb 1:</p>
     <ul>
	<LI> 1.2.6: Fixed crash in SDL_SetIcon() under Quartz (thanks Darrell!)
	<LI> 1.2.6: Fixed a problem with dlltool when building under MSYS on Windows
	<LI> 1.2.6: Removed obsolete Linux joystick code dealing with analog hats
	<LI> 1.2.6: Darrell added support for emulated SDL_DOUBLEBUF on MacOSX
	<LI> 1.2.6: Updated the 'missing' file included with the SDL source archive
	<LI> 1.2.6: Work around Objective C dependency problems with Cygwin's automake
	<LI> 1.2.6: Fixed header docs for the joystick hat position
	<LI> 1.2.6: Fixed QZ_ToggleFullScreen() return value (thanks Max!)
	<LI> 1.2.6: Implemented stdio redirection on Windows CE (thanks Corona688!)
	<LI> 1.2.6: Cth converted the MMX audio mixing routines to VC++ syntax
     </ul>
  <p>Changes for Sun Jan 19:</p>
     <ul>
	<LI> 1.2.6: David MacCormack fixed a bug in window sizing with Windows menus
	<LI> 1.2.6: Enable the glXGetProcAddressARB code on X11 (fixes NVidia issues)
	<LI> 1.2.6: Added support for SDL_WM_GrabInput and SDL_WM_IconifyWindow on Qtopia (thanks David!)
	<LI> 1.2.6: Almost completely rewritten and improved QNX code (thanks Mike and Julian!)
	<LI> 1.2.6: Fixed build error on BeOS when building SDL_BeApp.cc
     </ul>
  <p>Changes for Tue Dec 10:</p>
     <ul>
	<LI> 1.2.6: Fixed left/right shift detection on Windows (thanks Mike!)
	<LI> 1.2.6: Fixed invalid memory access in DGA video driver (thanks ldb!)
     </ul>
  <p>Changes for Fri Dec 6:</p>
     <ul>
	<LI> 1.2.6: Generate an expose event on MacOS X after power save (thanks Darrell!)
	<LI> 1.2.6: Fixed compile error if there is no X11 shared memory support.
	<LI> 1.2.6: Updated Atari port for new system headers (thanks Patrice!)
     </ul>
  <p>Changes for Sun Dec 1:</p>
     <ul>
	<LI> 1.2.6: Linux joystick cleanups from Alan Swanson
	<LI> 1.2.6: *BSD joystick cleanups from Wilbern Cobb
	<LI> 1.2.6: Fixed compile error when MIT-SHM support isn't available
	<LI> 1.2.6: Worked around Visual C++ 7 optimizer bug in blit code
	<LI> 1.2.6: Fixed win32 crash on exit in console mode
     </ul>
  <p>Changes for Sun Nov 17:</p>
     <ul>
	<LI> 1.2.6: Open ALSA devices in non-blocking mode (thanks Aleksey!)
	<LI> 1.2.6: Updated for DirectDB 0.9.15 (thanks Denis!)
	<LI> 1.2.6: Fixed building SDL DLL with Watcom C++ (thanks Jean-Pierre)
	<LI> 1.2.6: Fixed bsd joystick detection ... again (thanks Wilbern)
	<LI> 1.2.6: Support 1-bit alpha on surfaces passed to SDL_WM_SetIcon() (thanks Glenn!)
     </ul>
  <p>Changes for Fri Nov 8:</p>
     <ul>
	<LI> 1.2.6: Greatly improved X11 DGA video speed (thanks Cezary!)
	<LI> 1.2.6: Added MMX audio mixing code for gcc (thanks Stephane!)
	<LI> 1.2.6: Fixed potential dropped events under DirectInput
	<LI> 1.2.6: Turn on enums always ints for CodeWarrior (thanks Darrell!)
	<LI> 1.2.6: Fixed alpha blending bug (thanks Glenn!)
     </ul>
  <p>Changes for Mon Oct 14:</p>
     <ul>
	<LI> 1.2.6: Return error with color fills on &lt; 8 bpp surfaces
	<LI> 1.2.6: Fixed joystick detection on Windows XP (thanks Maciej!)
     </ul>
  <p>Changes for Fri Oct 11:</p>
     <ul>
	<LI> 1.2.6: Fixed a crash blitting RLE surfaces to RLE surfaces
	<LI> 1.2.6: Fixed mouse warp position bug with offset video modes
     </ul>
  <p>Changes for Tue Oct 8:</p>
     <ul>
	<LI> 1.2.6: Fixed windows event handling for ActiveX controls
	<LI> 1.2.6: Updated the Project Builder stationary with SDLMain.*
	<LI> 1.2.6: Added Visual C++ 7 (.NET) projects (thanks James!)
     </ul>
  <p>Changes for Mon Oct 7:</p>
     <ul>
	<LI> 1.2.5a: Fixed building SDL timer code on Windows CE
	<LI> 1.2.5a: Fixed source coordinates for blits from hardware surfaces
	<LI> 1.2.5a: Forgot to set the Win32 DLL version to 1.2.5
     </ul>
  <p>Changes for Sat Oct 5:</p>
     <ul>
	<LI> 1.2.5: Added an environment variable SDL_HAS3BUTTONMOUSE for Quartz
	<LI> 1.2.5: Added initial support for Dreamcast (thanks HERO!)
	<LI> 1.2.5: Fixed gamma correction in Atari video drivers (thanks Patrice!)
	<LI> 1.2.5: Atari joystick fixes contributed by Patrice Mandin
     </ul>
  <p>Changes for Fri Oct 4:</p>
     <ul>
	<LI> 1.2.5: Fixed cursor resource leak in Windows (thanks Huib-Jan Imbens!)
	<LI> 1.2.5: Fixed memory overwrite in BSD joystick driver (thanks SUGIMOTO Sadahiro!)
	<LI> 1.2.5: Fixed mouse wheel events on MacOS X
	<LI> 1.2.5: Fixed YUV overlay code for QuickTime 6 on MacOS X (thanks Darrell!)
	<LI> 1.2.5: Implemented resizing Cocoa windows (thanks Darrell!)
	<LI> 1.2.5: Generally cleaned up the Quartz video driver (thanks Darrell!)
     </ul>
  <p>Changes for Mon Sep 16:</p>
     <ul>
	<LI> 1.2.5: Fixed flickering in UpdateRects() on MacOS X 10.2  (thanks Darrell!)
     </ul>
  <p>Changes for Sun Sep 15:</p>
     <ul>
	<LI> 1.2.5: Changed SDL_WINDOW_POS to SDL_VIDEO_WINDOW_POS
	<LI> 1.2.5: Implemented support for SDL_VIDEO_WINDOW_POS=x,y
	<LI> 1.2.5: Fixed mouse focus problems caused by X11 'unclutter' hack
	<LI> 1.2.5: Applied John's fix for left-handed mice under Windows.
	<LI> 1.2.5: Fixed the logo when running testgl -twice (thanks John!)
	<LI> 1.2.5: Fixed a crash bug in checkkeys.c (thanks John!)
	<LI> 1.2.5: Gamepads and other HID devices should work under MacOS X
     </ul>
  <p>Changes for Sun Sep 8:</p>
     <ul>
	<LI> 1.2.5: Removed ${prefix}/include from include path in sdl-config
	<LI> 1.2.5: Fixed broken path detection in sdl.m4
	<LI> 1.2.5: Fixed missing cursor after shadow buffer flip (thanks Jan!)
	<LI> 1.2.5: Fixed typo in recent DirectX video changes
	<LI> 1.2.5: Added SDL_WINDOW_POS=center environment variable for X11
     </ul>
  <p>Changes for Sun Sep 1:</p>
     <ul>
	<LI> 1.2.5: Updated MacOS projects with "enums as int" build option
     </ul>
  <p>Changes for Sat Aug 31:</p>
     <ul>
	<LI> 1.2.5: Added miscellaneous Zaurus fixes from Alexandre Courbot
	<LI> 1.2.5: Added a -benchmark flag to testvidinfo for testing video speed
     </ul>
  <p>Changes for Fri Aug 30:</p>
     <ul>
	<LI> 1.2.5: Added accelerated YUV code to DirectFB driver (thanks Denis!)
	<LI> 1.2.5: Added palettized 8 bpp support to DirectFB driver (thanks Denis!)
	<LI> 1.2.5: Command line apps on MacOS X go to forground (thanks Max!)
	<LI> 1.2.5: Fixed joystick code on MacOS X 10.2 (thanks Darrell!)
	<LI> 1.2.5: Fixed aRts runtime sound daemon detection
     </ul>
  <p>Changes for Sun Aug 25:</p>
     <ul>
	<LI> 1.2.5: Updated Project Builder project files (thanks Darrell!)
     </ul>
  <p>Changes for Sat Aug 24:</p>
     <ul>
	<LI> 1.2.5: Improved the Nano-X video support (thanks Greg!)
	<LI> 1.2.5: Updated the CREDITS file and added the page to the website
	<LI> 1.2.5: Fixed 2048 pixel limitation in DirectX blit code
	<LI> 1.2.5: Updated Borland projects for Kylix 3 (thanks Dominique)
	<LI> 1.2.5: Added several fixes to the DirectFB driver (thanks Denis!)
     </ul>
  <p>Changes for Tue Aug 20:</p>
     <ul>
	<LI> 1.2.5: Added compile-time checking for the size of enums
	<LI> 1.2.5: Fixed offset bug in hardware accelerated fills and blits
     </ul>
  <p>Changes for Mon Aug 19:</p>
     <ul>
	<LI> 1.2.5: Fixed serious bugs in BSD HID joystick code (thanks Krister!)
	<LI> 1.2.5: Reset mouse state when changing video modes
	<LI> 1.2.5: Fixed crash with invalid bpp in SDL_SetVideoMode()
	<LI> 1.2.5: Added project files for embedded Visual C++ 4.0
	<LI> 1.2.5: Fixed mouse motion on MacOS X (recently broken)
	<LI> 1.2.5: Added SDL_BUTTON_WHEELUP (4) and SDL_BUTTON_WHEELDOWN (5)
	<LI> 1.2.5: Added SDL_GL_STEREO for stereoscopic OpenGL contexts
     </ul>
  <p>Changes for Sun Aug 18:</p>
     <ul>
	<LI> 1.2.5: Added the environment variable SDL_VIDEO_X11_WMCLASS
	<LI> 1.2.5: Fullscreen windows are always topmost in Windows
	<LI> 1.2.5: Fixed mouse grab going fullscreen to windowed in Windows
	<LI> 1.2.5: Fixed VidMode error when running on XFree86 3.3
     </ul>
  <p>Changes for Sat Aug 17:</p>
     <ul>
	<LI> 1.2.5: Fixed Quartz mouse motion and window centering bugs
	<LI> 1.2.5: Removed mouse coordinate polling in Quartz event handling
	<LI> 1.2.5: Updated configure.in for automake 1.6.2
	<LI> 1.2.5: Fixed building Windows DLL with latest native Cygwin tools
	<LI> 1.2.5: Added a way to get the Windows OpenGL context in SDL_syswm.h
	<LI> 1.2.5: Removed DDFLIP_WAIT flag from DirectX flip for performance
	<LI> 1.2.5: Flush message queue when shutting down video mode on Windows
	<LI> 1.2.5: Zeroed SDL_Surface::unused1 so glSDL will work on stock SDL
	<LI> 1.2.5: Only modifier key state is noted when X11 window opens
     </ul>
  <p>Changes for Thu Aug 1:</p>
     <ul>
	<LI> 1.2.5: Added initial support for PicoGUI (thanks Micah!)
	<LI> 1.2.5: Fixed SDL_DisplayFormatAlpha() on RGB surfaces with alpha
     </ul>
  <p>Changes for Mon Jul 29:</p>
     <ul>
	<LI> 1.2.5: Fixed building XFree86 code from a different build directory
	<LI> 1.2.5: Added pthread detection for HP-UX 11.X
	<LI> 1.2.5: SDL_Init(SDL_INIT_JOYSTICK) on MacOS X works with no joystick
	<LI> 1.2.5: Fixed DirectX software surface memory leak
	<LI> 1.2.5: Corrected error message when loading OpenGL library
	<LI> 1.2.5: Fixed video initialization crash on Windows CE
     </ul>
  <p>Changes for Sat Jun 15:</p>
     <ul>
	<LI> 1.2.5: Updated the QNX audio code for QNX 6.2 (thanks Travis!)
     </ul>
  <p>Changes for Thu Jun 13:</p>
     <ul>
	<LI> 1.2.5: Fixed building with pthread and pth support on UNIX
	<LI> 1.2.5: Fixed some memory leaks in the X11 YUV overlay code
	<LI> 1.2.5: Added detection of several joysticks to Linux code
     </ul>
  <p>Changes for Tue Jun 11:</p>
     <ul>
	<LI> 1.2.5: Fixed thread detection and joystick code for NetBSD
     </ul>
  <p>Changes for Mon Jun 10:</p>
     <ul>
	<LI> 1.2.5: Unified the thread detection code for UNIX platforms
	<LI> 1.2.5: Added support for audio in the Atari port (thanks Patrice!)
	<LI> 1.2.5: Added fixes for GNU Pthread support (thanks Patrice!) 
	<LI> 1.2.5: Added check for ENOMEDIUM to the Linux CDROM code
	<LI> 1.2.5: Updated for DirectFB 0.9.11 release (thanks Denis!)
	<LI> 1.2.5: Minor fix for window cleanup on Qtopia (thanks David!)
     </ul>
  <p>Changes for Sat Jun 1:</p>
     <ul>
	<LI> 1.2.5: Miscellaneous MacOS X cleanups (thanks Max and Darrell)
	<LI> 1.2.5: Added YUV hardware acceleration on MacOS X (thanks Darrell!)
	<LI> 1.2.5: Fixed building shared libraries on MacOS X (thanks Max!)
	<LI> 1.2.5: Added a README for building on the Qtopia platform
     </ul>
  <p>Changes for Wed May 29:</p>
     <ul>
	<LI> 1.2.5: Updated DirectFB support for DirectFB 0.9.11 (thanks Denis!)
     </ul>
  <p>Changes for Tue May 28:</p>
     <ul>
	<LI> 1.2.5: Wilbern Cobb improved the BSD joystick build system
	<LI> 1.2.5: Updated QNX port with fixes from Mike Gorchak
	<LI> 1.2.5: Updated Qtopia port with fixes from David Hedbor
     </ul>
  <p>Changes for Sun May 19:</p>
     <ul>
	<LI> 1.2.5: Use secondary audio buffers in DirectSound by default
	<LI> 1.2.5: Fixed window tab on Windows taskbar after application quit
	<LI> 1.2.5: Fixed setting OpenGL mode multiple times on Windows
	<LI> 1.2.5: Added Zaurus PDA (Qtopia) support by David Hedbor
	<LI> 1.2.5: Updated the QNX port with patches by Mike Gorchak
     </ul>
  <p>Changes for Fri May 17:</p>
     <ul>
	<LI> 1.2.5: Updated snapshot for the new CVS repository
     </ul>
  <p>Changes for Thu Apr 25:</p>
     <ul>
	<LI> 1.2.5: Fixed MacOS X installation for SDL 1.2.4 (thanks Darrell)
     </ul>
  <p>Changes for Thu Apr 18:</p>
     <ul>
	<LI> 1.2.5: Applied a bug fix to testgl.c, contributed by Knghtbrd
     </ul>
  <p>Changes for Wed Apr 17:</p>
     <ul>
	<LI> 1.2.5: Removed README.OpenBSD - SDL works out of the box on OpenBSD
	<LI> 1.2.5: Wilbern Cobb fixed joystick code on FreeBSD
	<LI> 1.2.5: Fixed crash in QZ_SetCaption() (thanks Darrell)
     </ul>
  <p>Changes for Mon Apr 15:</p>
     <ul>
	<LI> 1.2.5: Updated ALSA audio support for ALSA 0.9
	<LI> 1.2.5: Don't build RPM archives with ALSA library dependencies
     </ul>
  <p>Changes for Sun Apr 14:</p>
     <ul>
	<LI> 1.2.5: SDL_PollEvent()/SDL_WaitEvent() return values now match docs
	<LI> 1.2.5: Fixed failed make when running "make distclean"
     </ul>
  <p>Changes for Sat Apr 13:</p>
     <ul>
	<LI> 1.2.4: Fixed precompiled headers on MacOS X
	<LI> 1.2.4: Updated docs.html
	<LI> 1.2.4: Updated autogen.sh for new versions of automake
     </ul>
  <p>Changes for Thu Apr 11:</p>
     <ul>
	<LI> 1.2.4: Fixed the X11 YUV overlay on new NVidia drivers
	<LI> 1.2.4: Fixed a minor memory leak in the SDL thread subsystem
	<LI> 1.2.4: Fixed spurious keypress at startup on BeOS
	<LI> 1.2.4: Fixed gamma ramps in DirectX windowed and OpenGL modes
	<LI> 1.2.4: Specify the SDL API calling convention (C by default)
     </ul>
  <p>Changes for Wed Apr 10:</p>
     <ul>
	<LI> 1.2.4: BeOS compile fix for shared object loading code
     </ul>
  <p>Changes for Tue Apr 9:</p>
     <ul>
	<LI> 1.2.4: Fixed DirectX fullscreen gamma control (thanks John!)
	<LI> 1.2.4: Fixed a crash bug in the WM_ACTIVATE code (thanks John!)
     </ul>
  <p>Changes for Mon Apr 8:</p>
     <ul>
	<LI> 1.2.4: John Popplewell fixed mousewheel support on Windows
     </ul>
  <p>Changes for Thu Apr 4:</p>
     <ul>
	<LI> 1.2.4: Patrice fixed a mouse input bug in the Atari port
	<LI> 1.2.4: Added a couple of TV video modes to the fbcon driver
     </ul>
  <p>Changes for Mon Apr 1:</p>
     <ul>
	<LI> 1.2.4: Patrice fixed GNU Pthread support for threads on Atari
     </ul>
  <p>Changes for Sat Mar 30:</p>
     <ul>
	<LI> 1.2.4: Fixed SDL 1.1 RPM dependency problem (thanks Edward!)
	<LI> 1.2.4: Applied John's fixes for some international keys on Windows
	<LI> 1.2.4: Disabled QueryPerformanceCounter() due to problems on Win2K
	<LI> 1.2.4: Fixed Windows OpenGL mouse cursor/position mismatch bug
	<LI> 1.2.4: MacOS audio locking has been implemented by Ryan Gordon
	<LI> 1.2.4: The audio lock and unlock functions are part of the driver.
	<LI> 1.2.4: Patrice partially fixed up GNU PThread support for Atari port
     </ul>
  <p>Changes for Tue Mar 26:</p>
     <ul>
	<LI> 1.2.4: More Atari fixes from Patrice
     </ul>
  <p>Changes for Sat Mar 23:</p>
     <ul>
	<LI> 1.2.4: Fixed XFree86 extension library support
     </ul>
  <p>Changes for Sat Mar 23:</p>
     <ul>
	<LI> 1.2.4: Added UNIX RDTSC code by Lompik (disabled by default)
	<LI> 1.2.4: Lots of QNX fixes from Mike Gorchak:
	     <ul>
		<LI>Added 8bit palette emulation code for window mode with bpp>=15.
		<LI>Added store/restore original palette for 8bit modes.
		<LI>Added more information about photon API call fails.
		<LI>Rewroten change palette code, slow but works.
		<LI>Fixed bug with set caption before window was inited.
		<LI>Fixed bugs with some initial state of variables.
		<LI>Fixed bug with storing old video mode settings.
		<LI>Fixed bug with switching to fullscreen mode and back.
		<LI>Fixed few double SEGFAULTS during parachute mode.
		<LI>Removed compilation warning with no PgWaitHWIdle prototype.
		<LI>Removed pack of dead unusable code.
		<LI>Cleanups SDL_PrivateVideoData structure, some headers.
		<LI>Some code formatting.
             </ul>
     </ul>
  <p>Changes for Tue Mar 19:</p>
     <ul>
	<LI> 1.2.4: Win32 fullscreen alpha blit crash fix by John Popplewell
	<LI> 1.2.4: Fixed video flip bug in the Atari xbios driver
	<LI> 1.2.4: Used glext.h from the SGI sample OpenGL implementation
     </ul>
  <p>Changes for Thu Mar 7:</p>
     <ul>
	<LI> 1.2.4: Added GL attribute query support to the Quartz driver (thanks Darrell!)
	<LI> 1.2.4: Cleaned up BSD joystick driver (thanks Wilbern!)
	<LI> 1.2.4: Only put surfaces in video memory if blits are accelerated
	<LI> 1.2.4: Cleaned up Atari joystick support (thanks Patrice!)
	<LI> 1.2.4: Fixed display settings with ALT-tab and OpenGL on Windows
     </ul>
  <p>Changes for Thu Mar 7:</p>
     <ul>
	<LI> 1.2.4: Fixed reported mouse position in Quartz after mouse warp
	<LI> 1.2.4: Added Atari joystick support (thanks Patrice!)
     </ul>
  <p>Changes for Wed Mar 6:</p>
     <ul>
	<LI> 1.2.4: Fixed dynamic arts support.
	<LI> 1.2.4: Turned on dynamic audio load by default in RPM build.
	<LI> 1.2.4: Updated copyright information for 2002
	<LI> 1.2.4: Removed the API changes to preserve SDL 1.2 stability
     </ul>
  <p>Changes for Tue Mar 5:</p>
     <ul>
	<LI> 1.2.4: Added shared object loading functions in SDL_loadso.h
        <LI> 1.2.4: Added SDL_LockRect() and SDL_UnlockRect()
        <LI> 1.2.4: Incorporated XFree86 extension libraries into the source
     </ul>
  <p>Changes for Sat Mar 2:</p>
     <ul>
	<LI> 1.2.4: More QNX cleanups (including OpenGL support) from Mike Gorchak
     </ul>
  <p>Changes for Fri Mar 1:</p>
     <ul>
	<LI> 1.2.4: Fixed "short jump out of range" error in MMX code (thanks Steven)
     </ul>
  <p>Changes for Wed Feb 20:</p>
     <ul>
	<LI> 1.2.4: Updated for Watcom C++ and LCC compilers (thanks Jean-Pierre)
     </ul>
  <p>Changes for Tue Feb 19:</p>
     <ul>
	<LI> 1.2.4: Updated DirectFB video driver for DirectFB 0.9.9
     </ul>
  <p>Changes for Tue Feb 19:</p>
     <ul>
	<LI> 1.2.4: More QNX photon/nto-audio improvements by Julian Kinraid
	<LI> 1.2.4: Fixed SDL_OPENGLBLIT with OpenGL API newer than 1.2
     </ul>
  <p>Changes for Sun Feb 17:</p>
     <ul>
	<LI> 1.2.4: Added initial support for Atari (thanks Patrice!)
	<LI> 1.2.4: Updated the Project Builder archives (thanks Darrell)
     </ul>
  <p>Changes for Wed Feb 13:</p>
     <ul>
	<LI> 1.2.4: Mike Gorchak added some QNX tweaks, including OpenGL support
	<LI> 1.2.4: David Snopek added Borland compiler support
	<LI> 1.2.4: Added support for the pause key under DirectX
	<LI> 1.2.4: Updated the documentation for the SDL_PushEvent() call
	<LI> 1.2.4: Jon Atkins added a YUV overlay test program (testoverlay.c)
	<LI> 1.2.4: Added support for joysticks on *BSD (thanks Wilbern!)
     </ul>
  <p>Changes for Tue Jan 22:</p>
     <ul>
	<LI> 1.2.4: Quartz improvements: better mouse motion events
	<LI> 1.2.4: Quartz improvements: fixed minification bugs (except OpenGL)
	<LI> 1.2.4: Quartz improvements: fixed QZ_SetGamma for correct semantics
	<LI> 1.2.4: Quartz improvements: fade/unfade display before/after rez switch
	<LI> 1.2.4: SDL now compiles and works cleanly on stock BSDI.
     </ul>
  <p>Changes for Fri Jan 18:</p>
     <ul>
	<LI> 1.2.4: Fixed X11 crash when updating rectangles of zero height (thanks Mattias!)
	<LI> 1.2.4: Cleaned up XImage code and sped up byte-swapped X11 blits (thanks Mattias!)
	<LI> 1.2.4: Added Quartz version of SDL_SetIcon() for MacOS X (thanks Bob!)
	<LI> 1.2.4: Added QNX cleanups by Mike Gorchak (thanks!)
     </ul>
  <p>Changes for Wed Jan 9:</p>
     <ul>
	<LI> 1.2.4: Fixed building on Cygwin (thanks Michael)
	<LI> 1.2.4: Don't allow multiple audio opens to succeed (until SDL 1.3)
	<LI> 1.2.4: Miscellaneous build fixes (thanks Mattias)
     </ul>
  <p>Changes for Fri Dec 14:</p>
     <ul>
	<LI> 1.2.4: Updated mailing list information in INSTALL and README.Win32
	<LI> 1.2.4: Updated the e-mail address in the copyright information
	<LI> 1.2.4: Added support for building SDL for EPOC/SymbianOS 6.0 (thanks Hannu!) 
     </ul>
  <p>Changes for Wed Dec 5:</p>
     <ul>
	<LI> 1.2.4: Fix crash with Linux supermount fstab entries (thanks Erno!)
     </ul>
  <p>Changes for Mon Nov 26:</p>
     <ul>
	<LI> 1.2.4: Fixed bug in joystick detection code under Linux
     </ul>
  <p>Changes for Fri Nov 23:</p>
     <ul>
	<LI> 1.2.4: Fixed timeout in Linux condition variable implementation
     </ul>
  <p>Changes for Wed Nov 21:</p>
     <ul>
	<LI> 1.2.4: Fixed testgl so SDL_GL_Enter2DMode() allows alpha blending
	<LI> 1.2.4: Added support for Xi Graphics XME fullscreen extension
     </ul>
  <p>Changes for Wed Nov 7:</p>
     <ul>
	<LI> 1.2.3: Fixed X11 icon color allocation (thanks Mattias!)
     </ul>
  <p>Changes for Mon Nov 5:</p>
     <ul>
	<LI> 1.2.3: SDL_OPENGLBLIT is deprected, show the right way in testgl
     </ul>
  <p>Changes for Sun Nov 4:</p>
     <ul>
	<LI> 1.2.3: The Project Builder project now includes SDL_opengl.h
     </ul>
  <p>Changes for Sat Nov 3:</p>
     <ul>
	<LI> 1.2.3: Added X11 Xinerama support - fullscreen starts on screen 0
     </ul>
  <p>Changes for Fri Nov 2:</p>
     <ul>
	<LI> 1.2.3: Disabled virtual terminal check for SVGAlib video driver
	<LI> 1.2.3: Fixed building hermes objects with automake 1.5 (thanks winterlion)
	<LI> 1.2.3: Fixed key repeat interactions with event filters (thanks Elmar!)

	<LI> 1.2.3: Greatly simplified building MacOS X command line apps (thanks Max!)
	<LI> 1.2.3: The 'Analog 2-axis 4-button 1-hat FCS joystick' is now recognized as having a hat under Linux.
     </ul>
  <p>Changes for Thu Nov 1:</p>
     <ul>
	<LI> 1.2.3: Improved QNX Photon driver event handling (thanks Julian!)
	<LI> 1.2.3: Updated DirectFB backend for DirectFB version 0.9.7 (thanks Denis!)
     </ul>
  <p>Changes for Fri Oct 26:</p>
     <ul>
	<LI> 1.2.3: Fixed command line library install on MacOS X
     </ul>
  <p>Changes for Wed Oct 24:</p>
     <ul>
	<LI> 1.2.3: Use the DSBCAPS_STICKYFOCUS flag for DirectX audio
	<LI> 1.2.3: Fail if set a video mode requesting GL and can't get it
	<LI> 1.2.3: Fixed shared library creation on QNX (thanks Luca!)
	<LI> 1.2.3: Added platform independent OpenGL header - SDL_opengl.h
	<LI> 1.2.3: Broke command line library install on MacOS X
     </ul>
  <p>Changes for Mon Oct 22:</p>
     <ul>
	<LI> 1.2.3: Enabled Linux 2.4 event input support by default.
     </ul>
  <p>Changes for Tue Oct 16:</p>
     <ul>
	<LI> 1.2.3: Added Darrell's updated projects for MacOS X 10.1
     </ul>
  <p>Changes for Sun Oct 14:</p>
     <ul>
	<LI> 1.2.3: Fixed flashing the screen when creating a window on BeOS
	<LI> 1.2.3: Added double-buffering support for SVGAlib (thanks Kutak!)
     </ul>
  <p>Changes for Mon Oct 8:</p>
     <ul>
	<LI> 1.2.3: Added photon fixes submitted by Luca Barbato
     </ul>
  <p>Changes for Sun Sep 30:</p>
     <ul>
	<LI> 1.2.3: Fixed crash when using double-buffering with DGA
	<LI> 1.2.3: Fixed leadout track calculation using MCI CD-ROM code
	<LI> 1.2.3: Fixed MacOS X Objective C automake dependencies
     </ul>
  <p>Changes for Sun Sep 23:</p>
     <ul>
	<LI> 1.2.3: Improved MacOS Classic international keyboard handling (thanks Max!)
	<LI> 1.2.3: Fixed joystick code to work on MacOS X 10.1 (thanks Max!)
	<LI> 1.2.3: Added a small fix for MacOS X OpenGL code (thanks Max!)
	<LI> 1.2.3: Updated README.MacOSX on how to support command line building on MacOS X
        <LI> 1.2.3: Fixed command line building on MacOS X with UFS filesystem
	<LI> 1.2.3: Fixed resuming a paused CD on Win2K (thanks Aragorn)
        <LI> 1.2.3: Fixed QNX Photon window iconification (thanks phearbear!)
        <LI> 1.2.3: Fixed structure alignment with Metrowerks on MacOS
     </ul>
  <p>Changes for Thu Sep 13:</p>
     <ul>
        <LI> 1.2.3: Added support for the GNU Pth thread lib (thanks Mandin!)
        <LI> 1.2.3: Added the Undo key for the Atari keyboard (thanks Mandin!)
	<LI> 1.2.3: Fixed XVideo on GeForce by using last available adaptor
	<LI> 1.2.3: Updated documentation from the SDL Documentation Project
	<LI> 1.2.3: Added CD-ROM support for BSD/OS (thanks Steven!)
     </ul>
  <p>Changes for Tue Sep 11:</p>
     <ul>
        <LI> 1.2.3: Added initial support for EPOC/Symbian OS (thanks Hannu!)
	<LI> 1.2.3: Added a joystick driver for  MacOS X (thanks Max!)
        <LI> 1.2.3: Improved MacOS X international keyboard handling
     </ul>
  <p>Changes for Tue Sep  4:</p>
     <ul>
        <LI> 1.2.3: SDL will now build on Windows without audio support
        <LI> 1.2.3: Added Max's patches to build MacOS X apps on command line
        <LI> 1.2.3: Added support for DirectFB video on Linux (thanks Denis!)
        <LI> 1.2.3: Fixed Solaris nitpicks (thanks Mattias!)
        <LI> 1.2.3: Fixed joystick initialization on Windows (thanks Vitaliy!)
     </ul>
  <p>Changes for Fri Aug 31:</p>
     <ul>
        <LI> 1.2.3: Fixed mouse wheel motion position on Windows
        <LI> 1.2.3: An expose event is now sent when using XVideo output
        <LI> 1.2.3: Fixed setting the X11 title bar before window is mapped
     </ul>
  <p>Changes for Sun Aug 19:</p>
     <ul>
        <LI> 1.2.3: Fixed various issues in Quartz video (thanks Darrell!)
        <LI> 1.2.3: Use correct button in button up event on MacOS (thanks Max!)
     </ul>
  <p>Changes for Sat Aug 18:</p>
     <ul>
        <LI> 1.2.3: Fixed IDE and SCSI CD-ROM detection on BeOS (thanks Caz!)
     </ul>
  <p>Changes for Wed Aug 9:</p>
     <ul>
        <LI> 1.2.3: Audio no longer assumes sun audio API on UNIX systems
        <LI> 1.2.3: An expose event is now generated on WM_ERASEBKGND
        <LI> 1.2.3: SDL window now takes focus when clicked on Windows
        <LI> 1.2.3: Applied David's fixes for SDL_WINDOWID on Windows
     </ul>
  <p>Changes for Wed Aug 8:</p>
     <ul>
        <LI> 1.2.3: Fixed VGL detection on FreeBSD (thanks David!)
        <LI> 1.2.3: Updated ltconfig for OpenBSD (thanks Peter!)
        <LI> 1.2.3: Automated some Project Builder steps (thanks Max!)
        <LI> 1.2.3: Fixed compiling on Windows CE
        <LI> 1.2.3: Applied Paul Jenner's patches to fix "make distcheck"
        <LI> 1.2.3: Fixed buffer overflow in Linux CD code (thanks Ryan!) 
     </ul>
  <p>Changes for Wed Aug 1:</p>
     <ul>
        <LI> 1.2.3: Added 640x480 as a scaled resolution for NTSC/PAL output
        <LI> 1.2.3: Added support for TV output on the Linux PlayStation Beta
     </ul>
  <p>Changes for Tue Jul 31:</p>
     <ul>
        <LI> 1.2.3: Added initial NVidia acceleration on framebuffer console
     </ul>
  <p>Changes for Mon Jul 30:</p>
     <ul>
        <LI> 1.2.3: Added button-up with mouse-wheel on framebuffer console
        <LI> 1.2.3: Fixed audio format selection for OpenBSD (thanks Peter!)
        <LI> 1.2.3: The rectangle argument to SDL_SetClipRect is really const
        <LI> 1.2.3: Applied Maxim's patch for VGL detection on FreeBSD
        <LI> 1.2.3: Fix build when GL_CLIENT_PIXEL_STORE_BIT is not defined
     </ul>
  <p>Changes for Sun Jul 22:</p>
     <ul>
        <LI> 1.2.2: Removed lower limit from the keyboard repeat interval
        <LI> 1.2.2: Re-added SDLMain.nib to the src/main/macosx directory
        <LI> 1.2.2: Fixed crash when quitting fullscreen mode on MacOS X
        <LI> 1.2.2: Fixed fullscreen mouse events on MacOS X
        <LI> 1.2.2: Fixed noise when starting audio under DX5 (thanks Jesse!)
     </ul>
  <p>Changes for Fri Jul 20:</p>
     <ul>
	<LI> 1.2.2: Now returns an error if unable to open audio on BeOS
	<LI> 1.2.2: Fixed fullscreen/windowed mode problems on BeOS
     </ul>
  <p>Changes for Wed Jul 18:</p>
     <ul>
	<LI> 1.2.2: Fixed crash if cursor is outside of the screen bounds
	<LI> 1.2.2: Incoporated Rainer's Windows CE input/display patches
     </ul>
  <p>Changes for Sat Jul 14:</p>
     <ul>
	<LI> 1.2.2: Now gets correct keyboard state when starting up on X11
	<LI> 1.2.2: Fixed "double-switch" when switching away from fbcon
	<LI> 1.2.2: Prevent SDL from writing to Linux fb when switched away
     </ul>
  <p>Changes for Fri Jul 13:</p>
     <ul>
	<LI> 1.2.2: Merged DGA surface handling improvements into fb code
	<LI> 1.2.2: Unified framebuffer console surface locking code
	<LI> 1.2.2: Fixed matroxfb blit bug where src Y less than dst Y
	<LI> 1.2.2: Fixed fb hardware surface init with no mode change
	<LI> 1.2.2: Detect Microsoft IntelliMouse Explorer as IMPS2
	<LI> 1.2.2: Fixed crash using the -fast option to testsprite
     </ul>
  <p>Changes for Thu Jul 12:</p>
     <ul>
	<LI> 1.2.2: Greatly improved the DGA video driver - now thread-safe
     </ul>
  <p>Changes for Wed Jul 11:</p>
     <ul>
	<LI> 1.2.2: Fixed using XVidMode on older X11 servers with new code
     </ul>
  <p>Changes for Mon Jul 9:</p>
     <ul>
	<LI> 1.2.2: Reverted to non-blocking audio writes in the DSP driver
     </ul>
  <p>Changes for Sun Jul 8:</p>
     <ul>
	<LI> 1.2.2: Cleaned up the OpenBSD port, thanks to Peter Valchev
     </ul>
  <p>Changes for Sat Jul 7:</p>
     <ul>
	<LI> 1.2.2: Changed DSP audio driver to use blocking writes
	<LI> 1.2.2: Fixed possible dropout in DSP audio driver (thanks Hannu!)
	<LI> 1.2.2: Fixed DMA audio with some Linux sound card drivers
	<LI> 1.2.2: Fixed running on XFree86 v3 when built on XFree86 v4
	<LI> 1.2.2: Hopefully fixed X11 fullscreen problems with KDE 2.1
	<LI> 1.2.2: Added Holger Schemel's fix for SDL_GetTicks() on W2K
     </ul>
  <p>Changes for Sun Jul 1:</p>
     <ul>
	<LI> 1.2.2: Dummy audio and video drivers are enabled (thanks Ryan!)
	<LI> 1.2.2: Added support for inline when using Visual C++
	<LI> 1.2.2: Added a symlink to SDL 1.2 from libSDL-1.1.so.0 in RPMs
	<LI> 1.2.2: When fullscreen in X11, leavenotify sends mouse motion
     </ul>
  <p>Changes for Tue Jun 19:</p>
     <ul>
	<LI> 1.2.2: Added FreeBSD VGL video driver from FreeBSD ports
     </ul>
  <p>Changes for Fri Jun 15:</p>
     <ul>
        <LI> 1.2.1: Added Linux PlayStation 2 Graphics Synthesizer support
        <LI> 1.2.1: Added an audio driver that writes to disk (thanks Ryan!)
        <LI> 1.2.1: Mouse wheel sends mouse button (4/5) events on Windows
        <LI> 1.2.1: Added check for SVGALib 2.0 (thanks Benjamin!)
        <LI> 1.2.1: Updated MacOS X Project Builder projects (thanks Darrell!)
     </ul>
  <p>Changes for Sun Jun 10:</p>
     <ul>
        <LI> 1.2.1: Integrated the latest SDL Documentation Project files
        <LI> 1.2.1: Added MacOS X Project Builder projects (thanks Darrell!)
        <LI> 1.2.1: Disabled Linux /dev/event joystick interface by default
     </ul>
  <p>Changes for Thu Jun  7:</p>
     <ul>
	<LI> 1.2.1: Fixed bug in Win32 joystick motion (thanks Alexandre!)
	<LI> 1.2.1: Added initial support for Quartz video (thanks Darrell!)
	<LI> 1.2.1: Fix DIB palette creation in windowed mode at 8 bpp
	<LI> 1.2.1: Fixed compiling SDL_dibvideo.c (thanks Ryan!)
     </ul>
  <p>Changes for Sat May 26:</p>
     <ul>
	<LI> 1.2.1: Improved NetBSD port, including pthreads support
	<LI> 1.2.1: Added native OpenBSD audio driver (thanks vedge!)
     </ul>
  <p>Changes for Wed May 23:</p>
     <ul>
	<LI> 1.2.1: Integrated Windows CE patches from Rainer Loritz
     </ul>
  <p>Changes for Tue May 22:</p>
     <ul>
	<LI> 1.2.1: Added detection of Open Sound System on Solaris x86
     </ul>
  <p>Changes for Fri May 11:</p>
     <ul>
	<LI> 1.2.1: Caught up with location of Cygwin Win32 API libraries
     </ul>
  <p>Changes for Thu May 10:</p>
     <ul>
	<LI> 1.2.1: Added initial support for Nano-X (thanks Hsieh-Fu!)
	<LI> 1.2.1: Updated config.guess and config.sub
	<LI> 1.2.1: Use correct default CD-ROM device on OpenBSD (thanks Peter!)
	<LI> 1.2.1: Fixed endian detection on IA64 architectures (thanks Bill!)
	<LI> 1.2.1: Fixed strip_fPIC.sh for Solaris x86
	<LI> 1.2.1: Updated the Amiga OS port of SDL (thanks Gabriele!)
	<LI> 1.2.1: Integrated lots of QNX patches by Mike Gorchak
	<LI> 1.2.1: Added pthread.h for the Linux semaphore code
	<LI> 1.2.1: Fixed crash in GGI detection and initialization
	<LI> 1.2.1: Added --disable-dga configure option to disable DGA
     </ul>
  <p>Changes for Tue May 1:</p>
     <ul>
	<LI> 1.2.1: Fixed stuck keys when changing the video mode
     </ul>
  <p>Changes for Sun Apr 29:</p>
     <ul>
	<LI> 1.2.1: Fixed double-mouse event bug on Windows using OpenGL
	<LI> 1.2.1: Fixed key repeat detection under newer X servers
     </ul>
  <p>Changes for Sat Apr 28:</p>
     <ul>
	<LI> 1.2.1: Fixed left arrow on iBook keyboard under MacOS X
     </ul>
  <p>Changes for Fri Apr 27:</p>
     <ul>
	<LI> 1.2.1: Fixed memory leak in software YUV stretching code
	<LI> 1.2.1: Fixed relative motion checking after restore under X11
     </ul>
  <p>Changes for Thu Apr 26:</p>
     <ul>
	<LI> 1.2.1: Fixed 320x200 video mode on framebuffer console
	<LI> 1.2.1: Improved robustness for the ELO touchpad (thanks Alex!)
     </ul>
  <p>Changes for Tue Apr 24:</p>
     <ul>
	<LI> 1.2.1: Added support for building under Cygwin on Windows
	<LI> 1.2.1: Fixed crash with OpenGL on BeOS caused by cursor fix
	<LI> 1.2.1: The dummy video driver is not compiled by default
	<LI> 1.2.1: Added fix needed to keep alpha opaque in RGB->RGBA blits
     </ul>
  <p>Changes for Wed Apr 18:</p>
     <ul>
	<LI> 1.2.1: Added a dummy video driver for benchmarking (thanks Ryan!)
     </ul>
  <p>Changes for Tue Apr 17:</p>
     <ul>
	<LI> 1.2.1: Fixed fullscreen cursor offset bug on BeOS
     </ul>
  <p>Changes for Mon Apr 9:</p>
     <ul>
	<LI> 1.2.1: Added Enzo's patch for capslock under Windows
	<LI> 1.2.1: Added Mattias' patch for fast 50% alpha blits
     </ul>
  <p>Changes for Tue Apr 3:</p>
     <ul>
	<LI> 1.2.1: Integrated a bunch of patches for OpenBSD
	<LI> 1.2.1: Added a fix for 8-bit palettized modes with SVGAlib
	<LI> 1.2.1: Added fixes for using nasm on Solaris x86
	<LI> 1.2.1: Added potential workaround for QNX ld detection problem
     </ul>
  <p>Changes for Thu Mar 29:</p>
     <ul>
	<LI> 1.2.1: Fixed endian detection on Hitachi SuperH (thanks M.R.)
     </ul>
</blockquote>
<hr>
<?PHP
 include ("footer.inc");
?>
