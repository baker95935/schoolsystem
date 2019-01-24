<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>习题信息</title>
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
 </div>
	<div class="container" style="height: 100%;">
		<div class="row title_class">
			<div class="col-xs-2"><a href="<?php echo U('testmsg0201',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>"><img src="/Public/img/reg_back.png" class="title_left_img"></a></div>
			<div class="col-xs-8  title_font_middle " ><?php echo ($paper_name); ?></div>
			<div class="col-xs-2"><a href="<?php echo U('testmsg0203',array('userid'=>$userid,'paper_name'=>$paper_name,'classid'=>$classid,'testid'=>$testid,'username'=>$username,'realname'=>$realname));?>" style="color: white;font-size: 15px;display: block;margin-top: 1px;">习题</a></div>
		</div>
		<div class="row parent_nav">
		<div class="col-xs-3" >
 
		</div>
		<div class="col-xs-3">

			<select onchange="selectinfo()" name="class" id="class" class="blackselect">
				<option value="">班级</option>
				<?php if(is_array($classList)): foreach($classList as $key=>$item): ?><option value ="<?php echo ($item["id"]); ?>"><?php echo ($item["classname"]); ?></option><?php endforeach; endif; ?>
			</select>
		</div>
			<div class="col-xs-3">


			</div>

			<div class="col-xs-3">
			 	<select onchange="selectinfo()" name="group" id="group" class="blackselect">
					<option value="">群组</option>
					<?php if(is_array($groupList)): foreach($groupList as $key=>$item): ?><option value ="<?php echo ($item["id"]); ?>"><?php echo ($item["groupname"]); ?></option><?php endforeach; endif; ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div id="contentdiv" class="col-xs-12" style="height: 600px;overflow-y: auto;">
				<ol id="list1" style="list-style-type:none;font-size: 15px;margin-left: -30px;padding-top:10px;">
					<!--<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mydata): $mod = ($i % 2 );++$i;?><li>
							<div style="padding-left: 20px;padding-top: 4px;width: 330px;overflow-x:scroll;white-space: nowrap;">
								 <?php echo ($i); ?>.&nbsp;&nbsp;&nbsp;姓名：<?php echo ($mydata['realname']); ?>&nbsp;&nbsp;&nbsp;&nbsp;错误率：<?php echo ($mydata['ratio']); ?>&nbsp;&nbsp;&nbsp;&nbsp;群组：G<?php echo ($mydata['groupid']); ?>
							</div>
							<hr>
						</li><?php endforeach; endif; else: echo "" ;endif; ?> -->
				</ol>
				
				<div id="downdiv" onclick="nextpage()" style="width: 100%;height: 40px; text-align: center;">点击加载习题（<span id="nowpage">1</span>/<span id="pagenum">4</span>）</div>
				
              	<ol id="key_list1" style="list-style-type:none;font-size: 15px;margin-left: -30px;padding-top: 10px;display:none;">
				</ol>
				<div id="key_downdiv" onclick="key_nextpage()" style="width: 100%;height: 40px; text-align: center;display:none;">点击加载习题（<span id="key_nowpage">1</span>/<span id="key_pagenum">4</span>）</div>
				
			</div>
		</div>
		
		
		
	</div>


	<input id="userid" type="hidden" value="<?php echo ($userid); ?>">
	<input id="username" type="hidden" value="<?php echo ($username); ?>">
	<input id="realname" type="hidden" value="<?php echo ($realname); ?>">
	<input id="classid" type="hidden" value="<?php echo ($classid); ?>">
	<input id="paper_name" type="hidden" value="<?php echo ($paper_name); ?>">
	<input id="testid" type="hidden" value="<?php echo ($testid); ?>">
	
	
	<input id="pagelength" type="hidden" value="10">
	<input id="testidarr" type="hidden" value="">
	<input id="questionsum" type="hidden" value="0">

</body>

<script>
	$(function(){
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
		 
		var classinfo=$("#class").val();
		var group=$("#group").val();
		
		managetestdata(userid,nowpage,pagelength,classinfo,group);
	});
	function nextpage(){
		var nowpage=$('#nowpage').text();
		var maxnum=$('#pagenum').text();
		var userid=$('#userid').val();
		var pagelength=$('#pagelength').val();
		var classinfo=$("#class").val();
		var group=$("#group").val();
		

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
		managetestdata(userid,nowpage,pagelength,classinfo,group);
		selectele();


	}
	
	
	function selectinfo()
    {
		var classinfo=$("#class").val();
		var group=$("#group").val();
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
		 
		$('#list1').html('');
		managetestdata(userid,nowpage,pagelength,classinfo,group);
    }
	
	function managetestdata(userid,nowpage,pagelength,classinfo,group)
	{
		$.ajax({
			url:"<?php echo U('phptestmsg0202');?>",
			data:{userid:userid,nowpage:nowpage,pagelength:pagelength,classinfo:classinfo,group:group},
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
					if(nowpage>1) {
						j=i+1+(nowpage-1)*$('#pagelength').val();
					}
					testid=testlist[i]['testid'];
					//var ahtml='/index.php/Home/headteacher/managestu_test0403/userid/'+$('#userid').val()+'/username/'+$('#username').val()+'/realname/'+$('#realname').val()+'/stu_id/'+testlist[i]['userid']+'/stu_name/'+testlist[i]['realname'];
					
                  var ahtml='';
                  addhtmlmsg=addhtmlmsg+'<li><div style="padding-left: 20px;padding-top: 4px;width: 330px;overflow-x:scroll;white-space: nowrap;">'+j+'.&nbsp;&nbsp;&nbsp;姓名：<a href="'+ahtml+'">'+testlist[i]['realname']+'</a>&nbsp;&nbsp;&nbsp;&nbsp;错误率：'+testlist[i]['ratio']+'&nbsp;&nbsp;&nbsp;&nbsp;群组：'+testlist[i]['groupname']+'</div><hr></li>';
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
</script>
</html>