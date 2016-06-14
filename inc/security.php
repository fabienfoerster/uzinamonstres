<?php
	session_start();
	$SECURITY_ERROR=array('bad-login'=>'Bad login information !','unauthorized'=>'You must log in to see this page !','tasoeur'=>"C'est pas gentil de parler de la famille ...");
	
	
	
	function check($login, $password){
		$password = md5($password);
		$arbreXML= simplexml_load_file("users.xml");
		if($res=$arbreXML->xpath("user[login='$login' and password='$password']")){
			return array("nom"=>(String)$res[0]->nom,"prenom"=>(String)$res[0]->prenom,"login"=>(String)$res[0]->login);
		}
		return false;
	}
	function performLogin($login,$password){
		if($info=check($login,$password)){
			$_SESSION['nom']=$info['nom'];
			$_SESSION['prenom']=$info['prenom'];
			$_SESSION['login']=$info['login'];
			$_SESSION['estula']=true;
			return true;
		}
		else{
			return false;
			
		}
	}
	
	function loginForm(){
		global $SECURITY_ERROR ;
		$error=array_key_exists("error",$_GET)&&array_key_exists($_GET['error'],$SECURITY_ERROR)?$SECURITY_ERROR[$_GET['error']]:" ";
		echo '
		<div class="form">
			<form action="#" method="post">
			  <p>
				<a href="inscription.php">Inscription</a>
				ou Connexion :
				<input type="hidden" name="to_do" value="login" />
				<input type="text" name="log" id="log" />
				<input type="password" name="pass" id="pass" />
			  <input type="submit" value="Connexion" />
			  </p>
			</form>
			<p class="erreur">'.$error.'</p>
		</div>
		';
	}
	
	function logoutForm(){
		echo '
		
		<div class="form">
			<form action="#" method="post">
				<p>
					Bienvenue '.htmlspecialchars(stripslashes($_SESSION['login'])).'
					<input type="hidden" name="to_do" value="logout" />
					<input type="submit" value="Deconnexion"/>
				</p>
			</form>
		</div>
		';
	}
	
	
	function performLogout(){
		session_destroy();
		unset($_SESSION['estula']);
	}
	
	function isConnected(){
		return (isset($_SESSION['estula'])and $_SESSION['estula'])?true:false;
	}
	
	function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
{
   //Test1: fichier correctement uploadé
     if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return false;
   //Test2: taille limite
     if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return false;
   //Test3: extension
     $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
     if ($extensions !== FALSE AND !in_array($ext,$extensions)) return false;
   //Déplacement
     if(move_uploaded_file($_FILES[$index]['tmp_name'],$destination)) return true;
}
	
	
?>
