<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!--page specific plugin scripts-->

<script src="<?php echo base_url();?>themes/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>themes/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>themes/js/jquery.dataTables.bootstrap.js"></script>

<script src="<?php echo base_url();?>themes/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo base_url();?>themes/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo base_url();?>themes/js/bootbox.js"></script>
<script src="<?php echo base_url();?>themes/js/jquery.maskedinput.min.js"></script>

<link rel="stylesheet" href="<?php echo base_url();?>plugins/jquery-ui/themes/dot-luv/jquery.ui.all.css">
<script src="<?php echo base_url();?>plugins/jquery-ui/ui/jquery.ui.datepicker.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-ui/ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-ui/ui/jquery.ui.widget.js"></script>
<script src="<?php echo base_url();?>themes/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo base_url();?>themes/js/bootbox.js"></script>

<!--inline scripts related to this page-->

<script type="text/javascript">
	$(function() {
		$('#table-pm').dataTable({
			
		});
	
	
		$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
		function tooltip_placement(context, source) {
			var $source = $(source);
			var $parent = $source.closest('table')
			var off1 = $parent.offset();
			var w1 = $parent.width();
	
			var off2 = $source.offset();
			var w2 = $source.width();
	
			if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
			return 'left';
		}
		
		//Confirm delete modal/dialog with Twitter bootstrap?
		// ---------------------------------------------------------- Generic Confirm  
		$("#cdelete").on(ace.click_event, function() {
			bootbox.dialog({
				message: "Are you sure want to delete this Data!",
				title: "Confirm Delete",
				buttons: {
					cancel: {
					  label: "Cancel",
					  className: "btn-default",
					  callback: function() {
						//Example.show("great success");
					  }
					},
					main: {
					  label: "Delete",
					  className: "btn-danger",
					  callback: function() {
						$('#del').submit();
					  }
					}
				}
			});
		});
		
		$('#validation-form').validate({
			errorElement: 'span',
			errorClass: 'help-inline',
			focusInvalid: false,
			rules: {
					   score_type: {
					   	required: true
					   }
					  
                        },
			/* messages: {
				password_new: {
					required: "Please specify a password.",
					minlength: "Please specify a secure password."
				}
			}, */
	
			invalidHandler: function (event, validator) { //display error alert on form submit   
				//$('.alert-error', $('.login-form')).show();
			},
	
			highlight: function (e) {
				$(e).closest('.control-group').removeClass('info').addClass('error');
			},
	
			success: function (e) {
				$(e).closest('.control-group').removeClass('error').addClass('info');
				$(e).remove();
			},
	
			submitHandler: function (form) {
				form.submit();
			},
			invalidHandler: function (form) {
			}
		});
		
	});
        
        $(function() {
            
        $(".datepicker").datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});
                
                });
                
         $(function () {       
                var i = 0;
        var no = 1;
        $('#btnAddRow').click(function () {
            if (i == 0)
            {
                $("#itemRow").empty();
            }

            $("#itemRow").append('<tr id="row' + i + '">' +
                    
                    '<td align="center"><input type="text" name="score[' + i + '][question]" placeholder="question" ></td>' +
                    '<td align="center"><input type="text" name="score[' + i + '][option_a]" placeholder="option a" /></td>' +
                    '<td align="center"><input type="text" name="score[' + i + '][option_b]" placeholder="option b" /></td>' +
                    '<td align="center"><input type="text" name="score[' + i + '][option_c]" placeholder="option c" /></td>' +
                    '<td align="center"><input type="text" name="score[' + i + '][option_d]" placeholder="option d" /></td>' +
                    '<td align="center"><input type="text" name="score[' + i + '][answer]" placeholder="answer" /></td>' +
                    
                    '<td><a class="btn btn-mini btn-danger" onclick="delRow(' + i + ')"><i class="icon-remove"></i></button></td>' +
                    '</tr>');        
      no++;
            i++;
	});
        
        
        
        var j = $('#last_num').val();
        console.log(j);
        var num = 1;
        $('#btnAddRowEdit').click(function () {
            $("#itemRow").append('<tr id="row' + j + '">' +
                    
                    '<td align="center"> <= <input type="text" name="score[' + j + '][score_value]" placeholder="score value" ></td>' +
                    '<td align="center"><input type="text" name="score[' + j + '][score_mask]" placeholder="score mask" /></td>' +
                    '<td  align="center" width="10%"><input type="text" name="score[' + j + '][score_order]"   placeholder="score order"></td>' +
                    '<td align="center"><textarea name="score[' + j + '][score_description]" style="width:95%" placeholder="Description"></textarea></td>' +
                    '<td><a class="btn btn-mini btn-danger" onclick="delRow(' + j + ')"><i class="icon-remove"></i></button></td>' +
                   '<input type="hidden" name="score[' + j + '][id_score]"</td>' +
            '</tr>');     
            num++;
            j++;
        });

        
        
        
        
          });
          function delRow(j)
    {
        $("#row" + j).remove();
    }
	
</script>