<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->username,
);

$this->menu=array(
	//array('label'=>'List User', 'url'=>array('index')),
	//array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'User Settings', 'url'=>array('update', 'id'=>$model->uid)),
	array('label'=>'Password Settings', 'url'=>array('/user/passwordreset')),
	array('label'=>'Delete Profile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->uid),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->username; ?></h1>

<?php $this->widget('ext.bootstrap.widgets.BootDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'uid',
		'username',
		//'password',
		'email',
		'phone',
		'balance',
		'usercurrency',
	),
)); ?>
