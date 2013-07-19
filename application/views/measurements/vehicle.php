<div class="content" id="measurements_vehicle">

<?php if(isset($vehicle) && $vehicle != '') : ?>	
	<!-- Vehicle information -->
	<h1 class="title"><?=$vehicle['manufacturer'] . ' ' . $vehicle['model'] . '&mdash;' . $vehicle['year'];?>
		<span>Submitted By: <?php echo
			$vehicle['contributor']['first_name'] . ' ' .
			$vehicle['contributor']['last_name'] . ', ' .
			$vehicle['contributor']['affiliation'] . ', ' .
			$vehicle['contributor']['country'];
		?></span>
	</h1>
	<!-- Update button -->
	
	
	<!-- Photo Gallery -->
	<div id="slider" class="nivoSlider">
		<?php foreach($vehicle['images'] as $image) : ?>
			<img src="<?=base_url() . $image['url'];?>" width="100%" height="300px" />
		<?php endforeach;?>
	</div>
	
	<!-- Vehicle measurements -->
	<p class="note">Click on a component name to download the associated noise or transfer file.</p>
	
	<div class="data">
		<?php foreach($vehicle['components'] as $component) : ?>
			<div class="component">
				<?php if($component['url'] == NULL) : ?>
					<h3><?=$component['name'];?></h3>
				<?php else : ?>			
					<h3><a href="<?=base_url() . substr($component['url'],1);?>"><?=$component['name'];?></a></h3>
				<?php endif;?>
				
				<ul class="measurements">
					<?php if(isset($vehicle['measurements'])) : foreach($vehicle['measurements'] as $measurement) : ?>
						<?php if($measurement['fk_componentA_id'] == $component['pk_component_id']) : ?>
							<?php if($measurement['url'] != NULL) :?>
							<li><a href="<?=base_url() . substr($measurement['url'],1);?>"><?=$vehicle['components'][$measurement['fk_componentB_id']]['name'];?></a></li>
							<?php endif; ?>
						<?php endif; ?>
					<?php endforeach; endif; ?>
				</ul>
			</div>

		<?php endforeach; ?>
        </div>
        
             <!-- Vehicle manual -->
                <?php if(isset($vehicle['manuals'][0]['url']) && $vehicle['manuals'][0]['url'] != NULL) : ?>          
                    <p class="note">Click on the guideline to download: 
                    <a href="<?=base_url() . substr($vehicle['manuals'][0]['url'],1);?>"><?=$vehicle['manuals'][0]['file_name'];?></a></p>
                <?php else : ?>         
                    <p>No guideline exists.</p>
                <?php endif; ?>
<?php else : ?>

	<p>Vehicle doesn't exist. <a href="<?=site_url();?>measurements">Back</a></p>

<?php endif; ?>
	
</div>