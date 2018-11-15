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
					
					<div id="validation-form" class="form-horizontal">
					<h4 class="header blue bolder smaller">General</h4>

					<div class="row-fluid">
						<div class="span3">
							<span class="profile-picture">
								<img title="<?php echo $filename; ?>" src="<?php echo base_url() . $file_name;?>" />
							</span>
							
						</div>
						<div class="vspace"></div>
						<div class="span9">
							<div class="profile-user-info profile-user-info-striped">
								<div class="profile-info-row">
									<div class="profile-info-name">Employee ID</div>

									<div class="profile-info-value">
										<span><?php echo $id; ?></span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name">Username</div>

									<div class="profile-info-value">
										<span><?php echo $username; ?>&nbsp;</span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name">First Name</div>

									<div class="profile-info-value">
										<span><?php echo $first_name; ?></span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name">Middle Name</div>

									<div class="profile-info-value">
										<span><?php echo $middle_name; ?>&nbsp;</span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name">Last Name</div>

									<div class="profile-info-value">
										<span><?php echo $last_name; ?>&nbsp;</span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name">Gender</div>

									<div class="profile-info-value">
										<span><?php echo @$option_gender[$gender]; ?>&nbsp;</span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name">Position</div>

									<div class="profile-info-value">
										<span><?php echo @$option_position[$position_id]; ?>&nbsp;</span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name">Branch</div>

									<div class="profile-info-value">
										<span><?php echo @$option_branch[$branch_id]; ?>&nbsp;</span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name">Join Date</div>

									<div class="profile-info-value">
										<span><?php echo $join_date; ?>&nbsp;</span>
									</div>
								</div>
							</div>
                            
						</div>
					</div>

					<div class="space"></div>
					<h4 class="header blue bolder smaller">Contact</h4>
					<div class="profile-user-info profile-user-info-striped">
						<div class="profile-info-row">
							<div class="profile-info-name">Email</div>

							<div class="profile-info-value">
								<span><?php echo $email; ?>&nbsp;</span>
							</div>
						</div>
						<div class="profile-info-row">
							<div class="profile-info-name">Address</div>

							<div class="profile-info-value">
								<span><?php echo $address; ?>&nbsp;</span>
							</div>
						</div>
						<div class="profile-info-row">
							<div class="profile-info-name">Phone</div>

							<div class="profile-info-value">
								<span><?php echo $phone; ?>&nbsp;</span>
							</div>
						</div>
						<div class="profile-info-row">
							<div class="profile-info-name">HandPhone</div>

							<div class="profile-info-value">
								<span><?php echo $hp; ?>&nbsp;</span>
							</div>
						</div>
						<div class="profile-info-row">
							<div class="profile-info-name">Postal Code</div>

							<div class="profile-info-value">
								<span><?php echo $post_code; ?>&nbsp;</span>
							</div>
						</div>
					</div>
					
					<div class="hr"></div>
					<div class="form-actions">
						<?php 
							echo anchor('profile/CTRL_Edit/', '<i class="icon-save"></i>&nbsp;Change', array('class'=>'btn btn-small btn-info'));
						?>
					</div>
					</div>
				</div>

				<div id="edit-education" class="tab-pane">
					<div class="space-10"></div>
					
					<?php $this->load->view('Profile/view_education',$id); ?>
				</div>

				<div id="edit-training" class="tab-pane">
					<div class="space-10"></div>
					
					<?php $this->load->view('Profile/view_training',$id); ?>
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