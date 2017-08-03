								<!-- PAGE CONTENT BEGINS -->
								<h4 class="header green clearfix">
									Create an article
								</h4>
								<button class="btn btn-dagger btn-xs btn-collapse-errors" type="button" data-toggle="collapse" data-target="#errors-section" aria-expanded="false" aria-controls="errors-section">
								  <?= $counte ?> Errors ! Click to show errors's message
								</button>
								<div class="collapse" id="errors-section">
								  <div class="well">
								    <?= $this->flashSession->output() ?>
								  </div>
								</div>

								<div class="hr dotted"></div>

								<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
									<div class="row">
										<div class="col-xs-8" role="form">
										<?php foreach ($forms as $element) { ?>
											<?php if (is_a($element, 'Phalcon\Forms\Element\Hidden')) { ?>
												<?= $element ?>
											<?php } else { ?>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="management-add-title"> <?= $element->label() ?> </label>

												<div class="col-sm-9">
												<?php if ($element->getName() == 'tag') { ?>
													<span class="input-icon">
														<?= $element ?>
														<i class="ace-icon fa fa-tag blue"></i>
													</span>
												<?php } else { ?>
													<?= $element ?>
												<?php } ?>
												</div>
											</div>
											<?php } ?>
										<?php } ?>
										</div>
										<div class="col-xs-4">
											<label class="control-label no-padding-right" for="management-add-description"><i class="fa fa-file-image-o"></i> Intro Image (Show on top article)</label>
											<div class="widget-box" style="border: none">
												<div class="widget-body">
													<div class="widget-main no-padding">
														<div class="form-group" style="margin: 0">
															<div class="col-xs-12 no-padding">
																<input multiple="" name="article-file-upload" type="file" id="article-file-upload" />
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="hr dotted"></div>

									<textarea name="content" id="content"></textarea>

									<div class="clearfix form-actions" style="padding-right: 0">
										<div style="text-align: right">
											<button class="btn btn-info" type="submit" id="btn-add-new-article">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Reset
											</button>
										</div>
									</div>
								</form>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Template: Ace</span>
							Application &copy; 2013-2014 | <span class="blue bolder">Editor: Hubphoto.io</span>
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<?= $this->assets->outputJs() ?>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($){
				//Editor
				$('textarea#content').froalaEditor({
					height: 400,
					heightMax: 550,
					toolbarButtons: ['bold', 'italic', 'underline', 'subscript', 'superscript', '|', 'color', '|', 'fontSize', 'paragraphFormat', 'align', 'formatUL', '|', 'insertLink', 'insertImage', 'insertVideo', 'insertTable', '|', 'quote', 'insertHR', '|', 'undo', 'redo', '|', 'clearFormatting', 'html'],
					imageUploadURL: '/froalaeditorcrudimage/upload',
					imageUploadMethod: 'POST',
					imageAllowedTypes: ['jpg', 'png', 'gif', 'jpeg', 'blob'],
					imageMaxSize: 5*1024*1024,
					imageManagerPreloader: '',
					imageManagerLoadURL: '/froalaeditorcrudimage/loadimage',
					imageManagerLoadMethod: 'GET',
					imageManagerPageSize: 10,
					imageManagerScrollOffset: 20,
					imageManagerDeleteURL: '/froalaeditorcrudimage/deleteimage',
					imageManagerDeleteMethod: 'POST',
				})
				.on("froalaEditor.image.uploaded", function(e, editor, response) {
					console.log(response);
				})
				.on('froalaEditor.image.error', function (e, editor, error, response) {
					console.log(error);
				})
				.on('froalaEditor.imageManager.imagesLoaded', function (e, editor, data) {
					console.log('All image was loaded !');
					console.log(data);
				})
				.on('froalaEditor.imageManager.imageLoaded', function (e, editor, $img) {
					console.log($img);
				})
				.on('froalaEditor.imageManager.beforeDeleteImage', function (e, editor, $img) {
					console.log ('Accepted delete img '+$img);
				})
				.on('froalaEditor.imageManager.imageDeleted', function (e, editor, data) {
					console.log ('Image has been deleted.');
					console.log(data);
				});

				$('textarea[data-provide="markdown"]').each(function(){
			        var $this = $(this);

					if ($this.data('markdown')) {
					  $this.data('markdown').showEditor();
					}
					else $this.markdown()
					
					$this.parent().find('.btn').addClass('btn-white');
			    })
		
				function showErrorAlert (reason, detail) {
					var msg='';
					if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
					else {
						//console.log("error uploading file", reason, detail);
					}
					$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
					 '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
				}

				if ( typeof jQuery.ui !== 'undefined' && ace.vars['webkit'] ) {
					
					var lastResizableImg = null;
					function destroyResizable() {
						if(lastResizableImg == null) return;
						lastResizableImg.resizable( "destroy" );
						lastResizableImg.removeData('resizable');
						lastResizableImg = null;
					}

					var enableImageResize = function() {
						$('.wysiwyg-editor')
						.on('mousedown', function(e) {
							var target = $(e.target);
							if( e.target instanceof HTMLImageElement ) {
								if( !target.data('resizable') ) {
									target.resizable({
										aspectRatio: e.target.width / e.target.height,
									});
									target.data('resizable', true);
									
									if( lastResizableImg != null ) {
										//disable previous resizable image
										lastResizableImg.resizable( "destroy" );
										lastResizableImg.removeData('resizable');
									}
									lastResizableImg = target;
								}
							}
						})
						.on('click', function(e) {
							if( lastResizableImg != null && !(e.target instanceof HTMLImageElement) ) {
								destroyResizable();
							}
						})
						.on('keydown', function() {
							destroyResizable();
						});
				    }

					enableImageResize();

					/**
					//or we can load the jQuery UI dynamically only if needed
					if (typeof jQuery.ui !== 'undefined') enableImageResize();
					else {//load jQuery UI if not loaded
						//in Ace demo ./components will be replaced by correct components path
						$.getScript("assets/js/jquery-ui.custom.min.js", function(data, textStatus, jqxhr) {
							enableImageResize()
						});
					}
					*/
				}
				$('#article-file-upload').ace_file_input({
					style: 'well',
					btn_choose: 'Click to choose an image..',
					btn_change: null,
					no_icon: 'ace-icon fa fa-cloud-upload',
					droppable: true,
					thumbnail: 'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
				
				
				//$('#article-file-upload')
				//.ace_file_input('show_file_list', [
					//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
					//{type: 'file', name: 'hello.txt'}
				//]);
			
			});

		</script>
	</body>
</html>
