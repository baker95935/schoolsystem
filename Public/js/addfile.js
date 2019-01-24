/**
 * Created by fangzheng on 2018/3/8.
 */

function add_file(num)
{

    add_test_file(num);
    add_answer_file(num);
    $("#sumele").val(num);

}
//添加test控件及事件begin

function add_test_file(num)
{


    // var filemsg='<input name="filesernum" type="hidden" value=""><input id="test_sum" value="1" type="hidden">';
    var firstele='<label id="tlabel1"  style="display:block;" > <span id="tspan1"  style="float:left;">1</span><input id="tupload1"  name="tupload1" type="file" accept="image/*"  style="display: none" > <input id="treg1"  name="treg1" type="hidden" value="0"> <img class="teacher_panel_button" src="/Public/img/phone10.png"> </label>';
    var elemsg="";
    var i;
    for(var i=2;i<parseInt(num)+1;i++)
    {
        elemsg='<label id="tlabel'+i+'" style="display:none;"><span  style="float:left;" id="tspan'+i+'">'+i+'</span><input  id="tupload'+i+'" name="tupload'+i+'" accept="image/*" type="file" style="display: none" > <input  id="treg'+i+'" name="treg'+i+'" type="hidden" value="0"><img class="teacher_panel_button" src="/Public/img/phone10.png"></label>';
        firstele=firstele+elemsg;
    }
    elemsg='<label id="tlabel'+i+'" style="display: none;" onclick="testdeclare()" >'+i+' <img class="teacher_panel_button" src="/Public/img/phone10.png"> </label>';
    firstele=firstele+elemsg;
    $("#tdiv").html(firstele);


    bind_tfile_event(num);
}
function unbind_tfile_event(num)//2.在case中添加绑定的对应函数
{
    for(var i=1;i<parseInt(num)+1;i++)
    {
        var input1 = document.getElementById("tupload"+i);
        if(typeof FileReader==='undefined'){
            input1.setAttribute('disabled','disabled');
        }
        else
        {
            if(i>num)
            {
                break;
            }
            switch(i)
            {
                case 1:
                    input1.removeEventListener('change',treadFile1,false);
                    break;
                case 2:
                    input1.removeEventListener('change',treadFile2,false);
                    break;
                case 3:
                    input1.removeEventListener('change',treadFile3,false);
                    break;
                case 4:
                    input1.removeEventListener('change',treadFile4,false);
                    break;
                case 5:
                    input1.removeEventListener('change',treadFile5,false);
                    break;
                case 6:input1.removeEventListener('change',treadFile6,false);
                    break;
                case 7:input1.removeEventListener('change',treadFile7,false);
                    break;
                case 8:input1.removeEventListener('change',treadFile8,false);
                    break;
                case 9:input1.removeEventListener('change',treadFile9,false);
                    break;
                case 10:input1.removeEventListener('change',treadFile10,false);
                    break;
                case 11:input1.removeEventListener('change',treadFile11,false);
                    break;
                case 12:input1.removeEventListener('change',treadFile12,false);
                    break;
                case 13:input1.removeEventListener('change',treadFile13,false);
                    break;
                case 14:input1.removeEventListener('change',treadFile14,false);
                    break;
                case 15:input1.removeEventListener('change',treadFile15,false);
                    break;
                case 16:input1.removeEventListener('change',treadFile16,false);
                    break;
                case 17:input1.removeEventListener('change',treadFile17,false);
                    break;
                case 18:input1.removeEventListener('change',treadFile18,false);
                    break;
                case 19:input1.removeEventListener('change',treadFile19,false);
                    break;
                case 20:input1.removeEventListener('change',treadFile20,false);
                    break;
                case 21:input1.removeEventListener('change',treadFile21,false);
                    break;
                case 22:input1.removeEventListener('change',treadFile22,false);
                    break;
                case 23:input1.removeEventListener('change',treadFile23,false);
                    break;
                case 24:input1.removeEventListener('change',treadFile24,false);
                    break;
                case 25:input1.removeEventListener('change',treadFile25,false);
                    break;
                case 26:input1.removeEventListener('change',treadFile26,false);
                    break;
                case 27:input1.removeEventListener('change',treadFile27,false);
                    break;
                case 28:input1.removeEventListener('change',treadFile28,false);
                    break;
                case 29:input1.removeEventListener('change',treadFile29,false);
                    break;
                case 30:input1.removeEventListener('change',treadFile30,false);
                    break;
                case 31:input1.removeEventListener('change',treadFile31,false);
                    break;
                case 32:input1.removeEventListener('change',treadFile32,false);
                    break;
                case 33:input1.removeEventListener('change',treadFile33,false);
                    break;
                case 34:input1.removeEventListener('change',treadFile34,false);
                    break;
                case 35:input1.removeEventListener('change',treadFile35,false);
                    break;
                case 36:input1.removeEventListener('change',treadFile36,false);
                    break;
                case 37:input1.removeEventListener('change',treadFile37,false);
                    break;
                case 38:input1.removeEventListener('change',treadFile38,false);
                    break;
                case 39:input1.removeEventListener('change',treadFile39,false);
                    break;
                case 40:input1.removeEventListener('change',treadFile40,false);
                    break;

            }
        }
    }
}
function bind_tfile_event(num)//2.在case中添加绑定的对应函数
{
    for(var i=1;i<parseInt(num)+1;i++)
    {
        var input1 = document.getElementById("tupload"+i);
        if(typeof FileReader==='undefined'){
            input1.setAttribute('disabled','disabled');
        }else{
            if(i>num)
            {
                break;
            }

            switch(i)
            {
                case 1:
                    input1.addEventListener('change',treadFile1,false);
                    break;
                case 2:input1.addEventListener('change',treadFile2,false);
                    break;
                case 3:input1.addEventListener('change',treadFile3,false);
                    break;
                case 4:input1.addEventListener('change',treadFile4,false);
                    break;
                case 5:input1.addEventListener('change',treadFile5,false);
                    break;
                case 6:input1.addEventListener('change',treadFile6,false);
                    break;
                case 7:input1.addEventListener('change',treadFile7,false);
                    break;
                case 8:input1.addEventListener('change',treadFile8,false);
                    break;
                case 9:input1.addEventListener('change',treadFile9,false);
                    break;
                case 10:input1.addEventListener('change',treadFile10,false);
                    break;
                case 11:input1.addEventListener('change',treadFile11,false);
                    break;
                case 12:input1.addEventListener('change',treadFile12,false);
                    break;
                case 13:input1.addEventListener('change',treadFile13,false);
                    break;
                case 14:input1.addEventListener('change',treadFile14,false);
                    break;
                case 15:input1.addEventListener('change',treadFile15,false);
                    break;
                case 16:input1.addEventListener('change',treadFile16,false);
                    break;
                case 17:input1.addEventListener('change',treadFile17,false);
                    break;
                case 18:input1.addEventListener('change',treadFile18,false);
                    break;
                case 19:input1.addEventListener('change',treadFile19,false);
                    break;
                case 20:input1.addEventListener('change',treadFile20,false);
                    break;
                case 21:input1.addEventListener('change',treadFile21,false);
                    break;
                case 22:input1.addEventListener('change',treadFile22,false);
                    break;
                case 23:input1.addEventListener('change',treadFile23,false);
                    break;
                case 24:input1.addEventListener('change',treadFile24,false);
                    break;
                case 25:input1.addEventListener('change',treadFile25,false);
                    break;
                case 26:input1.addEventListener('change',treadFile26,false);
                    break;
                case 27:input1.addEventListener('change',treadFile27,false);
                    break;
                case 28:input1.addEventListener('change',treadFile28,false);
                    break;
                case 29:input1.addEventListener('change',treadFile29,false);
                    break;
                case 30:input1.addEventListener('change',treadFile30,false);
                    break;
                case 31:input1.addEventListener('change',treadFile31,false);
                    break;
                case 32:input1.addEventListener('change',treadFile32,false);
                    break;
                case 33:input1.addEventListener('change',treadFile33,false);
                    break;
                case 34:input1.addEventListener('change',treadFile34,false);
                    break;
                case 35:input1.addEventListener('change',treadFile35,false);
                    break;
                case 36:input1.addEventListener('change',treadFile36,false);
                    break;
                case 37:input1.addEventListener('change',treadFile37,false);
                    break;
                case 38:input1.addEventListener('change',treadFile38,false);
                    break;
                case 39:input1.addEventListener('change',treadFile39,false);
                    break;
                case 40:input1.addEventListener('change',treadFile40,false);
                    break;

            }
        }
    }
}
//3.添加对应的函数
function treadFile1()
{
    treadfileprocess(1);
}
function treadFile2()
{
    treadfileprocess(2);
}
function treadFile3()
{
    treadfileprocess(3);
}
function treadFile4()
{

    treadfileprocess(4);
}
function treadFile5()
{
    treadfileprocess(5);
}
function treadFile6()
{
    treadfileprocess(6);
}
function treadFile7()
{
    treadfileprocess(7);
}
function treadFile8()
{
    treadfileprocess(8);
}
function treadFile9()
{
    treadfileprocess(9);
}
function treadFile10()
{
    treadfileprocess(10);
}
function treadFile11()
{
    treadfileprocess(11);
}
function treadFile12()
{
    treadfileprocess(12);
}
function treadFile13()
{
    treadfileprocess(13);
}
function treadFile14()
{
    treadfileprocess(14);
}
function treadFile15()
{
    treadfileprocess(15);
}
function treadFile16()
{
    treadfileprocess(16);
}
function treadFile17()
{
    treadfileprocess(17);
}
function treadFile18()
{
    treadfileprocess(18);
}
function treadFile19()
{
    treadfileprocess(19);
}
function treadFile20()
{
    treadfileprocess(20);
}
function treadFile21()
{
    treadfileprocess(21);
}
function treadFile22()
{
    treadfileprocess(22);
}
function treadFile23()
{
    treadfileprocess(23);
}
function treadFile24()
{
    treadfileprocess(24);
}
function treadFile25()
{
    treadfileprocess(25);
}
function treadFile26()
{
    treadfileprocess(26);
}
function treadFile27()
{
    treadfileprocess(27);
}
function treadFile28()
{
    treadfileprocess(28);
}
function treadFile29()
{
    treadfileprocess(29);
}
function treadFile30()
{
    treadfileprocess(30);
}
function treadFile31()
{
    treadfileprocess(31);
}
function treadFile32()
{
    treadfileprocess(32);
}
function treadFile33()
{
    treadfileprocess(33);
}
function treadFile34()
{
    treadfileprocess(34);
}
function treadFile35()
{
    treadfileprocess(35);
}
function treadFile36()
{
    treadfileprocess(36);
}
function treadFile37()
{
    treadfileprocess(37);
}
function treadFile38()
{
    treadfileprocess(38);
}
function treadFile39()
{
    treadfileprocess(39);
}
function treadFile40()
{
    treadfileprocess(40);
}

function treadfileprocess(num)
{
    var name=$('#previewaid').attr('name');
    $('#kind').val('t');

    if(name==0)
    {
        treadfileprocessnext(num);
        return;
    }


    changedisplayimg(num);



    // return;
    //
    var tupload="tupload"+num;
    var imgsrc;
    var input1 = document.getElementById(tupload);
    var file1 = input1.files[0];//获取上传文件列表中第一个文件
    if(!/image\/\w+/.test(file1.type)){
        alert("文件必须为图片！");
        return false;
    }



    tupload="#"+tupload;
    var file = $(tupload).get(0).files[0];


    if(file.size>8100000 && file!=null)
    {
        alert("请输入小于4M的文件！！");
        return;
    }
    test_img = document.getElementById("imgpreviewid");
    if(file!=null)
    {
        imgsrc = window.navigator.userAgent.indexOf("Chrome") >= 1 || window.navigator.userAgent.indexOf("Safari") >= 1 ? window.webkitURL.createObjectURL(input1.files[0]) : window.URL.createObjectURL(input1.files[0]);

        test_img.src=imgsrc;
    }




    // add_temp_test_file(imgsrc,num);
}


function treadfileprocessnext(num)
{
    var tupload="tupload"+num;
    var imgsrc;
    var input1 = document.getElementById(tupload);
    var file1 = input1.files[0];//获取上传文件列表中第一个文件
    if(!/image\/\w+/.test(file1.type)){
        alert("文件必须为图片！");
        return false;
    }



    tupload="#"+tupload;
    var file = $(tupload).get(0).files[0];


    if(file.size>8100000 && file!=null)
    {
        alert("请输入小于4M的文件！！");
        return;
    }
    test_img = document.getElementById("test_img");
    if(file!=null)
    {
        imgsrc = window.navigator.userAgent.indexOf("Chrome") >= 1 || window.navigator.userAgent.indexOf("Safari") >= 1 ? window.webkitURL.createObjectURL(input1.files[0]) : window.URL.createObjectURL(input1.files[0]);

        test_img.src=imgsrc;
    }


    add_temp_test_file(imgsrc,num);
}



function add_temp_test_file(imgsrc,num)
{
    //获取当前数量
    var sum=num;
    var testimgmsg="";

    if(num==$("#test_sum").val())
    {
    if(num==1)
    {
        $("#test_temp").html("");
        $("#test_temp").css("padding-top","2px");
        $("#test_temp").css("padding-left","15%");
        testimgmsg='<div id="test_div_'+num+'" style="float:left;"><img id="test_img'+num+'" onclick="timgclick(this.id)" name="test_img" style="margin-left:3px;margin-right:3px;margin-top:1px;margin-bottom:2px;width: 38px;height: 44px;" src="'+imgsrc+'"></div>';
    }
    else
    {
        testimgmsg='<div id="test_div_'+num+'" style="float:left;"><img id="test_img'+num+'" onclick="timgclick(this.id)" name="test_img"  style="margin-left:3px;margin-right:3px;margin-top:1px;margin-bottom:2px;width: 38px;height: 44px;" src="'+imgsrc+'"></div>';

    }
    var htmltemp=$("#test_temp").html();
    //添加temp中的div内容
    htmltemp=htmltemp+testimgmsg;
    $("#test_temp").html(htmltemp);
    var fileid="#tlabel"+num;
    $(fileid).css("display","none");
    num=parseInt(num)+1;
    fileid="#tlabel"+num;
    $(fileid).css("display","block");
    $("#test_sum").val(num);
        //选择上传文件后，确定当前选择的文件。
        for(var i=1;i<num;i++)
        {
            if(i==num-1)
            {
                $("#test_img"+i).css("border","1px solid #4b88a6");
                choosedsub("test_div",i);
            }
            else
            {
                $("#test_img"+i).css("border","1px none #4b88a6");
            }
        }
        var tsum=parseInt($("#answer_sum").val());
        for(var i=1;i<tsum;i++)
        {
            $("#answer_img"+i).css("border","1px none #4b88a6");
        }
    }
    else
    {
        var testid="#test_img"+num;
        $(testid).attr('src',imgsrc);
        var thisnum=parseInt(num)+1;
        var tupload="#tupload"+thisnum;
        var file = $(tupload).val();
        if(file=="")
        {
            var fileid="#tlabel"+num;
            $(fileid).css("display","none");
            num=parseInt(num)+1;
            fileid="#tlabel"+num;
            $(fileid).css("display","block");
        }
        if(file==null)
        {
            var fileid="#tlabel"+num;
            $(fileid).css("display","none");
            num=parseInt(num)+1;
            fileid="#tlabel"+num;
            $(fileid).css("display","block");
        }

    }
}

//添加test控件及事件end

//添加answer控件及事件begin

function add_answer_file(num)
{
    var firstele='<label id="alabel1"  style="display:block;" > <span id="aspan1" style="float:left;">1</span><input id="aupload1"  name="aupload1" accept="image/*" type="file" style="display: none" > <input id="areg1"  name="areg1" type="hidden" value="0"> <img class="teacher_panel_button" src="/Public/img/phone20.png"> </label>';
    var elemsg="";
    var i;
    for(var i=2;i<parseInt(num)+1;i++)
    {
        elemsg='<label id="alabel'+i+'" style="display:none;"> <span id="aspan'+i+'"  style="float:left;">'+i+'</span><input id="aupload'+i+'" accept="image/*" name="aupload'+i+'" type="file" style="display: none" ><input id="areg'+i+'" name="areg'+i+'" type="hidden" value="0" ><img class="teacher_panel_button" src="/Public/img/phone20.png"></label>';
        firstele=firstele+elemsg;
    }

    elemsg='<label id="alabel'+i+'" style="display: none;" onclick="answerdeclare()" >'+i+' <img class="teacher_panel_button" src="/Public/img/phone20.png"> </label>';
    firstele=firstele+elemsg;
    $("#adiv").html(firstele);
    bind_afile_event(num);
}
function unbind_afile_event(num)//2.在case中解绑绑定的对应函数
{
    for(var i=1;i<parseInt(num)+1;i++)
    {
        var input1 = document.getElementById("aupload"+i);
        if(typeof FileReader==='undefined'){
            input1.setAttribute('disabled','disabled');
        }else{
            if(i>num)
            {
                break;
            }
            switch(i)
            {
                case 1:input1.removeEventListener('change',areadFile1,false);
                    break;
                case 2:input1.removeEventListener('change',areadFile2,false);
                    break;
                case 3:input1.removeEventListener('change',areadFile3,false);
                    break;
                case 4:input1.removeEventListener('change',areadFile4,false);
                    break;
                case 5:input1.removeEventListener('change',areadFile5,false);
                    break;
                case 6:input1.removeEventListener('change',areadFile6,false);
                    break;
                case 7:input1.removeEventListener('change',areadFile7,false);
                    break;
                case 8:input1.removeEventListener('change',areadFile8,false);
                    break;
                case 9:input1.removeEventListener('change',areadFile9,false);
                    break;
                case 10:input1.removeEventListener('change',areadFile10,false);
                    break;
                case 11:input1.removeEventListener('change',areadFile11,false);
                    break;
                case 12:input1.removeEventListener('change',areadFile12,false);
                    break;
                case 13:input1.removeEventListener('change',areadFile13,false);
                    break;
                case 14:input1.removeEventListener('change',areadFile14,false);
                    break;
                case 15:input1.removeEventListener('change',areadFile15,false);
                    break;
                case 16:input1.removeEventListener('change',areadFile16,false);
                    break;
                case 17:input1.removeEventListener('change',areadFile17,false);
                    break;
                case 18:input1.removeEventListener('change',areadFile18,false);
                    break;
                case 19:input1.removeEventListener('change',areadFile19,false);
                    break;
                case 20:input1.removeEventListener('change',areadFile20,false);
                    break;
                case 21:input1.removeEventListener('change',areadFile21,false);
                    break;
                case 22:input1.removeEventListener('change',areadFile22,false);
                    break;
                case 23:input1.removeEventListener('change',areadFile23,false);
                    break;
                case 24:input1.removeEventListener('change',areadFile24,false);
                    break;
                case 25:input1.removeEventListener('change',areadFile25,false);
                    break;
                case 26:input1.removeEventListener('change',areadFile26,false);
                    break;
                case 27:input1.removeEventListener('change',areadFile27,false);
                    break;
                case 28:input1.removeEventListener('change',areadFile28,false);
                    break;
                case 29:input1.removeEventListener('change',areadFile29,false);
                    break;
                case 30:input1.removeEventListener('change',areadFile30,false);
                    break;
                case 31:input1.removeEventListener('change',areadFile31,false);
                    break;
                case 32:input1.removeEventListener('change',areadFile32,false);
                    break;
                case 33:input1.removeEventListener('change',areadFile33,false);
                    break;
                case 34:input1.removeEventListener('change',areadFile34,false);
                    break;
                case 35:input1.removeEventListener('change',areadFile35,false);
                    break;
                case 36:input1.removeEventListener('change',areadFile36,false);
                    break;
                case 37:input1.removeEventListener('change',areadFile37,false);
                    break;
                case 38:input1.removeEventListener('change',areadFile38,false);
                    break;
                case 39:input1.removeEventListener('change',areadFile39,false);
                    break;
                case 40:input1.removeEventListener('change',areadFile40,false);
                    break;

            }
        }
    }
}
function bind_afile_event(num)//2.在case中添加绑定的对应函数
{
    for(var i=1;i<parseInt(num)+1;i++)
    {
        var input1 = document.getElementById("aupload"+i);
        if(typeof FileReader==='undefined'){
            input1.setAttribute('disabled','disabled');
        }else{
            if(i>num)
            {
                break;
            }
            switch(i)
            {
                case 1:input1.addEventListener('change',areadFile1,false);
                    break;
                case 2:input1.addEventListener('change',areadFile2,false);
                    break;
                case 3:input1.addEventListener('change',areadFile3,false);
                    break;
                case 4:input1.addEventListener('change',areadFile4,false);
                    break;
                case 5:input1.addEventListener('change',areadFile5,false);
                    break;
                case 6:input1.addEventListener('change',areadFile6,false);
                    break;
                case 7:input1.addEventListener('change',areadFile7,false);
                    break;
                case 8:input1.addEventListener('change',areadFile8,false);
                    break;
                case 9:input1.addEventListener('change',areadFile9,false);
                    break;
                case 10:input1.addEventListener('change',areadFile10,false);
                    break;
                case 11:input1.addEventListener('change',areadFile11,false);
                    break;
                case 12:input1.addEventListener('change',areadFile12,false);
                    break;
                case 13:input1.addEventListener('change',areadFile13,false);
                    break;
                case 14:input1.addEventListener('change',areadFile14,false);
                    break;
                case 15:input1.addEventListener('change',areadFile15,false);
                    break;
                case 16:input1.addEventListener('change',areadFile16,false);
                    break;
                case 17:input1.addEventListener('change',areadFile17,false);
                    break;
                case 18:input1.addEventListener('change',areadFile18,false);
                    break;
                case 19:input1.addEventListener('change',areadFile19,false);
                    break;
                case 20:input1.addEventListener('change',areadFile20,false);
                    break;
                case 21:input1.addEventListener('change',areadFile21,false);
                    break;
                case 22:input1.addEventListener('change',areadFile22,false);
                    break;
                case 23:input1.addEventListener('change',areadFile23,false);
                    break;
                case 24:input1.addEventListener('change',areadFile24,false);
                    break;
                case 25:input1.addEventListener('change',areadFile25,false);
                    break;
                case 26:input1.addEventListener('change',areadFile26,false);
                    break;
                case 27:input1.addEventListener('change',areadFile27,false);
                    break;
                case 28:input1.addEventListener('change',areadFile28,false);
                    break;
                case 29:input1.addEventListener('change',areadFile29,false);
                    break;
                case 30:input1.addEventListener('change',areadFile30,false);
                    break;
                case 31:input1.addEventListener('change',areadFile31,false);
                    break;
                case 32:input1.addEventListener('change',areadFile32,false);
                    break;
                case 33:input1.addEventListener('change',areadFile33,false);
                    break;
                case 34:input1.addEventListener('change',areadFile34,false);
                    break;
                case 35:input1.addEventListener('change',areadFile35,false);
                    break;
                case 36:input1.addEventListener('change',areadFile36,false);
                    break;
                case 37:input1.addEventListener('change',areadFile37,false);
                    break;
                case 38:input1.addEventListener('change',areadFile38,false);
                    break;
                case 39:input1.addEventListener('change',areadFile39,false);
                    break;
                case 40:input1.addEventListener('change',areadFile40,false);
                    break;

            }
        }
    }
}
//3.添加对应的函数
function areadFile1()
{
    areadfileprocess(1);
}
function areadFile2()
{
    areadfileprocess(2);
}
function areadFile3()
{
    areadfileprocess(3);
}
function areadFile4()
{
    areadfileprocess(4);
}
function areadFile5()
{
    areadfileprocess(5);
}
function areadFile6()
{
    areadfileprocess(6);
}
function areadFile7()
{
    areadfileprocess(7);
}
function areadFile8()
{
    areadfileprocess(8);
}
function areadFile9()
{
    areadfileprocess(9);
}
function areadFile10()
{
    areadfileprocess(10);
}
function areadFile11()
{
    areadfileprocess(11);
}
function areadFile12()
{
    areadfileprocess(12);
}
function areadFile13()
{
    areadfileprocess(13);
}
function areadFile14()
{
    areadfileprocess(14);
}
function areadFile15()
{
    areadfileprocess(15);
}
function areadFile16()
{
    areadfileprocess(16);
}
function areadFile17()
{
    areadfileprocess(17);
}
function areadFile18()
{
    areadfileprocess(18);
}
function areadFile19()
{
    areadfileprocess(19);
}
function areadFile20()
{
    areadfileprocess(20);
}
function areadFile21()
{
    areadfileprocess(21);
}
function areadFile22()
{
    areadfileprocess(22);
}
function areadFile23()
{
    areadfileprocess(23);
}
function areadFile24()
{
    areadfileprocess(24);
}
function areadFile25()
{
    areadfileprocess(25);
}
function areadFile26()
{
    areadfileprocess(26);
}
function areadFile27()
{
    areadfileprocess(27);
}
function areadFile28()
{
    areadfileprocess(28);
}
function areadFile29()
{
    areadfileprocess(29);
}
function areadFile30()
{
    areadfileprocess(30);
}
function areadFile31()
{
    areadfileprocess(31);
}
function areadFile32()
{
    areadfileprocess(32);
}
function areadFile33()
{
    areadfileprocess(33);
}
function areadFile34()
{
    areadfileprocess(34);
}
function areadFile35()
{
    areadfileprocess(35);
}
function areadFile36()
{
    areadfileprocess(36);
}
function areadFile37()
{
    areadfileprocess(37);
}
function areadFile38()
{
    areadfileprocess(38);
}
function areadFile39()
{
    areadfileprocess(39);
}
function areadFile40()
{
    areadfileprocess(40);
}
function areadfileprocess(num)
{
    var name=$('#previewaid').attr('name');
    $('#kind').val('a');

    if(name==0)
    {
        areadfileprocessnext(num);
        return;
    }


    changedisplayimg(num);
    var aupload="aupload"+num;


    var imgsrc;
    var input1 = document.getElementById(aupload);
    var file1 = input1.files[0];//获取上传文件列表中第一个文件
    if(!/image\/\w+/.test(file1.type)){
        alert("文件必须为图片！");
        return false;
    }
    aupload="#"+aupload;
    var file = $(aupload).get(0).files[0];



    if(file.size>8100000 && file!=null)
    {
        alert("请输入小于4M的文件！！");
        return;
    }

    test_img = document.getElementById("imgpreviewid");

    if(file!=null)
    {
        imgsrc = window.navigator.userAgent.indexOf("Chrome") >= 1 || window.navigator.userAgent.indexOf("Safari") >= 1 ? window.webkitURL.createObjectURL(input1.files[0]) : window.URL.createObjectURL(input1.files[0]);

        test_img.src=imgsrc;
    }
    // add_temp_answer_file(imgsrc,num);
}


function areadfileprocessnext(num)
{
    var aupload="aupload"+num;


    var imgsrc;
    var input1 = document.getElementById(aupload);
    var file1 = input1.files[0];//获取上传文件列表中第一个文件
    if(!/image\/\w+/.test(file1.type)){
        alert("文件必须为图片！");
        return false;
    }
    aupload="#"+aupload;
    var file = $(aupload).get(0).files[0];

    if(file.size>8100000 && file!=null)
    {
        alert("请输入小于4M的文件！！");
        return;
    }
    test_img = document.getElementById("imgpreviewid");
    if(file!=null)
    {
        imgsrc = window.navigator.userAgent.indexOf("Chrome") >= 1 || window.navigator.userAgent.indexOf("Safari") >= 1 ? window.webkitURL.createObjectURL(input1.files[0]) : window.URL.createObjectURL(input1.files[0]);

        test_img.src=imgsrc;
    }
    add_temp_answer_file(imgsrc,num);
}



function add_temp_answer_file(imgsrc,num)
{

    //获取当前数量
//		var imgsrc="";
    var answerimgmsg="";
    if(num==$("#answer_sum").val())
    {
    //添加testfile控件,隐藏
    var answerfilemsg='<input id="answer_file_'+num+'" name="answer_file_'+num+'" type="file">';
    //添加test缩略图，显示
    if(num==1)
    {
        $("#answer_temp").html("");
        $("#answer_temp").css("padding-top","2px");
        $("#answer_temp").css("padding-left","15%");
        answerimgmsg='<div id="answer_div_'+num+'" style="float:left;"><img id="answer_img'+num+'" name="answer_img" onclick="aimgclick(this.id)" style="margin-left:3px;margin-right:3px;margin-top:1px;margin-bottom:2px;width: 38px;height: 44px;" src="'+imgsrc+'"></div>';
    }
    else
    {
        answerimgmsg='<div id="answer_div_'+num+'" style="float:left;"><img id="answer_img'+num+'" name="answer_img" onclick="aimgclick(this.id)" style="margin-left:3px;margin-right:3px;margin-top:1px;margin-bottom:2px;width: 38px;height: 44px;" src="'+imgsrc+'"></div>';

    }

    //获得temp中div的内容
    var htmltemp=$("#answer_temp").html();
    //添加temp中的div内容
    htmltemp=htmltemp+answerimgmsg;
    $("#answer_temp").html(htmltemp);
    var fileid="#alabel"+num;
    $(fileid).css("display","none");
    num=parseInt(num)+1;
    fileid="#alabel"+num;
    $(fileid).css("display","block");
    $("#answer_sum").val(num);


        //选择上传文件后，确定当前选择的文件。
      for(var i=1;i<num;i++)
      {
          if(i==num-1)
          {
              $("#answer_img"+i).css("border","1px solid #4b88a6");
              choosedsub("answer_div",i);
          }
          else
          {
              $("#answer_img"+i).css("border","1px none #4b88a6");
          }

      }
      var tsum=parseInt($("#test_sum").val());
      for(var i=1;i<tsum;i++)
      {
          $("#test_img"+i).css("border","1px none #4b88a6");
      }
    }
    else
    {

        var answerid="#answer_img"+num;
        $(answerid).attr('src',imgsrc);

        var thisnum=parseInt(num)+1;
        var aupload="#aupload"+thisnum;
        var file = $(aupload).val();
        if(file=="")
        {
            var fileid="#alabel"+num;
            $(fileid).css("display","none");
            num=parseInt(num)+1;
            fileid="#alabel"+num;
            $(fileid).css("display","block");
        }
        if(file==null)
        {
            var fileid="#alabel"+num;
            $(fileid).css("display","none");
            num=parseInt(num)+1;
            fileid="#alabel"+num;
            $(fileid).css("display","block");
        }
    }
    //选中img 边框颜色 border:1px solid #4b88a6;margin-left:3px;
}
//添加answer控件及事件end
function choosedsub(msg,i)
{
    $("#justnum").html("");
    $("#choosedele").val("");
    $("#justnum").html(i);
    $("#choosedele").val(msg+"_"+i);

    myreg(i);//将当前控件的input，reg读取

    if(msg.indexOf('test')>-1)
    {
        var deg=$("#treg"+i).val();
      //  alert("testreg:"+deg);
        $("#test_img").css({transform: "rotate(" + deg + "deg)"});
    }
    if(msg.indexOf('answer')>-1)
    {
        var deg=$("#areg"+i).val();
      //  alert("answerreg:"+deg);
        $("#test_img").css({transform: "rotate(" + deg + "deg)"});
    }

}