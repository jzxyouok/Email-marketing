<?php
namespace app\tongji\controller;

class Visitor
{
	public function index($starttime = '',$endtime = ''){
		$tongji  = M('tongji');
		$starttime = I('get.starttime');
		$endtime = I('get.endtime');

		if($starttime == '' and $endtime ==''){
			for ($i=6; $i >0 ; $i--) { 
				$datetotime = "-".$i." day";
				$fwcount = date("Ymd",strtotime($datetotime));
				$fangwendata[$i]['count'] = $tongji->where("day(Time)=day('".$fwcount."')")->count();
				$fangwendata[$i]['date'] = $fwcount;
			}	
		}
		else{
			
				
		}
		
		
		
		/*开始实例化view*/	
	
		$view = new \think\View();
		$view->assign('data',$fangwendata);
		return $view->fetch();


	}

}