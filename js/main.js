const button = document.getElementById("button");
const navigationHeader = document.getElementById("navigation");
var hidden = true;
const login =  document.getElementById("login");
const form = document.getElementById("main-form");
const submit = document.getElementById("submit-btn");
const confirm =  document.getElementById("pass-confirm");
const usr =  document.getElementById("username");
const notice = document.getElementById("notice-form");
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
    login.addEventListener('click', ()=>{
     form.setAttribute("action","login.php");
     submit.innerHTML = 'Login';
     notice.innerHTML = "Login";
     confirm.remove();
     usr.remove();
     location.replace("#content");
    });
