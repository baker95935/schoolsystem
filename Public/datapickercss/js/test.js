$(document).ready(function () {

    $('.date-picker').datepicker({
        //按天选择
        minView: "day", //  选择时间时，最小可以选择到那层；默认是‘hour’也可用0表示
        language: 'zh-CN', // 语言
        autoclose: true, //  true:选择时间后窗口自动关闭
        format: 'yyyy-mm-dd', // 文本框时间格式，设置为0,最后时间格式为2017-03-23 17:00:00
       // todayBtn: true, // 如果此值为true 或 "linked"，则在日期时间选择器组件的底部显示一个 "Today" 按钮用以选择当前日期。
        // 窗口可选时间从今天开始
       // endDate: new Date()
    });

    $(".dayTest").click(function () {
        $(".date-picker").remove();
        $(".input-group-addon").remove();
        var $leftInput = $('<input name="startDate" class="form-control date-picker form-control-left" style="float: left;display: block;width: 100px;height: 25px;z-index: 5;"/>');
        $(".input-group").append($leftInput);
        var $inputGroupAddon = $('<span class="input-group-addon" style="float: left;display: block;width: 10px;height: 25px;z-index: 5;"></span>');
        $(".input-group").append($inputGroupAddon);
        var $rightInput = $('<input name="endDate" class="form-control date-picker form-control-right" style="float: left;display: block;width: 100px;height: 25px;margin-top: 0px;z-index: 5;"/>');
        $(".input-group").append($rightInput);
        $('.date-picker').datepicker({
            //按天选择
            minView: "day", //  选择时间时，最小可以选择到那层；默认是‘hour’也可用0表示
            language: 'zh-CN', // 语言
            autoclose: true, //  true:选择时间后窗口自动关闭
            format: 'yyyy-mm-dd', // 文本框时间格式，设置为0,最后时间格式为2017-03-23 17:00:00
            todayBtn: true, // 如果此值为true 或 "linked"，则在日期时间选择器组件的底部显示一个 "Today" 按钮用以选择当前日期。
            // 窗口可选时间从今天开始
         //   endDate: new Date()
        });
    });

    $(".monthTest").click(function () {
        $(".date-picker").remove();
        $(".input-group-addon").remove();
        var $leftInput = $('<input name="startDate" class="form-control date-picker form-control-left" style="float: left;display: block;width: 100px;height: 25px;z-index: 5;"/>');
        $(".input-group").append($leftInput);
        var $inputGroupAddon = $('<span class="input-group-addon" style="float: left;display: block;width: 10px;height: 25px;z-index: 5;"></span>');
        $(".input-group").append($inputGroupAddon);
        var $rightInput = $('<input name="endDate" class="form-control date-picker form-control-right" style="float: left;display: block;width: 100px;height: 25px;margin-top: 0px;z-index: 5;"/>');
        $(".input-group").append($rightInput);
        $('.date-picker').datepicker({
            //按月选择
            language: "zh-CN",
            autoclose: true,
            format: "yyyy-mm",
            minViewMode: 1,
           endDate: new Date()
        });
    });

    $(".yearTest").click(function () {
        $(".date-picker").remove();
        $(".input-group-addon").remove();
        var $leftInput = $('<input name="startDate" class="form-control date-picker form-control-left" style="float: left;display: block;width: 100px;height: 25px;z-index: 5;"/>');
        $(".input-group").append($leftInput);
        var $inputGroupAddon = $('<span class="input-group-addon" style="float: left;display: block;width: 10px;height: 25px;z-index: 5;"></span>');
        $(".input-group").append($inputGroupAddon);
        var $rightInput = $('<input name="endDate" class="form-control date-picker form-control-right" style="float: left;display: block;width: 100px;height: 25px;margin-top: 0px;z-index: 5;"/>');
        $(".input-group").append($rightInput);
        $(".date-picker").datepicker({
            language: "zh-CN",
            todayHighlight: true,
            format: 'yyyy-mm',
            autoclose: true,
            startView: 'years',
            maxViewMode:'years',
            minViewMode:'years',
            endDate: new Date()
        });
    });

})

//availableDates = ['04-25-2017','04-27-2017','04-22-2017'];
//$('#date').datepicker({
//    dateFormat: 'mm-dd-yy',
//    startDate: "04-20-2017",
//    endDate: "01-01-2018",
//    beforeShowDay: function(d) {
//        var dmy = (d.getMonth()+1)
//        if(d.getMonth()<9)
//            dmy="0"+dmy;
//        dmy+= "-";
//
//        if(d.getDate()<10) dmy+="0";
//        dmy+=d.getDate() + "-" + d.getFullYear();
//
//        console.log(dmy+' : '+($.inArray(dmy, availableDates)));
//
//        if ($.inArray(dmy, availableDates) != -1) {
//            return [true, "","Available"];
//        } else{
//            return [false,"","unAvailable"];
//        }
//    },
//    todayBtn: "linked",
//    autoclose: true,
//    todayHighlight: true
//});

//
//$('.date-picker').datepicker({
//    //按月选择
//    //language: "zh-CN",
//    //autoclose: true,
//    //format: "yyyy-mm",
//    //minViewMode: 1,
//    //endDate: new Date()
//
//    //选择年份
//    //language: "zh-CN",
//    //todayHighlight: true,
//    //format: 'yyyy-mm',
//    //autoclose: true,
//    //startView: 'years',
//    //maxViewMode:'years',
//    //minViewMode:'years',
//    //endDate: new Date()
//
//    //按天选择
//    minView: "day", //  选择时间时，最小可以选择到那层；默认是‘hour’也可用0表示
//    language: 'zh-CN', // 语言
//    autoclose: true, //  true:选择时间后窗口自动关闭
//    format: 'yyyy-mm-dd', // 文本框时间格式，设置为0,最后时间格式为2017-03-23 17:00:00
//    todayBtn: true, // 如果此值为true 或 "linked"，则在日期时间选择器组件的底部显示一个 "Today" 按钮用以选择当前日期。
//    // 窗口可选时间从今天开始
//    endDate: new Date()
//
//});


////选择时间范围
////format: 'yyyy-mm-dd',
////weekStart: 1,
////startDate:new Date(2015,08,06), //开始时间，在这时间之前都不可选
////endDate:new Date(2019,08,16),//结束时间，在这时间之后都不可选
////autoclose: true,
////todayBtn: 'linked',
////language: 'zh-CN',
//beforeShowDay:function(date){
//    var d=date;
//    var curr_date=d.getDate();
//    var curr_month=d.getMonth()+1;
//    var curr_year=d.getFullYear();
//    var formatDate=curr_year+"/"+curr_month+"/"+curr_date;
//    //特殊日期的匹配
//    if($.inArray(formatDate,speciald)!=-1){
//        return {classes:'specialdays'};
//    }
//    return;
//}

//将日期转换为星期
//var date = "2017-08-19";    //此处也可以写成 17/07/2014 一样识别    也可以写成 07-17-2014  但需要正则转换
////var day = new Date(Date.parse(date));   //需要正则转换的则 此处为 ：
//var day = new Date(Date.parse(date.replace(/-/g, '/')));
//var today = new Array('星期日','星期一','星期二','星期三','星期四','星期五','星期六');
//var week = today[day.getDay()];

//最终结果为：



//    $('.form-control-left').datepicker({
//        todayBtn : "linked",
//        autoclose : true,
//        todayHighlight : true,
//        endDate : new Date()
//    }).on('changeDate',function(){
//        var startTime = new Date(2017,08,06);
//        $('.form-control-right').datepicker('setStartDate',startTime);
//    });
////结束时间：
//    $('.form-control-right').datepicker({
//        todayBtn : "linked",
//        autoclose : true,
//        todayHighlight : true,
//        endDate : new Date()
//    }).on('changeDate',function(){
//        var endTime = "2017-08-14";
//        $('.form-control-left').datepicker('setEndDate',endTime);
//    });