<div class="content"  id="user-edit-measurements">

	<h1 class="title">Edit Vehicle</h1>
        <div class="errors"><?php echo $error;?></div> 
	<?php if(validation_errors()) : ?>
		<div class="errors"><?=validation_errors();?></div>
	<?php endif; ?>
	
	<?=form_open_multipart('submit/edit/'.$vehicle['pk_sub_id'], array('id'=>'submit_general'));?>
	
		<!-- VEHICLE INFORMATION -->
		<?=form_fieldset('Edit Vehicle Information');?>
			<?=form_hidden('fk_contributor_id', $contributor);?>
			
			<?=form_label('<span>*</span> Manufacturer', 'manufacturer');?>
			<?=form_dropdown('manufacturer', $manufacturers, set_value('manufacturer',$vehicle['manufacturer'])); ?>
				
			<?=form_label('<span>*</span> Model', 'model');?>
			<?= form_input(array('name'=>'model', 'maxlength'=>'40', 'value'=> set_value('model',$vehicle['model'])));?>
			
			
			<?=form_label('<span>*</span> Year', 'year');?>
			<?=form_input(array('name'=>'year', 'maxlength'=>'4', 'value'=>set_value('year',$vehicle['year'])));?>
		<?=form_fieldset_close();?>

                <hr>
                <br>
                <a class="deletefile" id="deletefile-1" href="#">Remove File(s)</a>
		<!-- IMAGES -->
		<?=form_fieldset('Images');?>
                        <div class="controls">
                            <a class="add" id="incrementImage" href="#">Add Image</a>
                            <a class="remove" id="decrementImage" href="#">Remove Image</a>
			</div>
                        <p class="note">Remove old files in order to replace them with new files.</p>
			<div class="group" id="images">
				<div class="group_member" id="image1">
					<?=form_label('<span>*</span> Image 1', 'image');?>                                                                                                   
					<?=form_upload(array('name'=>'image[]'));?>
				</div>
			</div>
		<?=form_fieldset_close();?>
                <hr>
                <br>
                <a class="deletefile" id="deletefile-2" href="#">Remove File(s)</a>
		<!-- COMPONENTS -->
		<?=form_fieldset('Components');?>	
			<div class="controls">
				<a class="add" id="incrementComponent" href="#">Add Component</a>
				<a class="remove" id="decrementComponent" href="#">Remove Component</a>
			</div>
						
			<p class="note">Please provide the names of each component, and attach any files associated with that singular point (ie: noise function file).<br> (Remove old files in order to replace them with new files)</p>
			<script>
				var id = <?php echo $id; ?>;
			</script>

			
			<div class="group" id="components">
                         <?php if(isset($vehicle['components'])) : ?>
                            <?php $i=1 ?>
			    <?php foreach($vehicle['components'] as $component) : ?>
					<div class="group_member component" id="component<?=$i;?>">
						<?=form_label('Component ' . $i, 'component_name');?>                                                
                                                <?=form_input(array('name'=>'component_name[]', 'maxlength'=>'20', 'value'=>set_value('component_name[]', $component['name'])));?>
                                                <?php if($component['url'] != NULL) : ?>
                                                    <span id="cfile_<?=$i;?>">
                                                        "<input type="checkbox" id="<?=$i;?>" name="delete2"><a href="<?=base_url() . substr($component['url'],1);?>"><?=$component['file_name'];?></a>
                                                        <?=form_hidden('orig_component_id[]', $component['pk_component_id']);?>
                                                    </span>
                                                <?php else : ?>
                                                    <?=form_upload(array('name'=>'component[]'));?>
                                                <?php endif;?>
					</div>
                                <?php $i++ ?>
                            <?php endforeach;?>
                           <?php else : ?>
                            <?php for($i = 1; $i <= $id+1; $i++) :?>
					<div class="group_member component" id="component<?=$i;?>">
						<?=form_label('Component ' . $i, 'component_name');?>
						<?=form_input(array('name'=>'component_name[]', 'maxlength'=>'20', 'value'=>set_value('component_name[]')));?>
						<?=form_upload(array('name'=>'component[]'));?>
					</div>
			    <?php endfor;?>
                           <?php endif ?>
                            
			</div>
		<?=form_fieldset_close();?>
                        
                <hr>
                <br>
                <a class="deletefile" id="deletefile-3" href="#">Remove File(s)</a>
		<!-- MEASUREMENTS -->
		<?=form_fieldset('Measurements');?>
			<p class="note">Please attach the s-parameter files associated between the two referenced points.<br> (Remove old files in order to replace them with new files)</p>
			
			<div id="measurements">
                            <?php $index = 0 ?>
                            <?php for($i = 1; $i <= $id+1; $i++) :?>
				<div class="measurement" id="measurement<?php echo $i ?>">
                                        <h2 class="measurement<?php echo $i ?>"><?php echo 'Component ' . $i ?></h2>
                                        <?php for($j = $i+1; $j <= $id+2; $j++) :?>
                                            <?php $index++ ?>
                                            <div class="reference" id="r<?php echo $index ?>">
                                                <?php if($vehicle['ni_measurements'][$j-$i-1]['url'] != NULL) : ?>
                                                        <?=form_label('Component ' . $j, 'measurement[]', array('class'=>'component' . $j));?>
                                                        <span id="mfile_<?=$index;?>">            
                                                            "<input type="checkbox" id="<?=$index;?>" name="delete3"><a href="<?=base_url() . substr($vehicle['ni_measurements'][$j-$i-1]['url'],1);?>"><?=$vehicle['ni_measurements'][$j-$i-1]['file_name'];?></a>
                                                            <?=form_hidden('orig_measurement_id[]', $vehicle['ni_measurements'][$j-$i-1]['pk_measurement_id']);?>
                                                        </span>
                                                    <?php else : ?>
                                                        <?=form_label('Component ' . $j, 'measurement[]', array('class'=>'component' . $j));?>
                                                        <?=form_upload(array('name'=>'measurement[]'));?>
                                                    <?php endif;?>
                                            </div>
                                        <?php endfor;?>
				</div>
                            <?php endfor;?>
			</div>
		
		<?=form_fieldset_close();?>
	
	
		<!-- TERMS AND CONDITIONS -->
		<?=form_fieldset('Terms and Conditions');?>
			<div class="clear"></div>
			<p id="terms">I am the owner of the submitted content, and hereby grant the IVPLC Group of UBC permission to display the submitted content on the IVPLC Group website. If I am not the legal owner of the content, I take on full liability and accept all responsibility and penalty for any infringement that ensues.</p>
			<p id="confirm">
			<?=form_checkbox('agreement', 'agree', set_value('agreement'));?>
			I have read and agree to the Terms and Conditions</p>
			<div id="submitb"><?=form_submit('submit', 'Submit');?></div>
			<div id="cancelb"><?=form_submit('submit', 'Cancel');?></div>
                        <br style="clear: left;" />
		<?=form_fieldset_close();?>

</div><!-- end of Content // Begin Footer File-->