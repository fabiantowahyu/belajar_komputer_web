<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div id="MasterEmployee" class="row-fluid">
	<div class="span12 offset panel-box">
		<div><h3><?php echo $title_head; ?></h3></div>
		<?php echo form_open_multipart($url,array('name'=>'AddEmpform','class'=>'form-horizontal','id'=>'validation-form')); ?>
		<h4 class="header blue bolder smaller">General</h4>

		<div class="row-fluid">
			<div class="span4">
				<p align="center"><span><b>Photo</b></span></p>
				<input type="file" name="userfile" />
				<span class="red"><i>Only for *.jpg, *.png and *.gif<br/>Maximum Attachment File (1024 Kb)</i></span>
				
				<div class="space-10"></div>

				<p align="center"><span><b>Employee Signature</b></span></p>
				<input type="file" name="signature" />
				<span class="red"><i>Only for *.jpg, *.png and *.gif<br/>Maximum Attachment File (1024 Kb)</i></span>
			</div>
			<div class="vspace"></div>
			<div class="span8">
				<div class="control-group">
					<label for="EmployeeID" class="control-label">EMP ID</label>
					<div class="controls">
						<?php
							$input = array('name'=>'emp_id','value'=>$id,'maxlength'=>16,'id'=>'EmployeeID','class'=>'input-small','disabled'=>'disabled');
							echo form_input($input);
						?>
					</div>
				</div>
				<div class="control-group">
					<label for="FirstName" class="control-label">First Name <span class="red bolder smaller">*</span></label>
					<div class="controls">
						<?php
							$input = array('name'=>'first_name','maxlength'=>64,'id'=>'FirstName','class'=>'input-large');
							echo form_input($input);
						?>
					</div>
				</div>
				<div class="control-group">
					<label for="MiddleName" class="control-label">Middle Name</label>
					<div class="controls">
						<?php
							$input = array('name'=>'middle_name','maxlength'=>64,'id'=>'MiddleName','class'=>'input-large');
							echo form_input($input);
						?>
					</div>
				</div>
				<div class="control-group">
					<label for="LastName" class="control-label">Last Name <span class="red bolder smaller">*</span></label>
					<div class="controls">
						<?php
							$input = array('name'=>'last_name','maxlength'=>64,'id'=>'LastName','class'=>'input-large');
							echo form_input($input);
						?>
					</div>
				</div>
				<div class="control-group">
                  <label for="Position" class="control-label">Company <span class="red bolder smaller">*</span></label>
                  <div class="controls">
                      <?php
                          echo form_dropdown('company',$option_company,$company,'id="Company" class="span6"');
                      ?>
                  </div>
				</div>
                <div class="control-group">
                  <label for="Position" class="control-label">Position <span class="red bolder smaller">*</span></label>
                  <div class="controls">
                      <?php
                          echo form_dropdown('position',$option_position,$position,'id="Position" class="span6"');
                      ?>
					  <input type="button" name="btnPick" value="Pick" onclick="PopUpWindow('<?php echo $url_position;?>','mywindow',800,600,'yes','yes'); return false;">
                  </div>
				</div>
                <div class="control-group">
                  <label for="Gender" class="control-label">Gender</label>
                  <div class="controls">
                      <?php
                          echo form_dropdown('gender',$option_gender,$gender,'id="Gender" class="span6"');
                      ?>
                  </div>
                </div>
                <div class="control-group">
                    <label for="branch" class="control-label">Worklocation <span class="red bolder smaller">*</span></label>
                    <div class="controls">
                        <?php
                           echo form_dropdown('branch_id',$option_branch,$branch_id,'id="branch" class="span6"');
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label for="grade" class="control-label">Grade <span class="red bolder smaller">*</span></label>
                    <div class="controls">
                        <?php
                           echo form_dropdown('grade_id',$option_grade,$grade_id,'id="grade" class="span6"');
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label for="JoinDate" class="control-label">Join Date <span class="red bolder smaller">*</span></label>
                    <div class="controls">
                        <?php
                            $input = array('name'=>'join_date','id'=>'JoinDate','class'=>'input-medium');
                            echo form_input($input);
                        ?>
                         <span class="add-on">
			              <i class="icon-calendar"></i>
			          	</span>
                    </div>
                </div>
				<div class="control-group">
					<label for="Email" class="control-label">Email</label>
					<div class="controls">
						<?php
							$input = array('name'=>'email','maxlength'=>128,'id'=>'Email','class'=>'input-large');
							echo form_input($input);
						?>
					</div>
				</div>
			</div>
		</div>
		
		<h4 class="header blue bolder smaller">Other Information</h4>
		<div class="control-group">
			<label for="BirthPlace" class="control-label">Birth Place &nbsp;<span class="red bolder smaller">*</span></label>
			<div class="controls">
				<?php
					$input = array('name'=>'birth_place','id'=>'birth_place','class'=>'input-small');
					echo form_input($input);
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="BirthDate" class="control-label">Birth Date&nbsp; <span class="red bolder smaller">*</span></label>
			<div class="controls">
				<?php
					$input = array('name'=>'birth_date','id'=>'birth_date','class'=>'input-medium');
					echo form_input($input);
				?>
				 <span class="add-on">
	              <i class="icon-calendar"></i>
	          	</span>
			</div>
		</div>
                <div class="control-group">
                        <label for="MarigeStatus" class="control-label">Marital Status&nbsp;<span class="red border smaller">*</span></label>
                        <div class="controls">
                                <?php
                                        echo form_dropdown('marital_status',$option_maritalstatus,$marital_status,'id="marital_status" class="span4"');
                                ?>
                        </div>
                </div>
                <div class="control-group">
                    <label for="MaritalDate" class="control-label">Marital Date&nbsp;</label>
                    <div class="controls">
                                <?php
                                        $input = array('name'=>'marital_date','id'=>'marital_date','class'=>'input-medium');
					echo form_input($input);
                                ?>
                                <span>
                                    <i class="icon-calendar"></i>
                                </span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="MaritalPlace" class="control-label">Marital Place&nbsp;</label>
                    <div class="controls">
                                <?php
                                        $input = array('name'=>'marital_place','id'=>'marital_place','class'=>'input-small');
					echo form_input($input);
                                ?>
                    </div>
                </div>
                <div class="control-group">
			<label for="Religion" class="control-label">Religion&nbsp; <span class="red bolder smaller">*</span></label>
			<div class="controls">
				<?php
                                        echo form_dropdown('religion',$option_religion,$religion,'id="religion" class="span4"');
                                ?>
			</div>
		</div>
                
		<h4 class="header blue bolder smaller">Register User &nbsp;&nbsp;
		<?php
			echo form_checkbox('reguser',1,1,'class="ace-checkbox-2" onclick="registerUser();"');
		?>
		<span class="lbl"></span>
			
		</h4>
		<div class="control-group" id="rowuser1">
			<label for="Username" class="control-label">Username <span class="red bolder smaller">*</span></label>
			<div class="controls">
                            
				<?php
					$input = array('name'=>'username','maxlength'=>32,'id'=>'Username','class'=>'input-medium');
					echo form_input($input);
				?>
			</div>
		</div>
		<div class="control-group" id="rowuser2">
			<label for="Password" class="control-label">Password <span class="red bolder smaller">*</span></label>
			<div class="controls">
				<?php
					$input = array('name'=>'password','id'=>'Password','maxlength'=>32,'minlength'=>6,'class'=>'input-medium');
					echo form_password($input);
				?>
				<span class="lbl"></span>
			</div>
		</div>
		<div class="control-group" id="rowuser3">
			<label for="RePassword" class="control-label">Re-Type Password <span class="red bolder smaller">*</span></label>
			<div class="controls">
				<?php
					$input = array('name'=>'password_re','id'=>'RePassword','maxlength'=>32,'minlength'=>6,'class'=>'input-medium');
					echo form_password($input);
				?>
				<span class="lbl"></span>
			</div>
		</div>
		<div class="control-group" id="rowuser4">
			<label for="Role" class="control-label">Role Application <span class="red bolder smaller">*</span></label>
			<div class="controls">
				<?php
					echo form_dropdown('role',$option_role,$role,'id="Role" class="span4"');
				?>
			</div>
		</div>
		<div class="control-group" id="rowuser5">
			<label for="Status" class="control-label">Active</label>
			<div class="controls">
				<?php
					echo form_checkbox('status',1,0,'class="ace-switch ace-switch-5"'); 
				?>
				<span class="lbl"></span>
			</div>
		</div>
		
		<div class="space"></div>
		<h4 class="header blue bolder smaller">Address and Phone Information</h4>
		<div class="control-group">
			<label for="Address" class="control-label">Address <span class="red bolder smaller">*</span></label>
			<div class="controls">
				<?php
					$txtarea = array('name'=>'address','rows'=>3,'class'=>'span5');
					echo form_textarea($txtarea); 
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="CountryName" class="control-label">Country <span class="red bolder smaller">*</span></label>
			<div class="controls">
				<?php
					echo form_dropdown('country',$option_country,$country,'id="CountryName" class="span4"');
				?>
			</div>
		</div>
		
		<div class="control-group">
			<label for="ProvinceName" class="control-label">Province <span class="red bolder smaller">*</span></label>
			<div class="controls">
				<?php
					echo form_dropdown('province',$option_province,$province,'id="ProvinceName" class="span4"');
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="PostalCode" class="control-label">Postal Code</label>
			<div class="controls">
				<?php
					$input = array('name'=>'post_code','maxlength'=>64,'id'=>'PostalCode','class'=>'input-medium input-mask-kdpos');
					echo form_input($input);
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="Phone" class="control-label">Phone</label>
			<div class="controls">
				<?php
					$input = array('name'=>'phone','maxlength'=>64,'id'=>'Phone','class'=>'input-medium input-mask-phone');
					echo form_input($input);
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="HandPhone" class="control-label">Mobile Phone</label>
			<div class="controls">
				<?php
					$input = array('name'=>'hp','maxlength'=>64,'id'=>'HandPhone','class'=>'input-medium input-mask-hp');
					echo form_input($input);
				?>
			</div>
		</div>
		
		<div class="hr"></div>
		<div class="form-actions">
			<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
			<?php 
				echo anchor('employee', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
				echo form_hidden('emp_id',$id);
				echo form_hidden('rdbuser',1);
			?>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>

<script>
	function registerUser() {
		if (document.AddEmpform.reguser.checked == false) {
			document.AddEmpform.rdbuser.value=0; 
			//document.AddEmpform.selStatus.selectedIndex=1;
			document.getElementById('rowuser1').style.display = "none";
			document.getElementById('rowuser2').style.display = "none";
			document.getElementById('rowuser3').style.display = "none";
			document.getElementById('rowuser4').style.display = "none";
			document.getElementById('rowuser5').style.display = "none";
			document.getElementById('rowuser6').style.display = "none";
		}
		else {
			document.AddEmpform.rdbuser.value=1; 
			//document.AddEmpform.selStatus.selectedIndex=0;
			document.getElementById('rowuser1').style.display = "";
			document.getElementById('rowuser2').style.display = "";
			document.getElementById('rowuser3').style.display = "";
			document.getElementById('rowuser4').style.display = "";
			document.getElementById('rowuser5').style.display = "";
			document.getElementById('rowuser6').style.display = "";
		}
	}
</script>