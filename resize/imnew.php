<?php												
error_reporting(E_ALL);

switch($_GET["type"]){
	case "catalog": $prefix="../img/catalog/"; break;
	case "gallery": $prefix="../img/gallery/"; break;
	case "news": $prefix="../img/news/"; break;
	case "nfrag": $prefix="../img/news2/"; break;
	case "photos": $prefix="../img/photos/"; break;
	case "icon": $prefix="../img/icons/"; break;
	case "tom": $prefix="../img/toms/"; break;
}
$filename=$prefix.$_GET["image"];

$isize = getimagesize($filename);

if (isset($_GET['big'])) {
	$width = 180;
	$dsp = 10;
	$vdsp = 10;
} else if (isset($_GET['small'])) {
	$width = 100;
	$dsp = 10;
	$vdsp = 10;
}
	$dsp = 0;
	$vdsp = 0;

	if ($isize[0]>$isize[1]){

	$otn        = $width/$isize[0];
	$new_height = $isize[1] * $otn;
	//print $new_height; die();
	
	//header('Content-type: image/jpeg');
		
	if ($isize[2]==1) {$source = imagecreatefromgif($filename);}
	if ($isize[2]==2) {$source = imagecreatefromjpeg($filename); }
	if ($isize[2]==3) {$source = imagecreatefrompng($filename);}

	
	

	$st = intval(($width - $new_height)/2)+$dsp;
    $dest = imagecreatetruecolor($width,$width);

    $thumb = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT']."/img/uzor.jpg");
    imagecopy($dest, $thumb, 0, 0, 0, 0, $width, $width);
	
		imagecopyresampled($dest, $source, 0, $st, 0, 0, $width, $new_height, $isize[0], $isize[1]);	
        //imagecopy($dest, $thumb, $vdsp, $st, 0, 0, $width, $new_height);
	}
	else
	{
        $otn        = $width/$isize[1];
        $new_width  = $isize[0] * $otn;
//		print $new_width; die();
//        header('Content-type: image/jpeg');

	if ($isize[2]==1) {$source = imagecreatefromgif($filename);}
	if ($isize[2]==2) {$source = imagecreatefromjpeg($filename); }
	if ($isize[2]==3) {$source = imagecreatefrompng($filename);}

	$st = intval(($width - $new_width)/2)+$dsp;
	$dest = imagecreatetruecolor($width,$width);
	
    $thumb = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT']."/img/uzor.jpg");
    imagecopy($dest, $thumb, 0, 0, 0, 0, $width, $width);



	
	imagecopyresampled($dest, $source, $st, 0, 0, 0, $new_width, $width, $isize[0], $isize[1]);	
	
	//imagecopy($dest, $thumb, $st, $vdsp, 0, 0, $new_width, $width);
	}


		header('Content-type: image/jpeg');
		imagejpeg($dest,'',100);	

	
//sharpen($dest,15);
/*	if ($isize[2]==1) {
		header('Content-type: image/gif');
		imagegif($dest);	
	}
	if ($isize[2]==2) {
	}
	if ($isize[2]==3) {
		header('Content-type: image/png');
		
		
		$background_color = imagecolorallocate($dest, 0, 0, 0);
		imagecolortransparent($dest, $background_color);
		
		imagepng($dest);	
	}*/




?>