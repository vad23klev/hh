
    <!-- begin search-banner -->
    <div class="search-banner has-bg">
        <!-- begin bg-cover -->
        <div class="bg-cover">
            <img src="/forum1/assets/img/cover.jpg" alt="" />
        </div>
        <!-- end bg-cover -->
        <!-- begin container -->
		<div class="container">
			<h1>Форум</h1>
		</div>
        <!-- end container -->
    </div>
    <!-- end search-banner -->


    <!-- begin content -->
    <div class="content">
        <!-- begin container -->
        <div class="container">

<div class="row" style="margin-bottom:0px;">
<div class="col-md-12">
<?$block = ORM::factory('categorie')->where('id','=',433)->find()?>
<?=$block->html?></div>

</div>

<hr class="m-t-10 m-b-20"/>
		
<div class="row" style="margin-bottom:20px">
		<form action="/forum/" method="get" id="sform">
			<div class="col-md-4" style="padding-left:10px">
			
						<select class="select3 form-control" name="step" onchange="$('#sform').submit()">
							<option value="0" >Выберите компетенции </option>

				<?foreach ($steps as $step):?>
					<?$count = 0?>
					<?$subcats = ORM::factory('categorie')->where('category_id','=',355)->where('step_id','=',$step)->find_all()?>
					<?foreach ($subcats as $subcat) :?>
						<?$products = ORM::factory('product')->where('category_id','=',$subcat->id)->where('sale_type','=',1)->where('pub','=',1)->find_all();?>
						<?if ($products->count() > 0):?>
							<option value="<?=$subcat->id?>" <?if($subcat->id==$_GET['step']):?>selected<?endif?>><?=$subcat->name?></option>
						<?endif?>

					<?endforeach?>
				<?endforeach?>
						

						</select>			
		</div>
	
			<div class="col-md-4" style="padding-right:10px">	
				
					<?if(strlen($_GET['search'])>0 || intval($_GET['step'])>0):?>
							<a href="/forum/list/<?=$role?>" class="btn btn-sm btn-success pull-right" style="padding:3px 12px">Сбросить результаты поиска</a>
					<?else:?>
						<div class="input-group text-right">
							<input type="hidden" value="<?=intval($_GET['gr'])?>" />
                            <input  type="text" class="form-control input-sm input-white" style="height:28px;border:1px solid #ddd;border-right:none" name="search" value="<?=$_GET['search']?>" placeholder="Искать вопрос" />
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-primary" style="padding:3px 12px;height:28px" type="button" onclick="$('#sform').submit()">Поиск</button>
                            </span>
                        </div>	

			<?endif?>
			</div>
			<div class="col-md-4">
			<table class="pull-right"><tr><td style="vertical-align:middle;height:29px"><h5 style="font-weight:normal;margin:0px">
		Поделиться: </h5></td><td>
		<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter"></div>
		</td></tr></table>
			</div>
		</form>		
					
</div>

            <!-- begin panel-forum -->
			<?foreach ($steps as $step):?>
				<?$count = 0?>
				<?$subcats = ORM::factory('categorie')->where('step_id','=',$step)->find_all()?>
				<?foreach ($subcats as $subcat) :?>
					<?$products = ORM::factory('product')->where('category_id','=',$subcat->id)->where('sale_type','=',1)->where('pub','=',1)->find_all();?>
					<?$count += $products->count()?>					
				<?endforeach?>
				<?if ($count > 0):?>
				<div class="panel panel-forum">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 style="color:black;margin:0" class="title"><?=$step->name?></h4>
                </div>
                <!-- end panel-heading -->
                <!-- begin forum-list -->
                <ul class="forum-list">
					<?$subcats = ORM::factory('categorie')->where('step_id','=',$step)->find_all()?>
					<?foreach ($subcats as $subcat) :?>
					<?$products = ORM::factory('product')->where('category_id','=',$subcat->id)->where('sale_type','=',1)->where('pub','=',1)->find_all();?>
					<?if ($products->count() > 0):?>
                    <li style="padding:8px 15px;padding-bottom:5px">
                        <!-- begin media -->
                        <div class="media" style="width:32px;height:32px">
                            <img src="/forum1/assets/img/icon-chat-bubble.png" alt="" />
                        </div>
                        <!-- end media -->
                        <!-- begin info-container -->
                        <div class="info-container" style="margin-left:55px">
                            <div class="info">
                                <h4 style="color:black" class="panel-title"><a href="/forum/list/0/<?=$step->id?>/<?=$subcat->id?>"><?=$subcat->name?></a></h4>
                            </div>
                            <div class="total-count">
								
								<?$feeds = 0?>
								<?foreach ($products as $prod) :?>
									<?$feed = $prod->feeds->find_all()?>
									<?$feeds += $feed->count()?>
								<?endforeach?>
								
                                <span class="total-post"><?=$products->count()?></span> <span class="divider">/</span> 
								<span class="total-comment"><?=$feeds?></span>
                            </div>
                            <div class="latest-post">
								<?$lastpost = ORM::factory('product')->where('category_id','=',$subcat->id)->where('sale_type','=',1)->where('pub','=',1)->order_by('cts','desc')->find();?>								
								<?if ($lastpost->id > 0):?>
								<?$lastcat = ORM::factory('categorie')->where('id','=',$prod->category_id)->find()?>
								<?$user = ORM::factory('useratt')->where('user_id','=',$lastpost->user_id)->find()?>
                                <h4 class="title"><a href="/forum/one/0/<?=$lastcat->step_id?>/<?=$lastcat->id?>/<?=$lastpost->id?>/0"><?=$lastpost->title?></a></h4>
                                <p class="time">опубликован <?=date('d.m.Y H:i',$lastpost->cts)?><br/><span style="color:#000;font-weight:bold" class="user">
								<?=$user->fio?> <?=$user->lastname?> <?=$user->surname?></span></p>
								<?endif?>
                            </div>
                        </div>
                        <!-- end info-container -->
                    </li>
					<?endif?>
					<?endforeach?>
                </ul>
                <!-- end forum-list -->
            </div>
			<?endif?>
			<?endforeach?>
            <!-- end panel-forum -->
           
            <!-- end panel-forum -->
        </div>
        <!-- end container -->
    </div>
    <!-- end content -->