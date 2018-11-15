<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	<div class="span12 offset panel-box2">
		<div><h3><?php echo $title_head; ?></h3></div>
		<?php echo form_open($url,array('name'=>'fmCostCenter','class'=>'form-horizontal','id'=>'validation-form')); ?>
		<fieldset>
			<h4 class="header blue bolder smaller">General</h4>
			<div class="control-group">
				<label for="CountryCode" class="control-label">Country Code <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'country_code','maxlength'=>16,'id'=>'CountryCode','class'=>'input-small');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="CountryName" class="control-label">Country Name <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'country_name','maxlength'=>128,'id'=>'CountryName','class'=>'input-medium');
						echo form_input($input);
					?>
				</div>
			</div>
            <i><span class="red bolder smaller">*</span>) Required</i>
			<div class="hr"></div>
			<div class="form-actions">
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
				<?php 
					echo anchor('country', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
				?>
			</div>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>