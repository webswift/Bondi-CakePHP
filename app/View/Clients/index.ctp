<div class="clients index">
    <div class="table_header">
        <div><h2><?php echo __('Clients'); ?></h2></div>
        <div class="actions">
            <ul><li><?php echo $this->Html->link(__('New Client'), array('action' => 'add')); ?></li></ul>
        </div>
    </div>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('contact'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('logo_url'); ?></th>
			<th><?php echo $this->Paginator->sort('login_url'); ?></th>
<!--			<th>--><?php //echo $this->Paginator->sort('in_group'); ?><!--</th>-->
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($clients as $client): ?>
	<tr>
		<td><?php echo h($client['Client']['id']); ?>&nbsp;</td>
		<td><?php echo h($client['Client']['name']); ?>&nbsp;</td>
		<td><?php echo h($client['Client']['email']); ?>&nbsp;</td>
		<td><?php echo h($client['Client']['contact']); ?>&nbsp;</td>
		<td><?php echo h($client['Client']['description']); ?>&nbsp;</td>
		<td><?php echo h($client['Client']['logo_url']); ?>&nbsp;</td>
		<td><?php echo h($client['Client']['login_url']); ?>&nbsp;</td>
<!--		<td>--><?php //echo h($client['Client']['in_group']); ?><!--&nbsp;</td>-->
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), 'view/'.$client['Client']['id']); ?>
			<?php echo $this->Html->link(__('Edit'), 'edit/'.$client['Client']['id']); ?>
			<?php echo $this->Form->postLink(__('Delete'), 'delete/'.$client['Client']['id'], array(), __('Are you sure you want to delete # %s?', $client['Client']['id'])); ?>
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
<div class="actions">
	<h3><?php //echo __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('New Client'), array('action' => 'add')); ?></li>
		<li><?php //echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
