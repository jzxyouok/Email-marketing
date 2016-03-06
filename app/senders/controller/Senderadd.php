<?php
namespace app\senders\controller;

class Senderadd 
{
	public function index(){
		$view = new \think\View();
		return $view->fetch();
	}
	public function save(){
		$name = I('post.name');
		$content = I('post.content');

		$senders = M('mailsenders');
		$sendergroup = M('mailsendergroup');
		$sendergroupdata = [
			'name' => $name,
			'add_time' =>date('Y:m:d H:i:s'),
		];	
		$sendergroupresult = $sendergroup->create($sendergroupdata);
		$sendergroupresult = $sendergroup->add();
		$content  = trim($content);
		$arr=explode("\n",$content);

			foreach ($arr as $key=>$val){
				$arr[$key]=explode("|",$val);
				$data[$key] = [
					'gruopid' => $sendergroupresult,
					'sendname' => $arr[$key]['0'],
					'apikey' => $arr[$key]['1'],
					'sendemail' => $arr[$key]['2'],
					'domain' => $arr[$key]['3'],
				];

					 $senderresult = $senders->create($data[$key]);
					 $accountresult = $senders->add();	 		  
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