<div class="content" id="login">

	<h1 class="title">Administrator Login</h1>

	<?=form_open('external/login' );?>
		<?=form_label('Email', 'email');?>
		<?=form_input('email', '');?>
		
		<?=form_label('Password', 'password');?>
		<?=form_password('password', '');?>	
		
		<?=form_submit('submit', 'Login');?>			
	<?=form_close();?>
		
</div>