<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"H:\WWW\2\tp5\public/../application/index\view\upload\index.html";i:1511233847;}*/ ?>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post" action="<?php echo url('up3'); ?>" enctype="multipart/form-data">
		<input type="file" name="filename[]">
		<input type="file" name="filename[]">
		<input type="file" name="filename[]">
		<input type="submit" value="提交">
	</form>
</body>
</html>