<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $this->config->item('website_title'); ?></title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link rel="shortcut icon" href="<?php echo base_url();?>themes/icon/psa.ico" />
		<!--basic styles-->

		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		<link href="<?php echo base_url();?>themes/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo base_url();?>themes/css/font-awesome.min.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>plugins/css/materialize.min.css"  media="screen,projection"/>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      	<script type="text/javascript" src="<?php echo base_url();?>plugins/js/materialize.min.js"></script>

		<!--[if IE 7]>
		  <link rel="stylesheet" href="<?php echo base_url();?>themes/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->


		<!--ace styles-->

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo base_url();?>themes/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<style>
			/* label focus color */
		   .input-field input[type=text]:focus + label {
		     color: #039be5;
		   }
		   .input-field input[type=password]:focus + label {
		     color: #039be5;
		   }
		   .input-field input[type=email]:focus + label {
		     color: #039be5;
		   }
		   /* label underline focus color */
		   .input-field input[type=text]:focus {
		     border-bottom: 1px solid #039be5;
		     box-shadow: 0 1px 0 0 #039be5;
		   }
		   .input-field input[type=password]:focus {
		     border-bottom: 1px solid #039be5;
		     box-shadow: 0 1px 0 0 #039be5;
		   }
		   .input-field input[type=email]:focus {
		     border-bottom: 1px solid #039be5;
		     box-shadow: 0 1px 0 0 #039be5;
		   }
		   .input-field input[type=text].valid {
		     border-bottom: 1px solid #039be5;
		     box-shadow: 0 1px 0 0 #039be5;
		   }
		   .input-field input[type=password].valid {
		     border-bottom: 1px solid #039be5;
		     box-shadow: 0 1px 0 0 #039be5;
		   }
		   .input-field input[type=email].valid {
		     border-bottom: 1px solid #039be5;
		     box-shadow: 0 1px 0 0 #039be5;
		   }
		</style>
	</head>

	<body class="login-layout teal darken-1">
		<div class="main-container container-fluid" style="background-color: white">
				<div class="row-fluid">
					<div class="row">
						<div class="login-container col s3" style="padding: 0px;float: left; margin-left: 100px;font-family: arial,helvetica,sans-serif" >
							<br/><br/><br/>
							<div class="card">
							    <div class="card-content">
							      <span class="card-title activator grey-text text-darken-4">LOGIN</span>
							      <?php echo form_open("login/doLogin",array("name"=>"frmLogin"));?>
										<div class="row">
									        <div class="input-field col s12">
									          <input type="text" class="validate" name="txtUserName">
									          <label for="txtUserName">Username</label>
									        </div>
									      </div>
									    <div class="row">
									        <div class="input-field col s12">
									          <input type="password" class="validate" name="txtPWD">
									          <label for="txtPWD">Password</label>
									        </div>
									    </div>
									    <!-- <a class="waves-effect waves-light btn red activator" style="margin-left:50px;">Forgot</a> -->
									    <button type="submit" class="waves-effect waves-light btn teal darken-1" style="margin-left:170px;">Login</button>
									<?php echo form_close(); ?>
							    </div>
							    <div class="card-action">
					              <a href="#" class="activator" style="margin-left:70px;;">Forgot Password</a>
					            </div>
							    <div class="card-reveal">
							      <span class="card-title grey-text text-darken-4">Forgot Password<i class="material-icons right">close</i></span>
							      <form method="post" action="<?=base_url()?>login/forgot_password">
								      <div class="row"><br/><br/>
								      	Please enter your email
								        <div class="input-field col s12">
								          <input type="email" class="validate" name="email" required>
								          <label for="email">Email</label>
								        </div>
								      </div>
								      <button type="submit" class="waves-effect waves-light btn teal darken-1" style="margin-left:100px;">Reset</button>
							   	  </form>
							    </div>
							  </div>
						</div>
						
					</div><!--/.span-->
				</div><!--/.row-fluid-->

		</div><!--/.main-container-->
		<!--basic scripts-->

		<!--[if !IE]>-->
		
		
		<!-- <div class="span4">
			<img src="<?=base_url()?>images/playstore.png" width="180px;" style="margin-top:30px;"/>
		</div> -->
            <!-- <h5>
                <span class="white">@2015, PT. Carsurin. All Rights Reserved</span>
          	</h5> -->
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
		$('#wrong_password').hide();
			function show_box(id) {
			 $('.widget-box.visible').removeClass('visible');
			 $('#'+id).addClass('visible');
			}

			function submitForm(){
				if($('#password').val() != $('#repeat_password').val()){
					$('#wrong_password').show();
				}else{
					document.getElementById("registration").action = "<?php echo base_url()?>login/do_register";
				}
			}
			
			$(document).ready(function(){
				$('#xLoader').hide();
			});

			/*$(':input[type=submit]').click(function(e){
				$('.page-content').fadeOut();
				$('#xLoader').show();
			});*/
			$('form').submit(function(){
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
