<?php
namespace app\index\controller;
use think\Image;
use think\Request;
class Upload extends \think\Controller
{
	public function index()
	{
		return $this->fetch();
	}
	// 单文件上传
	public function up(Request $request)
	{
		$file = $request->file("filename");
		// 上传文件验证
		$result = $this->validate(['filename' => $file],['filename' => 'require|image'],['filename.require' => '请选择上传文件','filename.image' => '非法图像文件']);
		if(true !== $result){
			$this->error($result);
		}
		// 移动到应用根目录public/uploads/目录下
		// $info = $file->rule("md5")->move(ROOT_PATH.'public'.DS.'uploads');
		// $info = $file->rule("date")->move(ROOT_PATH.'public'.DS.'uploads');
		// $info = $file->rule(function($file){
		// 	return $file->getInfo('type').date('Y-m-d_H-i-s');
		// })->move(ROOT_PATH.'public'.DS.'uploads');
		// 原文件名保存
		$info = $file->move(ROOT_PATH.'public'.DS.'uploads','');
		if($info){
			$this->success($info->getSaveName().'文件上传成功：'.$info->getRealPath());
		}else{
			$this->error($file->getError());
		}
	}
	// 多文件上传
	public function up3()
	{
		$files = request()->file("filename");
		// echo "<pre>";
		// print_r($files);exit;
		if(empty($files)){
			$this->error('请选择上传文件');
		}
		$item = [];
		foreach($files as $file){
			$result = $this->validate(['filename' => $file],['filename' => 'require|image'],['filename.require' => '请选择上传文件','filename.image' => '非法图像文件']);
			// echo "<pre>";
			// var_dump($result);exit;
			if(true !== $result){
				$this->error($result);
			}
			$info = $file->move(ROOT_PATH.'public'.DS.'uploads');
			if($info){
				$item[] = $info->getRealPath();
			}else{
				$this->error($file->getError());
			}
		}
		$this->success('文件上传成功'.implode('<br/>',$item));
	}

	// 图片处理
	public function image(){
		return $this->fetch();
	}
	public function up4(Request $request){
		$file = $request->file("name");
		if(true !== $this->validate(['name' => $file],['name' => 'require|image'])){
			$this->error("请选择图像文件");
		}else{
			$image = Image::open($file);
			// echo "<pre>";
			// print_r($image);
			// echo $image->width();echo "<br/>";
			// echo $image->height();echo "<br/>";
			// echo $image->type();echo "<br/>";
			// echo $image->mime();echo "<br/>";
			// $size = $image->size();
			// print_r($size);

			/*图片处理*/
			switch($request->param("type")){
				case 1; //图片裁剪（裁剪宽度，裁剪高度，x坐标（默认为0），y坐标（默认0））
					$image->crop(300,300,200,200);
					break;
				case 2; //缩略图（最大宽度，最大高度，裁剪类型）
					$image->thumb(150,150,Image::THUMB_CENTER);
					break;
				case 3; //垂直翻转
					$image->flip();
					break;
				case 4; //水平翻转（垂直翻转Image::FLIP_X=1 水平翻转Image::FLIP_Y=2）
					$image->flip(Image::FLIP_Y);
					break;
				case 5; //图片旋转（顺时针旋转的度数）
					$image->rotate(30);
					break;
				case 6; //图片水印（水印图片，水印位置（常量，默认右下角），水印透明度（默认100））
					$image->water(ROOT_PATH.'public'.DS.'uploads'.DS.'1.png',Image::WATER_NORTHWEST,50);
					break;
				case 7; //文字水印（水印文字，文字字体路径，文字大小，文字颜色，文字写入位置，偏移量，文字倾斜角度）
					$image->text('Axiao',VENDOR_PATH.'topthink/think-captcha/assets/ttfs/1.ttf',50,'#ffffff');
					break;					
			}
			// 保存图片（以当前时间戳）
			$saveName = $request->time().".png";
			$image->save(ROOT_PATH.'public/uploads/'.$saveName);
			$this->success("图片处理完毕...",'./uploads/'.$saveName,1);
		}
	}
}