<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <div class="col-md-12 ">
        <div><h3><?php echo $title_head; ?></h3></div>
        <?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form')); ?>
        <hr>
        <fieldset>
<!--            <h4 class="header blue bolder smaller">General</h4>-->
            
            <div class="form-group">
                <label for="TemplateName" class="col-md-2 control-label">Title <span class="text-danger">*</span></label>
                <div class="col-md-4">
                    <?php
                    $input = array('name' => 'judul_istilah', 'maxlength' => 250, 'id' => 'TemplateName', 'class' => 'form-control', 'placeholder' => 'Title');
                    echo form_input($input);
                    ?>
                </div>
            </div>
           

            <div class="form-group">
                <label for="TemplateName" class="col-md-2 control-label">Main Picture Link <span class="text-danger">*</span></label>
                <div class="col-md-4">
                    <?php
                    $input = array('name' => 'picture', 'maxlength' => 250, 'id' => 'TemplateName', 'class' => 'form-control', 'placeholder' => 'Main picture link');
                    echo form_input($input);
                    ?>
                </div>
            </div>
            

            <div class="form-group">
                <label for="Status" class="col-md-2 control-label">WOTD</label>
                <div class="col-md-4">
                    <?php
                    echo form_checkbox('word_of_the_day', 1, 0, ' data-toggle="toggle" ');
                    ?>
                    <span class="lbl"></span>
                </div>
            </div>

            <div class="form-group">
                <label for="Status" class="col-md-2 control-label"></label>
                <div class="col-md-4">
                    <button class="btn btn-small btn-info" onclick="PopUpWindow('<?php echo $url_browse_picture; ?>', 'mywindow', 700, 600, 'yes', 'yes'); return false;"><i class="icon-folder-open-alt"></i> Browse Picture</button>
                    <span class="lbl"></span>
                </div>
            </div>    
            <div id="content_editor">          
                <div class="form-group">
                    <label for="Editor" class="col-md-2 control-label">Content</label>
                    <div class="col-md-10">
                        <?php
                        fckeditor();
                        // Automatically calculates the editor base path based on the _samples directory.
                        // This is usefull only for these samples. A real application should use something like this:
                        // $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.

                        $oFCKeditor = new FCKeditor('arti');
                        $oFCKeditor->BasePath = base_url() . 'plugins/FCKeditor/';

                        $oFCKeditor->Config['SkinPath'] = base_url() . 'plugins/FCKeditor/skins/silver/';
                        $oFCKeditor->Height = '250';
                        $oFCKeditor->Value = $arti;
                        $oFCKeditor->Create();
                        ?>
                    </div>
                </div>   
            </div>
            <div id="content_editor">          
                <div class="form-group">
                    <label for="Editor" class="col-md-2 control-label">Content USA</label>
                    <div class="col-md-10">
                        <?php
                        fckeditor();
                        // Automatically calculates the editor base path based on the _samples directory.
                        // This is usefull only for these samples. A real application should use something like this:
                        // $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.

                        $oFCKeditor = new FCKeditor('arti_usa');
                        $oFCKeditor->BasePath = base_url() . 'plugins/FCKeditor/';

                        $oFCKeditor->Config['SkinPath'] = base_url() . 'plugins/FCKeditor/skins/silver/';
                        $oFCKeditor->Height = '250';
                        $oFCKeditor->Value = $arti_usa;
                        $oFCKeditor->Create();
                        ?>
                    </div>
                </div>   
            </div>
           
            <hr>
            <div class="form-actions pull-right">
                
                <button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="fa fa-save"></i> Save</button>
                <?php
                echo anchor('glossary', 'Cancel', array('class' => 'btn btn-small btn-primary'));
                
                ?>
            </div>
        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>
<br/><br/>