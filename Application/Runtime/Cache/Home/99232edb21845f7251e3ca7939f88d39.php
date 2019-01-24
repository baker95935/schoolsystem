<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>我的主页</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
	<link rel="stylesheet" type="text/css" href="/Public/bootstrap/css/bootstrap.min.css"/>
	<script src="/Public/jquery/jquery.min.js"></script>
	<script src="/Public/bootstrap/js/bootstrap.min.js"></script>
</head>
<body class="background_color">
	<div class="container">

		<div class="row title_class">
			<div class="col-xs-2"><a href="<?php echo U('/home/index');?>"><img src="/Public/img/set.png" class="title_left_img"></a></div>
			<div class="col-xs-8  title_font_middle " ><?php echo ($realname); ?></div>
			<div class="col-xs-2"><a href="<?php echo U('/home/headteacher/setpage0101','userid='.$userid.'&username='.$username.'&realname='.$realname);?>"><img src="/Public/img/add_icon.png" class="title_right_img"></a></div>
		</div>
		<div class="row">
			<div class="col-xs-12 nav_background_pic"></div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 goal_font_middle"><p class="h3">今天12个新任务</p><p class="h5" >日期：2018-12-12</p><p class="h6">距离中考230天</p></div>
		</div>
		
		
		<div class="row" >
		<div class="row margin_middle" style="margin-top: 8%">
			<div class="col-xs-4">
			 
			 <table border="0" class="goal_middle">
  				<tbody>
  				  <tr>
   				   <td> <a href="<?php echo U('/home/headteacher/publishpaper0201','userid='.$userid.'&username='.$username.'&realname='.$realname);?>"><img   src="/Public/img/task_icon.png"></a></td>
  				  </tr>
  			  <tr>
    		  <td class="goal_font_middle">发布任务</td>
  			  </tr>
			  </tbody>
			</table>
				
				 
			</div>
			
			<div class="col-xs-4">
			 
			  <table border="0" class="goal_middle">
  				<tbody>
  				  <tr>
   				   <td class="margin_middle"><a href="<?php echo U('/home/headteacher/testmsg0201','userid='.$userid.'&username='.$username.'&realname='.$realname);?>"><img src="/Public/img/manage.png"></a></td>
  				  </tr>
  			  <tr>
    		  <td class="goal_font_middle">考试信息</td>
  			  </tr>
			  </tbody>
			</table>
				 
			</div>
			
			<div class="col-xs-4">
			 
			  <table border="0" class="goal_middle">
  				<tbody>
  				  <tr>
   				   <td><a href="<?php echo U('/home/headteacher/managestu0301','userid='.$userid.'&username='.$username.'&realname='.$realname);?>"> <img  src="/Public/img/class.png"></a></td>
  				  </tr>
  			  <tr>
    		  <td class="goal_font_middle">人员管理</td>
  			  </tr>
			  </tbody>
			</table>
				 
			</div>
		</div>
		
		<div class="row  margin_middle" >
			<div class="col-xs-4">
				 <!--<table border="0" class="goal_middle">-->
  				<!--<tbody>-->
  				  <!--<tr>-->
   				   <!--<td> <img  src="/Public/img/page.png"></td>-->
  				  <!--</tr>-->
  			  <!--<tr>-->
    		  <!--<td class="goal_font_middle">试卷生成</td>-->
  			  <!--</tr>-->
			  <!--</tbody>-->
			<!--</table>	-->
			</div>
			
			<div class="col-xs-4">
				 <!--<table border="0" class="goal_middle">-->
  				<!--<tbody>-->
  				  <!--<tr>-->
   				   <!--<td> <img  src="/Public/img/class_set.png"></td>-->
  				  <!--</tr>-->
  			  <!--<tr>-->
    		  <!--<td class="goal_font_middle">群组设置</td>-->
  			  <!--</tr>-->
			  <!--</tbody>-->
			<!--</table>	-->
			</div>
			
			<div class="col-xs-4">
				 <!--<table border="0" class="goal_middle">-->
  				<!--<tbody>-->
  				  <!--<tr>-->
   				   <!--<td> <img  src="/Public/img/msg.png"></td>-->
  				  <!--</tr>-->
  			  <!--<tr>-->
    		  <!--<td class="goal_font_middle">班级通知</td>-->
  			  <!--</tr>-->
			  <!--</tbody>-->
			<!--</table>	-->
			</div>
		</div>	
		
	</div>

</div>

<input id="realname" type="hidden" value="<?php echo ($realname); ?>">
<input id="username" type="hidden" value="<?php echo ($username); ?>">
<input id="userid" type="hidden" value="<?php echo ($userid); ?>">


</body>
<script>
	function urlsetpage0101()
	{
		var id=$('#userid').val();
		var username=$('#username').val();
		window.location.href ="../headteacher/setpage0101/userid/"+id+"/username/"+username+"/realname/"+realname+".html";
	}
</script>
</html>