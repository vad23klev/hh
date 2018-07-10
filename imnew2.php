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

if (isset($_GET['big'])) {
	$width = 217;
	$height = 217;
	$baza = "";
	$lupa = "";
}elseif (isset($_GET['small'])){
	$width = 95; 
	$height = 95; 
	$baza = "";
	$lupa = "";
} else {
	$width = 160; 
	$height = 160;
	$baza = "";
	$lupa = "";
}


	if ($isize[0]>$isize[1]){

	$otn        = $width/$isize[1];
    $new_width  = $isize[0] * $otn;
	$new_height  = $isize[1] * $otn;


	
	//header('Content-type: image/jpeg');
	//$thumb = imagecreatetruecolor($width, $width);
//	$color = imagecolorallocate ($thumb, 255, 240, 215);
//	imagefill($thumb,0,0,$color);
		
	if ($isize[2]==1) $source = imagecreatefromgif($filename);
	if ($isize[2]==2) $source = imagecreatefromjpeg($filename);
	if ($isize[2]==3) $source = imagecreatefrompng($filename);

	
	
	//imagecopyresampled($thumb, $source, 0, 0, 0, 0, $width, $new_height, $isize[0], $isize[1]);
	
	    /*$overimg = @imagecreatefrompng('./pics/flogo.png');
        $w_over = imagesx($overimg);
        $h_over = imagesy($overimg);
	
		$left = ($width - $w_over)/2 - 40;
		$top = (($new_height - $h_over)/2) - 30;*/
		
		$left = $new_width-$width;

//        $dest = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT']."/img/".$baza);
		$dest = imagecreatetruecolor($width, $height);
		$color = imagecolorallocate ($dest, 255, 255, 255);
		imagefill($dest,0,0,$color);
		
		imagecopyresampled($dest, $source, 0, 0, $left, 0, $new_width, $new_height, $isize[0], $isize[1]);

//		imagecopy($dest,$overimg,$left,$top,0,0,300,64);
        
		//sharpen($dest,15);
	}
	else
	{
        $otn        = $width/$isize[0];
        $new_width  = $isize[0] * $otn;
		$new_height  = $isize[1] * $otn;



        if ($isize[2]==1) $source = imagecreatefromgif($filename);
        if ($isize[2]==2) $source = imagecreatefromjpeg($filename);
        if ($isize[2]==3) $source = imagecreatefrompng($filename);

		
	$top = $new_height-$height;
	//imagecopyresampled($thumb, $source, 0, 0, 0, 0, $new_width, $width, $isize[0], $isize[1]);
	//sharpen($thumb,25);
	
	$st = intval(($width - $new_width)/2);
//	$dest = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT']."/img/".$baza);
	$dest = imagecreatetruecolor($width, $height);
	$color = imagecolorallocate ($dest, 255, 255, 255);
	imagefill($dest,0,0,$color);
	
	imagecopyresampled($dest, $source, 0, 0, 0, $top, $new_width, $new_height, $isize[0], $isize[1]);	
	sharpen($dest,15);

}

//var_dump($dest);
header('Content-type: image/jpeg');
imagejpeg($dest,'',100);

?>