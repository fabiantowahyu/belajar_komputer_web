<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	<h3 class="header smaller lighter blue">
		<?php 
		echo 'Bank Account Information'; 
		?>
	</h3>

	<table id="table-bank" class="table table-striped table-bordered table-hover">
		<thead class="info">
			<tr>
				<th width="150">Bank Name</th>
				<th width="200">Bank Branch</th>
				<th width="100">Bank Account</th>
				<th width="100">Account Name</th>
				<th width="100">Currency</th>
                <th width="100">Saving Type</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($results_bank as $row) { ?>
			<tr>
				<td><?php echo $row->bank_name; ?></td>
				<td><?php echo $row->bank_branch; ?></td>
				<td><?php echo $row->bank_account; ?></td>
				<td><?php echo $row->account_name; ?></td>
                <td><?php echo $row->currency_id; ?></td>
				<td><?php echo $row->saving_type; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>