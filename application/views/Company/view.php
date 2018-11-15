<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<h3 class="header smaller lighter blue">
		<?php 
		echo anchor('company', $title, array('class'=>'link-control')); 
		echo nbs(2);
		echo anchor('company/CTRL_New', '<i class="icon-plus"></i>', array('class'=>'btn btn-danger btn-mini'));
		?>
	</h3>

	<table id="table-company" class="table table-striped table-bordered table-hover">
		<thead class="danger">
			<tr>
				<th width="100"><?php echo $title; ?> ID</th>
				<th width="250"><?php echo $title; ?> Name</th>
				<th width="200">Address</th>
				<th width="100">Phone</th>
				<th width="100">Email</th>
				<th width="100">Fax</th>
				<th width="10" class="center">Action</th> 
			</tr>
		</thead>

		<tbody>
			<?php foreach ($results as $row) { ?>
			<tr>
				<td><a href="#" onclick="PopUpWindow('<?php echo $url_view.$row->id; ?>','mywindow',800,600,'yes','yes'); return false;"><?php echo $row->id; ?></a></td>
				<td><?php echo $row->name; ?></td>
				<td><?php echo $row->address; ?></td>
				<td><?php echo $row->phone; ?></td>
				<td><?php echo $row->email; ?></td>
				<td><?php echo $row->fax; ?></td>
				<td class="center">
					<?php 
						echo anchor('company/CTRL_Edit/' . $row->id, '<button class="btn btn-mini btn-info"><i class="icon-edit bigger-120"></i></button>');
					?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
