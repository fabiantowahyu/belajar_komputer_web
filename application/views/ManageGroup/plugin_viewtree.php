<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!--page specific plugin scripts treeview-->

<script type="text/javascript" src="<?php echo base_url();?>themes/js/treewidget/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>themes/js/treewidget/js/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/js/treewidget/css/jquery-ui.css"/>

<script type="text/javascript" src="<?php echo base_url();?>themes/js/treewidget/js/jquery.tree.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/js/treewidget/css/jquery.tree.css"/>

<script type="text/javascript">
	$(function(){
		$('#tree').tree({
			onCheck: {
                node: 'expand'
            },
            onUncheck: {
                node: 'collapse'
            },
			collapseUiIcon: 'ui-icon-circle-plus',
			expandUiIcon: 'ui-icon-circle-minus'
		});

	});
</script>