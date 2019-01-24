/**
 * Created by fangzheng on 2018/7/4.
 */
function checkDate(mytime){
    var DATE_FORMAT = /^[0-9]{4}-[0-1]?[0-9]{1}-[0-3]?[0-9]{1}$/;
    if(DATE_FORMAT.test(mytime)){
        return 1;
    } else {
        return 0;
    }
}