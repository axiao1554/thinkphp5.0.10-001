<?php
namespace app\index\model;
use think\Model;
class ShippingArea extends Model{
	public function region(){
		return $this->belongsToMany('Region','area_region','region_id','shipping_area_id');
	}
}