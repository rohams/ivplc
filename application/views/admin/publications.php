<div class="content" id="admin-publications">

	<h1 class="title">Publications Administration</h1>

	<!-- List all unapproved publications-->
	<h2>New Publication Submissions</h2>
	<?php if(isset($ApprovePublications) && $ApprovePublications[0] != '') : ?>
	
		<table id="admin">
			<thead><tr>
				<th>Contributor</th>
				<th>Title</th>
				<th>Publisher</th>
				<th>Publication Year</th>
				<th>Authors</th>
				<th>Decision</th>
			</tr></thead>
	
			<tbody>		
				<?php foreach($ApprovePublications as $pub) : ?>
					<tr>
						<td>
							<p><a href="mailto:<?=$pub['contributor']['email'];?>"><?=$pub['contributor']['first_name'];?> <?=$pub['contributor']['last_name'];?></a></p>
						</td>
						<td>
							<a class="ext" href="<?=$pub['url'];?>"><!-- publication URL -->
							<p><?=$pub['title'];?></p> <!-- Title -->
							</a>
						</td>
						<td><p>
							<?=$pub['affiliation'];?></br>
						</p></td><!-- Publisher-->
						
						<td><p>
							<?=$pub['date'];?>
						</p></td><!-- Date of publication -->
						
						<td><p>
							<?=implode($pub['authors'], ', ');?>
						</p></td><!-- Authors -->
						<td>
						<?=form_open('admin/publications');?>
							<?=form_hidden('pk_pub_id', $pub['pk_pub_id']);?>
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
	
	<!-- List all approved publications -->
	<h2>Existing Publications</h2>
	<?php if(isset($publications) && $publications[0] != '') : ?>
	
		<table id="admin">
			<thead><tr>
				<th>Contributor</th>
				<th>Title</th>
				<th>Publisher</th>
				<th>Publication Year</th>
				<th>Authors</th>
				<th>Delete</th>
			</tr></thead>
	
			<tbody>		
				<?php foreach($publications as $pub) : ?>
					<tr>
						<td>
							<p><a href="mailto:<?=$pub['contributor']['email'];?>"><?=$pub['contributor']['first_name'];?> <?=$pub['contributor']['last_name'];?></a></p>
						</td>
						<td>
							<a class="ext" href="<?=$pub['url'];?>"><!-- publication URL -->
							<p><?=$pub['title'];?></p> <!-- Title -->
							</a>
						</td>
						<td><p>
							<?=$pub['affiliation'];?></br>
						</p></td><!-- Publisher-->
						
						<td><p>
							<?=$pub['date'];?>
						</p></td><!-- Date of publication -->
						
						<td><p>
							<?=implode($pub['authors'], ', ');?>
						</p></td><!-- Authors -->
						<td>
						<?=form_open('admin/publications');?>
							<?=form_hidden('pk_pub_id', $pub['pk_pub_id']);?>
							<div id="delete"><?=form_submit('submit', 'Delete');?></div>
						<?=form_close();?>
						</td>
					</tr>
				<?php endforeach;?>		
			</tbody>
		</table>
	<?php else : ?>
	
		<p>No publications approved.</p>
	
	<?php endif; ?>
	
</div>