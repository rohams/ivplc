<div class="content" id="submit_chooser">

	<h1 class="title">Submit Chooser</h1>

	<?php if(isset($message) && $message != '') : ?>
		<h2><?=$message;?></h2>
	<?php else : ?>
		<h2>Welcome back, <?=$name;?>!</h2>
		<h2>What would you like to submit?</h2>
	<?php endif; ?>

	<div id="selections">
		<a id="vehicle" href="<?=site_url();?>submit/edit">
			<span class="text">Edit Previous Submissions</span>
			<span class="icon" id="vehicle"></span>
		</a>
		<a id="vehicle" href="<?=site_url();?>submit/vehicle">
			<span class="text">Submit New Vehicle</span>
			<span class="icon" id="vehicle"></span>
		</a>
		<a id="publication" href="<?=site_url();?>submit/publication">
			<span class="text">Submit Publication</span>
			<span class="icon" id="publication"></span>
		</a>
	</div>

</div><!-- end of Content // Begin Footer File-->