<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row-fluid">
	<div class="span10 offset1 panel-box2">
		<h3 class="black">
			<span class="middle"><?php echo $title_head; ?></span>
		</h3>
		<h4 class="header blue bolder smaller">General</h4>

		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name">Category Code</div>

				<div class="profile-info-value">
					<span><?php echo $grade_code; ?></span>
				</div>
			</div>
			<div class="profile-info-row">
				<div class="profile-info-name">Category Name</div>

				<div class="profile-info-value">
					<span><?php echo $grade_name; ?></span>
				</div>
			</div>	
		</div>

		<div class="form-actions">
			<input type="button" name="close" value="Close" class="btn btn-small btn-primary" onClick="self.close()">
		</div>
	</div>
</div>