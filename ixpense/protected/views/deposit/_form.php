<div class="form">
<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
	'id'=>'deposit-form',
	'stacked'=>true, // should this be a stacked form?
    'errorMessageType'=>'inline', // how to display errors, inline or block?
    'enableAjaxValidation'=>true,
	)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

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
        'options'=>array('dateFormat' => 'yy-mm-dd','changeMonth' => 'true', 'changeYear' => 'true', 'constrainInput' => 'false',), // jquery plugin options
		'language' => 'en_us',
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
		<?php echo $form->labelEx($model,'deposit_type'); ?>
		<?php echo $form->dropDownList($model,'deposit_type', CHtml::listData(DepositType::model()->findAll(), 'deptypname','deptypname'), array('empty'=>'Select Type',)); ?>
		<?php echo $form->error($model,'deposit_type'); ?>
	</div>

	<div style="float:right">
		<center><span class="label notice">Amount Slider</span></center><br />
			<?php $this->widget('zii.widgets.jui.CJuiSliderInput', array(
    'name'=>'deposit_amount_slider',
    'value'=>0,
    'event'=>'change',
    'options'=>array(
        'min'=>0,
        'max'=>10000,
		'step'=>10,
        'slide'=>'js:function(event,ui){$("#dptamount").val(ui.value);}',
    ),
    'htmlOptions'=>array(
        'style'=>'width:400px; height:10px; float:right;'
    ),
));?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount', array('id'=>'dptamount')); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

		
<?php
$jsAdressLookup='js:function(request, response) {
		$("#dptmap").gmap3({action:"getAddress", address: request.term, callback:function(results){
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
              $("#dptmap").gmap3(
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
		<?php echo $form->labelEx($model,'deposit_place'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
    'model'=>$model,
	'name'=>'deposit_place',
	'attribute'=>'deposit_place',
    'source'=>$jsAdressLookup,
	'options'=>array('select'=>$jsAdressAddMarker),
	'htmlOptions'=>array(
        'class'=>'span7',
    ),
));?>
		<?php echo $form->error($model,'deposit_place'); ?> 
	</div>
	
	<?php
	Yii::import('ext.jquery-gmap.*');
	// create a map centered in the middle of the world ...Not se
$gmap = new EGmap3Widget();
$gmap->id= "dptmap";
$gmap->setSize(400, 180);
$gmap->setOptions(array(
        'zoom' => 15,
        'center' => array(41.148603149496736,24.15121078491211),
));
// add a marker
$marker = new EGmap3Marker(array(
    'title' => 'My place of deposit',
	'draggable'=>false,
));

$marker->latLng = array(0,0);
$marker->address = $model->deposit_place;
$marker->centerOnMap();
$gmap->add($marker);
  
// tell the gmap to update the marker from the Address model fields.
$gmap->updateMarkerAddressFromModel(
     // the model object
     $model,
     // the model attributes to capture, these MUST be present in the form
     // constructed above. Attributes must also be given in the correct
     // order for assembling the address string.
     array('deposit_place'),
     // you may pass these options :
     // 'first' - set to first marker added to map, default is last
     // 'nopan' - do not pan the map on marker update.
     array()
);
$gmap->renderMap();
?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'note'); ?>
		<?php echo $form->textArea($model,'note',array('rows'=>4, 'cols'=>50, 'class'=>'span7')); ?>
		<?php echo $form->error($model,'note'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn primary medium')); ?>
	 <?php echo BootHtml::resetButton('Reset', array('class'=>'btn danger small')); ?>
	
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->