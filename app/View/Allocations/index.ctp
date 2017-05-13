<?php $userRole = $this->Session->read('userRole'); ?>

<div class="allocations index">
	<div class="table_header">
		<div><h2><?php echo __('Allocations'); ?></h2></div>
		<div class="actions">
			<?php if ($userRole <= 2) { ?>
				<ul><li><?php echo $this->Html->link(__('New Allocation'), array('action' => 'add')); ?></li></ul>
			<?php } ?>
		</div>
	</div>
	<div class="client_user_content" style="display: flex">
		<div class="client_user_list" style="width: 7%; margin-right: 50px">
			<div class="client_user_list" style="width: 100%; margin-right: 50px">
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
		</div>
		<table cellpadding="0" cellspacing="0" class="clientAllocationsTable">
		<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('client_id'); ?></th>
				<th><?php echo $this->Paginator->sort('serviceno'); ?></th>
				<th><?php echo $this->Paginator->sort('alias'); ?></th>
				<th><?php echo $this->Paginator->sort('level1'); ?></th>
				<th><?php echo $this->Paginator->sort('level2'); ?></th>
				<th><?php echo $this->Paginator->sort('level3'); ?></th>
				<th><?php echo $this->Paginator->sort('level4'); ?></th>
				<th><?php echo $this->Paginator->sort('level5'); ?></th>
				<th><?php echo $this->Paginator->sort('level6'); ?></th>
				<th><?php echo $this->Paginator->sort('level7'); ?></th>
				<th><?php echo $this->Paginator->sort('level8'); ?></th>
				<th><?php echo $this->Paginator->sort('level9'); ?></th>
				<th><?php echo $this->Paginator->sort('level10'); ?></th>
				<th><?php echo $this->Paginator->sort('split'); ?></th>
				<th><?php echo $this->Paginator->sort('email'); ?></th>
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
			var clientID = this.id;
			getAllocationsByClient(clientID);
		});

		function getAllocationsByClient(clientID)
		{
			$.ajax({
				type: "POST",
				url: "<?php echo Router::url('/allocations/getAllocationListInClient'); ?>",
				data : { clientID : clientID },
				success: function (response_text) {
					var jsonResult = JSON.parse(response_text);

					var tableContents = '';
					var userRole = <?php echo $this->Session->read('userRole'); ?> ;

					tableContents += '<thead>' +
						'	<tr>' +
						'		<th><a href="/bondi/allocations/index/sort:id/direction:asc/controller:allocations">Id</a></th>' +
						'		<th><a href="/bondi/allocations/index/sort:serviceno/direction:asc/controller:allocations">Serviceno</a></th>' +
						'		<th><a href="/bondi/allocations/index/sort:alias/direction:asc/controller:allocations">Alias</a></th>' +
						'		<th><a href="/bondi/allocations/index/sort:level1/direction:asc/controller:allocations">Level1</a></th>' +
						'		<th><a href="/bondi/allocations/index/sort:level2/direction:asc/controller:allocations">Level2</a></th>' +
						'		<th><a href="/bondi/allocations/index/sort:level3/direction:asc/controller:allocations">Level3</a></th>' +
						'		<th><a href="/bondi/allocations/index/sort:level4/direction:asc/controller:allocations">Level4</a></th>' +
						'		<th><a href="/bondi/allocations/index/sort:level5/direction:asc/controller:allocations">Level5</a></th>' +
						'		<th><a href="/bondi/allocations/index/sort:level6/direction:asc/controller:allocations">Level6</a></th>' +
						'		<th><a href="/bondi/allocations/index/sort:level7/direction:asc/controller:allocations">Level7</a></th>' +
						'		<th><a href="/bondi/allocations/index/sort:level8/direction:asc/controller:allocations">Level8</a></th>' +
						'		<th><a href="/bondi/allocations/index/sort:level9/direction:asc/controller:allocations">Level9</a></th>' +
						'		<th><a href="/bondi/allocations/index/sort:level10/direction:asc/controller:allocations">Level10</a></th>' +
						'		<th><a href="/bondi/allocations/index/sort:split/direction:asc/controller:allocations">Split</a></th>' +
						'		<th><a href="/bondi/allocations/index/sort:email/direction:asc/controller:allocations">Email</a></th>' +
						'		<th class="actions">Actions</th>' +
						'	</tr>' +
						'</thead>' +
						'<tbody>';

					for (var index in jsonResult.data) {
						var allocation = jsonResult.data[index];
						tableContents +=
							'<tr>' +
							'	<td>' + allocation['id'] + ' &nbsp;</td>' +
							'	<td>' + allocation['serviceno'] + ' &nbsp;</td>' +
							'	<td>' + allocation['alias'] + ' &nbsp;</td>' +
							'	<td>' + allocation['level1'] + ' &nbsp;</td>' +
							'	<td>' + allocation['level2'] + ' &nbsp;</td>' +
							'	<td>' + allocation['level3'] + ' &nbsp;</td>' +
							'	<td>' + allocation['level4'] + ' &nbsp;</td>' +
							'	<td>' + allocation['level5'] + ' &nbsp;</td>' +
							'	<td>' + allocation['level6'] + ' &nbsp;</td>' +
							'	<td>' + allocation['level7'] + ' &nbsp;</td>' +
							'	<td>' + allocation['level8'] + ' &nbsp;</td>' +
							'	<td>' + allocation['level9'] + ' &nbsp;</td>' +
							'	<td>' + allocation['level10'] + ' &nbsp;</td>' +
							'	<td>' + allocation['split'] + ' &nbsp;</td>' +
							'	<td>' + allocation['email'] + ' &nbsp;</td>' +
							'   <td class="actions">';

						if (userRole > 2)
							tableContents +=
								'	 <a href="/bondi/allocation/view/' + allocation['id'] + '">View</a>';
						else
							tableContents +=
								'    <a href="/bondi/allocation/edit/' + allocation['id'] + '">Edit</a>' +
								'    <form action="/bondi/allocation/delete/' + allocation['id'] + '" ' +
								'    name="post_' + allocation['id'] + '" id="post_' + allocation['id'] + '" style="display:none;" method="post">' +
								'       <input type="hidden" name="_method" value="POST"/>' +
								'    </form>' +
								'    <a href="#" onclick="if (confirm(&quot;Are you sure you want to delete # ' + allocation['id'] + '?&quot;)) ' +
								'      { document.post_' + allocation['id'] + '.submit(); } event.returnValue = false; return false;">Delete</a>';

						tableContents += '  </td>' +
							'</tr>';
					}

					tableContents += '	</tbody>';
					$('.clientAllocationsTable').html(tableContents);
				},
				error: function () {
					alert("response error");
				}
			})
		}

		getAllocationsByClient(<?php echo $this->Session->read('workingClientID'); ?>)

	});
</script>
