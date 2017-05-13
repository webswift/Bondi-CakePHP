<?php $userRole = $this->Session->read('userRole'); ?>

<div class="clientsUsers index" style="width: 50%; padding:0 25%">
    <div class="table_header">
        <div><h2><?php echo __('Clients Users'); ?></h2></div>
        <div class="actions">
			<?php if ($userRole <= 2) { ?>
            	<ul><li><?php echo $this->Html->link(__('New Clients User'), array('action' => 'add')); ?></li></ul>
			<?php } ?>
        </div>
    </div>
	<div class="client_user_content" style="display: flex">
		<div class="client_user_list" style="width: 20%; margin-right: 50px">
			<?php
			include("/../../connect_db.php");

			$groupID = $this->Session->read('workingGroupID');
			$sqlQuery = "SELECT clients.id as id, clients.name as name FROM clients, groups_clients ".
						"WHERE clients.id = groups_clients.client_id AND groups_clients.group_id = $groupID ;";

			$result = mysqli_query($conn, $sqlQuery );

			echo "<table class='list_table'><thead><tr><th>Clients List</th></tr></thead><tbody>";

			while($row = mysqli_fetch_object($result)){
				echo "<tr><td class='list_item' id='".$row->id."' style='cursor: pointer;'>" . $row->name . "</td></tr>";
			}

			echo "</tbody></table>";

			mysqli_close($conn);
			?>
		</div>
		<table cellpadding="0" cellspacing="0" class="clientUsersTable">
		<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('client_id'); ?></th>
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
<div class="actions">
	<h3><?php //echo __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('New Clients User'), array('action' => 'add')); ?></li>
		<li><?php //echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>

<script>
	$ = jQuery;
	$(function()
	{
		$('.list_item').click(function()
		{
			var clientID = this.id;
			getUsersByClient(clientID);
		});

		function getUsersByClient(clientID)
		{
			$.ajax({
				type: "POST",
				url: "<?php echo Router::url('/clientsusers/getUserListInClient'); ?>",
				data : { clientID : clientID },
				success: function (response_text) {
					var jsonResult = JSON.parse(response_text);

					var tableContents = '';
					var userRole = <?php echo $this->Session->read('userRole'); ?> ;

					tableContents += '<thead>' +
						'	<tr>' +
						'		<th><a href="/bondi/clientsusers/index/sort:id/direction:asc/controller:clientsusers">Id</a></th>'	+
						'		<th><a href="/bondi/clientsusers/index/sort:client_id/direction:asc/controller:clientsusers">Client</a></th>' +
						'		<th><a href="/bondi/clientsusers/index/sort:user_id/direction:asc/controller:clientsusers">User</a></th>' +
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
							'	  <a href="/bondi/clients/view/' + user['clientID'] + '">'+user['clientName']+'</a></td>' +
							'	<td>' +
							'	  <a href="/bondi/users/view/' + user['userID'] + '">'+user['userName']+'</a></td>' +
							'  <td class="actions">';

						if (userRole > 2)
							tableContents +=
								'	 <a href="/bondi/clientsusers/view/' + user['id'] + '">View</a>';
						else
							tableContents +=
								'    <a href="/bondi/clientsusers/edit/' + user['id'] + '">Edit</a>' +
								'    <form action="/bondi/clientsusers/delete/' + user['id'] + '" ' +
								'    name="post_' + user['id'] + '" id="post_' + user['id'] + '" style="display:none;" method="post">' +
								'       <input type="hidden" name="_method" value="POST"/>' +
								'    </form>' +
								'    <a href="#" onclick="if (confirm(&quot;Are you sure you want to delete # ' + user['id'] + '?&quot;)) ' +
								'      { document.post_' + user['id'] + '.submit(); } event.returnValue = false; return false;">Delete</a>';

						tableContents += '  </td>' +
							'</tr>';
					}

					tableContents += '	</tbody>';
					$('.clientUsersTable').html(tableContents);
				},
				error: function () {
					alert("response error");
				}
			})
		}

		getUsersByClient(<?php echo $this->Session->read('workingClientID'); ?>)

	});
</script>
