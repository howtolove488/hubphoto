	<section class="main clearfix">
		<?php foreach ($articles as $article) { ?>
		<?php $imgLink = $this->tag->image(['/uploaded/' . ((isset($article->intro) ? $article->intro : 'default.png')), 'class' => 'media', 'alt' => $article->title]); ?>
		<?php $divLink = '<div class="caption">
							<div class="work_title">
								<h1>' . $article->title . '</h1>
							</div>
						</div>'; ?>
		<?php $txtLink = $imgLink . $divLink; ?>
		<div class="work">
		<?= $this->tag->linkTo(['/' . $article->slug . '-' . $article->id, $txtLink]) ?>
		</div>
		<?php } ?>
	</section><!-- end main -->
	<?= $this->assets->outputJs() ?>
	</body>
</html>