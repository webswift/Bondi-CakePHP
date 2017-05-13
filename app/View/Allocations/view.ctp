<div class="allocations view">
<h2><?php echo __('Allocation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($allocation['Allocation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo $this->Html->link($allocation['Client']['name'], array('controller' => 'clients', 'action' => 'view', $allocation['Client']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Serviceno'); ?></dt>
		<dd>
			<?php echo h($allocation['Allocation']['serviceno']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Alias'); ?></dt>
		<dd>
			<?php echo h($allocation['Allocation']['alias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level1'); ?></dt>
		<dd>
			<?php echo h($allocation['Allocation']['level1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level2'); ?></dt>
		<dd>
			<?php echo h($allocation['Allocation']['level2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level3'); ?></dt>
		<dd>
			<?php echo h($allocation['Allocation']['level3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level4'); ?></dt>
		<dd>
			<?php echo h($allocation['Allocation']['level4']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level5'); ?></dt>
		<dd>
			<?php echo h($allocation['Allocation']['level5']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level6'); ?></dt>
		<dd>
			<?php echo h($allocation['Allocation']['level6']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level7'); ?></dt>
		<dd>
			<?php echo h($allocation['Allocation']['level7']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level8'); ?></dt>
		<dd>
			<?php echo h($allocation['Allocation']['level8']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level9'); ?></dt>
		<dd>
			<?php echo h($allocation['Allocation']['level9']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level10'); ?></dt>
		<dd>
			<?php echo h($allocation['Allocation']['level10']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Split'); ?></dt>
		<dd>
			<?php echo h($allocation['Allocation']['split']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($allocation['Allocation']['email']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Allocation'), array('action' => 'edit', $allocation['Allocation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Allocation'), array('action' => 'delete', $allocation['Allocation']['id']), array(), __('Are you sure you want to delete # %s?', $allocation['Allocation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Allocations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Allocation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
	</ul>
</div>
