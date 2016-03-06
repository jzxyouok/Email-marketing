<?php
namespace app\accounts\controller;

class Accountlist
{
	public function index(){
		$Account= M('Accounts');

		$count = $Account->count();
		$view = new \think\View();
		$view->assign('count',$count);
		$Page  = new \think\Pagehome($count,10);
		$show  = $Page->show();
		$Accountdata  = $Account->limit($Page->firstRow.','.$Page->listRows)->select();

		//var_dump($Accountdata);
		$view->assign('page',$show);
		$view->assign('data',$Accountdata);
		return $view->fetch();
	}

}