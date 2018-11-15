<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!--page specific plugin scripts-->

<script src="<?php echo base_url(); ?>themes/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/jquery.dataTables.bootstrap.js"></script>

<script src="<?php echo base_url(); ?>themes/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/bootbox.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>plugins/jquery-ui/themes/dot-luv/jquery.ui.all.css">
<script src="<?php echo base_url(); ?>plugins/jquery-ui/ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url(); ?>plugins/jquery-ui/ui/jquery.ui.widget.js"></script>
<script src="<?php echo base_url(); ?>plugins/jquery-ui/ui/jquery.ui.datepicker.js"></script>

<!--inline scripts related to this page-->

<script type="text/javascript">
    $(function () {
        $('#table-sample_report').dataTable({
            "aoColumns": [{"bSortable": true}, null, {"bSortable": true}]
        });

        $("#id-date-picker-1").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
        $("#id-date-picker-2").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });

    })
</script>