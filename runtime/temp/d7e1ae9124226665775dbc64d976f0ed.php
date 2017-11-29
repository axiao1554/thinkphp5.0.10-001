<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"H:\WWW\2\tp5\public/../application/index\view\index\page.html";i:1511229027;}*/ ?>
<h2>用户列表（<?php echo $count; ?>）</h2>
<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
用户名：<?php echo $vo['username']; ?><br/>
性别：<?php echo $vo['sex']; ?><br/>
注册时间：<?php echo $vo['regtime']; ?><br/>
邮箱：<?php echo $vo['email']; ?><br/>
<hr/>
<?php endforeach; endif; else: echo "" ;endif; ?>
<?php echo $list->render(); ?>
<input type="hidden" name="ajaxName" value="<?php echo $ajaxName; ?>">
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
		var name = $("input[name='ajaxName']").val();
		$.get(url,{name:name}, function(result){
			// alert(result);
			$("#page").html(result);
		});
	}
</script>