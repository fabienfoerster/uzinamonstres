<?php

require_once("static/header.php");

//Traitement de l'ajout de commentaire
if(!empty($_POST['com'])){
	$xml = simplexml_load_file("gallery/gallery.xml");
	$picture = $xml->xpath("picture[name='".$_POST['picture']."']");
	$picture = $picture[0];
	$commentaire = $picture->addChild("commentaire");
	$commentaire->addChild("author",$_SESSION['login']);
	$commentaire->addChild("text",$_POST['com']);
	$xml->asXML("gallery/gallery.xml");
}
	
	


	echo "<div id='displayer'>";
	if(isset($_GET['f']) and !empty($_GET['f']) and !file_exists($_GET['f'])){
		echo "<img src='gallery/".$_GET['f']."' alt='a picture' />";
	}
	else{
		echo 'Erreur aucune image spécifiée/trouvée';
	}
	
	$resources = simplexml_load_file("gallery/gallery.xml");
	$res= $resources->xpath("picture[name='".$_GET['f']."']");
	$res = $res[0];
	$meta = htmlspecialchars(stripslashes($res->title." crée par ".$res->author));
	echo "<p class='meta'>$meta</p>";
	
	echo "<h2 id='ancor'>Commentaires</h2>";
	foreach($res->commentaire as $com){
		echo"<p class='auteur'>".htmlspecialchars(stripslashes($com->author))." a écrit : </p><p class='commentaire'>".htmlspecialchars(stripslashes($com->text)). "</p>";
	}
	
	if(isConnected()){
		echo "
		<h2>Ajouter un commentaire</h2>
		<fieldset>
			<legend>Commentaire</legend>
			<form action='#' method='post'>
				<label for='com'>Commentaire</label><br/>
				<textarea id='com' name='com' rows='5' cols='50'></textarea><br/>
				<input type='hidden' name='picture' value='".$_GET['f']."' />
				<input type='submit' value='Envoyer' />
			</form>
		</fieldset>
		";
	}
	
	
	
	
	
	
	
	echo"</div>";
	require_once("static/footer.html");
	
?>
