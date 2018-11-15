<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<br><br>
<div class="row-fluid">
    <h3 class="header smaller lighter blue">
        <?php
        echo anchor('information', $title, array('class' => 'link-control'));
        echo nbs(2);
        echo anchor('information/CTRL_New', '<i class="icon-plus"></i>', array('class' => 'btn btn-danger btn-mini'));
        ?>
    </h3>

    <table id="table-lettertemplate" class="table table-striped table-bordered table-hover">
        <thead class="danger">
            <tr>
                <th >No</th> 
                <th >Title</th> 
                <th >Created Date</th> 
                <th class="center">Status</th> 
                <th  class="center">Action</th> 
            </tr>
        </thead>

        <tbody>
            <?php
            $no = 1;
            foreach ($results as $row) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row->title; ?></td>
                    <td><?php echo date('l, j F Y H:i', strtotime($row->recdate)) . ' WIB'; ?></td>
                    <td class="center"><?php
                        if ($row->status == 1) {
                            echo "<span class='label label-success arrowed-in arrowed-in-right'>Published</span>";
                        } else {
                            echo "<span class='label label-danger arrowed-in arrowed-in-right'>Draft</span>";
                        };
                        ?></td>
                    <td class="center">
                        <?php
                        echo anchor('information/CTRL_Edit/' . $row->id, '<button class="btn btn-mini btn-info"><i class="icon-edit bigger-120"></i></button>');

                        if ($row->external_source == 1) {

                            $link_url = $row->link;
                        } else {

                            $link_url = $url_view . $row->id;
                        }
                       
                        ?>&nbsp;
                        <button type="button" class="btn btn-mini btn-success" onclick="PopUpWindow('<?php echo $link_url; ?>', 'mywindow', 800, 600, 'yes', 'yes'); return false;"><i class="icon-eye-open bigger-120"></i></button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>