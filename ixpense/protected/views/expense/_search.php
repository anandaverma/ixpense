<div class="wide form">

<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'expid'); ?>
		<?php echo $form->textField($model,'expid',array('size'=>20,'maxlength'=>20)); ?>
	</div>
 
	<div class="row">
		<?php echo $form->label($model,'date'); ?>
		<?php //echo $form->textField($model,'date'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
		$this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'date', //attribute name
        'mode'=>'date', //use "time","date" or "datetime" (default)
		'language' => 'en_us',
		'options'=>array('dateFormat' => 'yy-mm-dd','changeMonth' => 'true', 'changeYear' => 'true', 'constrainInput' => 'false',), // jquery plugin options
		)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time'); ?>
		<?php //echo $form->textField($model,'time'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
		$this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'time', //attribute name
        'mode'=>'time', //use "time","date" or "datetime" (default)
        'options'=>array('showSecond'=>'true','timeFormat' => 'hh:mm:ss'), // jquery plugin options
		'language' => 'en_us',
		)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'expense_place'); ?>
		<?php echo $form->textField($model,'expense_place', array('class'=>'span7')); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'expense_category'); ?>
		<?php echo $form->dropDownList($model,'expense_category', CHtml::listData(ExpenseCategory::model()->findAll(), 'expcatname','expcatname'), array('empty'=>'Select Type',)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'expense_name'); ?>
		<?php echo $form->textField($model,'expense_name',array('size'=>40,'maxlength'=>40)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'expense_mode'); ?>
		<?php echo $form->dropDownList($model,'expense_mode', CHtml::listData(ExpenseMode::model()->findAll(), 'mode_name','mode_name'), array('empty'=>'Select Mode',)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
	</div>

	<div class="row buttons">
		<?php echo BootHtml::submitButton('Search', array('class'=>'btn info medium')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->