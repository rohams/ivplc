<div id="header">
	<a href="<?=base_url();?>" id="logo">In-Vehicle Power Line Communication Group</a>
	
	<!-- Navigations Links -->
	<ul id="nav">
		<li class="<?=($parent == 'home') ? 'active' : '';?>"><a href="<?=site_url();?>">Home</a></li>
		<li class="<?=($parent == 'group') ? 'active' : '';?>"><a href="<?=site_url();?>group">Group</a></li>
		<li class="<?=($parent == 'publications') ? 'active' : '';?>"><a href="<?=site_url();?>publications">Publications</a></li>
		<li class="<?=($parent == 'measurements') ? 'active' : '';?>"><a href="<?=site_url();?>measurements">Measurements</a></li>
		<li class="<?=($parent == 'submit') ? 'active' : '';?>"><a href="<?=site_url();?>submit">Submit</a></li>
		
		<?php if(isset($admin)) :?>
			<li class="<?=($parent == 'admin') ? 'active' : '';?>"><a href="<?=site_url();?>admin">Admin</a></li>
		<?php else :?>
			<li class="<?=($parent == 'login') ? 'active' : '';?>"><a href="<?=site_url();?>login">Login</a></li>
		<?php endif;?>
	</ul>
</div>