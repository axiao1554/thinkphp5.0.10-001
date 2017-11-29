<?php
namespace app\index\model;
use think\Model;
class Users extends Model
{
	// 类型转换
	protected $type = array(
		'regtime' => 'timestamp:Y-m-d',
		'username' => 'serialize',
	);
	// 自动完成 insert update auto
	// protected $auto = array(
	// 	'sex' => 1,
	// );
	// username读取器
	protected function getUsersStatusAttr($a){
		return "正常";
	}
	protected function getUsernameAttr($a,$object){
		return "username:".$a."++性别：".$object['sex'];
	}
	// regtime写入器
	protected function setRegtimeAttr($a,$object){
		return strtotime($a);
	}

	// 查询范围
	protected function scopeUsername($query){
		$query->where('username','dddd');
		// $query->where('username',$a);
	}
	protected function scopeSex($query){
		$query->where('sex',0);
	}
	//全局查询范围
	// protected static function base($query){
	// 	$query->where('id',7);
	// }

	//模型关联表-------一对多
	public function comm(){
		return $this->hasMany('Comment','uid','id');
	}

	// 模型关联表-------一对一
	public function car(){
		return $this->hasOne('Car','uid','id');
	}
}