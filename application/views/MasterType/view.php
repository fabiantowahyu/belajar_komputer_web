<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<h3 class="header smaller lighter blue">
		<?php 
		echo anchor('master_type', $title, array('class'=>'link-control')); 
		echo nbs(2);
		echo anchor('master_type/CTRL_New', '<i class="icon-plus"></i>', array('class'=>'btn btn-danger btn-mini'));
		?>
	</h3>

	<table id="table-type" class="table table-striped table-bordered table-hover">
		<thead class="danger">
			<tr>
				<th width="100">Type Code</th>
				<th width="150">Type Name</th> 
				<th width="150">Table Name</th> 
				<th width="50">Order Number</th> 
				<th width="10" class="center">Action</th> 
			</tr>
		</thead>

		<tbody>
			<?php foreach ($results as $row) { ?>
			<tr>
				<td><?php echo $row->id; ?></td>
				<td><?php echo $row->name; ?></td>
				<td><?php echo $row->table_name; ?></td>
				<td><?php echo $row->tid; ?></td>
				<td class="center">
					<?php 
						echo anchor('master_type/CTRL_Edit/' . $row->id, '<button class="btn btn-mini btn-info"><i class="icon-edit bigger-120"></i></button>');
					?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>