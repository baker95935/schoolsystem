/**
 * Created by fangzheng on 2018/4/11.
 */
//取出数字部份
// msg.replace(/[^0-9]/ig,"");

function checkDate(publishtimeid){
    var DATE_FORMAT = /^[0-9]{4}-[0-1]?[0-9]{1}-[0-3]?[0-9]{1}$/;
    if(DATE_FORMAT.test(publishtimeid)){
        return true;
    } else {
        return false;
    }
}
//判断是否为数字
function isNumber(value) {         //验证是否为数字
    var patrn = /^(-)?\d+(\.\d+)?$/;
    if (patrn.exec(value) == null || value == "") {
        return false
    } else {
        return true
    }
}

//提取数字部分
function onlynumsub(msg)
{
    var num=msg.replace(/[^0-9]/ig,"");
    return num;
}

//获得图片宽度
function srcwidth(src)
{
    var theImage = new Image();
    theImage.src = src;
    return theImage.width;
}

//获得图片高度
function srcheight(src)
{
    var theImage = new Image();
    theImage.src = src;
    return theImage.height;
}

//获得文字长度
String.prototype.visualLength = function()
{
    var ruler = $("#ruler");
    ruler.text(this);
    return ruler[0].offsetWidth;
}
//获得中英文长度
function getByteLen(val) {
    var len = 0;
    for (var i = 0; i < val.length; i++) {
        var patt = new RegExp(/[^\x00-\xff]/ig);
        var a = val[i];
        if (patt.test(a))
        {
            len += 2;
        }
        else
        {
            len += 1;
        }
    }
    return len;
}

//生成用户序列号
function createfilesernum(userid) {
    var msg=userid;
    //var nowtime=new Date().Format("yyyy-MM-dd");
    var mydate = new Date();
    var month=mydate.getMonth()+1;
    var t=mydate.getFullYear()+""+month+""+mydate.getDate()+""+mydate.getHours()+""+mydate.getMinutes()+""+mydate.getSeconds();
    msg=msg+t;
    return msg;
}

//是否包含字符
function hasstring(parttxt,txt)
{
    var Cts = txt;
    if(Cts.indexOf(parttxt)>= 0) {
        return true;
    }
    else
    {
        return false;
    }
}