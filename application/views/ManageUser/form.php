<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<div class="span8 offset2 panel-box">
		<div><h3><?php echo $title; ?></h3></div>
		<?php echo form_open($url,array('name'=>'myForm','class'=>'form-horizontal','id'=>'validation-form')); ?>
		<div class="hr"></div>
        <span class="red bolder smaller">Fields with * are required.</span>
		<div class="hr"></div>
		<fieldset>
			<div class="control-group">
				<label for="UserID" class="control-label">Userid *</label>
				<div class="controls">
					<?php
						$input = array('name'=>'userid','maxlength'=>32,'id'=>'UserID','class'=>'input-small');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="FirstName" class="control-label">First Name *</label>
				<div class="controls">
					<?php
						$input = array('name'=>'first_name','maxlength'=>64,'id'=>'FirstName','class'=>'input-large');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="MiddleName" class="control-label">Middle Name</label>
				<div class="controls">
					<?php
						$input = array('name'=>'middle_name','maxlength'=>64,'id'=>'MiddleName','class'=>'input-large');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="LastName" class="control-label">Last Name *</label>
				<div class="controls">
					<?php
						$input = array('name'=>'last_name','maxlength'=>64,'id'=>'LastName','class'=>'input-large');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="Email" class="control-label">Email</label>
				<div class="controls">
					<?php
						$input = array('name'=>'email','maxlength'=>128,'id'=>'Email','class'=>'input-large');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="Password" class="control-label">Password *</label>
				<div class="controls">
					<?php
						$input = array('name'=>'password','id'=>'Password','maxlength'=>32,'class'=>'input-medium');
						echo form_password($input);
					?>
					<span class="lbl"></span>
				</div>
			</div>
			<div class="control-group">
				<label for="RePassword" class="control-label">Re-Type Password *</label>
				<div class="controls">
					<?php
						$input = array('name'=>'password_re','id'=>'RePassword','maxlength'=>32,'class'=>'input-medium');
						echo form_password($input);
					?>
					<span class="lbl"></span>
				</div>
			</div>
			<div class="control-group">
				<label for="Status" class="control-label">Active</label>
				<div class="controls">
					<?php
						echo form_checkbox('active',1,0,'class="ace-switch ace-switch-5"'); 
					?>
					<span class="lbl"></span>
				</div>
			</div>
		
			<div class="form-actions">
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
				<?php 
					echo anchor('manage_user', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
				?>
			</div>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>