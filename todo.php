<?php
    $nextver = '2.0.11';
    $url = "https://bugzilla.libsdl.org/buglist.cgi?bug_status=UNCONFIRMED&bug_status=NEW&bug_status=WAITING&bug_status=RESPONDED&bug_status=ASSIGNED&bug_status=REOPENED&keywords=target-$nextver&keywords_type=allwords&known_name=$nextver%20TODO&order=Bug%20Number&query_format=advanced";
?>
<html><head><title>Next SDL release's TODO list!</title>
<meta http-equiv="Refresh" content="0; url=<?php print($url)?>">
</head><body><center>
The next release of SDL is <?php print($nextver) ?> and you can see what's
left on the TODO list <a href="<?php print($url); ?>">here</a>.
</center></body></html>

