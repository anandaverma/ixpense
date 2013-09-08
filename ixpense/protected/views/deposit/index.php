
<?php
$this->breadcrumbs=array(
	'Deposits',
);
?>
<?php
$this->menu=array(
	array('label'=>'Create Deposit', 'url'=>array('create')),
	array('label'=>'Manage Deposit', 'url'=>array('admin')),
);
?>
<h3>Deposits</h3>

<?php $this->widget('ext.bootstrap.widgets.BootListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
