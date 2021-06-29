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
if(isset($_POST["submitAlbum"])){
 
    $artName = $_FILES['art']['name'];
    move_uploaded_file($_FILES['art']['tmp_name'],'AlbumArt/'.$artName);
    $allowed = array('png', 'jpg');
    $ext = pathinfo($artName, PATHINFO_EXTENSION);
   if (!in_array($ext, $allowed)) {
    echo '0';
    exit();
  }
    $countFiles = count($_FILES['file']['name']);
    $Name = $_POST["Name"];
    $Artist = $_POST["Artist"];
    for($i=0;$i<$countFiles;$i++){
        $filename= $_FILES['file']['name'][$i];
        move_uploaded_file($_FILES['file']['tmp_name'][$i], 'Songs/'.$filename);
        $allowed = array('ogg', 'mp3', 'm4a');
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
       if (!in_array($ext, $allowed)) {
        echo '0';
      }
        $song_title = explode('.',$filename)[0];
        $song_location = 'Songs/'.$filename;
        //insert into songs table
        $sql_insert_song = "INSERT INTO songs (Title,Location,Artist)values('$song_title','$song_location','$Artist')";
        $query_insert_song = mysqli_query($GLOBALS["conn"],$sql_insert_song);
        $songsId = "";
        if($query_insert_song && $i > 0){
          $sql_last_song_id = "SELECT * from songs order by Id  DESC LIMIT  1";
          $fetch_last_song_id = mysqli_fetch_array(mysqli_query($GLOBALS["conn"],$sql_last_song_id),MYSQLI_ASSOC);
          $songsId = $fetch_last_song_id["Id"];
        }
        if($i == 0){
          $sql_insert = "INSERT INTO Albums values('$artName','$songsId','$Name','$Artist')";
          $query_insert = mysqli_query($GLOBALS["conn"],$sql_insert);
        }else{
          $songsId_read_sql = "SELECT * from Albums where Name='$Name'";
          $fetch_songsId = mysqli_fetch_array(mysqli_query($GLOBALS["conn"],$songsId_read_sql),MYSQLI_ASSOC);
          $song =  $fetch_songsId["SongsId"];
          $song = $song.",".$songsId;
          $sql_update = "UPDATE Albums set songsId = '$song' where Name = '$Name'";
          $update_query = mysqli_query($GLOBALS["conn"],$sql_update);

        }
      
      }
      echo "1";
}
if(isset($_POST["submitSong"])){
  $songName = $_FILES['song']['name'];
  $allowed = array('ogg', 'mp3', 'm4a');
 $ext = pathinfo($songName, PATHINFO_EXTENSION);
 if (!in_array($ext, $allowed)) {
  echo '0';
}
  move_uploaded_file($_FILES['tmp_name'], 'Songs/'.$songName);
  $title = $_POST["Title"];
  $location =  'Songs/'.$songName;
  $artist = $_POST["Artist"];
  $sql_insert_song = "INSERT INTO songs (Title,Location,Artist)values('$title','$location')";
  $query_insert_song  = mysqli_query($GLOBALS["conn"],$sql_insert_song);
  if($query_insert_song){
    echo "1";
  }
}

?>