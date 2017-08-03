								<!-- PAGE CONTENT BEGINS -->
								<h4 class="header green clearfix">
									List Articles
								</h4>

								{{ flashSession.output() }}

								<div>
									<div class="row search-page" id="search-page-2">
										<div class="col-xs-12 col-md-10 col-md-offset-1">
											<div class="search-area no-margin-bottom">
												<form method="GET">
													<div class="row">
														<div class="col-md-12">
															<div class="input-group">
																<input type="text" class="form-control" id="management-search-articles" name="search" placeholder="Type key word to search..." />
																<div class="input-group-btn">
																	<button type="submit" class="btn btn-primary btn-sm">
																		<i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
																	</button>
																</div>
															</div>
														</div>
													</div>
												</form>
												<div class="space space-6"></div>
												{% if search_result is defined %}
													<span class="grey">About {{ count_result }} results be found </span>
												{% else %}
													<span class="grey">{{ count_result }} articles be show and paginator below !</span>
												{% endif %}
												<div class="hide search-results-by-type" id="search-results-by-type">
													<h4>4 results be found !</h4>
													<dl class="item-search-result">
														<dt><a href="#">Description lists</a></dt>
														<dd><a href="#" class="text-success">http://hubphoto.io/module-trong-nodejs-viet-mot-lan-thoi</a></dd>
													</dl>
													<dl class="item-search-result">
														<dt><a href="#">Description lists</a></dt>
														<dd><a href="#" class="text-success">http://hubphoto.io/module-trong-nodejs-viet-mot-lan-thoi</a></dd>
													</dl>
													<dl class="item-search-result">
														<dt><a href="#">Description lists</a></dt>
														<dd><a href="#" class="text-success">http://hubphoto.io/module-trong-nodejs-viet-mot-lan-thoi</a></dd>
													</dl>
												</div>
											</div>
											{% set list = page.items %}
											{% for item in list %}						
											<div class="search-results">
												<div class="search-result">
													<h5 class="search-title">
														{{ link_to('/'~item.slug~'-'~item.id, item.title) }}
														<ul class="pull-right group-tools-article">
															<li><i class="fa fa-calendar"></i> {{ date('d-m-Y', item.updated_at) }}</li>
															<li> {{ link_to('/management/list-articles/'~item.id, "Edit") }} </li>
															<li><a href="#"> Delete </a></li>
														</ul>
													</h5>
													{{ link_to('/'~item.slug, 'http://hubphoto.io/'~item.slug~'-'~item.id, 'class': 'text-success') }}

													<p class="search-content">
														{{ item.description }}
													</p>
												</div>
											</div>
											{% endfor %}
											<div class="search-area text-center">
												{# SET URI FOR SEARCH OR NOT #}
												{# USE THIS URI TO HANDLE PAGE #}
												{% set relative_uri = (search_result is defined)?'/management/list-articles?search='~search_result~'&page=' : '/management/list-articles?page=' %}

												<ul class="pagination">
													<!-- 10 is number each page -->
													{% set total_page = page.total_pages %}

													{% if page.current <= 1 %}
													<li class="disabled">
														<a href="javascript:void(0)"><i class="ace-icon fa fa-angle-double-left"></i></a>
													</li>
													{% else %}
													<li>
														{{ link_to(relative_uri~page.before, '<i class="ace-icon fa fa-angle-double-left"></i>') }}
													</li>
													{% endif %}

													{% set thought_page=1 %}
													{% for thought_page in 1..total_page %}
														{% if page.current is thought_page %}
														<li class="active">
															{{ link_to(relative_uri~page.current, page.current ) }}
														</li>
														{% else %}
														<li>
															{{ link_to(relative_uri~thought_page, thought_page ) }}
														</li>
														{% endif %}
													{% endfor %}

													{% if page.current >= total_page %}
													<li class="disabled">
														<a href="javascript:void(0)"><i class="ace-icon fa fa-angle-double-right"></i></a>
													</li>
													{% else %}
													<li>
														{{ link_to(relative_uri~page.next, '<i class="ace-icon fa fa-angle-double-right"></i>') }}
													</li>
													{% endif %}
												</ul>
											</div>
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
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
	</body>
</html>
