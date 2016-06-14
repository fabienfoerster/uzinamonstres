<?php
session_start();

$dataURL = (isset($_POST["dataURL"])) ? $_POST["dataURL"] : NULL;
$name = (isset($_POST["name"])) ? $_POST["name"] : NULL;

if ($dataURL & $name) {
	$imagename=md5(uniqid(rand(), true)).".png";
	$parts = explode(',', $dataURL);  
	$data = $parts[1];
	$data = str_replace(' ','+',$data);
	
	$data = base64_decode($data);
	if (!file_put_contents("../gallery/".$imagename,$data)) {
		echo "Impossible de sauvegarder l'image";
	}
	
	
	$gallery = simplexml_load_file("../gallery/gallery.xml");
	$picture=$gallery->addChild('picture');
	$picture->addChild("name",$imagename);
	$picture->addChild("title",$name);
	$picture->addChild("author",$_SESSION['login']);
	if ($gallery->asXML("../gallery/gallery.xml")) {
		echo "Votre monstre a bien été sauvegardé";
	} else {
		echo "Impossible de mettre à jour la base de données";
	}
} else {
	echo "Veuillez spécifier un nom";
}


