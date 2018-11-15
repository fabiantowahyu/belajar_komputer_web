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
						<div class="profile-info-name"><?php echo $title; ?> Name</div>

						<div class="profile-info-value">
							<span><?php echo $name; ?></span>
						</div>
					</div>
					<div class="profile-info-row">
						<div class="profile-info-name">Country</div>

						<div class="profile-info-value">
							<span><?php echo $country; ?>&nbsp;</span>
						</div>
					</div>
					<div class="profile-info-row">
						<div class="profile-info-name">Province</div>

						<div class="profile-info-value">
							<span><?php echo $province; ?>&nbsp;</span>
						</div>
					</div>
					<div class="profile-info-row">
						<div class="profile-info-name">City</div>

						<div class="profile-info-value">
							<span><?php echo $city; ?>&nbsp;</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<h4 class="header blue bolder smaller">Contact</h4>
		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name">Address</div>

				<div class="profile-info-value">
					<span><?php echo $address; ?>&nbsp;</span>
				</div>
			</div>
			<div class="profile-info-row">
				<div class="profile-info-name">Postal Code</div>

				<div class="profile-info-value">
					<span><?php echo $postal_code; ?>&nbsp;</span>
				</div>
			</div>
			<div class="profile-info-row">
				<div class="profile-info-name">Phone</div>

				<div class="profile-info-value">
					<span><?php echo $phone; ?>&nbsp;</span>
				</div>
			</div>
			<div class="profile-info-row">
				<div class="profile-info-name">Fax</div>

				<div class="profile-info-value">
					<span><?php echo $fax; ?>&nbsp;</span>
				</div>
			</div>
			<div class="profile-info-row">
				<div class="profile-info-name">Email</div>

				<div class="profile-info-value">
					<span><?php echo $email; ?>&nbsp;</span>
				</div>
			</div>
		</div>

		<div class="space"></div>
		<h4 class="header blue bolder smaller">Bank Account</h4>
		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name">Company Bank Account</div>

				<div class="profile-info-value">
					<span><?php echo $bank_account; ?>&nbsp;</span>
				</div>
			</div>
			<div class="profile-info-row">
				<div class="profile-info-name">Company Bank Name</div>

				<div class="profile-info-value">
					<span><?php echo $bank_name; ?>&nbsp;</span>
				</div>
			</div>
			<div class="profile-info-row">
				<div class="profile-info-name">Account Name</div>

				<div class="profile-info-value">
					<span><?php echo $account_name; ?>&nbsp;</span>
				</div>
			</div>
		</div>
		
		<div class="space"></div>
		<h4 class="header blue bolder smaller">Other</h4>
		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name">Vision</div>

				<div class="profile-info-value">
					<span><?php echo $vission; ?>&nbsp;</span>
				</div>
			</div>
			<div class="profile-info-row">
				<div class="profile-info-name">Mission</div>

				<div class="profile-info-value">
					<span><?php echo $mission; ?>&nbsp;</span>
				</div>
			</div>
			<div class="profile-info-row">
				<div class="profile-info-name">Company Currency</div>

				<div class="profile-info-value">
					<span><?php echo $currency; ?>&nbsp;</span>
				</div>
			</div>
			<div class="profile-info-row">
				<div class="profile-info-name">Tax Country</div>

				<div class="profile-info-value">
					<span><?php echo $tax_country; ?>&nbsp;</span>
				</div>
			</div>
			<div class="profile-info-row">
				<div class="profile-info-name">Tax File Number</div>

				<div class="profile-info-value">
					<span><?php echo $tax_file; ?>&nbsp;</span>
				</div>
			</div>
		</div>
		<div class="form-actions">
			<input type="button" name="close" value="Close" class="btn btn-small btn-primary" onClick="self.close()">
		</div>
	</div>
</div>