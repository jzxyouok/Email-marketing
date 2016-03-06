<?php
namespace app\accounts\controller;

class Accountadd
{
	public function index(){
		$view = new \think\View();
		return $view->fetch();
	}
	public function save(){
		$name = I('post.name');
		$content = I('post.content');

		$accounts = M('accounts');
		$accountgroup = M('accountgroup');

		$accountgroupdata = [
			'name' => $name,
			'add_times' =>date('Y:m:d H:i:s'),
		];	
		$accountgroupresult = $accountgroup->create($accountgroupdata);
		$accountgroupresult = $accountgroup->add();
		$content  = trim($content);
		$arr=explode("\n",$content);

			foreach ($arr as $key=>$val){
				$arr[$key]=explode("|",$val);
				$data[$key] = [
					'gruopid' => $accountgroupresult,
					'accountemail' => $arr[$key]['0'],
					'accountname' => $arr[$key]['1'],
					'accountgender' => $arr[$key]['2'],
				];

					 $accountresult = $accounts->create($data[$key]);
					 $accountresult = $accounts->add();	 		  
			}		

			$message = new \think\Response();
			if($accountresult and $accountgroupresult){
					return $message->success('收件人新增成功！','','/accounts/accountlist/','2');
			}
			else{
					return $message->error('收件人新增失败！','','','2');
			}

	}
}