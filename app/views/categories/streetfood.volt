	<section class="main clearfix">
		{% for article in articles %}
		{% set imgLink = image('/uploaded/'~(article.intro is defined ? article.intro : 'default.png'), 'class': 'media', 'alt': article.title) %}
		{% 
			set divLink = '<div class="caption">
							<div class="work_title">
								<h1>'~article.title~'</h1>
							</div>
						</div>'
		%}
		{% set txtLink = imgLink~divLink %}
		<div class="work">
		{{ link_to('/'~article.slug~'-'~article.id, txtLink) }}
		</div>
		{% endfor %}
	</section><!-- end main -->
	{{ assets.outputJs() }}
	</body>
</html>