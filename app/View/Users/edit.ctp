<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('email');
		echo $this->Form->input('role_id');
		//echo $this->Form->input('FL');
		//echo $this->Form->input('login_state');
		//echo $this->Form->input('login_date');
		//echo $this->Form->input('logoff_date');
		echo $this->Form->input('level_id');
		echo $this->Form->input('levelvalue_id');
		//echo $this->Form->input('in_client');
		//echo $this->Form->input('Client');
		//echo $this->Form->input('Group');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

