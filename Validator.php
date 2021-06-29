<?php 
session_start();
?>
<?php header('Access-Control-Allow-Origin: *'); ?>
<?php 
require_once("connection.php");
require_once("auth.php");

if(isset($_POST['UserName'])){
    $message = "";
    $UserName = $_POST["UserName"];
    $Email = $_POST["Email"];
    $Password = $_POST["Password"]; 
    $ConfirmPassword = $_POST["ConfirmPassword"] ;
    if(!($UserName)){
            $message = $message."0";
    }if(!($Email)){
          $message = $message.",1";
    }if(!($Password)){
        $message = $message.",2";

    }if(!($ConfirmPassword)){
        $message = $message.",3";

    }if($ConfirmPassword != $Password){
     
        $message = $message.",4";

    }
    $check_sql =  "SELECT count(*) as num  from users where Email='$Email'";
    $check_query = mysqli_fetch_array(mysqli_query($GLOBALS["conn"],$check_sql), MYSQLI_ASSOC);
    if($check_query["num"] > 0){
        $message = $message.",5";
    }if($message  == ""){
    $pass =  password_hash($Password,PASSWORD_DEFAULT);
    $insert_sql = "INSERT INTO users  values('$Email','$UserName','$pass')";
    $insert_query = mysqli_query($GLOBALS["conn"],$insert_sql);
    
    }else{
        echo $message;
    }
}elseif(isset($_POST["Email"])){
    $Email =  $_POST["Email"];
    $Password = $_POST["Password"];

     if(auth($Email,$Password)){
         $_SESSION["Email"] = $Email;
         $_SESSION["Passowrd"] = $Password;
         header("location:Profile.php");
     }else{

           echo "incorrect login Credentials";
     }
}

?>