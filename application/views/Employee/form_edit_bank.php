<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br>
<div class="row-fluid">
	<div class="span12 offset panel-box2">
		<div><h3><?php echo $title_head; ?></h3></div>
		<?php echo form_open($url,array('class'=>'form-horizontal','id'=>'validation-form-bank')); ?>
		
		<div class="hr"></div>
       	
      <div class="row-fluid">
			<div class="span9">
            	<div class="control-group">
                    <label for="bank_group" class="control-label">Bank Group <span class="red bolder smaller">*</span></label>
                    <div class="controls">
                         <?php
							echo form_dropdown('bank_group',$option_bank_group,$bank_group,'id="bank_group" class="span7"');
						?>
                    </div>
                </div>
		
               <div class="control-group">
                    <label for="bank_name" class="control-label">Bank Name <span class="red bolder smaller">*</span></label>
                    <div class="controls">
						<select name="bank_name" id="bank_id" class="span7">
                           <option value="">Choose a bank name..</option>
                          </option>
                       </select>
                    </div>
                </div>
				
                <div class="control-group">
                    <label for="bank_branch" class="control-label">Bank Branch <span class="red bolder smaller">*</span></label>
                    <div class="controls">
                        <?php
							$input = array('name'=>'bank_branch','value'=>$bank_branch,'id'=>'bank_branch','class'=>'input-large');
							echo form_input($input);
						?>
                    </div>
                </div>
                <div class="control-group">
                    <label for="bank_account" class="control-label">Bank Account <span class="red bolder smaller">*</span></label>
                    <div class="controls">
                        <?php
							$input = array('name'=>'bank_account','value'=>$bank_account,'id'=>'bank_account','class'=>'input-large');
							echo form_input($input);
						?>
                    </div>
                </div>
                <div class="control-group">
                    <label for="account_name" class="control-label">Account Name<span class="red bolder smaller">*</span></label>
                    <div class="controls">
                        <?php
							$input = array('name'=>'account_name','value'=>$account_name,'id'=>'account_name','class'=>'input-large');
							echo form_input($input);
						?>
                    </div>
                </div>
				<div class="control-group">
                    <label for="saving_type" class="control-label">Saving Type</label>
                    <div class="controls">
                         <?php
							echo form_dropdown('saving_type',$option_saving_type,$saving_type,'id="saving_type" class="span4"');
						?>
                    </div>
                </div>
				<div class="control-group">
                    <label for="currency" class="control-label">Currency</label>
                    <div class="controls">
                         <?php
							echo form_dropdown('currency',$option_currency,$currency,'id="currency" class="span3"');
						?>
                    </div>
                </div>
				<div class="control-group">
                    <label for="isdefault" class="control-label">Set as default</label>
                    <div class="controls">
                        <?php
                            echo form_checkbox('isdefault',1,$isdefault,'class="ace-checkbox-2"');
                        ?>
                        <span class="lbl">&nbsp;</span>
                    </div>
                </div>	
            </div>
        </div>
		<i><span class="red bolder smaller">*</span>) Required</i>
		<div class="hr"></div>
		<div class="form-actions">
			<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Update</button> &nbsp;
			<?php 
				echo anchor('employee/CTRL_Edit/'.$emp_id, '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
				echo form_hidden('emp_id',$emp_id);
				echo form_hidden('id',$id);
				echo nbs(1);
			?>
			<a href="#" id="cdelete-bank" class="btn btn-small btn-danger"><i class="icon-trash"></i>&nbsp;Delete</a>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php echo form_open($url_del,array('name'=>'del_bank','id'=>'del_bank')); ?>
<input type="hidden" name="id" id="delid" value="<?php echo $id; ?>">
<?php echo form_close(); ?>