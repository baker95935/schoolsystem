<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>错题管理</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
	<script src="/Public/jquery/jquery.min.js"></script>
	<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="/Public/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/Public/css/stu.css"/>

<script language="javascript">  
    function work1(target) {
		$("#dropdownMenu1").text($(target).text());
    }   
	
	 function work2(target) {
		$("#dropdownMenu2").text($(target).text());
    }  
	
		 function work3(target) {
		$("#dropdownMenu3").text($(target).text());
    }  
	
       $(document).ready(function(){
 			$("b").click(function(){
				$('#myModal01').modal(); 
 		});
	   	});
</script>

</head>
<body class="" style="background-color: #FFFFFF;">
<div id="answerdiv" onclick="answerdivsub()" style="width: 100%;min-height: 80px;border:1px;position: absolute;z-index: 2;top:30%;display: none;">
	<img id="preanswerimg" style="width: 40px;height: 40px;"><img id="answerimg" style="width: 90%;margin-left: 5%;border: 1px solid #000000;" src="">
</div>
	<div class="container">
		<div class="row title_class">
			<div class="col-xs-2"><a href="<?php echo U('managelist0202',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>"><img src="/Public//img/reg_back.png" class="title_left_img"></a></div>
			<div class="col-xs-8  title_font_middle " ><?php echo ($paper_name); ?></div>
			<div class="col-xs-2"><a style="color:white;" href="<?php echo U('home',array('userid'=>$userid,'username'=>$username,'realname'=>$realname));?>">主页</a></div>
		</div>
		<div class="row parent_nav">
		<div class="col-xs-4" >
			<div class="dropdown">
	<button type="button" class="btn dropdown-toggle parent_button" id="dropdownMenu1" 
			data-toggle="dropdown">
隐藏答案		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
		<li role="presentation" >
			<a  href="javascript:void(0)" onclick="work1(this)" role="menuitem" tabindex="-1" href="#">隐藏答案</a>
		</li>
		<li role="presentation">
			<a  href="javascript:void(0)" onclick="work1(this)" role="menuitem" tabindex="-1" href="#">显示答案</a>
		</li>
		<li role="presentation">
			<a  href="javascript:void(0)" onclick="work1(this)" role="menuitem" tabindex="-1" href="#">点击弹出</a>
		</li>
	</ul>
</div>

			
			
		</div>
		<div class="col-xs-4">
			
			
				<div class="dropdown">
	<button type="button" class="btn dropdown-toggle parent_button"  id="dropdownMenu2" 
			data-toggle="dropdown">
题行间距	<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
		<li role="presentation" >
			<a  href="javascript:void(0)" onclick="work2(this)" role="menuitem" tabindex="-1" href="#">1</a>
		</li>
		<li role="presentation">
			<a  href="javascript:void(0)" onclick="work2(this)" role="menuitem" tabindex="-1" href="#">2</a>
		</li>
		<li role="presentation">
			<a  href="javascript:void(0)" onclick="work2(this)" role="menuitem" tabindex="-1" href="#">3</a>
		</li>
		<li role="presentation">
			<a  href="javascript:void(0)" onclick="work2(this)" role="menuitem" tabindex="-1" href="#">4</a>
		</li>
		<li role="presentation" class="divider"></li>
		<li role="presentation">
			<a  href="javascript:void(0)" onclick="work2(this)" role="menuitem" tabindex="-1" href="#">默认</a>
		</li>
	</ul>
</div>
			
			
			
		</div>
		<div class="col-xs-4">
			<select class="blackselect" style="background-color: transparent;font-weight: normal;" onchange="window.location=this.value">
				<option value ="<?php echo U('managelistdetail0203',array('testid'=>$testid,'userid'=>$userid,'paper_name'=>$paper_name));?>"> 导出</option>
				<option value="<?php echo U('phpmanagelistdownloadpdf',array('testid'=>$testid,'outkind'=>'D','paper_name'=>$paper_name,'testtime'=>$testtime));?>">习题pdf</option>
				<option value="<?php echo U('phpmanagelistdownloadanswerpdf',array('testid'=>$testid,'outkind'=>'D','paper_name'=>$paper_name,'testtime'=>$testtime));?>" >答案pdf</option>
			</select>
		</div>	
		</div>
		<div class="row">
        <div class="col-xs-12" style="padding-left: 0px;padding-right: 0px;height: 532px;overflow-y: auto;">
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
		</div>
	</div>
<div class="modal fade" id="myModal01" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top:10px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel" style="text-align: center;">
				本题答案及解析					</h4>
			</div>
			<div class="modal-body">
				<p>答案：C</p>
				<p>主要是考察完形填空方面的内容，同学们要十分注意。本题错误率达到60%。</p>
			</div>
		
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>
	<input type="hidden" value="<?php echo ($testarr); ?>" id="testarrid">
	<!--<input type="hidden" value="<?php echo ($testid); ?>" id="testid">-->
	<!--<input type="hidden" value="<?php echo ($userid); ?>" id="userid">-->
<script>

	$(function(){
		var sum=$('#sum').val();
		var i=1;
		for(i=1;i<=sum;i++)
		{
			//alert('pica'+i);
			var imgsrca=$('#imga'+i)[0].src;
			var imgsrcb=$('#imgb'+i)[0].src;
			var imgsrcc=$('#imgc'+i)[0].src;
			var imgsrcd=$('#imgd'+i)[0].src;

			if(imgsrca.indexOf('uploads')>0)
			{

			}
			else
			{
				$('#imga'+i).remove();
			}

			if(imgsrcb.indexOf('uploads')>0)
			{

			}
			else
			{
				$('#imgb'+i).remove();
			}

			if(imgsrcc.indexOf('uploads')>0)
			{

			}
			else
			{
				$('#imgc'+i).remove();
			}

			if(imgsrcd.indexOf('uploads')>0)
			{

			}
			else
			{
				$('#imgd'+i).remove();
			}


		}
	})


	function answersub(id)
	{
		var id=$('#'+id).attr('name');
		$.ajax({
			url:"<?php echo U('answersql');?>",
			data:{id:id},
			dataType:'text',
			type:'post',
			success:function(re){
				if(re!=0)
				{
					$('#answerdiv').css('display','');
					$('#answerimg').attr('src',re);
					$('#preanswerimg').attr('src',re);
				}
				else
				{

				}
			}
		})
	}

	function answerdivsub()
	{
		$('#answerdiv').css('display','none');
	}
	function testtopdf()
	{
//		var testarr=$('testarrid').val();
//		$.ajax({
//			url: "<?php echo U('papertopdf');?>",
//			type: 'POST',
//			async:false,
//			data: {testarr:testarr},
//			dataType: 'json',
//			success: function (re) {
//				alert('下载成功！！');
//
//
//
//			}
//		})
	}
</script>
</body>
</html>