<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="login-bg">
<head>
    <title>CTB-Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="/Public/jquery/jquery.min.js"></script>
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/css/systemset.css"/>
    <script src="/Public/js/testtitle.js"></script>
    <script src="/Public/js/sys_public.js"></script>


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body >
<div class="contain" style="width: 100%">
    <div class="row" style="height: 45px;"></div>
    <div class="row">
        <div class="col-xs-4" style="padding-left:45px;">
            <b> <span id="bigtitle" style="font-size: 18px;">系统设置</span></b>
        </div>
        <div class="col-xs-4"></div>
        <div class="col-xs-4">
            <div class="admin_bt_div">
                <table>
                    <tr>
                        <td>
                            <div  class="admin_div_unchicked">
                                <a href="<?php echo U('systemset_01');?>">人员设定</a>
                            </div>
                        </td>
                        <td>
                            <div class="admin_div_unchicked">
                                <a href="<?php echo U('systemset_02');?>">学校设定</a>
                            </div>
                        </td>
                        <td>
                            <div style="color: #c0b9c8"   class="admin_div_unchicked">
                                学科设定
                            </div>
                        </td>
                        <td>
                            <div class="admin_div_unchicked">
                                <a  href="<?php echo U('systemset_04');?>">知识点题库</a>
                            </div>
                        </td>
                        <td>
                            <div class="admin_div_unchicked admin_list">
                                <a href="<?php echo U('adminindex/index');?>">返回</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
    <div class="row" style="height: 43px;"></div>
    <div class="row framelist" style="min-height: 26px;border: 1px solid #eaf0f2;text-align: right;font-size: 12px;padding-top: 4px;padding-bottom: 4px;padding-right: 28px;">
        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <span><u><a  href="javascript:void(0)">返回</a></u></span>
    </div>
    <div class="row" style="height: 15px;"></div>
    <div class="row">
        <div class="col-xs-6" style="height: 330px;border-right:1px solid #C3C3C3;">
            <div class="row sysset_blue" style="clear: left;"><span  id="chapter_part_msg" style="font-size: 16px;margin-left: 8%;"><b>1.添加小结及知识点</b></span><span style="margin-left: 49%"></span><input id="chapter_part1" name="chapter_part" type="radio" value="part"  checked="checked"><span>节</span><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><input id="chapter_part2" type="radio"  name="chapter_part"  value="chapter"  ><span>章</span></div>
            <hr style="margin-left: 6%;">
            <div class="row" style="height: 250px; overflow-y: auto;padding-left: 8%;padding-right: 2%">
                <table id="table_part" class="sysset_msgtable" style="width: 100%;">
                </table>
                <input id="part_begin" type="hidden" value="1">
                <div id="part_page_a" class="row"><div class="result page" style="margin-left: 20px;margin-top: 0px;"><a onclick="pre_sub('part')" href="javascript:void(0)">上一页</a><a style="margin-left: 4px;"><span id="part_begin_page">1</span>/<span id="part_page_sum">4</span></a><a style="margin-left: 4px;" onclick="next_sub('part')" href="javascript:void(0)">下一页</a></div></div>

                <table id="table_chaptermsg" class="sysset_msgtable" style="width: 100%;display: none;">

                </table>
                <input id="chaptermsg_begin" type="hidden" value="1">
                <div id="chaptermsg_page_a" class="row" style="display:none;"><div class="result page" style="margin-left: 20px;margin-top: 0px;"><a onclick="pre_sub('chaptermsg')" href="javascript:void(0)">上一页</a><a style="margin-left: 4px;"><span id="chaptermsg_begin_page">1</span>/<span id="chaptermsg_page_sum">4</span></a><a style="margin-left: 4px;" onclick="next_sub('chaptermsg')" href="javascript:void(0)">下一页</a></div></div>

            </div>

        </div>

        <div class="col-xs-6" style="height: 330px;border-right:1px solid #C3C3C3;">
            <div class="row sysset_blue" style="clear: left;"><span style="font-size: 16px;margin-left: 8%;"><b>2.题型信息</b></span><span style="margin-left: 62%"></span><a id="questiontypes_ok" onclick="newquestiontypesdata('questiontypes')"  href="javascript:void(0)">Add</a></div>
            <hr style="margin-left: 6%;">
            <div class="row" style="height: 250px; overflow-y: auto;padding-left: 8%;padding-right: 2%">

                <div class="sysset_msgli" id="questiontypes_msgli" >
                    <ol>
                        <li>

                            <span >选择学科：</span>
                            <select id="questiontypes_subject" onchange="questiontypes_select_sub()">
                                <option value ="1000">全部</option>
                                <?php if(is_array($questiontypes)): $i = 0; $__LIST__ = $questiontypes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$questiontypesid): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($questiontypesid[id]); ?>"><?php echo ($questiontypesid[subjectmsg]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                            <span  class="sysset_marginleft28" >题型：</span>
                            <input id="questiontypesmsg" style="width: 100px;"  type="text" placeholder="添加题型">
                        </li>
                    </ol>
                </div>

                <table id="table_questiontypes" class="sysset_msgtable" style="width: 100%;">
                </table>
                <input id="questiontypes_begin" type="hidden" value="1">
                <div id="questiontypes_page_a" class="row" style="display: block;"><div class="result page" style="margin-left: 20px;margin-top: 0px;"><a onclick="pre_sub('questiontypes')" href="javascript:void(0)">上一页</a><a style="margin-left: 4px;"><span id="questiontypes_begin_page">1</span>/<span id="questiontypes_page_sum">4</span></a><a style="margin-left: 4px;" onclick="next_sub('questiontypes')" href="javascript:void(0)">下一页</a></div></div>



            </div>

        </div>
    </div>
    <div class="row"style="border-top:1px solid #C3C3C3;padding-top: 15px;">
        <div class="col-xs-6" style="height: 340px;border-right:1px solid #C3C3C3;">

            <div class="row sysset_blue" style="clear: left;"><span style="font-size: 16px;margin-left: 8%;"><b>-添加章节信息</b></span><span style="margin-left: 62%"></span><a id="chapter_del" onclick="delchapterdata('chapter')" href="javascript:void(0)">Update</a>&nbsp;&nbsp;&nbsp;<a id="chapter_ok" onclick="newchapter_part_data()" href="javascript:void(0)">Add</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span></div>
            <hr style="margin-left: 6%;">

            <table id="table_chapter" class="sysset_msgtable" style="width: 100%;display: none;">
            </table>
            <input id="chapter_begin" type="hidden" value="1">
            <div id="chapter_page_a" class="row" style="display:none;"><div class="result page" style="margin-left: 20px;margin-top: 0px;"><a onclick="pre_sub('chapter')" href="javascript:void(0)">上一页</a><a style="margin-left: 4px;"><span id="chapter_begin_page">1</span>/<span id="chapter_page_sum">4</span></a><a style="margin-left: 4px;" onclick="next_sub('chapter')" href="javascript:void(0)">下一页</a></div></div>


           <div class="col-xs-6">
            <div class="sysset_msgli" id="chapter_msgli" >
                <ol>
                    <li>
                        <span >选择阶段：</span>
                        <select id="chapter_levelmsg" onchange="chapter_levelmsgsub()">
                            <option value ="1000">未选择</option>
                            <option value ="1">小学</option>
                            <option value ="2">初中</option>
                            <option value="3">高中</option>
                        </select>
                    </li>
                    <li>
                        <span >选择年级：</span>
                        <select id="chapter_grade" onchange="chapter_msg()">
                            <option value ="1000">未选择</option>
                        </select>
                    </li>
                    <li>
                        <span >选择科目：</span>
                        <select id="chapter_subject" onchange="chapter_msg()">
                            <?php if(is_array($questiontypes)): $i = 0; $__LIST__ = $questiontypes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chapter_subject): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($chapter_subject[id]); ?>"><?php echo ($chapter_subject[subjectmsg]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>



                    </li>

                    <li id="chapter_li" style="display: none;">
                        <!--<input type="radio" name="chapter_oper" value="chapter"  checked="checked">-->
                        <span  class="sysset_marginleft14">添加章：</span>
                        <input id="newchapter" style="width: 100px;"  type="text" placeholder="添加新章">
                    </li>
                    <li id="part_li_1">
                        <!--<input type="radio" name="chapter_oper" value="part">-->
                        <span  class="sysset_marginleft14" >选择章：</span>
                        <select id="chapter_select" onchange="keyarr()">
                            <option value ="1000">未选择</option>
                        </select>
                    </li>
                    <li id="part_li_2">
                        <span  class="sysset_marginleft14" >填写节：</span>

                        <input id="newpart"  style="width: 100px;"  type="text" placeholder="添加新节">
                    </li>


                    <li>

                    </li>

                </ol>
            </div>
           </div>
            <div class="col-xs-6">
                <span>已经选择知识点</span>
                <div id="choosekeynote" style="width: 100%;height: 35px;overflow-y: auto;background-color:#f9f9f8;">


                </div>

                <div id="choosekeynotevalue" style="width: 100%;height: 20px;overflow-y: auto;background-color:#f9f9f8;display: none;">


                </div>
                <span>全部知识点</span>
                    <div id="allkeynote" style="width: 100%;height: 160px;background-color:#f9f9f8;overflow-y: auto;padding-top: 8px;">


                    </div>
            </div>



        </div>
        <div class="col-xs-6" style="height: 340px;">

            <div class="row sysset_blue" style="clear: left;"><span style="font-size: 16px;margin-left: 8%;"><b>3.知识点</b></span><span style="margin-left: 62%"></span><a id="onekeynote_ok" onclick="newonekeynotedata()" href="javascript:void(0)">Add</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span></div>
            <hr style="margin-left: 6%;">




            <div class="sysset_msgli" id="onkeynote_msgli" >
                <ol>
                    <li>
                        <span >选择阶段：</span>
                        <select id="onkeynote_level" onchange="levelmsgsub()">
                            <option value ="1000">未选择</option>
                            <option value ="1">小学</option>
                            <option value ="2">初中</option>
                            <option value="3">高中</option>
                        </select>
                    <!--</li>-->
                    <!--<li>-->
                        <span >选择学科：</span>
                        <select id="onekeynote_subject" onchange="questiontypes_select_sub()">
                            <option value ="1000">全部</option>
                            <?php if(is_array($questiontypes)): $i = 0; $__LIST__ = $questiontypes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$onekeynoteid): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($onekeynoteid[id]); ?>"><?php echo ($onekeynoteid[subjectmsg]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    <!--</li>-->

                    <!--<li>-->
                        <span  class="sysset_marginleft14" >填年级：</span>
                        <select id="grade_select">
                            <option value ="1000">未选择</option>
                        </select>

                    <!--</li>-->
                    <!--<li>-->
                        <span  class="sysset_marginleft14" >知识点：</span>
                        <input id="onekeynotemsg" style="width: 100px;"  type="text" placeholder="添加知识点">
                    </li>
                </ol>
            </div>

            <table id="table_onekeynote" class="sysset_msgtable" style="width: 100%;">
            </table>
            <input id="onekeynote_begin" type="hidden" value="1">
            <div id="onekeynote_page_a" class="row"><div class="result page" style="margin-left: 20px;margin-top: 0px;"><a onclick="pre_sub('onekeynote')" href="javascript:void(0)">上一页</a><a style="margin-left: 4px;"><span id="onekeynote_begin_page">1</span>/<span id="onekeynote_page_sum">4</span></a><a style="margin-left: 4px;" onclick="next_sub('onekeynote')" href="javascript:void(0)">下一页</a></div></div>



        </div>
    </div>

</div>

<input type="hidden" id="edit_status" value="add">

</body>
<script type="text/javascript">

    var partbeginhtml='<tr ><th style="text-align: center;"  >序号</th><th>科目</th><th>阶段</th><th>年级</th><th>章</th><th>节</th><th>知识点</th><th>操作</th></tr>';
    var onekeynotebeginhtml='<tr><th style="text-align: center;"  >序号</th><th>学科</th><th>年级</th><th>知识点</th><th>阶段</th><th>操作</th></tr>';
    var questiontypesbeginhtml='<tr><th style="text-align: center;"  >序号</th><th>学科</th><th>题型</th><th>操作</th></tr>';
    var chapterbeginhtml='<tr><th style="text-align: center;"  >序号</th><th>年级</th><th>学科</th><th>章</th><th>操作</th></tr>';

    $(function(){

        var kind = $('input[name="chapter_part"]:checked').val();
        keynote_sql('part',partbeginhtml);
        onekeynote_sql("onekeynote",onekeynotebeginhtml);
        questiontypes_sql("questiontypes",questiontypesbeginhtml);

        $('input[name="chapter_part"]').change(function() {
            kind = $('input[name="chapter_part"]:checked').val();
            chapter_part_sub(kind);
        });
    })

    function keynote_sql(kind,beginhtml) {

        var length=6;
        var begin;
        var htmlmsg;
        var contentmsg;

        var msgkind = $('input[name="chapter_part"]:checked').val();

        if(msgkind=='chapter')
        {

            //chaptermsg_begin_page
            begin=$('#chaptermsg_begin').val();
            $.ajax({
                        url: "<?php echo U('php_chaptermsg_sql');?>",
                        type: 'POST',
                        data: {kind:kind,begin:begin,length:length},
                        dataType: 'json',
                        success: function (re) {
                            var begin_page='#chaptermsg_begin_page';
                            var page_sum='#chaptermsg_page_sum';
                            $(begin_page).text(re['chaptermsg_begin_page']);
                            $(page_sum).text(re['chaptermsg_page_sum']);
                            length=re['chaptermsg_count'];

                            for(var i=0;i<length;i++)
                            {
                                contentmsg=contentmsg+'<tr"><td style="text-align: center;" class="sysset_per5">'+re[i]['id']+'</td><td class="sysset_per15">'+re[i]['grademsg']+'</td><td class="sysset_per5">'+re[i]['subjectmsg']+'</td><td  class="sysset_per10">'+re[i]['chaptermsg']+'</td><td class="sysset_per15"><a id="'+re[i]['id']+'" name="'+kind+'" href="javascript:void(0);" onclick="delsub(this.id)">删除</a><span>&nbsp;&nbsp;</span><a id="'+re[i]['id']+'" name="'+kind+'" href="javascript:void(0);" >编辑</a></td></tr>';
                            }
                            var tablemsg='#table_chaptermsg';
                            $(tablemsg).html(chapterbeginhtml+contentmsg);
                        }
                    }
            )
        }


        if(msgkind=='part')
        {
            begin=$('#part_begin').val();

            $.ajax({
                        url: "<?php echo U('php_part_sql');?>",
                        type: 'POST',
                        data: {kind:kind,begin:begin,length:length},
                        dataType: 'json',
                        success: function (re) {

                            var begin_page='#part_begin_page';
                            var page_sum='#part_page_sum';
                            $(begin_page).text(re['part_begin_page']);
                            $(page_sum).text(re['part_page_sum']);

                            length=re['part_count'];

                            for(var i=0;i<length;i++)
                            {
                                contentmsg=contentmsg+'<tr><td style="text-align: center;" class="sysset_per5">'+re[i]['id']+'</td><td class="sysset_per5">'+re[i]['subjectmsg']+'</td><td class="sysset_per15">'+re[i]['levelmsg']+'</td><td class="sysset_per15">'+re[i]['grademsg']+'</td><td  class="sysset_per10">'+re[i]['chapter']+'</td><td class="sysset_per15">'+re[i]['part']+'</td><td  class="sysset_per15">'+re[i]['keynoteornot']+'</td><td class="sysset_per15"><a id="'+re[i]['id']+'" name="'+kind+'" href="javascript:void(0);" onclick="delsub(this.id)">删除</a><span>&nbsp;&nbsp;</span><a id="'+re[i]['id']+'" name="'+kind+'" href="javascript:void(0);" >编辑</a></td></tr>';
                            }

                            var tablemsg='#table_part';
                            $(tablemsg).html(beginhtml+contentmsg);
                        }
                    }
            )
        }

    }


    function onekeynote_sql(kind,beginhtml) {
        var length=4;
        var begin;
        var htmlmsg;
        var contentmsg;



        if(kind=='onekeynote')
        {
            begin=$('#onekeynote_begin').val();
        }

        $.ajax({
                    url: "<?php echo U('php_onekeynote_sql');?>",
                    type: 'POST',
                    data: {kind:kind,begin:begin,length:length},
                    dataType: 'json',
                    success: function (re) {

                        var begin_page='#'+kind+'_begin_page';
                        var page_sum='#'+kind+'_page_sum';
                        $(begin_page).text(re['onekeynote_begin_page']);
                        $(page_sum).text(re['onekeynote_page_sum']);

                        length=re['onekeynote_count'];


                        for(var i=0;i<length;i++)
                        {
                            contentmsg=contentmsg+'<tr"><td style="text-align: center;" class="sysset_per5">'+re[i]['id']+'</td><td class="sysset_per15">'+re[i]['subjectmsg']+'</td><td class="sysset_per5">'+re[i]['grademsg']+'</td><td  class="sysset_per10">'+re[i]['keynotemsg']+'</td><td class="sysset_per15">'+re[i]['levelmsg']+'</td><td class="sysset_per15"><a id="'+re[i]['id']+'" name="'+kind+'" href="javascript:void(0);" onclick="onekeynotedetailsub(this.id)">删除</a></td></tr>';
                        }

                        var tablemsg='#table_'+kind;
                        $(tablemsg).html(beginhtml+contentmsg);
                    }
                }
        )
    }


    function questiontypes_sql(kind,beginhtml) {
        var length=4;
        var begin;
        var htmlmsg;
        var contentmsg;

        var id=$('#questiontypes_subject').val();

        if(kind=='questiontypes')
        {
            begin=$('#questiontypes_begin').val();
        }


        $.ajax({
                    url: "<?php echo U('php_questiontypes_sql');?>",
                    type: 'POST',
                    data: {kind:kind,begin:begin,length:length,subject:id},
                    dataType: 'json',
                    success: function (re) {

                        var begin_page='#'+kind+'_begin_page';
                        var page_sum='#'+kind+'_page_sum';
                        $(begin_page).text(re['questiontypes_begin_page']);
                        $(page_sum).text(re['questiontypes_page_sum']);

                        length=re['questiontypes_count'];

                        for(var i=0;i<length;i++)
                        {
                            contentmsg=contentmsg+'<tr"><td style="text-align: center;" class="sysset_per5">'+re[i]['id']+'</td><td class="sysset_per15">'+re[i]['subjectmsg']+'</td><td class="sysset_per5">'+re[i]['typesmsg']+'</td><td class="sysset_per15"><a id="'+re[i]['id']+'" name="'+kind+'" href="javascript:void(0);" onclick="questiontypes_del(this.id)">删除</a></td></tr>';
                        }

                        var tablemsg='#table_'+kind;
                        $(tablemsg).html(beginhtml+contentmsg);
                    }
                }
        )
    }

    function div_list_sub(kind) {

        if( $('#keynote_a').html()=='New')
        {
            $('#table_keynote').css('display','none');
            $('#keynote_page_a').css('display','none');
            $('#keynote_a').html('List');
            $('#keynote_ok').css('display','');
            $('#keynote_msgli').css('display','');


            var myDate = new Date();
            var mytime=myDate.toLocaleString( );

            $('#keynote_regtime').val(mytime);

        }
        else
        {
            $('#table_keynote').css('display','');
            $('#keynote_page_a').css('display','');
            $('#keynote_a').html('New');
            $('#keynote_ok').css('display','none');
            $('#keynote_msgli').css('display','none');
        }

    }

    function pre_sub(kind) {
        var beginele='#'+kind+'_begin';
        var nowpage=$(beginele).val();

        if(nowpage==1)
        {
            return;
        }
        else
        {

            $(beginele).val(parseInt(nowpage)-1);

            //chaptermsg

            if(kind=='part')
            {
                keynote_sql(kind,partbeginhtml);
            }


            if(kind=='chaptermsg')
            {
                keynote_sql(kind,chapterbeginhtml);
            }

            if(kind=='onekeynote')
            {
                onekeynote_sql(kind,onekeynotebeginhtml);
            }
            if(kind=='questiontypes')
            {
                questiontypes_sql(kind,questiontypesbeginhtml);
            }

        }
    }

    function next_sub(kind) {
        var beginele='#'+kind+'_begin';
        var nowpage=$(beginele).val();
        var sumele='#'+kind+'_page_sum';


        if(nowpage==$(sumele).text())
        {

            return;
        }
        else
        {
            $(beginele).val(parseInt(nowpage)+1);

            if(kind=='part')
            {
                keynote_sql(kind,partbeginhtml);
            }

            if(kind=='chaptermsg')
            {
                keynote_sql(kind,chapterbeginhtml);
            }
            if(kind=='onekeynote')
            {
                onekeynote_sql(kind,onekeynotebeginhtml);
            }
            if(kind=='questiontypes')
            {
                questiontypes_sql(kind,questiontypesbeginhtml);
            }
        }

    }

    function newkeynotedata(kind) {
        var keynotename=$('#keynotename').val();
        var levelnum=$('#levelmsg').val();
        var linkman=$('#linkman').val();
        var phone=$('#phone').val();
        var starttime=$('#starttime').val();
        var endtime=$('#endtime').val();
        var gradecount=$('#gradecount').val();
        var classcount=$('#classcount').val();


        if(schoolname=='')
        {
            alert('学校名称不能为空！！');
            return;
        }
        if(levelnum==1000)
        {
            alert('请选择类型！！');
            return;
        }
        if(linkman=='')
        {
            alert('填写联系人！！');
            return;
        }
        if(phone=='')
        {
            alert('请填写联系电话！！');
            return;
        }

        if(starttime=='')
        {
            alert('请填写开始时间！！');
            return;
        }
        else
        {
           var val=checkDate(starttime);

            if(val==0)
            {
                alert("请填写正确的开始时间！！");
                return;
            }
        }

        if(endtime=='')
        {
            alert('请填写结束时间！！');
            return;
        }
        else
        {
            var val=checkDate(endtime);

            if(val==0)
            {
                alert("请填写正确的结束时间！！");
                return;
            }
        }
        if(gradecount==1000)
        {
            alert('请选择年级数量！！');
            return;
        }
        if(classcount=='')
        {
            alert('请填写班级数量！！');
            return;
        }



        $.ajax({
            url: "<?php echo U('php_newkeynote_data_sql');?>",
            type: 'POST',
            data: {schoolname:schoolname,linkman: linkman, phone: phone, starttime: starttime,endtime:endtime,areaid:0,levelnum:levelnum,gradecount:gradecount,classcount:classcount},
            dataType: 'text',
            success: function (re) {

                school_sql('school',keynotebeginhtml);
                $('#schoolname').val('');
                $('#levelmsg').val(1000);
                $('#linkman').val('');
                $('#phone').val('');
                $('#starttime').val('');
                $('#endtime').val('');
                $('#gradecount').val(1000);
                $('#classcount').val('');
            }
        })

    }

    function newquestiontypesdata(kind){
        var id=$('#questiontypes_subject').val();
        var typesmsg=$('#questiontypesmsg').val();


        if(id==1000)
        {
            alert('请选择题型所属科目！！');
            return;
        }
        if(typesmsg=='')
        {
            alert('请填写题型信息！！');
            return;
        }

        $.ajax({
        url: "<?php echo U('php_newkeynote_data_sql');?>",
                type: 'POST',
                data: {subjectid:id,typesmsg:typesmsg},
                dataType: 'json',
                success: function (re) {
                    questiontypes_sql("questiontypes",questiontypesbeginhtml);
                    $('#questiontypesmsg').val('');
                }
        })
        }

        function questiontypes_del(id){
            var id=id;
            $.ajax({
                url: "<?php echo U('php_del_data_sql');?>",
                type: 'POST',
                data: {id:id},
                dataType: 'json',
                success: function (re) {
                    questiontypes_sql("questiontypes",questiontypesbeginhtml);
                }
            })


        }

    function levelmsgsub()
    {
        var levelnum=$('#onkeynote_level').val();
        var i=0;
        var htmltext;
        $.ajax({
            url: "<?php echo U('php_level_grade_sql');?>",
            type: 'POST',
            data: {levelnum:levelnum},
            dataType: 'json',
            success: function (re) {
               // alert(1);
                var count=re['count'];

                if(count!=0)
                {
                    for(i;i<count;i++)
                    {
                        htmltext=htmltext+'<option value ="'+re[i]['id']+'">'+re[i]['grademsg']+'</option>';
                    }

                    $('#grade_select').html(htmltext);
                }
                else
                {
                    htmltext=htmltext+'<option value ="1000">未选择</option>';
                    $('#grade_select').html(htmltext);
                }

            }
        })

    }


//年级选择
    function chapter_levelmsgsub()
    {
        var levelnum=$('#chapter_levelmsg').val();
        var i=0;
        var htmltext;
        $.ajax({
            url: "<?php echo U('php_level_grade_sql');?>",
            type: 'POST',
            data: {levelnum:levelnum},
            dataType: 'json',
            success: function (re) {
                var count=re['count'];


                if(count!=0)
                {
                    for(i;i<count;i++)
                    {
                        htmltext=htmltext+'<option value ="'+re[i]['id']+'">'+re[i]['grademsg']+'</option>';
                    }

                    $('#chapter_grade').html(htmltext);
                }
                else
                {
                    htmltext=htmltext+'<option value ="1000">未选择</option>';
                    $('#chapter_grade').html(htmltext);
                }

                chapter_msg();


            }
        })

    }

//章选择
    function chapter_msg()
    {
        var gradeid=$('#chapter_grade').val();
        var subjectid=$('#chapter_subject').val();
        var i=0;
        var htmltext;
        $.ajax({
            url: "<?php echo U('php_chapter_msg_sql');?>",
            type: 'POST',
            data: {gradeid:gradeid,subjectid:subjectid},
            dataType: 'json',
            success: function (re) {
                var count=re['count'];
                if(count!=0)
                {
                    for(i;i<count;i++)
                    {
                        htmltext=htmltext+'<option value ="'+re[i]['id']+'">'+re[i]['chaptermsg']+'</option>';
                    }

                    $('#chapter_select').html(htmltext);
                    $('#chapter_new').html(htmltext);
                }
                else
                {
                    htmltext=htmltext+'<option value ="1000">未选择</option>';
                    $('#chapter_select').html(htmltext);

                    $('#chapter_new').html(htmltext);
                }
                keyarr();

            }
        })

    }








    function questiontypes_select_sub()
    {
        questiontypes_sql("questiontypes",questiontypesbeginhtml);
    }

    function newonekeynotedata()
    {
        var onkeynote_level=$('#onkeynote_level').val();
        var onekeynote_subject=$('#onekeynote_subject').val();
        var grade_select=$('#grade_select').val();
        var onekeynotemsg=$('#onekeynotemsg').val();


//        alert(onkeynote_level);
//        alert(onekeynote_subject);
//        alert(grade_select);
//        alert(onekeynotemsg);

        if(onkeynote_level==1000)
        {
            alert('请选择阶段！！');
            return;
        }
        if(onekeynote_subject==1000)
        {
            alert('请选择学科！！');
            return;
        }
        if(grade_select==1000)
        {
            alert('请选择年级！！');
            return;
        }

        if(onekeynotemsg=='')
        {
            alert('请输入知识点信息！！');
            return;
        }

        $.ajax({
            url: "<?php echo U('php_newonekeynote_sql');?>",
            type: 'POST',
            data: {onkeynote_level: onkeynote_level,onekeynote_subject:onekeynote_subject,grade_select:grade_select,onekeynotemsg:onekeynotemsg},
            dataType: 'json',
            success: function (re) {

               // alert(123);

                onekeynote_sql("onekeynote",onekeynotebeginhtml);
                $('#onekeynotemsg').val('');
            }
        })

    }

    function onekeynotedetailsub(id)
    {
        var id=id;
        $.ajax({
            url: "<?php echo U('php_onekeynotedel_data_sql');?>",
            type: 'POST',
            data: {id:id},
            dataType: 'json',
            success: function (re) {
              //  alert(re);
                onekeynote_sql("onekeynote",onekeynotebeginhtml);
            }
        })
    }

    function newchapter_part_data()
    {
        var kind = $('input[name="chapter_part"]:checked').val();




        var gradeid=$('#chapter_grade').val();
        var subjectid=$('#chapter_subject').val();
        var pre_chapter_id=$('#chapter_new').val();
        var newchapter=$('#newchapter').val();
        var chapter=$('#chapter_select').find("option:selected").val();
        var part=$('#newpart').val();
        var keynoteid=$('#choosekeynotevalue').html();
        var keynoteval=$('#choosekeynote').html();

        keynoteid=keynoteid.replace(/\s/g, "")





        if(keynoteid!='')
        {
            keynoteid=keynoteid+'#';
            keynoteid=keynoteid.replace(',#','');

            keynoteval=keynoteval+'#';
            keynoteval=keynoteval.replace(',#','');
        }
        else
        {
            keynoteid='';
            keynoteval='';

        }



        if(kind=='chapter')
        {
            if(gradeid==1000)
            {
                alert('请选择年级！！');
                return;
            }

            if(newchapter=='')
            {


                alert('请输入章节！！');
                return;
            }
        }
        else
        {
            if(gradeid==1000)
            {
                alert('请选择年级！！');
                return;
            }
            if(chapter=='未选择')
            {
                alert('请选择章！！');
                return;
            }
            if(part=='')
            {

                alert('请输入小节！！');
                return;
            }
        }




//        return;

        $.ajax({
            url: "<?php echo U('php_newchapterdata_sql');?>",
            type: 'POST',
            data: {kind:kind,gradeid:gradeid,subjectid:subjectid,newchapter:newchapter,chapter:chapter,part:part,akeynoteid:keynoteid,akeynotemsg:keynoteval},
            dataType: 'json',
            success: function (re) {

                if(re==1)
                {
                    alert('添加成功！！');

                    if(kind=='chapter')
                    {
                        $('#newchapter').val('');
                        keynote_sql(kind,chapterbeginhtml);
                    }
                    else
                    {
                        $('#newpart').val('');
                        keynote_sql(kind,partbeginhtml);
                    }


                }
                else
                {
                    alert('已经有重复数据！！');
                }
            }
        })
    }

    function delsub(id)
    {
        var msgkind = $('input[name="chapter_part"]:checked').val();
        var id=id;

            $.ajax({
                url: "<?php echo U('php_delsub_data_sql');?>",
                type: 'POST',
                data: {id:id,kind:msgkind},
                dataType: 'json',
                success: function (re) {
                    if(msgkind=='part')
                    {
                        keynote_sql('part',partbeginhtml);
                    }


                    if(msgkind=='chapter')
                    {
                        keynote_sql('chaptermsg',chapterbeginhtml);
                    }
                }
            })




    }

    function keyarr()
    {
        var gradeid=$('#chapter_grade').val();
        var subjectid=$('#chapter_subject').val();

        var htmlmsg='';

        $.ajax({
            url: "<?php echo U('php_keyarr_sql');?>",
            type: 'POST',
            data: {gradeid:gradeid,subjectid:subjectid},
            dataType: 'json',
            success: function (re) {
                var count=re['count'];
                for(var i=0;i<count;i++)
                {
                    htmlmsg=htmlmsg+'<input type="checkbox" style="margin-left: 5px;" name="keynotearr" onchange="checkboxsub()" id="'+re[i]['id']+'" value="'+re[i]['keynotemsg']+'"><span>'+re[i]['keynotemsg']+'</span>';
                }
                $('#allkeynote').html(htmlmsg);
            }
        })
    }


///可能有错误，需要修改
    function checkboxsub()
    {
        obj=document.getElementsByName("keynotearr");
        check_val=[];

        var mylength=$("input[name='keynotearr']:checked").length;

        if(mylength!=0)
        {
            for(k in obj) {
                if (obj[k].checked)
                    check_val.push(obj[k].value+',');
                //检测对不对
            }
            check_id=[];
            for(k in obj) {
                if (obj[k].checked)
                    check_id.push(obj[k].id+',');
                //检测对不对
            }
            $('#choosekeynotevalue').html(check_id);
            $('#choosekeynote').html(check_val);
        }
        else
        {
            $('#choosekeynotevalue').html('');
            $('#choosekeynote').html('');
        }

    }

    function chapter_part_sub(kind)
    {
        $('#table_chaptermsg').css('display','none');
        $('#table_part').css('display','none');
        $('#part_page_a').css('display','none');
        $('#chaptermsg_page_a').css('display','none');
        $('#chapter_li').css('display','none');
        $('#part_li_1').css('display','none');
        $('#part_li_2').css('display','none');



        if(kind=='chapter')
        {
            $('#newchapter').css('display','');
            $('#table_chaptermsg').css('display','');
            $('#chaptermsg_page_a').css('display','');
            $('#chapter_li').css('display','');
            keynote_sql('chapter',chapterbeginhtml);


            $('#chapter_part_msg').html('<b>1.添加章</b>');

        }
        else
        {
            $('#table_part').css('display','');
            $('#part_page_a').css('display','');
            $('#part_li_1').css('display','');
            $('#part_li_2').css('display','');
            $('#chapter_part_msg').html('<b>1.添加小结及知识点</b>');
        }
    }


</script>
</html>