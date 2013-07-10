<div class="content" id="user-edit-measurements">
	<h1 class="title">Your Previous Submissions</h1>

	<!-- Review User Submissions -->
	<h2>Edit Submissions</h2>
	<?php if(isset($UserVehicles)) : ?>	
		<table id="user">
			<thead><tr>
				<th></th>
				<th>Manufacturer</th>
				<th>Model</th>
				<th>Year</th>
				<th>Submission Date and Time</th>
				<td>Edit</td>
			</tr></thead>
	
			<tbody>		
				<?php foreach($UserVehicles as $vehicle) : ?>
					<tr>
						<td>
							<div class="mask">
									<img class="hero" src="<?=base_url() . $vehicle['images'][0];?>"/>
								</a>
							</div>
						</td>
						<td><?=$vehicle['manufacturer'];?></td>
						<td><?=$vehicle['model'];?></td>
						<td><?=$vehicle['year'];?></td>
						<td><?=$vehicle['submitted'];?></td>
						<td>
							<?=form_open('submit/edit');?>
								<?=form_hidden('pk_vehicle_id', $vehicle['pk_vehicle_id']);?>
								<?=form_hidden('fk_contributor_id', $vehicle['contributor']['pk_contributor_id']);?>
								<div id="approve"><?=form_submit('submit', 'Edit');?></div>
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