<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	<h3 class="header smaller lighter blue">
		<?php 
		echo 'Awards History'; 
		echo nbs(2);
		?>
	</h3>

	<table id="table-awardhistory" class="table table-striped table-bordered table-hover">
		<thead class="info">
			<tr>
				<th width="100">EMP ID</th>
				<th width="150">Employee Name</th> 
				<th width="150">Reference No</th> 
				<th width="150">Award Name</th>
				<th width="150">Date</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($results_award as $row) { ?>
			<tr>
				<td><?php echo $row->emp_id; ?></td>
				<td><?php echo $row->emp_name; ?></td>
				<td><?php echo $row->reference_no; ?></td>
				<td><?php echo $row->achievement_name; ?></td>
				<td style="text-align:left"><?php echo $row->date; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>