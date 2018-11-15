<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<br><br>
<div class="row-fluid">
    <h3 class="header smaller lighter blue">
	<?php
	echo anchor('Letter Template', $title, array('class' => 'link-control'));
	echo nbs(2);
	echo anchor('letter_template/CTRL_New', '<i class="icon-plus"></i>', array('class' => 'btn btn-danger btn-mini'));
	?>
    </h3>

    <table id="table-lettertemplate" class="table table-striped table-bordered table-hover">
	<thead class="danger">
	    <tr>
		<th width="100">Template Id</th> 
		<th width="100"><?php echo $title; ?> Name</th> 
                <th width="250">Used on</th> 
                <th width="50">Status</th> 
		<th width="10" class="center">Action</th> 
	    </tr>
	</thead>

	<tbody>
	    <?php foreach ($results as $row) { ?>
    	    <tr>
    		<td><?php echo $row->id; ?></td>
    		<td><?php echo $row->template_name; ?></td>
                    <td><?php echo $row->used_on; ?></td>
                    <td><?php echo $row->status; ?></td>
    		<td class="center">
			<?php
			echo anchor('letter_template/CTRL_Edit/' . $row->id, '<button class="btn btn-mini btn-info"><i class="icon-edit bigger-120"></i></button>');
			?>
    		</td>
    	    </tr>
	    <?php } ?>
	</tbody>
    </table>
</div>