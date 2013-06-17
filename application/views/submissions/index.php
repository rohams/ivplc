<div class="content" id="submit_index">

	<h1 class="title">Submit</h1>

	<p>The In-Vehicle Power Line Communication Group at UBC invites you and your organization to contribute to the IVPLC database.</p>

	<p>Please have the following items prepared:</p>

	<ul>
		<li>The vehicle manufacturer, model, and year</li>
		<li><b>(Optional)</b> Images of your vehicle (JPG, GIF or PNG)</li>
		<li>Component noise files (ZIP, MATLAB, or Excel)</li>
		<li>Related component transfer function files (ZIP, MATLAB, or Excel)</li>
		<li>
			<b>(Optional)</b> The URLs to any publications you have authored which relates to the IVPLC research.
			<i>You must have submitted a vehicle in order to submit a publication.</i>
		</li>
	</ul>

	<p>All submissions are reviewed by Lutz Lampe and Roberto Rosales, please allow 5 to 7 days for a response.</p>

	<?=form_open('submit');?>
		<?=form_label('To begin, please enter your email:', 'email');?>
		<?=form_input(array('name'=>'email', 'maxlength'=>'50'));?>
		<?=form_submit('submit', 'Begin');?>
	<?=form_close();?>

</div>