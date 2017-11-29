<?php
namespace app\index\controller;
use think\Controller;
class Captcha extends Controller
{
	// 验证码显示
	public function index(){
		$captcha = new \think\captcha\Captcha();
		$captcha->fontSize = 20;
		$captcha->length   = 4;
		// $captcha->useNoise = false;
		$captcha->fontttf = '6.ttf'; 
		// $captcha->useZh = true;
		// $captcha->codeSet = '0123456789'; 
		// $captcha->useImgBg = true;
		return $captcha->entry();
	}

	// 验证码检测
	public function check($code=''){
		// $captcha = new \think\captcha\Captcha();
		// if(!$captcha->check($code)){
		// 	$this->error("验证码错误");
		// }else{
		// 	$this->success("验证码正确");
		// }

		// 函数助手
		if(!captcha_check($code)){
			$this->error("验证码错误");
		}else{
			$this->success("验证码正确","http://www.baidu.com");
		}
	}
}