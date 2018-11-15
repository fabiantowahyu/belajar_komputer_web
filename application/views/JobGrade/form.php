<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	<div class="span12 offset panel-box2">
		<div><h3><?php echo $title_head; ?></h3></div>
		<?php echo form_open($url,array('name'=>'fmGrade','class'=>'form-horizontal','id'=>'validation-form')); ?>
		<fieldset>
			<h4 class="header blue bolder smaller">General</h4>
			<div class="control-group">
				<label for="GradeCode" class="control-label">Grade Code <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'grade_code','maxlength'=>16,'id'=>'GradeCode','class'=>'input-small');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="GradeName" class="control-label">Grade Name <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'grade_name','maxlength'=>128,'id'=>'GradeName','class'=>'input-medium');
						echo form_input($input);
					?>
				</div>
			</div>
            <div class="control-group">
				<label for="currency" class="control-label">Currency</label>
				<div class="controls">
					<?php
					   echo form_dropdown('currency',$option_currency,$currency,'id="currency" class="span3"');
					?>
				</div>
			</div>
            <div class="control-group">
				<label for="MinimumPay" class="control-label">Minimum Pay</label>
				<div class="controls">
					<?php
						$input = array('name'=>'minimum_pay','maxlength'=>32,'id'=>'MinimumPay','class'=>'input-medium','onblur'=>'document.fmGrade.minimum_pay.value = formatCurrency(document.fmGrade.minimum_pay.value);','onkeypress'=>'return numbersonly(event)');
						echo form_input($input);
					?>
				</div>
			</div>
             <div class="control-group">
				<label for="MidPay" class="control-label">Mid Pay</label>
				<div class="controls">
					<?php
						$input = array('name'=>'midpay','maxlength'=>128,'id'=>'midpay','class'=>'input-medium','onblur'=>'document.fmGrade.midpay.value = formatCurrency(document.fmGrade.midpay.value);','onkeypress'=>'return numbersonly(event)');
						echo form_input($input);
					?>
				</div>
			</div>
            <div class="control-group">
				<label for="MaximumPay" class="control-label">Maximum Pay</label>
				<div class="controls">
					<?php
						$input = array('name'=>'maximum_pay','maxlength'=>128,'id'=>'MaximumPay','class'=>'input-medium','onblur'=>'document.fmGrade.maximum_pay.value = formatCurrency(document.fmGrade.maximum_pay.value);','onkeypress'=>'return numbersonly(event)');
						echo form_input($input);
					?>
				</div>
			</div>
            <i><span class="red bolder smaller">*</span>) Required</i>
			<div class="hr"></div>
			<div class="form-actions">
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
				<?php 
					echo anchor('job_grade', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
				?>
			</div>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>