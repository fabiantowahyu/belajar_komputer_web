<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<div class="span8 offset2 panel-box">
		<div><h3><?php echo $title; ?></h3></div>
		<?php echo form_open($url,array('name'=>'myForm','class'=>'form-horizontal','id'=>'validation-form')); ?>
		<fieldset>
			<div class="control-group">
				<label for="UserID" class="control-label">User ID</label>
				<div class="controls">
					<?php
						$input = array('name'=>'userid','value'=>$userid,'id'=>'UserID','class'=>'input-xlarge','disabled'=>'disabled');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="Username" class="control-label">Username</label>
				<div class="controls">
					<?php
						$input = array('name'=>'username','value'=>$username,'id'=>'Username','class'=>'input-xlarge','disabled'=>'disabled');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="OldPassword" class="control-label">Old Password</label>
				<div class="controls">
					<?php
						$input = array('name'=>'password','id'=>'OldPassword','maxlength'=>32,'class'=>'input-xlarge');
						echo form_password($input);
					?>
					<span class="lbl"></span>
				</div>
			</div>
			<div class="control-group">
				<label for="NewPassword" class="control-label">New Password</label>
				<div class="controls">
					<?php
						$input = array('name'=>'password_new','id'=>'NewPassword','maxlength'=>32,'class'=>'input-xlarge');
						echo form_password($input);
					?>
					<span class="lbl"></span>
				</div>
			</div>
			<div class="control-group">
				<label for="RePassword" class="control-label">Re-Type Password</label>
				<div class="controls">
					<?php
						$input = array('name'=>'password_re','id'=>'RePassword','maxlength'=>32,'class'=>'input-xlarge');
						echo form_password($input);
					?>
					<span class="lbl"></span>
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
				<?php 
					echo anchor('admin', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
					echo nbs(1);
					echo form_hidden('userid',$userid);
				?>
			</div>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>