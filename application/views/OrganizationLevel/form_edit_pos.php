<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<div class="span10 offset1 panel-box2">
		<h3 class="black">
			<span class="middle"><?php echo $title; ?></span>
		</h3>
		<?php echo form_open($url,array('name'=>'myForm','class'=>'form-horizontal','id'=>'validation-form-det')); ?>
		<div class="hr"></div>
        <span class="red bolder smaller">Fields with * are required.</span>
		<div class="hr"></div>
		<h4 class="header blue bolder smaller">Edit Position Parent</h4>

		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name">Current Parent Position</div>

				<div class="profile-info-value">
					<span>
						<?php
							$input = array('name'=>'position_name','value'=>$position_name,'id'=>'PosName','class'=>'span12','disabled'=>'disabled');
							echo form_input($input);
							//echo form_hidden('parentpath',$parentpath);
						?>
					</span>
				</div>
			</div>
			<div class="profile-info-row">
				<div class="profile-info-name">New Parent Position *</div>

				<div class="profile-info-value">
					<span>
						<?php
							echo form_dropdown('posparent',$option_posparent,$posparent,'id="New Parent" class="span12"');
						?>
					</span>
				</div>
			</div>	
		</div>

		<div class="form-actions">
			<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
			<input type="button" name="close" value="Close" class="btn btn-small btn-primary" onClick="self.close()">
		</div>
		<?php echo form_close(); ?>
	</div>
</div>