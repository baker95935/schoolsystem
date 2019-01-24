<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>错题管理列表</title>
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
 <div  data-toggle="modal" data-target="#myModal" style="position: absolute;z-index:100;width: 80px;height:80px;background-color: #1b6d85;border-radius: 40px;top:70%;left: 70%;color: #ffffff;font-size: 16px;padding-top: 28px;text-align: center;" onclick='addtesttitle()'><span onclick='addtesttitle()'>添加</span><span id="notesum" style="margin-left: 2px;"></span>
 </div>
	<div class="container" style="height: 100%;">
		<div class="row title_class">
			<div class="col-xs-2"><a href="<?php echo U('home',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>"><img src="/Public/img/reg_back.png" class="title_left_img"></a></div>
			<div class="col-xs-8  title_font_middle " >错题管理</div>
			<div class="col-xs-2"><a href="<?php echo U('managelist0202',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>" style="color: white;font-size: 15px;display: block;margin-top: 1px;">个人</a></div>
		</div>
		<div class="row parent_nav">
		<div class="col-xs-3" >

			<select onchange="searchdata();" id="subjectid" name="subjectid" class="blackselect">
				 
				<?php if(is_array($subjectList)): foreach($subjectList as $k=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo["id"] == $selectsubjectid): ?>selected="selected"<?php endif; ?> ><?php echo ($vo["subjectmsg"]); ?></option><?php endforeach; endif; ?>
			</select>

		</div>
		<div class="col-xs-3">

			<select onchange="searchdata()" id="gradeid" name="gradeid" class="blackselect">
				<option value="0">全部</option>
				<option value="23">初一</option>
				<option value="24">初二</option>
				<option value="25">初三</option>
			</select>
		</div>
			<div class="col-xs-3" id="question">
			<select onchange="searchdata()" name="questionid" id="questionid"  class="blackselect">
			<option value="0">全部</option>
				<?php if(is_array($typelist)): foreach($typelist as $k=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["typesmsg"]); ?></option><?php endforeach; endif; ?>
			 </select>
			</div>
          	<div class="col-xs-3" >
				 
				<select onchange="initdata();" id="testkind" name="testkind" class="blackselect">
				<option value="0">班级试卷</option>
				<option value="1">知识点</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div id="contentdiv" class="col-xs-12" style="height: 600px;overflow-y: auto;">
				<ol id="list1" style="list-style-type:none;font-size: 15px;margin-left: -30px;padding-top: 10px;">
				</ol>
				<div id="downdiv" onclick="nextpage()" style="width: 100%;height: 40px; text-align: center;">点击加载（<span id="nowpage">1</span>/<span id="pagenum">4</span>）</div>
			
                <ol id="key_list1" style="list-style-type:none;font-size: 15px;margin-left: -30px;padding-top: 10px;display:none;">
				</ol>
				<div id="key_downdiv" onclick="key_nextpage()" style="width: 100%;height: 40px; text-align: center;display:none;">点击加载（<span id="key_nowpage">1</span>/<span id="key_pagenum">4</span>）</div>
			
          
          </div>
		</div>
	</div>

 <!-- 模态框（Modal） -->


 <div class="modal fade" id="myModal" style="margin-top: 120px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	 <div class="modal-dialog">
		 <div class="modal-content">
			 <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					 &times;
				 </button>
				 <h4 class="modal-title" id="myModalLabel">
					 生存新的个人试卷
				 </h4>
			 </div>
			 <div class="modal-body">
				 <input id="paper_name" type="text" style="border: 0px;" placeholder="请输入您要生存试卷名称！！">
			 </div>
			 <div class="modal-footer">
				 <button type="button" class="btn btn-primary" onclick="datasubmit()">
					 存储试卷
				 </button>
			 </div>
		 </div>
	 </div>
</div>

	<input id="userid" type="hidden" value="<?php echo ($userid); ?>">
  	<input id="username" type="hidden" value="<?php echo ($username); ?>">
  	<input id="realname" type="hidden" value="<?php echo ($realname); ?>">
	<input id="pagelength" type="hidden" value="10">
	<input id="testidarr" type="hidden" value="">
	<input id="questionsum" type="hidden" value="0">
  	<input id="key_testidarr" type="hidden" value="">
	<input id="key_questionsum" type="hidden" value="0">

</body>

<script>
	$(function(){
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
		var subjectid=$("#subjectid").val();
		var gradeid=$("#gradeid").val();
		var questionid=$("#questionid").val();
		var testkind=$('#testkind').val();
		
		//班级试题
		if(testkind==0) {
        	managetestdata(userid,nowpage,pagelength,subjectid,gradeid,questionid);
		} else {
			key_managetestdata(userid,nowpage,pagelength,subjectid,gradeid,questionid);
		}
	});
  
  
	//班级试题和知识点切换的时候执行
 function initdata()
 {
	 var gradeid=$("#gradeid").val(0);
	 var questionid=$("#questionid").val(0);
	 
	 var nowpage=1;
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
		var subjectid=$("#subjectid").val();
		var gradeid=$("#gradeid").val();
		var questionid=$("#questionid").val();
		var testkind=$('#testkind').val();
   
        $('#notesum').text('');
      	$('#questionsum').val('0');
       	$('#key_questionsum').val('0');
   
	//班级试题
	if(testkind==0) {
		$('#list1').html('');
        managetestdata(userid,nowpage,pagelength,subjectid,gradeid,questionid);
	} else {
		$('#key_list1').html('');
		key_managetestdata(userid,nowpage,pagelength,subjectid,gradeid,questionid);
	}
 }
	
  function addtesttitle()
  {
     var typeid=$('#questionid').val();
     var typemsg=$('#questionid').find("option:selected").text();
     var questionsum=$('#questionsum').val();
     var key_questionsum=$('#key_questionsum').val();
     var testkind=$('#testkind').find("option:selected").val();
    
     
     var titlemsg='';
    
     var mydate = new Date();
     var thisyear=mydate.getYear(); //获取当前年份(2位)
     var thismonth=mydate.getMonth()*1+1; //获取当前月份(0-11,0代表1月)
     var thisdate=mydate.getDate(); //获取当前日(1-31)
    
    
    //alert(testkind);
    
    
    if(testkind==1)
    {
      titlemsg=thisyear+''+thismonth+''+thisdate+'-'+key_questionsum;
      titlemsg=titlemsg;
    }
    else
    {
       titlemsg=thisyear+''+thismonth+''+thisdate+'-'+questionsum;
    }

    
     if(typeid==0)
     {
       titlemsg='习题'+titlemsg;
     }
    else
    {
      titlemsg=typemsg+titlemsg;
    }
    
    
 
    
    
    
    $('#paper_name').val(titlemsg);
   // alert(titlemsg);
  }
	
	//搜索
	function searchdata()
	{
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
		var subjectid=$("#subjectid").val();
		var gradeid=$("#gradeid").val();
		var questionid=$("#questionid").val();
		var testkind=$('#testkind').val();
      
        $('#notesum').text('');
      	$('#questionsum').val('0');
       	$('#key_questionsum').val('0');
		
		//班级试题
		if(testkind==0) {
			$('#list1').html('');
	        managetestdata(userid,nowpage,pagelength,subjectid,gradeid,questionid);
		} else {
			$('#key_list1').html('');
			key_managetestdata(userid,nowpage,pagelength,subjectid,gradeid,questionid);
		}
	
	}
	
	function searchdatatype()
	{
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
		var subjectid=$("#subjectid").val();
		var gradeid=$("#gradeid").val();
		var questionid=$("#questionid").val();
		$('#list1').html('');
        managetestdata(userid,nowpage,pagelength,subjectid,gradeid,questionid);
	}
	
	//题型
	function questiontype()
	{
		var subjectid=$("#subjectid").val();
		if(subjectid) {
			$.ajax({
				url:"<?php echo U('questiontype');?>",
				data:{subjectid:subjectid},
				datatype:'json',
				type:'post',
				success:function(re){
					 $("#question").html(eval("("+re+")"));
				}
			});
		}
	}
	
	function nextpage(){
		var nowpage=$('#nowpage').text();
		var maxnum=$('#pagenum').text();
		var userid=$('#userid').val();
		var pagelength=$('#pagelength').val();
		var subjectid=$("#subjectid").val();
		var gradeid=$("#gradeid").val();
		var questionid=$('#questionid').val();
		

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
		managetestdata(userid,nowpage,pagelength,subjectid,gradeid,questionid);
		selectele();


	}
  
  	function key_nextpage(){
		var nowpage=$('#key_nowpage').text();
		var maxnum=$('#key_pagenum').text();
		var userid=$('#userid').val();
		var pagelength=$('#pagelength').val();
		var subjectid=$("#subjectid").val();
		var gradeid=$("#gradeid").val();
		var questionid=$('#questionid').val();

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
		$('#key_nowpage').text(nowpage);
		key_managetestdata(userid,nowpage,pagelength,subjectid,gradeid,questionid)
		key_selectele();


	}
	function managetestdata(userid,nowpage,pagelength,subjectid,gradeid,questionid)
	{
		$.ajax({
			url:"<?php echo U('phpmanagetestdata0201');?>",
			data:{userid:userid,nowpage:nowpage,pagelength:pagelength,subjectid:subjectid,gradeid:gradeid,questionid:questionid},
			datatype:'json',
			type:'post',
			success:function(re){
				var testlist=eval("("+re+")");
				var addhtmlmsg = '';
				var beginhtml = $('#list1').html();
				var mylength = testlist['length'];

				//设置班级试题的结果和层隐藏
				$('#list1').show();
				$('#downdiv').show();
				$('#key_list1').hide();
				$('#key_downdiv').hide();
				
				var testid = '';
				var pagenum=testlist['pagenum'];
				var papername;
				$('#pagenum').text(pagenum);
				var j;
				for (var i = 0; i < mylength; i++) {
					j=i+1;
					testid=testlist[i]['id'];
					papername=testlist[i]['num']+'. '+testlist[i]['paper_name']+'（'+testlist[i]['wrongsum']+'）';
					var ahtml='/index.php/Home/Student/managepaperdetail0202/testid/'+testid+'/userid/'+$('#userid').val()+'/typeid/'+questionid+'/paper_name/'+testlist[i]['paper_name']+'/username/'+$('#username').val()+'/realname/'+$('#realname').val()+'/testkind/0.html';
					addhtmlmsg=addhtmlmsg+'<li><div class="row"><div class="col-xs-1"><input style="font-size: 30px;zoom:130%;margin-top:6px;" onclick="selectsub()" name="testid" type="checkbox" value="'+testlist[i]['id']+'" ctsum="'+testlist[i]['wrongsum']+'"></div><div class="col-xs-10"><div style="padding-top: 4px;overflow-x:scroll;white-space: nowrap;"><a style="color: #000000;" href="'+ahtml+'">'+papername+'</a><span style="margin-left:15px;">班级试卷</span><br><a style="margin-left: 20px;color: #000000;">'+testlist[i]['publish_time']+'</a><a style="margin-left: 15px;color: #000000;">Edit：'+testlist[i]['lastreadtime']+'</a></div></div></div></li><hr style="margin-top: 14px; margin-bottom: 10px;background:#c3c3c3;height:1px;">';
					$('#list1').html(beginhtml + addhtmlmsg);
				}
			}
		})
	}
  
  	function key_managetestdata(userid,nowpage,pagelength,subjectid,gradeid,questionid)
	{
		$.ajax({
			url:"<?php echo U('phpkeymanagetestdata0201');?>",
			data:{userid:userid,nowpage:nowpage,pagelength:pagelength,subjectid:subjectid,gradeid:gradeid,questionid:questionid},
			datatype:'json',
			type:'post',
			success:function(re){
				var testlist=eval("("+re+")");
				var addhtmlmsg = '';
				var beginhtml = $('#key_list1').html();
				var mylength = testlist['length'];
				
				//设置班级试题的结果和层隐藏
				$('#list1').hide();
				$('#downdiv').hide();
				$('#key_list1').show();
				$('#key_downdiv').show();
				
				var testid = '';
				var pagenum=testlist['pagenum'];
				var papername;
				$('#key_pagenum').text(pagenum);
				var j;
				for (var i = 0; i < mylength; i++) {
					j=i+1;
					testid=testlist[i]['id'];
					papername=testlist[i]['num']+'. '+testlist[i]['paper_name']+'（'+testlist[i]['wrongsum']+'）';
					var ahtml='/index.php/Home/Student/managepaperdetail0202/testid/'+testid+'/userid/'+$('#userid').val()+'/paper_name/'+testlist[i]['paper_name']+'/username/'+$('#username').val()+'/realname/'+$('#realname').val()+'/typeid/'+$('#questionid').val()+'/testkind/1.html';
					addhtmlmsg=addhtmlmsg+'<li><div class="row"><div class="col-xs-1"><input style="font-size: 30px;zoom:130%;margin-top:6px;" onclick="key_selectsub()" name="key_testid" type="checkbox" value="'+testlist[i]['id']+'" ctsum="'+testlist[i]['wrongsum']+'"></div><div class="col-xs-10"><div style="padding-top: 4px;overflow-x:scroll;white-space: nowrap;"><a style="color: #000000;" href="'+ahtml+'">'+papername+'</a><span style="margin-left:15px;">'+testlist[i]['keynote_msg']+'</span><br><a style="margin-left: 20px;color: #000000;">'+testlist[i]['publish_time']+'</a><a style="margin-left: 15px;color: #000000;">Edit：'+testlist[i]['lastreadtime']+'</a></div></div></div></li><hr style="margin-top: 14px; margin-bottom: 10px;background:#c3c3c3;height:1px;">';
					$('#key_list1').html(beginhtml + addhtmlmsg);
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
  
  	function key_selectsub() {
		var mytestarr='';
		var ctsumarr='';
		var ctsum=0;
      
      
		$("input[name='key_testid']").each(function(){
			if($(this).prop("checked")==true)
			{

				mytestarr=mytestarr+','+$(this).val();
				ctsum=ctsum+$(this).attr('ctsum')*1;
			}
		});

		mytestarr=mytestarr.substr(1);

		$('#notesum').text('('+ctsum+')');
		$('#key_testidarr').val(mytestarr);
		$('#key_questionsum').val(ctsum);

	}
	function datasubmit(){
	
      var userid=$('#userid').val();
      
      var testkind=$('#testkind').find("option:selected").val();
      
      var typequestion=$('#questionid').val();
      
      var paper_name=$('#paper_name').val();
      
      var questionsum=$('#questionsum').val();
      
      var key_questionsum=$('#key_questionsum').val();
      
      var subjectid=$('#subjectid').find("option:selected").val();
      
    
      if(paper_name=='')
		{
			alert('请输入试卷名称！！');
			return;
		}


      
      if(testkind==0)
      {
        if(questionsum==0)
		{
			alert('请选择习题！！')
            return;
		}
        
        var questionsum=$('#questionsum').val();
		var testidarr=$('#testidarr').val();
		var paper_name=$('#paper_name').val();
      }
      else
      {
          if(key_questionsum==0)
		{
			alert('请选择知识点习题！！')
            return;
		}
        
        var questionsum=$('#key_questionsum').val();
		var testidarr=$('#key_testidarr').val();
		var paper_name=$('#paper_name').val();
        
      }
      
    //  alert('userid:'+userid+',testidarr:'+testidarr+',questionsum:'+questionsum+',paper_name:'+paper_name+',testkind:'+testkind+',typequestion:'+typequestion+',subjectid:'+subjectid);
	
     // return;
      
      $.ajax({
			url:"<?php echo U('phpstumytestdata');?>",
			data:{userid:userid,testidarr:testidarr,questionsum:questionsum,paper_name:paper_name,testkind:testkind,typequestion:typequestion,subjectid:subjectid},
			datatype:'json',
			type:'post',
			success:function(re){
				window.location.href ="/index.php/Home/Student/managelist0202/userid/"+$('#userid').val()+"/username/"+$('#username').val()+"/realname/"+$('#realname').val()+".html";
			}
		});


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
  
  	function key_selectele(){

		var txt=','+$('#key_testidarr').val()+',';
		var parttxt;
		$("input[name='key_testid']").each(function(){
			parttxt=','+$(this).val()+',';
			if(hasstring(parttxt,txt))
			{
				$(this).attr("checked",true);
			}
		});
	}
  
  
  function testkindsub(ele)
  {
    
    if($('#testkind').attr('testkind')=='0')
    {
       $('#testkind').attr('testkind','1');
       $('#testkind').text('知识点');
      
       $('#list1').css('display','none');
       $('#downdiv').css('display','none');
       $('#key_list1').css('display','');
       $('#key_downdiv').css('display','');
       key_selectsub();    
    }
    else
    {
       $('#testkind').attr('testkind','0');
       $('#testkind').text('班级试卷');
      
       $('#list1').css('display','');
       $('#downdiv').css('display','');
       $('#key_list1').css('display','none');
       $('#key_downdiv').css('display','none');
      
      selectsub();
      
      
    }
   
  }
</script>
</html>