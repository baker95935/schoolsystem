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
			<div class="col-xs-2"><a href="<?php echo U('testmsg0202',array('userid'=>$userid,'username'=>$username,'realname'=>$realname,'testid'=>$testid,'classid'=>$classid,'paper_name'=>$paper_name));?>" style="color: white;font-size: 15px;display: block;margin-top: 1px;">学生</a></div>
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
					<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mydata): $mod = ($i % 2 );++$i;?><li>
							<div style="padding-left: 20px;padding-top: 4px;width: 330px;overflow-x:scroll;white-space: nowrap;">
								 <?php echo ($i); ?>.&nbsp;&nbsp;&nbsp;题号：<?php echo ($mydata['inputval']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;排序：<?php echo ($mydata['num']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($mydata['time']); ?>
							</div>
							<hr>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ol>
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
		//managetestdata(userid,nowpage,pagelength);
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
					var ahtml='/index.php/Home/HeadTeacher/managepaperdetail0202/testid/'+testid+'/classid/'+classid+'.html';
					addhtmlmsg=addhtmlmsg+'<li><div style="padding-left: 20px;padding-top: 4px;width: 330px;overflow-x:scroll;white-space: nowrap;"><a style="color: #000000;" href="'+ahtml+'">'+papername+'</a><br><a style="margin-left: 20px;color: #000000;">'+testlist[i]['publish_time']+'</a><a style="margin-left: 15px;color: #000000;">Edit：'+testlist[i]['lastreadtime']+'</a></div></li><hr style="margin-top: 14px; margin-bottom: 10px;">';
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