<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class PasswordresetForm extends CFormModel
{
	public $oldpassword;
	public $newpassword;
	public $retype;
	public $verifyCode;
	
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('oldpassword, newpassword, retype', 'required'),
			array('oldpassword, newpassword, retype', 'length', 'max'=>32, 'min'=>6),
			array('newpassword', 'compare', 'compareAttribute'=>'retype'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'oldpassword'=>'Old Password',
			'newpassword'=>'New Password',
			'Retype'=>'Retype Password',
		);
	}
}