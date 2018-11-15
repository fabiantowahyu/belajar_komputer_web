<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	<div class="span12 offset panel-box2">
		<div><h3><?php echo $title_head; ?></h3></div>
		<?php echo form_open($url,array('name'=>'fmProvince','class'=>'form-horizontal','id'=>'validation-form')); ?>
		<fieldset>
			<h4 class="header blue bolder smaller">General</h4>
			<div class="control-group">
				<label for="ProvinceCode" class="control-label">Province Code <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'province_code','maxlength'=>16,'id'=>'ProvinceCode','class'=>'input-small');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="ProvinceName" class="control-label">Province Name <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'province_name','maxlength'=>128,'id'=>'ProvinceName','class'=>'input-medium');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="CountryName" class="control-label">Country <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						echo form_dropdown('country',$option_country,$country,'id="CountryName" class="span4"');
                    ?>
				</div>
			</div>
            <i><span class="red bolder smaller">*</span>) Required</i>
			<div class="hr"></div>
			<div class="form-actions">
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
				<?php 
					echo anchor('province', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
				?>
			</div>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>