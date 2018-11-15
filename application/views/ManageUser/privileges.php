<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php echo form_open($url); ?>
<div class="easyui-panel" title="<?php echo $title; ?>" style="width:auto;padding:10px">
	<table width="50%" cellpadding="2" cellspacing="5" border="0">
	<tr>
		<td width="100" align="left" valign="top">User ID</td>
		<td width="10" align="left" valign="top">:</td>
		<td align="left" valign="top">
		<?php
			echo $userid;
		?>
		</td>
	</tr>
	<tr>
		<td align="left" valign="top">User Name</td>
		<td align="left" valign="top">:</td>
		<td align="left" valign="top">
		<?php
			echo $username;
		?>
		</td>
	</tr>
	</table>
	<hr>
	<table width="100%" border="0">
	<tr>
		<td width="50%">
			<table cellpadding="2" cellspacing="5" border="0">
			<tr>
				<td align="left" valign="top"><b>LIST GROUP</b></td>
				<td align="center">&nbsp;</td>
				<td align="left" valign="top"><b>SELECTED GROUP</b></td>
			</tr>
			<tr>
				<td align="left" valign="top">
				<?php
					$input = array('size'=>10);
					echo form_dropdown("group_id_all[]",$option_group_all,'','size="16" multiple="multiple"');
					echo form_hidden('user_id',$userid);
				?>
				</td>
				<td align="center">
					<?php echo form_submit('add','>>');?> <br><br>
					<?php echo form_submit('remove','<<');?>
				</td>
				<td align="left" valign="top">
				<?php
					$input = array('size'=>10);
					echo form_dropdown("group_id[]",$option_group,'','size="16" multiple="multiple"');
				?>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><?php echo form_submit('close','Close');?></td>
	</tr>
	</table>
</div>
<?php echo form_close(); ?>