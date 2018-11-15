<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row-fluid">
	<div class="span12 offset panel-box2">
		<div><h3><?php echo $title_head; ?></h3></div>
		
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
						<i class="blue icon-envelope bigger-125"></i>
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
				
<!--				<li id="tab-disciplines">
					<a data-toggle="tab" href="#edit-disciplines">
						<i class="blue icon-exclamation-sign"></i>
						Disciplines History
					</a>
				</li>-->
			</ul>

			<div class="tab-content profile-edit-tab-content">
				<div id="edit-basic" class="tab-pane in active">
					<div class="space-10"></div>
					
                                <?php echo form_open_multipart($url,array('name'=>'form_employee','class'=>'form-horizontal','id'=>'validation-form')); ?>
                                <h4 class="header blue bolder smaller">General</h4>
					
                    <table border="0" cellpadding="5" cellspacing="2" width="100%">
                    	<tr>
                        	<td width="20%">
                            <p align="center"><span><b>Photo</b></span></p>
                            <span class="profile-picture">
                                <img class="editable" id="Photo" src="<?php echo base_url() . $file_name;?>" width="150" />
                            </span><br/>
                            <span class="red"><i>Only for *.jpg, *.png and *.gif<br/>Maximum Attachment File (1024 Kb)</i></span>
                            </td>
                            <td valign="top" rowspan="2">
                            	<table  border="0" cellpadding="5" cellspacing="2" width="100%">
                                	<tr>
                                    	<td colspan="6"><b>Employee Id : <?php echo $id; ?></b><hr /></td>
                                    </tr>
                                	<tr>
                                    	<td align="left" width="17%">
                                        	<label for="FirstName">First Name <span class="red bolder smaller" class="control-table">*</span></label>
                                        </td>
                                        <td width="10%">
                                        	<?php
												$input = array('name'=>'first_name','value'=>$first_name,'maxlength'=>64,'id'=>'FirstName','class'=>'input-middle');
												echo form_input($input);
											?>
                                        </td>
                                        <td width="5%"></td>
                                        <td  align="left">
                                        	<label for="MiddleName">Middle Name</label>
                                        </td>
                                        <td width="10%">
                                        	<?php
												$input = array('name'=>'middle_name','value'=>$middle_name,'maxlength'=>64,'id'=>'MiddleName','class'=>'input-middle');
												echo form_input($input);
											?>
                                        </td>
                                    </tr>
                                	<tr>
                                    	<td align="left" width="15%">
                                        	<label for="FirstName">Last Name</label>
                                        </td>
                                        <td width="10%">
                                        <?php
											$input = array('name'=>'last_name','value'=>$last_name,'maxlength'=>64,'id'=>'LastName','class'=>'input-large');
											echo form_input($input);
										?>
                                        </td>
                                        <td width="2%"></td>
                                        <td  align="left">
                                        	<label for="Position">Position <span class="red bolder smaller">*</span></label>
                                        </td>
                                        <td width="10%">
										<?php
                                            echo form_dropdown('position_id',$option_position,$position_id,'id="Position" class="span11"');
                                        ?>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td align="left" width="15%">
                                        	 <label for="Gender">Gender</label>
                                        </td>
                                        <td width="10%">
                                        <?php
											echo form_dropdown('gender',$option_gender,$gender,'id="Gender" class="span11"');
										?>
                                        </td>
                                        <td width="2%"></td>
                                        <td  align="left">
                                        	<label for="branch">Branch</label>
                                        </td>
                                        <td width="10%">
                                                <?php
                                                   echo form_dropdown('branch_id',$option_branch,$branch_id,'id="branch" class="span11"');
                                                ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  align="left" width="15%">
                                        	<label for="grade">Grade <span class="red bolder smaller">*</span></label>
                                        </td>
                                        <td width="10%">
                                                <?php
                                                   echo form_dropdown('grade_id',$option_grade,$grade_id,'id="grade" class="span11"');
                                                ?>
                                        </td>
                                        <td width="2%"></td>
                                        <td  align="left" width="15%">
                                                <label for="CostCenter">Cost Center <span class="red bolder smaller">*</span></label>
                                        </td>
                                                <td>
                                                    <?php
                                                            echo form_dropdown('cost_center',$option_costcenter,$cost_center,'id="cost_center" class="span11"');
                                                     ?>
                                                </td>
                                    </tr>
                                    <tr>
                                        <td  align="left" width="15%">
                                        	<label for="id_number">ID Number</label>
                                        </td>
                                        <td width="10%">
                                            <?php
                                                $input = array('name'=>'id_number','value'=>$id_number,'id'=>'id_number','class'=>'input-middle');
                                                echo form_input($input);
                                            ?>
                                        </td>
                                        <td width="2%"></td>
                                        <td align="left">
                                        	<label for="ID_ExpiredDate">ID Expired Date</label>
                                        </td>
                                        <td width="10%">
                                            <?php
                                                $input = array('name'=>'id_expireddate','value'=>$id_expireddate,'id'=>'id_expireddate','class'=>'input-medium');
                                                echo form_input($input);
                                            ?>
                                          <span class="add-on">
                                              <i class="icon-calendar"></i>
                                          </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  align="left" width="15%">
                                        	<label for="birth_place">Birth Place <span class="red bolder smaller">*</span></label>
                                        </td>
                                        <td width="10%">
                                            <?php
                                                $input = array('name'=>'birth_place','value'=>$birth_place,'id'=>'birth_place','class'=>'input-middle');
                                                echo form_input($input);
                                            ?>
                                        </td>
                                        <td width="2%"></td>
                                        <td align="left">
                                        	<label for="birth_date">Birth Date <span class="red bolder smaller">*</span></label>
                                        </td>
                                        <td width="10%">
                                            <?php
                                                $input = array('name'=>'birth_date','value'=>$birth_date,'id'=>'birth_date','class'=>'input-medium');
                                                echo form_input($input);
                                            ?>
                                            <span class="add-on">
                                                <i class="icon-calendar"></i>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td align="left" width="15%">
                                            <label for="marital_status">Marital Status<span class="red bolder smaller">*</span></label>
                                        </td>
                                        <td width="10%">
                                            <?php
                                               echo form_dropdown('marital_status',$option_maritalstatus,$marital_status,'id="marital_status" class="span11"');
                                            ?>
                                        </td>
                                        <td width="5%"></td>
                                        <td align="left">
                                        	<label for="marital_date">Marital Date</label>
                                        </td>
                                        <td width="10%">
                                            <?php
                                                $input = array('name'=>'marital_date','value'=>$marital_date,'id'=>'marital_date','class'=>'input-medium');
                                                echo form_input($input);
                                            ?>
                                            <span class="add-on">
                                                <i class="icon-calendar"></i>
                                            </span>
                                        <td width="2%"></td>
                                    </tr>
                                    <tr>
                                    	<td  align="left" width="15%">
                                        	<label for="marital_status">Religion <span class="red bolder smaller">*</span></label>
                                        </td>
                                        <td width="10%">
                                            <?php
                                               echo form_dropdown('religion',$option_religion,$religion,'id="religion" class="span11"');
                                            ?>
                                        </td>
                                        <td width="5%"></td>
                                        <td align="left">
                                        	<label for="marital_place">Marital Place</label>
                                        </td>
                                        <td width="10%">
	 									<?php
                                            $input = array('name'=>'marital_place','value'=>$marital_place,'id'=>'marital_place','class'=>'input-middle');
                                            echo form_input($input);
                                        ?>
                                        <td width="2%"></td>
                                    </tr>
                                    <tr>
                                      <td align="left" width="15%">
                                        <label for="marital_place">Employment Status</label>
                                      </td>
                                      <td width="10%">
	 									<?php
                                           echo form_dropdown('emp_status',$option_empstatus,$emp_status,'id="emp_status" class="span12" onchange="setOnOff(document.form_employee);"');
                                        ?>
									  </td>
									  <td width="5%"></td>
									  <td align="left">
                                        	<label for="JoinDate">Effective Date <span class="red bolder smaller">*</span></label>
                                      </td>
                                      <td width="10%">
	 									<?php
                                            $input = array('name'=>'join_date','value'=>$join_date,'id'=>'JoinDate','class'=>'input-medium');
                                            echo form_input($input);
                                        ?>
                                          <span class="add-on">
                                              <i class="icon-calendar"></i>
                                          </span>
                                      </td>
									</tr>
									<tr id="enddate">									
									  <td align="left" width="15%">
                                       	<label for="end_date">End Date</label>
                                      </td>
                                      <td width="10%">
	 									<?php
                                            $input = array('name'=>'end_date','value'=>$end_date,'id'=>'end_date','class'=>'input-medium');
                                            echo form_input($input);
                                        ?>
                                          <span class="add-on">
                                              <i class="icon-calendar"></i>
                                          </span>
									  </td>
                                      <td width="2%"></td>
                                      <td  align="left" width="15%">
											<label for="Email">Email</label>
										</td>
										<td>
										 <?php
											  $input = array('name'=>'email','value'=>$email,'maxlength'=>128,'id'=>'Email','class'=>'input-middle');
											  echo form_input($input);
										  ?>
										</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        
                         <tr>
                        	<td width="20%">
                            <p align="center"><span><b>Employee Signature</b></span></p>
							<span class="profile-picture">
								<img class="editable" id="Signature" width="150" src="<?php echo base_url() . $file_signature;?>" />
							</span><br>
							<span class="red"><i>Only for *.jpg, *.png and *.gif<br/>Maximum Attachment File (1024 Kb)</i></span>
                            </td>
                        </tr>
                    </table>                     
					
					<hr />
					
					<div class="space"></div>
					<div class="form-actions">
						<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button>&nbsp;
						<?php 
							echo anchor('employee', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
							echo nbs(1);
							echo form_hidden('emp_id',$id);
						?>
						<a href="#" id="cdelete" class="btn btn-small btn-danger"><i class="icon-trash"></i>&nbsp;Delete</a>
					</div>
					<?php echo form_close(); ?>
				</div>
				
                <div id="edit-address" class="tab-pane">
					<div class="space-10"></div>
					<?php $this->load->view('Employee/form_edit_address',$id); ?>
				</div>
                
				<div id="edit-education" class="tab-pane">
					<div class="space-10"></div>
					<?php $this->load->view('Employee/view_education',$id); ?>
				</div>

				<div id="edit-training" class="tab-pane">
					<div class="space-10"></div>
					<?php $this->load->view('Employee/view_training',$id); ?>
				</div>
                
                <div id="edit-family" class="tab-pane">
					<div class="space-10"></div>
					<?php $this->load->view('Employee/view_family',$id); ?>
				</div>
				
				<div id="edit-bank" class="tab-pane">
					<div class="space-10"></div>
					<?php $this->load->view('Employee/view_bank',$id); ?>
				</div>
				
				<div id="edit-award" class="tab-pane">
					<div class="space-10"></div>
					<?php $this->load->view('Employee/view_award',$id); ?>
				</div>
				
<!--				<div id="edit-disciplines" class="tab-pane">
					<div class="space-10"></div>
					<?php $this->load->view('Employee/view_disciplines',$id); ?>
				</div>-->
			</div>
		</div>
		<div class="space-8"></div>
	</div>
</div>
<?php echo form_open($url_del,array('name'=>'del','id'=>'del')); ?>
<input type="hidden" name="id" id="delid" value="<?php echo $id; ?>">
<?php echo form_close(); ?>

<script>
function setOnOff(thisform)
{
	if (thisform.emp_status.value != 'Permanent')
	{
	
		document.getElementById('enddate').style.display = '';
	} else {
		document.getElementById('enddate').style.display = 'none';
	}
	
}
</script>