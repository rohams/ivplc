<div class="content">

	<h1 class="title">Submit Vehicle</h1>
        <div class="errors"><?php echo $error;?></div> 
	<?php if(validation_errors()) : ?>
		<div class="errors"><?=validation_errors();?></div>                          
	<?php endif; ?>
                <script>
			var id = 0;
		</script>
	
	<?=form_open_multipart('submit/vehicle', array('id'=>'submit_general'));?>
	
		<!-- VEHICLE INFORMATION -->
		<?=form_fieldset('Vehicle Information');?>
			<?=form_hidden('fk_contributor_id', $contributor);?>
			
			<?=form_label('<span>*</span> Manufacturer', 'manufacturer');?>
			<?=form_dropdown('manufacturer', $manufacturers, set_value('manufacturer')); ?>
				
			<?=form_label('<span>*</span> Model', 'model');?>
			<?=form_input(array('name'=>'model', 'maxlength'=>'40', 'value'=>set_value('model')));?>
			
			<?=form_label('<span>*</span> Year', 'year');?>
			<?=form_input(array('name'=>'year', 'maxlength'=>'4', 'value'=>set_value('year')));?>
		<?=form_fieldset_close();?>


		<!-- IMAGES -->
		<?=form_fieldset('Images');?>	
			<div class="controls">
				<a class="add" id="incrementImage" href="#">Add Image</a>
				<a class="remove" id="decrementImage" href="#">Remove Image</a>
			</div>
			
			<div class="group" id="images">
				<div class="group_member" id="image1">
					<?=form_label('<span>*</span> Image 1', 'image');?>
					<?=form_upload(array('name'=>'image[]'));?>
				</div>
			</div>
		<?=form_fieldset_close();?>


		<!-- COMPONENTS -->
		<?=form_fieldset('Components');?>	
			<div class="controls">
				<a class="add" id="incrementComponent" href="#">Add Component</a>
				<a class="remove" id="decrementComponent" href="#">Remove Component</a>
			</div>
						
			<p class="note">Please provide the names of each component, and attach any files associated with that singular point (ie: noise function file).</p>
			
			<div class="group" id="components">
				<?php for($i = 1; $i <= 2; $i++) :?>
					<div class="group_member component" id="component<?=$i;?>">
						<?=form_label('<span>*</span> Component ' . $i, 'component_name');?>
						<?=form_input(array('name'=>'component_name[]', 'maxlength'=>'20', 'value'=>set_value('component_name[]')));?>
						<?=form_upload(array('name'=>'component[]'));?>
					</div>
				<?php endfor;?>
			</div>
		<?=form_fieldset_close();?>


		<!-- MEASUREMENTS -->
		<?=form_fieldset('Measurements');?>
			<p class="note">Please attach the s-parameter files associated between the two referenced points.</p>
			
			<div id="measurements">
				<div class="measurement" id="measurement1">
					<h2 class="component1">Component 1</h2>
					<div class="reference">
						<?=form_label('Component 2', 'measurement[]', array('class'=>'component2'));?>
						<?=form_upload(array('name'=>'measurement[]'));?>
					</div>
				</div>
			</div>
		
		<?=form_fieldset_close();?>
	
	
		<!-- TERMS AND CONDITIONS -->
		<?=form_fieldset('Terms and Conditions');?>
			<div class="clear"></div>
			<p id="terms">I am the owner of the submitted content, and hereby grant the IVPLC Group of UBC permission to display the submitted content on the IVPLC Group website. If I am not the legal owner of the content, I take on full liability and accept all responsibility and penalty for any infringement that ensues.</p>
			<p id="confirm">
			<?=form_checkbox('agreement', 'agree', set_value('agreement'));?>
			I have read and agree to the Terms and Conditions</p>
			
			<?=form_submit('submit', 'Submit');?>
		<?=form_fieldset_close();?>

</div><!-- end of Content // Begin Footer File-->