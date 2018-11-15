<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="row">
	<div class="span10 offset panel-box">
		<div><h3>Organization Level</h3></div>
		<?php echo form_open($url,array('name'=>'myForm','class'=>'form-horizontal')); ?>
		<fieldset>
			<div class="hr"></div>
			<div id="treeOrgLevel" class="demo"></div>
			<div class="hr"></div>
			
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>

