<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:33:"../template/home/user\create.html";i:1511341851;}*/ ?>
<html>
<head>
	<title>用户登录注册2</title>
	<meta content="text/html; charset=utf-8">
</head>
<body>
	<form action="<?php echo url('index/user/add'); ?>" method="post">
		用户名：<input type="text" name="username"><br/>
		sex：<input type="text" name="sex"><br/>
		regtime：<input type="text" name="regtime"><br/>
		email：<input type="text" name="email"><br/>
		birthday：<input type="text" name="birthday"><br/>
		<input type="submit" value="提交">
	</form>
</body>
</html>