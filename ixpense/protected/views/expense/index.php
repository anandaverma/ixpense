<?php
$this->breadcrumbs=array(
	'Expenses',
);

$this->menu=array(
	array('label'=>'Create Expense', 'url'=>array('create')),
	array('label'=>'Manage Expense', 'url'=>array('admin')),
);
?>

<h3>Expenses</h3>

<?php $this->widget('ext.bootstrap.widgets.BootListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	
)); ?>
