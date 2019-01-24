<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>错题管理列表</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/Public/css/stu.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
	<script src="/Public/jquery/jquery.min.js"></script>
	<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="/Public/bootstrap/js/bootstrap.min.js"></script>

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
<div  name="buttonpdf" onclick="delsub()" style="display:none;position: absolute;width: 60px;height:60px;background-color: #6a0526;border-radius: 30px;top:490px;left: 90px;color: #ffffff;font-size: 14px;padding-top: 20px;padding-left: 16px;z-index:2;">删除</div>
<div  name="buttonpdf"  onclick="downloadpdf('test')" style="display:none;position: absolute;width: 60px;height:60px;background-color: #096e28;border-radius: 30px;top: 460px;left: 170px;color: #ffffff;font-size: 14px;padding-top: 20px;padding-left: 16px;z-index:2;">试卷↓</div>
<div  name="buttonpdf" onclick="downloadpdf('answer')" style="display:none;position: absolute;width: 60px;height:60px;background-color: #a4a206;border-radius: 30px;top: 450px;left: 250px;color: #ffffff;font-size: 14px;padding-top: 20px;padding-left: 16px;z-index:2;">答案↓</div>
<div id="bpdf"  onclick="buttontestpdf()" style="display:none;position: absolute;width: 80px;height:80px;background-color: #1b6d85;border-radius: 40px;top: 530px;;left: 70%;color: #ffffff;font-size: 16px;padding-top: 28px;padding-left: 24px;z-index:2;"><span  onclick="buttontestpdf()" >PDF↓</span></div>
	
  <div class="container">
		<div class="row title_class">
			<div class="col-xs-2"><a href="<?php echo U('managetest0201',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>"><img src="/Public/img/reg_back.png" class="title_left_img"></a></div>
			<div class="col-xs-8  title_font_middle " >我的错题本</div>
			<div class="col-xs-2"><a href="<?php echo U('managetest0201',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>" style="color: white;font-size: 15px;display: block;margin-top: 1px;">班级</a></div>
		</div>
		<div class="row parent_nav">
		<div class="col-xs-4" >
			<div class="dropdown">
			<select onchange="searchdata();" id="subjectid" name="subjectid" class="blackselect">
				<option value="">全部</option>
				<?php if(is_array($subjectList)): foreach($subjectList as $k=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["subjectmsg"]); ?></option><?php endforeach; endif; ?>
			</select>
</div>

			
			
		</div>
		<div class="col-xs-4">
			
			
				<div class="dropdown">
 	 
</div>
			
			
			
		</div>
		<div class="col-xs-4">
			
				<div class="dropdown">
 				<select onchange="searchdata()" id="kind" name="kind" class="blackselect">
				<option value="">全部</option>
				<option value="2">班级错题</option>
				<option value="1">知识点错题</option>
			</select>
</div>
		</div>	
		</div>
		<div class="row">
			<div id="contentdiv" class="col-xs-12" style="height: 470px;overflow-y: auto;">
				<ol id="list1" style="list-style-type:none;font-size: 15px;margin-left: -30px;padding-top: 10px;">
				</ol>
				<div id="downdiv" onclick="nextpage()" style="width: 100%;height: 40px; text-align: center;">点击加载（<span id="nowpage">1</span>/<span id="pagenum">4</span>）</div>
			</div>
		</div>
	</div>

	<input id="userid" type="hidden" value="<?php echo ($userid); ?>">
  	<input id="username" type="hidden" value="<?php echo ($username); ?>">
  	<input id="realname" type="hidden" value="<?php echo ($realname); ?>">
	<input id="pagelength" type="hidden" value="10">
	<input id="displayname" type="hidden" value="0">
	<input id="testid" type="hidden" value="">
    <input id="testkind" type="hidden" value="">
	<input id="paper_name" type="hidden" value="">
	<input id="nowtestid" type="hidden" value="">
</body>

<script>
	$(function(){
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
		var subjectid=$('#subjectid').val();
		var gradeid=$('#gradeid').val();
		var kind=$('#kind').val();
		
		managetestdata(userid,nowpage,pagelength,subjectid,gradeid,kind);
	});

	function searchdata()
	{
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
		var subjectid=$('#subjectid').val();
		var gradeid=$('#gradeid').val();
		var kind=$('#kind').val();
		
		$('#list1').html('');
		managetestdata(userid,nowpage,pagelength,subjectid,gradeid,kind);
	}

	function nextpage(){
		var nowpage=$('#nowpage').text();
		var maxnum=$('#pagenum').text();
		var userid=$('#userid').val();
		var pagelength=$('#pagelength').val();
		var subjectid=$('#subjectid').val();
		var gradeid=$('#gradeid').val();
		var kind=$('#kind').val();

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
		managetestdata(userid,nowpage,pagelength,subjectid,gradeid,kind);


	}


	function selectsub(obj)
	{
		var mytestarr='';
		var ctsumarr='';
		var ctsum=0;

		if($(obj).prop('checked')==true)
		{
			$("input[name='testid']").each(function(){
				$(this).prop("checked",false);
			});

			$(obj).prop('checked',true);
			$('#testid').val($(obj).val());
			$('#paper_name').val($(obj).attr('paper_name'));
            $('#testkind').val($(obj).attr('testkind'));
			$('#nowtestid').val($(obj).attr('id'));
            $('#bpdf').css('display','');
          
		}
		else
		{
			$('#testid').val('');
			$('#paper_name').val('');
			$('#nowtestid').val('');
            $('#testkind').val('');
            $('#bpdf').css('display','none');
          	$("div[name='buttonpdf']").css('display','none');
		}
	}

	function managetestdata(userid,nowpage,pagelength,subjectid,gradeid,kind)
	{
		$.ajax({
			url:"<?php echo U('phpmanagelist0201');?>",
			data:{userid:userid,nowpage:nowpage,pagelength:pagelength,subjectid:subjectid,gradeid:gradeid,kind:kind},
			datatype:'json',
			type:'post',
			success:function(re){
				var testlist=eval("("+re+")");
				var addhtmlmsg = '';
				var beginhtml = $('#list1').html();
				var mylength = testlist['length'];

				var testid = '';
				var pagenum=testlist['pagenum'];
				var papername;
				$('#pagenum').text(pagenum);
				var j;
              	for (var i = 0; i < mylength; i++) {
					j=i+1;
					testid=testlist[i]['id'];
					papername=testlist[i]['num']+'. '+testlist[i]['paper_name']+'（'+testlist[i]['questionsum']+'）';
					var ahtml='/index.php/Home/Student/managelistdetail0203/testid/'+testid+'/userid/'+$('#userid').val()+'/paper_name/'+testlist[i]['paper_name']+'/username/'+$('#username').val()+'/realname/'+$('#realname').val()+'/testkind/'+$('#testkind').val()+'.html';
					addhtmlmsg=addhtmlmsg+'<li  id="li_test_'+testlist[i]['id']+'"><div class="row"><div class="col-xs-1"><input id="test_'+testlist[i]['id']+'"  testkind="'+testlist[i]['testkind']+'"  paper_name="'+testlist[i]['paper_name']+'"  style="font-size: 30px;zoom:130%;margin-top:6px;" onclick="selectsub(this)" name="testid" type="checkbox" value="'+testlist[i]['id']+'" ctsum="'+testlist[i]['wrongsum']+'"></div><div class="col-xs-10"><div style="padding-top: 4px;overflow-x:scroll;white-space: nowrap;"><a style="color: #000000;" href="'+ahtml+'">'+papername+'</a><span style="margin-left:20px;">'+testlist[i]['testkind']+'</span><br><a style="margin-left: 20px;color: #000000;">Edit：'+testlist[i]['lastreadtime']+'</a></div></div></div></li><hr style="margin-top: 14px; margin-bottom: 10px;">';
					$('#list1').html(beginhtml + addhtmlmsg);
				}

			}

		})
	}


	function downloadpdf(kind){

		var testid=$('#testid').val();
		var paper_name=$('#paper_name').val();
      	var testkind=$('#testkind').val();

		if(testid=='')
		{
			alert('请选择习题！！');
			return;
		}
      
      
      

		if(kind=='test')
		{
			//window.location.href ="/index.php/Home/Student/phpmanagelistdownloadpdf/testid/"+testid+"/paper_name/"+paper_name+"/outkind/D/testkind/"+testkind+".html";
          window.location.href ="/index.php/Home/Student/phpmanagelistdownloadpdf/testid/"+testid+"/paper_name/"+paper_name+"/outkind/D.html";
		}else
		{
          
        //  alert(testid+','+paper_name+','+testkind);
        //  return;
          
          //window.location.href ="/index.php/Home/Student/phpmanagelistdownloadanswerpdf/testid/"+testid+"/paper_name/"+paper_name+"/outkind/D/testkind/"+testkind+".html";
			window.location.href ="/index.php/Home/Student/phpmanagelistdownloadanswerpdf/testid/"+testid+"/paper_name/"+paper_name+"/outkind/D.html";
		}
	}

	function buttontestpdf(){
		var displayname=$('#displayname').val();
		if(displayname=='1')
		{
			$("div[name='buttonpdf']").css('display','none');
			$('#displayname').val(0);
		}
		else
		{
			$("div[name='buttonpdf']").css('display','');
			$('#displayname').val(1);
		}

    }

	function delsub(){
		var testid=$('#testid').val();
		var paper_name=$('#paper_name').val();

		if(testid=='')
		{
			alert('请选择习题！！');
			return;
		}

		$.ajax({
			url:"<?php echo U('phpmanagelistdelsub');?>",
			data:{testid:testid},
			datatype:'json',
			type:'post',
			success:function(re){
				delele();
			}
		})
	}

	function delele() {
		var id=$('#nowtestid').val();
		$('#li_'+id).remove();
		$('#hr_'+id).remove();
		//managetestdata($('#userid').val(),$('#nowpage').text(),$('#pagelength').val());

	}

</script>
</html>