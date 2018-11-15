<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <div class="span12">
	<div class="span5">
	    <form method="post" id="form-filter" action="<?= base_url() ?>setup_dashboard/CTRL_SetFilterGroup">
		<div class="row-fluid input-append">
		    <div class="form-group">
			<select name="user_group" onchange="submitChange()" class="form-control">
			    <?php
			    foreach ($group as $group) {
				?>
    			    <option value="<?= $group->id ?>" <?= $group->id == $active_group ? 'selected' : '' ?>><?= $group->nama ?></option>
			    <?php } ?>
			</select>
		    </div>
		</div>
	    </form> 
	</div>
	<div class="clearfix"></div>
	<div class="span5">	    
	    <div class="well">
		<h5><strong>Add Access</strong></h5>
		<form method="post" action="<?= base_url() ?>setup_dashboard/CTRL_AddDashboardView">
		    <input type="hidden" name="group_id" value="<?= isset($active_group) ? $active_group : '' ?>">
		    <div class="form-group">
			<select name="view_id" class="form-control" id="dashboard">
			    <?php
			    foreach ($dashboard_view as $key => $view) {
				?>
    			    <option value="<?= $view->id ?>"><?= $view->view_title ?></option>
				<?php
			    }
			    ?>
			</select>
		    </div>
		    <div class="form-group">
			<select name="position" class="form-control" id="position">
			    <option value="L">LEFT</option>
			    <option value="R">RIGHT</option>
			</select>
		    </div>
		    <button class="btn btn-small btn-warning pull-right"><i class="fa fa-plus"></i> Add</button>
		    <div class="clearfix"></div>
		</form>
	    </div>
	</div>	
	<div class="clearfix"></div>
	<div class="span5">
	    <div class="well">
		<h5><strong>LEFT</strong></h5> <br/>
		<table class="table table-striped table-bordered table-hover">
		    <thead class="info">
		    <th>View Name</th>
		    <th>Action</th>
		    </thead>
		    <tbody>
			<?php
			foreach ($active_view_left as $key => $v) {
			    ?>
    			<tr>
    			    <td><?= $v->view_title ?></td>
    			    <td><a href="<?= base_url() ?>setup_dashboard/CTRL_DeleteView/<?= $v->previlege_id ?>" class="btn btn-danger btn-mini">Remove</td>
    			</tr>
			    <?php
			}
			?>
		    </tbody>
		</table>
	    </div>	
	</div>	    
	<div class="span5">
	    <div class="well">
		<h5><strong>RIGHT</strong></h5> <br/>
		<table class="table table-striped table-bordered table-hover">
		    <thead class="info">
		    <th>View Name</th>
		    <th>Action</th>
		    </thead>
		    <tbody>
			<?php
			foreach ($active_view_right as $key => $v) {
			    ?>
    			<tr>
    			    <td><?= $v->view_title ?></td>
    			    <td><a href="<?= base_url() ?>setup_dashboard/CTRL_DeleteView/<?= $v->previlege_id ?>" class="btn btn-danger btn-mini">Remove</td>
    			</tr>
			    <?php
			}
			?>
		    </tbody>
		</table>
	    </div>		    
	</div>	
    </div>
</div>
<script src="<?php echo base_url(); ?>themes/js/jquery.js"></script>

<!-- sweet alert -->
<link href="<?php echo base_url(); ?>themes/js/plugin/sweet-alert/sweet-alert.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>themes/js/plugin/sweet-alert/sweet-alert.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/plugin/sweet-alert/sweet-alert.init.js"></script>
<script type="text/javascript">
			    function submitChange() {
				document.getElementById('form-filter').submit();
			    }
</script>
