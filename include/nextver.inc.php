<?php
// Update these on each release.
$current_sdl_major = 2;
$current_sdl_minor = 0;
$current_sdl_patch = 20;
$next_sdl_version_duedate = "March 31, 2022 23:59:59 GMT-0800";

// for 2.0.20 we added a new milestone, so this number is out of order for the next few versions. Don't just bump it by one!
$github_milestone_id = '3';   // sadly, these don't have version strings, so we have to update for each release.

// don't touch these.
$current_sdl_version = "$current_sdl_major.$current_sdl_minor.$current_sdl_patch";
$development_sdl_version = "$current_sdl_major.$current_sdl_minor." . ($current_sdl_patch + 1);
$next_sdl_version = "$current_sdl_major.$current_sdl_minor." . ($current_sdl_patch + 2);
?>
