const button = document.getElementById("button");
const navigationHeader = document.getElementById("navigation");
var hidden = true;
button.addEventListener('click',()=>{

    if(hidden){
        navigationHeader.classList.toggle('menu-header');
    }})
