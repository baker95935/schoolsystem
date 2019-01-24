<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>已发布任务</title>
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
			<div class="col-xs-2"><a href="<?php echo U('home',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>"><img src="/Public/img/reg_back.png" class="title_left_img"></a></div>
			<div class="col-xs-7  title_font_middle " ><?php echo ($realname); ?></div>
			<div class="col-xs-3"><a href="<?php echo U('publishpaper0201',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>" style="color: white;font-size: 15px;display: block;margin-top: 1px;">未发布</a></div>
		</div>
		<div class="row parent_nav">
		<div class="col-xs-3" >
			<span style="margin-top:6px;display: block;">题量:-</span>
		</div>
		<div class="col-xs-3">

			<select onchange="searchdata();" name="classid" id="classid" class="blackselect">
				<option value ="">班级</option>
				<?php if(is_array($classList)): foreach($classList as $k=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" > <?php echo ($vo["classname"]); ?> </option><?php endforeach; endif; ?>
			</select>
		</div>
			<div class="col-xs-3">

				<select onchange="searchdata();" name="groupid" id="groupid" class="blackselect">
					<option value="">群组</option>
					<option value="1">G1</option>
					<option value="2">G2</option>
					<option value="3">G3</option>
				</select>
			</div>

			<div class="col-xs-3">
				<input type="text" onchange="searchdata();" name="keywords" id="keywords"  placeholder="关键词" style="width: 60px;text-align: center;height: 22px;font-size: 13px;margin-top: 5px;border-radius: 3px;border:0px solid #FFFFFF;">
 
			</div>
		</div>
		<div class="row">
			<div id="contentdiv" class="col-xs-12" style="height: 600px;overflow-y: auto;">
				<ol id="list1" style="list-style-type:none;font-size: 15px;margin-left: -30px;padding-top: 10px;">
				</ol>
					<div id="downdiv" onclick="nextpage()" style="width: 100%;height: 40px; text-align: center;">点击加载习题（<span id="nowpage">1</span>/<span id="pagenum">1</span>）</div>


			</div>
		</div>
	</div>


	<input id="userid" type="hidden" value="<?php echo ($userid); ?>">
	<input id="pagelength" type="hidden" value="10">
	<input id="testidarr" type="hidden" value="">
	<input id="questionsum" type="hidden" value="0">

</body>


<script>
	//页面初始化
	$(function(){
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
		var classid=$('#classid').val();
		var groupid=$('#groupid').val();
		var keywords=$('#keywords').val();
		
		testdata(userid,nowpage,pagelength,classid,groupid,keywords);
	});
	
	function searchdata()
	{
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
		var classid=$('#classid').val();
		var groupid=$('#groupid').val();
		var keywords=$('#keywords').val();
		$('#list1').html('');
		$('#nowpage').text(nowpage);
		testdata(userid,nowpage,pagelength,classid,groupid,keywords);
	}
	
	//下一页
	function nextpage(){
		var nowpage=$('#nowpage').text();
		var maxnum=$('#pagenum').text();
		var userid=$('#userid').val();
		var pagelength=$('#pagelength').val();
		var height=$('#contentdiv').scrollTop();
		var classid=$('#classid').val();
		var groupid=$('#groupid').val();
		var keywords=$('#keywords').val();

		nowpage=nowpage*1+1;
		if(nowpage>maxnum)
		{
			return;
		}
		if(nowpage<1)
		{
			return;
		}

		$('#nowpage').text(nowpage);
		testdata(userid,nowpage,pagelength,classid,groupid,keywords);
		$('#contentdiv').scrollTop(height);


	}


	//加载页面数据
	function testdata(userid,nowpage,pagelength,classid,groupid,keywords)
	{

		$.ajax({
			url:"<?php echo U('dataphpsql0202');?>",
			data:{userid:userid,nowpage:nowpage,pagelength:pagelength,classid:classid,groupid:groupid,keywords:keywords},
			datatype:'json',
			type:'post',
			success:function(re) {
				var testlist=eval("("+re+")");
				var addhtmlmsg = '';
				var beginhtml = $('#list1').html();
				var mylength = testlist['length'];
				var testid = '';
				var pagenum=testlist['pagenum'];
				$('#pagenum').text(pagenum);
				for (var i = 0; i < mylength; i++) {
					testid=testlist[i]['id'];
					//var ahtml='/index.php/Home/Headteacher/publicpaper_class0202/testid/'+testid+'/userid/'+$('#userid').val()+'/username/'+$('#username').val()+'/realname/'+$('#realname').val()+'/paper_name/'+testlist[i]['paper_name']+'.html';
					//addhtmlmsg=addhtmlmsg+'<li><a href="'+ahtml+'"><p class="h5">'+testlist[i]['num']+'.+testlist[i]['num']+</p> <p  class="h6">考试日期：'+testlist[i]['publish_time']+'；试题数：'+testlist[i]['questionsum']+'题。</p></a><hr></li>';
					//alert(testlist[i]['settime]']);
					addhtmlmsg=addhtmlmsg+ '<li>' +
					' <div style="padding-left: 10px;padding-top: 4px;width: 330px;overflow-x:scroll;white-space: nowrap;">' +
					' <span>'+testlist[i]['num']+'.</span><span style="margin-left: 5px;">'+testlist[i]['paper_name']+'</span><a id='+testlist[i]['id']+' href="javascript:void(0)" onclick="republicsub(this.id)"  style="margin-left: 60px;font-size:14px;font-weight: normal;">发布</a>' +
					'<br><div style="font-weight: normal;font-size: 13px;color: #3e3e3e;padding-top: 15px;">' +
					'<span style="margin-left: 15px;"> 发布：'+testlist[i]['settime']+'</span><span style="margin-left: 15px;">考试：'+testlist[i]['publish_time']+'</span><br>'+
					'<span style="margin-left: 15px;">班级：'+testlist[i]['class']+'</span><span  style="margin-left: 10px;">'+testlist[i]['group']+'</span></div></div>' +
					'<hr>' +
					'</li>'
					$('#list1').html(beginhtml + addhtmlmsg);
				}

			}

		});
	}

	function republicsub(id)
	{
		$.ajax({
			url: "<?php echo U('republicsub');?>",
			data: {testid:id},
					datatype: 'json',
					type: 'post',
					success: function (re) {
						$('#list1').html('');
						testdata($('#userid').val(),$('#nowpage').text(),$('#pagelength').val());
					}
			})
	}


</script>
</html>