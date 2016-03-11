<?php
namespace app\senders\controller;

class Sendergroup
{
	public function index(){
			$mailsendergroup = M('mailsendergroup');
			$count = $mailsendergroup->count();
			$view = new \think\View();
			$view->assign('count',$count);
			$Page  = new \think\Pagehome($count,10);
			$show  = $Page->show();
			$mailsendergroupdata  = $mailsendergroup->limit($Page->firstRow.','.$Page->listRows)->select();

			//var_dump($Accountdata);
			$view->assign('page',$show);
			$view->assign('data',$mailsendergroupdata);
			return $view->fetch();
	}
}