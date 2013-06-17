<?php include('header.php'); ?>

<?php $manufacturers = array('Acura','Audi', 'BMW', 'Buick', 'Cadilac', 'Cheverolet', 'Chrysler', 'Dodge', 'Eagle', 'Ferrari', 'Ford', 'GM', 'Honda', 'Hummer', 'Hyundai', 'Infiniti', 'Isuzu', 'Jaguar', 'Jeep', 'Kia', 'Lamborghini', 'Land Rover', 'Lexus', 'Lincoln', 'Lotus', 'Mazda', 'Mercedes', 'Mercury', 'Mitsubishi', 'Nissan', 'Oldsmobile', 'Peugeot', 'Pontiac', 'Porsche', 'Regal', 'Saab', 'Saturn', 'Subaru', 'Suzuki', 'Toyota', 'Volkswagen', 'Volvo'); ?>

<div class="main">
	<div id="content">
	
		<div id="browser">
			<ul class="column" id="manufacturer">
				<?php foreach($manufacturers as $key => $manufacturer): ?>
					<li><a id="manufacturer_<?=$key;?>" href="#"><span class="logo"></span><?=$manufacturer;?></a></li>
				<?php endforeach;?>
			</ul>
			<ul class="column" id="model">
				<?php for($i=0;$i<20;$i++): ?>
					<li><a id="model_<?=$i;?>" href="#">Previa <?=$i;?></a></li>
				<?php endfor;?>
			</ul>
			<ul class="column" id="year">
				<?php for($i=2012;$i>1979;$i--): ?>
					<li><a id="year_<?=$j++;?>" href="#"><?=$i;?></a></li>
				<?php endfor;?>
			</ul>
		</div>

	</div><!-- end content -->
</div><!-- end main -->