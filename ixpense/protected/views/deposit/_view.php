<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('depid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->depid), array('view', 'id'=>$data->depid)); ?>
	<br />

	<!-- <b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br /> -->

	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time')); ?>:</b>
	<?php echo CHtml::encode($data->time); ?>
	<br /> -->

	<b><?php echo CHtml::encode($data->getAttributeLabel('deposit_type')); ?>:</b>
	<?php echo CHtml::encode($data->deposit_type); ?>
	<br /> 

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<!-- <b><?php echo CHtml::encode($data->getAttributeLabel('note')); ?>:</b>
	<?php echo CHtml::encode($data->note); ?>
	<br /> -->


</div>