<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br>
<div id="MasterCompany" class="row-fluid">
	<div class="span9 offset2 panel-box2">
		<div><h3><?php echo $title_head; ?></h3></div>
		<?php echo form_open_multipart($url,array('class'=>'form-horizontal','id'=>'validation-form')); ?>
		<h4 class="header blue bolder smaller">General</h4>

		<div class="row-fluid">
			<div class="span3">
				<input type="file" name="userfile" />
			</div>
			<div class="vspace"></div>
			<div class="span9">
				<div class="control-group">
					<label for="CompanyID" class="control-label"><?php echo $title; ?> ID</label>
					<div class="controls">
						<?php
							$input = array('name'=>'id','value'=>$id,'maxlength'=>15,'id'=>'CompanyID','class'=>'input-small','disabled'=>'disabled');
							echo form_input($input);
						?>
					</div>
				</div>
				<div class="control-group">
					<label for="CompanyType" class="control-label"><?php echo $title; ?> Type</label>
					<div class="controls">
						<?php
							echo form_dropdown('type',$option_type,$type,'class="span5"');
						?>
					</div>
				</div>
				<div class="control-group">
					<label for="CompanyName" class="control-label"><?php echo $title; ?> Name</label>
					<div class="controls">
						<?php
							$input = array('name'=>'name','maxlength'=>64,'id'=>'CompanyName','class'=>'input-xlarge');
							echo form_input($input);
						?>
					</div>
				</div>
			</div>
		</div>
		<hr />
		<div class="control-group">
			<label for="Country" class="control-label">Country</label>
			<div class="controls">
				<?php
					$input = array('name'=>'country','maxlength'=>64,'id'=>'Country','class'=>'input-xlarge');
					echo form_input($input);
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="Province" class="control-label">Province</label>
			<div class="controls">
				<?php
					$input = array('name'=>'province','maxlength'=>64,'id'=>'Province','class'=>'input-xlarge');
					echo form_input($input);
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="City" class="control-label">City</label>
			<div class="controls">
				<?php
					$input = array('name'=>'city','maxlength'=>64,'id'=>'City','class'=>'input-xlarge');
					echo form_input($input);
				?>
			</div>
		</div>
		
		<div class="space"></div>
		<h4 class="header blue bolder smaller">Contact</h4>
		<div class="control-group">
			<label for="Address" class="control-label">Address</label>
			<div class="controls">
				<?php
					$txtarea = array('name'=>'address','rows'=>2,'class'=>'span7');
					echo form_textarea($txtarea); 
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="PostalCode" class="control-label">Postal Code</label>
			<div class="controls">
				<?php
					$input = array('name'=>'postal_code','maxlength'=>64,'id'=>'PostalCode','class'=>'input-small input-mask-kdpos');
					echo form_input($input);
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="Phone" class="control-label">Phone</label>
			<div class="controls">
				<?php
					$input = array('name'=>'phone','maxlength'=>64,'id'=>'Phone','class'=>'input-small input-mask-phone');
					echo form_input($input);
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="Fax" class="control-label">Fax</label>
			<div class="controls">
				<?php
					$input = array('name'=>'fax','maxlength'=>64,'id'=>'Fax','class'=>'input-small input-mask-fax');
					echo form_input($input);
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="Email" class="control-label">Email</label>
			<div class="controls">
				<?php
					$input = array('name'=>'email','maxlength'=>64,'id'=>'Email','class'=>'input-large');
					echo form_input($input);
				?>
			</div>
		</div>
		
		
		<div class="space"></div>
		<h4 class="header blue bolder smaller">Bank Account</h4>
		<div class="control-group">
			<label for="BankAccount" class="control-label">Company Bank Account</label>
			<div class="controls">
				<?php
					$input = array('name'=>'bank_account','maxlength'=>64,'id'=>'BankAccount','class'=>'input-small','onkeypress'=>'return numbersonly(event)');
					echo form_input($input);
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="BankName" class="control-label">Company Bank Name</label>
			<div class="controls">
				<?php
					$input = array('name'=>'bank_name','maxlength'=>64,'id'=>'BankName','class'=>'input-xlarge');
					echo form_input($input);
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="AccountName" class="control-label">Account Name</label>
			<div class="controls">
				<?php
					$input = array('name'=>'account_name','maxlength'=>64,'id'=>'AccountName','class'=>'input-xlarge');
					echo form_input($input);
				?>
			</div>
		</div>
		
		
		<div class="space"></div>
		<h4 class="header blue bolder smaller">Other</h4>
		<div class="control-group">
			<label for="Vision" class="control-label">Vision</label>
			<div class="controls">
				<?php
					$txtarea = array('name'=>'vission','rows'=>3,'class'=>'span7');
					echo form_textarea($txtarea); 
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="Mission" class="control-label">Mission</label>
			<div class="controls">
				<?php
					$txtarea = array('name'=>'mission','rows'=>3,'class'=>'span7');
					echo form_textarea($txtarea); 
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="CompanyStatus" class="control-label">Company Status</label>
			<div class="controls">
				<?php
					echo form_checkbox('status',1,0,'class="ace-switch ace-switch-3"'); 
				?>
				<span class="lbl"></span>
			</div>
		</div>
		<div class="control-group">
			<label for="CompanyCurrency" class="control-label">Company Currency</label>
			<div class="controls">
				<?php
					echo form_dropdown('currency',$option_currency,$currency,'class="span3"');
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="TaxCountry" class="control-label">Tax Country</label>
			<div class="controls">
				<?php
					$input = array('name'=>'tax_country','maxlength'=>64,'id'=>'TaxCountry','class'=>'input-small');
					echo form_input($input);
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="TaxFile" class="control-label">NPWP</label>
			<div class="controls">
				<?php
					$input = array('name'=>'tax_file','maxlength'=>64,'id'=>'TaxFile','class'=>'input-large');
					echo form_input($input);
				?>
			</div>
		</div>
		<div class="control-group">
			<label for="tax_signature" class="control-label">Tax Author Signature </label>
			<div class="controls">
				<?php
					echo form_dropdown('tax_signature',$option_tax_signature,$tax_signature,'class="span5"');
				?>
			</div>
		</div>
        <div class="control-group">
			<label for="invoice_signature" class="control-label">Invoice Author Signature </label>
			<div class="controls">
				<?php
					echo form_dropdown('invoice_signature',$option_invoice_signature,$invoice_signature,'class="span5"');
				?>
			</div>
		</div>
		<div class="hr"></div>
		<div class="form-actions">
			<button type="submit" name="submit" value="Save" class="btn btn-small btn-info"><i class="icon-save"></i> Save</button> &nbsp;
			<?php 
				echo anchor('company', '<i class="icon-reply"></i>&nbsp;Cancel', array('class'=>'btn btn-small btn-primary'));
				echo form_hidden('id',$id);
			?>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>