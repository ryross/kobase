<?php echo View::factory('template/header'); ?>

<div id="content">
	

<h1>Register</h1>

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
	<?php echo form::label('first_name') ?>
	<?php echo form::input('first_name', Arr::get($post, 'first_name', ''), array('id' => 'first_name')) ?>
</div>

<div class="form-row">
	<?php echo form::label('last_name') ?>
	<?php echo form::input('last_name', Arr::get($post, 'last_name', ''), array('id' => 'last_name')) ?>
</div>


<div class="form-row">
	<?php echo form::label('username') ?>
	<?php echo form::input('username', Arr::get($post, 'username', ''), array('id' => 'username')) ?>
</div>

<div class="form-row">
	<?php echo form::label('password') ?>
	<?php echo form::password('password', Arr::get($post, 'password', ''), array('id' => 'password')) ?>
</div>
<?php echo form::submit('submit', 'Register') ?>
<?php echo form::close(''); ?>

</div>

<?php echo View::factory('template/footer'); ?>