<div class="allocations form">
<?php echo $this->Form->create('Allocation'); ?>
	<fieldset>
		<legend><?php echo __('Add Allocation'); ?></legend>
	<?php
		echo $this->Form->input('client_id');
		echo $this->Form->input('serviceno');
		echo $this->Form->input('alias');
		echo $this->Form->input('level1', array('id'=>'level1', 'type'=>'select'));
		echo $this->Form->input('level2', array('id'=>'level2', 'type'=>'select'));
		echo $this->Form->input('level3', array('id'=>'level3', 'type'=>'select'));
		echo $this->Form->input('level4', array('id'=>'level4', 'type'=>'select'));
		echo $this->Form->input('level5', array('id'=>'level5', 'type'=>'select'));
		echo $this->Form->input('level6', array('id'=>'level6', 'type'=>'select'));
		echo $this->Form->input('level7', array('id'=>'level7', 'type'=>'select'));
		echo $this->Form->input('level8', array('id'=>'level8', 'type'=>'select'));
		echo $this->Form->input('level9', array('id'=>'level9', 'type'=>'select'));
		echo $this->Form->input('level10', array('id'=>'level10', 'type'=>'select'));
		echo $this->Form->input('split');
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<script>
	$ = jQuery;

	$.ajax({
		type: "POST",
		url: "<?php echo Router::url('/levelvalues/getAllLevelValues'); ?>",
		success: function (response_text) {
			rel_result = JSON.parse(response_text);

			for (var i = 0; i < 10; i++) {
				var levelname = '#level' + (i+1);
				$(levelname + ' option').remove();
			}

			for (var index in rel_result.levelvalues) {
				var levelvalue = rel_result.levelvalues[index];

				var levelname = '#level' + levelvalue['level_id'];

				$(levelname).append($('<option>', {
					value: levelvalue['name'],
					html: levelvalue['name']
				}));
			}
		},
		error: function () {
			alert("response error");
		}
	})

</script>