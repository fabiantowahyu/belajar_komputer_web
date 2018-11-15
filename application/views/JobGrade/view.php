<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<h3 class="header smaller lighter blue">
		<?php 
		echo anchor('job_grade', $title, array('class'=>'link-control')); 
		echo nbs(2);
		echo anchor('job_grade/CTRL_New', '<i class="icon-plus"></i>', array('class'=>'btn btn-danger btn-mini'));
		?>
	</h3>

	<table id="table-grade" class="table table-striped table-bordered table-hover">
		<thead class="danger">
			<tr>
				<th width="100">Grade Code</th>
				<th width="150">Grade Name</th> 
				<th width="50">Currency</th> 
                <th width="100">Min Pay</th> 
                <th width="100">Mid Pay</th> 
                <th width="100">Max Pay</th> 
				<th width="50" class="center">Action</th> 
			</tr>
		</thead>

		<tbody>
			<?php foreach ($results as $row) { ?>
			<tr>
				<td><a href="#" onclick="PopUpWindow('<?php echo $url_view.$row->id; ?>','mywindow',600,520,'yes','yes'); return false;"><?php echo $row->grade_code; ?></a></td>
				<td><?php echo $row->grade_name; ?></td>
				<td class="center"><?php echo $row->currency; ?></td>
                <td class="center"><?php echo number_format($row->minimum_pay,2); ?></td>
                <td class="center"><?php echo number_format($row->mid_pay,2); ?></td>
                <td class="center"><?php echo number_format($row->maximum_pay,2); ?></td>
				<td class="center">
					<?php 
						echo anchor('job_grade/CTRL_Edit/' . $row->id, '<button class="btn btn-mini btn-info"><i class="icon-edit bigger-120"></i></button>');
					?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>