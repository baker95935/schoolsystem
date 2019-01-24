<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>任务列表</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
<link rel="stylesheet" type="text/css" href="/Public/css/stu.css"/>
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
	<div class="container">
	
	
		<div class="row title_class">
			<div class="col-xs-2"><a href="<?php echo U('home',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>"><img src="/Public/img/reg_back.png" class="title_left_img"></a></div>
			<div class="col-xs-8  title_font_middle " >错题作业录入</div>
			<div class="col-xs-2"><a style="color: white;display: block;margin-top: 2px;" href="<?php echo U('managetest0201',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>"></a></div>
		</div>
		<div class="row parent_nav">
		<div class="col-xs-4" >
			<div class="dropdown">
					<select class="blackselect" id="subjectid" name="subjectid" onchange="stu_tasksub()">
					<option value="">全部</option>
					<?php if(is_array($subjectList)): foreach($subjectList as $k=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["subjectmsg"]); ?></option><?php endforeach; endif; ?>
					</select>
				</div>


		</div>
		<div class="col-xs-4">
				<div class="dropdown">
					<select id="finishstatus" class="blackselect" onchange="stu_tasksub()">
						<option value ="0">未完成</option>
						<option value ="1">完成</option>
					</select>
				</div>
		</div>
		<div class="col-xs-4">
			
				<div class="dropdown">
					<select id="teststatus" class="blackselect" onchange="test_tasksub()">
						<option value ="0">班级习题</option>
						<option value ="1">知识点习题</option>
					</select>
				</div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div id="contentdiv" class="col-xs-10" style="height: 470px;overflow-y: auto;">
				<ol id="list1" style="list-style-type:none;font-size: 15px;margin-left: -30px;padding-top:10px;">
				</ol>
				<div id="downdiv" onclick="nextpage()" style="width: 100%;height: 40px; text-align: center;">点击加载习题（<span id="nowpage">1</span>/<span id="pagenum">4</span>）</div>
				
              	<ol id="key_list1" style="list-style-type:none;font-size: 15px;margin-left: -30px;padding-top: 10px;display:none;">
				</ol>
				<div id="key_downdiv" onclick="key_nextpage()" style="width: 100%;height: 40px; text-align: center;display:none;">点击加载习题（<span id="key_nowpage">1</span>/<span id="key_pagenum">4</span>）</div>
				
          </div>
			<div class="col-xs-1"></div>
		</div>
	</div>

	<input id="userid" type="hidden" value="<?php echo ($userid); ?>">
  	<input id="username" type="hidden" value="<?php echo ($username); ?>">
  	<input id="realname" type="hidden" value="<?php echo ($realname); ?>">
	<input id="pagelength" type="hidden" value="5">
</body>

<script>
	$(function(){
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
		var kind=$('#finishstatus').val();
		testdata(userid,nowpage,pagelength,kind);
        //keytestdata(userid,nowpage,pagelength,kind);
	});


	function key_nextpage(){
		var nowpage=$('#key_nowpage').text();
		var maxnum=$('#key_pagenum').text();
		var userid=$('#userid').val();
		var pagelength=$('#pagelength').val();

		nowpage=nowpage*1+1;
		if(nowpage>maxnum)
		{
			return;
		}
		if(nowpage<1)
		{
			return;
		}

		var kind=$('#finishstatus').val();
		$("tr[name='testlisttr']").remove();
		$('#key_nowpage').text(nowpage);
		keytestdata(userid,nowpage,pagelength,kind);
	}
  
  	function nextpage(){
		var nowpage=$('#nowpage').text();
		var maxnum=$('#pagenum').text();
		var userid=$('#userid').val();
		var pagelength=$('#pagelength').val();

		nowpage=nowpage*1+1;
		if(nowpage>maxnum)
		{
			return;
		}
		if(nowpage<1)
		{
			return;
		}

		var kind=$('#finishstatus').val();

		$("tr[name='testlisttr']").remove();
		$('#nowpage').text(nowpage);
		testdata(userid,nowpage,pagelength,kind);
	}

	function testdata(userid,nowpage,pagelength,kind,subjectid='')
	{
		$.ajax({
			url:"<?php echo U('phptask0101');?>",
			data:{userid:userid,nowpage:nowpage,pagelength:pagelength,kind:kind,subjectid:subjectid},
			datatype:'json',
			type:'post',
			success:function(re){
				var testlist=eval("("+re+")");
				var addhtmlmsg = '';
				var beginhtml = $('#list1').html();
				var mylength = testlist['length'];
				var testid = '';
				var pagenum=testlist['pagenum'];
				$('#pagenum').text(pagenum);
				var kind=testlist['kind'];

				if(kind==0)
				{
					for (var i = 0; i < mylength; i++) {
						testid=testlist[i]['id'];
						var ahtml='/index.php/Home/Student/testchecked0102/testid/'+testid+'/userid/'+$('#userid').val()+'/paper_name/'+testlist[i]['paper_name']+'/username/'+$('#username').val()+'/realname/'+$('#realname').val()+'/subjectid/'+testlist[i]['subjectid']+'/testkind/stu'+'.html';
						addhtmlmsg=addhtmlmsg+'<li><a href="'+ahtml+'"><p class="h5">'+testlist[i]['num']+'.'+testlist[i]['paper_name']+'</p> <p  class="h6" style="margin-left: 10px;">科目：'+testlist[i]['subject']+'；考试时间：'+testlist[i]['publish_time']+'；试题数：'+testlist[i]['sum']+'；状态：'+testlist[i]['status']+'。</p></a><hr></li>';
						$('#list1').html(beginhtml + addhtmlmsg);
					}
				}
				else
				{
					for (var i = 0; i < mylength; i++) {
						testid=testlist[i]['id'];
						var ahtml='/index.php/Home/Student/checkedpaper0202/testid/'+testid+'/userid/'+$('#userid').val()+'/testkind/stu'+'/paper_name/'+testlist[i]['paper_name']+'/username/'+$('#username').val()+'/realname/'+$('#realname').val()+'/testkind/stu'+'.html';
						addhtmlmsg=addhtmlmsg+'<li><p class="h5"><a href='+ahtml+'>'+testlist[i]['num']+'.'+testlist[i]['paper_name']+'</a><a id='+testlist[i]['id']+' style="margin-left:40px;" href="javascript:void(0)" onclick="stu_rewrite(this.id)">录入</a></p> <p  style="margin-left: 10px;" class="h6">科目：'+testlist[i]['subject']+'；考试时间：'+testlist[i]['publish_time']+'；错题数：'+testlist[i]['sum']+'；状态：'+testlist[i]['status']+'。</p></a><hr></li>';
						$('#list1').html(beginhtml + addhtmlmsg);
					}
				}


			}

		})
	}
  
  
  function keytestdata(userid,nowpage,pagelength,keykind,subjectid)
	{
     // alert(userid+','+nowpage+','+pagelength+','+keykind);
      
    //  return;
		$.ajax({
			url:"<?php echo U('phpkeytask0101');?>",
			data:{userid:userid,nowpage:nowpage,pagelength:pagelength,kind:keykind,subjectid:subjectid},
			datatype:'json',
			type:'post',
			success:function(re){
				var testlist=eval("("+re+")");
				var addhtmlmsg = '';
				var beginhtml = $('#key_list1').html();
				var mylength = testlist['length'];
				var testid = '';
                var keynote_id='';
				var pagenum=testlist['pagenum'];
				$('#key_pagenum').text(pagenum);
				var kind=testlist['kind'];
              
              
				if(kind==0)
				{
					for (var i = 0; i < mylength; i++) {
						testid=testlist[i]['id'];
                        keynote_id=testlist[i]['keynote_id'];
						var ahtml='/index.php/Home/Student/testchecked0102/testid/'+testid+'/userid/'+$('#userid').val()+'/paper_name/'+testlist[i]['paper_name']+'/username/'+$('#username').val()+'/realname/'+$('#realname').val()+'/testkind/key/keynote_id/'+keynote_id+'.html';
						addhtmlmsg=addhtmlmsg+'<li><a href="'+ahtml+'"><p class="h5">'+testlist[i]['num']+'.'+testlist[i]['paper_name']+'</p> <p  class="h6" style="margin-left: 10px;">知识点：'+testlist[i]['keynotemsg']+'；修改时间：'+testlist[i]['lastreadtime']+'；试题数：'+testlist[i]['sum']+'；状态：'+testlist[i]['status']+'。</p></a><hr style="background-color:#c3c3c3;height: 1px;"></li>';
						$('#key_list1').html(beginhtml + addhtmlmsg);
					}
				}
				else
				{
					for (var i = 0; i < mylength; i++) {
						testid=testlist[i]['id'];
                        keynote_id=testlist[i]['keynote_id'];
						var ahtml='/index.php/Home/Student/checkedpaper0202/testid/'+testid+'/userid/'+$('#userid').val()+'/testkind/key'+'/paper_name/'+testlist[i]['paper_name']+'/username/'+$('#username').val()+'/realname/'+$('#realname').val()+'/testkind/key'+'/keynote_id/'+keynote_id+'.html';
						addhtmlmsg=addhtmlmsg+'<li><p class="h5"><a href='+ahtml+'>'+testlist[i]['num']+'.'+testlist[i]['paper_name']+'</a><a id='+testlist[i]['id']+' style="margin-left:40px;" href="javascript:void(0)"  keynote_id='+testlist[i]['keynote_id']+'  onclick="key_stu_rewrite(this.id)">录入</a></p> <p  style="margin-left: 10px;" class="h6">知识点：'+testlist[i]['keynotemsg']+'；修改时间：'+testlist[i]['lastreadtime']+'；错题数：'+testlist[i]['sum']+'；状态：'+testlist[i]['status']+'。</p></a><hr  style="background-color:#c3c3c3;height: 1px;"></li>';
						$('#key_list1').html(beginhtml + addhtmlmsg);
					}
				}


			}

		})
	}
  
   function div_display(kind)
  	{
       if(kind=='stu')
       {
         $('#list1').css('display','');
         $('#downdiv').css('display','');
         $('#key_list1').css('display','none');
         $('#key_downdiv').css('display','none');
       }
      else
       {
         $('#list1').css('display','none');
         $('#downdiv').css('display','none');
         $('#key_list1').css('display','');
         $('#key_downdiv').css('display','');
       }
  	}
  

	function stu_tasksub()
	{
		var val=$('#finishstatus').val();  
		var subjectid=$('#subjectid').val();  
        var kind=$('#teststatus').val();
       if(kind==0)
       {
        var nowpage=1;
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
		$('#list1').html('');
		testdata(userid,nowpage,pagelength,val,subjectid);
        $('#nowpage').text(1);
        $('#key_nowpage').text(1);
       }
      else
      {
        var nowpage=1;
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
		$('#key_list1').html('');
		keytestdata(userid,nowpage,pagelength,val,subjectid);
        $('#nowpage').text(1);
        $('#key_nowpage').text(1);
      }
	}
  
    function test_tasksub()
    {
        var val=$('#finishstatus').val();
		$('#testkind').val(val);
        var teststatus=$('#teststatus').val();
        $('#kind').val(teststatus);  
    
      	if(teststatus==0)
         {
           div_display('stu');
         }
        else
        {
          div_display('key');
        }
      
       stu_tasksub();
       $('#nowpage').text(1);
       $('#key_nowpage').text(1);

    }

	function stu_rewrite(id)
	{

		var userid=$('#userid').val();
		$.ajax({
			url:"<?php echo U('phptaskrewrite');?>",
			data:{userid:userid,testid:id},
			datatype:'json',
			type:'post',
			success:function(re){
              
      
				var nowpage=1;
				var pagelength=$('#pagelength').val();
				var userid=$('#userid').val();
                $('#finishstatus').val(0);
		        $('#testkind').val(0);
              
               //  $('#list1').html('');
              
              	test_tasksub();
				//testdata(userid,nowpage,pagelength,0);
			}
		})
	}
  
  	function key_stu_rewrite(id)
	{
		var userid=$('#userid').val();
        var keynote_id=$('#'+id).attr('keynote_id');
		$.ajax({
			url:"<?php echo U('key_phptaskrewrite');?>",
			data:{userid:userid,testid:id,keynote_id:keynote_id},
			datatype:'json',
			type:'post',
			success:function(re){
				var nowpage=1;
				var pagelength=$('#pagelength').val();
				var userid=$('#userid').val();
              
                $('#finishstatus').val(0);
		        $('#testkind').val(1);
              
             // $('#key_list1').html('');
              
              	test_tasksub();
              
				//keytestdata(userid,nowpage,pagelength,0);
			}
		})
	}


</script>
</html>