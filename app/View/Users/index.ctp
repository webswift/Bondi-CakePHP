<div class="users index">
    <div class="table_header">
        <div><h2><?php echo __('Users'); ?></h2></div>
        <div class="actions">
            <ul><li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li></ul>
        </div>
    </div>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php //echo $this->Paginator->sort('password'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('FL'); ?></th>
			<th><?php echo $this->Paginator->sort('login_state'); ?></th>
			<th><?php echo $this->Paginator->sort('login_date'); ?></th>
			<th><?php echo $this->Paginator->sort('logoff_date'); ?></th>
			<th><?php echo $this->Paginator->sort('level_id'); ?></th>
			<th><?php echo $this->Paginator->sort('levelvalue_id'); ?></th>
<!--			<th>--><?php //echo $this->Paginator->sort('in_client'); ?><!--</th>-->
			<th><?php echo $this->Paginator->sort('role_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php //echo h($user['User']['password']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['FL']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['login_state']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['login_date']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['logoff_date']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($user['Level']['name'], '/levels/view'.$user['Level']['id']); ?>
		</td>
		<td>
			<?php echo $this->Html->link($user['Levelvalue']['name'], '/levelvalues/view'.$user['Levelvalue']['id']); ?>
		</td>
<!--		<td>--><?php //echo h($user['User']['in_client']); ?><!--&nbsp;</td>-->
		<td>
			<?php echo $this->Html->link($user['Role']['name'], '/roles/view'.$user['Role']['id']); ?>
		</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), 'view/'.$user['User']['id']); ?>
			<?php echo $this->Html->link(__('Edit'), 'edit/'.$user['User']['id']); ?>
			<?php echo $this->Form->postLink(__('Delete'), 'delete/'.$user['User']['id'], array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
