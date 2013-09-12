<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Model
 * @author $Author$
 * @version $Id$
 */

/**
 * Contact model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Contact extends Model
{
	/**
	 * The email address to send contacts to.
	 */
	const TO_EMAILADDRESS = 'info@sah-company.com';

	/**
	 * The name of the email address to send contacts to.
	 */
	const TO_EMAILADDRESS_NAME = 'MTG Food Trading';

    /**
     * Dispense.
     */
    public function dispense()
    {
		$this->kind = 'prospect';
		$this->addValidator('kind', new Validator_HasValue());
		$this->addValidator('organization', new Validator_HasValue());
		$this->addValidator('attendee', new Validator_HasValue());
		$this->addValidator('email', new Validator_IsEmail());
		$this->addValidator('phone', new Validator_HasValue());
    }
	
	/**
	 * Send as email to webmaster.
	 *
	 * @return bool wether the mail was send or not
	 */
	public function mail()
	{
		require_once '../src/lib/PHPMailer-master/class.phpmailer.php';
		//render plain
		ob_start();
		Flight::render('mtg/email_contact_plaintext', array('record' => $this->bean));
		$plaintext = ob_get_contents();
		ob_end_clean();
		//render html
		ob_start();
		Flight::render('mtg/email_contact_html', array('record' => $this->bean));
		$html = ob_get_contents();
		ob_end_clean();
		//build the mail
		$mail = new PHPMailer();
		$mail->CharSet = 'UTF-8';
		$mail->isHTML(true);
		$mail->From = self::TO_EMAILADDRESS;
		$mail->FromName = self::TO_EMAILADDRESS_NAME;
		$mail->AddAddress(self::TO_EMAILADDRESS, self::TO_EMAILADDRESS_NAME);
		//$mail->AddAddress($this->bean->email, $this->bean->attendee);
		$mail->AddReplyTo(self::TO_EMAILADDRESS, self::TO_EMAILADDRESS_NAME);
		$mail->Subject = I18n::__('mtg_contact_mail_subject');
		$mail->Body = $html;
		$mail->AltBody = $plaintext;
		return $mail->Send();
	}
}
