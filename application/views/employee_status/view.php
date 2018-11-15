<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<h3 class="header smaller lighter blue">
		<?php 
		echo anchor('employee_status', $title, array('class'=>'link-control')); 
		echo nbs(2);
		echo anchor('employee_status/CTRL_New', '<i class="icon-plus"></i>', array('class'=>'btn btn-danger btn-mini'));
		?>
	</h3>

	<table id="table-empstatus" class="table table-striped table-bordered table-hover">
		<thead class="danger">
			<tr>
				<th width="100">Status Code</th>
				<th width="150">Employee Status</th>
				<th width="10" class="center">Action</th> 
			</tr>
		</thead>

		<tbody>
			<?php foreach ($results as $row) { ?>
			<tr>
				<td><a href="#" onclick="PopUpWindow('<?php echo $url_view.$row->id; ?>','mywindow',600,520,'yes','yes'); return false;"><?php echo $row->employmentstatus_code; ?></a></td>
				<td><?php echo $row->employmentstatus_name; ?></td>
				<td class="center">
					<?php 
						echo anchor('employee_status/CTRL_Edit/' . $row->id, '<button class="btn btn-mini btn-info"><i class="icon-edit bigger-120"></i></button>');
					?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>