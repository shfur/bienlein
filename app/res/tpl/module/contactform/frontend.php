<?php
$grps = array(
	'distributor' => I18n::__('mtg_contact_grp_distributor'),
	'industry' => I18n::__('mtg_contact_grp_industry'),
	'gastronomy' => I18n::__('mtg_contact_grp_gastronomy'),
	'hotel' => I18n::__('mtg_contact_grp_hotel'),
	'catering' => I18n::__('mtg_contact_grp_catering')
);
if (Flight::request()->method == 'POST'):
	try {
		$record = R::graph(Flight::request()->data->dialog, true);
		R::store($record);
		if ($record->mail()) {
			error_log('Mail was send');
			//say thanks and do not show form again.
			//better redirect to somewhere?
		}
	} catch (Exception $e) {
		//error
	}
else:
	$record = R::dispense('contact');
endif
?>
<form
	id="contact"
	method="POST"
	action=""
	accept-charset="utf-8">
	<div>
		<input
			type="hidden"
			name="dialog[type]"
			value="<?php echo $record->getMeta('type') ?>" />
		<input
			type="hidden"
			name="dialog[id]"
			value="<?php echo $record->getId() ?>" />
	</div>
	<fieldset>
		<legend><?php echo I18n::__('mtg_contact_legend_kind') ?></legend>
		<div class="row <?php echo $record->hasError('kind') ? 'error' : '' ?>">
			<input
				type="radio"
				name="dialog[kind]"
				value="prospect"
				<?php echo ($record->kind == 'prospect') ? 'checked="checked"' : '' ?> />
			<label
				for="kind-prospect">
				<?php echo I18n::__('mtg_kind_prospect') ?>
			</label>
			<br />
			<input
				type="radio"
				name="dialog[kind]"
				value="customer"
				<?php echo ($record->kind == 'customer') ? 'checked="checked"' : '' ?> />
			<label><?php echo I18n::__('mtg_kind_customer') ?></label>
		</div>
	</fieldset>
	<fieldset>
		<legend><?php echo I18n::__('mtg_contact_legend_grp') ?></legend>
		<div class="row <?php echo $record->hasError('grp') ? 'error' : '' ?>">
			<div class="span3">
				<label for="contact-group"><?php echo I18n::__('mtg_contact_grp_label') ?></label>
			</div>
			<div class="span9">
				<select
					id="contact-group"
					name="dialog[grp]">
					<?php foreach ($grps as $_grp_val => $_grp_option): ?>
					<option
						value="<?php echo $_grp_val ?>"
						<?php echo $record->grp == $_grp_val ? 'selected="selected"' : '' ?>>
						<?php echo $_grp_option ?>
					</option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
	</fieldset>
	<fieldset>
		<legend><?php echo I18n::__('mtg_contact_legend_person') ?></legend>
		<div class="row <?php echo $record->hasError('organization') ? 'error' : '' ?>">
			<div class="span3">
				<label for="contact-organization"><?php echo I18n::__('mtg_contact_organization_label') ?></label>
			</div>
			<div class="span9">
				<input
					id="contact-organization"
					type="text"
					name="dialog[organization]"
					value="<?php echo htmlspecialchars($record->organization) ?>" />
			</div>
		</div>
		<div class="row <?php echo $record->hasError('attendee') ? 'error' : '' ?>">
			<div class="span3">
				<label for="contact-attendee"><?php echo I18n::__('mtg_contact_attendee_label') ?></label>
			</div>
			<div class="span9">
				<input
					id="contact-attendee"
					type="text"
					name="dialog[attendee]"
					value="<?php echo htmlspecialchars($record->attendee) ?>" />
			</div>
		</div>
		<div class="row <?php echo $record->hasError('email') ? 'error' : '' ?>">
			<div class="span3">
				<label for="contact-email"><?php echo I18n::__('mtg_contact_email_label') ?></label>
			</div>
			<div class="span9">
				<input
					id="contact-email"
					type="email"
					name="dialog[email]"
					value="<?php echo htmlspecialchars($record->email) ?>" />
			</div>
		</div>
		<div class="row <?php echo $record->hasError('street') ? 'error' : '' ?>">
			<div class="span3">
				<label for="contact-address"><?php echo I18n::__('mtg_contact_street_label') ?></label>
			</div>
			<div class="span6">
				<input
					id="contact-street"
					type="text"
					name="dialog[street]"
					value="<?php echo htmlspecialchars($record->street) ?>" />
			</div>
			<div class="span3">
				<input
					id="contact-streetno"
					type="text"
					name="dialog[streetno]"
					value="<?php echo htmlspecialchars($record->streetno) ?>" />
			</div>
		</div>
		<div class="row <?php echo $record->hasError('zip') || $record->hasError('city') ? 'error' : '' ?>">
			<div class="span3">
				<label for="contact-city"><?php echo I18n::__('mtg_contact_city_label') ?></label>
			</div>
			<div class="span3">
				<input
					id="contact-zip"
					type="text"
					name="dialog[zip]"
					value="<?php echo htmlspecialchars($record->zip) ?>" />
			</div>
			<div class="span6">
				<input
					id="contact-city"
					type="text"
					name="dialog[city]"
					value="<?php echo htmlspecialchars($record->city) ?>" />
			</div>
		</div>
		<div class="row <?php echo $record->hasError('phone') ? 'error' : '' ?>">
			<div class="span3">
				<label for="contact-phone"><?php echo I18n::__('mtg_contact_phone_label') ?></label>
			</div>
			<div class="span9">
				<input
					id="contact-phone"
					type="phone"
					name="dialog[phone]"
					value="<?php echo htmlspecialchars($record->phone) ?>" />
			</div>
		</div>
		<div class="row <?php echo $record->hasError('fax') ? 'error' : '' ?>">
			<div class="span3">
				<label for="contact-fax"><?php echo I18n::__('mtg_contact_fax_label') ?></label>
			</div>
			<div class="span9">
				<input
					id="contact-fax"
					type="phone"
					name="dialog[fax]"
					value="<?php echo htmlspecialchars($record->fax) ?>" />
			</div>
		</div>
		<div class="row <?php echo $record->hasError('msg') ? 'error' : '' ?>">
			<div class="span3">
				<label for="contact-msg"><?php echo I18n::__('mtg_contact_msg_label') ?></label>
			</div>
			<div class="span9">
				<textarea
					id="contact-msg"
					name="dialog[msg]"
					rows="5"
					cols="60"><?php echo htmlspecialchars($record->msg) ?></textarea>
			</div>
		</div>
	</fieldset>
	<p class="contact-required-info"><?php echo I18n::__('mtg_contact_required_fields') ?></p>
	<div class="buttons">
		<input
			type="submit"
			name="submit"
			value="<?php echo I18n::__('mtg_contact_submit') ?>" />
	</div
</form>
