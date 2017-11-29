<?php
namespace app\index\validate;
use think\Validate;
class Users extends Validate
{
	// 验证规则
	protected $rule = [
		['username','require|min:5','用户名必须|用户名不能短于五个字符'],
		// ['email','email','邮箱格式错误'],
		['email','checkMail:www.baidu.com','邮箱格式错误'],
		['birthday','dateFormat:Y-m-d','生日格式错误'],
	];

	protected function checkMail($value,$rule){
		$result = strstr($value,$rule);
		if($result){
			return true;
		}else{
			return "邮箱必须包含{$rule}域名";
		}
	}
}