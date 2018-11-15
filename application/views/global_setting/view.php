<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	<div class="span12 offset panel-box2">
		<?php echo form_open($url,array('name'=>'fmGlobalSetting','class'=>'form-horizontal','id'=>'validation-form')); ?>
		<fieldset>
			<h4 class="header blue bolder smaller">General</h4>
			
            <div class="control-group">
				<label for="PensionAge" class="control-label">Pension Age <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'pension_age','value'=>$pension_age,'maxlength'=>3,'id'=>'pension_age','class'=>'input-small');
						echo form_input($input);
					?>
				</div>
			</div>
            <div class="control-group">
				<label for="SenderEmail" class="control-label">Sender Email</label>
				<div class="controls">
					<?php
						$input = array('name'=>'sender_email','value'=>$sender_email,'maxlength'=>16,'id'=>'sender_email','class'=>'input-medium');
						echo form_input($input);
					?>
				</div>
			</div>
            <div class="control-group">
				<label for="LetterSignee" class="control-label">Letter Signee <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						echo form_dropdown('letter_signee',$option_lettersignee,$letter_signee,'id="letter_signee" class="span4"');
					?>
				</div>
			</div>
            <i><span class="red bolder smaller">*</span>) Required</i>
			<div class="hr"></div>
			<div>
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Update</button> &nbsp;
			</div>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>