<div class="sidebar">
    <div class="navscroll">
		<?php echo $domain->hierMenu('', Flight::get('language'), false, 'url', 'sequence ASC', true)->render() ?>
		<a
			id="scrolltop"
			href="#top"
			class="ir"
			title="<?php echo I18n::__('mtg_scroll_top_title') ?>">
			<?php echo I18n::__('mtg_scroll_top') ?>
		</a>
    </div>
</div>