<div class="content" id="submit_publication">
	
	<h1 class="title">Submit Publication</h1>
	
	<?php if(validation_errors()) : ?>
		<div class="errors"><?=validation_errors();?></div>
	<?php endif; ?>
	
	<?=form_open('submit/publication', array('id'=>'submit_general'));?>
	
		<!-- PUBLICATION INFORMATION -->
		<?=form_fieldset('Publication Information');?>
			<?=form_hidden('fk_contributor_id', $contributor);?>
			
			<?=form_label('<span>*</span> Title', 'title');?>
			<?=form_input(array('name'=>'title', 'maxlength'=>'100', 'value'=>set_value('title')));?>
			
			<?=form_label('Publisher', 'affiliation');?>
			<?=form_input(array('name'=>'affiliation', 'maxlength'=>'100', 'value'=>set_value('affiliation')));?>
			
			<?=form_label('Publication Year', 'date');?>
			<?=form_input(array('name'=>'date', 'maxlength'=>'4', 'value'=>set_value('date')));?>
			
			<?=form_label('<span>*</span> URL', 'url');?>
			<?=form_input(array('name'=>'url', 'maxlength'=>'400', 'value'=>set_value('url')));?>
		<?=form_fieldset_close();?>


		<!-- AUTHORS -->
		<?=form_fieldset('Authors');?>
			<div class="controls">
				<a class="add" id="incrementAuthor" href="#">Add Author</a>
				<a class="remove" id="decrementAuthor" href="#">Remove Author</a>
			</div>
			
			<div class="clear"></div>
			
			<div class="group" id="authors">
				<div class="group_member" id="author1">
					<?=form_label('<span>*</span> First Initial', 'author_first[]');?>
					<?=form_input(array('name'=>'author_first[]', 'maxlength'=>'1', 'value'=>set_value('author_first[]')));?>
					
					<?=form_label('<span>*</span> Last', 'author_last[]');?>
					<?=form_input(array('name'=>'author_last[]', 'maxlength'=>'30', 'value'=>set_value('author_last[]')));?>
				</div>
			</div>
		<?=form_fieldset_close();?>
		
		<!-- RELATED VEHICLES -->
		
	
	
		<!-- TERMS AND CONDITIONS -->
		<?=form_fieldset('Terms and Conditions');?>
			<div class="clear"></div>
			<p id="terms">I am the owner of the submitted content, and hereby grant the IVPLC Group of UBC permission to display the submitted content on the IVPLC Group website. If I am not the legal owner of the content, I take on full liability and accept all responsibility and penalty for any infringement that ensues.</p>

			<?=form_checkbox('agreement', 'agree', set_value('agreement'));?>
			<p id="confirm">I have read and agree to the Terms and Conditions</p>
			
			<?=form_submit('submit', 'Submit');?>
		<?=form_fieldset_close();?>
		
	<?=form_close();?><!-- End Publication Form -->
</div><!-- end of Content // Begin Footer File-->