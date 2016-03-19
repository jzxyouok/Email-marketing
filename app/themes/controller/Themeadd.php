<?php
namespace app\themes\controller;

class themeadd
{
	public function index(){
		$view = new \think\View();
		return $view->fetch();
	}

	public function save(){
		$theme = M('themes');
		$themetitles = M('themestitle');

		$themedate['title'] = I('post.title');
		$themedate['theme_title'] = I('post.theme_title');
		$themedate['content'] = I('post.content');
		$themedate['time'] = date("Y-m-d");


		$result =   $theme->create($themedate);
		$result =   $theme->add();

		/*分割标题*/
		$arr=explode("\n",$themedate['theme_title']);
		$arrcount = count($arr);
		for ($i=0; $i < $arrcount ; $i++) { 

	
				$data[$i]['themesid'] = $result;
				$data[$i]['content_title'] =$arr[$i];
			
				//var_dump($data[$i]);exit();
				 $themetitleresult = $themetitles->create($data[$i]);
				 $themetitleresult = $themetitles->add();

		}
	

		$message = new \think\Response();
            if($result and $themetitleresult) {
            	
               	return $message->success('模板新增成功！','','/themes/themelist/','2');
            }else{
				return $message->error('模板新增失败','','/themes/themelist/');
            }	
	}

}