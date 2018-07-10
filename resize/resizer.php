<?php
/*
	$_GET['image'] 	- Имя файла
	$_GET['type'] 	- Тип файла для составления пути
	$_GET['width'] 	- Ширина требуемого размера
	$_GET['height']	- Высота требуемого размера
	$_GET['method']	- Метод сжатия (параметры: exact, portrait, landscape, auto, crop)
*/

include_once 'resize_class.php';
	
if (isset($_GET['image'])){
	/* Составляем правильный путь до изображения */
	switch($_GET['type']){
		case 'catalog': $prefix='../img/catalog/'; break;
		case 'pages': $prefix='../img/pages/'; break;
		case 'banners': $prefix='../img/banners/'; break;
		case 'gallery': $prefix='../img/gallery/'; break;
		case 'news': $prefix='../img/news/'; break;
		case 'photos': $prefix='../img/photos/'; break;
		case 'shopphotos': $prefix='../img/shopphotos/'; break;
		case 'icons': $prefix='../img/icons/'; break;
		case 'articles': $prefix='../img/articles/'; break;
		case 'exlink': $prefix=''; break;
		default: $prefix='../img/'; break;
	}
	$_GET['image'] = $prefix.$_GET['image'];
	
	$resizeObj = new resize($_GET['image'],$_GET['overimg']);
	
	$resizeObj -> resizeImage($_GET['width'], $_GET['height'], $_GET['method']);
	
	$resizeObj -> outputImage();
	
	
	
	
	
	
}else{
	return false;
}	