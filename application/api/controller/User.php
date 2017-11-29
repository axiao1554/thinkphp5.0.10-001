<?php
namespace app\api\controller;
use app\index\model\Users;
use think\Controller;
use think\Request;
use think\Db;
use think\Url;
use think\Log;
class User extends Controller
{
	public function test($id=0){
		// $user = Users::get($id);
		// if($user){
		// 	return json(array(
		// 		'status' => 1,
		// 		'msg' => "查询成功",
		// 		'date' => $user, 
		// 	));
		// }else{
		// 	return json(array(
		// 		'status' => -1,
		// 		'msg' => "用户不存在",
		// 		'date' => '', 
		// 	));
		// }


		// 模拟提交测试
		$username = input("post.username");
		$sex = input("post.sex");
		$user = Users::get(['username' => $username,'sex' => $sex]);
		if($user){
			return json(array(
				'status' => 1,
				'msg' => "查询成功",
				'date' => $user, 
			));
		}else{
			return json(array(
				'status' => -1,
				'msg' => "用户不存在",
				'date' => '', 
			));
		}


	}
}