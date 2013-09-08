<div class="form">

<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
	'id'=>'expense-form',
	'stacked'=>true, // should this be a stacked form?
    'errorMessageType'=>'inline', // how to display errors, inline or block?
    'enableAjaxValidation'=>true,
)); ?>


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php  	 //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>20,'maxlength'=>20,'value'=>Yii::app()->user->id,'readonly'=>readonly,)); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php //echo $form->textField($model,'date'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
		$this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'date', //attribute name
        'mode'=>'date', //use "time","date" or "datetime" (default)
		'language' => 'en_us',
		'options'=>array('dateFormat' => 'yy-mm-dd','changeMonth' => 'true', 'changeYear' => 'true', 'constrainInput' => 'false',), // jquery plugin options
		)); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time'); ?>
		<?php //echo $form->textField($model,'time'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
		$this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'time', //attribute name
        'mode'=>'time', //use "time","date" or "datetime" (default)
        'options'=>array('showSecond'=>'true','timeFormat' => 'hh:mm:ss'), // jquery plugin options
		'language' => 'en_us',
		
		
		)); ?>
		<?php echo $form->error($model,'time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expense_category'); ?>
		<?php echo $form->dropDownList($model,'expense_category', CHtml::listData(ExpenseCategory::model()->findAll(), 'expcatname','expcatname'), array('empty'=>'Select Type',)); ?>
		<?php echo $form->error($model,'expense_category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expense_name'); ?>
		<?php echo $form->textField($model,'expense_name',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'expense_name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'expense_mode'); ?>
		<?php echo $form->dropDownList($model,'expense_mode', CHtml::listData(ExpenseMode::model()->findAll(), 'mode_name','mode_name'), array('empty'=>'Select Mode',)); ?>
		<?php echo $form->error($model,'expense_mode'); ?>
	</div>
	
	<div style="float:right">
		<center><span class="label notice">Amount Slider</span></center><br />
		<?php $this->widget('zii.widgets.jui.CJuiSliderInput', array(
		'name'=>'expense_amount_slider',
		'value'=>0,
		'event'=>'change',
		'options'=>array(
        'min'=>0,
        'max'=>10000,
		'step'=>10,
        'slide'=>'js:function(event,ui){$("#expamount").val(ui.value);}',
		),
		'htmlOptions'=>array(
        'style'=>'width:400px; height:10px; '
    ),
));?> 	
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount', array('id'=>'expamount'));?>
		<?php echo $form->error($model,'amount'); ?> 
	</div>	
<?php
$jsAdressLookup='js:function(request, response) {
		$("#expmap").gmap3({action:"getAddress", address: request.term, callback:function(results){
        if (!results) return;
        response($.map(results, function(item) {
          return {
            label:  item.formatted_address,
            value: item.formatted_address,
            latLng: item.geometry.location
          }
        }));
      }
    });
  }';

	$jsAdressAddMarker='js:function(event, ui) {
              $("#expmap").gmap3(
                {action:"clear", name:"marker"},
                {action:"addMarker",
                  latLng:ui.item.latLng,
                  map:{center:true},
                  marker:{
				      options:{
				        draggable: false
				      }
				    } 
                }
              );
            }';
?>
	<div class="row">
		<?php echo $form->labelEx($model,'expense_place'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
    'model'=>$model,
	'name'=>'expense_place',
	'attribute'=>'expense_place',
    'source'=>$jsAdressLookup,
	'options'=>array('select'=>$jsAdressAddMarker),
	'htmlOptions'=>array(
        'class'=>'span7',
    ),
));?>
		<?php echo $form->error($model,'expense_place'); ?> 
	</div>
	
	<?php
	Yii::import('ext.jquery-gmap.*');
	// create a map centered in the middle of the world ...Not se
$gmap = new EGmap3Widget();
$gmap->id= "expmap";
$gmap->setSize(400, 180);
$gmap->setOptions(array(
        'zoom' => 15,
        'center' => array(41.148603149496736,24.15121078491211),
));
// add a marker
$marker = new EGmap3Marker(array(
    'title' => 'My place of expense',
	'draggable'=>false,
));

$marker->latLng = array(0,0);
$marker->address = $model->expense_place;
$marker->centerOnMap();
$gmap->add($marker);
  
// tell the gmap to update the marker from the Address model fields.
$gmap->updateMarkerAddressFromModel(
     // the model object
     $model,
     // the model attributes to capture, these MUST be present in the form
     // constructed above. Attributes must also be given in the correct
     // order for assembling the address string.
     array('expense_place'),
     // you may pass these options :
     // 'first' - set to first marker added to map, default is last
     // 'nopan' - do not pan the map on marker update.
     array()
);
$gmap->renderMap();
?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'note'); ?>
		<?php echo $form->textArea($model,'note',array('rows'=>4, 'cols'=>100, 'class'=>'span7')); ?>
		<?php echo $form->error($model,'note'); ?>
	</div>
	<div class="action">
		<?php echo BootHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn primary medium')); ?>
	    <?php echo BootHtml::resetButton('Reset', array('class'=>'btn danger small')); ?>
	
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->