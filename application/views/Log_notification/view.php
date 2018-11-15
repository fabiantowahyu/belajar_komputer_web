<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<br><br>
<div class="row-fluid">
    <h3 class="header smaller lighter blue">
	<?php
	echo anchor('Log_notification', $title, array('class' => 'link-control'));
	?>
    </h3>

    <table id="table-log-notification" class="table table-striped table-bordered table-hover">
	<thead class="danger">
	    <tr>
		<th>Sender</th>
		<th>Message</th>
		<th>Timestamp</th>
	    </tr>
	</thead>
	<tbody>
	    <?php foreach ($results as $row) { ?>
    	    <tr>
    		<td><?php echo $row->first_name.' '.$row->middle_name.' '.$row->last_name; ?></td>
    		<td><?php echo $row->message; ?></td>
    		<td><?php echo date("d F Y -  H:m ",strtotime($row->recdate)); ?></td>
    	    </tr>
	    <?php } ?>
	</tbody>
    </table>
</div>