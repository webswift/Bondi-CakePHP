<div class="groupsClients view">
<h2><?php echo __('Groups Client'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($groupsClient['GroupsClient']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupsClient['Group']['name'], array('controller' => 'groups', 'action' => 'view', $groupsClient['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupsClient['Client']['name'], array('controller' => 'clients', 'action' => 'view', $groupsClient['Client']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Groups Client'), array('action' => 'edit', $groupsClient['GroupsClient']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Groups Client'), array('action' => 'delete', $groupsClient['GroupsClient']['id']), array(), __('Are you sure you want to delete # %s?', $groupsClient['GroupsClient']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups Clients'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Groups Client'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
	</ul>
</div>
