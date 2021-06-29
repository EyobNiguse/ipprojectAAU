<?php 
require_once("connection.php");
function auth($email,$pass){
    $check_user_sql = "SELECT *  from users where Email='$email'";
    $check_user_query = mysqli_query($GLOBALS["conn"],$check_user_sql);
    $check_query_fetch = mysqli_fetch_array(mysqli_query($GLOBALS["conn"],$check_user_sql),MYSQLI_ASSOC);
    $verify =  password_verify($pass,$check_query_fetch["Password"]);
    $_SESSION["Email"] = $email;
    $_SESSION["Password"] = $pass;
    if($verify){
        $sql_get_user  = "select * from users where Email='$email'";
        $mysqli_fetch =  mysqli_fetch_array(mysqli_query($GLOBALS["conn"],$sql_get_user),MYSQLI_ASSOC);
        $_SESSION["username"] = $mysqli_fetch["UserName"];

    }
    return $verify; 
}
?>