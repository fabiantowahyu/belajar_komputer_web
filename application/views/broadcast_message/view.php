<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="row-fluid">
<div class="row">
    

    
    
    <div class="col-md-12">
        <h3 class="header smaller lighter blue">
        <?php
        echo anchor('broadcast_message', $title, array('class' => 'link-control'));
        ?>
    </h3>
        <hr>
        <?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form')); ?>
        <fieldset>
           
            
            <?php if ($this->session->flashdata('send_success')) { ?>
                        <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?= $this->session->flashdata('send_success') ?> </div>
                    <?php }if ($this->session->flashdata('send_failed')) {
                        ?>
                        <div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?= $this->session->flashdata('send_failed') ?> </div>
                        
             <?php       }
                    ?>
            <div class="form-group">
                <label for="template_id" class="col-md-2 control-label">Information ID</label>
                <div class="col-md-4">
                    <?php
                    $input = array('name' => 'id', 'value' => $id, 'maxlength' => 15, 'id' => 'template_id', 'class' => 'form-control', 'disabled' => 'disabled');
                    echo form_input($input);
                    ?>
                </div>
            </div>
            
            <div class="form-group">
                <label for="template_id" class="col-md-2 control-label">Target</label>
                <div class="col-md-4">
                  <?php
		    echo form_dropdown('target', $option_receiver, 'all', 'id="receiver" class=" form-control" ');
		    ?>
                </div>
            </div>
            
            <div class="form-group">
                <label for="TemplateName" class="col-md-2 control-label">Title <span class="red bolder smaller">*</span></label>
                <div class="col-md-4">
                    <?php
                    $input = array('name' => 'title', 'maxlength' => 250, 'id' => 'TemplateName', 'class' => 'form-control', 'placeholder' => 'Title');
                    echo form_input($input);
                    ?>
                </div>
            </div>
 <div class="form-group">
                <label for="TemplateName" class="col-md-2 control-label">Message <span class="red bolder smaller">*</span></label>
                <div class="col-md-4">
                    <?php
                    $txtarea = array('name'=>'message','rows'=>4,'class'=>'form-control','id'=>'message', 'placeholder' => 'Message');
                    echo form_textarea($txtarea); 
					?>
                </div>
            </div>
     

                        <hr>
            <div class="form-actions pull-right ">
                <button type="submit" name="submit" value="Save" class="btn btn-small btn-primary"><i class="icon-save"></i> Send Message</button> &nbsp;
                
                    <input type="reset" class="btn btn-small btn-info" value="Cancel">
                   
            </div>
        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="row">
    <br>
    <div class="space-20"></div>
    <br>
        <div class="col-md-12">
    <table id="table_broadcast" class="table table-striped table-bordered table-hover">
        <thead class="danger">
            <tr>
                <th width="30" >No</th> 
                <th width="250">Created Date</th> 
                <th >Title</th> 
                
                <th >Message</th> 
                <th width="100" class="center">Status</th> 
            </tr>
        </thead>

        <tbody>
            <?php
            $no = 1;
            foreach ($results as $row) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo date('l, j F Y H:i', strtotime($row->recdate)) . ' WIB'; ?></td>
                    <td><?php echo $row->title; ?></td>
                    <td><?php echo $row->message; ?></td>
                    <td class="center"><?php
                        if ($row->status == 1) {
                            echo "<span class='label label-success arrowed-in arrowed-in-right'>Success</span>";
                        } else {
                            echo "<span class='label label-danger arrowed-in arrowed-in-right'>Failed</span>";
                        };
                        ?></td>
                    
                </tr>
            <?php } ?>
        </tbody>
    </table>
        </div>

    
</div>
</div>