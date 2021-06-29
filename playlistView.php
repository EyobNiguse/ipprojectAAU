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
<?php 
if(isset($_GET["playlistName"])){
    $email = $_SESSION["Email"];
    $name = $_GET["playlistName"];
    $sql_select_play = "SELECT * FROM playlist where Email ='$email' and Name='$name'";
    $songs_get_query= mysqli_query($GLOBALS["conn"],$sql_select_play);
    $songs_get_fetch =  mysqli_fetch_array($songs_get_query,MYSQLI_ASSOC);
    $songsId = $songs_get_fetch["SongsId"];
    $songsId = explode(',',$songsId);
    $amount = count($songsId);  
    $response = '<table class="art-tr"><tr><td><div class="art" style="background:url(images/rd1.jpg);background-position:center;">';
    $response .= "<h3>$name</h3></div></td></tr></table>";
    $response .='<table class="song" cellspacing="10px">';
    for($i=0; $i< $amount;$i++){
    if($i==0){
        continue;
    }
    $id = $songsId[$i];
    $song_sql = "SELECT * FROM songs WHERE id = $id";
    $song_query = mysqli_query($GLOBALS["conn"],$song_sql);
    $song_fetch = mysqli_fetch_array($song_query,MYSQLI_ASSOC);
    $title =  substr($song_fetch["Title"], 0 ,30);
    $location =  $song_fetch["Location"];
    $response .= '<tr> <audio src=" " id="audio"></audio>';
    $response .= '<td class="first">';
    $response .= $i;
    $response  .= '</td><td class="second">';
    $response .= "<h3 name='$location'>$title";
    $response .= '<span class="play-btn"><i class="fas fa-play" name="play-song"></i></span></h3> </td>';
    $response .= '</tr>';    
}
    $response .= '</table>';
    echo $response;

}



if(isset($_GET["AlbumName"])){
    $Email  = $_SESSION["Email"];
    $sql_select_play = "SELECT * FROM playlist where Email ='$Email'";
    $sql_nav_query= mysqli_query($GLOBALS["conn"],$sql_select_play);
    $nav = "<select class='playlist-click'>";
    $nav .= "<option  value='0'>Add</option>";
    while($read = mysqli_fetch_array($sql_nav_query,MYSQLI_ASSOC)){
    $name = $read["Name"];
    $nav .= "<option class='add-one' value='$name'>$name</option>";
    }
    $nav .= "</select>";
 
    $name = $_GET["AlbumName"];
    $songs_get_sql = "SELECT * FROM Albums where Name='$name'";
    $songs_get_query = mysqli_query($GLOBALS["conn"],$songs_get_sql);
    $songs_get_fetch =  mysqli_fetch_array($songs_get_query,MYSQLI_ASSOC);
    $AlbumArt = $songs_get_fetch["CoverArt"];
    $songsId = $songs_get_fetch["SongsId"];
    $songsId = explode(',',$songsId);
    $amount = count($songsId);  
    $response = '<table class="art-tr"><tr><td><div class="art" style="background:url(AlbumArt/';
    $response .= $AlbumArt;
    $response .= ')">';
    $response .= "<h3>$name</h3></div></td></tr></table>";
    $response .='<table class="song" cellspacing="10px">';
    for($i=0; $i< $amount;$i++){
    if($i==0){
        continue;
    }
    $id = $songsId[$i];
    $song_sql = "SELECT * FROM songs WHERE id = $id";
    $song_query = mysqli_query($GLOBALS["conn"],$song_sql);
    $song_fetch = mysqli_fetch_array($song_query,MYSQLI_ASSOC);
    $title =  substr($song_fetch["Title"], 0 ,30);
    $location =  $song_fetch["Location"];
    $response .= '<tr>';
    $response .= '<td class="first">';
    $response .= $i;
    $response  .= '</td><td class="second"> <audio id="audio" src="" ></audio>';
    $response .= "<h3 name='$location'>$title";
    $response .= '<span class="play-btn"><i class="fas fa-play" name="play-song"></i>  </h3> </td>';
    $response .= "<td id=".$id.">".$nav."</td>";
    $response .= '</tr>';    
}
    $response .= '</table>';
    echo $response;

}

if(isset($_GET["AddPlayList"])){
$name =  $_GET["AddPlayList"];
$Email = $_SESSION["Email"];
$sql_select = "select count(*) as num from playlist where Email='$Email' and name='$name'";
$mysqli_fetch =  mysqli_fetch_array(mysqli_query($GLOBALS["conn"],$sql_select),MYSQLI_ASSOC);
if($mysqli_fetch["num"]>0){
    echo "playlist already exists !!";
    exit();
}else{
    $insert_sql = "INSERT INTO playlist (Email,name)value ('$Email','$name')";
    $insert_query = mysqli_query($GLOBALS["conn"],$insert_sql);
    echo "playlist  added";
}

}
if(isset($_GET["MyPlayList"])){
$sql_select = "select * from playlist where Email='$Email' and name='$name'";

$Email =  $_SESSION["Email"];
$query_select = mysqli_query($GLOBALS["conn"],$sql_select);
while($row = mysqli_fetch_array($query_select,MYSQLI_ASSOC)){
    $name =  $row["Name"];
    $response  = $response.'  <td><div class="album-play" style="background-image:linear-gradient(to right,rgba(255, 255, 255, 0.363), rgba(255, 255, 0, 0.363)),url(images/two.jpg)"name="'.$name.'">';
    $response = $response.'<h2>'.$name.'</h2>';
    $response = $response.'</div></td>';
}
$response = $response.'</tr>';
echo $response;
}
if(isset($_GET["search"])){
    $key = $_GET["search"];
    $sql_search = "SELECT * FROM songs where Title Like '%$key%' ";
    $query_search = mysqli_query($GLOBALS["conn"],$sql_search);
    $songsId =''; 
    if($query_search){
        while($fetch_search = mysqli_fetch_array($query_search,MYSQLI_ASSOC)){
            $songsId .= ','.$fetch_search["Id"];
        }
        $songsId = explode(",",$songsId);
        $amount = count($songsId);
        $AlbumName = '';
        for($i=0;$i<$amount;$i++){
         if($i==0){
             continue;
         }   
         $id = $songsId[$i];
         $sql_album = "SELECT * FROM Albums where SongsId Like '%,$id,%'";
        
         $query_albums = mysqli_query($GLOBALS["conn"],$sql_album);
         while($row=mysqli_fetch_array($query_albums,MYSQLI_ASSOC)){
             $AlbumName .= $row["Name"];
         }
        }
       
        $AlbumName = explode(",",$AlbumName);
        $response = "<tr>";
      
        if(count($AlbumName) >= 1){
            for($i=0;$i<count($AlbumName);$i++){
               
                $name = $AlbumName[$i];
                $sql_album= "SELECT * FROM Albums where Name = '$name'";
                $sql_query_album = mysqli_query($GLOBALS["conn"],$sql_album);
                $sql_album_fetch=  mysqli_fetch_array($sql_query_album,MYSQLI_ASSOC);

                $nameRes = $sql_album_fetch["Name"];
                if(!$nameRes){
                     echo "No Albums Found With the song $key";
                     exit();
                }
                $artistRes = $sql_album_fetch["Artist"]; 
                $coverArt =  $sql_album_fetch["CoverArt"];
                $response  = $response.'  <td><div class="album" style="background-image:linear-gradient(to right,rgba(255, 255, 255, 0.363), rgba(255, 255, 0, 0.363)),url(AlbumArt/'.$coverArt.')"name="'.$nameRes.'">';
                $response = $response.'<h2>'.$nameRes.'</h2>';
                $response = $response.'<h3> Artist: '.$artistRes.'</h3>';
                $response = $response.'</div></td>';
                if($i%3==0){
                    $response .= "</tr><tr>";
                }
            }
            $response .=  "</tr>";
            echo $response;
             
    }else{
        echo "No Albums Found With the song $key";
    }
  
    }else{
        echo $GLOBALS["conn"]->error;
    }



}
if(isset($_POST["name"])){
    $name = $_POST["name"];
    $songId = $_POST["id"];
    $email= $_SESSION["Email"];
    $get_sql = "select * from playlist where Email= '$email' and  Name='$name'";
    $query_song = mysqli_query($GLOBALS["conn"],$get_sql);
    $fetch = mysqli_fetch_array($query_song,MYSQLI_ASSOC);
    $songsId = $fetch["SongsId"];
    $expSong = explode(',' ,$songsId);
    $check = 1;
    foreach($expSong as $song){
        if($song != ' ' && $song == $songId){
            $check = 0;
            exit();
        }
    }
    $songsId .= ",".$songId;
    if($check){
        $update_sql = "update playlist set SongsId='$songsId' where Email= '$email' and Name='$name'";
        $query_playlist = mysqli_query($GLOBALS["conn"],$update_sql);
        if($query_playlist){
            echo "success";
        }else{
            echo "error";
        }
    }

    }

?>