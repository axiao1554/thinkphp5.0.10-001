<?php
namespace app\index\controller;
use app\index\model\Users;
use app\index\model\Data;
use app\index\model\Region;
use app\index\model\ShippingArea;
use org\util\TestExtend;
use app\common\util\Myclass;
use think\Controller;
use think\Request;
use think\Db;
use think\Url;
use think\Log;
use think\Session;
class Index extends Controller
{
    // public function __construct(){
    //     parent::__construct();
    //     $this->view->replace(['__PUBLIC__' => '/static',]);
            /*
                [replace:protected] => Array
                (
                    [__ROOT__] => 
                    [__URL__] => /index/index
                    [__STATIC__] => /static
                    [__CSS__] => /static/css
                    [__JS__] => /static/js
                )
            */
    // }
	/*连接数据库*/
    public function index($name="lisi")
    {
    	// print_r($this->request->param());
    	$data = Db::name("users")->where("username","cmd")->find();
    	// echo "<pre>";
    	// print_r($data);
    	$this->assign("name",$name);
    	$this->assign("data",$data);
        // echo "<pre>";
        // print_r($this->view);exit;
        // echo $this->request->module();exit;         //获取当前模块名字
        // echo request()->controller();exit;       //获取当前控制器名字
        // echo request()->action();exit;           //获取当前方法名字
    	return $this->fetch();
    }
    /*request获取传参*/
    public function hello($name="world"){
    	echo "hello:".$name."<br/>";
    	print_r($this->request->param());
    }
    /*url路由*/
    public function today($year="2017",$month="09"){
    	echo "今天是".$year."年".$month."月";
    }
    /*输出url*/
    public function url(){
        echo url().'<br/>';
    	echo Url::build('url2','a=1&b=2')."<br/>";
    	echo url("url2",'a=1&b=2').'<br/>';
    	echo url('admin/index/url2','a=1&b=2').'<br/>';
    	echo url('today/2017/09','a=1&b=2').'<br/>';
    	echo url('admin/HelloWorld/aaa','a=1&b=2');
    }
    /*request请求*/
    public function hello2(){
    	$request = Request::instance();          //不继承控制器需要这样实例化
    	echo $request->url();      //获取当前url地址，不含域名
    	echo "<br/>";
    	echo $this->request->url();
    	echo "<br/>";
    	$this->request->bind('username','张三');    //动态绑定属性
    	echo $this->request->username;
    	echo "<br/>";
    	echo request()->url();    //为了简洁  方便可以使用  函数助手
    	echo "<br/>";
    	/*请求变量信息*/
    	print_r($request->param());
    	echo "<br/>";
    	echo $request->param('name');
    	echo "<br/>";
    	print_r(input());     //为了简洁  方便可以使用  函数助手
    	echo "<br/>";
    	echo input('name');
    	echo "<br/>";
    	/*param方法支持变量的过滤和默认值*/
    	echo $request->param('enname','jakE','strtolower');
    	echo "<br/>";
    	/*指定获取参数*/
    	print_r($request->get());
    	echo "<br/>";
    	print_r($request->get('name'));
    	echo "<br/>";
    	print_r($request->post('name'));
    	echo "<br/>";
    	print_r($request->cookie(''));
    	echo "<br/>";
    	print_r($request->file('image'));
    	echo "<br/>";
    	/*input获取参数*/
    	print_r(input('get.'));
    	echo "<br/>";
    	print_r(input('get.name'));
    	echo "<br/>";
    	print_r(input('post.'));
    	echo "<br/>";
    	print_r(input('cookie.'));
    	echo "<br/>";
    	print_r(input('file.image'));
    	echo "<br/>";
    	/*request其他参数*/
    	echo "=====request其他参数====================<br/>";
    	echo "请求方法：".$request->method()."<br/>";
    	echo "访问ip：".$request->ip()."<br/>";
    	echo "是否ajax请求：" .($request->isAjax()?'是':'否')."<br/>";
    	echo "当前域名：".$request->domain()."<br/>";
    	echo "当前入口文件：".$request->baseFile()."<br/>";
    	echo "包含域名的完整url地址：".$request->url(true)."<br/>";
    	echo "url地址的参数信息：".$request->query()."<br/>";
    	echo "当前url地址  不含QUERY_STRING：".$request->baseUrl()."<br/>";
    	echo "url地址中的pathinfo信息：".$request->pathinfo()."<br/>";
    	echo "url地址中的后缀信息：".$request->ext()."<br/>";
    	/*request当前模块/控制器/操作信息*/
    	echo "=====request当前模块/控制器/操作信息=======<br/>";
    	echo "模块：".$request->module()."<br/>";
    	echo "控制器：".$request->controller()."<br/>";
    	echo "方法：".$request->action()."<br/>";
    }
    /*response响应*/
    public function hello3(){
    	$data = ['name'=>'axiao','age'=>20];
    	// return $data;
    	// return json($data);
    	// return json($data,201);
    	// return xml($data);
    	// $this->success("正确的跳转","hello2");
    	// $this->error("错误页面提示","/hello2");
    	$this->redirect('/hello2');
    }
    /*数据库操作*/
    public function hello5(){
    	// $result = Db::query('select * from tp_users where user_id=1');
    	// echo "<pre>";
    	// print_r($result);
    	// $result = Db::query('show tables from php02');
    	// echo "<pre>";
    	// print_r($result);
    	// $result = Db::execute('insert into tp_test (id,name,pid,path) values (,"童装",2,"3,")');
    	// print_r($result);

        /*连接多个数据库，在config.php中加配置*/
    	// $result = Db::connect('db2')->query('select * from type');
    	// echo "<pre>";
    	// print_r($result);

    	/*参数绑定*/
    	// Db::execute('insert into tp_test(id,name,pid,path) values(?,?,?,?)',[,"童装",2,"3,"]);
    	// $result = Db::query('select * from tp_users where id=?',[3]);
    	// print_r($result);
    	/*命名占位符绑定*/
    	// Db::execute('insert into tp_test(id,name,pid,path) values(:id,:name,:pid,:path)',['id'=>,'name'=>"童装",'pid'=>2,'path'=>"3,"]);
    	// $result = Db::query('select * from tp_users where id=:id',['id'=>3]);
    	// print_r($result);

    	/*查询构造器*/
    	// 插入记录
    	// Db::table('tp_data')->insert(['id'=>1,'name'=>'thinkphp','status'=>1]);
    	// Db::name('data')->insert(['id'=>2,'name'=>'thinkphp','status'=>1]);
    	// 更新记录
    	// Db::table('tp_data')->where('id',1)->update(['name'=>'hellotp5']);
    	// 查询数据
    	// $result = Db::table('tp_data')->where('id',1)->find();
    	// $result = Db::name('data')->where('id',1)->find();
    	// print_r($result);
    	// 删除数据
    	// Db::table('tp_data')->where('id',1)->delete();
    	// 链式操作
    	// $result = Db::name('data')
    	// 		->where('status',1)
    	// 		->field('id,name')
    	// 		->order("id","desc")
    	// 		->limit(10)
    	// 		->select();
    	// print_r($result);

    	/*=======================================事务回滚====================*/
        // Db::transaction(function(){
        //     Db::table('tp_data')->delete(6);
        //     Db::table('tp_data')->insert(['id'=>15,'name'=>'hello3','status'=>3]);
        // });
        $data = new Data;
        $data::transaction(function(){
            $data = new Data;
            $data->where('id',6)->delete();
            $data->insert(['id'=>13,'name'=>'hello3','status'=>3]);
        });
    	/*手动控制事务回滚*/
    	// Db::startTrans();
    	// try{
    	// 	Db::name('data')
    	// 		->delete(6);
    	// 	Db::name('data')
    	// 		->insert(['id'=>13,'name'=>'hello3','status'=>3]);
    	// 	echo "commit";
    	// 	Db::commit();	
    	// }catch(\Exception $a){
    	// 	echo "callback---".$a->getmessage();
    	// 	Db::rollback();
    	// }
    }

    public function hello6(){
    	// $result = Db::name('data')
    	// 		->where('id','between',[2,4])
    	// 		->select();
    	// echo "<pre>";
    	// print_r($result);
    	// $result = Db::name('data')
    	// 		->where('id','in',[1,2,3,4,9])
    	// 		->select();
    	// echo "<pre>";
    	// print_r($result);

    	// 使用EXP条件表达式，表示后面是原生的sql表达式
    	// $result = Db::name('data')
    	// 		->where('id','>','1')
    	// 		->where('name','like','%ll%')
    	// 		->select();
    	// echo "<pre>";
    	// print_r($result);

        // 复杂的查询，or与and混合连用
        $result = Db::name('data')
                ->where('name','like','%hello%')
                ->where('id',['in',[1,2,3]],['>',1],'or')
                ->limit(10)
                ->select();
        echo "<pre>";
        print_r($result);
        // 批量查询
        // $result = Db::name('data')
        //         ->where([
        //             'id' => [['in',[1,2,3]],['>',1],'or'],
        //             'name' => ['like','%hello%'],
        //         ])
        //         ->limit(2)
        //         ->select();
        // echo "<pre>";
        // print_r($result);   
        // 快捷查询
        $result = Db::name('data')
                ->where('id|status','>',0)           //->where('id&status','>',0)   |或的关系&且的关系
                ->limit(10)
                ->select();
        echo "<pre>";
        print_r($result);
    }
    public function hello7(){
        // 视图连表查询
        // $result = Db::view('data',true)     //第一张表
        //         ->view('users',['username' => 'users','sex'],'users.id=data.id')    //第二张表
        //         ->where('data.status','>',2)
        //         ->select();
        // echo "<pre>";
        // print_r($result);exit;
        // 连表查询
        // $data = new Data;
        // $result = $data
        //     ->field("tp_data.*,tp_users.username as users,tp_users.sex")
        //     ->join("tp_users","tp_users.id=tp_data.id")
        //     ->where("tp_data.status",">",2)
        //     ->select();
        // echo "<pre>";
        // print_r($result);exit;
        // 使用query对象
        // $query = new \think\db\Query;
        // $query->name('data')->where('id','>',0)->where('name','like','%hello%');
        // $result = Db::select($query);
        // echo "<pre>";
        // print_r($result);exit;

        // 获取某行某列的某个值
        // $data = new Data;
        // $name = $data->where('id',8)->value('name');
        // print_r($name);exit;
        // 获取某列
        // $data = new Data;
        // $name = $data->where('status',3)->column('name');
        // print_r($name);exit;
        // 获取id为键name为值的键值对
        // $name = Db::name('data')->where('status',3)->column('name','id');
        // print_r($name);
        // 获取id为键的数据集
        // $name = Db::name('data')->where('status',3)->column('*','id');
        // print_r($name);exit;

        // 建议字符串简单查询语句
        // $result = Db::name('data')
        //         ->where('id > :id and name like :name',['id' => 2,'name' => '%hello%'])
        //         ->select();
        // echo "<pre>";
        // print_r($result);        

        // 聚合查询count max min avg sum
        // 1.统计data表的数据
        // $count = Db::name('data')->where('status',3)->count();
        // print_r($count);
        // 2.统计data表的最大id
        // $max = Db::name('data')->where('status',3)->max('id');
        // print_r($max);exit;

        // 日期查询 建议日期类型int
        // 查询时间小于2016-01-01
        // $users = new Users;
        // $result = $users
        //         ->whereTime('regtime','<','2016-01-01')
        //         ->select();
        // echo "<pre>";
        // print_r($result);exit;
        // 查询＞本周此时的数据
        // $result = Db::name('users')
        //         ->whereTime('regtime','>','this week')
        //         ->select();
        // echo "<pre>";
        // print_r($result);exit;
        // 查询最近两天添加的数据
        // $result = Db::name('users')
        //         ->whereTime('regtime','>','-2 days')
        //         ->select();
        // echo "<pre>";
        // print_r($result);exit;
        // 查询创建时间在2016-01-01~~2017-01-01之间的数据
        // $result = Db::name('users')
        //         ->whereTime('regtime','between',['2016-01-01','2017-01-01'])
        //         ->select();
        // echo "<pre>";
        // print_r($result);
        // echo date("Y-m-d","1451577600");
        // 查询昨天yesterday，今天today，本周week，上周last week的数据
        // $result = Db::name('users')
        //         ->whereTime('regtime','today')
        //         ->select();
        // echo "<pre>";
        // print_r($result);

        // 分块查询=============================================数据过多，减小数据库压力
        // Db::name('data')->where('status','>',0)
        //                 ->chunk(2,function($list){
        //                     echo "<pre>";
        //                     print_r($list);
        //                     // foreach($list as $data){
        //                     //     //每2条处理一次直到处理完所有数据
        //                     //     echo "<pre>";
        //                     //     print_r($data);
        //                     // }
        //                 });exit;
        // 改造后的分块查询
        $p = 0;
        do{
            $result = Db::name('data')->limit($p,2)->select();
            $p +=2;
            if($result){
                echo "<pre>";
                print_r($result);
            }
            //逻辑处理
        }while(count($result) > 0);                
    }

    public function test20(){
        // 模型多对多关联------------一对多在(user->test)
        // tp_region  地区表
        // tp_shipping_area 物流配置表
        // tp_area_region 地区对应表（中间表）
        //region表添加一条数据
        // $region = model('Region');
        // $region->region_id = 4;
        // $region->name = "运城市2";
        // $region->level = 4;
        // $region->parent_id = 0;
        // $region->isUpdate(true)->save();
        // $shippingArea = model("ShippingArea");
        // $shippingArea->where("shipping_area_id",11)->delete();
        // 关联新增
        // $region = Region::getByName("北京市");
        // $result = $region->shippingArea()->save(["shipping_area_name" => "一线大城市"]);
        // 新增多条
        // $region = Region::getByName("北京市");
        // $region->shippingArea()->saveAll([
        //     ["shipping_area_name" => "中国首都"],
        //     ["shipping_area_name" => "中国大城市"],
        // ]);

        // 关联中间表填数据
        // $region = Region::getByName("北京市");
        // $shippingArea = ShippingArea::getByShippingAreaName("中国首都");
        // $region->shippingArea()->attach($shippingArea);    //使用attach方法增加中间表数据

        // 关联删除
        // $region = Region::getByName("北京市");
        // $shippingArea = ShippingArea::getByShippingAreaName("一线大城市");
        // // $region->shippingArea()->detach($shippingArea);    //删除关联数据，但不删除关联模型数据
        // $region->shippingArea()->detach($shippingArea,true);  //删除关联数据，并删除关联模型

        // 关联查询
        // $region = Region::getByName("北京市","shippingArea");
        // // echo "<pre>";
        // // print_r($region->shippingArea);exit;
        // $this->assign("list",$region->shippingArea);
        // // return $this->fetch();
        // echo $region->shippingArea[0]->shipping_area_name;
        // echo $region->shippingArea[1]->shipping_area_name;

        //这样也执行关联查询
        // $region = Region::get(1,"shippingArea");
    }

    //模型输出
    public function test21(){
        $user = Users::get(4);
        echo "<pre>";
        print_r($user->toArray());
        // print_r($user->hidden(['id','email'])->toArray());    //隐藏某个字段
        // print_r($user->visible(['email'])->toArray());       //只输出某个字段
        // print_r($user->append(['users_status'])->toArray());              //添加一个不存在的字段,调用users模型中的getUsersStatusAttr
        echo $user->username;
        // echo $user->toJson();    //输出json格式
        // echo $user;                //同上输出json格式
    }

    // 试图和模板
    public function test22(){
        $users = new Users;
        $list = $users->where('id','>',6)->select();
        $this->assign('list',$list);
        $this->assign('count',count($list));
        return $this->fetch();
    }
    //分页输出列表
    public function test23(){
        $users = new Users;
        // print_r(input());

        // $list = $users->paginate(3,false,['page'=>input('param.p'),'path'=>"/test23/[PAGE].html",]);//,false,['page'=>input('param.page'),'path'=>'/test23/name/page/[PAGE].html',]
        // //'test23/[:p]'    =>  ['index/index/test23',['method' => 'get']],
        
        // $list = $users->paginate(3,false,['page'=>input('param.page'),'path'=>"/test23/page/[PAGE].html",]);
        // //'test23'    =>  ['index/index/test23',[]],
        
        // $list = $users->paginate(3,false,['page'=>input('param.p'),'path'=>"/test23/p/[PAGE].html",]);
        // //'test23'    =>  ['index/index/test23',[]],

        // $name = input('param.name');
        // $list = $users->paginate(3,false,['page'=>input('param.page'),'path'=>"/test23/{$name}/[PAGE].html",]);
        // //'test23/[:name]/[:page]'    =>  ['index/index/test23',['method' => 'get']],

        // // 没有路由搜索传参
        // $where = array();
        // $name = input('param.name');
        // if($name){
        //     $where['username'] = $name;
        // }
        // $list = $users->where($where)->paginate(2,false,['query'=>['name'=>$name],]);

        // 路由搜索传参test23Search方法里面
        // $list = $users->paginate(2,false,['page'=>input('param.page'),'path'=>"/test23/[PAGE]",]);
        // 'test23/[:page]'    =>  ['index/index/test23',['method' => 'get']],

        // ajax搜索分页
        $where = array();
        $name = input("param.name");
        if($name){
            $where['username'] = $name;
        }
        $list = $users->where($where)->paginate(2,false,['page'=>input('param.page'),'path'=>"/test23/[PAGE]",]);
        // 'test23/[:page]'    =>  ['index/index/test23',['method' => 'get']],
        if(request()->isAjax()){    //如果是AJAX请求的分页
            if($name){
                $this->assign("ajaxName",$name);
            }else{
                $this->assign("ajaxName",'');
            }
            $this->assign('list',$list);
            $this->assign('count',count($list));
            return $this->fetch('page');
            exit;
        }

        // echo "<pre>";
        // print_r($list->toArray());exit;
        $this->assign("getname","");
        $this->assign('list',$list);
        $this->assign('count',count($list));
        return $this->fetch();
    }
    public function test23Search(){
        $users = new Users;
        $where = array();
        $name = input('param.name');
        // print_r($name);
        if($name){
            $where['username'] = $name;
            $this->assign("getname",$name);  
        }
        $list = $users->where($where)->paginate(2,false,['page'=>input('param.page'),'path'=>"/test23Search/{$name}/[PAGE]",]);
        // 'test23Search/[:name]/[:page]'    =>  ['index/index/test23Search',['method' => 'get']],
        $this->assign('list',$list);
        $this->assign('count',count($list));
        return $this->fetch("test23");
    }
    // 调试
    public function test24(){
        halt([1,2,3]);
        halt("这里的信息不会显示");  //类似exit
        trace("这是测试调试信息");
        trace([1,2,3]);
        // $list = Users::paginate(3);
        // $this->assign('list',$list);
        // $this->assign('count',count($list));
        // return $this->fetch();
        // return "错误测试".$_GET['name'];
    }
    // 调试日志(写入runtime->log中)
    public function test25(){
        Log::error("错误信息11111");
        Log::info("日志信息22222");
        trace("错误信息33333",'error');
        trace("日志信息44444",'info');
    }

    // 扩展
    public function test26(){
        echo myFun();
    }
    public function test27(){
        $obj = new TestExtend;
        echo $obj->test();
    }
    public function test28(){
        $obj = new Myclass();
        echo $obj->hello();
    }
    public function test29(){
        // 赋值
        // Session::set("name","axiao");
        // 赋值think2作用域
        // Session::set("name","axiao2","think2");
        // 判断（当前作用域）是否赋值
        // echo Session::has("name");
        // 判断think作用域是否赋值
        // echo Session::has("name","think");
        // 取值 (当前作用域)
        // echo Session::get("name");
        // 取值（think作用域）
        // echo Session::get("name","think");
        // 指定当前作用域
        // Session::prefix("name2");
        // 删除（当前作用域）
        // echo Session::delete("name");
        // echo Session::get("name","think");
        // 清除session(当前作用域)
        // Session::clear();
        // 赋值（当前作用域）
        Session::set("name.item","thinkphp");

        echo "<pre>";
        print_r($_SESSION);
    }
    public function test30(){
        // session("name","thinkphp123");
        // echo $this->request->session("name");
        // 判断（当前作用域）是否赋值
        // echo session("?name");
        // 取值（think2作用域）
        // echo session("name","","think2");
        // 删除session（当前作用域）
        // session("name",null);
        // 清除session(当前作用域)
        // session(null);
        // echo "<pre>";
        // print_r($_SESSION);
        return $this->fetch();  //$Request.session.name
    }

}
