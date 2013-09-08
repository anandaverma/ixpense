<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class RangeForm extends CFormModel
{
	public $fromdate;
	public $todate;
	

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('fromdate, todate', 'required'),
			array('todate','compare','compareAttribute'=>'fromdate','operator'=>'>=', 'allowEmpty'=>false , 'message'=>'{attribute} must be greater than {compareValue}.',),
			
			
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
			'fromdate'=>'From Date',
			'todate'=>'To Date'
		);
	}
}