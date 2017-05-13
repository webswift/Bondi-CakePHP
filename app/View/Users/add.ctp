<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('email');
		echo $this->Form->input('role_id', array('id'=>'role'));
		//echo $this->Form->input('FL');
		//echo $this->Form->input('login_state');
        //echo $this->Form->input('login_date');
        //echo $this->Form->input('logoff_date');
		echo $this->Form->input('level_id', array('id'=>'level'));
	    echo $this->Form->input('levelvalue_id', array('id'=>'levelvalue'));
		//echo $this->Form->input('in_client');
		//echo $this->Form->input('Client');
		//echo $this->Form->input('Group');
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>


<script>
    $ = jQuery;
    $(function()
    {
        $('#role').change(function()
        {
            role_select = this.value;
            if (role_select != 5)
            {
                $('#level').css({'display':'none'});
                $('#levelvalue').css({'display':'none'});
            }
            else
            {
                $('#level').show();
                $('#levelvalue').show();
            }
        });

        var rel_result;
        $('#level').change(function()
        {
            level_id = this.value;

            $.ajax({
                 type : "POST",
                 url : "<?php echo Router::url('/levelvalues/getLevelValuesByLevelID'); ?>",
                 data : {level_id : level_id},
                 success : function (response_text)
                 {
                    rel_result = JSON.parse(response_text);
                     add_levelvalue_list();
                 },
                 error : function ()
                 {
                      alert("response error");
                 }
            });

        });

        function add_levelvalue_list() {
            $('#levelvalue option').remove();

            for (var index in rel_result.levelvalues)
            {
                var levelvalue = rel_result.levelvalues[index];
            
                $("#levelvalue").append($('<option>', {
                    value: levelvalue['id'],
                    html: levelvalue['name']
                }));
            }
        }
    });
</script>
