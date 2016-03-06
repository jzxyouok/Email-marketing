<?php
namespace app\accounts\controller;

class AccountGroup
{
	public function index(){
		$accountgroup= M('accountgroup');

		$count = $accountgroup->count();
		$view = new \think\View();
		$view->assign('count',$count);
		$Page  = new \think\Pagehome($count,10);
		$show  = $Page->show();
		$Accountdata  = $accountgroup->limit($Page->firstRow.','.$Page->listRows)->select();

		//var_dump($Accountdata);
		$view->assign('page',$show);
		$view->assign('data',$Accountdata);
		return $view->fetch();
	}

}