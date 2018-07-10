<?php												
function sharpen($img,$amount)
{
		// Make sure that the sharpening function is available
	if ( ! function_exists('imageconvolution')) {return false;}
		

		// Amount should be in the range of 18-10
	$amount = round(abs(-18 + ($amount * 0.08)), 2);

		// Gaussian blur matrix
	$matrix = array
	(
		array(-1,   -1,    -1),
		array(-1, $amount, -1),
		array(-1,   -1,    -1),
	);

		// Perform the sharpen
	return imageconvolution($img, $matrix, $amount - 8, 0);
} 

error_reporting(E_ALL);

switch($_GET["type"]){
	case "catalog": $prefix="../img/catalog/"; break;
	case "gallery": $prefix="../img/gallery/"; break;
	case "news": $prefix="../img/news/"; break;
	case "nfrag": $prefix="../img/news2/"; break;
	case "photo": $prefix="../img/photos/"; break;
	case "icon": $prefix="../img/icons/"; break;
	case "tom": $prefix="../img/toms/"; break;
}
$filename=$prefix.$_GET["image"];

$isize = getimagesize($filename);

if (isset($_GET['big'])) {
	$width = 180;
	$baza = "pback2.jpg";
	$lupa = "lupa.png";
	$dsp = 10;
	$vdsp = 10;
} elseif (isset($_GET['large'])) {
	$width = 800; 
	$baza = "pback3.jpg";
	$lupa = "";
	$dsp = 10;
	$vdsp = 20;
}else {
	$width = 150; 
	$baza = "pback.jpg";
	$lupa = "";
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
		
	imagecopyresampled($dest, $source, $st, 0, 0, 0, $new_width, $width, $isize[0], $isize[1]);	
	
	//imagecopy($dest, $thumb, $st, $vdsp, 0, 0, $new_width, $width);
	}

	
//sharpen($dest,15);
	if ($isize[2]==1) {
		header('Content-type: image/gif');
		imagegif($dest);	
	}
	if ($isize[2]==2) {
		header('Content-type: image/jpeg');
		imagejpeg($dest,'',100);	
	}
	if ($isize[2]==3) {
		header('Content-type: image/png');
		
		
		$background_color = imagecolorallocate($dest, 0, 0, 0);
		imagecolortransparent($dest, $background_color);
		
		imagepng($dest);	
	}




?>