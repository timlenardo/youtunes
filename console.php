<?php
	session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" type="text/css" href="youTunesStyle.css" title="Twitter User Lookup Styles"/>
		<script src="js/googlejsapi.js" type="text/javascript"></script>
		<script type="text/javascript">
    	  google.load("swfobject", "2.1");
   		 </script>  
    	<script type="text/javascript">
      
      var paused=false;
      var selected="none";
      /*
       * Change out the video that is playing
       */
      
      // Update a particular HTML element with a new value
      function updateHTML(elmId, value) {
        document.getElementById(elmId).innerHTML = value;
      }
      
      // Loads the selected video into the player.
      function loadVideo() {
        var selectBox = document.getElementById("videoSelection");
        var videoID = selectBox.options[selectBox.selectedIndex].value
        
        if(ytplayer) {
          ytplayer.loadVideoById(videoID);
        }
      }
      
      function pause(sender){
      	
      	if(ytplayer){
      		if(paused){
      			sender.src = "images/pause.png";
      			ytplayer.playVideo();
      			paused=false;
      		}
      		else{
      			sender.src = "play.png";
      			ytplayer.pauseVideo();
      			paused=true;
      		}
      	}
      }
      

      
      function back(){
      	if(ytplayer){
      		ytplayer.previousVideo();
      	}
      }
      
      function forward(){
      	if(ytplayer){
      		ytplayer.nextVideo();
      	}
      }
      
      // This function is called when an error is thrown by the player
      function onPlayerError(errorCode) {
        alert("An error occured of type:" + errorCode);
      }
      
      // This function is automatically called by the player once it loads
      function onYouTubePlayerReady(playerId) {
        ytplayer = document.getElementById("ytPlayer");
        ytplayer.addEventListener("onError", "onPlayerError");
        initializePlayer();
      }
      
      // The "main method" of this sample. Called when someone clicks "Run".
      function loadPlayer() {
        // The video to load
        var videoID = "Ao138HwSqow"
        // Lets Flash from another domain call JavaScript
        var params = { allowScriptAccess: "always" };
        // The element id of the Flash embed
        var atts = { id: "ytPlayer" };
        // All of the magic handled by SWFObject (http://code.google.com/p/swfobject/)
        swfobject.embedSWF("http://www.youtube.com/v/" + videoID + 
                           "?version=3&enablejsapi=1&playerapiid=player1", 
                           "videoDiv", "560", "245", "9", null, null, params, atts);
      }
      
    /*  function init(){
      	var nameCategory=document.getElementById("name");
      	nameCategory.setAttribute
      }*/
     
      
      function _run() {
        loadPlayer();
        /*init();*/
      }
      
      
      google.setOnLoadCallback(_run);
    </script>
		<!--script type="text/javascript" src="swfobject.js"></script>
		<script src="//www.google.com/jsapi"></script>
		<script src="js/as3_demo_functions.js" type="text/javascript"></script-->
			
			
			
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<style type="text/css">
			@import "css/demo_page.css";
			@import "css/jquery.dataTables.css";
			@import "css/dataTables.tabletools.css";
			@import "css/dataTables.editor.css";
		</style>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/jquery.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/dataTables.tabletools.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/dataTables.editor.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/table.Songs.js"></script>
		<script src="js/dataTables.commonAPIs.js" type="text/javascript" ></script>
		<script type="text/javascript">
			$.fn.dataTableExt.oApi.fnGetAdjacentTr  = function ( oSettings, nTr, bNext )
			{
   			 /* Find the node's position in the aoData store */
    		var iCurrent = oSettings.oApi._fnNodeToDataIndex( oSettings, nTr );
      
    		/* Convert that to a position in the display array */
    		var iDisplayIndex = $.inArray( iCurrent, oSettings.aiDisplay );
    		if ( iDisplayIndex == -1 )
    		{
        		/* Not in the current display */
        		return null;
    		}
      
    		/* Move along the display array as needed */
    		iDisplayIndex += (typeof bNext=='undefined' || bNext) ? 1 : -1;
      
    		/* Check that it within bounds */
    		if ( iDisplayIndex < 0 || iDisplayIndex >= oSettings.aiDisplay.length )
    		{
      	  		/* There is no next/previous element */
        		return null;
    		}
      
    		/* Return the target node from the aoData store */
    		return oSettings.aoData[ oSettings.aiDisplay[ iDisplayIndex ] ].nTr;
			};
		</script>
		<script type="text/javascript" charset="utf-8">
		
			
				
			var interval = setInterval(checkTableLoaded,250);
			/*console.log(interval);*/
			var selectedRow = null;
				
			
			function checkTableLoaded(){
				
				var first = $(".odd");
				/*console.log(first);*/
				var children = first.length;
				
				
				if (children > 1) {
					clearInterval(interval);

					 oTable = $('#Songs').dataTable();
 
 					 oTable.$('tr').click( function () {
   					 	var data = oTable.fnGetData( this );
   					 	/*console.log(data);*/
   					 	/*console.log(selectedRow);*/
   					 	if(selectedRow == null){
   					 		/*console.log("first");*/
   					 		selectedRow = data;
   					 	}
   					 	else if (selectedRow != data){
   					 		var formerDTRowSel = document.getElementById(selectedRow.DT_RowId);
   					 		var curDTRowSel = document.getElementById(data.DT_RowId);
   					 		var formerClass = formerDTRowSel.getAttribute("class");
   					 		var curClass = curDTRowSel.getAttribute("class");
   					 		
   					 		/*console.log(formerClass + "  " + curClass);*/
   					 		//split the "DTTT Selected" off of the forer class and reset it
   					 		var splitClass = formerClass.split(" ");
   					 		var newFor = splitClass[0];
   					 		var newCur = curClass + " DTTT_selected"
   					 		formerDTRowSel.setAttribute("class", newFor);
   					 		
   					 		curDTRowSel.setAttribute("class", newCur);
   					 		
   					 		/*console.log(newFor + "  " + newCur);*/
   					 		selectedRow = data;
   					 		
   					 	}
   					 	else{
   					 		var curDTRowSel = document.getElementById(data.DT_RowId);
   					 		var curClass = curDTRowSel.getAttribute("class");
   					 		/*console.log(curClass);*/
   					 		
   					 		var splitClass = curClass.split(" ");
   					 		
   					 		/*console.log(splitClass[1] + "  ");*/
   					 		if(splitClass.length <= 1){
   					 			/*console.log("Got Here!");*/
   					 			curDTRowSel.setAttribute("class", splitClass[0] + " DTTT_selected");
   					 		}
   					 		
   					 	}
   					 	
   					 	
  					 	
 					 });
 					 
 					 oTable.$('tr').dblclick( function () {
 					 	var data = oTable.fnGetData( this );
 					 	//console.log(data['Video']);
 					 	/*if(ytplayer){
 					 		ytplayer.
 					 	}*/
 					 	Play(this);		
 					 });
						
					
				
				}
				
		
			}
			
		</script>
	</head>

	<body>
		
		<div id="header">
		
			<div id="nav">
				<ul id="navi">
				<li id="back">
					<img src="back.png" alt="some_text" onclick="back()"/>
				</li>
				<li id="play" >
					<img src="play.png" onclick="pause(this)" alt="some_text" id="playButton"/>
				</li>
				<li id="forward">
					<img src="forward.png" alt="some_text" onclick="forward()"/>
				</li>
				</ul>
			</div>
			<div id="center">
				
				
				<div id="videoDiv"></div>
				
				<div id="progress">
					<div id="songInfo">
					<h4 id="titlePane">
						Welcome to youTunes
					</h4>
					<h4 id="artistPane">
					
						(| ' _ ' |)
					</h4>
					</div>
					<div id="progressBar">
						<div id="loaded">
						</div>
						<div id="completed">
						</div>
						
						
						
					</div>	
				</div>
			
			</div>
			
			
			
		</div>
		
		<div id="leftColumn">
			<div id="playlistContainer">
				<table id="playlist">
					<thead class="playlistCategory">
						<th>
							<p>
								All music
							</p>
						</th>
					</thead>
					<tr class="playlist">
						<td>
							<p class="playlist">
								My Library
							</p>
			
						</td>
					</tr>
					<tr class="playlist">
						<td>
							<p class="playlist">
								youTunes Top 25
							</p>
			
						</td>
					</tr>
					<tr class="playlist">
						<td>
							<p class="playlist">
								youTunes Top 50
							</p>
			
						</td>
					</tr>
					<tr class="playlist" id="selectedHeader">
						<td>
							<p class="playlist">
								youTunes Top 100
							</p>
			
						</td>
					</tr>
					
					<thead class="playlistCategory">
						<th>
							<p>
								My music
							</p>
						</th>
					</thead>
					<tr class="playlist">
						<td>
							<p class="playlist">
								Shower Playlist
							</p>
			
						</td>
					</tr>
					<tr class="playlist">
						<td>
							<p class="playlist">
								Other Playlist
							</p>
			
						</td>
					</tr>
					<tr class="playlist">
						<td>
							<p class="playlist">
								Other Playlist
							</p>
			
						</td>
					</tr>
					<tr class="playlist">
						<td>
							<p class="playlist">
								Other Playlist
							</p>
			
						</td>
					</tr>
					<tr class="playlist">
						<td>
							<p class="playlist">
								Other Playlist
							</p>
			
						</td>
					</tr><br /><tr class="playlist">
						<td>
							<p class="playlist">
								Other Playlist
							</p>
			
						</td>
					</tr>
					<tr class="playlist">
						<td>
							<p class="playlist">
								Other Playlist
							</p>
			
						</td>
					</tr>
					<tr class="playlist">
						<td>
							<p class="playlist">
								Other Playlist
							</p>
			
						</td>
					</tr>
					<tr class="playlist">
						<td>
							<p class="playlist">
								Other Playlist
							</p>
			
						</td>
					</tr><br /><tr class="playlist">
						<td>
							<p class="playlist">
								Other Playlist
							</p>
			
						</td>
					</tr>
					<tr class="playlist">
						<td>
							<p class="playlist">
								Other Playlist
							</p>
			
						</td>
					</tr>
					<tr class="playlist">
						<td>
							<p class="playlist">
								Other Playlist
							</p>
			
						</td>
					</tr><br /><tr class="playlist">
						<td>
							<p class="playlist">
								Other Playlist
							</p>
			
						</td>
					</tr>
					<tr class="playlist">
						<td>
							<p class="playlist">
								Other Playlist
							</p>
			
						</td>
					</tr>
					<tr class="playlist">
						<td>
							<p class="playlist">
								Other Playlist
							</p>
			
						</td>
					</tr>
					<tr class="playlist">
						<td>
							<p class="playlist">
								Other Playlist
							</p>
			
						</td>
					</tr>
					<tr class="playlist">
						<td>
							<p class="playlist">
								Other Playlist
							</p>
			
						</td>
					</tr>
					<tr class="playlist">
						<td>
							<p class="playlist">
								Other Playlist
							</p>
			
						</td>
					</tr>
					
					
				</table>
			</div>
		</div>
		
		<div id="cont">
			
			
			<div id="library">
				
				<div id="container">
					
					<table cellpadding="0" cellspacing="0" border="0" class="display" id="Songs" width="100%">
						<thead>
							<tr>
								<th id="nameSel" onclick="selectHeader(this)">Name</th>
								<th id="time" onclick="selectHeader(this)">Time</th>
								<th id="artist" onclick="selectHeader(this)">Artist</th>
								<th id="album" onclick="selectHeader(this)">Album</th>
								<th id="genre" onclick="selectHeader(this)">Genre</th>
								<th id="plays" onclick="selectHeader(this)">Plays</th>
								<th id="video">VideoID</th>
							</tr>
						</thead>
					</table>

				</div>
					
					
					<?php
						
						$db = mysql_connect("localhost","root", "root");
						
						//check to see if the database was connected to successfully
    					if (!$db){
       						echo "Could not connect to database" . mysql_error();
        					exit();
    					}//end if
						
						//try to connect to the specific database, kill the thread if not
						$db_name = "youTunes";
   		 				if (!mysql_select_db($db_name, $db)){
        					die ("Could not select database") . mysql_error();
    					}//end if
	
						
    					$sql=mysql_query("select * from Songs");
    					
						//counts the number of songs and stores them for communication with Javascript later
    					$index = 0;
						$songs= array();
						
						
    					while($row=mysql_fetch_assoc($sql)){
       						
							$vID = $row['Video'];
							$title = $row['Title'];
							$time = $row['Time'];
							$artist = $row['Artist'];
							$plays = $row['Plays'];
							$genre = $row['Genre'];
							$sId = $row['sID'];
							$album = $row['Album'];
							
							
							$songs[$index] = array('vID' => $vID, 'title' => $title, 'time' => $time, 'artist' => $artist, 'plays' => $plays, 'genre' => $genre, 'sID' => $sId, 'album' => $album);
							
							//increment the counter so that the next video gets the next index
							$index++;
						}//end while	
					
					
					?>
					
				<script type="text/javascript">
					var selected=-1;
					var progress=document.getElementById('completed');
					var loadedBar=document.getElementById('loaded');
					var titlePane=document.getElementById('titlePane');
					var artistPane=document.getElementById('artistPane');
					var songArray = [];
					var titleArray = [];
					var artistArray = [];
   					var initialized = false; 
   					var selected="nameSel";
   					var shuffle=false;
   					var loop=0;
   					var index_map = new Object;
   					var currentSongPlaying = -1;
   					
   					/**
   					 * Runs through all of the songs, and cues them into the player as a playlist
   					 */
   					function initializePlayer(){
   						<?php echo("var numSongs = $index;"); ?>
						
						//Prints the songs into javascript from PHP
						var num = parseInt(numSongs);
				 				<?php 
				 					//prints out the songID, title and author to be stored in Javascript
									print ("var songs = \"");
									foreach ($songs as $vid){
										$id = $vid['vID'];
										$num = $vid['sID'];
										$tit = $vid['title'];
										$artist = $vid['artist'];
										print("$id<>$tit<>$artist<>$num;");
									}
									print("\";");
								?>
						//console.log(songs);
						var infoArray = songs.split(";");
						
						
						//run through the info and store them in songArray, titleArray, and artistArray accordingly
						for(var i = 0; i < infoArray.length; i++){
							
							var spltArr = infoArray[i].split("<>");
							var id = spltArr[3];
							index_map[id] = i;
							
							songArray[i] = spltArr[0];
							titleArray[i] = spltArr[1];
							artistArray[i] = spltArr[2];
						}//end for
						console.log(songArray);
						if(ytplayer){
   							//set an event listener, and cue the playlist. 
   							ytplayer.addEventListener("onStateChange", "onPlayerStateChange");
   							ytplayer.cuePlaylist(songArray,0,0,"small");
   						}//end if
   						
   					}//end initialize player
   					
   					//Changes the class of a header when the user clicks on it 
      				function selectHeader(sender){
      					
      					var id = sender.getAttribute("id");
      					
      					//checks if that header is already selected. If not change it
      					if(selected != id){
      						var previous = document.getElementById(selected);
      						var cut = selected.indexOf("Sel");
      						var newID = selected.slice(0,cut);
      						previous.setAttribute("id", newID);
      						selected = id + "Sel";
      						sender.setAttribute("id", id + "Sel");
      					}//end if
      				
      				}//end selectHeader
   					
   					
   					function updatePlayerInfo(){
   						
   						if(ytplayer && ytplayer.getDuration){
   							
   							var length = ytplayer.getDuration();
   							var curTime = ytplayer.getCurrentTime();
   							var total = ytplayer.getVideoBytesTotal();
   							var loaded = ytplayer.getVideoBytesLoaded();
   							
   							var percent = curTime/length * 100;
   							var loadedPercent = loaded/total * 100;
   							
   							var stringPercent = percent.toString();
   							var stringLoaded = loadedPercent.toString();
   							progress.style.width = stringPercent.concat("%");
   							loadedBar.style.width = stringLoaded.concat("%");
   							/*console.log("UpdatingPlayerInfo");*/
   						}	
   					}
   					
   					/**
   					 * SetShuffle
   					 * Resets the shuffle value depending on its current value
   					 */
   					function setShuffle(sender){
   						if(shuffle){
   							sender.setAttribute("src", "Images/shuffle50.png");
   							shuffle=false;
   						}//end if
   						else{
   							sender.setAttribute("src", "Images/shuffleSel50.png");
   							shuffle=true;
   						}//end else
   					}//end setShuffle
   					
   					/**
   					 * setLoop
   					 * Sets the loop value to either no loop, loop, or single song loop
   					 */
   					function setLoop(sender){
   						if(loop==0){
   							sender.setAttribute("src", "Images/loopSel50.png");
   							loop =1;
   						}//end if
   						else if(loop==1){
   							sender.setAttribute("src", "Images/loopSingleSel50.png");
   							loop=2;
   						}//end else if
   						else{
   							sender.setAttribute("src", "Images/loop50.png");
   							loop=0;
   						}//end else
   					}//end setLoop
   				
   					//Handles the state changes accordingly
   					function onPlayerStateChange(newState){
   						//TODO When a song has ended, increment its play count, find the next song, and play that one
   						if(newState == 0){
   							console.log("Song ended");
   							if(loop==2){
   								console.log("Single Loop");
   								ytplayer.stopVideo();
   								PlayIndex(currentSongPlaying);
   							}
   							else if(loop==1){
   								ytplayer.
   							}
   							//if shuffle is set, play a random song
   							else if(shuffle){
   								console.log("shuffle: " + Object.keys(index_map).length);
   								var nextSong=Math.floor(Math.random() * Object.keys(index_map).length);
   								
   								ytplayer.stopVideo();
   								PlayIndex(nextSong);
   							}//end if
   							//TODO otherwise somehow determine the next song
   							else{
   								console.log("Finding next");
   								var oTable = $('#Songs').dataTable();
   								var id = "#row_" + currentSongPlaying;

   								var current = $(id);
   								console.log(id +"   " + current + "    " + currentSongPlaying);
   								var nNext = oTable.fnGetAdjacentTr( current );
   								console.log(currentSongPlaying + "      " + nNext);
   								play(nNext);
   							}
   								
   						}
   						else if(newState == 1){
   							titlePane.innerHTML = '';
   							artistPane.innerHTML = '';
   							
   							
   							var index = ytplayer.getPlaylistIndex();
   							
   							titlePane.innerHTML = titleArray[index];
   							artistPane.innerHTML = artistArray[index];
   						}
   					}
   					
   					//Plays the song selected (called on a double click)
   					function Play(sender)
   					{
   						
   						var index = sender.getAttribute("id");
   						var splitIndex = index.split("_");
   						var vIndex = parseInt(splitIndex[1]);
   						
   						currentSongPlaying = vIndex;
   						PlayIndex(vIndex);
   						
   					}//end play
   					
   					function PlayIndex(index){
   						setInterval(updatePlayerInfo, 250);
   						if(ytplayer){
   							var curIndex = index_map[index];
   							console.log("Index to play: " + curIndex + "   " + "apped fro index: " + index);
   							ytplayer.playVideoAt(curIndex);
   							titlePane.innerHTML = titleArray[curIndex];
   							artistPane.innerHTML = artistArray[curIndex];
   							var play = document.getElementById("playButton");
   							play.src = "images/pause.png";
   						}//end if
   					}//end playIndex
   					
   				</script>
				
				
				<!--script type="text/javascript">
					//queuing up the songs in the youtube player!
					
					<?php echo("var numSongs = $index;"); ?>
					var num = parseInt(numSongs);
				 				<?php 
									print ("var songs = \"");
									foreach ($songs as $vID){
										
										print("$vID;");
									}
									print("\";");
								?>
					
					var songArray = songs.split(";");		
					
					
					
					
					
				</script-->
						
			</div>
			
			
			
		</div>
		
		<div id="rightColumn">
				 <h>
				 	
				 </h>
		</div>
		
		<ul id="footer">
			<div id="options">
				<ul id="opt">
					<li id="addPL">
						<img src="images/addPL.png" alt="some_text" />
					</li>
					<li id="shuffle" >
						<img onclick="setShuffle(this)" src="images/shuffle50.png" alt="some_text" />
					</li>
					<li id="loop">
						<img onclick="setLoop(this)" src="images/loop50.png" alt="some_text" />
					</li>
				</ul>
			</div>
			
		</ul>
	</body>
</html>