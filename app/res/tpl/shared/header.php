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
<header>
	<h1>
		<a
		    class="ir logo"
			href="<?php echo Url::build('/') ?>"
			title="<?php echo I18n::__('app_name') ?> <?php echo I18n::__('app_claim') ?>">
			<?php echo I18n::__('app_name') ?>
		</a>
	</h1>
	<h2 class="visuallyhidden"><?php echo I18n::__('app_claim') ?></h2>
	<?php echo $navigation ?>
</header>
