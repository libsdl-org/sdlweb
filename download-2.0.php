<!DOCTYPE html>
<html>
    <head>        
        <title>Simple DirectMedia Layer - SDL version 2.0.12 (stable)</title>
        <?php require_once("include/meta.inc.php"); ?><?php $current_page = basename(__FILE__, '.php'); ?>
    </head>
    <body>        
        <div id="wrapper">
            <?php require_once("include/header.inc.php"); ?>
            <div id="left">
                <?php require_once("include/sidebar.inc.php"); ?>
            </div>
            <div id="content">
               <h1>SDL version 2.0.12 (stable)</h1>
                <div class="col left">
                  
                    <a name="source"></a>
                    <h2>Source Code:</h2>
                    <blockquote>
<!--
                    	<a href="release/changes-2.0.html">What's New</a></br>
-->

                        <a href="release/SDL2-2.0.12.zip"
                           >SDL2-2.0.12.zip</a>
                        - <a href="release/SDL2-2.0.12.zip.sig">GPG signed</a><br>
                        <a href="release/SDL2-2.0.12.tar.gz"
                           >SDL2-2.0.12.tar.gz</a>
                        - <a href="release/SDL2-2.0.12.tar.gz.sig">GPG signed</a><br>
                    </blockquote>

                    <h2>Runtime Binaries:</h2>
                    <blockquote>
                        <p><span class="title">
                                Windows:
                            </span><br>
                            <a href="release/SDL2-2.0.12-win32-x86.zip"
                               >SDL2-2.0.12-win32-x86.zip</a> (32-bit Windows)<br>
                            <a href="release/SDL2-2.0.12-win32-x64.zip"
                               >SDL2-2.0.12-win32-x64.zip</a> (64-bit Windows)<br>
                        </p>
                        <p><span class="title">
                                Mac OS X:
                            </span><br>
                            <a href="release/SDL2-2.0.12.dmg"
                               >SDL2-2.0.12.dmg</a><br>
                        </p>
                        <p><span class="title">
                                Linux:
                            </span><br>
		            Please contact your distribution maintainer for updates.
                        </p>
                    </blockquote>

                    <h2>Development Libraries:</h2>
                    <blockquote>
	                    <p><span class="title">
		                    Windows:
		                    </span><br>
		                    <a href="release/SDL2-devel-2.0.12-VC.zip"
		                                    >SDL2-devel-2.0.12-VC.zip</a> (Visual C++ 32/64-bit)<br>
		                    <a href="release/SDL2-devel-2.0.12-mingw.tar.gz"
		                                    >SDL2-devel-2.0.12-mingw.tar.gz</a> (<a href="http://mingw-w64.sourceforge.net/">MinGW</a> 32/64-bit)<br>
	                    </p>
	                    <p><span class="title">
		                    Mac OS X:
		                    </span><br>
		                    <a href="release/SDL2-2.0.12.dmg"
		                                    >SDL2-2.0.12.dmg</a><br>
	                    </p>
	                    <p><span class="title">
		                    Linux:
		                    </span><br>
		                    Please contact your distribution maintainer for updates.
	                    </p>
	                    <p><span class="title">
		                    iOS &amp; Android:
		                    </span><br>
		                    Projects for these platforms are included with the <a href="#source">source</a>.
	                    </p>
                    </blockquote>

                    <p>
                        Older versions of SDL are available <a href="release/">here</a>.
                    </p>

                </div>

                <div class="col right">
                    <h2>GPG Signature:</h2>
                    <p>
                        The source code to this release has been signed by Sam Lantinga.
                        <br>
                        You can get the public key from any keyserver with the key id 0xA7763BE6,
                        or directly from Sam's home page:
                        <a href="http://slouken.libsdl.org/slouken-pubkey.asc"
                           >slouken-pubkey.asc</a>
                        <br>
                        The public key fingerprint should be:<pre class="small">
pub  1024D/A7763BE6 2001-01-05 Sam Lantinga &lt;slouken@libsdl.org&gt;
     Key fingerprint = 1528 635D 8053 A57F 77D1  E086 30A5 9377 A776 3BE6</pre>
                    </p>
                    <p>
                        For more information about public key signatures, see
                        <a href="http://www.gnupg.org/">http://www.gnupg.org/</a>
                    </p>

                </div>                
            </div>
            <div class="clearer"></div>            

        </div>
        <?php require_once("include/footer.inc.php"); ?> 

    </body>
</html>
