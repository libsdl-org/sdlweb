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
                    <p> Simple DirectMedia Layer is a cross-platform development library designed to provide low level access to audio, keyboard, mouse, joystick, and graphics hardware via OpenGL and Direct3D. It is used by video playback software, emulators, and popular games including <a href="https://www.valvesoftware.com/">Valve</a>'s award winning catalog and many <a href="https://www.humblebundle.com/">Humble Bundle</a> games.
                    </p><p>
			SDL officially supports Windows, macOS, Linux, iOS, and Android.  Support for other platforms may be found in the source code.
                    </p><p>
                        SDL is written in C, works natively with C++, and there are <a href="languages.php">bindings available</a> for several other languages, including C# and Python.
                    </p><p>
                        SDL is distributed under the <a href="license.php">zlib license</a>. This license allows you to use SDL freely in any software. </p>
                </div>
                <?php
// Steam games can be found at: https://steamdb.info/tech/SDK/SDL
$games = array(
    array("0 A.D.", "https://play0ad.com", "media/games/0ad.png"),
    array("100% Orange Juice", "https://store.steampowered.com/app/282800", "https://cdn.akamai.steamstatic.com/steam/apps/282800/header.jpg"),
    array("1000 Amps", "https://store.steampowered.com/app/205690", "https://cdn.akamai.steamstatic.com/steam/apps/205690/header.jpg"),
    array("7 Grand Steps", "http://www.7grandsteps.com", "https://cdn.akamai.steamstatic.com/steam/apps/238930/header.jpg"),
    array("A New Beginning - Final Cut", "https://store.steampowered.com/app/105000", "https://cdn.akamai.steamstatic.com/steam/apps/105000/header.jpg"),
    array("Amnesia: Rebirth", "https://store.steampowered.com/app/999220", "https://cdn.akamai.steamstatic.com/steam/apps/999220/header.jpg"),
    array("Amnesia: The Bunker", "https://store.steampowered.com/app/1944430", "https://cdn.akamai.steamstatic.com/steam/apps/1944430/header.jpg"),
    array("Amnesia: The Dark Descent", "http://amnesiagame.com", "https://cdn.akamai.steamstatic.com/steam/apps/57300/header.jpg"),
    array("Analogue: A Hate Story", "https://store.steampowered.com/app/209370", "https://cdn.akamai.steamstatic.com/steam/apps/209370/header.jpg"),
    array("Anno 2205™", "https://store.steampowered.com/app/375910", "https://cdn.akamai.steamstatic.com/steam/apps/375910/header.jpg"),
    array("Ankh 2: Heart of Osiris", "https://store.steampowered.com/app/12440", "https://cdn.akamai.steamstatic.com/steam/apps/12440/header.jpg"),
    array("Ankh 3: Battle of the Gods", "https://store.steampowered.com/app/12450", "https://cdn.akamai.steamstatic.com/steam/apps/12450/header.jpg"),
    array("Aquaria", "https://store.steampowered.com/app/24420", "https://cdn.akamai.steamstatic.com/steam/apps/24420/header.jpg"),
    array("Arcadia", "https://store.steampowered.com/app/72500", "https://cdn.akamai.steamstatic.com/steam/apps/72500/header.jpg"),
    array("Atlas Fallen: Reign Of Sand", "https://store.steampowered.com/app/1230530", "https://cdn.akamai.steamstatic.com/steam/apps/1230530/header.jpg"),
    array("Awesomenauts", "https://store.steampowered.com/app/204300", "https://cdn.akamai.steamstatic.com/steam/apps/204300/header.jpg"),
    array("Axiom Verge", "https://store.steampowered.com/app/332200", "https://cdn.akamai.steamstatic.com/steam/apps/332200/header.jpg"),
    array("Azada", "https://store.steampowered.com/app/7340", "https://cdn.akamai.steamstatic.com/steam/apps/7340/header.jpg"),
    array("Baba Is You", "https://store.steampowered.com/app/736260", "https://cdn.akamai.steamstatic.com/steam/apps/736260/header.jpg"),
    array("Balatro", "https://store.steampowered.com/app/2379780", "https://cdn.akamai.steamstatic.com/steam/apps/2379780/header.jpg"),
    array("Baldur's Gate 3", "https://store.steampowered.com/app/1086940", "https://cdn.akamai.steamstatic.com/steam/apps/1086940/header.jpg"),
    array("Barony", "https://store.steampowered.com/app/371970", "https://cdn.akamai.steamstatic.com/steam/apps/371970/header.jpg"),
    array("Barotrauma", "https://store.steampowered.com/app/602960", "https://cdn.akamai.steamstatic.com/steam/apps/602960/header.jpg"),
    array("Bastion", "https://store.steampowered.com/app/107100", "https://cdn.akamai.steamstatic.com/steam/apps/107100/header.jpg"),
    array("Blood Bowl 2", "https://store.steampowered.com/app/236690", "https://cdn.akamai.steamstatic.com/steam/apps/236690/header.jpg"),
    array("Braid", "https://store.steampowered.com/app/26800", "https://cdn.akamai.steamstatic.com/steam/apps/26800/header.jpg"),
    array("BrainBread 2", "https://store.steampowered.com/app/346330", "https://cdn.akamai.steamstatic.com/steam/apps/346330/header.jpg"),
    array("BRAINPIPE: A Plunge to Unhumanity", "https://store.steampowered.com/app/35800", "https://cdn.akamai.steamstatic.com/steam/apps/35800/header.jpg"),
    array("Broken Age", "https://store.steampowered.com/app/232790", "https://cdn.akamai.steamstatic.com/steam/apps/232790/header.jpg"),
    array("Broken Sword 2: The Smoking Mirror", "https://store.steampowered.com/app/33600", "https://cdn.akamai.steamstatic.com/steam/apps/33600/header.jpg"),
    array("Brutal Legend", "https://store.steampowered.com/app/225260", "https://cdn.akamai.steamstatic.com/steam/apps/225260/header.jpg"),
    array("CARRION", "https://store.steampowered.com/app/953490", "https://cdn.akamai.steamstatic.com/steam/apps/953490/header.jpg"),
    array("Caster", "https://store.steampowered.com/app/29800", "https://cdn.akamai.steamstatic.com/steam/apps/29800/header.jpg"),
    array("Cave Story+", "https://store.steampowered.com/app/200900", "https://cdn.akamai.steamstatic.com/steam/apps/200900/header.jpg"),
    array("Chaos on Deponia", "https://store.steampowered.com/app/220740", "https://cdn.akamai.steamstatic.com/steam/apps/220740/header.jpg"),
    array("Closure", "https://store.steampowered.com/app/72000", "https://cdn.akamai.steamstatic.com/steam/apps/72000/header.jpg"),
    array("Codename CURE", "https://store.steampowered.com/app/355180", "https://cdn.akamai.steamstatic.com/steam/apps/355180/header.jpg"),
    array("Conquest Of Elysium 3", "https://store.steampowered.com/app/211900", "https://cdn.akamai.steamstatic.com/steam/apps/211900/header.jpg"),
    array("Costume Quest", "https://store.steampowered.com/app/115100", "https://cdn.akamai.steamstatic.com/steam/apps/115100/header.jpg"),
    array("Counter-Strike: Condition Zero", "https://store.steampowered.com/app/80", "https://cdn.akamai.steamstatic.com/steam/apps/80/header.jpg"),
    array("Counter-Strike: Source", "https://store.steampowered.com/app/240", "https://cdn.akamai.steamstatic.com/steam/apps/240/header.jpg"),
    array("Counter-Strike 2", "https://store.steampowered.com/app/730", "https://cdn.akamai.steamstatic.com/steam/apps/730/header.jpg"),
    array("Crusader Kings II", "https://store.steampowered.com/app/203770", "https://cdn.akamai.steamstatic.com/steam/apps/203770/header.jpg"),
    array("Crusader Kings III", "https://store.steampowered.com/app/1158310", "https://cdn.akamai.steamstatic.com/steam/apps/1158310/header.jpg"),
    array("Crypt of the NecroDancer", "https://store.steampowered.com/app/247080", "https://cdn.akamai.steamstatic.com/steam/apps/247080/header.jpg"),
    array("Danganronpa: Trigger Happy Havoc", "https://store.steampowered.com/app/413410", "https://cdn.akamai.steamstatic.com/steam/apps/413410/header.jpg"),
    array("Danganronpa 2: Goodbye Despair", "https://store.steampowered.com/app/413420", "https://cdn.akamai.steamstatic.com/steam/apps/413420/header.jpg"),
    array("Dangerous High School Girls in Trouble", "http://www.mousechief.com/dhsg", "https://cdn.akamai.steamstatic.com/steam/apps/27400/header.jpg"),
    array("Darkest Dungeon®", "https://store.steampowered.com/app/262060", "https://cdn.akamai.steamstatic.com/steam/apps/262060/header.jpg"),
    array("Darwinia", "https://store.steampowered.com/app/1500", "https://cdn.akamai.steamstatic.com/steam/apps/1500/header.jpg"),
    array("Data Jammers: FastForward", "https://store.steampowered.com/app/110500", "https://cdn.akamai.steamstatic.com/steam/apps/110500/header.jpg"),
    array("Day of Defeat", "https://store.steampowered.com/app/30", "https://cdn.akamai.steamstatic.com/steam/apps/30/header.jpg"),
    array("Day of the Tentacle Remastered", "https://store.steampowered.com/app/388210", "https://cdn.akamai.steamstatic.com/steam/apps/388210/header.jpg"),
    array("Dead Cells", "https://store.steampowered.com/app/588650", "https://cdn.akamai.steamstatic.com/steam/apps/588650/header.jpg"),
    array("Dead Island Definitive Edition", "https://store.steampowered.com/app/383150", "https://cdn.akamai.steamstatic.com/steam/apps/383150/header.jpg"),
    array("Deadlock", "https://store.steampowered.com/app/1422450", "https://cdn.akamai.steamstatic.com/steam/apps/1422450/header.jpg"),
    array("Death Rally", "https://store.steampowered.com/app/108700", "https://cdn.akamai.steamstatic.com/steam/apps/108700/header.jpg"),
    array("Death Road to Canada", "https://store.steampowered.com/app/252610", "https://cdn.akamai.steamstatic.com/steam/apps/252610/header.jpg"),
    array("Democracy 4", "https://store.steampowered.com/app/1410710", "https://cdn.akamai.steamstatic.com/steam/apps/1410710/header.jpg"),
    array("Deponia", "https://store.steampowered.com/app/214340", "https://cdn.akamai.steamstatic.com/steam/apps/214340/header.jpg"),
    array("Deponia Doomsday", "https://store.steampowered.com/app/421050", "https://cdn.akamai.steamstatic.com/steam/apps/421050/header.jpg"),
    array("Deponia: The Complete Journey", "https://store.steampowered.com/app/292910", "https://cdn.akamai.steamstatic.com/steam/apps/292910/header.jpg"),
    array("Digital Combat Simulator: Black Shark", "https://store.steampowered.com/app/61000", "https://cdn.akamai.steamstatic.com/steam/apps/61000/header.jpg"),
    array("Distant Worlds 2", "https://store.steampowered.com/app/1531540", "https://cdn.akamai.steamstatic.com/steam/apps/1531540/header.jpg"),
    array("Divinity: Original Sin", "https://store.steampowered.com/app/373420", "https://cdn.akamai.steamstatic.com/steam/apps/373420/header.jpg"),
    array("Divinity: Original Sin 2", "https://store.steampowered.com/app/435150", "https://cdn.akamai.steamstatic.com/steam/apps/435150/header.jpg"),
    array("Doki Doki Literature Club!", "https://store.steampowered.com/app/698780", "https://cdn.akamai.steamstatic.com/steam/apps/698780/header.jpg"),
    array("Don't Starve", "https://store.steampowered.com/app/219740", "https://cdn.akamai.steamstatic.com/steam/apps/219740/header.jpg"),
    array("Don't Starve Together", "https://store.steampowered.com/app/322330", "https://cdn.akamai.steamstatic.com/steam/apps/322330/header.jpg"),
    array("Door Kickers: Action Squad", "https://store.steampowered.com/app/686200", "https://cdn.akamai.steamstatic.com/steam/apps/686200/header.jpg"),
    array("Dota 2", "https://store.steampowered.com/app/570", "https://cdn.akamai.steamstatic.com/steam/apps/570/header.jpg"),
    array("Dota Underlords", "https://store.steampowered.com/app/1046930", "https://cdn.akamai.steamstatic.com/steam/apps/1046930/header.jpg"),
    array("Double Action: Boogaloo", "https://store.steampowered.com/app/317360", "https://cdn.akamai.steamstatic.com/steam/apps/317360/header.jpg"),
    array("Drawn: The Painted Tower", "https://store.steampowered.com/app/51060", "https://cdn.akamai.steamstatic.com/steam/apps/51060/header.jpg"),
    array("Dune: Spice Wars", "https://store.steampowered.com/app/1605220", "https://cdn.akamai.steamstatic.com/steam/apps/1605220/header.jpg"),
    array("Dungeons of Dredmor", "https://store.steampowered.com/app/98800", "https://cdn.akamai.steamstatic.com/steam/apps/98800/header.jpg"),
    array("Dwarf Fortress", "https://store.steampowered.com/app/975370", "https://cdn.akamai.steamstatic.com/steam/apps/975370/header.jpg"),
    array("Dyad", "https://store.steampowered.com/app/223450", "https://cdn.akamai.steamstatic.com/steam/apps/223450/header.jpg"),
    array("Dying Light", "https://store.steampowered.com/app/239140", "https://cdn.akamai.steamstatic.com/steam/apps/239140/header.jpg"),
    array("Dying Light 2", "https://store.steampowered.com/app/534380", "https://cdn.akamai.steamstatic.com/steam/apps/534380/header.jpg"),
    array("Dynamite Jack", "http://www.galcon.com/dynamitejack", "https://cdn.akamai.steamstatic.com/steam/apps/202730/header.jpg"),
    array("EDGE", "https://store.steampowered.com/app/38740", "https://cdn.akamai.steamstatic.com/steam/apps/38740/header.jpg"),
    array("Edna &amp; Harvey: Harvey's New Eyes", "https://store.steampowered.com/app/219910", "https://cdn.akamai.steamstatic.com/steam/apps/219910/header.jpg"),
    array("Endless Sky", "https://store.steampowered.com/app/404410", "https://cdn.akamai.steamstatic.com/steam/apps/404410/header.jpg"),
    array("Eversion", "https://store.steampowered.com/app/33680", "https://cdn.akamai.steamstatic.com/steam/apps/33680/header.jpg"),
    array("Eufloria HD", "https://store.steampowered.com/app/221180", "https://cdn.akamai.steamstatic.com/steam/apps/221180/header.jpg"),
    array("Everyday Shooter", "https://store.steampowered.com/app/16300", "https://cdn.akamai.steamstatic.com/steam/apps/16300/header.jpg"),
    array("Exoplanet: First Contact", "https://store.steampowered.com/app/531660", "https://cdn.akamai.steamstatic.com/steam/apps/531660/header.jpg"),
    array("Factorio", "https://store.steampowered.com/app/427520", "https://cdn.akamai.steamstatic.com/steam/apps/427520/header.jpg"),
    array("Farm Together", "https://store.steampowered.com/app/673950", "https://cdn.akamai.steamstatic.com/steam/apps/673950/header.jpg"),
    array("Final Fantasy III (3D Remake)", "https://store.steampowered.com/app/239120", "https://cdn.akamai.steamstatic.com/steam/apps/239120/header.jpg"),
    array("Fistful of Frags", "https://store.steampowered.com/app/265630", "https://cdn.akamai.steamstatic.com/steam/apps/265630/header.jpg"),
    // This is no longer on the Google Play Store
    //array("FlapMMO", "https://play.google.com/store/apps/details?id=com.flapmmo.android", "media/games/flapmmo.png"),
    array("Freeciv", "http://freeciv.org", "media/games/freeciv.png"),
    array("Frostpunk", "https://store.steampowered.com/app/323190", "https://cdn.akamai.steamstatic.com/steam/apps/323190/header.jpg"),
    array("FTL: Faster Than Light", "https://store.steampowered.com/app/212680", "https://cdn.akamai.steamstatic.com/steam/apps/212680/header.jpg"),
    array("Fugl", "https://store.steampowered.com/app/643810/Fugl/", "https://cdn.akamai.steamstatic.com/steam/apps/643810/header.jpg"),
    array("Future Unfolding", "https://store.steampowered.com/app/539340", "https://cdn.akamai.steamstatic.com/steam/apps/539340/header.jpg"),
    array("Galcon Fusion", "http://www.galcon.com/fusion/", "https://cdn.akamai.steamstatic.com/steam/apps/44200/header.jpg"),
    array("Gish", "https://store.steampowered.com/app/9500", "https://cdn.akamai.steamstatic.com/steam/apps/9500/header.jpg"),
    array("Gotham Knights", "https://store.steampowered.com/app/1496790", "https://cdn.akamai.steamstatic.com/steam/apps/1496790/header.jpg"),
    array("Griftlands", "https://store.steampowered.com/app/601840", "https://cdn.akamai.steamstatic.com/steam/apps/601840/header.jpg"),
    array("Grim Fandango Remastered", "https://store.steampowered.com/app/316790", "https://cdn.akamai.steamstatic.com/steam/apps/316790/header.jpg"),
    array("Hacker Evolution Duality", "https://store.steampowered.com/app/70120", "https://cdn.akamai.steamstatic.com/steam/apps/70120/header.jpg"),
    array("Hacknet", "https://store.steampowered.com/app/365450", "https://cdn.akamai.steamstatic.com/steam/apps/365450/header.jpg"),
    array("Hades", "https://store.steampowered.com/app/1145360", "https://cdn.akamai.steamstatic.com/steam/apps/1145360/header.jpg"),
    array("Hades II", "https://store.steampowered.com/app/1145350", "https://cdn.akamai.steamstatic.com/steam/apps/1145350/header.jpg"),
    array("Half-Life 2", "https://store.steampowered.com/app/220", "https://cdn.akamai.steamstatic.com/steam/apps/220/header.jpg"),
    array("Half-Life", "https://store.steampowered.com/app/70", "https://cdn.akamai.steamstatic.com/steam/apps/70/header.jpg"),
    array("Half-Life: Alyx", "https://store.steampowered.com/app/546560", "https://cdn.akamai.steamstatic.com/steam/apps/546560/header.jpg"),
    array("Hedgewars", "https://hedgewars.org", "media/games/hedgewars.png"),
    array("Heroes of Hammerwatch", "https://store.steampowered.com/app/677120", "https://cdn.akamai.steamstatic.com/steam/apps/677120/header.jpg"),
    array("Heroes of Might &amp; Magic III - HD Edition", "https://store.steampowered.com/app/297000", "https://cdn.akamai.steamstatic.com/steam/apps/297000/header.jpg"),
    array("HighFleet", "https://store.steampowered.com/app/1434950", "https://cdn.akamai.steamstatic.com/steam/apps/1434950/header.jpg"),
    array("Horticular", "https://store.steampowered.com/app/1928540", "https://cdn.akamai.steamstatic.com/steam/apps/1928540/header.jpg"),
    array("Hunt: Showdown 1896", "https://store.steampowered.com/app/594650", "https://cdn.akamai.steamstatic.com/steam/apps/594650/header.jpg"),
    array("Imperator: Rome", "https://store.steampowered.com/app/859580", "https://cdn.akamai.steamstatic.com/steam/apps/859580/header.jpg"),
    array("Impostor Factory", "https://store.steampowered.com/app/1182620", "https://cdn.akamai.steamstatic.com/steam/apps/1182620/header.jpg"),
    array("Infested Planet", "https://store.steampowered.com/app/204530", "https://cdn.akamai.steamstatic.com/steam/apps/204530/header.jpg"),
    array("Inside a Star-filled Sky", "https://store.steampowered.com/app/104100", "https://cdn.akamai.steamstatic.com/steam/apps/104100/header.jpg"),
    array("Into the Breach", "https://store.steampowered.com/app/590380", "https://cdn.akamai.steamstatic.com/steam/apps/590380/header.jpg"),
    array("Into the Necrovale", "https://store.steampowered.com/app/1717090", "https://cdn.akamai.steamstatic.com/steam/apps/1717090/header.jpg"),
    array("Intravenous 2", "https://store.steampowered.com/app/2608270", "https://cdn.akamai.steamstatic.com/steam/apps/2608270/header.jpg"),
    array("Ion Fury", "https://store.steampowered.com/app/562860", "https://cdn.akamai.steamstatic.com/steam/apps/562860/header.jpg"),
    array("Ironclad Tactics", "https://store.steampowered.com/app/226960", "https://cdn.akamai.steamstatic.com/steam/apps/226960/header.jpg"),
    array("Jack Keane", "https://store.steampowered.com/app/12340", "https://cdn.akamai.steamstatic.com/steam/apps/12340/header.jpg"),
    array("Jewel Quest Pack", "https://store.steampowered.com/app/37960", "https://cdn.akamai.steamstatic.com/steam/apps/37960/header.jpg"),
    array("Just a To the Moon Series Beach Episode", "https://store.steampowered.com/app/2159210", "https://cdn.akamai.steamstatic.com/steam/apps/2159210/header.jpg"),
    array("KeeperRL", "https://store.steampowered.com/app/329970", "https://cdn.akamai.steamstatic.com/steam/apps/329970/header.jpg"),
    array("Ken Follett's The Pillars of the Earth", "https://store.steampowered.com/app/234270", "https://cdn.akamai.steamstatic.com/steam/apps/234270/header.jpg"),
    array("Kingdom Rush 5: Alliance TD", "https://store.steampowered.com/app/2849080", "https://cdn.akamai.steamstatic.com/steam/apps/2849080/header.jpg"),
    array("Kingdom Rush Frontiers - Tower Defense", "https://store.steampowered.com/app/458710", "https://cdn.akamai.steamstatic.com/steam/apps/458710/header.jpg"),
    array("Kingdom Rush Origins - Tower Defense", "https://store.steampowered.com/app/816340", "https://cdn.akamai.steamstatic.com/steam/apps/816340/header.jpg"),
    array("Left 4 Dead 2", "https://store.steampowered.com/app/550", "https://cdn.akamai.steamstatic.com/steam/apps/550/header.jpg"),
    array("Life is Strange: True Colors", "https://store.steampowered.com/app/936790", "https://cdn.akamai.steamstatic.com/steam/apps/936790/header.jpg"),
    array("Magical Diary", "https://store.steampowered.com/app/211340", "https://cdn.akamai.steamstatic.com/steam/apps/211340/header.jpg"),
    array("Mahjong Quest Collection", "https://store.steampowered.com/app/38000", "https://cdn.akamai.steamstatic.com/steam/apps/38000/header.jpg"),
    array("Mark of the Ninja", "https://store.steampowered.com/app/214560", "https://cdn.akamai.steamstatic.com/steam/apps/214560/header.jpg"),
    array("Mayhem Intergalactic", "https://store.steampowered.com/app/18600", "https://cdn.akamai.steamstatic.com/steam/apps/18600/header.jpg"),
    array("Memoria", "https://store.steampowered.com/app/243200", "https://cdn.akamai.steamstatic.com/steam/apps/243200/header.jpg"),
    array("Men of War II", "https://store.steampowered.com/app/1128860", "https://cdn.akamai.steamstatic.com/steam/apps/1128860/header.jpg"),
    array("MMORPG Tycoon 2", "https://store.steampowered.com/app/486860", "https://cdn.akamai.steamstatic.com/steam/apps/486860/header.jpg"),
    array("Mortal Kombat 1", "https://store.steampowered.com/app/1971870", "https://cdn.akamai.steamstatic.com/steam/apps/1971870/header.jpg"),
    array("Move or Die", "https://store.steampowered.com/app/323850", "https://cdn.akamai.steamstatic.com/steam/apps/323850/header.jpg"),
    array("Musaic Box", "https://store.steampowered.com/app/29130", "https://cdn.akamai.steamstatic.com/steam/apps/29130/header.jpg"),
    array("My Tribe", "https://store.steampowered.com/app/51010", "https://cdn.akamai.steamstatic.com/steam/apps/51010/header.jpg"),
    array("Natural Selection 2", "https://store.steampowered.com/app/4920", "https://cdn.akamai.steamstatic.com/steam/apps/4920/header.jpg"),
    array("Neverwinter Nights: Enhanced Edition", "https://store.steampowered.com/app/704450", "https://cdn.akamai.steamstatic.com/steam/apps/704450/header.jpg"),
    array("Nightmare House: The Original Mod", "https://store.steampowered.com/app/2954780", "https://cdn.akamai.steamstatic.com/steam/apps/2954780/header.jpg"),
    array("No More Room in Hell", "https://store.steampowered.com/app/224260", "https://cdn.akamai.steamstatic.com/steam/apps/224260/header.jpg"),
    array("Noita", "https://store.steampowered.com/app/881100", "https://cdn.akamai.steamstatic.com/steam/apps/881100/header.jpg"),
    array("Northgard", "https://store.steampowered.com/app/466560", "https://cdn.akamai.steamstatic.com/steam/apps/466560/header.jpg"),
    array("One Hour One Life", "https://store.steampowered.com/app/595690", "https://cdn.akamai.steamstatic.com/steam/apps/595690/header.jpg"),
    array("OneShot", "https://store.steampowered.com/app/420530", "https://cdn.akamai.steamstatic.com/steam/apps/420530/header.jpg"),
    array("OpenTTD", "https://www.openttd.org", "media/games/openttd.png"),
    array("Opus Magnum", "https://store.steampowered.com/app/558990", "https://cdn.akamai.steamstatic.com/steam/apps/558990/header.jpg"),
    array("Overgrowth", "https://store.steampowered.com/app/25000", "https://cdn.akamai.steamstatic.com/steam/apps/25000/header.jpg"),
    array("Owlboy", "https://store.steampowered.com/app/115800", "https://cdn.akamai.steamstatic.com/steam/apps/115800/header.jpg"),
    array("Painkiller Hell &amp; Damnation", "https://store.steampowered.com/app/214870", "https://cdn.akamai.steamstatic.com/steam/apps/214870/header.jpg"),
    array("Pathway", "https://store.steampowered.com/app/546430", "https://cdn.akamai.steamstatic.com/steam/apps/546430/header.jpg"),
    array("Penumbra Overture", "http://penumbragame.com", "https://cdn.akamai.steamstatic.com/steam/apps/22180/header.jpg"),
    array("Planet Centauri", "https://store.steampowered.com/app/385380", "https://cdn.akamai.steamstatic.com/steam/apps/385380/header.jpg"),
    array("Planetary Annihilation: TITANS", "https://store.steampowered.com/app/386070", "https://cdn.akamai.steamstatic.com/steam/apps/386070/header.jpg"),
    array("Poker Superstars II", "https://store.steampowered.com/app/4100", "https://cdn.akamai.steamstatic.com/steam/apps/4100/header.jpg"),
    array("Poppy Kart", "http://apps.webrox.fr/?page_id=8Change", "media/games/poppykart-sdl.png"),
    array("Portal", "https://store.steampowered.com/app/400", "https://cdn.akamai.steamstatic.com/steam/apps/400/header.jpg"),
    array("Postal 2 Complete", "https://store.steampowered.com/app/223470", "https://cdn.akamai.steamstatic.com/steam/apps/223470/header.jpg"),
    array("Postal", "https://store.steampowered.com/app/232770", "https://cdn.akamai.steamstatic.com/steam/apps/232770/header.jpg"),
    array("Precipice of Darkness, Episode Two", "https://store.steampowered.com/app/18020", "https://cdn.akamai.steamstatic.com/steam/apps/18020/header.jpg"),
    array("Primal Carnage: Extinction", "https://store.steampowered.com/app/321360", "https://cdn.akamai.steamstatic.com/steam/apps/321360/header.jpg"),
    array("Prison Architect", "https://store.steampowered.com/app/233450", "https://cdn.akamai.steamstatic.com/steam/apps/233450/header.jpg"),
    array("Professor Fizzwizzle and the Molten Mystery", "https://store.steampowered.com/app/50910", "https://cdn.akamai.steamstatic.com/steam/apps/50910/header.jpg"),
    array("Professor Fizzwizzle", "https://store.steampowered.com/app/50900", "https://cdn.akamai.steamstatic.com/steam/apps/50900/header.jpg"),
    array("Project Wingman", "https://store.steampowered.com/app/895870", "https://cdn.akamai.steamstatic.com/steam/apps/895870/header.jpg"),
    array("Proteus", "https://store.steampowered.com/app/219680", "https://cdn.akamai.steamstatic.com/steam/apps/219680/header.jpg"),
    array("Psychonauts", "https://store.steampowered.com/app/3830", "https://cdn.akamai.steamstatic.com/steam/apps/3830/header.jpg"),
    array("Pure Rock Crawling", "https://store.steampowered.com/app/824720", "https://cdn.akamai.steamstatic.com/steam/apps/54824720/header.jpg"),
    array("Pyre", "https://store.steampowered.com/app/462770", "https://cdn.akamai.steamstatic.com/steam/apps/462770/header.jpg"),
    array("QUAKE", "https://store.steampowered.com/app/2310", "https://cdn.akamai.steamstatic.com/steam/apps/2310/header.jpg"),
    array("Reassembly", "https://store.steampowered.com/app/329130", "https://cdn.akamai.steamstatic.com/steam/apps/329130/header.jpg"),
    array("RetroArch", "https://store.steampowered.com/app/1118310", "https://cdn.akamai.steamstatic.com/steam/apps/1118310/header.jpg"),
    array("Rhythm Doctor", "https://store.steampowered.com/app/774181", "https://cdn.akamai.steamstatic.com/steam/apps/774181/header.jpg"),
    array("RiME", "https://store.steampowered.com/app/493200", "https://cdn.akamai.steamstatic.com/steam/apps/493200/header.jpg"),
    array("Risk of Rain Returns", "https://store.steampowered.com/app/1337520", "https://cdn.akamai.steamstatic.com/steam/apps/1337520/header.jpg"),
    array("Robin Hood - Sherwood Builders", "https://store.steampowered.com/app/1159420", "https://cdn.akamai.steamstatic.com/steam/apps/1159420/header.jpg"),
    array("Robin Hood: The Legend of Sherwood", "https://store.steampowered.com/app/46560", "https://cdn.akamai.steamstatic.com/steam/apps/46560/header.jpg"),
    array("Rotwood", "https://store.steampowered.com/app/2015270", "https://cdn.akamai.steamstatic.com/steam/apps/2015270/header.jpg"),
    array("RUSH", "https://store.steampowered.com/app/38720", "https://cdn.akamai.steamstatic.com/steam/apps/38720/header.jpg"),
    array("Sakura Angels", "https://store.steampowered.com/app/342380", "https://cdn.akamai.steamstatic.com/steam/apps/342380/header.jpg"),
    array("Sakura Dungeon", "https://store.steampowered.com/app/407330", "https://cdn.akamai.steamstatic.com/steam/apps/407330/header.jpg"),
    array("Sakura Swim Club", "https://store.steampowered.com/app/402180", "https://cdn.akamai.steamstatic.com/steam/apps/402180/header.jpg"),
    array("Sapiens", "https://store.steampowered.com/app/1060230", "https://cdn.akamai.steamstatic.com/steam/apps/1060230/header.jpg"),
    array("SCARLET NEXUS", "https://store.steampowered.com/app/775500", "https://cdn.akamai.steamstatic.com/steam/apps/775500/header.jpg"),
    // This website no longer exists
    //array("Seed of Andromeda", "https://www.seedofandromeda.com", "media/games/seedofandromeda.png"),
    array("Senua’s Saga: Hellblade II", "https://store.steampowered.com/app/2461850", "https://cdn.akamai.steamstatic.com/steam/apps/2461850/header.jpg"),
    array("Shatter", "https://store.steampowered.com/app/20820", "https://cdn.akamai.steamstatic.com/steam/apps/20820/header.jpg"),
    array("SHENZHEN I/O", "https://store.steampowered.com/app/504210", "https://cdn.akamai.steamstatic.com/steam/apps/504210/header.jpg"),
    array("Shovel Knight: Specter of Torment", "https://store.steampowered.com/app/589510", "https://cdn.akamai.steamstatic.com/steam/apps/589510/header.jpg"),
    array("Signs of Life", "https://store.steampowered.com/app/263200", "https://cdn.akamai.steamstatic.com/steam/apps/263200/header.jpg"),
    array("Snapshot", "https://store.steampowered.com/app/204220", "https://cdn.akamai.steamstatic.com/steam/apps/204220/header.jpg"),
    array("SolForge", "https://store.steampowered.com/app/232450", "https://cdn.akamai.steamstatic.com/steam/apps/232450/header.jpg"),
    array("SOMA", "https://store.steampowered.com/app/282140", "https://cdn.akamai.steamstatic.com/steam/apps/282140/header.jpg"),
    array("Sorcery!", "https://store.steampowered.com/app/411000", "https://cdn.akamai.steamstatic.com/steam/apps/411000/header.jpg"),
    array("SpaceBourne 2", "https://store.steampowered.com/app/1646850", "https://cdn.akamai.steamstatic.com/steam/apps/1646850/header.jpg"),
    array("SpaceChem", "https://store.steampowered.com/app/92800", "https://cdn.akamai.steamstatic.com/steam/apps/92800/header.jpg"),
    array("SpaceEngine", "https://store.steampowered.com/app/314650", "https://cdn.akamai.steamstatic.com/steam/apps/314650/header.jpg"),
    array("SpeedRunners", "https://store.steampowered.com/app/207140", "https://cdn.akamai.steamstatic.com/steam/apps/207140/header.jpg"),
    array("Spirits", "https://store.steampowered.com/app/210170", "https://cdn.akamai.steamstatic.com/steam/apps/210170/header.jpg"),
    array("Stacking", "https://store.steampowered.com/app/115110", "https://cdn.akamai.steamstatic.com/steam/apps/115110/header.jpg"),
    array("Staxel", "https://store.steampowered.com/app/405710", "https://cdn.akamai.steamstatic.com/steam/apps/405710/header.jpg"),
    array("STAR WARS™: Battlefront Classic Collection", "https://store.steampowered.com/app/2446550", "https://cdn.akamai.steamstatic.com/steam/apps/2446550/header.jpg"),
    array("Starbound", "https://store.steampowered.com/app/211820", "https://cdn.akamai.steamstatic.com/steam/apps/211820/header.jpg"),
    array("SteamWorld Dig", "https://store.steampowered.com/app/252410", "https://cdn.akamai.steamstatic.com/steam/apps/252410/header.jpg"),
    array("SteamWorld Dig 2", "https://store.steampowered.com/app/571310", "https://cdn.akamai.steamstatic.com/steam/apps/571310/header.jpg"),
    array("SteamWorld Heist II", "https://store.steampowered.com/app/2396240", "https://cdn.akamai.steamstatic.com/steam/apps/2396240/header.jpg"),
    array("SteamWorld Quest: Hand of Gilgamech", "https://store.steampowered.com/app/804010", "https://cdn.akamai.steamstatic.com/steam/apps/804010/header.jpg"),
    array("Steel Storm: Burning Retribution", "https://store.steampowered.com/app/96200", "https://cdn.akamai.steamstatic.com/steam/apps/96200/header.jpg"),
    array("Stellaris", "https://store.steampowered.com/app/281990", "https://cdn.akamai.steamstatic.com/steam/apps/281990/header.jpg"),
    array("Still Life 2", "https://store.steampowered.com/app/46490", "https://cdn.akamai.steamstatic.com/steam/apps/46490/header.jpg"),
    array("Still Life", "https://store.steampowered.com/app/46480", "https://cdn.akamai.steamstatic.com/steam/apps/46480/header.jpg"),
    array("Streets of Rage 4", "https://store.steampowered.com/app/985890", "https://cdn.akamai.steamstatic.com/steam/apps/985890/header.jpg"),
    array("Sub Rosa", "https://store.steampowered.com/app/272230", "https://cdn.akamai.steamstatic.com/steam/apps/272230/header.jpg"),
    array("Superbrothers: Sword & Sworcery EP", "https://store.steampowered.com/app/204060", "https://cdn.akamai.steamstatic.com/steam/apps/204060/header.jpg"),
    array("SuperTux", "https://www.supertux.org", "media/games/supertux.png"),
    array("SuperTuxKart", "https://supertuxkart.net", "media/games/supertuxkart.png"),
    array("Sven Co-op", "https://store.steampowered.com/app/225840", "https://cdn.akamai.steamstatic.com/steam/apps/225840/header.jpg"),
    array("Swarmlake", "https://store.steampowered.com/app/793350", "https://cdn.akamai.steamstatic.com/steam/apps/793350/header.jpg"),
    array("Swords and Soldiers HD", "https://store.steampowered.com/app/63500", "https://cdn.akamai.steamstatic.com/steam/apps/63500/header.jpg"),
    array("Syberia", "https://store.steampowered.com/app/46500", "https://cdn.akamai.steamstatic.com/steam/apps/46500/header.jpg"),
    array("Syberia II", "https://store.steampowered.com/app/46510", "https://cdn.akamai.steamstatic.com/steam/apps/46510/header.jpg"),
    array("Tales of Berseria", "https://store.steampowered.com/app/429660", "https://cdn.akamai.steamstatic.com/steam/apps/429660/header.jpg"),
    array("Tales of Zestiria", "https://store.steampowered.com/app/351970", "https://cdn.akamai.steamstatic.com/steam/apps/351970/header.jpg"),
    array("Team Fortress 2", "https://store.steampowered.com/app/440", "https://cdn.akamai.steamstatic.com/steam/apps/440/header.jpg"),
    array("Teenage Mutant Ninja Turtles: Shredder's Revenge", "https://store.steampowered.com/app/1361510", "https://cdn.akamai.steamstatic.com/steam/apps/1361510/header.jpg"),
    array("Terminus: Zombie Survivors", "https://store.steampowered.com/app/1534980", "https://cdn.akamai.steamstatic.com/steam/apps/1534980/header.jpg"),
    array("TETRACHROMA", "https://store.steampowered.com/app/2702490", "https://cdn.akamai.steamstatic.com/steam/apps/2702490/header.jpg"),
    array("The Battle for Wesnoth", "https://store.steampowered.com/app/599390", "https://cdn.akamai.steamstatic.com/steam/apps/599390/header.jpg"),
    array("The Dark Eye: Chains of Satinav", "https://store.steampowered.com/app/203830", "https://cdn.akamai.steamstatic.com/steam/apps/203830/header.jpg"),
    array("THE KING OF FIGHTERS XIV", "https://store.steampowered.com/app/571260", "https://cdn.akamai.steamstatic.com/steam/apps/571260/header.jpg"),
    array("The Night of the Rabbit", "https://store.steampowered.com/app/230820", "https://cdn.akamai.steamstatic.com/steam/apps/230820/header.jpg"),
    array("The Surge 2", "https://store.steampowered.com/app/644830", "https://cdn.akamai.steamstatic.com/steam/apps/644830/header.jpg"),
    array("The Thing: Remastered", "https://store.steampowered.com/app/2958970", "https://cdn.akamai.steamstatic.com/steam/apps/2958970/header.jpg"),
    array("The Whispered World", "https://store.steampowered.com/app/18490", "https://cdn.akamai.steamstatic.com/steam/apps/18490/header.jpg"),
    array("They Are Billions", "https://store.steampowered.com/app/644930", "https://cdn.akamai.steamstatic.com/steam/apps/644930/header.jpg"),
    array("They Bleed Pixels", "https://store.steampowered.com/app/211260", "https://cdn.akamai.steamstatic.com/steam/apps/211260/header.jpg"),
    array("Thimbleweed Park™", "https://store.steampowered.com/app/569860", "https://cdn.akamai.steamstatic.com/steam/apps/569860/header.jpg"),
    array("Thymesia", "https://store.steampowered.com/app/1343240", "https://cdn.akamai.steamstatic.com/steam/apps/1343240/header.jpg"),
    array("Tiny and Big: Grandpa's Leftovers", "https://store.steampowered.com/app/205910", "https://cdn.akamai.steamstatic.com/steam/apps/205910/header.jpg"),
    array("Titan Souls", "https://store.steampowered.com/app/297130", "https://cdn.akamai.steamstatic.com/steam/apps/297130/header.jpg"),
    array("To the Moon", "https://store.steampowered.com/app/206440", "https://cdn.akamai.steamstatic.com/steam/apps/206440/header.jpg"),
    array("Toki Tori", "https://store.steampowered.com/app/38700", "https://cdn.akamai.steamstatic.com/steam/apps/38700/header.jpg"),
    array("Teeworlds", "https://store.steampowered.com/app/380840", "https://cdn.akamai.steamstatic.com/steam/apps/380840/header.jpg"),
    array("Transport Fever", "https://store.steampowered.com/app/446800", "https://cdn.akamai.steamstatic.com/steam/apps/446800/header.jpg"),
    array("Transport Fever 2", "https://store.steampowered.com/app/1066780", "https://cdn.akamai.steamstatic.com/steam/apps/1066780/header.jpg"),
    array("Transistor", "https://store.steampowered.com/app/237930", "https://cdn.akamai.steamstatic.com/steam/apps/237930/header.jpg"),
    array("Transmissions: Element 120", "https://store.steampowered.com/app/365300", "https://cdn.akamai.steamstatic.com/steam/apps/365300/header.jpg"),
    array("Trials 2: Second Edition", "https://store.steampowered.com/app/16600", "https://cdn.akamai.steamstatic.com/steam/apps/16600/header.jpg"),
    array("Trove", "https://store.steampowered.com/app/304050", "https://cdn.akamai.steamstatic.com/steam/apps/304050/header.jpg"),
    array("Umineko When They Cry - Answer Arcs", "https://store.steampowered.com/app/639490", "https://cdn.akamai.steamstatic.com/steam/apps/639490/header.jpg"),
    array("Umineko When They Cry - Question Arcs", "https://store.steampowered.com/app/406550", "https://cdn.akamai.steamstatic.com/steam/apps/406550/header.jpg"),
    array("UnEpic", "https://store.steampowered.com/app/233980", "https://cdn.akamai.steamstatic.com/steam/apps/233980/header.jpg"),
    array("Unrailed!", "https://store.steampowered.com/app/1016920", "https://cdn.akamai.steamstatic.com/steam/apps/1016920/header.jpg"),
    array("Uplink", "https://store.steampowered.com/app/1510", "https://cdn.akamai.steamstatic.com/steam/apps/1510/header.jpg"),
    array("Vertex Dispenser", "https://store.steampowered.com/app/102400", "https://cdn.akamai.steamstatic.com/steam/apps/102400/header.jpg"),
    array("Victoria 3", "https://store.steampowered.com/app/529340", "https://cdn.akamai.steamstatic.com/steam/apps/529340/header.jpg"),
    array("VVVVVV", "https://store.steampowered.com/app/70300", "https://cdn.akamai.steamstatic.com/steam/apps/70300/header.jpg"),
    array("Waking Mars", "https://store.steampowered.com/app/227200", "https://cdn.akamai.steamstatic.com/steam/apps/227200/header.jpg"),
    array("Wargroove", "https://store.steampowered.com/app/607050", "https://cdn.akamai.steamstatic.com/steam/apps/607050/header.jpg"),
    array("Wartales", "https://store.steampowered.com/app/1527950", "https://cdn.akamai.steamstatic.com/steam/apps/1527950/header.jpg"),
    array("Waveform", "https://store.steampowered.com/app/204180", "https://cdn.akamai.steamstatic.com/steam/apps/204180/header.jpg"),
    array("Weird Worlds: Return to Infinite Space", "https://store.steampowered.com/app/226120", "https://cdn.akamai.steamstatic.com/steam/apps/226120/header.jpg"),
    array("White Noise 2", "https://store.steampowered.com/app/503350", "https://cdn.akamai.steamstatic.com/steam/apps/503350/header.jpg"),
    array("World of Goo", "https://store.steampowered.com/app/22000", "https://cdn.akamai.steamstatic.com/steam/apps/22000/header.jpg"),
    array("X-COM: Apocalypse", "https://store.steampowered.com/app/7660", "https://cdn.akamai.steamstatic.com/steam/apps/7660/header.jpg"),
    array("X-COM: Terror from the Deep", "https://store.steampowered.com/app/7650", "https://cdn.akamai.steamstatic.com/steam/apps/7650/header.jpg"),
    array("X-COM: UFO Defense", "https://store.steampowered.com/app/7760", "https://cdn.akamai.steamstatic.com/steam/apps/7760/header.jpg"),
    array("Xenonauts", "https://store.steampowered.com/app/223830", "https://cdn.akamai.steamstatic.com/steam/apps/223830/header.jpg"),
    array("Xonotic", "https://xonotic.org", "media/games/xonotic.png"),
    array("Zen Bound 2", "https://store.steampowered.com/app/61600", "https://cdn.akamai.steamstatic.com/steam/apps/61600/header.jpg"),
    array("Zero Escape: The Nonary Games", "https://store.steampowered.com/app/477740", "https://cdn.akamai.steamstatic.com/steam/apps/477740/header.jpg"),
    array("Zero Escape: Zero Time Dilemma", "https://store.steampowered.com/app/311240", "https://cdn.akamai.steamstatic.com/steam/apps/311240/header.jpg"),
    array("Zombie Panic! Source", "https://store.steampowered.com/app/17500", "https://cdn.akamai.steamstatic.com/steam/apps/17500/header.jpg"),
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
			    $baseurl = 'https://cdn.akamai.steamstatic.com/steam/apps/';
			    if (strncmp($game[2], $baseurl, strlen($baseurl)) == 0) {
				$game[2] = preg_replace("/https:\/\/cdn.akamai.steamstatic.com\/steam\/apps\/(\d+)\/header.(.*)/", "steam_images/$1.$2", $game[2]);
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
