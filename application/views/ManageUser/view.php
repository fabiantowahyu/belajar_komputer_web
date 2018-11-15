<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<h3 class="header smaller lighter blue">
		<?php 
		echo anchor('manage_user', $title, array('class'=>'link-control')); 
		echo nbs(2);
		echo anchor('manage_user/CTRL_New', '<i class="icon-plus"></i>', array('class'=>'btn btn-success btn-mini'));
		?>
	</h3>

	<table id="table-group" class="table table-striped table-bordered table-hover">
		<thead class="success">
			<tr>
				<th width="150">Userid</th>
				<th width="250">Name</th>
				<th width="250">Email</th>
				<th width="100">Status</th>
				<th width="150">Last Login</th>
				<th width="10" class="center">Action</th> 
			</tr>
		</thead>

		<tbody>
			<?php foreach ($results as $row) { ?>
			<tr>
				<td><?php echo $row->userid; ?></td>
				<td><?php echo $row->username; ?></td>
				<td><?php echo $row->email; ?></td>
				<td><?php echo $row->active; ?></td>
				<td><?php echo $row->last_login; ?></td>
				<td class="center">
					<?php 
						echo anchor('manage_user/CTRL_Edit/' . $row->id, '<button class="btn btn-mini btn-info"><i class="icon-edit bigger-120"></i></button>');
					?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>