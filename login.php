<?php
	session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" type="text/css" href="youTunesStyle.css" title="Twitter User Lookup Styles"/>
		<link rel="stylesheet" type="text/css" href="signInStyle.css" title="Twitter User Lookup Styles"/>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/signInForms.js"></script>
		
	</head>

	<body>
		
		<div id="header">
			
			<div id="top">
			<div id="nav">
				<ul id="navi">
				<li id="back">
					<img src="back.png" alt="back.png not found"/>
				</li>
				<li id="play" >
					<img src="play.png" alt="back.png not found" id="playButton"/>
				</li>
				<li id="forward">
					<img src="forward.png" alt="forward.png not found"/>
				</li>
				</ul>
			</div>
			
			
			<div id="center">
				
				
				<div id="spacer"></div>
				
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
			
			
			<div id="search">
				<input type="text" name="search" id="searc" size="30" />
			</div>
			
			</div>
		</div>
		
		
		<div id="content">
			<div id="left">
				<img src="images/logonew580.png" id="logo" alt="some_text">
			</div>
			
			<div id="topI">
				<form action="index.php" method="post">
				<ul>
					<li id="head">
							<p>
								Sign in! 
							</p>
						</li>
					<li>
						<input type="text" name="username" id="signInput" size="30" />
					</li>
					
					<li>
						
						<input type="text" name="passwd" id="password" size="30" />
						<button type="submit" id="submit">Sign in!</button>
					</li>
					
					
				</ul>
				</form>
			</div>
			<div id="bottom">
				
				<form action="index.php" method="post">
					
					<ul>
						<li id="head2">
							<p>
								New to youTunes? 
							</p>
						</li>
						<li>
							<input type="text" name="username" id="signUpput" size="30"/>
						</li>
						
						<li>
							<input type="text" name="passwd" id="passwdNew" size="30" />
						</li>
						
						<li>
							<input type="text" name="passwdconf" id="passwdNewConfirm" size="30" />
							<button type="submit" id="submit2">Sign up!</button>
						</li>
					</ul>
					
				</form>
			</div>
			<!--form action="albums.php" method="post">
				<input type="text" name="passwd" id="email" size="30" />
				<input type="text" name="passwd" id="password" size="30" />
				<button type="submit" id="submit">Sign in!</button>
			</form-->
		</div>
		
		
		
		<ul id="footer">
			<div id="options">
				<ul id="opt">
					<li id="addPL">
						<img src="images/addPL.png" alt="some_text" />
					</li>
					<li id="shuffle" >
						<img src="images/shuffle50.png" alt="some_text" />
					</li>
					<li id="loop">
						<img src="images/loop50.png" alt="some_text" />
					</li>
				</ul>
			</div>
			
		</ul>
	</body>