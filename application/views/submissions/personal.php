<div class="content" id="submit_personal">

	<h1 class="title">Submit Personal Information</h1>

	<?php if(validation_errors()) : ?>
		<div class="errors"><?=validation_errors();?></div>
	<?php endif; ?>
	
	<?=form_open('submit/personal', array('id'=>'submit_general'));?>
		<?=form_fieldset();?>
			<?=form_label('<span>*</span> Email', 'email');?>
			<?=form_input(array('name'=>'email', 'maxlength'=>'50', 'value'=>$email));?>
			
			<?=form_label('<span>*</span> First Name', 'first');?>
			<?=form_input(array('name'=>'first', 'maxlength'=>'30', 'value'=>set_value('first')));?>
		
			<?=form_label('<span>*</span> Last Name', 'last');?>
			<?=form_input(array('name'=>'last', 'maxlength'=>'30', 'value'=>set_value('last')));?>
			
			<?=form_label('<span>*</span> Affiliation', 'affiliation');?>
			<?=form_input(array('name'=>'affiliation', 'maxlength'=>'100', 'value'=>set_value('affiliation')));?>
			
			<?=form_label('City', 'city');?>
			<?=form_input(array('name'=>'city', 'maxlength'=>'30', 'value'=>set_value('city')));?>
			
			<?=form_label('Country', 'country');?>
			<?=form_input(array('name'=>'country', 'maxlength'=>'30', 'value'=>set_value('country')));?>

			<?=form_submit('submit', 'Submit');?>
		<?=form_fieldset_close();?>
	<?=form_close();?><!-- End Personal Form -->

</div><!-- end of Content // Begin Footer File-->