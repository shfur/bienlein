<a
	class="close-details"
	href="#close"
	onclick="history.go(-1); return false;">
	<?php echo I18n::__('mtg_back_to_list') ?>
</a>
<h1><?php echo htmlspecialchars($news->name) ?></h1>
<?php echo Flight::textile($news->teaser) ?>
<?php echo Flight::textile($news->content) ?>
