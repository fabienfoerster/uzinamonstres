<?php require_once("adminlib.php"); ?>
<?php 

	if(!empty($_POST['delete_list']) and $_POST['delete_list'] != "undefined"){
		$delete_list = explode(";",$_POST['delete_list']);
		$xml = simplexml_load_file("../resources/resources.xml");
		
		foreach($delete_list as $fichier){
			unlink($fichier);
			$nom_fichier = explode("/",$fichier);
			$nom_fichier = $nom_fichier[2];
			if($picture = $xml->xpath("part[@src='".$nom_fichier."']")){
				$picture=$picture[0];
				$dom  = dom_import_simplexml($picture);
				$dom->parentNode->removeChild($dom);
				
			}
		}
		$xml->asXml("../resources/resources.xml");
	}
	if(!empty($_POST['viderCache'])){
		$cache = getAllPictures("../cache");
		foreach($cache as $fichier){
			unlink("../cache/".$fichier);
		}
	}
	
?>
	
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head> 
		<title>Uzinamonstres - Assemblez un monstre à votre image</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<script type="text/javascript" src="adminlib.js"></script>
	</head>
	<body>
		<h1>Panel d'administration</h1><a href="..">Retour au site</a>
		
		<h2>Gérer les parties de monstres</h2>
		<?php echo getGallery("../resources");?>
		
		<h2>Gérer la galerie de monstres</h2>
		<?php echo getGallery("../gallery");?>
		
		<form action="#" method="post" onsubmit="return getDeleteList()" onreset="return cleanDeleteList()">
			<label for="viderCache" id="label_viderCache">Vider le cache : </label><input type="checkbox" name="viderCache" id="viderCache" /><br/>
			<input type="hidden" name="delete_list" value="" id="delete_list" />
			<input type="submit" value="Supprimer" />
		</form>
		
	</body>
</html>


