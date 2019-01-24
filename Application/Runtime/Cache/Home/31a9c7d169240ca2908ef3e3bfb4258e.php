<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>注册信息</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>

<script src="/Public/js/jquery.min.js"></script>
<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="/Public/bootstrap/js/bootstrap.min.js"></script>

<link href="/Public/cropper/cropper.min.css" rel="stylesheet">
<link href="/Public/sitelogo/sitelogo.css" rel="stylesheet">
<script src="/Public/cropper/cropper.min.js"></script>
<script src="/Public/sitelogo/sitelogo.js"></script>
</head>
<body class="background_color">
	<div class="container" style="text-align: center;color: black;">
		<div class="row" style="padding-top: 8px;z-index:-1;">
			<div id="back_div" class="col-xs-2" ><a href="index.html"><img src="/Public/img/reg.png" style="width:16px;height:13px;margin-top:10px;" ></a></div>
			<div class="col-xs-8 h5">用户注册</div>
			<div class="col-xs-2 h6" style="padding-left: 0px;padding-right: 0px;"><a data-toggle="modal" data-target="#myModal01" style="color: darkgray;">手机</a></div>
		</div>
		<div class="row" style="z-index:-1;">
			<div class="col-xs-12" style="background:url(/Public/img/bg_reg.jpg);background-size: 100% 100%; height: 150px;">
			</div>
		</div>
		<div class="row" style="margin-top: -10px;">
			<div class="col-xs-2"></div>
			<div class="col-xs-8" >
				<label>
				<img name="data" id="data1"  class="img-circle register_add_pic_a" src="/Public/img/addpic.png">
				</label>
			</div>
			<div class="col-xs-2"></div>
		</div>


		<div class="row">

			<div class="col-xs-1"></div>
			<div class="col-xs-10">
			<span class="warncss"><input name="warnmsg" type="hidden"></span>
			</div>
			<div class="col-xs-1"></div>
		</div>




		<div class="row">

			<div class="col-xs-1 textarea_height"></div>
			<div class="col-xs-10 textarea_unline textarea_height">
				<input id="input_box" name="input_name" onclick="clearsub()" type="text" class="name-input input_class textarea_line"  placeholder="用户名（手机号）" /></div>
			<div class="col-xs-1 textarea_height"></div>	
		</div>
		
		<div class="row">
			<div class="col-xs-1 textarea_height"></div>
			<div class="col-xs-10 textarea_unline textarea_height"><input onclick="clearsub()" id="pwd" name="pwd" type="password" class="name-input input_class textarea_line"  placeholder="请输入密码" /></div>
			<div class="col-xs-1 textarea_height"></div>	
		</div>
		
		<div class="row">
			<div class="col-xs-1 textarea_height"></div>
			<div class="col-xs-10 textarea_unline textarea_height"><input  onclick="clearsub()" id="pwd1" name="pwd1" type="password" class="name-input input_class textarea_line"  placeholder="请再次输入密码" /></div>
			<div class="col-xs-1 textarea_height"></div>	
		</div>
		
		<div class="row">
			<div class="col-xs-1 textarea_height"></div>
			<div class="col-xs-10 textarea_unline textarea_height">
			<table width="170" border="0"  class="table_middle">
  			<tbody>
  			  <tr>
  			    <td >选择身份</td>
   				   <td>
					<select id="status_select" name="status" onchange="statussub(this)"  class="name-input input_class textarea_line select_middle" style="margin-left: 0px;">
					<option style="text-align:center;"  value="0">学生</option>
					<option style="text-align:center;"   value="1">学生家长</option>
					<option style="text-align:center;"   value="2">班主任</option>
					<option style="text-align:center;"   value="3">任课教师</option>
					</select>
					</td>
   			 </tr>
  			</tbody>
			</table>
			</div>
			<div class="col-xs-1 textarea_height"></div>	
		</div>
		
		<div class="row">
			<div class="col-xs-1 textarea_height"></div>
			<div class="col-xs-10 textarea_unline textarea_height">
			<table width="240" border="0"  class="table_middle">
  			<tbody>
  			  <tr>
  			    <td ></td>
   				   <td onclick="clearsub()">
					<select id="school_select"  name="schoolmsg" class="name-input input_class textarea_line select_middle">
						<option value="">请选择学校</option>
						<?php if(is_array($area)): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$school): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($school['school_id']); ?>"><?php echo ($school['schoolname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					</td>
  			     <td ></td>
   				   <td onclick="clearsub()" id="tec_class_td" >
					<select id="myclass_select" name="classmsg" class="name-input input_class textarea_line select_middle" >
						<option value="1000">所属班级</option>
					</select>
					</td>
   			 </tr>
  			</tbody>
			</table>
			</div>
			<div class="col-xs-1 textarea_height"></div>	
		</div>
		
		
		<div class="row" id="subject_div" style="display: none;">
			<div class="col-xs-1 textarea_height"></div>
			<div class="col-xs-10 textarea_unline textarea_height">
			<table width="170" border="0" class="table_middle">
  			<tbody>
  			  <tr>
  			    <td >任职学科</td>
   				   <td>
					<select id="subject_select"   name="subjectmsg" class="name-input input_class textarea_line select_middle">
						<?php if(is_array($subjectmsgn)): $i = 0; $__LIST__ = $subjectmsgn;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subjectmsgi): $mod = ($i % 2 );++$i;?><option style="text-align:center;"  value="<?php echo ($subjectmsgi['id']); ?>"><?php echo ($subjectmsgi['subjectmsg']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					</td>
   			 </tr>
  			</tbody>
			</table>
			</div>
			<div class="col-xs-1 textarea_height"></div>	
		</div>
		
		<div class="row" style="display:none;" id="tec_class_div" >
			<div class="col-xs-1 textarea_height"></div>
			<div class="col-xs-10 textarea_unline textarea_height" >
			<table width="200" border="0" class="table_middle">
  			<tbody>
  			  <tr>
  			    <td style="width: 60px;" >任课班级</td>
   				  <td >
   				<div name="checkboxmsg[]" style="overflow-x: scroll;white-space:nowrap;width: 140px;padding-left: 10px;">
     			 任课班级信息
  			    </div>
				</td>
   			 </tr>
  			</tbody>
			</table>
			</div>
			<div class="col-xs-1 textarea_height"></div>	
		</div>
		
		<div class="row">
			<div class="col-xs-1 textarea_height"></div>
			<div class="col-xs-10 textarea_unline textarea_height"><input id="real_name" required="required" name="realname" type="text" class="name-input input_class textarea_line"  placeholder="输入您的真实姓名" /></div>
			<div class="col-xs-1 textarea_height"></div>	
		</div>
		
		<div class="row">
			<div class="col-xs-1 textarea_height"></div>
			<div class="col-xs-10 textarea_unline textarea_height"><input  type="text" class="name-input input_class textarea_line"  placeholder="获取手机验证码(未开通)" /></div>
			<div class="col-xs-1 textarea_height"></div>	
		</div>

			<div class="row" style="margin-top: 6%;padding-bottom: 10%;">
				<div class="col-xs-12 ">
					<input type="button" onclick="registeruser()" class="textarea_height buttonreg_bg" style="border:none;width: 100%;color: #ffffff;"value="提交注册信息">
				</div>
			</div>
		<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top:30%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel01">
							操作提示信息			
							</h4>
			</div>
			<div class="modal-body">
				您的信息提交成功！！您的的手机号输入有误！！
			</div>
			<div class="modal-footer " >
				<button type="button" class="btn btn-default" data-dismiss="modal" style="width:20%;background-color:#87c15d;color:white;" >关闭
				</button>
				<button type="button" class="btn btn-primary"  onclick="javascrtpt:window.location.href='index.html'" style="background-image: url(../img/button_Bg.png);width:20%;">
					确认
				</button>
			</div>
		
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>
		
	<div>
	
	<div class="modal fade" id="myModal01" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top:30%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel" style="text-align: center;">
				修改注册手机号					</h4>
			</div>
			<div class="modal-body">
				<div class="row">
			<div class="col-xs-1 textarea_height"></div>
			<div class="col-xs-10 textarea_unline textarea_height"><input required="required" type="text" class="name-input input_class textarea_line" style="text-align: center;"  placeholder="新手机号" /></div>
			<div class="col-xs-1 textarea_height"></div>	
		</div>
		<div class="row">
			<div class="col-xs-1 textarea_height"></div>
			<div class="col-xs-10 textarea_unline textarea_height" style="border-bottom: 0;"><input  required="required" type="text" class="name-input input_class textarea_line" style="text-align: center;" placeholder="请输入验证码" /></div>
			<div class="col-xs-1 textarea_height"></div>	
		</div>
			</div>
			<div class="modal-footer " >
				<button type="button" class="btn btn-default" data-dismiss="modal" style="width:20%;background-color:#87c15d;color:white;" >关闭
				</button>
				<button type="button" class="btn btn-primary"  data-dismiss="modal"  style="background-image: url(../img/button_Bg.png);width:20%;">
					确认
				</button>
			</div>
		
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>

		<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">

						<div class="modal-header">
							<button class="close" data-dismiss="modal" type="button">&times;</button>
							<h4 class="modal-title" id="avatar-modal-label">CtbSystem</h4>
						</div>
						<div class="modal-body">
							<div class="avatar-body">
								<div class="row">
									<div class="col-md-9">
									<label for="upload" class="btn upload" style="margin-bottom: 20px;"></label>
									<input class="avatar-input" id="upload1" name="avatar_file1" type="hidden">
									</div>
									<div class="col-md-3">
									</div>

								</div>
								<div class="row">
									<div class="col-md-9">
										<canvas id="cvs"  width="200px" height="200px" style="background-color: #E8E8E8;"></canvas>
									</div>
									<div class="col-md-3">
									</div>
								</div>

								<div class="row avatar-btns">

									<div class="col-md-12">
										<button class="btn btn-primary btn-block avatar-save" data-dismiss="modal"  onclick="addimgsub()" >保存修改</button>
									</div>
								</div>
							</div>
						</div>

				</div>
			</div>
		</div>
	</div>
	</div>

	<script>




//		var formData = new FormData();
//		var myfile;


		function registeruser()
		{
          
			var username=$('#input_box').val();
			var pwd=$('#pwd').val();
			//$("select[name='status'] option[value='xxx']").attr("selected","selected");
			var status_val=$("select[name='status'] option:selected").val();
			var schoolmsg_val=$("select[name='schoolmsg'] option:selected").val();
			var classmsg_val=$("select[name='classmsg'] option:selected").val();
			var subjectmsg_val=$("select[name='subjectmsg'] option:selected").val();
			var classes_val = $("input:checkbox[name='class1[]']:checked").map(function(index,elem) {
				return $(elem).val();
			}).get().join(',');
			var realname_val=$("#real_name").val();

//			alert(subjectmsg_val);

			if(username=='')
			{
				alert("请输入用户名！！");
				return;
			}

			var pwd=$('#pwd').val();
			var pwd1=$('#pwd1').val();
			if(pwd=="")
			{
				$("[name='warnmsg']").val("0");
				alert('请您输入密码！！');
				return;
			}

			if(pwd!=pwd1)
			{
				$("[name='warnmsg']").val("0");
				alert('您两次输入的密码不一致！！');
				return;
			}

			if(realname_val=="")
			{
				alert('请输入您的真实姓名!!');
				return;
			}
			if(schoolmsg_val>999)
			{
				alert('请您选择相应的学校！！');
				return;
			}

			if(status==0 || status==3)
			{
				classes_val=0;
			}

 

			$.ajax({
				url:"<?php echo U('Index/registeruser');?>",
				data:{username:username,pwd:pwd,status:status_val,schoolmsg:schoolmsg_val,classmsg:classmsg_val,subjectmsg:subjectmsg_val,classes:classes_val,realname:realname_val},
				dataType:'text',
				type:'post',
				success:function(re){

//					alert('NO:'+re);
					if(re==2)
					{
						alert('请输入用户名');
					}
					if(re==1)
					{
						alert('已有重名，请重新输入！！');
					}
					if(re==100)
					{
						alert('学生已经注册成功！！');
						window.location.href ="/index.php/Home/Index/index.html";
					}
					if(re==101)
					{
						alert('教师已经注册成功！！');
						window.location.href ="/index.php/Home/Index/index.html";
					}
				}
			})
			//alert(classes_val);
		}

	function test(id)
{
	alert($('#'+id).attr('name'));

	alert($("select[name='subjectmsg'] option:selected").val());

	alert($('#'+id).val());

	alert($("select[name='status'] option:selected").val());


}

		function justthissub()
		{
			$("[name='warnmsg']").val("1");

			var username=$('#input_box').val();
			var len=username.length;

			var username=$('#input_box').val();
			$.ajax({
				url:"<?php echo U('Index/justsub');?>",
				data:{username:username},
				dataType:'text',
				type:'post',
				success:function(re){

					if(re==0)
					{
						$("[name='warnmsg']").val("0");
						alert("手机号码已经存在！！");
						return 0;
					}


				}
			})
			var pwd=$('#pwd').val();
			var pwd1=$('#pwd1').val();
			if(pwd=="")
			{
				$("[name='warnmsg']").val("0");
				alert('请您输入密码！！');
				return 0;
			}

			if(pwd!=pwd1)
			{
				$("[name='warnmsg']").val("0");
				alert('您两次输入的密码不一致！！');
				return 0;
			}

			var realname=$('realname').val();
			if(realname=="")
			{
				$("[name='warnmsg']").val("0");
				alert('请输入您的真实姓名!!');
				return 0;
			}
			var statusid=$("[name='status']").val();
			var schoolid=$("[name='schoolmsg']").val();
			if(schoolid>999)
			{
				$("[name='warnmsg']").val("0");
				alert('请您选择相应的学校！！');
				return 0;
			}
			var classid=$("[name='classmsg']").val();
			var subjectid=$("[name='subjectmsg']").val();

		}

		$(function(){
			$("[name='schoolmsg']").change(function(){


				var school_id=$(this).val();

				if(school_id=="")
				{
					$("[name='classmsg']").html('<option value="1000">请选择</option>');
					$("[name='class1']").html('任课班级信息');
					return false;
				}

				var status=$("[name='status']").val();

				$("[name='classmsg']").html('<option>loading……</option>');

				$.ajax({
					url:"<?php echo U('Index/schoolandclass');?>",
					data:{ParentId:school_id},
					dataType:'json',
					type:'post',
					success:function(re){
						var html='';
						var item=re.data;
						var html1='';
						for(var i in item){
							html +='<option value="'+item[i]['id']+'" >'+item[i]['classname']+'</option>';
							html1+="&nbsp;&nbsp;"+'<input type="checkbox"  name="class1[]" value="'+item[i]['id']+'">'+"&nbsp;"+item[i]['classname'];
						}
						if(status!=3)
						{
						$("[name='classmsg']").html(html);
						}
						else
						{
							$("[name='classmsg']").html('<option value="">无</option>');
						}


						$("[name='checkboxmsg[]']").html(html1);


					}
				})
			})
		}
		)

		var input1 = document.getElementById("upload");

		if(typeof FileReader==='undefined'){
			input1.setAttribute('disabled','disabled');
		}else{
			input1.addEventListener('change',readFile,false);
		}
		function readFile(){
			var file = this.files[0];//获取上传文件列表中第一个文件
			if(!/image\/\w+/.test(file.type)){
				alert("文件必须为图片！");
				return false;
			}
			// console.log(file);
			var reader = new FileReader();//实例一个文件对象
			reader.readAsDataURL(file);//把上传的文件转换成url
			reader.onload = function(e){

				var file = $("#upload").get(0).files[0];
				data1 = document.getElementById("data1");

				var image = new Image();
				// 设置src属性
				image.src = e.target.result;
				var max=200;
				// 绑定load事件处理器，加载完成后执行，避免同步问题
				image.onload = function(){
					var canvas = document.getElementById("cvs");
					var ctx = canvas.getContext("2d");
					ctx.clearRect(0, 0, canvas.width, canvas.height);
					ctx.drawImage(image, 0, 0, 200, 200);

				};
			}
			addimgsub();
		};

		function addimgsub()
		{
			var file = $("#upload").get(0).files[0];

			if(file.size>410000)
			{
				alert("请输入小于4M的文件！！");
				return;
			}
			data1 = document.getElementById("data1");
			if(file!=null)
			{
			data1.src = window.navigator.userAgent.indexOf("Chrome") >= 1 || window.navigator.userAgent.indexOf("Safari") >= 1 ? window.webkitURL.createObjectURL(input1.files[0]) : window.URL.createObjectURL(input1.files[0]);
				$("#data1").removeClass("register_add_pic_a");
				$("#data1").addClass("register_add_pic_b");
			}
			else
			{
				data1.src="/Public/img/addpic.png";
				//
				$("#data1").removeClass("register_add_pic_b");
				$("#data1").addClass("register_add_pic_a");
			}
		}

		function clearsub() {
			$("#warnmsg").html("");
		}

		function statussub(ele){
		  var val=$(ele).val();

            //学生
            if(val==0)
            {
               $('#tec_class_td').css('display','');
               $('#tec_class_div').css('display','none');
               $('#subject_div').css('display','none');
            }
            //学生家长
            if(val==1)
            {
                $('#tec_class_td').css('display','');
                $('#tec_class_div').css('display','none');
                $('#subject_div').css('display','none');
            }
            //班主任
            if(val==2)
            {
                $('#tec_class_td').css('display','');
                $('#tec_class_div').css('display','');
                $('#subject_div').css('display','');
            }
            //任课教师
            if(val==3)
            {
                $('#tec_class_td').css('display','none');
                $('#tec_class_div').css('display','');
                $('#subject_div').css('display','');
            }

            //tec_class_td 所属班级，科任老师没有所属班级；tec_class_div//授课班级，学生家长没有授课班级；//subject_div，任职学科，学生和家长没有；
            //
            $("#warnmsg").html("");
        }
	</script>


</body>
</html>