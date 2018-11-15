<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	<h3 class="header smaller lighter blue">
		<?php 
		echo 'Disciplines History'; 
		echo nbs(2);
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
			</tr>
		</thead>

		<tbody>
			<?php foreach ($results_disciplines as $row) { ?>
			<tr>
				<td><?php echo $row->emp_id; ?></td>
				<td><?php echo $row->emp_name; ?></td>
				<td><?php echo $row->reference_no; ?></td>
				<td><?php echo $row->disciplines_name; ?></td>
				<td><?php echo $row->start_date; ?></td>
				<td style="text-align:left"><?php echo $row->end_date; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>