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
	

function getGallery($dir,$display="all"){
	$gallery = getAllPictures($dir);
	$code="<div id='aGallery'>";
	foreach($gallery as $picture){ 
		$meta = simplexml_load_file("$dir/gallery.xml");
		if($res= $meta->xpath("picture[name='$picture']")){
			$res = $res[0]->title." crée par ".$res[0]->author;
		}
		else $res = "";
		$code .=  "<div class='vignette'>
					<a href='display.php?f=$picture' title='$res' >
						<img src='thumb.php?f=$dir/$picture&amp;s=200'  alt='a monster' title='$res' />
					</a>
				</div>";
	}
	$code .= "</div>";
	return $code;
}
	
	
	

		

?>

