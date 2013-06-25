<header class="clearfix master">
    <hgroup>
        <h1><a class="ir" href="/">MTG</a></h1>
        <h2 class="visuallyhidden">MTG Selecting Food</h2>
    </hgroup>
    <nav>
		<?php echo $root->hierMenu('/', Flight::get('language'))->render(array(
			'class' => 'main'
		)) ?>
    </nav>
    <nav>
		<?php echo $extra->hierMenu('/', Flight::get('language'))->render(array(
			'class' => 'secondary'
		)) ?>
    </nav>
</header>
