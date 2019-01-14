<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="row-fluid">
	<h3 class="header smaller lighter blue">
		<?php 
		echo anchor('score', $title, array('class'=>'link-control')); 
		echo nbs(2);
		echo anchor('score/CTRL_New', '<i class="icon-plus"></i>', array('class'=>'btn btn-danger btn-mini'));
		?>
	</h3>

	<table id="table-pm" class="table table-striped table-bordered table-hover">
		<thead class="danger">
			<tr>
				<th >ID Information</th>
                                <th >Urutan </th> 
				<th >Question</th> 
				<th >option a</th> 
                                <th >option b</th> 
                                <th >option c</th> 
                                <th >option d</th> 
                                <th >Answer</th> 
				<th  class="center">Action</th> 
			</tr>
		</thead>

		<tbody>
			<?php 
			foreach($results as $row)
			{ 
			?>
				<tr>
                                    <td><ul><?php echo $row->urutan; ?> </ul></td>
                                    <td><ul><?php echo $row->question; ?></ul></td>
                                    <td><ul><?php echo $row->option_a; ?></ul></td>
                                    <td><ul><?php echo $row->option_b; ?></ul></td>  
                                     <td><ul><?php echo $row->option_c; ?></ul></td>  
                                     <td><ul><?php echo $row->option_d; ?></ul></td> 
                                     <td><ul><?php echo $row->answer; ?></ul></td> 
                                    <td class="center">
                                            <?php
                                            echo anchor('score/CTRL_Edit/' . $row->id_information, '<button class="btn btn-mini btn-info"><i class="icon-edit bigger-120"></i></button>');
                                            ?>
                                        </td>
				</tr>
			<?php
			} 
			?>
		</tbody>
	</table>
</div>