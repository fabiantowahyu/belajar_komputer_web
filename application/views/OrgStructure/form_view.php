<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<input type="button" name="close" value="Close" class="btn btn-small btn-primary" onClick="self.close()">
<input type="button" name="horizontal" value="<?php echo $nmtype; ?>" class="btn btn-small btn-primary" onClick="javascript:window.location.href='<?php echo $url; ?>'">
<br /><br />
<?php
if($type == 'horizontal') {
?>
<!--
<center>
<table cellpadding=0 cellspacing=0 border=0 bordercolor="yellow">
	<tr>
		<td>
			<table align="center" cellpadding=0 cellspacing=0 border=0>
				<tr><td class="box">Organization Structure <span class="spdrill" id="sp_1" onclick="drillchart(this)">&raquo;</span></td></tr>
			</table>
		</td>
	</tr>
	<tr><td id="child_2231" align='center'></td></tr>
</table>
</center>
<iframe name="ifrdraw" style="display:none;"></iframe>

<div id="spexp" style="display:none;">&raquo;</div>
<div id="spclp" style="display:none;">&laquo;</div>
-->
<div style="display:none;">
<ul id="organisation">
	<?php  echo $orgchart; ?>
</ul>
</div>
 <div id="main"></div>
<?php
} else {
?>
<div class="row-fluid">
	<div class="span12 offset panel-box">
		<h4 class="header blue bolder smaller">Organizational Tree </h4>

		<div id="treeOrgLevel" class="demo"></div>
	</div>
</div>
<?php
}
?>