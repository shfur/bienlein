<a
	class="close-details"
	href="#close"
	onclick="history.go(-1); return false;">
	<?php echo I18n::__('mtg_back_to_list') ?>
</a>
<div class="row">
	<div class="span6">
		<?php for ($i=1;$i<=12;$i++): ?>
			<?php if (isset($article['OXPIC'.$i]) && $article['OXPIC'.$i]): ?>
				<img
					src="<?php echo Flight::get('oxid_path_art').$article['OXPIC'.$i] ?>"
					alt="<?php echo htmlspecialchars($article['OXTITLE']) ?>"
					title=""
					width="100%"
					height="auto" />
			<?php endif ?>
		<?php endfor; ?>
	</div>
	<div class="span6 pdetails">
		
		<div class="row">
			<span class="span3 attr">
				<?php echo I18n::__('mtg_th_artno') ?>
			</span>
			<span class="span9 val">
				<?php echo htmlspecialchars($article['OXARTNUM']) ?>
			</span>
		</div>
		
		<div class="row">
			<span class="span3 attr">
				<?php echo I18n::__('mtg_th_product') ?>
			</span>
			<span class="span9 val">
				<?php echo ($article['OXTITLE']) ?>
			</span>
		</div>
		
		<div class="row">
			<span class="span3 attr">
				<?php echo I18n::__('mtg_th_package') ?>
			</span>
			<span class="span9 val">
				<?php echo ($attributes['Gebinde']) ?>
			</span>
		</div>
		
		<div class="row">
			<span class="span3 attr">
				<?php echo I18n::__('mtg_th_tgtk') ?>
			</span>
			<span class="span9 val">
				<?php echo htmlspecialchars($attributes['TG/TK']) ?>
			</span>
		</div>
		
		<div class="row">
			<span class="span3 attr">
				<?php echo I18n::__('mtg_th_manufacturer') ?>
			</span>
			<span class="span9 val">
				<?php echo htmlspecialchars($article['manu_title']) ?><br />
				<img
					src="<?php echo Flight::get('oxid_path_manu').$article['manu_icon'] ?>"
					alt="<?php echo htmlspecialchars($article['manu_title']) ?>"
					title=""
					width="90"
					height="auto" /><br />
				<?php echo htmlspecialchars($article['manu_shortdesc']) ?>
			</span>
		</div>
		
		<div class="row">
			<span class="span3 attr">
				<?php echo I18n::__('mtg_th_ls') ?>
			</span>
			<span class="span9 val ir avail avail-<?php echo $article['OXSTOCKFLAG'] ?>">
				<?php echo htmlspecialchars($article['OXSTOCKFLAG']) ?>
			</span>
		</div>
		
		<div class="row">
			<span class="attr">
				<?php echo I18n::__('mtg_th_shortdesc') ?>
			</span><br />
			<span class="val">
				<?php echo htmlspecialchars($article['OXSHORTDESC']) ?>
			</span>
		</div>
		
		<div class="row">
			<span class="attr">
				<?php echo I18n::__('mtg_th_longdesc') ?>
			</span><br />
			<span class="val">
				<?php echo htmlspecialchars($article['OXLONGDESC']) ?>
			</span>
		</div>
		
		<div class="row">
			<span class="attr">
				<?php echo I18n::__('mtg_th_mhd') ?>
			</span>
			<span class="val">
				<?php echo htmlspecialchars($attributes['Mindesthaltbarkeit']) ?>
			</span>
		</div>
		
		<?php $preps = explode(' ** ', $attributes['Zubereitung']) ?>
		
		<div class="row">
			<span class="attr">
				<?php echo I18n::__('mtg_th_preparation') ?>
			</span><br />
			<span class="val">
				<?php foreach ($preps as $prep): ?>
					<?php echo Flight::textile($prep) ?>
				<?php endforeach ?>
			</span>
		</div>
		
	</div>
</div>