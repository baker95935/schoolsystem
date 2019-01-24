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
	<style type="text/css">
		input[type="checkbox"]:checked+label {color: #345ee5;}
		input[type="checkbox"] {
			position: absolute;
			clip: rect(0, 0, 0, 0);
		}
		input[type="checkbox"]+label{margin-left: 25px;color:#7b7a7a;font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana," sans-serif";font-weight:lighter;}

	</style>

</head>
<body class="background_color">


<!--<div  data-toggle="modal" data-target="#myModal" style="position: absolute;z-index:100;width: 80px;height:80px;background-color: #1b6d85;border-radius: 40px;top:70%;left: 70%;color: #ffffff;font-size: 16px;padding-top: 28px;text-align: center;"><span>预览</span><span id="notesum" style="margin-left: 2px;"></span>-->
<!--</div>-->

 </div>
	<div class="container" style="height: 100%;">
		<div class="row title_class">
			<div class="col-xs-2"><a href="<?php echo U('managestu_test0403',array('userid'=>$userid,'username'=>$username,'realname'=>$realname,'subject_id'=>$subject_id,'subject_msg'=>$subject_msg,'stu_id'=>$stu_id,'stu_name'=>$stu_name));?>"><img src="/Public/img/reg_back.png" class="title_left_img"></a></div>
			<div class="col-xs-8  title_font_middle " >习题-知识点</div>
			<div class="col-xs-2"><a href="#" style="color: white;font-size: 15px;display: block;margin-top: 1px;">Key</a></div>
		</div>
		<div class="row parent_nav">
		<div class="col-xs-3" >

			<select class="blackselect" style="padding-left: -10px;">
				<option value ="volvo"><?php echo ($subject_msg); ?></option>
			</select>

		</div>
		<div class="col-xs-3">

			<select class="blackselect">
				<option value ="<?php echo ($checktestkind); ?>"><?php echo ($checktestmsg); ?></option>
			</select>
		</div>
			<div class="col-xs-3">

				<select class="blackselect">
					<option value ="volvo">状态</option>
					<option value ="volvo">完成</option>
					<option value ="saab">未添加</option>
				</select>
			</div>

			<div class="col-xs-3">
				<select class="blackselect">
					<option value ="volvo">混合</option>
					<option value ="volvo">错题</option>
					<option value ="saab">知识点</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div id="contentdiv" class="col-xs-12" style="height: 600px;overflow-y: auto;">
				<div id="test_div" class="row" style="height: 300px;overflow-y: auto;padding-left: 10px;background-color: #ffffff;">
                  
                  
                  
			<ol id="list1" style="padding-right: 0%;padding-left: 0%;list-style-type:none;border: 0px;" class="parent_ol">
				<?php if(is_array($testdata)): $i = 0; $__LIST__ = $testdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$testid): $mod = ($i % 2 );++$i;?><li style="border: 0px;margin-top: 5px;">
						<table style="border: 1px;">
							<tr>
								<td style="padding-left: 15px;vertical-align: top;"><span style="margin-top: 0px;"><?php echo ($testid["newtitle"]); ?></span></td>
								<td><img id="img<?php echo ++$m;?>" name="<?php echo ($testid["id"]); ?>" onclick="answersub(this.id)" style="width: 100%"  src="<?php echo ($testid["src"]); ?>"></td>
							</tr>
							<tr>
								<td style="padding-left: 15px;vertical-align: top;"></td><td style="padding-right: 0px;text-align: center;"><img id="imga<?php echo ($m); ?>" src="<?php echo ($testid["pic1"]); ?>" style="width: 15%;"><img id="imgb<?php echo ($m); ?>" src="<?php echo ($testid["pic2"]); ?>" style="width: 15%;"><img id="imgc<?php echo ($m); ?>" src="<?php echo ($testid["pic3"]); ?>" style="width: 15%;"><img id="imgd<?php echo ($m); ?>" src="<?php echo ($testid["pic4"]); ?>" style="width: 15%;"></td>
							</tr>
							<tr>
								<td></td>
								<td style="text-align: center">
									<span style="font-size: 10px;"><?php echo ($testid["picnote"]); ?></span>
								</td>
							</tr>
						</table>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ol>
			<input type="hidden" id="sum" value="<?php echo ($m); ?>">
 
                  
                  
                  
				</div>

				<div id="mykey_div" class="row" style="height: 5px;background-color:#f3f3f3;padding-top:4px;padding-left: 10px;"></div>

				<div id="all_key_div" class="row" style="height: 310px;background-color: #FFFFFF;">
					<div id="my_key_div" class="col-xs-3" style="height: 295px;padding-top: 20px;overflow-y: auto;">
						
					</div>
					<div  class="col-xs-9" style="font-size:15px;border-left: 1px solid #1b6d85;padding-top: 20px;">
						<span style="font-size: 16px;" style="height: 260px;overflow-y: auto;"><?php echo ($subject_msg); ?>知识点</span><input onclick="inputkeynotesub()" style="margin-left: 40%;" type="button" value="确定"><hr>
                      <div id="keynote_div" style="height: 220px;overflow-y: auto;">

                      </div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<input id="userid" type="hidden" value="<?php echo ($userid); ?>">
  	<input id="username" type="hidden" value="<?php echo ($username); ?>">
  	<input id="realname" type="hidden" value="<?php echo ($realname); ?>">
  	<input id="subject_id" type="hidden" value="<?php echo ($subject_id); ?>">
	<input id="pagelength" type="hidden" value="10">
	<input id="testidarr" type="hidden" value="">
	<input id="questionsum" type="hidden" value="0">
    <input id="stu_id" type="hidden" value="<?php echo ($stu_id); ?>">
    <input id="stu_name" type="text" value="<?php echo ($stu_name); ?>">
  	<input id="checktestid" type="hidden" value="<?php echo ($checktestid); ?>">
</body>

<script>
	$(function(){
		var nowpage=1;
		var pagelength=$('#pagelength').val();
		var userid=$('#userid').val();
        keynote_data();
      my_keynote_data();
      
		//managetestdata(userid,nowpage,pagelength);
	});
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

		$("tr[name='testlisttr']").remove();
		$('#nowpage').text(nowpage);
		managetestdata(userid,nowpage,pagelength);
		selectele();


	}
	function managetestdata(userid,nowpage,pagelength)
	{
		$.ajax({
			url:"<?php echo U('phptestmsg0201');?>",
			data:{userid:userid,nowpage:nowpage,pagelength:pagelength},
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
					addhtmlmsg=addhtmlmsg+'<li><div style="padding-left: 20px;padding-top: 4px;width: 330px;overflow-x:scroll;white-space: nowrap;"><a style="color: #000000;" href="'+ahtml+'">'+papername+'</a><br><a style="margin-left: 20px;color: #000000;">'+testlist[i]['publish_time']+'</a><a style="margin-left: 15px;color: #000000;">Edit：'+testlist[i]['lastreadtime']+'</a></div></li><hr style="margin-top: 14px; margin-bottom: 10px;">';
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
  
  

  
  
	function keynote_data(){
		var subject_id=$('#subject_id').val();
		var userid=$('#userid').val();
		$.ajax({
			url:"<?php echo U('keynote_data_php');?>",
			data:{subject_id:subject_id},
			datatype:'json',
			type:'post',
			success:function(re){
              	var keylist=eval("("+re+")");
              	var mylength = keylist['count'];
              	var newletter='';
              	var newhtml='';
              	var letter_msg='';
              	var keynote_html='';
          		for (var i = 0; i < mylength; i++)
                {
                     if(keylist[i]['letter']!=newletter)
                     {
                       if(i==0)
                       {
                         letter_msg='<span>'+keylist[i]['letter'].toUpperCase()+'</span><br>';
						 keynote_html='<input type="checkbox"  id="object'+i+'" name="keynote" value="'+keylist[i]['id']+'"><label for="object'+i+'">'+keylist[i]['keynotemsg']+'</label>';
                       	 newhtml=newhtml+letter_msg+keynote_html;
                         newletter=keylist[i]['letter'];
                       }
                       else
                       {
                         letter_msg='<br><span>'+keylist[i]['letter'].toUpperCase()+'</span><br>';
						 keynote_html='<input type="checkbox"  id="object'+i+'"  name="keynote" value="'+keylist[i]['id']+'"><label for="object'+i+'">'+keylist[i]['keynotemsg']+'</label>';
                         newhtml=newhtml+letter_msg+keynote_html;
                         newletter=keylist[i]['letter'];
                       }
                      
                     }
                  else
                  	{
                       	keynote_html='<input type="checkbox"  id="object'+i+'"  name="keynote" value="'+keylist[i]['id']+'"><label for="object'+i+'">'+keylist[i]['keynotemsg']+'</label>';
                        newhtml=newhtml+keynote_html;
                        newletter=keylist[i]['letter'];
                  	}
                }
              
              $('#keynote_div').html(newhtml);
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
  
  function inputkeynotesub()
  {
     var keynote_arr='';
     $("input[name='keynote']:checked").each(function(){
		  keynote_arr=keynote_arr+','+$(this).val();		
	 });
    keynote_arr=keynote_arr.substr(1);
    var subject_id=$('#subject_id').val();
	var stu_id=$('#stu_id').val();
    
    var checktestid=$('#checktestid').val();
    		$.ajax({
			url:"<?php echo U('inputkeynotesub');?>",
			data:{subject_id:subject_id,stu_id:stu_id,keynote_arr:keynote_arr,checktestid:checktestid},
			datatype:'json',
			type:'post',
			success:function(re){
              window.location.href ="/index.php/Home/Headteacher/managestu_keylist0405/userid/"+$('#userid').val()+"/stu_id/"+$('#stu_id').val()+"/stu_name/"+$('#stu_name').val()+"/username/"+$('#username').val()+"/realname/"+$('#realname').val()+"/subject_id/"+$('#subject_id').val()+".html";
            }
            })
  };
  
    function my_keynote_data(){
		var subject_id=$('#subject_id').val();
		var stu_id=$('#stu_id').val();
      
		$.ajax({
			url:"<?php echo U('my_keynote_data_php');?>",
			data:{subject_id:subject_id,stu_id:stu_id},
			datatype:'json',
			type:'post',
			success:function(re){
              	var mykeylist=eval("("+re+")");
              	var mylength = mykeylist['count'];
                var newhtml='';
              
               for(var i=0;i<mylength;i++)
               {
                 newhtml=newhtml+'<span>'+mykeylist[i]['keynotemsg']+'</span><br><span  style="color: red;font-size: 14px;">'+mykeylist[i]['question_w']+'</span><span>&nbsp;&nbsp;</span><span style="color: #269edf;font-size: 14px;margin-left: 4px;">'+mykeylist[i]['question_sum']+'</span><br><hr>';
               }
              
              $('#my_key_div').html(newhtml);
            }
        })
    };
  
</script>
</html>