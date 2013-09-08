<?php
$this->breadcrumbs=array(
	'Deposits'=>array('index'),
	$model->depid,
);

$this->menu=array(
	array('label'=>'List Deposit', 'url'=>array('index')),
	array('label'=>'Create Deposit', 'url'=>array('create')),
	array('label'=>'Update Deposit', 'url'=>array('update', 'id'=>$model->depid)),
	array('label'=>'Delete Deposit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->depid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Deposit', 'url'=>array('admin')),
);
?>

<h3>View Deposit <?php echo $model->depid; ?></h3>

<?php $this->widget('ext.bootstrap.widgets.BootDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'depid',
		//'uid',
		'date',
		'time',
		'deposit_place',
		'deposit_type',
		'amount',
		'note',
	),
)); ?>

	<?php
	if(!$model->deposit_place == null)
	{
	Yii::import('ext.jquery-gmap.*');
// init the map
$gmap = new EGmap3Widget();
$gmap->setSize(700, 300);
$gmap->setOptions(array('zoom' => 14,
    'mapTypeControlOptions' => array(
        'style' => EGmap3MapTypeControlStyle::DROPDOWN_MENU,
        'position' => EGmap3ControlPosition::TOP_CENTER,
    ),
	));
 
// create the marker
$marker = new EGmap3Marker(array(
    'title' => 'My place of deposit',
    'draggable' => false,
));
$marker->address = $model->deposit_place;
$marker->centerOnMap();
// $infoWindow = new EGmap3InfoWindow(
    // array(‘content’=>$model->expense_place.”,”.$model->expense_name.”,”.$model->amount)
// );
$gmap->add($marker);
 
$gmap->renderMap();
	}
?>