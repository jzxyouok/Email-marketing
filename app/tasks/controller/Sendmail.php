<?php
namespace app\tasks\controller;
use Mailgun\Mailgun;
class Sendmail
{

	public function index(){
		$mailgun = new mailgun();
	}
	public function returndata($id){
		$tasks = M('tasks');
		$senders = M('senders');
		$themes = M('themes');
		$senddata  =  $tasks->join('themes on tasks.themesid = themes.id', 'left')->join('mailsenders on tasks.sender = mailsenders.groupid ')->where("tasks.id='".$id."'")->select();
		return $senddata;
	}

	public function send($id){
		$id =  I('get.id');

		$tasks = M('tasks');
		$senders = M('senders');
		$themes = M('themes');
		$data = $this->returndata($id);
		//var_dump($data);exit();

		//$data['0']['content'] = $this->moban($data['0']['content']); //内容模板解析
		
		//$data['0']['title'] = $this->moban($data['0']['title']);

		//$data['0']['addresseeemail'] = $this->moban($data['0']['addresseeemail']);

		//var_dump($data);
		//exit();
		$tasksdata =  $tasks->where("id='".$id."'")->select();


			if($tasksdata['0']['emailsj'] == 'mailgun'){
				if($tasksdata['0']['sendmoshi'] == 'sendlist'){
					$this->mailgunlist($data);
				}
				else if($tasksdata['0']['sendmoshi'] == 'sendmail'){
					$this->mailguncurl($data);
				}
				else{
					$message = new \think\Response();
					return $message->error('发送失败！发送模式没有选择','','/tasks/tasklist/');
				}
			}
			else if($tasksdata['0']['emailsj'] == 'postmarkapp'){
				$this->postmarkapp($data);
			}
			else{
			 	return false ;
			}

		//return $data;
	}


	

	/*发送模式  -----postmarkapp 发送模式*/
	public function postmarkapp($data){

	}
	/*发送模式 ----mailgun 站外发送*/
	public function mailguncurl($data){
		$url = "http://127.0.0.1/mail/maillist.php"; //配置网址
		$ch = curl_init ();
		// print_r($ch);
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query($data));
		$return = curl_exec ( $ch );
		curl_close ( $ch );
		print_r($return);

		$message = new \think\Response();
		if($return){
			return $message->success('发送成功！','','/tasks/tasklist/');			
		}
		else{
			return $message->error('发送失败！','','/tasks/tasklist/');		
		}
	}
	/*发送模式 ----mailgun 单发送*/
	public function mailgun($data){
		$mgClient = new \think\Loader\autoload('Mailgun');
       // $mgClient = new \Mailgun('key-5524fd3dfb9eacf6c6cf6c2019c6de5b');

        var_dump($mgClient);
		$result = $mgClient->get("lists/$From/members", array(
			    'subscribed' => 'yes',
			    'limit'      =>  10,
			    'skip'       =>  0
		));
		$result = object_array($result);
		foreach ($result['http_response_body']['items'] as $key => $value) {
				//echo $value["address"];
				$sendstate  = $mgClient->get("$domain/stats/total", array(
			    'event' => array('accepted', 'delivered', 'failed'),
			    'duration' => '1m'
		));
		$sendresult = $mgClient->sendMessage("$domain",
			 array(
				 'from' => $FromName.' <'.$From.'>',
				 'to' => $value["address"],
				 'subject' => $Subject,
				 'text' => $Content
		));

		}
	}


	/*发送模式 ----mailgun 发送列表*/
	public function mailgunlist($data){
		$Loader = new \think\Loader();

		$mgClient = $Loader::addNamespace('');
		$mgClient = $Loader::register();
		$mgClient = $Loader::autoload('mailgun');


		var_dump($mgClient);
		//exit();

       
		$sendresult = $mgClient->sendMessage("$domain",
			 array(
				 'from' => $FromName.' <'.$From.'>',
				 'to' => $value["address"],
				 'subject' => $Subject,
				 'text' => $Content
		));

	}




}