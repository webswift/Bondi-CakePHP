<div class="levelvalues view">
<h2><?php echo __('Levelvalue'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($levelvalue['Levelvalue']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level'); ?></dt>
		<dd>
			<?php echo $this->Html->link($levelvalue['Level']['name'], array('controller' => 'levels', 'action' => 'view', $levelvalue['Level']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($levelvalue['Levelvalue']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Levelvalue'), array('action' => 'edit', $levelvalue['Levelvalue']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Levelvalue'), array('action' => 'delete', $levelvalue['Levelvalue']['id']), array(), __('Are you sure you want to delete # %s?', $levelvalue['Levelvalue']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Levelvalues'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Levelvalue'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Levels'), array('controller' => 'levels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Level'), array('controller' => 'levels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($levelvalue['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('FL'); ?></th>
		<th><?php echo __('Login State'); ?></th>
		<th><?php echo __('Level Id'); ?></th>
		<th><?php echo __('Levelvalue Id'); ?></th>
		<th><?php echo __('In Client'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($levelvalue['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['FL']; ?></td>
			<td><?php echo $user['login_state']; ?></td>
			<td><?php echo $user['level_id']; ?></td>
			<td><?php echo $user['levelvalue_id']; ?></td>
			<td><?php echo $user['in_client']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), array(), __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
