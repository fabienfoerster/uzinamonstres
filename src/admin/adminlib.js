var list = new Array();

function addToDelete(image){
	if(image.className == "selected"){
		image.style.border="5px solid #36393D";
		image.className="";
		arrayUnset(list,extractUrlParams(image.src,"f"));
	}
	else {
		image.style.border="5px solid #B02B2C";
		image.className="selected";
		list.push(extractUrlParams(image.src,"f"));
	}
}


function getDeleteList(){
	var tmp =list[0];
	for(var i = 1 , l = list.length ; i<l;i++){
		tmp+=";"+list[i];
	}
	document.getElementById("delete_list").value=tmp;
	return true;
}

function cleanDeleteList(){
	list = new Array();
	return true;
}



function arrayUnset(array, value){
    array.splice(array.indexOf(value), 1);
}

function extractUrlParams(url,param){	
	var t = url.split('?')[1].split('&');
	var f = [];
	for (var i=0; i<t.length; i++){
		var x = t[ i ].split('=');
		if(x[0]==param){
			return x[1];
		}
	}
	return false;
}
