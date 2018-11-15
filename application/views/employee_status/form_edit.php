<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br /><br />
<div class="row-fluid">
	<div class="span8 offset2 panel-box">
		<div><h3><?php echo $title_head; ?></h3></div>
		<?php echo form_open($url,array('class'=>'form-horizontal','id'=>'validation-form')); ?>
		<fieldset>
			<h4 class="header blue bolder smaller">General</h4>
			<div class="control-group">
				<label for="StatusCode" class="control-label">Status Code <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'status_code','value'=>$status_code,'maxlength'=>15,'id'=>'BranchID','class'=>'input-small');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="StatusName" class="control-label">Status Name <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'status_name','value'=>$status_name,'maxlength'=>32,'class'=>'input-xlarge');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="hr"></div>
			<div>
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
				
				<?php 
					echo anchor('employee_status', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
					echo form_hidden('id',$id);
				?>
				<a href="#" id="cdelete" class="btn btn-small btn-danger"><i class="icon-trash"></i>&nbsp;Delete</a>&nbsp;
			</div>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>

<?php echo form_open($url_del,array('name'=>'del','id'=>'del')); ?>
<input type="hidden" name="id" id="delid" value="<?php echo $id; ?>">
<?php echo form_close(); ?>