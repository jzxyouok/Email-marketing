<?php
namespace app\tongji\controller;

class Lists
{
	public function index($where = ''){
		$tongji  = M('tongji');
		if(I('get.title') != ''){
			$where['title'] =  I('get.title');
		}
		else if(I('get.date') != ''){
			$where[day('time')] = day(I('get.date')) ;
		}
		else if(I('get.action') != ''){
			$where['action'] =  I('get.action');
		}
		
		
		//var_dump($where);
		/*开始实例化view*/

		if($where != ""){
			$count = $tongji->where($where)->count();
		}
		else{
				$count = $tongji->count();
		}
	
	
		$view = new \think\View();
		$view->assign('count',$count);
		$Page  = new \think\Pagehome($count,500);
		$show  = $Page->show();
		if($where != ""){
			$tongjidata = $tongji->where($where)->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
		}
		else{
			$tongjidata = $tongji->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
		}
		
		
		$view->assign('page',$show);
		$view->assign('data',$tongjidata);
		return $view->fetch();


	}
	public function chart($date = ''){
		$tongji  = M('tongji');
		if($date == ''){
			$date = date("Y-m-d");
		}else{
			$date = I('get.date');
		}
		$k = 0;
		for ($i=0; $i <24 ; $i++) { 
			if($k < 10 or $i < 10){
				$k = "0".$k;
				$i = "0".$i;
			}
			$k ++;
			$tonjidata[$i]['count']  = $tongji->where("clicktime >'".$date." ".$i.":00:00' and clicktime <'".$date." ".$k.":00:00'")->count();
			$tonjidata[$i]['date'] = $i;
		}

	//	var_dump($tonjidata);
		$view = new \think\View();
		$view->assign('data',$tonjidata);
		return $view->fetch();
	}



}