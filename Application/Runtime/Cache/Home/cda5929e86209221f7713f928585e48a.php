<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<title>错题系统</title>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="/Public/jquery/jquery.min.js"></script>
	<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="/Public/bootstrap/js/bootstrap.min.js"></script>
<!--<link rel="stylesheet" type="text/css" href="http://cdn.gbtags.com/twitter-bootstrap/3.2.0/css/bootstrap.min.css"/>-->
<link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
</head>
<body class="background_color" onload="notesub()">
<div class="container">
	<div class="row">
		<div class="col-xs-2 teacher_left_01"></div>
		<div class="col-xs-8 teacher_middle_01">
			<div id="teacher_middle_01_01" class="row" style="height: 60px;">
				<div class="col-xs-6" style="text-align: left;"><div class="teacher_font">2017</div></div>
				<div class="col-xs-6" style="text-align: right;"><div class="teacher_font">待处理习题</div></div>
			</div>
			<div id="teacher_middle_01_02" style="overflow-y: scroll;" class="row" >
				<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$testmsg): $mod = ($i % 2 );++$i;?><div class="teacher_test_row"><?php echo ++$a;?>.&nbsp;<?php echo ($testmsg["paper_name"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($testmsg["creat_time"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;<span id="msgnote<?php echo ++$b;?>" ><?php echo ($testmsg["statusmsg"]); ?></span></div><?php endforeach; endif; else: echo "" ;endif; ?>
				<div id="downdiv" style="width: 100%;height: 40px; text-align: center;">加载数据!!</div>

			</div >
            <input id="msgnum" type="hidden" value="<?php echo ($msgnum); ?>">
		</div>
		<div class="col-xs-2 teacher_right_01" ></div>
	</div>
	<div class="row teacher_bottom">
		<div class="col-xs-2"><a href="<?php echo U('home','userid='.$userid.'&username='.$username.'&realname='.$realname);?>"><img class="teacher_bottom_left_img_a img-responsive center-block " src="/Public/img/setpage_04_a.gif"></a></div>
		<form  action="<?php echo U('setpage0101','userid='.$userid.'&username='.$username.'&realname='.$realname);?>" enctype="multipart/form-data" method="post">

		<div class="col-xs-8 teacher_bottom_middle"><button type="submit"  style="height: 100%;width: 100%;background: transparent;border: 0px;">添加新的习题</button></div>

		</form>
		<div class="col-xs-2"><img class="teacher_bottom_right_img img-responsive center-block " src="/Public/img/setpage_06.png"></div>
	</div>
</div>
<input type="hidden" id="downjust" value="0">
<input type="hidden" id="beginnum" value="0">
<input type="hidden" id="datacount" value="<?php echo ($datacount); ?>">

</body>
<script>
	function notesub()
	{
		var num=$('#msgnum').val();
		for(var i=1;i<=num+1;i++)
		{
			var msgnotename="#msgnote"+i;
			if($(msgnotename).text()=="0")
			{
				$(msgnotename).text("未处理");
			}
			var msgnotename="#msgnote"+i;
			if($(msgnotename).text()=="1")
			{
				$(msgnotename).text("处理中");
			}
			if($(msgnotename).text()=="2")
			{
				$(msgnotename).text("处理完成");
			}
		}
	}

	$(document).ready(function(){
		$('#teacher_middle_01_02').scroll(function(event)
		{
			var scollheight=$('#teacher_middle_01_02').scrollTop();
			var allheight=$('#teacher_middle_01_02').prop('scrollHeight');
			var divheight=$('#teacher_middle_01_02').outerHeight(true);

			$('#scollheight').val(scollheight);
			$('#height').val(allheight);
			$('#divheight').val(divheight);
			var leveltop=$('#updiv').height();
			var bottomval=allheight-divheight-4;

			if(scollheight>bottomval)
			{
				if($('#downjust').val()=='0')
				{
					sqlsub();
					$('#downjust').val(1);
				}
			}

			if(scollheight<bottomval-30)
			{
				$('#downdiv').html('加载数据！！');
				$('#downjust').val(0);
			}
		})
	});

	function sqlsub(){

	    var beginnum=parseInt($('#msgnum').val())+1;
        var tlength=8;
        if(beginnum==$('#datacount').val())
        {
			$('#downdiv').html('已经是最后一条数据！！');
           return;
        }

        if(beginnum+parseInt(tlength)>$('#datacount').val())
        {
            var tlength=$('#datacount').val()-beginnum;
        }

        var datacount=$('#datacount').val();

		var j=0;

		$.ajax({
			url: "<?php echo U('dataphpsql');?>",
			type: 'POST',
			async:false,
			data: {beginnum:beginnum, tlength:tlength,datacount:datacount},
			dataType: 'json',
			success: function (re) {
				var addhtmlmsg='';
				var i=re['beginnum'];
				var length=i+parseInt(re['length']);
                var endhtml='<div id="downdiv" style="width: 100%;height: 40px; text-align: center;">down</div>';
				for(var i=re['beginnum'];i<length;i++)
				{
                    j=i+1;
					addhtmlmsg=addhtmlmsg+'<div class="teacher_test_row">'+j+'.&nbsp;'+re[i]['paper_name']+'&nbsp;&nbsp;&nbsp;&nbsp;'+re[i]['creat_time']+'&nbsp;&nbsp;&nbsp;&nbsp;<span>'+re[i]['statusmsg']+'</span></div>';
				}

                $('#msgnum').val(i-1);
                $('#downdiv').remove();
                var beginhtml=$('#teacher_middle_01_02').html();
                $('#teacher_middle_01_02').html(beginhtml+addhtmlmsg+endhtml);
			}
		})
	}
</script>

</html>