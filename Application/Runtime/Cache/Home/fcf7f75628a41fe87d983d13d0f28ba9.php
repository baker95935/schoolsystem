<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css" href="/Public/css/buildpage.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/css/pageword.css"/>

    <script src="/Public/js/buildpage.js"></script>
    <script src="/Public/js/titlenum.js"></script>
    <script src="/Public/js/public.js"></script>
    <script src="/Public/jquery/jquery.min.js"></script>
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>

    <style type="text/css">
        input[type="checkbox"]:checked+label {color: #ffffff;}
        input[type="checkbox"][name="banner"]:checked+label {color: #000000;}
        input[type="checkbox"][name="bannerquestion"]:checked+label {color:#6171e2;}
        input[type="checkbox"] {
            position: absolute;
            clip: rect(0, 0, 0, 0);
        }
        input[type="checkbox"]+label{margin-left: 20px;color:#7b7a7a;font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana," sans-serif";font-weight:lighter;}

        input[type="radio"]:checked+label {color: #ffffff;}
        input[type="radio"][name="bannerradio"]:checked+label {color: blue;}
        input[type="radio"] {
            position: absolute;
            clip: rect(0, 0, 0, 0);
        }
        input[type="radio"]+label{margin-left: 20px;color:#7b7a7a;font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana," sans-serif";font-weight:lighter;}
    </style>
</head>
<body >
<div id="preview" onclick="closepriviewimg()" style="width: 690px;;height: 320px;top:260px;left:736px;position: absolute;background-color: #2b542c;z-index:2;padding-top: 20px;padding-left: 5px;display: none;">
</div>

<div id="panel_div" style="display:none;width: 100px;height: 72px;background-color:#f0f0f0;position: absolute;z-index:3;border-radius:4px;text-align: center;left:1200px;top:528px;">
    <div   id="panel1" name="paneldiv" onmouseover="panneloversub(this.id)" onmouseout="panneloutsub(this.id)" onclick="preele()" class="panel_css" style="width:100%;height: 24px; border-top-left-radius: 4px;border-top-right-radius: 4px;">上移</div>
    <div  id="panel2" name="paneldiv" onmouseover="panneloversub(this.id)" onmouseout="panneloutsub(this.id)" onclick="nextele()" class="panel_css"  style="width:100%;height: 24px;border-bottom:solid 1px #000000;border-top:solid 1px #e3e3e3;">下移</div>
    <div  id="panel3" name="paneldiv" onmouseover="panneloversub(this.id)" onmouseout="panneloutsub(this.id)" onclick="delsub()" class="panel_css"  style="width:100%;height: 24px;border-bottom-left-radius: 4px;border-bottom-right-radius: 4px;">删除</div>
</div>

<div class="container" style="width: 100%;">
    <div class="row" style="height: 63px;text-align: left;vertical-align: top;">
        <div class="col-xs-3">
            <img src="/Public/img/tests_document.png" style="width: 25px;height:30px;margin-left: 50px;margin-top:14px;">
            <span style="margin-top: -31px;margin-left:90px;display:block;">好助教组卷系统</span>
            <span style="margin-left:100px;display:block;font-size: 9px;color: #8c8c8c;margin-top: 2px;">2019-07-11 18:32</span>
        </div>
        <div class="col-xs-9" style="padding-top: 22px;padding-left: 80px;">
            <input type="hidden"  value="OK" onclick="repagesub()">
            <input id="banner_1" type="checkbox" checked="checked" name="banner" value="1"><label for="banner_1">班级</label>
            <input id="banner_2" type="checkbox" checked="checked" name="banner" value="2"><label for="banner_2">群组</label>
            <input id="banner_3" type="checkbox" checked="checked" name="banner" value="3"><label for="banner_3">答题时间</label>
            <input id="banner_4" type="checkbox" checked="checked" name="banner" value="4"><label for="banner_4">数量</label>
            <input id="banner_5" type="checkbox" name="banner" value="5"><label for="banner_5">考试日期</label>
            <input id="banner_6" type="checkbox" name="banner" value="6"><label for="banner_6">难度</label>
            <input id="banner_7" type="checkbox" name="banner" value="7"><label for="banner_7">类型</label>

            <span>&nbsp;&nbsp;&nbsp;&nbsp;|</span>
            <input id="banner_12" type="checkbox" name="bannerquestion" value="1"><label for="banner_12">预览</label>
            <input id="banner_8" checked="checked" type="checkbox" name="bannerquestion" onclick="onequestionscore()" value="1"><label for="banner_8">单题分数</label>
            <input id="banner_9" type="checkbox" name="bannerquestion" onclick="repagesub()" value="1"><label for="banner_9">分页</label>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;|</span>
            <input id="banner_10" checked="checked" type="radio" name="bannerradio" value="question"><label for="banner_10">习题</label>
            <input id="banner_11" type="radio" name="bannerradio" onclick="nowscoresub02()" value="answer"><label for="banner_11">答案</label>
            <a  href="javascript:void(0)" onclick="testsavesub()" style="margin-left: 35px;">保存</a><a  href="javascript:void(0)" onclick="testlist()" style="margin-left: 35px;">列表</a><a href="<?php echo U('index');?>"  style="margin-left: 30px;">注销</a>
        </div>
        <input type="hidden" value="" id="pagesizenum">
        <input type="hidden" value="993" id="pagesizesum">
    </div>
    <div class="row" style="border-top:1px solid #d7d7d7;color: white;">
        <div  class="col-xs-3" style="height: 810px;background-color: #1c2127;float:left;">
            <div class="row" style="padding-left: 15px;">
                <img style="width: 50px;height: 55px;margin-top: 20px;" src="/Public/img/bulidtitle.png">

            <span style="font-size:16px;font-family: 微软雅黑;color: white;display: block;margin-left: 60px;margin-top: -51px;">试卷基本信息设定</span>
            <span style="font-size:45px;color:#00d576;display: block;margin-left: 58px;margin-top: -20px;">•</span><span style="font-size:12px;display: block;color:#a9b49e;margin-top: -39px;margin-left: 80px;">品质带来未来</span>
            </div>
            <div class="row">
                <span style="display: block;margin-top: 17px;margin-left: 15px;">组卷设定流程</span>
            </div>
            <div class="row">
                <uL style="margin-left: -22px;margin-top: 10px;text-align: center;font-size: 16px;">
                    <li id="li_msg"  style="padding-top:15px;list-style-type:none;float:left;width: 28%;height: 68px;display: block;background-color: #373c42;border-bottom:1px solid #FFFFFF;">
                        <a href="javascript:void(0)"  style="color: #ffffff;text-decoration:none;" onclick="bannersub('msg')">
                        <span>1.信息</span>
                        <span style="display:block;font-size: 11px;color: #babac7;">Message</span>
                        </a>
                    </li>
                    <li  id="li_structure"  style="padding-top:15px;list-style-type:none;float:left;margin-left:5%;width: 28%;height: 68px;display: block;background-color: #373c42;">
                        <a href="javascript:void(0)"  style="color: #ffffff;text-decoration:none;"  onclick="bannersub('structure')">
                        <span>2.结构</span>
                        <span style="display:block;font-size: 11px;color: #babac7;">Structure</span>
                        </a>
                    </li>
                    <li id="li_bank"  style="padding-top:15px;list-style-type:none;float:left;margin-left:5%;width: 28%;height: 68px;display: block;background-color: #373c42;">
                        <a href="javascript:void(0)" style="color: #ffffff;text-decoration:none;"  onclick="bannersub('bank')">
                        <span>3.题库</span>
                        <span style="display:block;font-size: 11px;color: #babac7;">MyBank</span>
                        </a>
                    </li>
                </uL>
            </div>
            <div class="row contentdiv" style="margin-top:15px;background-color:#1c2127;height: 582px;overflow-y: auto;overflow-x:hidden;">
                <ctb id="msg" >
                    <div class="row" style="padding-left: 15px;padding-right: 17px;">
                        <div class="col-xs-6">
                            <input id="testtitle" type="text" onchange="notemsg()" style="text-align: center;padding-left: 0px;" value="" placeholder="试卷标题！！">
                        </div>
                        <div class="col-xs-6">
                            <input type="text" id="testdate" onchange="notemsg()" style="text-align: center;font-size: 11px;padding-left: 0px;"  value="" placeholder="考试日期：2018-09-20">
                        </div>
                    </div>

                    <div class="row" style="padding-left: 15px;padding-right: 17px;">
                        <div class="col-xs-6">
                            <input type="text" id="testsumpre" onchange="notemsg()" style="text-align: center;padding-left: 0px;" value="" placeholder="试题数量！！">
                        </div>
                        <div class="col-xs-6">
                            <input type="text" id="testtime"  onchange="notemsg()" style="text-align: center;font-size: 11px;padding-left: 0px;" onchange="justsub('testtime')"  value="" placeholder="答题时间（小时）：1.5">
                        </div>
                    </div>


                    <div class="row" style="padding-left: 15px;padding-right: 17px;">
                        <div class="col-xs-6">
                            <select id="subjectid" onchange="subjectchangesub()">
                                <option>请选择学科</option>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <select id="testkindid">
                                <option value="1000">请选择考试类型</option>
                                <option value="1">课后测试</option>
                                <option value="2">章节考试</option>
                                <option value="3">每月考试</option>
                                <option value="4">期中考试</option>
                                <option value="5">期末考试</option>
                                <option value="6">综合考试</option>
                                <option value="7">其他考试</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-xs-12">
                        <div id="testgradeid" class="sysset_msgli" style="height: 40px;margin-right:3px;background-color: #363c42;margin-top: 5px;padding-top:10px;overflow-y:auto;clear: left;">
                            <span style="margin-left: 20px;">请选择年级</span>
                        </div>
                    </div>

                    <div class="col-xs-12" >
                        <div id="testchapterid" style="margin-right:2px;height: 90px;background-color: #363c42;margin-top: 5px;padding-top:10px;overflow-y:auto;">

                            <span style="margin-left: 20px;">请选择章节</span>
                        </div>

                    </div>

                    <div class="col-xs-12" >
                        <div id="testkeynoteid" style="margin-right:2px;height: 120px;background-color: #363c42;margin-top: 5px;padding-top:10px;overflow-y:auto;">

                            <span style="margin-left: 20px;">请选择知识点</span>
                        </div>

                    </div>

                <div class="col-xs-12" >
                    <select id="testlevel" onchange="notemsg()">
                        <option  value="0">请选择难度</option>
                        <option  value="1">A</option>
                        <option  value="2">B</option>
                        <option  value="3">C</option>
                    </select>
                </div>
                <div class="col-xs-12" >
                    <div id="classid" class="sysset_msgli" style="margin-right:3px;height: 40px;background-color: #363c42;margin-top: 5px;padding-top:10px;overflow-y:auto;clear: left;">
                        <span style="margin-left: 20px;">班级：</span>
                    </div>
                </div>
                <div class="col-xs-12" >
                    <div id="groupid" class="sysset_msgli" style="margin-right:3px;height: 40px;background-color: #363c42;margin-top: 5px;padding-top:10px;overflow-y:auto;clear: left;">
                        <span style="margin-left: 20px;">班级：</span>
                    </div>
                </div>
                <div class="col-xs-12" >
                    <input id="other_note" type="text" value="" placeholder="其他备注说明">
                </div>
                <div class="col-xs-12" style="margin-top: 20px;padding-left: 20px;">
                    <span>选择已有模版</span><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><a style="color: #5b83ff;">点击</a>
                </div>
                    <div class="row"style="height: 10px;"></div>
                </ctb>


                <ctb id="structure" style="display: none;">
                    <div class="col-xs-12" style="margin-bottom: 30px;">
                        <input name="testnote" style="text-align: left;"  type="text"  value="">
                    </div>
                    <div class="col-xs-12" >

                        <select id="titlelevel" readonly="readonly">
                            <!--<option value="1000">请选择标题级别</option>-->
                            <!--<option value="1">一级</option>-->
                            <option value="2">二级</option>
                        </select>
                    </div>


                    <div id="questiondiv2" class="row questiontype_class_padding_left" >
                        <div class="col-xs-8">
                            <select name="questiontype" id="questiontype2" onchange="questiontypechange(this.id)"></select>
                        </div>
                        <div class="col-xs-4" name="questionnum" id="questionnum2">
                            <input id="testsum2" autocomplete="off" type="text" name='testsum' class="questiontype_class_padding_left_input" value="" placeholder="题数(100)" onchange="testSum(this.id)">
                        </div>
                    </div>

                    <div class="col-xs-12" style="margin-top: 20px;padding-left: 20px;">
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <a style="color: #5b83ff;">上一步</a> <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><a style="color: #5b83ff;">下一步</a>
                    </div>
                    <div class="col-xs-12" style="margin-top: 20px;padding-left: 20px;">
                    <span>  </span>
                    </div>
                </ctb>

                <ctb id="bank" style="display: none;">
                    <!--<div class="col-xs-12" style="margin-bottom: 15px;">-->
                        <!--&lt;!&ndash;<input name="testnote"  style="text-align: left;" type="text"  value="1212">&ndash;&gt;-->
                        <!--<select id="hastitlelevel">-->
                            <!--<option value="1000">请选择标题</option>-->
                        <!--</select>-->
                    <!--</div>-->



                    <!--<div class="row">-->
                        <!--<div style="width: 85%;margin-left: 8%;">-->
                            <!--<select  id="testkindid03">-->
                                <!--<option value="0">全部考试</option>-->
                                <!--<option value="1">课后测试</option>-->
                                <!--<option value="2">章节考试</option>-->
                                <!--<option value="3">每月考试</option>-->
                                <!--<option value="4">期中考试</option>-->
                                <!--<option value="5">期末考试</option>-->
                                <!--<option value="6">综合考试</option>-->
                                <!--<option value="7">其他考试</option>-->
                            <!--</select>-->
                        <!--</div>-->

                    <!--</div>-->

                    <div class="row" style="padding-left: 15px;">
                        <div class="col-xs-6">
                            <select id="hastitlelevel">
                                <option value="1000">请选择标题</option>
                            </select>
                        </div>

                        <div class="col-xs-6">
                            <select  id="testkindid03" style="margin-left: -13px;">
                                <option value="0">全部考试</option>
                                <option value="1">课后测试</option>
                                <option value="2">章节考试</option>
                                <option value="3">每月考试</option>
                                <option value="4">期中考试</option>
                                <option value="5">期末考试</option>
                                <option value="6">综合考试</option>
                                <option value="7">其他考试</option>
                            </select>
                        </div>
                    </div>


                    <div class="row" style="padding-left: 15px;">
                        <div class="col-xs-6">
                                <input id="begintime" style="text-align: left;" type="text"   placeholder="开始时间:2018-09-20">
                        </div>

                        <div class="col-xs-6">
                                <input id="endtime" style="text-align: left;margin-left: -15px;" type="text"  placeholder="结束时间:2018-09-30">
                        </div>
                    </div>

                        <div class="col-xs-12">
                            <input id="keyword" type="text" value="" placeholder=" 试卷关键词">
                        </div>



                        <div class="col-xs-12"  style="padding-right: 17px;">
                            <div id="gradeid" class="sysset_msgli" style="height: 40px;background-color: #363c42;margin-top: 5px;padding-top:10px;overflow-y:auto;clear: left;">
                                <span style="margin-left: 20px;">请选择年级</span>
                            </div>

                        </div>
                 <div class="row">
                    <div class="col-xs-12" >
                        <div id="chapterid" style="margin-left:17px;margin-right:17px;height: 120px;background-color: #363c42;margin-top: 5px;padding-top:10px;overflow-y:auto;">

                        </div>
                    </div>
                </div>
                    <div class="row" style="padding-left: 15px;margin-top: 20px;">
                        <div class="col-xs-12">
                            <input id="searchbutton"  style="text-align: left;width:95%;text-align: center;" type="button" onclick="findtest()" value="试卷索引">
                        </div>
                    </div>

                    <div class="row" style="padding-left: 15px;margin-top: 20px;">
                        <div id="myclass03" class="col-xs-8">
                        </div>
                        <div class="col-xs-4">
                            <select  id="mygroup03" onclick="searchtestidtitlebind(0)"  style="width: 40px;font-size: 14px;height: 18px;margin-top: -2px;padding-left: 8px;">
                                <option value="1">G1</option>
                                <option value="2">G2</option>
                                <option value="3">G3</option>
                                <option value="5">ALL</option>
                            </select>

                        </div>
                        <div class="col-xs-6">
                            <input id="no1ration"  style="text-align: left;" type="text" value=""  placeholder="错题率(%):0">
                        </div>

                        <div class="col-xs-6">
                            <input id="no2ration"  style="text-align: left;margin-left: -15px;" type="text"  value=""  placeholder="错题率(%):100">
                        </div>
                    </div>

                    <div class="row" style="padding-left: 15px;">
                        <div class="col-xs-6">
                            <input id="no1testtime"  style="text-align: left;" type="text" value=""  placeholder="考过:1次">
                        </div>

                        <div class="col-xs-6">
                            <input id="no2testtime"  style="text-align: left;margin-left: -15px;" type="text" value=""  placeholder="考过：2次">
                        </div>
                    </div>

                    <div class="row" style="padding-left: 15px;margin-top: 20px;">
                        <div class="col-xs-12">
                            <input id="searchquestionbutton" onclick="searchtestidtitlebind(0)"  style="text-align: left;width:95%;text-align: center;" type="button"  value="习题索引">
                        </div>
                    </div>

                </ctb>

            </div>

        </div>
        <div class="col-xs-9"   style="height: 810px;">
            <div class="row">
                <div class="col-xs-4" style="height: 810px;background-color: #ecedf0;overflow-y: auto;" >
                    <div class="row" style="background-color: #f4f4f4;height: 40px;color: #777777;">
                        <div class="col-xs-6">
                            <select id="questionorder"  onchange="searchtestidtitlebind(0)" class="whiteselect">
                                <option value="0">随机排序</option>
                                <option value="1">错题率升序</option>
                                <option value="2">错题率降序</option>
                                <option value="3">考试次数升序</option>
                                <option value="4">考试次数降序</option>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <a href="javascript:void(0)" onclick="notemsgsub()">
                            <div style="width: 23px;height: 23px;background-color: #fdfdfd;color: #b5b5b5;border: 2px solid #e0e0e0;margin-left: 75%;margin-top: 8px;">
                                <span style="display: block;font-size: 26px;margin-left:5px;margin-top: -11px;">-</span>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-1"></div>
                        <div id="detaillistid" class="col-xs-10" style="color: #000000;">
                        </div>
                        <div class="col-xs-1"></div>
                    </div>
                </div>
                <div class="col-xs-8" style="height: 810px;overflow-y: auto;">
                    <div class="row">
                        <div id="test_img_id" class="col-xs-12 test_img_id_css ctb_header" style="overflow-y: auto;">
                            <div id="question1" mysernum="0" height1="54" height2="54" class="row h3 0 0" name="mytest"><div id="ctb_h1">试卷标题</div><div id="questionmsg1" name="testmsg"></div></div>
                            <div id="question2" mysernum="0" height1="32" height2="32"  class="row h6 0 0"  style="float: left;" name="mytest"><div id="ctb_h2"> 试卷相关信息</div><div id="questionmsg2" name="testmsg"></div></div>

                        </div>
                        <div id="answer_img_id" class="col-xs-12 test_img_id_css ctb_header" style="overflow-y: auto;display: none;padding-left: 50px;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="middiv" ></div>
<div id="rule"></div>

<input type="hidden" id="userid" value="<?php echo ($userid); ?>">
<input type="hidden" id="checkgradeid" value="">
<input type="hidden" id="checkchapterid" value="">
<input type="hidden" id="checktestchapterid" value="">
<input type="hidden" id="nowquestion" value="2">
<input type="hidden" id="questionidarr" value="1000">
<input type="hidden" id="questionsubjectid" value="0">
<input type="hidden" id="testsumid" value="0">
<input type="hidden" id="checktestgradeid" value="">
<input type="hidden" id="chapterchoose" value="0">
<input type="hidden" id="notemsg" value="0">
<input type="hidden" id="lastquestionid" value="2">
<input type="hidden"  id="img_ratio" value="0.266">
<input type="hidden"  id="answer_img_ratio" value="0.4">
<input type="hidden" id="questionsum" value="0">
<input type="hidden" id="questionscore" value="0">
<input type="hidden" id="nowele" value="0">
<input type="hidden" id="tsernum"  value="0">
<input type="hidden" id="tsernum_color" value="blue">
<input type="hidden" id="newquestionsum" value="0">

<input type="hidden" id="del_src">
<input type="hidden" id="del_kind">
<input type="hidden" id="del_sernum">
<input type="hidden" id="del_pare_id">
<input type="hidden" id="filesernum"value="123">
<input type="hidden" id="prequestionscore">
<input type="hidden" id="preserquestionscore">
<input type="hidden" id="nowpage_x" value="">
<input type="hidden" id="pagenum_x" value="">
<input type="hidden" id="pagelength" value="5">
<input type="hidden" id="nowtypeid" value="">

</body>

<script>
    $(function(){
        gradelevel();
        subjectsub();
        classsub();
        groupsub();
        questiontypesub();
        detaillistsub();
    })
//导航栏切换
    function bannersub(kind)
    {
        $('#msg').css('display','none');
        $('#structure').css('display','none');
        $('#bank').css('display','none');

        $('#li_msg').css('border-bottom','0px solid #FFFFFF');
        $('#li_structure').css('border-bottom','0px solid #FFFFFF');
        $('#li_bank').css('border-bottom','0px solid #FFFFFF');


        if(kind=='msg')
        {
            $('#msg').css('display','');
            $('#li_msg').css('border-bottom','1px solid #FFFFFF');
        }
        if(kind=='structure')
        {
            $('#structure').css('display','');
            $('#li_structure').css('border-bottom','1px solid #FFFFFF');

        }
        if(kind=='bank')
        {
            $('#bank').css('display','');
            $('#li_bank').css('border-bottom','1px solid #FFFFFF');
        }
    }
//判断答题时间
    function justsub(kind){


        if(kind=='testtime')
        {
            var num=$('#testtime').val();
            num=num.replace(/[^\d.]/g,"");
            $('#testtime').val(num);
        }

    }
//加载年级
    function gradelevel(){
        var id=$('#userid').val();
        var inhtml='';
        var inval='';
        $.ajax({
            url: "<?php echo U('gradelevelsub');?>",
            data: {id:id},
            dataType: 'json',
            type: 'post',
            success: function (re) {
                var count=re['count'];
                for(var i=0;i<count;i++)
                {
                    var gradeid='grade'+re[i]['id'];
                    inhtml=inhtml+'<input type="checkbox" checked="checked" name="gradeobject" onclick="gradechecksub();" id="'+gradeid+'" value="'+re[i]['id']+'"><label for="'+gradeid+'">'+re[i]['grademsg']+'</label>';

                    if(i==count-1)
                    {
                        inval=inval+re[i]['id'];
                    }
                    else
                    {
                        inval=inval+re[i]['id']+',';
                    }
                }
                $('#gradeid').html(inhtml+'<input type="checkbox" name="gradeobject_all" onclick="gradechangechecksub();" id="grade999" value="all"><label for="grade999">全选</label>');

                $('#checkgradeid').val(inval);
                chaptersub();
            }
        })
    }
//加载科目
    function subjectsub(){

        var id=0;
        var inhtml='';
        $.ajax({
            url:"<?php echo U('phpsubjectsub');?>",
            data:{id:id},
            datatype:'json',
            type:'post',
            success:function(re){
                var subject=eval("("+re+")");

                var count=subject['count'];

                for(var i=0;i<count;i++)
                {
                    inhtml=inhtml+'<option value ="'+subject[i]['id']+'">'+subject[i]['subjectmsg']+'</option>';
                }

                $('#subjectid').html('<option value ="0">请选择科目</option>'+inhtml);
            }

        }

        )
    }
//加载年级(好像没有用)
    function gradesub(){

        var gradeid=12;

        var id=0;
        var inhtml='';
        $.ajax({
                    url:"<?php echo U('phpgradesub');?>",
                    data:{gradeid:gradeid},
                    datatype:'json',
                    type:'post',
                    success:function(re){
                        var subject=eval("("+re+")");

                        var count=subject['count'];

                        for(var i=0;i<count;i++)
                        {
                            inhtml=inhtml+'<option value ="'+subject[i]['id']+'">'+subject[i]['subjectmsg']+'</option>';
                        }

                        $('#subjectid').html('<option value ="1000">请选择科目</option>'+inhtml);
                    }

                }

        )
    }
//根据年级家在章节
    function gradechecksub(){
        var arr = '';
        obj = document.getElementsByName("gradeobject");
        check_val = [];
        for(k in obj){
            if(obj[k].checked)
                check_val.push(obj[k].value);
        }
        var testarr=check_val.toString();
        $('#checkgradeid').val(testarr);


        chaptersub();
    }
//章节信息
    function chaptersub(){

        var checkgradeid=$('#checkgradeid').val();
        var subjectid=$('#questionsubjectid').val();
        if(checkgradeid=='')
        {
            $('#chapterid').html('<span style="margin-left: 20px;">请选择章节</span>');
            return;
        }

        var inhtml='';


        $.ajax({
                    url:"<?php echo U('phpgradesub');?>",
                    data:{checkgradeid:checkgradeid,subjectid:subjectid},
                    datatype:'json',
                    type:'post',
                    success:function(re){
                        var chapter=eval("("+re+")");
                        var count=chapter['count'];
                        for(var i=0;i<count;i++)
                        {
                            var chapterid='chapter'+chapter[i]['id'];
                            if(chapter[i]['kind']=='grade')
                            {
                                if(i==0)
                                {
                                    inhtml=inhtml+'<div style="padding-bottom: 8px;"><span style="margin-left: 8px;margin-top: 3px;">'+chapter[i]['chaptermsg']+'</span></div>';
                                }
                                else
                                {
                                    inhtml=inhtml+'<div style="padding-bottom: 8px;"><span style="margin-left: 8px;margin-top: 3px;">'+chapter[i]['chaptermsg']+'</span></div>';
                                }

                            }
                            else
                            {
                                inhtml=inhtml+'<input type="checkbox"  style="display: none;" checked="checked" name="chapterobject"  id="'+chapterid+'" value="'+chapter[i]['id']+'"><label  for="'+chapterid+'">'+chapter[i]['chaptermsg']+'</label>';

                            }



                        }
                        $('#chapterid').html(inhtml);
                    }

                }

        )
    }
    //第一部分章节信息
    function testchaptersub(){


        var checkgradeid=$('#checktestgradeid').val();
        var subjectid=$('#questionsubjectid').val();

        if(checkgradeid=='')
        {
            $('#testchapterid').html('<span style="margin-left: 20px;">请选择章节</span>');
            return;
        }

        var inhtml='';
        $.ajax({
                    url:"<?php echo U('phpgradesub');?>",
                    data:{checkgradeid:checkgradeid,subjectid:subjectid},
                    datatype:'json',
                    type:'post',
                    success:function(re){

                        var chapter=eval("("+re+")");

                        var count=chapter['count'];

                        for(var i=0;i<count;i++)
                        {
                            var chapterid='chapter'+chapter[i]['id'];

                            if(chapter[i]['kind']=='grade')
                            {
                                if(i==0)
                                {
                                    inhtml=inhtml+'<div style="padding-bottom: 8px;"><span style="margin-left: 8px;margin-top: 3px;">'+chapter[i]['chaptermsg']+'</span></div>';
                                }
                                else
                                {
                                    inhtml=inhtml+'<div style="padding-bottom: 8px;"><span style="margin-left: 8px;margin-top: 3px;">'+chapter[i]['chaptermsg']+'</span></div>';
                                }

                            }
                            else
                            {
                                inhtml=inhtml+'<input type="checkbox" style="display: none;"  name="testchapterobject" onclick="testchapterchecksub();" id="'+chapterid+'" value="'+chapter[i]['id']+'"><label for="'+chapterid+'">'+chapter[i]['chaptermsg']+'</label>';

                            }



                        }
                        $('#testchapterid').html(inhtml);
                        // $('#checktestchapterid').val(inval);
                    }

                }

        )
    }
    //第三部分章节信息
    function testchaptersub03(){
        var checkgradeid=$('#checkgradeid').val();
        var subjectid=$('#questionsubjectid').val();


        var inhtml='';
        $.ajax({
                    url:"<?php echo U('phpgradesub');?>",
                    data:{checkgradeid:checkgradeid,subjectid:subjectid},
                    datatype:'json',
                    type:'post',
                    success:function(re){

                        var chapter=eval("("+re+")");

                        var count=chapter['count'];

                        for(var i=0;i<count;i++)
                        {
                            var chapterid='mychapter'+chapter[i]['id'];

                            if(chapter[i]['kind']=='grade')
                            {
                                if(i==0)
                                {
                                    inhtml=inhtml+'<div style="padding-bottom: 8px;"><span style="margin-left: 8px;margin-top: 3px;">'+chapter[i]['chaptermsg']+'</span></div>';
                                }
                                else
                                {
                                    inhtml=inhtml+'<div style="padding-bottom: 8px;"><span style="margin-left: 8px;margin-top: 3px;">'+chapter[i]['chaptermsg']+'</span></div>';
                                }

                            }
                            else
                            {
                                inhtml=inhtml+'<input type="checkbox" style="display: none;" checked="checked"  name="chapterobject"  id="'+chapterid+'" value="'+chapter[i]['id']+'"><label for="'+chapterid+'">'+chapter[i]['chaptermsg']+'</label>';

                            }
                        }
                        $('#chapterid').html(inhtml);
//                        detaillistsub();
                    }

                }
        )
    }
//班级详细信息
    function classsub()
    {
        var inhtml='';
        var iinhtml=''
        var id=$('#userid').val();

        $.ajax({
           url:"<?php echo U('phpclasssub');?>",
           data:{id:id},
           datatype:'json',
           type:'post',
            success:function(re){

                var myclass=eval("("+re+")");
                var count=myclass['count'];


                for(var i=0;i<count;i++)
                {
                    var myclassid='myclass'+myclass[i]['id'];
                    var iclassid='iclass'+myclass[i]['id'];
                    inhtml=inhtml+'<input type="checkbox"  name="myclassobject"  onclick="notemsg()" class="'+myclass[i]['classname']+'"   id="'+myclassid+'" value="'+myclass[i]['id']+'"><label for="'+myclassid+'">'+myclass[i]['classname']+'</label>';


                    if(i==0)
                    {
                        iinhtml=iinhtml+'<input type="radio" checked="checked"  onclick="searchtestidtitlebind(0)"  name="iclassobject"  id="'+iclassid+'" value="'+myclass[i]['id']+'"><label for="'+iclassid+'">'+myclass[i]['classname']+'</label>';
                    }
                    else
                    {
                        iinhtml=iinhtml+'<input type="radio" onclick="searchtestidtitlebind(0)"   name="iclassobject"  id="'+iclassid+'" value="'+myclass[i]['id']+'"><label for="'+iclassid+'">'+myclass[i]['classname']+'</label>';
                    }

                }
                $('#classid').html('<label style="margin-left: 20px;">选择班级：</label>'+inhtml);
                $('#myclass03').html('<label style="margin-left: 20px;">班级：</label>'+iinhtml);

           }
            }
        )
    }
//添加群组
    function groupsub() {
        var inhtml='';
        var id=$('#userid').val();
        var count=5;
        for(var i=0;i<count;i++)
           {
               var groupid='group'+i;
               var groupmsg='';

                            if(i==0)
                            {
                                groupmsg='All';
                                inhtml=inhtml+'<input type="checkbox"  name="groupobject" onclick="notemsg();" id="'+groupid+'" class="All"  value="0"><label for="'+groupid+'">'+groupmsg+'</label>';

                            }

                            if(i==1)
                            {
                                groupmsg='G1';
                                inhtml=inhtml+'<input type="checkbox"  name="groupobject" onclick="notemsg();" id="'+groupid+'" class="G1"   value="1"><label for="'+groupid+'">'+groupmsg+'</label>';

                            }

                            if(i==2)
                            {
                                groupmsg='G2';
                                inhtml=inhtml+'<input type="checkbox"  name="groupobject" onclick="notemsg();" id="'+groupid+'" class="G2"   value="2"><label for="'+groupid+'">'+groupmsg+'</label>';

                            }

                            if(i==3)
                            {
                                groupmsg='G3';
                                inhtml=inhtml+'<input type="checkbox"  name="groupobject" onclick="notemsg();" id="'+groupid+'" class="G3"   value="3"><label for="'+groupid+'">'+groupmsg+'</label>';
                            }
                           if(i==4)
                            {
                               groupmsg='Other';
                               inhtml=inhtml+'<input type="checkbox"  name="groupobject" onclick="notemsg();" id="'+groupid+'" class="Other"  value="4"><label for="'+groupid+'">'+groupmsg+'</label>';
                            }


                        }
                        $('#groupid').html('<label style="margin-left: 20px;">选择群组：</label>'+inhtml);



    }
//添加试题
    function questiontypesub() {
        var subjectid=$('#questionsubjectid').val();
        var nowquestion=$('#nowquestion').val();
        var questiontypeid='questiontype'+nowquestion;
        var questionnumid='questionnum'+nowquestion;
        var inhtml='';


        $.ajax({
            url:"<?php echo U('phpquestionsub');?>",
            data:{subjectid:subjectid},
            datatype:'json',
            type:'post',
            success:function(re){

                var question=eval("("+re+")");
                var count=question['count'];

                for(var i=0;i<count;i++)
                {
                    inhtml=inhtml+'<option value ="'+question[i]['id']+'">'+question[i]['typesmsg']+'</option>';
                }

                $('#'+questiontypeid).html('<option value ="1000">请选择题型</option>'+'<option value ="del">删除</option>'+inhtml);

            }
        })
    }
//习题改变
    function questiontypechange(id) {
        var nowquestion=$('#nowquestion').val();
        var nowquestionmsg=$('#'+id).val();
        var questionid='';
        var titlelevel=$('#titlelevel').val();


        if(titlelevel=='1000')
        {
            alert('请选择标题级别!');
            return;
        }
        if(nowquestionmsg=='1000')
        {
//            $("select[name='questiontype']").each(function(){
//                questionid=questionid+$(this).val()+',';
//            });
//
//            questionid=questionid.substr(0,questionid.length-1);
//
//            $('#questionidarr').val(questionid);

//            alert(12332);
            delquestiontype_select(id);

//            detaillistsub();
            resettestsum();

            initdivsub();
            hastypesub();

            return;
        }
        if(nowquestionmsg=='del')
        {
            var nowquestion=$('#nowquestion').val();

            if(nowquestion==2)
            {

                detaillistsub();
                resettestsum();

                initdivsub();
                return;
            }

            delquestiontype(id);
//            detaillistsub();
            resettestsum();

            initdivsub();
            hastypesub();
            return;
        }

        addnewquestiontype();
        nowquestionmsg=nowquestionmsg+','+ $('#nowtypeid').val();
        $('#nowtypeid').val(nowquestionmsg);

        detaillistsub();
        initdivsub();

        hastypesub();
    }

    //删除习题
    function delquestiontype_select(id)
    {
        var nowquestion=$('#nowquestion').val();
        var thistypeid=$('#questiontype'+nowquestion).val();
        var questionidarr=$('#questionidarr').val();
        var questionid='';
        var msg=$('#nowtypeid').val();
        var arr = msg.split(",");
        var nowtypeid=arr[0];
        var newmsg = msg.replace(nowtypeid+',', "");
        $('#nowtypeid').val(newmsg);
        $('#nowquestion').val(nowquestion);
        $('#questiontype'+nowquestion).attr('disabled',false);
        $('#detaillistid').children("div:last-child").remove();
        $('#detaillistid').children("div:last-child").remove();

        var testmsg='';

        $("select[name='questiontype']").each(function(){
            questionid=questionid+$(this).val()+',';
            testmsg=$(this).val()+','+testmsg;
        });
        questionid=questionid.substr(0,questionid.length-1);
        $('#questionidarr').val(questionid);




删除之后更新题数
        var i=0;
        $("input[name='testSum']").each(function(){

            var result=publictestSum($(this).val());

            if($(this).val()!='')
            {
                i=i+parseInt($(this).val());
            }

        });

        $('#testSumid').val(i);

    }

//删除习题
    function delquestiontype(id)
    {
        var nowquestion=$('#nowquestion').val();

       // alert(nowquestion);

        var thistypeid=$('#questiontype'+nowquestion).val();

       // alert(thistypeid);

        var questionidarr=$('#questionidarr').val();
        var questionid='';
        var msg=$('#nowtypeid').val();
        var arr = msg.split(",");
        var nowtypeid=arr[0];
        var newmsg = msg.replace(nowtypeid+',', "");

        $('#questiondiv'+nowquestion).remove();
        nowquestion=nowquestion-2;
        $('#nowquestion').val(nowquestion);
        $('#questiontype'+nowquestion).attr('disabled',false);

        if(!hasstring('1000',$('#questionidarr').val()))
        {
            $('#detaillistid').children("div:last-child").remove();
            $('#detaillistid').children("div:last-child").remove();
        }

        var testmsg='';

        $("select[name='questiontype']").each(function(){
            questionid=questionid+$(this).val()+',';
            testmsg=$(this).val()+','+testmsg;
        });
        questionid=questionid.substr(0,questionid.length-1);
        $('#questionidarr').val(questionid);

        $('#nowtypeid').val(testmsg);


//删除之后更新题数
        var i=0;
        $("input[name='testSum']").each(function(){

            var result=publictestSum($(this).val());

            if($(this).val()!='')
            {
                i=i+parseInt($(this).val());
            }

        });

        $('#testSumid').val(i);

    }
//添加习题
    function addnewquestiontype()
    {
        var nowquestion=$('#nowquestion').val();
        var subjectid=$('#questionsubjectid').val();
        var questionidarr=$('#questionidarr').val();
        var questionid='';

        $("select[name='questiontype']").each(function(){
            questionid=questionid+$(this).val()+',';
        });

        questionid=questionid.substr(0,questionid.length-1);

        $('#questionidarr').val(questionid);

        var nextquestion=parseInt(nowquestion)+2;


        var inhtml=''
        var inhtml1='<div id="questiondiv'+nextquestion+'" name="typediv" class="row questiontype_class_padding_left" >';
        var inhtml2='<div class="col-xs-8"><select name="questiontype" id="questiontype'+nextquestion+'" onchange="questiontypechange(this.id)"></select></div>';
        var inhtml3='<div class="col-xs-4" name="questionnum" id="questionnum'+nextquestion+'"><input type="text" id="testsum'+nextquestion+'" autocomplete="off"  onchange="testSum(this.id)" name="testsum"  class="questiontype_class_padding_left_input" value="" placeholder="题数(100)"></div>';
        var inhtml4='</div>';
        inhtml=inhtml1+inhtml2+inhtml3+inhtml4;
        $("#questiondiv"+nowquestion).after(inhtml);
        $("#nowquestion").val(nextquestion);

        var questionidarr=$('#questionidarr').val();

        var myinhtml='';


        $.ajax(
                {
                    url:"<?php echo U('phpnextquestionsub');?>",
                    data:{subjectid:subjectid,questionidarr:questionidarr},
                    datatype:'json',
                    type:'post',
                    success:function(re){
                        var question=eval("("+re+")");
                        var count=question['count'];

                       if(count==0)
                       {
                           $('#questiondiv'+nextquestion).remove();
                           $("#nowquestion").val(nowquestion);
                           return;
                       }

                        for(var i=0;i<count;i++)
                        {
                            myinhtml=myinhtml+'<option value ="'+question[i]['id']+'">'+question[i]['typesmsg']+'</option>';
                        }
                        $('#questiontype'+nextquestion).html('<option selected="selected" value ="1000">请选择题型</option>'+'<option value ="del">删除</option>'+myinhtml);
                        $('#questiontype'+nowquestion).attr("disabled","disabled");
                        var questionidarr=$('#questionidarr').val();
                        $('#questionidarr').val(questionidarr+',1000');

                    }
                }
        )
    }
//试题个数
    function testSum(id)
    {
        var msg=$('#'+id).val();
        var result=publictestNum(msg);
        var questionid=0;
        if(!result)
        {
            $('#'+id).val('');
        }
        var i=0;
        $("input[name='testsum']").each(function(){
            var result=publictestNum($(this).val());

            if($(this).val()!='')
            {
                i=i+parseInt($(this).val());
            }
        });
        $('#testsumid').val(i);
        notemsg();

        var num=onlynumsub(id);

        $('#endnum'+num).text($('#'+id).val());



    }
//绑定详细列表，很重要的
    function detaillistsub()
    {
        var inhtml='';
        var i=2;
        var title='';
        var subjectid=$('#questionsubjectid').val();
        var id=$('#userid').val();
        var page_title='';
        var oldid='';
        var papernum='';

        var msg=$('#nowtypeid').val();
        var arr = msg.split(",");
//        alert('当前new:'+arr[0]);
            $("select[name='questiontype']").each(function(){
            var j=i/2;
            title=t12(0,j);
            var msg=$('#questiontype'+i).find("option:selected").text();
            var typeid=$('#questiontype'+i).find("option:selected").val();
            if(msg=='')
            {
               return;
            }
            if(typeid=='underfine')
            {
               return;
            }
            if(typeid=='1000')
            {
               return;
            }

            if(typeid==arr[0])
            {
               // return;
                var num=$('#testsum'+i).val();
                if(num=='')
                {
                    num=0;
                }
                var pagelength=$('#pagelength').val();
                var titlehtml=testsearch(typeid,1,pagelength);
                page_title=title+'、'+msg;
                var nownum='<span id="nownum'+i+'" class="span'+typeid+'">0</span>';
                var endnum='<span id="endnum'+i+'">'+num+'</span>';
                title=title+'、'+msg+' '+'('+nownum+'/'+endnum+')';
                var buttoninhtml='<div class="row" style="font-size: 12px;padding-top: 10px;padding-left:120px;"><a style="float: left;" onclick="prepagesub('+typeid+')">Pre</a><span style="float: left;margin-left: 8px;"><span id="nowpage'+typeid+'">'+$('#nowpage_x').val()+'</span>/<span  id="pagenum'+typeid+'">'+$('#pagenum_x').val()+'</span></span><a onclick="nextpagesub('+typeid+')" style="float: left;margin-left: 8px;">Next</a></div>';
                var inhtml1='<div id="detail_div_'+i+'" class="row detail_list_row" name="'+typeid+'">';
                var inhtml2='<div class="col-xs-9" style="padding-left: 0px;"><a style="float:left;" onclick="testtitlesub(this)" show="1" id="detail_span_'+i+'" href="javascript:void(0)" class="detail_list_row_span">'+title+'</a></div>';
                var inhtml3=' <div class="col-xs-3"> <input type="text" class="scorecss"  id="testscore'+i+'" value="0"  placeholder="分数" onchange="titlescoresub(this.id)"></div></div><div id="detail_title_'+i+'" name="testtype" class="row">'+buttoninhtml+'<ctb id=content'+typeid+'>'+titlehtml+'</ctb>'+'</div>';
                inhtml=inhtml+inhtml1+inhtml2+inhtml3;
                //修改处
                oldid='questionnum'+i;
                papernum=i/2;
                //页面中题型添加表信息
                papertitlesub(page_title,typeid,oldid,papernum);
            }
           i=i+2;
        });


        var id=$('#detaillistid').children("div:last-child").attr('id');

        if(typeof(id)!="undefined") {
            $('#'+id).after(inhtml)
        }else
        {
            $('#detaillistid').html(inhtml);
        }

        //绑定具体习题
        testidtitlebind(0);



    }
//试卷种类改变
    $("#testkindid").on("change",function(){
        var kind=$(this).find("option:selected").val();
        var inhtml='';
        var chapterhtml='';
        var keynotehtml='';
        if(kind==1000)
        {
            inhtml='<span style="margin-left: 20px;">请选择年级</span>';
            chapterhtml=' <span style="margin-left: 20px;">请选择章节</span>';

            $('#testgradeid').html(inhtml);
            $('#testchapterid').html(chapterhtml);

        }
        if(kind!=1000)
        {
            testgradelevel();
            chapterhtml=' <span style="margin-left: 20px;">请选择章节</span>';
            keynotehtml='<span style="margin-left: 20px;">请选择知识点</span>';
            $('#testkeynoteid').html(keynotehtml);
        }

    });
    //加载年级
    function testgradelevel(){
        var id=$('#userid').val();
        var inhtml='';
        var inval='';
        $.ajax({
            url: "<?php echo U('gradelevelsub');?>",
            data: {id:id},
            dataType: 'json',
            type: 'post',
            success: function (re) {
                var count=re['count'];
                for(var i=0;i<count;i++)
                {
                    var testgradeid='testgrade'+re[i]['id'];
                    inhtml=inhtml+'<input type="checkbox" checked="checked" name="testgradeobject" onclick="testgradechecksub();" id="'+testgradeid+'" value="'+re[i]['id']+'"><label for="'+testgradeid+'">'+re[i]['grademsg']+'</label>';

                    if(i==count-1)
                    {
                        inval=inval+re[i]['id'];
                    }
                    else
                    {
                        inval=inval+re[i]['id']+',';
                    }
                }
                $('#testgradeid').html(inhtml);
                $('#checktestgradeid').val(inval);
                testchaptersub();
            }
        })
    }
    //根据年级加载章节
    function testgradechecksub(){
        var arr = '';
        obj = document.getElementsByName("testgradeobject");
        check_val = [];
        for(k in obj){
            if(obj[k].checked)
                check_val.push(obj[k].value);
        }
        var testarr=check_val.toString();
        $('#checktestgradeid').val(testarr);
        testchaptersub();
        $('#checktestchapterid').val('');
    }

    //根据年级加载章节03
    function gradechecksub(){
        var arr = '';
        obj = document.getElementsByName("gradeobject");
        check_val = [];
        for(k in obj){
            if(obj[k].checked)
                check_val.push(obj[k].value);
        }
        var testarr=check_val.toString();
        if(testarr=='')
        {
            $("#chapterid").html('');
            detaillistsub();
            return;
        }
        $('#checkgradeid').val(testarr);
        testchaptersub03();
        $('#checktestchapterid').val('');
    }
    //第一部分章节变化
    function testchapterchecksub()
    {
        var msg='';
        var inhtml='';
        var id = document.getElementsByName('testchapterobject');
        var value = new Array();
        for(var i = 0; i < id.length; i++){
            if(id[i].checked)
                value.push(id[i].value);
        }
        $('#checktestchapterid').val(value);
        var count='';
        var msg1=$('#checktestchapterid').val();

        if(msg1=='')
        {
            $('#testkeynoteid').html('<span style="margin-left: 20px;">请选择知识点</span>');
        }

        $.ajax({
            url: "<?php echo U('phpchaptersub');?>",
            data: {checkchapter: msg1},
            datatype: 'json',
            type: 'post',
            success: function (re) {
                var keynote=eval("("+re+")");
                var count=keynote['count'];
                var keynoteid='';
                if(count!=0)
                {
                    for(var i=0;i<count;i++)
                    {
                        keynoteid='keynote'+(parseInt(i)+1);
                        inhtml=inhtml+'<input type="checkbox" style="display: none;"  name="testkeynoteobject"  id="'+keynoteid+'" value="'+keynote[i]['id']+'"><label for="'+keynoteid+'">'+keynote[i]['msg']+'</label>';
                    }
                    $('#testkeynoteid').html(inhtml);
                }
            }
        });
    }
   //进行详细信息绑定
    function datalistsub()
    {
        $.ajax({
            url: "<?php echo U('phptestlistsub');?>",
            data: {checkchapter: msg1},
            datatype: 'json',
            type: 'post',
            success: function (re) {
                var keynote=eval("("+re+")");
                var count=keynote['count'];
            }
        });
    }
    //动态绑定习题
    function bindtestdatasub(subjectid,id,typeid) {
        var retitlehtml;
        $.ajax({
            url:"<?php echo U('phpbindtestsub');?>",
            data:{subjectid:subjectid,id:id,typeid:typeid},
            datatype:'json',
            type:'post',
            async : false,
            success:function(re){
                var title=eval("("+re+")");
                var count=title['count'];
                var typeid=title['typeid'];
                var titlehtml='';
                var i;
                var j=1;
                var imgli='';
                for(i=0;i<count;i++)
                {
                    if(title[i]['typeid']==typeid)
                    {
                        titlehtml=titlehtml+'<div id="'+title[i]['testid']+'" class="col-xs-12 detail_title_css">'+title[i]['testname']+'</div>';
                        titlehtml=titlehtml+imgli;
                    }
                }
                retitlehtml=titlehtml;
            }
        })


        return retitlehtml;

    }
    //习题索引
    function testsearch(typeid,nowpage,pagelength)
    {
        var begintime=$('#begintime').val();
        var endtime=$('#endtime').val();
        var testtypekind=$('#testkindid03').find("option:selected").val();
        var keyword=$('#keyword').val();
        var userid=$('#userid').val();
        var subjectid=$('#questionsubjectid').val();


        if(testtypekind==1000)
        {
            testtypekind='';
        }

        var m=1;
        var testchapterarr='';

        var m1=1;
        var m2=1;

        $("input[name='chapterobject']").each(function(){

            m1=m1+1;

            if($(this).prop("checked")==true)
            {
                m2=m2+1;

                if(m==1)
                {
                    testchapterarr=testchapterarr+$(this).val();
                    m=2;
                }
                else
                {
                    testchapterarr=testchapterarr+','+$(this).val();
                }
            }

        });
        if(m1==m2)
        {
            testchapterarr=testchapterarr+',0';
        }
        var retitlehtml='';
        $.ajax({
            url:"<?php echo U('phptestsearch');?>",
            data:{userid:userid,subjectid:subjectid,begintime:begintime,endtime:endtime,testtypekind:testtypekind,keyword:keyword,testchapterarr:testchapterarr,typeid:typeid,nowpage:nowpage,pagelength:pagelength},
            datatype:'json',
            type:'post',
            async : false,
            success:function(re){
                var title=eval("("+re+")");
                var count=title['count'];
                var typeid=title['typeid'];
                var titlehtml='';
                var i;
                var j=1;
                var imgli='';


                for(i=0;i<count;i++)
                {
                    if(title[i]['typeid']==typeid)
                    {
                        titlehtml=titlehtml+'<div id="'+typeid+'-'+title[i]['testid']+'" name="testidtitle" class="col-xs-12 detail_title_css '+typeid+'">'+title[i]['testname']+'</div>';
                        titlehtml=titlehtml+"<div class='col-xs-12'><ol id='ol"+typeid+'-'+title[i]['testid']+"'></ol></div>";
                        //修改处
                    }
                }

                $('#nowpage_x').val(title['nowpage']);
                $("#pagenum_x").val(title['pagenum']);

                retitlehtml=titlehtml;
            }
        })



        return retitlehtml;

    }
//年级改变选项
    function gradechangechecksub(){


        $("input[name='chapterobject']").each(function(){

            if($('#chapterchoose').val()==0)
            {
                $(this).prop("checked", false);

            }
            else
            {
                $(this).prop("checked", true);

            }
        });

        if($('#chapterchoose').val()==0)
        {
            $('#chapterchoose').val('1');
        }
        else
        {
            $('#chapterchoose').val('0');
        }

        detaillistsub();


    }
//显示年级
    function notemsgsub()
    {
        if($('#notemsg').val()==0)
        {
            $("div[name='notemsg']").css('font-size','1px');
            $("div[name='notemsg']").css('height','1px');
            $("div[name='notemsg']").css('color','#ecedf0');
        }
        else
        {
            $("div[name='notemsg']").css('font-size','12px');
            $("div[name='notemsg']").css('height','20px');
            $("div[name='notemsg']").css('color','#8b8c8f');

        }

        if($('#notemsg').val()==0)
        {
            $('#notemsg').val(1);
        }
        else
        {
            $('#notemsg').val(0);
        }


    }
    //03条件进行修改
    function findtest()
    {
        var typeid=$('#hastitlelevel').val();
        var begintime=$('#begintime').val();
        var endtime=$('#endtime').val();

        if(!checkDate(begintime) && begintime!='')
        {
            alert('请输入正确的时间格式！');
            $('#begintime').val('');
            return;
        }

        if(!checkDate(endtime) && endtime!='')
        {
            alert('请输入正确的时间格式！');
            $('#endtime').val('');
            return;
        }

        searchdetaillistsub(typeid);

    }
///具体习题函数，包含单个习题的统计数据
    function testidtitlebind(mytypeid)
    {
        var testid='';
        var typeid='';

        var classid=$("input[name='iclassobject']:checked").val();
        var groupid=$('#mygroup03').find("option:selected").val();

        var no1ration=$('#no1ration').val();
        var no2ration=$('#no2ration').val();

        var no1testtime=$('#no1testtime').val();
        var no2testtime=$('#no2testtime').val();

        var questionorder=$('#questionorder').find("option:selected").val();

        var id='';
        var mytypeid=mytypeid;

        $("div[name='testidtitle']").each(function(){

              id='ol'+$(this).attr('id');
              typeid=$(this).attr('class').replace(/col-xs-12 detail_title_css /ig, '');
              testid=$(this).attr('id').replace(typeid+'-', '');

           // alert(testid);

            //修改

            if(mytypeid==0)
            {
                var msg=$('#nowtypeid').val();
                var arr = msg.split(",");
                mytypeid=arr[0];
            }


            if(typeid==mytypeid)
            {


               // alert(testid);
            $.ajax({
                url:"<?php echo U('phpbindtestdetail');?>",
                data:{testid:testid,typeid:typeid,groupid:groupid,classid:classid,no1ration:no1ration,no2ration:no2ration,no1testtime:no1testtime,no2testtime:no2testtime,questionorder:questionorder},
                datatype:'json',
                type:'post',
                async : false,
                success:function (re) {
                    var msg='';
                    var titledetail=eval("("+re+")");
                    var count=titledetail['count'];
                    var typeid=titledetail['typeid'];
                    var tsernumcss='';
                    var colormsg='';
                    var notemsg='';
                    for(var i=0;i<count;i++)
                    {
                        if(titledetail[i]['kind']=='Up')
                        {
                            titledetail[i]['ratio']='<span style="color: red">'+titledetail[i]['ratio']+'</span>'
                        }
                        if(titledetail[i]['kind']=='Down')
                        {
                            titledetail[i]['ratio']='<span style="color: darkgreen">'+titledetail[i]['ratio']+'</span>'
                        }
                        if(titledetail[i]['kind']=='Equ')
                        {
                            titledetail[i]['ratio']='<span style="color: blue;">Equ</span>';
                        }
                        var picsum=titledetail[i]['picsum'];
                        var pic1_src=titledetail[i]['pic1_src'];
                        var pic1_width=titledetail[i]['pic1_width'];
                        var pic1_height=titledetail[i]['pic1_height'];

                        var pic2_src=titledetail[i]['pic2_src'];
                        var pic2_width=titledetail[i]['pic2_width'];
                        var pic2_height=titledetail[i]['pic2_height'];

                        var pic3_src=titledetail[i]['pic3_src'];
                        var pic3_width=titledetail[i]['pic3_width'];
                        var pic3_height=titledetail[i]['pic3_height'];

                        var pic4_src=titledetail[i]['pic4_src'];
                        var pic4_width=titledetail[i]['pic4_width'];
                        var pic4_height=titledetail[i]['pic4_height'];
                        var picid=titledetail[i]['pic1_id']+' '+titledetail[i]['pic2_id']+' '+titledetail[i]['pic3_id']+' '+titledetail[i]['pic4_id'];
                        var t1_id=titledetail[i]['t1_id'];
                        if(titledetail[i]['t1_sernum']>0)
                        {
                            if($('#tsernum').val()==0)
                            {
                                $('#tsernum').val(titledetail[i]['t1_sernum']);
                                $('#tsernum_color').val('blue');
                                colormsg='blue';
                            }
                            else
                            {
                                if($('#tsernum').val()!=titledetail[i]['t1_sernum'])
                                {
                                    $('#tsernum').val(titledetail[i]['t1_sernum']);
                                    if($('#tsernum_color').val()=='blue')
                                    {
                                        $('#tsernum_color').val('BlueViolet');
                                         colormsg='BlueViolet';
                                    }
                                    else
                                    {
                                        $('#tsernum_color').val('blue');
                                        colormsg='blue';
                                    }
                                }
                            }
                            tsernumcss='border-right:solid 1px '+colormsg;
                        }
                        var tsermsg=titledetail[i]['t1_sernum']+','+titledetail[i]['t1_src']+','+titledetail[i]['t1_width']+','+titledetail[i]['t1_height'];
                        var picmsg=picsum+','+pic1_src+','+pic1_width+','+pic1_height+','+pic2_src+','+pic2_width+','+pic2_height+','+pic3_src+','+pic3_width+','+pic3_height+','+pic4_src+','+pic4_width+','+pic4_height;
                        notemsg='No2:'+titledetail[i]['two']+'&nbsp;&nbsp;&nbsp;&nbsp;No1:'+titledetail[i]['one']+'&nbsp;&nbsp;&nbsp;&nbsp;'+titledetail[i]['ratio'];

                        msg=msg+'<li ><div><div name="notemsg" style="margin-top: 2px;color: #8b8c8f;font-size: 12px;">'+notemsg+'</div><input msg="answermsg" type="hidden"  value="'+titledetail[i]['answerid']+' '+titledetail[i]['answersrc']+' '+titledetail[i]['width']+' '+titledetail[i]['height']+'"><img  id='+titledetail['testid']+'-'+titledetail[i]['srcid']+' oldid='+titledetail[i]['srcid']+' onmouseover="previewimg(this.src)"   picmsg="'+picmsg+'" picid="'+picid+'" t1_id="'+t1_id+'" tsermsg="'+tsermsg+'" style="'+tsernumcss+'"   name="'+typeid+'" class="detail_title_img_css" src='+titledetail[i]['src']+' onclick="chooseimgsub(this.id)"></div></li>';
                    }
                    $('#'+id).html(msg);
                }
            });
            }
        });
    }
    function subjectchangesub()
    {
        var val=$('#subjectid').find("option:selected").val();
        $('#questionsubjectid').val(val);
        questiontypesub();
        testchaptersub03();
        $('#detaillistid').html('');

    }
//重新统计习题总数
    function resettestsum()
    {
        var i=0;
        $("input[name='testsum']").each(function(){
            var result=publictestNum($(this).val());
            if($(this).val()!='')
            {
                i=i+parseInt($(this).val());
            }
        });
        $('#testsumid').val(i);
        notemsg();
    }
    //提示信息
    function notemsg()
    {
        var msg='';
        var title=$('#testtitle').val();
        var testlevel=$('#testlevel').find("option:selected").html();
        var testsum=$('#testsumid').val();
        var testsumpre=$('#testsumpre').val();
        msg="*"+title+'    '+testsum+'/'+testsumpre+'    '+'试卷难度：'+testlevel;
        $("input[name='testnote']").val(msg);
        $('#ctb_h1').html(title);
        pagenotemsg();
    }
    //进行标题插入
    function papertitlesub(title,typeid,oldid,num)
    {
        var questionclass='row my_h1 title '+typeid+' '+oldid+' '+'none';
        var score='';
        var id=0;
        var tsernum='';
        var tid='';
        $("div[name='mytest']").each(function(){
            myclass=$(this).attr('class');
            if($(this).hasClass("title") && $(this).hasClass(typeid))
            {
                id=$(this).attr('id');
            }
        });

       var m=1;
       var n;
       if(id==0)
       {
            $("div[name='mytest']").each(function(){
                m=m+1;
                tid=$(this).attr('id');
            });
            title='<div style="float:left;">'+title+'</div><span name="testscore" id="pagetestscore'+num*2+'" style="margin-left: 10px;">'+score+'</span>';
            var html='<div id="question'+m+'" class="'+questionclass+'" height1="30" height2="30" mysernum="0" name="mytest"><div id="questionmsg'+m+'" name="testmsg" >'+title+'</div></div>';
            n=m-1;

            tsernum=$('#'+tid).attr('mysernum');

            if(tsernum!=0)
            {
                $("div[tsernum="+tsernum+"]").each(function(){
                    id=$(this).attr('id');
                });
                $("#"+id).after(html);
            }
            else
            {
                $("#question"+n).after(html);
            }
        }
    }
    //进行图片插入
    function chooseimgsub(id)
    {



        var typeid=$('#'+id).attr('name');

        typeid='span'+typeid;

        var myid=$('span[class='+typeid+']').attr('id');
        myid='#endnum'+onlynumsub(myid);
        var maxnum=$(myid).text();
        var num=$('span[class='+typeid+']').text();

        if(num==maxnum)
        {
            alert('题型数量已超出！！');
            return;
        }

        num=parseInt(num)+1;
        $('span[class='+typeid+']').text(num);


        if(imgcsssub(id))
        {
            titlelevel02(id);
        }




        //进行分数统计
        if(!$('#banner_8').prop('checked'))
        {
            nowscoresub01();
        }
        //进行分页
        pagenotemsg();

    }
//二级目录插入图片
    function titlelevel02(id)
    {
        var src=$('#'+id).attr('src');
        var ratio=$('#img_ratio').val();
        var typeid=$('#'+id).attr('name');
        var tsermsg=$('#'+id).attr('tsermsg');
        var tserarr=tsermsg.split(",");

        var tsernum=tserarr[0];

        var premsg=pagetypesub(typeid,tsernum);

//        alert(premsg);

        var picmsg=$('#'+id).attr('picmsg');


//2480,660 图片实际尺寸，在页面显示尺寸。 高为993像素
        $.ajax({
            url: "<?php echo U('phpchooseimgsub');?>",
            data: {src: src,ratio:ratio,typeid:typeid,premsg:premsg,picmsg:picmsg,tsermsg:tsermsg},
            datatype: 'json',
            type: 'post',
            success: function (re) {
                var imgdetail=eval("("+re+")");
                var premsg=imgdetail['premsg'];
                var picsum=imgdetail['picsum'];
                var pichtml='';
                var marginright=0;
                var stylecss1='';
                var stylecss2='';
                var stylecss3='';
                var stylecss4='';

                var t1_sernum=imgdetail['t1_sernum'];
                var t1_src=imgdetail['t1_src'];
                var t1_width=imgdetail['t1_width'];
                var t1_height=imgdetail['t1_height'];
                //隐藏标题时的高度
                var height1='';
                var height2='';

                var serhtml='';


                //存在配图情况下，进行配图html生成

                if(picsum==0)
                {
                    height1=0;
                    picsum='';
                }
                if(picsum==1)
                {
                    height1=20+parseInt(imgdetail['pic1_height'])*1;
                    stylecss1="margin-left:10px;"+"width:"+imgdetail['pic1_width']+"px;height:"+imgdetail['pic1_height']+"px;";
                    marginright=660-parseInt(imgdetail['width']);
                    pichtml='<div class="row" style="text-align:right;padding-right:'+marginright+'px;padding-top: 20px;"> <img src="'+imgdetail['pic1_src']+'" style="'+stylecss1+'"></div>';
                }
                if(picsum==2)
                {
                    if(imgdetail['pic1_height']>=imgdetail['pic2_height'])
                    {
                        height1=20+parseInt(imgdetail['pic1_height'])*1;
                    }
                    else
                    {
                        height1=20+parseInt(imgdetail['pic2_height'])*1;
                    }
                    stylecss1="margin-left:10px;"+"width:"+imgdetail['pic1_width']+"px;height:"+imgdetail['pic1_height']+"px;";
                    stylecss2="margin-left:10px;"+"width:"+imgdetail['pic2_width']+"px;height:"+imgdetail['pic2_height']+"px;";
                    marginright=660-parseInt(imgdetail['width']);
                    pichtml='<div class="row" style="text-align:right;padding-right:'+marginright+'px;padding-top: 20px;"> <img src="'+imgdetail['pic1_src']+'" style="'+stylecss1+'"><img src="'+imgdetail['pic2_src']+'" style="'+stylecss2+'"></div>';
                }
                if(picsum==3)
                {
                    var mid1='';
                    if(imgdetail['pic1_height']>=imgdetail['pic2_height'])
                    {
                        mid1=imgdetail['pic1_height'];
                    }
                    else
                    {
                       mid1=imgdetail['pic2_height'];
                    }
                    if(mid1>=imgdetail['pic3_height'])
                    {
                        mid1=mid1;
                    }
                    else
                    {
                        mid1=imgdetail['pic3_height'];
                    }
                    height1=20+mid1;
                    stylecss1="margin-left:10px;"+"width:"+imgdetail['pic1_width']+"px;height:"+imgdetail['pic1_height']+"px;";
                    stylecss2="margin-left:10px;"+"width:"+imgdetail['pic2_width']+"px;height:"+imgdetail['pic2_height']+"px;";
                    stylecss3="margin-left:10px;"+"width:"+imgdetail['pic3_width']+"px;height:"+imgdetail['pic3_height']+"px;";
                    marginright=660-parseInt(imgdetail['width']);
                    pichtml='<div class="row" style="text-align:right;padding-right:'+marginright+'px;padding-top: 20px;"><img src="'+imgdetail['pic1_src']+'" style="'+stylecss1+'"><img src="'+imgdetail['pic2_src']+'" style="'+stylecss2+'"> <img src="'+imgdetail['pic3_src']+'" style="'+stylecss3+'"></div>';
                }
                if(picsum==4)
                {
                    var mid1='';
                    if(imgdetail['pic1_height']>=imgdetail['pic2_height'])
                    {
                        mid1=imgdetail['pic1_height'];
                    }
                    else
                    {
                        mid1=imgdetail['pic2_height'];
                    }
                    if(mid1>=imgdetail['pic3_height'])
                    {
                        mid1=mid1;
                    }
                    else
                    {
                        mid1=imgdetail['pic3_height'];
                    }

                    if(mid1>=imgdetail['pic4_height'])
                    {
                        mid1=mid1;
                    }
                    else
                    {
                        mid1=imgdetail['pic4_height'];
                    }


                    height1=20+mid1;
                    stylecss1="margin-left:10px;"+"width:"+imgdetail['pic1_width']+"px;height:"+imgdetail['pic1_height']+"px;";
                    stylecss2="margin-left:10px;"+"width:"+imgdetail['pic2_width']+"px;height:"+imgdetail['pic2_height']+"px;";
                    stylecss3="margin-left:10px;"+"width:"+imgdetail['pic3_width']+"px;height:"+imgdetail['pic3_height']+"px;";
                    stylecss4="margin-left:10px;"+"width:"+imgdetail['pic4_width']+"px;height:"+imgdetail['pic4_height']+"px;";
                    marginright=660-parseInt(imgdetail['width']);
                    pichtml='<div class="row" style="text-align:right;padding-right:'+marginright+'px;padding-top: 20px;"> <img src="'+imgdetail['pic1_src']+'" style="'+stylecss1+'"><img src="'+imgdetail['pic2_src']+'" style="'+stylecss2+'"><img src="'+imgdetail['pic3_src']+'" style="'+stylecss3+'"><img src="'+imgdetail['pic4_src']+'" style="'+stylecss4+'"></div>';
                    serhtml=''


                }

                //判断是否是完形


                if(t1_sernum!=0)
                {
                    //是完形的情况下

                    var arr=premsg.split("+");

                    if(arr[1]!='tsernum')
                    {
                        var sernum=arr[2]+'.';
                        var typeid=imgdetail['typeid'];
                        var preid=arr[0];
                        var mywidth='width:'+t1_width+'px;';
                        var myheight='height:'+t1_height+'px;';
                        var num='hao';

                        height1=height1*1+t1_height*1+10;
                        height2=height1*1+20;


                        var html='<div id="question'+num+'" height1="'+height1+'" height2="'+height2+'" class="row my_h2 question '+typeid+'" mysernum="'+t1_sernum+'" name="mytest"><div id="questionmsg'+num+'" name="testmsg" style="float:left;">'+sernum+'</div><input  onchange="scoresum(this)" name="onequestionscore" class="partscore" num="1" type="text" value="" placeholder="分数"><span name="onequestionscore" style="float: left;font-size:14px;margin-top:-1px;"></span><input  name="onequestionscore"  class="onequestionscore" readonly="readonly" style="width: 20px;text-align: left;margin-left: 0px;margin-top:-1px;float:left;font-size:14px;height:20px;" value=""><span name="onequestionscore" style="float:left;">\'</span><br name="onequestionscore"><img  onclick="panelbuttonsub(this)" src="'+t1_src+'" sernum="'+t1_sernum+'" style="'+mywidth+myheight+'margin-left: 10px;">'+pichtml+'</div>';

                        var mywidth='width:'+imgdetail['width']+'px;';
                        var myheight='height:'+imgdetail['height']+'px;';

                        if(imgdetail['height']>20)
                        {
                            height1=imgdetail['height']*1+16;
                        }
                        else
                        {
                            height1=20*1+16;
                        }

                        if(imgdetail['height']==20)
                        {
                            height1=21*1+16;
                        }

                        serhtml='<div id="'+t1_sernum+'tser_div_1"  height1="'+height1+'" height2="'+height2+'"  class="row" style="padding-left: 60px;margin-top: 16px;" tsernum="'+t1_sernum+'"><span style="float: left;">(1)</span><div  name="serquestion"><img onclick="panelbuttonsub(this)"  sernum="'+t1_sernum+'"  src="'+imgdetail['src']+'" style="'+mywidth+myheight+'margin-left: 10px;"></div></div>';
                        $('#'+preid).after(html+serhtml);
                        resernum();
                    }
                    else
                    {
                        var sernum=arr[2]+'.';
                        var typeid=imgdetail['typeid'];
                        var preid=arr[0];

                        var mywidth='width:'+imgdetail['width']+'px;';
                        var myheight='height:'+imgdetail['height']+'px;';


                        if(imgdetail['height']>20)
                        {
                            height1=imgdetail['height']*1+16;
                        }
                        else
                        {
                            height1=20*1+16;
                        }

                        if(imgdetail['height']==20)
                        {
                            height1=21*1+16;
                        }

                        height2=height1;


                        var num=arr[2];
                        var sernum='('+arr[2]+')';
                        var html='<div id="'+t1_sernum+'tser_div_'+num+'"  height1="'+height1+'" height2="'+height2+'"  class="row" style="padding-left: 60px;margin-top: 16px;" tsernum="'+t1_sernum+'"><span style="float: left;">'+sernum+'</span><div name="serquestion"><img onclick="panelbuttonsub(this)" sernum="0" src="'+imgdetail['src']+'" style="'+mywidth+myheight+'margin-left: 10px;"></div></div>';




                        $('#'+preid).after(html);

                        var tnum=$("div[mysernum="+t1_sernum+"]").children('input').attr('num');

                        tnum=tnum*1+1;

                        $("div[mysernum="+t1_sernum+"]").children('input').attr('num',tnum);


                    }

                }
                else
                {

                    var arr=premsg.split("+");
                    var sernum=arr[2]+'.';
                    var typeid=imgdetail['typeid'];
                    var preid=arr[0];
                    var mywidth='width:'+imgdetail['width']+'px;';
                    var myheight='height:'+imgdetail['height']+'px;';
                    var num='hao';
                    var iheight1=height1+imgdetail['height']+10;
                    var iheight2=iheight1*1+20;
                    var html='<div id="question'+num+'" height1="'+iheight1+'"  height2="'+iheight2+'" class="row my_h2 question '+typeid+'" mysernum="0" name="mytest"><div id="questionmsg'+num+'" name="testmsg" style="float:left;">'+sernum+'</div><input  onchange="scoresum(this)" name="onequestionscore" class="onequestionscore" type="text" num="1" value="" placeholder="分数"><span name="onequestionscore" style="font-size: 12px;margin-top: 1px;">\'</span><br name="onequestionscore"><img onclick="panelbuttonsub(this)"  sernum="0" src="'+imgdetail['src']+'" style="'+mywidth+myheight+'margin-left: 10px;">'+pichtml+'</div>';
                    $('#'+preid).after(html);
                    resernum();
                }

            }
        });


    }
// 题型平均分数变更
    function titlescoresub(id)
    {
        var score=$('#'+id).val();
        if(publictestNum(score) && !$('#banner_8').prop('checked'))
        {
            score='（'+score+'分）';
            $('#page'+id).text(score);
            nowscoresub01();
        }
        else
        {
            $('#'+id).val('');
        }


    }
//页面类型
    function pagetypesub(typeid,tsernum) {
        var m=1;
        var myclass='';
        var titlekind;
        var typekind;
        var standclass='';
        var id=0;
        var tid=0;
        var tnum=1;
        var mysernum=0;


        if(tsernum==0)
        {
            //进入的数据，不是完形类型
            $("div[name='mytest']").each(function(){
                
                if($(this).hasClass("question") && $(this).hasClass(typeid))
                {
                    id=$(this).attr('id');
                    m=m+1;
                }
            });

            if(id==0)
            {
                $("div[name='mytest']").each(function(){

                    if($(this).hasClass("title") && $(this).hasClass(typeid))
                    {
                        id=$(this).attr('id');
                    }
                });


                return id+'+title+'+'1';
            }
            else
            {
            //判断上一个是不是完形
                mysernum=$('#'+id).attr('mysernum');

                if(mysernum==0)
                {
                    return id+'+question+'+m;
                }
                else
                {
                    $("div[tsernum="+mysernum+"]").each(function(){

                        tid=$(this).attr('id');

                    });

                    return tid+'+question+'+m;
                }

            }
        }
        else
        {

            //是完形类型

            $("div[tsernum="+tsernum+"]").each(function(){

            //判断有没有同类型的完形，如果有就取出id

                tid=$(this).attr('id');
                tnum=tnum+1;

            });

                //如果tid等于0，就意味着这里面没有完形类的习题
                if(tid==0)
                {
                    $("div[name='mytest']").each(function(){

                        if($(this).hasClass("question") && $(this).hasClass(typeid))
                        {
                            id=$(this).attr('id');
                            m=m+1;
                        }
                    });
                //找到这个类型的习题
                    if(id==0)
                    {
                        $("div[name='mytest']").each(function(){

                            if($(this).hasClass("title") && $(this).hasClass(typeid))
                            {
                                id=$(this).attr('id');
                            }
                        });
                        return id+'+title+'+'1';
                    }
                    else
                    {
                        return id+'+question+'+m;
                    }
                }
                //如果tid不等于返回值应该是已有完形的内容
                else
                {
                    return tid+'+tsernum+'+tnum;
                }
        }




    }
//重新编排编码
    function resernum() {
        var questionid=0;
        var questionmsg=0;
        var m=1;
        var num=0;
        var thisclass;
        var class_arr;
        var msgkind;
        var typearr='';
        $("div[name='mytest']").each(function(){
                questionid='question'+m;
                $(this).attr('id',questionid);
                thisclass=$(this).attr('class');
                class_arr=thisclass.split(' ');
                msgkind=class_arr[2];
                if(msgkind=='title')
                {
                    typearr=typearr+','+class_arr[3];
                    num=num+1;
                }
            m=m+1;
        });
        var n=1;
        $("div[name='testmsg']").each(function(){
                questionmsg='questionmsg'+n;
                $(this).attr('id',questionmsg);
            n=n+1;
        });

        typearr=typearr.substr(1);
        var arr=typearr.split(',');
        var sernum=1;
        var msg;
        for(var i=0;i<num;i++)
        {
            thisclass='row my_h2 question '+arr[i];
            $("div[class='"+thisclass+"']").each(function(){
                msg=sernum+'.';
                $(this).children("div").eq(0).html(msg);
                sernum=sernum*1+1;
            });

            sernum=1;
        }
    }

//进行习题自动分页
    function repagesub01() {
        var myid;
        var myclass;
        var sum=40;
        var nextsum=40;
        var myheight;
        var pagenum=1;
        var paginghtml='';
        var margintop='';
        var standheight=600;
        var allsum=40;
        var id;

        delpagesub();
        $("div[name='mytest']").each(function(){
            myid=$(this).attr('id');
            myclass=$('#'+myid).attr("class");
//大标题高度
            if($(this).hasClass("h3"))
            {
                nextsum=parseInt(sum)+44;
                allsum=parseInt(allsum)+44;
            }

            if($(this).hasClass("h6"))
            {
                nextsum=parseInt(sum)+24;
                allsum=parseInt(allsum)+24;
            }

            if($(this).hasClass("my_h1"))
            {
                nextsum=parseInt(sum)+30;
                allsum=parseInt(allsum)+30;
            }

            if($(this).hasClass("my_h2"))
            {
                if($('#banner_8').prop('checked'))
                {
                    nextsum=parseInt(sum)+30;
                    myheight=$(this).children("img").css("height");
                    myheight=onlynumsub(myheight);
                    nextsum=parseInt(nextsum)+parseInt(myheight);
                    allsum=parseInt(allsum)+parseInt(onlynumsub(myheight))+30;
                }
                else
                {
                    myheight=$(this).children("img").css("height");
                    myheight=onlynumsub(myheight);
                    nextsum=parseInt(nextsum)+parseInt(myheight);
                    allsum=parseInt(allsum)+parseInt(onlynumsub(myheight))+30;
                }



            }

            //953为页面内高度

            if(sum<=standheight && nextsum>=standheight)
            {
                if($(this).hasClass("my_h1"))
                {
                    myid='#question'+(onlynumsub(myid)-1);
                    margintop=standheight-sum+30+20;
                    margintop=margintop+'px';
                    paginghtml='<div id="questiona'+pagenum+'" class="row ctb_paging" name="mytest" style="margin-top: '+margintop+';">-'+pagenum+'-</div><div class="ctb_paging" style="height: 1px;background-color: #000000;margin-top: 28px;margin-bottom: 30px;width: 660px;"></div>';


                    $(myid).after(paginghtml);
                    sum=40+30;
                    nextsum=40+30;

                }
                else
                {
                    myid='#question'+(onlynumsub(myid)-1);
                    margintop=standheight-sum+20;
                    margintop=margintop+'px';
                    paginghtml='<div id="questiona'+pagenum+'" class="row ctb_paging" name="mytest" style="margin-top: '+margintop+';">-'+pagenum+'-</div><div class="ctb_paging" style="height: 1px;background-color: #000000;margin-top: 28px;margin-bottom: 30px;width: 660px;"></div>';
                    $(myid).after(paginghtml);
                    sum=40+parseInt(myheight);
                    nextsum=40+parseInt(myheight);
                }

                pagenum=pagenum+1;

            }

            sum=nextsum;
            id=$(this).attr('id');
        });
        id='#'+id;
        if(sum!=standheight && allsum>=standheight)
        {

            margintop=standheight-sum+20;
            margintop=margintop+'px';
            paginghtml='<div id="questiona'+pagenum+'" class="row ctb_paging" name="mytest" style="margin-top: '+margintop+';">-'+pagenum+'-</div>';
            $(id).after(paginghtml);
            sum=40+30+parseInt(myheight);
            nextsum=40+30+parseInt(myheight);
        }


    }

//进行分页
    function repagesub() {
        var myid;
        var myclass;
        var sum=40;
        var nextsum=40;
        var myheight;
        var pagenum=1;
        var paginghtml='';
        var margintop='';
        var standheight=600;
        var allsum=40;
        var id;
        var margin_top=40;
        var id_arr='';
        var mysernum;
        var height1_arr='';
        var height2_arr='';
        var num=1;
        var kind=2;

        if(!$('#banner_9').prop('checked'))
        {
            delpagesub();
            return;
        }


        $("div[name='mytest']").each(function(){
            height1_arr=height1_arr+','+$(this).attr('height1');
            height2_arr=height2_arr+','+$(this).attr('height2');
            id_arr=id_arr+','+$(this).attr('id');
            mysernum=$(this).attr('mysernum');
            num=num+1;

            if(mysernum!=0)
            {
                $("div[tsernum="+mysernum+"]").each(function(){
                    height1_arr=height1_arr+','+$(this).attr('height1');
                    height2_arr=height2_arr+','+$(this).attr('height2');
                    id_arr=id_arr+','+$(this).attr('id');
                    num=num+1;
                });
            }
        });


        id_arr=id_arr.substr(1);
        height1_arr=height1_arr.substr(1);
        height2_arr=height2_arr.substr(1);

        var tid=id_arr.split(',');
        var theight1=height1_arr.split(',');
        var theight2=height2_arr.split(',');
        var n;
        var sum1=0;
        var sum2=0;
        var nsum1=0;
        var nsum2=0;

        num=num-1;

        for(var m=0;m<num-1;m++)
        {
            n=m+1;

            sum1=sum1+theight1[m]*1;
            nsum1=sum1+theight1[n]*1;

            sum2=sum2+theight2[m]*1;
            nsum2=sum2+theight2[n]*1;

            if(kind==1)
            {
                if(nsum1>=standheight && sum1<=standheight)
                {

                    margintop=standheight-sum2+30+20;
                    paginghtml='<div id="questiona'+pagenum+'" class="row ctb_paging" name="mytest" style="margin-top: '+margintop+'px;margin-bottom: 40px;">-'+pagenum+'-</div>';
                    pagenum=pagenum+1;

                    $('#'+tid[m]).after(paginghtml);
                    nsum1=0;
                    sum1=0;
                }
            }
            else
            {
                if(nsum2>=standheight && sum2<=standheight)
                {
//                    alert("into:::nsum2:"+nsum2+",sum2:"+sum2+",m:"+m+",id:"+tid[m]+",t2:"+theight2[m]+",nt2:"+theight2[n]);
                    margintop=standheight-sum2+30+20;
                    paginghtml='<div id="questiona'+pagenum+'" class="row ctb_paging" name="mytest" style="margin-top: '+margintop+'px;margin-bottom: 40px;">-'+pagenum+'-</div>';
                    pagenum=pagenum+1;

                    $('#'+tid[m]).after(paginghtml);
                    nsum2=0;
                    sum2=0;

                }

            }

        }

        if(kind==1)
        {
            if(nsum1<=standheight)
            {
                margintop=standheight-sum2+30+20;
                paginghtml='<div id="questiona'+pagenum+'" class="row ctb_paging" name="mytest" style="margin-top: '+margintop+'px;margin-bottom: 20px;">-'+pagenum+'-</div>';
                pagenum=pagenum+1;
                $('#'+tid[n]).after(paginghtml);
            }
        }
        else
        {
            if(nsum2<=standheight)
            {
                margintop=standheight-sum2+30+20;
                paginghtml='<div id="questiona'+pagenum+'" class="row ctb_paging" name="mytest" style="margin-top: '+margintop+'px;margin-bottom: 20px;">-'+pagenum+'-</div>';
                pagenum=pagenum+1;
                $('#'+tid[n]).after(paginghtml);
            }
        }





    }

//清空分页
    function delpagesub() {
        $("div[class='ctb_paging']").remove();
        $("div[class='row ctb_paging']").remove();
    }

//绑定页面显示信息
    $("input[name='banner']").bind("click",function(){
        pagenotemsg();
    });
    //试卷动态加载提示信息
    function pagenotemsg()
    {
        var notemsg='';
        $("input[name='banner']:checked").each(function(){

            var val=$(this).val();

            if($(this).val()==1)
            {
                // 班级信息

                var classmsg='';

                var m=1;

                $("input[name='myclassobject']:checked").each(function(){
                    if(m==1)
                    {
                        classmsg=classmsg+$(this).attr('class');
                        m=2;
                    }
                    else
                    {
                        classmsg=classmsg+','+$(this).attr('class');
                    }
                });

                notemsg=notemsg+'&nbsp;&nbsp;班级：'+classmsg;
            }
            if($(this).val()==2)
            {
                //群组
                var groupmsg='';
                m=1;
                $("input[name='groupobject']:checked").each(function(){
                    if(m==1)
                    {
                        groupmsg=groupmsg+$(this).attr('class');
                        m=2;
                    }
                    else
                    {
                        groupmsg=groupmsg+','+$(this).attr('class');
                    }
                });
                notemsg=notemsg+'&nbsp;&nbsp;群组：'+groupmsg;
            }


            if($(this).val()==3)
            {
                //答题时间
                notemsg=notemsg+'&nbsp;&nbsp;时间:'+$('#testtime').val()+'小时';
            }
            if($(this).val()==4)
            {
                //考试日期
                var testdate=$('#testdate').val();
                notemsg=notemsg+'&nbsp;&nbsp;日期：'+testdate;
            }
            if($(this).val()==5)
            {
                //习题数量
                var testsumid=$('#testsumid').val();
                notemsg=notemsg+'&nbsp;&nbsp;题数:'+testsumid;
            }
            if($(this).val()==6)
            {
                //考试难度
                var testlevel=$('#testlevel').find("option:selected").text();

                if(testlevel=='请选择难度')
                {
                    testlevel='';
                }

                notemsg=notemsg+'&nbsp;&nbsp;难度:'+testlevel;
            }
            if($(this).val()==7)
            {
                //考试类型
                var testkindid=$('#testkindid').find("option:selected").text();


                if(testkindid=='请选择考试类型')
                {
                    testkindid='';
                }

                notemsg=notemsg+'&nbsp;&nbsp;类型:'+testkindid;

            }



        });

        $('#newquestionsum').val(questionsumsub());

        notemsg=notemsg+',分数：'+$('#questionscore').val()+',习题数量:'+questionsumsub();

        $('#ctb_h2').html(notemsg);
    }
    //预览答案图片
    function previewimg(src)
    {
        if(!$('#banner_12').prop("checked"))
        {
            return;
        }
        var html='<img  style="width: 680px;" src='+src+'>';
        $('#preview').css('display','');
        $('#preview').html(html);
    }
    //  关闭预览
    function closepriviewimg()
    {
        $('#preview').css('display','none');
    }
// 绑定预览函数
    $('#banner_12').bind("click",function(){
        if($('#banner_12').prop("checked"))
        {
            $('#preview').html('');
            $('#preview').css('display','');
        }
        else
        {
            $('#preview').css('display','none');
        }
    });

    //单题分数显示
    function onequestionscore()
    {

        if($('#banner_8').prop('checked'))
        {

            $("span[name='testscore']").each(function(){
                $(this).css('display','none');
            });

            $("input[name='onequestionscore']").css('display','');
            $("span[name='onequestionscore']").css('display','');
            $("br[name='onequestionscore']").css('display','');

        }
        else
        {
            $("span[name='testscore']").each(function(){
                $(this).css('display','');
            });

            $("input[name='onequestionscore']").css('display','none');
            $("span[name='onequestionscore']").css('display','none');
            $("br[name='onequestionscore']").css('display','none');

        }
    }
    //没有单题分数时候的总体分数
    function nowscoresub01()
    {
        var scorenum;
        var id;
        var num;
        var questionnum;
        var sum=0;
        var midsum=0;
        $("input[class='scorecss']").each(function(){
            scorenum=parseInt($(this).val());
            id=$(this).attr('id');
            num=onlynumsub(id);
            questionnum=parseInt($('#nownum'+num).text());
            midsum=scorenum*questionnum;
            sum=sum+midsum;
        });
        $('#questionscore').val(sum);
        pagenotemsg();
    }

    //有单题分数的时候的总体分数
    function nowscoresub02()
    {
        var num=0;
        $("input[class='onequestionscore']").each(function(){

            if($(this).val()=='')
            {
                num=num;
            }
            else
            {
                num=num+parseInt($(this).val());
            }

        });
        $('#questionscore').val(num);
        pagenotemsg();
    }

   function panneloversub(id){
       $("#"+id).removeAttr('class','panel_css');
       $("#"+id).attr('class','panel_choose_css');

    };
    //
    function panneloutsub(id){
        $("#"+id).removeAttr('class','panel_choose_css');
        $("#"+id).attr('class','panel_css');

    }
//两种条件下，求和公式。
    function scoresum(myobj)
    {
        var thisclass=myobj.getAttribute("class");

        if(thisclass=='onequestionscore')
        {
            if(publictestNum(myobj.value))
            {

                if($('#banner_8').prop('checked'))
                {
                    nowscoresub02();
                }
                else
                {
                    nowscoresub01();
                }
            }
            else
            {
                myobj.value='';
            }
        }
        else
        {

            if(publictestNum(myobj.value))
            {

                var num=myobj.getAttribute("num");
                var sum=parseInt(myobj.value)*num;

                var msg='×'+num+'=';

                $(myobj).next().text(msg);
                $(myobj).next().next().val(sum);


                if($('#banner_8').prop('checked'))
                {
                    nowscoresub02();
                }
                else
                {
                    nowscoresub01();
                }
            }
            else
            {
                myobj.value='';
                $(myobj).next().text('');
                $(myobj).next().next().val('');
            }
        }
    }

    //不需要验证的求和公式
    function scoresum01()
    {
            if($('#banner_8').prop('checked'))
            {
                nowscoresub02();
            }
            else
            {
                nowscoresub01();
            }
    }

    //点击弹出操作菜单
     function panelbuttonsub(ele)
     {
         var src=$(ele).attr('src');
         var kind;
         var sernum=0;
         var pare_id;



         if($(ele).parent('div').attr('name')=='mytest')
         {
             //普通问题
             kind='question';

             if($(ele).parent('div').attr('mysernum')!=0)
             {
                 kind='mysernum';
             }


             pare_id=$(ele).parent('div').attr('id');
         }
         else
         {
             //完形
             kind='tsernum';
             pare_id=$(ele).parent('div').parent('div').attr('id');
             sernum=$(ele).parent('div').parent('div').attr('tsernum');
         }

         $('#del_src').val(src);
         $('#del_kind').val(kind);
         $('#del_sernum').val(sernum);
         $('#del_pare_id').val(pare_id);

             var e = event || window.event;
             var x=e.pageX;
             var y=e.pageY;

         if($('#panel_div').css('display')=='none')
         {
             $('#panel_div').css('display','');

             $('#panel_div').css('left',x);
             $('#panel_div').css('top',y);
         }
         else
         {
             $('#panel_div').css('display','none');

             $('#panel_div').css('left',x);
             $('#panel_div').css('top',y);

         }

     }

     //初始化pagediv内容，更新后绑定内容，主要是选中样式
     function initdivsub()
     {
         var src;
         var src1;
         var mysernum;

         $("div[name='mytest']").each(function(){

           var  myclass=$(this).attr('class');
             if($(this).hasClass("question"))
             {
                 src=$(this).children('img').attr('src');
                 mysernum=$(this).attr('mysernum');

                 if(mysernum>0)
                 {
                     $("div[tsernum="+mysernum+"]").each(function(){
                         src=$(this).children('div').children('img').attr('src');
                         $("img[class='detail_title_img_css']").each(function(){

                             src1=$(this).attr('src');
                             if(src==src1)
                             {
                                 imgcsssub($(this).attr('id'));
                             }
                         });
                     });
                 }
                 else
                 {
                     $("img[class='detail_title_img_css']").each(function(){
                         src1=$(this).attr('src');
                         if(src==src1)
                         {
                             imgcsssub($(this).attr('id'));
                         }

                     });
                 }
             }
         });


         var typeid='';
         var questionid='';
         var n=0;
         $("div[class='row detail_list_row']").each(function(){

             typeid=typeid+','+$(this).attr('name');
             questionid=questionid+','+onlynumsub($(this).attr('id'));
             n=n+1;
         });

         typeid=typeid.substr(1);
         questionid=questionid.substr(1);
         var arr=typeid.split(',');
         var questionarr=questionid.split(',');

         var spanmsg='';
         var m=0;
         var questionname='';
         var thisid='';

         for(var i=0;i<n;i++)
         {
             $("img[class='detail_title_img_css img_choose_css']").each(function(){
                 questionname=$(this).attr('name');
                 if(arr[i]==questionname)
                 {
                     m=m+1;
                 }
             });

             $('#nownum'+questionarr[i]).text(m);
             m=0;
         }

         //进行多余字符删除操作
         delhtmlsub();

     }

//删除操作下的
    function delhtmlsub()
    {
        var num='';
        var typeid='';
        var idmsg='';
        var classmsg='';
        var classarr;
        var lengnum=0;

        $("div[name='mytest']").each(function(){

            idmsg=idmsg+','+$(this).attr('id');
            classarr=$(this).attr('class').split(' ');
            classmsg=classmsg+','+classarr[3];

        });

        idmsg=idmsg.substr(1);
        var typemsg=classmsg.substr(1);

        var typearr=typemsg.split(',');
        var idmsgarr=idmsg.split(',');

        var msgnum=typearr.length;



        var typename='';
        $("div[class='row detail_list_row']").each(function(){
            typename=typename+','+$(this).attr('name');
        });

        typename='0,'+typename.substr(1);
        var typenamearr=typename.split(',');
        var msgnum1=typenamearr.length;

        var n=0;
        for(var i=0;i<msgnum;i++)
        {
            for(var j=0;j<msgnum1;j++)
            {
                if(typenamearr[j]==typearr[i])
                {
                    n=n+1;
                }
            }

            if(n>0)
            {
                n=0;
            }
            else
            {
                $('#'+idmsgarr[i]).remove();
            }
        }
        scoresum01();
    }

    //习题总数
    function questionsumsub()
    {
        var num=0;
        $("img[class='detail_title_img_css img_choose_css']").each(function(){
            num=num+1;
        });
        return num;
    }

    // 绑定预览函数
    $("input[name='bannerradio']").bind("click",function(){
        var msg=$(':radio[name="bannerradio"]:checked').val();
        if(msg=='question')
        {
            $('#answer_img_id').css('display','none');
            $('#test_img_id').css('display','');
        }
        else
        {

            var title_h1=$('#ctb_h1').html();
            var title_h2=$('#ctb_h2').html();
            answer_sub(title_h1,title_h2);
            $('#test_img_id').css('display','none');
            $('#answer_img_id').css('display','');
        }

    });

    //答案函数，需要具体验证，可能出现问题，主要是完形的图片的问题。
    function answer_sub(title_h1,title_h2)
    {

        var myclass='';
        var myid='';
        var answerhtml='';
        var answerid='answer';
        var num=1;
        var mylength=$("div[name='mytest']").length;
        var msgarr=new Array();
        var answer_img_ratio=$('#answer_img_ratio').val();
        var font_size=7;



        msgarr['kind']=0;
        msgarr['text']=0;
        msgarr['src']=0;
        msgarr['x']=0;
        msgarr['y']=0;
        msgarr['answersrc']=0;
        msgarr['textlength']=0;
        var thissrc='';

        $("div[name='mytest']").each(function(){
            myid=$(this).attr('id');
            myclass=$('#'+myid).attr("class");
//大标题
            if($(this).hasClass("h3"))
            {
                msgarr['kind']=msgarr['kind']+'#,'+'h3';
                msgarr['text']=msgarr['text']+'#,'+$('#ctb_h1').html()+'答案';
                msgarr['textlength']=msgarr['textlength']+'#,'+0;

                msgarr['src']=msgarr['src']+'#,'+'0';
                msgarr['x']=msgarr['x']+'#,'+'0';
                msgarr['y']=msgarr['y']+'#,'+'0';
                msgarr['answersrc']=msgarr['answersrc']+'#,'+0;
                num=num+1;
            }
//副标题
            if($(this).hasClass("h6"))
            {
                msgarr['kind']=msgarr['kind']+'#,'+'h6';
                msgarr['text']=msgarr['text']+'#,'+$('#ctb_h2').html();
                msgarr['src']=msgarr['src']+'#,'+'0';
                msgarr['x']=msgarr['x']+'#,'+'0';
                msgarr['y']=msgarr['y']+'#,'+'0';
                msgarr['answersrc']=msgarr['answersrc']+'#,'+0;
                msgarr['textlength']=msgarr['textlength']+'#,'+0;
                num=num+1;
            }
//一级标题
            if($(this).hasClass("my_h1"))
            {
                msgarr['kind']=msgarr['kind']+'#,'+'title';
                msgarr['textlength']=msgarr['textlength']+'#,'+getByteLen($(this).children('div').children('div').html())*(font_size);
                msgarr['text']=msgarr['text']+'#,'+$(this).children('div').children('div').html();
                msgarr['src']=msgarr['src']+'#,'+'0';
                msgarr['x']=msgarr['x']+'#,'+'0';
                msgarr['y']=msgarr['y']+'#,'+'0';
                msgarr['answersrc']=msgarr['answersrc']+'#,'+0;

                num=num+1;
            }
//习题
            if($(this).hasClass("my_h2"))
            {
                var mysernum=$(this).attr('mysernum');

//不是完形类型的习题
                if(mysernum==0)
                {
                    msgarr['kind']=msgarr['kind']+'#,'+'question';
                    msgarr['text']=msgarr['text']+'#,'+$(this).children('div').html();
                    var thistext=$(this).children('div').html();
                    thissrc=$(this).children('img').attr('src');
                    msgarr['src']=msgarr['src']+'#,'+$(this).children('img').attr('src');


                    $("img[class='detail_title_img_css img_choose_css']").each(function(){
                        if($(this).attr('src')==thissrc)
                        {
                            var answermsg=$(this).prev('input').val();
                            var answerarr=answermsg.split(' ');
                            var answersrc=answerarr[1];
                            var x_length=Math.round(answerarr[2]*answer_img_ratio);

                            msgarr['x']=msgarr['x']+'#,'+Math.round(answerarr[2]*answer_img_ratio);
                            msgarr['y']=msgarr['y']+'#,'+Math.round(answerarr[3]*answer_img_ratio);
                            msgarr['answersrc']=msgarr['answersrc']+'#,'+answersrc;
                            var textlength=getByteLen(thistext)*(font_size);

                            var questionsum=textlength*1+x_length*1+10*1;
                            msgarr['textlength']=msgarr['textlength']+'#,'+questionsum;
                        }

                    });

                    num=num+1;
                }
                else
                {

                    //完形类型的习题，标题保留
                    msgarr['kind']=msgarr['kind']+'#,'+'title';
                    msgarr['textlength']=msgarr['textlength']+'#,'+getByteLen($(this).children('div').html())*(font_size);
                    msgarr['text']=msgarr['text']+'#,'+$(this).children('div').html();
                    msgarr['src']=msgarr['src']+'#,'+'0';
                    msgarr['x']=msgarr['x']+'#,'+'0';
                    msgarr['y']=msgarr['y']+'#,'+'0';
                    msgarr['answersrc']=msgarr['answersrc']+'#,'+0;
                    num=num+1;


                    //进入完形类型题型的答案
                    $("div[tsernum="+mysernum+"]").each(function(){
                        msgarr['kind']=msgarr['kind']+'#,'+'question';
                        msgarr['text']=msgarr['text']+'#,'+$(this).children('span').html();
                        var thistext=$(this).children('span').html();
                        thissrc=$(this).children('div').children('img').attr('src');
                        msgarr['src']=msgarr['src']+'#,'+$(this).children('div').children('img').attr('src');


                        $("img[class='detail_title_img_css img_choose_css']").each(function(){
                            if($(this).attr('src')==thissrc)
                            {
                                var answermsg=$(this).prev('input').val();
                                var answerarr=answermsg.split(' ');
                                var answersrc=answerarr[1];
                                var x_length=Math.round(answerarr[2]*answer_img_ratio);

                                msgarr['x']=msgarr['x']+'#,'+Math.round(answerarr[2]*answer_img_ratio);
                                msgarr['y']=msgarr['y']+'#,'+Math.round(answerarr[3]*answer_img_ratio);
                                msgarr['answersrc']=msgarr['answersrc']+'#,'+answersrc;
                                var textlength=getByteLen(thistext)*(font_size);

                                var questionsum=textlength*1+x_length*1+10*1;
                                msgarr['textlength']=msgarr['textlength']+'#,'+questionsum;
                            }

                        });

                        num=num+1;


                    });

                }

            }

        });

        msgarr['kind']=msgarr['kind'].substr(3)+'#,'+0;
        msgarr['text']=msgarr['text'].substr(3)+'#,'+0;
        msgarr['src']=msgarr['src'].substr(3)+'#,'+0;
        msgarr['x']=msgarr['x'].substr(3)+'#,'+0;
        msgarr['y']=msgarr['y'].substr(3)+'#,'+0;
        msgarr['answersrc']=msgarr['answersrc'].substr(3)+'#,'+0;
        msgarr['textlength']=msgarr['textlength'].substr(3)+'#,'+0;


        var kind_arr= msgarr['kind'].split('#,');
        var text_arr= msgarr['text'].split('#,');
        var src_arr= msgarr['src'].split('#,');
        var x_arr= msgarr['x'].split('#,');
        var y_arr= msgarr['y'].split('#,');
        var answersrc_arr= msgarr['answersrc'].split('#,');
        var textlength_arr= msgarr['textlength'].split('#,');


        var endhtml='</div>';
        var maxwidth=660;
        var thisheight=0;
        var thiswidth=0;
        var texthtml='';
        var imghtml='';
        var answerhtml='';
        var m=3;
        var detailnum=1;
        var coverhtml= '';
        var myhtml='';
        var kind=0;
        var remainhtml='';
        var thisparthtml='';
        var nextwidth=0;
        var j=0;

        for(var i=2;i<num-1;i++)
        {
            coverhtml= '<div id="answer'+m+'" class="row" style="text-align: left;vertical-align: top; margin-top: 30px;">';
            texthtml='<div id="answer_detail'+detailnum+'" style="float: left;margin-left: 10px;">'+text_arr[i]+'</div>';
            if(answersrc_arr[i]==0)
            {
                answersrc_arr[i]='/uploads/0.png';
            }
            imghtml='<img id="img_detail'+detailnum+'" style="width: '+x_arr[i]+'px;height:'+y_arr[i]+'px;float: left;"  src="'+answersrc_arr[i]+'">';


            if(thiswidth<maxwidth && nextwidth<maxwidth)
            {
                j=i*1+1;
                thiswidth=thiswidth*1+textlength_arr[i]*1;
                nextwidth=thiswidth+textlength_arr[j]*1;

                    answerhtml=answerhtml+texthtml+imghtml;
                    detailnum=detailnum+1;
                    remainhtml=answerhtml;
                    if(thisheight<y_arr[i])
                    {
                        thisheight=y_arr[i];
                    }

            }
            else
            {

                thisparthtml=coverhtml+answerhtml+'</div>';
                myhtml=myhtml+thisparthtml;
                i=i-1;
                thisheight=0;
                thiswidth=0;
                detailnum=1;
                m=m+1;
                kind=1;
                remainhtml='';
                answerhtml='';
                nextwidth=0;
            }
        }

        if(remainhtml!='')
        {
            myhtml=myhtml+coverhtml+remainhtml+'</div>';
        }

        var titlehtml='<div id="answer1" class="row h3 0 0" name="myanswer"><div id="answer_h1">'+title_h1+'答案</div><div id="answermsg1" name="answermsg"></div></div><div id="answer2" class="row h6 0 0"  name="myanswer"><div id="answer_h2">'+title_h2+'</div><div id="answermsg2" name="answermsg"></div></div>';

        $('#answer_img_id').html(titlehtml+myhtml);

}

//进行删除操作
    function delsub()
    {
        var src=$('#del_src').val();
        var kind=$('#del_kind').val();
        var sernum=$('#del_sernum').val();
        var pare_id=$('#del_pare_id').val();

//        alert(kind);

        if(kind=='question')
        {
            $("img[class='detail_title_img_css img_choose_css']").each(function(){
                if($(this).attr('src')==src)
                {
                    $(this).attr('class','detail_title_img_css');
                }
            });
            $('#'+pare_id).remove();
            resernum();
        }
        if(kind=='tsernum')
        {

            $("img[class='detail_title_img_css img_choose_css']").each(function(){
                if($(this).attr('src')==src)
                {
                    $(this).attr('class','detail_title_img_css');
                }
            });



            var length=$("div[tsernum='"+sernum+"']").length;



            if(length==1)
            {
                $("div[mysernum='"+sernum+"']").remove();
            }
            $('#'+pare_id).remove();
            serresernum(sernum);
        }
        $('#panel_div').css('display','none');
    }


    //进行删除操作
    function hasimgsub()
    {

        $("div[name='mytest']").each(function(){
            var src=$(this).children('img').attr('src');
            if(typeof(src)!='undefined')
            {
                $("img[class='detail_title_img_css']").each(function(){
                    if($(this).attr('src')==src)
                    {
                        $(this).attr('class','detail_title_img_css img_choose_css');
                    }
                });
            }
        });




    }

//元素上移，,两个相邻的完形移动的时候，需要测试。？？？
    function preele(){
        var src=$('#del_src').val();
        var kind=$('#del_kind').val();
        var sernum=$('#del_sernum').val();
        var pare_id=$('#del_pare_id').val();
        var pre_id=$('#'+pare_id).prev().attr('id');
        var tsernum=$('#'+pare_id).prev().attr('tsernum');




        if(kind=='question')
        {
            if(typeof(tsernum)=='undefined')
            {
                tsernum=0;
            }

            if(tsernum!=0)
            {
                pre_id=beginserele(tsernum);
            }

            if($('#'+pare_id).prev().hasClass('title'))
            {
                alert('无法移动！！');
                $('#panel_div').css('display','none');
            }
            else
            {

                $("#"+pre_id).before($("#"+pare_id));
                resernum();
            }

        }

        if(kind=='tsernum')
        {
            if($('#'+pare_id).prev().hasClass('question'))
            {
                alert('无法移动！！');
                $('#panel_div').css('display','none');
            }
            else
            {

                $("#"+pre_id).before($("#"+pare_id));
                serresernum(sernum);
            }
        }

        if(kind=='mysernum')
        {
            if(typeof(tsernum)=='undefined')
            {
                tsernum=0;
            }


            if(tsernum!=0)
            {
                pre_id=beginserele(tsernum);
            }

            if($('#'+pare_id).prev().hasClass('title'))
            {
                alert('无法移动！！');
                $('#panel_div').css('display','none');
            }
            else
            {
                tsernum=$('#'+pare_id).attr('mysernum');

//                $("#"+pre_id).before($("#"+pare_id));
                preserele(pare_id,pre_id,tsernum);
                resernum();
            }

        }

        $('#panel_div').css('display','none');


    }

//元素向下移动,两个相邻的完形移动的时候，需要测试。？？？
    function nextele(){
        var src=$('#del_src').val();
        var kind=$('#del_kind').val();
        var sernum=$('#del_sernum').val();
        var pare_id=$('#del_pare_id').val();
        var next_id=$('#'+pare_id).next().attr('id');

        var mysernum=$('#'+pare_id).next().attr('mysernum');


        if(typeof(next_id)=='undefined')
        {
            alert('无法移动！！');
            $('#panel_div').css('display','none');
            return;
        }

        if(kind=='question')
        {
            if(typeof(mysernum)=='undefined')
            {
                mysernum=0;
            }


            if(mysernum!=0)
            {
                next_id=lastserele(mysernum);
            }


            if($('#'+pare_id).next().hasClass('title'))
            {
                alert('无法移动！！');
                $('#panel_div').css('display','none');
            }
            else
            {

                $("#"+next_id).after($("#"+pare_id));
                resernum();
            }

        }

        if(kind=='tsernum')
        {
            if($('#'+pare_id).next().hasClass('question') || $('#'+pare_id).next().hasClass('title') )
            {
                alert('无法移动！！');
                $('#panel_div').css('display','none');
            }
            else
            {

                $("#"+next_id).after($("#"+pare_id));
                serresernum(sernum);
            }
        }

        if(kind=='mysernum')
        {

            mysernum=$('#'+pare_id).attr('mysernum');
            var lastid=lastserele(mysernum);

            //当前完形最后一个习题的序号

            mysernum=$('#'+lastid).next().attr('mysernum');
            next_id=$('#'+lastid).next().attr('id');

            //完形最后一道题下面的习题的mysernum及nextid；

            if(typeof(next_id)=='undefined')
            {
                alert('无法移动！！');
                $('#panel_div').css('display','none');
                return;
            }

            //求出序号是否被定义，确定下一个是什么习题还是完形

            if(typeof(mysernum)=='undefined')
            {
                mysernum=0;
            }

            //如果是下一道题完形，就求出来完形中最后的下一个序号。

            if(mysernum!=0)
            {
                next_id=lastserele(mysernum);
            }

            //下一道题中有title，就证明是标题，也就是说无法移动。

            if($('#'+next_id).next().hasClass('title'))
            {
                alert('无法移动！！');
                $('#panel_div').css('display','none');
            }
            else
            {

                //不是标题，就进行移动。

                mysernum=$('#'+pare_id).attr('mysernum');

                nextserele(pare_id,next_id,mysernum);
                resernum();
            }

        }



        $('#panel_div').css('display','none');
    }

    //完形内部重新排序
    function serresernum(sernum)
    {
        var id='';
        var num=1;
        var notemsg='';

        $("div[tsernum='"+sernum+"']").each(function(){
            id=sernum+'tser_div_'+num;
            notemsg='('+num+')';
            $(this).attr('id',id);
            $(this).children('span').text(notemsg);
            num=num+1;

        });
    }

    //完形取得最开始元素
    function beginserele(sernum)
    {
        var beginid;
        beginid=$("div[mysernum='"+sernum+"']").attr('id');
        return beginid;
    }

    //完形取得最后元素
    function lastserele(sernum)
    {
        var lastid;

        $("div[tsernum='"+sernum+"']").each(function(){

            lastid=$(this).attr('id');

        });

        return lastid;
    }

//完形类型向上移动
    function preserele(pare_id,pre_id,sernum)
    {

        var pre_id=pre_id;
        var pare_id=pare_id;

         $("#"+pre_id).before($("#"+pare_id));
         pre_id=pare_id;

        $("div[tsernum='"+sernum+"']").each(function(){
            pare_id=$(this).attr('id');
            $("#"+pre_id).after($("#"+pare_id));
            pre_id=pare_id;
        });

    }

    //完形类型向下移动
    function nextserele(pare_id,next_id,mysernum)
    {
        var next_id=next_id;
        var pare_id=pare_id;
        var mysernum=mysernum;

        $("#"+next_id).after($("#"+pare_id));

        next_id=pare_id;

        $("div[tsernum='"+mysernum+"']").each(function(){
            pare_id=$(this).attr('id');
            $("#"+next_id).after($("#"+pare_id));
            next_id=pare_id;
        });

    }

    //试卷存储
    function testsavesub(){
        papermsg();

       // alert('userid：'+userid+'，filesernum：'+filesernum+'，title:'+title+',testdate:'+testdate+',testtime:'+testtime+',subjectid:'+subjectid+',testkindid:'+testkindid+',testgrade_arr:'+testgrade_arr+',testchapter_arr:'+testchapter_arr+',testkeynote_arr:'+testkeynote_arr+',testlevel:'+testlevel+',myclassobject_arr:'+myclassobject_arr+',groupobject_arr:'+groupobject_arr+',othernote:'+other_note);
    }

    function testlist(){
        window.location.href ="/index.php/Home/buildpaper/buildlist02/userid/"+$('#userid').val()+".html";
    }

    //单个习题信息插入
    function questionsavesub(){

        var srcid;
        var in_ser=1;
        var pic1;
        var pic2;
        var pic3;
        var pic4;
        var tsernum;
        var ctbname;
        var kind;
        var picsum;
        var inputname;
        var inputval;
        var filesernum=$('#filesernum').val();
        var align;
        var imgdisplay;
        var pagenum;
        var answerid1='0';
        var typeid;
        var questionnum;
        var questionscore;

        var testdetailmsg='';
        var thismsg;
        var thisclass;
        var picmsg;
        var picid;

        var titlekind=$('#banner_8').prop('checked');


        $("div[name='mytest']").each(function(){

            thisclass=$(this).attr('class');
            var class_arr=thisclass.split(' ');
            typeid=class_arr[3];


          if($(this).hasClass("title"))
          {
              srcid='0';pic1='0';pic2='0';pic3='0';pic4='0';tsernum='0';ctbname='t0';kind='test';picsum='0';
              inputname='title';imgdisplay='none';

              if(titlekind)
              {
                  inputval=$(this).children('div').children('div').html();
                  questionscore='0';
              }
              else
              {
                  inputval=$(this).children('div').children('div').html()+$(this).children('div').children('span').text();

                  questionscore=onlynumsub($(this).children('div').children('span').text());

                  $('#prequestionscore').val(questionscore);
              }

              filesernum=$('#filesernum').val();align='left';imgdisplay='none';pagenum='1';answerid1='';
              questionnum='1';



              thismsg=srcid+','+in_ser+','+pic1+','+pic2+','+pic3+','+pic4+','+tsernum+','+ ctbname+','+kind+','+picsum+','+ inputname+','+inputval+','+ filesernum+','+ align+','+imgdisplay+','+ pagenum+','+ answerid1+','+ typeid+','+ questionnum+','+ questionscore;


              testdetailmsg=testdetailmsg+'#'+thismsg;

              in_ser=in_ser*1+1;
          }


          if($(this).hasClass("question"))
          {
              if($(this).attr('mysernum')==0)
              {

                  var src=$(this).children('img').attr('src');


                  $("img[class='detail_title_img_css img_choose_css']").each(function(){

                      if($(this).attr('src')==src)
                      {
                          srcid=hassrcid($(this).attr('id'));
                          picmsg=$(this).attr('picmsg');
                          picid=$(this).attr('picid');
                          var class_arr=picmsg.split(',');
                          var picid_arr=picid.split(' ');


                          picsum=class_arr[0];

                          pic1=picid_arr[0];
                          pic2=picid_arr[1];
                          pic3=picid_arr[2];
                          pic4=picid_arr[3];



                      }

                  });



                  tsernum='0';ctbname='t-a';kind='test';
                  inputname='titleanswer';imgdisplay='block';

                  if(titlekind)
                  {

                      inputval=$(this).children('div').html()+$(this).children('input').val()+$(this).children('span').text();
                      questionscore=onlynumsub($(this).children('input').val());

                  }
                  else
                  {
                      inputval=$(this).children('div').html();
                      questionscore=$('#prequestionscore').val();

                  }



                  filesernum=$('#filesernum').val();align='left';pagenum='1';answerid1='';
                  questionnum='1';



                  thismsg=srcid+','+in_ser+','+pic1+','+pic2+','+pic3+','+pic4+','+tsernum+','+ ctbname+','+kind+','+picsum+','+ inputname+','+inputval+','+ filesernum+','+ align+','+imgdisplay+','+ pagenum+','+ answerid1+','+ typeid+','+ questionnum+','+ questionscore;



                  testdetailmsg=testdetailmsg+'#'+thismsg;

                  in_ser=in_ser*1+1;
              }
              else
              {
                  var src=$(this).children('img').attr('src');


                  $("img[class='detail_title_img_css img_choose_css']").each(function(){

                      if(hasstring(src,$(this).attr('tsermsg')))
                      {
                          srcid=hassrcid($(this).attr('t1_id'));
                          picmsg=$(this).attr('picmsg');
                          picid=$(this).attr('picid');
                          var class_arr=picmsg.split(',');
                          var picid_arr=picid.split(' ');

                          picsum=class_arr[0];
                          pic1=picid_arr[0];
                          pic2=picid_arr[1];
                          pic3=picid_arr[2];
                          pic4=picid_arr[3];

                      }

                  });



                  tsernum=$(this).attr('mysernum');ctbname='t1';kind='test';
                  inputname='title';imgdisplay='block';

                  if(titlekind)
                  {

                      inputval=$(this).children('div').html()+' '+$(this).children('div').next().val()+$(this).children('div').next().next().text()+$(this).children('div').next().next().next().val()+$(this).children('div').next().next().next().next().text();

                      questionscore=onlynumsub($(this).children('div').next().next().next().val());
                      $('#preserquestionscore').val($(this).children('div').next().val());

                  }
                  else
                  {
                      inputval=$(this).children('div').html();


                      questionscore= $('#prequestionscore').val()*$("div[tsernum='"+tsernum+"']").length;
                  }





                  filesernum=$('#filesernum').val();align='left';pagenum='1';answerid1='';
                  questionnum='1';





                  thismsg=srcid+','+in_ser+','+pic1+','+pic2+','+pic3+','+pic4+','+tsernum+','+ ctbname+','+kind+','+picsum+','+ inputname+','+inputval+','+ filesernum+','+ align+','+imgdisplay+','+ pagenum+','+ answerid1+','+ typeid+','+ questionnum+','+ questionscore;



                  testdetailmsg=testdetailmsg+'#'+thismsg;

                  in_ser=in_ser*1+1;


                  $("div[tsernum='"+tsernum+"']").each(function(){

                      var src=$(this).children('div').children('img').attr('src');



                      $("img[class='detail_title_img_css img_choose_css']").each(function(){



                          if(hasstring(src,$(this).attr('src')))
                          {
                              srcid=hassrcid($(this).attr('id'));

                              //alert(srcid);

                              picmsg=$(this).attr('picmsg');
                              picid=$(this).attr('picid');
                              typeid=$(this).attr('name');
                              var class_arr=picmsg.split(',');
                              var picid_arr=picid.split(' ');

                              picsum=class_arr[0];
                              pic1=picid_arr[0];
                              pic2=picid_arr[1];
                              pic3=picid_arr[2];
                              pic4=picid_arr[3];

                          }

                      });


                      ctbname='a';kind='test';
                      inputname='answer';imgdisplay='block';

                      if(titlekind)
                      {

                          inputval=$(this).children('span').text();


                          questionscore=$('#preserquestionscore').val();

                      }
                      else
                      {
                          inputval=$(this).children('span').text();
                          questionscore=$('#prequestionscore').val();

                      }

                      filesernum=$('#filesernum').val();align='left';pagenum='1';answerid1='';
                      questionnum='1';

                      thismsg=srcid+','+in_ser+','+pic1+','+pic2+','+pic3+','+pic4+','+tsernum+','+ ctbname+','+kind+','+picsum+','+ inputname+','+inputval+','+ filesernum+','+ align+','+imgdisplay+','+ pagenum+','+ answerid1+','+ typeid+','+ questionnum+','+ questionscore;

                      testdetailmsg=testdetailmsg+'#'+thismsg;

                      in_ser=in_ser*1+1;


                      
                  });
              }
          }

        });

        testdetailmsg=testdetailmsg.substr(1);


        $.ajax({
            url: "<?php echo U('questionsavesub');?>",
            data: {testdetailmsg:testdetailmsg},
            dataType: 'json',
            type: 'post',
            success: function (re) {
                window.location.href ="/index.php/Home/buildpaper/buildlist02/userid/"+$('#userid').val()+".html";
            }
        });
    }

    //试卷存储信息
    function papermsg()
    {
        var title=$('#testtitle').val();
        var testdate=$('#testdate').val();
        var testtime=$('#testtime').val();
        var subjectid=$('#subjectid').find("option:selected").val();
        var testkindid=$('#testkindid').find("option:selected").val();
        var testnote=$('#ctb_h2').html();
        var score_kind;
        if($('#banner_8').prop('checked'))
        {
            score_kind=2;
        }
        else
        {
            score_kind=1;
        }



        if(title=='')
        {
            alert('试卷标题不能为空！！');
            return;
        }

        if(testdate=='')
        {
            alert('请输入考试日期！！');
            return;
        }

        if(testtime=='')
        {
            alert('请输入考试日期！！');
            return;
        }

        if(subjectid==0)
        {
            alert('请选择考试科目类型！！');
            return;
        }

        if(testkindid==0)
        {
            alert('请选择考试类型！！');
            return;
        }




        var testgrade_arr='';
        $("input[name='testgradeobject']:checked").each(function(){
            testgrade_arr=testgrade_arr+','+$(this).val();
        });
        testgrade_arr=testgrade_arr.substr(1);

        if(testgrade_arr=='')
        {
            alert('请输入试卷年级！！');
            return;
        }

        var testchapter_arr='';
        $("input[name='testchapterobject']:checked").each(function(){
            testchapter_arr=testchapter_arr+','+$(this).val();
        });
        testchapter_arr=testchapter_arr.substr(1);



        var testkeynote_arr='';
        $("input[name='testkeynoteobject']:checked").each(function(){

            testkeynote_arr=testkeynote_arr+','+$(this).val();
        });


        testkeynote_arr=testkeynote_arr.substr(1);



        var testlevel=$('#testlevel').find("option:selected").val();


        if(testlevel==0)
        {
            alert('请选择试卷难度！！');
            return;
        }


        var myclassobject_arr='';
        $("input[name='myclassobject']:checked").each(function(){
            myclassobject_arr=myclassobject_arr+','+$(this).val();
        });
        myclassobject_arr=myclassobject_arr.substr(1);


        var groupobject_arr='';
        $("input[name='groupobject']:checked").each(function(){
            groupobject_arr=groupobject_arr+','+$(this).val();
        });
        groupobject_arr=groupobject_arr.substr(1);

        var other_note=$('#other_note').val();

        var userid=$('#userid').val();

        var filesernum=createfilesernum(userid);
        $('#filesernum').val(filesernum);
        var questionsum=$('#newquestionsum').val();


        $.ajax({
            url: "<?php echo U('testsavesub');?>",
            data: {userid:userid,filesernum:filesernum,title:title,testdate:testdate,testtime:testtime,subjectid:subjectid,testkindid:testkindid,testgrade_arr:testgrade_arr,testchapter_arr:testchapter_arr,testkeynote_arr:testkeynote_arr,testlevel:testlevel,myclassobject_arr:myclassobject_arr,groupobject_arr:groupobject_arr,other_note:other_note,testnote:testnote,questionsum:questionsum,score_kind:score_kind},
            dataType: 'json',
            type: 'post',
            success: function (re) {
                questionsavesub();
            }
        });
    }
    function prepagesub(typeid){

        var nowpage=$('#nowpage'+typeid).text();
        var pagelength=$('#pagelength').val();
        var thishtml='';
        if(nowpage==1)
        {
            alert('已经是第一页');
            return;
        }
        else
        {
            nowpage=nowpage-1;
            $('#nowpage'+typeid).text(nowpage);

            thishtml=testsearch(typeid,nowpage,pagelength);
            $('#content'+typeid).html(thishtml);
            testidtitlebind(typeid);
            initdivsub();
            hasimgsub();

        }

    }

    function nextpagesub(typeid){

        var nowpage=$('#nowpage'+typeid).text();
        var pagenum=$('#pagenum'+typeid).text();
        var pagelength=$('#pagelength').val();
        var thishtml='';

        if(nowpage==pagenum)
        {
            alert('已经是最后一页');
            return;
        }
        else
        {
            nowpage=nowpage*1+1;
            $('#nowpage'+typeid).text(nowpage);
            thishtml=testsearch(typeid,nowpage,pagelength);
            $('#content'+typeid).html(thishtml);
            testidtitlebind(typeid);
            initdivsub();
            hasimgsub();
        }

    }

    function testtitlesub(ele){
        var show=$(ele).attr('show');
        var myele=$(ele).parent('div').parent('div').next();
        if(show==1)
        {
            $(myele).css('display','none');
            $(ele).attr('show','0');
        }
        else
        {
            $(myele).css('display','');
            $(ele).attr('show','1');
        }
    }

    //绑定题库中的已有类型
    function hastypesub()
    {
        $('#hastitlelevel').empty();
        var html='';
        var id='';
        var vallength='';
        $("select[name='questiontype']").each(function(){

            vallength=$(this).val();
            if(typeof(vallength)=='string')
            {
                id=$(this).attr('id');
                html=html+'<option value="'+$(this).val()+'">'+$("#"+id+" option:selected").text()+'</option>';
            }

         });

//      alert(html);
        $('#hastitlelevel').html(html);
    }

//索引详细列表
    function searchdetaillistsub(typeid)
    {

        var id=$('#userid').val();
        var pagelength=$('#pagelength').val();
        var titlehtml=testsearch(typeid,1,pagelength);


        var contentid='#content'+typeid;

        $(contentid).html(titlehtml);

        var nowpage_num='#nowpage'+typeid;
        var pagenum_num='#pagenum'+typeid;

        $(nowpage_num).text($('#nowpage_x').val());
        $(pagenum_num).text($("#pagenum_x").val());


        //绑定具体习题
      testidtitlebind(typeid);



    }

//索引习题列表
    function searchtestidtitlebind(mytypeid)
    {

        var mytypeid=$('#hastitlelevel').val();
//        alert(typeid);
//        return;
        var testid='';
        var typeid='';

        var classid=$("input[name='iclassobject']:checked").val();
        var groupid=$('#mygroup03').find("option:selected").val();

        var no1ration=$('#no1ration').val();
        var no2ration=$('#no2ration').val();

        var no1testtime=$('#no1testtime').val();
        var no2testtime=$('#no2testtime').val();

        var questionorder=$('#questionorder').find("option:selected").val();

        var id='';


        $("div[name='testidtitle']").each(function(){

            id='ol'+$(this).attr('id');
            typeid=$(this).attr('class').replace(/col-xs-12 detail_title_css /ig, '');
            testid=$(this).attr('id').replace(typeid+'-', '');

            if(typeid==mytypeid)
            {

                $.ajax({
                    url:"<?php echo U('phpbindtestdetail');?>",
                    data:{testid:testid,typeid:typeid,groupid:groupid,classid:classid,no1ration:no1ration,no2ration:no2ration,no1testtime:no1testtime,no2testtime:no2testtime,questionorder:questionorder},
                    datatype:'json',
                    type:'post',
                    async : false,
                    success:function (re) {
                        var msg='';
                        var titledetail=eval("("+re+")");
                        var count=titledetail['count'];
                        var typeid=titledetail['typeid'];
                        var tsernumcss='';
                        var colormsg='';
                        var notemsg='';
                        for(var i=0;i<count;i++)
                        {
                            if(titledetail[i]['kind']=='Up')
                            {
                                titledetail[i]['ratio']='<span style="color: red">'+titledetail[i]['ratio']+'</span>'
                            }
                            if(titledetail[i]['kind']=='Down')
                            {
                                titledetail[i]['ratio']='<span style="color: darkgreen">'+titledetail[i]['ratio']+'</span>'
                            }
                            if(titledetail[i]['kind']=='Equ')
                            {
                                titledetail[i]['ratio']='<span style="color: blue;">Equ</span>';
                            }
                            var picsum=titledetail[i]['picsum'];
                            var pic1_src=titledetail[i]['pic1_src'];
                            var pic1_width=titledetail[i]['pic1_width'];
                            var pic1_height=titledetail[i]['pic1_height'];

                            var pic2_src=titledetail[i]['pic2_src'];
                            var pic2_width=titledetail[i]['pic2_width'];
                            var pic2_height=titledetail[i]['pic2_height'];

                            var pic3_src=titledetail[i]['pic3_src'];
                            var pic3_width=titledetail[i]['pic3_width'];
                            var pic3_height=titledetail[i]['pic3_height'];

                            var pic4_src=titledetail[i]['pic4_src'];
                            var pic4_width=titledetail[i]['pic4_width'];
                            var pic4_height=titledetail[i]['pic4_height'];
                            var picid=titledetail[i]['pic1_id']+' '+titledetail[i]['pic2_id']+' '+titledetail[i]['pic3_id']+' '+titledetail[i]['pic4_id'];
                            var t1_id=titledetail[i]['t1_id'];
                            if(titledetail[i]['t1_sernum']>0)
                            {
                                if($('#tsernum').val()==0)
                                {
                                    $('#tsernum').val(titledetail[i]['t1_sernum']);
                                    $('#tsernum_color').val('blue');
                                    colormsg='blue';
                                }
                                else
                                {
                                    if($('#tsernum').val()!=titledetail[i]['t1_sernum'])
                                    {
                                        $('#tsernum').val(titledetail[i]['t1_sernum']);
                                        if($('#tsernum_color').val()=='blue')
                                        {
                                            $('#tsernum_color').val('BlueViolet');
                                            colormsg='BlueViolet';
                                        }
                                        else
                                        {
                                            $('#tsernum_color').val('blue');
                                            colormsg='blue';
                                        }
                                    }
                                }
                                tsernumcss='border-right:solid 1px '+colormsg;
                            }
                            var tsermsg=titledetail[i]['t1_sernum']+','+titledetail[i]['t1_src']+','+titledetail[i]['t1_width']+','+titledetail[i]['t1_height'];
                            var picmsg=picsum+','+pic1_src+','+pic1_width+','+pic1_height+','+pic2_src+','+pic2_width+','+pic2_height+','+pic3_src+','+pic3_width+','+pic3_height+','+pic4_src+','+pic4_width+','+pic4_height;
                            notemsg='No2:'+titledetail[i]['two']+'&nbsp;&nbsp;&nbsp;&nbsp;No1:'+titledetail[i]['one']+'&nbsp;&nbsp;&nbsp;&nbsp;'+titledetail[i]['ratio'];

                            msg=msg+'<li ><div><div name="notemsg" style="margin-top: 2px;color: #8b8c8f;font-size: 12px;">'+notemsg+'</div><input msg="answermsg" type="hidden"  value="'+titledetail[i]['answerid']+' '+titledetail[i]['answersrc']+' '+titledetail[i]['width']+' '+titledetail[i]['height']+'"><img  id='+titledetail['testid']+'-'+titledetail[i]['srcid']+' oldid='+titledetail[i]['srcid']+' onmouseover="previewimg(this.src)"   picmsg="'+picmsg+'" picid="'+picid+'" t1_id="'+t1_id+'" tsermsg="'+tsermsg+'" style="'+tsernumcss+'"   name="'+typeid+'" class="detail_title_img_css" src='+titledetail[i]['src']+' onclick="chooseimgsub(this.id)"></div></li>';
                        }
                        $('#'+id).html(msg);
                    }
                });
            }
        });
    }

</script>
</html>