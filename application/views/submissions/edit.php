<div class="content" id="user-edit-measurements">
	<h1 class="title">Your Previous Submissions</h1>

	<!-- Review User Submissions -->
	<h2>Edit Submissions</h2>
	<?php if(isset($UserVehicles)) : ?>	
		<table id="admin">
			<thead><tr>
				<th></th>
				<th>Manufacturer</th>
				<th>Model</th>
				<th>Year</th>
				<td>Edit</td>
			</tr></thead>
	
			<tbody>		
				<?php foreach($UserVehicles as $vehicle) : ?>
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
						<td>
							<?=form_open('submissions/edit');?>
								<?=form_hidden('pk_vehicle_id', $vehicle['pk_vehicle_id']);?>
								<?=form_hidden('fk_contributor_id', $vehicle['contributor']['pk_contributor_id']);?>
								<div id="approve"><?=form_submit('submit', 'Approve');?></div>
							<?=form_close();?>
						</td>
					</tr>
				<?php endforeach;?>		
			</tbody>
		</table>
	<?php else : ?>
		<p>No submissions to edit.</p>
	<?php endif; ?>
	

</div>