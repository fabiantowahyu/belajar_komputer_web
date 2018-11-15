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


		<!--ace styles-->
		<link rel="stylesheet" href="<?php echo base_url();?>themes/css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>themes/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>themes/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo base_url();?>themes/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	</head>

	<body class="login-layout">
    <?php 
		$this->load->model('md_admin');
		$result_company = $this->md_admin->MDL_Select_Company();
		$company_name = $result_company->company_name;
	  ?>
		<div class="main-container container-fluid">
			<div class="main-content">
				<div class="row-fluid">
					<div class="span12">
                    	<div class="center">
                            <h3>
                                <!-- <i class="icon-beaker white"></i> -->
                                <span class="white"><b>Human Capital Management System</b></span>
                            </h3>
                            <h4 class="white"><b><?php echo $company_name; ?></b> </h4>
                        </div>
                        
						<div class="login-container">
							
							<div class="space-6"></div>

							<div class="row-fluid">
								<div class="position-relative">
									<div id="login-box" class="login-box visible widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header blue lighter bigger">
													<img src="<?php echo base_url();?>file_upload/logo/CMPY00001.jpg"><br/>
													<i class="icon-coffee green"></i>
													Please Enter Your Information
												</h4>

												<div class="space-6"></div>

												<?php echo form_open("login/doLogin",array("name"=>"frmLogin"));?>
													<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
																<?php
																	$input = array("name"=>"txtUserName","class"=>"span12","placeholder"=>"Username",'required'=>'required');
																	echo form_input($input);
																?>
																<i class="icon-user"></i>
															</span>
														</label>

														<label>
															<span class="block input-icon input-icon-right">
																<?php
																	$input = array("name"=>"txtPWD","class"=>"span12","placeholder"=>"Password",'required'=>'required');
																	echo form_password($input);
																?>
																<i class="icon-lock"></i>
															</span>
														</label>

														<div class="space"></div>

														<div class="clearfix">
															<button name="btnLogin" type="submit" class="width-35 pull-right btn btn-small btn-primary">
																<i class="icon-key"></i>
																Login
															</button>
														</div>

														<div class="space-4"></div>
													</fieldset>
												<?php echo form_close(); ?>

												<br><br>
											</div><!--/widget-main-->

											<div class="toolbar clearfix">
												<div>
													<a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">
														<i class="icon-arrow-left"></i>
														I forgot my password
													</a>
												</div>

											</div>
										</div><!--/widget-body-->
									</div><!--/login-box-->

									<div id="forgot-box" class="forgot-box widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header red lighter bigger">
													<i class="icon-key"></i>
													Retrieve Password
												</h4>

												<div class="space-6"></div>
												<p>
													Enter your email and to receive instructions
												</p>

												<form action="<?=base_url()?>login/forgot_password" method="post">
													<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
																<input type="email" class="span12" placeholder="Email" name="forgot_email" />
																<i class="icon-envelope"></i>
															</span>
														</label>

														<div class="clearfix">
															<button class="width-35 pull-right btn btn-small btn-danger">
																<i class="icon-lightbulb"></i>
																Send Me!
															</button>
														</div>
													</fieldset>
												</form>
											</div><!--/widget-main-->

											<div class="toolbar center">
												<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
													Back to login
													<i class="icon-arrow-right"></i>
												</a>
											</div>
										</div><!--/widget-body-->
									</div><!--/forgot-box-->
								</div><!--/position-relative-->
							</div>
                            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                            <br><br><br><br>
                            <div class="center">
                                <h5>
                                    <span class="white">@2016, PSA Technology. All Rights Reserved</span>
                                </h5>
                            </div>
						</div>
					</div><!--/.span-->
				</div><!--/.row-fluid-->
			</div>

			<div id="xLoader" style="opacity: 0.8;position:fixed;"><div class="google-spin-wrapper" ><div class="google-spin"></div></div></div>
			<link rel="stylesheet" href="<?php echo base_url();?>plugins/css/xloader.css">

		</div><!--/.main-container-->
		<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
		<script src="<?php echo base_url();?>themes/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--ace scripts-->

		<script src="<?php echo base_url();?>themes/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>themes/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			function show_box(id) {
			 $('.widget-box.visible').removeClass('visible');
			 $('#'+id).addClass('visible');
			}


			//$(document).ready(function(){
				$('#xLoader').hide();
			//});

			$('form').submit(function(e){
				if($(this).valid()) {
	            	$('.page-content').fadeOut();
					$('#xLoader').show();
        		}
			});

			function showLoader(){
				$('#xLoader').show();
			}
		</script>
	</body>
</html>
