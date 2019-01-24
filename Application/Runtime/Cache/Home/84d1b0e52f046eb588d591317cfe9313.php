<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>发布任务</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
	<script src="/Public/datapickercss/js/jquery.min.js"></script>
<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="/Public/bootstrap/js/bootstrap.min.js"></script>
<link href="/Public/datapickercss/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="/Public/datapickercss/css/test.css" rel="stylesheet" />

<script src="/Public/datapickercss/bootstrap/js/bootstrap.js"></script>
<link href="/Public/datapickercss/datapicker/css/bootstrap-datepicker3.css" rel="stylesheet">
<script src="/Public/datapickercss/datapicker/js/bootstrap-datepicker.js"></script>
<script src="/Public/datapickercss/datapicker/locales/bootstrap-datepicker.zh-CN.min.js"></script>
<script src="/Public/datapickercss/js/test.js"></script>


</head>
<body style="background-color:#48a0dc;">
	<div class="container">
		<div class="row title_class">
			<div class="col-xs-2"><a href="<?php echo U('home',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>"><img src="/Public/img/reg_back.png" class="title_left_img"></a></div>
			<div class="col-xs-8  title_font_middle " ><?php echo ($realname); ?></div>
			<div class="col-xs-2 " ><div class="a_white"><a href="<?php echo U('publicpaper_list0202',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>">发布</a></div></div>
		</div>
		<div class="row">
			<div class="col-xs-12 teacher_nav_background_pic">
			<div class="row" style="height: 50px;"></div>
			<div class="row">
				<div class="col-xs-1"></div>
				<div class="col-xs-10">
				<div  style="margin-top: -10px;">
				<table border="0" style="width: 96%;margin: 0 auto;height: 120px;">
  					<tbody>
  					  <tr>
  					    <td style="width: 72%;">
  					   	<div class="teacher_nav_div" style="height: 120px;">
  					   		<table border="0" style="width: 100%;height: 100%;">
  <tbody>
    <tr style="height: 50%;">
      <td>
      <input id="startDate"  name="startDate" class="date-picker teacher_input_css"  placeholder="开始时间" value=""  readonly="true;">
      </td>
      <td> <div  style="border-left:1px solid gray" class="teacher_tab_bg"></div></td>
      <td>
      <input id="endDate" name="endDate" class="date-picker teacher_input_css"  placeholder="结束时间" value=""  readonly="true;">
      </td>
    </tr>
    <tr style="height: 50%;border-top:1px solid gray ">
      <td colspan="3">        
        <form> 
        <div class="teacher_tab_bg">
         <input id="keywords" name="keywords" required="required" type="text" class="name-input input_class textarea_line" style="width: 100%;" placeholder="关键词" />
         </div>
         </form>
         </td>
      </tr>
  </tbody>
</table>
 					    				   	</div>
  					    </td>
 					     <td style="width: 4%">&nbsp;</td>
   						   <td style="width: 24%;">
   						   		<div class="teacher_nav_div teacher_img_button_div">
   						   		<a onclick="searchData();" href="#"><img src="/Public/img/seekbutton.jpg" class="teacher_img_seek" ></a>
   						   		</div>	
					    </td>
  					  </tr>
 				 </tbody>
				</table>
				
			
				</div>
			  </div>
				<div class="col-xs-1"></div>
			</div>				
			</div>
		</div>
	  <div class="row" style="margin-top: 0px;">
	  <div class="col-xs-1"></div>
		<div id="contentdiv" class="col-xs-10 teacher_paper_panel" style="height: 470px;overflow-y: auto;">
          <div class="row h6 teacher_prompt_msg" ><span id="testsum"></span>套习题符合搜索条件</div>
			<ol id="list1">
			</ol>
			<div id="downdiv" onclick="nextpage()" style="width: 100%;height: 40px; text-align: center;">点击加载习题（<span id="nowpage">1</span>/<span id="pagenum">4</span>）</div>
		</div>
	  <div class="col-xs-1"></div>
		</div>
		
	</div>

	<input id="msgnum" type="hidden" value="<?php echo ($msgnum); ?>">
	<input type="hidden" id="downjust" value="0">
	<input type="hidden" id="beginnum" value="0">
	<input type="hidden" id="username" value="<?php echo ($username); ?>">
	<input type="hidden" id="realname" value="<?php echo ($realname); ?>">
	<input type="hidden" id="datacount" value="<?php echo ($datacount); ?>">

	<input id="userid" type="hidden" value="<?php echo ($userid); ?>">
	<input id="pagelength" type="hidden" value="5">
</body>

<script>
//页面初始化
$(function(){
	var nowpage=1;
	var pagelength=$('#pagelength').val();
	var userid=$('#userid').val();
	var keywords=$("#keywords").val();
	var startDate=$("#startDate").val();
	var endDate=$("#endDate").val();
	
	testdata(userid,nowpage,pagelength,keywords,startDate,endDate);
});
//下一页
function nextpage(){
	var nowpage=$('#nowpage').text();
	var maxnum=$('#pagenum').text();
	var userid=$('#userid').val();
	var pagelength=$('#pagelength').val();
	var height=$('#contentdiv').scrollTop();
	var keywords=$("#keywords").val();
	var startDate=$("#startDate").val();
	var endDate=$("#endDate").val();

	nowpage=nowpage*1+1;
	if(nowpage>maxnum)
	{
		return;
	}
	if(nowpage<1)
	{
		return;
	}

	$('#nowpage').text(nowpage);
	testdata(userid,nowpage,pagelength);
	$('#contentdiv').scrollTop(height);


}
function searchData()
{
	var nowpage=1;
	var pagelength=$('#pagelength').val();
	var userid=$('#userid').val();
	var keywords=$("#keywords").val();
	var startDate=$("#startDate").val();
	var endDate=$("#endDate").val();
	$('#nowpage').text(nowpage);
	$('#list1').html('');
	testdata(userid,nowpage,pagelength,keywords,startDate,endDate);
}

//加载页面数据
function testdata(userid,nowpage,pagelength,keywords,startDate,endDate)
{


	$.ajax({
		url:"<?php echo U('dataphpsql0201');?>",
		data:{userid:userid,nowpage:nowpage,pagelength:pagelength,keywords:keywords,startDate:startDate,endDate:endDate},
		datatype:'json',
		type:'post',
		success:function(re) {
			var testlist=eval("("+re+")");
			var addhtmlmsg = '';
			var beginhtml = $('#list1').html();
			var mylength = testlist['length'];
            var testsum=testlist['count'];
			var testid = '';
			var pagenum=testlist['pagenum'];
			$('#pagenum').text(pagenum);
            $('#testsum').text(testsum);
          

			for (var i = 0; i < mylength; i++) {
				testid=testlist[i]['id'];
				var ahtml='/index.php/Home/Headteacher/publicpaper_class0202/testid/'+testid+'/userid/'+$('#userid').val()+'/username/'+$('#username').val()+'/realname/'+$('#realname').val()+'/paper_name/'+testlist[i]['paper_name']+'.html';
				addhtmlmsg=addhtmlmsg+'<li><a href="'+ahtml+'"><p class="h5">'+testlist[i]['paper_name']+'</p> <p  class="h6">考试日期：'+testlist[i]['publish_time']+'；试题数：'+testlist[i]['questionsum']+'题。</p></a><hr></li>';
				$('#list1').html(beginhtml + addhtmlmsg);
			}

		}

	});
}

</script>


</html>