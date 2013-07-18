<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html lang="<?php echo $language ?>" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html lang="<?php echo $language ?>" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html lang="<?php echo $language ?>" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="<?php echo $language ?>" class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title><?php echo $title ?></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">

		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <!--<link rel="stylesheet" href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>-->
		<link rel="stylesheet" type="text/css" href="/css/MyFontsWebfontsKit.css">
		<link rel="stylesheet" href="/css/mtg.css">
		<!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <![endif]-->
	</head>

	<body id="<?php echo $page_id ?>">
		<!--[if lt IE 7]>
		<?php echo Flight::textile(I18n::__('browser_is_ancient')) ?>
		<![endif]-->

		<div class="wrapper">
			
			<?php echo isset($header) ? $header : '' ?>
			
			<?php if ($page_id != 'home'): ?>
			<div id="people-slider-container">
			<div id="people-slider">
				<ul class="bjqs">
					<?php for ($i=1; $i<12; $i++): ?>
					<li>
						<img
							src="/img/mtg/mtg-header-slider-<?php echo $i ?>.jpg"
							alt=""
							width="1000"
							height="350" />
					</li>
					<?php endfor;
					?>
				</ul>
			</div>
			</div>
			<?php endif ?>
			
			<?php if (isset($_SESSION['msg'])): ?>
			<div class="alert alert-error">
				<?php echo $_SESSION['msg'] ?>
				<?php unset($_SESSION['msg']) ?>
			</div>
			<?php endif ?>
			
			<div class="main clearfix">
				
				<?php echo isset($sidebar) ? $sidebar : '' ?>
				
				<div class="content">
			        <!-- Content (required) -->
					<?php echo $content; ?>
					<!-- End of required content -->
				</div>
				
			</div>
		</div>
		
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="/js/mtg.js"></script>
		<script src="/js/jquery.scrollTo-1.4.3.1-min.js"></script>
		<script src="/js/bjqs-1.3.min.js"></script>
	</body>
</html>
