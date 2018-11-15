<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $this->config->item('website_title'); ?></title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link rel="shortcut icon" href="<?php echo base_url();?>themes/icon/logo.ico" />
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

		<!--inline styles related to this page-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	
	<body>

		<div class="main-container container-fluid">
		<!--	<div class="main-content"> -->
				<div class="page-content">
					<?php
						echo $page;
					?>
				</div><!--/.page-content-->
			<!--</div>/.main-content-->
		</div><!--/.main-container-->

		<!--basic scripts-->

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
		?>
			<div id="xLoader" style="opacity: 0.8;position:fixed;"><div class="google-spin-wrapper" ><div class="google-spin"></div></div></div>
			<link rel="stylesheet" href="<?php echo base_url();?>plugins/css/xloader.css">
		<?php
		}
		?>
	</body>
</html>
<script type="text/javascript">
		//$(document).ready(function(){
			$('#xLoader').hide();
		//});
		
		/*var button = $('button').not(':button[data-toggle=dropdown]');
		$(button).click(function(e){
			$('#xLoader').show();
		});*/

		$('form').submit(function(){
            if($(this).valid()) {
                $('.page-content').fadeOut();
                $('#xLoader').show();
            }
        });
		/*$('[data-role=page]').live('pagebeforeshow', function (event, ui) {
     		$('#xLoader').show();
		}); */

</script>