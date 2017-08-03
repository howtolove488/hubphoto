<!DOCTYPE html>
<html lang="en">
<head>
	<?= $this->tag->getTitle() ?>
	<meta charset="utf-8">
	<meta name="author" content="pixelhint.com">
	<meta name="description" content="hubphoto là website trình bày ảnh game và comic"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script|Courgette|Lobster|Satisfy" rel="stylesheet">
	
	<?= $this->assets->outputCss() ?>
	<!-- Css admin page -->
</head>
<body>
	<?= $this->getContent() ?>
	
