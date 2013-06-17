<div class="content" id="adminHome">

	<h1 class="title">Administrator</h1>
	<div id="admin">
		<div id="selections">
			<a id="vehicle" href="<?=site_url();?>admin/measurements">
				<span class="text">Admin Measurements &mdash; <b><?=$vehicles_count;?></b></span>
				<span class="icon" id="vehicle"></span>
			</a>
			
			<a id="publication" href="<?=site_url();?>admin/publications">
				<span class="text">Admin Publications &mdash; <b><?=$publications_count;?></b></span>
				<span class="icon" id="publication"></span>
			</a>
			
			<a id="group" href="<?=site_url();?>admin/group">
				<span class="text">Admin Group</span>
				<span class="icon" id="group"></span>
			</a>
		</div>
	</div>
</div>