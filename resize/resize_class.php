<?
Class resize
{
    // *** Переменные класса
    private $image;
    private $width;
    private $height;
	private $ext;
	private $overimg;
	private $imageResized;

    function __construct($fileName,$overimg='')
    {	$this->ext = strtolower(strrchr($fileName, '.'));
        // *** Открываем файл
        $this->image = $this->openImage($fileName);
		$this->overimg = $overimg;
        // *** Устанавливаем исходные параметры: ширину и высоту.
        $this->width  = imagesx($this->image);
		$this->height = imagesy($this->image);
		
    }
	
	private function openImage($file)
	{
		if (file_exists($file)) {
			switch($this->ext)
			{
				case '.jpg':
				case '.jpeg':
				$img = @imagecreatefromjpeg($file);
					break;
				case '.gif':
					$img = @imagecreatefromgif($file);
					break;
				case '.png':
					$img = @imagecreatefrompng($file);
					break;
				default:
					$img = false;
					break;
			}
			return $img;
		} else {

        $img  = imagecreatetruecolor(150, 30); /* Create a black image */
        $bgc = imagecolorallocate($img, 255, 255, 255);
        $tc  = imagecolorallocate($img, 0, 0, 0);
        imagefilledrectangle($img, 0, 0, 150, 30, $bgc);
		//imagestring($img, 1, 5, 5, "Missing\r\nphoto", $tc);
				
		return $img;
		
		}
	}

	public function resizeImage($newWidth, $newHeight, $option="auto")
        {

            // *** Получаем оптимальную высоту и ширину - базируясь на $option
            $optionArray = $this->getDimensions($newWidth, $newHeight, strtolower($option));

            $optimalWidth  = $optionArray['optimalWidth'];
            $optimalHeight = $optionArray['optimalHeight'];

            // *** Resample - create image canvas of x, y size
            $this->imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);
            imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $this->width, $this->height);

            // *** Если опция включена 'crop'
            if ($option == 'crop') {
                $this->crop($optimalWidth, $optimalHeight, $newWidth, $newHeight);
            }
        }
		
		public function watermark(){
			
				$watermark = imagecreatefrompng('../img/watermark.png');
				$watermark_width = imagesx($watermark);
				$watermark_height = imagesy($watermark);
				
				$dest_x = imagesx($this->imageResized)/2 - $watermark_width/2;
				$dest_y = imagesy($this->imageResized)/2 - $watermark_height/2;
				imagealphablending($this->imageResized, true);
				imagealphablending($watermark, true);
				imagecopy($this->imageResized, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height);
				
            
		}
		
private function getDimensions($newWidth, $newHeight, $option)
        {

           switch ($option)
            {
                case 'exact':
                    $optimalWidth = $newWidth;
                    $optimalHeight= $newHeight;
                    break;
                case 'portrait':
                    $optimalWidth = $this->getSizeByFixedHeight($newHeight);
                    $optimalHeight= $newHeight;
                    break;
                case 'landscape':
                    $optimalWidth = $newWidth;
                    $optimalHeight= $this->getSizeByFixedWidth($newWidth);
                    break;
                case 'auto':
                    $optionArray = $this->getSizeByAuto($newWidth, $newHeight);
                    $optimalWidth = $optionArray['optimalWidth'];
                    $optimalHeight = $optionArray['optimalHeight'];
                    break;
                case 'crop':
                    $optionArray = $this->getOptimalCrop($newWidth, $newHeight);
                    $optimalWidth = $optionArray['optimalWidth'];
                    $optimalHeight = $optionArray['optimalHeight'];
                    break;
            }
            return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
        }
		
		private function getSizeByFixedHeight($newHeight)
        {
            $ratio = $this->width / $this->height;
            $newWidth = $newHeight * $ratio;
            return $newWidth;
        }

        private function getSizeByFixedWidth($newWidth)
        {
            $ratio = $this->height / $this->width;
            $newHeight = $newWidth * $ratio;
            return $newHeight;
        }

        private function getSizeByAuto($newWidth, $newHeight)
        {
            if ($this->height < $this->width)
            // *** Изображения изменяется по ширине (landscape)
            {
                $optimalWidth = $newWidth;
                $optimalHeight= $this->getSizeByFixedWidth($newWidth);
            }
            elseif ($this->height > $this->width)
            // *** Изображение изменяется по высоте (portrait)
            {
                $optimalWidth = $this->getSizeByFixedHeight($newHeight);
                $optimalHeight= $newHeight;
            }
            else
            // *** Изображение изменяется в соответствии с указанными значениями
            {
                if ($newHeight < $newWidth) {
                    $optimalWidth = $newWidth;
                    $optimalHeight= $this->getSizeByFixedWidth($newWidth);
                } else if ($newHeight > $newWidth) {
                    $optimalWidth = $this->getSizeByFixedHeight($newHeight);
                    $optimalHeight= $newHeight;
                } else {
                    // *** Sqaure being resized to a square
                    $optimalWidth = $newWidth;
                    $optimalHeight= $newHeight;
                }
            }

            return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
        }

        private function getOptimalCrop($newWidth, $newHeight)
        {

            $heightRatio = $this->height / $newHeight;
            $widthRatio  = $this->width /  $newWidth;

            if ($heightRatio < $widthRatio) {
                $optimalRatio = $heightRatio;
            } else {
                $optimalRatio = $widthRatio;
            }

            $optimalHeight = $this->height / $optimalRatio;
            $optimalWidth  = $this->width  / $optimalRatio;

            return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
        }

	private function crop($optimalWidth, $optimalHeight, $newWidth, $newHeight)
        {
            // *** Поиск центра изображения - используется для резайза
            $cropStartX = ( $optimalWidth / 2) - ( $newWidth /2 );
            $cropStartY = ( $optimalHeight/ 2) - ( $newHeight/2 );

            $crop = $this->imageResized;
            //imagedestroy($this->imageResized);

            // *** Вырезаем указанный кусочек изображения
            $this->imageResized = imagecreatetruecolor($newWidth , $newHeight);
            imagecopyresampled($this->imageResized, $crop , 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);
        }
	public function saveImage($savePath, $imageQuality="100")
        {
            
            switch($this->ext)
            {
                case '.jpg':
                case '.jpeg':
                    if (imagetypes() & IMG_JPG) {
                        imagejpeg($this->imageResized, $savePath, $imageQuality);
                    }
                    break;

                case '.gif':
                    if (imagetypes() & IMG_GIF) {
                        imagegif($this->imageResized, $savePath);
                    }
                    break;

                case '.png':
                    // *** Приводим качество из диапазона 0-100 к 0-9
                    $scaleQuality = round(($imageQuality/100) * 9);

                    // *** Инвертируем качество (0 - наилучшее)
                    $invertScaleQuality = 9 - $scaleQuality;

                    if (imagetypes() & IMG_PNG) {
                        imagepng($this->imageResized, $savePath, $invertScaleQuality);
                    }
                    break;

                // ... etc

                default:
                    // *** Не указано - не сохраняем
                    break;
            }

            imagedestroy($this->imageResized);
        }
		
		public function outputImage($imageQuality="100")
        {	
			$content_type = image_type_to_mime_type($type);
            if ( ! headers_sent() ) {
                header('Content-Type: ' . $content_type);
            } else {
                user_error('Headers have already been sent. Could not display image.', E_USER_NOTICE);
                return false;
            }

			if (strlen($this->overimg)>0) {
				$overimg = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/img/'.$this->overimg);

				if (!$overimg){
					$im  = imagecreatetruecolor(238, 232); /* Create a black image */
					$bgc = imagecolorallocate($im, 255, 255, 255);
					$tc  = imagecolorallocate($im, 0, 0, 0);
					imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
					/* Output an errmsg */
					imagestring($im, 1, 5, 5, "Error loading lenta.png", $tc);
				}
				$w_over = imagesx($overimg);
				$h_over = imagesy($overimg);			
				imagecopy($this->imageResized,$overimg,0,0,0,0,$w_over,$h_over);
			}
			
			
            switch($this->ext)
            {
                case '.jpg':
                case '.jpeg':
                    
					if (imagetypes() & IMG_JPG) {
                        $content_type = image_type_to_mime_type(IMAGETYPE_JPEG);
					if ( ! headers_sent() ) {
						header('Content-Type: ' . $content_type);
					} else {
						user_error('Headers have already been sent. Could not display image.', E_USER_NOTICE);
						return false;
					}

						imagejpeg($this->imageResized, '', $imageQuality);
                    }
                    break;

                case '.gif':
                    
					if (imagetypes() & IMG_GIF) {
                        $content_type = image_type_to_mime_type(IMAGETYPE_GIF);
					if ( ! headers_sent() ) {
						header('Content-Type: ' . $content_type);
					} else {
						user_error('Headers have already been sent. Could not display image.', E_USER_NOTICE);
						return false;
					}
						imagegif($this->imageResized);
                    }
                    break;

                case '.png':
                    
					
					// *** Приводим качество из диапазона 0-100 к 0-9
                    $scaleQuality = round(($imageQuality/100) * 9);

                    // *** Инвертируем качество (0 - наилучшее)
                    $invertScaleQuality = 9 - $scaleQuality;

                    if (imagetypes() & IMG_PNG) {
                        $content_type = image_type_to_mime_type(IMAGETYPE_PNG);
						if ( ! headers_sent() ) {
							header('Content-Type: ' . $content_type);
						} else {
							user_error('Headers have already been sent. Could not display image.', E_USER_NOTICE);
							return false;
						}
						$background_color = imagecolorallocate($this->imageResized, 0, 0, 0);
						imagecolortransparent($this->imageResized, $background_color);
						imagepng($this->imageResized, '', $invertScaleQuality);
                    }
                    break;

                // ... etc

                default:
                    // *** Не указано - не сохраняем
                    break;
            }
			




//			
			
			
			
        }


}