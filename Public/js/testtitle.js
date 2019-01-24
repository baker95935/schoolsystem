//鼠标移动
$("#choose_img").ready(function(){
    $("#choose_img").mousemove(function(e){
        var x=e.pageX;
        var y=e.pageY;

        if($('#reimgkind').val()=='pic'){

            if($('#addpickind').val()=='a')
            {
                newPos=new Object();
                newPos.left= x-20;
                newPos.top= y-20;
                $('#add_pic_div_a').offset(newPos);
            }
            if($('#addpickind').val()=='b')
            {
                newPos=new Object();
                newPos.left= x+20;
                newPos.top= y+20;
                $('#add_pic_div_b').offset(newPos);
            }
            if($('#addpickind').val()=='none')
            {
            }

        }
        else
        {
            $('#title_div').css('display','none');

            if($('#titlechoose').val()==1){
                if(x>parseInt($('#level1_Div').offset().left) && x<parseInt($('#level1_Div').offset().left)+385)
                {
                    $("#level1_Div").addClass("rule_div_checked");
                    $("#level2_Div").addClass("rule_div_checked");
                    $("#level3_Div").addClass("rule_div_checked");
                    $("#level4_Div").addClass("rule_div_checked");
                    $("#level5_Div").addClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("no1");
                }

                if(x>parseInt($('#link_Div').offset().left) && x<parseInt($('#link_Div').offset().left)+38 )
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").addClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("link");
                }
                if(x>parseInt($('#Del_Div').offset().left) && x<parseInt($('#Del_Div').offset().left)+38 )
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").addClass("rule_div_checked");
                    $('#nowleveldiv').val("del");
                }

                auto_title_display(1,y);

            }

            if($('#titlechoose').val()==2){
                if(x>parseInt($('#level1_Div').offset().left) && x<parseInt($('#level1_Div').offset().left)+154)
                {
                    $("#level1_Div").addClass("rule_div_checked");
                    $("#level2_Div").addClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("no1");
                }
                if(x>parseInt($('#level3_Div').offset().left) && x<parseInt($('#level3_Div').offset().left)+231)
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").addClass("rule_div_checked");
                    $("#level4_Div").addClass("rule_div_checked");
                    $("#level5_Div").addClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("no2");
                }


                if(x>parseInt($('#link_Div').offset().left) && x<parseInt($('#link_Div').offset().left)+38 )
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").addClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("link");


                }
                if(x>parseInt($('#Del_Div').offset().left) && x<parseInt($('#Del_Div').offset().left)+38 )
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").addClass("rule_div_checked");
                    $('#nowleveldiv').val("del");
                }
                auto_title_display(2,y);
            }

            if($('#titlechoose').val()==3){
                if(x>parseInt($('#level1_Div').offset().left) && x<parseInt($('#level1_Div').offset().left)+77)
                {
                    $("#level1_Div").addClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("no1");
                }
                if(x>parseInt($('#level2_Div').offset().left) && x<parseInt($('#level2_Div').offset().left)+154)
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").addClass("rule_div_checked");
                    $("#level3_Div").addClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("no2");
                }
                if(x>parseInt($('#level4_Div').offset().left) && x<parseInt($('#level4_Div').offset().left)+154)
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").addClass("rule_div_checked");
                    $("#level5_Div").addClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("no3");
                }


                if(x>parseInt($('#link_Div').offset().left) && x<parseInt($('#link_Div').offset().left)+38 )
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").addClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("link");


                }
                if(x>parseInt($('#Del_Div').offset().left) && x<parseInt($('#Del_Div').offset().left)+38 )
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").addClass("rule_div_checked");
                    $('#nowleveldiv').val("del");
                }
                auto_title_display(3,y);
            }

            if($('#titlechoose').val()==4){
                if(x>parseInt($('#level1_Div').offset().left) && x<parseInt($('#level1_Div').offset().left)+77)
                {
                    $("#level1_Div").addClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("no1");
                }
                if(x>parseInt($('#level2_Div').offset().left) && x<parseInt($('#level2_Div').offset().left)+77)
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").addClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("no2");
                }
                if(x>parseInt($('#level3_Div').offset().left) && x<parseInt($('#level3_Div').offset().left)+77)
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").addClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("no3");
                }

                if(x>parseInt($('#level4_Div').offset().left) && x<parseInt($('#level4_Div').offset().left)+154)
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").addClass("rule_div_checked");
                    $("#level5_Div").addClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("no4");
                }


                if(x>parseInt($('#link_Div').offset().left) && x<parseInt($('#link_Div').offset().left)+38 )
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").addClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("link");


                }
                if(x>parseInt($('#Del_Div').offset().left) && x<parseInt($('#Del_Div').offset().left)+38 )
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").addClass("rule_div_checked");
                    $('#nowleveldiv').val("del");
                }

                auto_title_display(4,y);
            }

            if($('#titlechoose').val()==5){
                if(x>parseInt($('#level1_Div').offset().left) && x<parseInt($('#level1_Div').offset().left)+77)
                {
                    $("#level1_Div").addClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("no1");
                }
                if(x>parseInt($('#level2_Div').offset().left) && x<parseInt($('#level2_Div').offset().left)+77)
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").addClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("no2");
                }
                if(x>parseInt($('#level3_Div').offset().left) && x<parseInt($('#level3_Div').offset().left)+77)
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").addClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("no3");
                }

                if(x>parseInt($('#level4_Div').offset().left) && x<parseInt($('#level4_Div').offset().left)+77)
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").addClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("no4");
                }

                if(x>parseInt($('#level5_Div').offset().left) && x<parseInt($('#level5_Div').offset().left)+77)
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").addClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("no5");
                }


                if(x>parseInt($('#link_Div').offset().left) && x<parseInt($('#link_Div').offset().left)+38 )
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").addClass("rule_div_checked");
                    $("#Del_Div").removeClass("rule_div_checked");
                    $('#nowleveldiv').val("link");


                }
                if(x>parseInt($('#Del_Div').offset().left) && x<parseInt($('#Del_Div').offset().left)+38 )
                {
                    $("#level1_Div").removeClass("rule_div_checked");
                    $("#level2_Div").removeClass("rule_div_checked");
                    $("#level3_Div").removeClass("rule_div_checked");
                    $("#level4_Div").removeClass("rule_div_checked");
                    $("#level5_Div").removeClass("rule_div_checked");
                    $("#link_Div").removeClass("rule_div_checked");
                    $("#Del_Div").addClass("rule_div_checked");
                    $('#nowleveldiv').val("del");
                }
                auto_title_display(5,y);
            }
        hrlocal(y);
    }
    });

});
//当序号级别为1级的时候，一级序号排序1，2在前
function no1aselect(id) {
    $('#no'+id).append("<option value='t14'>1,2</option>");
    $('#no'+id).append("<option value='t16'>(1)(2)</option>");
    $('#no'+id).append("<option value='t15'>1),2)</option>");
    $('#no'+id).append("<option value='t10'>a,b</option>");
    $('#no'+id).append("<option value='t11'>A,B</option>");
    $('#no'+id).append("<option value='t18'>a)b)</option>");
    $('#no'+id).append("<option value='t19'>(a)(b)</option>");
    $('#no'+id).append("<option value='t17'>Ⅰ,Ⅱ</option>");
    $('#no'+id).append("<option value='t12'>一、二</option>");
    $('#no'+id).append("<option value='t13'>(一)(二)</option>");
    $('#no'+id).append("<option value='t20'>No1,No2</option>");
    $('#no'+id).append("<option value='t7'>Part1</option>");
    $('#no'+id).append("<option value='t8'>PartA</option>");
    $('#no'+id).append("<option value='t9'>PartⅠ</option>");
    $('#no'+id).append("<option value='t3'>第一节</option>");
    $('#no'+id).append("<option value='t4'>第1节</option>");
    $('#no'+id).append("<option value='t5'>第一部分</option>");
    $('#no'+id).append("<option value='t6'>第1部分</option>");
    $('#no'+id).append("<option value='t1'>第一章</option>");
    $('#no'+id).append("<option value='t2'>第1章</option>");
    $('#no'+id).val(0);

}
//当序号级别为1级的时候，一级序号排序（1）（2）在前
function no1bselect(id) {
    $('#no'+id).append("<option value='t16'>(1)(2)</option>");
    $('#no'+id).append("<option value='t14'>1,2</option>");
    $('#no'+id).append("<option value='t15'>1),2)</option>");
    $('#no'+id).append("<option value='t10'>a,b</option>");
    $('#no'+id).append("<option value='t11'>A,B</option>");
    $('#no'+id).append("<option value='t18'>a)b)</option>");
    $('#no'+id).append("<option value='t19'>(a)(b)</option>");
    $('#no'+id).append("<option value='t17'>Ⅰ,Ⅱ</option>");
    $('#no'+id).append("<option value='t12'>一、二</option>");
    $('#no'+id).append("<option value='t13'>(一)(二)</option>");
    $('#no'+id).append("<option value='t20'>No1,No2</option>");
    $('#no'+id).append("<option value='t7'>Part1</option>");
    $('#no'+id).append("<option value='t8'>PartA</option>");
    $('#no'+id).append("<option value='t9'>PartⅠ</option>");
    $('#no'+id).append("<option value='t3'>第一节</option>");
    $('#no'+id).append("<option value='t4'>第1节</option>");
    $('#no'+id).append("<option value='t5'>第一部分</option>");
    $('#no'+id).append("<option value='t6'>第1部分</option>");
    $('#no'+id).append("<option value='t1'>第一章</option>");
    $('#no'+id).append("<option value='t2'>第1章</option>");
    $('#no'+id).val(0);

}
//当序号级别为2级的时候，一级序号排序
function no2select(id) {
    $('#no'+id).append("<option value='t14'>1,2</option>");
    $('#no'+id).append("<option value='t15'>1)2)</option>");
    $('#no'+id).append("<option value='t12'>一、二</option>");
    $('#no'+id).append("<option value='t13'>(一)(二)</option>");
    $('#no'+id).append("<option value='t10'>a,b</option>");
    $('#no'+id).append("<option value='t11'>A,B</option>");
    $('#no'+id).append("<option value='t20'>No1,No2</option>");
    $('#no'+id).append("<option value='t17'>Ⅰ,Ⅱ</option>");
    $('#no'+id).append("<option value='t18'>a)b)</option>");
    $('#no'+id).append("<option value='t19'>(a)(b)</option>");
    $('#no'+id).append("<option value='t16'>(1)(2)</option>");
    $('#no'+id).append("<option value='t7'>Part1</option>");
    $('#no'+id).append("<option value='t8'>PartA</option>");
    $('#no'+id).append("<option value='t9'>PartⅠ</option>");
    $('#no'+id).append("<option value='t5'>第一部分</option>");
    $('#no'+id).append("<option value='t6'>第1部分</option>");
    $('#no'+id).append("<option value='t3'>第一节</option>");
    $('#no'+id).append("<option value='t4'>第1节</option>");
    $('#no'+id).append("<option value='t1'>第一章</option>");
    $('#no'+id).append("<option value='t2'>第1章</option>");
    $('#no'+id).val(0);
}
//当序号级别为3级的时候，一级序号排序
function no3select(id) {

    $('#no'+id).append("<option value='t12'>一,二</option>");
    $('#no'+id).append("<option value='t13'>（一)(二)</option>");
    $('#no'+id).append("<option value='t14'>1，2</option>");
    $('#no'+id).append("<option value='t15'>1）2）</option>");
    $('#no'+id).append("<option value='t11'>A、B</option>");

    $('#no'+id).append("<option value='t10'>a,b</option>");
    $('#no'+id).append("<option value='t7'>Part1</option>");
    $('#no'+id).append("<option value='t8'>PartA</option>");
    $('#no'+id).append("<option value='t9'>PartⅠ</option>");
    $('#no'+id).append("<option value='t17'>Ⅰ,Ⅱ</option>");

    $('#no'+id).append("<option value='t18'>a)b)</option>");
    $('#no'+id).append("<option value='t19'>(a)(b)</option>");
    $('#no'+id).append("<option value='t20'>No1</option>");
    $('#no'+id).append("<option value='t5'>第一部分</option>");
    $('#no'+id).append("<option value='t6'>第1部分</option>");

    $('#no'+id).append("<option value='t3'>第一节</option>");
    $('#no'+id).append("<option value='t4'>第1节</option>");
    $('#no'+id).append("<option value='t1'>第一章</option>");
    $('#no'+id).append("<option value='t2'>第1章</option>");
    $('#no'+id).append("<option value='t16'>(1)(2)</option>");


    $('#no'+id).val(0);
}
//当序号级别为4级的时候，一级序号排序
function no4select(id) {

    $('#no'+id).append("<option value='t5'>第一部分</option>");
    $('#no'+id).append("<option value='t6'>第1部分</option>");
    $('#no'+id).append("<option value='t3'>第一节</option>");
    $('#no'+id).append("<option value='t4'>第1节</option>");
    $('#no'+id).append("<option value='t1'>第一章</option>");

    $('#no'+id).append("<option value='t2'>第1章</option>");
    $('#no'+id).append("<option value='t7'>Part1</option>");
    $('#no'+id).append("<option value='t8'>PartA</option>");
    $('#no'+id).append("<option value='t9'>PartⅠ</option>");
    $('#no'+id).append("<option value='t17'>Ⅰ,Ⅱ</option>");

    $('#no'+id).append("<option value='t10'>a,b</option>");
    $('#no'+id).append("<option value='t11'>A,B</option>");
    $('#no'+id).append("<option value='t12'>一,二</option>");
    $('#no'+id).append("<option value='t13'>(一)(二)</option>");
    $('#no'+id).append("<option value='t14'>1，2</option>");

    $('#no'+id).append("<option value='t15'>1）2）</option>");
    $('#no'+id).append("<option value='t16'>(1)(2)</option>");
    $('#no'+id).append("<option value='t18'>a)b)</option>");
    $('#no'+id).append("<option value='t19'>(a)(b)</option>");
    $('#no'+id).append("<option value='t20'>No1</option>");



    $('#no'+id).val(0);
}
//当序号级别为5级的时候，一级序号排序
function no5select(id) {

    $('#no'+id).append("<option value='t1'>第一章</option>");
    $('#no'+id).append("<option value='t2'>第1章</option>");
    $('#no'+id).append("<option value='t3'>第一节</option>");
    $('#no'+id).append("<option value='t4'>第1节</option>");
    $('#no'+id).append("<option value='t5'>第一部分</option>");

    $('#no'+id).append("<option value='t6'>第1部分</option>");
    $('#no'+id).append("<option value='t7'>Part1</option>");
    $('#no'+id).append("<option value='t8'>PartA</option>");
    $('#no'+id).append("<option value='t9'>PartⅠ</option>");
    $('#no'+id).append("<option value='t20'>No1</option>");

    $('#no'+id).append("<option value='t10'>a,b</option>");
    $('#no'+id).append("<option value='t11'>A,B</option>");
    $('#no'+id).append("<option value='t12'>一、二</option>");
    $('#no'+id).append("<option value='t13'>(一)(二)</option>");
    $('#no'+id).append("<option value='t14'>1，2</option>");

    $('#no'+id).append("<option value='t15'>1)2)</option>");
    $('#no'+id).append("<option value='t16'>(1)(2)</option>");
    $('#no'+id).append("<option value='t17'>Ⅰ,Ⅱ</option>");
    $('#no'+id).append("<option value='t18'>a)b)</option>");
    $('#no'+id).append("<option value='t19'>(a)(b)</option>");


    $('#no'+id).val(0);
}
//清空选项栏
function emptyselect(id) {

    $("#no"+id+" option[value='t1']").remove();
    $("#no"+id+" option[value='t2']").remove();
    $("#no"+id+" option[value='t3']").remove();
    $("#no"+id+" option[value='t4']").remove();
    $("#no"+id+" option[value='t5']").remove();
    $("#no"+id+" option[value='t6']").remove();
    $("#no"+id+" option[value='t7']").remove();
    $("#no"+id+" option[value='t8']").remove();
    $("#no"+id+" option[value='t9']").remove();
    $("#no"+id+" option[value='t10']").remove();
    $("#no"+id+" option[value='t11']").remove();
    $("#no"+id+" option[value='t12']").remove();
    $("#no"+id+" option[value='t13']").remove();
    $("#no"+id+" option[value='t14']").remove();
    $("#no"+id+" option[value='t15']").remove();
    $("#no"+id+" option[value='t16']").remove();
    $("#no"+id+" option[value='t17']").remove();
    $("#no"+id+" option[value='t18']").remove();
    $("#no"+id+" option[value='t19']").remove();
    $("#no"+id+" option[value='t20']").remove();
    $("#no"+id+" option[value='0']").remove();

}
//清空select选项
function emptyselectser(id) {
    $("#no"+id+" option[value='t1']").remove();
    $("#no"+id+" option[value='t2']").remove();
    $("#no"+id+" option[value='t3']").remove();
    $("#no"+id+" option[value='t4']").remove();
    $("#no"+id+" option[value='t5']").remove();
    $("#no"+id+" option[value='t6']").remove();
    $("#no"+id+" option[value='t7']").remove();
    $("#no"+id+" option[value='t8']").remove();
    $("#no"+id+" option[value='t9']").remove();
    $("#no"+id+" option[value='t10']").remove();
    $("#no"+id+" option[value='t11']").remove();
    $("#no"+id+" option[value='t12']").remove();
    $("#no"+id+" option[value='t13']").remove();
    $("#no"+id+" option[value='t14']").remove();
    $("#no"+id+" option[value='t15']").remove();
    $("#no"+id+" option[value='t16']").remove();
    $("#no"+id+" option[value='t17']").remove();
    $("#no"+id+" option[value='t18']").remove();
    $("#no"+id+" option[value='t19']").remove();
    $("#no"+id+" option[value='t20']").remove();
    $("#no"+id+" option[value='0']").remove();

}
//绑定select选项
function bindselect(level) {
    if(level==1)
    {
        emptyselect(1);

        $('#no1').append("<option value='0'>一级标题</option>");
        no1aselect(1);

    }
    if(level==2)
    {
        emptyselect(1);
        emptyselect(2);

        $('#no1').append("<option value='0'>一级标题</option>");
        $('#no2').append("<option value='0'>二级标题</option>");


        no2select(1);
        no1bselect(2);
    }

    if(level==3)
    {

        emptyselect(1);
        emptyselect(2);
        emptyselect(3);

        $('#no1').append("<option value='0'>一级标题</option>");
        $('#no2').append("<option value='0'>二级标题</option>");
        $('#no3').append("<option value='0'>三级标题</option>");


        no3select(1);
        no2select(2);
        no1bselect(3);
    }

    if(level==4)
    {

        emptyselect(1);
        emptyselect(2);
        emptyselect(3);
        emptyselect(4);

        $('#no1').append("<option value='0'>一级标题</option>");
        $('#no2').append("<option value='0'>二级标题</option>");
        $('#no3').append("<option value='0'>三级标题</option>");
        $('#no4').append("<option value='0'>四级标题</option>");


        no4select(1);
        no3select(2);
        no2select(3);
        no1bselect(4);
    }

    if(level==5)
    {

        emptyselect(1);
        emptyselect(2);
        emptyselect(3);
        emptyselect(4);
        emptyselect(5);

        $('#no1').append("<option value='0'>一级标题</option>");
        $('#no2').append("<option value='0'>二级标题</option>");
        $('#no3').append("<option value='0'>三级标题</option>");
        $('#no4').append("<option value='0'>四级标题</option>");
        $('#no5').append("<option value='0'>五级标题</option>");


        no5select(1);
        no4select(2);
        no3select(3);
        no2select(4);
        no1bselect(5);
    }



}
//绑定标题级别
function testtitle() {
    var selectnum=$('#titlechoose').val();
    if(selectnum==0){

        $('#no1').css('display','none');
        $('#no2').css('display','none');
        $('#no3').css('display','none');
        $('#no4').css('display','none');
        $('#no5').css('display','none');
        $("#mytitleser").val(1);
        $("#mytitleser").empty();
        $("#mytitleser").append("<option value='0'>未选择</option>");
    }


    if(selectnum==1){
        $('#no2').css('display','none');
        $('#no3').css('display','none');
        $('#no4').css('display','none');
        $('#no5').css('display','none');
        $('#no1').css('display','');

        bindselect(1);

        $("#mytitleser").empty();

        $("#mytitleser").append("<option value='1'>一级排序</option>");
        $("#mytitleser").val(1);



    }
    if(selectnum==2){

        $('#no1').css('display','');
        $('#no2').css('display','');
        $('#no3').css('display','none');
        $('#no4').css('display','none');
        $('#no5').css('display','none');

        bindselect(2);

        $("#mytitleser").empty();

        $("#mytitleser").append("<option value='1'>一级排序</option>");
        $("#mytitleser").append("<option value='2'>二级排序</option>");

        $("#mytitleser").val(2);

    }
    if(selectnum==3){
        $('#no1').css('display','');
        $('#no2').css('display','');
        $('#no3').css('display','');
        $('#no4').css('display','none');
        $('#no5').css('display','none');

        bindselect(3);

        $("#mytitleser").empty();

        $("#mytitleser").append("<option value='1'>一级排序</option>");
        $("#mytitleser").append("<option value='2'>二级排序</option>");
        $("#mytitleser").append("<option value='3'>三级排序</option>");

        $("#mytitleser").val(2);
    }
    if(selectnum==4){

        $('#no1').css('display','');
        $('#no2').css('display','');
        $('#no3').css('display','');
        $('#no4').css('display','');
        $('#no5').css('display','none');

        bindselect(4);

        $("#mytitleser").empty();

        $("#mytitleser").append("<option value='1'>一级排序</option>");
        $("#mytitleser").append("<option value='2'>二级排序</option>");
        $("#mytitleser").append("<option value='3'>三级排序</option>");
        $("#mytitleser").append("<option value='4'>四级排序</option>");

        $("#mytitleser").val(3);
    }
    if(selectnum==5){

        $('#no1').css('display','');
        $('#no2').css('display','');
        $('#no3').css('display','');
        $('#no4').css('display','');
        $('#no5').css('display','');

        bindselect(5);

        $("#mytitleser").empty();

        $("#mytitleser").append("<option value='1'>一级排序</option>");
        $("#mytitleser").append("<option value='2'>二级排序</option>");
        $("#mytitleser").append("<option value='3'>三级排序</option>");
        $("#mytitleser").append("<option value='4'>四级排序</option>");
        $("#mytitleser").append("<option value='5'>五级排序</option>");

        $("#mytitleser").val(4);
    }
}
//返回序号类型，比如章，节
function titlekind(val) {
    var msg='';
    switch (val)
    {
        case 't1':msg='一章';break;
        case 't2':msg='1章';break;
        case 't3':msg='一节';break;
        case 't4':msg='1节';break;
        case 't5':msg='一部';break;
        case 't6':msg='1部';break;
        case 't7':msg='Part1';break;
        case 't8':msg='PartA';break;
        case 't9':msg='PartⅠ';break;
        case 't10':msg='-a-';break;
        case 't11':msg='-A-';break;
        case 't12':msg=',一';break;
        case 't13':msg='(一)';break;
        case 't14':msg='-1-';break;
        case 't15':msg='1)';break;
        case 't16':msg='(1)';break;
        case 't17':msg='-Ⅱ-';break;
        case 't18':msg='a)';break;
        case 't19':msg='(a)';break;
        case 't20':msg='No1';break;
    }
    return msg;
}
//导航初始化
function initnavdiv() {
    $("#level1_Div").removeClass("rule_div_checked");
    $("#level2_Div").removeClass("rule_div_checked");
    $("#level3_Div").removeClass("rule_div_checked");
    $("#level4_Div").removeClass("rule_div_checked");
    $("#level5_Div").removeClass("rule_div_checked");
    $("#link_Div").removeClass("rule_div_checked");
    $("#Del_Div").removeClass("rule_div_checked");

    $("#level2_Div").css('border-left','0px solid #7e8cc9');
    $("#level3_Div").css('border-left','0px solid #7e8cc9');
    $("#level4_Div").css('border-left','0px solid #7e8cc9');
    $("#level5_Div").css('border-left','0px solid #7e8cc9');

    $("#msg_no1").text('');
    $("#msg_no2").text('');
    $("#msg_no3").text('');
    $("#msg_no4").text('');
    $("#msg_no5").text('');
}
//习题序号子选项
function childselect(id){
    var val=parseInt($('#titlechoose').val());
    if(val==1)
    {
        $("#msg_no3").text("No1"+titlekind($('#no1').val()));
    }
    if(val==2)
    {
        if(id=='no1')
        {
        $("#msg_no1").text("No1"+titlekind($('#no1').val()));
        }
        if(id=='no2')
        {
         $("#msg_no3").text("No2"+titlekind($('#no2').val()));
        }
    }
    if(val==3)
    {
        if(id=='no1')
        {
            $("#msg_no1").text("No1"+titlekind($('#no1').val()));
        }
        if(id=='no2')
        {
            $("#msg_no2").text("No2"+titlekind($('#no2').val()));
        }
        if(id=='no3')
        {
            $("#msg_no4").text("No3"+titlekind($('#no3').val()));
        }
    }
    if(val==4)
    {
        if(id=='no1')
        {
            $("#msg_no1").text("No1"+titlekind($('#no1').val()));
        }
        if(id=='no2')
        {
            $("#msg_no2").text("No2"+titlekind($('#no2').val()));
        }
        if(id=='no3')
        {
            $("#msg_no3").text("No3"+titlekind($('#no3').val()));
        }
        if(id=='no4')
        {
            $("#msg_no4").text("No4"+titlekind($('#no4').val()));
        }
    }
    if(val==5)
    {
        if(id=='no1')
        {
            $("#msg_no1").text("No1"+titlekind($('#no1').val()));
        }
        if(id=='no2')
        {
            $("#msg_no2").text("No2"+titlekind($('#no2').val()));
        }
        if(id=='no3')
        {
            $("#msg_no3").text("No3"+titlekind($('#no3').val()));
        }
        if(id=='no4')
        {
            $("#msg_no4").text("No4"+titlekind($('#no4').val()));
        }
        if(id=='no5')
        {
            $("#msg_no5").text("No5"+titlekind($('#no5').val()));
        }
    }

}
//显示当前题号
function navval(level) {
    removenav();
    if(level==5) {
        $('#tnum1').text(retitlekind($('#no1').val(), $('#num1').val(), 0));
        $('#tnum2').text(retitlekind($('#no2').val(), $('#num2').val(), 0));
        $('#tnum3').text(retitlekind($('#no3').val(), $('#num3').val(), 0));
        $('#tnum4').text(retitlekind($('#no4').val(), $('#num4').val(), 0));
        $('#tnum5').text(retitlekind($('#no5').val(), $('#num5').val(), 0));
        $('#tnum5').addClass('nownavmsg');
    }
    if(level==4) {
        $('#tnum1').text(retitlekind($('#no1').val(), $('#num1').val(), 0));
        $('#tnum2').text(retitlekind($('#no2').val(), $('#num2').val(), 0));
        $('#tnum3').text(retitlekind($('#no3').val(), $('#num3').val(), 0));
        $('#tnum4').text(retitlekind($('#no4').val(), $('#num4').val(), 0));
        $('#tnum5').text('');
        $('#tnum4').addClass('nownavmsg');
    }
    if(level==3) {
        $('#tnum1').text(retitlekind($('#no1').val(), $('#num1').val(), 0));
        $('#tnum2').text(retitlekind($('#no2').val(), $('#num2').val(), 0));
        $('#tnum3').text(retitlekind($('#no3').val(), $('#num3').val(), 0));
        $('#tnum4').text('');
        $('#tnum5').text('');
        $('#tnum3').addClass('nownavmsg');

    }
    if(level==2) {
        $('#tnum1').text(retitlekind($('#no1').val(), $('#num1').val(), 0));
        $('#tnum2').text(retitlekind($('#no2').val(), $('#num2').val(), 0));
        $('#tnum3').text('');
        $('#tnum4').text('');
        $('#tnum5').text('');
        $('#tnum2').addClass('nownavmsg');
    }
    if(level==1) {
        $('#tnum1').text(retitlekind($('#no1').val(), $('#num1').val(), 0));
        $('#tnum2').text('');
        $('#tnum3').text('');
        $('#tnum4').text('');
        $('#tnum5').text('');
        $('#tnum1').addClass('nownavmsg');
    }
}
//全部移除选中样式
function removenav() {
    $('#tnum1').removeClass('nownavmsg');
    $('#tnum2').removeClass('nownavmsg');
    $('#tnum3').removeClass('nownavmsg');
    $('#tnum4').removeClass('nownavmsg');
    $('#tnum5').removeClass('nownavmsg');
}
//显示习题号码（左侧）
function displaynotesub(num,x,y,msg){
    if(num==1)
    {
        $('#numdisplay').css('display','');
    }
    else
    {
            $('#numdisplay').css('display','none');
    }
    newPos=new Object();
    newPos.left= x-30;
    newPos.top= y+10;
    $('#numdisplay').offset(newPos);

    $('#notenum').text(msg);
}
function displaynotesubtitle(id) {
    var id=parseInt(id);
    switch(id){
        case 1: $('#notenum').text($('#title_div_chlid1').text());break;
        case 2: $('#notenum').text($('#title_div_chlid2').text());break;
        case 3: $('#notenum').text($('#title_div_chlid3').text());break;
        case 4: $('#notenum').text($('#title_div_chlid4').text());break;
        case 5: $('#notenum').text('None');break;
    }
}
function closetitle() {
        $('#test_or_answer').text('(A)');
        $('#notenum').text('');
        $('#title_div').css('display','none');
        // hiddennav();
}
////分割线
function cutline() {

}
//初始化hr
function inithr(){
    var x=$('#choose_img').offset().left;
    var y=$('#choose_img').offset().top;

    newPos=new Object();
    newPos.left= x;
    newPos.top= y;
    $('#rule_hr').offset(newPos);
}
//hr的位置
function hrlocal(y){
    var min_y=parseInt($('#hr_y').val());
    var x=$('#choose_img').offset().left;
    newPos=new Object();
    newPos.left= x;
    newPos.top= y-8;
    $('#rule_hr').offset(newPos);
    $('#rule_hr').css('display','block');
}
//hr的重新设定位置
function rehrlocal(){
    var x=$('#choose_img').offset().left;
    newPos=new Object();
    newPos.left= x;
    newPos.top= $('#hr_y').val();
    $('#rule_hr').offset(newPos);
    $('#rule_hr').css('display','block');

}
//finishdiv初始化
function initfinishdiv(){
    var x=$('#choose_img').offset().left;
    var y=$('#choose_img').offset().top;
    newPos=new Object();
    newPos.left= x;
    newPos.top= y;
    $('#finish_div').offset(newPos);
    $('#finish_div').css('height','0');
}
//finishdiv框区
function finishdiv(){
    var x=$('#choose_img').offset().left;
    var y=$('#choose_img').offset().top;
    var y1= $('#rule_hr').offset().top;
    var heightnum=parseInt(y1)-parseInt(y);
    newPos=new Object();
    newPos.left= x;
    newPos.top= y;
    $('#finish_div').offset(newPos);
    $('#finish_div').css('height',heightnum);
}
//右侧显示数字位置
function rightnumsub(height) {
    newPos=new Object();
    newPos.left= $('#numdisplay').offset().left;
    newPos.top= parseInt($('#finish_div').offset().top)+parseInt(height);
    $('#numdisplay').offset(newPos);
}
//banner,init显示
function initdisplay(){
    $('#initdiv').css('display','');
    $('#resetdiv').css('display','none');
}
//banner,reset显示
function resetdisplay(){
    $('#initdiv').css('display','none');
    $('#resetdiv').css('display','');
    new_nosub();

}
//banner,intreset设置
function intresetdisplay(){
    var num=$('#titlechoose').val();

    $('#set_no1').val('');
    $('#set_no2').val('');
    $('#set_no3').val('');
    $('#set_no4').val('');
    $('#set_no5').val('');

    switch(num)
    {
        case 1:
            $('#set_no1').css('display','');
            $('#set_no2').css('display','none');
            $('#set_no3').css('display','none');
            $('#set_no4').css('display','none');
            $('#set_no5').css('display','none');
            break;
        case 2:
            $('#set_no1').css('display','');
            $('#set_no2').css('display','');
            $('#set_no3').css('display','none');
            $('#set_no4').css('display','none');
            $('#set_no5').css('display','none');
            break;
        case 3:
            $('#set_no1').css('display','');
            $('#set_no2').css('display','');
            $('#set_no3').css('display','');
            $('#set_no4').css('display','none');
            $('#set_no5').css('display','none');
            break;
        case 4:
            $('#set_no1').css('display','');
            $('#set_no2').css('display','');
            $('#set_no3').css('display','');
            $('#set_no4').css('display','');
            $('#set_no5').css('display','none');
            break;
        case 5:
            $('#set_no1').css('display','');
            $('#set_no2').css('display','');
            $('#set_no3').css('display','');
            $('#set_no4').css('display','');
            $('#set_no5').css('display','');
            break;
    }


}
//重新设置数字
function resetnum(){
    if($('#titlechoose').val()=='1' || num1==0)
    {
        var num1=$('#set_no1').val();

        if(isPositiveInteger(num1)==false)
        {
            alert('请输入合法序号！！');
            return;
        }
         num1=parseInt(num1)-1;
        $('#num1').val(num1);
    }
    if($('#titlechoose').val()=='2')
    {
        var num1=$('#set_no1').val();
        var num2=$('#set_no2').val();
        if(isPositiveInteger(num1)==false || isPositiveInteger(num2)==false || num1==0 || num2==0 )
        {
            alert('请输入合法序号！！');
            return;
        }
        num2=parseInt(num2)-1;
        $('#num1').val(num1);
        $('#num2').val(num2);
    }
    if($('#titlechoose').val()=='3')
    {
        var num1=$('#set_no1').val();
        var num2=$('#set_no2').val();
        var num3=$('#set_no3').val();
        if(isPositiveInteger(num1)==false || isPositiveInteger(num2)==false  || isPositiveInteger(num3)==false  || num1==0 || num2==0 || num3==0)
        {
            alert('请输入合法序号！！');
            return;
        }
        num3=parseInt(num3)-1;
        $('#num1').val(num1);
        $('#num2').val(num2);
        $('#num3').val(num3);
    }
    if($('#titlechoose').val()=='4')
    {
        var num1=$('#set_no1').val();
        var num2=$('#set_no2').val();
        var num3=$('#set_no3').val();
        var num4=$('#set_no4').val();

        if(isPositiveInteger(num1)==false || isPositiveInteger(num2)==false  || isPositiveInteger(num3)==false || isPositiveInteger(num4)==false  || num1==0 || num2==0 || num3==0 || num4==0 )
        {
            alert('请输入合法序号！！');
            return;
        }

        num4=parseInt(num4)-1;

        $('#num1').val(num1);
        $('#num2').val(num2);
        $('#num3').val(num3);
        $('#num4').val(num4);
    }
    if($('#titlechoose').val()=='5')
    {
        var num1=$('#set_no1').val();
        var num2=$('#set_no2').val();
        var num3=$('#set_no3').val();
        var num4=$('#set_no4').val();
        var num5=$('#set_no5').val();
        if(isPositiveInteger(num1)==false || isPositiveInteger(num2)==false  || isPositiveInteger(num3)==false || isPositiveInteger(num4)==false  || isPositiveInteger(num5)==false || num1==0 || num2==0 || num3==0 || num4==0 || num5==0)
        {
            alert('请输入合法序号！！');
            return;
        }
        num5=parseInt(num5)-1;
        $('#num1').val(num1);
        $('#num2').val(num2);
        $('#num3').val(num3);
        $('#num4').val(num4);
        $('#num5').val(num5);
    }
    $('#begin_or_not').val(0);
    initselect();
    navval($('#titlechoose').val());
    $('#finish_div').css('height','0');
    //标题独立的级别
}
function isPositiveInteger(s){//是否为正整数
    var re = /^[0-9]+$/ ;
    return re.test(s)
}