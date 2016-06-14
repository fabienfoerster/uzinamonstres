<?php
require_once("inc/security.php"); 

		if(isset($_POST['to_do'])){
			if($_POST['to_do'] == "logout"){
				performLogout();
			}
			else{
				if(!empty($_POST['log']) and !empty($_POST['pass']) and performLogin($_POST['log'],$_POST['pass'])){
					}
				else {
					$_GET['error']="bad-login";
				}	
			}
		}
?>
