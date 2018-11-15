<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br /><br />
<div class="row-fluid">
	<div class="span8 offset2 panel-box">
		<div><h3><?php echo $title_head; ?></h3></div>
		<?php echo form_open($url,array('class'=>'form-horizontal','id'=>'validation-form')); ?>
		<fieldset>
			<h4 class="header blue bolder smaller">General</h4>
			<div class="control-group">
				<label for="StatusCode" class="control-label">Status Code <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'status_code','maxlength'=>15,'id'=>'BranchID','class'=>'input-small');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="StatusName" class="control-label">Status Name <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'status_name','maxlength'=>32,'class'=>'input-xlarge');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="hr"></div>
			<div class="form-actions">
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
				<?php 
					echo anchor('employee_status', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
				?>
			</div>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>