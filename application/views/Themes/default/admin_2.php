<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $this->config->item('website_title'); ?></title>
	<link rel="shortcut icon" href="<?php echo base_url();?>icon/logo.ico" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/themes/default/styleadmin.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/themes/icon.css">
	<script type="text/javascript" src="<?php echo base_url();?>js/function.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/clock.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.easyui.min.js"></script>
	<style>		
		a:link{color: #0000ff;}
		a:visited{color: #0000ff;}
		a:hover{color: #3366ff;}
		a{text-decoration:none;}
		.txtNumber {
			text-align: right;
		}
		
		.err {
			margin-top: 20px;
			color: #FF0000;
			font-size: 14pt;
		}
		.err a {
			color: #FF0000;
			font-size: 14pt;
		}
	</style>

	<script type="text/javascript"> 

		function PopUpWindow(url,name,w,h,r,s,sys) { //sys,title,msg
			var newwindow = window.open(url,name,"toolbar=0,location=0,directories=0,status=0,menubar=0,resizable="+r+",scrollbars="+s+",width="+w+",height="+h+"");
			if (newwindow.focus != null) newwindow.focus();
			//newwindow.opener.name = name;
		}
		
		function Set_Cookie( name, value, expires, path, domain, secure ) {
			// set time, it's in milliseconds
			var today = new Date();
			today.setTime( today.getTime() );
		
			/*
			if the expires variable is set, make the correct
			expires time, the current script below will set
			it for x number of days, to make it for hours,
			delete * 24, for minutes, delete * 60 * 24
			*/
			if ( expires ) {
				expires = expires * 1000 * 60 * 60 * 24;
			}
			var expires_date = new Date( today.getTime() + (expires) );
		
			document.cookie = name + "=" +escape( value ) +
			( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) +
			( ( path ) ? ";path=" + path : "" ) +
			( ( domain ) ? ";domain=" + domain : "" ) +
			( ( secure ) ? ";secure" : "" );
		}
		
		function Get_Cookie( name ) {
			var start = document.cookie.indexOf( name + "=" );
			var len = start + name.length + 1;
			if ( ( !start ) && ( name != document.cookie.substring( 0, name.length ) ) ) {
				return null;
			}
			if ( start == -1 ) return null;
			var end = document.cookie.indexOf( ";", len );
			if ( end == -1 ) end = document.cookie.length;
			return unescape( document.cookie.substring( len, end ) );
		}
		
		// this deletes the cookie when called
		function Delete_Cookie( name, path, domain ) {
			if ( Get_Cookie( name ) ) document.cookie = name + "=" +
			( ( path ) ? ";path=" + path : "") +
			( ( domain ) ? ";domain=" + domain : "" ) +
			";expires=Thu, 01-Jan-1970 00:00:01 GMT";
		}

	</script>
</head>
<body onLoad="goforit()">
	<div id="header_wrapper">
        <div id="header">
            <div id="logo">
                <img src="<?php echo base_url();?>images/toplogo_orange.png" alt="Carsurin">
            </div>
			<div class="nav_wrapper">
				<ul id="css3menu1" class="topmenu">
				
					<?php
						$id = $this->session->userdata('userid');
						$menubox = $this->md_menubox->MDL_content_menubox2($id);
						echo $menubox;
					?>
				</ul>
				<div class="search_top">
					<?php
						//$this->load->model('md_company');
						$option_company = $this->md_company->MDL_Option_Company();
						$comID = "";
						echo form_dropdown('comID ',$option_company,$comID);
					?>
					&nbsp;&nbsp;
				</div><!-- END "div.search" -->
				<div class="clear"></div>
			</div>
        </div><!-- END "div#header" -->
    </div><!-- END "div#header_wrapper" -->
	
	<div id="intro_wrapper" class="intro_wrapper_3d">
        <div class="intro_home intro_home_3d">
			<div class="intro_breadcrum">
				<?php if(!empty($breadcrum)) echo $breadcrum; ?>
				<!-- <p id="slider_3d_desc" class="intro_desc"><?php //if(!empty($breadcrum)) echo $breadcrum; ?></p> -->
			</div>
			<div class="intro_clock">
				<span id="clock" class="intro_desc" style="float:right"></span>
			</div>
        </div><!-- END "div.intro_home" -->
    </div><!-- END "div#intro_wrapper" -->

    <div id="content_wrapper">
	   <div id="content" class="content_3d">
		<?php
			if(!empty($page)) {
				$this->load->view($page);
			} else {
				$this->load->view('error_page');
			}
		?>
        </div><!-- END "div#content" -->
    </div><!-- END "div#content_wrapper" -->
	<!-- 
	<div id="footer" class="footer gradBlack">
		<p>
		<span class="copyright">Copyright &copy; 2013 &nbsp  PT. Carsurin All Rights Reserved</span>
		</p>
	</div>
	-->
</body>
</html>