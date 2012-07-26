


var input1;
var input2;
var input3;
var input4;
var input5;	

	
window.onload = initialize;

function initialize(){
	
	var username1 = document.getElementById("signInput");
	var passwd = document.getElementById("password");
	var usernameNew = document.getElementById("signUpput");
	var passwdNew = document.getElementById("passwdNew");
	var passwdNewConf = document.getElementById("passwdNewConfirm");
	
	
	input1 = false;
	input2 = false;
	input3 = false;
	input4 = false;
	input5 = false;
		
	username1.setAttribute("value", "email");
	passwd.setAttribute("value", "password");
	usernameNew.setAttribute("value", "email");
	passwdNew.setAttribute("value", "password");
	passwdNewConf.setAttribute("value","confirm password");
	
	username1.onclick = changeUsername1;
	passwd.onclick = changePassword;
	usernameNew.onclick = changeUsernameNew;
	passwdNew.onclick = changePasswdNew;
	passwdNewConf.onclick = changePasswdNewConf;
    
    username1.onkeydown = changeUsername1;
	passwd.onkeydown = changePassword;
	usernameNew.onkeydown = changeUsernameNew;
	passwdNew.onkeydown = changePasswdNew;
	passwdNewConf.onkeydown = changePasswdNewConf;
    
	/*
	username1.onkeypress = inputSet(1);
	passwd.onkeypress = inputSet(2);
	usernameNew.onkeypress  =inputSet(3);
	passwdNew.onkeypress = inputSet(4);
	passwdNewConf.onkeypress = inputSet(5);*/
	
}

function inputSet(index){
	console.log("triggered");
	if(index == 1){
		input1 = true;
	}	
	else if(index == 2){
		input2 = true;
	}
	else if(index == 3){
		input3 = true;
	}
	else if (index == 4){
		input4 = true;
	}
	else{
		input5 = true;
	}
}

function changeUsername1(){
	
	try{
		var username1 = document.getElementById("signInput");
		username1.setAttribute("value", "");
		username1.setAttribute("id", "signInputSelected");
		//resetFields(1);
	}catch(err){
	
	}
	
	
}

function changePassword(){
	
	try{
		var passwd = document.getElementById("password");
		passwd.setAttribute("value", "");
		passwd.setAttribute("type", "password");
		passwd.setAttribute("id", "passwordSelected");
		//resetFields(2);
	}catch(err){}
	
}

function changeUsernameNew(){
	try{
	var usernameNew = document.getElementById("signUpput");
	usernameNew.setAttribute("value", "");
	usernameNew.setAttribute("id", "signUpputSelected");
	//resetFields(3);
	}catch(err){}
	
}

function changePasswdNew(){
	try{
	var passwdNew = document.getElementById("passwdNew");
	passwdNew.setAttribute("value","");
	passwdNew.setAttribute("type", "password");
	passwdNew.setAttribute("id", "passwdNewSelected");
	//resetFields(4);
	}catch(err){}
}

function changePasswdNewConf(){
	try{
	var passwdNewConf = document.getElementById("passwdNewConfirm");
	passwdNewConf.setAttribute("value", "");
	passwdNewConf.setAttribute("type", "password");
	passwdNewConf.setAttribute("id", "passwdNewConfirmSelected");
	//resetFields(5);
	}catch(err){}
}



function resetFields(calling){
	
	var username1 = document.getElementById("signInputSelected");
	var passwd = document.getElementById("passwordSelected");
	var usernameNew = document.getElementById("signUpputSelected");
	var passwdNew = document.getElementById("passwdNewSelected");
	var passwdNewConf = document.getElementById("passwdNewConfirmSelected");
	
	
	
	if(username1 != null && calling != 1 && input1 != true){
		console.log(username1.getAttribute("value"));
		username1.setAttribute("id", "signInput");
		username1.setAttribute("value", "email");	
	}
	
	if(passwd != null && calling != 2 && passwd.getAttribute("value") == "" && input2 != true){
		passwd.setAttribute("type", "text");
		passwd.setAttribute("value", "password");
		passwd.setAttribute("id", "password");
	}
	
	if(usernameNew != null && calling !=3 && usernameNew.getAttribute("value") == "" && input3 != true){
		usernameNew.setAttribute("value", "email");
		usernameNew.setAttribute("id", "signUpput");
	}
	
	if(passwdNew != null && calling != 4 && input4 != true){
		passwdNew.setAttribute("type","text");
		passwdNew.setAttribute("id", "passwdNew");
		passwdNew.setAttribute("value", "password");
	}
	
	if(passwdNewConf != null && calling != 5 && input5 != true){
		passwdNewConf.setAttribute("type","text");
		passwdNewConf.setAttribute("id", "passwdNewConfirm");
		passwdNewConf.setAttribute("value", "confirm password");
	}
	
}


