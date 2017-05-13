<div class="groups form">
<?php echo $this->Form->create('Group', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Group'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('contact');
		echo $this->Form->input('description');
		echo $this->Form->input('logo_url', array('type' => 'file'));
		echo $this->Form->input('login_url');
		//echo $this->Form->input('Client');
		//echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<!--<div class="actions">-->
<!--<h3><?php echo __('Actions'); ?>--><!--</h3>-->
<!--<ul>-->
<!---->
<!--	<li>--><?php //echo $this->Html->link(__('List Groups'), array('action' => 'index')); ?><!--</li>-->
<!--	<li>--><?php //echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?><!-- </li>-->
<!--	<li>--><?php //echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?><!-- </li>-->
<!--	<li>--><?php //echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?><!-- </li>-->
<!--	<li>--><?php //echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?><!-- </li>-->
<!--</ul>-->
<!--</div>-->
