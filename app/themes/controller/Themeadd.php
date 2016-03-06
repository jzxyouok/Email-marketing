<?php
namespace app\themes\controller;

class themeadd
{
	public function index(){
		$view = new \think\View();
		return $view->fetch();
	}

	public function save(){
		$theme = M('themes');

		$themedate['title'] = I('post.title');
		$themedate['content'] = I('post.content');
		$themedate['time'] = date("Y-m-d");

		$result =   $theme->create($themedate);
		$message = new \think\Response();
            if($result) {
            	$result =   $theme->add();
               	return $message->success('模板新增成功！','','/themes/themelist/','2');
            }else{
				return $message->error('模板新增失败','','/themes/themelist/');
            }	
	}

}