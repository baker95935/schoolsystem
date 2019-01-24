/**
 * Created by fangzheng on 2018/4/16.
 */
//num 0表示仅有标题，1表示标题和图片
function titlesub(num,src,titlea,titleb,aline,kind){
    var titlehtml;
    var idnum=$('#testimgnum').val();

    if(kind=='up'){ idnum='iup';}
    if(kind=='down'){ idnum='idown';}


    var inputid='input'+idnum;
    var imgid='img'+idnum;
    var tsernum=$('#titleanswer').val();
    var inputserid='inputser'+idnum;
    var notemsg=notemsgsub(idnum);
    var picid='inputpic'+idnum;


    if(num==0)
    {
        if(kind!='up' || kind!='down') {
            $('#preimgsrc').val('0');
            $('#preimgid').val('0');
            $('#prekind').val('t0');
        }
        titlehtml='<ctb id="ctb'+idnum+'"  name="t0" style="display: block;" class="'+tsernum+'"><input id="'+inputserid+'" type="hidden" name="'+tsernum+'"> <input id="'+inputid+'" ondblclick="notedisplaysub(this.id)" name="title" style="height: 24px;margin-bottom: 4px;" type="text" style="text-align: '+aline+';" value="'+titlea+'&nbsp;'+titleb+'&nbsp;(T)">'+notemsg+'<img id="'+imgid+'"   name="title" style="display: none;"  src="" onclick="notedisplaysub(this.id)"><input id="'+picid+'" type="hidden" value="1"></ctb>';

    }
    else
    {
        if(kind!='up' || kind!='down') {
            $('#preimgsrc').val(src);
            $('#preimgid').val(imgid);
            $('#prekind').val('t1');
        }
        var src1=src+'?'+timemsgsub();
        titlehtml='<ctb id="ctb'+idnum+'"  name="t1"  style="display: block;"  class="'+tsernum+'"><input id="'+inputserid+'" type="hidden" name="'+tsernum+'"><input id="'+inputid+'" name="title"   style="height: 24px;margin-bottom: 4px;"  type="text" style="text-align: '+aline+';" value="'+titlea+'&nbsp;'+titleb+'&nbsp;(T)">'+notemsg+'<img id="'+imgid+'"   name="title"  style="display: block;" src="'+src1+'" onclick="notedisplaysub(this.id)"><input id="'+picid+'" type="hidden" value="1"></ctb>';
    }
    $('#testimgnum').val(parseInt($('#testimgnum').val())+1);
    if(kind=='new'){ $('#display_div').append(titlehtml);}
    if(kind=='up'){ $('#ctbup').after(titlehtml);$('#ctbup').remove();}
    if(kind=='down'){ $('#ctbdown').after(titlehtml);$('#ctbdown').remove();}
}
//添加标题和答案一起的习题
function titleanswersub(titlea,titleb,src,kind){
    var idnum=$('#testimgnum').val();

    if(kind=='up'){ idnum='iup';}
    if(kind=='down'){ idnum='idown';}

    var inputid='input'+idnum;
    var imgid='img'+idnum;
    var divid='div'+idnum;
    var tsernum=$('#titleanswer').val();
    var inputserid='inputser'+idnum;
    var notemsg=notemsgsub(idnum);
    var picid='inputpic'+idnum;
    if(kind!='up' || kind!='down')
    {
        $('#preimgsrc').val(src);
        $('#preimgid').val(imgid);
        $('#prekind').val('t-a');
    }
    var src1=src+'?'+timemsgsub();
    var htmlmsg='<ctb id="ctb'+idnum+'"  style="display: block;"  name="t-a" ><input id="'+inputserid+'" type="hidden" name="'+tsernum+'"><input id="'+inputid+'"  name="titleanswer"  style="height: 24px;margin-bottom: 4px;"  type="text" value="'+titlea+"&nbsp;"+titleb+"&nbsp;(T+A)"+'">'+notemsg+'<img id="'+imgid+'"  src="'+src1+'"  name="titleanswer"  onclick="notedisplaysub(this.id)"><input id="'+picid+'" type="hidden" value="1"></ctb>';
    $('#testimgnum').val(parseInt($('#testimgnum').val())+1);
    if(kind=='new'){ $('#display_div').append(htmlmsg);}
    if(kind=='up'){ $('#ctbup').after(htmlmsg);$('#ctbup').remove();}
    if(kind=='down'){ $('#ctbdown').after(htmlmsg);$('#ctbdown').remove();}
}
//添加仅有答案的习题
function answersub(titlea,titleb,src,kind){
    var idnum=$('#testimgnum').val();
    var tsernum=$('#titleanswer').val();
    if(kind=='up'){ idnum='iup';tsernum=$('#updownser').val();}
    if(kind=='down'){ idnum='idown';tsernum=$('#updownser').val();}
    var notemsg=notemsgsub(idnum);
    var inputid='input'+idnum;
    var imgid='img'+idnum;
    var brid='br'+idnum;
    var spanida='span'+idnum+'_a';
    var spanidb='span'+idnum+'_b';
    var picid='inputpic'+idnum;

    var inputserid='inputser'+idnum;
    if(kind!='up' || kind!='down') {
        $('#preimgsrc').val(src);
        $('#preimgid').val(imgid);
        $('#prekind').val('a');
    }
    var src1=src+'?'+timemsgsub();
    var htmlmsg='<ctb id="ctb'+idnum+'" name="a"  style="display: block;"   class="'+tsernum+'"><input id="'+inputserid+'" type="hidden" name="'+tsernum+'"><input  id="'+inputid+'"name="answer"  style="height: 24px;margin-bottom: 4px;"  type="text" value="'+titlea+"&nbsp;"+titleb+"&nbsp;(A)"+'">'+notemsg+'<img id="'+imgid+'"  name="answer" src="'+src1+'"  onclick="notedisplaysub(this.id)"><input id="'+picid+'" type="hidden" value="1"></ctb>';

    $('#testimgnum').val(parseInt($('#testimgnum').val())+1);
    if(kind=='new'){ $('#display_div').append(htmlmsg);}
    if(kind=='up'){ $('#ctbup').after(htmlmsg);$('#ctbup').remove();}
    if(kind=='down'){ $('#ctbdown').after(htmlmsg);$('#ctbdown').remove();}
}
//提示栏显示信息，及点击图片显示事件
function notedisplaysub(id) {
    if($('#reimgkind').val()=='pic')
    {
        displaynoterule(1,num);
    }
    $('#ctbup').remove();
    $('#ctbdown').remove();
    $('#reimgkind').val('');
    $('#reimgid').val('');
    $('#automsg').val('Auto');
    var num=id.replace(/[^0-9]/ig,"");
    // initnotedisplay(num);
    if($('#note'+num).css('display')=='none'){

        $('#note'+num).css('display','');
    }
    else
    {
        $('#note'+num).css('display','none');
    }
    if($('#nownote').val()=='note'+num){

        $('#note_re'+num).val('RE');
        $('#note_eraser'+num).val('□');
        $('#note_pic'+num).val('+Pic');
        $('#note_down'+num).val('+↓');
        $('#note_up'+num).val('+↑');
        return;
    }
    var id1=$('#nownote').val();
    $('#'+id1).css('display','none');
    var num1=id1.replace(/[^0-9]/ig,"");
    $('#note_re'+num1).val('RE');
    $('#note_eraser'+num1).val('□');
    $('#note_pic'+num1).val('+Pic');
    $('#note_down'+num1).val('+↓');
    $('#note_up'+num1).val('+↑');
    $('#nownote').val('note'+num);
}
//隐藏note，好像没有用
function notedisplaynone(id) {
    var num=id.replace(/[^0-9]/ig,"");
    $('#note'+num).css('display','none');
}
//返回事件随机数
function timemsgsub(){
    var d=new Date();
    return d.getTime();
}
//控制面板操作
function noteoperate(id){
    var id=id.replace('*',"");
    var msg = id.replace(/[^a-z]+/ig,"");
    var num = id.replace(/[^0-9]/ig,"");
    var kind=$('#ctb'+num).attr("name");
    var sernum;
    msg=msg.replace("note", "");
    initnotemsg(num);

    if(msg=='erase'){};
    if(msg=='re'){
        reimgsub(num);
    };
    if(msg=='down'){
        newaddpic('down',num);
        initfinishdiv();
        $('#updownid').val(num);
        $('#updownkind').val('down');
        $('#updownser').val(idtosernum(num));
        return;
    };
    if(msg=='up'){
        newaddpic('up',num);
        initfinishdiv();
        $('#updownid').val(num);
        $('#updownkind').val('up');
        $('#updownser').val(idtosernum(num));
        return;
    };
    if(msg=='del'){
        deltitle(id,kind);
    };
    if(msg=='esc'){
        var num=id.replace(/[^0-9]/ig,"");
       // $('#note'+num).css('display','none');
    };
    if(msg=='page'){

    };
    if(msg=='pic'){
        newaddimg(0,num);

        // $('#updownid').val(num);
        // $('#updownkind').val('up');
        // $('#updownser').val(idtosernum(num));
       // addimgpic();
    };
    $('#ctbup').remove();
    $('#ctbdown').remove();
}
// 提示信息栏
function notemsgsub(idnum){
    var notemsg='<div id="note'+idnum+'"  style="text-align: center;width: 100%;height:25px;display: none;margin-bottom: 1px;"><input id="note_eraser'+idnum+'" onclick="noteoperate(this.id)"  style="margin-left: 15px;font-size: 14px;height: 20px; width: 40px; background-color: #e8f1f2;" type="button" value="□"><input id="note_pic'+idnum+'" onclick="noteoperate(this.id)"  style="margin-left: 15px;font-size: 14px;height: 20px; width: 40px; background-color: #e8f1f2;" type="button" value="+Pic"><input id="note_re'+idnum+'" onclick="noteoperate(this.id)"  style="margin-left: 15px;font-size: 14px;height: 20px; width: 40px; background-color: #e8f1f2;" type="button" value="RE"><input id="note_down'+idnum+'" onclick="noteoperate(this.id)"   style="margin-left: 15px;font-size: 14px;height: 20px; width: 40px; background-color: #e8f1f2;" type="button" value="+↓"><input id="note_up'+idnum+'" onclick="noteoperate(this.id)"  style="margin-left: 15px;font-size: 14px;height: 20px; width: 40px; background-color: #e8f1f2;" type="button" value="+↑"><input id="note_del'+idnum+'" onclick="noteoperate(this.id)"  style="margin-left: 10px;font-size: 14px;height: 20px; width: 40px; background-color: #e8f1f2;" type="button" value="Del"><input  id="note_esc'+idnum+'" onclick="noteoperate(this.id)"   style="margin-left: 10px;height: 20px;font-size: 14px; width: 50px;background-color: #e8f1f2;" value="Esc" type="button"><span id="notespan'+idnum+'" style="font-size: 14px;margin-left: 10px;">&nbsp;&nbsp;P'+$('#nowpagemsg').val()+'</span></div>';


    return notemsg;
}
//习题成组随机数
function titlesernumsub(kind){


    var d=new Date();
    var titlenum=d.getTime();

    switch(kind){
        case '(T)':
            $('#titleanswer').val(titlenum);break;
        case '(T+A)':
            $('#titleanswer').val(0);break;
        case '(A)': break;
    }
}
//删除分解后的习题
function deltitle(id,kind){
    var msg = id.replace(/[^a-z]+/ig,"");
    var num = id.replace(/[^0-9]/ig,"");
    var anum = id.replace(/[^0-9]/ig,"");
    var id=$('#inputpic'+num).attr('name');


    if(kind=='t-a'){
        $('#ctb'+num).remove();


        delsqldata(id,'t-a',1);
        regsernum(num,0);
    }
    if(kind=='t0' || kind=='t1'){

        var myname=($('#inputser'+num).attr("name"));
        var leng=$("input[name="+myname+"]").length;
        leng=leng-1;
        myname="."+myname;
        $("ctb").remove(myname);
        var tleng=leng+1;
        if(kind=='t0')
        {
            delsqldata(id,'t0',tleng);
        }
        else
        {
            delsqldata(id,'t1',tleng);
        }

        regsernum(num,leng);
    }
    if(kind=='a'){
        var myname=($('#inputser'+num).attr("name"));
        var num=$("input[name="+myname+"]").length;

        if(num>2)
        {
            $('#ctb'+anum).remove();
            delsqldata(id,'a',1);
            regsernum(anum,0);
        }
        else
        {
            delsqldata(id,'a',2);
            myname="."+myname;
            $("ctb").remove(myname);
            anum=anum-1;
            regsernum(anum,1);
        }
    }
}
//1，第2，3去掉，第4个往前移动，一共7个从，长度为1=（3-2）。从第2个去掉。
function regsernum(num,leng){
    // alert('num:'+num+',leng:'+leng);
    var sum=parseInt($('#testimgnum').val())-1;
    var j;
    num=parseInt(num)+parseInt(leng);
    if(num==sum){

        $('#testimgnum').val(parseInt($('#testimgnum').val())-leng-1);
        return 1;
    }
    else
    {
        //alert("num:"+num+",sum:"+sum);
        for(var i=num+1;i<=sum;i++){
            j=i-leng-1;


            inchangesub(i,j);
        }
    }
    $('#testimgnum').val(parseInt($('#testimgnum').val())-leng-1);
}
//增加一个元素之后调整顺序,begin,开始的数值，sum，一共的数值，kind向上还是向下添加
function addsernum(begin,sum,kind){
    if(kind=='up'){
        for(var i=sum-1;i>=begin;i--){
            j=i+1;
            inchangesub(i,j)
        }

        inchangesub("iup",begin);
    }else
    {
        for(var i=sum-1;i>=begin;i--){
            j=i+1;

           // alert('CTB:'+j+"变成"+'CTB:'+i);

           inchangesub(i,j)
        }
        i=i+1;
        inchangesub("idown",i);
    }
}
//进行内部调整顺序
function inchangesub(i,j){
    var kind=$("#ctb"+i).attr("name");
    if(kind=='t1'){
        $("#ctb"+i).attr("id","ctb"+j);
        $("#inputser"+i).attr("id","inputser"+j);
        $("#input"+i).attr("id","input"+j);
        $("#img"+i).attr("id","img"+j);
    }
    if(kind=='t0'){
        $("#ctb"+i).attr("id","ctb"+j);
        $("#inputser"+i).attr("id","inputser"+j);
        $("#input"+i).attr("id","input"+j);
        $("#img"+i).attr("id","img"+j);
    }
    if(kind=='a'){
        $("#ctb"+i).attr("id","ctb"+j);
        $("#inputser"+i).attr("id","inputser"+j);
        $("#input"+i).attr("id","input"+j);
        $("#img"+i).attr("id","img"+j);
    }
    if(kind=='t-a'){
        $("#ctb"+i).attr("id","ctb"+j);
        $("#inputser"+i).attr("id","inputser"+j);
        $("#input"+i).attr("id","input"+j);
        $("#img"+i).attr("id","img"+j);
    }
    $("#note"+i).attr("id","note"+j);
    $("#note_eraser"+i).attr("id","note_eraser"+j);
    $("#note_pic"+i).attr("id","note_pic"+j);
    $("#note_re"+i).attr("id","note_re"+j);
    $("#note_down"+i).attr("id","note_down"+j);
    $("#note_up"+i).attr("id","note_up"+j);
    $("#note_del"+i).attr("id","note_del"+j);
    $("#note_close"+i).attr("id","note_close"+j);
    $("#notespan"+i).attr("id","notespan"+j);

    $("#pic"+i).attr("id","pic"+j);

    var picnum=$("#inputpic"+i).val();

    if(picnum==5)
    {
        $("#pic"+i+"1").attr("id","pic"+j+"1");
        $("#pic"+i+"2").attr("id","pic"+j+"2");
        $("#pic"+i+"3").attr("id","pic"+j+"3");
        $("#pic"+i+"4").attr("id","pic"+j+"4");
    }
    if(picnum==4)
    {
        $("#pic"+i+"1").attr("id","pic"+j+"1");
        $("#pic"+i+"2").attr("id","pic"+j+"2");
        $("#pic"+i+"3").attr("id","pic"+j+"3");
    }
    if(picnum==3)
    {
        $("#pic"+i+"1").attr("id","pic"+j+"1");
        $("#pic"+i+"2").attr("id","pic"+j+"2");
    }
    if(picnum==2)
    {
        $("#pic"+i+"1").attr("id","pic"+j+"1");
    }
    if(picnum==1)
    {

    }
    // $("#inputser"+i)
    $("#ctbpicid"+i).attr("id","ctbpicid"+j);
    $("#inputpic"+i).attr("id","inputpic"+j);
    $("#note"+j).css('display','none');
}
//选择添加文件的类型
function chooseimgkind(id){

    $("#up_span_a").removeClass();
    $("#up_span_b").removeClass();
    $("#up_span_c").removeClass();
    $("#up_span_del").removeClass();

    $("#down_span_a").removeClass();
    $("#down_span_b").removeClass();
    $("#down_span_c").removeClass();
    $("#down_span_del").removeClass();


    if(id=='a'){
        $("#up_span_a").attr("class", "span_class_del03");
    }
    if(id=='b'){
        $("#up_span_b").attr("class", "span_class_del03");
    }
    if(id=='c'){
        $("#up_span_c").attr("class", "span_class_del03");
    }
    if(id=='del'){
    }

    if(id=='a1'){
        $("#down_span_a").attr("class", "span_class_del03");
    }
    if(id=='b1'){
        $("#down_span_b").attr("class", "span_class_del03");
    }
    if(id=='c1'){
        $("#down_span_c").attr("class", "span_class_del03");
    }
    if(id=='del1'){
    }

}
//添加新的数据
function newaddpic(upordown,num){

    $('#ctbup').remove();
    $('#ctbdown').remove();
    if(upordown=='up'){
      if($('#note_up'+num).val()=='+↑*')
        {
            $('#ctbup').remove();
            $('#note_up'+num).val('+↑');
            $('#reimgkind').val('');
            $('#reimgid').val('');
        }
        else
        {
            $('#note_up'+num).val('+↑*');
            var html='<ctb id="ctbup"><br><br><br><br><span style="margin: 0 auto;color: red;">新的习题(up)</span><br><br><br></ctb>';
            $('#ctb'+num).before(html);
            $('#reimgkind').val('up');
            $('#automsg').val('Pause');
            $('#reimgid').val('img'+num);
        }
    }
    if(upordown=='down'){
        if($('#note_down'+num).val()=='+↓*') {

            $('#ctbdown').remove();
            $('#note_down'+num).val('+↓');
            $('#reimgkind').val('');
            $('#reimgid').val('');

        }
        else
        {
            $('#note_down'+num).val('+↓*');
            var html = '<ctb id="ctbdown"><br><br><br><br><span style="margin: 0 auto;color: red;">新的习题(down)</span><br><br><br></ctb>';
            $('#ctb' + num).after(html);
            $('#reimgkind').val('down');
            $('#automsg').val('Pause');
            $('#reimgid').val('img'+num);

        }
    }
}
//没有用
function notelistchange(id){

    $('#add_img_child_close').removeClass('notelistchange');
    $('#add_img_child_ta').removeClass('notelistchange');
    $('#add_img_child_t').removeClass('notelistchange');
    $('#add_img_child_a').removeClass('notelistchange');


    if(id=='add_img_child_close'){
        $('#add_img_child_close').addClass('notelistchange');
    }
    if(id=='add_img_child_ta'){
        $('#add_img_child_ta').addClass('notelistchange');
    }
    if(id=='add_img_child_t'){
        $('#add_img_child_t').addClass('notelistchange');
    }
    if(id=='add_img_child_a'){
        $('#add_img_child_a').addClass('notelistchange');
    }
}
//没有用
function notelistdisplay(kind){
    if(kind==0){

        $('#add_img_child_close').removeClass('notelistchange');
        $('#add_img_child_ta').removeClass('notelistchange');
        $('#add_img_child_t').removeClass('notelistchange');
        $('#add_img_child_a').removeClass('notelistchange');
        $('#add_img_div').css('display','none');
    }
    else{
        $('#add_img_div').css('display','');
    }

}
//添加习题配图
function newaddimg(kind,num){
    initnotemsg(num);
    $('#note_pic'+num).val('+Pic*');
    $('#reimgkind').val('pic');
    $('#addpicid').val('note_pic'+num);
     displaynoterule(kind,num);

}
//重新设置图片的函数
function reimgsub(num){
    replacesub(num);
    $('#automsg').val('Pause');
    $('#finish_div').css('height',0);
    var src=$('#img'+num)[0].src;
    src=changinitsrc(src);
    $('#reimgsrc').val(src);
    $('#reimgid').val('img'+num);
    $('#reimgkind').val('re');
    $('#note_re'+num).val($('#note_re'+num).val()+'*');

}
//控制序号增量的函数
function autosub(){
    if($('#automsg').val()=='Pause'){
        $('#automsg').val('Auto');
        $('#reimgkind').val('');
    }
    else
    {
        $('#automsg').val('Pause');
    }
}
//重置分割习题操作面板的函数
function replacesub(num){
    var msg=$('#note_re'+num).val();
    msg=msg.replace('*','');
    $('#note_re'+num).val(msg);

}
//将文件地址，转化成网络可用地址
function changinitsrc(src){
    var anum = src.indexOf('uploads');
    var alength = src.length;
    var src = "./" + src.substr(anum, alength - anum);
    var numx=src.indexOf('?');
    return src.substr(0,numx);
}
//将网络地址，转化成文件可用地址
function changfilesrc(src){
    var src=src.replace('./','/');
    var myDate = new Date();
    //获取当前年
    var year = myDate.getFullYear();
    //获取当前月
    var month = myDate.getMonth() + 1;
    //获取当前日
    var date = myDate.getDate();
    var h = myDate.getHours(); //获取当前小时数(0-23)
    var m = myDate.getMinutes(); //获取当前分钟数(0-59)
    var s = myDate.getSeconds();
    //获取当前时间
    var now = year+'' + month+'' + date+''+h+''+ m+''+ s;
    return src+'?'+now;
}
// 初始化导航栏
function initnotemsg(num){
    $('#automsg').val('Auto');
    $('#reimgsrc').val(0);
    $('#reimgid').val(0);
    $('#reimgkind').val(0);
    $('#note_re'+num).val('RE');
    $('#note_eraser'+num).val('□');
    $('#note_pic'+num).val('+Pic');
    $('#note_down'+num).val('+↓');
    $('#note_up'+num).val('+↑');
    displaynoterule(1,num);
    $('#addpicid').val(0);
}
//判断额外插入的数据是否合法
function justnewpic(upordown,kind,num) {

    var num=parseInt(num);
    var prenum=num-1;
    var nextnum=num+1;
    var premsg;
    var nextmsg;
    var sernum=$('#updownser').val();
    var sum=parseInt($('#testimgnum').val()-1);
    if(kind=='t-a'){
        if (upordown == 'up') {
            if (prenum == 0) {
                premsg = 'begin';
            }
            else {
                premsg = $('#ctb' + prenum).attr('name');
            }
            nextmsg = $('#ctb' + num).attr('name');


            var msg = justt_a(premsg, kind, nextmsg);

            if (msg == 0) {
                return 0;
            }
            else
            {
                return num;
            }

            // return msg;
        }
        if (upordown == 'down') {

            if(num==sum)
            {
                nextmsg='end';
            }
            else
            {
                nextmsg=$('#ctb'+nextnum).attr('name');
            }

            premsg=$('#ctb'+num).attr('name');

            var msg = justt_a(premsg, kind, nextmsg);

            if (msg == 0) {
                return 0;
            }
            else
            {
                num=num+1;
                return num;
            }
        }
    }
    if(kind=='t'){
        if(upordown=='up'){

            if(prenum==0)
            {
                premsg='begin';
            }
            else
            {
                premsg=$('#ctb'+prenum).attr('name');
            }
            nextmsg=$('#ctb'+num).attr('name');

            var msg=justt_a(premsg,kind,nextmsg);
            //ata情况下进行修改
            if(msg==4)
            {
                atasernum('up',num,sernum);
                return num;
            }

            if(msg==13 || msg==14){
                return num;
            }

           return msg;

        }
        if(upordown=='down'){


            if(num==sum)
            {
                nextmsg='end';
            }
            else
            {
                nextmsg=$('#ctb'+nextnum).attr('name');
            }

            premsg=$('#ctb'+num).attr('name');


            var msg=justt_a(premsg,kind,nextmsg);
            if(msg==4)
            {
                atasernum('down',num,sernum);
                num=num+1;
                return num;
            }

            if(msg==13 || msg==14 || msg==15){

                num=num+1;
                return num;
            }

            return msg;
        }
    }
    if(kind=='a') {
        if (upordown == 'up') {
            if (prenum == 0) {
                premsg = 'begin';
            }
            else {
                premsg = $('#ctb' + prenum).attr('name');
            }
            nextmsg = $('#ctb' + num).attr('name');

            var msg = justt_a(premsg, kind, nextmsg);


            if (msg == 17 || msg == 18) {
                return num;
            }

            return msg;
        }
        if (upordown == 'down') {

            if(num==sum)
            {
                nextmsg='end';
            }
            else
            {
                nextmsg=$('#ctb'+nextnum).attr('name');
            }

            premsg=$('#ctb'+num).attr('name');

            var msg = justt_a(premsg, kind, nextmsg);

        //  alert('pre:'+premsg+',kind:'+kind+',nextmsg:'+nextmsg);

            if (msg == 17 || msg == 18) {
                num=num+1;

               // alert(num);
                return num;
            }
            return msg;
        }
    }
}
//根据数据类型判断是否合法,函数会去掉t-a重的-，所以t-a变成ta
function justt_a(pre,kind,next) {

    //alert(pre+','+kind+','+next);

    var pre = pre.replace(/[^a-z]/ig,"");
    var kind = kind.replace(/[^a-z]/ig,"");
    var next = next.replace(/[^a-z]/ig,"");

    // if(pre=='ta' && kind=='t-a' && next=='ta'){
    //     return 1;
    // }

    if(pre=='ta' && kind=='t' && next=='ta'){
        return 2;
    }
    // if(pre=='t' && kind=='a' && next=='a'){
    //     return 3;
    // }

    if(pre=='a' && kind=='t' && next=='a'){
        return 4;
    }

    // if(pre=='a' && kind=='a' && next=='a'){
    //     return 5;
    // }

    // if(pre=='begin' && kind=='ta' && next=='ta'){
    //     return 6;
    // }
    // if(pre=='begin' && kind=='ta' && next=='t'){
    //     return 7;
    // }
    // if(pre=='ta' && kind=='ta' && next=='end'){
    //     return 8;
    // }
    if(pre=='ta' && kind=='t' && next=='end'){
        return 9;
    }
    // if(pre=='a' && kind=='a' && next=='end'){
    //     return 10;
    // }
    // if(pre=='a' && kind=='ta' && next=='end'){
    //     return 11;
    // }
    // if(pre=='t' && kind=='a' && next=='end'){
    //     return 12;
    // }
    if(kind=='t' && next=='t'){
        return 13;
    }
    if(kind=='t' && next=='ta'){
        return 14;
    }
    if(kind=='t' && next=='end'){
        return 15;
    }
    if(pre=='a' && kind=='a'){
        return 17;
    }
    if(pre=='t' && kind=='a'){
        return 18;
    }
    if(kind=='ta')
    {
        if(kind=='ta' && next=='a'){
        return 0;
         }
        else
        {
            return 19;
        }
    }

    if(pre=='t' && kind=='t' && next=='a'){
        return 0;
    }


    return 0;
}
//获得根据id，获得t或者a类型的sernum
function idtosernum(num) {
    return $('#inputser'+num).attr('name');
}
//在ata排序情况下序号变化及插入序列码
function atasernum(upordown,tnum,sernum){

    titlesernumsub($('#test_or_answer').text());
    var leng1;
    var beginnum=parseInt(mytitlenum(upordown,tnum,sernum));
    var endnum=parseInt(myendnum(upordown,tnum,sernum));
    var tnum=parseInt(tnum);
    var nowsernum=$('#titleanswer').val();
    var i=tnum;
    if(upordown=='up')
    {
        while(i<=endnum){
            $('#ctb'+i).removeClass(sernum);
            $('#ctb'+i).addClass(nowsernum);
            $('#inputser'+i).attr('name',nowsernum);
            i++;
        }

    }
    if(upordown=='down')
    {
        i=i+1;
        while(i<=endnum){
            $('#ctb'+i).removeClass(sernum);
            $('#ctb'+i).addClass(nowsernum);
            $('#inputser'+i).attr('name',nowsernum);
            i++;
        }
    }

    // alert(upordown+','+tnum+','+sernum+','+leng1);
    //alert(mytitlenum('up',tnum,sernum));
   // myendnum('up',tnum,sernum);
}
//判断当前序列中，题目的的序号
function mytitlenum(upordown,tnum,sernum){
    var i=tnum;

    while (i>0)
    {
        if($('#ctb'+i).attr('name')=='t1' || $('#ctb'+i).attr('name')=='t0'){
            return i;
            break;
        }
        i--;
    }
    return 0;
}
//t,a中中最后一个a
function myendnum(upordown,tnum,sernum){
    var i=parseInt(tnum);
    leng1=$("input[name="+sernum+"]").length;
    while (i>0)
    {
        if($('#ctb'+i).attr('name')=='t1' || $('#ctb'+i).attr('name')=='t0' || $('#ctb'+i).attr('name')=='t-a'){
            i=i+parseInt(leng1)-1;
            return i;
            break;
        }
        i--;
    }
    return 0;
}
//添加图片位置的函数，a，b
function addpiclocal(x,y,kind){
    if(kind=="a"){
        newPos=new Object();
        newPos.left= x-20;
        newPos.top= y-20;
        $('#add_pic_div').offset(newPos);
        $('#add_pic_div_a').css('display','block');
        $('#add_pic_div_b').css('display','none');

    }
    if(kind=="b"){
        newPos=new Object();
        newPos.left= x-20;
        newPos.top= y-20;
        $('#add_pic_div').offset(newPos);
        $('#add_pic_div_b').css('display','block');
        $('#add_pic_div_a').css('display','block');

    }
    if(kind=="none"){
        newPos=new Object();
        newPos.left= 0;
        newPos.top= 0;
        $('#add_pic_div').offset(newPos);
        $('#add_pic_div_b').css('display','none');
        $('#add_pic_div_a').css('display','none');

    }


}
//添加配图时候隐藏或者显示导航
function displaynoterule(kind,num){
    if(kind==0){
        initfinishdiv();
        $('#rule_hr').css('display','none');
        $('#buttondiv2').css('display','none');
        $('#buttondiv3').css('display','none');
        $('#buttondiv4').css('display','none');
        $('#addpic').val(1);
        $('#addpickind').val('a');
        var kind=$('#addpickind').val();
        addpiclocal(880,600,kind);
        $('#automsg').val('Pause');
    }
    if(kind==1){
        $('#rule_hr').css('display','block');
        $('#buttondiv2').css('display','none');
        $('#buttondiv3').css('display','none');
        $('#buttondiv4').css('display','none');

        $('#addpic').val(0);
        $('#addpickind').val("none");
        var kind=$('#addpickind').val();
        addpiclocal(880,600,kind);
        $('#add_pic_div').css('display','none');
        $('#add_pic_div_a').css('display','none');
        $('#add_pic_div_b').css('display','none');
        $('#automsg').val('Auto');
        $('#addpicid').val(0);
        inithr();
        $('#hr_y').val($('#choose_img').offset().top);
    }
}
//添加配图
function addpicmsgsub(num,src) {
    var inputpicid='#inputpic'+num;
    var picnum=$(inputpicid).val();
    var imgid='#img'+num;
    var picid='pic'+num+picnum;
    var newpicid='pic'+num+(parseInt(picnum)+1);
    var inputmsg=$('#input'+num).val();
    var ctbpicid='ctbpicid'+num;
    inputmsg=inputmsg.replace('. (T+A)','');
    inputmsg=inputmsg.replace('.(T+A)','');
    inputmsg=inputmsg.replace('(T+A)','');
    inputmsg=inputmsg.replace('. (T)','');
    inputmsg=inputmsg.replace('.(T)','');
    inputmsg=inputmsg.replace('(T)','');
    inputmsg=inputmsg.replace('. (A)','');
    inputmsg=inputmsg.replace('.(A)','');
    inputmsg=inputmsg.replace('(A)','');
    inputmsg='题'+inputmsg+'图';
    inputmsg=inputmsg.replace('.图','');

    if($(inputpicid).val()==5)
    {
        return 0;
    }



    if($(inputpicid).val()==1)
    {


        var imgmsg='<img id="'+picid+'" onclick="editpic(this.id)" src="'+src+'" style="margin-left:16px;margin-top:10px;width: 90px;height: 90px;"><div class="row" id="'+ctbpicid+'" style="margin-top:10px;text-align: center;background-color: white;"><span>'+inputmsg+'</span></div>';
        $(imgid).after(imgmsg);
        picnum=parseInt(picnum)+1;
        $(inputpicid).val(picnum);
        return 1;
    }
    if($(inputpicid).val()==2)
    {
        picid='pic'+num+'1';
        newpicid='pic'+num+2;

        var imgmsg='<img id="'+newpicid+'"  onclick="editpic(this.id)"   src="'+src+'" style="margin-left:10px;margin-top:10px;width: 90px;height: 90px;">';
        $('#'+picid).after(imgmsg);
        picnum=parseInt(picnum)+1;

        $(inputpicid).val(picnum);
        return 1;
    }
    if($(inputpicid).val()==3)
    {
        picid='pic'+num+'2';
        newpicid='pic'+num+3;

        var imgmsg='<img id="'+newpicid+'"   onclick="editpic(this.id)"   src="'+src+'" style="margin-left:10px;margin-top:10px;width: 90px;height: 90px;">';
        $('#'+picid).after(imgmsg);
        picnum=parseInt(picnum)+1;
        $(inputpicid).val(picnum);
        return 1;
    }
    if($(inputpicid).val()==4)
    {

        picid='pic'+num+'3';
        newpicid='pic'+num+4;

        var imgmsg='<img id="'+newpicid+'"   onclick="editpic(this.id)"   src="'+src+'" style="margin-left:10px;margin-top:10px;width: 90px;height: 90px;">';
        $('#'+picid).after(imgmsg);
        picnum=parseInt(picnum)+1;
        $(inputpicid).val(picnum);
        return 1;
    }
}
//对于配图进行处理
function editpic(id){
    var nownum=$('#nownote').val();
    var num=nownum.replace(/[^0-9]/ig,"");


    e=window.event;

    var x=e.pageX;
    var y=e.pageY;

    var x1,x2;
    var x0=$('#'+id).offset().left;
    x1=parseInt(x0)+30;
    x2=parseInt(x1)+30;

    if(x>x0 && x<x1){
        editpic_pre_next(id,'pre');
    }
    if(x>x1 && x<x2){
        editpic_del(id);
    }
    if(x>x2){
        editpic_pre_next(id,'next');
    }

}
//删除配图
function editpic_del(id){
    //var nowpicnum=
    var idlength=id.length;
    var charlen=parseInt(idlength)-1;
    var nowpic=id.substr(0,charlen);
    var num=id.substr(charlen,idlength);
    // id,当前控件id；picnum,当前的图片的数量，num，当前的图片的序号,num1当前配图及其他信息的序号
    var num1=nowpic.replace(/[^0-9]/ig,"");
    var id=$('#inputpic'+num1).attr('name');
    var picnum=$('#inputpic'+num1).val();
    picnum=parseInt(picnum)-1;
    $('#pic'+num1+num).remove();
    delsqldata(id,'pic',num);
    var i=parseInt(num)+1;
    var j;
    if(picnum==1){
        $('#ctbpicid'+num1).remove();
        $('#inputpic'+num1).val(1);
    }
    if(num==picnum)
    {
        return 1;
    }
    else
    {

        for(i=num;i<picnum;i++)
        {
            j=parseInt(i)+1;
            $('#pic'+num1+j).attr('id','pic'+num1+i);
        }
        $('#inputpic'+num1).val(picnum);
    }


}
//前后移动配图
function editpic_pre_next(id,kind){
    //var nowpicnum=
    var idlength=id.length;
    var charlen=parseInt(idlength)-1;

    var nowpic=id.substr(0,charlen);
    var num=id.substr(charlen,idlength);

    // id,当前控件id；picnum,当前的图片的数量，num，当前的图片的序号,num1当前配图及其他信息的序号
    // alert(num);

    var num1=nowpic.replace(/[^0-9]/ig,"");
    var picnum=$('#inputpic'+num1).val();
    picnum=parseInt(picnum)-1;
    var id=$('#inputpic'+num1).attr("name");

    if(kind=='pre'){
        if(num==1)
        {
            return 0;
        }
        else
        {
            i=num;
            j=parseInt(i)-1;

            var tempsrc=$('#pic'+num1+i)[0].src;
            $('#pic'+num1+i)[0].src=$('#pic'+num1+j)[0].src;
            $('#pic'+num1+j)[0].src=tempsrc;
            movedata(id,i,j);
        }
    }
    if(kind=='next'){
        if(num==picnum){
            return 0;
        }
        else
        {
            i=num;
            j=parseInt(i)+1;
            var tempsrc=$('#pic'+num1+i)[0].src;
            $('#pic'+num1+i)[0].src=$('#pic'+num1+j)[0].src;
            $('#pic'+num1+j)[0].src=tempsrc;
            movedata(id,i,j);
        }

    }

}
//进行图片插入，需要关闭相关操作
function justinsertcutsub(){
    var kind=$('#reimgkind').val();
    if(kind=='re' || kind=='pic' || kind=='up'  || kind=='down'){
        return -100;
    }
}



