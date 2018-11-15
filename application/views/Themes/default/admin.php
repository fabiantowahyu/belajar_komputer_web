<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $this->config->item('website_title'); ?></title>

        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="shortcut icon" href="<?php echo base_url(); ?>themes/icon/psa.ico" />
        <!--basic styles-->

        <link href="<?php echo base_url(); ?>themes/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>themes/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>themes/css/font-awesome.min.css" />

        <!--[if IE 7]>
          <link rel="stylesheet" href="<?php echo base_url(); ?>themes/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!--page specific plugin styles-->

        <link rel="stylesheet" href="<?php echo base_url(); ?>themes/css/chosen.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>themes/css/jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>themes/css/jquery.gritter.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>themes/css/select2.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>themes/css/bootstrap-editable.css" />

        <script type="text/javascript" src="<?php echo base_url(); ?>themes/js/clock.js"></script>
        <!--ace styles-->

        <link rel="stylesheet" href="<?php echo base_url(); ?>themes/css/ace.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>themes/css/ace-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>themes/css/ace-skins.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>themes/css/custom.css" />

        <!--[if lte IE 8]>
          <link rel="stylesheet" href="<?php echo base_url(); ?>themes/css/ace-ie.min.css" />
        <![endif]-->

        <!--inline styles related to this page-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>

    <body onLoad="goforit()">
	<?php
//	$this->load->model('md_admin');
//
//	$log_notification_not_read = '0';
//	$log_notification = $this->md_admin->MDL_Get_Log_Notification();
//
//	foreach ($log_notification AS $value) {
//	    if ($value->status == '0') {
//		$log_notification_not_read = $log_notification_not_read + 1;
//	    }
//	}
//
//	function time_elapsed_string($datetime, $full = false) {
//	    $now = new DateTime;
//	    $ago = new DateTime($datetime);
//	    $diff = $now->diff($ago);
//
//	    $diff->w = floor($diff->d / 7);
//	    $diff->d -= $diff->w * 7;
//
//	    $string = array(
//		'y' => 'year',
//		'm' => 'month',
//		'w' => 'week',
//		'd' => 'day',
//		'h' => 'hour',
//		'i' => 'minute',
//		's' => 'second',
//	    );
//	    foreach ($string as $k => &$v) {
//		if ($diff->$k) {
//		    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
//		} else {
//		    unset($string[$k]);
//		}
//	    }
//
//	    if (!$full)
//		$string = array_slice($string, 0, 1);
//	    return $string ? implode(', ', $string) . ' ago' : 'just now';
//	}
//
	$avatar = $this->md_menubox->MDL_getAvatar_User();
//	$result_company = $this->md_admin->MDL_Select_Company();
//	$company_name = $result_company->company_name;
//
//	$hasil = $this->md_admin->MDL_Total_Approval();
//	$total_approval = $hasil->jumlah_approval;
//
//
//	$privIdeas = $this->md_admin->PrivIdeas();
//	if ($privIdeas) {
//	    $hasil_ideas = $this->md_admin->MDL_Total_Approval_Ideas();
//	    $total_approval_ideas = $hasil_ideas->jumlah_approval;
//	} else {
//	    $total_approval_ideas = '0';
//	}
//
//	$hasil_cheers = $this->md_admin->MDL_Total_Cheers();
//	$total_unread_cheers = $hasil_cheers->jumlah_unread_cheers;
//
//	$hasilself = $this->md_admin->MDL_CountUnfinishedSelf();
//	$total_unfinished_self = $hasilself->total;
//
//	$hasilpeers = $this->md_admin->MDL_CountUnfinishedRequest();
//	$total_unfinished_peers = $hasilpeers->total;
//
//	$hasilreviewer = $this->md_admin->MDL_CountUnfinishedRequestReviewer();
//	$total_unfinished_reviewer = $hasilreviewer->total;
//        
//        
//        $hasil_ipp = $this->md_admin->MDL_TotalRequestIPP();
//	$total_request_ipp = $hasil_ipp->jumlah_approval;
//        
//        $total_points = $this->md_admin->MDL_CountTotalPoints();
	?>



        <div class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid"  style="background-color:#00838F;">
                    <a href="#" class="brand">
                        <small>
                            <i class="icon-lightbulb"></i>
                            <span class="white"><b>Welcome Admin</b></span>
                        </small>
                    </a><!--/.brand-->


                    <ul class="nav ace-nav pull-right">
                        <!-- Start Alert Notification-->
                       
			
			<!--End Notification-->        

			<li class="light-blue" style="background-color:#006064;">
			    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
				<img class="nav-user-photo" src="<?php echo base_url() . $avatar; ?>" alt="Employee's Photo" />
				<span class="user-info">
				    <small>Welcome,</small>
				    <?php echo $this->session->userdata('username'); ?>
				</span>

				<i class="icon-caret-down"></i>
			    </a>


			    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
				<!--
				<li>
					<a href="#">
						<i class="icon-cog"></i>
						Settings
					</a>
				</li>
				-->

				<li>f
				    <?php echo anchor('profile', '<i class="icon-user"></i>Proile'); ?>
				</li>
                                
				<li class="divider"></li>

				<li>
				    <?php echo anchor('login/logout', '<i class="icon-off"></i>Logout'); ?>
				</li>
			    </ul>
			</li>

		    </ul><!--/.ace-nav-->
		</div><!--/.container-fluid-->
	    </div><!--/.navbar-inner-->
	</div>

	<div class="main-container container-fluid">
	    <a class="menu-toggler" id="menu-toggler" href="#">
		<span class="menu-text"></span>
	    </a>

	    <div class="sidebar" id="sidebar" >
		<div class="sidebar-shortcuts" id="sidebar-shortcuts">
		    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
			<button class="btn btn-small btn-success">
			    <i class="icon-signal"></i>
			</button>

			<button class="btn btn-small btn-info">
			    <i class="icon-pencil"></i>
			</button>

			<button class="btn btn-small btn-warning">
			    <i class="icon-group"></i>
			</button>

			<button class="btn btn-small btn-danger">
			    <i class="icon-cogs"></i>
			</button>
		    </div>

		    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
			<span class="btn btn-success"></span>

			<span class="btn btn-info"></span>

			<span class="btn btn-warning"></span>

			<span class="btn btn-danger"></span>
		    </div>
		</div><!--#sidebar-shortcuts-->

		<ul class="nav nav-list">

		    <?php
		    $id = $this->session->userdata('userid');
		    $menubox = $this->md_menubox->MDL_MainMenu($id);
		    echo $menubox;
		    ?>

		</ul><!--/.nav-list-->

		<div class="sidebar-collapse" id="sidebar-collapse">
		    <i class="icon-double-angle-left"></i>
		</div>
	    </div>

	    <div class="main-content">
		<div class="breadcrumbs" id="breadcrumbs">

		    <?php if (!empty($breadcrum)) echo $breadcrum; ?><!--.breadcrumb-->

		    <div class="nav-search" id="nav-search">
			<div class="clock">
			    <span id="clock"></span>
			</div>
			<!-- <form class="form-search" />
				<span class="input-icon">
					<input type="text" placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
					<i class="icon-search nav-search-icon"></i>
				</span> -->
			</form>
		    </div><!--#nav-search-->
		</div>

		<div class="page-content">
		    <?php
		    if (!empty($page)) {
			$this->load->view($page);
		    } else {
			$this->load->view('error_page');
		    }
		    ?>
		</div><!--/.page-content-->

		<div class="ace-settings-container" id="ace-settings-container">
		    <div class="btn btn-app btn-mini btn-warning ace-settings-btn" id="ace-settings-btn">
			<i class="icon-cog bigger-150"></i>
		    </div>

		    <div class="ace-settings-box" id="ace-settings-box">
			<div>
			    <div class="pull-left">
				<select id="skin-colorpicker" class="hide">
				    <option data-class="default" value="#438EB9" />#438EB9
				    <option data-class="skin-1" value="#222A2D" />#222A2D
				    <option data-class="skin-2" value="#C6487E" />#C6487E
				    <option data-class="skin-3" value="#D0D0D0" />#D0D0D0
				</select>
			    </div>
			    <span>&nbsp; Choose Skin</span>
			</div>

			<div>
			    <input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />
			    <label class="lbl" for="ace-settings-header"> Fixed Header</label>
			</div>

			<div>
			    <input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />
			    <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
			</div>

			<div>
			    <input type="checkbox" class="ace-checkbox-2" id="ace-settings-breadcrumbs" />
			    <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
			</div>

			<div>
			    <input type="checkbox" class="ace-checkbox-2" id="ace-settings-rtl" />
			    <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
			</div>
		    </div>
		</div><!--/#ace-settings-container-->
	    </div><!--/.main-content-->
	</div><!--/.main-container-->

	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
	    <i class="icon-double-angle-up icon-only bigger-110"></i>
	</a>

	<!--basic scripts-->

	<!--[if !IE]>-->

	<script src="<?php echo base_url(); ?>plugins/js/jquery.min.js"></script>

	<!--<![endif]-->

	<!--[if IE]>
	<script src="<?php echo base_url(); ?>plugins/js/jquery_ie.min.js"></script>
	<![endif]-->

	<!--[if !IE]>-->

	<script type="text/javascript">
				    window.jQuery || document.write("<script src='<?php echo base_url(); ?>themes/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
	</script>

	<!--<![endif]-->

	<!--[if IE]>
	<script type="text/javascript">
	 window.jQuery || document.write("<script src='<?php echo base_url(); ?>themes/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
	</script>
	<![endif]-->

	<script type="text/javascript">
	    if ("ontouchend" in document)
		document.write("<script src='<?php echo base_url(); ?>themes/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
	</script>
	<script src="<?php echo base_url(); ?>plugins/js/function.js"></script>
	<script src="<?php echo base_url(); ?>themes/js/bootstrap.min.js"></script>

	<!--ace scripts-->

	<script src="<?php echo base_url(); ?>themes/js/ace-elements.min.js"></script>
	<script src="<?php echo base_url(); ?>themes/js/ace.min.js"></script>

	<?php
	if (!empty($plugin)) {
	    $this->load->view($plugin);
	    ?>
    	<div id="xLoader" style="opacity: 0.8;position:fixed;"><div class="google-spin-wrapper" ><div class="google-spin"></div></div></div>
    	<link rel="stylesheet" href="<?php echo base_url(); ?>plugins/css/xloader.css">
	    <?php
	}
	?>
    </body>
</html>

<script type="text/javascript">
	    $('#xLoader').hide();

	    $('form').submit(function () {
		if ($(this).valid()) {
		    $('.page-content').fadeOut();
		    $('#xLoader').show();
		}
	    });

	    function isRead(id) {
		url = "<?= base_url(); ?>admin/Update_Isread/" + id;

		$.ajax({
		    url: url,
		    type: "GET",
		    dataType: "json",
		    success: function (data) {
			if (data == true) {
			    location.reload();
			} else {
			}
		    }, error: function (textStatus, errorThrown) {
		    }
		});
	    }
</script>