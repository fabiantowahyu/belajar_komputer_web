<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!--page specific plugin scripts treeview-->

<link rel="stylesheet" href="<?php echo base_url();?>themes/js/jstree/themes/default/style.min.css">

<script src="<?php echo base_url();?>themes/js/jstree/jquery.min.js"></script>
<script src="<?php echo base_url();?>themes/js/jstree/jstree.min.js"></script>

<script type="text/javascript">
	function clickOrgLevel(id) {
		window.location.href = '<?php echo site_url(); ?>employee/CTRL_Select_Position/'+ id;
	}
	
	$(function(){
		$('#treeOrgLevel').jstree({
			'core' : {
				'data' : {
					"url" : "<?php echo site_url(); ?>organization_level/CTRL_SelectData",
					"dataType" : "json" // needed only if you do not supply JSON headers
				}
			}
		});

	});
</script>