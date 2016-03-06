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
// $Id$

return [
    // 生成运行时目录
    '__dir__'  => ['runtime/cache', 'runtime/log', 'runtime/temp', 'runtime/template'],
    '__file__' => ['common.php'],

    //定义模板文件的自动生成
    'themes'    => [
        '__file__'   => ['common.php'],
        '__dir__'    => ['behavior', 'controller', 'model', 'view'],
        'controller' => ['Yuminglist','Yumingadd'],
        'model'      => [],
        'view'       => ['themes/Yuminglist','themes/Yumingadd'],
    ],
    //定义发件人组信息
    'senders'    => [
        '__file__'   => ['common.php'],
        '__dir__'    => ['behavior', 'controller', 'model', 'view'],
        'controller' => ['Sendergroup'],
        'model'      => [],
        'view'       => ['senders/Sendergroup'],
    ],
    

    
];
