<h2>Art der Kontaktaufnahme</h2>

<p><?php echo I18n::__('mtg_kind_'.$record->kind) ?></p>

<h2>Gruppe</h2>

<p><?php echo I18n::__('mtg_contact_grp_'.$record->grp) ?></p>

<p>Firma: <?php echo htmlspecialchars($record->organization) ?></p>

<p>Ansprechpartner: <?php echo htmlspecialchars($record->attendee) ?></p>

<p>E-Mail Adresse: <?php echo htmlspecialchars($record->email) ?></p>

<p>Strasse/Nr.: <?php echo htmlspecialchars($record->street) ?> <?php echo htmlspecialchars($record->streetno) ?></p>

<p>PLZ/Ort: <?php echo htmlspecialchars($record->zip) ?> <?php echo htmlspecialchars($record->city) ?></p>

<p>Telefon: <?php echo htmlspecialchars($record->phone) ?></p>
<p>Fax: <?php echo htmlspecialchars($record->fax) ?></p>

<p>Nachricht:<br />
<?php echo nl2br(htmlspecialchars($record->msg)) ?></p>
