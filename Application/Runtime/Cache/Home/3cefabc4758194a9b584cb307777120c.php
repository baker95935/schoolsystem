<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>我的主页</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
  
  
<!--<link rel="stylesheet" type="text/css" href="http://cdn.gbtags.com/twitter-bootstrap/3.2.0/css/bootstrap.min.css"/>-->
<link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/bootstrap/css/bootstrap.min.css"/>
</head>
<body class="background_color">
	<div class="container">

		<div class="row title_class">
			<div class="col-xs-2"><a href="<?php echo U('/home/index');?>"><img src="/Public/img/set.png" class="title_left_img"></a></div>
			<div class="col-xs-8  title_font_middle " ><?php echo ($realname); ?>同学</div>
			<div class="col-xs-2"><img src="/Public/img/add_icon.png" class="title_right_img"></div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 nav_background_pic"></div>
		</div>
		
		<div class="row">
          <div class="col-xs-12 goal_font_middle"><p class="h3"><span>今天</span><span><?php echo ($count); ?></span><span>个新任务</span></p><p class="h5" >日期：<?php echo ($datemsg); ?></p><p class="h6">好好学习 天天向上</p></div>
		</div>
		
		
		<div class="row" >
		<div class="row margin_middle" style="margin-top: 8%">
			<div class="col-xs-4">
			 
			 <table border="0" class="goal_middle">
  				<tbody>
  				  <tr>
   				   <td> <a href="<?php echo U('task0101',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>"><img class="button_panl_img" src="/Public/img/task_icon.png"></a></td>
  				  </tr>
  			  <tr>
    		  <td class="goal_font_middle">我的任务</td>
  			  </tr>
			  </tbody>
			</table>
				
				 
			</div>
			
			<div class="col-xs-4">
			 
			  <table border="0" class="goal_middle">
  				<tbody>
  				  <tr>
   				   <td class="margin_middle"> <a href="<?php echo U('managetest0201',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>"><img class="button_panl_img" src="/Public/img/manage.png"></a></td>
  				  </tr>
  			  <tr>
    		  <td class="goal_font_middle">错题管理</td>
  			  </tr>
			  </tbody>
			</table>
				 
			</div>
			
			<div class="col-xs-4">

				<table border="0" class="goal_middle">
					<tbody>
					<tr>
						<td> <a href="<?php echo U('stu_keylist0401',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>"><img class="button_panl_img" src="/Public/img/msg.png"></a></td>
					</tr>
					<tr>
						<td class="goal_font_middle">知识点</td>
					</tr>
					</tbody>
				</table>



				 
			</div>
		</div>
		
		<div class="row  margin_middle" style="margin-top: 5%;margin-bottom: 5%;">
			<div class="col-xs-4">
				<table border="0" class="goal_middle">
					<tbody>
					<tr>
						<td><a href="<?php echo U('/home/student/managemsg0301','userid='.$userid.'&username='.$username.'&realname='.$realname);?>"> <img  src="/Public/img/class.png"></a></td>
					</tr>
					<tr>
						<td class="goal_font_middle">个人信息</td>
					</tr>
					</tbody>
				</table>
			</div>
			
			<div class="col-xs-4">
				 <table border="0" class="goal_middle">
  				<tbody>
  				  <tr>
   				   <td></td>
  				  </tr>
  			  <tr>
    		  <td class="goal_font_middle"></td>
  			  </tr>
			  </tbody>
			</table>	
			</div>
			
			<div class="col-xs-4">
				 <table border="0" class="goal_middle">
  				<tbody>
  				  <tr>
   				   <td> </td>
  				  </tr>
  			  <tr>
    		  <td class="goal_font_middle"></td>
  			  </tr>
			  </tbody>
			</table>	
			</div>
		</div>	
		
	</div>

</div>


</body>
</html>