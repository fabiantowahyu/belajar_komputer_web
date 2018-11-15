<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div class="row">
	<div class="span10 offset panel-box">
		<div><h3><?php echo $title; ?></h3></div>
		<?php echo form_open($url,array('name'=>'myForm','class'=>'form-horizontal')); ?>
		<fieldset>
			<div class="control-group">
				<label class="control-label">Group Name</label>
				<label class="control-label"><?php echo $nama; ?></label>
			</div>
			<div class="control-group">
				<label class="control-label">Description</label>
				<label class="control-label"><?php echo $description; ?></label>
			</div>
			<div class="hr"></div>
			<div id="tree">
				<ul>
                    <li>
					<label>
						<input name="frmChk_all" class="ace-checkbox-2" type="checkbox" value="all" <?php echo $cekall; ?> >
						<span class="lbl">All</span>
					</label>
					<ul>
						<?php 
							echo $DATA_MENU;
						?>
					</ul>
				</ul>
            </div>
			<div class="hr"></div>
			<div>
				<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
				<?php 
					echo anchor('manage_group', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
					echo form_hidden('pid',$id);
				?>
			</div>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>

