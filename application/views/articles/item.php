<div style="padding:10px;">
<h1 style="margin-bottom:10px;"><?=$prod->name?></h1>
<?
if (file_exists("img/news/".$prod->picture)) :
?>
<img src="/img/news/<?=$prod->picture?>" align="left" style="margin:10px" width="50%"/>
<?endif?>

<?=$prod->text?>

<p align="right">
<a href="<?=$link?>" class="border backs">Все статьи</a>
</p>

</div>