window.onload = init;
var host = location.hostname;
var myLocalStorage = localStorage; 

function init() {  
    setLightTheme(true)

    var rL = readLocal();    
    if(rL!=null){
        if(rL.length>1) setDarkTheme();        
    } 

    // burger menu toggler 
    const left = document.getElementById("left")
    left.addEventListener("click", function(event){
        event.currentTarget.classList.toggle("active")
    })
}

function switch_theme(value){   
    switch (value) {
        case "light":
            deleteLocal();
            setLightTheme();
        break;        
        case "dark":            
            writeLocal();  
            setDarkTheme();
        break;            
    }
}

function setLightTheme(buttons_only) {
    if(buttons_only == undefined) // only highlight selected button
        document.getElementsByTagName("body")[0].setAttribute("class", "light");
    document.getElementById("dark_theme").setAttribute("class", "button theme");
    document.getElementById("light_theme").setAttribute("class", "button theme active");     
}

function setDarkTheme(buttons_only) {
    if(buttons_only == undefined)        
        document.getElementsByTagName("body")[0].setAttribute("class", "black");            
     document.getElementById("light_theme").setAttribute("class", "button theme");
     document.getElementById("dark_theme").setAttribute("class", "button theme active"); 
}

function writeLocal() { myLocalStorage.setItem("SDL_Theme", "Moles hate bright colours!"); }
function deleteLocal() {  myLocalStorage.removeItem("SDL_Theme"); }
function readLocal() { return myLocalStorage.getItem("SDL_Theme");}
