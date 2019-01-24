<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>班级管理</title>
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
			<div class="col-xs-8  title_font_middle " >班级管理<?php echo ($class_name); ?></div>
			<div class="col-xs-2"><a href="<?php echo U('managelist0202',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>" style="color: white;font-size: 15px;display: block;margin-top: 1px;"></a></div>
		</div>
		<div class="row parent_nav">
		<div class="col-xs-4" >

			<select class="blackselect" style="padding-left: -10px;">
				<option value ="volvo">全部</option>
				<option value ="volvo">未通过</option>
				<option value ="saab">已通过</option>
			</select>

		</div>
		<div class="col-xs-4">
			<select class="blackselect">
				<option value ="volvo">群组</option>
				<option value ="volvo">G1</option>
				<option value ="saab">G2</option>
				<option value="opel">G3</option>
			</select>
		</div>
			<div class="col-xs-4">
				<select class="blackselect">
					<option value ="volvo">全部</option>
					<option value ="volvo">学生</option>
					<option value ="saab">家长</option>
				</select>
			</div>


		</div>
		<div class="row">
			<div id="contentdiv" class="col-xs-12" style="height: 600px;overflow-y: auto;">
				<ol id="list1" style="list-style-type:none;font-size: 15px;margin-left: -30px;padding-top: 10px;">
					<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mydata): $mod = ($i % 2 );++$i; echo ($mydata[msg]); endforeach; endif; else: echo "" ;endif; ?>
					<!--<li><span>1.</span><span style="margin-left: 16px;">小明</span><span  style="margin-left: 20px;">2018-09-12</span><select style="margin-left: 20px;" class="pageblackselect"><option>G3</option><option>G1</option><option>G2</option></select><select  style="margin-left: 20px;" class="pageblackselect"><option>冻结</option><option>通过</option><option>删除</option></select></li>-->
					<!--<hr>-->
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
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
	});


	function groupsub(ele)
	{
		var userid=$(ele).attr('name');
		var val=$(ele).val();

		$.ajax({
			url:"<?php echo U('phpgroupsub');?>",
			data:{userid:userid,groupval:val},
			datatype:'json',
			type:'post',
			async : false,
			success:function(re){

			}
		})
	}

	function kindsub(ele)
	{
		var userid=$(ele).attr('name');
		var val=$(ele).val();


		$.ajax({
			url:"<?php echo U('phpkindsub');?>",
			data:{userid:userid,val:val},
			datatype:'json',
			type:'post',
			async : false,
			success:function(re){
				if(re==1)
				{
					window.location.href ="/index.php/Home/HeadTeacher/managestu0301/userid/"+$('#userid').val()+".html";
				}else
				{

				}
			}
		})
	}
</script>
</html>