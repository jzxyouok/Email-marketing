<?php
namespace app\themes\controller;

class themelist
{
	public function index(){
		$theme = M('themes');
		$themetitle = M('themestitle');

		$count = $theme->count();
		
		$view = new \think\View();
		$view->assign('count',$count);
		$Page  = new \think\Pagehome($count,5);
		$show  = $Page->show();

		$themedata = $theme->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach ($themedata as $key => $value) {
			$themedata[$key]['theme_title'] = $themetitle->join("inner JOIN themes ON themes.id = themestitle.themesid ")->where("themestitle.themesid = '".$value['id']."'")->order("themes.id asc")->select();
		}

		$view->assign('data',$themedata);
		$view->assign('page',$show);
		return $view->fetch();
	}

	public function del($id){
		 
		 $view = new \think\View();
		 $message = new \think\Response();
		 if (!empty($id)) {
            $theme = M('themes');
			$themetitle = M('themestitle');

            $result = $theme->delete($id);
            if (false !== $result) {
                return $message->success('删除成功！');
            } else {
                return $message->error('删除错误！');
            }
        } else {
        	    return $message->error('ID错误！');
        }

	}

	public function sc($id){
		$theme = M('themes');
		$themetitle = M('themestitle');

		$id = I('get.id');

		$themeiddata = $themetitle->join("right JOIN themes ON themes.id = themestitle.themesid ")->where("themestitle.tid = '".$id."'")->select();
		foreach ($themeiddata as $key => $value) {
			$themeiddata[$key]['content'] = $this->replace($themeiddata[$key]['content'],$themeiddata);
		}
		$view = new \think\View();
		$view->assign('data',$themeiddata);
		return $view->fetch();
	}

	public function replace($content,$data){
		$search  = array(
			'%send_moban_id%',
			'%send_date%', 
			'%send_title_id%',
			'%rand_1%',
			'%rand_a%'

		);
		$replace = array(
			$data['0']['id'],
			date("Y-m-d"),
			$data['0']['tid'],
			rand(0,9),
			
		);
		$newcontent = str_replace($search, $replace, $content);
		return $newcontent;
	}
}