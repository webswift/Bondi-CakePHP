<div class="groups form">
<?php echo $this->Form->create('Group', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Edit Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

