<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->uid), array('view', 'id'=>$data->uid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br /> -->

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('usercurrency')); ?>:</b>
	<?php echo CHtml::encode($data->usercurrency); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('balance')); ?>:</b>
	<?php echo CHtml::encode($data->balance); ?>	
	<br />

</div>