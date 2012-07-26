<?php
	session_start();
	
	
	//check to see if the user has attempted to log in	
	if(isset($_POST['username'])){
		
		$username = $_POST['username'];
		
		//Establish connection to the database
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
		
		
		$mypdo = new PDO("mysql:host=localhost;dbname=youTunes","root","root");
		
		
		//check to see the user is a new user
		if(isset($_POST['passwordconf'])){
			$sql=mysql_query("select * from Users where username = $username");
			
			$count = $sql->count();
			//if the email address already has an account
			if($count > 0){
				$_SESSION['loginError'] = 0;
			}
			else {
				$activated = "false";
				//$sql=mysql_query("INSERT INTO Users VALUES $username, $_POST['password'], $activated");
			}
		}
		else{
    				
		}
		
	}

	if(isset($_SESSION['username'])){
		include 'console.php';
	}
	else{
		include 'login.php';
	}
	
?>