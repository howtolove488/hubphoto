								<!-- PAGE CONTENT BEGINS -->
								<h4 class="header green clearfix">
									Create a new article
								</h4>
								<div>
									<div class="row">
										<div class="form-horizontal col-xs-8" role="form">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="management-add-title"> Title </label>

												<div class="col-sm-9">
													<input type="text" id="management-add-title" placeholder="Text Field" class="form-control" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="management-add-uri"> Relative URI </label>

												<div class="col-sm-9">
													<input type="text" id="management-add-uri" placeholder="Text Field" class="form-control" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="management-add-description"> Description (Limited 255)</label>
												<div class="col-sm-9">
													<textarea id="management-add-description" class="form-control limited" maxlength="255" rows="5"></textarea>
												</div>
											</div>
										</div>
										<div class="col-xs-4">
											<label class="control-label no-padding-right" for="management-add-description"><i class="fa fa-file-image-o"></i> Intro Image (Show on top article)</label>
											<div class="widget-box" style="border: none">
												<div class="widget-body">
													<div class="widget-main no-padding">
														<div class="form-group" style="margin: 0">
															<div class="col-xs-12 no-padding">
																<input multiple="" type="file" id="id-input-file-3" />
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="hr dotted"></div>

									<div class="wysiwyg-editor" id="editor1"></div>

									<div class="clearfix form-actions" style="padding-right: 0">
										<div style="text-align: right">
											<button class="btn btn-info" type="button">
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
								</div>
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
							<span class="blue bolder">Ace</span>
							Application &copy; 2013-2014
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
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

				//but we want to change a few buttons colors for the third style
				$('#editor1').ace_wysiwyg({
					toolbar:
					[
						'font',
						null,
						'fontSize',
						null,
						{name:'bold', className:'btn-info'},
						{name:'italic', className:'btn-info'},
						{name:'strikethrough', className:'btn-info'},
						{name:'underline', className:'btn-info'},
						null,
						{name:'insertunorderedlist', className:'btn-success'},
						{name:'insertorderedlist', className:'btn-success'},
						{name:'outdent', className:'btn-purple'},
						{name:'indent', className:'btn-purple'},
						null,
						{name:'justifyleft', className:'btn-primary'},
						{name:'justifycenter', className:'btn-primary'},
						{name:'justifyright', className:'btn-primary'},
						{name:'justifyfull', className:'btn-inverse'},
						null,
						{name:'createLink', className:'btn-pink'},
						{name:'unlink', className:'btn-pink'},
						null,
						{name:'insertImage', className:'btn-success'},
						null,
						'foreColor',
						null,
						{name:'undo', className:'btn-grey'},
						{name:'redo', className:'btn-grey'}
					],
					'wysiwyg': {
						fileUploadError: showErrorAlert
					}
				}).prev().addClass('wysiwyg-style1');

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
				$('#id-input-file-3').ace_file_input({
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
				
				
				//$('#id-input-file-3')
				//.ace_file_input('show_file_list', [
					//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
					//{type: 'file', name: 'hello.txt'}
				//]);
			
				
				
			
				//dynamically change allowed formats by changing allowExt && allowMime function
				$('#id-file-format').removeAttr('checked').on('change', function() {
					var whitelist_ext, whitelist_mime;
					var btn_choose
					var no_icon
					if(this.checked) {
						btn_choose = "Drop images here or click to choose";
						no_icon = "ace-icon fa fa-picture-o";
			
						whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
						whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
					}
					else {
						btn_choose = "Drop files here or click to choose";
						no_icon = "ace-icon fa fa-cloud-upload";
						
						whitelist_ext = null;//all extensions are acceptable
						whitelist_mime = null;//all mimes are acceptable
					}
					var file_input = $('#id-input-file-3');
					file_input
					.ace_file_input('update_settings',
					{
						'btn_choose': btn_choose,
						'no_icon': no_icon,
						'allowExt': whitelist_ext,
						'allowMime': whitelist_mime
					})
					file_input.ace_file_input('reset_input');
					
					file_input
					.off('file.error.ace')
					.on('file.error.ace', function(e, info) {
						//console.log(info.file_count);//number of selected files
						//console.log(info.invalid_count);//number of invalid files
						//console.log(info.error_list);//a list of errors in the following format
						
						//info.error_count['ext']
						//info.error_count['mime']
						//info.error_count['size']
						
						//info.error_list['ext']  = [list of file names with invalid extension]
						//info.error_list['mime'] = [list of file names with invalid mimetype]
						//info.error_list['size'] = [list of file names with invalid size]
						
						
						/**
						if( !info.dropped ) {
							//perhapse reset file field if files have been selected, and there are invalid files among them
							//when files are dropped, only valid files will be added to our file array
							e.preventDefault();//it will rest input
						}
						*/
						
						
						//if files have been selected (not dropped), you can choose to reset input
						//because browser keeps all selected files anyway and this cannot be changed
						//we can only reset file field to become empty again
						//on any case you still should check files with your server side script
						//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
					});
					
					
					/**
					file_input
					.off('file.preview.ace')
					.on('file.preview.ace', function(e, info) {
						console.log(info.file.width);
						console.log(info.file.height);
						e.preventDefault();//to prevent preview
					});
					*/
				
				});
			});

		</script>
	</body>
</html>
