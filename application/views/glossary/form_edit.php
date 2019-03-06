<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="row-fluid">
    <div class="span12 offset panel-box2">
        <div><h3><?php echo $title_head; ?></h3></div>
        <?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form')); ?>
        <hr>
        <fieldset>
            
           <div class="form-group">
                <label for="TemplateName" class="col-md-2 control-label">Title <span class="text-danger">*</span></label>
                <div class="col-md-4">
                    <?php
                    $input = array('name' => 'judul_istilah','value' => $judul_istilah, 'maxlength' => 250, 'id' => 'TemplateName', 'class' => 'form-control', 'placeholder' => 'Title');
                    echo form_input($input);
                    ?>
                </div>
            </div>
           

            <div class="form-group">
                <label for="TemplateName" class="col-md-2 control-label">Main Picture Link <span class="text-danger">*</span></label>
                <div class="col-md-4">
                    <?php
                    $input = array('name' => 'picture', 'value' => $picture, 'maxlength' => 250, 'id' => 'TemplateName', 'class' => 'form-control', 'placeholder' => 'Main picture link');
                    echo form_input($input);
                    ?>
                </div>
            </div>
            

            <div class="form-group">
                <label for="Status" class="col-md-2 control-label">WOTD</label>
                <div class="col-md-4">
                    <?php
                    echo form_checkbox('word_of_the_day', 1, $word_of_the_day, ' data-toggle="toggle" ');
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
            
            <div id="content_editor" >   
                

                    <div class="form-group">
                        <label for="Editor" class="col-md-2 control-label">Template Content</label>
                        <div class="col-md-10">
                            <?php
                            fckeditor();
                            // Automatically calculates the editor base path based on the _samples directory.
                            // This is usefull only for these samples. A real application should use something like this:
                            // $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.

                            $oFCKeditor = new FCKeditor('arti');
                            $oFCKeditor->BasePath = base_url() . 'plugins/FCKeditor/';

                            $oFCKeditor->Config['SkinPath'] = base_url() . 'plugins/FCKeditor/skins/silver/';
                            $oFCKeditor->Height = '400';
                            $oFCKeditor->Value = $arti;
                            $oFCKeditor->Create();
                            ?>
                        </div>
                    </div>   
            </div>
            
            <div class="hr"></div>
            
            <div id="content_editor" >   
                

                    <div class="form-group">
                        <label for="Editor" class="col-md-2 control-label">Template Content USA</label>
                        <div class="col-md-10">
                            <?php
                            fckeditor();
                            // Automatically calculates the editor base path based on the _samples directory.
                            // This is usefull only for these samples. A real application should use something like this:
                            // $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.

                            $oFCKeditor = new FCKeditor('arti_usa');
                            $oFCKeditor->BasePath = base_url() . 'plugins/FCKeditor/';

                            $oFCKeditor->Config['SkinPath'] = base_url() . 'plugins/FCKeditor/skins/silver/';
                            $oFCKeditor->Height = '400';
                            $oFCKeditor->Value = $arti_usa;
                            $oFCKeditor->Create();
                            ?>
                        </div>
                    </div>   
            </div>
            <hr>
            <div class="form-actions pull-right">
                <button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="fa fa-save"></i> Save</button>&nbsp;
                <?php
                echo anchor('glossary', 'Cancel', array('class' => 'btn btn-small btn-primary'));
                echo nbs(1);
                echo form_hidden('id', $id);
                ?>
                <a href="#" id="cdelete" data-toggle="modal" data-target="#myModaldelete" class="btn btn-small btn-danger"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                </div>
        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>

<br/><br/>
<?php echo form_open($url_del, array('name' => 'del', 'id' => 'del')); ?>

<!-- Modal -->
<div class="modal fade" id="myModaldelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
	<div class="modal-content">
	    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		    &times;
		</button>
		<h4 class="modal-title" id="myModalLabel"><i class="fa fa-times"></i>&nbsp;Delete</a></h4>
	    </div>
	    <div class="modal-body">
		<p>
		    Are you sure to delete this data..!!!
		</p>
	    </div>

	    <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">
		    Cancel
		</button>
		<button type="submit" name="btn_submit_delete" class="btn btn-danger">
		    Delete
		</button>
	    </div>
	</div>
    </div>
</div>
<input type="hidden" name="id" id="delid" value="<?php echo $id; ?>">
<?php echo form_close(); ?>