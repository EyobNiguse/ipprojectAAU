const button = document.getElementById("button");
const navigationHeader = document.getElementById("navigation");
var hidden = true;
button.addEventListener('click',()=>{

    if(hidden){
        navigationHeader.classList.toggle('menu-header');
        console.log(document.getElementsByClassName("hidden-menu")[0].style.display);
        if(document.getElementsByClassName("hidden-menu")[0].style.display === 'block'){
            document.getElementsByClassName("hidden-menu")[0].style.display =  "none"; 
        }else{
            document.getElementsByClassName("hidden-menu")[0].style.display =  "block"; 
        }
            
    }})
