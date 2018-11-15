<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<h3 class="header smaller lighter blue">
		<?php 
		echo anchor('disciplines_history', $title, array('class'=>'link-control')); 
		echo nbs(2);
		echo anchor('disciplines_history/CTRL_New', '<i class="icon-plus"></i>', array('class'=>'btn btn-info btn-mini'));
		?>
	</h3>

	<table id="table-disciplineshistory" class="table table-striped table-bordered table-hover">
		<thead class="info">
			<tr>
				<th width="100">EMP ID</th>
				<th width="150">Employee Name</th> 
				<th width="150">Reference No</th> 
				<th width="150">Disciplines Name</th>
				<th width="150">Start Date</th>
				<th width="150">End Date</th>
				<th width="50" class="center">Action</th> 
			</tr>
		</thead>

		<tbody>
			<?php foreach ($results as $row) { ?>
			<tr>
				<td><?php echo $row->emp_id; ?></td>
				<td><?php echo $row->emp_name; ?></td>
				<td><?php echo $row->reference_no; ?></td>
				<td><?php echo $row->disciplines_name; ?></td>
				<td><?php echo $row->start_date; ?></td>
				<td><?php echo $row->end_date; ?></td>
				<td class="center">
					<?php 
						echo anchor('disciplines_history/CTRL_Edit/' . $row->id, '<button class="btn btn-mini btn-info"><i class="icon-edit bigger-120"></i></button>');
					?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>