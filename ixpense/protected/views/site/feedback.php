<?php
$this->pageTitle=Yii::app()->name . ' - Feedback';
$this->breadcrumbs=array(
	'Feedback',
);
?>

<div class="page-header">
          <h3><img src= "<?php echo Yii::app()->request->baseUrl; ?>/images/feedback.png" alt=""> Feedback <small></small></h3>
        </div>


<?php if(Yii::app()->user->hasFlash('feedback')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('feedback'); ?>
</div>

<?php else: ?>

<div class="form">

<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
	'id'=>'feedback-form',
	'stacked'=>true, // should this be a stacked form?
    'errorMessageType'=>'inline', // how to display errors, inline or block?
	'enableClientValidation'=>true,
	//'clientOptions'=>array(
	//	'validateOnSubmit'=>true,
	//),
)); ?>
<p>Use the form below to send us your comments. We read all feedback carefully, and respond to the comments you submit as soon as possible.</p>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'feedbacktype'); ?>
		<?php echo $form->dropDownList($model,'feedbacktype', array('Enhancement Request'=>'Enhancement Request', 'Bug Report'=>'Bug Report', 'Design/Ease of Use'=>'Design/Ease of Use', 'Other'=>'Other'), array('empty'=>'Select Feedback Type:',)); ?>
		<?php echo $form->error($model,'feedbacktype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>


	<div class="row buttons">
		<?php echo BootHtml::submitButton('Submit',array('class'=>'btn primary medium')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>