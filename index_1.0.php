

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" type="text/css" href="youTunesStyle.css" title="Twitter User Lookup Styles"/>
		<script src="http://www.google.com/jsapi" type="text/javascript"></script>
		<script type="text/javascript">
    	  google.load("swfobject", "2.1");
   		 </script>    
    	<script type="text/javascript">
      
      var paused=false;
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
      			sender.src = "pause.png";
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
      function _run() {
        loadPlayer();
      }
      google.setOnLoadCallback(_run);
    </script>
		<!--script type="text/javascript" src="swfobject.js"></script>
		<script src="//www.google.com/jsapi"></script>
		<script src="js/as3_demo_functions.js" type="text/javascript"></script-->
	</head>

	<body>
		
		<div id="header">
			<div id="logo">
				<img src="youTunesLarge.png" alt="some_text"/>
			</div>
			<div id="center">
				
				
				<div id="videoDiv"></div>
				
				<div id="progress">
					<div id="songInfo">
					<h4 id="titlePane">
						Title of the Song
					</h4>
					<h4 id="artistPane">
						The Artist
					</h4>
					</div>
					<div id="progressBar">
						<div id="loaded">
						</div>
						<div id="completed">
						</div>
						
						
						
					</div>	
				</div>
				<!--script type="text/javascript" src="swfobject.js"></script>    
  					<div id="ytapiplayer">
   						 You need Flash player 8+ and JavaScript enabled to view this video.
 					</div>

  				<script type="text/javascript">

    					var params = { allowScriptAccess: "always" };
    					var atts = { id: "myytplayer" };
    					swfobject.embedSWF("http://www.youtube.com/v/VIDEO_ID?enablejsapi=1&playerapiid=ytplayer&version=3",
                       "ytapiplayer", "560", "245", "8", null, null, params, atts);
				
  				</script>
  				
  				<script type="text/javascript">
  				function onYouTubePlayerReady(playerId) {
    			  ytplayer = document.getElementById("myytplayer");
   				 }
   				 </script-->
  				
  				<!--iframe id="ytplayer" type="text/html" width="560" height="250" src="http://www.youtube.com/embed/Zhawgd0REhA" frameborder="0" allowfullscreen-->
  				
  				<!--iframe width="560" height="245" src="http://www.youtube.com/embed/VIDEO_ID?enablejsapi=1" frameborder="0" allowfullscreen></iframe>
				<!--iframe width="560" height="35" src="http://www.youtube.com/v/IoBP24I2lwA?version=3&enablejsapi=1&autoplay=1" frameborder="0" allowfullscreen></iframe>
				<!--iframe width="560" height="25" src="http://www.youtube.com/embed/Vysgv7qVYTo?autoplay=1" frameborder="0" allowfullscreen></iframe>
				<iframe width="560" height="40" src="http://www.youtube.com/embed/a_YR4dKArgo?autoplay=1" frameborder="0" allowfullscreen></iframe>
				<iframe width="560" height="25" src="http://www.youtube.com/embed/Vysgv7qVYTo?autoplay=1" frameborder="0" allowfullscreen></iframe-->
			</div>
			
			<div id="nav">
				<div id="back">
					<img src="back.png" alt="some_text" onclick="back()"/>
				</div>
				<div id="play" >
					<img src="play.png" onclick="pause(this)" alt="some_text" id="playButton"/>
				</div>
				<div id="forward">
					<img src="forward.png" alt="some_text" onclick="forward()"/>
				</div>
			</div>
			
		</div>
		
		<div id="cont">
			<div id="column">
			
				<table>
					<tr>
						<td id="lib">
							<p>
								Library
							</p>
			
						</td>
					</tr>
				</table>
			
			</div>
			
			<div id="library">
				<table>
					<tr>
						<td class="playing">
							
						</td>
						<td class="title">
							<p>
								Name
							</p>
						
						</td>
						<td class="time">
							<p>
								Time
							</p>
						
						</td>
						<td class="artist">
							<p>
								Artist
							</p>
						
						</td>
						<td class="genre">
							<p>
							Genre
							</p>
						
						</td>
						<td class="plays">
							<p>
								Plays
							</p>
						</td>
						<td class="remove">
							<p>
								Remove
							</p>
						</td>
					</tr>
					
				</table>	
				<table id="songsonsongs">	
					
					
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
       						
							$vID = $row['video'];
							
							$songs[$index] = $vID;
							
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
   					
   					function SelectSong(sender){
   						
   						
   						if(selected != -1){
   							var switchBack = document.getElementById(new String(selected));
   							var children = switchBack.childNodes;
   							for(var i=0; i<children.length; i++)
							{
  								//checks to make sure each child is a legitimate child with a classa
  								try{
  									var curClass = new String(children[i].getAttribute('class'));
  									var cut = curClass.indexOf("Sel");
  									if(cut == -1){
   										break;
  									}
  									var sliced = curClass.slice(0,cut);
  									children[i].setAttribute('class', sliced.concat("1"));
  								}//end try
  								catch(err){
  								
  								}//end catch
							}//end for
   						}
   						//makes a song blue when the user clicks on it. 
   						var children = sender.childNodes;
   						for(var i=0; i<children.length; i++)
						{
  							
  							try{
  								var curClass = new String(children[i].getAttribute('class'));
  								var cut = curClass.indexOf("1");
  								if(cut == -1){
   									break;
  								}
  								var sliced = curClass.slice(0,cut);
  								children[i].setAttribute('class', sliced.concat("Sel"));
  							}
  							catch(err){
  								
  							}
  							
  						
						}//end for
						
						selected = parseInt(sender.getAttribute('id'));
   					}//end SelectSong
   					
   					function updatePlayerInfo(){
   						
   						if(ytplayer && ytplayer.getDuration){
   							console.log(loaded);
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
   							
   						}
   						
   					}
   					
   					function onPlayerStateChange(newState){
   						if(newState == 0){
   							titlePane.innerHTML = '';
   							artistPane.innerHTML = '';
   						}
   						if(newState == 1){
   							
   							//PHP code to print the title and artsit of the song
   						}
   					}
   					//Plays the song selected (called on a double click)
   					function Play(sender)
   					{
   						
   						var vIndexString = sender.getAttribute("id");
   						console.log(vIndexString);
   						var vIndex = parseInt(vIndexString);
   						
   						
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
   						var toPlay = songArray.slice(vIndex, numSongs+1);
   						
   						setInterval(updatePlayerInfo, 250);
   						ytplayer.addEventListener("onStateChange", "onPlayerStateChange");
   						
   						if(ytplayer){
   							ytplayer.loadPlaylist(toPlay,0,0,"default");
   						}
   						
   						var play = document.getElementById("playButton");
   						play.src = "pause.png";
   						/*var ytplayer = document.getElementById("ytplayer");
   						ytplayer.loadPlaylist(toPlay,0,0,"default");*/
   					}
   					
   					
   				</script>
				
				<?php
					
				
					$sql=mysql_query("select * from Songs");
					$counter = 0;
					
					while($row=mysql_fetch_assoc($sql)){
							$title = $row['Title'];
							$time = $row['Time'];
							$artist = $row['Artist'];
							$plays = $row['Plays'];
							$genre = $row['Genre'];
							$sId = $row['sID'];
					//prints out information about the current song. 
							print("
							
							
							<tr class=\"songListing\" onclick=\"SelectSong(this)\" onDblClick=\"Play(this)\" id=\"$counter\">
								
								<td class=\"playing1\">
								
								</td>
								<td class=\"title1\">
									<p>
										$title
									</p>
						
								</td>
								<td class=\"time1\">
									<p>
										$time
									</p>
						
								</td>
								<td class=\"artist1\">
									<p>
										$artist
									</p>
						
								</td>
								<td class=\"genre1\">
									<p>
										$genre
									</p>
						
								</td>
								<td class=\"plays1\">
									<p>
										$plays
									</p>
								</td>
								<td class=\"remove1\">
									<p>
										Remove!
									</p>
								</td>
							</tr>
							</div>
							
							");
							$counter++;
					}
				
				?>
				<script type="text/javascript">
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
					
					
					
					
					
				</script>
				
				</table>			
			</div>
		</div>
	</body>
</html>