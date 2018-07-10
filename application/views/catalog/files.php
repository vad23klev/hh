							<div id="files1" class="m-t-10 text-left">	
								<?if($exp['files']->count() > 0):?>
									<h4 style="margin-top:0px">Файлы:</h4>
									<table>
									<?foreach($exp['files'] as $i=>$file) :?>							
										<tr><td style="padding-right:15px;padding-bottom:10px">
										<a class="m-b-10" target="_blank" href="/img/files/<?=$file->name?>"><?=$i+1?>. <?=$file->file?></a>
										</td><td style="padding-right:15px;padding-bottom:10px">
										<a href="/user/delfile?del=<?=$file->id?>" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Удалить</a>
										</td></tr>
									<?endforeach?>
									</table>
								<?endif?>	
							</div>	



<form id="fileupload" action="assets/global/plugins/jquery-file-upload/server/php/" method="POST" enctype="multipart/form-data">
                        <div class="row fileupload-buttonbar">
                            <div class="col-md-7">
                                <span class="btn btn-success fileinput-button">
                                    <i class="fa fa-plus"></i>
                                    <span>Добавить...</span>
                                    <input type="file" name="files[]" multiple>
                                </span>
                                <!--button type="submit" class="btn btn-primary start">
                                    <i class="fa fa-upload"></i>
                                    <span>Start upload</span>
                                </button>
                                <button type="reset" class="btn btn-warning cancel">
                                    <i class="fa fa-ban"></i>
                                    <span>Cancel upload</span>
                                </button>
                                <button type="button" class="btn btn-danger delete">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    <span>Delete</span>
                                </button-->
                                <!-- The global file processing state -->
                                <span class="fileupload-process"></span>
                            </div>
                            <!-- The global progress state -->
                            <div class="col-md-5 fileupload-progress fade">
                                <!-- The global progress bar -->
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                </div>
                                <!-- The extended global progress state -->
                                <div class="progress-extended">&nbsp;</div>
                            </div>
                        </div>
                        <!-- The table listing the files available for upload/download -->
                        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                    </form>													
												