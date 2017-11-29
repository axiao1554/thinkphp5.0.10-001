<?php
namespace app\index\model;
use think\Model;
class Test extends Model
{
	//设置数据表，不含前缀
	protected $name = "data";
	// 设置完整的数据表，包含前缀
	protected $table = "tp_data";
}