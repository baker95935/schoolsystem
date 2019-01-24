<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh">
<head>
<title>错题本</title>

<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta author="极客标签：www.gbtags.com" />
<meta name="Description" content="描述" />
<meta name="Keywords" content="错题本" />

  
<!--<link rel="stylesheet" type="text/css" href="http://cdn.gbtags.com/twitter-bootstrap/3.2.0/css/bootstrap.min.css"/>-->
<link rel="stylesheet" type="text/css" href="/Public/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
  <style>
    html,body {height: 100%};
  </style>
</head>
<body id="body" style="min-height:600px;height:100%;overflow-y:scroll;">
<form action="<?php echo U('index');?>" method="post" enctype="multipart/form-data" >
<div class="container">
<div id="header_Div" class="row title_margintop">
  <div class="col-xs-4 h5 text-center"><a href="<?php echo U('registermsg');?>">注册账号</a></div>
  <div class="col-xs-4 h5 text-center"><a>密码找回</a></div>
  <div class="col-xs-4 h5 text-center"><a>河西教育局</a></div>
</div>
 <div  class="row" style="margin-top: 13%;">
  <div class="col-xs-1" ></div>
  <div id="middiv" class="col-xs-10">
  	  <div class="col-xs-12" style="height: 60px;" ></div>
  	  <div id="logo_Div" class="col-xs-12" ><img src="/Public/img/logo.png" style="width:80px; height: 98px; "></div>
  	  <div class="col-xs-12" style="height: 100px;" ></div>
  	  <div class="row" >

  	  <div id="input1" class="col-xs-12">

  	  <div class="row" style="color: black;">

  	  	<div class="col-xs-3 password_class" style="padding-left:0;padding-right:0;" ><span>用户名</span></div>

		   <div class="col-xs-7" style="height: 45px;padding-top: 13px;">
			<input type="input" value="<?php echo ($cookieusername); ?>" name="username" class="input_class" />
		  </div>
  	  	<div class="col-xs-2" style="height: 45px;"></div>
  	  </div>
		  </div>

  	  <div id="input2" class="col-xs-12">
  	  <div class="row" style="color: black;">
  	  	<div class="col-xs-3 password_class"><span>密码</span></div>
  	  	<div class="col-xs-7" style="height: 45px;padding-top: 13px;">
  	  	<input class="input_class" name="pwd" type="password" value="<?php echo ($cookiepwd); ?>"  />

		</div>

  	  	<div class="col-xs-2" style="height: 45px;text-align:left;"><a href="#"><img class="img-responsive center-block" src="/Public/img/ask.png"  style="margin-top:9px;width:25px;height:20px;"></a>

		</div>
  	    </div>
  	  </div>
  	  </div>
  		
  </div>
   
   
  <div class="col-xs-1"></div>
</div>
<div class="row" style="height:80px;" >
</div>
<div class="row" style="padding-right:28px;padding-left:28px;">
<div class="col-xs-10" style="text-align:center;padding-top: 13px; width: 100%;height:47px;background-color:#64cc59;" >
	<input type="submit"  style= "background-color:transparent;border: none;color: #ffffff; " value="登录"/>
</div>  
</div>

</div>
  <div id="footer1" class="row" style="text-align:center;padding-top: 13px; width: 100%;height:47px;background-color:#64cc59; margin-left:0px;display:none;" >
	<input type="submit"  style= "background-color:transparent;border: none;color: #ffffff; " value="登录"/>
</div>
  


</form>
</body>
</html>