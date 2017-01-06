<?php
	


require_once("static/header.php"); 
echo '<script type="text/javascript" charset="utf-8" src="js/atelier.js"></script>';

echo "
<div id='atelier'>
<div id='buttons'>
	<p>Nom du monstre :<input type='text' id='monster_name'/></p>
	<button id='toTop'>
		Mettre au premier plan
	</button>
	<button id='toBottom'>
		Mettre au second plan
	</button>
	<button id='rotateplus'>
		Rotation +
	</button>
	<button id='rotateminus'>
		Rotation -
	</button>
	<button id='sizeplus'>
		Taille +
	</button>
	<button id='sizeminus'>
		Taille -
	</button>
	<button id='erase'>
		Effacer
	</button>
	<button id='save'>
		Enregistrer
	</button>
	
	
</div>
<div id='container'>
</div>
<div id='inventaire'>
	<div>
		<select onchange='getAllParts(this.options[this.selectedIndex].value)'>
			<option value='head'>Tête</option>
			<option value='body'>Corps</option>
			<option value='left_arm'>Bras Gauche</option>
			<option value='right_arm'>Bras Droit</option>
			<option value='left_leg'>Jambe Gauche</option>
			<option value='right_leg'>Jambe Droite</option>
			<option value='appurtenance'>Accesoire</option>
		</select>
	</div>
	<div id='drop_part'>
	<script type='text/javascript'>getAllParts('head');</script>	
	</div>
</div>
</div>";



require_once("static/footer.html"); 


?>
