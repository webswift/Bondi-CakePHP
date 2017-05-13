<?php $userRole = $this->Session->read('userRole'); ?>

<div class="groupsClients index" style="width: 50%; padding:0 25%">
    <div class="table_header">
	    <div><h2><?php echo __('Groups Clients'); ?></h2></div>
	    <div class="actions">
			<?php if ($userRole <= 2) { ?>
				<ul><li><?php echo $this->Html->link(__('New Groups Client'), array('action' => 'add')); ?></li></ul>
        	<?php } ?>
		</div>
	</div>
	<div class="group_client_content" style="display: flex">
		<?php if ($userRole == 1) { ?>
			<div class="group_client_list" style="width: 20%; margin-right: 50px">
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
		<table class="clientsTable" cellpadding="0" cellspacing="0" style="width: 80%">
			<thead>
				<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('group_id'); ?></th>
					<th><?php echo $this->Paginator->sort('client_id'); ?></th>
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
			getClientsByGroup(groupID);
		});

		function getClientsByGroup(groupID)
		{
			$.ajax({
				type: "POST",
				url: "<?php echo Router::url('/groupsclients/getClientListInGroup'); ?>",
				data : { groupID : groupID },
				success: function (response_text) {
					var jsonResult = JSON.parse(response_text);

					var tableContents = '';
					var userRole = <?php echo $this->Session->read('userRole'); ?> ;

					tableContents += '<thead>' +
						'	<tr>' +
						'		<th><a href="/bondi/groupsclients/index/sort:id/direction:asc/controller:groupsclients">Id</a></th>' +
						'		<th><a href="/bondi/groupsclients/index/sort:group_id/direction:asc/controller:groupsclients">Group</a></th>' +
						'		<th><a href="/bondi/groupsclients/index/sort:client_id/direction:asc/controller:groupsclients">Client</a></th>' +
						'		<th class="actions">Actions</th>' +
						'	</tr>' +
						'</thead>' +
						'<tbody>';

					for (var index in jsonResult.clients) {
						var client = jsonResult.clients[index];
						tableContents +=
							'<tr>' +
							'	<td>' + client['id'] + ' &nbsp;</td>' +
							'	<td>' +
							'	  <a href="/bondi/groups/view/' + client['group_id'] + '">'+client['groupName']+'</a></td>' +
							'	<td>' +
							'	  <a href="/bondi/clients/view/' + client['client_id'] + '">'+client['clientName']+'</a></td>' +
							'  <td class="actions">';

						if (userRole > 2)
							tableContents +=
								'	 <a href="/bondi/groupsclients/view/' + client['id'] + '">View</a>';
						else
							tableContents +=
									'    <a href="/bondi/groupsclients/edit/' + client['id'] + '">Edit</a>' +
								'    <form action="/bondi/groupsclients/delete/' + client['id'] + '" ' +
								'    name="post_' + client['id'] + '" id="post_' + client['id'] + '" style="display:none;" method="post">' +
								'       <input type="hidden" name="_method" value="POST"/>' +
								'    </form>' +
								'    <a href="#" onclick="if (confirm(&quot;Are you sure you want to delete # ' + client['id'] + '?&quot;)) ' +
								'      { document.post_' + client['id'] + '.submit(); } event.returnValue = false; return false;">Delete</a>';

						tableContents += '  </td>' +
							'</tr>';
					}

					tableContents += '	</tbody>';
					$('.clientsTable').html(tableContents);
				},
				error: function () {
					alert("response error");
				}
			})
		}

		getClientsByGroup(<?php echo $this->Session->read('workingGroupID'); ?>)

	});
</script>