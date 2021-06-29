<?php
require_once("connection.php");
function checkAdmin($email,$pass){
    $sql_checker = "SELECT * from  Admin where Email='$email'";
    $checker_query = mysqli_query($GLOBALS["conn"],$sql_checker);
    $fetch_query=   mysqli_fetch_array($checker_query,MYSQLI_ASSOC);
    $password = $fetch_query["Password"];
    $verify = password_verify($pass,$password);
    return $verify;
  
  }
?>