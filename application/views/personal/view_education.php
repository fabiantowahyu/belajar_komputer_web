<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	
	<table id="table-education" class="table table-striped table-bordered table-hover">
		<thead class="info">
			<tr>
				<th width="150">Education Level</th>
                <th width="150">Faculty</th>
				<th width="150">Institution</th>
				<th width="100">Start Date</th>
				<th width="100">End Date</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($results_education as $row) { ?>
			<tr>
				<td><?php echo $row->education_lvl; ?></td>
				<td><?php echo $row->faculty; ?></td>
				<td><?php echo $row->institution; ?></td>
                <td><?php echo $row->startdate; ?></td>
				<td><?php echo $row->enddate; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>