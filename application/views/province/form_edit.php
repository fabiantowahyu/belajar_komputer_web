<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	<div class="span12 offset panel-box2">
		<div><h3><?php echo $title_head; ?></h3></div>
		<?php echo form_open($url,array('name'=>'fmCountry','class'=>'form-horizontal','id'=>'validation-form')); ?>
		<fieldset>
			<h4 class="header blue bolder smaller">General</h4>
			<div class="control-group">
				<label for="ProvinceCode" class="control-label">Province Code <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'province_code','maxlength'=>16,'id'=>'ProvinceCode','class'=>'input-small','value'=>$province_code,'disabled'=>'disabled');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="ProvinceName" class="control-label">Province Name <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'province_name','maxlength'=>128,'id'=>'ProvinceName','class'=>'input-medium','value'=>$province_name);
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
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button>&nbsp;
				<?php 
					echo anchor('province', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
					echo nbs(1);
					echo form_hidden('id',$id);
				?>
				<a href="#" id="cdelete" class="btn btn-small btn-danger"><i class="icon-trash"></i>&nbsp;Delete</a>
			</div>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>
<?php echo form_open($url_del,array('name'=>'del','id'=>'del')); ?>
<input type="hidden" name="id" id="delid" value="<?php echo $province_code; ?>">
<?php echo form_close(); ?>