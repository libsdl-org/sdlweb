<!DOCTYPE html>
<html>
    <head>        
        <title>Simple DirectMedia Layer - Homepage</title>
       <?php require_once("include/meta.inc.php"); ?><?php $current_page = basename(__FILE__, '.php'); ?>
    </head>
    <body class="home">        
        <div id="wrapper">
            <?php require_once("include/header.inc.php"); ?>
            <div id="left">
                <?php require_once("include/sidebar.inc.php"); ?>
            </div>
            <div id="content">
                <h1>About SDL</h1>
                <div class="col left">
                    <p> Simple DirectMedia Layer is a cross-platform development library designed to provide low level access to audio, keyboard, mouse, joystick, and graphics hardware via OpenGL and Direct3D. It is used by video playback software, emulators, and popular games including <a href="http://valvesoftware.com">Valve</a>'s award winning catalog and many <a href="https://www.humblebundle.com/">Humble Bundle</a> games.
                    </p><p>
			SDL officially supports Windows, Mac OS X, Linux, iOS, and Android.  Support for other platforms may be found in the source code.
                    </p><p>
                        SDL is written in C, works natively with C++, and there are <a href="languages.php">bindings available</a> for several other languages, including C# and Python.
                    </p><p>
                        SDL 2.0 is distributed under the <a href="license.php">zlib license</a>. This license allows you to use SDL freely in any software. </p>
                </div>
                <?php
// FIXME: This should go into a database soon.
$games = array(
    array("0 A.D.", "https://play0ad.com", "media/games/0ad.png"),
    array("1000 Amps", "http://store.steampowered.com/app/205690", "http://cdn.akamai.steamstatic.com/steam/apps/205690/header.jpg"),
    array("7 Grand Steps", "http://www.7grandsteps.com", "http://cdn.akamai.steamstatic.com/steam/apps/238930/header.jpg"),
    array("Amnesia: The Dark Descent", "http://amnesiagame.com", "http://cdn.akamai.steamstatic.com/steam/apps/57300/header.jpg"),
    array("Analogue: A Hate Story", "http://store.steampowered.com/app/209370", "http://cdn.akamai.steamstatic.com/steam/apps/209370/header.jpg"),
    array("A New Beginning - Final Cut", "http://store.steampowered.com/app/105000", "http://cdn.akamai.steamstatic.com/steam/apps/105000/header.jpg"),
    array("Ankh 2: Heart of Osiris", "http://store.steampowered.com/app/12440", "http://cdn.akamai.steamstatic.com/steam/apps/12440/header.jpg"),
    array("Ankh 3: Battle of the Gods", "http://store.steampowered.com/app/12450", "http://cdn.akamai.steamstatic.com/steam/apps/12450/header.jpg"),
    array("Aquaria", "http://store.steampowered.com/app/24420", "http://cdn.akamai.steamstatic.com/steam/apps/24420/header.jpg"),
    array("Arcadia", "http://store.steampowered.com/app/72500", "http://cdn.akamai.steamstatic.com/steam/apps/72500/header.jpg"),
    array("Awesomenauts", "http://store.steampowered.com/app/204300", "http://cdn.akamai.steamstatic.com/steam/apps/204300/header.jpg"),
    array("Azada", "http://store.steampowered.com/app/7340", "http://cdn.akamai.steamstatic.com/steam/apps/7340/header.jpg"),
    array("Baba Is You", "http://store.steampowered.com/app/736260", "http://cdn.akamai.steamstatic.com/steam/apps/736260/header.jpg"),
    array("Barotrauma", "http://store.steampowered.com/app/602960", "http://cdn.akamai.steamstatic.com/steam/apps/602960/header.jpg"),
    array("Bastion", "http://store.steampowered.com/app/107100", "http://cdn.akamai.steamstatic.com/steam/apps/107100/header.jpg"),
    array("The Battle for Wesnoth", "http://store.steampowered.com/app/599390", "http://cdn.akamai.steamstatic.com/steam/apps/599390/header.jpg"),
    array("Braid", "http://store.steampowered.com/app/26800", "http://cdn.akamai.steamstatic.com/steam/apps/26800/header.jpg"),
    array("BRAINPIPE: A Plunge to Unhumanity", "http://store.steampowered.com/app/35800", "http://cdn.akamai.steamstatic.com/steam/apps/35800/header.jpg"),
    array("Broken Age", "http://store.steampowered.com/app/232790", "http://cdn.akamai.steamstatic.com/steam/apps/232790/header.jpg"),
    array("Broken Sword 2: The Smoking Mirror", "http://store.steampowered.com/app/33600", "http://cdn.akamai.steamstatic.com/steam/apps/33600/header.jpg"),
    array("Brutal Legend", "http://store.steampowered.com/app/225260", "http://cdn.akamai.steamstatic.com/steam/apps/225260/header.jpg"),
    array("Caster", "http://store.steampowered.com/app/29800", "http://cdn.akamai.steamstatic.com/steam/apps/29800/header.jpg"),
    array("Cave Story+", "http://store.steampowered.com/app/200900", "http://cdn.akamai.steamstatic.com/steam/apps/200900/header.jpg"),
    array("Chaos on Deponia", "http://store.steampowered.com/app/220740", "http://cdn.akamai.steamstatic.com/steam/apps/220740/header.jpg"),
    array("Closure", "http://store.steampowered.com/app/72000", "http://cdn.akamai.steamstatic.com/steam/apps/72000/header.jpg"),
    array("Conquest Of Elysium 3", "http://store.steampowered.com/app/211900", "http://cdn.akamai.steamstatic.com/steam/apps/211900/header.jpg"),
    array("Costume Quest", "http://store.steampowered.com/app/115100", "http://cdn.akamai.steamstatic.com/steam/apps/115100/header.jpg"),
    array("Dangerous High School Girls in Trouble", "http://www.mousechief.com/dhsg", "http://cdn.akamai.steamstatic.com/steam/apps/27400/header.jpg"),
    array("Data Jammers: FastForward", "http://store.steampowered.com/app/110500", "http://cdn.akamai.steamstatic.com/steam/apps/110500/header.jpg"),
    array("Day of Defeat", "http://store.steampowered.com/app/30", "http://cdn.akamai.steamstatic.com/steam/apps/30/header.jpg"),
    array("Day of the Tentacle Remastered", "http://store.steampowered.com/app/388210", "http://cdn.akamai.steamstatic.com/steam/apps/388210/header.jpg"),
    array("Dead Cells", "http://store.steampowered.com/app/588650", "http://cdn.akamai.steamstatic.com/steam/apps/588650/header.jpg"),
    array("Death Rally", "http://store.steampowered.com/app/108700", "http://cdn.akamai.steamstatic.com/steam/apps/108700/header.jpg"),
    array("Deponia Doomsday", "http://store.steampowered.com/app/421050", "http://cdn.akamai.steamstatic.com/steam/apps/421050/header.jpg"),
    array("Deponia", "http://store.steampowered.com/app/214340", "http://cdn.akamai.steamstatic.com/steam/apps/214340/header.jpg"),
    array("Digital Combat Simulator: Black Shark", "http://store.steampowered.com/app/61000", "http://cdn.akamai.steamstatic.com/steam/apps/61000/header.jpg"),
    array("Divinity: Original Sin 2", "http://store.steampowered.com/app/435150", "http://cdn.akamai.steamstatic.com/steam/apps/435150/header.jpg"),
    array("Divinity: Original Sin", "http://store.steampowered.com/app/373420", "http://cdn.akamai.steamstatic.com/steam/apps/373420/header.jpg"),
    array("Don't Starve", "http://store.steampowered.com/app/219740", "http://cdn.akamai.steamstatic.com/steam/apps/219740/header.jpg"),
    array("Don't Starve Together", "http://store.steampowered.com/app/322330", "http://cdn.akamai.steamstatic.com/steam/apps/322330/header.jpg"),
    array("Dota 2", "http://store.steampowered.com/app/570", "http://cdn.akamai.steamstatic.com/steam/apps/570/header.jpg"),
    array("Dota Underlords", "http://store.steampowered.com/app/1046930", "http://cdn.akamai.steamstatic.com/steam/apps/1046930/header.jpg"),
    array("Drawn: The Painted Tower", "http://store.steampowered.com/app/51060", "http://cdn.akamai.steamstatic.com/steam/apps/51060/header.jpg"),
    array("Dungeons of Dredmor", "http://store.steampowered.com/app/98800", "http://cdn.akamai.steamstatic.com/steam/apps/98800/header.jpg"),
    array("Dyad", "http://store.steampowered.com/app/223450", "http://cdn.akamai.steamstatic.com/steam/apps/223450/header.jpg"),
    array("Dying Light", "http://store.steampowered.com/app/239140", "http://cdn.akamai.steamstatic.com/steam/apps/239140/header.jpg"),
    array("Dynamite Jack", "http://www.galcon.com/dynamitejack", "http://cdn.akamai.steamstatic.com/steam/apps/202730/header.jpg"),
    array("EDGE", "http://store.steampowered.com/app/38740", "http://cdn.akamai.steamstatic.com/steam/apps/38740/header.jpg"),
    array("Edna &amp; Harvey: Harvey's New Eyes", "http://store.steampowered.com/app/219910", "http://cdn.akamai.steamstatic.com/steam/apps/219910/header.jpg"),
    array("Eversion", "http://store.steampowered.com/app/33680", "http://cdn.akamai.steamstatic.com/steam/apps/33680/header.jpg"),
    array("Everyday Shooter", "http://store.steampowered.com/app/16300", "http://cdn.akamai.steamstatic.com/steam/apps/16300/header.jpg"),
    array("Factorio", "http://store.steampowered.com/app/427520", "http://cdn.akamai.steamstatic.com/steam/apps/427520/header.jpg"),
    array("Farm Together", "http://store.steampowered.com/app/673950", "http://cdn.akamai.steamstatic.com/steam/apps/673950/header.jpg"),
    array("FlapMMO", "https://play.google.com/store/apps/details?id=com.flapmmo.android", "media/games/flapmmo.png"),
    array("Freeciv", "http://freeciv.org", "media/games/freeciv.png"),
    array("FTL: Faster Than Light", "http://store.steampowered.com/app/212680", "http://cdn.akamai.steamstatic.com/steam/apps/212680/header.jpg"),
    array("Fugl", "https://store.steampowered.com/app/643810/Fugl/", "http://cdn.akamai.steamstatic.com/steam/apps/643810/header.jpg"),
    array("Future Unfolding", "http://store.steampowered.com/app/539340", "http://cdn.akamai.steamstatic.com/steam/apps/539340/header.jpg"),
    array("Galcon Fusion", "http://www.galcon.com/fusion/", "http://cdn.akamai.steamstatic.com/steam/apps/44200/header.jpg"),
    array("Gish", "http://store.steampowered.com/app/9500", "http://cdn.akamai.steamstatic.com/steam/apps/9500/header.jpg"),
    array("Hacker Evolution Duality", "http://store.steampowered.com/app/70120", "http://cdn.akamai.steamstatic.com/steam/apps/70120/header.jpg"),
    array("Half-Life 2", "http://store.steampowered.com/app/220", "http://cdn.akamai.steamstatic.com/steam/apps/220/header.jpg"),
    array("Half-Life", "http://store.steampowered.com/app/70", "http://cdn.akamai.steamstatic.com/steam/apps/70/header.jpg"),
    array("Half-Life: Alyx", "http://store.steampowered.com/app/546560", "http://cdn.akamai.steamstatic.com/steam/apps/546560/header.jpg"),
    array("Hedgewars", "https://hedgewars.org", "media/games/hedgewars.png"),
    array("Heroes of Might &amp; Magic III", "http://store.steampowered.com/app/297000", "http://cdn.akamai.steamstatic.com/steam/apps/297000/header.jpg"),
    array("Infested Planet", "http://store.steampowered.com/app/204530", "http://cdn.akamai.steamstatic.com/steam/apps/204530/header.jpg"),
    array("Inside a Star-filled Sky", "http://store.steampowered.com/app/104100", "http://cdn.akamai.steamstatic.com/steam/apps/104100/header.jpg"),
    array("Into the Breach", "http://store.steampowered.com/app/590380", "http://cdn.akamai.steamstatic.com/steam/apps/590380/header.jpg"),
    array("Ion Fury", "http://store.steampowered.com/app/562860", "http://cdn.akamai.steamstatic.com/steam/apps/562860/header.jpg"),
    array("Jack Keane", "http://store.steampowered.com/app/12340", "http://cdn.akamai.steamstatic.com/steam/apps/12340/header.jpg"),
    array("Jack Keane", "http://store.steampowered.com/app/12440", "http://cdn.akamai.steamstatic.com/steam/apps/12440/header.jpg"),
    array("Jewel Quest Pack", "http://store.steampowered.com/app/37960", "http://cdn.akamai.steamstatic.com/steam/apps/37960/header.jpg"),
    array("Left 4 Dead 2", "http://store.steampowered.com/app/550", "http://cdn.akamai.steamstatic.com/steam/apps/550/header.jpg"),
    array("Magical Diary", "http://store.steampowered.com/app/211340", "http://cdn.akamai.steamstatic.com/steam/apps/211340/header.jpg"),
    array("Mahjong Quest Collection", "http://store.steampowered.com/app/38000", "http://cdn.akamai.steamstatic.com/steam/apps/38000/header.jpg"),
    array("Mayhem Intergalactic", "http://store.steampowered.com/app/18600", "http://cdn.akamai.steamstatic.com/steam/apps/18600/header.jpg"),
    array("Memoria", "http://store.steampowered.com/app/243200", "http://cdn.akamai.steamstatic.com/steam/apps/243200/header.jpg"),
    array("Move or Die", "http://store.steampowered.com/app/323850", "http://cdn.akamai.steamstatic.com/steam/apps/323850/header.jpg"),
    array("Musaic Box", "http://store.steampowered.com/app/29130", "http://cdn.akamai.steamstatic.com/steam/apps/29130/header.jpg"),
    array("My Tribe", "http://store.steampowered.com/app/51010", "http://cdn.akamai.steamstatic.com/steam/apps/51010/header.jpg"),
    array("Natural Selection 2", "http://store.steampowered.com/app/4920", "http://cdn.akamai.steamstatic.com/steam/apps/4920/header.jpg"),
    array("OpenTTD", "https://www.openttd.org", "media/games/openttd.png"),
    array("Painkiller Hell &amp; Damnation", "http://store.steampowered.com/app/214870", "http://cdn.akamai.steamstatic.com/steam/apps/214870/header.jpg"),
    array("Penumbra Overture", "http://penumbragame.com", "http://cdn.akamai.steamstatic.com/steam/apps/22180/header.jpg"),
    array("Poker Superstars II", "http://store.steampowered.com/app/4100", "http://cdn.akamai.steamstatic.com/steam/apps/4100/header.jpg"),
    array("Poppy Kart", "http://apps.webrox.fr/?page_id=8Change", "media/games/poppykart-sdl.png"),
    array("Portal", "http://store.steampowered.com/app/400", "http://cdn.akamai.steamstatic.com/steam/apps/400/header.jpg"),
    array("Postal 2 Complete", "http://store.steampowered.com/app/223470", "http://cdn.akamai.steamstatic.com/steam/apps/223470/header.jpg"),
    array("Postal", "http://store.steampowered.com/app/232770", "http://cdn.akamai.steamstatic.com/steam/apps/232770/header.jpg"),
    array("Precipice of Darkness, Episode Two", "http://store.steampowered.com/app/18020", "http://cdn.akamai.steamstatic.com/steam/apps/18020/header.jpg"),
    array("Prison Architect", "http://store.steampowered.com/app/233450", "http://cdn.akamai.steamstatic.com/steam/apps/233450/header.jpg"),
    array("Professor Fizzwizzle and the Molten Mystery", "http://store.steampowered.com/app/50910", "http://cdn.akamai.steamstatic.com/steam/apps/50910/header.jpg"),
    array("Professor Fizzwizzle", "http://store.steampowered.com/app/50900", "http://cdn.akamai.steamstatic.com/steam/apps/50900/header.jpg"),
    array("Proteus", "http://store.steampowered.com/app/219680", "http://cdn.akamai.steamstatic.com/steam/apps/219680/header.jpg"),
    array("Psychonauts", "http://store.steampowered.com/app/3830", "http://cdn.akamai.steamstatic.com/steam/apps/3830/header.jpg"),
    array("Pyre", "http://store.steampowered.com/app/462770", "http://cdn.akamai.steamstatic.com/steam/apps/462770/header.jpg"),
    array("Robin Hood: The Legend of Sherwood", "http://store.steampowered.com/app/46560", "http://cdn.akamai.steamstatic.com/steam/apps/46560/header.jpg"),
    array("RUSH", "http://store.steampowered.com/app/38720", "http://cdn.akamai.steamstatic.com/steam/apps/38720/header.jpg"),
    array("Seed of Andromeda", "https://www.seedofandromeda.com", "media/games/seedofandromeda.png"),
    array("Shatter", "http://store.steampowered.com/app/20820", "http://cdn.akamai.steamstatic.com/steam/apps/20820/header.jpg"),
    array("Shovel Knight: Specter of Torment", "http://store.steampowered.com/app/589510", "http://cdn.akamai.steamstatic.com/steam/apps/589510/header.jpg"),
    array("Snapshot", "http://store.steampowered.com/app/204220", "http://cdn.akamai.steamstatic.com/steam/apps/204220/header.jpg"),
    array("SolForge", "http://store.steampowered.com/app/232450", "http://cdn.akamai.steamstatic.com/steam/apps/232450/header.jpg"),
    array("Sorcery!", "http://store.steampowered.com/app/411000", "http://cdn.akamai.steamstatic.com/steam/apps/411000/header.jpg"),
    array("SpaceChem", "http://store.steampowered.com/app/92800", "http://cdn.akamai.steamstatic.com/steam/apps/92800/header.jpg"),
    array("SpeedRunners", "http://store.steampowered.com/app/207140", "http://cdn.akamai.steamstatic.com/steam/apps/207140/header.jpg"),
    array("Spirits", "http://store.steampowered.com/app/210170", "http://cdn.akamai.steamstatic.com/steam/apps/210170/header.jpg"),
    array("Stacking", "http://store.steampowered.com/app/115110", "http://cdn.akamai.steamstatic.com/steam/apps/115110/header.jpg"),
    array("Steel Storm: Burning Retribution", "http://store.steampowered.com/app/96200", "http://cdn.akamai.steamstatic.com/steam/apps/96200/header.jpg"),
    array("Stellaris", "http://store.steampowered.com/app/281990", "http://cdn.akamai.steamstatic.com/steam/apps/281990/header.jpg"),
    array("Still Life 2", "http://store.steampowered.com/app/46490", "http://cdn.akamai.steamstatic.com/steam/apps/46490/header.jpg"),
    array("Still Life", "http://store.steampowered.com/app/46480", "http://cdn.akamai.steamstatic.com/steam/apps/46480/header.jpg"),
    array("Superbrothers: Sword & Sworcery EP", "http://store.steampowered.com/app/204060", "http://cdn.akamai.steamstatic.com/steam/apps/204060/header.jpg"),
    array("SuperTux", "https://www.supertux.org", "media/games/supertux.png"),
    array("SuperTuxKart", "https://supertuxkart.net", "media/games/supertuxkart.png"),
    array("Swords and Soldiers HD", "http://store.steampowered.com/app/63500", "http://cdn.akamai.steamstatic.com/steam/apps/63500/header.jpg"),
    array("Syberia", "http://store.steampowered.com/app/46500", "http://cdn.akamai.steamstatic.com/steam/apps/46500/header.jpg"),
    array("Syberia II", "http://store.steampowered.com/app/46510", "http://cdn.akamai.steamstatic.com/steam/apps/46510/header.jpg"),
    array("Tales of Berseria", "http://store.steampowered.com/app/429660", "http://cdn.akamai.steamstatic.com/steam/apps/429660/header.jpg"),
    array("Team Fortress 2", "http://store.steampowered.com/app/440", "http://cdn.akamai.steamstatic.com/steam/apps/440/header.jpg"),
    array("The Dark Eye: Chains of Satinav", "http://store.steampowered.com/app/203830", "http://cdn.akamai.steamstatic.com/steam/apps/203830/header.jpg"),
    array("The Night of the Rabbit", "http://store.steampowered.com/app/230820", "http://cdn.akamai.steamstatic.com/steam/apps/230820/header.jpg"),
    array("The Whispered World", "http://store.steampowered.com/app/18490", "http://cdn.akamai.steamstatic.com/steam/apps/18490/header.jpg"),
    array("They Bleed Pixels", "http://store.steampowered.com/app/211260", "http://cdn.akamai.steamstatic.com/steam/apps/211260/header.jpg"),
    array("Thimbleweed Park™", "http://store.steampowered.com/app/569860", "http://cdn.akamai.steamstatic.com/steam/apps/569860/header.jpg"),
    array("Tiny and Big: Grandpa's Leftovers", "http://store.steampowered.com/app/205910", "http://cdn.akamai.steamstatic.com/steam/apps/205910/header.jpg"),
    array("Toki Tori", "http://store.steampowered.com/app/38700", "http://cdn.akamai.steamstatic.com/steam/apps/38700/header.jpg"),
    array("Trials 2: Second Edition", "http://store.steampowered.com/app/16600", "http://cdn.akamai.steamstatic.com/steam/apps/16600/header.jpg"),
    array("Umineko When They Cry - Answer Arcs", "http://store.steampowered.com/app/639490", "http://cdn.akamai.steamstatic.com/steam/apps/639490/header.jpg"),
    array("Umineko When They Cry - Question Arcs", "http://store.steampowered.com/app/406550", "http://cdn.akamai.steamstatic.com/steam/apps/406550/header.jpg"),
    array("UnEpic", "http://store.steampowered.com/app/233980", "http://cdn.akamai.steamstatic.com/steam/apps/233980/header.jpg"),
    array("Uplink", "http://store.steampowered.com/app/1510", "http://cdn.akamai.steamstatic.com/steam/apps/1510/header.jpg"),
    array("Vertex Dispenser", "http://store.steampowered.com/app/102400", "http://cdn.akamai.steamstatic.com/steam/apps/102400/header.jpg"),
    array("VVVVVV", "http://store.steampowered.com/app/70300", "http://cdn.akamai.steamstatic.com/steam/apps/70300/header.jpg"),
    array("Waking Mars", "http://store.steampowered.com/app/227200", "http://cdn.akamai.steamstatic.com/steam/apps/227200/header.jpg"),
    array("Waveform", "http://store.steampowered.com/app/204180", "http://cdn.akamai.steamstatic.com/steam/apps/204180/header.jpg"),
    array("Weird Worlds: Return to Infinite Space", "http://store.steampowered.com/app/226120", "http://cdn.akamai.steamstatic.com/steam/apps/226120/header.jpg"),
    array("World of Goo", "http://store.steampowered.com/app/22000", "http://cdn.akamai.steamstatic.com/steam/apps/22000/header.jpg"),
    array("X-COM: Apocalypse", "http://store.steampowered.com/app/7660", "http://cdn.akamai.steamstatic.com/steam/apps/7660/header.jpg"),
    array("X-COM: Terror from the Deep", "http://store.steampowered.com/app/7650", "http://cdn.akamai.steamstatic.com/steam/apps/7650/header.jpg"),
    array("X-COM: UFO Defense", "http://store.steampowered.com/app/7760", "http://cdn.akamai.steamstatic.com/steam/apps/7760/header.jpg"),
    array("Xenonauts", "http://store.steampowered.com/app/223830", "http://cdn.akamai.steamstatic.com/steam/apps/223830/header.jpg"),
    array("Xonotic", "https://xonotic.org", "media/games/xonotic.png"),
    array("Zen Bound 2", "http://store.steampowered.com/app/61600", "http://cdn.akamai.steamstatic.com/steam/apps/61600/header.jpg"),
);

// Set this to True if you want to see the entire games list
$show_all_games = False;

if ( !$show_all_games ) {
    $key1 = mt_rand(0, count($games) - 1);
    do {
        $key2 = mt_rand(0, count($games) - 1);
    } while ($key2 == $key1);

    $games = [$games[$key1], $games[$key2]];
}
                ?>        
                <div class="col right image">
		<?php for ( $i = 0; $i < count($games); ++$i ) {
			$game = $games[$i];

			// we can't serve unencrypted content from an external website if we're using
			//  SSL, or the browser will complain and warn that our site isn't 100% safe
			//  to visit. But I'd rather Valve's content servers handle this bandwidth
			//  for unencrypted connnections, so we'll only serve the images if we're
			//  serving over SSL.
			$using_ssl = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ($_SERVER['SERVER_PORT'] == 443);
			if ($using_ssl) {
			    $baseurl = 'http://cdn.akamai.steamstatic.com/steam/apps/';
			    if (strncmp($game[2], $baseurl, strlen($baseurl)) == 0) {
				$game[2] = preg_replace("/http:\/\/cdn.akamai.steamstatic.com\/steam\/apps\/(\d+)\/header.(.*)/", "steam_images/$1.$2", $game[2]);
			    }
			}
			?>
			<div class="imagebox">
			    <a href="<?php echo $game[1]; ?>">
			    <img src="<?php echo $game[2]; ?>" alt="<?php echo $game[0]; ?>" />
			    <h5>Made with SDL: <?php echo $game[0]; ?></h5>
			    </a>
			</div>
			<?php
		} ?>
                </div>
                <div class="clearer"></div>
            </div>
            <div class="clearer"></div>            
        </div>
        <?php require_once("include/footer.inc.php"); ?>       
    </body>
</html>
