<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	<div class="span12 offset panel-box2">
				
		<div class="tabbable">
			<ul class="nav nav-tabs padding-16">
				<li class="active" id="tab-basic">
					<a data-toggle="tab" href="#edit-basic">
						<i class="blue icon-edit bigger-125"></i>
						Personal Info
					</a>
				</li>
				
                <li id="tab-address">
					<a data-toggle="tab" href="#edit-address">
						<i class="blue icon-edit bigger-125"></i>
						Address And Phone
					</a>
				</li>
                
                <li id="tab-education">
					<a data-toggle="tab" href="#edit-education">
						<i class="blue icon-cog bigger-125"></i>
						Education
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#edit-training">
						<i class="blue icon-key bigger-125"></i>
						Training
					</a>
				</li>
                
                <li id="tab-family">
					<a data-toggle="tab" href="#edit-family">
						<i class="blue icon-cog bigger-125"></i>
						Family And Dependant
					</a>
				</li>
				
				<li id="tab-bank">
					<a data-toggle="tab" href="#edit-bank">
						<i class="blue icon-lightbulb"></i>
						Bank Account Information
					</a>
				</li>
				
				<li id="tab-award">
					<a data-toggle="tab" href="#edit-award">
						<i class="blue icon-gift"></i>
						Awards History
					</a>
				</li>
				
				<li id="tab-disciplines">
					<a data-toggle="tab" href="#edit-disciplines">
						<i class="blue icon-exclamation-sign"></i>
						Disciplines History
					</a>
				</li>
			</ul>

			<div class="tab-content profile-edit-tab-content">
				<div id="edit-basic" class="tab-pane in active">
					<div class="space-10"></div>
					<?php echo form_open_multipart($url,array('class'=>'form-horizontal','id'=>'validation-form')); ?>
					<h4 class="header blue bolder smaller">Personal Information</h4>
					
                    <table border="0" cellpadding="6" cellspacing="3" width="100%">
                    	<tr>
                        	<td width="15%">
                            <p align="center"><span><b>Photo</b></span></p>
                            <span class="profile-picture">
                                <img title="<?php echo $filename; ?>" id="Photo" src="<?php echo base_url() . $file_name;?>" />
                            </span>
                            
                            </td>
                            <td valign="top" rowspan="2">
                            	<table border="0" cellpadding="6" cellspacing="3" width="100%">
                                	<tr>
                                    	<td colspan="6"><b>Employee Id : <?php echo $id; ?></b><hr /></td>
                                    </tr>
                                	<tr>
                                    	<td align="left" width="20%">
                                        	<label for="FirstName">First Name <span class="red bolder smaller">*</span></label>
                                        </td>
                                        <td width="25%">
											<label>:&nbsp;<?php echo $first_name;?></label>
                                        </td>
                                        <td width="2%"></td>
                                        <td align="left">
                                        	<label for="MiddleName">Middle Name</label>
                                        </td>
                                        <td width="30%">
											<label>:&nbsp;<?php echo $middle_name;?></label>
                                        </td>
										
                                    </tr>
                                	<tr>
                                    	<td align="left" width="15%">
                                        	<label for="FirstName">Last Name</label>
                                        </td>
                                        <td width="10%">
											<label>:&nbsp;<?php echo $last_name;?></label>
                                        </td>
                                        <td width="2%"></td>
                                        <td  align="left">
                                        	<label for="Position">Position <span class="red bolder smaller">*</span></label>
                                        </td>
                                        <td width="10%">
                                        	<label>:&nbsp;<?php echo $position_name;?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td align="left" width="15%">
                                        	 <label for="Gender">Gender</label>
                                        </td>
                                        <td width="10%">
										<label>:&nbsp;<?php echo $gender;?></label>
                                        </td>
                                        <td width="2%"></td>
                                        <td  align="left">
                                        	<label for="branch">Branch</label>
                                        </td>
                                        <td width="10%">
											<label>:&nbsp;<?php echo $branch;?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  align="left" width="15%">
                                        	<label for="grade">Grade <span class="red bolder smaller">*</span></label>
                                        </td>
                                        <td width="10%">
											<label>:&nbsp;<?php echo $grade_code;?></label>
                                        </td>
                                        <td width="2%"></td>
                                        <td  align="left">
											<label for="CostCenter">Cost Center <span class="red bolder smaller">*</span></label>
										</td>
										<td width="10%">
											<label>:&nbsp;<?php echo $cost_center;?></label>
										</td>
                                    </tr>
                                    <tr>
                                        <td  align="left" width="15%">
                                        	<label for="id_number">ID Number</label>
                                        </td>
                                        <td width="10%">
											<label>:&nbsp;<?php echo $id_number;?></label>
                                        </td>
                                        <td width="2%"></td>
                                        <td align="left">
                                        	<label for="ID_ExpiredDate">ID Expired Date</label>
                                        </td>
                                        <td width="10%">
											<label>:&nbsp;<?php echo $id_expireddate;?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  align="left" width="15%">
                                        	<label for="birth_place">Birth Place <span class="red bolder smaller">*</span></label>
                                        </td>
                                        <td width="10%">
											<label>:&nbsp;<?php echo $birth_place;?></label>
                                        </td>
                                        <td width="2%"></td>
                                        <td align="left">
                                        	<label for="birth_date">Birth Date <span class="red bolder smaller">*</span></label>
                                        </td>
                                        <td width="10%">
											<label>:&nbsp;<?php echo $birth_date;?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td  align="left" width="15%">
                                        	<label for="marital_status">Marital Status</label>
                                        </td>
                                        <td width="10%">
											<label>:&nbsp;<?php echo $marital_status;?></label>
                                        </td>
                                        <td width="5%"></td>
                                        <td align="left">
                                        	<label for="marital_date">Marital Date</label>
                                        </td>
                                        <td width="10%">
											<label>:&nbsp;<?php echo $marital_date;?></label>
										</td>
                                    </tr>
                                    <tr>
                                    	<td  align="left" width="15%">
                                        	<label for="marital_status">Religion <span class="red bolder smaller">*</span></label>
                                        </td>
                                        <td width="10%">
											<label>:&nbsp;<?php echo $religion;?></label>
                                        </td>
                                        <td width="5%"></td>
                                        <td align="left">
                                        	<label for="marital_place">Marital Place</label>
                                        </td>
                                        <td width="10%">
											<label>:&nbsp;<?php echo $marital_place;?></label>
										</td>
                                    </tr>
                                    <tr>
                                      <td align="left" width="15%">
                                        <label for="marital_place">Employment Status</label>
                                      </td>
                                      <td width="10%">
	 									<label>:&nbsp;<?php echo $employment_status;?></label>
									  </td>
									  <td width="5%"></td>
									  <td align="left">
                                        	<label for="JoinDate">Effective Date <span class="red bolder smaller">*</span></label>
                                      </td>
                                      <td width="10%">
	 									<label>:&nbsp;<?php echo $join_date;?></label>
                                      </td>
									</tr>
                                    <tr>
                                      <td align="left" width="15%">
                                       	<label for="end_date">End Date</label>
                                      </td>
                                      <td width="10%">
										<label>:&nbsp;<?php echo $end_date;?></label>
									  </td>
                                      <td width="2%"></td>
                                      <td  align="left" width="15%">
                                      	<label for="Email">Email</label>
                                      </td>
                                      <td>
                                      	<label>:&nbsp;<?php echo $email;?></label>
                                      </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        
                        <tr>
                        	<td width="20%">
                            <p align="center"><span><b>Employee Signature</b></span></p>
							<span class="profile-picture">
								<img title="<?php echo $filesignature; ?>" id="Photo" src="<?php echo base_url() . $file_signature;?>" />
							</span>
                            </td>
                        </tr>
                    </table>
                    	<!--- Remark dulu....
                        <div class="control-group">
                            <label for="Role" class="control-label">Role Application</label>
                            <div class="controls">
                                <?php
                                    echo form_dropdown('role',$option_role,$role,'id="Role" class="span4" disabled');
                                ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="Status" class="control-label">Active</label>
                            <div class="controls">
                                <?php
                                    echo form_checkbox('status',1,$status,'class="ace-switch ace-switch-5"'); 
                                ?>
                                <span class="lbl"></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="Username" class="control-label">Username</label>
                            <div class="controls">
                                <?php
                                    $input = array('name'=>'username','value'=>$username,'maxlength'=>32,'id'=>'Username','class'=>'input-medium');
                                    echo form_input($input);
                                ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">&nbsp;</label>
                            <label>
                                <small class="green">
                                    <b>Reset Password</b>
                                </small>
    
                                <input id="skip-password" type="checkbox" name="choice_pwd" value="1" class="ace-switch ace-switch-6" />
                                <span class="lbl"></span>
                            </label>
                        </div>
                        <div id="reset-password">
                            <div class="control-group">
                                <label for="Password" class="control-label">Password</label>
                                <div class="controls">
                                    <?php
                                        //$input = array('name'=>'password','id'=>'Password','maxlength'=>32,'class'=>'input-medium');
                                        //echo form_password($input);
                                    ?>
                                    <span class="lbl"></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="RePassword" class="control-label">Re-Type Password</label>
                                <div class="controls">
                                    <?php
                                        //$input = array('name'=>'password_re','id'=>'RePassword','maxlength'=>32,'class'=>'input-medium');
                                        //echo form_password($input);
                                    ?>
                                    <span class="lbl"></span>
                                </div>
                            </div>
                        </div>
                        --->
                       
					
					<hr />
					
					<div class="space"></div>
					<!---
                    <h4 class="header blue bolder smaller">Contact</h4>
					<div class="control-group">
						<label for="Address" class="control-label">Address</label>
						<div class="controls">
							<?php
								//$txtarea = array('name'=>'address','value'=>$address,'rows'=>2,'class'=>'span4');
								//echo form_textarea($txtarea); 
							?>
						</div>
					</div>
					<div class="control-group">
						<label for="Phone" class="control-label">Phone</label>
						<div class="controls">
							<?php
								//$input = array('name'=>'phone','maxlength'=>64,'id'=>'Phone','class'=>'input-medium input-mask-phone');
								//echo form_input($input);
							?>
						</div>
					</div>
					<div class="control-group">
						<label for="HandPhone" class="control-label">HandPhone</label>
						<div class="controls">
							<?php
								//$input = array('name'=>'hp','maxlength'=>64,'id'=>'HandPhone','class'=>'input-medium input-mask-hp');
								//echo form_input($input);
							?>
						</div>
					</div>
					<div class="control-group">
						<label for="PostalCode" class="control-label">Postal Code</label>
						<div class="controls">
							<?php
								//$input = array('name'=>'post_code','maxlength'=>64,'id'=>'PostalCode','class'=>'input-medium input-mask-kdpos');
								//echo form_input($input);
							?>
						</div>
					</div>
					--->
					
					<?php echo form_close(); ?>
				</div>
				
                <div id="edit-address" class="tab-pane">
					<div class="space-10"></div>
					<?php $this->load->view('personal/form_edit_address',$id); ?>
				</div>
                
				<div id="edit-education" class="tab-pane">
					<div class="space-10"></div>
					<?php $this->load->view('personal/view_education',$id); ?>
				</div>

				<div id="edit-training" class="tab-pane">
					<div class="space-10"></div>
					<?php $this->load->view('personal/view_training',$id); ?>
				</div>
                
                <div id="edit-family" class="tab-pane">
					<div class="space-10"></div>
					<?php $this->load->view('personal/view_family',$id); ?>
				</div>
				
				<div id="edit-bank" class="tab-pane">
					<div class="space-10"></div>
					<?php $this->load->view('personal/view_bank',$id); ?>
				</div>
				
				<div id="edit-award" class="tab-pane">
					<div class="space-10"></div>
					<?php $this->load->view('personal/view_award',$id); ?>
				</div>
				
				<div id="edit-disciplines" class="tab-pane">
					<div class="space-10"></div>
					<?php $this->load->view('personal/view_disciplines',$id); ?>
				</div>
			</div>
		</div>
		<div class="space-8"></div>
	</div>
</div>