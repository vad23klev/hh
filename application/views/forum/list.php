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
	
	
	return $diff;
}

?>

    <div class="page-title has-bg">
        <!-- begin bg-cover -->
        <div class="bg-cover">
            <img src="/forum1/assets/img/cover2.jpg" alt="" />
        </div>
        <!-- end bg-cover -->
        <!-- begin container -->
        <div class="container">
            <!-- begin breadcrumb -->
            <ul class="breadcrumb">
                <li><a href="/">Главная</a></li>
                <li ><a href="/forum">Форум</a></li>
				<?if (intval($cat->id) > 0):?>
				<li ><span><?=$stepname->name?></span></li>
            </ul>
            <!-- end breadcrumb -->
            <h1><?=$cat->name?></h1>
			<?else:?>
			</ul><h1><?=$stepname->name?></h1>
			<?endif?>
        </div>
        <!-- end container -->
    </div>
    <!-- end page-title -->

    <!-- begin content -->
    <div class="content">
        <!-- begin container -->
        <div class="container">

            <!-- begin row -->
            <div class="row">
                <!-- begin col-9 -->
                <div class="col-md-9">
				
				<div class="col-md-8" style="padding-left:0px">	
				<form action="/forum/list/0/<?=$step?>/<?=$category?>/" method="get" id="sform">
					<?if(strlen($_GET['search'])>0 || intval($_GET['step'])>0):?>
							<a href="/forum/list/0/<?=$step?>/<?=$category?>/" class="btn btn-sm btn-success pull-right" style="padding:5px 12px">Сбросить результаты поиска</a>
					<?endif?>
						<div class="input-group text-right">
							<input type="hidden" value="<?=intval($_GET['gr'])?>" />
                            <input  type="text" class="form-control input-sm input-white" style="border:1px solid #ddd;" name="search" value="<?=$search?>" placeholder="Искать вопрос" />
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-primary" style="padding:4px 12px;margin-right:10px;padding-bottom:5px" type="button" onclick="$('#sform').submit()">Поиск</button>
                            </span>
                        </div>	

				</form>	
			</div>

				
				
                    <!-- begin pagination -->
                    <div class="text-right">
						<?=$pagination?>                        
                    </div>
                    <!-- end pagination -->
                    <!-- begin panel-forum -->
                    <div class="panel panel-forum">
                        <!-- begin forum-list -->
                        <ul class="forum-list forum-topic-list">
							<?foreach ($questions as $q):?>
                            <li>
								<?$user = ORM::factory('useratt')->where('user_id','=',$q->user_id)->find()?>
                                <!-- begin media -->
                                <div class="media">
									<div style="height:64px;overflow:hidden">
                                    <?if ($user->photo != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$user->photo)):?>
										<img src="/img/uimgs/<?=$user->photo?>" />
									<?endif?>
									</div>
                                </div>
                                <!-- end media -->
                                <!-- begin info-container -->
                                <div class="info-container">
									<?$feeds = $q->feeds->find_all()?>
									
                                    <div class="info">
                                        <h4 class="title"><a href="/forum/one/0/<?=$step?>/<?=$category?>/<?=$q->id?>/<?=$page?>"><?=$q->title?></a></h4>
                                        <ul class="info-start-end">
											<li>опубликовал
											<?if ($user->user->role == 4 || $user->user->role == 5):?>
												<?if ($user->user->role == 4):?><?$link1 = "/companies/one/0/".$user->user_id?><?endif?>
												<?if ($user->user->role == 5):?><?$link1 = "/companies/one/1/".$user->user_id?><?endif?>
												
												<a href="<?=$link1?>"><?=$user->fio?> <?=$user->lastname?> <?=$user->surname?></a></li>
											<?else:?>
												<span><?=$user->fio?> <?=$user->lastname?> <?=$user->surname?></span>
											<?endif?>
											<?if($feeds->count()>0):?>
												<li>последний ответ 
												<?$lastuser = ORM::factory('feed')->where('product_id','=',$q->id)->order_by('id','desc')->find()?>
												<?$lastuserfio = ORM::factory('useratt')->where('user_id','=',$lastuser->user_id)->find()?>
												<?if ($lastuserfio->user->role == 4 || $lastuserfio->user->role == 5):?>
													<?if ($lastuserfio->user->role == 4):?><?$link = "/companies/one/0/0/".$lastuserfio->user_id?><?endif?>
													<?if ($lastuserfio->user->role == 5):?><?$link = "/companies/one/1/0/".$lastuserfio->user_id?><?endif?>
													<a href="<?=$link?>"><?=$lastuserfio->fio?> <?=$lastuserfio->lastname?> <?=$lastuserfio->surname?></a></li>
												<?else:?>
													<span><?=$lastuserfio->fio?> <?=$lastuserfio->lastname?> <?=$lastuserfio->surname?></span></li>
												<?endif?>
											<?endif?>
                                        </ul>
                                    </div>
                                    <div class="date-replies">
                                        <div class="time">
											<?=convdate($q->cts)?>
                                        </div>
                                        <div class="replies">
                                            <div class="total"><?=$feeds->count()?></div>
                                            <div class="text">ответов</div>
                                        </div>
                                    </div>
									<div style="clear:both"></div>
                                </div>
                                <!-- end info-container -->
                            </li>
							<?endforeach?>

                        </ul>
                        <!-- end forum-list -->
                    </div>
                    <!-- end panel-forum -->
                    
                    <!-- begin pagination -->
                    <div class="text-right">
						<?=$pagination?>                       
                    </div>
                    <!-- end pagination -->
                </div>
                <!-- end col-9 -->
                <!-- begin col-3 -->
                <div class="col-md-3">
                    <!-- begin panel-forum -->
                    <div class="panel panel-forum">
                        <div class="panel-heading">
                            <h4 class="panel-title">Последние вопросы</h4>
                        </div>
                        <!-- begin threads-list -->
                        <ul class="threads-list">
							<?foreach ($lastposts as $lastpost) :?>
							<?$lastcat = ORM::factory('categorie')->where('id','=',$lastpost->category_id)->find()?>
                            <li style="padding-bottom:5px">
                                <h4 class="title"><a href="/forum/one/0/<?=$lastcat->step_id?>/<?=$lastcat->id?>/<?=$lastpost->id?>/0"><?=$lastpost->title?></a></h4>
                                <?if ($lastpost->id > 0):?>
								<?$user = ORM::factory('useratt')->where('user_id','=',$lastpost->user_id)->find()?>                                
                                <p class="time">опубликован <?=date('d.m.Y H:i',$lastpost->cts)?><br/><span class="user">
								<?=$user->fio?> <?=$user->lastname?> <?=$user->surname?></span></p>
								<?endif?>
                            </li>
							<?endforeach?>
                        </ul>
                        <!-- end threads-list -->
                    </div>
                    <!-- end panel-forum -->
                </div>
                <!-- end col-3 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>	