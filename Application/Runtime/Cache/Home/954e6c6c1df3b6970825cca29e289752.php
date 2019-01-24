<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="login-bg">
<head>
    <title>CTB-Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />






    <script src="/Public/jquery/jquery.min.js"></script>
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
    <script src="/Public/js/addtest.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<!--test选项框-->
<div id="ttsquarebutton" onclick="tsquaresub()" style="width: 15px;height: 20px;background-color: #000000;position: absolute;z-index: 2;opacity:0.3;display:none;"></div>
<div id="ttdiv" onclick="divsub()" style="width: 15px;height: 20px;background-color: red;position: absolute;z-index: 2;opacity:0.45;display:none;"></div>
<!--answer选项框-->
<div id="atsquarebutton" onclick="presquaresub()" style="width: 15px;height: 20px;background-color: #000000;position: absolute;z-index: 5;opacity:0.4;display:none;"></div>
<div id="atdiv"onclick="predivsub()"  style="width: 15px;height: 20px;background-color: red;position: absolute;z-index: 2;opacity:0.55;display:none;"></div>

<div id="phone_test"  style="overflow-y: scroll;width: 430px;height: 640px;position: absolute;border: 1px solid #9d9d9d;background-color:#FFFFFF;z-index: 3;top: 100px;left:100px;display:none;">
<div id="titlediv" style="width: 100%;text-align: center;font-size: 16px;margin-top: 20px;"><?php echo ($title); ?><a href="javascript:void(0)" onclick="downloadpdf()"><u>下载pdf</u></a></div>
</div>
<div id="thr"  class="cutinglinecss" onclick="cutlinesub()" style="width: 1200px;height: 1px;"></div>
<img id="del_img_up" class="del_img" src="/Public/img/del_arrow_a.png" onclick="cutlinesub()" >
<img id="del_img_down" class="del_img" src="/Public/img/del_arrow_c.png" onclick="cutlinesub()" >
<img id="del_img_right" class="del_img" src="/Public/img/del_arrow_b.png" onclick="cutlinesub()" >
<img id="del_img_left" class="del_img" src="/Public/img/del_arrow_d.png" onclick="cutlinesub()" >
<div id="tvline"  class="cutinglinecss" onclick="cutlinesub()" style="height: 375px;width: 1px;"></div>


<div id="prethr" class="cutinglinecss" onclick="precutlinesub()"  style="width: 150px;height: 1px;"></div>
<img id="del_img_up_pre" class="del_img_pre" src="/Public/img/del_arrow_a.png" onclick="precutlinesub()">
<img id="del_img_down_pre" class="del_img_pre" src="/Public/img/del_arrow_c.png" onclick="precutlinesub()">
<img id="del_img_right_pre" class="del_img_pre" src="/Public/img/del_arrow_b.png" onclick="precutlinesub()">
<img id="del_img_left_pre" class="del_img_pre" src="/Public/img/del_arrow_d.png" onclick="precutlinesub()">
<div id="pretvline"  class="cutinglinecss" onclick="precutlinesub()" style="width: 1px;height: 375px;"></div>


<div class="contain" style="width: 100%">
    <div class="row" style="height: 45px;"></div>
    <div class="row">
        <div class="col-xs-4" style="padding-left:45px;">
            <span id="titlenote" style="font-size: 18px;"><b>习题*&nbsp;&nbsp;|&nbsp;&nbsp;答案&nbsp;&nbsp;&nbsp;</b></span><span style="font-size: 13px;">橡皮擦</span>
        </div>
        <div class="col-xs-4"></div>
        <div class="col-xs-4">
            <div class="admin_bt_div">
                <table>
                    <tr>
                        <td>
                            <div class="admin_div_unchicked">
                                <a href="<?php echo U('test_list01');?>">习题列表</a>
                            </div>
                        </td>
                        <td>
                            <div  class="admin_div_unchicked">
                                <a href="<?php echo U('test_whole02',array('filesernum'=>$filesernum,'kind'=>$kind,'oldstatus'=>$oldstatus));?>">整体处理</a>
                            </div>
                        </td>
                        <td>
                            <div  class="admin_div_unchicked">
                                <a href="<?php echo U('test_del03',array('filesernum'=>$filesernum,'kind'=>$kind,'oldstatus'=>$oldstatus));?>">习题分解</a>
                            </div>
                        </td>
                        <td>
                            <div  class="admin_div_unchicked">
                                <a href="<?php echo U('answer_del04',array('filesernum'=>$filesernum,'kind'=>$kind,'oldstatus'=>$oldstatus));?>">答案分解</a>
                            </div>
                        </td>
                        <td>
                            <div style="color: #c0b9c8" class="admin_div_unchicked admin_list">
                                橡皮擦处理
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row" style="height: 43px;"></div>
    <div class="row" style="min-height: 26px;width:1455px;border: 1px solid #eaf0f2;text-align: center;font-size: 12px;padding-top: 4px;padding-bottom: 4px;">

        <span>习题：&nbsp;</span>
        <span><input name="testedit" type="radio" value="title"  />&nbsp;T橡皮擦&nbsp;&nbsp;<input name="testedit" type="radio" value="cut"  checked="checked">&nbsp;D橡皮擦&nbsp; &nbsp;<input name="tedit" type="checkbox" value="re" checked="checked">&nbsp;自动拼接&nbsp;<input id="topersave" type="checkbox" value="save" checked="checked">&nbsp;自动保存&nbsp;&nbsp;&nbsp;&nbsp;<input id="toperdown" type="checkbox" value="down" checked="checked">&nbsp;自动向下 &nbsp;&nbsp;&nbsp;&nbsp;<input id="tinputw" type="text" style="width: 22px;" value="15"><span style="font-size:20px;height: 18px;">×</span><input id="tinputh" type="text" style="width: 22px;" value="20">&nbsp;&nbsp;&nbsp;<input type="button" style="width: 40px;" onclick="ttsquarebuttonsub()" value="OK"></span>
        <span class="framelist"><a href="<?php echo U('test_preview_06',array('filesernum'=>$filesernum));?>">习题下载(N)</a></span> <span class="framelist">&nbsp;&nbsp;&nbsp;&nbsp;<a  href="<?php echo U('answer_preview_06',array('filesernum'=>$filesernum));?>">答案下载</a></span>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <span>剪切处理：&nbsp;</span>
        <span><input id="cut_up" name="cut" type="radio" value="up"  />&nbsp;向上剪切&nbsp;&nbsp;<input  id="cut_down"  name="cut" type="radio"   value="down" >&nbsp;向下剪切&nbsp;<input  id="cut_left"  name="cut" type="radio" value="left" checked="checked" >&nbsp;向左剪切&nbsp;<input  id="cut_right"  name="cut" type="radio" value="right" >&nbsp;向右剪切</span>


        <span id="button_del05">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><a href="<?php echo U('finish06',array('filesernum'=>$filesernum,'statusmsg'=>'1','kind'=>$kind));?>">完成</a></u>&nbsp;&nbsp;</span>
    </div>
    <div class="row" style="height: 15px;"></div>
    <div class="row black_a" style="height: 420px;width:1455px;background-color: #9eb3c3;">
        <div  style="text-align: center;width: 1455px;height: 20px;color: white;">
            <span>&nbsp;&nbsp;</span>
            <span id="tnowtitle" style="margin-left: 20px;color: white;margin-top: 10px;">当前题:<?php echo ($tdata[0][title]); ?></span>&nbsp;&nbsp;&nbsp;<span id="testkind">题型：选择题</span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <!--<input name="aedit" type="checkbox" value="re" checked="checked">&nbsp;进行剪切&nbsp;-->
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>左旋转：&nbsp;</span>
            <a href="#"><span id="left_reg" onclick="rotatesub(this.id)"><-</span></a>
            <span>&nbsp;<span id="regspan">0</span>&nbsp;</span>
            <a href="#">
            <span id="right_reg" onclick="rotatesub(this.id)">-></span></a>&nbsp;:右旋转</span>
        <span>&nbsp;</span>
        <input id="smallrotate" type="checkbox" checked="checked" value="0.1">小角度（0.1）
        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
         <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>题型：</span>
            <select id="typechoose" onchange="typechoose()">
                <option value="0">未选择</option>
                <?php if(is_array($questiontype)): $i = 0; $__LIST__ = $questiontype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$typeid): $mod = ($i % 2 );++$i;?><option value="<?php echo ($typeid["id"]); ?>"><?php echo ($typeid["typesmsg"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
        <div id="contenttest" style="height: 400px; border: 1px solid #f9f9f8;background-color: #9eb3c3;overflow-y: scroll;">
            <!--<hr>-->
            <table>
                <tr>
                    <td> <img id="testimg" onclick="cutlinesub()" style="width: 1200px;margin-left: 30px;margin-top: 10px;" src="<?php echo ($tdata[0][src]); ?>"></td><td style="vertical-align: top;"><img id="testimgpre"  onclick="precutlinesub()"   src="0" style="width: 150px;margin-left: 40px;margin-top: 10px;"></td>
                </tr>
            </table>

        </div>

    </div>
    <div class="row" style="width: 1455px;">
        <div class="col-xs-6" style="min-height: 240px;border-right: 1px solid #728090;background-color: #fcf9e2;">
            <div class="row">
                <div class="col-xs-2"></div>
                <div class="col-xs-8" style="background-color: #fcf9e2;min-height:200px;padding-top: 30px;text-align: center;">
                    <div class="row"></div>
                    <div style="width: 100%;text-align: right;">
                        <span id="testnote">习题*：</span>         <span>Cancel:(Z)        </span><span id="tnexttitle">下一题:<?php echo ($tdata[1][title]); ?></span>
                    </div>
                    <div id="tcontentid" style="height: 180px;width:465px;overflow-y: scroll;">
                        <table border="1px;" style="width: 460px;background-color: #2b669a;color:white;">
                            <tr style="height: 45px;">
                                <th style="text-align: center;display:none;">序号</th><th style="text-align: center;">标题</th><th style="text-align: center;">题型</th><th style="text-align: center;">题数</th><th style="text-align: center;">操作</th>
                            </tr>
                            <?php if(is_array($tdata)): $i = 0; $__LIST__ = $tdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$testdata): $mod = ($i % 2 );++$i;?><input type="hidden" value="<?php echo ($m++); ?>">

                            <tr style="height: 45px;" id="ttr<?php echo ($m); ?>">
                                <td style="display:none;"><?php echo ($m); ?></td> <td id="ta<?php echo ($m); ?>"><?php echo ($testdata["title"]); ?></td><td  id="tb<?php echo ($m); ?>"><?php echo ($testdata["typesmsg"]); ?></td> <td ><input  id="tnum<?php echo ($m); ?>" name="<?php echo ($testdata["myid"]); ?>" type="text" value="<?php echo ($testdata["questionnum"]); ?>" onchange="testnum(this.id);" style="width: 40px;color:grey;border: 0px;text-align: center;" autocomplete="off"></td>  <td  id="tf<?php echo ($m); ?>"><input id="tid<?php echo ($m); ?>" type="hidden" value="<?php echo ($testdata["id"]); ?>"><input id="tsrc<?php echo ($m); ?>" type="hidden" value="<?php echo ($testdata["src"]); ?>"><a  id="tfa<?php echo ($m); ?>" href="javascript:void(0)" onclick="choosetest(this.id)">选择</a></td>
                                <input id="trationa<?php echo ($m); ?>" type="hidden" value="<?php echo ($testdata["rationa"]); ?>"><input id="trationb<?php echo ($m); ?>" type="hidden" value="<?php echo ($testdata["rationb"]); ?>">
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            <input type="hidden" id="tsum" value="<?php echo ($m); ?>">
                        </table>
                    </div>
                </div>
                <div class="col-xs-2" style=" min-height: 200px;">
                </div>
            </div>
        </div>
        <div class="col-xs-6" style="min-height: 240px;background-color: #fcf9e2;">
            <div class="row">
                <div class="col-xs-2"></div>
                <div class="col-xs-8" style="background-color: #fcf9e2;min-height:200px;text-align: center;padding-top: 30px;">
                    <div style="width: 100%;text-align: right;">
                        <span id="answernote">答案：</span>           <span>Cancel:(X)        </span>下一题:  <span id="anexttitle"></span>
                    </div>
                    <div id="acontentid" style="height: 180px;width:465px;overflow-y: scroll;">
                        <table border="1px;" style="width: 460px;background-color: #2b669a;color:white;">
                            <tr style="height: 45px;">
                                <th style="text-align: center;display:none;">序号</th><th style="text-align: center;">标题</th><th style="text-align: center;">操作</th>
                            </tr>
                            <?php if(is_array($adata)): $i = 0; $__LIST__ = $adata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$answerdata): $mod = ($i % 2 );++$i;?><input type="hidden" value="<?php echo ($n++); ?>">

                                <tr style="height: 45px;" id="atr<?php echo ($n); ?>">
                                    <td style="display:none;"><?php echo ($n); ?></td> <td  id="aa<?php echo ($n); ?>"><?php echo ($answerdata["title"]); ?></td>  <td  id="af<?php echo ($n); ?>"><input id="aid<?php echo ($n); ?>" type="hidden" value="<?php echo ($answerdata["id"]); ?>"><input id="asrc<?php echo ($n); ?>" type="hidden" value="<?php echo ($answerdata["src"]); ?>"><a  id="afa<?php echo ($n); ?>" href="javascript:void(0)" onclick="chooseanswer(this.id)">选择</a></td>
                                    <input id="arationa<?php echo ($n); ?>" type="hidden" value="<?php echo ($answerdata["rationa"]); ?>"><input id="arationb<?php echo ($n); ?>" type="hidden" value="<?php echo ($answerdata["rationb"]); ?>">

                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            <input type="hidden" id="asum" value="<?php echo ($n); ?>">
                        </table>
                    </div>
                </div>
                </div>
                <div class="col-xs-2">
                </div>
            </div>
        </div>
    </div>
</div>
<input id="tpre" type="hidden" value="0">
<input id="apre" type="hidden" value="0">

<!--当前标题删除选框位置-->
<input id="ttlocal_x" type="hidden" value="0">
<input id="ttlocal_y" type="hidden" value="0">
<input id="ttlocal_width" type="hidden" value="5">
<input id="ttlocal_height" type="hidden" value="10">

<!--完成标题删除选框位置-->
<input id="fttlocal_x" type="hidden" value="0">
<input id="fttlocal_y" type="hidden" value="0">
<input id="fttlocal_width" type="hidden" value="5">
<input id="fttlocal_height" type="hidden" value="10">
<input id="ftstation" type="hidden" value="0">

<!--当前删除选框位置-->
<input id="tdlocal_x" type="hidden" value="0">
<input id="tdlocal_y" type="hidden" value="0">
<input id="tdlocal_width" type="hidden" value="5">
<input id="tdlocal_height" type="hidden" value="10">

<!--完成标题删除选框位置-->
<input id="ftdlocal_x" type="hidden" value="0">
<input id="ftdlocal_y" type="hidden" value="0">
<input id="ftdlocal_width" type="hidden" value="15">
<input id="ftdlocal_height" type="hidden" value="20">
<input id="fdstation" type="hidden" value="0">



<input id="atlocal_x" type="hidden" value="0">
<input id="atlocal_y" type="hidden" value="0">
<input id="atlocal_width" type="hidden" value="5">
<input id="atlocal_height" type="hidden" value="10">


<input id="fatlocal_x" type="hidden" value="0">
<input id="fatlocal_y" type="hidden" value="0">
<input id="fatlocal_width" type="hidden" value="5">
<input id="fatlocal_height" type="hidden" value="10">
<input id="fastation" type="hidden" value="0">

<input id="nowkind" type="hidden" value="test">
<input id="nowid" type="hidden">

<input id="filesernum" type="hidden" value="<?php echo ($filesernum); ?>">
<input id="kind" type="hidden" value="<?php echo ($kind); ?>">
<input id="oldstatus" type="hidden" value="<?php echo ($oldstatus); ?>">


<script>
    $(document).ready(function(){
        $('#ttr1').css('background-color','#FFFFFF');
        $('#ttr1').css('color','#2b669a');
        $('#ttr1').css('color','#2b669a');
        $('#tfa1').css('color','#2b669a');
        $('#tpre').val(1);


        var num=$('#tpre').val();
        var id=$('#tid'+num).val();
        $('#nowid').val(id);

        $('#atr1').css('background-color','#FFFFFF');
        $('#atr1').css('color','#2b669a');
        $('#atr1').css('color','#2b669a');
        $('#afa1').css('color','#2b669a');
        $('#apre').val(1);


        var tsum=$('#displaytsum').val();

        for(var i=1;i<=tsum;i++)
        {
            if($('#textimg'+i).attr('src')=='.')
            {
                $('#textimg'+i).remove();
                var msg=$('#textid'+i).html().replace(/&nbsp;/ig,'');
                $('#textid'+i).html(msg);
            }
        }

        for(var j=1;j<=tsum;j++)
        {

            var msg=$('#textid'+j).html().replace(/&nbsp;/ig,'');
            $('#textid'+j).html(msg);

            var width=$('#textimg'+j).attr('class');


            if($('#tpic1'+j).attr('src')!='')
            {
                var width1=$('#tpic1'+j).attr('class');
                var pic1width=width1/width;
                pic1width=pic1width.toFixed(2)*100+'%';
                $('#tpic1'+j).css('width',pic1width);
            }
            if($('#tpic2'+j).attr('src')!='')
            {
                var width2=$('#tpic2'+j).attr('class');
                var pic2width=width2/width;
                pic2width=pic2width.toFixed(2)*100+'%';
                $('#tpic2'+j).css('width',pic2width);

            }
            if($('#tpic3'+j).attr('src')!='')
            {
                var width3=$('#tpic3'+j).attr('class');
                var pic3width=width3/width;
                pic3width=pic3width.toFixed(2)*100+'%';
                $('#tpic3'+j).css('width',pic3width);
            }
            if($('#tpic4'+j).attr('src')!='')
            {
                var width4=$('#tpic4'+j).attr('class');
                var pic4width=width4/width;
                pic4width=pic4width.toFixed(2)*100+'%';
                $('#tpic4'+j).css('width',pic4width);
            }


            if($('#tpic1'+j).attr('src')=='' && $('#tpic2'+j).attr('src')=='' && $('#tpic3'+j).attr('src')=='' && $('#tpic4'+j).attr('src')=='')
            {
                $('#titleid'+j).remove();
            }


            if($('#tpic1'+j).attr('src')=='')
            {
                $('#tpic1'+j).remove();
            }
            if($('#tpic2'+j).attr('src')=='')
            {
                $('#tpic2'+j).remove();
            }
            if($('#tpic3'+j).attr('src')=='')
            {
                $('#tpic3'+j).remove();
            }
            if($('#tpic4'+j).attr('src')=='')
            {
                $('#tpic4'+j).remove();
            }
        }
        var width=$('#textimg22').attr('class');



        initcutlinelocalsub();


    });
///下一个习题
    function tnextsub() {
        var prenum=$('#tpre').val();

        if(prenum==$('#tsum').val())
        {
            return;
        }
        $('#ttr'+prenum).css('background-color','#2b669a');
        $('#ttr'+prenum).css('color','#FFFFFF');
        $('#ttr'+prenum).css('color','#FFFFFF');
        $('#tfa'+prenum).css('color','#FFFFFF');
        var num=parseInt(prenum)+1;
        $('#ttr'+num).css('background-color','#FFFFFF');
        $('#ttr'+num).css('color','#2b669a');
        $('#ttr'+num).css('color','#2b669a');
        $('#tfa'+num).css('color','#2b669a');
        $('#tpre').val(num);

        var str=$('#ta'+num).html();

        str = str.replace(/&nbsp;/ig,'');

        $('#tnowtitle').text(str);

        var tsum=$('#tsum').val();

        if(num!=tsum)
        {
            num1=parseInt(num)+1;
            var str1=$('#ta'+num1).html();
            str1 = str1.replace(/&nbsp;/ig,'');
            $('#tnexttitle').text(str1);
        }
        else
        {
            $('#tnexttitle').text(str);
        }



        var mydate = new Date();
        var src=$('#tsrc'+num).val();
        src=src+'?'+mydate.getTime();
        if(src=='')
        {
            $('#testimg').css('display','none');
        }
        else
        {
            $('#testimg').attr('src',src);
            $('#testimgpre').attr('src',src);
        }

        var top=$('#tcontentid').scrollTop();
        top=parseInt(top)+45;
        $('#tcontentid').scrollTop(top);
    }
//前一个习题
    function tpresub() {

        var prenum=$('#tpre').val();
        if(prenum==1)
        {
            return;
        }
        $('#ttr'+prenum).css('background-color','#2b669a');
        $('#ttr'+prenum).css('color','#FFFFFF');
        $('#ttr'+prenum).css('color','#FFFFFF');
        $('#tfa'+prenum).css('color','#FFFFFF');

        var num=parseInt(prenum)-1;

        $('#ttr'+num).css('background-color','#FFFFFF');
        $('#ttr'+num).css('color','#2b669a');
        $('#ttr'+num).css('color','#2b669a');
        $('#tfa'+num).css('color','#2b669a');
        $('#tpre').val(num);


        var str=$('#ta'+num).html();

        str = str.replace(/&nbsp;/ig,'');

        $('#tnowtitle').text(str);

        var tsum=$('#tsum').val();

        if(num!=tsum)
        {
            num1=parseInt(num)+1;
            var str1=$('#ta'+num1).html();
            str1 = str1.replace(/&nbsp;/ig,'');
            $('#tnexttitle').text(str1);
        }
        else
        {
            $('#tnexttitle').text(str);
        }




        var mydate = new Date();
        var src=$('#tsrc'+num).val();
        src=src+'?'+mydate.getTime();
        if(src=='')
        {
            $('#testimg').css('display','none');
        }
        else
        {
            $('#testimg').attr('src',src);
            $('#testimgpre').attr('src',src);
        }
        var top=$('#tcontentid').scrollTop();
        top=parseInt(top)-45;
        $('#tcontentid').scrollTop(top);

    }
//下一个答案
    function anextsub() {
        var prenum=$('#apre').val();
        if(prenum==$('#asum').val())
        {
            return;
        }
        $('#atr'+prenum).css('background-color','#2b669a');
        $('#atr'+prenum).css('color','#FFFFFF');
        $('#atr'+prenum).css('color','#FFFFFF');
        $('#afa'+prenum).css('color','#FFFFFF');

        var num=parseInt(prenum)+1;

        $('#atr'+num).css('background-color','#FFFFFF');
        $('#atr'+num).css('color','#2b669a');
        $('#atr'+num).css('color','#2b669a');
        $('#afa'+num).css('color','#2b669a');
        $('#apre').val(num);


        var str=$('#aa'+num).html();

        str = str.replace(/&nbsp;/ig,'');

        $('#anowtitle').text(str);

        var asum=$('#asum').val();

        if(num!=asum)
        {
            num1=parseInt(num)+1;
            var str1=$('#aa'+num1).html();
            str1 = str1.replace(/&nbsp;/ig,'');
            $('#anexttitle').text(str1);
        }
        else
        {
            $('#anexttitle').text(str);
        }




        var mydate = new Date();
        var src=$('#asrc'+num).val();
        src=src+'?'+mydate.getTime();
        if(src=='')
        {
            $('#testimg').css('display','none');
        }
        else
        {
            $('#testimg').attr('src',src);
            $('#testimgpre').attr('src',src);
        }
        var top=$('#acontentid').scrollTop();
        top=parseInt(top)+45;
        $('#acontentid').scrollTop(top);
    }
//上一个答案
    function apresub() {
        var prenum=$('#apre').val();
        if(prenum==1)
        {
            return;
        }

        $('#atr'+prenum).css('background-color','#2b669a');
        $('#atr'+prenum).css('color','#FFFFFF');
        $('#atr'+prenum).css('color','#FFFFFF');
        $('#afa'+prenum).css('color','#FFFFFF');

        var num=parseInt(prenum)-1;

        $('#atr'+num).css('background-color','#FFFFFF');
        $('#atr'+num).css('color','#2b669a');
        $('#atr'+num).css('color','#2b669a');
        $('#afa'+num).css('color','#2b669a');
        $('#apre').val(num);


        var str=$('#aa'+num).html();

        str = str.replace(/&nbsp;/ig,'');

        $('#anowtitle').text(str);

        var asum=$('#asum').val();

        if(num!=asum)
        {
            num1=parseInt(num)+1;
            var str1=$('#aa'+num1).html();
            str1 = str1.replace(/&nbsp;/ig,'');
            $('#anexttitle').text(str1);
        }
        else
        {
            $('#anexttitle').text(str);
        }


        var mydate = new Date();
        var src=$('#asrc'+num).val();
        src=src+'?'+mydate.getTime();
        if(src=='')
        {
            $('#testimg').css('display','none');
        }
        else
        {
            $('#testimg').attr('src',src);
            $('#testimgpre').attr('src',src);
        }

        var top=$('#acontentid').scrollTop();
        top=parseInt(top)-45;
        $('#acontentid').scrollTop(top);

    }
//习题选择
    function choosetest(id){
        var num=id.replace(/[^0-9]/ig,"");
        var prenum=$('#tpre').val();


        $('#testimg').css('display','block');

        $('#ttr'+prenum).css('background-color','#2b669a');
        $('#ttr'+prenum).css('color','#FFFFFF');
        $('#ttr'+prenum).css('color','#FFFFFF');
        $('#tfa'+prenum).css('color','#FFFFFF');



        $('#ttr'+num).css('background-color','#FFFFFF');
        $('#ttr'+num).css('color','#2b669a');
        $('#ttr'+num).css('color','#2b669a');
        $('#tfa'+num).css('color','#2b669a');

        var mydate = new Date();
        var src=$('#tsrc'+num).val();
        src=src+'?'+mydate.getTime();
        if(src=='')
        {
            $('#testimg').css('display','none');
        }
        else
        {
            $('#testimg').attr('src',src);
            $('#testimgpre').attr('src',src);
        }

        $('#tpre').val(num);


        var str=$('#ta'+num).html();

        str = str.replace(/&nbsp;/ig,'');

        $('#tnowtitle').text(str);

        var tsum=$('#tsum').val();

        if(num!=tsum)
        {
            num1=parseInt(num)+1;
            var str1=$('#ta'+num1).html();
            str1 = str1.replace(/&nbsp;/ig,'');
            $('#tnexttitle').text(str1);
        }
        else
        {
            $('#tnexttitle').text(str);
        }

        nowkindsub('test');
    }
//答案选择
    function chooseanswer(id){
        var num=id.replace(/[^0-9]/ig,"");

        $('#answerimg').css('display','block');

        var prenum=$('#apre').val();
        $('#atr'+prenum).css('background-color','#2b669a');
        $('#atr'+prenum).css('color','#FFFFFF');
        $('#atr'+prenum).css('color','#FFFFFF');
        $('#afa'+prenum).css('color','#FFFFFF');


        $('#atr'+num).css('background-color','#FFFFFF');
        $('#atr'+num).css('color','#2b669a');
        $('#atr'+num).css('color','#2b669a');
        $('#afa'+num).css('color','#2b669a');




        var str=$('#aa'+num).html();

        str = str.replace(/&nbsp;/ig,'');

        $('#anowtitle').text(str);

        var asum=$('#asum').val();

        if(num!=asum)
        {
            num1=parseInt(num)+1;
            var str1=$('#aa'+num1).html();
            str1 = str1.replace(/&nbsp;/ig,'');
            $('#anexttitle').text(str1);
        }
        else
        {
            $('#anexttitle').text(str);
        }



        var mydate = new Date();
        var src=$('#asrc'+num).val();
        src=src+'?'+mydate.getTime();
        if(src=='')
        {
            $('#testimg').css('display','none');
        }
        else
        {
            $('#testimg').attr('src',src);
            $('#testimgpre').attr('src',src);
        }


        $('#apre').val(num);

        nowkindsub('answer');
    }
//标题橡皮擦(习题)位置
    function ttsquarebutton() {

        var x0=$('#testimg').offset().left;
        var y0=$('#testimg').offset().top;

        var ttlocal_x=$('#ttlocal_x').val();
        var ttlocal_y=$('#ttlocal_y').val();
        var width=$('#ttlocal_width').val();
        var height=$('#ttlocal_height').val();

        var x=parseInt(ttlocal_x)+parseInt(x0);
        var y=parseInt(ttlocal_y)+parseInt(y0);


        var ttlocal_width=$('#ttlocal_width').val();
        var ttlocal_height=$('#ttlocal_height').val();


        newPos=new Object();
        newPos.left= x-2;
        newPos.top= y-4;

//        alert(width);

        $('#ttsquarebutton').offset(newPos);
        $('#ttsquarebutton').css('width',width);
        $('#ttsquarebutton').css('height',height);
        $('#ttsquarebutton').css('display','block');
    }
//习题图片移动事件
    function testimgsub(){

        var checkval=$("input[name=testedit]:checked").attr('value');

        if(checkval=='title')
        {
            kind='title';
        }

        if(checkval=='cut')
        {
            kind='cut';

            $('#ttdiv').css('display','none');
            $('#ttdiv').css('width',0);
            $('#ttdiv').css('height',0);
            $('#fttlocal_x').val(0);
            $('#fttlocal_y').val(0);
            $('#ftstation').val(0);


            $('#atdiv').css('display','none');
            $('#atdiv').css('width',0);
            $('#atdiv').css('height',0);
            $('#fatlocal_x').val(0);
            $('#fatlocal_y').val(0);
            $('#fastation').val(0);

            $('#ttsquarebutton').css('display','none');
            $('#atsquarebutton').css('display','none');
            return;
        }

        var e=window.event;

        var x1 = e.pageX;
        var y1= e.pageY;

        var x0=$('#testimg').offset().left;
        var y0=$('#testimg').offset().top;

        var ttlocal_x=x1-x0;
        var ttlocal_y=y1-y0;

        var kind='';


        $('#ttlocal_x').val(ttlocal_x.toFixed(2));
        $('#ttlocal_y').val(ttlocal_y.toFixed(2));



        ttsquarebutton();



    }
    //图片上面鼠标跟随
    $("#testimg").ready(function(){
        $("#testimg").mousemove(function(e) {
            var checkval=$("input[name=testedit]:checked").attr('value');
            if(checkval=='title')
            {
                testimgsub();
            }
            else
            {
                $('#ttdiv').css('display','none');
                $('#ttdiv').css('width',0);
                $('#ttdiv').css('height',0);
                $('#fttlocal_x').val(0);
                $('#fttlocal_y').val(0);
                $('#ftstation').val(0);


                $('#atdiv').css('display','none');
                $('#atdiv').css('width',0);
                $('#atdiv').css('height',0);
                $('#fatlocal_x').val(0);
                $('#fatlocal_y').val(0);
                $('#fastation').val(0);

                $('#ttsquarebutton').css('display','none');
                $('#atsquarebutton').css('display','none');


                testimglinesub();
            }

        })
    });
    //习题方框函数now121
    function tsquaresub(){

        $('#ttdiv').css('display','');

        var x,y,width,height,m,n;

        var x01=$('#testimg').offset().left;
        var y01=$('#testimg').offset().top;
        var x02=parseInt($('#testimg').offset().left)+parseInt($('#testimg').width());
        var y02=parseInt($('#testimg').offset().top)+parseInt($('#testimg').height());


        var x1=$('#ttsquarebutton').offset().left;
        var y1=$('#ttsquarebutton').offset().top;
        var x2=parseInt($('#ttsquarebutton').offset().left)+parseInt($('#ttsquarebutton').width());
        var y2=parseInt($('#ttsquarebutton').offset().top)+parseInt($('#ttsquarebutton').height());

        if(x01>x1)
        {
            x=x01;
        }
        else
        {
            x=x1;
        }
        x=x.toFixed(2);

        if(y01>y1)
        {
            y=y01;
        }
        else
        {
            y=y1;
        }
        y=y.toFixed(2);

        if(x2>x02)
        {
            m=x02;
        }
        else
        {
            m=x2;
        }
        m=m.toFixed(2);

        if(y2>y02)
        {
            n=y02;
        }
        else
        {
            n=y2;
        }
        n=n.toFixed(2);

        width=m-x;
        height=n-y;



        if($('#ftstation').val()==0)
        {
            $('#ttdiv').css('display','block');
            $('#fttlocal_x').val(x);
            $('#fttlocal_y').val(y);

            newPos=new Object();
            newPos.left= x;
            newPos.top= y;

            $('#ttdiv').offset(newPos);


            $('#ftstation').val(1);

            $('#ttdiv').css('width',width);
            $('#ttdiv').css('height',height);

        }
        else {
            width=parseInt(x)+parseInt(width)- parseInt($('#fttlocal_x').val());
            height=parseInt(y)+parseInt(height)- parseInt($('#fttlocal_y').val());
            $('#ttdiv').css('width',Math.abs(width));
            $('#ttdiv').css('height',Math.abs(height));
        }

    }
    //习题方框函数now121
    function presquaresub(){

        $('#atdiv').css('display','');

        var x,y,width,height,m,n;

        var x01=$('#testimgpre').offset().left;
        var y01=$('#testimgpre').offset().top;
        var x02=parseInt($('#testimgpre').offset().left)+parseInt($('#testimgpre').width());
        var y02=parseInt($('#testimgpre').offset().top)+parseInt($('#testimgpre').height());


        var x1=$('#atsquarebutton').offset().left;
        var y1=$('#atsquarebutton').offset().top;
        var x2=parseInt($('#atsquarebutton').offset().left)+parseInt($('#atsquarebutton').width());
        var y2=parseInt($('#atsquarebutton').offset().top)+parseInt($('#atsquarebutton').height());

        if(x01>x1)
        {
            x=x01;
        }
        else
        {
            x=x1;
        }
        x=x.toFixed(2);

        if(y01>y1)
        {
            y=y01;
        }
        else
        {
            y=y1;
        }
        y=y.toFixed(2);

        if(x2>x02)
        {
            m=x02;
        }
        else
        {
            m=x2;
        }
        m=m.toFixed(2);

        if(y2>y02)
        {
            n=y02;
        }
        else
        {
            n=y2;
        }
        n=n.toFixed(2);

        width=m-x;
        height=n-y;



        if($('#fastation').val()==0)
        {
            $('#atdiv').css('display','block');
            $('#fatlocal_x').val(x);
            $('#fatlocal_y').val(y);

            newPos=new Object();
            newPos.left= x;
            newPos.top= y;

            $('#atdiv').offset(newPos);


            $('#fastation').val(1);

            $('#atdiv').css('width',width);
            $('#atdiv').css('height',height);

        }
        else {
            width=parseInt(x)+parseInt(width)- parseInt($('#fatlocal_x').val());
            height=parseInt(y)+parseInt(height)- parseInt($('#fatlocal_y').val());
            $('#atdiv').css('width',Math.abs(width));
            $('#atdiv').css('height',Math.abs(height));
        }

    }
    function divsub(){

//        alert($('#nowkind').val());
        if($('#nowkind').val()=='test')
        {
            ttdivsub();
        }
        else
        {
            atdivsub();
        }
       // ttdivsub();
    }
    function predivsub(){

//        alert($('#nowkind').val());
        if($('#nowkind').val()=='test')
        {
            prettdivsub();
        }
        else
        {
            preatdivsub();
        }
        // ttdivsub();
    }
//预览进行剪切
    function prettdivsub(){

        var checkval=$("input[name=testedit]:checked").attr('value');


        var num=$('#tpre').val();

        var src=$('#tsrc'+num).val();
        var trationa=$('#trationa'+num).val();


        var x0=$('#testimgpre').offset().left;
        var y0=$('#testimgpre').offset().top;

        var x1=$('#atdiv').offset().left;
        var y1=$('#atdiv').offset().top;

        var x=x1-x0;
        var y=y1-y0;

        var width=$('#atdiv').width();
        var height=$('#atdiv').height();

        var id=$('#tid'+num).val();

        var newsrc;

        x=(x*trationa).toFixed(2);
        y=(y*trationa).toFixed(2);
        width=(width*trationa).toFixed(2);
        height=(height*trationa).toFixed(2);

        $.ajax({
            url: "<?php echo U('erasetestsql');?>",
            type: 'POST',
            async:false,
            data: {id:id,x: x,y: y,width:width, height: height,src:src,kind:checkval},
            dataType: 'json',
            success: function (re) {

                if(checkval=='title')
                {
//                    $('#tb'+num).html(x);
//                    $('#tc'+num).html(y);
//                    $('#td'+num).html(width);
//                    $('#te'+num).html(height);
                    newsrc=src+'?'+timemsgsub();
                    $('#testimg').attr('src',newsrc);
                    $('#testimgpre').attr('src',newsrc);
                }
                else
                {
                    newsrc=src+'?'+timemsgsub();
                    $('#testimg').attr('src',newsrc);
                    $('#testimgpre').attr('src',newsrc);
                }



            }
        })

        $('#ttdiv').css('display','none');
        $('#ttdiv').css('width',0);
        $('#ttdiv').css('height',0);
        $('#fttlocal_x').val(0);
        $('#fttlocal_y').val(0);
        $('#ftstation').val(0);

    }
    //确认文本删除函数
    function ttdivsub(){

        var checkval=$("input[name=testedit]:checked").attr('value');


        var num=$('#tpre').val();

        var src=$('#tsrc'+num).val();
        var trationa=$('#trationa'+num).val();


        var x0=$('#testimg').offset().left;
        var y0=$('#testimg').offset().top;

        var x1=$('#ttdiv').offset().left;
        var y1=$('#ttdiv').offset().top;

        var x=x1-x0;
        var y=y1-y0;

        var width=$('#ttdiv').width();
        var height=$('#ttdiv').height();

        var id=$('#tid'+num).val();

        var newsrc;

        x=(x*trationa).toFixed(2);
        y=(y*trationa).toFixed(2);
        width=(width*trationa).toFixed(2);
        height=(height*trationa).toFixed(2);

        $.ajax({
            url: "<?php echo U('erasetestsql');?>",
            type: 'POST',
            async:false,
            data: {id:id,x: x,y: y,width:width, height: height,src:src,kind:checkval},
            dataType: 'json',
            success: function (re) {

                if(checkval=='title')
                {
                    $('#tb'+num).html(x);
                    $('#tc'+num).html(y);
                    $('#td'+num).html(width);
                    $('#te'+num).html(height);
                    newsrc=src+'?'+timemsgsub();
                    $('#testimg').attr('src',newsrc);
                    $('#testimgpre').attr('src',newsrc);
                }
                else
                {
                    newsrc=src+'?'+timemsgsub();
                    $('#testimg').attr('src',newsrc);
                    $('#testimgpre').attr('src',newsrc);
                }



            }
        })

        $('#ttdiv').css('display','none');
        $('#ttdiv').css('width',0);
        $('#ttdiv').css('height',0);
        $('#fttlocal_x').val(0);
        $('#fttlocal_y').val(0);
        $('#ftstation').val(0);

    }
    //进行旋转操作
    function rotatesub(id) {
        var num=$('#regspan').text();
//        var nowimg=$('#nowimg').val();
//        var nowimgnum=nowimg.replace(/[^0-9]/ig,"");
//        var addnum;


        var a = $("#smallrotate").prop("checked");


        if(id.indexOf('left')>-1)
        {
            if(num>-3)
            {
                if(a)
                {
                    num=10*num;
                    num=parseInt(num)-1;
                    num=num/10;
                    num=num.toFixed(1);
                }
                else
                {
                    num=num-1;
                    num=num.toFixed(1)
                }

                $('#regspan').text(num);
//                if (nowimg.indexOf('timg') > -1) {
//                    $("#timg_reg"+nowimgnum).val(num);
                    $("#testimg").css({transform: "rotate(" + num+ "deg)"});
                    $("#testimgpre").css({transform: "rotate(" + num+ "deg)"});
//                }

            }
            else
            {
                if(num==-3)
                {
//                alert("-3度为最小值！");
                }
            }
        }
        if(id.indexOf('right')>-1)
        {
            if(num<3)
            {
                if(a)
                {
                    num=10*num;
                    num=parseInt(num)+1;
                    num=num/10;
                    num=num.toFixed(1);
                }
                else
                {
                    num=num*1+1;
                    num=num.toFixed(1)
                }

                $('#regspan').text(num);
//                if (nowimg.indexOf('timg') > -1) {
//                    $("#timg_reg"+nowimgnum).val(num);
                    $("#testimg").css({transform: "rotate(" + num+ "deg)"});
                    $("#testimgpre").css({transform: "rotate(" + num+ "deg)"});
//                }

            }
            else
            {
                if(num==3)
                {
//                alert("3度为最大值！");
                }
            }
        }

    }
    //确认预览答案删除函数
    function preatdivsub(){
        var checkval=$("input[name=testedit]:checked").attr('value');
        var num=$('#apre').val();
        var src=$('#asrc'+num).val();


        var aration=$('#arationb'+num).val();

        var x0=$('#testimgpre').offset().left;
        var y0=$('#testimgpre').offset().top;
        var x1=$('#atdiv').offset().left;
        var y1=$('#atdiv').offset().top;
        var x=x1-x0;
        var y=y1-y0;
        var width=$('#atdiv').width();
        var height=$('#atdiv').height();


        var id=$('#aid'+num).val();

        x=(x*aration).toFixed(3);
        y=(y*aration).toFixed(3);
        width=(width*aration).toFixed(3);
        height=(height*aration).toFixed(3);


        $.ajax({
            url: "<?php echo U('erasetestsql');?>",
            type: 'POST',
            async:false,
            data: {id:id,x: x,y: y,width:width, height: height,src:src,kind:checkval},
            dataType: 'json',
            success: function (re) {
                if(checkval=='title') {
//                    $('#ab' + num).html(x);
//                    $('#ac' + num).html(y);
//                    $('#ad' + num).html(width);
//                    $('#ae' + num).html(height);
                    newsrc = src + '?' + timemsgsub();
                    $('#testimg').attr('src', newsrc);
                    $('#testimgpre').attr('src', newsrc);
                }
                else
                {
                    newsrc = src + '?' + timemsgsub();
                    $('#testimg').attr('src', newsrc);
                    $('#testimgpre').attr('src', newsrc);
                }
            }
        })

        $('#ttdiv').css('display','none');
        $('#ttdiv').css('width',0);
        $('#ttdiv').css('height',0);
        $('#fttlocal_x').val(0);
        $('#fttlocal_y').val(0);
        $('#ftstation').val(0);

    }
    //确认答案删除函数
    function atdivsub(){
        var checkval=$("input[name=testedit]:checked").attr('value');
        var num=$('#apre').val();
        var src=$('#asrc'+num).val();
        var aration=$('#arationa'+num).val();
        var x0=$('#testimg').offset().left;
        var y0=$('#testimg').offset().top;
        var x1=$('#ttdiv').offset().left;
        var y1=$('#ttdiv').offset().top;
        var x=x1-x0;
        var y=y1-y0;
        var width=$('#ttdiv').width();
        var height=$('#ttdiv').height();


        var id=$('#aid'+num).val();

        x=(x*aration).toFixed(2);
        y=(y*aration).toFixed(2);
        width=(width*aration).toFixed(2);
        height=(height*aration).toFixed(2);


        $.ajax({
            url: "<?php echo U('erasetestsql');?>",
            type: 'POST',
            async:false,
            data: {id:id,x: x,y: y,width:width, height: height,src:src,kind:checkval},
            dataType: 'json',
            success: function (re) {
                if(checkval=='title') {
                    $('#ab' + num).html(x);
                    $('#ac' + num).html(y);
                    $('#ad' + num).html(width);
                    $('#ae' + num).html(height);
                    newsrc = src + '?' + timemsgsub();
                    $('#testimg').attr('src', newsrc);
                }
                else
                {
                    newsrc = src + '?' + timemsgsub();
                    $('#testimg').attr('src', newsrc);
                }
            }
        })

        $('#ttdiv').css('display','none');
        $('#ttdiv').css('width',0);
        $('#ttdiv').css('height',0);
        $('#fttlocal_x').val(0);
        $('#fttlocal_y').val(0);
        $('#ftstation').val(0);

    }
//
    function cutlinesub() {

    var x;
    var y;
    var kind;
    var rationa

    var checkval=$("input[name=cut]:checked").attr('value');

    var cnum=0;


    if($('#nowkind').val()=='test')
    {
        cnum=$('#tpre').val();
        rationa=$('#trationa'+cnum).val();
    }
    else
    {
         cnum=$('#apre').val();
        rationa=$('#arationa'+cnum).val();
    }




    var x0=$('#testimg').offset().left;
    var y0=$('#testimg').offset().top;

    if(x0==0 || y0==0)
    {
        return;
    }

    var x1=$('#thr').offset().left;
    var y1=$('#thr').offset().top;

    var x2=$('#tvline').offset().left;
    var y2=$('#tvline').offset().top;

    if(checkval=='up' || checkval=='down')
    {
        var x=x1-x0;
        var y=y1-y0;


        if(checkval=='up')
        {
            kind=1;
        }
        if(checkval=='down')
        {
            kind=2;
        }
    }

    if(checkval=='left' || checkval=='right')
    {
        var x=x2-x0;
        var y=y2-y0-1;


        if(checkval=='left')
        {
            kind=3;
        }
        if(checkval=='right')
        {
            kind=4;
        }
    }

    x=(x*rationa).toFixed(2);
    y=(y*rationa).toFixed(2);


    var src = $('#testimg')[0].src;
    var num = src.indexOf('uploads');
    var length = src.length;
    src = "./" + src.substr(num, length - num);
    var num1 = src.indexOf('?');
    src = src.substr(0, num1);


    //  alert(x+','+y+','+src+','+kind);
      
     // return;

    $.ajax({
        url: "<?php echo U('cutlinesql');?>",
        type: 'POST',
        async:false,
        data: {x:x,y:y,src:src,kind:kind},
        dataType: 'json',
        success: function (re) {
            $('#testimg').attr('src', re['src']);
            $('#testimgpre').attr('src', re['src']);

            if($('#nowkind').val()=='test')
            {
                $('#trationa'+cnum).val(re['rationa']);
            }
            else
            {
                $('#arationa'+cnum).val(re['rationa']);
            }

        }
    })
}
    function precutlinesub() {

        var x;
        var y;
        var kind;
        var rationb;

        var checkval=$("input[name=cut]:checked").attr('value');

        var cnum=0;

        if($('#nowkind').val()=='test')
        {
            cnum=$('#tpre').val();
            rationb=$('#trationb'+cnum).val();
        }
        else
        {
            cnum=$('#apre').val();
            rationb=$('#arationb'+cnum).val();
        }



        var x0=$('#testimgpre').offset().left;
        var y0=$('#testimgpre').offset().top;

        if(x0==0 || y0==0)
        {
            return;
        }

        var x1=$('#prethr').offset().left;
        var y1=$('#prethr').offset().top;

        var x2=$('#pretvline').offset().left;
        var y2=$('#pretvline').offset().top;

        if(checkval=='up' || checkval=='down')
        {
            var x=x1-x0;
            var y=y1-y0;


            if(checkval=='up')
            {
                kind=1;
            }
            if(checkval=='down')
            {
                kind=2;
            }
        }

        if(checkval=='left' || checkval=='right')
        {
            var x=x2-x0;
            var y=y2-y0-1;


            if(checkval=='left')
            {
                kind=3;
            }
            if(checkval=='right')
            {
                kind=4;
            }
        }


        x=(x*rationb).toFixed(2);
        y=(y*rationb).toFixed(2);


        var src = $('#testimgpre')[0].src;
        var num = src.indexOf('uploads');
        var length = src.length;
        src = "./" + src.substr(num, length - num);
        var num1 = src.indexOf('?');
        src = src.substr(0, num1);
//
//        alert('x:'+x+',y:'+y+',src:'+src);

        $.ajax({
            url: "<?php echo U('cutlinesql');?>",
            type: 'POST',
            async:false,
            data: {x:x,y:y,src:src,kind:kind},
            dataType: 'json',
            success: function (re) {
                $('#testimg').attr('src', re['src']);
                $('#testimgpre').attr('src', re['src']);


                if($('#nowkind').val()=='test')
                {
                    $('#trationb'+cnum).val(re['rationb']);
                }
                else
                {
                    $('#arationb'+cnum).val(re['rationb']);
                }
            }
        })
    }
//键盘事件
    $(document).keydown(function(e){
        //Z 取消事件
            if (e.which == 90) {
                $('#ttdiv').css('display','none');
                $('#ttdiv').css('width',0);
                $('#ttdiv').css('height',0);
                $('#fttlocal_x').val(0);
                $('#fttlocal_y').val(0);
                $('#ftstation').val(0);


                $('#atdiv').css('display','none');
                $('#atdiv').css('width',0);
                $('#atdiv').css('height',0);
                $('#fatlocal_x').val(0);
                $('#fatlocal_y').val(0);
                $('#fastation').val(0);
            }


        //A text向上事件
        if (e.which == 65) {
            tpresub();
            nowkindsub('test');
        }
        //S text向下事件
        if (e.which == 83) {

            tnextsub();
            nowkindsub('test');
        }

        if (e.which == 68) {
        //D答案向上
          apresub();
          nowkindsub('answer');
        }

        if (e.which == 70) {
          //F tanswer向下事件
            anextsub();
            nowkindsub('answer');
        }
        //N 试题图片预览
        if (e.which == 78) {

            phone_test_display();
        }

        if (e.which == 81) {
            //q向左旋转
            rotatesub('left_reg');
        }


        if (e.which == 87) {
            //w向右旋转
            rotatesub('right_reg');
        }

        if (e.which == 86) {
            //存储事件,V
            phprotatesub();
        }

//    if (e.which == 49) {
//        //r，向上剪切
//
//        $("#cut_up").attr("checked","checked");
//
//    }
//    if (e.which == 50) {
//        //向下箭头，向下剪切
//
//        $("#cut_down").attr("checked","checked");
//
//    }
//    if (e.which == 51) {
//        //向左箭头，向左剪切
//
//        $("#cut_left").attr("checked","checked");
//    }
//    if (e.which == 52) {
//        //向右箭头，向右剪切
//
//        $("#cut_right").attr("checked","checked");
//    }
    if (e.which == 9) {
        //tab，切换橡皮差和剪切





    }
        });
    function phprotatesub() {
            var reg = $('#regspan').text();
            var src = $('#testimg')[0].src;
            var num = src.indexOf('uploads');
            var length = src.length;
            src = "./" + src.substr(num, length - num);
            var num1 = src.indexOf('?');
            src = src.substr(0, num1);

                $.ajax({
                    url: "<?php echo U('myrotateimg');?>",
                    type: 'POST',
                    data: {src: src, reg: reg, name: name},
                    dataType: 'text',
                    success: function (re) {
                        if (re != 0) {
                            $('#testimg').attr('src', re);
                            $('#testimgpre').attr('src', re);
                            $('#regspan').text("0");
                            $("#testimg").css({transform: "rotate(" + 0 + "deg)"});
                            $("#testimgpre").css({transform: "rotate(" + 0 + "deg)"});
                        }
                        else {
                            alert('数据错误！！');
                        }


                    }
                })

    }
    //方块事件
    function ttsquarebuttonsub() {
    var tinputw=$('#tinputw').val();
    var tinputh=$('#tinputh').val();
    $('#ttsquarebutton').css('width',tinputw);
    $('#ttsquarebutton').css('height',tinputh);
    $('#ttlocal_width').val(tinputw);
    $('#ttlocal_height').val(tinputh);
}
//当前选择为习题还是答案
    function nowkindsub(kind) {
    $('#regspan').text(0);
    $("#testimg").css({transform: "rotate(" + 0+ "deg)"});
    $("#testimgpre").css({transform: "rotate(" + 0+ "deg)"});
    if(kind=='test')
    {
        $('#nowkind').val('test');
        var num=$('#tpre').val();
        var id=$('#tid'+num).val();
        $('#nowid').val(id);
    }
    else
    {
        $('#nowkind').val('answer');
        var num=$('#apre').val();
        var id=$('#aid'+num).val();
        $('#nowid').val(id);
    }

    if($('#nowkind').val()=='test')
    {
       $('#titlenote').html("<b>习题*&nbsp;&nbsp;|&nbsp;&nbsp;答案&nbsp;&nbsp;&nbsp;</b>");
       $('#testnote').html("习题*：");
       $('#answernote').html("答案");
    }
    else
    {
        $('#titlenote').html("<b>习题&nbsp;&nbsp;|&nbsp;&nbsp;答案*&nbsp;&nbsp;&nbsp;</b>");
        $('#testnote').html("习题：");
        $('#answernote').html("答案*：");
    }
}
//preimg鼠标跟随事件
    $("#testimgpre").ready(function(){
        $("#testimgpre").mousemove(function(e) {
            var checkval=$("input[name=testedit]:checked").attr('value');
            if(checkval=='title')
            {
                testimgpresub();
            }
            else
            {
                $('#ttdiv').css('display','none');
                $('#ttdiv').css('width',0);
                $('#ttdiv').css('height',0);
                $('#fttlocal_x').val(0);
                $('#fttlocal_y').val(0);
                $('#ftstation').val(0);
                $('#atdiv').css('display','none');
                $('#atdiv').css('width',0);
                $('#atdiv').css('height',0);
                $('#fatlocal_x').val(0);
                $('#fatlocal_y').val(0);
                $('#fastation').val(0);
                $('#ttsquarebutton').css('display','none');
                $('#atsquarebutton').css('display','none');
                pretestimglinesub();
            }
        })
});
//pre图片移动事件
    function testimgpresub(){

    var checkval=$("input[name=testedit]:checked").attr('value');

    if(checkval=='title')
    {
        kind='title';
    }

    if(checkval=='cut') {
        kind='cut';
        $('#ttdiv').css('display','none');
        $('#ttdiv').css('width',0);
        $('#ttdiv').css('height',0);
        $('#fttlocal_x').val(0);
        $('#fttlocal_y').val(0);
        $('#ftstation').val(0);


        $('#atdiv').css('display','none');
        $('#atdiv').css('width',0);
        $('#atdiv').css('height',0);
        $('#fatlocal_x').val(0);
        $('#fatlocal_y').val(0);
        $('#fastation').val(0);

        $('#ttsquarebutton').css('display','none');
        $('#atsquarebutton').css('display','none');
        return;
    }

        var e=window.event;

        var x1 = e.pageX;
        var y1= e.pageY;

        var x0=$('#testimgpre').offset().left;
        var y0=$('#testimgpre').offset().top;

        var atlocal_x=x1-x0;
        var atlocal_y=y1-y0;
        var kind='';


        $('#atlocal_x').val(atlocal_x.toFixed(2));
        $('#atlocal_y').val(atlocal_y.toFixed(2));

        presquarebutton();
    }
//pre橡皮擦(习题)位置
    function presquarebutton() {

        var x0=$('#testimgpre').offset().left;
        var y0=$('#testimgpre').offset().top;

//        alert(x0+','+y0);

        var atlocal_x=$('#atlocal_x').val();
        var atlocal_y=$('#atlocal_y').val();
        var width=$('#atlocal_width').val();
        var height=$('#atlocal_height').val();

        var x=parseInt(atlocal_x)+parseInt(x0);
        var y=parseInt(atlocal_y)+parseInt(y0);


        var atlocal_width=$('#atlocal_width').val();
        var atlocal_height=$('#atlocal_height').val();


        newPos=new Object();
        newPos.left= x-2;
        newPos.top= y-4;

//        alert(newPos.left+','+newPos.top);


        $('#atsquarebutton').offset(newPos);
        $('#atsquarebutton').css('width',width);
        $('#atsquarebutton').css('height',height);
        $('#atsquarebutton').css('display','block');

    }
//切割线的位置
    function initcutlinelocalsub(){

    var checkval=$("input[name=cut]:checked").attr('value');

   // alert(checkval);

    if(checkval=='up' || checkval=='down' )
    {
        var top1=$('#testimg').offset().top;
        var left1=$('#testimg').offset().left;
        var width1=$('#testimg').width();
        var height1=$('#testimg').height();

        if(height1==0)
        {
            height1=20;
        }
        newPos1=new Object();
        newPos1.left= left1;
        newPos1.top= parseInt(top1)+parseInt(height1/2);

        $('#thr').offset(newPos1);
/////
        var top2=$('#testimgpre').offset().top;
        var left2=$('#testimgpre').offset().left;
        var width2=$('#testimgpre').width();
        var height2=$('#testimgpre').height();

//        alert(left2);

        if(height2==0)
        {
            height2=20;
        }
        newPos2=new Object();
        newPos2.left= left2;
        newPos2.top= parseInt(top2)+parseInt(height1/2);

        $('#prethr').offset(newPos2);
    }


    if(checkval=='right' || checkval=='left')
    {
        var top3=$('#testimg').offset().top;
        var left3=$('#testimg').offset().left;
        var width3=$('#testimg').width();
        var height3=$('#testimg').height();
        if(width3==0)
        {
            width3=1000;
        }

        newPos3=new Object();
        newPos3.left= left3+parseInt(width3/2);
        newPos3.top= top3-4;

        $('#tvline').offset(newPos3);



        var top4=$('#testimgpre').offset().top;
        var left4=$('#testimgpre').offset().left;
        var width4=$('#testimgpre').width();
        var height4=$('#testimgpre').height();

        if(width4==0)
        {
            width4=150;
        }

        newPos4=new Object();
        newPos4.left= left4+parseInt(width4/2);
        newPos4.top= top4-4;

        $('#pretvline').offset(newPos4);
    }



        //thr
        //prethr
        //tvline
        //pretvline
}
    function testimglinesub() {

    if($("input[name=testedit]:checked").attr('value')=='title')
    {
        return;
    }

    var checkval=$("input[name=cut]:checked").attr('value');
    var e=window.event;

    var x = e.pageX;
    var y= e.pageY;

    if(checkval=='up' || checkval=='down' )
    {
        $('#thr').css('display','block');
        var top1=$('#testimg').offset().top;
        var left1=$('#testimg').offset().left;
        var width1=$('#testimg').width();
        var height1=$('#testimg').height();

        if(height1==0)
        {
            height1=20;
        }
        newPos1=new Object();
        newPos1.left= left1;
//        newPos1.top= y;



        if(checkval=='up')
        {
            newPos1.top=y-6;
        }
        if(checkval=='down')
        {
            newPos1.top=y+6;
        }



        $('#thr').offset(newPos1);

        if(checkval=='up')
        {
            $('#del_img_up').css('display','block');

            var widtha=$('#thr').width();
            newPosa=new Object();
            newPosa.left=left1+parseInt(widtha/2);
            newPosa.top= y;
            $('#del_img_up').offset(newPosa);
        }
        if(checkval=='down')
        {
            var widthb=$('#thr').width();
            $('#del_img_down').css('display','block');

            newPosb=new Object();
            newPosb.left=left1+parseInt(widthb/2);
            newPosb.top= y-30;
            $('#del_img_down').offset(newPosb);
        }

    }


    if(checkval=='right' || checkval=='left')
    {
        $('#tvline').css('display','block');
        var top3=$('#testimg').offset().top;
        var left3=$('#testimg').offset().left;
        var width3=$('#testimg').width();
        var height3=$('#testimg').height();
        if(width3==0)
        {
            width3=1000;
        }
        newPos3=new Object();
//        newPos3.left= x;
        newPos3.top= parseInt(top3)+1;

        if(checkval=='left')
        {
            newPos3.left= x-6;
        }
        if(checkval=='right')
        {
            newPos3.left= x+6;
        }




        $('#tvline').offset(newPos3);
        if(checkval=='right')
        {
            var heightc=$('#tvline').height();

            $('#del_img_right').css('display','block');
            newPosc=new Object();
            newPosc.left=x-30;
            newPosc.top= top3+parseInt(heightc/2)-80;
            $('#del_img_right').offset(newPosc);
        }
        if(checkval=='left')
        {
            var heightd=$('#tvline').height();
            $('#del_img_left').css('display','block');
            newPosd=new Object();
            newPosd.left=x;
            newPosd.top= top3+parseInt(heightd/2)-80;
            $('#del_img_left').offset(newPosd);
        }
    }
}
    function pretestimglinesub() {


    if($("input[name=testedit]:checked").attr('value')=='title')
    {
        return;
    }

        var checkval=$("input[name=cut]:checked").attr('value');
        var e=window.event;

        var x = e.pageX;
        var y= e.pageY;

        if(checkval=='up' || checkval=='down' )
        {
            $('#prethr').css('display','block');

        var top2=$('#testimgpre').offset().top;
        var left2=$('#testimgpre').offset().left;
        var width2=$('#testimgpre').width();
        var height2=$('#testimgpre').height();


        if(height2==0)
        {
            height2=20;
        }
        newPos2=new Object();
        newPos2.left= left2;


            if(checkval=='up')
            {
                newPos2.top=y-6;
            }
            if(checkval=='down')
            {
                newPos2.top=y+6;
            }


        $('#prethr').offset(newPos2);


            if(checkval=='up')
            {

                var widthprea=$('#prethr').width();

                $('#del_img_up_pre').css('display','block');

                newPosprea=new Object();
                newPosprea.left=left2+parseInt(widthprea/2)-10;
                newPosprea.top= y;
                $('#del_img_up_pre').offset(newPosprea);
            }
            if(checkval=='down')
            {
                var widthb=$('#prethr').width();

                $('#del_img_down_pre').css('display','block');


                newPospreb=new Object();
                newPospreb.left=left2+parseInt(widthb/2)-10;
                newPospreb.top= y-20;
                $('#del_img_down_pre').offset(newPospreb);
            }
        }


        if(checkval=='right' || checkval=='left')
        {
        $('#pretvline').css('display','block');
        var top4=$('#testimgpre').offset().top;
        var left4=$('#testimgpre').offset().left;
        var width4=$('#testimgpre').width();
        var height4=$('#testimgpre').height();

        if(width4==0)
        {
            width4=150;
        }

        if(height4>400)
        {
            height4=400;
        }

        newPos4=new Object();

        newPos4.top= parseInt(top4)+1;

            if(checkval=='left')
            {
                newPos4.left= x-6;
            }
            if(checkval=='right')
            {
                newPos4.left= x+6;
            }

        $('#pretvline').offset(newPos4);

        $('#pretvline').css('height',height4);



            if(checkval=='right')
            {
                var heightc=$('#pretvline').height();


                $('#del_img_right_pre').css('display','block');

                newPoscpre=new Object();
                newPoscpre.left=x-20;
                newPoscpre.top= top4+parseInt(heightc/2)-10;
                $('#del_img_right_pre').offset(newPoscpre);
            }
            if(checkval=='left')
            {
                var heightd=$('#pretvline').height();

                $('#del_img_left_pre').css('display','block');

                newPosdpre=new Object();
                newPosdpre.left=x;
                newPosdpre.top= top4+parseInt(heightd/2)-10;
                $('#del_img_left_pre').offset(newPosdpre);
            }
        }


    }
    $(function() {
        $('input[name=testedit]').change(function() {
            testlinedisplaynone();
        });


        $('input[name=cut]').change(function() {
            testlinedisplaynone();
        });
    })
    function testlinedisplaynone() {
        $('#thr').css('display','none');
        $('#prethr').css('display','none');
        $('#tvline').css('display','none');
        $('#pretvline').css('display','none');

        $('#del_img_up').css('display','none');
        $('#del_img_down').css('display','none');
        $('#del_img_left').css('display','none');
        $('#del_img_right').css('display','none');

        $('#del_img_up_pre').css('display','none');
        $('#del_img_down_pre').css('display','none');
        $('#del_img_left_pre').css('display','none');
        $('#del_img_right_pre').css('display','none');
    }

    function typechoose(){
        if($('#nowkind').val()!='test')
        {
            alert('不能添加，请选择习题类型！！');
            return;
        }

        var typeid=$('#typechoose').val();
        var num=$('#tpre').val();
        var id=$('#tid'+num).val();
        var filesernum=$('#filesernum').val();
        var typetext=$('#typechoose').find("option:selected").text();
//可能有问题。
//        alert(typeid);

        $.ajax({
            url: "<?php echo U('typesql');?>",
            type: 'POST',
            async:false,
            data: {id:id,typeid: typeid,kind:1,filesernum:filesernum},
            dataType: 'json',
            success: function (re) {
              
              //alert(123);
              var num1=num;
            //  alert(num1+','+$('#tsum').val()+','+typetext);
              
                for(num1=num;num1<=38;num1++)
                {
          
                    $('#tb'+num1).html(typetext);
                }
            }
        })

    }

    function testnum(id){
        var myid=$('#'+id).attr('name');
        var myval=$('#'+id).val();
        $.ajax({
            url: "<?php echo U('questionnum');?>",
            type: 'POST',
            async:false,
            data: {myid:myid,myval: myval},
            dataType: 'json',
            success: function (re) {
            }
        })

    }
</script>
</body>
</html>