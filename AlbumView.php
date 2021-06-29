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

}else{
    header("location:index.html");
    exit();
}
if(isset($_GET["Discover"])){
    $sql_album = "SELECT * from Albums ";
    $query_album = mysqli_query($GLOBALS["conn"],$sql_album);
    $response  = '<tr>';
    $counter  = 0;
        while($row = mysqli_fetch_array($query_album,MYSQLI_ASSOC)){
            $name =  $row["Name"];
            $songsId = $row["SongsId"];
            $coverArt = $row["CoverArt"]; 
            $artistName =  $row["Artist"];
            $response  = $response.'  <td><div class="album" style="background-image:linear-gradient(to right,rgba(255, 255, 255, 0.363), rgba(255, 255, 0, 0.363)),url(AlbumArt/'.$coverArt.')"name="'.$name.'">';
            $response = $response.'<h2>'.$name.'</h2>';
            $response = $response.'<h3> Artist: '.$artistName.'</h3>';
            $response = $response.'</div></td>';
           
            if($counter == 3){
            break;
            }
            $counter ++;
        }
    $response = $response.'</tr>';
    echo $response;
        
    }

if(isset($_POST["Playlist"])){
    $response = "<tr>";
    for($i=0;$i<$length;$i++){
        
        if($i != 0){
            $sql_songs_get  = "SELECT * from songs where id =$i";
            $sql_query_song = mysqli_query($GLOBALS["conn"],$sql_songs_get);
            $mysqli_fetch_song =  mysqli_fetch_array($sql_query_song,MYSQLI_ASSOC);            
            $name = $mysqli_fetch_song["Name"];
            $artist = $mysqli_fetch_song["ArtistName"];
            $coverArt= $mysqli_fetch_song["CoverArt"];

            $response += `
                  
                    <td><div class="album" style="background:url(../images/)">
                        <h2>$name </h2>
                         <h3>Artist:  $artist</h3>
                    </div> </td>
                `;
        }
    }
    $response +="</tr>";
    echo $response;
}
if(isset($_GET["deletePlaylist"])){
    $name  = $_GET["deletePlaylist"];
    $email = $_SESSION["Email"];
    $sql_delete = "DELETE FROM playlist where Email='$email' and name='$name' ";
    $query = mysqli_query($GLOBALS["conn"],$sql_delete);
    if($query){
        echo "playlist deleted";
    }else{
        echo $GLOBALS["conn"]->error;
    }
}
if(isset($_GET["myPlay"])){
    $Email= $_SESSION["Email"];
    $sql_album = "SELECT * from playlist where Email='$Email'";
    $query_album = mysqli_query($GLOBALS["conn"],$sql_album);
    $response  = '<tr>';
    $counter  = 1;
        while($row = mysqli_fetch_array($query_album,MYSQLI_ASSOC)){
            $name =  $row["Name"];
            $response  = $response.'  <td><div class="album-play" style="background-image:linear-gradient(to right,rgba(255, 255, 255, 0.363), rgba(255, 255, 0, 0.363)),url(images/two.jpg)"name="'.$name.'">';
            $response = $response.'<i class="fas fa-times-circle btn-delete" name="delete"></i><h2>'.$name.'</h2>';
            $response = $response.' </div></td>';
           
            if($counter % 3 == 0){
                $response .= "</tr><tr>";
            }
            $counter ++;
        }
    $response = $response.'</tr>';
    echo $response;
        
    
    }

?>