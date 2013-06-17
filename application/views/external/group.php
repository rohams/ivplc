<div class="content" id="groups">

	<!-- List Supervisors -->
	<div id="supervisors">
		<h1 class="title">Supervisors</h1>
		
		<?php foreach($supervisors as $member) : ?>

			<div class="member">
				<div class="mask">
					<img src="<?=base_url() . substr($member['url'],1);?>"/>
				</div>
				
				<div class="info">
					<div class="details">
						<h3><?=$member['name'];?></h3>
						<a href="mailto:<?=$member['email'];?>"><?=$member['email'];?></a></h3>
					</div>
					<p><?=$member['bio'];?></br></p>
				</div>
			</div>
		<?php endforeach;?>
	
	</div>


	<!-- List Research Assistants -->
	<div id="assistants">
		<h1 class="title">Research Assistants</h1>
		
		<?php foreach($assistants as $member) : ?>
			<div class="member">
				<div class="mask">
					<img src="<?=base_url() . substr($member['url'],1);?>"/>
				</div>
				
				<div class="info">
					<div class="details">
						<h3><?=$member['name'];?></h3>
						<a href="mailto:<?=$member['email'];?>"><?=$member['email'];?></a></h3>
					</div>
					<?php if($member['bio']) : ?>
						<p><?=$member['bio'];?></br></p>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach;?>
	</div>
</div>