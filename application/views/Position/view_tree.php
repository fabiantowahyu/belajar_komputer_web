<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<link rel="stylesheet" href="<?php echo base_url();?>themes/js/jstree/themes/default/style.min.css">

<script src="<?php echo base_url();?>themes/js/jstree/jquery.min.js"></script>
<script src="<?php echo base_url();?>themes/js/jstree/jstree.min.js"></script>

<script type="text/javascript">
	$(function(){
		$('#treeOrgLevel_Detail').jstree({
			'core' : {
				'data' : {
					"url" : "<?php echo $url_view; ?>",
					"dataType" : "json" // needed only if you do not supply JSON headers
				}
			}
		});

	});
</script>

<div id="treeOrgLevel_Detail" class="demo"></div>