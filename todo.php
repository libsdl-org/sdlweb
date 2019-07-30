<?php
    $nextver = '2.0.11';
    $url = "https://bugzilla.libsdl.org/buglist.cgi?bug_status=UNCONFIRMED&bug_status=NEW&bug_status=WAITING&bug_status=RESPONDED&bug_status=ASSIGNED&bug_status=REOPENED&keywords=target-$nextver&keywords_type=allwords&known_name=$nextver%20TODO&order=Bug%20Number&query_format=advanced";
?>
<html><head><title>Next SDL release's TODO list!</title>
<meta http-equiv="Refresh" content="0; url=<?php print($url)?>">
</head><body><center>
<p>The next release of SDL is <b><?php print($nextver) ?>.</b></p>
<p>We are redirecting you to the TODO buglist for this version now. If you
aren't sent there automtically, you can
click <a href="<?php print($url); ?>">here</a> instead.</p>
</center></body></html>

