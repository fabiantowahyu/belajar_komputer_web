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

<!--inline scripts related to this page-->

<script type="text/javascript">
	$(function() {
		var oTable1 = $('#table-company').dataTable( {
		"aoColumns": [
		  { "bSortable": true },
		  null,null,null,null,null,
		  { "bSortable": false }
		] } );
	
	
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
				message: "Are you sure, you want to delete this company!",
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
				name: {
					required: true
				},
				type: {
					required:true
				},
				email: {
					email:true
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
		
		var last_gritter;
		$('#logoCompany').on('click', function(){
			var modal = 
			'<div class="modal hide fade">\
				<div class="modal-header">\
					<button type="button" class="close" data-dismiss="modal">&times;</button>\
					<h4 class="blue">Change Logo</h4>\
				</div>\
				\
				<?php echo form_open_multipart(@$url,array('class'=>'no-margin')); ?>\
				<div class="modal-body">\
					<div class="space-4"></div>\
					<div style="width:75%;margin-left:12%;"><input type="file" name="userfile" /></div>\
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
				btn_choose:'Click to choose new logo',
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
		
						if( file.size > 510000 ) {//~500Kb
							last_gritter = $.gritter.add({
								title: 'File too big!',
								text: 'Image size should not exceed 500Kb!',
								class_name: 'gritter-error gritter-center'
							});
							return false;
						}
					}

					return true;
				}
			});

			/* form.on('submit', function(){
				if(!file.data('ace_input_files')) return false;
				
				file.ace_file_input('disable');
				form.find('button').attr('disabled', 'disabled');
				form.find('.modal-body').append("<div class='center'><i class='icon-spinner icon-spin bigger-150 orange'></i></div>");
				
				var deferred = new $.Deferred;
				working = true;
				deferred.done(function() {
					form.find('button').removeAttr('disabled');
					form.find('input[type=file]').ace_file_input('enable');
					form.find('.modal-body > :last-child').remove();
					
					modal.modal("hide");

					var thumb = file.next().find('img').data('thumb');
					if(thumb) $('#logoCompany').get(0).src = thumb;

					working = false;
				});
				
				
				setTimeout(function(){
					deferred.resolve();
				} , parseInt(Math.random() * 800 + 800));

				return false;
			}); */
					
		});
		
		$('#MasterCompany')
		.find('input[type=file]').ace_file_input({
			style:'well',
			btn_choose:'Change logo',
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
	
					if( file.size > 510000 ) {//~500Kb
						last_gritter = $.gritter.add({
							title: 'File too big!',
							text: 'Image size should not exceed 500Kb!',
							class_name: 'gritter-error gritter-center'
						});
						return false;
					}
				}
	
				$.gritter.removeAll();
				return true;
			}
		})

		$.mask.definitions['~']='[+-]';
		$('.input-mask-phone').mask('(999) 9999999');
		$('.input-mask-phone').mask('(999) 9999999').val('<?php echo @$phone; ?>');
		$('.input-mask-fax').mask('(999) 9999999');
		$('.input-mask-fax').mask('(999) 9999999').val('<?php echo @$fax; ?>');
		$('.input-mask-kdpos').mask('(999) 9999999');
		$('.input-mask-kdpos').mask('99999').val('<?php echo @$postal_code; ?>');
	})
</script>