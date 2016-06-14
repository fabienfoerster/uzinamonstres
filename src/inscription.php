<?php

	require_once("static/connexion.php");
	require_once("inc/security.php");
	if(isConnected()){
		header('Location:index.php?error=weird');
	}


if(array_key_exists("login",$_POST)){
	$users = simplexml_load_file("users.xml");
	
	$user=$users->addChild('user');
	$user->addChild('login',$_POST['login']);
	$user->addChild('password',md5($_POST['password']));
	$users->asXML("users.xml");
	
	performLogin($_POST['login'],$_POST['password']);
	
	header('Location: index.php');
}
?>
<?php require_once("static/header.php"); ?>

<div id="inscription_form">
	<h1>Allez viens t'inscrire !</h1>
	<fieldset>
		<legend>Inscription</legend>
		<form action="#" method="post" onsubmit="return isValid(this);" onreset="return areUSure(this);">
			<ul>
				<li>
					<label for="login" >Login</label>
					<input type="text" name="login" id="login" />
					<span id="alert_login">Le login doit faire au moins 4 caractères.</span>
				</li>
				<li>
					<label for="password">Password</label>
					<input type="password" name="password" id="password" />
					<span id="alert_password">Le password doit faire plus de 6 caractères.</span>
				</li>
				<li>
					<label for="repassword">Re-Password</label>
					<input type="password" name="repassword" id="repassword" />
					<span id="alert_repassword"></span>
				</li>
			</ul>
			<p>
				<input type="submit" value="Valider" />
				<input type="reset" value="Effacer" />
			</p>
		</form>
	</fieldset>
</div>			
		

<?php require_once("static/footer.html"); ?>
