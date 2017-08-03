								<!-- PAGE CONTENT BEGINS -->
								<div>
									<ul class="ace-thumbnails clearfix">
										{% for item in page.items %}
										<li>
											{{ link_to('/uploaded/'~item.uri, image("/uploaded/"~item.uri, "alt": item.tag, "height": "150", "width": "150"), 'target': '_blank') }}

											<div class="tags">
												<span class="label-holder">
													<span class="label label-warning arrowed-in">{{ item.tag }}</span>
												</span>
											</div>
										</li>
										{% endfor %}
									</ul>
									<div class="search-area text-center">
										<ul class="pagination">
											<!-- 24 is number each page -->
											{% set total_page = page.total_pages %}
											{% if page.current <= 1 %}
											<li class="disabled">
												<a href="javascript:void(0)"><i class="ace-icon fa fa-angle-double-left"></i></a>
											</li>
											{% else %}
											<li>
												{{ link_to('/management/gallery?page='~page.before, '<i class="ace-icon fa fa-angle-double-left"></i>') }}
											</li>
											{% endif %}

											{% if page.current >= total_page %}
											<li class="disabled">
												<a href="javascript:void(0)"><i class="ace-icon fa fa-angle-double-right"></i></a>
											</li>
											{% else %}
											<li>
												{{ link_to('/management/gallery?page='~page.next, '<i class="ace-icon fa fa-angle-double-right"></i>') }}
											</li>
											{% endif %}
										</ul>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
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

		{{ assets.outputJs() }}
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				var $overflow = '';
				var colorbox_params = {
					rel: 'colorbox',
					reposition:true,
					scalePhotos:true,
					scrolling:false,
					previous:'<i class="ace-icon fa fa-arrow-left"></i>',
					next:'<i class="ace-icon fa fa-arrow-right"></i>',
					close:'&times;',
					current:'{current} of {total}',
					maxWidth:'100%',
					maxHeight:'100%',
					onOpen:function(){
						$overflow = document.body.style.overflow;
						document.body.style.overflow = 'hidden';
					},
					onClosed:function(){
						document.body.style.overflow = $overflow;
					},
					onComplete:function(){
						$.colorbox.resize();
					}
				};

				$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
				$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
			
			
				$(document).one('ajaxloadstart.page', function(e) {
					$('#colorbox, #cboxOverlay').remove();
			   	});
			})
		</script>
	</body>
</html>