<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\Data;
use app\index\model\Users;
use app\index\model\UsersLevel;
use app\index\model\Test;
class TestModel extends controller
{
	public function testmodel(){
		// $a = Test::get(6);
		// $a = UsersLevel::get(1);
		// $a = model("UsersLevel");
		// $a = $a->where("id",1)->column("userid");
		// echo "<pre>";
		// print_r($a);
		// print_r($a->toArray());

		// 插入操作
		// $users = new Users;
		// $users->username = 'adai';
		// $users->sex = '1'; 
		// $users->save();
		// 换种方法插入操作
		// $userArr['username'] = 'adai2';
		// $userArr['sex'] = 0;
		// if($result = Users::create($userArr)){
		// 	echo "用户id：{$result->id} 用户姓名：{$result->username} 用户性别：{$result->sex}";
		// }
		// 批量插入
		// $users = new Users;
		// $list = [
		// 	['username' => 'ajian','sex' => 1],
		// 	['username' => 'alin','sex' => 0],
		// ];
		// if($users->saveAll($list)){
		// 	echo "用户批量新增成功";
		// }

		// 查询数据
		// $user = Users::get(1);  //返回对象
		// echo $user->username;
		// echo "<br/>";
		// echo $user['sex']; //因为实现了ArrayAccess接口，可以将对象像数组一样访问
		// 根据某个条件查询数据 getByXxxx()方法
		// $user = Users::getBySex('1');
		// print_r($user['username']);
		// 如果不是根据主键查询，可以传入数组作为查询条件
		// $user = Users::get(['username' => 'axiao','sex' => 1]);
		// $user = Users::where('username','axiao')->find();
		// $user = Users::where(['username' => 'axiao','sex' => 1])->find();
		// echo $user['username'];
		// 如果要查询多个数据，可以使用模型的all方法
		$user = Users::all();
		$a = json_encode($user);
		$b = json_decode($a,true);
		// echo "<pre>";
		// halt($b);

		$this->assign("count",count($b));
		$this->assign("list",$b);
		return $this->fetch();
		// $user = Users::all(['id' => 3]);
		// $user = Users::where('id','>',3)->select();
		// foreach($user as $v){
		// 	echo "id：".$v->id;
		// 	echo "username：".$v->username;
		// 	echo "<br/>";
		// }
		// 对于数据库查询出来的数据更新数据
		// $user = Users::get(3);
		// $user->username = "aaa";
		// // $user->id = null;
		// if(false !== $user->save()){  //$user->isUpdate(false)->save()-------->insert,注意主键id不能重复
		// 	return "更新用户数据成功";
		// }else{
		// 	return $user->getError();
		// }
		// 自己定义数据更新操作
		// $userArr['username'] = 'bbb';
		// Users::update($userArr,['id' => 2]);
		// 删除操作
		// $user = Users::get(1);
		// $user->delete();
		// 或者使用
		print_r(Users::destroy(4));
	}	
	//读取器和写入器
	public function readFun(){
		$user = Users::get(5);
		// echo $user->username;    //自动检测 模型中的函数getUsernameAttr
		$user->regtime = '2016-01-01'; //自动检测 模型中的函数setUsernameAttr
		print_r($user->save());
	}
	// 类型转换
	public function type(){
		$user = Users::get(5);
		// echo $user->regtime;exit;
		$user->regtime = '2017-01-01';
		$user->username = ['aa' => 1];
		$user->save();
		print_r($user->username);
		Users::create(['username' => 'dddd']);
	}
	// 查询范围
	public function find(){
		// $user = Users::scope('username,sex')->select();
		// $a = json_encode($user);
		// $b = json_decode($a,true);
		// echo "<pre>";
		// print_r($b);exit;
		$user = Users::scope('username,sex')
				->order('id','desc')
				->select();
		echo "<pre>";
		print_r($user);
	}
}