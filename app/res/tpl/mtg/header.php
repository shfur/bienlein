<header class="clearfix master">
        <h1><a class="ir" href="/">MTG</a></h1>
        <h2 class="visuallyhidden">MTG Selecting Food</h2>
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
	<nav>
		<ul class="language">
			<?php if (Flight::get('language') == Flight::get('default_language')): ?>
			<li><a href="/en/"><?php echo I18n::__('mtg_lng_en') ?></a></li>
			<?php else: ?>
			<li><a href="/"><?php echo I18n::__('mtg_lng_de') ?></a></li>
			<?php endif ?>
		</ul>
	</nav>
	<div id="account">
	<?php if ( ! $oxuser): ?>
		<h3><?php echo I18n::__('mtg_login_h3') ?></h3>
		<form
			id="login"
			method="post"
			action="<?php echo Url::build('/mtg/login') ?>"
			accept-charset="utf-8">
			<div>
				<input type="hidden" name="goto" value="<?php echo htmlspecialchars(Flight::request()->url) ?>" />
			</div>
			<fieldset>
				<legend><?php echo I18n::__('mtg_login_legend') ?></legend>
				<div class="row">
					<input
						type="text"
						id="mtg-uname"
						name="uname"
						placeholder="<?php echo I18n::__('mtg_uname_placeholder') ?>"
						value="" />
					<input
						type="password"
						id="mtg-pw"
						name="pw"
						value="" />						
					<input
						id="submit"
						type="submit"
						class="ir"
						name="submit"
						value="submit" />
				</div>
			</fieldset>
		</form>
	<?php else: ?>
		<h3>
			<a href="<?php echo Url::build('/mtg/logout') ?>"><?php echo I18n::__('mtg_logout_h3') ?></a>
		</h3>
		<p id="oxidaccount"><?php echo I18n::__('mtg_account_welcome', null, array($oxuser['name'])) ?></p>
	<?php endif ?>
	</div>
</header>
