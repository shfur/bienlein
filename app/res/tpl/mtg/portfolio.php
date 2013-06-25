<div class="sidebar">
    <div class="navscroll">
		<ul>
			<?php foreach ($categories as $n => $category): ?>
			<li>
				<a href="#cat-<?php echo $category['OXID'] ?>"><?php echo htmlspecialchars($category['OXTITLE']) ?></a>
			</li>
			<?php endforeach ?>
		</ul>
    </div>
</div>