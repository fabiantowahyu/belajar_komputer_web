<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<div class="span8 offset2 panel-box">
		<div><h3><?php echo $title_head; ?></h3></div>
		<?php echo form_open($url,array('class'=>'form-horizontal','id'=>'validation-form')); ?>
		<fieldset>
			<div class="control-group">
				<label for="TypeID" class="control-label">Type Code</label>
				<div class="controls">
					<?php
						$input = array('name'=>'id','value'=>$id,'maxlength'=>15,'id'=>'TypeID','class'=>'input-small','disabled'=>'disabled');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="TypeName" class="control-label">Type Name</label>
				<div class="controls">
					<?php
						$input = array('name'=>'name','value'=>$name,'maxlength'=>64,'id'=>'TypeName','class'=>'input-xlarge');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="TableName" class="control-label">Table Name</label>
				<div class="controls">
					<?php
						echo form_dropdown('table_name',$option_table_name,$table_name,'id="TableName"');
					?>
				</div>
			</div>
			<div id="TableNameOther">
				<div class="control-group">
					<label for="Other" class="control-label">Other</label>
					<div class="controls">
						<?php
							$input = array('name'=>'table_name_other','maxlength'=>32,'id'=>'Other','class'=>'input-xlarge');
							echo form_input($input);
						?>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label for="OrderNumber" class="control-label">Order Number</label>
				<div class="controls">
					<?php
						$input = array('name'=>'tid','value'=>$tid,'id'=>'OrderNumber','class'=>'input-mini');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button>&nbsp;
				<?php 
					echo anchor('master_type', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
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
<input type="hidden" name="id" id="delid" value="<?php echo $id; ?>">
<?php echo form_close(); ?>