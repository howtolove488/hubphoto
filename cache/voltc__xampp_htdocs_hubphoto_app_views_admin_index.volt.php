								<!-- PAGE CONTENT BEGINS -->
								<div class="alert alert-block alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>

									<i class="ace-icon fa fa-check green"></i>

									Welcome to
									<strong class="green">
										Hubphoto.io Management
										<small>(v0.1)</small>
									</strong>, Sumary traffic once month
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="widget-box">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller">
													<i class="ace-icon fa fa-comment blue"></i>
													Recent work
												</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													
													<div class="dialogs">
														<?php foreach ($recent_work as $work) { ?>
														<div class="itemdiv dialogdiv">
															<div class="user">
																<?= $this->tag->image(['/img/avatar5.png', 'alt' => 'Tadashi same s avatar']) ?>
															</div>

															<div class="body">
																<div class="time">
																	<i class="ace-icon fa fa-clock-o"></i>
																	<span class="green"><?= date('d/m', $work->updated_at) ?></span>
																</div>

																<div class="name">
																	<a href="#">Tadashi same</a> posted on <b class="red"><?= $work->category ?></b>:
																</div>
																<div class="text"><?= $work->title ?></div>

																<div class="tools">
																	<?= $this->tag->linkTo(['/management/list-articles/' . $work->id, '<i class="icon-only ace-icon fa fa-share"></i>', 'class' => 'btn btn-minier btn-info', 'title' => 'Edit this']) ?>
																</div>
															</div>
														</div>
														<?php } ?>
														<div class="itemdiv dialogdiv">
															<div class="user">
																<?= $this->tag->image(['/img/avatar5.png', 'alt' => 'Tadashi same s avatar']) ?>
															</div>

															<div class="body">
																<div class="name">
																	<a href="#">Tadashi same</a> posted:
																</div>
																<div class="text"><?= $count_record - 5 ?> more</div>
															</div>
														</div>
													</div>
													
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->

									<div class="vspace-12-sm"></div>

									<div class="col-sm-6">
										<div class="widget-box">
											<div class="widget-header widget-header-flat widget-header-small">
												<h5 class="widget-title">
													<i class="ace-icon fa fa-signal"></i>
													Traffic Sources
												</h5>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<div id="piechart-placeholder"></div>

													<div class="hide sources-data">
														<div id="do-uong"><?= round(($count_cate_du / $count_record) * 100, 2) ?></div>
														<div id="mon-an-vat"><?= round(($count_cate_du / $count_record) * 100, 2) ?></div>
														<div id="mon-an-gia-dinh"><?= round(($count_cate_magd / $count_record) * 100, 2) ?></div>
														<div id="mon-an-theo-mua"><?= round(($count_cate_matm / $count_record) * 100, 2) ?></div>
														<div id="dac-san-vung-mien"><?= round(($count_cate_dsvm / $count_record) * 100, 2) ?></div>
														<div id="streetfood"><?= round(($count_cate_sf / $count_record) * 100, 2) ?></div>
													</div>

													<div class="hr hr8 hr-double"></div>

													<div class="clearfix">
														<div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-facebook-square fa-2x blue"></i>
																&nbsp; likes
															</span>
															<h4 class="bigger pull-right">55</h4>
														</div>

														<div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-twitter-square fa-2x purple"></i>
																&nbsp; tweets
															</span>
															<h4 class="bigger pull-right">0</h4>
														</div>

														<div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-pinterest-square fa-2x red"></i>
																&nbsp; pins
															</span>
															<h4 class="bigger pull-right">0</h4>
														</div>
													</div>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title lighter">
													<i class="ace-icon fa fa-star orange"></i>
													Popular Post
												</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom">
															<tr>
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>Title
																</th>

																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>View
																</th>

																<th class="hidden-480">
																	<i class="ace-icon fa fa-caret-right blue"></i>Status
																</th>
															</tr>
														</thead>

														<tbody>
															<?php foreach ($popular_post as $post) { ?>
															<tr>
																<td><?= $post->title ?></td>

																<td>
																	<b class="blue"><?= $post->total ?></b>
																</td>

																<td class="hidden-480">
																	<span class="label label-success arrowed-in arrowed-in-right"><?= $post->tag ?></span>
																</td>
															</tr>
															<?php } ?>
														</tbody>
													</table>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->
								</div><!-- /.row -->
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
			jQuery(function($) {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: ace.vars['old_ie'] ? false : 1000,
						size: size
					});
				})			
			
			  //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  //but sometimes it brings up errors with normal resize event handlers
			  $.resize.throttleWindow = false;
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var sources_data = {du: parseInt($('#do-uong').text()), mav: parseInt($('#mon-an-vat').text()), matm: parseInt($('#mon-an-theo-mua').text()), magd: parseInt($('#mon-an-gia-dinh').text()), dsvm: parseInt($('#dac-san-vung-mien').text()), sf: parseInt($('#streetfood').text()), }
			  var data = [
				{ label: "Đồ uống",  data: sources_data['du'], color: "#68BC31"},
				{ label: "Món ăn vặt",  data: sources_data['mav'], color: "#2091CF"},
				{ label: "Món ăn gia đình",  data: sources_data['magd'], color: "#FEE074"},
				{ label: "Món ăn theo mùa",  data: sources_data['matm'], color: "#3C763D"},
				{ label: "Đặc sản",  data: sources_data['dsvm'], color: "#AF4E96"},
				{ label: "Streetfood",  data: sources_data['sf'], color: "#DA5430"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;			
			})
		</script>
	</body>
</html>
