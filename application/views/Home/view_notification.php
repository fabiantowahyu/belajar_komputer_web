<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid" style="margin-left: 10px">
    <h3 class="header smaller lighter blue"><i class="icon-gift red"></i>  Cheers for Peers</h3>
    <div class="infobox infobox-pink  ">
	<div class="infobox-icon">
	    <i class="icon-share-alt"></i>
	</div>
	<div class="infobox-data">
	    <span class="infobox-data-number"><?php echo $total_cheers_sent; ?></span>
	    <div class="infobox-content"><a href="#" onclick="PopUpWindow('<?php echo $url_view_cheers; ?>', 'mywindow', 700, 520, 'yes', 'yes'); return false;">Cheers Sent</a></div>
	</div>
    </div>
    <div class="infobox infobox-pink  ">
	<div class="infobox-icon">
	    <i class="icon-download-alt "></i>
	</div>
	<div class="infobox-data">
	    <span class="infobox-data-number"><?php echo $total_cheers_received; ?></span>
	    <div class="infobox-content"><a href="#" onclick="PopUpWindow('<?php echo $url_view_cheers; ?>', 'mywindow', 700, 520, 'yes', 'yes'); return false;">Cheers Received</a></div>
	</div>
    </div>
    <h3 class="header smaller lighter lighter blue"><i class="icon-lightbulb red"></i>  Bright Ideas</h3>
    <div class="infobox infobox-orange2  ">
	<div class="infobox-icon">
	    <i class="icon-share-alt"></i>
	</div>
	<div class="infobox-data">
	    <span class="infobox-data-number"><?php echo $total_ideas; ?></span>
	    <div class="infobox-content"><a href="#" onclick="PopUpWindow('<?php echo $url_view_ideas; ?>', 'mywindow', 700, 520, 'yes', 'yes'); return false;">Ideas Sent</a></div>
	</div>
    </div>
    <div class="infobox infobox-orange2  ">
	<div class="infobox-icon">
	    <i class="icon-check-sign"></i>
	</div>
	<div class="infobox-data">
	    <span class="infobox-data-number"><?php echo $total_ideas_approved; ?></span>
	    <div class="infobox-content"><a href="#" onclick="PopUpWindow('<?php echo $url_view_ideas; ?>', 'mywindow', 700, 520, 'yes', 'yes'); return false;">Ideas Approved</a></div>
	</div>
    </div>
</div>
<br/>