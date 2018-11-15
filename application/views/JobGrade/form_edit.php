<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	<div class="span12 offset panel-box2">
		<div><h3><?php echo $title_head; ?></h3></div>
		<?php echo form_open($url,array('name'=>'fmGrade','class'=>'form-horizontal','id'=>'validation-form')); ?>
		<fieldset>
			<h4 class="header blue bolder smaller">General</h4>
			<div class="control-group">
				<label for="CategoryCode" class="control-label">Grade Code <span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'grade_code','value'=>$grade_code,'maxlength'=>16,'id'=>'CategoryCode','class'=>'input-middle','disabled'=>'disabled');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="CategoryName" class="control-label">Grade Name<span class="red bolder smaller">*</span></label>
				<div class="controls">
					<?php
						$input = array('name'=>'grade_name','value'=>$grade_name,'maxlength'=>128,'id'=>'CategoryName','class'=>'input-middle');
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
						$input = array('name'=>'minimum_pay','value'=>$min_pay,'maxlength'=>32,'id'=>'MinimumPay','class'=>'input-medium','onblur'=>'document.fmGrade.minimum_pay.value = formatCurrency(document.fmGrade.minimum_pay.value);','onkeypress'=>'return numbersonly(event)');
						echo form_input($input);
					?>
				</div>
			</div>
             <div class="control-group">
				<label for="MidPay" class="control-label">Mid Pay</label>
				<div class="controls">
					<?php
						$input = array('name'=>'midpay','maxlength'=>32,'value'=>$mid_pay,'id'=>'midpay','class'=>'input-medium','onblur'=>'document.fmGrade.midpay.value = formatCurrency(document.fmGrade.midpay.value);','onkeypress'=>'return numbersonly(event)');
						echo form_input($input);
					?>
				</div>
			</div>
            <div class="control-group">
				<label for="MaximumPay" class="control-label">Maximum Pay</label>
				<div class="controls">
					<?php
						$input = array('name'=>'maximum_pay','value'=>$max_pay,'maxlength'=>32,'id'=>'MaximumPay','class'=>'input-medium','onblur'=>'document.fmGrade.maximum_pay.value = formatCurrency(document.fmGrade.maximum_pay.value);','onkeypress'=>'return numbersonly(event)');
						echo form_input($input);
					?>
				</div>
			</div>
            <i><span class="red bolder smaller">*</span>) Required</i>
           
			<div class="hr"></div>
			<div class="form-actions">
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button>&nbsp;
				<?php 
					echo anchor('job_grade', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
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