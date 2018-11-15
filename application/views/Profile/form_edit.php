<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<div class="span12 offset panel-box2">
		<div class="well well-small">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			&nbsp;
			<div class="inline middle blue bigger-110"> Your profile is <?php echo $persentase; ?> complete </div>

			&nbsp; &nbsp; &nbsp;
			<div style="width:200px;" data-percent="<?php echo $persentase; ?>" class="inline middle no-margin progress progress-success progress-striped active">
				<div class="bar" style="width:<?php echo $persentase; ?>"></div>
			</div>
		</div><!--/well-->
		
		<div class="tabbable">
			<ul class="nav nav-tabs padding-16">
				<li class="active" id="tab-basic">
					<a data-toggle="tab" href="#edit-basic">
						<i class="green icon-edit bigger-125"></i>
						Basic Info
					</a>
				</li>

				<li id="tab-education">
					<a data-toggle="tab" href="#edit-education">
						<i class="purple icon-film bigger-125"></i>
						Education
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#edit-training">
						<i class="blue icon-hdd bigger-125"></i>
						Training
					</a>
				</li>
				
				<li>
					<a data-toggle="tab" href="#edit-password">
						<i class="blue icon-key bigger-125"></i>
						Password
					</a>
				</li>
			</ul>

			<div class="tab-content profile-edit-tab-content">
				<div id="edit-basic" class="tab-pane in active">
					<div class="space-10"></div>
					
					<?php echo form_open_multipart($url,array('class'=>'form-horizontal','id'=>'validation-form')); ?>
					<h4 class="header blue bolder smaller">General</h4>

					<div class="row-fluid">
						<div class="span3">
							<p align="center"><span><b>Photo</b></span></p>
							<span class="profile-picture">
								<img title="<?php echo $filename; ?>" class="editable" id="Photo" src="<?php echo base_url() . $file_name;?>" />
							</span>
							<span class="red"><i>Only for *.jpg, *.png and *.gif<br/>Maximum Attachment File (1024 Kb)</i></span>
						</div>
						<div class="vspace"></div>
						<div class="span9">
							<div class="control-group">
								<label for="EmployeeID" class="control-label">Employee ID</label>
								<div class="controls">
									<?php
										$input = array('name'=>'emp_id','value'=>$id,'maxlength'=>16,'id'=>'EmployeeID','class'=>'input-small','disabled'=>'disabled');
										echo form_input($input);
									?>
								</div>
							</div>
							<div class="control-group">
								<label for="FirstName" class="control-label">First Name</label>
								<div class="controls">
									<?php
										$input = array('name'=>'first_name','value'=>$first_name,'maxlength'=>64,'id'=>'FirstName','class'=>'input-large');
										echo form_input($input);
									?>
								</div>
							</div>
							<div class="control-group">
								<label for="MiddleName" class="control-label">Middle Name</label>
								<div class="controls">
									<?php
										$input = array('name'=>'middle_name','value'=>$middle_name,'maxlength'=>64,'id'=>'MiddleName','class'=>'input-large');
										echo form_input($input);
									?>
								</div>
							</div>
							<div class="control-group">
								<label for="LastName" class="control-label">Last Name</label>
								<div class="controls">
									<?php
										$input = array('name'=>'last_name','value'=>$last_name,'maxlength'=>64,'id'=>'LastName','class'=>'input-large');
										echo form_input($input);
									?>
								</div>
							</div>
                            <div class="control-group">
                                <label for="Gender" class="control-label">Gender</label>
                                <div class="controls">
                                    <?php
                                        echo form_dropdown('gender',$option_gender,$gender,'id="Gender" class="span3"');
                                    ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="JoinDate" class="control-label">Join Date</label>
                                <div class="controls">
                                    <?php
                                        $input = array('name'=>'join_date','value'=>$join_date,'id'=>'JoinDate','class'=>'input-small');
                                        echo form_input($input);
                                    ?>
                                </div>
                            </div>
                            
						</div>
					</div>

					<div class="space"></div>
					<h4 class="header blue bolder smaller">Contact</h4>
					<div class="control-group">
						<label for="Email" class="control-label">Email</label>
						<div class="controls">
							<?php
								$input = array('name'=>'email','value'=>$email,'maxlength'=>128,'id'=>'Email','class'=>'input-large');
								echo form_input($input);
							?>
						</div>
					</div>
					<div class="control-group">
						<label for="Address" class="control-label">Address</label>
						<div class="controls">
							<?php
								$txtarea = array('name'=>'address','value'=>$address,'rows'=>3,'class'=>'span5');
								echo form_textarea($txtarea); 
							?>
						</div>
					</div>
					<div class="control-group">
						<label for="Phone" class="control-label">Phone</label>
						<div class="controls">
							<?php
								$input = array('name'=>'phone','maxlength'=>64,'id'=>'Phone','class'=>'input-small input-mask-phone');
								echo form_input($input);
							?>
						</div>
					</div>
					<div class="control-group">
						<label for="HandPhone" class="control-label">HandPhone</label>
						<div class="controls">
							<?php
								$input = array('name'=>'hp','maxlength'=>64,'id'=>'HandPhone','class'=>'input-small input-mask-hp');
								echo form_input($input);
							?>
						</div>
					</div>
					<div class="control-group">
						<label for="PostalCode" class="control-label">Postal Code</label>
						<div class="controls">
							<?php
								$input = array('name'=>'post_code','maxlength'=>64,'id'=>'PostalCode','class'=>'input-small input-mask-kdpos');
								echo form_input($input);
							?>
						</div>
					</div>
					
					<div class="hr"></div>
					<div class="form-actions">
						<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button>&nbsp;
						<?php 
							echo anchor('profile', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
						?>
					</div>
					<?php echo form_close(); ?>
				</div>

				<div id="edit-education" class="tab-pane">
					<div class="space-10"></div>
					
					<?php $this->load->view('Employee/view_education',$id); ?>
				</div>

				<div id="edit-training" class="tab-pane">
					<div class="space-10"></div>
					
					<?php $this->load->view('Employee/view_training',$id); ?>
				</div>
				
				<div id="edit-password" class="tab-pane">
					<div class="space-10"></div>
					
					<?php $this->load->view('Profile/form',$id); ?>
				</div>
			</div>
		</div>
		<div class="space-8"></div>
	</div>
</div>
