<?php
namespace app\tongji\model;

use think\Model;

class Lists extends Model
{
	protected $connection = array(
        'db_type'  => 'mysql',
        'db_user'  => 'root',
        'db_pwd'   => 'root',
        'db_host'  => 'localhost',
        'db_port'  => '3306',
        'db_name'  => 'baidu',
        'db_charset' => 'utf8',
    );
    
}