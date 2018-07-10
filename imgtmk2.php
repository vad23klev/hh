<?php

if (!isset($_GET["pic"]))
	{
		if (isset($_POST["pic"])) $pic = $_POST["pic"];
	}
	else $pic = $_GET["pic"]; 

if (!isset($_GET["folder"]))
	{
		if (isset($_POST["folder"])) $folder = $_POST["folder"];
	}
	else $folder = $_GET["folder"]; 

	
function LoadJpeg($imgname) 
{
	$isize = getimagesize($imgname);
	if ($isize[2]==1) $im = imagecreatefromgif($imgname);
	if ($isize[2]==2) $im = imagecreatefromjpeg($imgname);
	if ($isize[2]==3) $im = imagecreatefrompng($imgname);

    //$im = @imagecreatefromjpeg($imgname); /* Attempt to open */
        $w_src = imagesx($im);
        $h_src = imagesy($im);

    
    $overimg = @imagecreatefrompng('img/flogo.png');
        $w_over = imagesx($overimg);
        $h_over = imagesy($overimg);
    
    if (!$overimg){
        $im  = imagecreatetruecolor(238, 232); /* Create a black image */
        $bgc = imagecolorallocate($im, 255, 255, 255);
        $tc  = imagecolorallocate($im, 0, 0, 0);
        imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
        /* Output an errmsg */
        imagestring($im, 1, 5, 5, "Error loading flogo.png", $tc);
    }

    if (!$im) { /* See if it failed */
        $im  = imagecreatetruecolor(150, 30); /* Create a black image */
        $bgc = imagecolorallocate($im, 255, 255, 255);
        $tc  = imagecolorallocate($im, 0, 0, 0);
        imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
        /* Output an errmsg */
        imagestring($im, 1, 5, 5, "Error loading $imgname", $tc);
    } else {
        
        
    	$w = 495;
	
        if ($w_src > $w) 
        {
            if ($w_src > $h_src) {
                $ratio = $w_src/$w;
        } else {
			$ratio = $h_src/$w;
		}
	
            $w_dest = round($w_src/$ratio);
            $h_dest = round($h_src/$ratio);
        } else {
            $w_dest = $w_src;
            $h_dest = $h_src;
        }    
    

	if (!isset($nom)){
			$displace = -25;
		} else {
			$displace = 150;
		}
		
	$left = $w_dest-120;
	$top = $h_dest-30;

   	//$left = ($w_dest - $w_over);
	//$top = ($h_dest - $h_over);

    $dest = imagecreatetruecolor($w_dest,$h_dest);
	$color = imagecolorallocate ($dest, 255, 240, 215);
	imagefill($dest,0,0,$color);
	
	imagecopyresampled($dest,$im,0,0,0,0,$w_dest,$h_dest,$w_src,$h_src);        
	imagecopy($dest,$overimg,$left,$top,0,0,$w_over,$h_over);    
    }

    return $dest;
}

//http://www.sld.dsms.ru/files/good_big/6075_1303474841.jpg

$bigpic = "img/".$folder."/".$pic;

//echo "<img src='".$bigpic."'>";
$img = LoadJpeg($bigpic);

//imagecopyresized
Header("Content-type:image/jpeg");
imagejpeg($img,'',100);
imagedestroy($img);
//print "<img src='pics/flogo.png'>";
?>