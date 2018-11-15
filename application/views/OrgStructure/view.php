<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="row">
	<div class="span11 offset panel-box">
		<h3>
			<?php
				echo $title; 
				echo nbs(2);
			?>
			<a href="javascript:void(0);" title="view detail" class="btn btn-danger btn-mini" onclick="PopUpWindow('<?php echo $url_detail; ?>','mywindow',800,400,'yes','yes'); return false;"><i class="icon-bar-chart"></i></a>
		</h3>
		<div class="hr"></div>
		<table width="98%" cellpadding="3" cellspacing="3">
		<tr>
			<td width="35%" valign="top">
				<div id="treeOrgLevel" class="demo"></div>
			</td>
			<td valign="top">
				<iframe name="myframe" src="<?php echo $url_view; ?>" width="100%" height="450px">
					<p>Your browser does not support iframes.</p>
				</iframe>
			</td>
		</tr>
		</table>
		<div class="hr"></div>
	</div>
</div>

