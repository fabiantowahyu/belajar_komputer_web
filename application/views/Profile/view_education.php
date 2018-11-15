<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	<h3 class="header smaller lighter blue">
		<?php 
		echo 'Education'; 
		if($isEdit) {
			echo nbs(2);
			echo anchor('profile/CTRL_New_Education/'.$id, '<i class="icon-plus"></i>', array('class'=>'btn btn-warning btn-mini'));
		}
		?>
	</h3>

	<table id="table-education" class="table table-striped table-bordered table-hover">
		<thead class="info">
			<tr>
				<th width="150">Education Level</th>
                <th width="150">Faculty</th>
				<th width="150">Institution</th>
				<th width="100">Start Date</th>
				<th width="100">End Date</th>
				<th width="10" class="center">
					<?php 
					if($isEdit) { 
						echo 'Action';
					} else {
						echo '&nbsp;';
					}
					?>
				</th>
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
				<td class="center">
				<?php 
				if($isEdit) { 
					echo anchor('profile/CTRL_Edit_Education/' . $id . '/' . $row->id, '<button class="btn btn-mini btn-info"><i class="icon-edit bigger-120"></i></button>');
				} else {
					echo '&nbsp;';
				}
				?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>