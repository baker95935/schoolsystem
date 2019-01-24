/**
 * Created by fangzheng on 2018/7/4.
 */



function publictestNum(str){
    var r = /^\+?[1-9][0-9]*$/;　　//判断是否为正整数
    return r.test(str);
}

//选择图片后的css样式
function imgcsssub(id)
{
    if($('#'+id).hasClass("img_choose_css"))
    {
        return false;
    }
    else
    {
        $('#'+id).attr('class','detail_title_img_css img_choose_css');
        var arr=id.split('-');
        $("img[oldid='"+arr[1]+"']").attr('class','detail_title_img_css img_choose_css');
        return true;
    }
}

//判断图片是否被选中
function justimgcsssub(id)
{
    if($('#'+id).hasClass("img_choose_css"))
    {
        return true;
    }
    else
    {
        return false;
    }
}

//取出图片的srcid
function hassrcid(srcid)
{
    if(srcid.indexOf('-')>0)
    {
        var arr=srcid.split('-');
        return arr[1];
    }else
    {
        return srcid;
    }
}

