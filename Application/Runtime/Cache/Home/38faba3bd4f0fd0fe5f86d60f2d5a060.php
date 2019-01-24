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
	 <style>::-webkit-scrollbar{display:none;}html,body{overflow:hidden;height:100%;margin:0;}</style>
</head>
<body class="background_color">


<!--<div  data-toggle="modal" data-target="#myModal" style="position: absolute;z-index:100;width: 80px;height:80px;background-color: #1b6d85;border-radius: 40px;top:70%;left: 70%;color: #ffffff;font-size: 16px;padding-top: 28px;text-align: center;"><span>预览</span><span id="notesum" style="margin-left: 2px;"></span></div>-->

 </div>
	<div class="container" style="height: 100%;">
		<div class="row title_class">
			<div class="col-xs-2"><a href="<?php echo U('managestuscore0401',array('userid'=>$userid,'username'=>$username,'realname'=>$realname,'keynote_id'=>$keynote_id));?>"><img src="/Public/img/reg_back.png" class="title_left_img"></a></div>
			<div class="col-xs-8  title_font_middle " >学生：<?php echo ($stu_name); ?></div>
			<div class="col-xs-2"><a href="<?php echo U('managestu_test0403',array('userid'=>$userid,'username'=>$username,'realname'=>$realname,'stu_id'=>$stu_id,'stu_name'=>$stu_name,'subject_id'=>$subject_id));?>" style="color: white;font-size: 15px;display: block;margin-top: 1px;">Test</a></div>
		</div>
		<div class="row parent_nav">
		<div class="col-xs-3" >

			<select class="blackselect" style="padding-left: -10px;">
				<option value ="volvo">数学</option>
			</select>

		</div>
		<div class="col-xs-3">

			<select class="blackselect">
				<option value ="volvo">题型</option>
				<option value ="volvo">选择</option>
				<option value ="saab">填空</option>
				<option value="opel">简答</option>
			</select>
		</div>
			<div class="col-xs-3">

				<select class="blackselect">
					<option value ="volvo">状态</option>
					<option value ="volvo">添加完成</option>
					<option value ="saab">未添加</option>
				</select>
			</div>

			<div class="col-xs-3">
				<select class="blackselect">
					<option value ="volvo">排序</option>
					<option value ="volvo">Up</option>
					<option value ="saab">Down</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div id="mountNode" class="col-xs-12" style="height: 600px;overflow-y: auto;">
				
			</div>
		</div>
	</div>

	<input id="userid" type="hidden" value="<?php echo ($userid); ?>">
	<input id="pagelength" type="hidden" value="10">
	<input id="testidarr" type="hidden" value="">
	<input id="questionsum" type="hidden" value="0">
    <input id="stu_id" type="hidden" value="<?php echo ($stu_id); ?>">

</body>

<script>/*Fixing iframe window.innerHeight 0 issue in Safari*/document.body.clientHeight;</script>
<script src="/Public/js/g2.min.js"></script>
<script src="/Public/js/data-set.min.js"></script>
<script>
 $(function(){
 test();
 })
  
  function test()
  {
 
var chart = new G2.Chart({
  container: 'mountNode',
  forceFit: true,
  height: window.innerHeight
});
chart.source(<?php echo ($data); ?>);
chart.scale('wrong', {
  min: 0
});
chart.scale('times', {
  range: [0, 1]
});
chart.tooltip({
  crosshairs: {
    type: 'line'
  }
});
chart.line().position('times*wrong');
chart.point().position('times*wrong').size(4).shape('circle').style({
  stroke: '#fff',
  lineWidth: 1
});
chart.render();
  }
</script>
</html>