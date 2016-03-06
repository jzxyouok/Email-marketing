<?php
namespace app\senders\controller;

class senderlist
{
	public function index(){
		$senders = M('mailsenders');
		
		$count = $senders->count();
		$view = new \think\View();
		$view->assign('count',$count);
		$Page  = new \think\Pagehome($count,10);
		$show  = $Page->show();
		$sendersdata = $senders->limit($Page->firstRow.','.$Page->listRows)->select();

		//var_dump($sendersdata);
		$view->assign('page',$show);
		$view->assign('data',$sendersdata);
		return $view->fetch();
	}
}