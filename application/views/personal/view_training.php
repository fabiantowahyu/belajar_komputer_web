<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	
	<table id="table-training" class="table table-striped table-bordered table-hover">
		<thead class="info">
			<tr>
				<th width="150">Subject</th>
				<th width="200">Topic</th>
				<th width="100">Commenced</th>
				<th width="100">Complete Date</th>
				<th width="100">Training Type</th>
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
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>