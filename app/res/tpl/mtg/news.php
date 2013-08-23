<?php $_news = R::find('news', 'language = ? AND newscat_id = ? AND archived = ? AND online = 1 ORDER BY pubdatetime DESC', array('de', 1, 0)) ?>
<div class="sidebar news">
	<h2><?php echo I18n::__('mtg_news_h1') ?></h2>
	<?php if (empty($_news)): ?>
	    <p class="alert alert-info"><?php echo I18n::__('news_no_items_found') ?></p>
	<?php else: ?>
	    <?php foreach ($_news as $_news_id => $_news): ?>
	    <div class="news item">
			<?php if ($_news->name): ?>
			<h3><?php echo htmlspecialchars($_news->name) ?></h3>	
			<?php endif ?>
	        <?php echo Flight::textile($_news->teaser) ?>
			<?php if ($_news->content): ?>
			<a href="<?php echo Url::build('/news/%d', array($_news->getId())) ?>"><?php echo I18n::__('mtg_read_news') ?></a>
			<?php endif ?>
	    </div>
	    <?php endforeach ?>
	<?php endif ?>
</div>
