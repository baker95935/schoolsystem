<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>知识点辅导</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
	<link rel="stylesheet" type="text/css" href="/Public/css/stu.css"/>
	<script src="/Public/jquery/jquery.min.js"></script>
	<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="/Public/bootstrap/js/bootstrap.min.js"></script>
	<script src="/Public/js/public.js"></script>

	<script language="javascript">
		function work1(target) {
			//e.preventDefault();
			$("#dropdownMenu1").text($(target).text());
		}

		function work2(target) {
			//e.preventDefault();
			$("#dropdownMenu2").text($(target).text());
		}

		function work3(target) {
			//e.preventDefault();
			$("#dropdownMenu3").text($(target).text());
		}
	</script>
</head>
<body class="background_color">


<!--<div  data-toggle="modal" data-target="#myModal" style="position: absolute;z-index:100;width: 80px;height:80px;background-color: #1b6d85;border-radius: 40px;top:70%;left: 70%;color: #ffffff;font-size: 16px;padding-top: 28px;text-align: center;"><span>预览</span><span id="notesum" style="margin-left: 2px;"></span></div>-->

 </div>
	<div class="container" style="height: 100%;">
		<div class="row title_class">
			<div class="col-xs-2"><a href="<?php echo U('home',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>"><img src="/Public/img/reg_back.png" class="title_left_img"></a></div>
			<div class="col-xs-8  title_font_middle " >学生：<?php echo ($realname); ?></div>
			<div class="col-xs-2"><a  href="<?php echo U('stu_keytestlist0403',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>" style="color: white;font-size: 15px;display: block;margin-top: 1px;">Test</a></div>
		</div>
		<div class="row parent_nav">
		<div class="col-xs-4" >

			<select id="subjectid" onchange="searchdata()"  name="subjectid" class="blackselect" style="padding-left: -10px;">
              <?php if(is_array($subject_data)): $i = 0; $__LIST__ = $subject_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subject_data): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($subject_data["id"]); ?>"><?php echo ($subject_data["subjectmsg"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				
			</select>

		</div>
			<div class="col-xs-4">

				<select id="status" onchange="searchdata()"  name="status" class="blackselect">
					<option value="0">状态</option>
					<option value="1">添加完成</option>
					<option value="2">未添加</option>
				</select>
			</div>

			<div class="col-xs-4">
				<select id="order" onchange="searchdata()"  name="order" class="blackselect">
					<option value="0">排序</option>
					<option value="asc">Up</option>
					<option value="desc">Down</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div id="contentdiv" class="col-xs-12" style="height: 600px;overflow-y: auto;">
				<ol id="list1" style="list-style-type:none;font-size: 15px;margin-left: -30px;padding-top: 10px;">
                 <!--  <?php if(is_array($key_data)): $i = 0; $__LIST__ = $key_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$key_id): $mod = ($i % 2 );++$i;?><li>
							<div style="padding-left: 20px;padding-top: 4px;width: 330px;overflow-x:scroll;white-space: nowrap;">
                              <?php echo ++$m;?>.&nbsp;&nbsp;&nbsp;<?php echo ($key_id[keynotemsg]); ?><span>（</span><?php echo ($key_id[all_question_sum]); ?> <span>）</span>&nbsp;&nbsp;&nbsp;&nbsp;发布:<?php echo ($key_id[creattime]); ?>&nbsp;&nbsp;&nbsp;&nbsp;<a id="span<?php echo ($m); ?>" name="<?php echo ($key_id[question_sum]); ?>" keynote_id="<?php echo ($key_id[keynote_id]); ?>"  keynote_msg="<?php echo ($key_id[keynotemsg]); ?>" onclick="keydetailsub(this.id)">Add</a>
								<hr >
								<span style="margin-left: 16px;">最后练习:<?php echo ($key_id[lasttime]); ?>  &nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($key_id[question_w]); ?>/<?php echo ($key_id[question_sum]); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($key_id[ratio]); ?>%</span>
							</div>
							<hr color="#1b6d85" >
						</li><?php endforeach; endif; else: echo "" ;endif; ?> -->
				</ol>
			</div>
		</div>
	</div>

	<input id="userid" type="hidden" value="<?php echo ($userid); ?>">
    <input id="username" type="hidden" value="<?php echo ($username); ?>">
    <input id="realname" type="hidden" value="<?php echo ($realname); ?>">
	<input id="pagelength" type="hidden" value="10">
	<input id="testidarr" type="hidden" value="">
	<input id="questionsum" type="hidden" value="0">
    <input id="subjectid" type="hidden" value="<?php echo ($subject_id); ?>">
    <input id="subjectmsg" type="hidden" value="<?php echo ($subjectmsg); ?>">

</body>

<script>
	$(function(){
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
		
		var subjectid=$('#subjectid').val();
		var status=$("#status").val();
		var order=$("#order").val();
 
		managetestdata(userid,nowpage,pagelength,subjectid,status,order);
	});
	
	
	function searchdata()
	{
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
		
		var subjectid=$('#subjectid').val();
		var status=$("#status").val();
		var order=$("#order").val();
		
		$('#list1').html('');
		managetestdata(userid,nowpage,pagelength,subjectid,status,order);
	}
	
	function nextpage(){
		var nowpage=$('#nowpage').text();
		var maxnum=$('#pagenum').text();
		var userid=$('#userid').val();
		var pagelength=$('#pagelength').val();
		
		var subjectid=$('#subjectid').val();
		var status=$("#status").val();
		var order=$("#order").val();
		

		nowpage=nowpage*1+1;
		if(nowpage>maxnum)
		{
			return;
		}
		if(nowpage<1)
		{
			return;
		}

		$("tr[name='testlisttr']").remove();
		$('#nowpage').text(nowpage);
		managetestdata(userid,nowpage,pagelength,subjectid,status,order);
		selectele();


	}
	function managetestdata(userid,nowpage,pagelength,subjectid,status,order)
	{
		$.ajax({
			url:"<?php echo U('phpstukeylist0401');?>",
			data:{userid:userid,nowpage:nowpage,pagelength:pagelength,subjectid:subjectid,status:status,order:order},
			datatype:'json',
			type:'post',
			success:function(re){
				var testlist=eval("("+re+")");
				var addhtmlmsg = '';
				var beginhtml = $('#list1').html();
				var mylength = testlist['length'];

				var testid = '';
				var classid=testlist['classid'];
				var pagenum=testlist['pagenum'];
				var papername;
				$('#pagenum').text(pagenum);
				var j;
				for (var i = 0; i < mylength; i++) {
					j=i+1;
					testid=testlist[i]['testid'];
					papername=testlist[i]['num']+'. '+testlist[i]['paper_name']+'（'+testlist[i]['person_sum']+'/'+testlist[i]['classnum']+'）';
					var ahtml='/index.php/Home/HeadTeacher/managepaperdetail0202/testid/'+testid+'/classid/'+classid+'.html';
					//addhtmlmsg=addhtmlmsg+'<li><div style="padding-left: 20px;padding-top: 4px;width: 330px;overflow-x:scroll;white-space: nowrap;"><a style="color: #000000;" href="'+ahtml+'">'+papername+'</a><br><a style="margin-left: 20px;color: #000000;">'+testlist[i]['publish_time']+'</a><a style="margin-left: 15px;color: #000000;">Edit：'+testlist[i]['lastreadtime']+'</a></div></li><hr style="margin-top: 14px; margin-bottom: 10px;">';
					addhtmlmsg=addhtmlmsg+'<li><div style="padding-left: 20px;padding-top: 4px;width: 330px;overflow-x:scroll;white-space: nowrap;">'+j+'.&nbsp;&nbsp;&nbsp;'+testlist[i]['keynotemsg']+'<span>（</span>'+testlist[i]['all_question_sum']+'<span>）</span>&nbsp;&nbsp;&nbsp;&nbsp;发布:'+testlist[i]['creattime']+'&nbsp;&nbsp;&nbsp;&nbsp;<a id="span'+j+'" name="'+testlist[i]['question_sum']+'" keynote_id="'+testlist[i]['keynote_id']+'"  keynote_msg="'+testlist[i]['keynotemsg']+'" onclick="keydetailsub(this.id)">Add</a><hr><span style="margin-left: 16px;">最后练习:'+testlist[i]['lasttime']+'  &nbsp;&nbsp;&nbsp;&nbsp;'+testlist[i]['question_w']+'/'+testlist[i]['question_sum']+'&nbsp;&nbsp;&nbsp;&nbsp;'+testlist[i]['ratio']+'%</span></div><hr color="#1b6d85" ></li>';
					$('#list1').html(beginhtml + addhtmlmsg);
				}
			}
		})
	}
	function selectsub() {
		var mytestarr='';
		var ctsumarr='';
		var ctsum=0;
		$("input[name='testid']").each(function(){
			if($(this).prop("checked")==true)
			{

				mytestarr=mytestarr+','+$(this).val();
				ctsum=ctsum+$(this).attr('ctsum')*1;
			}
		});

		mytestarr=mytestarr.substr(1);

		$('#notesum').text('('+ctsum+')');
		$('#testidarr').val(mytestarr);
		$('#questionsum').val(ctsum);

	}
	function datasubmit(){
		var userid=$('#userid').val();
		var questionsum=$('#questionsum').val();
		var testidarr=$('#testidarr').val();
		var paper_name=$('#paper_name').val();

		if(paper_name=='')
		{
			alert('请输入试卷名称！！');
			return;
		}

		if(questionsum==0)
		{
			alert('请选择习题！！')
		}

		$.ajax({
			url:"<?php echo U('phpstumytestdata');?>",
			data:{userid:userid,testidarr:testidarr,questionsum:questionsum,paper_name:paper_name},
			datatype:'json',
			type:'post',
			success:function(re){
				window.location.href ="/index.php/Home/Student/managelist0202/userid/"+$('#userid').val()+".html";
			}
		});


	}
	function selectele(){

		var txt=','+$('#testidarr').val()+',';
		var parttxt;
		$("input[name='testid']").each(function(){
			parttxt=','+$(this).val()+',';
			if(hasstring(parttxt,txt))
			{
				$(this).attr("checked",true);
			}
		});
	}
  
  function keydetailsub(id)
  {
    var keynote_id=$('#'+id).attr('keynote_id');
    var keynote_msg=$('#'+id).attr('keynote_msg');
    var subject_id=$('#subjectid').val();
    var subjectmsg=$('#subjectmsg').val();
    
    var questionsum=$('#'+id).attr('name');
    

    
    if(questionsum=='0')
    {
      alert('知识点下没有习题！！');
      return;
    }
    
 
    
    window.location.href ="/index.php/Home/Student/stu_key_test0402/userid/"+$('#userid').val()+"/username/"+$('#username').val()+"/realname/"+$('#realname').val()+"/keynote_id/"+keynote_id+"/keynote_msg/"+keynote_msg+"/subject_id/"+subject_id+".html";
    // href="<?php echo U('stu_key_test0402',array('userid'=>$userid,'username'=>$username,'realname'=>$realname,'keynote_id'=>$key_id[keynote_id],'keynotemsg'=>$key_id[keynotemsg],'subject_id'=>$subject_id));?>"
  }
</script>
</html>