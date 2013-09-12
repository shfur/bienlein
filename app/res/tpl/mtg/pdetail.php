<a
	class="close-details"
	href="#close"
	onclick="history.go(-1); return false;">
	<?php echo I18n::__('mtg_back_to_list') ?>
</a>
<div class="row details-divider">
	<div class="span6 pimages">
		<?php for ($i=1;$i<=12;$i++): ?>
			<?php if (isset($article['OXPIC'.$i]) && $article['OXPIC'.$i]): ?>
				<img
					src="<?php echo Flight::get('oxid_path_pics').$i.'/'.$article['OXPIC'.$i] ?>"
					alt="<?php echo htmlspecialchars($article['OXTITLE']) ?>"
					title=""
					width="95%" />
			<?php endif ?>
		<?php endfor; ?>
	</div>
	<div class="span6 pdetails">
		
		<div class="row">
			<h1 class="span12">
				<?php echo ($article['OXTITLE']) ?>
			</h1>
		</div>
		
		<div class="row">
			<span class="span4 attr">
				<?php echo I18n::__('mtg_th_artno') ?>
			</span>
			<span class="span8 val">
				<?php echo htmlspecialchars($article['OXARTNUM']) ?>
			</span>
		</div>
		
		<div class="row">
			<span class="span4 attr">
				<?php echo I18n::__('mtg_th_category') ?>
			</span>
			<span class="span8 val">
				<?php echo ($article['cat_title']) ?>
			</span>
		</div>
		
		<?php if (isset($attributes['Gebinde'])): ?>
		<div class="row">
			<span class="span4 attr">
				<?php echo I18n::__('mtg_th_package') ?>
			</span>
			<span class="span8 val">
				<?php echo ($attributes['Gebinde']) ?>
			</span>
		</div>
		<?php endif ?>
		
		<?php if (isset($attributes['TG/TK'])): ?>
		<div class="row">
			<span class="span4 attr">
				<?php echo I18n::__('mtg_th_tgtk') ?>
			</span>
			<span class="span8 val">
				<?php echo htmlspecialchars($attributes['TG/TK']) ?>
			</span>
		</div>
		<?php endif ?>
		
		<div class="row">
			<span class="span4 attr">
				<?php echo I18n::__('mtg_th_manufacturer') ?>
			</span>
			<span class="span8 val">
				<?php echo htmlspecialchars($article['manu_title']) ?><br />
				<img
					src="<?php echo Flight::get('oxid_path_manu').$article['manu_icon'] ?>"
					alt="<?php echo htmlspecialchars($article['manu_title']) ?>"
					title=""
					width="90" />
			</span>
		</div>
		
		<div class="row">
			<span class="span4 attr">
				<?php echo I18n::__('mtg_pdetail_th_ls') ?>
			</span>
			<span
				class="span8 val ir avail avail-<?php echo $article['OXSTOCKFLAG'] ?>"
				title="<?php echo I18n::__('mtg_avail_'.$article['OXSTOCKFLAG']) ?>">
				<?php echo htmlspecialchars($article['OXSTOCKFLAG']) ?>
			</span>
		</div>
		
		<?php if (isset($attributes['Mindesthaltbarkeit'])): ?>
		<div class="row">
			<span class="span4 attr">
				<?php echo I18n::__('mtg_th_mhd') ?>
			</span>
			<span class="span8 val">
				<?php echo htmlspecialchars($attributes['Mindesthaltbarkeit']) ?>
			</span>
		</div>
		<?php endif ?>
		
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
			<p class="val">
				<?php echo ($article['OXLONGDESC']) ?>
			</p>
		</div>
		
		
		<?php $preps = array('Backofen', 'Konvektomat', 'Friteuse', 'Mikrowelle') ?>
		<?php if (isset($attributes['Zub-Backofen']) || isset($attributes['Zub-Konvektomat']) || isset($attributes['Zub-Friteuse']) || isset($attributes['Zub-Mikrowelle'])): ?>
			
			<div class="row">
				<span class="attr">
					<?php echo I18n::__('mtg_th_preparation') ?>
				</span><br />
				<span class="val">
					<?php foreach ($preps as $prep): ?>
						<?php $prep_name = 'Zub-'.$prep ?>
						<?php if (isset($attributes[$prep_name])): ?>
						<p title="<?php echo I18n::__('mtg_zubereitung_title_'.strtolower($prep)) ?>" class="tips-zub zub <?php echo strtolower($prep) ?>">
							<?php echo $attributes[$prep_name] ?>
						</p>
						<?php endif ?>
					<?php endforeach ?>
				</span>
			</div>
			
		<?php endif ?>
		
		
		<?php if ( ! empty($files)): ?>
			<div class="row">
				<span class="attr"><?php echo I18n::__('mtg_th_downloads') ?></span><br />
				<span class="val">
			<?php $i = 0 ?>
			<?php foreach ($files as $n => $file): ?>
			<?php $i++ ?>
				<a href="/mtg/download/?file=<?php echo urlencode($file['OXFILENAME']) ?>"><?php echo $file['OXFILENAME'] ?></a><br />
			<?php endforeach ?>
				</span>
			</div>
		<?php endif ?>
	</div>
</div>