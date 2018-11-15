<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div><h3>Position</h3></div>
<?php echo form_open($url,array('name'=>'myForm','class'=>'form-horizontal')); ?>
	<table width="100%" cellspacing="2" cellpadding="4" border="1">
		<?php foreach ($results as $row) { ?>
			<tr>
				<td>
					<div class="control-group">
						<div class="controls">
							<?php
								echo form_radio('radPosition',1,0,'OnClick="ChangeID();"');
							?>
							<span class="lbl">&nbsp;[<?php echo $row->position_code; ?>]&nbsp;-&nbsp;<?php echo $row->position_name; ?></span>
						</div>
					</div>
				</td>
			</tr>
		<?php } ?>
	</table>
<?php echo form_close(); ?>


