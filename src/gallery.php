<?php 

	require_once("static/header.php");
	require_once("inc/webgal.php");
	

	
	echo '
	<h1>Bienvenue dans notre galerie des monstres</h1>
	';
	

	if(array_key_exists("display",$_GET) and (display=="all" or display=="recent" or display=="best")){
		echo(getGallery("gallery",$_GET['display']));
	}
	else{
		echo(getGallery("gallery"));
	}
	
	
	require_once("static/footer.html");
	
	
	
?>
