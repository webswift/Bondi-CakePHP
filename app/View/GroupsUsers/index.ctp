<?php $userRole = $this->Session->read('userRole'); ?>

<div class="groupsUsers index" style="width: 50%; padding:0 25%">
    <div class="table_header">
        <div><h2><?php echo __('Groups Users'); ?></h2></div>
        <div class="actions">
			<?php if ($userRole <= 2) { ?>
            	<ul><li><?php echo $this->Html->link(__('New Groups User'), array('action' => 'add')); ?></li></ul>
			<?php } ?>
        </div>
    </div>
	<div class="group_user_content" style="display: flex">
		<?php if ($userRole == 1) { ?>
			<div class="group_user_list" style="width: 20%; margin-right: 50px">
				<?php
				include("/../../connect_db.php");

				$result = mysqli_query($conn, "SELECT id, name FROM groups;" );

				echo "<table class='list_table'><thead><tr><th>Group List</th></tr></thead><tbody>";

				while($row = mysqli_fetch_object($result)){
					echo "<tr><td class='list_item' id='".$row->id."' style='cursor: pointer;'>" . $row->name . "</td></tr>";
				}

				echo "</tbody></table>";

				mysqli_close($conn);
				?>
			</div>
		<?php } ?>
		<table cellpadding="0" cellspacing="0" class="usersTable">
		<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('group_id'); ?></th>
				<th><?php echo $this->Paginator->sort('user_id'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		<tbody>
		</tbody>
		</table>
	</div>
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

<script>
	$ = jQuery;
	$(function()
	{
		$('.list_item').click(function()
		{
			var groupID = this.id;
			getUsersByGroup(groupID);
		});

		function getUsersByGroup(groupID)
		{
			$.ajax({
				type: "POST",
				url: "<?php echo Router::url('/groupsusers/getUserListInGroup'); ?>",
				data : { groupID : groupID },
				success: function (response_text) {
					var jsonResult = JSON.parse(response_text);

					var tableContents = '';
					var userRole = <?php echo $this->Session->read('userRole'); ?> ;

					tableContents += '<thead>' +
						'	<tr>' +
						'		<th><a href="/bondi/groupsusers/index/sort:id/direction:asc/controller:groupsusers">Id</a></th>' +
						'		<th><a href="/bondi/groupsusers/index/sort:group_id/direction:asc/controller:groupsusers">Group</a></th>' +
						'		<th><a href="/bondi/groupsusers/index/sort:user_id/direction:asc/controller:groupsusers">User</a></th>' +
						'		<th class="actions">Actions</th>' +
						'	</tr>' +
						'</thead>' +
						'<tbody>';

					for (var index in jsonResult.users) {
						var user = jsonResult.users[index];
						tableContents +=
							'<tr>' +
							'	<td>' + user['id'] + ' &nbsp;</td>' +
							'	<td>' +
							'	  <a href="/bondi/groups/view/' + user['groupID'] + '">'+user['groupName']+'</a></td>' +
							'	<td>' +
							'	  <a href="/bondi/users/view/' + user['userID'] + '">'+user['userName']+'</a></td>' +
							'  <td class="actions">';

						if (userRole > 2)
							tableContents +=
								'	 <a href="/bondi/groupsusers/view/' + user['id'] + '">View</a>';
						else
							tableContents +=
								'    <a href="/bondi/groupsusers/edit/' + user['id'] + '">Edit</a>' +
								'    <form action="/bondi/groupsusers/delete/' + user['id'] + '" ' +
								'    name="post_' + user['id'] + '" id="post_' + user['id'] + '" style="display:none;" method="post">' +
								'       <input type="hidden" name="_method" value="POST"/>' +
								'    </form>' +
								'    <a href="#" onclick="if (confirm(&quot;Are you sure you want to delete # ' + user['id'] + '?&quot;)) ' +
								'      { document.post_' + user['id'] + '.submit(); } event.returnValue = false; return false;">Delete</a>';

						tableContents += '  </td>' +
							'</tr>';
					}

					tableContents += '	</tbody>';
					$('.usersTable').html(tableContents);
				},
				error: function () {
					alert("response error");
				}
			})
		}

		getUsersByGroup(<?php echo $this->Session->read('workingGroupID'); ?>)

	});
</script>
