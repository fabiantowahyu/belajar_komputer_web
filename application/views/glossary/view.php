<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="row">
    
    <div class="col-md-12">
        
        <h3 class="header smaller lighter blue">
        <?php
        echo anchor('glossary', $title, array('class' => 'link-control'));
        echo nbs(2);
        echo anchor('glossary/CTRL_New', '<i class="fa fa-plus"></i>', array('class' => 'btn btn-danger btn-xs'));
        ?>
    </h3>
    <hr>
        
        
    <table id="table_article" class="table table-striped table-bordered table-hover">
        <thead class="danger">
            <tr>
                <th >No</th> 
                <th >Title</th> 
                <th >Description</th>
                <th >Picture</th> 
                <th >WOTD</th> 
                <th width="60" class="center" >Action</th> 
            </tr>
        </thead>

        <tbody>
            <?php
            $no = 1;
            foreach ($results as $row) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row->judul_istilah; ?></td>
                     <td><?php echo $row->arti; ?></td>
                     <td class="text-center"><?php  if($row->picture){ ?>
                    <span class='label label-success '><i class="fa fa-check"></i></span>
                    <?php }?>
                    </td>
                    <td class="center"><?php
                        if ($row->word_of_the_day == 1) {
                            echo "<span class='label label-success '>WOTD</span>";
                        } else {
                            echo "<span class='label label-warning '>WOTD</span>";
                        };
                        ?></td>
                    <td class="center">
                        <?php
                        echo anchor('glossary/CTRL_Edit/' . $row->id, '<button class="btn btn-xs btn-info"><i class="fa fa-pencil "></i></button>');

                        ?>
                       
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
</div>