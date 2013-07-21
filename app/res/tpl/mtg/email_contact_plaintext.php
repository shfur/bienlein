Art der Kontaktaufnahme:
<?php echo I18n::__('mtg_kind_'.$record->kind) ?>

Gruppe:
<?php echo I18n::__('mtg_contact_grp_'.$record->grp) ?>

Firma: <?php echo $record->organization ?>
Ansprechpartner: <?php echo $record->attendee ?>

E-Mail Adresse: <?php echo $record->email ?>

Strasse/Nr.: <?php echo $record->street ?> <?php echo $record->streetno ?>
PLZ/Ort: <?php echo $record->zip ?> <?php echo $record->city ?>

Telefon: <?php echo $record->phone ?>
Fax: <?php echo $record->fax ?>

Nachricht:
<?php echo $record->msg ?>
