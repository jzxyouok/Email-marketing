<?php
namespace app\tasks\controller;

class tasklist
{
	public function index(){
		$tasks = M('tasks');

		$count = $tasks->count();
		
		$view = new \think\View();
		$view->assign('count',$count);
		$Page  = new \think\Pagehome($count,10);
		$show  = $Page->show();
		$tasksdata = $tasks->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$view->assign('data',$tasksdata);
		return $view->fetch();
	}
}