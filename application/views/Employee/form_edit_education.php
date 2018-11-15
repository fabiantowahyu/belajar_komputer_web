<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div id="UploadFile" class="row-fluid">
	<div class="span12 offset panel-box">
		<div><h3><?php echo $title_head; ?></h3></div>
		<?php echo form_open_multipart($url,array('class'=>'form-horizontal','id'=>'validation-form-leader')); ?>
		
		<div class="hr"></div>
        
        <div class="row-fluid">
			<div class="span6">
            	<div class="control-group">
                <label for="EducationLevel" class="control-label">Education Level</label>
                <div class="controls">
                    <?php
						echo form_dropdown('education_lvl',$option_education_lvl,$education_lvl,'id="EducationLevel" class="span8"');
                    ?>
                </div>
            </div>
            <div class="control-group">
                <label for="StartDate-Education" class="control-label">Start Date <span class="red bolder smaller">*</span></label>
                <div class="controls">
                    <div class="row-fluid">
                        <?php
                            $input = array('name'=>'startdate','value'=>$startdate,'id'=>'StartDate-Education','class'=>'input-small');
                            echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="EndDate-Education" class="control-label">End Date <span class="red bolder smaller">*</span></label>
                <div class="controls">
                    <div class="row-fluid">
                        <?php
                            $input = array('name'=>'enddate','value'=>$enddate,'id'=>'EndDate-Education','class'=>'input-small');
                            echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="Faculty" class="control-label">Faculty</label>
                <div class="controls">
                    <?php
                        echo form_dropdown('faculty',$option_faculty,$faculty,'id="Faculty" class="span8"');
                    ?>
                </div>
            </div>
            <div class="control-group">
                <label for="Institution" class="control-label">Institution <span class="red bolder smaller">*</span></label>
                <div class="controls">
                    <?php
                       echo form_dropdown('institution',$option_institution,$institution,'id="Institution" class="span8"');
                    ?>
                </div>
            </div>
            </div>
            <div class="span6">
            	<div class="control-group">
                <label for="Country" class="control-label">Country <span class="red bolder smaller">*</span></label>
                <div class="controls">
                    <?php
                        //$input = array('name'=>'country','value'=>$country,'maxlength'=>32,'id'=>'Country','class'=>'input-xlarge');
                        //echo form_input($input);
						echo form_dropdown('country',$option_country,$country,'id="Country" class="span8"');
                    ?>
                </div>
            </div>
            <div class="control-group">
                <label for="Province" class="control-label">Province <span class="red bolder smaller">*</span></label>
                <div class="controls">
                    <?php
                        //$input = array('name'=>'province','value'=>$province,'maxlength'=>32,'id'=>'Province','class'=>'input-xlarge');
                        //echo form_input($input);
						echo form_dropdown('province',$option_province,$province,'id="Province" class="span8"');
                    ?>
                </div>
            </div>
            <div class="control-group">
                <label for="City" class="control-label">City</label>
                <div class="controls">
                    <?php
                        $input = array('name'=>'city','value'=>$city,'maxlength'=>32,'id'=>'City','class'=>'input-xlarge');
                        echo form_input($input);
                    ?>
                </div>
            </div>
            <div class="control-group">
                <label for="Major" class="control-label">Major</label>
                <div class="controls">
                    <?php
                        $input = array('name'=>'major','value'=>$major,'maxlength'=>32,'id'=>'Major','class'=>'input-small');
                        echo form_input($input);
                    ?>
                </div>
            </div>
            <div class="control-group">
                <label for="GPA" class="control-label">GPA</label>
                <div class="controls">
                    <?php
                        $input = array('name'=>'gpa','id'=>'GPA','class'=>'input-small input-mask-gpa');
                        echo form_input($input);
                    ?>
                </div>
            </div>
            </div>
        </div>
		
        
		
		<div class="control-group">
			<label for="IsDefault" class="control-label">Is Default</label>
			<div class="controls">
				<?php
					echo form_checkbox('is_default',1,$is_default,'class="ace-checkbox-2"');
				?>
				<span class="lbl"></span>
			</div>
		</div>
		<div class="control-group">
			<label for="Certificate" class="control-label">Certificate</label>
			<div class="controls">
				<?php
					$checked_yes = ($certificate==1) ? 1 : 0;
					echo form_radio('certificate',1,$checked_yes,'id="CertYes"');
				?>
				<span class="lbl"> Yes</span>
				<?php
					$checked_no = ($certificate==0) ? 1 : 0;
					echo form_radio('certificate',0,$checked_no,'id="CertNo"');
				?>
				<span class="lbl"> No</span>
			</div>
		</div>
		
		<div id="View-Certificate">
		<div class="space"></div>
		<h4 class="header blue bolder smaller">Certificate</h4>
		<div class="control-group">
			<label for="CertNumber" class="control-label">Number <span class="red bolder smaller">*</span></label>
			<div class="controls">
				<?php
					$input = array('name'=>'certificate_num','value'=>$certificate_num,'id'=>'CertNumber','class'=>'input-small');
					echo form_input($input);
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="CertDate-Education" class="control-label">Date <span class="red bolder smaller">*</span></label>
			<div class="controls">
				<div class="row-fluid">
					<?php
						$input = array('name'=>'certificate_date','value'=>$certificate_date,'id'=>'CertDate-Education','class'=>'input-mini');
						echo form_input($input);
					?>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label for="AttachCertificate" class="control-label">Attachment</label>
			<div class="controls">
				<?php if($certificate_file) { ?>
					<a href="Javascript:void(0);" id="AttachFiles-1" title="certificate"><?php echo $certificate_file; ?></a>
				<?php }	else { ?>
					<a href="Javascript:void(0);" id="AttachFiles-1" title="certificate">Upload file certificate</a>
				<?php } ?>
			</div>
		</div>
		</div>

		<div class="hr"></div>
		<div class="form-actions">
			<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
			<?php 
				echo anchor('employee/CTRL_Edit/'.$emp_id, '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
				echo form_hidden('emp_id',$emp_id);
				echo form_hidden('id',$id);
				echo nbs(1);
			?>
			<a href="#" id="cdelete-education" class="btn btn-small btn-danger"><i class="icon-trash"></i>&nbsp;Delete</a>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php echo form_open($url_del,array('name'=>'del_education','id'=>'del_education')); ?>
<input type="hidden" name="id" id="delid" value="<?php echo $id; ?>">
<?php echo form_close(); ?>
