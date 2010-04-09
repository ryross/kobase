<?php echo View::factory('template/header'); ?>

<div id="content">
	

<h1>Log In</h1>

<?php echo form::open(); ?>

<?php if( ! empty($errors)) { ?>
	<div class="errors">
		<h2>Errors</h2>
		<ul>
		<?php foreach($errors as $error) {?>
			<li><?php echo $error ?></li>
		<?php } ?>
		</ul>
	</div>
<?php } ?>
<div class="form-row">
	<?php echo form::label('username') ?>
	<?php echo form::input('username', Arr::get($post, 'user', ''), array('id' => 'username')) ?>
</div>

<div class="form-row">
	<?php echo form::label('password') ?>
	<?php echo form::password('password', Arr::get($post, 'password', ''), array('id' => 'password')) ?>
</div>
<?php echo form::submit('submit', 'Log In') ?>
<?php echo form::close(''); ?>

</div>

<?php echo View::factory('template/footer'); ?>