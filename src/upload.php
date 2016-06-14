<?php	
	require_once("static/connexion.php");
	require_once("inc/security.php");
	if(!isConnected()){
		header('Location:index.php?error=unauthorized');
	}
	
	$blabla="";
	//Traitement de l'upload
	if(!empty($_POST['maxsize'])){
		if($res = upload('fichier','resources/'.$_FILES['fichier']['name'],$_POST['maxsize'],array('png')))
		{
			chmod("resources/".$_FILES['fichier']['name'],0777);
			$resources = simplexml_load_file("resources/resources.xml");
			$lastChild = $resources->xpath("part[last()]");
			$lastChild = $lastChild[0];
			$lastChildID = $lastChild==null?-1:$lastChild['id'];
			$part=$resources->addChild("part");
			$part->addAttribute("src",$_FILES['fichier']['name']);
			$part->addAttribute("categorie",$_POST['categorie']);
			$part->addAttribute("id",$lastChildID+1);
			$resources->asXML("resources/resources.xml");
		}
		if($res){
			$blabla = " Le transfert de votre membre a réussi";
		}
		else {
			$blabla = " Le transfert de votre membre a échoué :(";
		}
	}
	



require_once("static/header.php"); ?>

<h2>Formulaire d'upload</h2>
<fieldset>
	<legend>Uploader vos propres parties de monstres</legend>
	<form method="post" action="#" enctype="multipart/form-data">

		 <p>
			<input type="file" name="fichier" id="fichier" /> <span class="erreur_upload">  <?php echo $blabla; ?></span><br /><br />
			Note : pour un confort optimal, veuillez s'il vous plait à ce que l'image soit une image transparente et au format png .<br/><br />
			<label for="categorie">Choissiez la categorie</label>
			<select name="categorie" id="categorie">
				<option value="head">Tête</option>
				<option value="body">Corps</option>
				<option value="left_arm">Bras Gauche</option>
				<option value="right_arm">Bras Droit</option>
				<option value="left_leg">Jambe Gauche</option>
				<option value="right_leg">Jambe Droite</option>
				<option value="appurtenance">Accessoire</option>
			</select>
			<input type="hidden" name="maxsize" value="512000" />
		</p>
		 <input type="submit" name="submit" value="Envoyer" />
	</form>
</fieldset>








<?php	require_once("static/footer.html"); ?>
