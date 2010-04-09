<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
	<title><?php echo $title ?></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<?php foreach ($styles as $file) echo HTML::style($file), "\n" ?>
	<?php foreach ($scripts as $file) echo HTML::script($file), "\n" ?>
</head>
<body>
	<div id="page">
		<?php echo $content ?>
	</div>
</body>
</html>