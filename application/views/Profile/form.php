<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<?php echo form_open($url,array('class'=>'form-horizontal','id'=>'validation-form-password')); ?>
	<div class="control-group">
		<label for="OldPassword" class="control-label">Old Password</label>
		<div class="controls">
			<?php
				$input = array('name'=>'old_password','id'=>'OldPassword','maxlength'=>32,'class'=>'input-medium');
				echo form_password($input);
			?>
			<span class="lbl"></span>
		</div>
	</div>
	<div class="control-group">
		<label for="Password" class="control-label">New Password</label>
		<div class="controls">
			<?php
				$input = array('name'=>'password','id'=>'Password','maxlength'=>32,'class'=>'input-medium');
				echo form_password($input);
			?>
			<span class="lbl"></span>
		</div>
	</div>
	<div class="control-group">
		<label for="RePassword" class="control-label">Re-New Password</label>
		<div class="controls">
			<?php
				$input = array('name'=>'password_re','id'=>'RePassword','maxlength'=>32,'class'=>'input-medium');
				echo form_password($input);
			?>
			<span class="lbl"></span>
		</div>
	</div>
	
	<div class="hr"></div>
	<div class="form-action">
		<button type="submit" name="btnPassword" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
	</div>
	<?php echo form_close(); ?>
</div>