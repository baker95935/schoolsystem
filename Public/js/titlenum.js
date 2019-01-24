/**
 * Created by fangzheng on 2018/4/8.
 */
// 第一章样式
function t1(initialnum,varnum) {
   if(initialnum<0)
   {
       return;
   }
    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }

    if(initialnum==9999 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }

    if(initialnum>9999)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)+parseInt(varnum);
    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }

    var msg="第"+cnnum(num)+"章";
    return msg;
}
//第1章样式
function t2(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }

    if(initialnum==9999 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }

    if(initialnum>9999)
    {
        return "序号超出上限！！";
    }



    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }


    var msg="第"+num+"章";
    return msg;
}
//第一节样式
function t3(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }
    if(initialnum==9999 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }

    if(initialnum>9999)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }


    var msg="第"+cnnum(num)+"节";
    return msg;
}
//第1节样式
function t4(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }
    if(initialnum==9999 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }
    if(initialnum>9999)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }

    var msg="第"+num+"节";
    return msg;
}
//第一部分样式
function t5(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }
    if(initialnum==9999 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }

    if(initialnum>9999)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }


    var msg="第"+cnnum(num)+"部分";
    return msg;
}
//第1部分样式
function t6(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }
    if(initialnum==9999 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }

    if(initialnum>9999)
    {
        return "序号超出上限！！";
    }



    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }


    var msg="第"+num+"部份";
    return msg;
}
//Part1样式
function t7(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }
    if(initialnum==9999 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }


    if(initialnum>9999)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }


    var msg="Part"+num;
    return msg;
}
//PartA样式
function t8(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }
    if(initialnum==26 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }

    if(initialnum>26)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }


    var msg="Part"+ennum(num,1);
    return msg;
}
//PartⅠ样式（罗马）
function t9(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }
    if(initialnum==40 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }

    if(initialnum>39)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }


    var msg="Part"+rmnum(num);
    return msg;
}
//a
function t10(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }
    if(initialnum==26 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }

    if(initialnum>26)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }


    var msg=ennum(num,0);
    return msg;
}
//A
function t11(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }


    if(initialnum==26 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }

    if(initialnum>26)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }


    var msg=ennum(num,1);
    return msg;
}
//一
function t12(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }

    if(initialnum==10000 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }

    if(initialnum>10000)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }


    var msg=cnnum(num,1);
    return msg;
}
//（一）
function t13(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }
    if(initialnum==10000 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }

    if(initialnum>10000)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }

    var msg="（"+cnnum(num,1)+"）";
    return msg;
}
//1，2样式
function t14(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }

    if(initialnum==9999 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }
    if(initialnum>9999)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)*1+parseInt(varnum)*1;

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }

    var msg=num;
    return msg;
}
//1）2）样式
function t15(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }
    if(initialnum==9999 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }
    if(initialnum>9999)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }

    var msg=num+"）";
    return msg;
}
//（1），（2）样式
function t16(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }
    if(initialnum==9999 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }
    if(initialnum>9999)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }

    var msg="（"+num+"）";
    return msg;
}
//I，II
function t17(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }
    if(initialnum==40 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }
    if(initialnum>40)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }

    var msg=rmnum(num);
    return msg;
}
//a)b)
function t18(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }
    if(initialnum==26 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }
    if(initialnum>26)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }

    var msg=ennum(num)+")";
    return msg;
}
//(a)(b)
function t19(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }
    if(initialnum==26 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }
    if(initialnum>26)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }

    var msg="("+ennum(num)+")";
    return msg;
}
//No1,No2
function t20(initialnum,varnum) {

    if(initialnum<0)
    {
        return;
    }

    if(initialnum==0 && varnum==0 )
    {
        return '-';
    }
    if(initialnum==26 && varnum>0 )
    {
        return "序号超出上限！！";
    }
    else
    {
        if(initialnum<1 && varnum<0 )
        {
            return "序号超出下限！！";
        }
    }
    if(initialnum>26)
    {
        return "序号超出上限！！";
    }

    var num=parseInt(initialnum)+parseInt(varnum);

    if(initialnum<0 ||num<0)
    {
        return "序号非法输入！！";
    }
    var msg="No"+num;
    return msg;
}
//数字转化成中文小于10000
function cnnum(num) {
    var num1000='',num100='',num10='',num1='';
    var msg1000='',msg100='',msg10='',msg1='';



    if(num>=0 && num<10) {
        var num1= num;
    }

    if(num>=10 && num<100) {
        var num10 = parseInt(num / 10);
        num=num%10;
        var num1= num;
    }

    if(num>=100 && num<1000) {
        var num100 = parseInt(num / 100);
        num=num%100;
        var num10 = parseInt(num / 10);
        num=num%10;
        var num1= num;
    }


    if(num>=1000 && num<=9999)
    {
    var num1000=parseInt(num/1000);
    num=num%1000;
    var num100 = parseInt(num / 100);
    num=num%100;
    var num10 = parseInt(num / 10);
    num=num%10;
    var num1= num;

    }

    switch(num1000)
    {
        case 1:msg1000="一千";break;
        case 2:msg1000="二千";break;
        case 3:msg1000="三千";break;
        case 4:msg1000="四千";break;
        case 5:msg1000="五千";break;
        case 6:msg1000="六千";break;
        case 7:msg1000="七千";break;
        case 8:msg1000="八千";break;
        case 9:msg1000="九千";break;
    }

    switch(num100)
    {
        case 1:msg100="一百";break;
        case 2:msg100="二百";break;
        case 3:msg100="三百";break;
        case 4:msg100="四百";break;
        case 5:msg100="五百";break;
        case 6:msg100="六百";break;
        case 7:msg100="七百";break;
        case 8:msg100="八百";break;
        case 9:msg100="九百";break;
    }

    switch(num10)
    {
        case 1:msg10="十";break;
        case 2:msg10="二十";break;
        case 3:msg10="三十";break;
        case 4:msg10="四十";break;
        case 5:msg10="五十";break;
        case 6:msg10="六十";break;
        case 7:msg10="七十";break;
        case 8:msg10="八十";break;
        case 9:msg10="九十";break;
    }
    switch(num1)
    {
        case 1:msg1="一";break;
        case 2:msg1="二";break;
        case 3:msg1="三";break;
        case 4:msg1="四";break;
        case 5:msg1="五";break;
        case 6:msg1="六";break;
        case 7:msg1="七";break;
        case 8:msg1="八";break;
        case 9:msg1="九";break;
    }

    return msg=msg1000+msg100+msg10+msg1;
}
//数字转化成罗马文字小于40
function rmnum(num) {
    switch(num)
    {
        case 1:msg="I";break;
        case 2:msg="II";break;
        case 3:msg="III";break;
        case 4:msg="IV";break;
        case 5:msg="V";break;
        case 6:msg="VI";break;
        case 7:msg="VII";break;
        case 8:msg="VIII";break;
        case 9:msg="IX";break;
        case 10:msg="X";break;
        case 11:msg="XI";break;
        case 12:msg="XII";break;
        case 13:msg="XIII";break;
        case 14:msg="XIV";break;
        case 15:msg="XV";break;
        case 16:msg="XVI";break;
        case 17:msg="XVII";break;
        case 18:msg="XVIII";break;
        case 19:msg="XIX";break;
        case 20:msg="XX";break;
        case 21:msg="XXI";break;
        case 22:msg="XXII";break;
        case 23:msg="XXIII";break;
        case 24:msg="XXIV";break;
        case 25:msg="XXV";break;
        case 26:msg="XXVI";break;
        case 27:msg="XXVII";break;
        case 28:msg="XXVIII";break;
        case 29:msg="XXIX";break;
        case 30:msg="XXX";break;
        case 31:msg="XXXI";break;
        case 32:msg="XXXII";break;
        case 33:msg="XXXIII";break;
        case 34:msg="XXXIV";break;
        case 35:msg="XXXV";break;
        case 36:msg="XXXVI";break;
        case 37:msg="XXXVII";break;
        case 38:msg="XXXVIII";break;
        case 39:msg="XXXIX";break;
        case 40:msg="XL";break;
    }

    return msg;
}
//数字转化成英文字母小于26
function ennum(num,up) {
    switch(num)
    {
        case 1:msg="a";break;
        case 2:msg="b";break;
        case 3:msg="c";break;
        case 4:msg="d";break;
        case 5:msg="e";break;
        case 6:msg="f";break;
        case 7:msg="g";break;
        case 8:msg="h";break;
        case 9:msg="i";break;
        case 10:msg="j";break;
        case 11:msg="k";break;
        case 12:msg="l";break;
        case 13:msg="m";break;
        case 14:msg="n";break;
        case 15:msg="o";break;
        case 16:msg="p";break;
        case 17:msg="q";break;
        case 18:msg="r";break;
        case 19:msg="s";break;
        case 20:msg="t";break;
        case 21:msg="u";break;
        case 22:msg="v";break;
        case 23:msg="w";break;
        case 24:msg="x";break;
        case 25:msg="y";break;
        case 26:msg="z";break;

    }
    if(up==1)
    {
        msg=msg.toUpperCase();
    }

    return msg;
}
//标点符号显示
function dotsub(tnum){
    switch (tnum)
    {
        case 't1':return '#';break;
        case 't2':return '#';break;
        case 't3':return '#';break;
        case 't4':return '#';break;
        case 't5':return '#';break;

        case 't6':return '#';break;
        case 't7':return '#';break;
        case 't8':return '#';break;
        case 't9':return '#';break;
        case 't10':return '#';break;

        case 't11':return '#';break;
        case 't12':return '、';break;
        case 't13':return '';break;
        case 't14':return '.';break;
        case 't15':return '';break;

        case 't16':return '';break;
        case 't17':return '#';break;
        case 't18':return '';break;
        case 't19':return '';break;
        case 't20':return '#';break;
    }
}
