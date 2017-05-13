<div class="levels form">
<?php echo $this->Form->create('Level'); ?>
	<fieldset>
		<legend><?php echo __('Add Level'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Levels'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Levelvalues'), array('controller' => 'levelvalues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Levelvalue'), array('controller' => 'levelvalues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
