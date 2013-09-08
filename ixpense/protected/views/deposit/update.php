<?php
$this->breadcrumbs=array(
	'Deposits'=>array('index'),
	$model->depid=>array('view','id'=>$model->depid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Deposit', 'url'=>array('index')),
	array('label'=>'Create Deposit', 'url'=>array('create')),
	array('label'=>'View Deposit', 'url'=>array('view', 'id'=>$model->depid)),
	array('label'=>'Manage Deposit', 'url'=>array('admin')),
);
?>

<h3>Update Deposit <?php echo $model->depid; ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>