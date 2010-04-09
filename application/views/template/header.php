<div id="header">
	<h1><a href="/">CPRFC Alumni</a></h1>
	<ul id="nav">
		<li><?php echo html::anchor('','Home')?></li>
	
		<?php if (Auth::instance()->logged_in()) { ?>
			<li><?php echo html::anchor('account/', 'My Account')?></li>
			<li><?php echo html::anchor('account/logout', 'Log Out')?></li>
		<?php } else { ?>
			<li><?php echo html::anchor('account/register', 'Register')?></li>
			<li><?php echo html::anchor('account/login', 'Log In')?></li>
		<?php } ?>
	</ul>
</div>