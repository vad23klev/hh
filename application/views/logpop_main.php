<ul class="nav navbar-nav navbar-right">			
						<?if ($login['name'] != -1) :?>

				<?$newq = array(4=>'Новые заявки',5=>'Новые вопросы')?>
				<?$newq1 = array(4=>'Заявки',5=>'Вопросы')?>
				<?$newq2 = array(4=>'providerlots',5=>'providerq')?>
				<?$classes = array(4=>'icon-docs',5=>'icon-question')?>
						
						<li class="dropdown navbar-user">
						<a aria-expanded="true" href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<?if ($login['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$login['photo'])):?>
								<img src="/imnew.php?type=uimgs&image=<?=$login['photo']?>&width=30&height=30" alt="" />
							<?endif?> 
							<span class="hidden-xs"><?=$login['fio']?> <?=$login['lastname']?> <?=$login['surname']?></span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<?if (($login['role'] == 4 || $login['role'] == 5)):?>
							<li >
								<a <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/<?=$newq2[$login['role']]?>/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" data-container="body" data-title="<?=$reject?>"<?endif?>><i class="<?=$classes[$login['role']]?>"></i> <span><?=$newq1[$login['role']]?></span> </a>							
							</li>							
							<?if ($login['role'] == 4):?>
								<li >
									<a <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/ausers/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" data-container="body" data-title="<?=$reject?>"<?endif?>><i class="icon-users"></i> <span>Мои эксперты</span></a>
								</li>
							<?endif?>	
					<?else:?>										
							<li >
								<a <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/openlots/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" data-title="<?=$reject?>"<?endif?>><i class="icon-docs"></i> <span>Мои заявки</span></a>
							</li>
							<li >
								<a <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/openq/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" data-title="<?=$reject?>"<?endif?>><i class="icon-question"></i> <span>Мои вопросы экспертам</span></a>
							</li>
							<!--li><a class="<?if ($login['complete']==0 || $login['expert']==0) :?>disabled<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/activity/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-container="body" data-placement="bottom" data-title="<?=$reject?>"<?endif?>><i class="fa fa-laptop"></i> <span>Сообщения</span></a></li-->
							<li >
								<a <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/addlot/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-container="body" data-placement="bottom" data-title="<?=$reject?>"<?endif?>><i class="icon-note"></i> <span>Создать заявку</span></a>
							</li>
							<li >
								<a <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/addlot?sale_type=1"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-container="body" data-placement="bottom" data-title="<?=$reject?>"<?endif?>><i class="icon-question "></i><span>Задать вопрос эксперту</span></a>
							</li>							
					<?endif?>
							<li ><a href="/user/cabinet/"><i class="icon-user"></i> <span>Мой профиль</span></a></li>
							<li ><a href="/user/chpass/"><i class="icon-key"></i> <span>Смена пароля</span></a></li>					
							<li><a href="/user/logout/">Выход</a></li>
						</ul>
					</li>
						<?else:?>
							<li><a href="http://app.russiagoingglobal.com/login">ВХОД</a></li>
						<?endif?>
                    </ul>