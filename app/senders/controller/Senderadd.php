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
				$arrs[$key]=explode("|",$val);
				var_dump($arrs);
				exit();
				$data[$key] = array(
					'gruopid' => $sendergroupresult,
					'sendname' => $arrs[$key]['0'],
					'apikey' =>  $arrs[$key]['1'],
					'sendemail' => $arrs[$key]['2'],
					'domain' => $arrs[$key]['3'],
				);

					 $senderresult = $senders->create($data[$key]);
					 $accountresult = $senders->add();	 		  
			}		

			$message = new \think\Response();
			if($accountresult){
					return $message->success('收件人新增成功！','','/accounts/accountlist/','2');
			}
			else{
					return $message->error('收件人新增失败！','','','2');
			}

	}

}