<div class="sidebar">
    <div class="navscroll">
		<input
			type="search"
			id="q"
			name="q"
			value=""
			placeholder="<?php echo I18n::__('mtg_q_placeholder') ?>" />
		<ul>
			<?php foreach ($categories as $n => $category): ?>
			<li>
				<a href="#cat-<?php echo $category['OXID'] ?>"><?php echo htmlspecialchars($category['OXTITLE']) ?></a>
			</li>
			<?php endforeach ?>
		</ul>
		<a
			id="scrolltop"
			href="#top"
			class="ir">
			<?php echo I18n::__('mtg_scroll_top') ?>
		</a>
    </div>
</div>