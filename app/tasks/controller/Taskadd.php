<?php
namespace app\tasks\controller;

class Taskadd
{
	public function index(){

		$themesdata = M('themes')->select();
		$sendmaildata = M('mailsendergroup')->select();
		$accountgroupdata = M('accountgroup')->select();
		foreach ($sendmaildata as $key => $value) {
			$sendmaildata[$key]['count'] = M('mailsenders')->where("groupid='".$value['groupid']."'")->count();
		}

		foreach ($accountgroupdata as $key => $value) {
			$accountgroupdata[$key]['count'] = M('accounts')->where("groupid='".$value['groupid']."'")->count();
		}

		$view = new \think\View();
		$view->assign('accountgroupdata',$accountgroupdata);
		$view->assign('themesdata',$themesdata);
		$view->assign('sendmaildata',$sendmaildata);
		return $view->fetch();
	}

	public function save(){
		$tasks = M('tasks');
		$tasksdata =array(
			'name'=>  I('post.name'),
			'themesid' => I('post.moban'),
			'sendemail' => trim(I('post.sendemail')),
			'sendseelp' => I('post.sendseelp'),
			'emailsj' => trim(I('post.emailsj')) ,
			'addresseeemail' =>trim(I('post.addresseeemail')),
			'addtime' => date('Y:m:d H:i:s'),
			'sendmoshi' => I('post.sender_moshi'),
		);
			$result =   $tasks->create($tasksdata);
			$message = new \think\Response();
            if($result) {
            	$result =   $tasks->add($tasksdata);
               	return $message->success('任务新增成功！','','/tasks/tasklist/','2');
            }else{
				return $message->error('任务新增失败','','/tasks/tasklist/');
            }	
		
	}
}