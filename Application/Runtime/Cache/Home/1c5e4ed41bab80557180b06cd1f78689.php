<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="login-bg">
<head>
    <title>CTB-Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="/Public/jquery/jquery.min.js"></script>
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
    <script src="/Public/js/testtitle.js"></script>


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body onclick="displaysub()">
<div class="contain" style="width: 100%">
    <div id="notediv"  style="position:absolute;z-index:2;border:1px solid #9d9d9d;border-radius:4px;width: 140px;height: 192px;top: 330px;left: 100px;display: none;">
        <div class="notemsgdiv" style="border-top-left-radius: 4px;border-top-right-radius: 4px;">
            <form name="addform" id="addform">
            <label for="addimg" style="display: block;">
                <span>添加</span>
                <input id="addimg" name="addimg" type="file" style="display: none" onchange="addimgsub()">
                <input id="addfilesernum" name="addfilesernum" type="hidden" value="0">
                <input id="addfilepath" name="addfilepath" type="hidden" value="0">
                <input id="addpreid" name="addpreid" type="hidden" value="0">
            </label>
                </form>
        </div>
        <div class="notemsgdiv">
            <a id="download" href="javascript:void(0)" onclick="downloadImage()">下载</a>
        </div>
        <div class="notemsgdiv">
            <form name="reform" id="reform">
            <label for="replaceimg" style="display: block;">
                <span>替换</span>
                <input id="replaceimg" name="replaceimg" type="file" style="display: none" onchange="replacesub()">
                <input id="replacefilesernum" name="replacefilesernum" type="hidden" value="0">
                <input id="replacefilepath" name="replacefilepath" type="hidden" value="0">
                <input id="presrc" name="presrc" type="hidden" value="0">
                <input id="replaceid" name="replaceid" type="hidden" value="0">
            </label>
                </form>
        </div>
        <div class="notemsgdiv">
            <a  href="javascript:void(0)" onclick="delsub()">删除</a>
        </div>
        <div  class="notemsgdiv">
            <a id="up" href="javascript:void(0)" onclick="moveimgsub(this.id)">上移一个</a>
        </div>
        <div  class="notemsgdiv">
            <a id="down"  href="javascript:void(0)"  onclick="moveimgsub(this.id)">下移一个</a>
        </div>
    </div>
    <div class="row" style="height: 45px;"></div>
    <div class="row">
        <div class="col-xs-4" style="padding-left:45px;">
            <b> <span id="bigtitle" style="font-size: 18px;">试题*&nbsp;|&nbsp;&nbsp;答案</span></b><span>&nbsp;&nbsp;预览</span>
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
                            <div style="color: #c0b9c8" class="admin_div_unchicked">
                                整体处理
                            </div>
                        </td>
                        <td>
                            <div class="admin_div_unchicked">
                                <a href="<?php echo U('test_del03',array('filesernum'=>$filesernum,'kind'=>$kind,'oldstatus'=>$oldstatus));?>">习题分解</a>
                            </div>
                        </td>
                        <td>
                            <div class="admin_div_unchicked">
                                <a href="<?php echo U('answer_del04',array('filesernum'=>$filesernum,'kind'=>$kind,'oldstatus'=>$oldstatus));?>">答案分解</a>
                            </div>
                        </td>
                        <td>
                            <div class="admin_div_unchicked admin_list">
                                <a  href="<?php echo U('erase_del05',array('filesernum'=>$filesernum,'kind'=>$kind,'oldstatus'=>$oldstatus));?>">橡皮擦处理</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
    <div class="row" style="height: 43px;"></div>
    <div class="row framelist" style="min-height: 26px;border: 1px solid #eaf0f2;text-align: center;font-size: 12px;padding-top: 4px;padding-bottom: 4px;overflow-x: scroll;overflow-y: hidden;white-space: nowrap;">
        <span>当前图片：</span><u><span id="smalltitle">试卷</span></u>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <span>剪切：</span>
        <span>
         <select class="cutchoose" onchange="cutchoosesub()" >
        <option value="1">未分割</option>
        <option value="2">上下剪切</option>
        <option value="7">上下分割</option>
        <option value="3">左右剪切</option>
        <option value="4">分割两部份</option>
        <option value="5">分割三部份</option>
        <option value="6">确定剪切区域</option>
        </select>
        </span>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <span>左旋转：&nbsp;<a href="#"><span id="left_reg" onclick="rotatesub(this.id)"><-</span></a><span>&nbsp;<span id="regspan">0</span>&nbsp;</span><a href="#"><span id="right_reg" onclick="rotatesub(this.id)">-></span></a>&nbsp;:右旋转</span>
        <span>&nbsp;</span>
        <input id="smallrotate" type="checkbox" value="0.1">小角度（0.1）
        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
       <a  href="javascript:void(0)" onclick="cutsub()"> <span>开始剪切&nbsp;( C )</span></a>
       <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
       <a  href="javascript:void(0)" onclick="noisereduction()"> <span>自动降噪&nbsp;( R )</span></a>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <span>习题序号级别：</span>
        <select id="titlechoose" onchange="testtitle()">
        <option value="0">未选择</option>
        <option value="1">一级</option>
        <option value="2">二级</option>
        <option value="3">三级</option>
        <option value="4">四级</option>
        <option value="5">五级</option>
        </select>
            <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
        <select id="no1" style="display: none">
            <option value="0">一级</option>
        </select>
         <select id="no2" style="display: none">
             <option value="0">二级</option>
        </select>

         <select id="no3" style="display: none">
             <option value="0">三级</option>
        </select>

        <select id="no4" style="display: none">
            <option value="0">四级</option>
        </select>

        <select id="no5" style="display: none">
            <option value="0">五级</option>
        </select>

        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <span>序号排序：</span>
        <select id="mytitleser">
            <option value='0'>未选择</option>
        </select>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <span><u><a href="<?php echo U('test_re','filesernum='.$filesernum);?>">重置习题</a></u></span>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <span><u><a  href="javascript:void(0)" onclick="finishthisstep()">保存设置</a></u></span>
    </div>
    <div class="row" style="height: 15px;"></div>
    <div class="row">
        <div class="col-xs-6" style="min-height: 700px;border-right: 1px solid #728090;background-color: #fcf9e2;">
            <div class="row">
                <div class="col-xs-3" style=" min-height: 700px;">
                    <div class="row" style="height: 130px;"></div>
                    <div class="row   admin_test_img_thumb" style="height: 400px;overflow-y: scroll;text-align: center;margin-left: 16px;">
                        <?php if(is_array($tdata)): $i = 0; $__LIST__ = $tdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tid): $mod = ($i % 2 );++$i;?><img  id="timg<?php echo ++$timg;?>" name="<?php echo ($tid[id]); ?>" onclick="nowimgsub(this.id)"  ondblclick="mysub(this.id)" src="<?php echo ($tid[src_pic]); ?>">
                            <input id="timg_reg<?php echo ($timg); ?>" type="hidden" value="<?php echo ($tid[img_reg]); ?>">
                            <input id="timg_x_ratio<?php echo ($timg); ?>" type="hidden" value="<?php echo ($tid[x_ratio]); ?>">
                            <input id="timg_y_ratio<?php echo ($timg); ?>" type="hidden" value="<?php echo ($tid[y_ratio]); ?>"><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <div class="row admin_note_css">习题：<span id="tnownum">1</span>/<span id="tsumnum"><?php echo ($timg); ?></span></div>
                </div>
                <div id="tbigimgdiv" class="col-xs-9" style="background-color: #fcf9e2;min-height: 678px;padding-top: 30px;text-align: center;position: relative;">
                    <img id="tbigimg" class="bimgclass" onclick="testcutsub(this.id)"  style="position:absolute;" src="<?php echo ($tdata[0][src_pic]); ?>">
                    <input id="filesernum" type="hidden" value="<?php echo ($tdata[0][filesernum]); ?>">
                    <input id="filepath" type="hidden" value="<?php echo ($tdata[0][src_pic]); ?>">
                    <div id="thr1"  class="cutinglinecss" >
                    </div>
                    <div id="thr2" class="cutinglinecss">
                    </div>
                    <div id="tvline1"  class="cutinglinecss">
                    </div>
                    <div id="tvline2"  class="cutinglinecss">
                    </div>
                    <div id="tmvlineonly"  class="cutinglinecss" >
                    </div>
                    <div id="tmvlineleft" class="cutinglinecss" >
                    </div>
                    <div id="tmvlineright"  class="cutinglinecss">
                    </div>
                    <div id="tpartline" class="cutinglinecss"></div>
                </div>
            </div>
        </div>
        <div class="col-xs-6" style="min-height: 700px;background-color: #fcf9e2;">
            <div class="row">
                <div class="col-xs-2" style=" min-height: 700px;">
                    <div class="row" style="height: 130px;"></div>
                    <div class="row admin_test_img_thumb" style="height: 400px;overflow-y: scroll;text-align: center;margin-left: 0px;">
                        <?php if(is_array($adata)): $i = 0; $__LIST__ = $adata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$aid): $mod = ($i % 2 );++$i;?><img id="aimg<?php echo ++$aimg;?>" name="<?php echo ($aid[id]); ?>"  onclick="nowimgsub(this.id)"  ondblclick="mysub(this.id)" src="<?php echo ($aid[src_pic]); ?>" >
                            <input id="aimg_reg<?php echo ($aimg); ?>" type="hidden" value="<?php echo ($aid[img_reg]); ?>">
                            <input id="aimg_x_ratio<?php echo ($aimg); ?>" type="hidden" value="<?php echo ($aid[x_ratio]); ?>">
                            <input id="aimg_y_ratio<?php echo ($aimg); ?>" type="hidden" value="<?php echo ($aid[y_ratio]); ?>"><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <div class="row admin_note_css">答案：<span id="anownum">1</span>/<span id="asumnum"><?php echo ($aimg); ?></span></div>
                </div>
                <div id="abigimgdiv" class="col-xs-10" style="background-color: #fcf9e2;min-height: 678px;padding-top: 30px;text-align: center;position: relative;">
                    <img id="abigimg" class="aimgclass" onclick="answercutsub(this.id)" style="position:absolute;" src="<?php echo ($adata[0][src_pic]); ?>">
                    <div id="ahr1"  class="cutinglinecss" >
                    </div>
                    <div id="ahr2" class="cutinglinecss">
                    </div>
                    <div id="avline1"  class="cutinglinecss">
                    </div>
                    <div id="avline2"  class="cutinglinecss">
                    </div>
                    <div id="amvlineonly"  class="cutinglinecss" >
                    </div>
                    <div id="amvlineleft" class="cutinglinecss" >
                    </div>
                    <div id="amvlineright"  class="cutinglinecss">
                    </div>
                    <div id="apartline" class="cutinglinecss"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<input id="localx" type="hidden" value="">
<input id="localy" type="hidden" value="">
<input id="nowid" type="hidden" value="">
<input id="spreid" type="hidden" value="0">
<input id="bpreid" type="hidden" value="0">

<input id="tnowimg" type="hidden" value="timg1">
<input id="anowimg" type="hidden" value="aimg1">
<input id="nowimg" type="hidden" value="timg1">
<!--参考线距离父级距离-->
<input id="thr1_top" type="hidden" value="0">
<input id="thr2_top" type="hidden" value="0">
<input id="tvline1_top" type="hidden" value="0">
<input id="tvline2_top" type="hidden" value="0">
<input id="tmvlineonly_top" type="hidden" value="0">
<input id="tmvlineleft_top" type="hidden" value="0">
<input id="tmvlineright_top" type="hidden" value="0">

<input id="thr1_left" type="hidden" value="0">
<input id="thr2_left" type="hidden" value="0">
<input id="tvline1_left" type="hidden" value="0">
<input id="tvline2_left" type="hidden" value="0">
<input id="tmvlineonly_left" type="hidden" value="0">
<input id="tmvlineleft_left" type="hidden" value="0">
<input id="tmvlineright_left" type="hidden" value="0">

<input id="kind" type="hidden"  value="<?php echo ($kind); ?>">
<input id="oldstatus" type="hidden" value="<?php echo ($oldstatus); ?>">

</body>
<script type="text/javascript">
function finishthisstep(){
    var filesernum=$('#filesernum').val();
    var tsum=parseInt($('#tsumnum').text());
    var asum=parseInt($('#asumnum').text());
    for(var i=1;i<=tsum;i++){

        if($('#timg_reg'+i).val()!=0){
            alert('习题图片'+i+'未保存！！请保存！！');
            return 0;
        }
    }
    for(var j=1;j<=asum;j++){

        if($('#aimg_reg'+j).val()!=0){
            alert('答案图片'+j+'未保存！！请保存！！');
            return 0;
        }
    }

    var t1=0,t2=0,t3=0,t4=0,t5=0,nolevel;
    nolevel=$('#titlechoose').val();
    t1=$('#no1').val();
    t2=$('#no2').val();
    t3=$('#no3').val();
    t4=$('#no4').val();
    t5=$('#no5').val();

    var filesernum=$('#filesernum').val();

    if(nolevel==0){

        if(t1==0)
        {
            alert('序号信息有误！！');
            return;
        }

    }

    if(nolevel==1){
        if(t1==0)
        {
            alert('序号信息有误！！');
            return;
        }
    }

    if(nolevel==2){
        if(t1==0 || t2==0)
        {
            alert('序号信息有误！！');
            return;
        }

    }

    if(nolevel==3){
        if(t1==0 || t2==0 || t3==0 )
        {
            alert('序号信息有误！！');
            return;
        }

    }

    if(nolevel==4){
        if(t1==0 || t2==0 || t3==0 || t4==0)
        {
            alert('序号信息有误！！');
            return;
        }

    }

    if(nolevel==5){
        if(t1==0 || t2==0 || t3==0 || t4==0 || t5==0)
        {
            alert('序号信息有误！！');
            return;
        }

    }

	var kind=$('#kind').val();
    $.ajax({
        url: "<?php echo U('addtitleser');?>",
        type: 'POST',
        data: {filesernum:filesernum,nolevel:nolevel,no1:t1,no2:t2,no3:t3,no4:t4,no5:t5,kind:kind},
        dataType: 'text',
        success: function (re) {
            if(re==1)
            {
               // window.location.href='<?php echo U("testpanel/test_del03");?>?filesernum='+ filesernum+'/kind='+$('#kind').val();

                window.location.href='/index.php/Home/testpanel/test_del03/filesernum/'+ filesernum+'/kind/'+$('#kind').val()+'/oldstatus/'+$('#oldstatus').val();

               // window.location.href ="/index.php/Home/HeadTeacher/managestu0301/userid/"+$('#userid').val()+".html";

            }
          else
            {
                alert('数据插入信息失败！！');
            }
        }
    }
    )


   // window.location.href ="../testpanel/test_del03?t1='"+t1+"'&t2='"+t2+"'&t3='"+t3+"'&t4='"+t4+"'&t5='"+t5+"'&nolevel='"+nolevel;

}
 ///////////////////////////////////////////////////////图片编辑事件
//进行select事件
function cutchoosesub() {
   // var num=parseInt($('#regspan').text());
    var nowimg=$('#nowimg').val();
    var selectnum=$('.cutchoose').val();

    if (nowimg.indexOf('timg') > -1) {


//        if(selectnum== 0) {
//            //度数保存
//            tintcutcss();
//            $(".cutchoose").val("0");
//        }

        if(selectnum== 1) {
            //度数保存
            tintcutcss();
            $(".cutchoose").val("1");
        }


        if(selectnum== 2) {
            //65，a，上下剪切
            $(".cutchoose").val("2");
            thrsub();
        }
        if(selectnum == 3) {
            //83，s，左右剪切
            $(".cutchoose").val("3");
            tvlinesub();
        }
        if(selectnum == 4) {
            // 90，z，两个部份分割
            $(".cutchoose").val("4");
            tcut2sub();

        }

        if(selectnum == 5) {
            //88,x，三部分分割
            $(".cutchoose").val("5");
            tcut3sub();
        }

        if(selectnum==6){
            $(".cutchoose").val("6");
            ta_thrsub();
        }
        if(selectnum==7){
            $(".cutchoose").val("7");
            tpartline();
        }

    }
    if (nowimg.indexOf('aimg') > -1) {

//        if(selectnum== 0) {
//            //度数保存
//            tintcutcss();
//            $(".cutchoose").val("0");
//        }

        if(selectnum== 1) {
            //度数保存
            tintcutcss();
            $(".cutchoose").val("1");
        }

        if(selectnum== 2) {
            //65，a，上下剪切
            $(".cutchoose").val("2");
            ahrsub();
        }
        if(selectnum == 3) {
            //83，s，左右剪切
            $(".cutchoose").val("3");
            avlinesub();
        }
        if(selectnum == 4) {
            // 90，z，两个部份分割
            $(".cutchoose").val("4");
            acut2sub();

        }

        if(selectnum == 5) {
            //88,x，三部分分割
            $(".cutchoose").val("5");
            acut3sub();
        }

        if(selectnum==6){
            $(".cutchoose").val("6");
            aa_thrsub();
        }

        if(selectnum==7){
            $(".cutchoose").val("7");
            apartline();
        }
    }

}
//进行旋转操作
function rotatesub(id) {
        var num=$('#regspan').text();
        var nowimg=$('#nowimg').val();
        var nowimgnum=nowimg.replace(/[^0-9]/ig,"");
    var addnum;


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
                if (nowimg.indexOf('timg') > -1) {
                    $("#timg_reg"+nowimgnum).val(num);
                    $("#tbigimg").css({transform: "rotate(" + num+ "deg)"});
                }

                if (nowimg.indexOf('aimg') > -1) {
                    $("#aimg_reg"+nowimgnum).val(num);
                    $("#abigimg").css({transform: "rotate(" + num+ "deg)"});
                }
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
                if (nowimg.indexOf('timg') > -1) {
                    $("#timg_reg"+nowimgnum).val(num);
                   $("#tbigimg").css({transform: "rotate(" + num+ "deg)"});
                }

                if (nowimg.indexOf('aimg') > -1) {
                    $("#aimg_reg"+nowimgnum).val(num);
                    $("#abigimg").css({transform: "rotate(" + num+ "deg)"});
                }
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
//下拉单显示
function mysub(id){
        var e = event || window.event;
        var x=e.pageX;
        var y=e.pageY;
        $("#notediv").css("display",'block');
        $("#notediv").css("top",y);
        $("#notediv").css("left",x);
        $("#localx").val(x);
        $("#localy").val(y);
        $("#nowid").val(id);
    };
//当前选框样式
function nowimgsub(id) {
    if(id.indexOf('timg')>-1)
    {
        if( $('#nowimg').val().indexOf('aimg')>-1)
        {
            tintcutcss();
            $(".cutchoose").val("1");
        }
    }

    if(id.indexOf('aimg')>-1)
    {
        if( $('#nowimg').val().indexOf('timg')>-1)
        {
            tintcutcss();
            $(".cutchoose").val("1");
        }
    }
    $('#nowimg').val(id);

    var num=id.replace(/[^0-9]/ig,"");
    if (id.indexOf('timg') > -1) {
        $('#bigtitle').text("试题* | 答案");
        $('#smalltitle').text("试卷");
    }
    else {
        $('#bigtitle').text("试题  | *答案");
        $('#smalltitle').text("答案");
    }

    var tmsg = $('#tnowimg').val();
    var amsg = $('#anowimg').val();
    if (id.indexOf('timg') > -1) {
        $('#' + tmsg).css("border", "");
        $('#' + amsg).css("border", "1px solid #cececf");
        $('#' + id).css("border", "1px solid #9b9ca3");
        $('#tbigimg').attr('src',$('#'+id)[0].src);
        $('#tnowimg').val(id);

        var timg_reg="#timg_reg"+num;
        $('#regspan').text($(timg_reg).val());
        $("#tbigimg").css({transform: "rotate(" + $(timg_reg).val() + "deg)"});
    }
    if (id.indexOf('aimg') > -1) {
        $('#' + amsg).css("border", "");
        $('#' + tmsg).css("border", "1px solid #cececf");
        $('#' + id).css("border", "1px solid #9b9ca3");
        $('#abigimg').attr('src',$('#'+id)[0].src);
        $('#anowimg').val(id);

        var aimg_reg="#aimg_reg"+num;
        $('#regspan').text($(aimg_reg).val());
        $("#abigimg").css({transform: "rotate(" + $(aimg_reg).val() + "deg)"});
    }
    nownnumsub(id);
}
//单击关闭下拉单
function displaysub() {
        var e = event || window.event;
        if($("#localx").val()!="")
            {
                var e = event || window.event;
                var x=e.pageX;
                var y=e.pageY;
                var x1=parseInt($("#localx").val());
                var y1=parseInt($("#localy").val());
                var x2=x1+140;
                var y2=y1+192;
                if(x<x1||x>x2)
                {
                        $("#localy").val("")
                        $("#localx").val("");
                        $("#notediv").css("display",'none');
                    return false;
                }
            if(y<y1||y>y2)
            {
                $("#localy").val("")
                $("#localx").val("");
                $("#notediv").css("display",'none');
                return false;
            }

            }
    }
//鼠标滑动下拉单事件
$(function(){
//当鼠标滑入时将div的class换成divOver
        $('.notemsgdiv').hover(function(){
                   $(this).css("background-color","#468efe");
            $(this).css("color","#ffffff");
                },function(){
//鼠标离开时移除divOver样式
                    $(this).css("background-color","#f0f0f0");
                    $(this).css("color","#000000");
                }
        );
    })
//窗口变动函数，未使用。
$(document).ready(function(){
    $(window).resize(function() {

    });

});
//初始化页面图片状态
$(function(){
        $('#timg1').css("border","1px solid #9b9ca3");
        $('#aimg1').css("border","1px solid #cececf");
        $('#regspan').text($('#timg_reg1').val());
        $("#tbigimg").css({transform: "rotate(" + $('#timg_reg1').val() + "deg)"});
        $("#abigimg").css({transform: "rotate(" + $('#aimg_reg1').val() + "deg)"});
        $('#tbigimg').css('top',30);
        $('#tbigimg').css('left',50);
        var top1=30;
        var left1=50;
        var width1=parseInt($('#tbigimg').width());
        var height1=parseInt($('#tbigimg').height());
        $('#abigimg').css('top',30);
        $('#abigimg').css('left',50);
        var top2=30;
        var left2=50;
        var width2=parseInt($('#abigimg').width());
        var height2=parseInt($('#abigimg').height());
        $('#thr1').css("height","1px");
        $('#thr1').css("width","420px");
        $('#thr1').css({top:top1,left:left1});
        var kind=0;
   cutlinereset(top1,left1,width1,height1,top2,left2,width2,height2,kind);
    $('#addfilesernum').val($('#filesernum').val());
    $('#replacefilesernum').val($('#filesernum').val());
    var filepath= $('#filepath').val();
    var addnum=filepath.lastIndexOf('/');
    var addfilepath=filepath.substr(0,addnum)+"/";
    $('#addfilepath').val(addfilepath);
    $('#replacefilepath').val(addfilepath);
    })
//初始化参考线位置
function cutlinereset(top1,left1,width1,height1,top2,left2,width2,height2,kind) {
    var top1=parseInt(top1);
    var left1=parseInt(left1);

if(kind=="" || kind==0)
{
    $('#thr1').css({height:1,width:width1,top:top1,left:left1});

    $('#thr2').css({height:1,width:width1,top:(top1+height1),left:left1});

    $('#tvline1').css({height:height1,width:1,top:top1,left:left1});

    $('#tvline2').css({height:height1,width:1,top:top1,left:(left1+width1)});

    $('#tmvlineonly').css({height:height1,width:1,top:top1,left:(left1+width1/2)});

    $('#tmvlineleft').css({height:height1,width:1,top:top1,left:(left1+width1/3)});

    $('#tmvlineright').css({height:height1,width:1,top:top1,left:(left1+width1*2/3)});

    $('#tpartline').css({height:1,width:width1,top:top1+height1/2,left:left1});





    $('#ahr1').css({height:1,width:width2,top:top2,left:left2});

    $('#ahr2').css({height:1,width:width2,top:(top2+height2),left:left2});

    $('#avline1').css({height:height2,width:1,top:top2,left:left2});

    $('#avline2').css({height:height2,width:1,top:top2,left:(left2+width2)});

    $('#amvlineonly').css({height:height2,width:1,top:top2,left:(left2+width2/2)});

    $('#amvlineleft').css({height:height2,width:1,top:top2,left:(left2+width2/3)});

    $('#amvlineright').css({height:height2,width:1,top:top2,left:(left2+width2*2/3)});

    $('#apartline').css({height:1,width:width2,top:top2+height2/2,left:left2});
}
    if(kind==1)
    {
        $('#thr1').css({height:1,width:width1,top:top1,left:left1});

        $('#thr2').css({height:1,width:width1,top:(top1+height1),left:left1});

        $('#tvline1').css({height:height1,width:1,top:top1,left:left1});

        $('#tvline2').css({height:height1,width:1,top:top1,left:(left1+width1)});

        $('#tmvlineonly').css({height:height1,width:1,top:top1,left:(left1+width1/2)});

        $('#tmvlineleft').css({height:height1,width:1,top:top1,left:(left1+width1/3)});

        $('#tmvlineright').css({height:height1,width:1,top:top1,left:(left1+width1*2/3)});

        $('#tpartline').css({height:1,width:width1,top:top1+height1/2,left:left1});



        $('#ahr1').css({height:1,width:width2,top:top2,left:left2});

        $('#ahr2').css({height:1,width:width2,top:(top2+height2),left:left2});

        $('#avline1').css({height:height2,width:1,top:top2,left:left2});

        $('#avline2').css({height:height2,width:1,top:top2,left:(left2+width2)});

        $('#amvlineonly').css({height:height2,width:1,top:top2,left:(left2+width2/2)});

        $('#amvlineleft').css({height:height2,width:1,top:top2,left:(left2+width2/3)});

        $('#amvlineright').css({height:height2,width:1,top:top2,left:(left2+width2*2/3)});

        $('#apartline').css({height:1,width:width2,top:top2+height2/2,left:left2});
    }
    if(kind==2)
    {
        $('#thr1').css({height:1,width:width1,top:top1,left:left1});

        $('#thr2').css({height:1,width:width1,top:(top1+height1),left:left1});

        $('#tvline1').css({height:height1,width:1,top:top1,left:left1});

        $('#tvline2').css({height:height1,width:1,top:top1,left:(left1+width1)});

        $('#tmvlineonly').css({height:height1,width:1,top:top1,left:(left1+width1/2)});

        $('#tmvlineleft').css({height:height1,width:1,top:top1,left:(left1+width1/3)});

        $('#tmvlineright').css({height:height1,width:1,top:top1,left:(left1+width1*2/3)});

        $('#tpartline').css({height:1,width:width1,top:top1+height1/2,left:left1});



        $('#ahr1').css({height:1,width:width2,top:top2,left:left2});

        $('#ahr2').css({height:1,width:width2,top:(top2+height2),left:left2});

        $('#avline1').css({height:height2,width:1,top:top2,left:left2});

        $('#avline2').css({height:height2,width:1,top:top2,left:(left2+width2)});

        $('#amvlineonly').css({height:height2,width:1,top:top2,left:(left2+width2/2)});

        $('#amvlineleft').css({height:height2,width:1,top:top2,left:(left2+width2/3)});

        $('#amvlineright').css({height:height2,width:1,top:top2,left:(left2+width2*2/3)});

        $('#apartline').css({height:1,width:width2,top:top2+height2/2,left:left2});


    }
}
//当前序号
function nownnumsub(id) {
    if (id.indexOf('timg') > -1) {
        $('#tnownum').text(id.replace(/[^0-9]/ig,""));
    }
    if (id.indexOf('aimg') > -1) {
        $('#anownum').text(id.replace(/[^0-9]/ig,""));
    }
}
//剪切处理,键盘事件
$(document).keydown(function(e){
    if($('#nowimg').val().indexOf('timg')>-1) {
        if (e.which == 65) {
            //65，a，上下剪切
            $(".cutchoose").val("2");
            thrsub();
        }


        if (e.which == 83) {
            //83，s，左右剪切
            $(".cutchoose").val("3");
            tvlinesub();
        }
        if (e.which == 90) {
            // 90，z，两个部份分割
            $(".cutchoose").val("4");
            tcut2sub();

        }

        if (e.which == 88) {
            //88,x，三部分分割
            $(".cutchoose").val("5");
            tcut3sub();
        }

        if (e.which == 68) {
            //确认剪切区域
            $(".cutchoose").val("6");
            ta_thrsub();
        }

        if (e.which == 67) {
            //C上下分割区域
            $(".cutchoose").val("7");
            tpartline();
        }

        if (e.which == 69) {
            //69,e退出事件
            $(".cutchoose").val("1");
            tintcutcss();
        }
        if (e.which == 13) {
            alert("保存");
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
            cutsub();
        }

        if (e.which == 82) {
            //降噪事件,R

            noisereduction();
        }

        if (e.which == 70) {
            //小角度旋转
            smallrotation();
        }
    }

    if($('#nowimg').val().indexOf('aimg')>-1) {
        if (e.which == 65) {
            //65，a，上下剪切
            $(".cutchoose").val("2");
            ahrsub();
        }
        if (e.which == 83) {
            //83，s，左右剪切
            $(".cutchoose").val("3");
            avlinesub();
        }
        if (e.which == 90) {
            // 90，z，两个部份分割
            $(".cutchoose").val("4");
            acut2sub();

        }

        if (e.which == 88) {
            //88,x，三部分分割
            $(".cutchoose").val("5");
            acut3sub();
        }

        if (e.which == 68) {
            //确认剪切区域,D
            $(".cutchoose").val("6");
            aa_thrsub();
        }

        if (e.which == 67) {
            //C上下分割区域
            $(".cutchoose").val("7");
            apartline();
        }

        if (e.which == 69) {
            //69,e退出事件
            $(".cutchoose").val("1");
            tintcutcss();
        }
        if (e.which == 13) {
            alert("保存");
        }
        if (e.which == 81) {
            //q向左旋转
            rotatesub('left_reg');
        }

        if (e.which == 87) {
            //w向右旋转
            rotatesub('right_reg');
        }



        if (e.which == 27) {
            $(".cutchoose").val("1");
            tintcutcss();
        }
        if (e.which == 86) {
            //存储事件,V

            cutsub();
        }

        if (e.which == 82) {
            //降噪事件,R
            noisereduction();
        }

        if (e.which == 70) {
            //小角度旋转
            smallrotation();
        }
    }
});
//试题中2部分分割线显示
function tcut2sub() {
    tintcutcss();
    $('#tmvlineonly').css('display','block');
}
//试题中3部分分割线显示
function tcut3sub() {
     tintcutcss();
     $('#tmvlineleft').css('display','block');
     $('#tmvlineright').css('display','block');
}
//试题中上下分割线显示
function thrsub() {
        tintcutcss();
        $('#thr1').css('display','block');
        $('#thr2').css('display','block');
}
//试题中左右分割线显示
function tvlinesub() {
        tintcutcss();
        $('#tvline1').css('display','block');
        $('#tvline2').css('display','block');
}
//试题中框分割线显示
function ta_thrsub() {
     tintcutcss();
     $('#thr1').css('display','block');
     $('#thr2').css('display','block');
     $('#tvline1').css('display','block');
     $('#tvline2').css('display','block');
}
//答案中2部分分割线显示
function acut2sub() {
    tintcutcss();
    $('#amvlineonly').css('display','block');
}
//答案中3部分分割线显示
function acut3sub() {
    tintcutcss();
    $('#amvlineleft').css('display','block');
    $('#amvlineright').css('display','block');
}
//答案中上下部分分割线显示
function ahrsub() {
    tintcutcss();
    $('#ahr1').css('display','block');
    $('#ahr2').css('display','block');
}
//试题中左右部分分割线显示
function avlinesub() {
    tintcutcss();
    $('#avline1').css('display','block');
    $('#avline2').css('display','block');
}
//试题中框分割线显示
function aa_thrsub() {
    tintcutcss();
    $('#ahr1').css('display','block');
    $('#ahr2').css('display','block');
    $('#avline1').css('display','block');
    $('#avline2').css('display','block');
}
//习题上下分割线
function tpartline(){
    tintcutcss();
    $('#tpartline').css('display','block');
}

//答案上下分割线
function apartline(){
    tintcutcss();
    $('#apartline').css('display','block');
}

//隐藏所有分割线
function tintcutcss() {
    $('#thr1').css('display','none');
    $('#thr2').css('display','none');
    $('#tvline1').css('display','none');
    $('#tvline2').css('display','none');
    $('#tmvlineonly').css('display','none');
    $('#tmvlineleft').css('display','none');
    $('#tmvlineright').css('display','none');
    $('#tpartline').css('display','none');

    $('#ahr1').css('display','none');
    $('#ahr2').css('display','none');
    $('#avline1').css('display','none');
    $('#avline2').css('display','none');
    $('#amvlineonly').css('display','none');
    $('#amvlineleft').css('display','none');
    $('#amvlineright').css('display','none');
    $('#apartline').css('display','none');
}
//习题移动参考线事件
function testcutsub(id) {
    var top=parseInt($('#tbigimgdiv').offset().top);
    var left=parseInt($('#tbigimgdiv').offset().left);

    var i=$(".cutchoose").val();

    var width=parseInt($('#'+id).width());
    var height=parseInt($('#'+id).height());

    var e = event || window.event;
    var ex=parseInt(e.pageX);
    var ey=parseInt(e.pageY);

    if(i==1)
    {

    }
    if(i==2)
    {
       if(ey>top+30 && ey<top+30+height/2)
       {
           $("#thr1").css("top",ey-top);
       }
       if(ey>top+30+height/2 && ey<top+30+height)
       {
           $("#thr2").css("top",ey-top);
       }
    }
    if(i==3) {
        if(ex>left+50 && ex<(left+50+width/2))
        {
            $("#tvline1").css("left",ex-left);
        }
        if(ex>(left+50+width/2) && ex<(left+50+width))
        {
            $("#tvline2").css("left",ex-left);
        }
    }
    if(i==4)
    {
        if (ex>left+50  && ex<left+50+width) {
            $("#tmvlineonly").css("left", ex-left);
        }
    }
    if(i==5)
    {
        if (ex>left+50 && ex<left+50+width/2) {
            $("#tmvlineleft").css("left", ex-left);
        }
        if (ex> left+50+width/2 && ex<left+50+width) {
            $("#tmvlineright").css("left", ex-left);
        }
    }

    if(i==7)
    {
        if (ey>top+30 && ey<top+30+height) {
            $("#tpartline").css("top",ey-top);
        }
    }
}
//答案移动参考线事件
function answercutsub(id) {
    var top=parseInt($('#abigimgdiv').offset().top);
    var left=parseInt($('#abigimgdiv').offset().left);

    var i=$(".cutchoose").val();

    var width=parseInt($('#'+id).width());
    var height=parseInt($('#'+id).height());
    var e = event || window.event;
    var ex=parseInt(e.pageX);
    var ey=parseInt(e.pageY);
        if(i==1)
        {

        }
        if(i==2)
        {
            if(ey>top+30 && ey<top+30+height/2)
            {
                $("#ahr1").css("top",ey-top);
            }
            if(ey>top+30+height/2 && ey<top+30+height)
            {
                $("#ahr2").css("top",ey-top);
            }
        }
        if(i==3) {
            if(ex>left+50 && ex<(left+50+width/2))
            {
                $("#avline1").css("left",ex-left);
            }
            if(ex>(left+50+width/2) && ex<(left+50+width))
            {
                $("#avline2").css("left",ex-left);
            }
        }
        if(i==4)
        {
            if (ex>left+50  && ex<left+50+width) {
                $("#amvlineonly").css("left", ex-left);
            }
        }
        if(i==5)
        {
            if (ex>left+50 && ex<left+50+width/2) {
                $("#amvlineleft").css("left", ex-left);
            }
            if (ex> left+50+width/2 && ex<left+50+width) {
                $("#amvlineright").css("left", ex-left);
            }
        }

    if(i==7)
    {
        if (ey>top+30 && ey<top+30+height) {
            $("#apartline").css("top",ey-top);
        }
    }
}
//上下移动事件
function moveimgsub(id) {
    var nowimg=$('#nowimg').val();
    var num=nowimg.replace(/[^0-9]/ig,"");
    var tsumnnum=$('#tsumnum').text();
    var asumnnum=$('#asumnum').text();
    if(id=='up')
    {
        if(num==1)
        {
            alert("第一个无法上移！！")
        }
        else
        {
            if(nowimg.indexOf('timg')>-1) {
                var tprenum = parseInt(num) - 1;
                var timgsrc = $('#' + nowimg)[0].src;
                var timg_reg = $('#timg_reg' + num).val();
                var timg_x_ratio = $('#timg_x_ratio' + num).val();
                var timg_y_ratio = $('#timg_y_ratio' + num).val();
                var tname=$('#' + nowimg).attr('name');


                $('#timg' + num).attr('src', $('#timg' + tprenum)[0].src);
                $('#timg_reg' + num).val($('#timg_reg' + tprenum).val());
                $('#timg_x_ratio' + num).val($('#timg_x_ratio' + tprenum).val());
                $('#timg_y_ratio' + num).val($('#timg_y_ratio' + tprenum).val());
                $('#timg' + num).attr('name', $('#timg' + tprenum).attr('name'));


                $('#timg' + tprenum).attr('src', timgsrc);
                $('#timg_reg' + tprenum).val(timg_reg);
                $('#timg_x_ratio' + tprenum).val(timg_x_ratio);
                $('#timg_y_ratio' + tprenum).val(timg_y_ratio);
                $('#timg' + tprenum).attr('name', tname);



                $('#timg' + num).css("border", "0px solid #cececf");
                $('#timg' + tprenum).css("border", "1px solid #9b9ca3");

                var y=$("#notediv").offset().top;
                $("#notediv").css("top",y-104);
                $('#nowimg').val('timg' + tprenum);
                $('#tnowimg').val('timg' + tprenum);


                $('#tnownum').text(tprenum);
            }

            if(nowimg.indexOf('aimg')>-1) {
                var aprenum = parseInt(num) - 1;
                var aimgsrc = $('#' + nowimg)[0].src;
                var aimg_reg = $('#aimg_reg' + num).val();
                var aimg_x_ratio = $('#aimg_x_ratio' + num).val();
                var aimg_y_ratio = $('#aimg_y_ratio' + num).val();
                var aname=$('#' + nowimg).attr('name');

                $('#aimg' + num).attr('src', $('#aimg' + aprenum)[0].src);
                $('#aimg_reg' + num).val($('#aimg_reg' + aprenum).val());
                $('#aimg_x_ratio' + num).val($('#aimg_x_ratio' + aprenum).val());
                $('#aimg_y_ratio' + num).val($('#aimg_y_ratio' + aprenum).val());
                $('#aimg' + num).attr('name', $('#aimg' + aprenum).attr('name'));


                $('#aimg' + aprenum).attr('src', aimgsrc);
                $('#aimg_reg' + aprenum).val(aimg_reg);
                $('#aimg_x_ratio' + aprenum).val(aimg_x_ratio);
                $('#aimg_y_ratio' + aprenum).val(aimg_y_ratio);
                $('#aimg' + aprenum).attr('name', aname);


                $('#aimg' + num).css("border", "0px solid #cececf");
                $('#aimg' + aprenum).css("border", "1px solid #9b9ca3");
                var y=$("#notediv").offset().top;
                $("#notediv").css("top",y-104);
                $('#nowimg').val('aimg' + aprenum);
                $('#anowimg').val('aimg' + aprenum);

                $('#anownum').text(aprenum);
            }
         }

    }



    if(id=='down')
    {
        if(nowimg.indexOf('timg')>-1)
        {
            if(num==tsumnnum)
            {
                alert("最后一个无法下移！！")
            }
            else
            {
                var tnextnum = parseInt(num) + 1;
                var timgsrc = $('#' + nowimg)[0].src;
                var timg_reg = $('#timg_reg' + num).val();
                var timg_x_ratio = $('#timg_x_ratio' + num).val();
                var timg_y_ratio = $('#timg_y_ratio' + num).val();
                var tname=$('#' + nowimg).attr('name');


                $('#timg' + num).attr('src', $('#timg' + tnextnum)[0].src);
                $('#timg_reg' + num).val($('#timg_reg' + tnextnum).val());
                $('#timg_x_ratio' + num).val($('#timg_x_ratio' + tnextnum).val());
                $('#timg_y_ratio' + num).val($('#timg_y_ratio' + tnextnum).val());
                $('#timg' + num).attr('name', $('#timg' + tnextnum).attr('name'));



                $('#timg' + tnextnum).attr('src', timgsrc);
                $('#timg_reg' + tnextnum).val(timg_reg);
                $('#timg_x_ratio' + tnextnum).val(timg_x_ratio);
                $('#timg_y_ratio' + tnextnum).val(timg_y_ratio);
                $('#timg' + tnextnum).attr('name', tname);




                $('#timg' + num).css("border", "0px solid #cececf");
                $('#timg' + tnextnum).css("border", "1px solid #9b9ca3");
                var y=$("#notediv").offset().top;
                $("#notediv").css("top",y+104);


                $('#nowimg').val('timg' + tnextnum);
                $('#tnowimg').val('timg' + tnextnum);

                $('#tnownum').text(tnextnum);
            }
        }
        if(nowimg.indexOf('aimg')>-1)
        {
            if(num==asumnnum)
            {
                alert("最后一个无法下移")
            }
            else
            {
                var anextnum = parseInt(num) + 1;
                var aimgsrc = $('#' + nowimg)[0].src;
                var aimg_reg = $('#aimg_reg' + num).val();
                var aimg_x_ratio = $('#aimg_x_ratio' + num).val();
                var aimg_y_ratio = $('#aimg_y_ratio' + num).val();
                var aname=$('#' + nowimg).attr('name');


                $('#aimg' + num).attr('src', $('#aimg' + anextnum)[0].src);
                $('#aimg_reg' + num).val($('#aimg_reg' + anextnum).val());
                $('#aimg_x_ratio' + num).val($('#aimg_x_ratio' + anextnum).val());
                $('#aimg_y_ratio' + num).val($('#aimg_y_ratio' + anextnum).val());
                $('#aimg' + num).attr('name', $('#aimg' + anextnum).attr('name'));


                $('#aimg' + anextnum).attr('src', aimgsrc);
                $('#aimg_reg' +anextnum).val(aimg_reg);
                $('#aimg_x_ratio' + anextnum).val(aimg_x_ratio);
                $('#aimg_y_ratio' + anextnum).val(aimg_y_ratio);
                $('#aimg' + anextnum).attr('name', aname);




                $('#aimg' + num).css("border", "0px solid #cececf");
                $('#aimg' + anextnum).css("border", "1px solid #9b9ca3");
                var y=$("#notediv").offset().top;
                $("#localy").val(y+104);
                $('#nowimg').val('aimg' + anextnum);
                $('#anowimg').val('aimg' + anextnum);

                $('#anownum').text(anextnum);
            }
        }

    }

}
//下载事件
function downloadImage() {

    var mydate = new Date();
    $("#localy").val("")
    $("#localx").val("");
    $("#notediv").css("display",'none');
    var nowimg=$('#nowimg').val();
    var imgname="ctbsystem_"+nowimg+mydate.getSeconds();


    if(nowimg.indexOf('timg')>-1)
    {
    var src=$('#tbigimg')[0].src;

    if(src.indexOf('.png')>-1)
    {
        imgname=imgname+'.png';
    }

    if(src.indexOf('.jpeg')>-1)
    {
        imgname=imgname+'.jpeg';
    }
    if(src.indexOf('.jpg')>-1)
     {
         imgname=imgname+'.jpg';
     }
    if(src.indexOf('.gif')>-1)
     {
         imgname=imgname+'.gif';
     }

    var $a = $("<a></a>").attr("href", src).attr("download", imgname);
    $a[0].click();
    }

    if(nowimg.indexOf('aimg')>-1)
    {
        var src=$('#abigimg')[0].src;

        if(src.indexOf('.png')>-1)
        {
            imgname=imgname+'.png';
        }

        if(src.indexOf('.jpeg')>-1)
        {
            imgname=imgname+'.jpeg';
        }
        if(src.indexOf('.jpg')>-1)
        {
            imgname=imgname+'.jpg';
        }
        if(src.indexOf('.gif')>-1)
        {
            imgname=imgname+'.gif';
        }

        var $a = $("<a></a>").attr("href", src).attr("download", imgname);
        $a[0].click();
    }


}
//添加1张图片
 function add1imgsub() {
   //  $("#notediv").css("display",'none');
     var nowimg=$('#nowimg').val();
     var num=parseInt(nowimg.replace(/[^0-9]/ig,""));
     var tsumnum=parseInt($('#tsumnum').text());
     var asumnum=parseInt($('#asumnum').text());

     if(nowimg.indexOf('timg')>-1)
     {
     $('#timg_y_ratio'+num).after("<img id='addimg1'  onclick='nowimgsub(this.id)' ondblclick='mysub(this.id)'>");
     $('#addimg1').after("<input id='addimg_reg' type='hidden' value='0'>");
     $('#addimg_reg').after("<input id='addimg_x_ratio' type='hidden' value='0'>");
     $('#addimg_x_ratio').after("<input id='addimg_y_ratio' type='hidden' value='0'>");


     for(var i=tsumnum;i>num;i--)
     {

         var j=parseInt(i)+1;
         $('#timg'+i).attr('id','timg'+j);
         $('#timg_reg'+i).attr('id','timg_reg'+j);
         $('#timg_x_ratio'+i).attr('id','timg_x_ratio'+j);
         $('#timg_y_ratio'+i).attr('id','timg_y_ratio'+j);
     }
     $('#addimg1').attr('id','timg'+(parseInt(num)+1));
     $('#addimg_reg').attr('id','timg_reg'+(parseInt(num)+1));
     $('#addimg_x_ratio').attr('id','timg_x_ratio'+(parseInt(num)+1));
     $('#addimg_y_ratio').attr('id','timg_y_ratio'+(parseInt(num)+1));

         $('#tsumnum').text(parseInt(tsumnum)+1);
     }
     if(nowimg.indexOf('aimg')>-1)
     {

         $('#aimg_y_ratio'+num).after("<img id='addimg1' onclick='nowimgsub(this.id)' ondblclick='mysub(this.id)'>");
         $('#addimg1').after("<input id='addimg_reg' type='hidden' value='0'>");
         $('#addimg_reg').after("<input id='addimg_x_ratio' type='hidden' value='0'>");
         $('#addimg_x_ratio').after("<input id='addimg_y_ratio' type='hidden' value='0'>");


         for(var i=asumnum;i>num;i--)
         {

             var j=parseInt(i)+1;
             $('#aimg'+i).attr('id','aimg'+j);
             $('#aimg_reg'+i).attr('id','aimg_reg'+j);
             $('#aimg_x_ratio'+i).attr('id','aimg_x_ratio'+j);
             $('#aimg_y_ratio'+i).attr('id','aimg_y_ratio'+j);
         }
         $('#addimg1').attr('id','aimg'+(parseInt(num)+1));
         $('#addimg_reg').attr('id','aimg_reg'+(parseInt(num)+1));
         $('#addimg_x_ratio').attr('id','aimg_x_ratio'+(parseInt(num)+1));
         $('#addimg_y_ratio').attr('id','aimg_y_ratio'+(parseInt(num)+1));

         $('#asumnum').text(parseInt(asumnum)+1);

     }
 }
//添加2张图片
function add2imgsub() {
    $("#notediv").css("display",'none');
    var nowimg=$('#nowimg').val();
    var num=parseInt(nowimg.replace(/[^0-9]/ig,""));
    var tsumnum=parseInt($('#tsumnum').text());
    var asumnum=parseInt($('#asumnum').text());

    if(nowimg.indexOf('timg')>-1)
    {
        $('#timg_y_ratio'+num).after("<img id='addimga' onclick='nowimgsub(this.id)' ondblclick='mysub(this.id)'>");
        $('#addimga').after("<input id='addimg_rega'  type='hidden'>");
        $('#addimg_rega').after("<input id='aimg_x_ratioa' type='hidden'>");
        $('#aimg_x_ratioa').after("<input id='aimg_y_ratioa'  type='hidden'>");

        $('#aimg_y_ratioa').after("<img id='addimgb' onclick='nowimgsub(this.id)' ondblclick='mysub(this.id)'>");
        $('#addimgb').after("<input id='addimg_regb'  type='hidden'>");
        $('#addimg_regb').after("<input id='aimg_x_ratiob'  type='hidden'>");
        $('#aimg_x_ratiob').after("<input id='aimg_y_ratiob'  type='hidden'>");


        for(var i=tsumnum;i>num;i--)
        {
            var j=parseInt(i)+2;
            $('#timg'+i).attr('id','timg'+j);
            $('#timg_reg'+i).attr('id','timg_reg'+j);
            $('#timg_x_ratio'+i).attr('id','timg_x_ratio'+j);
            $('#timg_y_ratio'+i).attr('id','timg_y_ratio'+j);
        }
        $('#addimga').attr('id','timg'+(parseInt(num)+1));
        $('#addimg_rega').attr('id','timg_reg'+(parseInt(num)+1));
        $('#aimg_x_ratioa').attr('id','timg_x_ratio'+(parseInt(num)+1));
        $('#aimg_y_ratioa').attr('id','timg_y_ratio'+(parseInt(num)+1));

        $('#addimgb').attr('id','timg'+(parseInt(num)+2));
        $('#addimg_regb').attr('id','timg_reg'+(parseInt(num)+2));
        $('#aimg_x_ratiob').attr('id','timg_x_ratio'+(parseInt(num)+2));
        $('#aimg_y_ratiob').attr('id','timg_y_ratio'+(parseInt(num)+2));

        $('#tsumnum').text(parseInt(tsumnum)+2);
    }
    if(nowimg.indexOf('aimg')>-1)
    {

        $('#aimg_y_ratio'+num).after("<img id='addimga' onclick='nowimgsub(this.id)' ondblclick='mysub(this.id)'>");
        $('#addimga').after("<input id='addimg_rega'  type='hidden'>");
        $('#addimg_rega').after("<input id='aimg_x_ratioa' type='hidden'>");
        $('#aimg_x_ratioa').after("<input id='aimg_y_ratioa'  type='hidden'>");

        $('#aimg_y_ratioa').after("<img id='addimgb' onclick='nowimgsub(this.id)' ondblclick='mysub(this.id)'>");
        $('#addimgb').after("<input id='addimg_regb'  type='hidden'>");
        $('#addimg_regb').after("<input id='aimg_x_ratiob'  type='hidden'>");
        $('#aimg_x_ratiob').after("<input id='aimg_y_ratiob'  type='hidden'>");


        for(var i=asumnum;i>num;i--)
        {
            var j=parseInt(i)+2;
            $('#aimg'+i).attr('id','aimg'+j);
            $('#aimg_reg'+i).attr('id','aimg_reg'+j);
            $('#aimg_x_ratio'+i).attr('id','aimg_x_ratio'+j);
            $('#aimg_y_ratio'+i).attr('id','aimg_y_ratio'+j);
        }
        $('#addimga').attr('id','aimg'+(parseInt(num)+1));
        $('#addimg_rega').attr('id','aimg_reg'+(parseInt(num)+1));
        $('#aimg_x_ratioa').attr('id','aimg_x_ratio'+(parseInt(num)+1));
        $('#aimg_y_ratioa').attr('id','aimg_y_ratio'+(parseInt(num)+1));

        $('#addimgb').attr('id','aimg'+(parseInt(num)+2));
        $('#addimg_regb').attr('id','aimg_reg'+(parseInt(num)+2));
        $('#aimg_x_ratiob').attr('id','aimg_x_ratio'+(parseInt(num)+2));
        $('#aimg_y_ratiob').attr('id','aimg_y_ratio'+(parseInt(num)+2));

        $('#asumnum').text(parseInt(asumnum)+2);


    }
}
//编辑图片事件（分割，剪切）
function cutsub() {



    if($('#nowimg').val().indexOf('timg')>-1) {
        var x_ratio = $("#timg_x_ratio" + $('#nowimg').val().replace(/[^0-9]/ig, "")).val();
        var y_ratio = $("#timg_y_ratio" + $('#nowimg').val().replace(/[^0-9]/ig, "")).val();
        var reg = $('#regspan').text();
        var src = $('#tbigimg')[0].src;
        var num = src.indexOf('uploads');
        var length = src.length;
        src = "./" + src.substr(num, length - num);
        var num1=src.indexOf('?');
        src=src.substr(0,num1);

        var nowimg=$('#nowimg').val();
        var name=$('#'+nowimg).attr('name');

        if ($(".cutchoose").val() == 1) {


            $.ajax({
                url: "<?php echo U('myrotateimg');?>",
                type: 'POST',
                data: {src: src, reg: reg,name:name},
                dataType: 'json',
                success: function (re) {
                    if(re!=0)
                        {
                    var nowimg=$('#nowimg').val();
                    var num=nowimg.replace(/[^0-9]/ig,"");
                    $('#tbigimg').attr('src',re['src']);
                    $('#timg'+num).attr('src',re['src']);
                    $('#timg_reg'+num).val(0);
                    $('#regspan').text("0");
                    $("#tbigimg").css({transform: "rotate(" +0+ "deg)"});

                    $('#timg_x_ratio'+num).val(re['x_ratio']);
                    $('#timg_y_ratio'+num).val(re['y_ratio']);
                        }
                        else
                        {
                            alert('数据错误！！');
                        }


                }
            })
        }








        if ($(".cutchoose").val() == 6) {

            var left0 = $('#tbigimg').position().left;
            var top0 = $('#tbigimg').position().top;

            var left1 = $('#tvline1').position().left;
            var top1 = $('#thr1').position().top;

            var x = left1 - left0;
            var y = top1 - top0;

            var width = $('#tvline2').position().left - $('#tvline1').position().left;
            var height = $('#thr2').position().top - $('#thr1').position().top;
            x = Math.round(x * x_ratio);
            y = Math.round(y * y_ratio);
            width = Math.round(width * x_ratio);
            height = Math.round(height * y_ratio);





            $.ajax({
                url: "<?php echo U('testcutsub');?>",
                type: 'POST',
                data: {kind: 'cut', x: x, y: y, width: width, height: height, src: src, reg: reg,name:name},
                dataType: 'json',
                success: function (re) {

//                    alert(re[1]['src']);

                    var nowimg=$('#nowimg').val();
                    var num=nowimg.replace(/[^0-9]/ig,"");
                    $('#tbigimg').attr('src',re[1]['src']);
                    $('#timg'+num).attr('src',re[1]['src']);
                    $('#timg_reg'+num).val(0);
                    $('#timg_x_ratio'+num).val(re[1]['x_ratio']);
                    $('#timg_y_ratio'+num).val(re[1]['y_ratio']);
                    $('#regspan').text("0");
                    $("#tbigimg").css({transform: "rotate(" + re[1]['reg']+ "deg)"});
                    cutlinereset(30,50,420,610,30,50,420,610,1);
                }
            })
        }

        if ($(".cutchoose").val() == 4) {
            var width = $('#tmvlineonly').position().left - $('#tbigimg').position().left;
            width = Math.round(width * x_ratio);
            var x=width;
            var height = 0;//没有用
            $.ajax({
                url: "<?php echo U('testcutsub');?>",
                type: 'POST',
                data: {kind: 'cut2', x: x, y: 0, width: 0, height: 0, src: src, reg: reg,name:name},
                dataType: 'json',
                success: function (re) {
                    add1imgsub();

                    var src = $('#tbigimg')[0].src;
                    var nowimg=$('#nowimg').val();
                    var num=nowimg.replace(/[^0-9]/ig,"");
                    $('#tbigimg').attr('src',re[1]['src']);
                    $('#timg'+num).attr('src',re[1]['src']);
                    $('#timg_reg'+num).val(0);
                    $('#timg_x_ratio'+num).val(re[1]['x_ratio']);
                    $('#timg_y_ratio'+num).val(re[1]['y_ratio']);


                    $('#regspan').text("0");
                    $("#tbigimg").css({transform: "rotate(" + re[1]['reg']+ "deg)"});
                    var num1=parseInt(num)+1;
                    $('#timg'+num1).attr('src',re[2]['src']);
                    $('#timg_reg'+num1).val(0);
                    $('#timg_x_ratio'+num1).val(re[2]['x_ratio']);
                    $('#timg_y_ratio'+num1).val(re[2]['y_ratio']);
                    $('#timg'+num1).attr('name',re[2]['id']);
                    cutlinereset(30,50,420,610,30,50,420,610,1);
                }
            })
        }

        if ($(".cutchoose").val() == 7) {
            var height = $('#tpartline').position().top - $('#tbigimg').position().top;
            height = Math.round(height * y_ratio);
            var y=height;


            $.ajax({
                url: "<?php echo U('testcutsub');?>",
                type: 'POST',
                data: {kind: 'cutpart2', x: 0, y: y, width: 0, height: 0, src: src, reg: reg,name:name},
                dataType: 'json',
                success: function (re) {
                    add1imgsub();
                    var src = $('#tbigimg')[0].src;
                    var nowimg=$('#nowimg').val();
                    var num=nowimg.replace(/[^0-9]/ig,"");
                    $('#tbigimg').attr('src',re[1]['src']);
                    $('#timg'+num).attr('src',re[1]['src']);
                    $('#timg_reg'+num).val(0);
                    $('#timg_x_ratio'+num).val(re[1]['x_ratio']);
                    $('#timg_y_ratio'+num).val(re[1]['y_ratio']);


                    $('#regspan').text("0");
                    $("#tbigimg").css({transform: "rotate(" + re[1]['reg']+ "deg)"});
                    var num1=parseInt(num)+1;
                    $('#timg'+num1).attr('src',re[2]['src']);
                    $('#timg_reg'+num1).val(0);
                    $('#timg_x_ratio'+num1).val(re[2]['x_ratio']);
                    $('#timg_y_ratio'+num1).val(re[2]['y_ratio']);
                    $('#timg'+num1).attr('name',re[2]['id']);
                    cutlinereset(30,50,420,610,30,50,420,610,1);
                }
            })
        }





        if ($(".cutchoose").val() == 5) {
            var width1 = $('#tmvlineleft').position().left - $('#tbigimg').position().left;
            var width2 = $('#tmvlineright').position().left - $('#tmvlineleft').position().left;
            width1 = Math.round(width1 * x_ratio);
            width2 = Math.round(width2 * x_ratio);

            var x=width1;
            var width=width2;
            $.ajax({
                url: "<?php echo U('testcutsub');?>",
                type: 'POST',
                data: {kind: 'cut3', x: x, y: 0, width: width, height: 0, src: src, reg: reg,name:name},
                dataType: 'json',
                success: function (re) {

                    add2imgsub();
                    var src = $('#tbigimg')[0].src;
                    var nowimg=$('#nowimg').val();
                    var num=nowimg.replace(/[^0-9]/ig,"");
                    $('#tbigimg').attr('src',re[1]['src']);
                    $('#timg'+num).attr('src',re[1]['src']);
                    $('#timg_reg'+num).val(0);
                    $('#timg_x_ratio'+num).val(re[1]['x_ratio']);
                    $('#timg_y_ratio'+num).val(re[1]['y_ratio']);
                    $('#regspan').text("0");
                    $("#tbigimg").css({transform: "rotate(" + re[1]['reg']+ "deg)"});


                    var num1=parseInt(num)+1;
                    $('#timg'+num1).attr('src',re[2]['src']);
                    $('#timg_reg'+num1).val(0);
                    $('#timg_x_ratio'+num1).val(re[2]['x_ratio']);
                    $('#timg_y_ratio'+num1).val(re[2]['y_ratio']);
                    $('#timg'+num1).attr('name',re[2]['id']);

                    var num2=parseInt(num)+2;
                    $('#timg'+num2).attr('src',re[3]['src']);
                    $('#timg_reg'+num2).val(0);
                    $('#timg_x_ratio'+num2).val(re[3]['x_ratio']);
                    $('#timg_y_ratio'+num2).val(re[3]['y_ratio']);
                    $('#timg'+num2).attr('name',re[3]['id']);

                    cutlinereset(30,50,420,610,30,50,420,610,1);
                }
            })
        }
    }


    if($('#nowimg').val().indexOf('aimg')>-1) {
      
        var x_ratio = $("#aimg_x_ratio" + $('#nowimg').val().replace(/[^0-9]/ig, "")).val();
        var y_ratio = $("#aimg_y_ratio" + $('#nowimg').val().replace(/[^0-9]/ig, "")).val();
        var reg = $('#regspan').text();
        var src = $('#abigimg')[0].src;
        var num = src.indexOf('uploads');
        var length = src.length;
        src = "./" + src.substr(num, length - num);
        var num1=src.indexOf('?');
        src=src.substr(0,num1);

        var nowimg=$('#nowimg').val();
        var name=$('#'+nowimg).attr('name');



        if ($(".cutchoose").val() == 1) {

            $.ajax({
                url: "<?php echo U('myrotateimg');?>",
                type: 'POST',
                data: {src: src, reg: reg,name:name},
                dataType: 'text',
                success: function (re) {

                    var re=eval("("+re+")");


                    if(re!=0)
                    {
//                        alert(re['src']);
                        var nowimg=$('#nowimg').val();
                        var num=nowimg.replace(/[^0-9]/ig,"");
                        $('#abigimg').attr('src',re['src']);
                        $('#aimg'+num).attr('src',re['src']);
                        $('#aimg_reg'+num).val(0);
                        $('#regspan').text("0");
                        $("#abigimg").css({transform: "rotate(" +0+ "deg)"});

                        $('#aimg_x_ratio'+num).val(re['x_ratio']);
                        $('#aimg_y_ratio'+num).val(re['y_ratio']);
                    }
                    else
                    {
                        alert('数据错误！！');
                    }





                }
            })
        }





        if ($(".cutchoose").val() == 6) {



            var left0 = $('#abigimg').position().left;
            var top0 = $('#abigimg').position().top;


            var left1 = $('#avline1').position().left;
            var top1 = $('#ahr1').position().top;

            var x = left1 - left0;
            var y = top1 - top0;

            var width = $('#avline2').position().left - $('#avline1').position().left;
            var height = $('#ahr2').position().top - $('#ahr1').position().top;
            x = Math.round(x * x_ratio);
            y = Math.round(y * y_ratio);
            width = Math.round(width * x_ratio);
            height = Math.round(height * y_ratio);



            $.ajax({
                url: "<?php echo U('testcutsub');?>",
                type: 'POST',
                data: {kind: 'cut', x: x, y: y, width: width, height: height, src: src, reg: reg,name:name},
                dataType: 'json',
                success: function (re) {
                 
                    var nowimg=$('#nowimg').val();
                    var num=nowimg.replace(/[^0-9]/ig,"");
                    $('#abigimg').attr('src',re[1]['src']);
                    $('#aimg'+num).attr('src',re[1]['src']);
                    $('#aimg_reg'+num).val(0);
                    $('#aimg_x_ratio'+num).val(re[1]['x_ratio']);
                    $('#aimg_y_ratio'+num).val(re[1]['y_ratio']);
                    $('#regspan').text("0");
                    $("#abigimg").css({transform: "rotate(" + re[1]['reg']+ "deg)"});
                    cutlinereset(30,50,420,610,30,50,420,610,1);
                }
            })
        }

        if ($(".cutchoose").val() == 4) {
            var width = $('#amvlineonly').position().left - $('#abigimg').position().left;
            width = Math.round(width * x_ratio);
            var x = width;//没有用
            $.ajax({
                url: "<?php echo U('testcutsub');?>",
                type: 'POST',
                data: {kind: 'cut2', x: x, y: 0, width: 0, height: 0, src: src, reg: reg,name:name},
                dataType: 'json',
                success: function (re) {
                    add1imgsub();
                    var src = $('#abigimg')[0].src;
                    var nowimg=$('#nowimg').val();
                    var num=nowimg.replace(/[^0-9]/ig,"");
                    $('#abigimg').attr('src',re[1]['src']);
                    $('#aimg'+num).attr('src',re[1]['src']);
                    $('#aimg_reg'+num).val(0);
                    $('#aimg_x_ratio'+num).val(re[1]['x_ratio']);
                    $('#aimg_y_ratio'+num).val(re[1]['y_ratio']);
                    $('#regspan').text("0");
                    $("#abigimg").css({transform: "rotate(" + re[1]['reg']+ "deg)"});
                    var num1=parseInt(num)+1;
                    $('#aimg'+num1).attr('src',re[2]['src']);
                    $('#aimg_reg'+num1).val(0);
                    $('#aimg_x_ratio'+num1).val(re[2]['x_ratio']);
                    $('#aimg_y_ratio'+num1).val(re[2]['y_ratio']);
                    $('#aimg'+num1).attr('name',re[2]['id']);
                    cutlinereset(30,50,420,610,30,50,420,610,1);
                }
            })
        }


        if ($(".cutchoose").val() == 7) {
            var height = $('#apartline').position().top - $('#abigimg').position().top;
            height = Math.round(height * y_ratio);
            var y=height;
            $.ajax({
                url: "<?php echo U('testcutsub');?>",
                type: 'POST',
                data: {kind: 'cutpart2', x: 0, y: y, width: 0, height: 0, src: src, reg: reg,name:name},
                dataType: 'json',
                success: function (re) {
                    add1imgsub();
                    var src = $('#abigimg')[0].src;

                    var nowimg=$('#nowimg').val();
                    var num=nowimg.replace(/[^0-9]/ig,"");
                    $('#abigimg').attr('src',re[1]['src']);
                    $('#aimg'+num).attr('src',re[1]['src']);
                    $('#aimg_reg'+num).val(0);
                    $('#aimg_x_ratio'+num).val(re[1]['x_ratio']);
                    $('#aimg_y_ratio'+num).val(re[1]['y_ratio']);

                    $('#regspan').text("0");
                    $("#abigimg").css({transform: "rotate(" + re[1]['reg']+ "deg)"});
                    var num1=parseInt(num)+1;
                    $('#aimg'+num1).attr('src',re[2]['src']);
                    $('#aimg_reg'+num1).val(0);
                    $('#aimg_x_ratio'+num1).val(re[2]['x_ratio']);
                    $('#aimg_y_ratio'+num1).val(re[2]['y_ratio']);
                    $('#aimg'+num1).attr('name',re[2]['id']);
                    cutlinereset(30,50,420,610,30,50,420,610,1);
                }
            })
        }


        if ($(".cutchoose").val() == 5) {
            var width1 = $('#amvlineleft').position().left - $('#abigimg').position().left;
            var width2 = $('#amvlineright').position().left - $('#amvlineleft').position().left;
            width1 = Math.round(width1 * x_ratio);
            width2 = Math.round(width2 * x_ratio);

            var x=width1;
            var width=width2;
            $.ajax({
                url: "<?php echo U('testcutsub');?>",
                type: 'POST',
                data: {kind: 'cut3', x: x, y: 0, width: width, height: 0, src: src, reg: reg,name:name},
                dataType: 'json',
                success: function (re) {
                    add2imgsub();
                    var src = $('#abigimg')[0].src;
                    var nowimg=$('#nowimg').val();
                    var num=nowimg.replace(/[^0-9]/ig,"");
                    $('#abigimg').attr('src',re[1]['src']);
                    $('#aimg'+num).attr('src',re[1]['src']);
                    $('#aimg_reg'+num).val(0);
                    $('#aimg_x_ratio'+num).val(re[1]['x_ratio']);
                    $('#aimg_y_ratio'+num).val(re[1]['y_ratio']);
                    $('#regspan').text("0");
                    $("#abigimg").css({transform: "rotate(" + re[1]['reg']+ "deg)"});


                    var num1=parseInt(num)+1;
                    $('#aimg'+num1).attr('src',re[2]['src']);
                    $('#aimg_reg'+num1).val(0);
                    $('#aimg_x_ratio'+num1).val(re[2]['x_ratio']);
                    $('#aimg_y_ratio'+num1).val(re[2]['y_ratio']);
                    $('#aimg'+num1).attr('name',re[2]['id']);

                    var num2=parseInt(num)+2;
                    $('#aimg'+num2).attr('src',re[3]['src']);
                    $('#aimg_reg'+num2).val(0);
                    $('#aimg_x_ratio'+num2).val(re[3]['x_ratio']);
                    $('#aimg_y_ratio'+num2).val(re[3]['y_ratio']);
                    $('#aimg'+num2).attr('name',re[3]['id']);


                    cutlinereset(30,50,420,610,30,50,420,610,1);
                }
            })
        }
    }
}

//////////////////////////////////////////////////////增删改事件
//删除事件
function delsub() {
    var nowimg=$('#nowimg').val();
    var num=nowimg.replace(/[^0-9]/ig,"");
    var tsumnnum=$('#tsumnum').text();
    var asumnnum=$('#asumnum').text();

    $("#notediv").css("display",'none');
    if(nowimg.indexOf('timg')>-1)
    {

        var tsrc = $('#tbigimg')[0].src;
        var tnum = tsrc.indexOf('uploads');
        var tlength = tsrc.length;
        tsrc = "./" + tsrc.substr(tnum, tlength - tnum);
        var numx=tsrc.indexOf('?');
        tsrc=tsrc.substr(0,numx);
        var tid=$('#'+nowimg).attr('name');
        phpdelsub(tid,tsrc);
        if(num!=tsumnnum)
        {
            $('#'+nowimg).remove();
            $('#timg_reg'+num).remove();
            $('#timg_x_ratio'+num).remove();
            $('#timg_y_ratio'+num).remove();
            for(var i=num;i<tsumnnum;i++)
            {
                // alert(i+"ddd"+j);
                var j=parseInt(i)+1;
                $('#timg'+j).attr('id','timg'+i);
                $('#timg_reg'+j).attr('id','timg_reg'+i);
                $('#timg_x_ratio'+j).attr('id','timg_x_ratio'+i);
                $('#timg_y_ratio'+j).attr('id','timg_y_ratio'+i);
            }

            $('#timg' + num).css("border", "1px solid #9b9ca3");
            $('#tbigimg').attr('src',$('#timg' + num)[0].src);
            $('#tnowimg').val('timg' + num);
            $('#nowimg').val('timg' + num);
            $('#regspan').text($('#timg_reg'+num).val());
            $("#tbigimg").css({transform: "rotate(" + $('#timg_reg'+num).val() + "deg)"});
        }
        if(num==tsumnnum)
        {
            $('#'+nowimg).remove();
            $('#timg_reg'+num).remove();
            $('#timg_x_ratio'+num).remove();
            $('#timg_y_ratio'+num).remove();

            num=parseInt(num)-1;

            $('#timg' + num).css("border", "1px solid #9b9ca3");
            $('#tbigimg').attr('src',$('#timg' + num)[0].src);
            $('#tnowimg').val('timg' + num);
            $('#nowimg').val('timg' + num);
            $('#regspan').text($('#timg_reg'+num).val());
            $("#tbigimg").css({transform: "rotate(" + $('#timg_reg'+num).val() + "deg)"});
            $('#tnownum').text(num);
        }
        tsumnnum=parseInt(tsumnnum)-1;
        $('#tsumnum').text(tsumnnum);


    }
    if(nowimg.indexOf('aimg')>-1)
    {

        var asrc = $('#abigimg')[0].src;
        var anum = asrc.indexOf('uploads');
        var alength = asrc.length;
        src = "./" + asrc.substr(anum, alength - anum);
        var numx=asrc.indexOf('?');
        asrc=asrc.substr(0,numx);
        var aid=$('#'+nowimg).attr('name');
        phpdelsub(aid,asrc);

        if(num!=asumnnum)
        {
            $('#'+nowimg).remove();
            $('#aimg_reg'+num).remove();
            $('#aimg_x_ratio'+num).remove();
            $('#aimg_y_ratio'+num).remove();
            for(var i=num;i<asumnnum;i++)
            {
                // alert(i+"ddd"+j);
                var j=parseInt(i)+1;
                $('#aimg'+j).attr('id','aimg'+i);
                $('#aimg_reg'+j).attr('id','aimg_reg'+i);
                $('#aimg_x_ratio'+j).attr('id','aimg_x_ratio'+i);
                $('#aimg_y_ratio'+j).attr('id','aimg_y_ratio'+i);
            }

            $('#aimg' + num).css("border", "1px solid #9b9ca3");
            $('#abigimg').attr('src',$('#aimg' + num)[0].src);
            $('#anowimg').val('aimg' + num);
            $('#nowimg').val('aimg' + num);
            $('#regspan').text($('#aimg_reg'+num).val());
            $("#abigimg").css({transform: "rotate(" + $('#aimg_reg'+num).val() + "deg)"});
        }
        if(num==asumnnum)
        {
            $('#'+nowimg).remove();
            $('#aimg_reg'+num).remove();
            $('#aimg_x_ratio'+num).remove();
            $('#aimg_y_ratio'+num).remove();

            num=parseInt(num)-1;

            $('#aimg' + num).css("border", "1px solid #9b9ca3");
            $('#abigimg').attr('src',$('#aimg' + num)[0].src);
            $('#anowimg').val('aimg' + num);
            $('#nowimg').val('aimg' + num);
            $('#regspan').text($('#aimg_reg'+num).val());
            $("#abigimg").css({transform: "rotate(" + $('#aimg_reg'+num).val() + "deg)"});
            $('#anownum').text(num);
        }
        asumnnum=parseInt(asumnnum)-1;
        $('#asumnum').text(asumnnum);
    }
}
//在php端进行数据删除和文件删除
function phpdelsub(id,src) {
    var id=id;
    var src=src;
    $.ajax({
        url: "<?php echo U('delsub');?>",
        type: 'POST',
        data: {id:id, src: src},
        dataType: 'text',
        success: function (re) {
           // alert(re);
        }
    })
}
//添加事件
 function addimgsub() {

     var nowimg=$('#nowimg').val();
     var num=nowimg.replace(/[^0-9]/ig,"");
     var id=$('#'+nowimg).attr('name');
     var tsumnnum=$('#tsumnum').text();
     var asumnnum=$('#asumnum').text();
     if(nowimg.indexOf('timg')>-1) {
         $('#addpreid').val(id);
         addfilesubmit(num,1);

     }

     if(nowimg.indexOf('aimg')>-1) {
         $('#addpreid').val(id);
         addfilesubmit(num,2);

     }
     $("#notediv").css("display",'none');
 }
 //文件上传
 function addfilesubmit(num,kind){
     // $("div[name='aprogressdiv']").css('display','block');
     var data = new FormData($('#addform')[0]);

     if(kind==1)
     {
     $.ajax({
         url: "<?php echo U('addupload');?>",
         type: 'POST',
         data: data,
         dataType: 'json',
         cache: false,
         processData: false,
         contentType: false,

         success:function(re){

             if(re['status']==0)
             {
                 alert("请添加小于4M的图片文件！！");
             }
             else {
                 add1imgsub();

                 $('#timg' + num).css("border", "0px solid #9b9ca3");
                 num = parseInt(num) + 1;
                 $('#timg' + num).css("border", "1px solid #9b9ca3");
                 $('#timg' + num).attr('src', re['src']);
                 $('#timg_reg' + num).val('0');
                 $('#timg_x_ratio' + num).val(re['x_ratio']);
                 $('#timg_y_ratio' + num).val(re['y_ratio']);
                 $('#timg' + num).attr('name', re['id']);


                 $('#tbigimg').attr('src', $('#timg' + num)[0].src);
                 $('#tnowimg').val('timg' + num);
                 $('#nowimg').val('timg' + num);
                 $('#regspan').text($('#timg_reg' + num).val());
                 $("#tbigimg").css({transform: "rotate(" + $('#timg_reg' + num).val() + "deg)"});
                 $('#tnownum').text(num);
             }

         }
     })
     }

     if(kind==2)
     {
         $.ajax({
             url: "<?php echo U('addupload');?>",
             type: 'POST',
             data: data,
             dataType: 'json',
             cache: false,
             processData: false,
             contentType: false,

             success:function(re){
                 if(re['status']==0)
                 {
                     alert("请添加小于4M的图片文件！！");
                 }
                 else {
                     add1imgsub();

                     $('#aimg' + num).css("border", "0px solid #9b9ca3");
                     num = parseInt(num) + 1;
                     $('#aimg' + num).css("border", "1px solid #9b9ca3");
                     $('#aimg' + num).attr('src', re['src']);
                     $('#aimg_reg' + num).val('0');
                     $('#aimg_x_ratio' + num).val(re['x_ratio']);
                     $('#aimg_y_ratio' + num).val(re['y_ratio']);
                     $('#aimg' + num).attr('name', re['id']);

                     $('#abigimg').attr('src', $('#aimg' + num)[0].src);
                     $('#anowimg').val('aimg' + num);
                     $('#nowimg').val('aimg' + num);
                     $('#regspan').text($('#aimg_reg' + num).val());
                     $("#abigimg").css({transform: "rotate(" + $('#aimg_reg' + num).val() + "deg)"});
                     $('#anownum').text(num);
                 }

             }
         })
     }
 }
 //文件替换
 function replacesub(){
    var nowimg=$('#nowimg').val();
    var replacenum=$('#'+nowimg)[0].src.indexOf('?');
    var replacepath=$('#'+nowimg)[0].src.substr(0,replacenum);
    var numb=replacepath.indexOf('/uploads');
    var strlength=replacepath.length;
    replacepath=replacepath.substr(numb,strlength-numb);
    $('#presrc').val(replacepath);

     var id=$('#'+nowimg).attr('name');
     $('#replaceid').val(id);

    var num=nowimg.replace(/[^0-9]/ig,"");
     if(nowimg.indexOf('timg')>-1) {
         refilesubmit(num,1);
     }
     if(nowimg.indexOf('aimg')>-1) {
         refilesubmit(num,2);
     }
     $("#notediv").css("display",'none');
 }
 //php文件替换
 function refilesubmit(num,kind){
     // $("div[name='aprogressdiv']").css('display','block');
     var data = new FormData($('#reform')[0]);
     if(kind==1)
     {
         $.ajax({
             url: "<?php echo U('reupload');?>",
             type: 'POST',
             data: data,
             dataType: 'json',
             cache: false,
             processData: false,
             contentType: false,

             success:function(re){


                if(re['status']==0)
                {
                    alert("请添加小于4M的图片文件！！");
                }
                else{
                    $('#timg' + num).attr('src',re['src']);
                    $('#timg_reg' + num).val('0');
                    $('#timg_x_ratio' + num).val(re['x_ratio']);
                    $('#timg_y_ratio' + num).val(re['y_ratio']);
                    $('#tbigimg').attr('src',$('#timg' + num)[0].src);
                    $("#tbigimg").css({transform: "rotate(" + $('#timg_reg'+num).val() + "deg)"});
                }

             }
         })
     }

     if(kind==2)
     {
         $.ajax({
             url: "<?php echo U('reupload');?>",
             type: 'POST',
             data: data,
             dataType: 'json',
             cache: false,
             processData: false,
             contentType: false,
             success:function(re){
                 if(re['status']==0)
                 {
                     alert("请添加小于4M的图片文件！！");
                 }
                 else {

                     $('#aimg' + num).attr('src', re['src']);
                     $('#aimg_reg' + num).val('0');
                     $('#aimg_x_ratio' + num).val(re['x_ratio']);
                     $('#aimg_y_ratio' + num).val(re['y_ratio']);
                     $('#abigimg').attr('src', $('#aimg' + num)[0].src);
                     $("#abigimg").css({transform: "rotate(" + $('#aimg_reg' + num).val() + "deg)"});
                 }

             }
         })
     }
 }

//文件降噪
function noisereduction() {
        var nowimg=$('#nowimg').val();
        var num=nowimg.replace(/[^0-9]/ig,"");
        var tsumnnum=$('#tsumnum').text();
        var asumnnum=$('#asumnum').text();

        $("#notediv").css("display",'none');
        if(nowimg.indexOf('timg')>-1)
        {

            var tsrc = $('#tbigimg')[0].src;
            var tnum = tsrc.indexOf('uploads');
            var tlength = tsrc.length;
            tsrc = "./" + tsrc.substr(tnum, tlength - tnum);
            var numx=tsrc.indexOf('?');
            tsrc=tsrc.substr(0,numx);
            var tid=$('#'+nowimg).attr('name');
            phpnoisesub(tid,tsrc,nowimg,'t');
        }
        if(nowimg.indexOf('aimg')>-1)
        {

            var asrc = $('#abigimg')[0].src;
            var anum = asrc.indexOf('uploads');
            var alength = asrc.length;
            asrc = "./" + asrc.substr(anum, alength - anum);
            var numx=asrc.indexOf('?');
            asrc=asrc.substr(0,numx);
            var aid=$('#'+nowimg).attr('name');
            phpnoisesub(aid,asrc,nowimg,'a');

        }
    }
//在php端进行数据删除和文件删除
    function phpnoisesub(id,src,nowimg,kind) {
        var id=id;
        var src=src;
        $.ajax({
            url: "<?php echo U('noisesub');?>",
            type: 'POST',
            data: {id:id, src: src,nowimg:nowimg},
            dataType: 'text',
            success: function (re) {

                if(kind=='t')
                {
                    $('#'+nowimg).attr('src', re);
                    $('#tbigimg').attr('src', re);
                }
                if(kind=='a')
                {
                    $('#'+nowimg).attr('src', re);
                    $('#abigimg').attr('src', re);
                }
            }
        })
    }

    //小角度旋转函数
    function smallrotation(){
        var a=$("#smallrotate").prop("checked");

        if(a)
        {
            $("#smallrotate").prop("checked",false);
        }
        else
        {
            $("#smallrotate").prop("checked",true);
        }
    }
</script>
</html>