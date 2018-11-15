<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!--page specific plugin scripts-->

<script src="<?php echo base_url();?>themes/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>themes/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>themes/js/jquery.dataTables.bootstrap.js"></script>

<script src="<?php echo base_url();?>themes/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo base_url();?>themes/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo base_url();?>themes/js/bootbox.js"></script>
<script src="<?php echo base_url();?>themes/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url();?>themes/js/jquery.gritter.min.js"></script>

<link rel="stylesheet" href="<?php echo base_url();?>plugins/jquery-ui/themes/dot-luv/jquery.ui.all.css">
<script src="<?php echo base_url();?>plugins/jquery-ui/ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-ui/ui/jquery.ui.widget.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-ui/ui/jquery.ui.datepicker.js"></script>
<!--inline scripts related to this page-->

<script type="text/javascript">
	$(function() {
		$('#table-employee').dataTable({
			"aoColumns": [{ "bSortable": true },null,null,null,null,null,null,{ "bSortable": false }]
		});
		
		$('#table-education').dataTable({
			"aoColumns": [{ "bSortable": true },null,null,null,null,{ "bSortable": false }]
		});
		
		$('#table-training').dataTable({
			"aoColumns": [{ "bSortable": true },null,null,null,null,{ "bSortable": false }]
		});
	
		$('#table-family').dataTable({
			"aoColumns": [{ "bSortable": true },null,null,null,null,null,{ "bSortable": false }]
		});
		
		$('#table-bank').dataTable({
			"aoColumns": [{ "bSortable": true },null,null,null,null,null,{ "bSortable": false }]
		});
		
		$('#table-awardhistory').dataTable({
			"aoColumns": [{ "bSortable": true },null,null,null,{ "bSortable": false }]
		});
		
		$('#table-disciplineshistory').dataTable({
			"aoColumns": [{ "bSortable": true },null,null,null,null,{ "bSortable": false }]
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
				message: "Are you sure, you want to delete this employee!",
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
		
		$("#cdelete-education").on(ace.click_event, function() {
			bootbox.dialog({
				message: "Are you sure, you want to delete this education!",
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
						$('#del_education').submit();
					  }
					}
				}
			});
		});
		
		$("#cdelete-training").on(ace.click_event, function() {
			bootbox.dialog({
				message: "Are you sure, you want to delete this training!",
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
						$('#del_training').submit();
					  }
					}
				}
			});
		});
		
		$("#cdelete-family").on(ace.click_event, function() {
			bootbox.dialog({
				message: "Are you sure to delete this family data!",
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
						$('#del_family').submit();
					  }
					}
				}
			});
		});
		
		$("#cdelete-bank").on(ace.click_event, function() {
			bootbox.dialog({
				message: "Are you sure to delete this Bank data!",
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
						$('#del_bank').submit();
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
				first_name: {
					required: true
				},
				last_name: {
					required:true
				},
				position_id: {
					required: true
				},
				birth_place: {
					required: true
				},
				birth_date: {
					required:true
				},
				email: {
					email: true
				},
				join_date:{
					required:true
				},
				grade_id:{
					required:true
				},
				branch_id:{
					required:true
				},
				marital_status: {
					required:true
				},
				position: {
					required:true
				},
				address: {
					required:true
				},
				country: {
					required:true
				},
				province: {
					required:true
				},
				religion: {
					required:true
				},
                                username: {
                                        required:true
                                },
                                password: {
                                        required:true
                                },
                                password_re: {
                                        required:true
                                }, 
                                role:{
                                        required:true
                                }
			},
			
			/*
			messages: {
				username: {
					remote: "Username already exist"
				}
			},*/
	
			highlight: function (e) {
				$(e).closest('.control-group').removeClass('info').addClass('error');
			},
	
			success: function (e) {
				$(e).closest('.control-group').removeClass('error').addClass('info');
				$(e).remove();
			},
	
			submitHandler: function (form) {
				form.submit();
			}
			
		});
		
		$('#validation-form-address').validate({
			errorElement: 'span',
			errorClass: 'help-inline',
			focusInvalid: true,
			rules: {
				address: {
					required: true
				},
				country: {
					required: true
				},
				province: {
					required: true
				},
				address2: {
					required:true
				},
				country2: {
					required:true
				},
				province2: {
					required: true
				}
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
			}

		});
		
		$('#validation-form-education').validate({
			errorElement: 'span',
			errorClass: 'help-inline',
			focusInvalid: true,
			rules: {
				startdate: {
					required: true
				},
				enddate: {
					required: true
				},
				institution: {
					required: true
				},
				country: {
					required:true
				},
				province: {
					required:true
				},
				certificate_num: {
					required: true
				},
				certificate_date: {
					required: true
				}
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
			}

		});
		
		$('#validation-form-training').validate({
			errorElement: 'span',
			errorClass: 'help-inline',
			focusInvalid: true,
			rules: {
				subject: {
					required: true
				},
				topic: {
					required: true
				},
				startdate: {
					required: true
				},
				enddate: {
					required: true
				},
				fee: {
					required:true
				},
				trainer: {
					required:true
				}
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
			}

		});
		
		$('#validation-form-family').validate({
			errorElement: 'span',
			errorClass: 'help-inline',
			focusInvalid: false,
			rules: {
				emp_family: {
					required: true
				},
				birth_place: {
					required: true
				},
				date_birth: {
					required: true
				},
				relationship: {
					required: true
				},
				gender: {
					required:true
				},
				education_lvl: {
					required:true
				}
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
			}

		});
		
		$('#validation-form-bank').validate({
			errorElement: 'span',
			errorClass: 'help-inline',
			focusInvalid: false,
			rules: {
				bank_group: {
					required: true
				},
				bank_name: {
					required: true
				},
				bank_branch: {
					required: true
				},
				bank_account: {
					required: true
				},
				account_name: {
					required:true
				}
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
			}

		});
		
		var last_gritter;
		$('#Photo,#Signature').on('click', function(){
			var a = this.id;
			var modal = 
			'<div class="modal hide fade">\
				<div class="modal-header">\
					<button type="button" class="close" data-dismiss="modal">&times;</button>\
					<h4 class="blue">Change Picture</h4>\
				</div>\
				\
				<?php echo form_open_multipart(@$url,array('class'=>'no-margin')); ?>\
				<div class="modal-body">\
					<div class="space-4"></div>\
					<div style="width:75%;margin-left:12%;"><input type="file" name="userfile" /></div>\
					<div><input type="hidden" name="upload_type" value="' + a + '" /></div>\
				</div>\
				\
				<div class="modal-footer center">\
					<button type="submit" name="upload" value="upload" class="btn btn-small btn-success"><i class="icon-ok"></i> Submit</button>\
					<button type="button" class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancel</button>\
				</div>\
				<?php echo form_close(); ?>\
			</div>';
			
			
			var modal = $(modal);
			modal.modal("show").on("hidden", function(){
				modal.remove();
			});

			var working = false;

			var form = modal.find('form:eq(0)');
			var file = form.find('input[type=file]').eq(0);
			file.ace_file_input({
				style:'well',
				btn_choose:'Click to choose new picture',
				btn_change:null,
				no_icon:'icon-picture',
				thumbnail:'small',
				before_remove: function() {
					//don't remove/reset files while being uploaded
					return !working;
				},
				before_change: function(files, dropped) {
					var file = files[0];
					if(typeof file === "string") {
						//file is just a file name here (in browsers that don't support FileReader API)
						if(! (/\.(jpe?g|png|gif)$/i).test(file) ) return false;
					}
					else {//file is a File object
						var type = $.trim(file.type);
						if(last_gritter) $.gritter.remove(last_gritter);
						if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type) )
								|| ( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name) )//for android default browser!
							) {
							last_gritter = $.gritter.add({
								title: 'File is not an image!',
								text: 'Please choose a jpg|gif|png image!',
								class_name: 'gritter-error gritter-center'
							});
							return false;
						}
		
						if( file.size > 1000000 ) {//~1Mb
							last_gritter = $.gritter.add({
								title: 'File too big!',
								text: 'Image size should not exceed 1Mb!',
								class_name: 'gritter-error gritter-center'
							});
							return false;
						}
					}

					return true;
				}
			});

		});
		
		$('#UploadFile')
		.find('input[type=file]').ace_file_input({
			btn_choose:'Upload File',
			btn_change:null,
			thumbnail:'small',
			droppable:true,
			before_change: function(files, dropped) {
				var file = files[0];
				if(typeof file === "string") {//files is just a file name here (in browsers that don't support FileReader API)
					if(! (/\.(jpe?g|png|gif)$/i).test(file) ) return false;
				}
				else {//file is a File object
					var type = $.trim(file.type);
					if(last_gritter) $.gritter.remove(last_gritter);
					if( ( type.length > 0 && ! (/^image|application\/(jpe?g|png|gif|pdf)$/i).test(type) )
							|| ( type.length == 0 && ! (/\.(jpe?g|png|gif|pdf)$/i).test(file.name) )//for android default browser!
						) {
						last_gritter = $.gritter.add({
							title: 'File is not an image or pdf!',
							text: 'Please choose a jpg|gif|png|pdf image or pdf!',
							class_name: 'gritter-error gritter-center'
						});
						return false;
					}
	
					if( file.size > 1000000 ) {//~1Mb
						last_gritter = $.gritter.add({
							title: 'File too big!',
							text: 'Image size should not exceed 1Mb!',
							class_name: 'gritter-error gritter-center'
						});
						return false;
					}
				}
	
				$.gritter.removeAll();
				return true;
			}
		})
		
		$('#MasterEmployee')
		.find('input[type=file]').ace_file_input({
			style:'well',
			btn_choose:'Change picture',
			btn_change:null,
			no_icon:'icon-picture',
			thumbnail:'large',
			droppable:true,
			before_change: function(files, dropped) {
				var file = files[0];
				if(typeof file === "string") {//files is just a file name here (in browsers that don't support FileReader API)
					if(! (/\.(jpe?g|png|gif)$/i).test(file) ) return false;
				}
				else {//file is a File object
					var type = $.trim(file.type);
					if(last_gritter) $.gritter.remove(last_gritter);
					if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type) )
							|| ( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name) )//for android default browser!
						) {
						last_gritter = $.gritter.add({
							title: 'File is not an image!',
							text: 'Please choose a jpg|gif|png image!',
							class_name: 'gritter-error gritter-center'
						});
						return false;
					}
	
					if( file.size > 1000000 ) {//~1Mb
						last_gritter = $.gritter.add({
							title: 'File too big!',
							text: 'Image size should not exceed 1Mb!',
							class_name: 'gritter-error gritter-center'
						});
						return false;
					}
				}
	
				$.gritter.removeAll();
				return true;
			}
		})
		
		$('#AttachFiles-1').on('click', function(){
			var modal = 
			'<div class="modal hide fade">\
				<div class="modal-header">\
					<button type="button" class="close" data-dismiss="modal">&times;</button>\
					<h4 class="blue">Change Files</h4>\
				</div>\
				\
				<?php echo form_open_multipart(@$url,array('class'=>'no-margin')); ?>\
				<div class="modal-body">\
					<div class="space-4"></div>\
					<div style="width:75%;margin-left:12%;"><input type="file" name="userfile" /></div>\
				</div>\
				\
				<div class="modal-footer center">\
					<button type="submit" name="btnUpload" value="upload" class="btn btn-small btn-success"><i class="icon-ok"></i> Submit</button>\
					<button type="button" class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancel</button>\
				</div>\
				<?php echo form_close(); ?>\
			</div>';
			
			
			var modal = $(modal);
			modal.modal("show").on("hidden", function(){
				modal.remove();
			});

			var working = false;

			var form = modal.find('form:eq(0)');
			var file = form.find('input[type=file]').eq(0);
			file.ace_file_input({
				style:'well',
				btn_choose:'Click to choose new file',
				btn_change:null,
				no_icon:'icon-picture',
				thumbnail:'small',
				before_remove: function() {
					//don't remove/reset files while being uploaded
					return !working;
				},
				before_change: function(files, dropped) {
					var file = files[0];
					if(typeof file === "string") {
						//file is just a file name here (in browsers that don't support FileReader API)
						if(! (/\.(jpe?g|png|gif|pdf)$/i).test(file) ) return false;
					}
					else {//file is a File object
						var type = $.trim(file.type);
						if(last_gritter) $.gritter.remove(last_gritter);
						if( ( type.length > 0 && ! (/^image|application\/(jpe?g|png|gif|pdf)$/i).test(type) )
								|| ( type.length == 0 && ! (/\.(jpe?g|png|gif|pdf)$/i).test(file.name) )//for android default browser!
							) {
							last_gritter = $.gritter.add({
								title: 'File is not an image or pdf!',
								text: 'Please choose a jpg|gif|png|pdf image or pdf!',
								class_name: 'gritter-error gritter-center'
							});
							return false;
						}
		
						if( file.size > 1000000 ) {//~1Mb
							last_gritter = $.gritter.add({
								title: 'File too big!',
								text: 'Image size should not exceed 1Mb!',
								class_name: 'gritter-error gritter-center'
							});
							return false;
						}
					}

					return true;
				}
			});

		});

		$.mask.definitions['~']='[+-]';
		$('.input-mask-phone').mask('(999) 9999999').val('<?php echo @$phone; ?>');
		$('.input-mask-hp').mask('(9999) 99999999').val('<?php echo @$hp; ?>');
		$('.input-mask-fax').mask('(999) 9999999').val('<?php echo @$fax; ?>');
		$('.input-mask-kdpos').mask('99999').val('<?php echo @$post_code; ?>');
		$('.input-mask-gpa').mask('9.99').val('<?php echo @$gpa; ?>');
		
		$('a[data-toggle="tab"]').on('shown', function () {
			//save the latest tab; use cookies if you like 'em better:
			localStorage.setItem('lastTab', $(this).attr('href'));
		});

		
		//go to the latest tab, if it exists:
		var lastTab = localStorage.getItem('lastTab');
		if (lastTab) {
			$('a[href=' + lastTab + ']').tab('show');
		} else {
			// Set the first tab if cookie do not exist
			$('a[data-toggle="tab"]:first').tab('show');
		}
		
		if($('#CertYes').attr('checked')=="checked") {
			$('#View-Certificate').show();
		} else {
			$('#View-Certificate').hide();
		}
		$('#CertYes').on('click', function(){
			$validation = this.checked;
			if(this.checked) {
				$('#View-Certificate').show();
			}
			else {
				$('#View-Certificate').hide();
			}
		});
		$('#CertNo').on('click', function(){
			$validation = this.checked;
			if(this.checked) {
				$('#View-Certificate').hide();
			}
			else {
				$('#View-Certificate').show();
			}
		});
		
		$("#JoinDate").datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});
		
		$("#StartDate-Education").datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});
		
		$("#EndDate-Education").datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});
		
		$("#CertDate-Education").datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});
		
		$("#Family_DateBirth").datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});
		
		$("#id_expireddate").datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});
		
		$("#birth_date").datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});
		
		$("#marital_date").datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});
		
		$("#end_date").datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});
	})

	$(document).ready(function() {
		$("#bank_group").change(function() {
		  var bank_group = $("#bank_group").val();
		  
		  $.ajax({
			  type : "POST",
			  url : "<?php echo base_url(); ?>employee/CTRL_Option_BankName",
			  data : "bank_group=" + bank_group,
			  success : function(data) {
				  $("#bank_id").html(data);
			  }
		  });
	  }); 
	});
</script>