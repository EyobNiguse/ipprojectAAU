<?php
session_start();
?>
<?php header('Access-Control-Allow-Origin: *'); ?>
<?php 
require_once("auth.php");
require_once("connection.php");
if(!(isset($_SESSION["Email"]))){
   if(isset($_POST["Email"])){
       $_SESSION["Email"] = $_POST["Email"];
       $_SESSION["Password"] = $_POST["Password"];

   }else{
       header("location:index.html");
   } 
}
if(auth($_SESSION["Email"],$_SESSION["Password"])){
$email = $_SESSION["Email"];
$sql_user_data = "SELECT * from users where Email = '$email'";
$fetch_userName = mysqli_fetch_array(mysqli_query($GLOBALS["conn"],$sql_user_data));
$UserName = $fetch_userName["UserName"];
}else{
    header("location:index.html");
    exit();
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" referrerpolicy="no-referrer" />
    <title>Profile</title>
    
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <div class="container" id="mainContainer">
      <div class="menu-container">
        <div class="name-display">
            <h3><?php echo $_SESSION["username"]?></h3>
        </div>
        <div class="discover" id="discoverMenu">
         <h3><i class="fas fa-globe-americas"></i> Discover</h3>

        </div>
        <div class="myplaylist" id="myPlayListMenu">
         <h3> <i class="fas fa-music"></i> My playlist</h3>
        </div>
        <div class="add-content" id="logout">
         <h3><i class="fa fa-sign-out" aria-hidden="true"></i> Log out</h3>
        </div>
      </div>
      <div class="action-container" id="discover"> 
        <div class="search">
            <form action="" method="GET"><span class="srch"><input type="text" class="txt-input" name="searchkey" id="key" placeholder="Search Here" ><button class="btn-search" id="search" TYPE="submit"><i class="fas fa-search"></i></button></span></form>
        </div>
        <table class="view" cellspacing="10px" id="view-discover">
          <tr>
              <td><div class="album">
                  <h2>Rock and Roll</h2>
                   <h3>Artist:  Mark</h3>
              </div> </td>
              <td><div class="album">
                  <h2>Rock and Roll</h2>
                   <h3>Artist:  Mark</h3>
              </div> </td>
              <td><div class="album">
                  <h2>Rock and Roll</h2>
                   <h3>Artist:  Mark</h3>
              </div> </td>
          </tr>
          <tr>
              <td>
                  
              </td>
          </tr>
      </table>
      </div>
    </div>
</body>
<script src="js/menu.js"></script>
</html>