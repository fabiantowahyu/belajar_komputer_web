<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <h3 class="header smaller lighter blue">
        <?php
        echo anchor('rpt_cheers', $title, array('class' => 'link-control'));
        ?>
    </h3>

    <?php echo form_open('rpt_cheers', array('name' => 'fmFilter', 'id' => 'fmFilter')); ?>
    <table width="100%" border="0">
        <tr>
            <td width="7%">
                <div class="row-fluid input-append">
                    <label for="id-date-picker-1">From Date</label>
                </div>
            </td>
            <td width="15%">
                <div class="row-fluid input-append">
                    <input class="span9 date-picker" id="id-date-picker-1" value="<?php echo $req_startdate ?>" type="text" name="req_startdate" />

                    <span class="add-on">
                        <i class="icon-calendar"></i>
                    </span>
                </div>
            </td>
            <td width="7%">
                <div class="row-fluid input-append">
                    <label for="id-date-picker-2">End Date</label>
                </div>
            </td>
            <td width="15%">
                <div class="row-fluid input-append">
                    <input class="span9 date-picker" id="id-date-picker-2" value="<?php echo $req_enddate ?>" type="text" name="req_enddate" />
                    <span class="add-on">
                        <i class="icon-calendar"></i>
                    </span>
                </div>
            </td>
            <td valign="middle">
                <div class="row-fluid input-append">
                    <button type="submit" name="filter" class="btn btn-small btn-primary"><i class="icon-filter"></i> Filter</button>
                </div>
            </td>
        </tr>

    </table>
    <?php echo form_close(); ?>

    <table id="table-sample_report" class="table table-striped table-bordered table-hover">
        <thead class="info">
            <tr>
                <th>Employee Name</th>
                <th>Position</th>
                <th width="200px">Total Stars</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $row) { ?>
                <tr>
                    <td><?= $row->employee_name; ?></td>
                    <td><?= $row->position_name; ?></td>
                    <td><?= $row->total_stars; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>