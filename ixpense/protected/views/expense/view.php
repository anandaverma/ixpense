<?php
$this->breadcrumbs=array(
	'Expenses'=>array('index'),
	$model->expid,
);

$this->menu=array(
	array('label'=>'List Expense', 'url'=>array('index')),
	array('label'=>'Create Expense', 'url'=>array('create')),
	array('label'=>'Update Expense', 'url'=>array('update', 'id'=>$model->expid)),
	array('label'=>'Delete Expense', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->expid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Expense', 'url'=>array('admin')),
);
?>

<h3>View Expense <?php echo $model->expid; ?></h3>

<?php $this->widget('ext.bootstrap.widgets.BootDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'expid',
		//'uid',
		'date',
		'time',
		'expense_place',
		'expense_category',
		'expense_name',
		'expense_mode',
		'amount',
		'note',
	),
)); ?>
    
	<?php
	if(!$model->expense_place == null)
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
    'title' => 'My place of expense',
    'draggable' => false,
));
$marker->address = $model->expense_place;
$marker->centerOnMap();
// $infoWindow = new EGmap3InfoWindow(
    // array(‘content’=>$model->expense_place.”,”.$model->expense_name.”,”.$model->amount)
// );
$gmap->add($marker);
 
$gmap->renderMap();
	}
?>
