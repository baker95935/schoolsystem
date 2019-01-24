<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>习题信息列表</title>
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

<div class="container" style="width: 100%;">
    <div class="row" style="height: 63px;text-align: left;vertical-align: top;">
        <div class="col-xs-3">
            <img src="/Public/img/tests_document.png" style="width: 25px;height:30px;margin-left: 50px;margin-top:14px;">
            <span style="margin-top: -31px;margin-left:90px;display:block;">好助教组卷系统</span>
            <span style="margin-left:100px;display:block;font-size: 9px;color: #8c8c8c;margin-top: 2px;">2019-07-11 18:32</span>
        </div>
        <div class="col-xs-9" style="padding-top: 22px;padding-left: 380px;">
            <a  href="<?php echo U('buildpage01',array('userid'=>$userid));?>"  style="margin-left: 70%;">添加习题</a><a href="<?php echo U('index');?>"  style="margin-left: 30px;">注销</a>
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
                <span style="display: block;margin-top: 17px;margin-left: 15px;">试卷列表</span>
            </div>

            <div class="row contentdiv" style="margin-top:15px;background-color:#1c2127;height: 582px;overflow-y: auto;overflow-x:hidden;">

                <ctb id="bank">
                    <div class="col-xs-12" style="margin-bottom: 4px;">
                        <select>
                            <option>全部类型</option>
                            <option>章节考试</option>
                            <option>期末考试</option>
                        </select>
                    </div>
                    <div class="col-xs-12" style="margin-bottom: 30px;">
                        <select>
                            <option>原始试卷</option>
                            <option>新建试卷</option>
                        </select>
                    </div>


                    <div class="row" style="padding-left: 15px;">
                        <div class="col-xs-6">
                                <input id="begintime" style="text-align: left;" type="text" onchange="findtest(2)"  placeholder="开始时间:2018-09-20">
                        </div>

                        <div class="col-xs-6">
                                <input id="endtime" style="text-align: left;margin-left: -15px;" type="text" onchange="findtest(3)"  placeholder="结束时间:2018-09-30">
                        </div>
                    </div>

                        <div class="col-xs-12">
                            <input id="keyword" onchange="detaillistsub()" type="text" value="" placeholder=" 试卷关键词">
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
                    <div class="row" style="padding-left: 15px;margin-top: 40px;">
                        <div class="col-xs-6">
                            <input id="no1ration" onchange="testidtitlebind()" style="text-align: left;" type="text" value=""  placeholder="错题率(%):0">
                        </div>

                        <div class="col-xs-6">
                            <input id="no2ration" onchange="testidtitlebind()" style="text-align: left;margin-left: -15px;" type="text"  value=""  placeholder="错题率(%):100">
                        </div>
                    </div>

                    <div class="row" style="padding-left: 15px;">
                        <div class="col-xs-6">
                            <input id="no1testtime" onchange="testidtitlebind()" style="text-align: left;" type="text" value=""  placeholder="考过:1次">
                        </div>

                        <div class="col-xs-6">
                            <input id="no2testtime" onchange="testidtitlebind()"  style="text-align: left;margin-left: -15px;" type="text" value=""  placeholder="考过：2次">
                        </div>
                    </div>

                </ctb>

            </div>

        </div>
        <div class="col-xs-9"   style="height: 810px;">
            <div class="row">
                <div class="col-xs-12" style="height: 36px;background-color: #f5f5f5;overflow-y: auto;" >
                    <span style="color:#777777;display: block;margin-top: 8px;margin-left: 40px;">试卷相关信息列表</span>
                </div>
                <div class="col-xs-12" style="height: 774px;background-color: #ecedf0;overflow-y: auto;" >
                    <table style="width: 100%;border-collapse:separate; border-spacing:0px 15px;">
                        <tr id="testlisttr" style="background-color: #ffffff;height: 45px;color: #000000;">
                            <th style="text-align: center;width: 50px;">序号</th>
                            <th  style="text-align: center;width: 200px;">标题</th>
                            <th style="width: 100px;">试卷类型</th>
                            <th style="width: 100px;">习题类型</th>
                            <th style="width: 150px;">试卷信息</th>
                            <th style="width: 120px;">注释信息</th>
                            <th>预览操作</th>
                            <th>下载操作</th>
                            <th>操作</th>
                        </tr>
                        <tr style="background-color: #f9f9f9;font-size:14px;height: 45px;border: solid 1px #e5e5e5;color: #777777; font-weight: lighter;">
                            <th style="background-color:#ecedf0;"></th>
                            <th style="background-color:#ecedf0;"></th>
                            <th style="background-color:#ecedf0;"></th>
                            <th style="background-color:#ecedf0;"></th>
                            <th style="background-color:#ecedf0;"></th>
                            <th style="background-color:#ecedf0;"></th>
                            <th style="background-color:#ecedf0;text-align: center;" ><a onclick="prepage()" style="color:#777777;" href="javascript:void(0)">上一页</a></th>
                            <th style="background-color:#ecedf0;text-align: center;"><span id="nowpage">1</span>/<span id="pagenum">4</span></th>
                            <th style="background-color:#ecedf0;text-align: center;"  ><a onclick="nextpage()" style="color:#777777;" href="javascript:void(0)">下一页</a></th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
 <input id="userid" type="hidden" value="<?php echo ($userid); ?>">
<input id="pagelength" type="hidden" value="10">
</body>
<script>
    $(function(){
        var nowpage=1;
        var pagelength=$('#pagelength').val();
        var userid=$('#userid').val();
        testdata(userid,nowpage,pagelength);
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
        testdata(userid,nowpage,pagelength);


    }

    function prepage(){
        var nowpage=$('#nowpage').text();
        var maxnum=$('#pagenum').text();
        var userid=$('#userid').val();
        var pagelength=$('#pagelength').val();

        nowpage=nowpage*1-1;
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
        testdata(userid,nowpage,pagelength);
    }



//加载页面数据
    function testdata(userid,nowpage,pagelength)
    {
        $.ajax({
                    url:"<?php echo U('phptestlist');?>",
                    data:{userid:userid,nowpage:nowpage,pagelength:pagelength},
                    datatype:'json',
                    type:'post',
                    success:function(re){
                        var testlist=eval("("+re+")");
                        var mylength=testlist['length'];
                        var pagelength=testlist['pagelength'];
                        var pagenum=testlist['pagenum'];
                        var count=testlist['count'];
                        var paper_name,kind,statusmsg,testnote,othernote;
                        var inhtml='';
                        var tr1='<tr name="testlisttr" style="background-color: #f9f9f9;font-size:14px;height: 45px;border: solid 1px #e5e5e5;color: #777777;">';
                        var tr2='</tr>';
                        var j=1;
                        var sernumhtml;
                        var paper_namehtml;
                        var kindhtml;
                        var statusmsghtml;
                        var testnotehtml='';
                        var othernotehtml;
                        var prehtml;
                        var opehtml;
                        var delhtml;
                        var filesernum;
                        var testid;

                        for(var i=0;i<mylength;i++)
                        {
                            paper_name=testlist[i]['paper_name'];
                            kind=testlist[i]['kind'];
                            statusmsg=testlist[i]['statusmsg'];
                            testnote=testlist[i]['testnote'];
                            othernote=testlist[i]['othernote'];
                            filesernum=testlist[i]['filesernum'];
                            testid=testlist[i]['id'];
                            var kind;

                            sernumhtml='<td style="text-align: center;font-weight: normal;">'+testlist[i]['num'];+'</td>';
                            paper_namehtml='<td style="font-weight: normal;">'+paper_name+'</td>';
                            kindhtml='<td style="font-weight: normal;">'+kind+'</td>';

                            if(statusmsg==2)
                            {
                                statusmsg='二次试卷';
                                kind=2;
                                if(testnote==null)
                                {
                                    testnote='好助教错题试卷';
                                }



                            }
                            else
                            {
                                statusmsg='初始试卷';
                                kind=1;
                                testnote='好助教错题试卷';
                            }

                            if(statusmsg==null)
                            {
                                statusmsg='';
                            }

                            statusmsghtml='<td style="font-weight: normal;">'+statusmsg+'</td>';

                            if(testnote==null)
                            {
                                testnote='';
                            }

                            if(othernote==null)
                            {
                                othernote='';
                            }

                            testnotehtml='<td style="font-weight: normal;"><div style="margin-left: 0px;height:40px;padding-top:10px;width: 140px;white-space: nowrap;overflow: auto;">'+testnote+'</div></td>';
                            othernotehtml='<td style="font-weight: normal;">'+othernote+'</td>';
                            prehtml='<td style="font-weight: normal;"><a href="/index.php/Home/buildpaper/pretestpdf01/filesernum/'+filesernum+'/paper_name/'+paper_name+'/testnote/'+testnote+'/kind/'+kind+'/operkind/I/testid/'+testid+'.html" target="_blank">习题</a> <a href="/index.php/Home/buildpaper/preanswerpdf01/filesernum/'+filesernum+'/paper_name/'+paper_name+'/testnote/'+testnote+'/operkind/I/testid/'+testid+'.html" target="_blank">答案</a></td>';
                            opehtml='<td style="font-weight: normal;"><a href="/index.php/Home/buildpaper/pretestpdf01/filesernum/'+filesernum+'/paper_name/'+paper_name+'/testnote/'+testnote+'/kind/'+kind+'/operkind/D/testid/'+testid+'.html" target="_blank">习题</a> <a href="/index.php/Home/buildpaper/preanswerpdf01/filesernum/'+filesernum+'/paper_name/'+paper_name+'/testnote/'+testnote+'/operkind/D/testid/'+testid+'.html" target="_blank">答案</a></td>';
                            delhtml='<td style="font-weight: normal;"><a href="javascript:void(0)">删除</a></td>';
                            inhtml=inhtml+tr1+sernumhtml+paper_namehtml+kindhtml+statusmsghtml+testnotehtml+othernotehtml+prehtml+opehtml+delhtml+tr2;
                            j=j+1;
                        }

                        $('#pagenum').text(pagenum);
                        $("#testlisttr").after(inhtml);
                    }

                })
    }
</script>

</html>