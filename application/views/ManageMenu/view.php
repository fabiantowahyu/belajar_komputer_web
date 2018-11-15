<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<h3 class="header smaller lighter blue">
		<?php 
		echo anchor('manage_menu', $title, array('class'=>'link-control')); 
		echo nbs(2);
		echo anchor('manage_menu/CTRL_New', '<i class="icon-plus"></i>', array('class'=>'btn btn-success btn-mini'));
		?>
	</h3>

	<table id="table-menu" class="table table-striped table-bordered table-hover">
		<thead class="success">
			<tr>
				<th width="200">Custom Title</th>
				<th width="200">Parent</th> 
				<th width="150">URL</th> 
				<th width="50">Order Number</th> 
				<th width="100">Status</th> 
				<th width="10" class="center">Action</th> 
			</tr>
		</thead>

		<tbody>
			<?php foreach ($results as $row) { ?>
			<tr>
				<td><?php echo $row->custom_title; ?></td>
				<td><?php echo $row->parentt; ?></td>
				<td><?php echo $row->url_menu; ?></td>
				<td><?php echo $row->tid; ?></td>
				<td><?php echo $row->active; ?></td>
				<td class="center">
					<?php 
						echo anchor('manage_menu/CTRL_Edit/' . $row->id, '<button class="btn btn-mini btn-info"><i class="icon-edit bigger-120"></i></button>');
					?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>