<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="page-header position-relative">
    <h1>
        DASHBOARD
    </h1>
</div><!--/.page-header-->

<table border="0" width="100%" cellspading="3" cellspacing="3">
    <tr>
        <td width="50%" valign="top">
	    <?php
	    foreach ($dashboard_left as $left) {
		$this->load->view('Home/' . $left->view_name);
	    }
	    ?>
	</td>
	<td width="1%">
	</td>
	<td valign="top">
	    <?php
	    foreach ($dashboard_right as $right) {
		$this->load->view('Home/' . $right->view_name);
	    }
	    ?>
        </td>
    </tr>
</table>
