<div class="content" id="admin-group">
	
	<h1 class="title">Group Information <a href="#" id="add">Add</a></h1>	
	
	<div id="adminform"><?=form_open_multipart('admin/group', array('id'=>'add_member', 'class'=>'hidden'));?>
		<?=form_label('Photo', 'photo');?>
		<?=form_upload(array('name'=>'photo'));?>
	
		<?=form_label('Name', 'name');?>
		<?=form_input(array('name'=>'name', 'maxlength'=>'30'));?>
			
		<?=form_label('email', 'email');?>
		<?=form_input(array('name'=>'email', 'maxlength'=>'40'));?>
		
		<?=form_label('Biography', 'bio');?>
		<div id="bio""><?=form_textarea(array('name'=>'bio', 'rows'=>'10', 'cols'=>'40'));?></div>
		
			<?=form_label('Supervisor', 'type');?>
			<?=form_radio('type', '1', TRUE);?>
			<?=form_label('Assistant', 'type');?>
			<?=form_radio('type', '0');?>
		
		<?=form_label('Password', 'password');?>		
		<?=form_password('password', '');?>
		
		<?=form_submit('submit', 'Add');?>
	<?=form_close();?></div>
	
	<div id="admin">
		<table id="admin">
			<thead><tr>
				<th>Photo</th>
				<th>Name</th>
				<th>email</th>
				<th>Biography</th>
				<th>Options</th>
			</tr></thead>
			<tbody>
			
			<?php foreach($supervisors as $member) : ?>	
				<tr>
					<td><!-- Member Image -->
						<img src="<?=base_url() . substr($member['url'],1);?>"/>
					</td>
					<td><!-- Member name -->
						<p><?=$member['name'];?></p>
					</td>
					<td><!-- email -->
						<p><a href="mailto:<?=$member['email'];?>"><?=$member['email'];?></a></p>					
					</td>
					<td><!-- Member Bio -->	
						<p><?=$member['bio'];?></br></p>
					</td>
					<td><!-- Options -->
						<?=form_open('admin/group');?>
							<?=form_hidden('pk_group_id', $member['pk_group_id']);?>
							<div id="delete"><?=form_submit('submit', 'Delete');?></div>
						<?=form_close();?>
					</td>
				</tr>
			<?php endforeach;?>
			
			<?php foreach($assistants as $member) : ?>
				<tr>
					<td><!-- Member Image -->
						<img src="<?=base_url() . substr($member['url'],1);?>"/>
					</td>
					<td><!-- Member name, email -->
						<p><?=$member['name'];?></p>
					</td>
					<td><!-- email -->
						<p><a href="mailto:<?=$member['email'];?>"><?=$member['email'];?></a></p>					
					</td>
					<td><!-- Member Bio -->	
					<p><?=$member['bio'];?></br></p>
					</td>
					<td><!-- Options -->
						<?=form_open('admin/group');?>
							<?=form_hidden('pk_group_id', $member['pk_group_id']);?>
							<div id="delete"><?=form_submit('submit', 'Delete');?></div>
						<?=form_close();?>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
	</div><!-- END DIV GROUP -->
	
</div>