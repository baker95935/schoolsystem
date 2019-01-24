<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="login-bg">
<head>
    <title>CTB-Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="/Public/jquery/jquery.min.js"></script>
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
    <script src="/Public/js/testtitle.js"></script>
    <script src="/Public/js/titlenum.js"></script>
    <script src="/Public/js/autotitle.js"></script>
    <script src="/Public/js/addtest.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        a{
            color: #0f0f0f;
        }
        a:hover
        {
            color:#0f0f0f;

        }
    </style>
</head>
<body>
<div  id="up_div" style="width:470px;height: 40px;z-index: 3;position: absolute;">
    <div class="row" style="width:470px;height: 15px;background-color: white;">
        <div id="level1_Div" style="border-left: 1px solid #7e8cc9;"  class="col-xs-2 rule_div"><span id="msg_no1"></span></div>
        <div id="level2_Div"  class="col-xs-2 rule_div"><span id="msg_no2"></span></div>
        <div id="level3_Div"  class="col-xs-2 rule_div"><span id="msg_no3"></span></div>
        <div id="level4_Div"  class="col-xs-2 rule_div"><span id="msg_no4"></span></div>
        <div id="level5_Div" style="border-right: 1px solid #7e8cc9;" class="col-xs-2 rule_div"><span id="msg_no5"></span></div>
        <div id="link_Div"  style="border-right: 1px solid #7e8cc9;"  class="col-xs-1 rule_div" >link</div>
        <div id="Del_Div" class="col-xs-1 rule_div" style="border-right: 1px solid #7e8cc9;">Del</div>
    </div>
    <div  class="row" style="margin-top:1px;height: 20px;background-color: #e7eef5;width:470px;text-align: left;font-size: 12px;padding-left: 4px;padding-top:2px;opacity:0.8;overflow-x: scroll;overflow-y:hidden;white-space: nowrap; ">
        <b><a href="#" onclick="test_or_answersub()"><span>Now</span><span id="test_or_answer" >(T+A)</span></a><span>：</span><span id="tnum1" name="0"></span><span>&nbsp;&nbsp;</span><span id="tnum2" name="0"></span><span>&nbsp;&nbsp;</span><span id="tnum3" name="0"></span><span>&nbsp;&nbsp;</span><span id="tnum4" name="0"></span><span>&nbsp;&nbsp;</span><span id="tnum5" name="0"></span></b>
        <span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span>
        <span>Pre：</span><span id="pretnum1"></span><span>&nbsp;&nbsp;</span><span id="pretnum2"></span><span>&nbsp;&nbsp;</span><span id="pretnum3"></span><span>&nbsp;&nbsp;</span><span id="pretnum4"></span><span>&nbsp;&nbsp;</span><span id="pretnum5"></span><span>&nbsp;&nbsp;</span>
    </div>
</div>
<!--//二级标题选项按钮-->
<div id="buttondiv2" style="width: 77px;z-index: 4;position: absolute;background-color: #9aafe5;display: none;opacity: 0.2;" class="navtab_hight">
    <table style="width: 77px;border: 0px;">
        <tr>
            <td><div id="buttondiv2_div1" class="navtab_hight" onmouseover="buttondiv2_a()" onclick="addbuttondiv2_a()" style="width: 37px;background-color: red;"></div></td><td><div  id="buttondiv2_div2"  class="navtab_hight" onmouseover="buttondiv2_b()" onclick="addbuttondiv2_b()" style="width: 38px;background-color: yellow;"></div> </td>
        </tr>
    </table>
</div>
<div id="buttondiv3" class="navtab_hight" style="width: 77px;z-index: 4;position: absolute;background-color: #9aafe5;opacity: 0.8;display: none;">
    <table style="width: 77px;border: 0px;">
        <tr>
            <td><div onmouseover="buttondiv3_a()" onclick="addbuttondiv3_a()" class="navtab_hight" style="width: 26px;background-color: red;"></div></td><td><div onmouseover="buttondiv3_b()" onclick="addbuttondiv3_b()" class="navtab_hight" style="width: 26px;background-color: yellow;"></div> </td> <td><div onmouseover="buttondiv3_c()" onclick="addbuttondiv3_c()" class="navtab_hight" style="width: 26px;background-color: blue;"></div></td>
        </tr>
    </table>
</div>
<div id="buttondiv4" class="navtab_hight" style="width: 77px;z-index: 4;position: absolute;background-color: #9aafe5;display: none;opacity: 0.8;">
    <table style="width: 77px;border: 0px;">
        <tr>
            <td><div onmouseover="buttondiv4_a()" onclick="addbuttondiv4_a()" class="navtab_hight" style="width: 19px;background-color: red;"></div></td><td><div onmouseover="buttondiv4_b()"  onclick="addbuttondiv4_b()"  class="navtab_hight" style="width: 19px;background-color: yellow;"></div> </td> <td><div onmouseover="buttondiv4_c()"  onclick="addbuttondiv4_c()"  class="navtab_hight" style="width: 19px;background-color: blue;"></div></td><td><div onmouseover="buttondiv4_d()"  onclick="addbuttondiv4_d()"  class="navtab_hight" style="width: 19px;background-color: red;"></div></td>
        </tr>
    </table>
</div>
<!--显示当前序号-->
<div id="numdisplay"  style="padding-right:2px;padding-left:2px;text-align:right;min-width: 60px;height: 20px;font-size:13px;z-index: 5;position: absolute;background-color: #e3e3e3;display: block;color: #000000;">
    <span id="notenum">一&nbsp;1&nbsp;</span><span id="notetext"></span>
</div>

<hr id="rule_hr" style="z-index: 2;width:470px;height: 1px;background-color: black;position: absolute;">
<div id="finish_div" style="z-index: 6;width:470px;background-color: black;opacity: 0.7;position: absolute;"></div>
<!--显示选择添加的时候添加图片-->
<div id="add_pic_div_a" style="top: 880px;left: 660px;">
    <img id="add_pic_a"  src="/Public/img/picbegin_a.png">
</div>
<div id="add_pic_div_b">
    <img id="add_pic_b"  src="/Public/img/picbegin_b.png">
</div>
<div id="add_pic_div" onclick="addpiconesub()">
</div>

<div class="contain" style="width: 100%">
    <div class="row" style="height: 45px;"></div>
    <div class="row">
        <div class="col-xs-4" style="padding-left:45px;">
            <span style="font-size: 18px;"><b>试题分解*&nbsp;&nbsp;</b></span>|<span><b>&nbsp;&nbsp;试题修改</b></span>
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
                            <div style="color: #c0b9c8" class="admin_div_unchicked">
                                习题分解
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
    <div class="row" style="min-height: 26px;border: 1px solid #eaf0f2;text-align: center;font-size: 12px;padding-left: 20px;padding-right: 20px;padding-top: 4px;padding-bottom: 4px;overflow-x:scroll;overflow-y: hidden;white-space: nowrap;">
        <div id="initdiv" style="display:none;">
        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <span>习题序号级别：</span>
        <select id="titlechoose" onchange="mytesttitle()">
            <option value="0">未选择</option>
            <option value="1">一级</option>
            <option value="2">二级</option>
            <option value="3">三级</option>
            <option value="4">四级</option>
            <option value="5">五级</option>
        </select>
        <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
        <select id="no1" onchange="childselect(this.id)" >
            <option value="0">一级</option>
        </select>
        <select id="no2" onchange="childselect(this.id)">
            <option value="0">二级</option>
        </select>

        <select id="no3"  onchange="childselect(this.id)">
            <option value="0">三级</option>
        </select>

        <select id="no4"  onchange="childselect(this.id)">
            <option value="0">四级</option>
        </select>

        <select id="no5"  onchange="childselect(this.id)">
            <option value="0">五级</option>
        </select>

        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <!--<span>序号排序：</span>-->
        <!--<select id="mytitleser">-->
            <!--<option value='0'>未选择</option>-->
        <!--</select>-->
        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <span>序号独立：</span>
        <select id="title_aline">
            <option value='left'>左对齐</option>
            <option value='center'>居中对齐</option>
            <option value='right'>右对齐</option>
        </select>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>

        <!--<span>序号独立：</span>-->
        <!--<select id="display_test_kind">-->
            <!--<option value='1'>显示信息</option>-->
            <!--<option value='2'>隐藏信息</option>-->
        <!--</select>-->

            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input type="button"  style="width: 40px;height: 20px;" value="设定" onclick="resetdisplay()">
            <span>&nbsp;&nbsp;</span>
            <input type="button"  style="width: 40px;height: 20px;" value="返回">
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>|</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input type="button" onclick="savetitlemsg()"  style="width: 80px;height: 20px;" value="保存&下一步">
        </div>
        <div id="resetdiv" style="text-align: left;margin-left: 20px;">
            <span>&nbsp;&nbsp;设定标题：&nbsp;&nbsp;</span>
            <span id="new_no1">一级：<input id="set_no1" type="text"  style="width: 30px;height: 19px;" value="1"></span>
            <span id="new_no2">&nbsp;&nbsp;二级：<input   id="set_no2" type="text"  style="width: 30px;height: 19px;text-align: center;"  value="1"></span>
            <span id="new_no3">&nbsp;&nbsp;三级：<input  id="set_no3" type="text"  style="width: 30px;height: 19px;"  value="1"></span>
            <span id="new_no4">&nbsp;&nbsp;四级：<input  id="set_no4" type="text" style="width: 30px;height: 19px;"  value="1"></span>
            <span id="new_no5">&nbsp;&nbsp;五级：<input  id="set_no5" type="text" style="width: 30px;height: 19px;"  value="0"></span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input type="button"  style="width: 40px;height: 20px;" value="OK" onclick="resetnum()">

            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>|</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>橡皮擦：</span>
            <input type="text" style="width:30px;height: 17px;" value="10">
            <span>&times;</span>
            <input type="text"  style="width:30px;height:17px;"  value="10">
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input type="button"  style="width: 40px;height: 20px;" value="OK">
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>序号自增：</span>
            <input id="automsg" type="button" onclick="autosub()"  style="width: 60px;height: 20px;color: red;" value="Auto">
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input id="twofont" type="checkbox" value="1">双字符
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input type="button"  style="width: 40px;height: 20px;" onclick="finishdivdisplay()" value="取消">
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input type="button"  style="width: 40px;height: 20px;" onclick="initdisplay()" value="初始">
            <span>&nbsp;</span>
            <input type="button"  style="width: 40px;height: 20px;" value="返回">
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>|</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input type="button" onclick="savetitlemsg()"   style="width: 80px;height: 20px;" value="保存&下一步">
        </div>

    </div>
    <div class="row" style="height: 15px;"></div>
    <div class="row">
        <div class="col-xs-6" style="min-height: 700px;border-right: 1px solid #728090;background-color: #fcf9e2;">
            <div class="row">
                <div class="col-xs-2"></div>
                <div class="col-xs-8" style="background-color: #fcf9e2;min-height: 678px;padding-top: 30px;text-align: center;">
                    <div id="display_div" style="width: 470px;height: 660px; border: 1px solid #f9f9f8;background-color: #FFFFFF;padding-left: 10px;overflow-y: scroll;text-align: left;padding-top: 10px;">
                        <input type="text" style="text-align: center;" value="<?php echo ($title); ?>">
                        <hr style="margin-top: 8px;">



                        <?php if(is_array($imgdata)): $i = 0; $__LIST__ = $imgdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgid): $mod = ($i % 2 );++$i;?><ctb id="ctb<?php echo ($imgid[in_ser]); ?>" style="display: block"  name="<?php echo ($imgid[ctbname]); ?>" class="<?php echo ($imgid[tsernum]); ?>">
                            <input id="inputser<?php echo ($imgid[in_ser]); ?>" type="hidden" name="<?php echo ($imgid[tsernum]); ?>" >
                            <input id="input<?php echo ($imgid[in_ser]); ?>" ondblclick="notedisplaysub(this.id)" name="<?php echo ($timgid[inputname]); ?>" style="height: 24px;margin-bottom: 4px;text-align: <?php echo ($imgid[align]); ?>" type="text" name="<?php echo ($imgid[inputname]); ?>" value="<?php echo ($imgid[inputval]); ?>">
                                <div id="note<?php echo ($imgid[in_ser]); ?>"  style="text-align: center;width: 100%;height:25px;display: none;margin-bottom: 1px;">
                                    <input id="note_eraser<?php echo ($imgid[in_ser]); ?>" onclick="noteoperate(this.id)"  style="margin-left: 15px;font-size: 14px;height: 20px; width: 40px; background-color: #e8f1f2;" type="button" value="□">
                                    <input id="note_pic<?php echo ($imgid[in_ser]); ?>" onclick="noteoperate(this.id)"  style="margin-left: 15px;font-size: 14px;height: 20px; width: 40px; background-color: #e8f1f2;" type="button" value="+Pic">
                                    <input id="note_re<?php echo ($imgid[in_ser]); ?>" onclick="noteoperate(this.id)"  style="margin-left: 15px;font-size: 14px;height: 20px; width: 40px; background-color: #e8f1f2;" type="button" value="RE">
                                    <input id="note_down<?php echo ($imgid[in_ser]); ?>" onclick="noteoperate(this.id)"   style="margin-left: 15px;font-size: 14px;height: 20px; width: 40px; background-color: #e8f1f2;" type="button" value="+↓">
                                    <input id="note_up<?php echo ($imgid[in_ser]); ?>'" onclick="noteoperate(this.id)"  style="margin-left: 15px;font-size: 14px;height: 20px; width: 40px; background-color: #e8f1f2;" type="button" value="+↑">
                                    <input id="note_del<?php echo ($imgid[in_ser]); ?>" onclick="noteoperate(this.id)"  style="margin-left: 10px;font-size: 14px;height: 20px; width: 40px; background-color: #e8f1f2;" type="button" value="Del">
                                    <input  id="note_esc<?php echo ($imgid[in_ser]); ?>" onclick="noteoperate(this.id)"   style="margin-left: 10px;height: 20px;font-size: 14px; width: 50px;background-color: #e8f1f2;" value="Esc" type="button">
                                    <span id="notespan<?php echo ($imgid[in_ser]); ?>" style="font-size: 14px;margin-left: 10px;">&nbsp;&nbsp;P<?php echo ($imgid[pagenum]); ?></span>
                                </div>
                                <img id="img<?php echo ($imgid[in_ser]); ?>"  name="<?php echo ($timgid[inputname]); ?>"   src="<?php echo ($imgid[src]); ?>" onclick="notedisplaysub(this.id)" style="display: <?php echo ($imgid[imgdisplay]); ?>">
                            <input id="pic<?php echo ($imgid[in_ser]); ?>" type="hidden" value="1">
                                <?php echo ($imgid[html]); echo ($imgid[inputpic]); ?>


                            </ctb><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
                <div class="col-xs-2" style=" min-height: 700px;">
                </div>
            </div>
        </div>
        <div class="col-xs-6" style="min-height: 700px;background-color: #fcf9e2;">
            <div class="row">
                <div class="col-xs-2" style=" min-height: 700px;">
                    <div class="row" style="height: 130px;"></div>
                    <div class="row admin_test_img_thumb" style="height: 400px;overflow-y: scroll;text-align: center;margin-left: 0px;">
                        <?php if(is_array($tdata)): $i = 0; $__LIST__ = $tdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tid): $mod = ($i % 2 );++$i;?><img  id="timg<?php echo ++$timg;?>"  name="<?php echo ($tid[id]); ?>" onclick="tnowimgsub(this.id)"  src="<?php echo ($tid[src_pic]); ?>">
                            <input id="timg_x_ratio<?php echo ($timg); ?>" type="hidden" value="<?php echo ($tid[x_ratio]); ?>">
                            <input id="timg_y_ratio<?php echo ($timg); ?>" type="hidden" value="<?php echo ($tid[y_ratio]); ?>"><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <div class="row admin_note_css">习题：<span id="tnownum">1</span>/<span id="tsumnum"><?php echo ($timg); ?></span></div>
                </div>
                <div class="col-xs-10" style="background-color: #fcf9e2;min-height: 661px;padding-top: 30px;">
                    <div class="row" >
                        <img onclick="addbuttondiv1()"  id="choose_img"  style="width: 470px;height: 661px; border: 1px solid #f9f9f8;z-index: 1;" src="<?php echo ($tdata[0][src_pic]); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input id="preleveldiv" type="hidden" value="0">
<input id="nowleveldiv" type="hidden" value="0">
<input id="choose_y" type="hidden" value="0">
<input id="test1" type="hidden">
<input id="test2" type="hidden">
<!--//控制导航栏，选项单-->
<input id="no1val" type="hidden"  value="<?php echo ($no1); ?>">
<input id="no2val" type="hidden"  value="<?php echo ($no2); ?>">
<input id="no3val" type="hidden"  value="<?php echo ($no3); ?>">
<input id="no4val" type="hidden"  value="<?php echo ($no4); ?>">
<input id="no5val" type="hidden"  value="<?php echo ($no5); ?>">
<input id="nolevel" type="hidden" value="<?php echo ($nolevel); ?>">
<!--控制习题序号-->
<!--当前序号-->
<input id="num1" type="hidden" value="1">
<input id="num2" type="hidden" value="1">
<input id="num3" type="hidden" value="1">
<input id="num4" type="hidden" value="1">
<input id="num5" type="hidden" value="0">
<!--上一题序号-->
<input id="prenum1" type="hidden" value="0">
<input id="prenum2" type="hidden" value="0">
<input id="prenum3" type="hidden" value="0">
<input id="prenum4" type="hidden" value="0">
<input id="prenum5" type="hidden" value="0">
<!--当前标题序号-->
<input id="titlenum1" type="hidden">
<input id="titlenum2" type="hidden">
<input id="titlenum3" type="hidden">
<input id="titlenum4" type="hidden">
<input id="titlenum5" type="hidden">
<!--判断习题是否为开始-->
<input id="begin_or_not" type="hidden" value="0">
<input id="note_x" type="hidden" value="0">
<input id="note_y" type="hidden" value="0">
<!--分割线或者DIV-->
<input id="pre_div_y" type="hidden" value="0">
<input id="div_x" type="hidden" value="0">
<input id="div_y" type="hidden" value="0">
<input id="pre_hr_y" type="hidden" value="191">
<input id="hr_x" type="hidden" value="0">
<input id="hr_y" type="hidden" value="191">
<!--显示的标题-->
<input id="titlea" type="hidden" value="0">
<input id="titleb" type="hidden" value="0">
<!--显示图片src-->
<input id="imgsrc" type="hidden" value="0">
<!--最后序号ID的序号加1-->
<input id="testimgnum" type="hidden" value="<?php echo ($imgcount); ?>">
<!--上一个图片的src-->
<input id="preimgsrc" type="hidden" value="0">
<!--上一个数据类型，习题，习题和答案，答案，控制-->
<input id="prekind" type="hidden" value="begin">
<input id="preimgid" type="hidden" value="0">
<!--当前页数-->
<input id="nowpagemsg" type="hidden" value="1">
<input id="titleanswer" type="hidden" value="0">
<!--当前添加数据的类型及状态，0为不添加-->
<input id="addimgmsg" type="hidden" value="0">
<!--添加当前reimgsrc地址-->
<input id="reimgsrc" type="hidden" value="0">
<input id="reimgid" type="hidden" value="0">
<input id="reimgkind" type="hidden" value="0">
<!--当前选中的分解图片id-->
<input id="nownote" type="hidden" value="0">
<!--向上向下的依据ID-->
<input id="updownid" type="hidden" value="0">
<input id="updownkind" type="hidden" value="0">
<input id="updownser" type="hidden" value="0">
<!--<input id="test" type="text" value="0">-->
<!--添加配图参数-->
<input id="addpicid" type="hidden" value="0">
<input id="addpickind" type="hidden" value="0">
<input id="addpicx" type="hidden" value="0">
<input id="addpicy" type="hidden" value="0">

<!--图片导航-->
<input id="picnav" type="hidden" value="timg1">
<input id="filesernum" type="hidden" value="<?php echo ($filesernum); ?>">
<input id="kind" type="hidden" value="<?php echo ($kind); ?>">
<input id="oldstatus" type="hidden" value="<?php echo ($oldstatus); ?>">





</body>
<script type="text/javascript">
//初始化整体数据
$(function(){
        var x=$('#choose_img').offset().left;
        var y=$('#choose_img').offset().top;
        $('#hr_y').val(parseInt(y));
        $('#pre_hr_y').val(parseInt(y));
         inithr();
        newPos=new Object();
        newPos.left= x+16;
        newPos.top= y+parseInt($('#choose_y').val())-40;
        $('#up_div').offset(newPos);
        initnum($('#nolevel').val());
        initselect();
        navval($('#titlechoose').val());
        //提示框
        var x=$('#choose_img').offset().left-80;
        var y=$('#choose_img').offset().top+10;
        var msg=0;
        $('#note_x').val(x);
        $('#note_y').val(y);
        displaynotesub(1,x,y,msg);
        initfinishdiv();
        intresetdisplay();
        $('#timg1').css("border","1px solid #9b9ca3");
        new_nosub();
    $('#notetext').text('(T+A)');


        //标题独立的级别
    })
//初始化选框
function initselect() {
        var level=$('#nolevel').val();
        var no1=$('#no1val').val();
        var no2=$('#no2val').val();
        var no3=$('#no3val').val();
        var no4=$('#no4val').val();
        var no5=$('#no5val').val();

        bindselect(level);
        $('#titlechoose').val(level);
    ///当前级别
        var val=$('#titlechoose').val();
        testtitle();
        bindrule(val,no1,no2,no3,no4,no5);
    }
//绑定导航栏序号
function bindrule(val,no1val,no2val,no3val,no4val,no5val) {
        var val=parseInt(val);
        switch(val)
        {
            case 1:
                $('#no1').val(no1val);
                $('#msg_no3').text("No1"+titlekind($('#no1').val()));
                break;
            case 2:
                $('#no1').val(no1val);
                $('#no2').val(no2val);
                $('#msg_no1').text("No1"+titlekind($('#no1').val()));
                $('#msg_no3').text("No2"+titlekind($('#no2').val()));
                $("#level3_Div").css('border-left','1px solid #7e8cc9');
                break;
            case 3:
                $('#no1').val(no1val);
                $('#no2').val(no2val);
                $('#no3').val(no3val);
                $('#msg_no1').text("No1"+titlekind($('#no1').val()));
                $('#msg_no2').text("No2"+titlekind($('#no2').val()));
                $('#msg_no4').text("No3"+titlekind($('#no3').val()));
                $("#level2_Div").css('border-left','1px solid #7e8cc9');
                $("#level4_Div").css('border-left','1px solid #7e8cc9');
                break;
            case 4:
                $('#no1').val(no1val);
                $('#no2').val(no2val);
                $('#no3').val(no3val);
                $('#no4').val(no4val);
                $('#msg_no1').text("No1"+titlekind($('#no1').val()));
                $('#msg_no2').text("No2"+titlekind($('#no2').val()));
                $('#msg_no3').text("No3"+titlekind($('#no3').val()));
                $('#msg_no4').text("No4"+titlekind($('#no4').val()));
                $("#level2_Div").css('border-left','1px solid #7e8cc9');
                $("#level3_Div").css('border-left','1px solid #7e8cc9');
                $("#level4_Div").css('border-left','1px solid #7e8cc9');
                break;
            case 5:
                $('#no1').val(no1val);
                $('#no2').val(no2val);
                $('#no3').val(no3val);
                $('#no4').val(no4val);
                $('#no5').val(no5val);
                $('#msg_no1').text("No1"+titlekind($('#no1').val()));
                $('#msg_no2').text("No2"+titlekind($('#no2').val()));
                $('#msg_no3').text("No3"+titlekind($('#no3').val()));
                $('#msg_no4').text("No4"+titlekind($('#no4').val()));
                $('#msg_no5').text("No5"+titlekind($('#no5').val()));

                $("#level2_Div").css('border-left','1px solid #7e8cc9');
                $("#level3_Div").css('border-left','1px solid #7e8cc9');
                $("#level4_Div").css('border-left','1px solid #7e8cc9');
                $("#level5_Div").css('border-left','1px solid #7e8cc9');
                break;
        }

    }
// 导航栏选择匹配
function mytesttitle() {
        initnavdiv();
        testtitle();
//        $('#no1val').val('t14');
        var no1=$('#no1val').val();
        var no2=$('#no2val').val();
        var no3=$('#no3val').val();
        var no4=$('#no4val').val();
        var no5=$('#no5val').val();

        var val=$('#titlechoose').val();

        if(val==0){
            hiddennav();
            $('#up_div').css('display','none');
            bindrule(val,no1,no2,no3,no4,no5);
        }
        if(val==1)
        {
            hiddennav();
            initnum(1);
            $('#no1val').val('t14');
            var no1=$('#no1val').val();
            $('#up_div').css('display','');
            bindrule(val,no1,no2,no3,no4,no5);

        }
        if(val==2){
            hiddennav();
            initnum(2);
            $('#no1val').val('t12');
            var no1=$('#no1val').val();
            $('#no2val').val('t14');
            var no2=$('#no2val').val();
            $('#up_div').css('display','');
            bindrule(val,no1,no2,no3,no4,no5);

        }
        if(val==3)
        {
            hiddennav();
            initnum(3);
            $('#no1val').val('t12');
            var no1=$('#no1val').val();
            $('#no2val').val('t14');
            var no2=$('#no2val').val();
            $('#no3val').val('t16');
            var no3=$('#no3val').val();
            $('#up_div').css('display','');
            bindrule(val,no1,no2,no3,no4,no5);

        }
        if(val==4){
            hiddennav();
            initnum(4);
            $('#no1val').val('t5');
            var no1=$('#no1val').val();
            $('#no2val').val('t12');
            var no2=$('#no2val').val();
            $('#no3val').val('t14');
            var no3=$('#no3val').val();
            $('#no4val').val('t16');
            var no4=$('#no4val').val();
            $('#up_div').css('display','');
            bindrule(val,no1,no2,no3,no4,no5);

        }
        if(val==5)
        {
            hiddennav();
            initnum(5);
            $('#no1val').val('t1');
            var no1=$('#no1val').val();
            $('#no2val').val('t5');
            var no2=$('#no2val').val();
            $('#no3val').val('t12');
            var no3=$('#no3val').val();
            $('#no4val').val('t14');
            var no4=$('#no4val').val();
            $('#no5val').val('t16');
            var no5=$('#no5val').val();

            $('#up_div').css('display','');
            bindrule(val,no1,no2,no3,no4,no5);

        }
    navval($('#titlechoose').val());
    $('#nolevel').val(val);


   }
//窗口变动函数。
$(document).ready(function(){
        $(window).resize(function() {
            var x=$('#choose_img').offset().left;
            var y=$('#choose_img').offset().top;
            newPos=new Object();
            newPos.left= x+16;
            newPos.top= y+parseInt($('#choose_y').val())-40;
            $('#up_div').offset(newPos);

            //提示框
            var x=$('#choose_img').offset().left-60;
            var y=$('#choose_img').offset().top+10;
            var msg=0;
            $('#note_x').val(x);
            $('#note_y').val(y);
            displaynotesub(1,x,y,msg);
            hiddennav();
            if($('#reimgkind').val()!='pic'){
                finishdiv();
                rehrlocal($('#hr_y').val());
            }
            else{
                initfinishdiv();
            }
        });
    });
// 选择当前是试题，答案，试题+答案
function test_or_answersub() {
    switch ($('#test_or_answer').text())
    {
        case '(T+A)': $('#test_or_answer').text('(T)');break;
        case '(T)': $('#test_or_answer').text('(A)');break;
        case '(A)': $('#test_or_answer').text('(T+A)');break;
    }
}
//页面键盘事件
$(document).keydown(
function(e){
    if (e.which == 81) {
//控制剪切图片是习题，答案，还是习题+答案,Q
        $('#test_or_answer').text('(T+A)');
        $('#notetext').text('(T+A)');
   }
    if (e.which == 87) {
//控制剪切图片是习题，答案，还是习题+答案,W
        $('#test_or_answer').text('(T)');
        $('#notetext').text('(T)');
    }

    if (e.which == 69) {
//控制剪切图片是习题，答案，还是习题+答案,E
        $('#test_or_answer').text('(A)');
        $('#notetext').text('(A)');
    }

    if (e.which == 83) {
//控制剪切图片是习题，答案，还是习题+答案,S
        $('#test_or_answer').text('(T)');
        $('#notetext').text('*');
    }



});
//添加分解后的习题图片及信息
function addtest() {
    if($('#test_or_answer').text()=='(A)' && $('#prekind').val()=='t-a')
    {
        alert('没有题目T型数据，不能够插入A类型数据!');
        return;
    }
    if($('#test_or_answer').text()=='(A)' && $('#prekind').val()=='begin')
    {
        alert('没有题目T型数据，不能够插入A类型数据!');
        return;
    }
    var img_x=0;
    var img_y=0;
    var img_width=0;
    var img_height=0;
    var kind='test';
    var tsernum='0';
    var inputname='';
    var ctbname='';
    var in_ser=$('#testimgnum').val();
    var idnum=in_ser;
    var picsum=1;
    var align='left';
    var imgdisplay='block';
    var pagenum=$('#nowpagemsg').val();



    var e=window.event;
    var test_aline=$('#title_aline').val();
    var x=e.pageX;
    var y=e.pageY;
    $('#pre_hr_y').val($('#hr_y').val());
    $('#hr_y').val(y);
    var y1=$('#finish_div').height();
    finishdiv();
    var y2=$('#finish_div').height();
    var imgsrc;
    rightnumsub(y2);
    if($('#nowleveldiv').val()=='del'){
        return;
    }



    if($('#nowleveldiv').val()=='link'){
        if($('#prekind').val()=='begin')
        {
            alert('非法连接操作！！')
            return;
        }
        else
        {
            var sum=parseInt($('#testimgnum').val());
           var linknum=sum-1;

            var src1=$('#preimgsrc').val();
          
        //  alert(y1+','+y2);
          
          
            var src2=cutsqlsub(y1,y2);
          
          
  
       
            addcutsub(src1,src2);
          
            var newsrc=src1+'?'+timemsgsub();
            $("#img"+linknum).attr("src", newsrc);
            return;
//
        }
    }
    titlesernumsub($('#test_or_answer').text());
    if($('#test_or_answer').text()=='(T)'){


      
        var align=test_aline;
        var titlea=$('#titlea').val();
        var titleb=$('#titleb').val();
        var height=parseInt(y2)-parseInt(y1);
        tsernum=$('#titleanswer').val();
        inputname='title';
//新修改的
		if(titleb=='0')
		{
  			titleb='';
		}
      
        if($('#notetext').text()=='*')
        {
            imgdisplay='none';
            ctbname='t0';
            imgsrc='';
            titlesub(0,0,titlea,titleb,test_aline,'new');
        }
        else
        {
            imgsrc=cutsqlsub(y1,y2);
            if(imgsrc==0)
            {
                ctbname='t0';
                return;
            }
            else
            {
                ctbname='t1';
                titlesub(1,imgsrc,titlea,titleb,test_aline,'new');
            }
        }
    }
    if($('#test_or_answer').text()=='(A)'){
        imgsrc=cutsqlsub(y1,y2);


        tsernum=$('#titleanswer').val();
        inputname='answer';
        ctbname='a';

        if(imgsrc==0)
        {
            return;
        }
        else{
            var titlea=$('#titlea').val();
            var titleb=$('#titleb').val();
          if(titleb=='0')
          {
            titleb='';
          }

            answersub(titlea,titleb,imgsrc,'new');
        }
    }
    if($('#test_or_answer').text()=='(T+A)'){

        tsernum='0';
        inputname='titleanswer';
        ctbname='t-a';


        imgsrc=cutsqlsub(y1,y2);
        if(imgsrc==0)
        {
            return;
        }
        else
        {
            var titlea=$('#titlea').val();
            var titleb=$('#titleb').val();
          
          if(titleb=='0')
          {
            titleb='';
          }
          
            titleanswersub(titlea,titleb,imgsrc,'new');
        }
    }

    var inputval=$('#input'+idnum).val();
  
    var src=imgsrc;
    var filesernum=$('#filesernum').val();
  jsaddimgsql(src,kind,img_x,img_y,img_width,img_height,tsernum,inputname,ctbname,in_ser,kind,picsum,inputval,filesernum,align,imgdisplay,pagenum);
}
//添加额外分解后的习题图片及信息
function addnewtest(kind) {
    var e=window.event;
    var test_aline=$('#title_aline').val();
    var x=e.pageX;
    var y=e.pageY;
    $('#pre_hr_y').val($('#hr_y').val());
    $('#hr_y').val(y);
    var y1=$('#finish_div').height();
    finishdiv();
    var y2=$('#finish_div').height();
    var imgsrc;
    var num;
    var updown;
    var sum;
    var inputname='';
    var tsernum='0';
    var kind1='test';
    var ctbname='';
    var picsum=1;
    var imgdisplay='block';
    var align='left';
    var pagenum=$('#nowpagemsg').val();


    var idnum=$('#reimgid').val();
    idnum=idnum.replace(/[^0-9]/ig,"");
    var in_ser=idnum;
  
  

    if($('#nowleveldiv').val()=='del'){
        return;
    }

    if($('#nowleveldiv').val()=='link'){
        alert('非法连接操作！！')
        return;
    }

    titlesernumsub($('#test_or_answer').text());
  
    if($('#test_or_answer').text()=='(T)'){
      
      //alert(123432);
      var titlekind='';

        updown=$('#updownkind').val();
        num=$('#updownid').val();

        var nummsg=justnewpic(updown,'t',num);
        if(nummsg=='0')
        {
            alert('不能够插入T类型数据!!');
            initfinishdiv();
            return;
        }
        rightnumsub(y2);
        var titlea=$('#titlea').val();
        var titleb=$('#titleb').val();
        var height=parseInt(y2)-parseInt(y1);
        inputname='title';


        if($('#notetext').text()=='*')
        {  
          titlesub(0,0,titlea,titleb,test_aline,kind);
          ctbname='t0';
          imgsrc='';
          titlekind='titlenull';
          imgdisplay='none';
        
        }
        else
        {
            imgsrc=cutsqlsub(y1,y2);
            if(imgsrc==0)
            {
           
                ctbname='t0';
                return;
            }
            else
            {
                ctbname='t1';
                titlesub(1,imgsrc,titlea,titleb,test_aline,kind);
            }
        }


        sum=$('#testimgnum').val();
        addsernum(nummsg,sum,updown);



        initnotemsg(num);
        initnotemsg(parseInt(num)+1);
        initnotemsg(parseInt(num)-1);

        tsernum=$('#titleanswer').val();
      

    }
    if($('#test_or_answer').text()=='(A)'){

        updown=$('#updownkind').val();
        num=$('#updownid').val();
        var nummsg=justnewpic(updown,'a',num);


         tsernum=$('#updownser').val();


        if(nummsg=='0')
        {
            alert('不能够插入A类型数据!!');
            initfinishdiv();
            return;
        }

        inputname='answer';

        rightnumsub(y2);

        imgsrc=cutsqlsub(y1,y2);
        if(imgsrc==0)
        {
            return;
        }
        else{
            var titlea=$('#titlea').val();
            var titleb=$('#titleb').val();
            answersub(titlea,titleb,imgsrc,kind);
        }

        ctbname='a';

        sum=$('#testimgnum').val();
        addsernum(nummsg,sum,updown);

        initnotemsg(num);
        initnotemsg(parseInt(num)+1);
        initnotemsg(parseInt(num)-1);

       // tsernum=$('#updownser').val();
    }
    if($('#test_or_answer').text()=='(T+A)'){

        updown=$('#updownkind').val();
        num=$('#updownid').val();

        var nummsg=justnewpic(updown,'t-a',num);

        if(nummsg=='0')
        {
            alert('不能够插入A类型数据!!');
            initfinishdiv();
            return;
        }


        tsernum='0';
        inputname='titleanswer';
        ctbname='t-a';


        imgsrc=cutsqlsub(y1,y2);
        if(imgsrc==0)
        {
            return;
        }
        else
        {
            var titlea=$('#titlea').val();
            var titleb=$('#titleb').val();
            titleanswersub(titlea,titleb,imgsrc,kind);
        }

        sum=$('#testimgnum').val();
        addsernum(nummsg,sum,updown);
        initnotemsg(num);
        initnotemsg(parseInt(num)+1);
        initnotemsg(parseInt(num)-1);
    }
    var upordown=$('#updownkind').val();
    var inputval=$('#input'+idnum).val();
    var filesernum=$('#filesernum').val();
    if(upordown=='up')
    {
        idnum=parseInt(idnum)+1;
    }
    var nowid=$('#inputpic'+idnum).attr("name");
  
  //alert('inser_end:'+in_ser);
  
  //alert(imgsrc+','+kind1+','+'0,0,0,0'+','+tsernum+','+inputname+','+ctbname+','+in_ser+','+upordown+','+picsum+','+inputval+','+filesernum+','+align+','+imgdisplay+','+pagenum+','+nowid);
  
 jsaddnewimgsql(imgsrc,kind1,0,0,0,0,tsernum,inputname,ctbname,in_ser,upordown,picsum,inputval,filesernum,align,imgdisplay,pagenum,nowid);
}
function retest() {
    var e=window.event;
    var test_aline=$('#title_aline').val();
    var x=e.pageX;
    var y=e.pageY;

    var nowsrc=$('#reimgsrc').val();





    $('#pre_hr_y').val($('#hr_y').val());
    $('#hr_y').val(y);
    var y1=$('#finish_div').height();
    finishdiv();
    var y2=$('#finish_div').height();
    rightnumsub(y2);




    if($('#nowleveldiv').val()=='del'){
        return;
    }

    if($('#nowleveldiv').val()=='link'){
        nowsrc=nowsrc.replace('./uploads','/uploads');
        var src1=nowsrc;
        var src2=cutsqlsub(y1,y2);
        readdcutsub(src1,src2);
        var newsrc=src1+'?'+timemsgsub();

       $("#"+$('#reimgid').val()).attr("src", newsrc);
        return;

    }

    recutsqlsub(y1,y2,nowsrc);

    var num =$('#reimgid').val();

     num = num.replace(/[^0-9]/ig,"");

    initnotemsg(num);
}
function recutsqlsub(y1,y2,nowsrc) {
    var pagenum=$('#nowpagemsg').val();
    var ratio_x=$('#timg_x_ratio'+pagenum).val();
    var ratio_y=$('#timg_y_ratio'+pagenum).val();
    var y=y1*ratio_y;
    var height=parseInt(y2)-parseInt(y1);
    var imgsrc;
    height=height*ratio_y;
    var src=$('#choose_img')[0].src;
    var num = src.indexOf('uploads');
    var length = src.length;
    src = "./" + src.substr(num, length - num);
    $.ajax({
        url: "<?php echo U('recutandsql');?>",
        type: 'POST',
        async:false,
        data: {y: y, height: height,src:src,nowsrc:nowsrc},
        dataType: 'text',
        success: function (re) {
            $("#"+$('#reimgid').val()).attr("src", changfilesrc(nowsrc));
        }
    })
}
function cutsqlsub(y1,y2) {
    var pagenum=$('#nowpagemsg').val();
    var ratio_x=$('#timg_x_ratio'+pagenum).val();
    var ratio_y=$('#timg_y_ratio'+pagenum).val();
    var y=y1*ratio_y;
    //var y=y1*(4532/660);
    var height=parseInt(y2)-parseInt(y1);
    var imgsrc;
    height=height*ratio_y;
    //height=height*(4532/660);
    var src=$('#choose_img')[0].src;
    var num = src.indexOf('uploads');
    var length = src.length;
    src = "./" + src.substr(num, length - num);
  	y=y.toFixed(2);
  	height=height.toFixed(2);

    $.ajax({
        url: "<?php echo U('cutandsql');?>",
        type: 'POST',
        async:false,
        data: {y: y, height: height,src:src},
        dataType: 'text',
        success: function (re) {
            imgsrc=re;
        }
    })
    return imgsrc;
}
function cutrectangle(x,y,width,height) {
    var pagenum=$('#nowpagemsg').val();
    var ratio_x=$('#timg_x_ratio'+pagenum).val();
    var ratio_y=$('#timg_y_ratio'+pagenum).val();
    $('#timg_y_ratio'+pagenum).val();
    var x1=x*ratio_x;
    var y1=y*ratio_y;
    var width1=width*ratio_x;
    var height1=height*ratio_y;
    var src=$('#choose_img')[0].src;
    var num = src.indexOf('uploads');
    var length = src.length;
    src = "./" + src.substr(num, length - num);
    $.ajax({
        url: "<?php echo U('cutrectanglesql');?>",
        type: 'POST',
        async:false,
        data: {x:x1.toFixed(2),y: y1.toFixed(2),width:width1.toFixed(2),height: height1.toFixed(2),src:src},
        dataType: 'text',
        success: function (re) {
            imgsrc=re;
        }
    })
    return imgsrc;
}
function addcutsub(src1,src2){
    var num1 = src1.indexOf('uploads');
    var length1 = src1.length;
    src1 = "./" + src1.substr(num1, length1 - num1);

    var num2 = src2.indexOf('uploads');
    var length2 = src2.length;
    src2 = "./" + src2.substr(num2, length2 - num2);
  
    $.ajax({
        url: "<?php echo U('addcutimg');?>",
        type: 'POST',
        async:false,
        data: {src1:src1,src2:src2},
        dataType: 'text',
        success: function (re) {
          
       

        }
    })
}



//编辑状态下的连接添加图片
function readdcutsub(src1,src2){
    var num1 = src1.indexOf('uploads');
    var length1 = src1.length;
    src1 = "./" + src1.substr(num1, length1 - num1);

    var num2 = src2.indexOf('uploads');
    var length2 = src2.length;
    src2 = "./" + src2.substr(num2, length2 - num2);
  

    $.ajax({
        url: "<?php echo U('addcutimg');?>",
        type: 'POST',
        async:false,
        data: {src1:src1,src2:src2},
        dataType: 'text',
        success: function (re) {
            if(re==1){
//                $('#'+$('#preimgid').val())[0].src=$('#preimgsrc').val()+'?'+timemsgsub();
            }
        }
    })
}
//添加图片函数
function addpiconesub(){
    var x;
    var y;
    var width;
    var height;

    var x1=$('#choose_img').offset().left;
    var y1=$('#choose_img').offset().top;

    var x2=$('#add_pic_div').offset().left;
    var y2=$('#add_pic_div').offset().top;


    x=x2-x1;
    y=y2-y1;

    if(x<0 || y<0){
        alert('剪切数据不合法！！');
        $('#add_pic_div').css('display','none');
        $('#add_pic_div_b').css('display','none');
        $('#addpickind').val('none');
        return;
    }


    var id=$('#nownote').val();
    var num=id.replace(/[^0-9]/ig,"");

    var inputpicid='#inputpic'+num;

//    alert(inputpicid);
//    alert($(inputpicid).val());

    if($(inputpicid).val()==5)
    {
        alert('已经达到最大配图!!')
        $('#add_pic_div').css('display','none');
        $('#add_pic_div_b').css('display','none');
        $('#addpickind').val('none');
        return;
    }

    var width=$('#add_pic_div').width();
    var height=$('#add_pic_div').height();
    var picsrc=cutrectangle(x,y,width,height);



    addpicmsgsub(num,picsrc);

    $('#add_pic_div').css('display','none');
    $('#add_pic_div_b').css('display','none');
    $('#addpickind').val('none');

    var testid=$('#inputpic'+num).attr('name');
    var src=picsrc;

    var picsum=$(inputpicid).val();
    jsaddpicsql(src,testid,picsum);

    }
//当前图片模式
function tnowimgsub(id){
    var nowimg=$('#picnav').val();
    $('#' + nowimg).css("border", "");
    $('#' + id).css("border", "1px solid #9b9ca3");
    $('#picnav').val(id);
    $('#choose_img').attr('src',$('#'+id)[0].src);
    var num=id.replace(/[^0-9]/ig,"");
    $('#tnownum').text(num);
    $('#nowpagemsg').val(num);
    inithr();
    initfinishdiv();

    newpagenote();



}

//翻页后提示栏位置

function newpagenote()
{
    var x=$('#choose_img').offset().left-80;
    var y=$('#choose_img').offset().top+10;

    newPos=new Object();
    newPos.left= x-30;
    newPos.top= y+10;
    $('#numdisplay').offset(newPos);

}
//添加img图片地址
function jsaddimgsql(src,kind,img_x,img_y,img_width,img_height,tsernum,inputname,ctbname,in_ser,kind,picsum,inputval,filesernum,align,imgdisplay,pagenum){
    $.ajax({
        url: "<?php echo U('addimgsql');?>",
        type: 'POST',
        async:false,
        data: {src:src,kind:kind,img_x:img_x,img_y:img_y,img_width:img_width,img_height:img_height,tsernum:tsernum,inputname:inputname,ctbname:ctbname,in_ser:in_ser,kind:kind,picsum:picsum,pic1:'',pic2:'',pic3:'',pic4:'',inputval:inputval,filesernum:filesernum,align:align,imgdisplay:imgdisplay,pagenum:pagenum},
        dataType: 'text',
        success: function (re) {
            if(re!=0){
                $('#inputpic'+in_ser).attr('name',re);
            }
        }
    })
}
//添加配图pic图片地址
function jsaddpicsql(src,testid,picsum){
     $.ajax({
         url: "<?php echo U('addpicsql');?>",
         type: 'POST',
         async:false,
         data: {src:src,testid:testid,picsum:picsum},
         dataType: 'text',
         success: function (re) {

         }
     })
 }
 //删除数据库中数据
function delsqldata(id,kind,leng) {
     $.ajax({
         url: "<?php echo U('phpdelsqldata');?>",
         type: 'POST',
         async:false,
         data: {id:id,kind:kind,leng:leng},
         dataType: 'text',
         success: function (re) {
          //alert(re);
         }
     })
 }
 //上下左右进行移动
function movedata(id,num1,num2){
    $.ajax({
        url: "<?php echo U('movedatasql');?>",
        type: 'POST',
        async:false,
        data: {id:id,num1:num1,num2:num2},
        dataType: 'text',
        success: function (re) {
               // alert(re);
        }
    })
}
//添加额外img图片地址
function jsaddnewimgsql(src,kind,img_x,img_y,img_width,img_height,tsernum,inputname,ctbname,in_ser,upordown,picsum,inputval,filesernum,align,imgdisplay,pagenum,nowid){
    $.ajax({
        url: "<?php echo U('addnewimgsql');?>",
        type: 'POST',
        async:false,
        data: {src:src,kind:kind,img_x:img_x,img_y:img_y,img_width:img_width,img_height:img_height,tsernum:tsernum,inputname:inputname,ctbname:ctbname,in_ser:in_ser,upordown:upordown,picsum:picsum,pic1:'',pic2:'',pic3:'',pic4:'',inputval:inputval,filesernum:filesernum,align:align,imgdisplay:imgdisplay,pagenum:pagenum,nowid:nowid},
        dataType: 'text',
        success: function (re) {
          
     //     alert(re);
            if(re!=0){
                //alert(re);
            }
        }
    })

}

//选区撤销
function finishdivdisplay(){
$('#finish_div').css('height',0);

}

//设定标题序号
function new_nosub()
{
    $('#new_no1').css('display','none');
    $('#new_no2').css('display','none');
    $('#new_no3').css('display','none');
    $('#new_no4').css('display','none');
    $('#new_no5').css('display','none');

    var kind=$('#nolevel').val();
    if(kind==1)
    {
        $('#new_no1').css('display','');
    }
    if(kind==2)
    {
        $('#new_no1').css('display','');
        $('#new_no2').css('display','');
    }
    if(kind==3)
    {
        $('#new_no1').css('display','');
        $('#new_no2').css('display','');
        $('#new_no3').css('display','');
    }
    if(kind==4)
    {
        $('#new_no1').css('display','');
        $('#new_no2').css('display','');
        $('#new_no3').css('display','');
        $('#new_no4').css('display','');
    }
    if(kind==5)
    {
        $('#new_no1').css('display','');
        $('#new_no2').css('display','');
        $('#new_no3').css('display','');
        $('#new_no4').css('display','');
        $('#new_no5').css('display','');
    }
}

//保存文本框中筛选的问题
     function savetitlemsg(){
         var sum=parseInt($('#testimgnum').val());
         var arrid='',arrtitle='';
         for(var i=1;i<sum;i++)
         {
             if(i==1)
             {
                 arrtitle=$('#input'+1).val();
                 arrid=$('#inputpic'+1).attr('name');
             }
             else
             {
                 arrtitle=arrtitle+","+$('#input'+i).val();
                 arrid=arrid+","+$('#inputpic'+i).attr('name');
             }

         }
         var filesernum=$('#filesernum').val();

         $.ajax({
             url: "<?php echo U('titledatasql');?>",
             type: 'POST',
             async:false,
             data: {arrid:arrid,arrtitle:arrtitle,sum:sum},
             dataType: 'text',
             success: function (re) {
                // window.location.href='<?php echo U("testpanel/answer_del04");?>?filesernum='+ filesernum;
                 window.location.href='/index.php/Home/testpanel/answer_del04/filesernum/'+ filesernum+'/kind/'+$('#kind').val()+'/oldstatus/'+$('#oldstatus').val();
             }
         })


     }


</script>
</html>