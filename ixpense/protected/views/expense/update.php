<?php
$this->breadcrumbs=array(
	'Expenses'=>array('index'),
	$model->expid=>array('view','id'=>$model->expid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Expense', 'url'=>array('index')),
	array('label'=>'Create Expense', 'url'=>array('create')),
	array('label'=>'View Expense', 'url'=>array('view', 'id'=>$model->expid)),
	array('label'=>'Manage Expense', 'url'=>array('admin')),
);
?>

<h3>Update Expense <?php echo $model->expid; ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>