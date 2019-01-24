<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>错题录入</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
	<script src="/Public/jquery/jquery.min.js"></script>
	<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="/Public/bootstrap/js/bootstrap.min.js"></script>
<style type="text/css">
	input[type=checkbox]+span {
    /* your style goes here */
    display: inline-block;
    height: 15px;
    width: 15px;
    border-radius: 4px;
	background-image: url(/Public/img/unchecked.png);
	background-size: 100% 100%;
		margin-left: 2px;
		margin-top: 4px;
        }
	
	/* active style goes here */
	input[type=checkbox]:checked+span {
   	background-image: url(/Public/img/checked.png);
}
	
	
	
	.needitem input[type=checkbox]{
　　display: inline-block;
　　vertical-align: middle;

}
</style>
</head>
<body  id="myid"  class="background_color_checked">
	<div class="container">
	
	
		<div class="row title_class_transparent">
			<div class="col-xs-2"><a href="<?php echo U('task0101',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>"><img src="/Public/img/reg_back.png" class="title_left_img"></a></div>
			<div class="col-xs-8  title_font_middle " ><?php echo ($titlekind); ?>错题作业录入</div>
			<div class="col-xs-2"></div>		
		</div>
		
		<div class="row h6 parent_msg_panel">
			<p><?php echo ($paper_name); ?></p>
			<p>试题难度：A级别  考试时间：2017-4-12</p>
			<p>原始试卷查看</p>		
		</div>
		<div  class="row ">
			<div id="textul12" class="col-xs-12  parent_checked_panel" style="height: 432px;overflow-y: auto;padding-left: 0px;padding-right: 0px;">
			</div>
		</div>
		<div class="row parent_bottom_div">
		<div class="col-xs-6 parent_bottom_div_div" style="background-color: #48a0dc;"><a href="<?php echo U('task0101',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>"><img style="width: 20px;" class="img-responsive center-block" src="/Public/img/close.png"></a></div>
		<div class="col-xs-6 parent_bottom_div_div" style="background-color: #87c15e;"><a href="javascript:void(0)" onclick="submittest()"><img style="width:21px;"class="img-responsive center-block" src="/Public/img/ok.png"></a></div>
		</div>
		
	</div>
<input id="testid" type="hidden" value="<?php echo ($testid); ?>">
<input id="keynote_id" type="hidden" value="<?php echo ($keynote_id); ?>">
<input id="testkind" type="hidden" value="<?php echo ($testkind); ?>">
<input id="subjectid" type="hidden" value="<?php echo ($subjectid); ?>">
<input id="userid"  type="hidden" value="<?php echo ($userid); ?>">
<input id="username"  type="hidden" value="<?php echo ($username); ?>">
<input id="realname"  type="hidden" value="<?php echo ($realname); ?>">

</body>
<script type="text/javascript">
	$(document).ready(function(){



		var testid=$('#testid').val();
		var userid=$('#userid').val();
        var testkind=$('#testkind').val();

		$.ajax({
			url: "<?php echo U('testser');?>",
			type: 'POST',
			async:false,
			data: {testid:testid,userid:userid,testkind:testkind},
			dataType: 'json',
			success: function (re) {

				var count=re['count'];
              
				var htmlbegin='',htmlmid='',htmlend='',htmltext='';
				var j=0;
				for(var i=0;i<count;i++)
				{
					j=i+1;
					if(re[i]['ctbname']=='t1' || re[i]['ctbname']=='t0')
					{
                      
						htmlbegin=htmlbegin+re[i]['inputval'];
                      
                   //   	alert(htmlbegin);

						if(re[j]['ctbname']=='a' || re[j]['ctbname']=='t-a' || j!=count)
						{
							htmlbegin='<li><p>'+htmlbegin+'</p><p class="needitem">';
						}
					}

					if(re[i]['ctbname']=='a' || re[i]['ctbname']=='t-a')
					{
						htmlmid=htmlmid+'<label>'+re[i]['inputval']+'<input  type="checkbox" name="test" class="hidden-input"  typeid="'+re[i]['typeid']+'" value="'+re[i]['id']+'"/><span></span></label>';

						if(j!=count)
						{
//
							if(re[j]['ctbname']=='t1' || re[j]['ctbname']=='t0')
							{
								htmlend='</p><hr></li>';
								htmltext=htmltext+htmlbegin+htmlmid+htmlend;
								htmlbegin='';
								htmlmid='';
								htmlend='';
							}
						}
						else
						{
							htmlend='</p><hr></li>';
							htmltext=htmltext+htmlbegin+htmlmid+htmlend;
							htmlbegin='';
							htmlmid='';
							htmlend='';
						}

					}
				}

				htmltext='<ul  class="parent_p_color" style="padding-right: 6%;">'+htmltext+'</ul>';
              
              
             // alert(htmltext);
				$('#textul12').html(htmltext);

			}
		})
	})
  
  function submittest()
  {
    var testkind=$('#testkind').val();
    if(testkind=='stu')
    {
      stu_submittest();
    }
    else
    {
       key_submittest();
    }
  }

	function stu_submittest()
	{

		var questionarr='';
		var typeidarr='';

		$("input[name='test']").each(function(){
			if($(this).prop("checked")==true)
			{
				questionarr=questionarr+','+$(this).val();
				typeidarr=typeidarr+','+$(this).attr('typeid');
			}
		});

		var testid=$('#testid').val();
		var userid=$('#userid').val();
        var keynote_id=$('#keynote_id').val();

		questionarr=questionarr.substr(1);
		typeidarr=typeidarr.substr(1);

		if(questionarr=='')
		{
			alert('请选择相应的错题!!');
			return;
		}
      
		var subjectid=$('#subjectid').val();

		$.ajax({
			url: "<?php echo U('phpsubmittest');?>",
			type: 'POST',
			async:false,
			data: {testid:testid,userid:userid,questionarr:questionarr,typeidarr:typeidarr,keynote_id:keynote_id,subjectid:subjectid},
			dataType: 'text',
			success: function (re) {
					window.location.href ="/index.php/Home/Student/task0101/userid/"+$('#userid').val()+"/username/"+$('#username').val()+"/realname/"+$('#realname').val()+".html";
			}
		})


	}
  
  	function key_submittest()
	{

		var questionarr='';
		var typeidarr='';

		$("input[name='test']").each(function(){
			if($(this).prop("checked")==true)
			{
				questionarr=questionarr+','+$(this).val();
				typeidarr=typeidarr+','+$(this).attr('typeid');
			}
		});

		var testid=$('#testid').val();
		var userid=$('#userid').val();
        var keynote_id=$('#keynote_id').val();

		questionarr=questionarr.substr(1);
		typeidarr=typeidarr.substr(1);

		if(questionarr=='')
		{
			alert('请选择相应的错题!!');
			return;
		}
      
      //alert('testid:'+testid+',userid:'+userid+',questionarr:'+questionarr+',typeidarr:'+typeidarr+',keynote_id:'+keynote_id);
      
     // return;

		$.ajax({
			url: "<?php echo U('key_phpsubmittest');?>",
			type: 'POST',
			async:false,
			data: {testid:testid,userid:userid,questionarr:questionarr,typeidarr:typeidarr,keynote_id:keynote_id},
			dataType: 'text',
			success: function (re) {
					window.location.href ="/index.php/Home/Student/task0101/userid/"+$('#userid').val()+"/username/"+$('#username').val()+"/realname/"+$('#realname').val()+".html";
			}
		})


	}
</script>
</html>