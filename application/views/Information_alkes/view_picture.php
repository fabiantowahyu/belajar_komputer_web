<h4 class="header blue bolder smaller">Browse Picture</h4>
<div class="row-fluid">
    <?php
    if ($this->session->flashdata('upload_success')) {
        $msg = $this->session->flashdata('upload_success');
        ?>
        <div id="success-message" >
            <div class="<?php echo $msg['class']; ?>">
                <button class="close" data-dismiss="alert" type="button">
                    <i class="icon-remove"></i>
                </button>
                <h4> <strong><?php echo $msg['title']; ?></strong> </h4><?php echo $msg['message']; ?>
            </div>
        </div>
    <?php } ?>
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->


        <div class="row-fluid">
            <?php echo form_open_multipart($url, array('class' => 'form-horizontal', 'id' => 'validation-form')); ?>
            <div class="control-group" style="margin-bottom: 0px;">


                <input type="file"  class="form-control" name="file_picture" id="id-input-file-1"accept=".jpg,.jpeg,.gif" data-bv-notempty ="true">

            </div>

            <div class="pull-right"> <button type="submit" name="btn_upload" value="Save" class="btn btn-mini btn-primary"><i class="icon-upload"></i> Upload</button></div>
            <?php echo form_close(); ?>
        </div>




        <div class="row-fluid">

            <h4 class="header blue bolder smaller"></h4>
            <div class="pic_browser">
                <ul class="ace-thumbnails">


                    <?php foreach ($results as $row) {
                        ?>
                        <li>
                            <a data-rel="colorbox" title="Photo Title" href="<?php echo base_url(); ?>file_upload/picture/<?php echo $row->picture; ?>" class="cboxElement">
                                <img width="150" src="<?php echo base_url(); ?>file_upload/picture/<?php echo $row->picture; ?>" alt="150x150">
                                <div class="tags">
                                    <span class="label label-info"><?php echo $row->picture; ?></span>

                                </div>
                            </a>

                            <div class="tools tools-bottom">
                                <a href="javascript:void(0)" alt="Copy Link" class="btn_copy" onclick="CopyUrl('<?php echo $row->picture; ?>');" >
                                    <i class="icon-link"></i>
                                </a>

                                <a href="<?php echo base_url();?>information_alkes/CTRL_DeletePicture/<?php echo $row->picture;?>" onclick="if (!confirm('Delete Data?')){return false;};">
                                    <i class="icon-remove red"></i>
                                </a>
                            </div>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </div><!--PAGE CONTENT ENDS-->
    </div><!--/.span-->
</div>