	<section class="main clearfix">
		<section class="top" style="background: url('/uploaded/{{ article.intro }}') no-repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-position: 50% 50%; background-attachment: fixed">
			<div class="wrapper content_header clearfix">
				<div class="work_nav">
				
					<ul class="btn clearfix">
						<li>{{ (pre_related is defined) ? link_to('/'~pre_related.slug~'-'~pre_related.id, '', 'data-title': 'Previous', 'class': 'previous') : '<a href="javascript:void(0)" class="previous" data-title="Previous"></a>' }}</li>
						<li>{{ link_to('/', '', 'class': 'grid', 'data-title': 'List Articles') }}</li>
						<li>{{ (next_related is defined) ? link_to('/'~next_related.slug~'-'~next_related.id, '', 'data-title': 'Next', 'class': 'next') : '<a href="javascript:void(0)" class="next" data-title="Next"></a>' }}</li>
					</ul>

				</div><!-- end work_nav -->
				<h1 class="title">{{ article.title }}</h1>
			</div>
		</section><!-- end top -->

		<section class="wrapper">
			<div class="content">
				{{ article.content }}
			</div><!-- end content -->
		</section>
	</section><!-- end main -->
	{{ assets.outputJs() }}
	</body>
</html>