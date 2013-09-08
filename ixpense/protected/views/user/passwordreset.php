<?php
$this->pageTitle=Yii::app()->name . ' - Reset Password';
$this->menu=array(
	//array('label'=>'List User', 'url'=>array('index')),
	//array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View', 'url'=>array('view', 'id'=>Yii::app()->user->id)),
	//array('label'=>'Manage User', 'url'=>array('admin')),
);
?>
<div class="page-header">
          <h3><img src= "<?php echo Yii::app()->request->baseUrl; ?>/images/password_reset.png" alt=""> Password Settings<small></small></h3>
        </div>
<?php if(Yii::app()->user->hasFlash('passwordreset')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('passwordreset');
	sleep(5);
	?>
</div>

<?php else: ?>

<div class="form">

<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
	'id'=>'passwordreset-form',
	'stacked'=>true, // should this be a stacked form?
    'errorMessageType'=>'inline', // how to display errors, inline or block?
	//'enableClientValidation'=>true,
	//'clientOptions'=>array(
	//	'validateOnSubmit'=>true,
	//),
)); ?>
<div class="hero-unit">
		<div class="row">
		<?php echo $form->labelEx($model,'oldpassword'); ?>
		<?php echo $form->passwordField($model,'oldpassword',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'oldpassword'); ?>
		</div>
		<div class="row">
		<?php echo $form->labelEx($model,'newpassword'); ?>
		<?php echo $form->passwordField($model,'newpassword',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'newpassword'); ?>
		</div>
		<div class="row">
		<?php echo $form->labelEx($model,'retype'); ?>
		<?php echo $form->passwordField($model,'retype',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'retype'); ?>
		</div>
		<div class="row">
		<?php if(CCaptcha::checkRequirements()): ?>
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		</div>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
		</div>
		<?php endif; ?>
	<br />
	<?php echo BootHtml::submitButton('Save Settings',array('class'=>'btn danger medium')); ?>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<?php endif; ?>