<div class="page-header">
          <h3><img src= "<?php echo Yii::app()->request->baseUrl; ?>/images/forgot_password.png" alt=""> Forgot Password <small></small></h3>
        </div>


<?php if(Yii::app()->user->hasFlash('forgot')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('forgot');
	echo BootHtml::link("Click to Login",array('site/login'), array('class'=>'btn success medium')); 
	echo " or ";
	echo BootHtml::link("Create a New Account",array('user/create'), array('class'=>'btn danger medium')); 
	?>
</div>

<?php else: ?>

<div class="form">

<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
	'id'=>'forgot-form',
	'stacked'=>true, // should this be a stacked form?
    'errorMessageType'=>'inline', // how to display errors, inline or block?
	//'enableClientValidation'=>true,
	//'clientOptions'=>array(
	//	'validateOnSubmit'=>true,
	//),
)); ?>
<div class="hero-unit">
		<?php echo $form->labelEx($model,'mailid'); ?>
		<?php echo $form->textField($model,'mailid'); ?>
		<?php echo $form->error($model,'mailid'); ?>
		<br />
		<?php if(CCaptcha::checkRequirements()): ?>
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>
	<br />
	<?php echo BootHtml::submitButton('Send',array('class'=>'btn danger medium')); ?>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>