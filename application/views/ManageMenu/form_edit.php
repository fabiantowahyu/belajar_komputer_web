<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<div class="span8 offset2 panel-box">
		<div><h3><?php echo $title; ?></h3></div>
		<?php echo form_open($url,array('class'=>'form-horizontal','id'=>'validation-form')); ?>
		<fieldset>
			<div class="control-group">
				<label for="CustomTitle" class="control-label">Custom Title</label>
				<div class="controls">
					<?php
						$input = array('name'=>'custom_title','value'=>$custom_title,'maxlength'=>64,'id'=>'CustomTitle','class'=>'input-xlarge');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="URL" class="control-label">URL</label>
				<div class="controls">
					<?php
						$input = array('name'=>'url_menu','value'=>$url_menu,'id'=>'URL','class'=>'input-xlarge');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="PathIcon" class="control-label">Path Icon</label>
				<div class="controls">
					<?php
						$input = array('name'=>'path_icon','value'=>$path_icon,'id'=>'PathIcon','class'=>'input-xlarge');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="Parent" class="control-label">Parent</label>
				<div class="controls">
					<?php
						echo form_dropdown('parent_id',$option_parent_id,$parent_id,'id="Parent"');
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="OrderNumber" class="control-label">Order Number</label>
				<div class="controls">
					<?php
						$input = array('name'=>'tid','value'=>$tid,'id'=>'OrderNumber','class'=>'input-mini txtNumber','onkeypress'=>'return numbersonly(event)');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="URL" class="control-label">Active</label>
				<div class="controls">
					<?php
						echo form_checkbox('active',1,$active,'class="ace-switch ace-switch-3"'); 
					?>
					<span class="lbl"></span>
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
				<?php 
					echo anchor('manage_menu', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
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