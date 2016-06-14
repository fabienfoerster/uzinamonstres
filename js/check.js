

function checkPassword(theForm) {
	var pass = document.getElementById('password');
	var repass = document.getElementById("repassword");
	
	document.getElementById("alert_password").style.color="black";
	document.getElementById("alert_repassword").innerHTML="";
	document.getElementById("alert_repassword").style.color="black";
	
	if(pass.value.length < 6 ){
		document.getElementById("alert_password").style.color="red";
		return false;
	}
	else if(pass.value != repass.value){
		document.getElementById("alert_repassword").style.color="red";
		document.getElementById("alert_repassword").innerHTML="Les deux mots de pass doivent être identiques.";
		
		return false;
	}
	return true
}

function checkLogin(theForm) {
	document.getElementById('alert_login').style.color="black";
	document.getElementById("alert_login").innerHTML="Le login doit faire au moins 4 caractères.";
	
	var login = document.getElementById('login').value;
	
	var pattern = new RegExp("[A-Za-z]{4,}","g");
	
	var xmlDoc = loadXMLDoc("users.xml");
	
	var path = "/users/user[login='"+login+"']/login";
	var nodes = xmlDoc.evaluate(path,xmlDoc, null, XPathResult.ANY_TYPE,null);
	var result=nodes.iterateNext();
	
	if(!pattern.test(login))
	{
		document.getElementById('alert_login').style.color="red";
		return false;
	}
	
	else if(result){
		
		document.getElementById("alert_login").innerHTML="Le login est déja utilisé.";
		document.getElementById("alert_login").style.color="red";
		return false;
	}
	
	return true;
}



function isValid(theForm) {
	var check = checkLogin(theForm);
	return checkPassword(theForm) && check;
	
}

function areUSure(theForm) {
	return confirm("Are you sure ?");
}

