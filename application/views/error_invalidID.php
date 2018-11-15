<div class="err" align="center">
	<h4 class="title">WARNING !!</h4>
    <h4 class="title">ID you choose error!, Please choose a right ID.</h4>
	<br><br>
	<?php 
	if(@$isPopupWindow) {
		echo '<a href="javascript:self.close()">[ Close ]</a>';
	} else {
		echo '<a href="javascript:history.back()">[ Back ]</a>';
	}
	?>
</div>