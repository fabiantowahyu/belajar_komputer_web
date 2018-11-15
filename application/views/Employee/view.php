<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br>
<div class="row-fluid">
	<h3 class="header smaller lighter blue">
		<?php 
		echo anchor('employee', $title, array('class'=>'link-control')); 
		echo nbs(2);
		echo anchor('employee/CTRL_New', '<i class="icon-plus"></i>', array('class'=>'btn btn-info btn-mini'));
		?>
	</h3>

	<table id="table-employee" class="table table-striped table-bordered table-hover">
		<thead class="info">
			<tr>
				<th width="100">EMP ID</th>
				<th width="150">Employee Name</th>
				<th width="150">Position</th>
				<th width="150">Branch</th>
				<th width="150">Join Date</th>
				<th width="100">Gender</th>
				<th width="100">Mobile Phone</th>
				<th width="10" class="center">Action</th> 
			</tr>
		</thead>

		<tbody>
			<?php foreach ($results as $row) { ?>
			<tr>
				<td><a href="#" onclick="PopUpWindow('<?php echo $url_view.$row->emp_id; ?>','mywindow',800,600,'yes','yes'); return false;"><?php echo $row->emp_id; ?></a></td>
				<td><?php echo $row->emp_name;?></td>
				<td><?php echo $row->position_name; ?></td>
                <td><?php echo $row->branch; ?></td>
				<td><?php echo date("d M Y", strtotime($row->join_date)) ?></td>
				<td><?php echo $row->gender; ?></td>
				<td><?php echo $row->hp; ?></td>
				<td class="center">
					<?php 
						echo anchor('employee/CTRL_Edit/' . $row->emp_id, '<button class="btn btn-mini btn-info"><i class="icon-edit bigger-120"></i></button>');
					?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	localStorage.setItem('lastTab', '');
</script>