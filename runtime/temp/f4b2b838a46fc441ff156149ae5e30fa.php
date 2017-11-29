<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:63:"H:\WWW\2\tp5\public/../application/index\view\index\test23.html";i:1511229019;s:57:"H:\WWW\2\tp5\public/../application/index\view\layout.html";i:1510110587;s:63:"H:\WWW\2\tp5\public/../application/index\view\index\header.html";i:1511147044;s:63:"H:\WWW\2\tp5\public/../application/index\view\index\footer.html";i:1505121235;}*/ ?>
<html>
<head>
	<title>这是第23个例子</title>
	<!-- <link rel="stylesheet" type="text/css" href="__PUBLIC__/index.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo url('/static/index.css','',''); ?>"> -->
	<link rel="stylesheet" type="text/css" href="__STATIC__/index.css">
	<script type="text/javascript" src="__STATIC__/jquery-1.8.3.min.js"></script>
</head>
<body>
	头部模块
	<!--  --><!-- config中开启layout可以去掉这行代码 -->   <!--  --><!-- 不需要调用时输出这行代码 -->
<html>
<head>
	<title>这是第23个例子</title>
	<!-- <link rel="stylesheet" type="text/css" href="__PUBLIC__/index.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo url('/static/index.css','',''); ?>"> -->
	<link rel="stylesheet" type="text/css" href="__STATIC__/index.css">
	<script type="text/javascript" src="__STATIC__/jquery-1.8.3.min.js"></script>
</head>
<body>
	头部模块
	<!-- <form action="#" method="get"> -->
		<input type="text" name="name" <?php if($getname): ?>value="<?php echo $getname; ?>"<?php endif; ?>>
		<input type="button" onclick="search()" value="搜索">
	<!-- </form> -->
	<div id="page">
		<h2>用户列表（<?php echo $count; ?>）</h2>
		<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
		用户名：<?php echo $vo['username']; ?><br/>
		性别：<?php echo $vo['sex']; ?><br/>
		注册时间：<?php echo $vo['regtime']; ?><br/>
		邮箱：<?php echo $vo['email']; ?><br/>
		<hr/>
		<?php endforeach; endif; else: echo "" ;endif; ?>
		<?php echo $list->render(); ?>
		<script type="text/javascript">
			// ajax分页
			$(".pagination a").click(function(){
				var url=$(this).attr("href");
				if(url){
					getPage(url);
				}
				return false;
			});
			function getPage(url){
				$.get(url, function(result){
					// alert(result);
					$("#page").html(result);
				});
			}
		</script>
	</div>
	底部模块
</body>
</html>
<script type="text/javascript">
	// function search(){
	// 	var name = $("input[name='name']").val();
	// 	if(name){
	// 		window.location.assign("/test23Search/"+name);
	// 	}else{
	// 		window.location.assign("/test23");
	// 	}
	// }
</script>
<!-- ajax搜索 -->
<script type="text/javascript">
	function search(){
		var name = $("input[name='name']").val();
		$.post("/test23",{name:name},function(a){
			$("#page").html(a);
		})
	}
</script>
	底部模块
</body>
</html>