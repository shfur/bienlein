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
	<div id="account">
	<?php if ( ! $oxuser): ?>
		<h3><?php echo I18n::__('mtg_login_h3') ?></h3>
		<form
			id="login"
			method="post"
			action="/mtg/login"
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
			<a href="/mtg/logout"><?php echo I18n::__('mtg_logout_h3') ?></a>
		</h3>
		<p id="oxidaccount"><?php echo I18n::__('mth_account_welcome', $oxuser['name']) ?></p>
	<?php endif ?>
	</div>
</header>
