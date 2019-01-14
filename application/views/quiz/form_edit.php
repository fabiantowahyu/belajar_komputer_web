<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<br/>
<div class="row-fluid">
    <div class="span12 offset panel-box2">
        <div><h3><?php echo $title_head; ?></h3></div>

        <div class="hr"></div><br>

        <?php echo form_open($url, array('name' => 'fmaassesment', 'class' => 'form-horizontal', 'id' => 'validation-form')); ?>
        <fieldset>
            <div class="control-group">
                <label class="control-label">Score Type <span class="red bolder smaller">*</span></label>
                <div class="controls">
                    <?php
                    $input = array('name' => 'quiz_type', 'maxlength' => 128, 'id' => 'quiz_type', 'class' => 'input-large', 'value' => $quiz_type, 'readonly' => 'true');
                    echo form_input($input);
                    ?>
                </div>
            </div>


            <table class="table table-striped table-bordered table-hover">
                <thead>

                <th>Question </th>
                <th>Question usa</th>
                 <th>Urutan</th>
                <th>Option a</th>
                <th>Option b</th>
                <th>Option c</th>
                <th>Option d</th>
                <th>Answer</th>
                <th></th>
                </thead>


                <tbody id="itemRow">

                    <?php
                    foreach ($quiz as $key => $s) {
                        ?>
                        <tr>

                    <input type="hidden" name="quiz[<?= $key ?>][id_information]" value="<?= $s->id_information ?>">
                    <td align="center"><input type="text" name="quiz[<?= $key ?>][question]" value="<?= $s->question ?>"></td>
                    <td align="center"><input type="text" name="quiz[<?= $key ?>][question_usa]" value="<?= $s->question_usa ?>"></td>
                    <td align="center"><input type="text" name="quiz[<?= $key ?>][urutan]" value="<?= $s->urutan ?>" /></td>
                    <td align="center"><input type="text" name="quiz[<?= $key ?>][option_a]" value="<?= $s->option_a ?>" /></td>
                    <td align="center"><input type="text" name="quiz[<?= $key ?>][option_b]" value="<?= $s->option_b ?>" /></td>
                    <td align="center"><input type="text" name="quiz[<?= $key ?>][option_c]" value="<?= $s->option_c ?>" /></td>
                    <td align="center"><input type="text" name="quiz[<?= $key ?>][option_d]" value="<?= $s->option_d ?>" /></td>
                    <td align="center"><input type="text" name="quiz[<?= $key ?>][answer]" value="<?= $s->answer ?>" /></td>
                    <td align="center">
                        <a href="../../quiz/CTRL_Delete_item/<?php echo $s->id_information; ?>" class="btn btn-mini btn-danger"onclick="if (!confirm('Delete Data?'))
                                    {
                                        return false;
                                    }
                                    ;"><i class="icon-trash"></i></a>
                    </td>

                    </tr>

                <?php } $last_num = $key + 1; ?>
                <input type="hidden" id="last_num" value="<?= $last_num ?>"/>
                <tfoot>
                    <tr>
                        <td colspan="5" >
                            <span class="btn btn-primary btn-mini" id="btnAddRowEdit"> <i class="icon-plus"></i> Add item row</span>
                        </td>
                    </tr>
                </tfoot>
                </tbody>
            </table>
            <span> note : Please list Score in order from higher to lower value </span>


            <div class='clearfix'></div>
            <div class='row-fluid'>
                <i><span class="red bolder smaller">*</span>) Required</i>
            </div>
            <br/>

            <div class="hr"></div>
            <div class="form-actions">
                <?php
                echo anchor('quiz', '<i class="icon-reply"></i>&nbsp;Cancel', array('class' => 'btn btn-small btn-primary'));
                echo nbs(1);
                echo form_hidden('quiz_type', $quiz_type);
                ?>
                <button type="submit" name="submit" value="Save"  class="btn btn-small btn-primary"><i class="icon-save"></i> Save</button>&nbsp;
                <a href="javascript:void(0)" id="cdelete" class="btn btn-small btn-danger"><i class="icon-trash"></i>&nbsp;Delete</a>
            </div>
        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>
<?php echo form_open($url_del, array('name' => 'del', 'id' => 'del')); ?>
<input type="hidden" name="quiz_type" id="delid" value="<?php echo $quiz_type; ?>">
<?php echo form_close(); ?>