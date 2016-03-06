<?php
namespace app\index\controller;

class index
{
    public function index()
    {
    	// $tongji =M('tongji');
    	
    	//$model = $tongji->select();
    	//var_dump($model);
    	//var_dump($tongji);
        $view = new \think\View();
		return $view->fetch();
    }
}
