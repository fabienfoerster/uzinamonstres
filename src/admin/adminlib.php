<?php


function getAllFiles($dir,$available_extension){
	$library=array();
	if ($handle = opendir($dir)) {
		while (false != ($entry = readdir($handle))) {
			$turc = explode(".",$entry);
			if (in_array($turc[count($turc)-1],$available_extension)) {
				$library[]=$entry;
			}
		}
	closedir($handle);
	}
	return $library;
}
	
function getAllPictures($dir){
		$available_extension=array("png","jpg","jpeg","gif");
		return getAllFiles($dir,$available_extension);
	}
	

function getGallery($dir){
	$gallery = getAllPictures($dir);
	$code="<div class='aGallery'>";
	foreach($gallery as $picture){ 
		$code .=  "<div class='vignette'>
						<img src='thumb.php?f=$dir/$picture&amp;s=100'  alt='a monster' onclick='addToDelete(this)' />
				</div>";
	}
	$code .= "</div>";
	return $code;
}
?>
