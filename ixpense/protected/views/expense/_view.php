<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('expid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->expid), array('view', 'id'=>$data->expid)); ?>
	<br />

	<!-- <b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time')); ?>:</b>
	<?php echo CHtml::encode($data->time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expense_category')); ?>:</b>
	<?php echo CHtml::encode($data->expense_category); ?>
	<br /> -->

	<b><?php echo CHtml::encode($data->getAttributeLabel('expense_name')); ?>:</b>
	<?php echo CHtml::encode($data->expense_name); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('expense_mode')); ?>:</b>
	<?php echo CHtml::encode($data->expense_mode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('note')); ?>:</b>
	<?php echo CHtml::encode($data->note); ?>
	<br />

	*/ ?>

</div>