<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	<h3 class="header smaller lighter blue">
		<?php 
		echo 'Training'; 
		if($isEdit) {
			echo nbs(2);
			echo anchor('profile/CTRL_New_Training/'.$id, '<i class="icon-plus"></i>', array('class'=>'btn btn-warning btn-mini'));
		}
		?>
	</h3>

	<table id="table-training" class="table table-striped table-bordered table-hover">
		<thead class="info">
			<tr>
				<th width="150">Subject</th>
				<th width="200">Topic</th>
				<th width="100">Commenced</th>
				<th width="100">Complete Date</th>
				<th width="100">Training Type</th>
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
			<?php foreach ($results_training as $row) { ?>
			<tr>
				<td><?php echo $row->subject; ?></td>
				<td><?php echo $row->topic; ?></td>
				<td><?php echo $row->startdate; ?></td>
				<td><?php echo $row->enddate; ?></td>
				<td><?php echo $row->type; ?></td>
				<td class="center">
				<?php 
				if($isEdit) { 
					echo anchor('profile/CTRL_Edit_Training/' . $id . '/' . $row->id, '<button class="btn btn-mini btn-info"><i class="icon-edit bigger-120"></i></button>');
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