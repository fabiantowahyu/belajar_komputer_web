<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<div class="span8 offset2 panel-box">
		<div><h3><?php echo $title; ?></h3></div>
		<?php echo form_open($url,array('name'=>'myForm','class'=>'form-horizontal','id'=>'validation-form')); ?>
		<div class="hr"></div>
        <span class="red bolder smaller">Fields with * are required.</span>
		<div class="hr"></div>
		<fieldset>
			<div class="control-group">
				<label for="OrgLvl" class="control-label">Parent Position</label>
				<div class="controls">
					<iframe src="<?php echo $url_view; ?>" width="90%" height="100px">
					  <p>Your browser does not support iframes.</p>
					</iframe>
				</div>
			</div>
			<div class="control-group">
				<label for="OrgCode" class="control-label">Position Code *</label>
				<div class="controls">
					<?php
						$input = array('name'=>'position_code','value'=>$position_code,'maxlength'=>32,'id'=>'OrgCode','class'=>'input-medium');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="OrgName" class="control-label">Position Name *</label>
				<div class="controls">
					<?php
						$input = array('name'=>'position_name','value'=>$position_name,'maxlength'=>255,'id'=>'OrgName','class'=>'input-large');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="OrgLvl" class="control-label">Job Status</label>
				<div class="controls">
					<?php
						echo form_dropdown('jobstatus_code',$option_jobstatus_code,$jobstatus_code,'id="OrgLvl"');
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="Status" class="control-label">Active</label>
				<div class="controls">
					<?php
						echo form_checkbox('position_active',1,$position_active,'class="ace-switch ace-switch-5"'); 
					?>
					<span class="lbl"></span>
				</div>
			</div>
			<div class="control-group">
				<label for="Status" class="control-label">Grade</label>
				<div class="controls">
					<table width="90%" border="0">
					<tr>
						<td width="45%" align="left" valign="top">
							<?php
								echo form_dropdown("selNonGrade",$option_not_grade,'','multiple="multiple" class="span11" style="height:300px;"');
							?>
						</td>
						<td width="5%" align="center">
							<a href="javascript:void(0);" class="btn btn-small btn-primary" onclick="ChangeValue_Grade(2);"> >> </a> <br><br>
							<a href="javascript:void(0);" class="btn btn-small btn-danger" onclick="ChangeValue_Grade(3);"> << </a>
						</td>
						<td width="45%" align="center" valign="top">
							<?php
								echo form_dropdown("selGrade",$option_grade,'','multiple="multiple" class="span11" style="height:300px;"');
							?>
						</td>
					</tr>
					</table>
				</div>
			</div>
			<div class="control-group">
				<label for="Status" class="control-label">Work Location</label>
				<div class="controls">
					<table width="90%" border="0">
					<tr>
						<td width="45%" align="left" valign="top">
							<?php
								echo form_dropdown("selNonMember",$option_not_member,'','multiple="multiple" class="span11" style="height:300px;"');
							?>
						</td>
						<td width="5%" align="center">
							<a href="javascript:void(0);" class="btn btn-small btn-primary" onclick="ChangeValue(2);"> >> </a> <br><br>
							<a href="javascript:void(0);" class="btn btn-small btn-danger" onclick="ChangeValue(3);"> << </a>
						</td>
						<td width="45%" align="center" valign="top">
							<?php
								echo form_dropdown("selMember",$option_member,'','multiple="multiple" class="span11" style="height:300px;"');
							?>
						</td>
					</tr>
					</table>
				</div>
			</div>
			<div class="control-group">
				<label for="MarketSalary" class="control-label">Market Salary</label>
				<div class="controls">
					<?php
						$input = array('name'=>'market_salary','value'=>$market_salary,'maxlength'=>32,'id'=>'MarketSalary','class'=>'input-medium');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="MaxMarketSalary" class="control-label">Max Market Salary</label>
				<div class="controls">
					<?php
						$input = array('name'=>'maxmarket_salary','value'=>$maxmarket_salary,'maxlength'=>32,'id'=>'MaxMarketSalary','class'=>'input-medium');
						echo form_input($input);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="Status" class="control-label">Job Description</label>
				<div class="controls">
					<?php
						$txtarea = array('name'=>'pos_job_desc','value'=>$pos_job_desc,'rows'=>5,'class'=>'span7');
						echo form_textarea($txtarea);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="Status" class="control-label">Managerial Requirements</label>
				<div class="controls">
					<?php
						$txtarea = array('name'=>'pos_man_req','value'=>$pos_man_req,'rows'=>5,'class'=>'span7');
						echo form_textarea($txtarea);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="Status" class="control-label">Technical Requirements</label>
				<div class="controls">
					<?php
						$txtarea = array('name'=>'pos_tech_req','value'=>$pos_tech_req,'rows'=>5,'class'=>'span7');
						echo form_textarea($txtarea);
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="JobTitle" class="control-label">Job Title *</label>
				<div class="controls">
					<?php
						echo form_dropdown('pos_jobtitle',$option_pos_jobtitle,$pos_jobtitle,'id="JobTitle"');
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="CostCenter" class="control-label">Cost Center *</label>
				<div class="controls">
					<?php
						echo form_dropdown('pos_costcenter',$option_pos_costcenter,$pos_costcenter,'id="CostCenter"');
					?>
				</div>
			</div>
			<div class="control-group">
				<label for="Status" class="control-label">Position In Neck</label>
				<div class="controls">
					<?php
						$chkNeck = ($pos_in_neck == '0' || $pos_in_neck == '1') ? 1 : 0;
						echo form_checkbox('chkNeck',1,$chkNeck,'onClick="uncheck(document.forms[\'myForm\'].elements[\'radNeck\'], \'\');"'); 
					?>
					<span class="lbl"></span>
				</div>
			</div>
			<div class="control-group">
				<label for="Status" class="control-label">Right Or Left</label>
				<div class="controls">
					<?php
						$radNeck_Left = ($pos_in_neck == '0') ? 1 : 0;
						echo form_radio('radNeck',0,$radNeck_Left,'onClick="raduncheck(document.forms[\'myForm\'].elements[\'radNeck\'], \'\');"'); 
					?>
					<span class="lbl"> Left Position</span>
					<?php
						$radNeck_Right = ($pos_in_neck == '1') ? 1 : 0;
						echo form_radio('radNeck',1,$radNeck_Right,'onClick="raduncheck(document.forms[\'myForm\'].elements[\'radNeck\'], \'\');"'); 
					?>
					<span class="lbl"> Right Position</span>
				</div>
			</div>
		
			<div class="form-actions">
				<?php 
					echo anchor($url_new, '<i class="icon-plus"></i>&nbsp;Add Child', array('class'=>'btn btn-small btn-info'));
				?>
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info" onclick="SelectAll_Member();"><i class="icon-save"></i> Save</button> &nbsp;
				<?php 
					echo anchor('position', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
					echo form_hidden('division_id',$division_id);
					echo form_hidden('position_parent',$position_parent);
					echo form_hidden('position_level',$position_level);
					echo form_hidden('position_parentpath',$position_parentpath);
					echo form_hidden('position_flag','3');
					echo form_hidden('work_location','');
					echo form_hidden('grade_code','');
				?>
				&nbsp;
				<a href="javascript:void(0);" id="cdelete" class="btn btn-small btn-danger"><i class="icon-trash"></i>&nbsp;Delete</a>
			</div>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>
<?php echo form_open($url_del,array('name'=>'del','id'=>'del')); ?>
<input type="hidden" name="id" id="delid" value="<?php echo $id; ?>">
<?php echo form_close(); ?>