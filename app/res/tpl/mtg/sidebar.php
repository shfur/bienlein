<div class="sidebar">
    <div class="navscroll">
		<?php echo $domain->hierMenu('', Flight::get('language'))->render() ?>
		<a
			id="scrolltop"
			href="#top"
			class="ir"
			title="<?php echo I18n::__('mtg_scroll_top_title') ?>">
			<?php echo I18n::__('mtg_scroll_top') ?>
		</a>
    </div>
</div>