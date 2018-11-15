<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	<div class="span12 offset panel-box2">
		<div><h3><?php echo $title_head; ?></h3></div>
		<?php echo form_open($url,array('class'=>'form-horizontal','id'=>'validation-form')); ?>
		<fieldset>
			<h4 class="header blue bolder smaller">General</h4>
			<div class="control-group">
				<label for="template_id" class="control-label">Template ID</label>
				<div class="controls">
					<?php
						$input = array('name'=>'id','value'=>$id,'maxlength'=>15,'id'=>'template_id','class'=>'input-small','disabled'=>'disabled');
						echo form_input($input);
					?>
				</div>
			</div>
            <div class="control-group">
				<label for="TemplateName" class="control-label">Template Name <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'template_name','maxlength'=>100,'id'=>'TemplateName','class'=>'input-large');
						echo form_input($input);
					?>
				</div>
			</div>
            <div class="control-group">
				<label for="used_on" class="control-label">Used On</label>
				<div class="controls">
					<?php
						$input = array('name'=>'used_on','maxlength'=>100,'id'=>'used_on','class'=>'input-large');
						echo form_input($input);
					?>
				</div>
			</div>         
            <div class="control-group">
                <label for="Status" class="control-label">Active</label>
                <div class="controls">
                    <?php
                        echo form_checkbox('status',1,0,'class="ace-switch ace-switch-5"');
                    ?>
                    <span class="lbl"></span>
                </div>
            </div>
         
            <div class="control-group">
				<label for="Editor" class="control-label"></label>
				<div class="controls">
					<?php
						fckeditor();
						// Automatically calculates the editor base path based on the _samples directory.
						// This is usefull only for these samples. A real application should use something like this:
						// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
		
						$oFCKeditor = new FCKeditor('content') ;
						$oFCKeditor->BasePath = base_url().'plugins/FCKeditor/'; 
		
						$oFCKeditor->Config['SkinPath'] = base_url() . 'plugins/FCKeditor/skins/silver/';
						$oFCKeditor->Height = '400';
						$oFCKeditor->Value = $content;
						$oFCKeditor->Create() ;
					?>
				</div>
			</div>   
           
			<div class="hr"></div>
			<div class="form-actions">
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
				<?php 
					echo anchor('letter_template', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
					echo form_hidden('id',$id);
				?>
			</div>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>