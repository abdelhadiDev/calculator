// Variables globales
const displaySelector = document.querySelector("#ecran");
let screen = "";

window.onload = () => {
    // On écoute les clics sur les touches
    let keys = document.querySelectorAll("span");
    for(let key of keys){
        key.addEventListener("click", clickKey);
    }
}

/**
 * Cette fonction réagit au clic sur les touches
 */
function clickKey(event){
    let key;
    let error = false;

    key = this.innerText;
    
    if (key === "C") {
        screen = "";
        displaySelector.value = 0;
    } else {
        // On met à jour la valeur de screen et on affiche sur l'écran
        screen = (screen === "") ? key.toString() : screen + key.toString();
        displaySelector.value = screen;
    }
}