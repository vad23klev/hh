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

/*switch($_GET["type"]){
	case "banner": $prefix="../img/banners/"; break;
	case "catalog": $prefix="../img/catalog/"; break;
	case "gallery": $prefix="../img/gallery/"; break;
	case "news": $prefix="../img/news/"; break;
	case "nfrag": $prefix="../img/news2/"; break;
	case "photo": $prefix="../img/photos/"; break;
	case "icon": $prefix="../img/icons/"; break;
	case "tom": $prefix="../img/toms/"; break;
}*/
if (!isset($_GET["type"])) {
$prefix = $_SERVER['DOCUMENT_ROOT']."/img/";
} else {$prefix = $_SERVER['DOCUMENT_ROOT']."/img/";}
$filename=$prefix.$_GET['type']."/".$_GET["image"];

$isize = getimagesize($filename);

	$width = $_GET['width']; 
	$height = $_GET['height'];
	
	if (isset($_GET['small'])) {
		$width=120;
		$height=120;
	}
	
	
	$baza = "";
	$lupa = "";
	$width2 = $width; 
	$height2 = $height;


	if ($isize[0]>=$isize[1]){

	
	if ($isize[0]>$width) {
		$otn = $height/$isize[1];
		$width2 = $isize[0]*$otn;
		$new_height = $height;
		$st = intval(($width - $width2)/2);		
		$disp = ($height-$new_height)/2;	
	} else {		
		$otn        = $width/$isize[0];
		$new_height = $isize[1] * $otn;
		$st = 0;		
		$disp = ($height-$new_height)/2;		
	}
	//print $new_height; die();
	
	//header('Content-type: image/jpeg');
	//$thumb = imagecreatetruecolor($width, $width);
//	$color = imagecolorallocate ($thumb, 255, 240, 215);
//	imagefill($thumb,0,0,$color);
		
	if ($isize[2]==1) $source = imagecreatefromgif($filename);
	if ($isize[2]==2) $source = imagecreatefromjpeg($filename);
	if ($isize[2]==3) $source = imagecreatefrompng($filename);

	
	
	//imagecopyresampled($thumb, $source, 0, 0, 0, 0, $width, $new_height, $isize[0], $isize[1]);
	
	
		
//        $dest = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT']."/img/".$baza);
		$dest = imagecreatetruecolor($width, $height);
		$color = imagecolorallocate ($dest,255,255, 255);

		imagefill($dest,0,0,$color);
		imagecopyresampled($dest, $source, $st, $disp, 0, 0, $width2, $new_height, $isize[0], $isize[1]);
        
		if (!isset($_GET['small'])) {
			sharpen($dest,15);
		}
	}
	else
	{
		if ($isize[1]>$height) {
			$st = 2;
			$new_width = $isize[0];
			$height2 = $isize[1];
			
		} else {
			$otn        = $height/$isize[1];
			$new_width  = $isize[0] * $otn;
			$st = 0;
			
			//$st = intval(($height - $height2)/2);		
		}



        if ($isize[2]==1) $source = imagecreatefromgif($filename);
        if ($isize[2]==2) $source = imagecreatefromjpeg($filename);
        if ($isize[2]==3) $source = imagecreatefrompng($filename);

	//imagecopyresampled($thumb, $source, 0, 0, 0, 0, $new_width, $width, $isize[0], $isize[1]);
	//sharpen($thumb,25);
	
	$st = intval(($width - $new_width)/2);
//	$dest = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT']."/img/".$baza);
	$dest = imagecreatetruecolor($width, $height);
	$color = imagecolorallocate ($dest, 255, 255, 255);
	//$color = imagecolorallocate ($dest, 0, 255, 0);
	imagefill($dest,0,0,$color);
	
	$disp = ($width-$new_width)/2;
	
	imagecopyresampled($dest, $source, $disp, 0, 0, 0, $new_width, $height2, $isize[0], $isize[1]);	
//	if (!isset($_GET['small'])) {
//		sharpen($dest,15);
//	}

}

//var_dump($dest);
header('Content-type: image/png');
imagepng($dest);
imagedestroy($dest);

?>
