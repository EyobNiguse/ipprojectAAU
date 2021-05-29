const button = document.getElementById("button");
const navigationHeader = document.getElementById("navigation");
var hidden = true;
button.addEventListener('click',()=>{

    if(hidden){
        navigationHeader.classList.toggle('menu-header');
        console.log(document.getElementsByClassName("hidden-menu")[0].style.display);
        if(document.getElementsByClassName("hidden-menu")[0].style.display === 'block'){
            document.getElementsByClassName("hidden-menu")[0].style.display =  "none"; 
            button.innerHTML= `  <div class="1"></div>
            <div class="2"></div>
            <div class="3"></div>`;
            button.style=  'margin-top:0px;';
        }else{
            document.getElementsByClassName("hidden-menu")[0].style.display =  "block"; 
       
            button.innerHTML = '<i class="fas fa-times-circle"></i>';
            button.style=  'margin-top:5px;';
        }
            
    }})
