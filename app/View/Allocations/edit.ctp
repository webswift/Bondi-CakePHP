<div class="allocations form">
<?php echo $this->Form->create('Allocation'); ?>
	<fieldset>
		<legend><?php echo __('Edit Allocation'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('client_id');
		echo $this->Form->input('serviceno');
		echo $this->Form->input('alias');
		echo $this->Form->input('level1');
		echo $this->Form->input('level2');
		echo $this->Form->input('level3');
		echo $this->Form->input('level4');
		echo $this->Form->input('level5');
		echo $this->Form->input('level6');
		echo $this->Form->input('level7');
		echo $this->Form->input('level8');
		echo $this->Form->input('level9');
		echo $this->Form->input('level10');
		echo $this->Form->input('split');
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<!--<div class="actions">-->
	<!--<h3><?php echo __('Actions'); ?></h3>-->
	<!--<ul>-->

		<!--<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Allocation.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Allocation.id'))); ?></li>-->
		<!--<li><?php echo $this->Html->link(__('List Allocations'), array('action' => 'index')); ?></li>-->
		<!--<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>-->
		<!--<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>-->
	<!--</ul>-->
<!--</div>-->
