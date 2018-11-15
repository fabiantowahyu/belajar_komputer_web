<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<h3 class="header smaller lighter blue">
		<?php 
		echo anchor('manage_group', $title, array('class'=>'link-control')); 
		echo nbs(2);
		echo anchor('manage_group/CTRL_New', '<i class="icon-plus"></i>', array('class'=>'btn btn-success btn-mini'));
		?>
	</h3>

	<table id="table-group" class="table table-striped table-bordered table-hover">
		<thead class="success">
			<tr>
				<th width="100">Group ID</th>
				<th width="250">Group Name</th>
				<th width="300">Description</th>
				<th width="100">Status</th>
				<th width="10" class="center">Action</th> 
			</tr>
		</thead>

		<tbody>
			<?php foreach ($results as $row) { ?>
			<tr>
				<td><?php echo $row->id; ?></td>
				<td><?php echo $row->nama; ?></td>
				<td><?php echo $row->description; ?></td>
				<td><?php echo $row->active; ?></td>
				<td class="center">
					<?php 
						echo anchor('manage_group/CTRL_Edit/' . $row->id, '<button class="btn btn-mini btn-info"><i class="icon-edit bigger-120"></i></button>');
					?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>