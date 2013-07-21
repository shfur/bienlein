<?php
$_root = R::load('domain', 16);
?>
<?php echo $_root->hierMenu('/', Flight::get('language'))->render(array(
	'class' => 'sitemap'
)) ?>
