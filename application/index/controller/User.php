<?php
namespace app\index\controller;
use app\index\model\Users;
use app\index\model\Comment;
use think\Controller;
use think\Validate;
class User extends Controller
{
	public function create(){
		// return view();
		return view('user/create');
	}
	// 验证validate所有规则
	// public function add(){
	// 	$users = new Users;
	// 	if($users->allowField(true)->validate(true)->save(input('post.'))){  // allowField过滤post数组中的非数据表字段数据
	// 		return "用户".$users->username.":".$users->id;
	// 	}else{
	// 		return $users->getError();
	// 	}
	// }
	// 单独验证某字段
	public function add(){
		$data = input('post.');
		// 验证birthday是否有效的日期---》其他格式可以查看Validate类
		$check = Validate::is($data['birthday'],'date');
		if(false === $check){
			return 'birthday日期格式非法';
		}
		$users = new Users;
		$users->allowField(true)->save($data);
		return "用户".$users->username.":".$users->id;
	}

	//模型关联表-------一对多-------->多对多在(index->test20)
	public function test(){
		// $user = Users::get(4);
		// // echo $user->username.'<br/>';
		// // $user->comm;   //集合
		// $a = json_encode($user->comm);
		// $b = json_decode($a,true);
		// echo "<pre>";
		// print_r($b);exit;
		// foreach($user->comm as $comm){
		// 	echo "评论人id：".$comm['uid'].'评论内容：'.$comm['content'].'<br/>';
		// }

		// $user = Users::where("id",">",3)->select();
		// foreach($user as $v){
		// 	$a = json_encode($v->comm);
		// 	$b = json_decode($a,true);
		// 	echo "<pre>";
		// 	print_r($b);
		// }exit;

		// //执行关联的comm对象的查询，获取user对象的comm关联对象
		// $comm = $user->comm()->where('content','很好！')->find();
		// echo "id：".$comm->comm_id.'评论内容：'.$comm->content.'<br/>';
		// print_r($comm->toArray());

		// 一对多关联新增
		// $user = Users::get(7);
		// $comment = new Comment;
		// $comment->content = "tp5测试！";
		// $comment->addtime = time();
		// $user->comm()->save($comment);
		// return "新增评论成功！";

		// 一对多批量新增
		// $user = Users::get(8);
		// $comm = [
		// 	['content'=>'test111','addtime'=>time()],
		// 	['content'=>'test222','addtime'=>time()],
		// ];
		// $user->comm()->saveAll($comm);
		// return "批量新增评论成功！";

		// $user = Users::get(4,'comm');
		// echo "<pre>";
		// print_r($user->comm);

		// $user = Users::get(4);
		// $comm = $user->comm()->getByContent("tp5测试！");
		// print_r($comm->toArray());
		// echo "评论id：".$comm->id.'评论内容：'.$comm->content.'<br/>';


		//根据关联数据来查询当前模型数据
		// 查询有评论过的用户列表
		// $user = Users::has('comm')->select();
		// 查询评论过两次以上的用户
		// $user = Users::has('comm','>=',2)->select();
		// 查询评论内容有“tp5测试！”的用户
		// $user = Users::hasWhere('comm',['content'=>'tp5测试！'])->select();
		// $a = json_encode($user,JSON_UNESCAPED_UNICODE);
		// $b = json_decode($a,true);
		// echo "<pre>";
		// print_r($b);

		// 关联更新（更新第一条content = mmmmm2）
		// $user = Users::get(4);
		// $comm = $user->comm()->getByContent("mmmmm2");
		// // echo "<pre>";
		// // print_r($comm->toArray());exit;
		// $comm->content = 'mmmmm1';
		// $comm->save();

		// 查询构造器的update方法进行更新(更新全部content = mmmmm1)
		// $user = Users::get(4);
		// $user->comm()->where("content","mmmmm1")->update(["content"=>"mmmmm2"]);

		// 删除部分关联数据
		// $user = Users::get(4);
		// $comm = $user->comm()->getByContent("mmmmm1");
		// $comm->delete();

		// 删除所有的关联数据
		// $user = Users::get(4);
		// $user->comm()->where("content",'test222')->delete();

		// =======================================================
		// 关联一对一
		// 新增用户关联汽车
		// $user = new Users;
		// $user->username = "cmd";
		// $user->sex = 1;
		// $user->regtime = time();
		// $user->email = "2@qq.com";
		// $user->birthday = "2017-09-09";
		// if($user->save()){
		// 	$car['brand'] = "宝马";
		// 	$car['plate_number'] = "晋M12345";
		// 	$user->car()->save($car);
		// 	return "用户：".$user->username."新增成功";
		// }else{
		// 	return $user->getError();
		// }

		// 查询
		// $user = Users::get(33);
		// echo "用户：".$user->username."汽车品牌：".$user->car->brand."车牌号：".$user->car->plate_number;

		// 关联更新
		// $user = Users::get(33);
		// // echo "<pre>";;
		// // print_r($user->toArray());exit;
		// $user->regtime = "2017";
		// if($user->save()){
		// 	$user->car->plate_number = "晋M33333";
		// 	$user->car->save();
		// 	return "用户：".$user->username."更新成功";
		// }else{
		// 	return $user->getError();
		// }

		// // 关联删除
		$user = Users::get(33);
		if($user->delete()){
			$user->car->delete();
			return "删除成功";
		}else{
			return $user->getError();
		}
	}
}