<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!--page specific plugin scripts-->

<script src="<?php echo base_url(); ?>themes/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/jquery.dataTables.bootstrap.js"></script>

<script src="<?php echo base_url(); ?>themes/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/bootbox.js"></script>
<script src="<?php echo base_url(); ?>themes/js/jquery.maskedinput.min.js"></script>

<script src="<?php echo base_url(); ?>themes/js/jquery.slimscroll.min.js"></script>


<script src="<?php echo base_url(); ?>themes/js/jquery.colorbox-min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/css/colorbox.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.10/clipboard.min.js"></script>


<!--inline scripts related to this page-->

<script type="text/javascript">

    $(function () {

        setTimeout(function () {
            $('#success-message').fadeOut('slow');
        }, 1500);

        $('.pic_browser').slimScroll({
            height: '350px'
        });
        $('#id-input-file-1').ace_file_input({
            no_file: 'Choose Picture *',
            btn_choose: 'Choose',
            btn_change: 'Change',
            droppable: false,
            onchange: null,
            thumbnail: false,
            whitelist: 'jpg|jpeg|gif',
            blacklist: 'exe|php'
                    //onchange:''
                    //
        });


        var oTable1 = $('#table-lettertemplate').dataTable();


        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                return 'right';
            return 'left';
        }

        //Confirm delete modal/dialog with Twitter bootstrap?
        // ---------------------------------------------------------- Generic Confirm  
        $("#cdelete").on(ace.click_event, function () {
            bootbox.dialog({
                message: "Are you sure, you want to delete this Template!",
                title: "Confirm Delete",
                buttons: {
                    cancel: {
                        label: "Cancel",
                        className: "btn-default",
                        callback: function () {
                            //Example.show("great success");
                        }
                    },
                    main: {
                        label: "Delete",
                        className: "btn-danger",
                        callback: function () {
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
                branch: {
                    required: true
                },
                address: {
                    required: true
                },
                phone: {
                    required: true
                },
                fax: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                head_op: {
                    required: true
                },
                company_id: {
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

        $.mask.definitions['~'] = '[+-]';
        $('.input-mask-phone').mask('(999) 9999999');
        $('.input-mask-phone').mask('(999) 9999999').val('<?php echo @$phone; ?>');
        $('.input-mask-fax').mask('(999) 9999999');
        $('.input-mask-fax').mask('(999) 9999999').val('<?php echo @$fax; ?>');

    });



    $(function () {
        var colorbox_params = {
            reposition: true,
            scalePhotos: true,
            scrolling: false,
            previous: '<i class="icon-arrow-left"></i>',
            next: '<i class="icon-arrow-right"></i>',
            close: '&times;',
            current: '{current} of {total}',
            maxWidth: '100%',
            maxHeight: '100%',
            onOpen: function () {
                document.body.style.overflow = 'hidden';
            },
            onClosed: function () {
                document.body.style.overflow = 'auto';
            },
            onComplete: function () {
                $.colorbox.resize();
            }
        };

        $('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
        $("#cboxLoadingGraphic").append("<i class='icon-spinner orange'></i>");//let's add a custom loading icon

        /**$(window).on('resize.colorbox', function() {
         try {
         //this function has been changed in recent versions of colorbox, so it won't work
         $.fn.colorbox.load();//to redraw the current frame
         } catch(e){}
         });*/
    });

    $('#validation-form').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            file_picture: {
                required: true,
            }
        },
        messages: {
            file_picture: {
                required: "Please Choose Images !"
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
            //form.submit();
            saveDetail_sample();
        },
        invalidHandler: function (form) {
        }
    });

    function CopyUrl(images)
    {
        url = "<?php echo base_url();?>file_upload/picture/"+images;
  
        new Clipboard('.btn_copy', {
            text: function () {
                return url;
            }
        });
        
    }

   $('#external_source').change(function () {
			if (this.checked) {
				$("#external_url").show();
                                $("#content_editor").hide();
			} else {
				$("#external_url").hide();
                                $("#content_editor").show();
			}

		});


</script>