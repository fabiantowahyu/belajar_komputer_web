<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	<div class="span12 offset panel-box2">
        <h4 class="header blue bolder smaller">Address and Phone Information</h4>
		<?php echo form_open_multipart($url,array('class'=>'form-horizontal','id'=>'validation-form-address')); ?>
		
		<h6 class="header black bolder">A. Current Address</h6>
        <div class="row-fluid">
			<div class="span6">
            	<div class="control-group">
                <label for="Address" class="control-label">Address <span class="red bolder smaller">*</span></label>
                <div class="controls">
                   <?php
						$txtarea = array('name'=>'address','rows'=>4,'class'=>'span10','id'=>'Address','value'=>$address1);
						echo form_textarea($txtarea); 
					?>
                </div>
				</div>
				
				<div class="control-group">
					<label for="CountryName" class="control-label">Country <span class="red bolder smaller">*</span></label>
					<div class="controls">
						<?php
							echo form_dropdown('country',$option_country,$country,'id="CountryName" class="span8"');
						?>
					</div>
				</div>
				
				<div class="control-group">
					<label for="ProvinceName" class="control-label">Province <span class="red bolder smaller">*</span></label>
					<div class="controls">
						<?php
							echo form_dropdown('province',$option_province,$province,'id="ProvinceName" class="span8"');
						?>
					</div>
				</div>
				
            </div>
			
			<div class="span6">
            	<div class="control-group">
					<label for="RTRW" class="control-label">RT/RW</label>
					<div class="controls">
					   <?php
							$input = array('name'=>'rt','maxlength'=>8,'id'=>'RTRW','class'=>'input-small','value'=>$rt1);
							echo form_input($input);
						?>
						&nbsp;/&nbsp;
						<?php
							$input = array('name'=>'rw','maxlength'=>8,'id'=>'RTRW','class'=>'input-small','value'=>$rw1);
							echo form_input($input);
						?>
					</div>
				</div>
				
				<div class="control-group">
					<label for="postalcode" class="control-label">Postal Code</label>
					<div class="controls">
					   <?php
							$input = array('name'=>'postalcode','maxlength'=>8,'id'=>'postalcode','class'=>'input-small','value'=>$postal_code1);
							echo form_input($input);
						?>
					</div>
				</div>
				
				<div class="control-group">
					<label for="Phone" class="control-label">Phone</label>
					<div class="controls">
					   <?php
							$input = array('name'=>'phone','maxlength'=>8,'id'=>'Phone','class'=>'input-middle','value'=>$phone1);
							echo form_input($input);
						?>
					</div>
				</div>
            </div> 
        </div>
		
		<h6 class="header black bolder">B. ID Card Address</h6>
        <div class="row-fluid">
			<div class="span6">
            	<div class="control-group">
                <label for="Address2" class="control-label">Address <span class="red bolder smaller">*</span></label>
                <div class="controls">
                   <?php
						$txtarea = array('name'=>'address2','rows'=>4,'class'=>'span10','id'=>'Address2','value'=>$address2);
						echo form_textarea($txtarea); 
					?>
                </div>
				</div>
				
				<div class="control-group">
					<label for="CountryName2" class="control-label">Country <span class="red bolder smaller">*</span></label>
					<div class="controls">
						<?php
							echo form_dropdown('country2',$option_country2,$country2,'id="CountryName2" class="span8"');
						?>
					</div>
				</div>
				
				<div class="control-group">
					<label for="ProvinceName2" class="control-label">Province <span class="red bolder smaller">*</span></label>
					<div class="controls">
						<?php
							echo form_dropdown('province2',$option_province2,$province2,'id="ProvinceName2" class="span8"');
						?>
					</div>
				</div>
				
            </div>
			
			<div class="span6">
            	<div class="control-group">
					<label for="RTRW2" class="control-label">RT/RW</label>
					<div class="controls">
					   <?php
							$input = array('name'=>'rt2','maxlength'=>8,'id'=>'RTRW2','class'=>'input-small','value'=>$rt2);
							echo form_input($input);
						?>
						&nbsp;/&nbsp;
						<?php
							$input = array('name'=>'rw2','maxlength'=>8,'id'=>'RTRW2','class'=>'input-small','value'=>$rw2);
							echo form_input($input);
						?>
					</div>
				</div>
				
				<div class="control-group">
					<label for="postalcode2" class="control-label">Postal Code</label>
					<div class="controls">
					   <?php
							$input = array('name'=>'postalcode2','maxlength'=>12,'id'=>'postalcode2','class'=>'input-small','value'=>$postal_code2);
							echo form_input($input);
						?>
					</div>
				</div>
				
				<div class="control-group">
					<label for="Phone2" class="control-label">Phone</label>
					<div class="controls">
					   <?php
							$input = array('name'=>'phone2','maxlength'=>12,'id'=>'Phone2','class'=>'input-middle','value'=>$phone2);
							echo form_input($input);
						?>
					</div>
				</div>
            </div> 
        </div>
		
		<h6 class="header black bolder">C. Mobile Phone</h6>
		<div class="row-fluid">
			<div class="span6">
            	<div class="control-group">
                <label for="MobilePhone1" class="control-label">Mobile Phone 1</label>
                <div class="controls">
                   <?php
						$input = array('name'=>'mobilephone1','maxlength'=>12,'id'=>'MobilePhone1','class'=>'input-middle','value'=>$mobile_phone1);
						echo form_input($input);
					?>
                </div>
				</div>
			</div>
			<div class="span6">
            	<div class="control-group">
                <label for="MobilePhone2" class="control-label">Mobile Phone 2</label>
                <div class="controls">
                   <?php
						$input = array('name'=>'mobilephone2','maxlength'=>12,'id'=>'MobilePhone2','class'=>'input-middle','value'=>$mobile_phone2);
						echo form_input($input);
					?>
                </div>
				</div>
			</div>
		</div>
		
		<div class="hr"></div>
		<div>
			<button type="submit" name="submit_address" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
			<button type="reset" name="reset" value="reset" class="btn btn-small btn-info"><i class="icon-save"></i> Reset</button> &nbsp;
			<?php 
				echo anchor('employee/', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
				echo form_hidden('emp_id',$id);
				echo nbs(1);
			?>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php echo form_close(); ?>
