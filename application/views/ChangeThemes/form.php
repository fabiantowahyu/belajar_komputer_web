<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php echo form_open($url,array('id'=>'myForm')); ?>
<div class="easyui-panel" title="<?php echo $title; ?>" style="width:auto;padding:10px">
	<table cellpadding="2" cellspacing="5" border="0">
		<tr>
			<td align="left" valign="top" >Themes</td>
			<td align="left" valign="top">:</td>
			<td align="left" valign="top">
			<?php
				echo form_dropdown('themes',$option_themes,$themes);
			?>
			</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td align="left" valign="top" style="padding-top: 5px;" >
			<?php
				echo form_hidden('userid',$userid);
				echo form_submit('submit','Save','onclick="clicked=\'Save\'"');
				echo nbs(2);
				echo form_submit('close','Close');
			?>
			</td>
		</tr>
	</table>
</div>
<?php echo form_close(); ?>