<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<div class="span10 offset1 panel-box2">
		<h3 class="black">
			<span class="middle"><?php echo $title_head; ?></span>
			<?php
			if($cek_status) {
			?>
				<span class="label label-info arrowed-in-right">
					<i class="icon-circle smaller-80"></i>
					<?php echo $status; ?>
				</span>
			<?php
			} else {
			?>
				<span class="label label-warning arrowed-in-right">
					<i class="icon-ban-circle smaller-80"></i>
					<?php echo $status; ?>
				</span>
			<?php
			}
			?>
		</h3>
		<h4 class="header blue bolder smaller">General</h4>

		<div class="row-fluid">
			<div class="span4">
				<span class="profile-picture">
					<img class="editable" id="logoCompanyd_bak" src="<?php echo base_url() . $file_name;?>" />
				</span>
			</div>
			<div class="vspace"></div>
			<div class="span8">
				<div class="profile-user-info profile-user-info-striped">
					<div class="profile-info-row">
						<div class="profile-info-name"><?php echo $title; ?> ID</div>

						<div class="profile-info-value">
							<span><?php echo $id; ?></span>
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
						<div class="profile-info-name">Position</div>

						<div class="profile-info-value">
							<span><?php echo $position_id; ?>&nbsp;</span>
						</div>
					</div>
					<div class="profile-info-row">
						<div class="profile-info-name">Gender</div>

						<div class="profile-info-value">
							<span><?php echo $gender; ?>&nbsp;</span>
						</div>
					</div>
					<div class="profile-info-row">
						<div class="profile-info-name">Join Date</div>

						<div class="profile-info-value">
							<span><?php echo $join_date; ?>&nbsp;</span>
						</div>
					</div>
					<div class="profile-info-row">
						<div class="profile-info-name">Username</div>

						<div class="profile-info-value">
							<span><?php echo $username; ?>&nbsp;</span>
						</div>
					</div>
					<div class="profile-info-row">
						<div class="profile-info-name">Role Application</div>

						<div class="profile-info-value">
							<span><?php echo $role; ?>&nbsp;</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		
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

		<div class="form-actions">
			<input type="button" name="close" value="Close" class="btn btn-small btn-primary" onClick="self.close()">
		</div>
	</div>
</div>