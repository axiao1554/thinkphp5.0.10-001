<?php
namespace app\index\model;
use think\Model;
class Region extends Model{
	public function shippingArea(){
		return $this->belongsToMany('ShippingArea','area_region','shipping_area_id','region_id');
	}
	// 写入器
	protected function setParentIdAttr($a,$object){
		return $object["level"].$a;
	}
}