<div class="form">

<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'stacked'=>true, // should this be a stacked form?
    'errorMessageType'=>'inline', // how to display errors, inline or block?
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?>
                <br />
		<span class="label notice">Hint:</span><span style="color: #736F6E;"> Varun, Varun.Kumar, Varun_kumar, Varun123</span>
		
	</div>
        <br />
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password2'); ?>
		<?php echo $form->passwordField($model,'password2',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'password2'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'phone'); ?>
                <br />
		<span class="label notice">Hint:</span><span style="color: #736F6E;"> 9898989898</span>
	</div>
        <br />
	<div class="row">
		<?php echo $form->labelEx($model,'usercurrency'); ?>
		<?php echo $form->dropDownList($model,'usercurrency', array('USD'=>'USD', 'INR'=>'INR', 'EUR'=>'EUR', 'GBP'=>'GBP', 'AUD'=>'AUD', 'CAD'=>'CAD', 'JPY'=>'JPY', 'AED'=>'AED', 'AFN'=>'AFN' , 'ALL'=>'ALL', 'AMD'=>'AMD', 'ANG'=>'ANG', 'AOA'=>'AOA', 'ARS'=>'ARS', 'AWG'=>'AWG', 'AZN'=>'AZN','BAN'=>'BAN', 'BBD'=>'BBD', 'BDT'=>'BDT', 'BGN'=>'BGN', 'BHD'=>'BHD', 'BIF'=>'BIF', 'BMD'=>'BMD', 'BND'=>'BND', 'BOB'=>'BOB', 'BRL'=>'BRL', 'BSD'=>'BSD', 'BTN'=>'BTN', 'BWP'=>'BWP', 'BYR'=>'BYR', 'BZD'=>'BZD', 'CDF'=>'CDF', 'CHF'=>'CHF', 'CLP'=>'CLP', 'CNY'=>'CNY', 'COP'=>'COP', 'CRC'=>'CRC', 'CUC'=>'CUC', 'CUP'=>'CUP', 'CVE'=>'CVE', 'CZK'=>'CZK', 'DKK'=>'DKK', 'DOP'=>'DOP', 'DZD'=>'DZD', 'EGP'=>'EGP', 'ERN'=>'ERN', 'ETB'=>'ETB', 'FJD'=>'FJD', 'FKP'=>'FKP', 'GEL'=>'GEL', 'GGP'=>'GGP', 'GHS'=>'GHS', 'GIP'=>'GIP', 'GMD'=>'GMD', 'GNF'=>'GNF', 'GTQ'=>'GTQ', 'GYD'=>'GYD', 'HKD'=>'HKD', 'HNL'=>'HNL', 'HRK'=>'HRK', 'HTG'=>'HTG', 'HUF'=>'HUF', 'IDR'=>'IDR', 'ILS'=>'ILS', 'IMP'=>'IMP', 'IQD'=>'IQD', 'IRR'=>'IRR', 'ISK'=>'ISK', 'JEP'=>'JEP', 'JMD'=>'JMD', 'JOD'=>'JOD', 'KES'=>'KES', 'KGS'=>'KGS', 'KHR'=>'KHR', 'KMF'=>'KMF', 'KPW'=>'KPW', 'KRW'=>'KRW', 'KWD'=>'KWD', 'KYD'=>'KYD', 'KZT'=>'KZT', 'LAK'=>'LAK', 'LBP'=>'LBP', 'LKR'=>'LKR', 'LRD'=>'LRD', 'LSL'=>'LSL', 'LTL'=>'LTL', 'LVL'=>'LVL', 'LYD'=>'LYD', 'MAD'=>'MAD', 'MDL'=>'MDL', 'MGA'=>'MGA', 'MKD'=>'MKD', 'MMK'=>'MMK', 'MNT'=>'MNT', 'MOP'=>'MOP', 'MRO'=>'MRO', 'MUR'=>'MUR', 'MVR'=>'MVR', 'MWK'=>'MWK', 'MXN'=>'MXN', 'MYR'=>'MYR', 'MZN'=>'MZN', 'NAD'=>'NAD', 'NGN'=>'NGN', 'NIO'=>'NIO', 'NOK'=>'NOK', 'NPR'=>'NPR', 'NZD'=>'NZD', 'OMR'=>'OMR', 'PAB'=>'PAB', 'PEN'=>'PEN', 'PGK'=>'PGK', 'PHP'=>'PHP', 'PKR'=>'PKR', 'PLN'=>'PLN', 'PYG'=>'PYG', 'QAR'=>'QAR', 'RON'=>'RON', 'RSD'=>'RSD', 'RUB'=>'RUB', 'RWF'=>'RWF', 'SAR'=>'SAR', 'SBD'=>'SBD', 'SCR'=>'SCR', 'SDG'=>'SDG', 'SEK'=>'SEK', 'SGD'=>'SGD', 'SHP'=>'SHP', 'SLL'=>'SLL', 'SOS'=>'SOS', 'SRD'=>'SRD', 'STD'=>'STD', 'SVC'=>'SVC', 'SYP'=>'SYP', 'SZL'=>'SZL', 'THB'=>'THB', 'TJS'=>'TJS', 'TMT'=>'TMT', 'TND'=>'TND', 'TOP'=>'TOP', 'TRY'=>'TRY', 'TTD'=>'TTD', 'TVD'=>'TVD', 'TWD'=>'TWD', 'TZS'=>'TZS', 'UAH'=>'UAH', 'UGX'=>'UGX', 'UYU'=>'UYU', 'UZS'=>'UZS', 'VEF'=>'VEF', 'VND'=>'VND', 'VUV'=>'VUV', 'WST'=>'WST','XAF'=>'XAF', 'XCD'=>'XCD', 'XDR'=>'XDR', 'XOF'=>'XOF', 'XPF'=>'XPF', 'YER'=>'YER', 'ZAR'=>'ZAR', 'ZMK'=>'ZMK', 'ZWD'=>'ZWD' ), array('empty'=>'Select',)); ?>
		<?php echo $form->error($model,'usercurrency'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'balance'); ?>
		<?php echo $form->textField($model,'balance',array('default'=>0)); ?>
                <!-- edited on 30-10-2011 at 8:10 PM  -->
                <?php echo $form->error($model,'balance'); ?>
                 <br />
		<span class="label notice">Hint:</span><span style="color: #736F6E;"> iWallet is your virtual wallet on iXpense, which helps you to keep track of your current account balance.</span>
		
	</div>
	<br />
	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
	</div>
	<?php endif; ?>
	
	<div class="row buttons">
		<?php echo BootHtml::submitButton($model->isNewRecord ? 'Register' : 'Save', array('class'=>'btn primary medium')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->