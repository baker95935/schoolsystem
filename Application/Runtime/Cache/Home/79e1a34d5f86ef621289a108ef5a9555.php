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
    <link rel="stylesheet" type="text/css" href="/Public/css/buildpage.css"/>
    <script src="/Public/js/testtitle.js"></script>
    <script src="/Public/js/sys_public.js"></script>
    <script src="/Public/js/public.js"></script>


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body >
<div class="contain">
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
                            <div   class="admin_div_unchicked">
                                <a  href="<?php echo U('systemset_03');?>">学科设定</a>
                            </div>
                        </td>
                        <td>
                            <div style="color: #c0b9c8"  class="admin_div_unchicked">
                                知识点题库
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
        <div class="col-xs-6" style="height: 340px;border-right:1px solid #C3C3C3;">
            <div style="font-size: 16px;margin-left: 8%;"><b style="float: left;">习题 上传预览</b><input id="file_exercise" style="margin-left: 300px;" type="file" multiple="multiple" name="img[]" onchange="previewFiles()"></div>
            <hr style="margin-left: 6%;">
            <div class="row" style="background-color: #C3C3C3;height: 260px; overflow-x: scroll;white-space: nowrap;padding-left: 4px;padding-right: 4px;" id="preview_div">
            </div>
        </div>

        <div class="col-xs-6" style="height: 340px;border-right:1px solid #C3C3C3;">
            <div style="font-size: 16px;margin-left: 8%;"><b style="float: left;">答案  上传预览</b><input id="file_answer" style="margin-left: 350px;" type="file" multiple="multiple" name="img_answer[]" onchange="previewFilesAnswer()"></div>
            <hr style="margin-left: 6%;">
            <div class="row" style="background-color: #C3C3C3;border-left:1px solid #FFFFFF;height: 260px; overflow-x: scroll;white-space: nowrap;padding-left: 4px;padding-right: 4px;" id="preview_answer_div">
            </div>
        </div>

    </div>


    <div class="row"style="border-top:1px solid #C3C3C3;padding-top: 15px;">
        <div class="col-xs-6" style="height: 330px;border-right:1px solid #C3C3C3;padding-top: 20px;">
            <div class="row sysset_blue" style="clear: left;"><span  id="chapter_part_msg" style="font-size: 16px;margin-left: 8%;"><b>1.知识点题库列表</b></span></div>
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

        <div class="col-xs-6" style="height: 330px;border-right:1px solid #C3C3C3;padding-top: 20px;">
            <div class="row" style="font-size: 16px;margin-left: 8%;">
                <div class="col-xs-5"><b>操作：上传知识点原始试卷</b></div>
                <div class="col-xs-4">
                    <div name="aprogressdiv">
                        <progress id="ap" value="0" style="width: 50%;float:left;"></progress><span id="aprogress" style="margin-left: 2px;"></span>
                    </div>
                </div>
                <div class="col-xs-3"><input id="input_bt" type="button" value="上传" style="margin-left:20px;background-color: transparent;border: 0px;color: red;font-size: 14px;"></div>
            </div>
            <hr style="margin-left: 6%;">
            <div class="row" style="height: 250px; overflow-y: auto;padding-left: 8%;padding-right: 2%">
                <div class="col-xs-3" style="height: 250px;">
                    <div  class="row" >
                        <input id="datetime_input" type="text" value="<?php echo ($datetime); ?>" style="font-size:13px;width: 100px;text-align: center;">
                        <!--<select id="datetime_select">-->
                        <!--<option><?php echo ($datetime); ?></option>-->
                        <!--</select>-->
                    </div>
                    <div id="test_kind_select" class="row"  style="margin-top: 10px;display:none;" >
                        <input type="radio" value="1" name="kind_select" checked="checked"><span>习题</span>
                        <input type="radio" value="0" name="kind_select"><span>答案</span>
                    </div>
                    <div class="row"  style="margin-top: 10px;">
                        <select id="subjectmsg_select" onchange="selectkeynote()">
                            <option value="0">未选择</option>
                            <?php if(is_array($subject_data)): $i = 0; $__LIST__ = $subject_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i_subject_data): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($i_subject_data[id]); ?>"><?php echo ($i_subject_data[subjectmsg]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <div class="row" style="margin-top: 10px;" onchange="selectkeynote()">
                        <select  id="grademsg_select">
                            <?php if(is_array($grade_data)): $i = 0; $__LIST__ = $grade_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i_grade_data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($i_grade_data[id]); ?>"><?php echo ($i_grade_data[grademsg]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <div  class="row"  style="margin-top: 10px;">
                        <select   id="schoolname_select">
                            <option value="system">系统</option>
                            <?php if(is_array($school_data)): $i = 0; $__LIST__ = $school_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i_school_data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($i_school_data[school_id]); ?>"><?php echo ($i_school_data[schoolname]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <div  class="row"  style="margin-top: 10px;">
                        <input id="keynote_input"  onchange="selectkeynote()" type="text" placeholder="知识点关键词" style="font-size:13px;width: 100px;text-align: center;">
                    </div>
                </div>
                <div id="keynote_div" class="col-xs-9" style="border-left:1px solid #000000;height: 250px; overflow-y: auto;">

                </div>

            </div>
        </div>

    </div>

    <input type="hidden" id="edit_status" value="add">

</div>
</div>

</body>
<script type="text/javascript">

    function selectkeynote()
    {
        var subjectmsg_val=$('#subjectmsg_select').find("option:selected").val();
        var grademsg_val=$('#grademsg_select').find("option:selected").val();
        var keynote_input=$('#keynote_input').val();
        // alert(subjectmsg_val+','+grademsg_val+','+keynote_input);
        $.ajax({
            url: "<?php echo U('php_selectkeynote');?>",
            type: 'POST',
            data: {subjectid:subjectmsg_val,gradeid:grademsg_val,keynote:keynote_input},
            dataType: 'json',
            success: function (re) {
                var count=re['count'];
                var ihtml='';
                var i;
                for(i=0;i<count;i++)
                {
                    ihtml=ihtml+'<label style="margin-right: 10px;"><input value="'+re[i]['id']+'" name="keynoteid" type="checkbox" ><span>'+re[i]['keynotemsg']+'</span></label>';
                }
                $('#keynote_div').html(ihtml);
            }
        });
    }

    $("#input_bt").click(function(){
        var formData = new FormData();
        for(var i=0; i<$('#file_exercise')[0].files.length;i++){
            formData.append('file_exercise[]', $('#file_exercise')[0].files[i]);
        }

        for(var i=0; i<$('#file_answer')[0].files.length;i++){
            formData.append('file_answer[]', $('#file_answer')[0].files[i]);
        }


        obj=document.getElementsByName("keynoteid");
        check_val=[];

        var mylength=$("input[name='keynoteid']:checked").length;

        if(mylength!=0) {
            for (k in obj) {
                if (obj[k].checked)
                    check_val.push(obj[k].value);
            }
        }

        var paper_name=$('#datetime_input').val();
        var test_kind_select=$("input[name='kind_select']:checked").val();
        var keynote_id=check_val;
        var subjectid=$('#subjectmsg_select').find("option:selected").val();
        var schoolname=$('#schoolname_select').find("option:selected").val();
        var keynote_input=$('#keynote_input').val();
        var filesernum=createfilesernum('system');
        var gradeid=$('#grademsg_select').find("option:selected").val();


        if(checkDate(paper_name)==0)
        {
            alert('试卷名称必须是日期格式！！');
            return;
        }

        if(subjectid==0)
        {
            alert('请选择科目！！');
            return;
        }

        formData.append('paper_name', paper_name);
        formData.append('test_kind', test_kind_select);
        formData.append('keynote_id', keynote_id);
        formData.append('subjectid', subjectid);
        formData.append('schoolname', schoolname);
        formData.append('keynote_input', keynote_input);
        formData.append('filesernum', filesernum);
        formData.append('gradeid', gradeid);

//    alert(paper_name+'|'+test_kind_select+'|'+keynote_id+'|'+subjectid+'|'+schoolname+'|'+keynote_input+'|'+filesernum+'|'+gradeid);
//    return;

        $.ajax({
            url: "<?php echo U('Systemset/upload');?>",
            type: "POST",
            processData: false,
            contentType: false,
            data: formData,
            xhr: function(){ //获取ajaxSettings中的xhr对象，为它的upload属性绑定progress事件的处理函数
                myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){ //检查upload属性是否存在
                    //绑定progress事件的回调函数
                    myXhr.upload.addEventListener('progress',aprogressHandlingFunction, false);
                }
                return myXhr; //xhr对象返回给jQuery使用
            },
            success: function(d){
                if(d==1) {
                    $('#ap').val(0);
                    $('#aprogress').html('');
                    $('#preview_div').html('');
                    $('#preview_answer_div').html('');
                    alert('上传成功');
                    //$('#preview').html('上传成功');
                }
            }
        });

    });

    //上传进度回调函数：
    function aprogressHandlingFunction(e) {
        if (e.lengthComputable) {
            $('#ap').attr({value : e.loaded, max : e.total}); //更新数据到进度条
            var percent = e.loaded/e.total*100;
            $('#aprogress').html(percent.toFixed(2) + "%");
        }
    }

    function previewFiles() {
        var preview = document.querySelector('#preview_div');
        var files = document.querySelector('input[id=file_exercise]').files;

        function readAndPreview(file) {

            // Make sure `file.name` matches our extensions criteria
            if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
                var reader = new FileReader();

                reader.addEventListener("load", function() {
                    var image = new Image();
                    image.title = file.name;
                    image.src = this.result;
                    //image.width='190';
                    image.height='260';

                    preview.appendChild(image);
                }, false);

                reader.readAsDataURL(file);
            }

        }

        if (files) {
            $('#preview_div').html(' ');
            [].forEach.call(files, readAndPreview);
        }

    }

    function previewFilesAnswer() {
        var preview = document.querySelector('#preview_answer_div');
        var files = document.querySelector('input[id=file_answer]').files;

        function readAndPreview(file) {

            // Make sure `file.name` matches our extensions criteria
            if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
                var reader = new FileReader();

                reader.addEventListener("load", function() {
                    var image = new Image();
                    image.title = file.name;
                    image.src = this.result;
                    //image.width='190';
                    image.height='260';

                    preview.appendChild(image);
                }, false);

                reader.readAsDataURL(file);
            }

        }

        if (files) {
            $('#preview_answer_div').html(' ');
            [].forEach.call(files, readAndPreview);
        }

    }

</script>
</html>