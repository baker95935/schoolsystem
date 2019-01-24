<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>考试信息</title>
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
	<div class="container" style="height: 100%;">
		<div class="row title_class">
			<div class="col-xs-2"><a href="<?php echo U('home',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>"><img src="/Public/img/reg_back.png" class="title_left_img"></a></div>
			<div class="col-xs-8  title_font_middle " >考试信息</div>
			<div class="col-xs-2"><a href="<?php echo U('managelist0202',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>" style="color: white;font-size: 15px;display: block;margin-top: 1px;"></a></div>
		</div>
		<div class="row parent_nav">
		<div class="col-xs-3" >

			<select class="blackselect" style="padding-left: -10px;">
				<option value ="volvo">科目</option>
				<option value ="volvo">数学</option>
				<option value ="saab">英语</option>
				<option value="opel">语文</option>
				<option value="audi">政治</option>
			</select>

		</div>
		<div class="col-xs-3">

			<select class="blackselect">
				<option value ="volvo">班级</option>
				<option value ="volvo">0102</option>
				<option value ="saab">1210</option>
				<option value="opel">1212</option>
			</select>
		</div>
			<div class="col-xs-3">

				<select class="blackselect">
					<option value ="volvo">群组</option>
					<option value ="volvo">G1</option>
					<option value ="saab">G2</option>
					<option value="opel">G3</option>
				</select>
			</div>

			<div class="col-xs-3">
				<select class="blackselect">
					<option value ="volvo">操作</option>
					<option value ="volvo">时间</option>
					<option value ="saab">标题</option>
					<option value="opel">年级</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div id="contentdiv" class="col-xs-12" style="height: 600px;overflow-y: auto;">
				<ol id="list1" style="list-style-type:none;font-size: 15px;margin-left: -30px;padding-top: 10px;">


				</ol>
				<div id="downdiv" onclick="nextpage()" style="width: 100%;height: 40px; text-align: center;">点击加载（<span id="nowpage">1</span>/<span id="pagenum">4</span>）</div>
			</div>
		</div>
	</div>


	<input id="userid" type="hidden" value="<?php echo ($userid); ?>">
	<input id="pagelength" type="hidden" value="10">
	<input id="testidarr" type="hidden" value="">
	<input id="questionsum" type="hidden" value="0">

</body>

<script>
	$(function(){
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
		managetestdata(userid,nowpage,pagelength);
	});
	function nextpage(){
		var nowpage=$('#nowpage').text();
		var maxnum=$('#pagenum').text();
		var userid=$('#userid').val();
		var pagelength=$('#pagelength').val();

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
		managetestdata(userid,nowpage,pagelength);
		selectele();


	}
	function managetestdata(userid,nowpage,pagelength)
	{
		$.ajax({
			url:"<?php echo U('phptestmsg0201');?>",
			data:{userid:userid,nowpage:nowpage,pagelength:pagelength},
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
					var ahtml='/index.php/Home/HeadTeacher/testmsg0202/testid/'+testid+'/classid/'+classid+'/paper_name/'+testlist[i]['paper_name']+'/userid/'+$('#userid').val()+'.html';
					addhtmlmsg=addhtmlmsg+'<li><div style="padding-left: 20px;padding-top: 4px;width: 330px;overflow-x:scroll;white-space: nowrap;"><a style="color: #000000;" href="'+ahtml+'">'+papername+'</a><a style="margin-left: 20px;color: #000000;">'+testlist[i]['time']+'</a><br><a style="margin-left: 15px;color: #000000;">Ave：'+testlist[i]['wrong_ratio']+'&nbsp;&nbsp;&nbsp;&nbsp;G1：'+testlist[i]['g1_wrong_ratio']+'&nbsp;&nbsp;&nbsp;&nbsp;G2：'+testlist[i]['g2_wrong_ratio']+'&nbsp;&nbsp;&nbsp;&nbsp;G3：'+testlist[i]['g3_wrong_ratio']+'</a></div></li><hr style="margin-top: 14px; margin-bottom: 10px;">';
					$('#list1').html(beginhtml + addhtmlmsg);
				}
			}
		})
	}

</script>
</html>