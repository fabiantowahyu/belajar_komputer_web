<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<br/>
<div class="row-fluid">
    <div class="span12 offset panel-box">
	<div><h3><?php echo $title_head; ?></h3></div>
	<div class="hr"></div><br>
	<?php echo form_open($url, array('name' => 'myForm', 'class' => 'form-horizontal', 'id' => 'validation-form')); ?>
	<div class="control-group">
	    <label class="control-label">Score Type <span class="red bolder smaller">*</span></label>
	    <div class="controls">
		<?php
		$input = array('name' => 'id_information', 'maxlength' => 128, 'id' => 'id_information', 'class' => 'input-large');
		echo form_input($input);
		?>
	    </div>
	</div>
	<span class="btn btn-primary btn-mini" id="btnAddRow"> <i class="icon-plus"></i> Add item</span>
	<br><br>
	<table class="table table-striped table-bordered table-hover">
	    <thead>
	   <th>Question </th>
           <th>Question usa </th>
           <th>Urutan</th>
                <th>Option a</th>
                <th>Option b</th>
                <th>Option c</th>
                <th>Option d</th>
                <th>Answer</th>
                <th></th>
	    </thead>
	    <tbody id="itemRow">
		<tr>
		    <td colspan="6" style="padding:2%;"> No data available in table</td>
		</tr>
	    </tbody>
	</table>
	<fieldset>
	    <span> note : Please list Score in order from higher to lower value </span>
	    <div class='clearfix'></div>
	    <div class='row-fluid'>
		<i><span class="red bolder smaller">*</span>) Required</i>
	    </div>
	    <br/>
	    <div class="hr"></div>
	    <div class="form-actions">
		<?php
		echo anchor('quiz', '<i class="icon-reply"></i>&nbsp;Cancel', array('class' => 'btn btn-small btn-primary'));
		?>
		<button type="submit" name="submit" onclick="SelectAll_Member()" value="Save" class="btn btn-small btn-primary"><i class="icon-save"></i> Save</button> &nbsp;
	    </div>
	</fieldset>
	<?php echo form_close(); ?>
    </div>
</div>

