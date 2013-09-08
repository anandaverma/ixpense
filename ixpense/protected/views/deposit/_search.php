<div class="wide form">

<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'depid'); ?>
		<?php echo $form->textField($model,'depid',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<!--<div class="row">
		<?php echo $form->label($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>20,'maxlength'=>20)); ?>
	</div> -->

	<div class="row">
		<?php echo $form->label($model,'date'); ?>
		<?php //echo $form->textField($model,'date'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
		$this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'date', //attribute name
        'mode'=>'date', //use "time","date" or "datetime" (default)
        'options'=>array('dateFormat' => 'yy-mm-dd','changeMonth' => 'true', 'changeYear' => 'true', 'constrainInput' => 'false',), // jquery plugin options
		'language' => 'en_us',
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
		<?php echo $form->label($model,'deposit_place'); ?>
		<?php echo $form->textField($model,'deposit_place', array('class'=>'span7')); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'deposit_type'); ?>
		<?php echo $form->dropDownList($model,'deposit_type', CHtml::listData(DepositType::model()->findAll(), 'deptypname','deptypname'), array('empty'=>'Select Type',)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
	</div>

	<!--<div class="row">
		<?php echo $form->label($model,'note'); ?>
		<?php echo $form->textArea($model,'note',array('rows'=>6, 'cols'=>50)); ?>
	</div> -->

	<div class="row buttons">
		<?php echo BootHtml::submitButton('Search',array('class'=>'btn info medium')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->