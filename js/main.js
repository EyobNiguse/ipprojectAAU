const button = document.getElementById("button");
const navigationHeader = document.getElementById("navigation");
var hidden = true;
const login =  document.getElementById("login");
const form = document.getElementById("main-form");
const submit = document.getElementById("submit-btn");
<<<<<<< HEAD
const confirm =  document.getElementById("pass-confirm");
const usr =  document.getElementById("username");
const notice = document.getElementById("notice-form");
=======
const confirm =  document.getElementById("ConfirmPassword");
const usr =  document.getElementById("UserName");
const notice = document.getElementById("notice-form");
const Email = document.getElementById("Email");
const pass = document.getElementById("Password");

>>>>>>> 6ad740a (complete branch)
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
<<<<<<< HEAD
     form.setAttribute("action","login.php");
     submit.innerHTML = 'Login';
=======
     form.setAttribute("action","http://localhost/Musika/Profile.php");
     form.setAttribute("method","POST");

     submit.innerHTML = 'Login';
     submit.id = "login";
>>>>>>> 6ad740a (complete branch)
     notice.innerHTML = "Login";
     confirm.remove();
     usr.remove();
     location.replace("#content");
    });
<<<<<<< HEAD
=======
submit.addEventListener('click',(e)=>{
   if(submit.id=="submit-btn"){
    e.preventDefault();
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status==200){
            if(this.responseText!="success"){
                var  errorMessage = this.responseText.split(","); 
                errorMessage.forEach((i,elem)=>{
                    console.log(i);
                    switch(i){
                        case"0":
                            usr.setAttribute("placeholder","Username can not be empty");
                            usr.style ="border-left:2px solid red";
                            usr.className="err";
                        break;
                        case "1":
                            Email.placeholder = "Email can not be empty";
                            Email.style = "border-left:2px solid red";
                            Email.className="err";
                            break;
                            case "2":
                                pass.placeholder = "Password can not be empty";
                                pass.style = "border-left:2px solid red";
                                pass.className="err";
                                break;
                                case "3":
                                    confirm.placeholder = "Passwords do not match";
                                    confirm.style = "border-left:2px solid red";
                                    confirm.className="err";
                                    break;
                                    case "4":
                                        confirm.placeholder = "Passwords do not match";
                                        confirm.style = "border-left:2px solid red";
                                        confirm.className="err";
                                        break;
                                        case "5":
                                            Email.value="";
                                            Email.placeholder = "Email already exists";
                                            Email.style = "border-left:2px solid red";
                                            Email.className="err";
                                            break;

                    }
                });
            }else{
                console.log(this.responseText);
                login.click();
            }

            
        }

    }
    xmlHttp.open('post','http://localhost/Musika/Validator.php',true);
    const sendString = "Email=" + Email.value + "&Password=" + pass.value + "&UserName=" + usr.value + "&ConfirmPassword=" + confirm.value; 
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send(sendString);
}
});
>>>>>>> 6ad740a (complete branch)
