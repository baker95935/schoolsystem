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

	<div class="container" style="height: 100%;">
		<div class="row title_class">
			<div class="col-xs-2"><a href="<?php echo U('managestu_keylist0405',array('userid'=>$userid,'username'=>$username,'realname'=>$realname,'keynote_id'=>$keynote_id,'stu_id'=>$stu_id,'stu_name'=>$stu_name,'subject_id'=>$subject_id));?>"><img src="/Public/img/reg_back.png" class="title_left_img"></a></div>
			<div class="col-xs-8  title_font_middle " ><?php echo ($keynotemsg); ?>(5次)</div>
			<div class="col-xs-2"><a href="<?php echo U('managestu_keylist0405',array('userid'=>$userid,'username'=>$username,'realname'=>$realname,'stu_id'=>$stu_id,'stu_name'=>$stu_name,'subject_id'=>$subject_id));?>" style="color: white;font-size: 15px;display: block;margin-top: 1px;">Key</a></div>
		</div>
		<div class="row parent_nav">
		<div class="col-xs-4" >
			<select class="blackselect" style="padding-left: -10px;">
				<option value ="volvo">2019</option>
			</select>

		</div>
			<div class="col-xs-4" style="border-right:1px solid #b9b9b9;">
                  <input type="text" onchange="searchdata();" name="keywords"  value='1' style="width: 100px;text-align: center;height: 22px;font-size: 13px;margin-top: 5px;border-radius: 3px;border:0px solid #FFFFFF;">
			</div>

			<div class="col-xs-4">
				<input type="text" onchange="searchdata();" name="keywords"  value='5' style="width: 100px;text-align: center;height: 22px;font-size: 13px;margin-top: 5px;border-radius: 3px;border:0px solid #FFFFFF;">
			</div>
		</div>
		<div class="row">
			<div id="mountNode" class="col-xs-12" style="height:600px;overflow-y: auto;padding-left:0px;">
				
			</div>
	  </div>
 
	<input id="userid" type="hidden" value="<?php echo ($userid); ?>">
	<input id="pagelength" type="hidden" value="5">
	<input id="testidarr" type="hidden" value="">
	<input id="questionsum" type="hidden" value="0">
    <input id="stu_id" type="hidden" value="<?php echo ($stu_id); ?>">
    <input id="stu_name" type="hidden" value="<?php echo ($stu_name); ?>">
    <input id="keynote_id" type="hidden" value="<?php echo ($keynote_id); ?>">
    <input id="subject_id" type="hidden" value="<?php echo ($subject_id); ?>">
    <input id="questioncount" type="hidden" value="0">

</body>
<script src="/Public/js/g2.min.js"></script>
<script src="/Public/js/data-set.min.js"></script>
<script>

	var chart = new G2.Chart({
  	container: 'mountNode',
  	forceFit: true,
  	height: window.innerHeight
	});
	chart.source(<?php echo ($data); ?>);
	chart.scale('num', {
  	min: 1
  });
	chart.scale('ratio', {
 	range: [0, 1]
});
	chart.tooltip({
  	crosshairs: {
    type: 'line'
  }
});
	chart.line().position('num*ratio');
	chart.point().position('num*ratio').size(4).shape('circle').style({
  	stroke: '#fff',
  	lineWidth: 1
});
	chart.render();
  
function a(){
	$('#canvas_1').css('width','400px');
    $('#canvas_1').css('height','500px');
}
  a();
  
  
</script>
</html>