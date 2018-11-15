<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <div class="span12 offset panel-box2">
        <div><h3><?php echo $title_head; ?></h3></div>
        <?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form')); ?>
        <fieldset>
            <h4 class="header blue bolder smaller">General</h4>
            <div class="control-group">
                <label for="template_id" class="control-label">Information ID</label>
                <div class="controls">
                    <?php
                    $input = array('name' => 'id', 'value' => $id, 'maxlength' => 15, 'id' => 'template_id', 'class' => 'input-small', 'disabled' => 'disabled');
                    echo form_input($input);
                    ?>
                </div>
            </div>
            <div class="control-group">
                <label for="TemplateName" class="control-label">Title <span class="red bolder smaller">*</span></label>
                <div class="controls">
                    <?php
                    $input = array('name' => 'title', 'maxlength' => 250, 'id' => 'TemplateName', 'class' => 'input-xlarge', 'placeholder' => 'Title');
                    echo form_input($input);
                    ?>
                </div>
            </div>
            <div class="control-group">
                <label for="TemplateName" class="control-label">Title USA<span class="red bolder smaller">*</span></label>
                <div class="controls">
                    <?php
                    $input = array('name' => 'title_usa', 'maxlength' => 250, 'id' => 'TemplateName', 'class' => 'input-xlarge', 'placeholder' => 'Title');
                    echo form_input($input);
                    ?>
                </div>
            </div>

            <div class="control-group">
                <label for="TemplateName" class="control-label">Main Picture Link <span class="red bolder smaller">*</span></label>
                <div class="controls">
                    <?php
                    $input = array('name' => 'picture', 'maxlength' => 250, 'id' => 'TemplateName', 'class' => 'input-xlarge', 'placeholder' => 'Main picture link');
                    echo form_input($input);
                    ?>
                </div>
            </div>
            <div class="control-group">
                <label for="TemplateName" class="control-label">External Source <span class="red bolder smaller">*</span></label>
                <div class="controls">
                    <input class="ace-checkbox-2" type="checkbox" onclick="changeState()"  value="1" id="external_source" name="external_source">
                    <span class="lbl"></span>
                </div>
            </div>
            <div id="external_url" style="display: none;">
                <div class="control-group">
                    <label for="TemplateName" class="control-label">External Url <span class="red bolder smaller">*</span></label>
                    <div class="controls">

                        <?php
                        $input = array('name' => 'link', 'maxlength' => 250, 'id' => 'TemplateName', 'class' => 'input-xlarge', 'placeholder' => 'External link');
                        echo form_input($input);
                        ?>

                        <div class="note">Link diisi jika ingin menampilkan informasi dari luar tanpa mengisi content.</div>

                    </div>
                </div>
            </div>

            <div class="control-group">
                <label for="Status" class="control-label">Publish</label>
                <div class="controls">
                    <?php
                    echo form_checkbox('status', 1, 0, 'class="ace-switch ace-switch-5"');
                    ?>
                    <span class="lbl"></span>
                </div>
            </div>

            <div class="control-group">
                <label for="Status" class="control-label"></label>
                <div class="controls">
                    <button class="btn btn-small btn-info" onclick="PopUpWindow('<?php echo $url_browse_picture; ?>', 'mywindow', 700, 600, 'yes', 'yes'); return false;"><i class="icon-folder-open-alt"></i> Browse Picture</button>
                    <span class="lbl"></span>
                </div>
            </div>    
            <div id="content_editor">          
                <div class="control-group">
                    <label for="Editor" class="control-label"></label>
                    <div class="controls">
                        <?php
                        fckeditor();
                        // Automatically calculates the editor base path based on the _samples directory.
                        // This is usefull only for these samples. A real application should use something like this:
                        // $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.

                        $oFCKeditor = new FCKeditor('content');
                        $oFCKeditor->BasePath = base_url() . 'plugins/FCKeditor/';

                        $oFCKeditor->Config['SkinPath'] = base_url() . 'plugins/FCKeditor/skins/silver/';
                        $oFCKeditor->Height = '400';
                        $oFCKeditor->Value = $content;
                        $oFCKeditor->Create();
                        ?>
                    </div>
                </div>   
            </div>
            <div id="content_editor">          
                <div class="control-group">
                    <label for="Editor" class="control-label"></label>
                    <div class="controls">
                        <?php
                        fckeditor();
                        // Automatically calculates the editor base path based on the _samples directory.
                        // This is usefull only for these samples. A real application should use something like this:
                        // $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.

                        $oFCKeditor = new FCKeditor('content_usa');
                        $oFCKeditor->BasePath = base_url() . 'plugins/FCKeditor/';

                        $oFCKeditor->Config['SkinPath'] = base_url() . 'plugins/FCKeditor/skins/silver/';
                        $oFCKeditor->Height = '400';
                        $oFCKeditor->Value = $content_usa;
                        $oFCKeditor->Create();
                        ?>
                    </div>
                </div>   
            </div>
            <div class="hr"></div>
            <div class="form-actions">
                <button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
                <?php
                echo anchor('information', '<i class="icon-reply"></i>&nbsp;Cancel', array('class' => 'btn btn-small btn-primary'));
                echo form_hidden('id', $id);
                ?>
            </div>
        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>