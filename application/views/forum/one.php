<?
function convdate($cts) {
	$diff = time() - $cts;	
	$months = 30*24*60*60;	
	$months = $diff/$months;
	if (intval($months)  > 0) {
		return intval($months).' месяцев назад';
	}

	$days = 24*60*60;	
	$days = $diff/$days;
	if (intval($days)  > 0) {
		return intval($days).' дней назад';
	}

	$hours = 60*60;	
	$hours = $diff/$hours;
	if (intval($hours)  > 0) {
		return intval($hours).' часов назад';
	}

	$minutes = 60;	
	$minutes = $diff/$minutes;
	if (intval($minutes)  > 0) {
		return intval($minutes).' минут назад';
	}
	
	if ($diff < 60) {
		return 'только что';
	}
	
	return $diff;
}
?>

    <!-- begin page-title -->
    <div class="page-title has-bg">
        <!-- begin bg-cover -->
        <div class="bg-cover">
            <img src="/forum1/assets/img/cover3.jpg" alt="" />
        </div>
        <!-- end bg-cover -->
        <!-- begin container -->
        <div class="container">
            <!-- begin breadcrumb -->
            <ul class="breadcrumb">
                <li><a href="/">Главная</a></li>
				<li><a href="/forum/">Форум</a></li>
				<li><a href="/forum/list/<?=$postpage?>/<?=$step?>/?search=<?=$search?>"><?=$stepname->name?></a></li>
                <li><a href="/forum/list/<?=$postpage?>/<?=$step?>/<?=$category?>?search=<?=$search?>"><?=$cat->name?></a></li>
                <li class="active">&nbsp;</li>
            </ul>
            <!-- end breadcrumb -->
            <h1><?=$prod->title?></h1>
        </div>
        <!-- end container -->
    </div>
    <!-- end page-title -->
    <!-- begin content -->
    <div class="content">
        <!-- begin container -->
        <div class="container">
            <!-- begin row -->

<div class="row"><div class="col-md-12 m-b-15">
		<div class="pull-right"><a class="btn btn-primary btn-sm" style="padding:3px 12px" href="/forum/list/<?=$postpage?>/<?=$step?>/<?=$category?>?search=<?=$search?>">Вернуться к списку вопросов</a></div>
		
		<table><tr><td style="vertical-align:middle;height:29px"><h5 style="font-weight:normal;margin:0px">
		Поделиться вопросом: </h5></td><td>
		<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter"></div>
		</td></tr></table>
</div></div>


            <div class="row">
                <!-- begin col-9 -->
                <div class="col-md-12">
                    <!-- begin pagination -->
                    <div class="text-right">
                        <?=$pagination?>
                    </div>
                    <!-- end pagination -->
                    <?$roles = array(3=>'экспортер',6=>'импортер',4=>'провайдер услуг',5=>'эксперт консультант')?>
                    <!-- begin forum-list -->
                    <ul class="forum-list forum-detail-list">
                        <li>
                            <!-- begin media -->
                            <div class="media">
                                <?if ($owner->photo != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$owner->photo)):?>
										<img src="/img/uimgs/<?=$owner->photo?>" />
								<?endif?>
								<span class="label label-danger">ВОПРОС</span>
                            </div>
                            <!-- end media -->
                            <!-- begin info-container -->
                            <div class="info-container">
                                <div class="post-user">
								<?$roles = array(4=>0,5=>1)?>
								<?if ($owner->user->role == 4 || $owner->user->role == 5):?>									
									<a href="/companies/one/<?=$roles[$owner->user->role]?>/0/<?=$owner->user_id?>"><?=$owner->fio?> <?=$owner->lastname?> <?=$owner->surname?></a>
								<?else:?>
									<span><?=$owner->fio?> <?=$owner->lastname?> <?=$owner->surname?></span>
								<?endif?>
								</div>
                                <div class="post-content" style="margin-bottom:0px"><?=$prod->name?></div>
                                <div class="post-time"><?=convdate($prod->cts)?></div>
                            </div>
                            <!-- end info-container -->
                        </li>
						<?foreach($feeds as $q):?>
                        <li>
                            <!-- begin media -->
							<?$user = ORM::factory('useratt')->where('user_id','=',$q->user_id)->find()?>
                            <div class="media">
                                <?if ($user->photo != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$user->photo)):?>
										<img src="/img/uimgs/<?=$user->photo?>" />
								<?endif?>
								<span class="label label-primary">ОТВЕТ</span>
                            </div>
                            <!-- end media -->
                            <!-- begin info-container -->
                            <div class="info-container">
                                <div class="post-user">

								<?if ($user->user->role == 4 || $user->user->role == 5):?>									
									<a href="/companies/one/<?=$roles[$user->user->role]?>/0/<?=$user->user_id?>"><?=$user->fio?> <?=$user->lastname?> <?=$user->surname?></a>
								<?else:?>
									<span><?=$user->fio?> <?=$user->lastname?> <?=$user->surname?></span>
								<?endif?>	
								</div>
                                <div class="post-content" style="margin-bottom:0px"><?=$q->text?></div>
                                <div class="post-time pull-left"><?=convdate($q->cts)?></div>
								<?$likes = $q->like->find_all()?>
								<?$voted = ORM::factory('like')->where('user_id','=',$user_id)->find()?>
								<div class="comment-rating pull-right">
								<?// && $owner->id != $user_id?>
								<?if ($voted->id == 0) :?>
									<a <?if($user_id>0):?>href="/forum/like?id=<?=$q->id?>"<?else:?>href="#modal-login" data-toggle="modal"<?endif?> class="btn btn-primary btn-xs pull-left"><i class="fa fa-thumbs-up"></i> Лучший ответ</a>
									<div class="m-l-10 text-inverse pull-left" style="cursor:default"><i class="fa fa-thumbs-up text-primary fa-lg"></i> <?=$likes->count()?></div>
								<?else:?>
									<div class="m-l-10 text-inverse pull-left" style="cursor:default"><i class="fa fa-thumbs-up text-primary fa-lg"></i> <?=$likes->count()?></div>	
								<?endif?>
								</div>
								<div style="clear:both"></div>
								
                            </div>
                            <!-- end info-container -->
                        </li>
                        <?endforeach?>
                    </ul>
                    <!-- end forum-list -->
                    
                    <!-- begin pagination -->
                    <div class="text-right">
                        <?=$pagination?>
                    </div>
                    <!-- end pagination -->
                    
                    <!-- begin comment-section -->
					<?if ($login['name'] != -1):?>
                    <!--div class="comment-banner-msg">
                        Вы можете добавить ответ на вопрос.
                    </div-->
                    <div class="panel panel-forum">
                        <div class="panel-heading">
                            <h4 class="panel-title">Ответ</h4>
                        </div>
                        <div class="panel-body">
                            <form action="/forum/one/<?=$page?>/<?=$step?>/<?=$category?>/<?=$prod->id?>/<?=$pastpage?>" name="wysihtml5" id="putcomment" method="POST">
                                <textarea class="textarea form-control req" style="resize:vertical" id="wysihtml5" name="text" rows="12" placeholder="Введите текст"></textarea>
                                <div class="m-t-10">
                                    <button type="submit" class="btn btn-primary" style="padding:3px 12px" onclick="return controlform('#putcomment')">Добавить ответ <i class="fa fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
					<?else:?>
						<div class="comment-banner-msg" style="color:black">
							Ответы могут оставить только зарегистрированные пользователи. Пожалуйста <a href="#modal-login" data-toggle="modal">авторизуйтесь</a> или <a href="/user/register">зарегистрируйтесь</a>.
						</div>
					<?endif?>
                    <!-- end comment-section -->
                </div>
                <!-- end col-9 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
	
<?if (intval($success) > 0):?>	
	<script>
		$(document).ready(function() {
			setTimeout(function() {
				setTimeout("$('#change').modal('show')",500);
				/*$.gritter.add({
					text: '',
					<?if ($data->complete == 1) :?>
						title: 'Ваши данные были успешно изменены.',
					<?else:?>	
						title: 'Ваши данные переданы администраторам сайта для проверки и дальнейшей авторизации',
					<?endif?>	
					image: '',
					sticky: true,
					time: 5000,
					class_name: 'my-sticky-class'
				});*/
			}, 1000);									
		});
	</script>
<?endif?>			