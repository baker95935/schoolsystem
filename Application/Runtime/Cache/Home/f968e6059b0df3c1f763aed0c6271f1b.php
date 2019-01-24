<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="login-bg">
<head>
    <title>CTB-Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="/Public/jquery/jquery.min.js"></script>
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        tr.change:hover
        {
            background-color:#f4fafc;
        }
    </style>
</head>
<body>
<div class="container" style="width: 100%;">
<div class="row">
<div class="col-xs-9">
    <div class="row" style="height: 54px;"></div>
    <div class="row">
        <div class="col-xs-1"></div>
        <div class="col-xs-10">
            <table>
                <tr>
                    <td><a href="<?php echo U('Adminindex/index');?>"><img class="img-circle" style="width: 70px;height: 70px;" src="/Public/img/admin_radio.png"></a></td>

                    <td class="admin_title" style="padding-left: 20px;">
                        <span style="font-size: 24px;">习题处理模块-列表</span>
                        <br>
                        <span id="nowtimeid" class="admin_sec_title">当前日期：2018-2-12</span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-xs-1">
            <input id="tid" type="hidden" value="<?php echo ($userdata[id]); ?>">
            <input id="tusername" type="hidden" value="<?php echo ($userdata[username]); ?>">
            <input id="trealname" type="hidden" value="<?php echo ($userdata[realname]); ?>">
        </div>
    </div>
    <div class="row" style="margin-top: 34px;"> <hr class="admin_hr"></div>
    <div class="row">
        <div style="height: 30px;"></div>
        <div style="padding-left: 5%;"><b><span id="title_note" style="color: red;">待处理_习题统计列表_学校</span></b><label style="width: 50%;"></label><label><input type="radio"  value="1" name="paper_kind" checked="checked"><span style="margin-left: 4px;">学校试卷</span> <input name="paper_kind"  value="0" style="margin-left: 10px;" type="radio"><span  style="margin-left: 4px;">知识点试卷</span></label></div>
    </div>
    <div class="row" id="undotest" style="margin-top: 35px;">
        <div class="col-xs-12 admin_data_tabel admin_list" style="padding-left:5%;padding-right:5%;">
        <table style="width: 100%;margin-left:0px; margin-right:0px;border: 1px;">
            <tr style="height: 45px;">
                <th>序号</th><th>标题</th><th>用户id</th><th>时间</th><th>操作</th>
            </tr>
            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$testdata): $mod = ($i % 2 );++$i;?><tr class="change">
                <td ><?php echo ++$m1;?><input type="hidden" value="<?php echo ($testdata["id"]); ?>"></td><td ><?php echo ($testdata["paper_name"]); ?></td><td><?php echo ($testdata["userid"]); ?></td><td><?php echo ($testdata["creat_time"]); ?></td><td><a href="<?php echo U('delpublicsub',array('id'=>$testdata[id]));?>">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo U('test_whole02',array('filesernum'=>$testdata[filesernum],'kind'=>'school','oldstatus'=>'0'));?>">进行处理</a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
            <hr style="margin-top: 0px;">
            <div style="padding-right: 0px;"><div class="result page"><?php echo ($page); ?></div></div>
        </div>
    </div>

    <div class="row" id="undokeytest" style="margin-top: 35px;display: none;">
        <div class="col-xs-12 admin_data_tabel admin_list" style="padding-left:5%;padding-right:5%;">
            <table style="width: 100%;margin-left:0px; margin-right:0px;border: 1px;">
                <tr style="height: 45px;">
                    <th>序号</th><th>标题</th><th>用户id</th><th>时间</th><th>操作</th>
                </tr>
                <?php if(is_array($key_data)): $i = 0; $__LIST__ = $key_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$keytestdata): $mod = ($i % 2 );++$i;?><tr class="change">
                        <td ><?php echo ++$m2;?><input type="hidden" value="<?php echo ($keytestdata["id"]); ?>"></td><td ><?php echo ($keytestdata["paper_name"]); ?></td><td><?php echo ($keytestdata["userid"]); ?></td><td><?php echo ($keytestdata["creat_time"]); ?></td><td><a href="<?php echo U('delpublicsub',array('id'=>$testdata[id]));?>">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo U('test_whole02',array('filesernum'=>$keytestdata[filesernum],'kind'=>'key','oldstatus'=>'0'));?>">进行处理</a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            <hr style="margin-top: 0px;">
            <div style="padding-right: 0px;"><div class="result page"><?php echo ($key_page); ?></div></div>
        </div>
    </div>


    <div id="finishtest" class="col-xs-12 admin_data_tabel admin_list" style="padding-left:5%;padding-right:5%;margin-top:35px;display: none;">
          <table style="width: 100%;margin-left:0px; margin-right:0px;border: 1px;">
             <tr style="height: 45px;">
                    <th>序号</th><th>标题</th><th>用户id</th><th>时间</th><th>操作</th>
             </tr>
                <?php if(is_array($fdata)): $i = 0; $__LIST__ = $fdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$testdata): $mod = ($i % 2 );++$i;?><tr class="change">
                        <td ><?php echo ++$m3;?><input type="hidden" value="<?php echo ($testdata["id"]); ?>"></td><td ><?php echo ($testdata["paper_name"]); ?></td><td><?php echo ($testdata["userid"]); ?></td><td><?php echo ($testdata["creat_time"]); ?></td><td><a href="<?php echo U('delpublicsub',array('id'=>$testdata[id]));?>">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo U('test_whole02',array('filesernum'=>$testdata[filesernum],'kind'=>'school','oldstatus'=>'1'));?>">完成</a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            <hr style="margin-top: 0px;">
         <div style="padding-right: 0px;"><div class="result page"><?php echo ($fpage); ?></div></div>
     </div>

    <div id="keyfinishtest" class="col-xs-12 admin_data_tabel admin_list" style="padding-left:5%;padding-right:5%;margin-top:35px;display: none;">
        <table style="width: 100%;margin-left:0px; margin-right:0px;border: 1px;">
            <tr style="height: 45px;">
                <th>序号</th><th>标题</th><th>用户id</th><th>时间</th><th>操作</th>
            </tr>
            <?php if(is_array($key_fdata)): $i = 0; $__LIST__ = $key_fdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$keyftestdata): $mod = ($i % 2 );++$i;?><tr class="change">
                    <td ><?php echo ++$m4;?><input type="hidden" value="<?php echo ($keyftestdata["id"]); ?>"></td><td ><?php echo ($keyftestdata["paper_name"]); ?></td><td><?php echo ($keyftestdata["userid"]); ?></td><td><?php echo ($keyftestdata["creat_time"]); ?></td><td><a href="<?php echo U('delpublicsub',array('id'=>$testdata[id]));?>">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo U('test_whole02',array('filesernum'=>$keyftestdata[filesernum],'kind'=>'key','oldstatus'=>'1'));?>">完成</a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <hr style="margin-top: 0px;">
        <div style="padding-right: 0px;"><div class="result page"><?php echo ($key_fpage); ?></div></div>
    </div>
    </div>
    <div class="col-xs-3">
        <div class="row" style="height:70px; "></div>
        <div class="row" style=""><input id="inputbutton" type="submit" onclick="testsub()" value="处理完成习题" style="width:115px;height:32px;font-size:12px;background-color:#e8eef5; border: none;border-radius: 3px;border: 1px solid #cccccc;"></div>
         <div class="row" style="height: 80px;"></div>
            <div class="row">
                <div class="col-xs-1" style="height: 680px; border-left: 1px solid #dae2ea; "></div>
                <div class="col-xs-10">
                <div>统计数据(unfinished)</div>
                <div style="height: 100px;"></div>
                 <div style="color: #333333;">
               &nbsp;&nbsp;当前提交120张试卷，600张图片，最后一次提交为《初中物理试卷》。<br><br>&nbsp;&nbsp;1.习题列表&nbsp;2.整体处理&nbsp;3.试题分解&nbsp;4.答案分解&nbsp;5.完成返回<br><br>技术支持：18902182280<br><br><br>错题本系统V1.0
                </div>
            </div>
       <div class="col-xs-1"></div>
   </div>
</div>
</div>
</div>
<script>


    $(document).ready(function(){

        nowtime();

    })

    function testsub()
    {
        var paper_kind=$("input[name='paper_kind']:checked").val();
        if($('#undotest').css('display')!="none" || $('#undokeytest').css('display')!="none")
        {
            $('#undotest').css('display','none');
            $('#undokeytest').css('display','none');

            $('#finishtest').css('display','block');
            $('#keyfinishtest').css('display','block');



            if(paper_kind==1)
            {
                $('#keyfinishtest').css('display','none');
                $('#title_note').text('完成_习题统计列表_学校');
                $('#title_note').css('color','black');
            }

            if(paper_kind==0)
            {
                $('#finishtest').css('display','none');
                $('#title_note').text('完成_习题统计列表_知识点');
                $('#title_note').css('color','black');
            }



            $('#inputbutton').val('待处理习题');

           // $('#kind_input').val(1);
        }
        else
        {
            $('#undotest').css('display','block');
            $('#undokeytest').css('display','block');

            if(paper_kind==1)
            {
                $('#undokeytest').css('display','none');
                $('#title_note').text('待处理_习题统计列表_学校');
                $('#title_note').css('color','red');
            }

            if(paper_kind==0)
            {
                $('#undotest').css('display','none');
                $('#title_note').text('待处理_习题统计列表_知识点');
                $('#title_note').css('color','red');
            }



            $('#finishtest').css('display','none');
            $('#keyfinishtest').css('display','none');



            $('#inputbutton').val('处理完成习题');
          //  $('#kind_input').val(0);
        }
    }

    function nowtime()
    {
        var myDate = new Date();
        var year=myDate.getFullYear();    //获取完整的年份(4位,1970-????)
        var month=myDate.getMonth();       //获取当前月份(0-11,0代表1月)
        var date=myDate.getDate();        //获取当前日(1-31)
        var nowtime=year+'-'+(parseInt(month)+1)+'-'+date;
        $('#nowtimeid').text('当前日期：'+nowtime);
    }

    $('input[name="paper_kind"]').change(function() {

        var paper_kind=$("input[name='paper_kind']:checked").val();

        if(paper_kind==0)
        {

            if(($('#undotest').css('display')!="none" || $('#undokeytest').css('display')!='none') && $('#finishtest').css('display')!='block')
            {
                if($('#undotest').css('display')!="none")
                {
                    $('#title_note').text('待处理_习题统计列表_知识点');
                    $('#undotest').css('display','none');
                    $('#undokeytest').css('display','block');
                    $('#title_note').css('color','red');
                }else
                {
                    $('#title_note').text('待处理_习题统计列表_学校');
                    $('#undotest').css('display','block');
                    $('#undokeytest').css('display','none');
                    $('#title_note').css('color','red');
                }
            }


            if(($('#finishtest').css('display')!="none" || $('#keyfinishtest').css('display')!='none') && $('#undokeytest').css('display')!='block')
            {
                if($('#finishtest').css('display')!="none")
                {
                    $('#title_note').text('完成_习题统计列表_知识点');
                    $('#finishtest').css('display','none');
                    $('#keyfinishtest').css('display','block');
                    $('#title_note').css('color','black');
                }else
                {
                    $('#title_note').text('完成_习题统计列表_知识点');
                    $('#finishtest').css('display','block');
                    $('#keyfinishtest').css('display','none');
                    $('#title_note').css('color','black');
                }
            }

        }

        if(paper_kind==1)
        {
            if(($('#undotest').css('display')!="none" || $('#undokeytest').css('display')!='none') && $('#finishtest').css('display')!='block')
            {

                if($('#undotest').css('display')!="none")
                {
                    $('#title_note').text('待处理_习题统计列表_知识点');
                    $('#undotest').css('display','none');
                    $('#undokeytest').css('display','block');
                    $('#title_note').css('color','red');
                }else
                {
                    $('#title_note').text('待处理_习题统计列表_学校');
                    $('#undotest').css('display','block');
                    $('#undokeytest').css('display','none');
                    $('#title_note').css('color','red');
                }
            }

            if(($('#finishtest').css('display')!="none" || $('#keyfinishtest').css('display')!='none') && $('#undokeytest').css('display')!='block')
            {
                if($('#finishtest').css('display')!="none")
                {
                    $('#title_note').text('完成_习题统计列表_知识点');
                    $('#finishtest').css('display','none');
                    $('#keyfinishtest').css('display','block');
                    $('#title_note').css('color','black');
                }else
                {
                    $('#title_note').text('完成_习题统计列表_学校');
                    $('#finishtest').css('display','block');
                    $('#keyfinishtest').css('display','none');
                    $('#title_note').css('color','black');
                }
            }

        }


    });
</script>
</body>
</html>