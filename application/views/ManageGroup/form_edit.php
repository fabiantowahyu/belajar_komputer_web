<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<div class="span8 offset2 panel-box">
		<div><h3><?php echo $title; ?></h3></div>
		<?php echo form_open($url,array('name'=>'myForm','class'=>'form-horizontal','id'=>'validation-form')); ?>
		<fieldset>
			<div class="control-group">
				<label for="GroupName" class="control-label">Group Name</label>
				<div class="controls">
					<?php
						$input = array('name'=>'nama','value'=>$nama,'maxlength'=>64,'id'=>'GroupName','class'=>'input-xlarge');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="Description" class="control-label">Description</label>
				<div class="controls">
					<?php
						$input = array('name'=>'description','value'=>$description,'maxlength'=>128,'id'=>'Description','class'=>'input-xlarge');
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
					echo anchor('manage_group', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
					echo nbs(1);
					echo form_hidden('id',$id);
				?>
				<div class="btn-group">
					<button data-toggle="dropdown" class="btn btn-danger btn-small dropdown-toggle">
						More
						<span class="caret"></span>
					</button>	

					<ul class="dropdown-menu dropdown-danger">
						<li>
							<?php 
								echo anchor('manage_group/CTRL_Privileges_User/'.$id, '<i class="icon-group"></i> Admin Group');
							?>
						</li>
						<li>
							<?php 
								echo anchor('manage_group/CTRL_Privileges_Menu/'.$id, '<i class="icon-key"></i> User Authorization Group');
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
<input type="hidden" name="id" id="delid" value="<?php echo $id; ?>">
<?php echo form_close(); ?>