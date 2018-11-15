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
				<label for="UserID" class="control-label">Userid <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'userid2','value'=>$userid2,'maxlength'=>32,'id'=>'UserID','class'=>'input-small');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="FirstName" class="control-label">First Name <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'first_name','value'=>$first_name,'maxlength'=>64,'id'=>'FirstName','class'=>'input-large');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="MiddleName" class="control-label">Middle Name</label>
				<div class="controls">
					<?php
						$input = array('name'=>'middle_name','value'=>$middle_name,'maxlength'=>64,'id'=>'MiddleName','class'=>'input-large');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="LastName" class="control-label">Last Name <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'last_name','value'=>$last_name,'maxlength'=>64,'id'=>'LastName','class'=>'input-large');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="Email" class="control-label">Email</label>
				<div class="controls">
					<?php
						$input = array('name'=>'email','value'=>$email,'maxlength'=>128,'id'=>'Email','class'=>'input-large');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="Status" class="control-label">Active</label>
				<div class="controls">
					<?php
						echo form_checkbox('active',1,$active,'class="ace-switch ace-switch-5"'); 
					?>
					<span class="lbl"></span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">&nbsp;</label>
				<label>
					<small class="green">
						<b>Reset Password</b>
					</small>

					<input id="skip-password" type="checkbox" name="choice_pwd" value="1" class="ace-switch ace-switch-6" />
					<span class="lbl"></span>
				</label>
			</div>
			<div id="reset-password">
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
					<label for="RePassword" class="control-label">Re-Type Password</label>
					<div class="controls">
						<?php
							$input = array('name'=>'password_re','id'=>'RePassword','maxlength'=>32,'class'=>'input-medium');
							echo form_password($input);
						?>
						<span class="lbl"></span>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
				<?php 
					echo anchor('manage_user', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
					echo form_hidden('userid',$userid);
					echo form_hidden('tabel',$tabel);
				?>
				<div class="btn-group">
					<button data-toggle="dropdown" class="btn btn-danger btn-small dropdown-toggle">
						More
						<span class="caret"></span>
					</button>	

					<ul class="dropdown-menu dropdown-danger">
						<li>
							<?php 
								echo anchor('manage_user/CTRL_Privileges_User/'.$userid, '<i class="icon-group"></i> Admin Group');
							?>
						</li>
						<li class="divider"></li>
						<li>
							<a href="#" id="cdelete"><i class="icon-trash"></i>&nbsp;Delete</a>
						</li>
					</ul>
				</div><!--/btn-group-->
			</div>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>
<?php echo form_open($url_del,array('name'=>'del','id'=>'del')); ?>
<input type="hidden" name="id" id="delid" value="<?php echo $userid; ?>">
<?php echo form_close(); ?>