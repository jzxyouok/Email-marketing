<?php
namespace app\tongji\controller;

class Daochu
{
	/**
	 * 導出文件
	 * @param int $action 
	 */
	public function index($action){
		$tongji = M("tongji");
		
		$message = new \think\Response();
		if($action  == ''){
			return $message->error('没有参数！');
		}
		else{
			$tonjiresult = $tongji->where("action='".$action."' and export != '1' ")->select();
			$savedata = array(
				'export'=>1,
			);
			$tongjiexportupdate = $tongji->where("action='".$action."' and export != '1' ")->save($savedata);
		}
		
		foreach ($tonjiresult as $key => $value) {
			  //$data[] = $value['jieshou_email']."\n";
			var_dump($value);
		}
		exit();
		$filename = "daochu-".$action.".txt";
		$file = fopen($filename,"w"); // 打开文件 
		fwrite($file ,'string');
		$txt = fclose($file);
		var_dump($txt);
		//$this->downloadFile($file);

	}
	/**
	 * 返回下載
	 * @param string $file
	 */
	private function downloadFile($file){
		$file_name = $file;
		$mime = 'application/force-download';
		header('Pragma: public'); // required
		header('Expires: 0'); // no cache
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Cache-Control: private',false);
		header('Content-Type: '.$mime);
		header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
		header('Content-Transfer-Encoding: binary');
		header('Connection: close');
		readfile($file_name); // push it out
		exit();
	}

}