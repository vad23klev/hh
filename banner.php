<?php
if (!isset($_GET["pic"]))
	{
		if (isset($_POST["pic"])) $pic = $_POST["pic"];
	}
	else $pic = $_GET["pic"]; 


	
function LoadJpeg($imgname) 
{
    $im = @imagecreatefromjpeg($imgname); /* Attempt to open */
        $w_src = imagesx($im);
        $h_src = imagesy($im);

    $overimg = @imagecreatefrompng('./img/paspartu.png');
        $w_over = imagesx($overimg);
        $h_over = imagesy($overimg);
    
    if (!$overimg){
        $im  = imagecreatetruecolor(300, 64); /* Create a black image */
        $bgc = imagecolorallocate($im, 255, 255, 255);
        $tc  = imagecolorallocate($im, 0, 0, 0);
        imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
        /* Output an errmsg */
        imagestring($im, 1, 5, 5, "Error loading paspartu.png", $tc);
    }

    if (!$im) { /* See if it failed */
        $im  = imagecreatetruecolor(150, 30); /* Create a black image */
        $bgc = imagecolorallocate($im, 255, 255, 255);
        $tc  = imagecolorallocate($im, 0, 0, 0);
        imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
        /* Output an errmsg */
        imagestring($im, 1, 5, 5, "Error loading $imgname", $tc);
    } else {

    $w = 730;

    if ($w_src > $w) 
    {
        if ($w_src > $h_src) {
            $ratio = $w_src/$w;
    } else {
        $ratio = $h_src/$w;
    }
        $ratio_over = $w_over/$w;
    
        $w_dest = round($w_src/$ratio);
        $h_dest = round($h_src/$ratio);
    
        $w_dest_over = round($w_over/$ratio_over);
        $h_dest_over = round($h_over/$ratio_over);

    
    } else {            
        $w_dest = $w_src;
        $h_dest = $h_src;
        $w_dest_over = $w_over;
        $h_dest_over = $h_over;
    }    


    $dest = imagecreatetruecolor($w_dest,$h_dest);
    imagecopyresampled($dest,$im,0,0,0,0,$w_dest,$h_dest,$w_src,$h_src);   
    imagecopyresampled($dest,$overimg,0,0,0,0,$w_dest_over,$h_dest_over,$w_over,$h_over);   
    
		

	//imagecopy($im,$overimg,0,0,0,0,600,227);    
    }

    return $dest;
}


$bigpic = "banners/".$pic;

//echo "<img src='../pics/flogo.png'>";
$img = LoadJpeg($bigpic);

//imagecopyresized
Header("Content-type:image/jpeg");
imagejpeg($img);
imagedestroy($img);
//print "<img src='pics/flogo.png'>";
?>