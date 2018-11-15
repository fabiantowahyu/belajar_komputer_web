<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	<h3 class="header smaller lighter blue">
		<?php 
		echo 'Training'; 
		echo nbs(2);
		echo anchor('employee/CTRL_New_Training/'.$id, '<i class="icon-plus"></i>', array('class'=>'btn btn-warning btn-mini'));
		?>
	</h3>

	<table id="table-training" class="table table-striped table-bordered table-hover">
		<thead class="info">
			<tr>
				<th width="150">Subject</th>
				<th width="200">Topic</th>
				<th width="100">Commenced</th>
				<th width="100">Complete Date</th>
				<th width="100">Training Type</th>
				<th width="10" class="center">Action</th> 
			</tr>
		</thead>

		<tbody>
			<?php foreach ($results_training as $row) { ?>
			<tr>
				<td><?php echo $row->subject; ?></td>
				<td><?php echo $row->topic; ?></td>
				<td><?php echo $row->startdate; ?></td>
				<td><?php echo $row->enddate; ?></td>
				<td><?php echo $row->type; ?></td>
				<td class="center">
					<?php 
						echo anchor('employee/CTRL_Edit_Training/' . $id . '/' . $row->id, '<button class="btn btn-mini btn-info"><i class="icon-edit bigger-120"></i></button>');
					?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>