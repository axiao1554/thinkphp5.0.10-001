<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [						//	hello/id或者hello/name
        '[:id]'   => ['index/index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/index/hello', ['method' => 'post']],
    ],
    // 'hello/[:name]' => ['index/index/hello',['method' => 'get','ext' => 'html']],	//	hello/name
    'today/[:year]/[:month]' => ['index/index/today',['method' => 'get'],['year' => '\d{4}','month' => '\d{2}']],	//	today/2017/09
    'url'	=>	['index/index/url',[]],
    'hello3'	=>	['index/index/hello3',[]],
    'hello7'    =>  ['index/index/hello7',[]],
    'test23/[:page]'    =>  ['index/index/test23',[]],
    'test23Search/[:name]/[:page]'    =>  ['index/index/test23Search',['method' => 'get']],
    'testmodel'    =>  ['index/TestModel/testmodel',[]],
    'find'    =>  ['index/TestModel/find',[]],
    'create'    =>  ['index/User/create',[]],
    'api'    =>  ['api/User/test',[]],
    'upload'    =>  ['index/Upload/index',[]],
    'image'    =>  ['index/Upload/image',[]],
];
