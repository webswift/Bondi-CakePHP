<div class="levelvalues form">
<?php echo $this->Form->create('Levelvalue'); ?>
	<fieldset>
		<legend><?php echo __('Edit Levelvalue'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('level_id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Levelvalue.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Levelvalue.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Levelvalues'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Levels'), array('controller' => 'levels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Level'), array('controller' => 'levels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
