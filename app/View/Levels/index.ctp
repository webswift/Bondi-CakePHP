<div class="levels index">
	<h2><?php echo __('Levels'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($levels as $level): ?>
	<tr>
		<td><?php echo h($level['Level']['id']); ?>&nbsp;</td>
		<td><?php echo h($level['Level']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), 'view/'.$level['Level']['id']); ?>
			<?php echo $this->Html->link(__('Edit'), 'edit/'.$level['Level']['id']); ?>
			<?php echo $this->Form->postLink(__('Delete'), 'delete/'.$level['Level']['id'], array(), __('Are you sure you want to delete # %s?', $level['Level']['id'])); ?>
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
<!--<div class="actions">-->
	<!--<h3><?php echo __('Actions'); ?></h3>-->
	<!--<ul>-->
		<!--<li><?php echo $this->Html->link(__('New Level'), array('action' => 'add')); ?></li>-->
		<!--<li><?php echo $this->Html->link(__('List Levelvalues'), array('controller' => 'levelvalues', 'action' => 'index')); ?> </li>-->
		<!--<li><?php echo $this->Html->link(__('New Levelvalue'), array('controller' => 'levelvalues', 'action' => 'add')); ?> </li>-->
		<!--<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>-->
		<!--<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>-->
	<!--</ul>-->
<!--</div>-->
