<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	
	<table id="table-family" class="table table-striped table-bordered table-hover">
		<thead class="info">
			<tr>
				<th width="150">Name</th>
				<th width="200">Relationship</th>
				<th width="100">Birth Place</th>
				<th width="100">Date of Birth</th>
				<th width="100">Dependent</th>
                <th width="100">Status</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($results_family as $row) { ?>
			<tr>
				<td><?php echo $row->empfamily_name; ?></td>
				<td><?php echo $row->relationship; ?></td>
				<td><?php echo $row->family_birthplace; ?></td>
				<td><?php echo $row->family_dob; ?></td>
                <td><?php echo $row->family_dependentsts; ?></td>
				<td><?php echo $row->alive_status; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>