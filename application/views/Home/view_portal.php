<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="widget-header widget-header-flat widget-header-small">
    <h5>
	<i class="icon-signal"></i>
	Personal Information
    </h5>
</div>
<div class="widget-body">
    <div class="widget-main">
	<div class="row-fluid">
	    <div class="span12 offset panel-box">
		<div>
		    <div>
			<div id="validation-form" class="form-horizontal">
			    <div class="row-fluid">
				<div class="span4">
				    <span class="profile-picture">
					<img title="<?php echo $file_name; ?>" src="<?php echo base_url() . $file_name; ?>" />
				    </span>
				    <div class="space-10"></div>
				    <span class="profile-picture">
					<img title="<?php echo $file_signature; ?>" src="<?php echo base_url() . $file_signature; ?>" />
				    </span>
				</div>
				<div class="span8">
				    <h4 class="blue">
					<span class="middle"><b><?php echo $emp_name; ?></b></span>
					<span class="label label-purple arrowed-in-right">
					    <i class="icon-circle smaller-80"></i>
					    Online
					</span>
				    </h4>
				    <div class="profile-user-info">
					<div class="profile-info-row">
					    <div>
						<span>Born in &nbsp;<?php echo $birth_place; ?>,&nbsp;<?php echo $birth_date; ?></span>
					    </div>
					</div>
					<div class="profile-info-row">
					    <div>
						<h5 class="blue">
						    <span>
							<?php echo $position_name; ?>&nbsp;of&nbsp;<?php echo $company_name; ?>
						    </span>
						</h5>
					    </div>
					</div>
					<div class="profile-info-row">
					    <div>
						<span>Work since <?php echo $join_date; ?></span>
					    </div>
					</div>
					<div class="profile-info-row">
					    <div>
						<span>Currently placed at <?php echo $branch; ?></span>
					    </div>
					</div>
					<div class="profile-info-row">
					    <div>
						<span><h5 class="blue">Residential Address:</h5></span>
					    </div>
					</div>
					<div class="profile-info-row">
					    <div>
						<span><?php echo $address1; ?></span>
					    </div>
					</div>
					<div class="profile-info-row">
					    <div>
						<span>Telp :&nbsp;<?php echo $phone1; ?></span>
					    </div>
					</div>
					<div class="profile-info-row">
					    <div>
						<span>Mobile :&nbsp;<?php echo $mobile_phone1; ?></span>
					    </div>
					</div>
					<div class="profile-info-row">
					    <div>
						<span>Email :&nbsp;<?php echo $email; ?></span>
					    </div>
					</div>
				    </div>
				</div>
			    </div>
			</div>
		    </div>	
		</div>
	    </div>
	</div>
    </div><!--/widget-main-->
</div><!--/widget-body-->