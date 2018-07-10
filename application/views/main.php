<?if (!$main):?>
	<?if (($login['name'] != -1 && strpos($_SERVER['REQUEST_URI'],'/user/') !== false) || ($login['name'] != -1 && $saletype > 0)) :?>
		<?require "main1.php"?>
	<?else:?>	
		<?=$content?>
	<?endif?>
<?else:?>
	<?require "mainpage.php"?>
<?endif?>