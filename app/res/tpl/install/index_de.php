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
<!-- Install de -->
<article>
    <header>
		<h1>Installation</h1>
    </header>
    <form
        id="form-install"
        class="panel install"
        method="POST"
        action="?"
        accept-charset="utf-8">
        <div>
            <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
            <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
            <input type="hidden" name="dialog[isadmin]" value="1" />
        </div>
        <fieldset>
            <legend>Installationskennwort</legend>
            <div
                class="row">
                <label
                    for="install-pass">
                    Installationscode
                </label>
                <input
                    type="password"
                    id="install-pass"
                    name="pass"
                    required="required"
                    autofocus="autofocus" />
            </div>
        </fieldset>
        <fieldset>
            <legend>Verwalterkonto</legend>
            <div
                class="row<?php echo $record->hasError('email') ? ' error' : '' ?>">
                <label
                    for="install-email">
                    E-Mail
                </label>
                <input
                    type="email"
                    id="install-email"
                    name="dialog[email]"
                    placeholder="vorname.nachname@example.com"
                    value="<?php echo htmlspecialchars($record->email) ?>"
                    required="required" />
            </div>
            <div
                class="row<?php echo $record->hasError('name') ? ' error' : '' ?>">
                <label
                    for="install-name">
                    Name
                </label>
                <input
                    type="text"
                    id="install-name"
                    name="dialog[name]"
                    placeholder="Vor- und Nachname"
                    value="<?php echo htmlspecialchars($record->name) ?>"
                    required="required" />
            </div>
            <div
                class="row<?php echo $record->hasError('shortname') ? ' error' : '' ?>">
                <label
                    for="install-shortname">
                    Kurzname
                </label>
                <input
                    type="text"
                    id="install-shortname"
                    name="dialog[shortname]"
                    placeholder="Admin"
                    value="<?php echo htmlspecialchars($record->shortname) ?>"
                    required="required" />
            </div>
            <div
                class="row<?php echo $record->hasError('pw') ? ' error' : '' ?>">
                <label
                    for="install-pw">
                    Kennwort
                </label>
                <input
                    type="password"
                    id="install-pw"
                    name="dialog[pw]"
                    value=""
                    required="required" />
            </div>
        </fieldset>
        <div class="buttons">
            <input type="submit" name="submit" value="Installation beginnen" />
        </div>
    </form>
</article>
<!-- End of Install -->
