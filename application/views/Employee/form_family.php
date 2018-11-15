<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br>
<div id="UploadFile" class="row-fluid">
	<div class="span12 offset panel-box2">
		<div><h3><?php echo $title_head; ?></h3></div>
		<?php echo form_open_multipart($url,array('class'=>'form-horizontal','id'=>'validation-form-family')); ?>
		
		<div class="hr"></div>
       	
        <div class="row-fluid">
			<div class="span6">
            	<div class="control-group">
                    <label for="FamilyName" class="control-label">Name <span class="red bolder smaller">*</span></label>
                    <div class="controls">
                         <?php
							$input = array('name'=>'emp_family','id'=>'FamilyName','class'=>'input-large');
							echo form_input($input);
						?>
                    </div>
                </div>
                <div class="control-group">
                    <label for="Family_Relation" class="control-label">Relationship<span class="red bolder smaller">*</span></label>
                    <div class="controls">
                       <?php
							echo form_dropdown('relationship',$option_relationship,$relationship,'id="Relationship" class="span8"');
						?>
                    </div>
                </div>
                <div class="control-group">
                    <label for="Family_Gender" class="control-label">Gender <span class="red bolder smaller">*</span></label>
                    <div class="controls">
                       <?php
							echo form_dropdown('gender',$option_gender,$gender,'id="Gender" class="span8"');
						?>
                    </div>
                </div>
                
                <div class="control-group">
                    <label for="LastEducation" class="control-label">Last Education <span class="red bolder smaller">*</span></label>
                    <div class="controls">
                       <?php
							echo form_dropdown('education_lvl',$option_education_lvl,$education_lvl,'id="LastEducation" class="span8"');
						?>
                    </div>
                </div>
                <div class="control-group">
                    <label for="IsDependent" class="control-label">Is Dependent</label>
                    <div class="controls">
                        <?php
                            echo form_checkbox('is_dependent',1,0,'class="ace-checkbox-2"');
                        ?>
                        <span class="lbl">&nbsp;Yes</span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="Family_Status" class="control-label">Status</label>
                    <div class="controls">
                        <?php
                            echo form_checkbox('family_status',1,0,'class="ace-checkbox-2"');
                        ?>
                        <span class="lbl">&nbsp;Deceased</span>
                    </div>
                </div>		
            </div>
            <!--Right-->
            <div class="span6">
            	<div class="control-group">
                    <label for="BirthPlace" class="control-label">Birth Place <span class="red bolder smaller">*</span></label>
                    <div class="controls">
                         <?php
							$input = array('name'=>'birth_place','id'=>'BirthPlace','class'=>'input-large');
							echo form_input($input);
						?>
                    </div>
                </div>
                <div class="control-group">
                    <label for="Family_DateBirth" class="control-label">Date of Birth <span class="red bolder smaller">*</span></label>
                    <div class="controls">
                        <?php
							$input = array('name'=>'date_birth','id'=>'Family_DateBirth','class'=>'input-small');
							echo form_input($input);
						?>
                    </div>
                </div>
            	<div class="control-group">
                    <label for="Phone" class="control-label">Phone</label>
                    <div class="controls">
                        <?php
                            $input = array('name'=>'phone','maxlength'=>32,'id'=>'Phone','class'=>'input-xlarge');
                            echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
        </div>      
				
		<div id="View-Document">
			<div class="space"></div>
			<h4 class="header blue bolder smaller">Supporting Document</h4>
			<div class="control-group">
				<label for="Attach_FamilyDocument" class="control-label">Attachment</label>
				<div class="controls">
					<input type="file" name="userfile" id="Attach_FamilyDocument"/>
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