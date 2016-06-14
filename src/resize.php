<?php
    $filename = (array_key_exists("f", $_GET) ? $_GET["f"] : null);
    $width = (array_key_exists("w",$_GET) ? $_GET["w"] : null);
    if (null == $filename)
        die("You should gimme a file name as 'f' url parameter!");
        
    if (null == $width)
        die("You should gimme a file name as 'w' url parameter!");
        
    $name='cache/'.basename($filename,".png").'_'.$width.'.png';
    if(file_exists($name)){
		$dest=imagecreatefrompng($name);
	}
	else{
	list($width_orig, $height_orig) = getimagesize($filename);
	$ratio = $width_orig/$height_orig;
	$height = $width/$ratio;
	
	$dest = imagecreatetruecolor($width, $height);
	imagealphablending($dest,false);
	imagesavealpha($dest,true);
	$source = imagecreatefrompng($filename);
	imagecopyresampled($dest, $source, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	 imagepng($dest,$name);
	}
	
    
    header('Content-type: image/png');
    imagepng($dest);
?>

