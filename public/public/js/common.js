$(function(){
	//关闭按钮
	$('.close').click(function(){
		$(this).parent().fadeOut();
	});

	//ajax input表单提交
	var inputmodify=true;
	$('.inputmodify').click(function(){
		if(inputmodify){
			inputmodify=false; //编辑锁定

			var _this=$(this);
			var rawdata=_this.html();
			var primarykey=_this.attr('primarykey');
			var field=_this.attr('field');

			$(this).html('<input id="edit_'+primarykey+field+'" size=40 type="text" value="'+rawdata+'">');
			$("#edit_"+primarykey+field).focus();

			$("#edit_"+primarykey+field).blur(function(){
				var newdata=$(this).val();
				if(newdata == rawdata){	//无变化
					_this.html(newdata);
					loading(UNCHANGED,0);
					inputmodify=true;
					return false;
				}else{
					$.ajax({url:updateurl,timeout:60000,dataType:'json',type:'post',
							data:{'primarykey':primarykey,'field':field,'value':newdata,'rawdata':rawdata},
							beforeSend:function(){loading(PROCESSING,1);},
							success:function(returns){
								if(returns.status==1){
									_this.html(returns.data);
								  }else{
								  	_this.html(rawdata);
								  }
								loading(returns.info,0)
							},
							complete:function () {inputmodify= true;},
					 });
					return false;
				}
			});

		}
	});

   //数据删除操作
    $('.delete').click(function(){
    	var id=this.value;
    	$.ajax({url:delurl,timeout:60000,dataType:'json',type:'post',
    			data:{'id':id},
				beforeSend:function(){loading(PROCESSING,1);},
				success:function(returns){
					loading(returns.info,0);
					if(returns.status==1) setTimeout(function(){location.reload();},500);
				},
    	});
    });

    //状态禁用启用操作
     $('.statusacton').click(function(){
    	var id=this.value;
    	$.ajax({url:statusurl,timeout:60000,dataType:'json',type:'post',
    			data:{'id':id},
				beforeSend:function(){loading(PROCESSING,1);},
				success:function(returns){
					loading(returns.info,0);
					if(returns.status==1) $('#status_'+id).html(returns.data);
				},
    	});
    });

   //全选
	$("#selectAll").click(function() {
	$(".node").each(function() {
		$(this).attr("checked", true);
		});
	});
	//反选
	$("#selectFan").click(function() {
		$(".node").each(function() {
			if($(this).attr("checked"))
			{
				$(this).attr("checked", false);
			}
			else
			{
				$(this).attr("checked", true);
			}
		});
	});
	//取消全部
	$("#selectNone").click(function() {
		$(".node").each(function() {
			$(this).attr("checked", false);
			});
		});
		//alert
		$("#alertall").click(function() {
			$(".node").each(function() {
				if($(this).attr("checked"))
			{
				alert($(this).val());
			}
		});
	});

	//左栏菜单
	$('.tit').click(function (){
			$(this).next("li").slideToggle(300);
	});

	//邮件验证
	var emailverify=true;
	$('.emailverify').click(function(){
		id=this.value;
		if(emailverify){
			emailverify=false; //验证锁定
				$("#emailverifybox").zxxbox({'title':VERIFY});
				$.ajax({url:EMAIL_VERIFY_URL,timeout:60000,dataType:'json',type:'post',data:{'action':'geteid','id':id},
								beforeSend:function(){$('#result').html('<p id="tips">'+GET_EMAIL_PROCESSING+LOADINGIMG+'</p>')},
								success:function(returns){
									$('#tips').html(returns.info);
									if(returns.status==1){
											$('#result').append('<div id="progressbar"><div id="progressbg"></div><div id="progress">0 %</div></div><div id="verifyresult"></div>');
											var ids=returns.data;
											doverify(0,ids); //开始邮件验证
									}
								},
								error:function errorc(xhr,msg,error){
									$('#tips').html('<span class="failed">'+msg+'</span>');
								},
								complete:function () {emailverify= true;}
			});
		}
	});

	//展开发件人验证box
	$('.senderverify').click(function(){
			var i=this.value;
			var sender_email=$('#sender_email_'+i).text();
			$('#senderverifyresult').html('');
			$('#input_sender_email').val(sender_email);
			$("#senderverifybox").zxxbox({'title':sender_email+' '+VERIFY});
	});

	//发件人SES验证
	$('#senderverifysubmit').click(function(){
		$.ajax({url:sesverifyurl,timeout:60000,dataType:'json',type:'post',
						data:{'sender_email':$('#input_sender_email').val(),'account_id':$('select[name="account_id"]').val()},
						beforeSend:function(){
							$('#senderverifyresult').html(PROCESSING+LOADINGIMG);
						},
						success:function(returns){
							$('#senderverifyresult').html(returns.info);
						},
						error:function errorc(xhr,msg,error){
							$('#senderverifyresult').html('<span class="failed">'+msg+'</span>');
						},
		});
	});

	//展开账户测试box
	$('.accounttest').click(function(){
			var i=this.value;
			var account_name=$('#account_name_'+i).html();
			$('#accounttestresult').html('');
			$('#account_id').val(i);
			$("#accounttestbox").zxxbox({'title':account_name+'--'+ACCOUNTTEST});
	});

	//账户测试操作
	$('#accounttestsubmit').click(function(){
		$.ajax({url:accounttesturl,timeout:60000,dataType:'json',type:'post',
						data:{'receiver_email':$('#receiver_email').val(),'account_id':$('#account_id').val(),'sender_id':$('select[name="sender_id"]').val()},
						beforeSend:function(){
							$('#accounttestresult').html(PROCESSING+LOADINGIMG);
						},
						success:function(returns){
							$('#accounttestresult').html(returns.info);
						},
						error:function errorc(xhr,msg,error){
							$('#accounttestresult').html('<span class="failed">'+msg+'</span>');
						},
		});
	});

	//任务添加模板预览
	$('#unsubscribe_tpl_id,#tpl_id,#subscribe_failed_id,#subscribe_success_id').change(function(){
			tpl_id=$(this).val();
			name=$(this).attr('id');
			if(tpl_id=='') return $('#'+name+'_area').html('');
			$.get(themerequesturl,{'tpl_id':tpl_id},function(data){$('#'+name+'_area').html(data),'html'});
	});

	//任务测试
	$('.tasktest').click(function(){
			var task_id=this.value;
			var this_task=taskdetail[task_id];

			$('#tasktestresult').html('');

			$('#task_id').val(task_id);
			$('#account_ids').html(this_task['account_ids']);
			$('#assign_rule').html(this_task['assign_rule']);
			$('#sender_detail').html(this_task['sender_detail']);
			$('#group_name').html(this_task['group_name']);
			$('#transfer_group_name').html(this_task['transfer_group_name']);
			$('#tpl_name').html(this_task['tpl_name']);
			$('#unsubscribe_tpl_name').html(this_task['unsubscribe_tpl_name']);
			$('#name_format').html(this_task['name_format']);
			$('#china_ip_mark').html(this_task['china_ip_mark']);
			$('#subject').html(this_task['subject']);

			$("#tasktestbox").zxxbox({'title':this_task['task_name']+'--'+TASKTEST});
	});

		//账户测试操作
	$('#tasktestsubmit').click(function(){
		$.ajax({url:tasktesturl,timeout:60000,dataType:'json',type:'post',
						data:{'receiver_email':$('#receiver_email').val(),'task_id':$('#task_id').val()},
						beforeSend:function(){
							$('#tasktestresult').html(PROCESSING+LOADINGIMG);
						},
						success:function(returns){
							$('#tasktestresult').html(returns.info);
						},
						error:function errorc(xhr,msg,error){
							$('#tasktestresult').html('<span class="failed">'+msg+'</span>');
						},
		});
	});

	//任务发送
	$('.tasksend').click(function(){
			var task_id=this.value;
			var action=$(this).attr('rel');
			if(action=='sendnow'){
					dotasksend(task_id,action,0);
			}else{
					$('#scheduleresult').html('');
					$('#schedule_task_id').val(task_id);
					$("#schedulebox").zxxbox({'title':taskdetail[task_id]['task_name']+'--'+SCHEDULE_TIME});
			}
	});

	//定时发送操作
	$('#schedulesubmit').click(function(){
			var task_id=$('#schedule_task_id').val();
			var action='schedule';
			var sendtime=$('#schedule_time').val();
			dotasksend(task_id,action,sendtime);
	});

	//添加追销规则
	$('#addrule').click(function(){
			rule_id++;
			clone=$('#clone').html()+delrulimg;
			$('#autorule').append('<div id="rule_'+rule_id+'">'+clone+'</div>');
			$('#rule_'+rule_id+' > input').attr('name','rules['+rule_id+'][0]');
			$('#rule_'+rule_id+' > img').attr('rel',rule_id);
			$('#rule_'+rule_id+' > select').attr('name','rules['+rule_id+'][1]');
			$('#rule_'+rule_id+' > select').attr('id','rules['+rule_id+'][1]');
	});

})

//追销任务删除
function delrule(obj){
	del_id=$(obj).attr('rel');
	$('#rule_'+del_id).remove();
}

//任务发送操作
function dotasksend(task_id,action,sendtime){
		$.ajax({url:tasksendurl,timeout:60000,dataType:'json',type:'post',
						data:{'task_id':task_id,'action':action,'sendtime':sendtime},
						beforeSend:function(){
							if(action=='sendnow'){
								loading(PROCESSING,1);
							}else{
								$('#scheduleresult').html(PROCESSING+LOADINGIMG);
							}
						},
						success:function(returns){
							if(action=='sendnow'){
								loading(returns.info,0);
							}else{
								$('#scheduleresult').html(returns.info);
							}
							if(returns.status==1) setTimeout(function(){location.reload();},500);
						},
						error:function errorc(xhr,msg,error){
							$('#scheduleresult').html('<span class="failed">'+msg+'</span>');
						},
		});
}

//邮件验证处理
function doverify(idx,ids){
	id=ids[idx];
	$.ajax({url:EMAIL_VERIFY_URL,timeout:60000,dataType:'json',type:'post',data:{'action':'emailverify','id':id},
								beforeSend:function(){
									$('#verifyresult').append('<p id="process'+id+'">ID:'+id+PROCESSING+LOADINGIMG+'</p>');
								},
								success:function(returns){$('#process'+id).html(returns.info)},
								error:function errorc(xhr,msg,error){
									$('#process'+id).html('<span class="failed">'+msg+'</span>');
								},
								complete:function () {
									if(++idx < ids.length) {
										setprogress(idx,ids.length);
									 	doverify(idx,ids);
									}else{
										$('#result').append(VERIFY_COMPLETE);
									}
								},
	});
}

//进度条
  function setprogress(progress,total) {
		progress=progress+1;
		var percentage=parseInt(progress*100/total);
			if (progress) {$("#progressbg").css("width", String(percentage) + "%");$("#progress").html(String(percentage) + "%");}
	}

function loading(str,type){
	$(".loading").html(str);
	$(".loadingwrapper").show();
	if(type==0)	setTimeout(function(){$(".loadingwrapper").hide();},1000);
}