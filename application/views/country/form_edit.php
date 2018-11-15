<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	<div class="span12 offset panel-box2">
		<div><h3><?php echo $title_head; ?></h3></div>
		<?php echo form_open($url,array('name'=>'fmCountry','class'=>'form-horizontal','id'=>'validation-form')); ?>
		<fieldset>
			<h4 class="header blue bolder smaller">General</h4>
			<div class="control-group">
				<label for="CountryCode" class="control-label">Country Code <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'country_code','maxlength'=>16,'id'=>'CountryCode','class'=>'input-small','value'=>$country_code,'disabled'=>'disabled');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="CountryName" class="control-label">Country Name <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'country_name','maxlength'=>128,'id'=>'CountryName','class'=>'input-medium','value'=>$country_name);
						echo form_input($input);
					?>
				</div>
			</div>
            <i><span class="red bolder smaller">*</span>) Required</i>
           
			<div class="hr"></div>
			<div class="form-actions">
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button>&nbsp;
				<?php 
					echo anchor('country', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
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
<input type="hidden" name="id" id="delid" value="<?php echo $country_code; ?>">
<?php echo form_close(); ?>