<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

/*
$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
); */
?>

<div class="page-header">
          <h3><img src= "<?php echo Yii::app()->request->baseUrl; ?>/images/register.png" alt=""> Register<small></small></h3>
        </div>

<?php if(Yii::app()->user->hasFlash('registrationsuccess')): ?>
<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('registrationsuccess');
	echo "<br /><br />";
	echo BootHtml::link("Click to Login",array('site/login'), array('class'=>'btn success medium')); 
	?>
</div>

<?php else: ?>
		
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php endif; ?>