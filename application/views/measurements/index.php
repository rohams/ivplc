<div class="content" id="measurements_index">

	<h1 class="title">Measurements</h1>

	<?php if(isset($manufacturers) && $manufacturers != '') : foreach($manufacturers as $manufacturer) : ?>
		<h2 class="manufacturer"><?=$manufacturer;?></h2>

		<?php foreach($vehicles as $vehicle) : ?>		
			<?php if($vehicle['manufacturer'] == $manufacturer) : ?>
				<a class="vehicles ext" href="<?=site_url();?>measurements/<?=$vehicle['pk_sub_id'];?>">
					<div class="mask">
						<?php if($vehicle['images'][0]['url'] != null) : ?>
							<img class="hero" src="<?=base_url() . $vehicle['images'][0]['url'];?>"/>
						<?php else : ?>
							<img class="hero" src="<?=base_url();?>resources/styles/images/car.png"/>
						<?php endif; ?>
					</div>
					
					<p class="model"><?=$vehicle['manufacturer'] . ' ' . $vehicle['model'];?></p>
					<p class="year"><?=$vehicle['year'];?></p>
				</a>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endforeach; endif; ?>
	
</div>