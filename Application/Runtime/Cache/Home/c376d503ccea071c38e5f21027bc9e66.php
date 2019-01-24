<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<title>上传试卷</title>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="/Public/jquery/jquery.min.js"></script>
	<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="/Public/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
</head>
<body class="background_color">
<form  action="<?php echo U('pagepanel0102','userid='.$userid.'&username='.$username.'&realname='.$realname);?>" enctype="multipart/form-data" method="post">
<div class="container">
	<div class="row">
		<div class="col-xs-2 teacher_left_01"></div>
		<div class="col-xs-8 teacher_middle_01">
			<div id="teacher_middle_01_01" class="row">
				<div class="col-xs-6" style="text-align: left;"><a href="<?php echo U('home','userid='.$userid.'&username='.$username.'&realname='.$realname);?>"><img class="teacher_back_img" src="/Public/img/reg.png"></a></div>
				<div class="col-xs-6" style="text-align: right;"><div class="teacher_font">习题处理系统</div></div>			
			</div>
			<div id="teacher_middle_01_02" style="opacity: 0;height: 312px;" class="row">
			</div>
			<div  class="row teacher_middle_01_03">
			<div class="col-xs-2"><img class="teacher_img_01 " src="/Public/img/person.png"></div>
			<div class="col-xs-10">
					<select name="paperkind" class="name-input input_class_new textarea_line teacher_txt_margin" >
					<option  value="0">请选择试卷种类</option>
					<option  value="1">成品试卷</option>
						<option  value="2">个人试卷</option>
					</select>
			</div>
			</div>
			<div  class="row teacher_middle_01_03">
				<div class="col-xs-2"><img class="teacher_img_01 " src="/Public/img/person.png"></div>
				<div class="col-xs-10">
					<input name="subjectid" id="subject" type="hidden" value="<?php echo ($subjectid); ?>">
						<select id="gradeid_subject" name="gradeid_subject" class="name-input input_class_new textarea_line teacher_txt_margin" >
							<option  value="0">请选择学科年级</option>
							<?php if(is_array($data1)): $i = 0; $__LIST__ = $data1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subjectmsg): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($subjectmsg['val']); ?>"><?php echo ($subjectmsg['msg']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
				</div>
			</div>
			<div class="row teacher_middle_01_03">
			<div class="col-xs-2"><img class="teacher_img_02 " src="/Public/img/msg_icon.png"></div>
			<div class="col-xs-10">
				<select name="chapter" id="mychapterid" class="name-input input_class_new textarea_line teacher_txt_margin" ><option value="0">无相关数据!!</option>
				</select>



			</div>
			</div>
			<div  class="row teacher_middle_01_03">
			<div class="col-xs-2"><img class="teacher_img_02 " src="/Public/img/lock.png"></div>
			<div class="col-xs-10">
				<input name="publishtime" id="publishtimeid"  type="text" class="name-input input_class_new teacher_txt_margin" style="text-align:left;"  placeholder="考试时间：2018-06-19" required="required" onBlur="checkDate();" />
			</div>
			</div>
			<div class="row teacher_middle_01_03" >
			<div class="col-xs-2"><img class="teacher_img_02 " src="/Public/img/msg_icon.png"></div>
			<div class="col-xs-10">
				<input name="papername"   type="text" class="name-input input_class_new teacher_txt_margin" style="text-align: left;" placeholder="试卷名称" required="required"  />
			</div>
			</div>
			<div  class="row teacher_middle_01_03">
			<div class="col-xs-2"><img class="teacher_img_02 " src="/Public/img/tel_icon.png"></div>
			<div class="col-xs-10 textcss" style="padding-top: 14px;padding-left: 15px;">
				<a  data-toggle="modal" data-target="#myModal" onclick="bindchapter()">请选择知识点</a>
			</div>
			</div>	
		</div>
		<div class="col-xs-2 teacher_right_01"></div>
	</div>
	<div class="row teacher_bottom">
		<div class="col-xs-2"><a  href="<?php echo U('/home/headteacher/testlist0103','userid='.$userid.'&username='.$username.'&realname='.$realname);?>"><img class="teacher_bottom_left_img_a img-responsive center-block " src="/Public/img/setpage_04_a.gif"></a></div>
		<div class="col-xs-8 teacher_bottom_middle"><button type="submit" style="height: 100%;width: 100%;background: transparent;border: 0px;">确认提交习题</button></div>
		<div class="col-xs-2"><img class="teacher_bottom_right_img img-responsive center-block " src="/Public/img/setpage_06.png"></div>
	</div>
	
		<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top:50px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel01">
							请选择您需要的知识点			
			  </h4>
			</div>
			<div id='checkboxarea' class="modal-body" name="checkboxarea">
		  </div>
			<div class="modal-footer " >
				<button type="button" class="btn btn-primary"  data-dismiss="modal" style="width:20%;">
					确认
				</button>
			</div>
		
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>

</div>
	</form>

<input type="hidden" name="subjectid" value="<?php echo ($subjectid); ?>" >

<script>
	$(function() {
		$("[name='gradeid_subject']").change(function () {


					var subjectid =$("#subject").val();
					var subjecttext =$("#gradeid_subject").find("option:selected").text();
			        var gradeid= $(this).val();
					var inhtml='';

					$.ajax({
						url:"<?php echo U('headteacher/selectmsg');?>",
						data:{gradeid:gradeid,subjectid:subjectid,subjecttext:subjecttext},
						dataType:'json',
						type:'post',
						success:function(re){

							var sum=re['count'];

							if(gradeid=='all')
							{
								inhtml=inhtml+'<option value='+re['id']+'  style="margin: 0 auto;">'+re['chaptermsg']+'</option>';
								$('#mychapterid').html(inhtml);
							}
							else
							{
								if(sum!=0)
								{
									for(var i=0;i<sum;i++)
									{

										inhtml=inhtml+'<option value='+re[i]['id']+'  style="margin: 0 auto;">'+re[i]['chaptermsg']+'</option>';

									}

									inhtml='<option value='+re['top']['id']+'  style="margin: 0 auto;">'+re['top']['chaptermsg']+'</option>'+inhtml;
									$('#mychapterid').html(inhtml);
								}
								else
								{
									inhtml=inhtml+'<option value="0">无相关数据！！</option>';
									$('#mychapterid').html(inhtml);
								}

							}


						}
					})
//			bindchapter(subjectid,gradeid);
			//bindchapter();
				}
		)
	}
	)

	function bindchapter(){

		var kind=$('#mychapterid').val();
		var subjectid =$("#subject").val();
		var gradeid=$("[name='gradeid_subject']").val();

		var chapter=$('#mychapterid').val();

//		alert(chapter);
//
//		return;


//		var chapter=1;
//		var partid=1;

//		alert(gradeid);
//
//		return;

//		alert(kind);

		if(kind=='subject')
		{
			kind=1;
		}
		else
		{
			if(kind=='chapter')
			{
				kind=2;
			}
			else
			{
				kind=3;
			}
		}


		var inhtml='';
		var count='';
		var itemhtml='';
		$.ajax({
			url:"<?php echo U('headteacher/keynotearr');?>",
			data:{kind:kind,gradeid:gradeid,subjectid:subjectid,chapter:chapter},
			dataType:'json',
			type:'post',
			success:function(re){

				count=re['count'];
				var begin=1;
				var begin1=1;
				var chapterbegin=1;

				if(kind==1)
				{
					for(var i=0;i<count;i++)
					{
						if(re[i]['chapterkind']==2)
						{
							if(begin==1)
							{
								inhtml=inhtml+'<span style="color: #2b55af;">'+re[i]['grademsg']+re[i]['subjectmsg']+'</span>';
								begin=100;
							}
							else
							{
								inhtml=inhtml+'<br><span style="color: #2b55af;">'+re[i]['grademsg']+re[i]['subjectmsg']+'</span>';
								chapterbegin=1;
							}

						}
						if(re[i]['chapterkind']==3)
						{

							if(begin1==1)
							{
								inhtml=inhtml+'<br><span style="color: #68729e;">'+re[i]['chaptermsg']+'</span><hr style="margin-top: 4px;margin-bottom: 4px; height:2px;border:none;border-top:1px dotted #185598;" >';
								begin1=100;
							}
							else
							{
								if(chapterbegin==1)
								{
									inhtml=inhtml+'<br><span style="color: #68729e;">'+re[i]['chaptermsg']+'</span><hr style="margin-top: 4px;margin-bottom: 4px; height:2px;border:none;border-top:1px dotted #185598;" >';
									chapterbegin=100;

								}
								else
								{
									inhtml=inhtml+'<br><span style="color: #68729e;">'+re[i]['chaptermsg']+'</span><hr style="margin-top: 4px;margin-bottom: 4px; height:2px;border:none;border-top:1px dotted #185598;" >';
								}

							}

						}
						if(re[i]['chapterkind']==4)
						{
							var itemcount=re[i]['arr_count'];


							for(var m=0;m<itemcount;m++)
							{
								itemhtml=itemhtml+'<label  style="margin-left: 6px;" ><input type="checkbox" name="keynotemsg[]" style="margin-left: 6px;margin-right: 6px;" value="'+re[i]['arr_id'][m]+'">'+re[i]['arr_val'][m]+'</label>';
							}
							inhtml=inhtml+'<span style="margin-top: 2px;">'+re[i]['part']+'<br>'+itemhtml+'</span><br>';
							itemhtml='';
						}
					}

					$('#checkboxarea').html(inhtml);
				}

				if(kind==2)
				{
					for(var i=0;i<count;i++)
					{
						if(re[i]['chapterkind']==3)
						{

							inhtml=inhtml+'<span style="color: #68729e;">'+re[i]['chaptermsg']+'</span><hr style="margin-top: 4px;margin-bottom: 4px; height:2px;border:none;border-top:1px dotted #185598;" >';
							begin1=100;

						}
						if(re[i]['chapterkind']==4)
						{
							var itemcount=re[i]['arr_count'];

							for(var m=0;m<itemcount;m++)
							{
								itemhtml=itemhtml+'<label  style="margin-left: 6px;" ><input type="checkbox" name="keynotemsg[]" style="margin-left: 6px;margin-right: 6px;" value="'+re[i]['arr_id'][m]+'">'+re[i]['arr_val'][m]+'</label>';
							}
							inhtml=inhtml+'<span style="margin-top: 2px;">'+re[i]['part']+'<br>'+itemhtml+'</span><br>';
							itemhtml='';
						}
					}
					$('#checkboxarea').html(inhtml);
				}

				if(kind==3)
				{

					for(var i=0;i<count;i++)
					{
						if(re[i]['chapterkind']==3)
						{

							inhtml=inhtml+'<span style="color: #68729e;">'+re[i]['chaptermsg']+'</span><hr style="margin-top: 4px;margin-bottom: 4px; height:2px;border:none;border-top:1px dotted #185598;" >';
							begin1=100;

						}
						if(re[i]['chapterkind']==4)
						{
							var itemcount=re[i]['arr_count'];

							for(var m=0;m<itemcount;m++)
							{
								itemhtml=itemhtml+'<label  style="margin-left: 6px;" ><input type="checkbox" name="keynotemsg[]" style="margin-left: 6px;margin-right: 6px;" value="'+re[i]['arr_id'][m]+'">'+re[i]['arr_val'][m]+'</label>';
							}
							inhtml=inhtml+'<span style="margin-top: 2px;">'+re[i]['part']+'<br>'+itemhtml+'</span><br>';
							itemhtml='';
						}
					}
					$('#checkboxarea').html(inhtml);


				}


			}
		})

	}

	function checkDate(){
		var DATE_FORMAT = /^[0-9]{4}-[0-1]?[0-9]{1}-[0-3]?[0-9]{1}$/;
		var publishtimeid = document.getElementById("publishtimeid").value;
		if(DATE_FORMAT.test(publishtimeid)){
//			alert("您输入的日期格式正确");
		} else {
			alert("正确格式为2018-01-01");
		}
	}



</script>

</body>
</html>