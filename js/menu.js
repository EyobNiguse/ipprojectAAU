
var discover =  document.getElementById("discover");
var playlist =  document.getElementById("playList");
var content = document.getElementById("content");
const discoverMenu = document.getElementById("discoverMenu");
const playlistMenu = document.getElementById("myPlayListMenu");
const logout = document.getElementById("logout");
var mainContainer = document.getElementById("mainContainer");
var addMy = document.getElementById("add_my");
var album  = document.getElementsByClassName("album");
var find =  document.getElementById("search");
var addMine = document.getElementById("addPlayList");
var addPlay = document.getElementById("table-play");
logout.addEventListener('click',()=>{
window.location.replace('logout.php');
})

find.addEventListener('click',(e)=>{
    e.preventDefault();
    const searchInput = document.getElementById("key");
    var xhttp =  new XMLHttpRequest();
    const name = e.target.getAttribute("name");
    xhttp.onreadystatechange = async function (){
        if(this.readyState==4 && this.status==200){
            var tableView = document.getElementById("view-discover");
            if(tableView){
                tableView.innerHTML = "";
                tableView.innerHTML =await  this.responseText;
            }

        }
    }
    xhttp.open("GET",`http://localhost/Musika/playlistView.php?search=${searchInput.value}`);
    xhttp.send();
});
ShowInDiscover();
//handling ajax created elements requests
document.addEventListener('click', function(e){
    if(e.target && e.target.className== 'album'){
        var tableView = document.getElementById("view-discover");
        var xhttp =  new XMLHttpRequest();
        const  name = e.target.getAttribute("name");
        xhttp.onreadystatechange =  async function(){
            if(this.readyState==4&& this.status==200){
                checkVars();
                if(discover){
                    discover.innerHTML = "";
                    discover.innerHTML += await this.responseText;
                    
                }else if(playlist){
                    playlist.innerHTML = "";
                    playlist.innerHTML = await this.responseText;
                }
        
            }
        }
        
            xhttp.open("GET",`http://localhost/Musika/playlistView.php?AlbumName=${name}`);
            xhttp.send();
        
    
    }else if(e.target && e.target.className =='album-add'){
        
        checkVars();
        console.log(addPlay);
        addPlay.innerHTML="";
        e.target.remove();
        addPlay.innerHTML = addPlaylistContent;
        const addbutton  =  document.getElementById("addPlayList");
        addbutton.addEventListener("click", (e)=>{
            const name = document.getElementById("playName");
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange =   async function(){
                if(this.readyState==4 && this.status == 200){
                  const res =  await this.responseText;
                  alert(res);
                  playlistMenu.click();
                }
            }
            xhttp.open("GET",  `http://localhost/Musika/playlistView.php?AddPlayList=${name.value}`);
            xhttp.send();
        })
    }else if(e.target && e.target.className == 'album-play'){
        var xhttp =  new XMLHttpRequest();
        const  name = e.target.getAttribute("name");
        xhttp.onreadystatechange =  async function(){
            if(this.readyState==4&& this.status==200){
                     checkVars();
    
                    playlist.innerHTML = "";
                    playlist.innerHTML = await this.responseText;
            
        
            }
        }
        xhttp.open("GET",`http://localhost/Musika/playlistView.php?playlistName=${name}`);
        xhttp.send();
    }else if(e.target && e.target.getAttribute("name") =="delete"){
        const name = e.target.parentNode.getAttribute("name");
        var xhttp =  new XMLHttpRequest();
        xhttp.onreadystatechange =  async function(){
            if(this.readyState == 4 && this.status == 200){
                const res =  await this.responseText;
                alert(res);
                playlistMenu.click();

            }
        }
        xhttp.open("GET",`http://localhost/Musika/AlbumView.php?deletePlaylist=${name}`);
        xhttp.send();
    }else if(e.target && e.target.getAttribute("name")=="play-song"){
        const name =  e.target.parentNode.parentNode.getAttribute("name");
        const audio  = document.getElementById("audio");
        audio.src = name;
        audio.addEventListener('ended',()=>{
            const songsList =  document.getElementsByClassName("fa-pause");
            songsList[0].classList.remove('fa-pause');
            songsList[0].classList.add('fa-play');
        }
        )
        if(e.target.classList.contains("fa-play")){
            e.target.classList.remove("fa-play");
            e.target.classList.add("fa-pause");
            if(audio.src!=""){
                audio.pause();
                const songsList =  document.getElementsByClassName("fas");
                console.log(songsList);
                for(i=0;i<songsList.length;i++){
                console.log( songsList[i].parentNode.parentNode.getAttribute("name"));
                console.log(audio.getAttribute("src"));

                    if(songsList[i].classList.contains('fa-pause') && songsList[i].parentNode.parentNode.getAttribute("name") !== audio.getAttribute('src') && audio.getAttribute("src")!==""){
                        songsList[i].classList.remove('fa-pause')
                        songsList[i].classList.add('fa-play');
                    }
                }

            }
            audio.play(); 
       }else{
            e.target.classList.remove("fa-pause");
            e.target.classList.add("fa-play"); 
            audio.pause();
        }
        console.log(e.target.getAttribute("name"));
        // song.play();
        
    }});
function player(name,press){
    song  = new Audio(name);
    if(press%2==0 && press !=0){
        sound.pause(); 
        sound.currentTime = 0;
    }
}
document.addEventListener("change",(e)=>{
    if(e.target && e.target.className == 'playlist-click'){
        console.log(e);
        const id = e.target.parentNode.id;   
        const name = e.target.value;
        console.log(id);
        console.log(name);
        var xhttp =  new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState==4 && this.status ==200){
                console.log(this.responseText);
            }
        }
        xhttp.open("post","http://localhost/Musika/playlistView.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`name=${name}&id=${id}`);
        
    }
});

function htmlToElement(html){
    var template = document.createElement('template');
    html =  html.trim();
    template.innerHTML = html;
    return template.content.firstChild;

}
function checkVars(){
    discover =  document.getElementById("discover");
    playlist =  document.getElementById("playlist");
    content = document.getElementById("content");
    addMy = document.getElementById("add_my");
    addMine = document.getElementById("addPlayList");
    addPlay = document.getElementById("table-play");
    
    }
const contentContent = `
<div class="play-container" id="content">
    <table class="view" cellspacing="10px">
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
                <div class="album-add" id="add_my">
                    <h2> <i class="fa fa-plus" aria-hidden="true"></i>
                    Add</h2>
                
                </div> 
            </td>
        </tr>
    </table>
</div>
 `;
const discoverContent = `
<div class="action-container" id="discover"> 
<div class="search">
    <form action="" method="GET"><span class="srch"><input type="text" class="txt-input" name="searchkey" id="key" placeholder="Search Here"><button class="btn-search" TYPE="submit" id="search"><i class="fas fa-search"></i></button></span></form>
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
</div>`;
const playlistContent = `
<div class="play-container" id="playlist">


    <table class="view" cellspacing="10px" id="table-play">
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
        </table>
        <table class="view" id="add-table">
        <tr>
        <td></td>
        <td id="add-play"><div class="album-add">
        <h2>Add</h2>
    </div> </td>
        </tr>
        </table>
  
  </div>
`;
addPlaylistContent = `
<div class="add-album">
<h3>
    Add playList
</h3>
<div>
<input type="text" id="playName" placeholder="Enter The playlist Title" class="txt-input" required>
<button type="submit"  id="addPlayList" class="submit-btn">
    Add
</button>
</div>
</div>

    `;
const addContent = `
<div class="add-album">
<h3>
    Add Album
</h3>
<form action="AdminUpload.php" enctype='multipart/form-data'>
<input type="text" name="Name" placeholder="Enter The Album Title" class="txt-input" requried>
<input type="text" name="Artist" class="txt-input" placeholder="Enter the Artist Name" required>
<input type="file" name="art" class="txt-input" placeholder="Album Art" required>
<input type="file" name="file[]" class="txt-input" id="file" placeholder="Song tracks" multiple required>
<button type="submit" name="submitAlbum"  id="submitAlbum" class="submit-btn">
    Submit
</button>
</form>
</div>
<div class="add-song">
<h3>
    Add Song
    </h3>
<form action="AdminUpload.php" method="post" enctype='multipart/form-data'>
    <input type="text" name="Title" placeholder="Enter the song title" class="txt-input" >
    <input type="text" name="Artist" placeholder="Enter the Artist Name" class="txt-input" >
    <input type="file" name="song" placeholder="Select A song" class="txt-input" requried>
    <button type="submit" name="submitSong" id="submitSong" class="submit-btn">
        Upload
    </button>
</form>
</div>`;
function ShowInDiscover(){
    checkVars();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange =  function(){
        console.log("called here");
        if(this.readyState==4 && this.status == 200){
            var tableView = document.getElementById("view-discover");
            if(tableView){
                tableView.innerHTML = "";
                tableView.innerHTML = this.responseText;
            }
         
        }
    }
    xhttp.open("GET","http://localhost/Musika/AlbumView.php?Discover=1");
    xhttp.send();
}
discoverMenu.addEventListener('click',()=>{
    ShowInDiscover();
    checkVars();
if(discover){

}else if(playlist){

    playlist.remove();
    mainContainer.appendChild(htmlToElement(discoverContent));
    
    

}else if(content){

content.remove();
mainContainer.appendChild(htmlToElement(discoverContent));

}
});
playlistMenu.addEventListener('click',()=>{
    checkVars();    
    if(playlist){
        checkVars();  
        playlist.remove();
        mainContainer.appendChild(htmlToElement(playlistContent));
        getPlaylist();  
    }else if(discover){
    checkVars();
    discover.remove();
    mainContainer.appendChild(htmlToElement(playlistContent));
    getPlaylist();
    
}else if(content){
    checkVars();
    content.remove();
    mainContainer.appendChild(htmlToElement(playlistContent));
    getPlaylist();
    
}
 
});
function getPlaylist(){
    const tbl =  document.getElementById("table-play");
    tbl.innerHTML="";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange =  function(){
     if(this.readyState==4 && this.status==200){
         tbl.innerHTML = this.responseText;
     }
 }
 xhttp.open("GET",`http://localhost/Musika/AlbumView.php?myPlay=1`);
 xhttp.send();
}
