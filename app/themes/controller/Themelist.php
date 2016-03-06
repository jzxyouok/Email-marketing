<?php
namespace app\themes\controller;

class themelist
{
	public function index(){
		$theme = M('themes');

		$count = $theme->count();
		
		$view = new \think\View();
		$view->assign('count',$count);
		$Page  = new \think\Pagehome($count,12);
		$show  = $Page->show();

		$themedata = $theme->limit($Page->firstRow.','.$Page->listRows)->select();
		//var_dump($themedata);
		$view->assign('data',$themedata);
		$view->assign('page',$show);
		return $view->fetch();
	}
}