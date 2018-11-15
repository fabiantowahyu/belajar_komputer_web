<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!--page specific plugin scripts-->

<script src="<?php echo base_url();?>themes/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>themes/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>themes/js/jquery.dataTables.bootstrap.js"></script>

<script src="<?php echo base_url();?>themes/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo base_url();?>themes/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo base_url();?>themes/js/bootbox.js"></script>

<!--inline scripts related to this page-->

<script type="text/javascript">
	$(function() {
		var oTable1 = $('#table-group').dataTable( {
		"aoColumns": [
		  { "bSortable": true },
		  null,null,null,null,
		  { "bSortable": false }
		] } );
	
	
		$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
		function tooltip_placement(context, source) {
			var $source = $(source);
			var $parent = $source.closest('table');
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
				message: "Are you sure, you want to delete this user!",
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
		
		$('#reset-password').hide();
		$('#skip-password').removeAttr('checked').on('click', function(){
			$validation = this.checked;
			if(this.checked) {
				$('#reset-password').show();
			}
			else {
				$('#reset-password').hide();
			}
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
				password: {
					required: true,
					minlength: 5
				},
				password_re: {
					required: true,
					minlength: 5,
					equalTo: "#Password"
				},
				userid: {
					required: true,
					remote: {
						url: '<?php echo @$url_cek_field; ?>',
						type: "post",
						data: {
							fvalue: function() {
								return $( "#UserID" ).val();
							}
						}
					}
				},
				email: {
					email:true
				}
			},
	
			messages: {
				userid: {
					remote: "Userid already exist"
				}
			},
	
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
	
	function ChangeValue(intWhichOne) {
		var frmShr = document.myForm;
		var arrNonMember = new Array(frmShr.selNonMember.options.length);
		var arrIsMember = new Array(frmShr.selMember.options.length);
		var arrMember = new Array();
		var arrNon = new Array();
		var lstNon = frmShr.selNonMember;
		var lstMem = frmShr.selMember;
		var intSelected = 0;
		var intSelectedMem = 0;

		for(i=0;i<lstNon.options.length;i++){
			arrNon[i] = new CreateStruct(lstNon.options[i].selected,lstNon.options[i].text,lstNon.options[i].value);
			arrNonMember[i] = new CreateStruct(lstNon.options[i].selected,lstNon.options[i].text,lstNon.options[i].value);

			if(lstNon.options[i].selected){
				intSelected++;
			}
		}

		for(i=0;i<lstMem.options.length;i++){
			arrMember[i] = new CreateStruct(lstMem.options[i].selected,lstMem.options[i].text,lstMem.options[i].value);
			arrIsMember[i] = new CreateStruct(lstMem.options[i].selected,lstMem.options[i].text,lstMem.options[i].value);

			if(lstMem.options[i].selected){
				intSelectedMem++;
			}		

		}

		if(navigator.appName == "Microsoft Internet Explorer"){
			frmShr.reset(); 
		}	

		for(i=0;i<lstNon.options.length;i++){
			lstNon.options[i].selected = arrNonMember[i].IsSelect;
		}
		for(i=0;i<lstMem.options.length;i++){
			lstMem.options[i].selected = arrMember[i].IsSelect;
		}	
		if (intWhichOne == 2){
			var intMemLen = lstMem.options.length;
			lstMem.options.length += intSelected;
			for(i=0;i<lstNon.options.length;i++){
				if(lstNon.options[i].selected){
					if (!CheckExist(arrMember,lstNon.options[i].value)){
						lstMem.options[intMemLen].text = arrNonMember[i].selText;
						
						lstMem.options[intMemLen].value = arrNonMember[i].selValue;
						intMemLen++;
					}else{
						lstMem.options.length--;
					}
				}
			}

			var arrDeleteMem = new Array();
			var intItem = 0;
			var intLength = lstNon.options.length;
			for(i=0;i<lstNon.options.length;i++){
				if(!arrNon[i].IsSelect){
					arrDeleteMem[intItem] = new CreateStruct(false,arrNon[i].selText,arrNon[i].selValue)
					intItem++;
				}
			}
			for(i=intLength;i>=intItem;i--){
				lstNon.options.length = i;
				if(navigator.appName == "Microsoft Internet Explorer"){
					frmShr.reset(); 
				}				
			}
							
			if(intItem > 0){
				for(i=0;i<intItem;i++){
					lstNon.options[i].text = arrDeleteMem[i].selText;
					lstNon.options[i].value = arrDeleteMem[i].selValue;		
				}
			}
		}else if (intWhichOne == 3){
			var intNonLen = lstNon.options.length;
			lstNon.options.length += intSelectedMem;
			for(i=0;i<lstMem.options.length;i++){
				if(lstMem.options[i].selected){
					if (!CheckExist(arrNon,lstMem.options[i].value)){
						lstNon.options[intNonLen].text = arrIsMember[i].selText;
						lstNon.options[intNonLen].value = arrIsMember[i].selValue;
						intNonLen++;
					}else{
						lstNon.options.length--;
					}
				}
			}
		
			var arrDeleteMem = new Array();
			var intItem = 0;
			var intLength = lstMem.options.length;
			for(i=0;i<lstMem.options.length;i++){
				if(!arrMember[i].IsSelect){
					arrDeleteMem[intItem] = new CreateStruct(false,arrMember[i].selText,arrMember[i].selValue)
					intItem++;
				}
			}
			for(i=intLength;i>=intItem;i--){
				lstMem.options.length = i;
				if(navigator.appName == "Microsoft Internet Explorer"){
					frmShr.reset(); 
				}				
			}		
			if(intItem > 0){
				for(i=0;i<intItem;i++){
					lstMem.options[i].text = arrDeleteMem[i].selText;
					lstMem.options[i].value = arrDeleteMem[i].selValue;		
				}
			}
		}
		return true;
	}
	
	function CreateStruct(IsSelect,selText,selValue) {
		this.IsSelect = IsSelect;
		this.selText = selText;
		this.selValue = selValue;
	}
	
	function CheckExist(arrayName,value) {
		for (var i = 0; i < arrayName.length; i++) { 
		   var obj = arrayName[i]; 
			for (var key in obj) {          
				if (obj[key] == value) { 
					return true;
				} 
			} 
		}

		return false;
	}
	
	function SelectAll_Member() {
		var frmMember = document.myForm;
		var lstMem = frmMember.selMember;
		var arrMember = new Array();
		
		for(i=0;i<lstMem.options.length;i++){
			arrMember[i] = lstMem.options[i].value;	

		}
		
		frmMember.selMember_value.value = arrMember.join(',');
		return true;
	}
</script>