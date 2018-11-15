<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<div class="span8 offset2 panel-box">
		<div><h3><?php echo $title; ?></h3></div>
		<?php echo form_open($url,array('name'=>'myForm','class'=>'form-horizontal','id'=>'validation-form')); ?>
		<fieldset>
			<div class="control-group">
				<label for="GroupName" class="control-label">Group Name</label>
				<div class="controls">
					<?php
						$input = array('name'=>'nama','maxlength'=>64,'id'=>'GroupName','class'=>'input-xlarge');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="Description" class="control-label">Description</label>
				<div class="controls">
					<?php
						$input = array('name'=>'description','maxlength'=>128,'id'=>'Description','class'=>'input-xlarge');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="URL" class="control-label">Active</label>
				<div class="controls">
					<?php
						echo form_checkbox('active',1,0,'class="ace-switch ace-switch-3"'); 
					?>
					<span class="lbl"></span>
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
				<?php 
					echo anchor('manage_group', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
				?>
			</div>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>