<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"H:\WWW\2\tp5\public/../application/index\view\upload\image.html";i:1511237671;}*/ ?>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post" action="__URL__/up4" enctype="multipart/form-data">
		选择图片文件：<input type="file" name="name">
		选择处理类别：<select name="type">
				<option value="1" selected>图片裁剪</option>
				<option value="2">生成缩略图</option>
				<option value="3">垂直翻转</option>
				<option value="4">水平翻转</option>
				<option value="5">图片旋转</option>
				<option value="6">添加图片水印</option>
				<option value="7">添加文字水印</option>
			</select>	
		<input type="submit" value="提交">
	</form>
</body>
</html>