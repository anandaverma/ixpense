<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->uid=>array('view','id'=>$model->uid),
	'Update',
);

$this->menu=array(
	//array('label'=>'List User', 'url'=>array('index')),
	//array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View', 'url'=>array('view', 'id'=>$model->uid)),
	//array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<div class="page-header">
          <h3><img src= "<?php echo Yii::app()->request->baseUrl; ?>/images/settings.png" alt=""> User Settings<small></small></h3>
        </div>

<?php echo $this->renderPartial('_formsettings', array('model'=>$model)); ?>