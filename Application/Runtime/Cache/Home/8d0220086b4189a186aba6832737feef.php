<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>个人试卷</title>
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

<form class="avatar-form" action="<?php echo U('managestu_addkey0404');?>" enctype="multipart/form-data" method="post">
    <input name="checktestid" type="hidden">
    <input name="checktestkind" type="hidden">
    <input name="checktestmsg" type="hidden">
    <input name="stu_id" id="stu_id" type="hidden" value="<?php echo ($stu_id); ?>">
    <input name="stu_name" type="hidden" value="<?php echo ($stu_name); ?>">
    <input name="subject_id" type="hidden" value="<?php echo ($subject_id); ?>">
  	<input id="userid" name="userid" type="hidden" value="<?php echo ($userid); ?>">
    <input id="realname" name="realname" type="hidden" value="<?php echo ($realname); ?>">
    <input id="username" name="username" type="hidden" value="<?php echo ($username); ?>">
    <input id="subject_msg" name="subject_msg" type="hidden" value="<?php echo ($subject_msg); ?>">
    <div id="button_div"  data-toggle="modal" data-target="#myModal" style="position: absolute;z-index:100;width: 80px;height:80px;background-color: #1b6d85;border-radius: 40px;top:70%;left: 70%;color: #ffffff;font-size: 16px;padding-top: 28px;text-align: center;display:none;"><input id="input_button" type="submit" value="确认" style="background-color:transparent;border:0px solid blue;"><span id="notesum" style="margin-left: 2px;"></span></div>
</form>
	<div class="container" style="height: 100%;">
		<div class="row title_class">
			<div class="col-xs-2"><a href="<?php echo U('managestuscore0401',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>"><img src="/Public/img/reg_back.png" class="title_left_img"></a></div>
			<div class="col-xs-8  title_font_middle " >学生：<?php echo ($stu_name); ?></div>
			<div class="col-xs-2"><a href="<?php echo U('managestu_keylist0405',array('userid'=>$userid,'username'=>$username,'realname'=>$realname,'stu_id'=>$stu_id,'stu_name'=>$stu_name,'subject_id'=>$subject_id));?>" style="color: white;font-size: 15px;display: block;margin-top: 1px;">Key</a></div>
		</div>
		<div class="row parent_nav">
		<div class="col-xs-3" >

			<select onchange="searchdata()"  id="subjectid" name="subjectid" class="blackselect" style="padding-left: -10px;">
               <option value ="<?php echo ($subject_data["id"]); ?>">学科</option>
              <?php if(is_array($subject_data)): $i = 0; $__LIST__ = $subject_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subject_data): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($subject_data["id"]); ?>"><?php echo ($subject_data["subjectmsg"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				
			</select>

		</div>
		<div class="col-xs-3">
			<select onchange="searchdata()"  id="gradeid" name="gradeid" class="blackselect">
					<option value="0">全部</option>
					<option value="23">初一</option>
					<option value="24">初二</option>
                 	<option value="25">初三</option>
				</select>

		</div>
			<div class="col-xs-3">

            <select class="blackselect" id="test_kind" onchange="questiontypes_sub()">
			<option value ="0">全部</option>
              <?php if(is_array($questiontypes)): $i = 0; $__LIST__ = $questiontypes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$questiontypesid): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($questiontypesid['id']); ?>"><?php echo ($questiontypesid['typesmsg']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
				
			</div>

			<div class="col-xs-3">
				<select onchange="searchdata()"  id="order" name="order" class="blackselect">
					<option value="0">排序</option>
					<option value="asc">Up</option>
					<option value="desc">Down</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div id="contentdiv" class="col-xs-12" style="height: 600px;overflow-y: auto;">
				<ol id="list1" style="list-style-type:none;font-size: 15px;margin-left: -30px;padding-top: 10px;">
                  <!-- <?php if(is_array($testdata)): $i = 0; $__LIST__ = $testdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mytestid): $mod = ($i % 2 );++$i;?><li>
                    	<div style="padding-left: 20px;padding-top: 4px;width: 330px;overflow-x:scroll;white-space: nowrap;">
						<input  style="font-size: 30px;zoom:130%;margin-top:6px;" onclick='testchicksub()' name='check_test' value='<?php echo ($mytestid['testid']); ?>'  type="checkbox"> <?php echo ++$m;?>.&nbsp;&nbsp;&nbsp;<?php echo ($mytestid['paper_name']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($mytestid['publish_time']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($mytestid['paper_ratio']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($mytestid['w_ratio']); ?>
						<hr >
						<span style="margin-left: 16px;">知识点：<?php echo ($mytestid['keynotename']); ?></span>
						</div>
						<hr color="#1b6d85" >              
                    </li><?php endforeach; endif; else: echo "" ;endif; ?> -->
				</ol>
				 <div id="downdiv" onclick="nextpage()" style="width: 100%;height: 40px; text-align: center;">点击加载习题（<span id="nowpage">1</span>/<span id="pagenum">4</span>）</div>
			</div>
		</div>
	</div>


  
	<input id="pagelength" type="hidden" value="10">
	<input id="testidarr" type="hidden" value="">
	<input id="questionsum" type="hidden" value="0">
    <input id="num" type="hidden" value="0">
</body>

<script>
	$(function(){
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		
		var userid=$('#stu_id').val();
		var subjectid=$("#subjectid").val();
		var gradeid=$("#gradeid").val();
		var order=$('#order').val();
		
		managetestdata(userid,nowpage,pagelength,subjectid,gradeid,order);
	});
  
	function searchdata()
	{
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		
		var userid=$('#stu_id').val();
		var subjectid=$("#subjectid").val();
		var gradeid=$("#gradeid").val();
		var order=$('#order').val();
		
		$('#nowpage').text(nowpage);
		
		$('#list1').html('');
		managetestdata(userid,nowpage,pagelength,subjectid,gradeid,order);
	}

  
	function nextpage(){
		var nowpage=$('#nowpage').text();
		var maxnum=$('#pagenum').text();
		var userid=$('#stu_id').val();
		var pagelength=$('#pagelength').val();
		
		var subjectid=$("#subjectid").val();
		var gradeid=$("#gradeid").val();
		var order=$('#order').val();
		

		nowpage=nowpage*1+1;
		if(nowpage>maxnum)
		{
			return;
		}
		if(nowpage<1)
		{
			return;
		}

		$("tr[name='testlisttr']").remove();
		$('#nowpage').text(nowpage);
		managetestdata(userid,nowpage,pagelength,subjectid,gradeid,order);
		selectele();


	}
	function managetestdata(userid,nowpage,pagelength,subjectid,gradeid,order)
	{
		$.ajax({
			url:"<?php echo U('phpmanagestutest0403');?>",
			data:{userid:userid,nowpage:nowpage,pagelength:pagelength,subjectid:subjectid,gradeid:gradeid,order:order},
			datatype:'json',
			type:'post',
			success:function(re){
				var testlist=eval("("+re+")");
				var addhtmlmsg = '';
				var beginhtml = $('#list1').html();
				var mylength = testlist['length'];

				var testid = '';
				var classid=testlist['classid'];
				var pagenum=testlist['pagenum'];
				var papername;
				$('#pagenum').text(pagenum);
				var j;
				for (var i = 0; i < mylength; i++) {
					j=i+1;
					testid=testlist[i]['testid'];
					papername=testlist[i]['num']+'. '+testlist[i]['paper_name']+'（'+testlist[i]['person_sum']+'/'+testlist[i]['classnum']+'）';
					var ahtml='/index.php/Home/HeadTeacher/managepaperdetail0202/testid/'+testid+'/classid/'+classid+'.html';
					//addhtmlmsg=addhtmlmsg+'<li><div style="padding-left: 20px;padding-top: 4px;width: 330px;overflow-x:scroll;white-space: nowrap;"><a style="color: #000000;" href="'+ahtml+'">'+papername+'</a><br><a style="margin-left: 20px;color: #000000;">'+testlist[i]['publish_time']+'</a><a style="margin-left: 15px;color: #000000;">Edit：'+testlist[i]['lastreadtime']+'</a></div></li><hr style="margin-top: 14px; margin-bottom: 10px;">';
					addhtmlmsg=addhtmlmsg+'<li><div style="padding-left: 20px;padding-top: 4px;width: 330px;overflow-x:scroll;white-space: nowrap;"><input  style="font-size: 30px;zoom:130%;margin-top:6px;" onclick="testchicksub()" name="check_test" value="'+testlist[i]['testid']+'"  type="checkbox"> '+j+'.&nbsp;&nbsp;&nbsp;'+testlist[i]['paper_name']+'&nbsp;&nbsp;&nbsp;&nbsp;'+testlist[i]['publish_time']+'&nbsp;&nbsp;&nbsp;&nbsp;'+testlist[i]['paper_ratio']+'&nbsp;&nbsp;&nbsp;&nbsp;'+testlist[i]['w_ratio']+'<hr><span style="margin-left: 16px;">知识点：'+testlist[i]['keynotename']+'</span></div><hr color="#1b6d85"></li>';
					$('#list1').html(beginhtml + addhtmlmsg);
				}
			}
		})
	}
	function selectsub() {
		var mytestarr='';
		var ctsumarr='';
		var ctsum=0;
		$("input[name='testid']").each(function(){
			if($(this).prop("checked")==true)
			{

				mytestarr=mytestarr+','+$(this).val();
				ctsum=ctsum+$(this).attr('ctsum')*1;
			}
		});

		mytestarr=mytestarr.substr(1);

		$('#notesum').text('('+ctsum+')');
		$('#testidarr').val(mytestarr);
		$('#questionsum').val(ctsum);

	}
	function datasubmit(){
		var userid=$('#userid').val();
		var questionsum=$('#questionsum').val();
		var testidarr=$('#testidarr').val();
		var paper_name=$('#paper_name').val();

		if(paper_name=='')
		{
			alert('请输入试卷名称！！');
			return;
		}

		if(questionsum==0)
		{
			alert('请选择习题！！')
		}

		$.ajax({
			url:"<?php echo U('phpstumytestdata');?>",
			data:{userid:userid,testidarr:testidarr,questionsum:questionsum,paper_name:paper_name},
			datatype:'json',
			type:'post',
			success:function(re){
				window.location.href ="/index.php/Home/Student/managelist0202/userid/"+$('#userid').val()+".html";
			}
		});


	}
  function testchicksub()
  {
    var num=$("input[name='check_test']:checked").length;
    
    if(num==0)
    {
      $('#button_div').css('display','none');
    }
    else
    {
      $('#button_div').css('display','');
    }
    
    var testid_arr='';
    
    $("input[name='check_test']:checked").each(function(){
        testid_arr=testid_arr+','+$(this).val();
  	});
    
    testid_arr=testid_arr.substr(1);
    $("input[name='checktestid']").val(testid_arr);
    var test_kind=$('#test_kind').val();
    $("input[name='checktestkind']").val(test_kind);
    var test_msg=$('#test_kind').find("option:selected").text();
    $("input[name='checktestmsg']").val(test_msg);
    
  }
  
  function questiontypes_sub()
  {
        var test_kind=$('#test_kind').val();
    	$("input[name='checktestkind']").val(test_kind);
        var test_msg=$('#test_kind').find("option:selected").text();
        $("input[name='checktestmsg']").val(test_msg);
  }
  
	function selectele(){

		var txt=','+$('#testidarr').val()+',';
		var parttxt;
		$("input[name='testid']").each(function(){
			parttxt=','+$(this).val()+',';
			if(hasstring(parttxt,txt))
			{
				$(this).attr("checked",true);
			}
		});
	}
</script>
</html>