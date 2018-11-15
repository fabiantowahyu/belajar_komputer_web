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
                  <label>:&nbsp;<?php echo $address1;?></label>
                </div>
				</div>
				
				<div class="control-group">
					<label for="CountryName" class="control-label">Country <span class="red bolder smaller">*</span></label>
					<div class="controls">
						 <label>:&nbsp;<?php echo $country1;?></label>
					</div>
				</div>
				
				<div class="control-group">
					<label for="ProvinceName" class="control-label">Province <span class="red bolder smaller">*</span></label>
					<div class="controls">
						 <label>:&nbsp;<?php echo $country1;?></label>
					</div>
				</div>
				
            </div>
			
			<div class="span6">
            	<div class="control-group">
					<label for="RTRW" class="control-label">RT/RW</label>
					<div class="controls">
					  <label>:&nbsp;<?php echo $rt1;?>&nbsp;/&nbsp;<?php echo $rw1;?></label>
					</div>
				</div>
				
				<div class="control-group">
					<label for="postalcode" class="control-label">Postal Code</label>
					<div class="controls">
					   <label>:&nbsp;<?php echo $postal_code1;?></label>
					</div>
				</div>
				
				<div class="control-group">
					<label for="Phone" class="control-label">Phone</label>
					<div class="controls">
					   <label>:&nbsp;<?php echo $phone1;?></label>
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
                   <label>:&nbsp;<?php echo $address2;?></label>
                </div>
				</div>
				
				<div class="control-group">
					<label for="CountryName2" class="control-label">Country <span class="red bolder smaller">*</span></label>
					<div class="controls">
						<label>:&nbsp;<?php echo $country2;?></label>
					</div>
				</div>
				
				<div class="control-group">
					<label for="ProvinceName2" class="control-label">Province <span class="red bolder smaller">*</span></label>
					<div class="controls">
						<label>:&nbsp;<?php echo $province2;?></label>
					</div>
				</div>
				
            </div>
			
			<div class="span6">
            	<div class="control-group">
					<label for="RTRW2" class="control-label">RT/RW</label>
					<div class="controls">
					  <label>:&nbsp;<?php echo $rt2;?>&nbsp;/&nbsp;<?php echo $rw2;?></label>
					</div>
				</div>
				
				<div class="control-group">
					<label for="postalcode2" class="control-label">Postal Code</label>
					<div class="controls">
					  <label>:&nbsp;<?php echo $postal_code2;?></label>
					</div>
				</div>
				
				<div class="control-group">
					<label for="Phone2" class="control-label">Phone</label>
					<div class="controls">
					  <label>:&nbsp;<?php echo $phone2;?></label>
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
                  <label>:&nbsp;<?php echo $mobilephone1;?></label>
                </div>
				</div>
			</div>
			<div class="span6">
            	<div class="control-group">
                <label for="MobilePhone2" class="control-label">Mobile Phone 2</label>
                <div class="controls">
                   <label>:&nbsp;<?php echo $mobilephone2;?></label>
                </div>
				</div>
			</div>
		</div>
		
		<?php echo form_close(); ?>
	</div>
</div>
<?php echo form_close(); ?>
