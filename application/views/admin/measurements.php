<div class="content" id="admin-measurements">
	<h1 class="title">Measurements Requiring Approval</h1>

	<!-- Review Submissions -->
	<h2>New Vehicle Submissions</h2>
	<?php if(isset($ApproveVehicles) && $ApproveVehicles[0] != '') : ?>	
		<table id="admin">
			<thead><tr>
				<th></th>
				<th>Manufacturer</th>
				<th>Model</th>
				<th>Year</th>
				<th>Contributor</th>
				<td>Options</td>
			</tr></thead>
	
			<tbody>		
				<?php foreach($ApproveVehicles as $vehicle) : ?>
					<tr>
						<td>
							<div class="mask">
								<a class="ext" href="<?=site_url();?>admin/measurements/<?=$vehicle['pk_vehicle_id'];?>">
									<img class="hero" src="<?=base_url() . $vehicle['images'][0];?>"/>
								</a>
							</div>
						</td>
						<td><?=$vehicle['manufacturer'];?></td>
						<td><?=$vehicle['model'];?></td>
						<td><?=$vehicle['year'];?></td>
						<td><a href="mailto: <?=$vehicle['contributor']['email'];?>"><?=$vehicle['contributor']['first_name'] . ' ' . $vehicle['contributor']['last_name'];?></a></td>
						<td>
							<?=form_open('admin/measurements');?>
								<?=form_hidden('pk_vehicle_id', $vehicle['pk_vehicle_id']);?>
								<?=form_hidden('fk_contributor_id', $vehicle['contributor']['pk_contributor_id']);?>
								<div id="approve"><?=form_submit('submit', 'Approve');?></div>
								<div id="delete"><?=form_submit('submit', 'Reject');?></div>
							<?=form_close();?>
						</td>
					</tr>
				<?php endforeach;?>		
			</tbody>
		</table>
	<?php else : ?>
		<p>Nothing awaiting approval.</p>
	<?php endif; ?>
	
	
	<!-- Manage Existing Vehicles -->
	<h2>Existing Vehicles</h2><!-- List all approved vehicles -->
	<?php if(isset($vehicles) && $vehicles[0] != '') : ?>
		<table id="admin">
			<thead><tr>
				<th></th>
				<th>Manufacturer</th>
				<th>Model</th>
				<th>Year</th>
				<th>Contributor</th>
				<th>Options</th>
			</tr></thead>
	
			<tbody>		
				<?php foreach($vehicles as $vehicle) : ?>
					<tr>
						<td>
							<div class="mask">
								<a class="ext" href="<?=site_url();?>measurements/<?=$vehicle['pk_vehicle_id'];?>">
									<img class="hero" src="<?=base_url() . $vehicle['images'][0];?>"/>
								</a>
							</div>
						</td>
						<td><?=$vehicle['manufacturer'];?></td>
						<td><?=$vehicle['model'];?></td>
						<td><?=$vehicle['year'];?></td>
						<td><a href="mailto: <?=$vehicle['contributor']['email'];?>"><?=$vehicle['contributor']['first_name'] . ' ' . $vehicle['contributor']['last_name'];?></a></td>
						<td>
							<?=form_open('admin/measurements');?>
								<?=form_hidden('pk_vehicle_id', $vehicle['pk_vehicle_id']);?>
								<div id="delete"><?=form_submit('submit', 'Delete');?></div>
							<?=form_close();?>
						</td>
					</tr>
				<?php endforeach;?>		
			</tbody>
		</table>
	<?php else : ?>
		<p>No vehicles approved.</p>
	<?php endif; ?>
	
	<!-- Add new manufacturers -->
	<h2>Add New Manufacturer</h2>
	<div id="adminform">
		<?=form_open_multipart('admin/measurements', array('id'=>'add_manu'));?>
			<?=form_label('Manufacturer', 'manu');?>
			<?=form_input(array('name'=>'manu', 'maxlength'=>'20'));?>
			<?=form_submit('submit', 'Add');?>
		<?=form_close();?>
	</div>
</div>