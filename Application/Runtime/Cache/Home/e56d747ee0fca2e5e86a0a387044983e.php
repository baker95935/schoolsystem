<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>知识点辅导</title>
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


<!--<div  data-toggle="modal" data-target="#myModal" style="position: absolute;z-index:100;width: 80px;height:80px;background-color: #1b6d85;border-radius: 40px;top:70%;left: 70%;color: #ffffff;font-size: 16px;padding-top: 28px;text-align: center;"><span>预览</span><span id="notesum" style="margin-left: 2px;"></span></div>-->

 </div>
	<div class="container" style="height: 100%;">
		<div class="row title_class">
			<div class="col-xs-2"><a href="<?php echo U('managestuscore0401',array('userid'=>$userid,'username'=>$username,'realname'=>$realname,'keynote_id'=>$keynote_id));?>"><img src="/Public/img/reg_back.png" class="title_left_img"></a></div>
			<div class="col-xs-8  title_font_middle " >学生：<?php echo ($stu_name); ?></div>
			<div class="col-xs-2"><a href="<?php echo U('managestu_test0403',array('userid'=>$userid,'username'=>$username,'realname'=>$realname,'stu_id'=>$stu_id,'stu_name'=>$stu_name,'subject_id'=>$subject_id));?>" style="color: white;font-size: 15px;display: block;margin-top: 1px;">Test</a></div>
		</div>
		<div class="row parent_nav">
		<div class="col-xs-4" >
				<select onchange="searchdata()"  id="subjectid" name="subjectid" class="blackselect" style="padding-left: -10px;">
               <option value ="<?php echo ($subject_data["id"]); ?>">学科</option>
              <?php if(is_array($subject_data)): $i = 0; $__LIST__ = $subject_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subject_data): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($subject_data["id"]); ?>"><?php echo ($subject_data["subjectmsg"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				
			</select>


		</div>
			<div class="col-xs-4">
			<select onchange="searchdata()" name="gradeid" id="gradeid" class="blackselect">
				<option value="">班级</option>
				<option value="23">初一</option>
				<option value="24">初二</option>
				<option value="25">初三</option>
			</select>
			</div>

			<div class="col-xs-4">
				<select  onchange="searchdata()"  id="kind" name="kind" class="blackselect">
                  <option value="1">进行中</option>
				  <option value="0">关闭</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div id="contentdiv" class="col-xs-12" style="height: 600px;overflow-y: auto;">
				<ol id="list1" style="list-style-type:none;font-size: 15px;margin-left: -30px;padding-top: 10px;">

				</ol>
              <div id="downdiv" onclick="nextpage()" style="width: 100%;height: 40px; text-align: center;">点击加载习题（<span id="nowpage">1</span>/<span id="pagenum">4</span>）</div>
			</div>
		</div>
	</div>
  

	<input id="userid" type="hidden" value="<?php echo ($userid); ?>">
	<input id="pagelength" type="hidden" value="5">
	<input id="testidarr" type="hidden" value="">
	<input id="questionsum" type="hidden" value="0">
    <input id="stu_id" type="hidden" value="<?php echo ($stu_id); ?>">
  	<input id="stu_name" type="hidden" value="<?php echo ($stu_name); ?>">
    <input id="keynote_id" type="hidden" value="<?php echo ($keynote_id); ?>">
    <input id="subject_id" type="hidden" value="<?php echo ($subject_id); ?>">
    <input id="questioncount" type="hidden" value="0">
  	<input id="username" type="hidden" value="<?php echo ($username); ?>">
	<input id="realname" type="hidden" value="<?php echo ($realname); ?>">

</body>
<script src="/Public/js/g2.min.js"></script>
<script src="/Public/js/data-set.min.js"></script>
<script>
	$(function(){
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		var stu_id=$('#stu_id').val();
		var kind=$("#kind").val();
		var subjectid=$("#subjectid").val();
		var gradeid=$("#gradeid").val();
		
		managetestdata(stu_id,nowpage,pagelength,subjectid,gradeid,kind);
	});
	
	
	function searchdata()
	{
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		var stu_id=$('#stu_id').val();
		var kind=$("#kind").val();
		var subjectid=$("#subjectid").val();
		var gradeid=$("#gradeid").val();
		$('#nowpage').text(nowpage);
		
		$('#list1').html('');
		managetestdata(stu_id,nowpage,pagelength,subjectid,gradeid,kind);
	}
	
	function nextpage(){
		var nowpage=$('#nowpage').text();
		var maxnum=$('#pagenum').text();
		var stu_id=$('#stu_id').val();
		var pagelength=$('#pagelength').val();
		var kind=$("#kind").val();
		var subjectid=$("#subjectid").val();
		var gradeid=$("#gradeid").val();
		

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
		managetestdata(stu_id,nowpage,pagelength,subjectid,gradeid,kind);
		selectele();


	}
	function managetestdata(stu_id,nowpage,pagelength,subjectid,gradeid,kind)
	{     
            var key_status_01=$('#kind').find("option:selected").val();
            var subject_id=$('#subject_id').val();   
      
      		$.ajax({
			url:"<?php echo U('phpkeymsg0405');?>",
            async:false, 
			data:{stu_id:stu_id,nowpage:nowpage,pagelength:pagelength,subject_id:subject_id,kind:kind,subjectid:subjectid,gradeid:gradeid},
			datatype:'json',
			type:'post',
			success:function(re){
				var testlist=eval("("+re+")");
				var addhtmlmsg = '';
				var beginhtml = $('#list1').html();
				var mylength = testlist['length'];
              
			  	var count=testlist['count'];
                $('#questioncount').val(count);
         
				var testid = '';                           
				var pagenum=testlist['pagenum'];
               var stu_id=$('#stu_id').val();
              
              if(key_status_01==1)
              {
                var opermsg='统计';
              }
              else
              {
                var opermsg='删除';
              }
              
               // var pagenum=Math.ceil(count/mylength);
				var papername;
				$('#pagenum').text(pagenum);
				   var j;
				   for (var i = 0; i < mylength; i++) {
					addhtmlmsg=addhtmlmsg+'<li><div style="padding-left: 20px;padding-top: 4px;width: 330px;overflow-x:scroll;white-space: nowrap;">'+testlist[i]['num']+'.&nbsp;&nbsp;&nbsp;<a>'+testlist[i]['keynotemsg']+'</a>&nbsp;&nbsp;&nbsp;&nbsp;发布:'+testlist[i]['creattime']+'&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="cancel_sub(this)" name="'+testlist[i]['keynote_id']+'">取消</a>'+
                      '<hr><span style="margin-left: 16px;">Last:'+testlist[i]['lasttime']+'&nbsp;&nbsp;&nbsp;&nbsp;'+testlist[i]['ratio']+'%&nbsp;&nbsp;&nbsp;&nbsp;{'+testlist[i]['question_w']+'/'+testlist[i]['question_sum']+'}</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" keynote_id='+testlist[i]['keynote_id']+'  keynote_msg='+testlist[i]['keynotemsg']+'  stu_id='+stu_id+' onclick="statisticsub(this)">'+opermsg+'</a>'+
                      '</div><hr color="#1b6d85"></li>';  
                     $('#questionsum').val(testlist[i]['num']);
				}
               $('#list1').html(beginhtml + addhtmlmsg);
               
			}
		});
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
  function cancel_sub(ele)
  {
     var keynote_id=$(ele).attr('name');
     var stu_id=$('#stu_id').val(); 
     var key_status_01=$('#kind').val();
    
    $.ajax({
	    url:"<?php echo U('phpcanceltestdata');?>",
		data:{keynote_id:keynote_id,stu_id:stu_id,kind:key_status_01},
		datatype:'json',
      	async:false, 
		type:'post',
		success:function(re){
          
          $('#list1').html('');
          
          
           $nowpage1=$('#nowpage').text();
           $pagenum1=$('#pagenum').text();
          
          //alert($nowpage1+','+$pagenum1);
          	var kind=$("#kind").val();
		 var subjectid=$("#subjectid").val();
		 var gradeid=$("#gradeid").val();
          
          if($nowpage1==$pagenum1)
          {
             var questionsum=$('#questionsum').val();
             managetestdata(stu_id,1,questionsum,subjectid,gradeid,kind);
             var nowpage=$('#nowpage').text();
              questionsum=questionsum-1;
              $('#questionsum').val(questionsum);
          	  var questioncount=$('#questioncount').val();
          	  var pagelength=$('#pagelength').val(); 
         	  var pagenum=Math.ceil(questioncount/pagelength); 
         	  var havnum=(questioncount*1+1)%pagelength;

              if(havnum==1)
             {
                nowpage=nowpage-1;
                $('#nowpage').text(nowpage);
             }
             $('#pagenum').text(pagenum);
            
          }
          else
          {
             var questionsum=$('#questionsum').val();
             managetestdata(stu_id,1,questionsum,subjectid,gradeid,kind);
             var nowpage=$('#nowpage').text();
              //questionsum=questionsum-1;
              $('#questionsum').val(questionsum);
          	  var questioncount=$('#questioncount').val();
          	  var pagelength=$('#pagelength').val(); 
         	  var pagenum=Math.ceil(questioncount/pagelength); 
              $('#nowpage').text(nowpage);
              $('#pagenum').text(pagenum);
          }
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
  
  function statisticsub(ele)
  {
    var keynote_id=$(ele).attr('keynote_id');
    var stu_id=$(ele).attr('stu_id');
    var keynote_msg=$(ele).attr('keynote_msg');
    var subject_id=$('#subject_id').val();
    var stu_name=$('#stu_name').val();
    
    
    window.location.href ="/index.php/Home/Headteacher/keystatistic/userid/"+$('#userid').val()+"/username/"+$('#username').val()+"/realname/"+$('#realname').val()+"/keynote_id/"+keynote_id+"/stu_id/"+stu_id+"/stu_name/"+stu_name+"/subject_id/"+subject_id+"/keynotemsg/"+keynote_msg+".html";

  
    
    
  }
    
    
 
</script>
</html>