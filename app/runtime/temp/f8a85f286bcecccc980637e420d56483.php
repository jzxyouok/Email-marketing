<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>邮件营销系统</title>
  <link rel="stylesheet" type="text/css" href="/Public/Css/public.css?v1.0" />
  <script type="text/javascript" src="/Public/Js/jquery.js?v1.7.1"></script>
  <script type="text/javascript" src="/public/string?v1.0"></script>
  <script type="text/javascript" src="/Public/Js/jquery.validate.js?v1.11.1"></script>
  <script type="text/javascript" src="/Public/Js/formcheck.js?v1.0"></script>
  <script type="text/javascript" src="/Public/Js/common.js?v1.0"></script>
</head>
<body id="admin">
	<div id="Tasks_tasklist">
	<!-- 头部 -->
		<div id="header">
			<div id="logo">
				<a href="/index/index/"><img src="/Public/Images/slogo.png" alt="logo"></a>
			</div>

			<div id="headright">
			

        <ul id="headlink">
          <li><a href="/senders/senderadd" class="addpeople">发件人添加</a></li>
          <li><a href="/themes/themeadd" class="addtheme">模板添加</a></li>
          <li><a href="/tasks/taskadd" class="sendnew">任务添加</a></li>

        </ul>
			</div>
		</div>
	<!-- 主体 -->
	<div id="center">
	<!-- 左边栏 -->
	<div id="leftbar">
		<ul class="Tasks">
			<li class="tit"><a>任务管理</a></li>
			<li>
				<ul>
				<li><a href="/tasks/tasklist">任务列表</a></li><li><a href="/tasks/taskadd">任务添加</a></li>				</ul>
			</li>
		</ul>
        
        
        <ul class="Senders">
			<li class="tit"><a>发件人管理</a></li>
			<li>
				<ul>
				<li><a href="/senders/senderlist">发件人列表</a></li>
                <li><a href="/senders/sendergroup">发件人组</a></li>
                <li><a href="/senders/sendergroup">发件人组</a></li>
                <li><a href="/senders/senderadd">发件人添加</a></li>				</ul>
			</li>
		</ul>
      
          <ul class="Senders">
			<li class="tit"><a>收件箱管理</a></li>
			<li>
				<ul>
				<li><a href="/accounts/accountlist">收件人列表</a></li><li><a href="/accounts/accountgroup">收件人组</a></li><li><a href="/accounts/accountadd">收件人添加</a></li>				</ul>
			</li>
		</ul>
        
      <ul class="Themes">
			<li class="tit"><a>模板管理</a></li>
			<li>
				<ul>
				<li><a href="/themes/themelist">模板列表</a></li><li><a href="/themes/themeadd">模板添加</a></li>	<li><a href="/themes/yuminglist">域名库管理</a></li>				</ul>
			</li>
		</ul>
        
            <ul class="Themes">
			<li class="tit"><a>营销统计</a></li>
			<li>
				<ul>
				<li><a href="/tongji/lists/">整体分析</a></li><li><a href="/tongji/visitor/">流量趋势</a></li>				</ul>
			</li>
		</ul>
        
        </div>
	<!-- 核心模块 -->
<div id="rightbar">
		<h1>模板列表</h1>
		
		<!-- 帮助信息 -->
				<div class="alert alert-info">
				    <button class="close" data-dismiss="alert">×</button>
				    <strong>帮助!</strong>
					<ol>
						
       		</ol>
				</div>


<div class="box">
  <p class="boxtitle">
    <img alt="tag" src="/Public/Images/tag.png">邮件模板--模板列表  </p>
  <div class="boxitem">
  
  <table>
    <thead>
    <tr style="background: none;">
      <th>ID</th>
      <th>模板名称</th>
      <th>模板内容</th>
      <th>模板标题</th>
       <th>添加时间</th>
      <th>操作</th>
    </tr>
    </thead>
    <tbody>
    
    
  
    
  
           
        
 <?php if(is_array($data)): foreach($data as $key=>$val): ?>
    <tr style="height: 200px; background: none;">
      <td width="10%" class="tdcenter"><?php echo $val['id']; ?></td>
      <td width="10%" class="tdcenter"><?php echo $val['title']; ?></td>
      <td width="10%"><?php echo $val['content']; ?></td>
      <td width="25%">
      <?php if(is_array($val['theme_title'])): foreach($val['theme_title'] as $key=>$sub): ?>
     <a href="/themes/themelist/sc/id/<?php echo $sub['tid']; ?>/" target="_blank" ><?php echo $sub['content_title']; ?></a><br>
      <?php endforeach; endif; ?>
       <br></td>
      <td width="10%"><?php echo $val['time']; ?></td>
      <td width="10%" class="tdcenter">
     
        <a href="/themes/themelist/del/id/<?php echo $val['id']; ?>/" class="button delete">删除</a>
      </td>
    </tr>  
   <?php endforeach; endif; if(empty($data)): echo '"empty'; endif; ?>
    </tbody>
  </table>

  </div>
    <br class="cb">
</div>


<div class="pagelink">
      <?php echo $page; ?>              
</div>
	</div>
    
    
 



<link rel="stylesheet" type="text/css" href="/Public/Css/colorbox.css?v1.3" />
<script type="text/javascript" src="/Public/Js/colorbox.js?v1.3.19.3"></script>
<script type="text/javascript" src="/Public/Js/jquery.zxxbox.min.js?v4.0"></script>
<script type="text/javascript" src="/Public/Js/lhgcore.min.js?v1.4.5"></script>
<script type="text/javascript" src="/Public/Js/lhgcalendar.min.js?v2.0.3"></script>
<script type="text/javascript">
$(function(){
    $(".preview").colorbox({width:"850px",scrolling:false});
    J('#schedule_time').calendar({format:'yyyy-MM-dd HH:mm:ss'});
})
var delurl='/tasks/taskdel';
var tasktesturl='/tasks/tasktest';
var tasksendurl='/tasks/tasksend';
</script>

				<br />
        <div class="loadingwrapper"><span class="loading"></span></div>
	</div>
		<!-- 底部 -->
		</div>
		<div id="footer">
			2016 &copy;
			Email: <a href="mailto:248278242@qq.com">248278242@qq.com</a>
		</div>
	</div>
</body>
</html>