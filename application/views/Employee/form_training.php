<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<div class="span12 offset panel-box2">
		<div><h3><?php echo $title_head; ?></h3></div>
		<?php echo form_open($url,array('name'=>'myForm','class'=>'form-horizontal','id'=>'validation-form-training')); ?>
		
		<div class="hr"></div>
		<div class="row-fluid">
			<div class="span6">
				<div class="control-group">
					<label for="Subject" class="control-label">Subject <span class="red bolder smaller">*</span></label>
					<div class="controls">
						<?php
							$input = array('name'=>'subject','maxlength'=>64,'id'=>'Subject','class'=>'span10');
							echo form_input($input);
						?>
					</div>
				</div>
				<div class="control-group">
					<label for="Topic" class="control-label">Topic <span class="red bolder smaller">*</span></label>
					<div class="controls">
						<?php
							$txtarea = array('name'=>'topic','rows'=>2,'class'=>'span10','id'=>'Topic');
							echo form_textarea($txtarea); 
						?>
					</div>
				</div>
				<div class="control-group">
					<label for="StartDate-Education" class="control-label">Commenced <span class="red bolder smaller">*</span></label>
					<div class="controls">
						<div class="row-fluid input-append">
							<?php
								$input = array('name'=>'startdate','id'=>'StartDate-Education','class'=>'input-small');
								echo form_input($input);
							?>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label for="EndDate-Education" class="control-label">Completed Date <span class="red bolder smaller">*</span></label>
					<div class="controls">
						<div class="row-fluid input-append">
							<?php
								$input = array('name'=>'enddate','id'=>'EndDate-Education','class'=>'input-small');
								echo form_input($input);
							?>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label for="CertificateNumber" class="control-label">Certificate Number</label>
					<div class="controls">
						<?php
							$input = array('name'=>'certificate_num','maxlength'=>32,'id'=>'CertificateNumber','class'=>'input-xlarge');
							echo form_input($input);
						?>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="control-group">
					<label for="TrainingType" class="control-label">Training Type</label>
					<div class="controls">
						<?php
							//$input = array('name'=>'type','maxlength'=>32,'id'=>'TrainingType','class'=>'input-xlarge');
							//echo form_input($input);
							echo form_dropdown('type',$option_type,$type,'id="TrainingType" class="span8"');
						?>
					</div>
				</div>
				<div class="control-group">
					<label for="TrainingProvider" class="control-label">Training Provider</label>
					<div class="controls">
						<?php
							$input = array('name'=>'provider','maxlength'=>32,'id'=>'TrainingProvider','class'=>'input-xlarge');
							echo form_input($input);
						?>
					</div>
				</div>
				<div class="control-group">
					<label for="TrainingFee" class="control-label">Training Fee <span class="red bolder smaller">*</span></label>
					<div class="controls">
						<?php
							echo form_dropdown('currency',$option_currency,$currency,'class="span4"');
							echo nbs(2);
							$input = array('name'=>'fee','maxlength'=>15,'id'=>'TrainingFee','class'=>'span7 input-number','onblur'=>'document.myForm.fee.value = formatCurrency(document.myForm.fee.value);','onkeypress'=>'return numbersonly(event)');
							echo form_input($input);
						?>
					</div>
				</div>
				<div class="control-group">
					<label for="Trainer" class="control-label">Trainer <span class="red bolder smaller">*</span></label>
					<div class="controls">
						<?php
							$input = array('name'=>'trainer','maxlength'=>32,'id'=>'Trainer','class'=>'input-xlarge');
							echo form_input($input);
						?>
					</div>
				</div>
				<div class="control-group">
					<label for="IsPassed" class="control-label">Is Passed</label>
					<div class="controls">
						<?php
							echo form_checkbox('passed',1,0,'class="ace-checkbox-2"');
						?>
						<span class="lbl"></span>
					</div>
				</div>
			</div>
		</div>

		<div class="hr"></div>
		<div class="form-actions">
			<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
			<?php 
				echo anchor('employee/CTRL_Edit/'.$id, '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
				echo form_hidden('emp_id',$id);
			?>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>