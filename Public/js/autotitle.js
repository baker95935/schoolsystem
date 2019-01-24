/**
 * Created by fangzheng on 2018/4/8.
 */
//显示二级标题选项栏
function auto_title_display(level,y) {
    var val=$('#nowleveldiv').val();
    if(level==5)
    {
        initbutton2(0);
        switch(val){
            case 'no5':childnotesub(4,y,0,0,5);buttondiv1();break;
            case 'no4':childnotesub(4,y,1,2,5);break;
            case 'no3':childnotesub(3,y,1,3,5);break;
            case 'no2':childnotesub(2,y,1,4,5);break;
            case 'no1':childnotesub(1,y,1,4,5);break;
            default:nav5button(); hiddennav();break;
        }
    }
    if(level==4)
    {
        initbutton2(0);
        switch(val){
            case 'no4':childnotesub(1,y,1,0,4);buttondiv1();break;
            case 'no3':childnotesub(3,y,1,2,4);break;
            case 'no2':childnotesub(2,y,1,3,4);break;
            case 'no1':childnotesub(1,y,1,4,4);break;
            default:nav5button(); hiddennav();break;
        }
    }


    if(level==3)
    {

        switch(val){
            case 'no3':childnotesub(3,y,0,2,3);buttondiv1();break;
            case 'no2':childnotesub(2,y,1,2,3);break;
            case 'no1':childnotesub(1,y,1,3,3);break;
            default:nav5button(); hiddennav();break;
        }
    }

    if(level==2)
    {

        switch(val){
            case 'no2':childnotesub(2,y,1,0,2);buttondiv1();break;
            case 'no1':childnotesub(1,y,1,2,2);break;
            default:nav5button(); hiddennav();break;
        }
    }
    if(level==1)
    {
        switch(val){
            case 'no1':childnotesub(1,y,0,2,2);buttondiv1();break;
            default:nav5button(); hiddennav();break;
        }
    }
}
//id表示选择对齐的Div,id表示与对齐的div的序号，y表示垂直距离，num表示0不显示，1显示，displaynum的button的序号
function childnotesub(id,y,num,displaynum,level) {

    $("#buttondiv2").css('display','none');
    $("#buttondiv3").css('display','none');
    $("#buttondiv4").css('display','none');

    var buttondiv='#buttondiv'+displaynum;
    if(level==5)
    {
        if(num==1)
        {
        $(buttondiv).css('display','');
        var level_div="#level"+id+"_Div";
        var x1=$(level_div).offset().left;
        var y1=y-15;
        newPos=new Object();
        newPos.left= x1;
        newPos.top= y1;
        $(buttondiv).offset(newPos);
        }
        if(num==0)
        {

            nav5button();
        }
    }

    if(level==4)
    {
        if(num==1)
        {
            $(buttondiv).css('display','');
            var level_div="#level"+id+"_Div";
            var x1=$(level_div).offset().left;
            var y1=y-15;
            newPos=new Object();
            newPos.left= x1;
            newPos.top= y1;
            $(buttondiv).offset(newPos);
        }
        if(num==0)
        {

            nav5button();
        }
    }
    if(level==3)
    {
        if(num==1)
        {
            $(buttondiv).css('display','');
            var level_div="#level"+id+"_Div";
            var x1=$(level_div).offset().left;
            var y1=y-15;
            newPos=new Object();
            newPos.left= x1;
            newPos.top= y1;
            $(buttondiv).offset(newPos);
            initbutton2(1);
        }
        if(num==0)
        {
            nav5button();
        }
    }

    if(level==2)
    {
        if(num==1)
        {
            $(buttondiv).css('display','');
            var level_div="#level"+id+"_Div";
            var x1=$(level_div).offset().left;
            var y1=y-15;
            newPos=new Object();
            newPos.left= x1;
            newPos.top= y1;
            $(buttondiv).offset(newPos);
            initbutton2(1);
        }
        if(num==0)
        {

            nav5button();
        }
    }

    if(level==1)
    {
        if(num==1)
        {
            $(buttondiv).css('display','');
            var level_div="#level"+id+"_Div";
            var x1=$(level_div).offset().left;
            var y1=y-15;
            newPos=new Object();
            newPos.left= x1;
            newPos.top= y1;
            $(buttondiv).offset(newPos);
            initbutton2(1);
        }
        if(num==0)
        {

            nav5button();
        }
    }
}
//根据当前的标题类型，返回正确的标题格式kind表示数字转码类型，initialnum表示初始化量，varnum表示增量
function retitlekind(kind,initialnum,varnum) {
    if(initialnum==0&&varnum==0)
    {
        return '*';
    }
    var msg;
    switch(kind)
    {
        case 't1':msg=t1(initialnum,varnum);break;
        case 't2':msg=t2(initialnum,varnum);break;
        case 't3':msg=t3(initialnum,varnum);break;
        case 't4':msg=t4(initialnum,varnum);break;
        case 't5':msg=t5(initialnum,varnum);break;
        case 't6':msg=t6(initialnum,varnum);break;
        case 't7':msg=t7(initialnum,varnum);break;
        case 't8':msg=t8(initialnum,varnum);break;
        case 't9':msg=t9(initialnum,varnum);break;
        case 't10':msg=t10(initialnum,varnum);break;
        case 't11':msg=t11(initialnum,varnum);break;
        case 't12':msg=t12(initialnum,varnum);break;
        case 't13':msg=t13(initialnum,varnum);break;
        case 't14':msg=t14(initialnum,varnum);break;
        case 't15':msg=t15(initialnum,varnum);break;
        case 't16':msg=t16(initialnum,varnum);break;
        case 't17':msg=t17(initialnum,varnum);break;
        case 't18':msg=t18(initialnum,varnum);break;
        case 't19':msg=t19(initialnum,varnum);break;
        case 't20':msg=t20(initialnum,varnum);break;
    }
    return msg;

}
//button移动区域上，数字自动加一
function buttondiv1() {
    if(justsubeffect('buttondiv1')==0)
    {
        return;
    }
    var val=$('#titlechoose').val();
    var begin_or_not=$('#begin_or_not').val();
    var myval=$('#nowleveldiv').val();
    if(val==5 && myval!='del' && myval!='link')
    {
            nav5button();
            removenav();
            var tkind5=$('#no5').val();
            var num5=$('#num5').val();
            $('#tnum5').attr('name',parseInt(num5)+1);
            $('#tnum5').addClass('nownavmsg');
            var msg5=retitlekind(tkind5,num5,1);
            $('#tnum5').text(msg5);
    }
    if(val==4  && myval!='del' && myval!='link')
    {
        nav5button();
        removenav();
        var tkind4=$('#no4').val();
        var num4=$('#num4').val();
        $('#tnum4').attr('name',parseInt(num4)+1);
        $('#tnum4').addClass('nownavmsg');
        var msg4=retitlekind(tkind4,num4,1);
        $('#tnum4').text(msg4);
    }

    if(val==3  && myval!='del' && myval!='link')
    {
        nav5button();
        removenav();
        var tkind3=$('#no3').val();
        var num3=$('#num3').val();
        $('#tnum3').attr('name',parseInt(num3)+1);
        $('#tnum3').addClass('nownavmsg');
        var msg3=retitlekind(tkind3,num3,1);
        $('#tnum3').text(msg3);
    }


    if(val==2  && myval!='del' && myval!='link')
    {
        nav5button();
        removenav();
        var tkind2=$('#no2').val();
        var num2=$('#num2').val();
        $('#tnum2').attr('name',parseInt(num2)+1);
        $('#tnum2').addClass('nownavmsg');
        var msg2=retitlekind(tkind2,num2,1);
        $('#tnum2').text(msg2);
    }
    if(val==1  && myval!='del' && myval!='link')
    {
        nav5button();
        removenav();
        var tkind1=$('#no1').val();
        var num1=$('#num1').val();
        $('#tnum1').attr('name',parseInt(num1)+1);
        $('#tnum1').addClass('nownavmsg');
        var msg1=retitlekind(tkind1,num1,1);
        $('#tnum1').text(msg1);
    }


    notemsg();
}
function buttondiv2_a(){

    if(justsubeffect('buttondiv2_a')==0)
    {
        return;
    }
    var val=$('#titlechoose').val();
    var begin_or_not=$('#begin_or_not').val();
    if(val==5 )
    {
        if(begin_or_not==1 )
        {


            nav5button();
            removenav();
            var tkind4 = $('#no4').val();
            var tkind5 = $('#no5').val();
            var num4 = $('#num4').val();
            var num5 = $('#num5').val();

            $('#tnum4').attr('name', parseInt(num4)+1);
            $('#tnum5').attr('name', 1);
            var msg4 = retitlekind(tkind4, num4, 1);
            var msg5 = retitlekind(tkind5, 1, 0);
            $('#tnum4').text(msg4);
            $('#tnum5').text(msg5);
            $('#tnum5').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();
            var tkind4=$('#no4').val();
            var tkind5=$('#no5').val();
            var num4=$('#num4').val();
            var num5=$('#num5').val();

            $('#tnum4').attr('name',num4);
            $('#tnum5').attr('name',1);

            $('#tnum5').addClass('nownavmsg');
            var msg4=retitlekind(tkind4,num4,0);
            var msg5=retitlekind(tkind5,1,0);

            $('#tnum4').text(msg4);
            $('#tnum5').text(msg5);


        }
    }
    if(val==4)
    {
        if(begin_or_not==1 )
        {
            nav5button();
            removenav();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();

            $('#tnum3').attr('name', parseInt(num3)+1);
            $('#tnum4').attr('name', 1);
            var msg3 = retitlekind(tkind3, num3, 1);
            var msg4 = retitlekind(tkind4, 1, 0);
            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);
            $('#tnum4').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();
            var tkind3=$('#no3').val();
            var tkind4=$('#no4').val();
            var num3=$('#num3').val();
            var num4=$('#num4').val();

            $('#tnum3').attr('name',num3);
            $('#tnum4').attr('name',1);

            $('#tnum4').addClass('nownavmsg');
            var msg3=retitlekind(tkind3,num3,0);
            var msg4=retitlekind(tkind4,1,0);

            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);


        }
    }

    if(val==3)
    {
        if(begin_or_not==1)
        {
            nav5button();
            removenav();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();

            $('#tnum2').attr('name', parseInt(num2)+1);
            $('#tnum3').attr('name', 1);
            var msg2 = retitlekind(tkind2, num2, 1);
            var msg3 = retitlekind(tkind3, 1, 0);
            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum3').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();
            var tkind2=$('#no2').val();
            var tkind3=$('#no3').val();
            var num2=$('#num2').val();
            var num3=$('#num3').val();

            $('#tnum2').attr('name',num2);
            $('#tnum3').attr('name',1);

            $('#tnum3').addClass('nownavmsg');
            var msg2=retitlekind(tkind2,num2,0);
            var msg3=retitlekind(tkind3,1,0);

            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);


        }
    }
    if(val==2)
    {
        if(begin_or_not==1)
        {
            nav5button();
            removenav();
            var tkind1 = $('#no1').val();
            var tkind2 = $('#no2').val();
            var num1 = $('#num1').val();
            var num2 = $('#num2').val();

            $('#tnum1').attr('name', parseInt(num1)+1);
            $('#tnum2').attr('name', 1);
            var msg1 = retitlekind(tkind1, num1, 1);
            var msg2 = retitlekind(tkind2, 1, 0);
            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum2').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();
            var tkind1=$('#no1').val();
            var tkind2=$('#no2').val();
            var num1=$('#num1').val();
            var num2=$('#num2').val();

            $('#tnum1').attr('name',num1);
            $('#tnum2').attr('name',1);

            $('#tnum2').addClass('nownavmsg');
            var msg1=retitlekind(tkind1,num1,0);
            var msg2=retitlekind(tkind2,1,0);

            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);


        }
    }

    if(val==1)
    {
        if(begin_or_not==1)
        {
            nav5button();
            removenav();
            var tkind1 = $('#no1').val();
            var num1 = $('#num1').val();

            $('#tnum1').attr('name', parseInt(num1)+1);
            var msg1 = retitlekind(tkind1, num1, 1);
            $('#tnum1').text(msg1);
            $('#tnum1').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态
            nav5button();
            removenav();
            var tkind1=$('#no1').val();
            var num1=$('#num1').val();
            $('#tnum1').attr('name',num1);
            $('#tnum1').addClass('nownavmsg');
            var msg1=retitlekind(tkind1,num1,0);
            $('#tnum1').text(msg1);
        }
    }
    notemsg();
}
function buttondiv2_b(){
    if(justsubeffect('buttondiv2_b')==0)
    {
        return;
    }

    var val=$('#titlechoose').val();
    var begin_or_not=$('#begin_or_not').val();
    if(val==5) {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind4 = $('#no4').val();
            var num4 = $('#num4').val();
            var num5 = $('#num5').val();

            $('#tnum4').attr('name', parseInt(num4)+1);
            $('#tnum5').attr('name', 0);

            var msg4 = retitlekind(tkind4, num4, 1);

            $('#tnum4').text(msg4);
            $('#tnum5').text('');

            $('#tnum4').addClass('nownavmsg');
        }
        else
        {
            nav5button();
            removenav();
            var tkind4 = $('#no4').val();
            var num4 = $('#num4').val();
            var num5 = $('#num5').val();


            $('#tnum4').attr('name', num4);
            $('#tnum5').attr('name', 0);

            var msg4 = retitlekind(tkind4, num4, 0);

            $('#tnum4').text(msg4);
            $('#tnum5').text('');

            $('#tnum4').addClass('nownavmsg');
        }
    }


    if(val==4) {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind3 = $('#no3').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();


            $('#tnum3').attr('name', parseInt(num3)+1);
            $('#tnum4').attr('name', 0);

            var msg3 = retitlekind(tkind3, num3, 1);

            $('#tnum3').text(msg3);
            $('#tnum4').text('');

            $('#tnum3').addClass('nownavmsg');
        }
        else
        {
            nav5button();
            removenav();
            var tkind3 = $('#no3').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();


            $('#tnum3').attr('name', num3);
            $('#tnum4').attr('name', 0);

            var msg3 = retitlekind(tkind3, num3, 0);

            $('#tnum3').text(msg3);
            $('#tnum4').text('');

            $('#tnum3').addClass('nownavmsg');
        }
    }


    if(val==3) {
        if (begin_or_not == 1 ) {
            nav5button();
            removenav();
            var tkind2 = $('#no2').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();


            $('#tnum2').attr('name', parseInt(num2)+1);
            $('#tnum3').attr('name', 0);

            var msg2 = retitlekind(tkind2, num2, 1);

            $('#tnum2').text(msg2);
            $('#tnum3').text('');

            $('#tnum2').addClass('nownavmsg');
        }
        else
        {
            nav5button();
            removenav();
            var tkind2 = $('#no2').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();


            $('#tnum2').attr('name', num2);
            $('#tnum3').attr('name', 0);

            var msg2 = retitlekind(tkind2, num2, 0);

            $('#tnum2').text(msg2);
            $('#tnum3').text('');

            $('#tnum2').addClass('nownavmsg');
        }
    }


    if(val==2) {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind1 = $('#no1').val();
            var num1 = $('#num1').val();
            var num2 = $('#num2').val();


            $('#tnum1').attr('name', parseInt(num1)+1);
            $('#tnum2').attr('name', 0);

            var msg1 = retitlekind(tkind1, num1, 1);

            $('#tnum1').text(msg1);
            $('#tnum2').text('');

            $('#tnum1').addClass('nownavmsg');
        }
        else
        {
            nav5button();
            removenav();
            var tkind1 = $('#no1').val();
            var num1 = $('#num1').val();
            var num2 = $('#num2').val();


            $('#tnum1').attr('name', num1);
            $('#tnum2').attr('name', 0);

            var msg1 = retitlekind(tkind1, num1, 0);

            $('#tnum1').text(msg1);
            $('#tnum2').text('');

            $('#tnum1').addClass('nownavmsg');
        }
    }
    notemsg();
}
function buttondiv3_a(){

    if(justsubeffect('buttondiv3_a')==0)
    {
        return;
    }

    var val=$('#titlechoose').val();
    var begin_or_not=$('#begin_or_not').val();

    if(val==5)
    {
        if(begin_or_not==1)
        {
            nav5button();
            removenav();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();
            var tkind5 = $('#no5').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();
            var num5 = $('#num5').val();

            $('#tnum3').attr('name', parseInt(num3)+1);
            $('#tnum4').attr('name', 1);
            $('#tnum5').attr('name', 1);

            var msg3 = retitlekind(tkind3, num3, 1);
            var msg4 = retitlekind(tkind4, 1, 0);
            var msg5 = retitlekind(tkind5, 1, 0);


            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);
            $('#tnum5').text(msg5);
            $('#tnum5').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();

            var tkind3=$('#no3').val();
            var tkind4=$('#no4').val();
            var tkind5=$('#no5').val();

            var num3=$('#num3').val();
            var num4=$('#num4').val();
            var num5=$('#num5').val();

            $('#tnum3').attr('name',num4);
            $('#tnum4').attr('name',1);
            $('#tnum5').attr('name',1);

            $('#tnum5').addClass('nownavmsg');


            var msg3=retitlekind(tkind3,num3,0);
            var msg4=retitlekind(tkind4,1,0);
            var msg5=retitlekind(tkind5,1,0);

            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);
            $('#tnum5').text(msg5);
        }
    }

    if(val==4)
    {
        if(begin_or_not==1)
        {
            nav5button();
            removenav();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();

            $('#tnum2').attr('name', parseInt(num2)+1);
            $('#tnum3').attr('name', 1);
            $('#tnum4').attr('name', 1);

            var msg2 = retitlekind(tkind2, num2, 1);
            var msg3 = retitlekind(tkind3, 1, 0);
            var msg4 = retitlekind(tkind4, 1, 0);


            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);
            $('#tnum4').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();


            var tkind2=$('#no2').val();
            var tkind3=$('#no3').val();
            var tkind4=$('#no4').val();

            var num2=$('#num2').val();
            var num3=$('#num3').val();
            var num4=$('#num4').val();

            $('#tnum2').attr('name',num2);
            $('#tnum3').attr('name',1);
            $('#tnum4').attr('name',1);

            $('#tnum4').addClass('nownavmsg');


            var msg2=retitlekind(tkind2,num2,0);
            var msg3=retitlekind(tkind3,1,0);
            var msg4=retitlekind(tkind4,1,0);

            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);


        }
    }


    if(val==3)
    {
        if(begin_or_not==1 )
        {
            nav5button();
            removenav();
            var tkind1 = $('#no1').val();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var num1 = $('#num1').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();

            $('#tnum1').attr('name', parseInt(num1)+1);
            $('#tnum2').attr('name', 1);
            $('#tnum3').attr('name', 1);

            var msg1 = retitlekind(tkind1, num1, 1);
            var msg2 = retitlekind(tkind2, 1, 0);
            var msg3 = retitlekind(tkind3, 1, 0);


            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum3').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();


            var tkind1=$('#no1').val();
            var tkind2=$('#no2').val();
            var tkind3=$('#no3').val();

            var num1=$('#num1').val();
            var num2=$('#num2').val();
            var num3=$('#num3').val();

            $('#tnum1').attr('name',num1);
            $('#tnum2').attr('name',1);
            $('#tnum3').attr('name',1);

            $('#tnum3').addClass('nownavmsg');


            var msg1=retitlekind(tkind1,num1,0);
            var msg2=retitlekind(tkind2,1,0);
            var msg3=retitlekind(tkind3,1,0);

            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);


        }
    }
    notemsg();

}
function buttondiv3_b(){
    if(justsubeffect('buttondiv3_b')==0)
    {
        return;
    }

    var val=$('#titlechoose').val();
    var begin_or_not=$('#begin_or_not').val();
    if(val==5) {
        if (begin_or_not == 1 ) {
            nav5button();
            removenav();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();
            var num5 = $('#num5').val();

            $('#tnum3').attr('name', parseInt(num3) + 1);
            $('#tnum4').attr('name', 1);
            $('#tnum5').attr('name', 0);

            var msg3 = retitlekind(tkind3, num3, 1);
            var msg4 = retitlekind(tkind4, 1, 0);
            // var msg5 = retitlekind(tkind5, 1, 0);

            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);
            $('#tnum5').text('');
            $('#tnum4').addClass('nownavmsg');
        }
        else
        {
            nav5button();
            removenav();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();
            var tkind5 = $('#no5').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();
            var num5 = $('#num5').val();

            $('#tnum3').attr('name', num3);
            $('#tnum4').attr('name', 1);
            $('#tnum5').attr('name', 0);

            var msg3 = retitlekind(tkind3, num3, 0);
            var msg4 = retitlekind(tkind4, 1, 0);

            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);
            $('#tnum5').text('');
            $('#tnum4').addClass('nownavmsg');
        }
    }

    if(val==4) {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();

            $('#tnum2').attr('name', parseInt(num2) + 1);
            $('#tnum3').attr('name', 1);
            $('#tnum4').attr('name', 0);

            var msg2 = retitlekind(tkind2, num2, 1);
            var msg3 = retitlekind(tkind3, 1, 0);
            // var msg5 = retitlekind(tkind5, 1, 0);

            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text('');
            $('#tnum3').addClass('nownavmsg');
        }
        else
        {
            nav5button();
            removenav();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();

            $('#tnum2').attr('name', num2);
            $('#tnum3').attr('name', 1);
            $('#tnum4').attr('name', 0);

            var msg2 = retitlekind(tkind2, num2, 0);
            var msg3 = retitlekind(tkind3, 1, 0);

            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text('');
            $('#tnum3').addClass('nownavmsg');
        }
    }


    if(val==3) {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind1 = $('#no1').val();
            var tkind2 = $('#no2').val();
            var num1 = $('#num1').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();

            $('#tnum1').attr('name', parseInt(num1) + 1);
            $('#tnum2').attr('name', 1);
            $('#tnum3').attr('name', 0);

            var msg1 = retitlekind(tkind1, num1, 1);
            var msg2 = retitlekind(tkind2, 1, 0);
            // var msg5 = retitlekind(tkind5, 1, 0);

            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text('');
            $('#tnum2').addClass('nownavmsg');
        }
        else
        {
            nav5button();
            removenav();
            var tkind1 = $('#no1').val();
            var tkind2 = $('#no2').val();

            var num1 = $('#num1').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();

            $('#tnum1').attr('name', num1);
            $('#tnum2').attr('name', 1);
            $('#tnum3').attr('name', 0);

            var msg1 = retitlekind(tkind1, num1, 0);
            var msg2 = retitlekind(tkind2, 1, 0);

            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text('');
            $('#tnum2').addClass('nownavmsg');
        }
    }
    notemsg();
}
function buttondiv3_c(){
    if(justsubeffect('buttondiv3_c')==0)
    {
        return;
    }

    var val=$('#titlechoose').val();
    var begin_or_not=$('#begin_or_not').val();
    if(val==5) {
        if (begin_or_not == 1 ) {
            nav5button();
            removenav();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();
            var num5 = $('#num5').val();

            $('#tnum3').attr('name', parseInt(num3) + 1);
            $('#tnum4').attr('name', 0);
            $('#tnum5').attr('name', 0);

            var msg3 = retitlekind(tkind3, num3, 1);
            var msg4 = retitlekind(tkind4, 1, 0);
            var msg5 = retitlekind(tkind5, 1, 0);

            $('#tnum3').text(msg3);
            $('#tnum4').text('');
            $('#tnum5').text('');
            $('#tnum3').addClass('nownavmsg');
        }
        else
        {
            nav5button();
            removenav();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();
            var tkind5 = $('#no5').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();
            var num5 = $('#num5').val();

            $('#tnum3').attr('name', num3);
            $('#tnum4').attr('name', 0);
            $('#tnum5').attr('name', 0);

            var msg3 = retitlekind(tkind3, num3, 0);
            var msg4 = retitlekind(tkind4, 1, 0);
            var msg5 = retitlekind(tkind5, 1, 0);

            $('#tnum3').text(msg3);
            $('#tnum4').text('');
            $('#tnum5').text('');
            $('#tnum3').addClass('nownavmsg');
        }
    }


    if(val==4) {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();

            $('#tnum2').attr('name', parseInt(num2) + 1);
            $('#tnum3').attr('name', 0);
            $('#tnum4').attr('name', 0);

            var msg2 = retitlekind(tkind2, num2, 1);
            var msg3 = retitlekind(tkind3, 1, 0);
            var msg4 = retitlekind(tkind4, 1, 0);

            $('#tnum2').text(msg2);
            $('#tnum3').text('');
            $('#tnum4').text('');
            $('#tnum2').addClass('nownavmsg');
        }
        else
        {
            nav5button();
            removenav();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();

            $('#tnum2').attr('name', num2);
            $('#tnum3').attr('name', 0);
            $('#tnum4').attr('name', 0);

            var msg2 = retitlekind(tkind2, num2, 0);
            var msg3 = retitlekind(tkind3, 1, 0);
            var msg4 = retitlekind(tkind4, 1, 0);

            $('#tnum2').text(msg2);
            $('#tnum3').text('');
            $('#tnum4').text('');
            $('#tnum2').addClass('nownavmsg');
        }
    }

    if(val==3) {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind1 = $('#no1').val();
            var tkind2 = $('#no2').val();
            var num1 = $('#num1').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();

            $('#tnum1').attr('name', parseInt(num1) + 1);
            $('#tnum2').attr('name', 0);
            $('#tnum3').attr('name', 0);

            var msg1 = retitlekind(tkind1, num1, 1);
            var msg2 = retitlekind(tkind2, 1, 0);
            var msg3 = retitlekind(tkind3, 1, 0);

            $('#tnum1').text(msg1);
            $('#tnum2').text('');
            $('#tnum3').text('');
            $('#tnum1').addClass('nownavmsg');
        }
        else
        {
            nav5button();
            removenav();
            var tkind1 = $('#no1').val();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var num1 = $('#num1').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();

            $('#tnum1').attr('name', num1);
            $('#tnum2').attr('name', 0);
            $('#tnum3').attr('name', 0);

            var msg1 = retitlekind(tkind1, num1, 0);
            var msg2 = retitlekind(tkind2, 1, 0);
            var msg3 = retitlekind(tkind3, 1, 0);

            $('#tnum1').text(msg1);
            $('#tnum2').text('');
            $('#tnum3').text('');
            $('#tnum1').addClass('nownavmsg');
        }
    }
    notemsg();
}
function buttondiv4_a(){
    var val=$('#titlechoose').val();
    var valnum=$('#nowleveldiv').val();
    var begin_or_not=$('#begin_or_not').val();
    if(val==5 && valnum=='no2') {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();
            var tkind5 = $('#no5').val();

            var num2 = $('#num2').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();
            var num5 = $('#num5').val();

            $('#tnum2').attr('name', parseInt(num2)+1);
            $('#tnum3').attr('name', 1);
            $('#tnum4').attr('name', 1);
            $('#tnum5').attr('name', 1);

            var msg2 = retitlekind(tkind2, num2, 1);
            var msg3 = retitlekind(tkind3, 1, 0);
            var msg4 = retitlekind(tkind4, 1, 0);
            var msg5 = retitlekind(tkind5, 1, 0);


            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);
            $('#tnum5').text(msg5);
            $('#tnum5').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();

            var tkind2=$('#no2').val();
            var tkind3=$('#no3').val();
            var tkind4=$('#no4').val();
            var tkind5=$('#no5').val();

            var num2=$('#num2').val();
            var num3=$('#num3').val();
            var num4=$('#num4').val();
            var num5=$('#num5').val();

            $('#tnum2').attr('name',num2);
            $('#tnum3').attr('name',1);
            $('#tnum4').attr('name',1);
            $('#tnum5').attr('name',1);


            $('#tnum5').addClass('nownavmsg');


            var msg2=retitlekind(tkind2,num2,0);
            var msg3=retitlekind(tkind3,1,0);
            var msg4=retitlekind(tkind4,1,0);
            var msg5=retitlekind(tkind5,1,0);

            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);
            $('#tnum5').text(msg5);

        }
    }


    if(val==5 && valnum=='no1') {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind1 = $('#no1').val();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();
            var tkind5 = $('#no5').val();

            var num1 = $('#num1').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();
            var num5 = $('#num5').val();

            $('#tnum1').attr('name', parseInt(num1)+1);
            $('#tnum2').attr('name', 1);
            $('#tnum3').attr('name', 1);
            $('#tnum4').attr('name', 1);
            $('#tnum5').attr('name', 1);

            var msg1 = retitlekind(tkind1, num1, 1);
            var msg2 = retitlekind(tkind2, 1, 0);
            var msg3 = retitlekind(tkind3, 1, 0);
            var msg4 = retitlekind(tkind4, 1, 0);
            var msg5 = retitlekind(tkind5, 1, 0);


            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);
            $('#tnum5').text(msg5);
            $('#tnum5').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();

            var tkind1=$('#no1').val();
            var tkind2=$('#no2').val();
            var tkind3=$('#no3').val();
            var tkind4=$('#no4').val();
            var tkind5=$('#no5').val();

            var num1=$('#num1').val();
            var num2=$('#num2').val();
            var num3=$('#num3').val();
            var num4=$('#num4').val();
            var num5=$('#num5').val();

            $('#tnum1').attr('name',num1);
            $('#tnum2').attr('name',1);
            $('#tnum3').attr('name',1);
            $('#tnum4').attr('name',1);
            $('#tnum5').attr('name',1);


            $('#tnum5').addClass('nownavmsg');

            var msg1=retitlekind(tkind1,num1,0);
            var msg2=retitlekind(tkind2,1,0);
            var msg3=retitlekind(tkind3,1,0);
            var msg4=retitlekind(tkind4,1,0);
            var msg5=retitlekind(tkind5,1,0);

            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);
            $('#tnum5').text(msg5);

        }
    }

    if(val==4) {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind1 = $('#no1').val();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();

            var num1 = $('#num1').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();

            $('#tnum1').attr('name', parseInt(num1)+1);
            $('#tnum2').attr('name', 1);
            $('#tnum3').attr('name', 1);
            $('#tnum4').attr('name', 1);

            var msg1 = retitlekind(tkind1, num1, 1);
            var msg2 = retitlekind(tkind2, 1, 0);
            var msg3 = retitlekind(tkind3, 1, 0);
            var msg4 = retitlekind(tkind4, 1, 0);


            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);
            $('#tnum4').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();

            var tkind1=$('#no1').val();
            var tkind2=$('#no2').val();
            var tkind3=$('#no3').val();
            var tkind4=$('#no4').val();

            var num1=$('#num1').val();
            var num2=$('#num2').val();
            var num3=$('#num3').val();
            var num4=$('#num4').val();

            $('#tnum1').attr('name',num1);
            $('#tnum2').attr('name',1);
            $('#tnum3').attr('name',1);
            $('#tnum4').attr('name',1);


            $('#tnum4').addClass('nownavmsg');


            var msg1=retitlekind(tkind1,num1,0);
            var msg2=retitlekind(tkind2,1,0);
            var msg3=retitlekind(tkind3,1,0);
            var msg4=retitlekind(tkind4,1,0);

            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);

        }
    }
    notemsg();
}
function buttondiv4_b(){
    var val=$('#titlechoose').val();
    var valnum=$('#nowleveldiv').val();
    var begin_or_not=$('#begin_or_not').val();
    if(val==5 && valnum=='no2') {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();
            var tkind5 = $('#no5').val();

            var num2 = $('#num2').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();
            var num5 = $('#num5').val();

            $('#tnum2').attr('name', parseInt(num2)+1);
            $('#tnum3').attr('name', 1);
            $('#tnum4').attr('name', 1);
            $('#tnum5').attr('name', 0);

            var msg2 = retitlekind(tkind2, num2, 1);
            var msg3 = retitlekind(tkind3, 1, 0);
            var msg4 = retitlekind(tkind4, 1, 0);
            var msg5 = retitlekind(tkind5, 1, 0);


            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);
            $('#tnum5').text('');
            $('#tnum4').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();

            var tkind2=$('#no2').val();
            var tkind3=$('#no3').val();
            var tkind4=$('#no4').val();
            var tkind5=$('#no5').val();

            var num2=$('#num2').val();
            var num3=$('#num3').val();
            var num4=$('#num4').val();
            var num5=$('#num5').val();

            $('#tnum2').attr('name',num2);
            $('#tnum3').attr('name',1);
            $('#tnum4').attr('name',1);
            $('#tnum5').attr('name',0);

            var msg2=retitlekind(tkind2,num2,0);
            var msg3=retitlekind(tkind3,1,0);
            var msg4=retitlekind(tkind4,1,0);
            var msg5=retitlekind(tkind5,1,0);

            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);
            $('#tnum5').text('');
            $('#tnum4').addClass('nownavmsg');

        }
    }
    if(val==5 && valnum=='no1') {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind1 = $('#no1').val();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();
            var tkind5 = $('#no5').val();

            var num1 = $('#num1').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();
            var num5 = $('#num5').val();

            $('#tnum1').attr('name', parseInt(num1)+1);
            $('#tnum2').attr('name', 1);
            $('#tnum3').attr('name', 1);
            $('#tnum4').attr('name', 1);
            $('#tnum5').attr('name', 0);

            var msg1 = retitlekind(tkind1, num1, 1);
            var msg2 = retitlekind(tkind2, 1, 0);
            var msg3 = retitlekind(tkind3, 1, 0);
            var msg4 = retitlekind(tkind4, 1, 0);
            var msg5 = retitlekind(tkind5, 1, 0);


            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);
            $('#tnum5').text('');
            $('#tnum4').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态
            nav5button();
            removenav();

            var tkind1=$('#no1').val();
            var tkind2=$('#no2').val();
            var tkind3=$('#no3').val();
            var tkind4=$('#no4').val();
            var tkind5=$('#no5').val();

            var num1=$('#num1').val();
            var num2=$('#num2').val();
            var num3=$('#num3').val();
            var num4=$('#num4').val();
            var num5=$('#num5').val();

            $('#tnum1').attr('name',num1);
            $('#tnum2').attr('name',1);
            $('#tnum3').attr('name',1);
            $('#tnum4').attr('name',1);
            $('#tnum5').attr('name',0);

            var msg1=retitlekind(tkind1,num1,0);
            var msg2=retitlekind(tkind2,1,0);
            var msg3=retitlekind(tkind3,1,0);
            var msg4=retitlekind(tkind4,1,0);
            var msg5=retitlekind(tkind5,1,0);

            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text(msg4);
            $('#tnum5').text('');
            $('#tnum4').addClass('nownavmsg');

        }
    }


    if(val==4) {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind1 = $('#no1').val();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();

            var num1 = $('#num1').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();

            $('#tnum1').attr('name', parseInt(num1)+1);
            $('#tnum2').attr('name', 1);
            $('#tnum3').attr('name', 1);
            $('#tnum4').attr('name', 0);

            var msg1 = retitlekind(tkind1, num1, 1);
            var msg2 = retitlekind(tkind2, 1, 0);
            var msg3 = retitlekind(tkind3, 1, 0);
            var msg4 = retitlekind(tkind4, 1, 0);


            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text('');
            $('#tnum3').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();

            var tkind1=$('#no1').val();
            var tkind2=$('#no2').val();
            var tkind3=$('#no3').val();
            var tkind4=$('#no4').val();

            var num1=$('#num1').val();
            var num2=$('#num2').val();
            var num3=$('#num3').val();
            var num4=$('#num4').val();

            $('#tnum1').attr('name',num1);
            $('#tnum2').attr('name',1);
            $('#tnum3').attr('name',1);
            $('#tnum4').attr('name',0);

            var msg1=retitlekind(tkind1,num1,0);
            var msg2=retitlekind(tkind2,1,0);
            var msg3=retitlekind(tkind3,1,0);
            var msg4=retitlekind(tkind4,1,0);

            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text('');
            $('#tnum3').addClass('nownavmsg');

        }
    }
    notemsg();
}
function buttondiv4_c(){
    var val=$('#titlechoose').val();
    var valnum=$('#nowleveldiv').val();
    var begin_or_not=$('#begin_or_not').val();
    if(val==5 && valnum=='no2') {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();
            var tkind5 = $('#no5').val();

            var num2 = $('#num2').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();
            var num5 = $('#num5').val();

            $('#tnum2').attr('name', parseInt(num2)+1);
            $('#tnum3').attr('name', 1);
            $('#tnum4').attr('name', 0);
            $('#tnum5').attr('name', 0);

            var msg2 = retitlekind(tkind2, num2, 1);
            var msg3 = retitlekind(tkind3, 1, 0);
            var msg4 = retitlekind(tkind4, 1, 0);
            var msg5 = retitlekind(tkind5, 1, 0);


            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text('');
            $('#tnum5').text('');
            $('#tnum3').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();

            var tkind2=$('#no2').val();
            var tkind3=$('#no3').val();
            var tkind4=$('#no4').val();
            var tkind5=$('#no5').val();

            var num2=$('#num2').val();
            var num3=$('#num3').val();
            var num4=$('#num4').val();
            var num5=$('#num5').val();

            $('#tnum2').attr('name',num2);
            $('#tnum3').attr('name',1);
            $('#tnum4').attr('name',0);
            $('#tnum5').attr('name',0);

            var msg2=retitlekind(tkind2,num2,0);
            var msg3=retitlekind(tkind3,1,0);
            var msg4=retitlekind(tkind4,1,0);
            var msg5=retitlekind(tkind5,1,0);

            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text('');
            $('#tnum5').text('');
            $('#tnum3').addClass('nownavmsg');

        }
    }
    if(val==5 && valnum=='no1') {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind1 = $('#no1').val();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();
            var tkind5 = $('#no5').val();

            var num1 = $('#num1').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();
            var num5 = $('#num5').val();

            $('#tnum1').attr('name', parseInt(num1)+1);
            $('#tnum2').attr('name', 1);
            $('#tnum3').attr('name', 1);
            $('#tnum4').attr('name', 0);
            $('#tnum5').attr('name', 0);

            var msg1 = retitlekind(tkind1, num1, 1);
            var msg2 = retitlekind(tkind2, 1, 0);
            var msg3 = retitlekind(tkind3, 1, 0);
            var msg4 = retitlekind(tkind4, 1, 0);
            var msg5 = retitlekind(tkind5, 1, 0);


            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text('');
            $('#tnum5').text('');
            $('#tnum3').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();

            var tkind1=$('#no1').val();
            var tkind2=$('#no2').val();
            var tkind3=$('#no3').val();
            var tkind4=$('#no4').val();
            var tkind5=$('#no5').val();

            var num1=$('#num1').val();
            var num2=$('#num2').val();
            var num3=$('#num3').val();
            var num4=$('#num4').val();
            var num5=$('#num5').val();

            $('#tnum1').attr('name',num1);
            $('#tnum2').attr('name',1);
            $('#tnum3').attr('name',1);
            $('#tnum4').attr('name',0);
            $('#tnum5').attr('name',0);

            var msg1=retitlekind(tkind1,num1,0);
            var msg2=retitlekind(tkind2,1,0);
            var msg3=retitlekind(tkind3,1,0);
            var msg4=retitlekind(tkind4,1,0);
            var msg5=retitlekind(tkind5,1,0);

            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text(msg3);
            $('#tnum4').text('');
            $('#tnum5').text('');
            $('#tnum3').addClass('nownavmsg');

        }
    }


    if(val==4) {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind1 = $('#no1').val();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();

            var num1 = $('#num1').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();

            $('#tnum1').attr('name', parseInt(num1)+1);
            $('#tnum2').attr('name', 1);
            $('#tnum3').attr('name', 0);
            $('#tnum4').attr('name', 0);

            var msg1 = retitlekind(tkind1, num1, 1);
            var msg2 = retitlekind(tkind2, 1, 0);
            var msg3 = retitlekind(tkind3, 1, 0);
            var msg4 = retitlekind(tkind4, 1, 0);


            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text('');
            $('#tnum4').text('');
            $('#tnum2').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();

            var tkind1=$('#no1').val();
            var tkind2=$('#no2').val();
            var tkind3=$('#no3').val();
            var tkind4=$('#no4').val();

            var num1=$('#num1').val();
            var num2=$('#num2').val();
            var num3=$('#num3').val();
            var num4=$('#num4').val();

            $('#tnum1').attr('name',num1);
            $('#tnum2').attr('name',1);
            $('#tnum3').attr('name',0);
            $('#tnum4').attr('name',0);

            var msg1=retitlekind(tkind1,num1,0);
            var msg2=retitlekind(tkind2,1,0);
            var msg3=retitlekind(tkind3,1,0);
            var msg4=retitlekind(tkind4,1,0);

            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text('');
            $('#tnum4').text('');
            $('#tnum2').addClass('nownavmsg');

        }
    }
    notemsg();
}
function buttondiv4_d(){
    var val=$('#titlechoose').val();
    var valnum=$('#nowleveldiv').val();
    var begin_or_not=$('#begin_or_not').val();
    if(val==5 && valnum=='no2') {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();
            var tkind5 = $('#no5').val();

            var num2 = $('#num2').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();
            var num5 = $('#num5').val();

            $('#tnum2').attr('name', parseInt(num2)+1);
            $('#tnum3').attr('name', 0);
            $('#tnum4').attr('name', 0);
            $('#tnum5').attr('name', 0);

            var msg2 = retitlekind(tkind2, num2, 1);
            var msg3 = retitlekind(tkind3, 1, 0);
            var msg4 = retitlekind(tkind4, 1, 0);
            var msg5 = retitlekind(tkind5, 1, 0);


            $('#tnum2').text(msg2);
            $('#tnum3').text('');
            $('#tnum4').text('');
            $('#tnum5').text('');
            $('#tnum2').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();

            var tkind2=$('#no2').val();
            var tkind3=$('#no3').val();
            var tkind4=$('#no4').val();
            var tkind5=$('#no5').val();

            var num2=$('#num2').val();
            var num3=$('#num3').val();
            var num4=$('#num4').val();
            var num5=$('#num5').val();

            $('#tnum2').attr('name',num2);
            $('#tnum3').attr('name',0);
            $('#tnum4').attr('name',0);
            $('#tnum5').attr('name',0);

            var msg2=retitlekind(tkind2,num2,0);
            var msg3=retitlekind(tkind3,1,0);
            var msg4=retitlekind(tkind4,1,0);
            var msg5=retitlekind(tkind5,1,0);

            $('#tnum2').text(msg2);
            $('#tnum3').text('');
            $('#tnum4').text('');
            $('#tnum5').text('');
            $('#tnum2').addClass('nownavmsg');

        }
    }

    if(val==5 && valnum=='no1') {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind1 = $('#no1').val();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();
            var tkind5 = $('#no5').val();

            var num1 = $('#num1').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();
            var num5 = $('#num5').val();

            $('#tnum1').attr('name', parseInt(num1)+1);
            $('#tnum2').attr('name', 1);
            $('#tnum3').attr('name', 0);
            $('#tnum4').attr('name', 0);
            $('#tnum5').attr('name', 0);

            var msg1 = retitlekind(tkind1, num1, 1);
            var msg2 = retitlekind(tkind2, 1, 0);
            var msg3 = retitlekind(tkind3, 1, 0);
            var msg4 = retitlekind(tkind4, 1, 0);
            var msg5 = retitlekind(tkind5, 1, 0);


            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text('');
            $('#tnum4').text('');
            $('#tnum5').text('');
            $('#tnum2').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();

            var tkind1=$('#no1').val();
            var tkind2=$('#no2').val();
            var tkind3=$('#no3').val();
            var tkind4=$('#no4').val();
            var tkind5=$('#no5').val();

            var num1=$('#num1').val();
            var num2=$('#num2').val();
            var num3=$('#num3').val();
            var num4=$('#num4').val();
            var num5=$('#num5').val();

            $('#tnum1').attr('name',num1);
            $('#tnum2').attr('name',1);
            $('#tnum3').attr('name',0);
            $('#tnum4').attr('name',0);
            $('#tnum5').attr('name',0);

            var msg1=retitlekind(tkind1,num1,0);
            var msg2=retitlekind(tkind2,1,0);
            var msg3=retitlekind(tkind3,1,0);
            var msg4=retitlekind(tkind4,1,0);
            var msg5=retitlekind(tkind5,1,0);

            $('#tnum1').text(msg1);
            $('#tnum2').text(msg2);
            $('#tnum3').text('');
            $('#tnum4').text('');
            $('#tnum5').text('');
            $('#tnum2').addClass('nownavmsg');

        }
    }

    if(val==4) {
        if (begin_or_not == 1) {
            nav5button();
            removenav();
            var tkind1 = $('#no1').val();
            var tkind2 = $('#no2').val();
            var tkind3 = $('#no3').val();
            var tkind4 = $('#no4').val();

            var num1 = $('#num1').val();
            var num2 = $('#num2').val();
            var num3 = $('#num3').val();
            var num4 = $('#num4').val();

            $('#tnum1').attr('name', parseInt(num1)+1);
            $('#tnum2').attr('name', 0);
            $('#tnum3').attr('name', 0);
            $('#tnum4').attr('name', 0);

            var msg1 = retitlekind(tkind1, num1, 1);
            var msg2 = retitlekind(tkind2, 1, 0);
            var msg3 = retitlekind(tkind3, 1, 0);
            var msg4 = retitlekind(tkind4, 1, 0);


            $('#tnum1').text(msg1);
            $('#tnum2').text('');
            $('#tnum3').text('');
            $('#tnum4').text('');
            $('#tnum1').addClass('nownavmsg');

        }
        else
        {
            // 初始化状态

            nav5button();
            removenav();

            var tkind1=$('#no1').val();
            var tkind2=$('#no2').val();
            var tkind3=$('#no3').val();
            var tkind4=$('#no4').val();

            var num1=$('#num1').val();
            var num2=$('#num2').val();
            var num3=$('#num3').val();
            var num4=$('#num4').val();

            $('#tnum1').attr('name',num1);
            $('#tnum2').attr('name',0);
            $('#tnum3').attr('name',0);
            $('#tnum4').attr('name',0);

            var msg1=retitlekind(tkind1,num1,0);
            var msg2=retitlekind(tkind2,1,0);
            var msg3=retitlekind(tkind3,1,0);
            var msg4=retitlekind(tkind4,1,0);

            $('#tnum1').text(msg1);
            $('#tnum2').text('');
            $('#tnum3').text('');
            $('#tnum4').text('');
            $('#tnum1').addClass('nownavmsg');

        }
    }
    notemsg();
}
//导航栏初始化
function nav5button() {
    var val=parseInt($('#titlechoose').val());
    var tkind1=$('#no1').val();
    var tkind2=$('#no2').val();
    var tkind3=$('#no3').val();
    var tkind4=$('#no4').val();
    var tkind5=$('#no5').val();

    var num1=$('#num1').val();
    var num2=$('#num2').val();
    var num3=$('#num3').val();
    var num4=$('#num4').val();
    var num5=$('#num5').val();

    var msg1=retitlekind(tkind1,num1,0);
    var msg2=retitlekind(tkind2,num2,0);
    var msg3=retitlekind(tkind3,num3,0);
    var msg4=retitlekind(tkind4,num4,0);
    var msg5=retitlekind(tkind5,num5,0);

    $('#tnum1').text(msg1);
    $('#tnum2').text(msg2);
    $('#tnum3').text(msg3);
    $('#tnum4').text(msg4);
    $('#tnum5').text(msg5);


    $('#tnum1').attr('name',num1);
    $('#tnum2').attr('name',num2);
    $('#tnum3').attr('name',num3);
    $('#tnum4').attr('name',num4);
    $('#tnum5').attr('name',num5);

    removenav();

    switch (val)
    {
        case 5:$('#tnum5').addClass('nownavmsg');break;
        case 4:$('#tnum4').addClass('nownavmsg');break;
        case 3:$('#tnum3').addClass('nownavmsg');break;
        case 2:$('#tnum2').addClass('nownavmsg');break;
        case 1:$('#tnum1').addClass('nownavmsg');break;
    }


}
//隐藏二级选项栏
function  hiddennav() {
    $("#buttondiv2").css('display','none');
    $("#buttondiv3").css('display','none');
    $("#buttondiv4").css('display','none');
}
////////////////////////////////////////////////////////添加事件
//no5五级递增
function addbuttondiv1() {
    var val=$('#titlechoose').val();
    var myval=$('#nowleveldiv').val();
    if($('#automsg').val()=='Pause'){
        if($('#reimgkind').val()=='re')
        {
            retest();

        }
        if($('#reimgkind').val()=='up')
        {
            addnewtest('up');

        }
        if($('#reimgkind').val()=='down')
        {
            addnewtest('down');

        }

        if($('#reimgkind').val()=='pic'){

            if($('#addpickind').val()=='a')
            {

                $('#add_pic_div_b').css('display','block');
                $('#addpickind').val('b');
                return;
            }
            if($('#addpickind').val()=='b')
            {
                $('#add_pic_div').css('display','');

                var x=$('#add_pic_div_a').offset().left;
                var y=$('#add_pic_div_a').offset().top;
                var width=parseInt($('#add_pic_div_b').offset().left)-parseInt($('#add_pic_div_a').offset().left)+7;
                var height=parseInt($('#add_pic_div_b').offset().top)-parseInt($('#add_pic_div_a').offset().top)+7;

                newPos=new Object();
                newPos.left= x+4;
                newPos.top= y+4;
                $('#add_pic_div').offset(newPos);


                $('#add_pic_div').css('width',width);
                $('#add_pic_div').css('height',height);

                $('#addpickind').val('none');
                return;
            }
            if($('#addpickind').val()=='none')
            {
                // $('#add_pic_div_a').css('display','none');
                // $('#add_pic_div_b').css('display','none');
                $('#add_pic_div').css('display','none');
                $('#add_pic_div_b').css('display','none');
                $('#addpickind').val('a');
                return;
            }

        }

            return;
        }

        // if(justinsertcutsub()==-100)
        // {
        //     alert('请您关闭编辑选项单！！');
        //     return;
        // }

        if(myval=='del') {
            addtest();
            return;
        }

        if(myval=='link') {
            addtest();
            return;
        }

        if($('#test_or_answer').text()=='(T)') {
            addtest();
        }

       if(justsubeffect('addbuttondiv1')==0)
       {
          return;
       }

        if(justsubbegin(1)==0)
        {
            return;
        }

    //当前级别及当前序号
    if(val==5 && myval=='no5') {
    var begin_or_not=$('#begin_or_not').val();
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        $('#pretnum5').text($('#tnum5').text());
        var num5 = $('#num5').val();
        $('#num5').val($('#tnum5').attr('name'));

        addtest();
        prenumsub();
        buttondiv1();
    }

    if(val==4 && myval=='no4') {
        var begin_or_not=$('#begin_or_not').val();
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        var num4 = $('#num4').val();
        $('#num4').val($('#tnum4').attr('name'));

        addtest();
        prenumsub();
        buttondiv1();
    }

    if(val==3 && myval=='no3') {
        var begin_or_not=$('#begin_or_not').val();
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        var num3 = $('#num3').val();
        $('#num3').val($('#tnum3').attr('name'));

        addtest();
        prenumsub();
        buttondiv1();
    }
    if(val==2 && myval=='no2') {
        var begin_or_not=$('#begin_or_not').val();
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        var num2 = $('#num2').val();
        $('#num2').val($('#tnum2').attr('name'));

        addtest();
        prenumsub();
        buttondiv1();
    }
    if(val==1 && myval=='no1') {
        var begin_or_not=$('#begin_or_not').val();
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        var num1 = $('#num1').val();
        $('#num1').val($('#tnum1').attr('name'));

        addtest();
        prenumsub();
        buttondiv1();
    }

    scrolltopsub();
}
function addbuttondiv2_a(){
    if($('#automsg').val()=='Pause'){
        if($('#reimgkind').val()=='re')
        {
            retest();

        }

        if($('#reimgkind').val()=='up')
        {
            addnewtest('up');

        }
        if($('#reimgkind').val()=='down')
        {
            addnewtest('down');

        }

        return;
    }

    if(justsubeffect('addbuttondiv2_a')==0)
    {
        return;
    }

    if($('#test_or_answer').text()=='(T)') {
        addtest();
    }

    if(justsubbegin(1)==0)
    {
        return;
    }
    var val=$('#titlechoose').val();
    if(val==5) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        $('#pretnum5').text($('#tnum5').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num4').val($('#tnum4').attr('name'));
        $('#num5').val(1);

        addtest();
        prenumsub();
        buttondiv2_a();
    }

    if(val==4) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num3').val($('#tnum3').attr('name'));
        $('#num4').val(1);

        addtest();
        prenumsub();
        buttondiv2_a();
    }

    if(val==3) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num2').val($('#tnum2').attr('name'));
        $('#num3').val(1);

        addtest();
        prenumsub();
        buttondiv2_a();
    }

    if(val==2) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num1').val($('#tnum1').attr('name'));
        $('#num2').val(1);

        addtest();
        prenumsub();
        buttondiv2_a();
    }

    scrolltopsub();

}
function addbuttondiv2_b() {
    if($('#automsg').val()=='Pause'){
        if($('#reimgkind').val()=='re')
        {
            retest();

        }

        if($('#reimgkind').val()=='up')
        {
            addnewtest('up');

        }
        if($('#reimgkind').val()=='down')
        {
            addnewtest('down');

        }

        return;
    }

    var val=$('#titlechoose').val();
    if (justsubeffect('addbuttondiv2_b') == 0) {
        return;
    }

    if($('#test_or_answer').text()=='(T)') {
        addtest();
    }

    if (justsubbegin(1) == 0) {
        return;
    }
    if (val == 5) {
            $('#pretnum1').text($('#tnum1').text());
            $('#pretnum2').text($('#tnum2').text());
            $('#pretnum3').text($('#tnum3').text());
            $('#pretnum4').text($('#tnum4').text());
            $('#pretnum5').text($('#tnum5').text());
            //从num4,num5中取出name的值，也就是当前，修改后的数值，将实际值存储,实值输入
            //name值是已经相应的增加的
            $('#num4').val(parseInt($('#tnum4').attr('name')));
            $('#num5').val(1);
            addtest();
            prenumsub();
            buttondiv2_b();
    }

    if (val == 4) {
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值，将实际值存储,实值输入
        //name值是已经相应的增加的
        $('#num3').val(parseInt($('#tnum3').attr('name')));
        $('#num4').val(1);
        addtest();
        prenumsub();
        buttondiv2_b();
    }

    if (val == 3) {
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值，将实际值存储,实值输入
        //name值是已经相应的增加的
        $('#num2').val(parseInt($('#tnum2').attr('name')));
        $('#num3').val(1);
        addtest();
        prenumsub();
        buttondiv2_b();
    }

    if (val == 2) {
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值，将实际值存储,实值输入
        //name值是已经相应的增加的
        $('#num1').val(parseInt($('#tnum1').attr('name')));
        $('#num2').val(1);
        addtest();
        prenumsub();
        buttondiv2_b();
    }
    scrolltopsub();
}
function addbuttondiv3_a(){
    if($('#automsg').val()=='Pause'){
        if($('#reimgkind').val()=='re')
        {
            retest();

        }

        if($('#reimgkind').val()=='up')
        {
            addnewtest('up');

        }
        if($('#reimgkind').val()=='down')
        {
            addnewtest('down');

        }

        return;
    }

    if(justsubeffect('addbuttondiv3_a')==0)
    {
        return;
    }

    if($('#test_or_answer').text()=='(T)') {
        addtest();
    }

    if(justsubbegin(1)==0)
    {
        return;
    }
    var val=$('#titlechoose').val();
    if(val==5) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        $('#pretnum5').text($('#tnum5').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num3').val($('#tnum3').attr('name'));
        $('#num4').val($('#tnum4').attr('name'));
        $('#num5').val($('#tnum5').attr('name'));

        addtest();
        prenumsub();
        buttondiv3_a();
    }

    if(val==4) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num2').val($('#tnum2').attr('name'));
        $('#num3').val($('#tnum3').attr('name'));
        $('#num4').val($('#tnum4').attr('name'));

        addtest();
        prenumsub();
        buttondiv3_a();
    }

    if(val==3) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num1').val($('#tnum1').attr('name'));
        $('#num2').val($('#tnum2').attr('name'));
        $('#num3').val($('#tnum3').attr('name'));

        addtest();
        prenumsub();
        buttondiv3_a();
    }

    scrolltopsub();
}
function addbuttondiv3_b(){
    if($('#automsg').val()=='Pause'){
        if($('#reimgkind').val()=='re')
        {
            retest();

        }

        if($('#reimgkind').val()=='up')
        {
            addnewtest('up');

        }
        if($('#reimgkind').val()=='down')
        {
            addnewtest('down');

        }

        return;
    }

    if(justsubeffect('addbuttondiv3_b')==0)
    {
        return;
    }

    if($('#test_or_answer').text()=='(T)') {
        addtest();
    }

    if(justsubbegin(1)==0)
    {
        return;
    }
    var val=$('#titlechoose').val();
    if(val==5) {

        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        $('#pretnum5').text($('#tnum5').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num3').val($('#tnum3').attr('name'));
        $('#num4').val(1);
        $('#num5').val(0);

        addtest();
        prenumsub();
        buttondiv3_b();
    }

    if(val==4) {

        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num2').val($('#tnum2').attr('name'));
        $('#num3').val(1);
        $('#num4').val(0);

        addtest();
        prenumsub();
        buttondiv3_b();
    }

    if(val==3) {

        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());

        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num1').val($('#tnum1').attr('name'));
        $('#num2').val(1);
        $('#num3').val(0);

        addtest();
        prenumsub();
        buttondiv3_b();
    }
    scrolltopsub();
}
function addbuttondiv3_c(){
    if($('#automsg').val()=='Pause'){
        if($('#reimgkind').val()=='re')
        {
            retest();

        }

        if($('#reimgkind').val()=='up')
        {
            addnewtest('up');

        }
        if($('#reimgkind').val()=='down')
        {
            addnewtest('down');

        }

        return;
    }

    if(justsubeffect('addbuttondiv3_c')==0)
    {
        return;
    }

    if($('#test_or_answer').text()=='(T)') {
        addtest();
    }

    if(justsubbegin(1)==0)
    {
        return;
    }
    var val=$('#titlechoose').val();
    if(val==5) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        $('#pretnum5').text($('#tnum5').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num3').val($('#tnum3').attr('name'));
        $('#num4').val(0);
        $('#num5').val(0);

        addtest();
        prenumsub();
        buttondiv3_c();
    }


    if(val==4) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        $('#pretnum5').text($('#tnum5').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num2').val($('#tnum2').attr('name'));
        $('#num3').val(0);
        $('#num4').val(0);

        addtest();
        prenumsub();
        buttondiv3_c();
    }

    if(val==3) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        $('#pretnum5').text($('#tnum5').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num1').val($('#tnum1').attr('name'));
        $('#num2').val(0);
        $('#num3').val(0);

        addtest();
        prenumsub();
        buttondiv3_c();
    }
    scrolltopsub();
}
function addbuttondiv4_a() {
    if($('#automsg').val()=='Pause'){
        if($('#reimgkind').val()=='re')
        {
            retest();

        }

        if($('#reimgkind').val()=='up')
        {
            addnewtest('up');

        }
        if($('#reimgkind').val()=='down')
        {
            addnewtest('down');

        }

        return;
    }

    if($('#test_or_answer').text()=='(T)') {
        addtest();
    }

    if (justsubbegin(1) == 0) {
        return;
    }

    var val = $('#titlechoose').val();
    var valnum = $('#nowleveldiv').val();
    var begin_or_not = $('#begin_or_not').val();
    if (val == 5) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        $('#pretnum5').text($('#tnum5').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num1').val($('#tnum1').attr('name'));
        $('#num2').val($('#tnum2').attr('name'));
        $('#num3').val($('#tnum3').attr('name'));
        $('#num4').val($('#tnum4').attr('name'));
        $('#num5').val($('#tnum5').attr('name'));

        addtest();
        prenumsub();
        buttondiv4_a();
    }
    if (val == 4) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num1').val($('#tnum1').attr('name'));
        $('#num2').val($('#tnum2').attr('name'));
        $('#num3').val($('#tnum3').attr('name'));
        $('#num4').val($('#tnum4').attr('name'));

        addtest();
        prenumsub();
        buttondiv4_a();
    }
    scrolltopsub();
}
function addbuttondiv4_b(){
    if($('#automsg').val()=='Pause'){
        if($('#reimgkind').val()=='re')
        {
            retest();

        }

        if($('#reimgkind').val()=='up')
        {
            addnewtest('up');

        }
        if($('#reimgkind').val()=='down')
        {
            addnewtest('down');

        }

        return;
    }

    if($('#test_or_answer').text()=='(T)') {
        addtest();
    }

    if(justsubbegin(1)==0)
    {
        return;
    }
    var val=$('#titlechoose').val();
    var valnum=$('#nowleveldiv').val();
    var begin_or_not=$('#begin_or_not').val();
    if(val==5) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        $('#pretnum5').text($('#tnum5').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num1').val($('#tnum1').attr('name'));
        $('#num2').val($('#tnum2').attr('name'));
        $('#num3').val($('#tnum3').attr('name'));
        $('#num4').val($('#tnum4').attr('name'));
        $('#num5').val(0);

        addtest();
        prenumsub();
        buttondiv4_b();
    }

    if(val==4) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num1').val($('#tnum1').attr('name'));
        $('#num2').val($('#tnum2').attr('name'));
        $('#num3').val($('#tnum3').attr('name'));
        $('#num4').val(0);

        addtest();
        prenumsub();
        buttondiv4_b();
    }
    scrolltopsub();
}
function addbuttondiv4_c(){
    if($('#automsg').val()=='Pause'){
        if($('#reimgkind').val()=='re')
        {
            retest();

        }
        if($('#reimgkind').val()=='up')
        {
            addnewtest('up');

        }
        if($('#reimgkind').val()=='down')
        {
            addnewtest('down');

        }

        return;
    }

    if($('#test_or_answer').text()=='(T)') {
        addtest();
    }

    if(justsubbegin(1)==0)
    {
        return;
    }
    var val=$('#titlechoose').val();
    var valnum=$('#nowleveldiv').val();
    var begin_or_not=$('#begin_or_not').val();
    if(val==5) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        $('#pretnum5').text($('#tnum5').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num1').val($('#tnum1').attr('name'));
        $('#num2').val($('#tnum2').attr('name'));
        $('#num3').val($('#tnum3').attr('name'));
        $('#num4').val(0);
        $('#num5').val(0);

        addtest();
        prenumsub();
        buttondiv4_c();
    }

    if(val==4) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num1').val($('#tnum1').attr('name'));
        $('#num2').val($('#tnum2').attr('name'));
        $('#num3').val(0);
        $('#num4').val(0);

        addtest();
        prenumsub();
        buttondiv4_c();
    }
    scrolltopsub();


}
function addbuttondiv4_d(){
    if($('#automsg').val()=='Pause'){
        if($('#reimgkind').val()=='re')
        {
            retest();

        }

        if($('#reimgkind').val()=='up')
        {
            addnewtest('up');

        }
        if($('#reimgkind').val()=='down')
        {
            addnewtest('down');

        }

        return;
    }

    if($('#test_or_answer').text()=='(T)') {
        addtest();
    }
    if (justsubbegin(1) == 0) {
        return;
    }
    var val = $('#titlechoose').val();
    var valnum = $('#nowleveldiv').val();
    var begin_or_not = $('#begin_or_not').val();
    if (val == 5) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        $('#pretnum5').text($('#tnum5').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num1').val($('#tnum1').attr('name'));
        $('#num2').val($('#tnum2').attr('name'));
        $('#num3').val(0);
        $('#num4').val(0);
        $('#num5').val(0);
        addtest();
        prenumsub();
        buttondiv4_d();
    }
    if (val == 4) {
        //将当前的数据赋值给pre，变成上一个数据
        $('#pretnum1').text($('#tnum1').text());
        $('#pretnum2').text($('#tnum2').text());
        $('#pretnum3').text($('#tnum3').text());
        $('#pretnum4').text($('#tnum4').text());
        //从num4,num5中取出name的值，也就是当前，修改后的数值
        $('#num1').val($('#tnum1').attr('name'));
        $('#num2').val(0);
        $('#num3').val(0);
        $('#num4').val(0);
        addtest();
        prenumsub();
        buttondiv4_d();
    }
    scrolltopsub();
}
//前一个num进行赋值
function prenumsub(){
    $('#prenum1').val( $('#num1').val());
    $('#prenum2').val( $('#num2').val());
    $('#prenum3').val( $('#num3').val());
    $('#prenum4').val( $('#num4').val());
    $('#prenum5').val( $('#num5').val());
}
//进行判断
function justsubbegin(val) {
    if(val==0)
    {
        return 0;
    }
    if(val==1)
    {
        if($('#test_or_answer').text()=='(T)')
        {

            return 0;
        }
        else
        {
            $('#begin_or_not').val(1);
            return 1;
        }

    }
}
//判断函数或显示是否生效
function justsubeffect(subname){
    switch(subname)
    {
        case 'addbuttondiv1':
            return justsubend('addbuttondiv1');break;
        case 'addbuttondiv2_a':
            return justsubend('addbuttondiv2_a');break;
        case 'addbuttondiv2_b':
            return justsubend('addbuttondiv2_b');break;
        case 'addbuttondiv3_a':
            return justsubend('addbuttondiv3_a');break;
        case 'addbuttondiv3_b':
            return justsubend('addbuttondiv3_b');break;
        case 'addbuttondiv3_c':
            return justsubend('addbuttondiv3_c');break;


        case 'buttondiv1':
            return justsubdisplay('buttondiv1');break;
        case 'buttondiv2_a':
            return justsubdisplay('buttondiv2_a');break;
        case 'buttondiv2_b':
            return justsubdisplay('buttondiv2_b');break;
        case 'buttondiv3_a':
            return justsubdisplay('buttondiv3_a');break;
        case 'buttondiv3_b':
            return justsubdisplay('buttondiv3_b');break;
        case 'buttondiv3_c':
            return justsubdisplay('buttondiv3_c');break;
        default:return 1;
    }
}
//函数是否生效
function justsubend(subname) {
    var prenum1=$('#prenum1').val();
    var prenum2=$('#prenum2').val();
    var prenum3=$('#prenum3').val();
    var prenum4=$('#prenum4').val();
    var prenum5=$('#prenum5').val();
    var subname='/'+subname;
    var msg;

    if(prenum1!=0 && prenum2!=0 && prenum3==0 && prenum4==0 && prenum5==0)
    {
        msg='/buttondiv3_a'+'/buttondiv3_b'+'/buttondiv3_c'+'/buttondiv2_a'+'/buttondiv2_b'+'/buttondiv1';
        msg=msg+'/addbuttondiv3_a'+'/addbuttondiv3_b'+'/addbuttondiv3_c'+'/addbuttondiv2_a'+'/addbuttondiv2_b'+'/addbuttondiv1';
        if(msg.indexOf(subname)>-1)
        {
            return 0;
        }
    }
    if(prenum1!=0 && prenum2!=0 && prenum3!=0 && prenum4==0 && prenum5==0)
    {
        msg='/buttondiv2_a'+'/buttondiv2_b'+'/buttondiv1';
        msg=msg+'/addbuttondiv2_a'+'/addbuttondiv2_b'+'/addbuttondiv1';
        if(msg.indexOf(subname)>-1)
        {
            return 0;
        }
    }
    if(prenum1!=0 && prenum2!=0 && prenum3!=0 && prenum4!=0 &&prenum5==0)
    {
        msg='/buttondiv1'+'/addbuttondiv1';
        if(msg.indexOf(subname)>-1)
        {
            return 0;
        }
    }

    return 1;
}
//显示是否生效
function justsubdisplay(subname) {
    var prenum1=$('#prenum1').val();
    var prenum2=$('#prenum2').val();
    var prenum3=$('#prenum3').val();
    var prenum4=$('#prenum4').val();
    var prenum5=$('#prenum5').val();
    var subname='/'+subname;
    var msg;

    if(prenum1!=0 && prenum2!=0 && prenum3==0 && prenum4==0 && prenum5==0)
    {
        msg='/buttondiv3_a'+'/buttondiv3_b'+'/buttondiv3_c'+'/buttondiv2_a'+'/buttondiv2_b'+'/buttondiv1';
        msg=msg+'/addbuttondiv3_a'+'/addbuttondiv3_b'+'/addbuttondiv3_c'+'/addbuttondiv2_a'+'/addbuttondiv2_b'+'/addbuttondiv1';
        if(msg.indexOf(subname)>-1)
        {
            $('#tnum1').text('none');
            $('#tnum2').text('');
            $('#tnum3').text('');
            $('#tnum4').text('');
            $('#tnum5').text('');
            return 0;
        }
    }
    if(prenum1!=0 && prenum2!=0 && prenum3!=0 && prenum4==0 && prenum5==0)
    {
        msg='/buttondiv2_a'+'/buttondiv2_b'+'/buttondiv1';
        msg=msg+'/addbuttondiv2_a'+'/addbuttondiv2_b'+'/addbuttondiv1';
        if(msg.indexOf(subname)>-1)
        {
            $('#tnum1').text('none');
            $('#tnum2').text('');
            $('#tnum3').text('');
            $('#tnum4').text('');
            $('#tnum5').text('');
            return 0;
        }
    }
    if(prenum1!=0 && prenum2!=0 && prenum3!=0 && prenum4!=0 &&prenum5==0)
    {
        msg='/buttondiv1'+'/addbuttondiv1';
        if(msg.indexOf(subname)>-1)
        {
            $('#tnum1').text('none');
            $('#tnum2').text('');
            $('#tnum3').text('');
            $('#tnum4').text('');
            $('#tnum5').text('');
            return 0;
        }
    }

    return 1;
}
//左侧显示数字
function notemsg() {

    var tkind1 = $('#no1').val();
    var tkind2 = $('#no2').val();
    var tkind3 = $('#no3').val();
    var tkind4 = $('#no4').val();
    var tkind5 = $('#no5').val();


    var num1=$('#tnum1').attr('name');
    var num2=$('#tnum2').attr('name');
    var num3=$('#tnum3').attr('name');
    var num4=$('#tnum4').attr('name');
    var num5=$('#tnum5').attr('name');

    num1=parseInt(num1.replace(/[^0-9]/ig,""));
    num2=parseInt(num2.replace(/[^0-9]/ig,""));
    num3=parseInt(num3.replace(/[^0-9]/ig,""));
    num4=parseInt(num4.replace(/[^0-9]/ig,""));
    num5=parseInt(num5.replace(/[^0-9]/ig,""));

    var val = $('#titlechoose').val();


    var checkkind=$('#twofont').prop('checked');
    var checknum;

if(checkkind)
{
    checknum=1;
}


    var test_or_answer=$('#test_or_answer').text();

    var msg, msg1,msg2;

    if(val==5){
    if(num1!=0 && num2!=0 &&  num3!=0 &&  num4!=0 &&  num5!=0){
        if(num5==1 && test_or_answer=='(T+A)' && checknum==1)
        {
            msg1=retitlekind(tkind4,num4,0)+dotsub(tkind4).replace('#',' ');
            msg2=retitlekind(tkind5,num5,0)+dotsub(tkind5).replace('#',' ');

            $('#titlea').val(msg1);
            $('#titleb').val(msg2);

            msg=msg1+msg2;
            $('#notenum').text(msg);
        }
        else
        {
            msg=retitlekind(tkind5,num5,0)+dotsub(tkind5).replace('#',' ');

            $('#titlea').val(msg);
            $('#titleb').val('');
            $('#notenum').text(msg);
        }

    }
    if(num1!=0 && num2!=0 &&  num3!=0 &&  num4!=0 &&  num5==0){

        if(num4==1 && test_or_answer=='(T+A)' && checknum==1)
        {
            msg1=retitlekind(tkind3,num3,0)+dotsub(tkind3).replace('#',' ');
            msg2=retitlekind(tkind4,num4,0)+dotsub(tkind4).replace('#',' ');

            $('#titlea').val(msg1);
            $('#titleb').val(msg2);
            msg=msg1+msg2;
            $('#notenum').text(msg);
        }
        else
        {
            msg=retitlekind(tkind4,num4,0)+dotsub(tkind4).replace('#',' ');
            $('#titlea').val(msg);
            $('#titleb').val('');
            $('#notenum').text(msg);
        }
    }
    if(num1!=0 && num2!=0 &&  num3!=0 &&  num4==0 &&  num5==0){
        if(num3==1 && test_or_answer=='(T+A)' && checknum==1)
        {
            msg1=retitlekind(tkind2,num2,0)+dotsub(tkind2).replace('#',' ');
            msg2=retitlekind(tkind3,num3,0)+dotsub(tkind3).replace('#',' ');
            $('#titlea').val(msg1);
            $('#titleb').val(msg2);
            msg=msg1+msg2;
            $('#notenum').text(msg);
        }
        else
        {
            msg=retitlekind(tkind3,num3,0)+dotsub(tkind3).replace('#',' ');
            $('#titlea').val(msg);
            $('#titleb').val('');
            $('#notenum').text(msg);
        }
    }
    if(num1!=0 && num2!=0 &&  num3==0 &&  num4==0 &&  num5==0){
        if(num2==1 && test_or_answer=='(T+A)' && checknum==1)
        {
            msg1=num1;
            msg2=num2;

            msg1=retitlekind(tkind1,num1,0)+dotsub(tkind1).replace('#',' ');
            msg2=retitlekind(tkind2,num2,0)+dotsub(tkind2).replace('#',' ');

            $('#titlea').val(msg1);
            $('#titleb').val(msg2);

            msg=msg1+msg2;
            $('#notenum').text(msg);
        }
        else
        {
            msg=retitlekind(tkind2,num2,0)+dotsub(tkind2).replace('#',' ');
            $('#titlea').val(msg);
            $('#titleb').val('');
            $('#notenum').text(msg);
        }
    }
    if(num1!=0 && num2==0 &&  num3==0 &&  num4==0 &&  num5==0){

            msg=retitlekind(tkind1,num1,0)+dotsub(tkind1).replace('#',' ');
        $('#titlea').val(msg);
            $('#notenum').text(msg);


        }
    }
    if(val==4){
        if(num1!=0 && num2!=0 &&  num3!=0 &&  num4!=0){
            if(num4==1 && test_or_answer=='(T+A)' && checknum==1)
            {
                msg1=retitlekind(tkin3,num3,0)+dotsub(tkind3).replace('#',' ');
                msg2=retitlekind(tkind4,num4,0)+dotsub(tkind4).replace('#',' ');

                $('#titlea').val(msg1);
                $('#titleb').val(msg2);

                msg=msg1+msg2;
                $('#notenum').text(msg);
            }
            else
            {
                msg=retitlekind(tkind4,num4,0)+dotsub(tkind4).replace('#',' ');
                $('#titlea').val(msg);
                $('#titleb').val('');
                $('#notenum').text(msg);
            }

        }
        if(num1!=0 && num2!=0 &&  num3!=0 &&  num4==0 ){

            if(num3==1 && test_or_answer=='(T+A)' && checknum==1)
            {
                msg1=retitlekind(tkind2,num2,0)+dotsub(tkind2).replace('#',' ');
                msg2=retitlekind(tkind3,num3,0)+dotsub(tkind3).replace('#',' ');

                $('#titlea').val(msg1);
                $('#titleb').val(msg2);

                msg=msg1+msg2;
                $('#notenum').text(msg);
            }
            else
            {
                msg=retitlekind(tkind3,num3,0)+dotsub(tkind3).replace('#',' ');
                $('#titlea').val(msg);
                $('#titleb').val('');
                $('#notenum').text(msg);
            }
        }
        if(num1!=0 && num2!=0 &&  num3==0 &&  num4==0){
            if(num2==1 && test_or_answer=='(T+A)' && checknum==1)
            {
                msg1=retitlekind(tkind1,num1,0)+dotsub(tkind1).replace('#',' ');
                msg2=retitlekind(tkind2,num2,0)+dotsub(tkind2).replace('#',' ');

                $('#titlea').val(msg1);
                $('#titleb').val(msg2);

                msg=msg1+msg2;
                $('#notenum').text(msg);
            }
            else
            {
                 msg=retitlekind(tkind2,num2,0)+dotsub(tkind2).replace('#',' ');
                $('#titlea').val(msg);
                $('#titleb').val('');
                $('#notenum').text(msg);
            }
        }

        if(num1!=0 && num2==0 &&  num3==0 &&  num4==0){

                msg=retitlekind(tkind1,num1,0)+dotsub(tkind1).replace('#',' ');
            $('#titlea').val(msg);
                $('#notenum').text(msg);
        }
    }
    if(val==3){
        if(num1!=0 && num2!=0 &&  num3!=0){
            if(num3==1 && test_or_answer=='(T+A)' && checknum==1)
            {
                msg1=retitlekind(tkind2,num2,0)+dotsub(tkind2).replace('#',' ');
                msg2=retitlekind(tkind3,num3,0)+dotsub(tkind3).replace('#',' ');

                $('#titlea').val(msg1);
                $('#titleb').val(msg2);

                msg=msg1+msg2;
                $('#notenum').text(msg);
            }
            else
            {
                msg=retitlekind(tkind3,num3,0)+dotsub(tkind3).replace('#',' ');
                $('#titlea').val(msg);
                $('#titleb').val('');
                $('#notenum').text(msg);
            }

        }
        if(num1!=0 && num2!=0 &&  num3==0 ){

            if(num2==1 && test_or_answer=='(T+A)' && checknum==1)
            {
                msg1=retitlekind(tkind1,num1,0)+dotsub(tkind1).replace('#',' ');
                msg2=retitlekind(tkind2,num2,0)+dotsub(tkind2).replace('#',' ');

                $('#titlea').val(msg1);
                $('#titleb').val(msg2);

                msg=msg1+msg2;
                $('#notenum').text(msg);
            }
            else
            {
                msg=retitlekind(tkind2,num2,0)+dotsub(tkind2).replace('#',' ');
                $('#titlea').val(msg);

                $('#notenum').text(msg);
            }
        }
        if(num1!=0 && num2==0 &&  num3==0 ){
                msg=retitlekind(tkind1,num1,0)+dotsub(tkind1).replace('#',' ');
            $('#titlea').val(msg);
                $('#notenum').text(msg);
        }
    }
    if(val==2){
        if(num1!=0 && num2!=0){
            if(num2==1 && test_or_answer=='(T+A)' && checknum==1)
            {
                msg1=retitlekind(tkind1,num1,0)+dotsub(tkind1).replace('#',' ');
                msg2=retitlekind(tkind2,num2,0)+dotsub(tkind2).replace('#',' ');


                $('#titlea').val(msg1);
                $('#titleb').val(msg2);

                msg=msg1+msg2;
                $('#notenum').text(msg);
            }
            else
            {
                msg=retitlekind(tkind2,num2,0)+dotsub(tkind2).replace('#',' ');
                $('#titlea').val(msg);
                $('#titleb').val('');
                $('#notenum').text(msg);
            }

        }
        if(num1!=0 && num2==0) {

            msg = retitlekind(tkind1, num1, 0) + dotsub(tkind1).replace('#', ' ');
            $('#titlea').val(msg);
            $('#notenum').text(msg);
        }
    }
    if(val==1) {
        if (num1 != 0) {
            msg = retitlekind(tkind1, num1, 0) + dotsub(tkind1).replace('#', ' ');
            $('#titlea').val(msg);
            $('#notenum').text(msg);
        }
    }
}
//button2重置
function initbutton2(num) {
    if(num==0)
    {
        $('#buttondiv2_div1').css('width','37px');
        $('#buttondiv2_div2').css('width','38px');
    }
    if(num==1)
    {
        $('#buttondiv2_div1').css('width','77px');
        $('#buttondiv2_div2').css('width','77px');
    }
}
//num初始化（显示初始赋值）
function initnum(num) {
    if(num==5)
    {
        $('#num1').val(1);
        $('#num2').val(1);
        $('#num3').val(1);
        $('#num4').val(1);
        $('#num5').val(0);
    }
    if(num==4)
    {
        $('#num1').val(1);
        $('#num2').val(1);
        $('#num3').val(1);
        $('#num4').val(0);
        $('#num5').val(-1);
    }
    if(num==3)
    {
        $('#num1').val(1);
        $('#num2').val(1);
        $('#num3').val(0);
        $('#num4').val(-1);
        $('#num5').val(-1);
    }
    if(num==2)
    {
        $('#num1').val(1);
        $('#num2').val(0);
        $('#num3').val(-1);
        $('#num4').val(-1);
        $('#num5').val(-1);
    }
    if(num==1)
    {
        $('#num1').val(0);
        $('#num2').val(-1);
        $('#num3').val(-1);
        $('#num4').val(-1);
        $('#num5').val(-1);
    }

    $('#pretnum1').text('');
    $('#pretnum2').text('');
    $('#pretnum3').text('');
    $('#pretnum4').text('');
    $('#pretnum5').text('');
}


//滚动条居于底
function scrolltopsub(){
    $('#display_div').scrollTop($('#display_div')[0].scrollHeight);
}
