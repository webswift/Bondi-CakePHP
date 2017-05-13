<div class="clientsUsers form">
<?php echo $this->Form->create('ClientsUser'); ?>
	<fieldset>
		<legend><?php echo __('Edit Clients User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('client_id');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php //echo __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ClientsUser.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('ClientsUser.id'))); ?></li>
		<li><?php //echo $this->Html->link(__('List Clients Users'), array('action' => 'index')); ?></li>
		<li><?php //echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
