<div class="content" id="publications">
	<h1 class="title">Publications</h1>

	<?php foreach($publications as $pub) : ?>	
		<a class="publication ext" href="<?=$pub['url'];?>">
			<div class="icon"></div>

			<h3><?=$pub['title'];?></h3>
			
			<p class="affiliation"><?=$pub['affiliation'];?> &mdash; Published: <?=$pub['date'];?></p>
	
			<p class="author"><?=implode($pub['authors'], ', ');?></p>
		</a>
	<?php endforeach;?>
</div>