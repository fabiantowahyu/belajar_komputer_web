<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<!--basic styles-->

	<link href="<?php echo base_url();?>themes/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>themes/css/bootstrap-responsive.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo base_url();?>themes/css/font-awesome.min.css" />

	<!--[if IE 7]>
	  <link rel="stylesheet" href="<?php echo base_url();?>themes/css/font-awesome-ie7.min.css" />
	<![endif]-->

	<!--page specific plugin styles-->

	<link rel="stylesheet" href="<?php echo base_url();?>themes/css/chosen.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>themes/css/jquery-ui-1.10.3.custom.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>themes/css/jquery.gritter.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>themes/css/select2.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>themes/css/bootstrap-editable.css" />

	<!--ace styles-->

	<link rel="stylesheet" href="<?php echo base_url();?>themes/css/ace.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>themes/css/ace-responsive.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>themes/css/ace-skins.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>themes/css/custom.css" />

	<!--[if lte IE 8]>
	  <link rel="stylesheet" href="<?php echo base_url();?>themes/css/ace-ie.min.css" />
	<![endif]-->
	
	<!--[if !IE]>-->

	<script src="<?php echo base_url();?>plugins/js/jquery.min.js"></script>

	<!--<![endif]-->

	<!--[if IE]>
	<script src="<?php echo base_url();?>plugins/js/jquery_ie.min.js"></script>
	<![endif]-->

	<!--[if !IE]>-->

	<script type="text/javascript">
		window.jQuery || document.write("<script src='<?php echo base_url();?>themes/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
	</script>

	<!--<![endif]-->

	<!--[if IE]>
	<script type="text/javascript">
	 window.jQuery || document.write("<script src='<?php echo base_url();?>themes/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
	</script>
	<![endif]-->

	<script type="text/javascript">
		if("ontouchend" in document) document.write("<script src='<?php echo base_url();?>themes/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
	</script>
	<script src="<?php echo base_url();?>plugins/js/function.js"></script>
	<script src="<?php echo base_url();?>themes/js/bootstrap.min.js"></script>

	<!--ace scripts-->

	<script src="<?php echo base_url();?>themes/js/ace-elements.min.js"></script>
	<script src="<?php echo base_url();?>themes/js/ace.min.js"></script>
	
<?php
	if(!empty($plugin)) {
		$this->load->view($plugin);
	}
?>
</head>
<body>
<?php
if($err) {
?>
<div class="err" align="center">
	<h4 class="title">WARNING !!</h4>
    <h4 class="title"><?php echo $err; ?></h4>
</div>
<?php
} else {
if(strlen($id)) {
?>
<div class="row-fluid">
	<h4 class="header smaller lighter blue">
		<?php 
		echo nbs(2); 
		echo $title; 
		?>
	</h4>
	<?php
		$img_excel = '<img src='.base_url().'/themes/images/xlsfile.gif />';
		echo nbs(2);
		echo anchor($url_excel, $img_excel, array('title'=>'Export to Excel'));
	?>

	

	<table id="table-employee" class="table table-striped table-bordered table-hover">
		<thead class="danger">
			<tr>
				<th width="100">Employee ID</th>
				<th width="150">Employee Name</th>
				<th width="150">Position</th>
				<th width="150">Status</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($results as $row) { ?>
			<tr>
				<td><?php echo $row->emp_id;?></td>
				<td><?php echo $row->emp_name;?></td>
				<td><?php echo $row->position; ?></td>
				<td><?php echo $row->emp_status; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<?php
}
}
?>
</body>
</html>