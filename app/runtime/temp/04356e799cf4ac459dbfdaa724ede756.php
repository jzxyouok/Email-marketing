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
                <li><a href="/senders/sendergroup">发件人组</a></li><li><a href="/senders/senderadd">发件人添加</a></li>				</ul>
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
				<li><a href="/tongji/lists/">整体分析</a></li><li><a href="/tongji/qushi/">流量趋势</a></li>				</ul>
			</li>
		</ul>
        
        </div>
	<!-- 核心模块 -->
	<div id="rightbar">
		<h1>任务列表</h1>
		
		<!-- 帮助信息 -->
				<div class="alert alert-info">
				    <button class="close" data-dismiss="alert">×</button>
				    <strong>帮助!</strong>
					<ol>
						
            <li>任务发送会有1分钟左右的误差</li>
            <li>采用了"伪队列"模式,多任务同时进行时,会将所有发送邮件加入队列，所以出现任务时间已到但是没有发送记录是正常现象</li>
            <li>点击失败数可以查看具体失败原因</li>
        					</ol>
				</div>
		
<div class="box">
      <p class="boxtitle">
        <img alt="tag" src="/Public/Images/tag.png">任务列表      </p>
        <volist name='list' id='data'>
      <div class="boxitem">
      <script type="text/javascript">var taskdetail= new Array();</script>
      

       <?php if(is_array($data)): foreach($data as $key=>$val): ?>
            
      
      
      <div class="taskinfo">
          <table>
            <tbody><tr>
              <td width="130px">
                <h3 id="task_name_13"><?php echo $val['name']; ?></h3>
                
                <p>
                  <button onClick="location.href='/tasks/Sendmail/send/id/<?php echo $val['id']; ?>/'"  rel="sendnow" value="15" class="tasksend" >立即发送</button>
                    <br><br>
                    <button rel="schedule" value="15" class="tasksend">定时发送</button>
                  
                </p>
                                   
                                   
           
              </td>

          
              <td width="625px">
                  <table>
                    <tbody><tr>
                      <td>
                        <div class="data inline-block">
                          <h4 class="proccess">0</h4>
                          <p class="dim-el">总数</p>
                        </div>
                      </td>

                      <td>
                        <div class="data inline-block">
                          <h4 class="failed">0</h4>
                          <p class="dim-el">无效数</p>
                        </div>
                      </td>

                      <td>
                        <div class="data inline-block">
                          <h4 class="failed"><a href="/tasks/faileddetail/id/13" target="_blank">0</a></h4>
                          <p class="dim-el">失败数</p>
                        </div>
                      </td>

                      <td>
                        <div class="data inline-block">
                          <h4 class="warning">0.00%(0)</h4>
                          <p class="dim-el">打开率</p>
                        </div>
                      </td>

                      <td>
                        <div class="data inline-block">
                          <h4 class="success">0.00%(0)</h4>
                          <p class="dim-el">点击率</p>
                        </div>
                      </td>

                      <td>
                        <div class="data inline-block">
                          <h4 class="failed">0.00%(0)</h4>
                          <p class="dim-el">退订率</p>
                        </div>
                      </td>
                  </tr>
                </tbody></table>
              </td>

              <td width="80px">
                <a class="button">详情</a>
                <br><br>
                <button class="tasktest" value="13">测试</button>
                <br><br>
                <button value="13" class="delete">删除</button>
              </td>
            </tr>
          </tbody></table>
        </div>  
        
      <?php endforeach; endif; if(empty($data)): echo '"empty'; endif; ?>    	
        
            </div>
    </div>
    <div class="pagelink">
                   
                 
      </div>
<div id="tasktestbox">
    <div class="boxitem">
         <dl>
            <dt>邮件账户 :</dt>
            <dd id="account_ids"></dd>
            <br class="cb">

            <dt>分配规则 :</dt>
            <dd id="assign_rule"></dd>
            <br class="cb">

            <dt>发件人邮箱 :</dt>
            <dd id="sender_detail"></dd>
            <br class="cb">

            <dt>邮件组 :</dt>
            <dd id="group_name"></dd>
            <br class="cb">

            <dt>打开点击客户转存组 :</dt>
            <dd id="transfer_group_name"></dd>
            <br class="cb">

            <dt>邮件模板 :</dt>
            <dd id="tpl_name"></dd>
            <br class="cb">

            <dt>退订模板 :</dt>
            <dd id="unsubscribe_tpl_name"></dd>
            <br class="cb">

            <dt>姓名格式 :</dt>
            <dd id="name_format"></dd>
            <br class="cb">

            <dt>中国IP标记 :</dt>
            <dd id="china_ip_mark"></dd>
            <br class="cb">

            <dt>邮件标题 :</dt>
            <dd id="subject"></dd>
            <br class="cb">

            <dt>收件人邮箱</dt>
            <dd><input type="text" value="" size="45" name="receiver_email" id="receiver_email"></dd>
            <br class="cb">

            <dt>&nbsp;<input type="hidden" value="" name="task_id" id="task_id"></dt>
            <dd>
                <input type="submit" value="提交" id="tasktestsubmit">
                <span id="tasktestresult"></span>
            </dd>
         </dl>
         <br class="cb">
    </div>
</div>

<div id="schedulebox">
  <div class="boxitem">
  <dl>
    <dt>定时时间</dt>
    <dd><input type="text" value="2016-02-24 16:12:27" name="schedule_time" id="schedule_time" class="runcode" size="45"></dd>
    <dt>&nbsp;</dt>
            <dd>
                <input type="hidden" value="" name="schedule_task_id" id="schedule_task_id">
                <input type="submit" value="提交" id="schedulesubmit">
                <span id="scheduleresult"></span>
            </dd>
     <br class="cb">
  </dl>
  </div>
</div>

<link rel="stylesheet" type="text/css" href="/Public/Css/colorbox.css?v1.3">
<script type="text/javascript" src="/Public/Js/colorbox.js?v1.3.19.3"></script>
<script type="text/javascript" src="/Public/Js/jquery.zxxbox.min.js?v4.0"></script>
<script type="text/javascript" src="/Public/Js/lhgcore.min.js?v1.4.5"></script>
<script type="text/javascript" src="/Public/Js/lhgcalendar.min.js?v2.0.3"></script>

				<br>
        <div class="loadingwrapper"><span class="loading"></span></div>
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