<?php
session_start();
?>
<?php header('Access-Control-Allow-Origin: *'); ?>
<?php 
require_once("checkAdmin.php");
require_once("connection.php");
if(!(isset($_SESSION["Email"]))){
   if(isset($_POST["Email"])){
       $_SESSION["Email"] = $_POST["Email"];
       $_SESSION["Password"] = $_POST["Password"];

   }else{
       header("location:login.html");
   } 
}
if(checkAdmin($_SESSION["Email"],$_SESSION["Password"])){
$email = $_SESSION["Email"];
$sql_user_data = "SELECT * from users where Email = '$email'";
$fetch_userName = mysqli_fetch_array(mysqli_query($GLOBALS["conn"],$sql_user_data));
$UserName = $fetch_userName["UserName"];
}else{
    header("location:donot.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/manage.css">
    <title>Manage</title>
</head>
<body>
    <div class="container">
        <div class="add-album">
            <h3>
                Add Album
            </h3>
            <form action="AdminUpload.php"  method="POST" enctype='multipart/form-data' >
            <input type="text" name="Name" placeholder="Enter The Album Title" class="txt-input" requried>
            <input type="text" name="Artist" class="txt-input" placeholder="Enter the Artist Name" required>
            <input type="file" name="art" class="txt-input" placeholder="Album Art" required>
            <input type="file" name="file[]" class="txt-input" id="file" placeholder="Song tracks" multiple required>
            <button type="submit" name="submitAlbum" class="submit-btn">
                Submit
            </button>
            </form>
        </div>
        <div class="add-song">
            <h3>
                Add Song
                </h3>
            <form action="AdminUpload.php" method="POST" enctype='multipart/form-data'>
                <input type="text" name="Title" placeholder="Enter the song title" class="txt-input" >
                <input type="text" name="Artist" placeholder="Enter the Artist Name" class="txt-input" >
                <input type="file" name="song" placeholder="Select A song" class="txt-input" requried>
                <button type="submit" name="submitSong" class="submit-btn">
                    Submit
                </button>
            </form>
        </div>
    </div>
</body>
</html>