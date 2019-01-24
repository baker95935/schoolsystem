<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>我的主页</title>


<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link rel="stylesheet" type="text/css" href="http://cdn.gbtags.com/twitter-bootstrap/3.2.0/css/bootstrap.min.css"/>-->

	<script src="/Public/jquery/jquery.min.js"></script>
	<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="/Public/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>


 <style type="text/css">
	input[type="checkbox"]:checked+label {color: #345ee5;}
	input[type="checkbox"] {
    position: absolute;
    clip: rect(0, 0, 0, 0);
}
	input[type="checkbox"]+label{margin-left: 35px;color:#7b7a7a;font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana," sans-serif";font-weight:lighter;}
	
	</style>
</head>
<body>
	<div class="container">
		<div class="row title_class">
			<div class="col-xs-2"><a href="<?php echo U('publishpaper0201',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>"><img src="/Public/img/reg_back.png"  class="title_left_img"></a></div>
			<div class="col-xs-8  title_font_middle " ><?php echo ($realname); ?>老师</div>
			<div class="col-xs-2 " ><div class="a_white"><a href="javascript:void(0)" onclick="location.reload()">重置</a></div></div>		
		</div>	
		<div class="row teacher_puclicpaper_class">
		<div class="col-xs-1"></div>
		<div class="col-xs-10 teacher_class_msg">
		<div class="row">
		<img class="img-responsive center-block teacher_publicpaper_img_icon" src="/Public/img/paper_icon_img.png" >
		</div>
		<div class="row h4" style="text-align:center;">
			<span><?php echo ($paper_name); ?></span>
			<hr style="width: 80%;">
			<div style="width: 100%; text-align: left;padding-left: 12%">
			<p class="h5">
			 <label >班级</label>
				<?php if(is_array($myclass)): $i = 0; $__LIST__ = $myclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$myclassid): $mod = ($i % 2 );++$i;?><input id="<?php echo ($m++); ?>" type="hidden">
					<input type="checkbox" name="options" id="option<?php echo ($m); ?>" value="<?php echo ($myclassid["classid"]); ?>"><label for="option<?php echo ($m); ?>"> <?php echo ($myclassid["classname"]); ?>
				</label><?php endforeach; endif; else: echo "" ;endif; ?>
			<hr style="width: 80%;">
			</p>
			
			
			<p class="h5">
			<label >群组</label>
				
				<?php if(is_array($groupid)): $i = 0; $__LIST__ = $groupid;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mygroupid): $mod = ($i % 2 );++$i;?><input type="checkbox" name="group" id="group<?php echo ($mygroupid); ?>" value="<?php echo ($mygroupid); ?>"><label for="group<?php echo ($mygroupid); ?>">G<?php echo ($mygroupid); ?></label><?php endforeach; endif; else: echo "" ;endif; ?>
			<hr style="width: 80%;">
			</p>

			</div>
			
			<p class="h5">
			<label >发布对象</label>
			<input type="checkbox" name="object" checked='checked' id="object1" value="0"><label for="object1">学生</label>
			<input type="checkbox" name="object" id="object2" value="1"><label for="object2">家长</label>
			<hr style="width: 80%;">
			</p>
			

		</div>
		<div class="row">
			<div class="col-xs-6">
				<div  class="teacher_public_bottom_button" style="background-color:#48a0dc;margin-left: 27%;"><a onclick="uploadsub()" href="javascript:void(0)">确认发布</a></div>
			</div>
			<div class="col-xs-6">
				<div  class="teacher_public_bottom_button" style="background-color:#ed7161;margin-left:3%;"><a href="<?php echo U('home',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>">取消发布</a></div>
			</div>
		</div>
			
		</div>
		<div class="col-xs-1"></div>
		</div>		
		
	</div>
<input id="testid" type="hidden" value="<?php echo ($testid); ?>">
<input id="userid" type="hidden" value="<?php echo ($userid); ?>">
<input id="username" type="hidden" value="<?php echo ($username); ?>">
<input id="realname" type="hidden" value="<?php echo ($realname); ?>">


</body>
<script>

	$(function(){
		haveclassgroup();
	})


	function uploadsub(){

		var classarray = '';
		$('input:checkbox[name=options]:checked').each(function(k){
			if(k == 0){
				classarray = $(this).val();
			}else{
				classarray += ','+$(this).val();
			}
		})


		var grouparray = '';
		$('input:checkbox[name=group]:checked').each(function(k){
			if(k == 0){
				grouparray = $(this).val();
			}else{
				grouparray += ','+$(this).val();
			}
		})

		var objectarray = '';
		$('input:checkbox[name=object]:checked').each(function(k){
			if(k == 0){
				objectarray = $(this).val();
			}else{
				objectarray += ','+$(this).val();
			}
		})


		var testid=$('#testid').val();
		var userid=$('#userid').val();


		$.ajax({
			url: "<?php echo U('headteacher/publicpapersql');?>",
			type: 'POST',
			async:false,
			data: {testid:testid,userid:userid,classarray:classarray,grouparray:grouparray,objectarray:objectarray},
			dataType: 'json',
			success: function (re) {
				window.location.href ="/index.php/Home/headteacher/publishpaper0201/userid/"+userid+"/username/"+$('#username').val()+"/realname/"+$('#realname').val()+".html";
			}
		})

	}
//  已有班级和群组信息
	function haveclassgroup(){
		var testid=$('#testid').val();
      
     // alert(testid);
      
     // return;
		$.ajax({
			url:"<?php echo U('phpclassgroup');?>",
			data:{testid:testid},
			datatype:'json',
			type:'post',
			success:function(re){
				var classgroup=eval("("+re+")");
              
              var kind=classgroup['kind'];
             if(kind==1)
             {
				var classarr = classgroup['classid_arr'].split(',');
				for(var i in classarr){
					$("input[name='options']").each(function() {
						var this_val = $(this).val();
						if(this_val==classarr[i])
						{
							$(this).prop("checked", true);
						}
					});
				}
				var grouparr = classgroup['groupid_arr'].split(',');
				for(var j in grouparr){
					$("input[name='group']").each(function() {
						var this_val = $(this).val();


						if(this_val==100 && grouparr=='1,2,3')
						{
							$(this).prop("checked", true);
						}

						if(this_val==grouparr[j])
						{
							$(this).prop("checked", true);
						}
					});
				}
			}
            }
		})
	}

	// 绑定预览函数
	$("input[name='group']").bind("click",function(){

		var msg=$(this).prop("checked");

		var myval=$(this).val();

		if(myval==100)
		{
			if(msg==true)
			{
				$("input[name='group']").prop("checked", true);
			}
			else
			{
				$("input[name='group']").removeAttr('checked',false);
			}
		}
		else
		{
			$('#group100').removeAttr('checked');
		}


	});


</script>
</html>