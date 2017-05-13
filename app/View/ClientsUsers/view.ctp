<div class="clientsUsers view">
<h2><?php echo __('Clients User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($clientsUser['ClientsUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo $this->Html->link($clientsUser['Client']['name'], array('controller' => 'clients', 'action' => 'view', $clientsUser['Client']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($clientsUser['User']['id'], array('controller' => 'users', 'action' => 'view', $clientsUser['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Clients User'), array('action' => 'edit', $clientsUser['ClientsUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Clients User'), array('action' => 'delete', $clientsUser['ClientsUser']['id']), array(), __('Are you sure you want to delete # %s?', $clientsUser['ClientsUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Clients User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
