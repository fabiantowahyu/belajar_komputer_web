<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<div class="span11 offset panel-box">
		<h3 class="black">
			<span class="middle"><?php echo $title_head; ?>
            </span>
		</h3>

		<div class="profile-user-info profile-user-info-striped">
		<table id="table-newEmployee" class="table table-striped table-bordered table-hover">
          <thead class="info">
              <tr>
                  <th width="100">EMP ID</th>
                  <th width="130">Employee Name</th>
				  <th width="250">Position</th> 
				  <th width="100">Birth Date</th> 
              </tr>
          </thead>
          
          <tbody>
			<?php foreach ($results_birthday as $row) { ?>
			<tr>
				<td><?php echo $row->emp_id; ?></td>
				<td><?php echo $row->emp_name; ?></td>
				<td><?php echo $row->position_name; ?></td>
				<td><?php echo date("d M Y", strtotime($row->birth_date)); ?></td>
			</tr>
			<?php } ?>
		  </tbody>
        
        </table>	
		</div>

		<div class="form-actions">
			<input type="button" name="close" value="Close" class="btn btn-small btn-primary" onClick="self.close()">
		</div>
	</div>
</div>