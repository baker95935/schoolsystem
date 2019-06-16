<?php

/**
 * Created by PhpStorm.
 * User: fangzheng
 * Date: 2018/1/25
 * Time: 上午9:27
 */
function home_func()
{
    echo "前台模块".__FUNCTION__;
}


function saveasfile($oldsrc,$newsrc,$filepath)
{
    if(!file_exists($filepath)) {
        mkdir($filepath);
    }
    $command = './Public/cfile/saveasfile '.$oldsrc.' '.$newsrc;
    return $result = exec($command);
}




function trimall($str)//删除空格
{
    $oldchar=array(" ","　","\t","\n","\r");
    $newchar=array("","","","","");
    return str_replace($oldchar,$newchar,$str);
}



//去掉习题的相同部分
function uniquearray($arr)
{
    $count=sizeof($arr);
    $newarr=$arr;

    for($i=0;$i<$count;$i++)
    {
        $filesernum=$arr[$i]['filesernum'];
        $typeid=$arr[$i]['typeid'];

        $newcount=sizeof($newarr);

        for($m=$i+1;$m<$newcount;$m++)
        {
            if($filesernum==$newarr[$m]['filesernum'] && $typeid==$newarr[$m]['typeid'])
            {
                $newarr[$m]['id']='del';
            }
        }
    }

    $k=0;
    for($n=0;$n<$count;$n++)
    {
        if($newarr[$n]['id']!='del')
        {
            $outputarr[$k]['id']=$newarr[$n]['id'];
            $outputarr[$k]['testid']=$newarr[$n]['testid'];
            $outputarr[$k]['testname']=$newarr[$n]['testname'];
            $outputarr[$k]['filesernum']=$newarr[$n]['filesernum'];
            $outputarr[$k]['typeid']=$newarr[$n]['typeid'];

            $k=$k+1;
        }
    }

    return $outputarr;


}



//去掉数组中的相同部分
//function uniquearray01($arr)
//{
//    $count=sizeof($arr);
//
//    $newarr[0]['id']=0;
//    $newarr[0]['testid']=0;
//    $newarr[0]['testname']=0;
//    $newarr[0]['filesernum']=0;
//    $newarr[0]['typeid']=0;
//
//    $kind=0;
//    $testkind=1;
//    $m=0;
//
//    for($i=0;$i<$count;$i++)
//    {
//
//
//        if($kind==0)
//        {
//            $newarr[$m]['id']=$arr[$i]['id'];
//            $newarr[$m]['testid']=$arr[$i]['testid'];
//            $newarr[$m]['testname']=$arr[$i]['testname'];
//            $newarr[$m]['filesernum']=$arr[$i]['filesernum'];
//            $newarr[$m]['typeid']=$arr[$i]['typeid'];
//            $m=$m+1;
//            $kind=1;
//        }
//        else
//        {
//            $newarr_count=sizeof($newarr);
//            for($j=0;$j<$newarr_count;$j++)
//            {
//
//                if($newarr[$j]['filesernum']==$arr[$i]['filesernum'] && $newarr[$j]['typeid']==$arr[$i]['typeid'])
//                {
//                    $testkind=0;
//                    break;
//                }
//            }
//
//            if($testkind==0)
//            {
//                $testkind=1;
//                continue;
//
//            }
//            else
//            {
//                $newarr[$m]['id']=$arr[$i]['id'];
//                $newarr[$m]['testid']=$arr[$i]['testid'];
//                $newarr[$m]['testname']=$arr[$i]['testname'];
//                $newarr[$m]['filesernum']=$arr[$i]['filesernum'];
//                $newarr[$m]['typeid']=$arr[$i]['typeid'];
//                $m=$m+1;
//                $testkind=0;
//            }
//        }
//    }
//
//    return $newarr;
//
//}

function appusersrc($src)
{
    $src=str_replace('./uploads/', '/uploads/', $src);
    return $src;
}

//两个数组匹配
function arraysub($arr,$chapterid)
{
    $chapterdata=explode(',',$arr);
    $count=sizeof($chapterdata);

    for($m=0;$m<$count;$m++)
    {
        if($chapterid==$chapterdata[$m])
        {
            return 1;
            break;
        }
    }

    return 0;
}

//去掉习题的相同部分
function uniquetestarray($arr)
{
    $count=sizeof($arr);
    $newarr=$arr;

    for($i=0;$i<$count;$i++)
    {
        $id=$arr[$i]['id'];

        $newcount=sizeof($newarr);

        for($m=$i+1;$m<$newcount;$m++)
        {
            if($id==$newarr[$m]['id'])
            {
                $newarr[$m]['id']='del';
            }
        }
    }


    $k=0;
    for($n=0;$n<$count;$n++)
    {
        if($newarr[$n]['id']!='del')
        {
            $outputarr[$k]['id']=$newarr[$n]['id'];
            $outputarr[$k]['paper_name']=$newarr[$n]['paper_name'];
            $outputarr[$k]['classidarr']=$newarr[$n]['classidarr'];
            $outputarr[$k]['testkind']=$newarr[$n]['testkind'];
            $outputarr[$k]['testid']=$newarr[$n]['testid'];
            $outputarr[$k]['testtime']=$newarr[$n]['testtime'];
            $outputarr[$k]['groupidarr']=$newarr[$n]['groupidarr'];
            $outputarr[$k]['chapterarr']=$newarr[$n]['chapterarr'];
            $outputarr[$k]['filesernum']=$newarr[$n]['filesernum'];
            $k=$k+1;
        }
    }

    return $outputarr;


}


    function opertestsub($testid,$testtime,$classid,$groupid,$papername,$testkind,$subjectid,$userid,$filesernum,$keynote_msg,$schoolid,$gradeid,$inewdata)
    {

        $model_test=M('test_statistic');
        $count=sizeof($inewdata);
        $justtestid=0;
        $addtest=0;
        $testnote=0;
        $datakind=0;
        for($i=0;$i<$count;$i++)
        {
            if($inewdata[$i]['testid']==$testid)
            {
                $justtestid=1;
            }
        }

        if($justtestid==0)
        {
            //不存在已有的testid数据
            $datakind='addnewtest';
        }

        if($justtestid==1)
        {
            //存在已有的testid数据

            for($i=0;$i<$count;$i++)
            {

                $classida='-'.$classid.'-';
                $groupida='-'.$groupid.'-';

                if($inewdata[$i]['testid']==$testid)
                {
                    $testidj=1;
                }
                else
                {
                    $testidj=0;
                }

                $testtimej=strpossub($inewdata[$i]['testtime'],$testtime);
                $classidj=strpossub($inewdata[$i]['classidarr'],$classida);
                $groupidj=strpossub($inewdata[$i]['groupidarr'],$groupida);


                if($testidj==1 && $testtimej==1 && $classidj==1 && $groupidj==1)
                {
                    $addtest=2;

                }


                if($testidj==1 && $testtimej==1 && $classidj==0)
                {
                    $testnote=4;
                }
                if($testidj==1 && $testtimej==0 && $classidj==1)
                {
                    $testnote=4;
                    $testtimenote=1;
                }


                if($testidj==1 && $testtimej==0 && $classidj==0 )
                {
                    $testnote=4;
                }

                if($testidj==1 && $testtimej==1 && $classidj==1 && $groupidj==0)
                {
                    $addtest=3;
                }

            }


            if($addtest==2)
            {
                $datakind='canceltest';
            }
            else
            {

                if($addtest==3)
                {
                    $datakind='addgroupnote';
                }
                else
                {
                    if($testnote==4)
                    {
                        $datakind='addnownote';
                    }
                }
            }


        }


        if($datakind=='addnewtest')
        {
            $addtestdata['testid']=$testid;
            $addtestdata['classidarr']=$classid;
            $addtestdata['testtime']=$testtime;
            $addtestdata['groupidarr']=$groupid;
            $addtestdata['paper_name']=$papername;
            $addtestdata['testkind']=$testkind;
            $addtestdata['subjectid']=$subjectid;
            $addtestdata['userid']=$userid;

            $addtestdata['filesernum']=$filesernum;
            $addtestdata['keynote_msg']=$keynote_msg;
            $addtestdata['schoolid']=$schoolid;
            $addtestdata['gradeid']=$gradeid;
            $model_test->add($addtestdata);
        }

        if($datakind=='canceltest')
        {

        }

        if($datakind=='addgroupnote')
        {
            $testarr['testid']=$testid;
            $this_data=$model_test->where($testarr)->field('id,testid,classidarr,groupidarr,testtime,testkind,chapterarr,paper_name,filesernum')->find();

            $updatatest['groupidarr']=$this_data['groupidarr'].'-'.$groupid;
            $model_test->where($testarr)->save($updatatest);



        }

        if($datakind=='addnownote')
        {
            $testarr['testid']=$testid;
            $this_data=$model_test->where($testarr)->field('id,testid,classidarr,groupidarr,testtime,testkind,chapterarr,paper_name,filesernum')->find();
            $updatatest['classidarr']=$this_data['classidarr'].','.$classid;
            $updatatest['testtime']=$this_data['testtime'].','.$testtime;
            $updatatest['groupidarr']=$this_data['groupidarr'].','.$groupid;
            $model_test->where($testarr)->save($updatatest);
        }


    }


    function strpossub($arr1,$arr2)
    {
        $arr1='***'.$arr1;
        $msg=strpos($arr1,$arr2);

        if($msg!='')
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }


//单个习题的错题率统计
    function test_question_statistic($question_id,$classid,$groupid)
    {

    $kind=$groupid;

    $question_model=M('question_statistic');
    $question_arr['question_id']=$question_id;

    $question_data=$question_model->where($question_arr)->select();

    $all_count=sizeof($question_data);

        if($all_count==0)
        {
            if($kind==1)
            {
                $data['group']="g1";
            }
            if($kind==2)
            {
                $data['group']="g2";
            }
            if($kind==3)
            {
                $data['group']="g3";
            }
            if($kind==4)
            {
                $data['group']="other";
            }
            if($kind==5)
            {
                $data['group']="all";
            }

            $data['one']=-1;
            $data['two']="-";
            $data['ratio']=-1;
            $data['kind']="-";
            $data['sum']=0;
            $data['classid']=$classid;
            return $data;
        }


    $m=0;
    for($i=0;$i<$all_count;$i++)
    {

        $testidarr=explode(',',$question_data[$i]['testidarr']);
        $classidarr=explode(',',$question_data[$i]['classidarr']);
        $testtimearr=explode(',',$question_data[$i]['testtimearr']);
        $useridarr=explode(',',$question_data[$i]['useridarr']);
        $schoolidarr=explode(',',$question_data[$i]['schoolidarr']);

        $g1_w_num_arr=explode(',',$question_data[$i]['g1_w_num_arr']);
        $g2_w_num_arr=explode(',',$question_data[$i]['g2_w_num_arr']);
        $g3_w_num_arr=explode(',',$question_data[$i]['g3_w_num_arr']);
        $other_w_num_arr=explode(',',$question_data[$i]['other_w_num_arr']);
        $all_w_num_arr=explode(',',$question_data[$i]['all_w_num_arr']);

        $g1_sum_arr=explode(',',$question_data[$i]['g1_sum_arr']);
        $g2_sum_arr=explode(',',$question_data[$i]['g2_sum_arr']);
        $g3_sum_arr=explode(',',$question_data[$i]['g3_sum_arr']);
        $other_sum_arr=explode(',',$question_data[$i]['other_sum_arr']);
        $all_sum_arr=explode(',',$question_data[$i]['all_sum_arr']);

        $test_count=sizeof($testidarr);
        for($n=0;$n<$test_count;$n++)
        {

            $myclassidarr=explode('-',$classidarr[$n]);
            $testtimearr=explode('+',$testtimearr[$n]);



            $myg1_w_num_arr=explode('-',$g1_w_num_arr[$n]);
            $myg2_w_num_arr=explode('-',$g2_w_num_arr[$n]);
            $myg3_w_num_arr=explode('-',$g3_w_num_arr[$n]);
            $myother_w_num_arr=explode('-',$other_w_num_arr[$n]);
            $myall_w_num_arr=explode('-',$all_w_num_arr[$n]);

            $myg1_sum_arr=explode('-',$g1_sum_arr[$n]);
            $myg2_sum_arr=explode('-',$g2_sum_arr[$n]);
            $myg3_sum_arr=explode('-',$g3_sum_arr[$n]);
            $myother_sum_arr=explode('-',$other_sum_arr[$n]);
            $myall_sum_arr=explode('-',$all_sum_arr[$n]);


            $myclass_count=sizeof($myclassidarr);
            for($k=0;$k<$myclass_count;$k++)
            {

                $mynewdata[$m]['id']=$question_data[$i]['id'];
                $mynewdata[$m]['question_id']=$question_data[$i]['question_id'];

                $mynewdata[$m]['testid']=$testidarr[$n];
                $mynewdata[$m]['userid']=$useridarr[$n];
                $mynewdata[$m]['schoolid']=$schoolidarr[$n];

                $mynewdata[$m]['classid']=$myclassidarr[$k];
                $mynewdata[$m]['testtime']=$testtimearr[$k];

                $mynewdata[$m]['g1_w_num']=$myg1_w_num_arr[$k];
                $mynewdata[$m]['g2_w_num']=$myg2_w_num_arr[$k];
                $mynewdata[$m]['g3_w_num']=$myg3_w_num_arr[$k];
                $mynewdata[$m]['other_w_num']=$myother_w_num_arr[$k];
                $mynewdata[$m]['all_w_num']=$myall_w_num_arr[$k];


                $mynewdata[$m]['g1_sum']=$myg1_sum_arr[$k];
                $mynewdata[$m]['g2_sum']=$myg2_sum_arr[$k];
                $mynewdata[$m]['g3_sum']=$myg3_sum_arr[$k];
                $mynewdata[$m]['other_sum']=$myother_sum_arr[$k];
                $mynewdata[$m]['all_sum']=$myall_sum_arr[$k];

                $m=$m+1;
            }
        }
    }

    $class_count=sizeof($mynewdata);

    $m=0;

    for($a=0;$a<$class_count;$a++)
    {

        if($mynewdata[$a]['classid']==$classid)
        {
            $classdata[$m]['id']=$mynewdata[$a]['id'];
            $classdata[$m]['question_id']=$mynewdata[$a]['question_id'];

            $classdata[$m]['testid']=$mynewdata[$a]['testid'];
            $classdata[$m]['testtime']=$mynewdata[$a]['testtime'];
            $classdata[$m]['userid']=$mynewdata[$a]['userid'];
            $classdata[$m]['schoolid']=$mynewdata[$a]['schoolid'];

            $classdata[$m]['classid']=$mynewdata[$a]['classid'];

            $classdata[$m]['g1_w_num']=$mynewdata[$a]['g1_w_num'];
            $classdata[$m]['g2_w_num']=$mynewdata[$a]['g2_w_num'];
            $classdata[$m]['g3_w_num']=$mynewdata[$a]['g3_w_num'];
            $classdata[$m]['other_w_num']=$mynewdata[$a]['other_w_num'];
            $classdata[$m]['all_w_num']=$mynewdata[$a]['all_w_num'];


            $classdata[$m]['g1_sum']=$mynewdata[$a]['g1_sum'];
            $classdata[$m]['g2_sum']=$mynewdata[$a]['g2_sum'];
            $classdata[$m]['g3_sum']=$mynewdata[$a]['g3_sum'];


            $classdata[$m]['other_sum']=$mynewdata[$a]['other_sum'];
            $classdata[$m]['all_sum']=$mynewdata[$a]['all_sum'];
            $m=$m+1;
        }
    }


    $data=$classdata;
    $count=sizeof($classdata);

    $num1=$count-1;
    $num2=$count-2;


    $mydata['num']=$count;
    $data['classid']=$classid;



    if($count>=2)
    {
        $data['sum']=$count;
        if($kind=='1')
        {
            $data['one']=round($data[$num1]['g1_w_num']/$data[$num1]['g1_sum']*100,2)."%";
            $data['two']=round($data[$num2]['g1_w_num']/$data[$num2]['g1_sum']*100,2)."%";

            $data['ratio']=($data['one']-$data['two']);

            $num=(int)$data['ratio'];


            $data['group']='g1';


            if($num>0)
            {
                $data['ratio']='Up:'.$data['ratio'].'%';
                $data['kind']='Up';
            }
            if($num<0)
            {
                $data['ratio']='Down:'.$data['ratio']*(-1).'%';
                $data['kind']='Down';
            }
            if($num==0)
            {
                $data['ratio']="0%";
                $data['kind']='Equ';
            }

        }
        if($kind=='2')
        {
            $data['one']=round($data[$num1]['g2_w_num']/$data[$num1]['g2_sum']*100,2)."%";
            $data['two']=round($data[$num2]['g2_w_num']/$data[$num2]['g2_sum']*100,2)."%";

            $data['ratio']=($data['one']-$data['two']);

            $num=(int)$data['ratio'];

            $data['group']='g2';


            if($num>0)
            {
                $data['ratio']='Up:'.$data['ratio'].'%';
                $data['kind']='Up';
            }
            if($num<0)
            {
                $data['ratio']='Down:'.$data['ratio']*(-1).'%';
                $data['kind']='Down';
            }
            if($num==0)
            {
                $data['ratio']="0%";
                $data['kind']='Equ';
            }

        }
        if($kind=='3')
        {
            $data['one']=round($data[$num1]['g3_w_num']/$data[$num1]['g3_sum']*100,2)."%";
            $data['two']=round($data[$num2]['g3_w_num']/$data[$num2]['g3_sum']*100,2)."%";

            $data['ratio']=($data['one']-$data['two']);

            $num=(int)$data['ratio'];

            $data['group']='g3';


            if($num>0)
            {
                $data['ratio']='Up:'.$data['ratio'].'%';
                $data['kind']='Up';
            }
            if($num<0)
            {
                $data['ratio']='Down:'.$data['ratio']*(-1).'%';
                $data['kind']='Down';
            }
            if($num==0)
            {
                $data['ratio']="0%";
                $data['kind']='Equ';
            }
        }
        if($kind=='4')
        {
            $data['one']=round($data[$num1]['other_w_num']/$data[$num1]['other_sum']*100,2)."%";
            $data['two']=round($data[$num2]['other_w_num']/$data[$num2]['other_sum']*100,2)."%";

            $data['ratio']=($data['one']-$data['two']);

            $num=(int)$data['ratio'];

            $data['group']='other';


            if($num>0)
            {
                $data['ratio']='Up:'.$data['ratio'].'%';
                $data['kind']='Up';
            }
            if($num<0)
            {
                $data['ratio']='Down:'.$data['ratio']*(-1).'%';
                $data['kind']='Down';
            }
            if($num==0)
            {
                $data['ratio']="0%";
                $data['kind']='Equ';
            }
        }
        if($kind=='5')
        {
            $data['one']=round($data[$num1]['all_w_num']/$data[$num1]['all_sum']*100,2)."%";
            $data['two']=round($data[$num2]['all_w_num']/$data[$num2]['all_sum']*100,2)."%";

            $data['ratio']=($data['one']-$data['two']);

            $num=(int)$data['ratio'];

            $data['group']='all';

            if($num>0)
            {
                $data['ratio']='Up:'.$data['ratio'].'%';
                $data['kind']='Up';
            }
            if($num<0)
            {
                $data['ratio']='Down:'.$data['ratio']*(-1).'%';
                $data['kind']='Down';
            }
            if($num==0)
            {
                $data['ratio']="0%";
                $data['kind']='Equ';
            }
        }

    }
    //计算到这里
    if($count==1)
    {
        $data['sum']=1;
        $num=$count-1;
        if($kind=='1') {
            $data['one'] = round($data[$num1]['g1_w_num'] / $data[$num]['g1_sum'] * 100, 2) . "%";
            $data['two'] = "-%";
            $data['ratio']='-1';
            $data['kind']='None';
            $data['group']="g1";
        }
        if($kind=='2') {
            $data['one'] = round($data[$num1]['g2_w_num'] / $data[$num]['g2_sum'] * 100, 2) . "%";
            $data['two'] = "-%";
            $data['ratio']='-1';
            $data['kind']='None';
            $data['group']="g2";
        }
        if($kind=='3') {
            $data['one'] = round($data[$num1]['g3_w_num'] / $data[$num]['g3_sum'] * 100, 2) . "%";
            $data['two'] = "-%";
            $data['ratio']='-1';
            $data['kind']='None';
            $data['group']="g3";
        }
        if($kind=='4') {
            $data['one'] = round($data[$num1]['other_w_num'] / $data[$num]['other_sum'] * 100, 2) . "%";
            $data['two'] = "-%";
            $data['ratio']='-1';
            $data['kind']='None';
            $data['group']="other";
        }
        if($kind=='5') {
            $data['one'] = round($data[$num1]['all_w_num'] / $data[$num]['all_sum'] * 100, 2) . "%";
            $data['two'] = "-%";
            $data['ratio']='-1';
            $data['kind']='None';
            $data['group']="all";
        }
    }

    if($count==0)
    {
        $data['sum']=0;
        $staticdata['one'] = -1;
        $data['two'] = "-%";
        $data['ratio']='';
        $data['kind']='None';
        if($kind==1)
        {
            $data['group']="g1";
        }
        if($kind==2)
        {
            $data['group']="g2";
        }
        if($kind==3)
        {
            $data['group']="g3";
        }
        if($kind==4)
        {
            $data['group']="other";
        }
        if($kind==5)
        {
            $data['group']="all";
        }
    }

        return $data;


    }




//数组排序,arr是要排序的数组，keys是哪行元素，$order,1是升序，0是降序
function array_sort($arr, $keys, $order) {
    if (!is_array($arr)) {
        return false;
    }
    $keysvalue = array();
    foreach($arr as $key => $val) {
        $keysvalue[$key] = $val[$keys];
    }
 
    if($order == 1){
        asort($keysvalue);
    }else{
        arsort($keysvalue);
    }
    reset($keysvalue);//设定数组的内部指标到它的第一个元素
    foreach($keysvalue as $key => $vals) {
        $keysort[$key] = $key;
    }
    $new_array = array();
    foreach($keysort as $key => $val) {
        $new_array[$key] = $arr[$val];
    }
    return $new_array;
}





//进行区间索引
function seekarr($arr,$key,$no1,$no2)
{


    if($no1=='0')
    {
        $no1=0;
    }
        else
        {
         if($no1=='' || $no1<0)
        {
          $no1=-1;
        }
    }

    if($no2=='0')
        {
        $no2=0;
        }
        else
        {
            if($no2=='')
        {
        $no2=1000;
        }

            if($no2<0)
             {
                 $no2=0;
                }
         }


   $count=sizeof($arr);

    $m=0;

    for($i=0;$i<$count;$i++)
    {
        if($arr[$i][$key]>=$no1 && $arr[$i][$key]<=$no2)
        {
            $newarr[$m]['srcid']=$arr[$i]['srcid'];
            $newarr[$m]['src']=$arr[$i]['src'];
            $newarr[$m]['group']=$arr[$i]['group'];
            $newarr[$m]['one']=$arr[$i]['one'];
            $newarr[$m]['two']=$arr[$i]['two'];
            $newarr[$m]['ratio']=$arr[$i]['ratio'];
            $newarr[$m]['kind']=$arr[$i]['kind'];
            $newarr[$m]['ratio']=$arr[$i]['ratio'];
            $newarr[$m]['sum']=$arr[$i]['sum'];
            $newarr[$m]['classid']=$arr[$i]['classid'];
            $newarr[$m]['ctone']=$arr[$i]['ctone'];
            $newarr[$m]['answerid']=$arr[$i]['answerid'];
            $newarr[$m]['answersrc']=$arr[$i]['answersrc'];
            $newarr[$m]['width']=$arr[$i]['width'];
            $newarr[$m]['height']=$arr[$i]['height'];

            $newarr[$m]['pic1']=$arr[$i]['pic1'];
            $newarr[$m]['pic1_width']=$arr[$i]['pic1_width'];
            $newarr[$m]['pic1_height']=$arr[$i]['pic1_height'];

            $newarr[$m]['pic2']=$arr[$i]['pic2'];
            $newarr[$m]['pic2_width']=$arr[$i]['pic2_width'];
            $newarr[$m]['pic2_height']=$arr[$i]['pic2_height'];

            $newarr[$m]['pic3']=$arr[$i]['pic3'];
            $newarr[$m]['pic3_width']=$arr[$i]['pic3_width'];
            $newarr[$m]['pic3_height']=$arr[$i]['pic3_height'];

            $newarr[$m]['pic4']=$arr[$i]['pic4'];
            $newarr[$m]['pic4_width']=$arr[$i]['pic4_width'];
            $newarr[$m]['pic4_height']=$arr[$i]['pic4_height'];

            $newarr[$m]['pic1_src']=$arr[$i]['pic1_src'];
            $newarr[$m]['pic2_src']=$arr[$i]['pic2_src'];
            $newarr[$m]['pic3_src']=$arr[$i]['pic3_src'];
            $newarr[$m]['pic4_src']=$arr[$i]['pic4_src'];

            $newarr[$m]['pic1_id']=$arr[$i]['pic1_id'];
            $newarr[$m]['pic2_id']=$arr[$i]['pic2_id'];
            $newarr[$m]['pic3_id']=$arr[$i]['pic3_id'];
            $newarr[$m]['pic4_id']=$arr[$i]['pic4_id'];

            $newarr[$m]['t1_width']=$arr[$i]['t1_width'];
            $newarr[$m]['t1_height']=$arr[$i]['t1_height'];
            $newarr[$m]['t1_src']=$arr[$i]['t1_src'];
            $newarr[$m]['t1_sernum']=$arr[$i]['t1_sernum'];
            $newarr[$m]['t1_id']=$arr[$i]['t1_id'];

            $newarr[$m]['picsum']=$arr[$i]['picsum'];

            $m=$m+1;
        }
    }

    return $newarr;
}


//插入习题统计信息
function questioninsertstatictis($question_id,$stuid,$testid,$myclassid,$operkind)
{
//    $question_id='1443,1444,110';


//    $stuid=136;
//    $testid=1520;
//    $myclassid=65;
//    $question_id=1443;
//    $operkind=1;

    $question_model=M('question_statistic');

    $question_arr=explode(',',$question_id);
    $myquestion_count=sizeof($question_arr);

    //需要根据习题进行循环,便利全部数据

    $myarr['question_id']=$question_id;
    $question_data=$question_model->where($myarr)->select();
    $count=sizeof($question_data);



//    print_r($question_data);

    if($count==0)
    {
        //如果没有数据，就要进行插入；
        $testkind='add';
    }
    else
    {
        //否则进行更新；
        $testkind='update';
    }





    //进入更新板块进行操作，说明里面有符合条件的数据（有习题即可）
    if($testkind=='update')
    {
        //首先要将习题分解成单个，包含班级和群主信息，这样才能判断现有的数据，是属于那一类，是班级一致，还是群组一致
        $testidarr=explode(',',$question_data[0]['testidarr']);
        $classidarr=explode(',',$question_data[0]['classidarr']);

        $g1_w_num_arr=explode(',',$question_data[0]['g1_w_num_arr']);
        $g2_w_num_arr=explode(',',$question_data[0]['g2_w_num_arr']);
        $g3_w_num_arr=explode(',',$question_data[0]['g3_w_num_arr']);
        $other_w_num_arr=explode(',',$question_data[0]['other_w_num_arr']);

        $all_w_num_arr=explode(',',$question_data[0]['all_w_num_arr']);

        $g1_sum_arr=explode(',',$question_data[0]['g1_sum_arr']);
        $g2_sum_arr=explode(',',$question_data[0]['g2_sum_arr']);
        $g3_sum_arr=explode(',',$question_data[0]['g3_sum_arr']);
        $other_sum_arr=explode(',',$question_data[0]['other_sum_arr']);

        $all_sum_arr=explode(',',$question_data[0]['all_sum_arr']);

        $testtimearr=explode(',',$question_data[0]['testtimearr']);
        $useridarr=explode(',',$question_data[0]['useridarr']);
        $schoolidarr=explode(',',$question_data[0]['schoolidarr']);

        $onlyquestionarr['question_id']=$question_id;

        $testcount=sizeof($testidarr);

        //第一次扒皮，分解出来，习题中的每个考试数据


        $m=0;
        for($k=0;$k<$testcount;$k++)
        {

            $questiontestarr[$k]['question_id']=$question_id;
            $questiontestarr[$k]['testid']=$testidarr[$k];



            $testdata[$m]['question_id']=$question_id;
            $testdata[$m]['testid']=$testidarr[$k];
            $testdata[$m]['classidarr']=$classidarr[$k];

            $testdata[$m]['g1_w_num']=$g1_w_num_arr[$k];
            $testdata[$m]['g2_w_num']=$g2_w_num_arr[$k];
            $testdata[$m]['g3_w_num']=$g3_w_num_arr[$k];
            $testdata[$m]['other_w_num']=$other_w_num_arr[$k];
            $testdata[$m]['all_w_num']=$all_w_num_arr[$k];

            $testdata[$m]['g1_sum_num']=$g1_sum_arr[$k];
            $testdata[$m]['g2_sum_num']=$g2_sum_arr[$k];
            $testdata[$m]['g3_sum_num']=$g3_sum_arr[$k];
            $testdata[$m]['other_sum_num']=$other_sum_arr[$k];

            $testdata[$m]['all_sum_arr']=$all_sum_arr[$k];
            $testdata[$m]['testtimearr']=$testtimearr[$k];

            $testdata[$m]['useridarr']=$useridarr[$k];
            $testdata[$m]['schoolidarr']=$schoolidarr[$k];

            $m=$m+1;
        }


        $m=0;
        $i=0;

        //第二次扒皮，每个试题所在的试卷，所对应的班级及其数据
        for($k=0;$k<$testcount;$k++)
        {


            $classid=explode('-',$classidarr[$k]);

            $g1_w_num=explode('-',$g1_w_num_arr[$k]);
            $g2_w_num=explode('-',$g2_w_num_arr[$k]);
            $g3_w_num=explode('-',$g3_w_num_arr[$k]);
            $other_w_num=explode('-',$other_w_num_arr[$k]);
            $all_w_num=explode('-',$all_w_num_arr[$k]);

            $g1_sum=explode('-',$g1_sum_arr[$k]);
            $g2_sum=explode('-',$g2_sum_arr[$k]);
            $g3_sum=explode('-',$g3_sum_arr[$k]);
            $other_sum=explode('-',$other_sum_arr[$k]);

            $all_sum=explode('-',$all_sum_arr[$k]);

            $testtime=explode('+',$testtimearr[$k]);




            $class_count=sizeof($classid);

            $onlytestid[$i]=$testidarr[$k];
            $i=$i+1;

            for($a=0;$a<$class_count;$a++)
            {

                $testclassdata[$m]['question_id']=$question_id;
                $testclassdata[$m]['testid']=$testidarr[$k];
                $testclassdata[$m]['useridarr']=$useridarr[$k];
                $testclassdata[$m]['schoolidarr']=$schoolidarr[$k];

                $testclassdata[$m]['classid']=$classid[$a];

                $testclassdata[$m]['g1_w_num']=$g1_w_num[$a];
                $testclassdata[$m]['g2_w_num']=$g2_w_num[$a];
                $testclassdata[$m]['g3_w_num']=$g3_w_num[$a];
                $testclassdata[$m]['other_w_num']=$other_w_num[$a];
                $testclassdata[$m]['all_w_num']=$all_w_num[$a];


                //$all_w_num

                $testclassdata[$m]['g1_sum']=$g1_sum[$a];
                $testclassdata[$m]['g2_sum']=$g2_sum[$a];
                $testclassdata[$m]['g3_sum']=$g3_sum[$a];
                $testclassdata[$m]['other_sum']=$other_sum[$a];
                $testclassdata[$m]['all_sum']=$all_sum[$a];
                $testclassdata[$m]['testtime']=$testtime[$a];

                $m=$m+1;
            }


        }



        $testclass_count=sizeof($testclassdata);
        $questiongroupkind=0;
        $questionclassnotekind=0;
        $questiontimenotekind=0;
        $questiontimeclassnotekind=0;

        $model_paper=M('paper_msg_data');
        $paper_data=$model_paper->where('id='.$testid)->find();
        $testtime=$paper_data['publish_time'];
        $userid=$paper_data['userid'];




        //判断添加节点的类型，这样才能够决定在哪里更新数据

        for($i=0;$i<$testclass_count;$i++)
        {

            if( $testclassdata[$i]['testid']==$testid &&  $testclassdata[$i]['classid']==$myclassid && $testclassdata[$i]['testtime']==$testtime)
            {
                $questiongroupkind=1;
            }

            if($testclassdata[$i]['testid']==$testid  &&  $testclassdata[$i]['testtime']==$testtime &&  $testclassdata[$i]['classid']!=$myclassid)
            {
                $questionclassnotekind=1;
            }

            if($testclassdata[$i]['testid']==$testid &&  $testclassdata[$i]['classid']==$myclassid  &&  $testclassdata[$i]['testtime']!=$testtime )
            {
                $questiontimenotekind=1;
            }
            if($testclassdata[$i]['testid']==$testid &&  $testclassdata[$i]['classid']!=$myclassid  &&  $testclassdata[$i]['testtime']!=$testtime )
            {
                $questiontimeclassnotekind=1;
            }

        }



        if($questiongroupkind==1)
        {
            $updatequestionkind='updategroup';
            //更新群组信息
        }
        else
        {
            if($questiontimenotekind==1)
            {
                $updatequestionkind='addtimenote';
                //添加时间节点
            }
            else
            {
                if($questionclassnotekind==1)
                {
                    $updatequestionkind='addclassnote';
                    //添加班级信息
                }
                else
                {
                    if($questiontimeclassnotekind==1)
                    {
                        $updatequestionkind='addtimeclassnote';
                        //添加时间和班级信息
                    }
                    else
                    {
                        $updatequestionkind='addtest';
                        //添加考试
                    }

                }
            }
        }
    }



    $model_user=M('user_data');
    $model_user_add=M('user_studentparent_addation_data');
    $model_group=M('group_data');
    $model_class=M('class_data');


    $user_data=$model_user->where('id='.$stuid)->find();
    $user_add_data=$model_user_add->where('userid='.$stuid)->find();

    $groupid=$user_add_data['groupid'];
    $groupdata=$model_group->where('id='.$groupid)->find();
    $groupmsg=$groupdata['groupname'];




    $myclassid=$user_add_data['classid'];
    $class_data=$model_class->where('id='.$myclassid)->find();


    //找到班级对应的群组信息，用来计算G1有多少人，G2有多少人，G3有多少人

    $g1sum=$class_data['g1_sum'];
    $g2sum=$class_data['g2_sum'];
    $g3sum=$class_data['g3_sum'];
    $othersum=$class_data['other_sum'];
    $allsum=$class_data['classnum'];
    $schoolid=$class_data['school_id'];





    //根据最开始的判断，如果是没有这个习题并且进行添加的话，那么进行添加操作。
    if($testkind=='add')
    {

        $model_paper=M('paper_msg_data');
        $paper_data=$model_paper->where('id='.$testid)->find();
        $testtime=$paper_data['publish_time'];
        $userid=$paper_data['userid'];

        $questionarr['question_id']=$question_id;
        $questionarr['testidarr']=$testid;
        $questionarr['classidarr']=$myclassid;


        $questionarr['g1_w_num_arr']=0;
        $questionarr['g2_w_num_arr']=0;
        $questionarr['g3_w_num_arr']=0;
        $questionarr['other_w_num_arr']=0;
        $questionarr['all_w_num_arr']=1;

        if($groupmsg=='g1')
        {
            $questionarr['g1_w_num_arr']=1;
        }
        if($groupmsg=='g2')
        {
            $questionarr['g2_w_num_arr']=1;
        }
        if($groupmsg=='g3')
        {
            $questionarr['g3_w_num_arr']=1;
        }
        if($groupmsg=='other')
        {
            $questionarr['other_w_num_arr']=1;
        }


        $questionarr['all_w_num_arr']=1;
        $questionarr['g1_sum_arr']=$g1sum;
        $questionarr['g2_sum_arr']=$g2sum;
        $questionarr['g3_sum_arr']=$g3sum;
        $questionarr['other_sum_arr']=$othersum;
        $questionarr['all_sum_arr']=$allsum;
        $questionarr['testtimearr']=$testtime;
        $questionarr['useridarr']=$userid;
        $questionarr['schoolidarr']=$schoolid;
        $question_model->add($questionarr);

    }



    if($testkind=='update') {

        //进入更新信息
        if($updatequestionkind=='updategroup')
        {
            for($m=0;$m<$testclass_count;$m++)
            {


                if( $testclassdata[$m]['testid']==$testid &&  $testclassdata[$m]['classid']==$myclassid && $testclassdata[$m]['testtime']==$testtime)
                {


                    //进入群组操作，进行添加操作
                    if($operkind==1)
                    {
                        //添加操作
                        if($groupmsg=='g1')
                        {
                            $testclassdata[$m]['g1_w_num']=$testclassdata[$m]['g1_w_num']+1;
                        }
                        if($groupmsg=='g2')
                        {
                            $testclassdata[$m]['g2_w_num']=$testclassdata[$m]['g2_w_num']+1;
                        }
                        if($groupmsg=='g3')
                        {
                            $testclassdata[$m]['g3_w_num']=$testclassdata[$m]['g3_w_num']+1;
                        }
                        if($groupmsg=='other')
                        {
                            $testclassdata[$m]['other_w_num']=$testclassdata[$m]['other_w_num']+1;
                        }
                        $testclassdata[$m]['all_w_num']=$testclassdata[$m]['all_w_num']+1;


                    }
                    else
                    {
                        //削减操作
                        if($groupmsg=='g1')
                        {
                            $testclassdata[$m]['g1_w_num']=$testclassdata[$m]['g1_w_num']-1;
                        }
                        if($groupmsg=='g2')
                        {
                            $testclassdata[$m]['g2_w_num']=$testclassdata[$m]['g2_w_num']-1;
                        }
                        if($groupmsg=='g3')
                        {
                            $testclassdata[$m]['g3_w_num']=$testclassdata[$m]['g3_w_num']-1;
                        }
                        if($groupmsg=='other')
                        {
                            $testclassdata[$m]['other_w_num']=$testclassdata[$m]['other_w_num']-1;
                        }

                        $testclassdata[$m]['all_w_num']=$testclassdata[$m]['all_w_num_']-1;
                    }
                }
            }

        }



        if($updatequestionkind=='addtimeclassnote' || $updatequestionkind=='addclassnote' || $updatequestionkind=='addtimenote')
        {
            //进行新的节点添加，根据相应的组，再进行加1
            if($operkind==1)
            {
                $testclassdata[$testclass_count]['question_id']=$question_id;
                $testclassdata[$testclass_count]['testid']=$testid;
                $testclassdata[$testclass_count]['useridarr']=$userid;
                $testclassdata[$testclass_count]['schoolidarr']=$schoolid;
                $testclassdata[$testclass_count]['classid']=$myclassid;

                if($groupmsg=='g1')
                {
                    $testclassdata[$testclass_count]['g1_w_num']='1';
                    $testclassdata[$testclass_count]['g2_w_num']='0';
                    $testclassdata[$testclass_count]['g3_w_num']='0';
                    $testclassdata[$testclass_count]['other_w_num']='0';
                }
                if($groupmsg=='g2')
                {
                    $testclassdata[$testclass_count]['g1_w_num']='0';
                    $testclassdata[$testclass_count]['g2_w_num']='1';
                    $testclassdata[$testclass_count]['g3_w_num']='0';
                    $testclassdata[$testclass_count]['other_w_num']='0';
                }
                if($groupmsg=='g3')
                {
                    $testclassdata[$testclass_count]['g1_w_num']='0';
                    $testclassdata[$testclass_count]['g2_w_num']='0';
                    $testclassdata[$testclass_count]['g3_w_num']='1';
                    $testclassdata[$testclass_count]['other_w_num']='0';
                }
                if($groupmsg=='other')
                {
                    $testclassdata[$testclass_count]['g1_w_num']='0';
                    $testclassdata[$testclass_count]['g2_w_num']='0';
                    $testclassdata[$testclass_count]['g3_w_num']='0';
                    $testclassdata[$testclass_count]['other_w_num']='1';
                }


                $testclassdata[$testclass_count]['all_w_num']=1;
                $testclassdata[$testclass_count]['g1_sum']=$g1sum;
                $testclassdata[$testclass_count]['g2_sum']=$g2sum;
                $testclassdata[$testclass_count]['g3_sum']=$g3sum;
                $testclassdata[$testclass_count]['other_sum']=$othersum;
                $testclassdata[$testclass_count]['all_sum']=$allsum;
                $testclassdata[$testclass_count]['testtime']=$testtime;
                $testclass_count=$testclass_count+1;
            }
        }


        if($updatequestionkind=='addtest')
        {
            // 添加试题，并且根据群组信息进行更新;

            if($operkind==1)
            {

                $testclassdata[$testclass_count]['question_id']=$question_id;
                $testclassdata[$testclass_count]['testid']=$testid;
                $testclassdata[$testclass_count]['useridarr']=$userid;
                $testclassdata[$testclass_count]['schoolidarr']=$schoolid;
                $testclassdata[$testclass_count]['classid']=$myclassid;

                if($groupmsg=='g1')
                {
                    $testclassdata[$testclass_count]['g1_w_num']='1';
                    $testclassdata[$testclass_count]['g2_w_num']='0';
                    $testclassdata[$testclass_count]['g3_w_num']='0';
                    $testclassdata[$testclass_count]['other_w_num']='0';
                }
                if($groupmsg=='g2')
                {
                    $testclassdata[$testclass_count]['g1_w_num']='0';
                    $testclassdata[$testclass_count]['g2_w_num']='1';
                    $testclassdata[$testclass_count]['g3_w_num']='0';
                    $testclassdata[$testclass_count]['other_w_num']='0';
                }
                if($groupmsg=='g3')
                {
                    $testclassdata[$testclass_count]['g1_w_num']='0';
                    $testclassdata[$testclass_count]['g2_w_num']='0';
                    $testclassdata[$testclass_count]['g3_w_num']='1';
                    $testclassdata[$testclass_count]['other_w_num']='0';
                }
                if($groupmsg=='other')
                {
                    $testclassdata[$testclass_count]['g1_w_num']='0';
                    $testclassdata[$testclass_count]['g2_w_num']='0';
                    $testclassdata[$testclass_count]['g3_w_num']='0';
                    $testclassdata[$testclass_count]['other_w_num']='1';
                }


                $testclassdata[$testclass_count]['all_w_num']=1;
                $testclassdata[$testclass_count]['g1_sum']=$g1sum;
                $testclassdata[$testclass_count]['g2_sum']=$g2sum;
                $testclassdata[$testclass_count]['g3_sum']=$g3sum;
                $testclassdata[$testclass_count]['other_sum']=$othersum;
                $testclassdata[$testclass_count]['all_sum']=$allsum;



                $testclassdata[$testclass_count]['testtime']=$testtime;
                $testclass_count=$testclass_count+1;
            }

            $count=sizeof($questiontestarr);
            $questiontestarr[$count]['question_id']=$question_id;
            $questiontestarr[$count]['testid']=$testid;
        }

    }



    $questiontest_size=sizeof($questiontestarr);
    $all_count=sizeof($testclassdata);


    for($m=0;$m<$questiontest_size;$m++)
    {
        for($n=0;$n<$all_count;$n++)
        {
            if($questiontestarr[$m]['question_id']==$testclassdata[$n]['question_id'] && $questiontestarr[$m]['testid']==$testclassdata[$n]['testid'])
            {
                $questiontestarr[$m]['useridarr']=$testclassdata[$n]['useridarr'];
                $questiontestarr[$m]['schoolidarr']=$testclassdata[$n]['schoolidarr'];
                $questiontestarr[$m]['classid']=$questiontestarr[$m]['classid'].'-'.$testclassdata[$n]['classid'];
                $questiontestarr[$m]['g1_w_num']=$questiontestarr[$m]['g1_w_num'].'-'.$testclassdata[$n]['g1_w_num'];
                $questiontestarr[$m]['g2_w_num']=$questiontestarr[$m]['g2_w_num'].'-'.$testclassdata[$n]['g2_w_num'];
                $questiontestarr[$m]['g3_w_num']=$questiontestarr[$m]['g3_w_num'].'-'.$testclassdata[$n]['g3_w_num'];
                $questiontestarr[$m]['other_w_num']=$questiontestarr[$m]['other_w_num'].'-'.$testclassdata[$n]['other_w_num'];
                $questiontestarr[$m]['all_w_num']=$questiontestarr[$m]['all_w_num'].'-'.$testclassdata[$n]['all_w_num'];

                $questiontestarr[$m]['g1_sum']=$questiontestarr[$m]['g1_sum'].'-'.$testclassdata[$n]['g1_sum'];
                $questiontestarr[$m]['g2_sum']=$questiontestarr[$m]['g2_sum'].'-'.$testclassdata[$n]['g2_sum'];
                $questiontestarr[$m]['g3_sum']=$questiontestarr[$m]['g3_sum'].'-'.$testclassdata[$n]['g3_sum'];
                $questiontestarr[$m]['other_sum']=$questiontestarr[$m]['other_sum'].'-'.$testclassdata[$n]['other_sum'];
                $questiontestarr[$m]['all_sum']=$questiontestarr[$m]['all_sum'].'-'.$testclassdata[$n]['all_sum'];

                $questiontestarr[$m]['testtime']=$questiontestarr[$m]['testtime'].'+'.$testclassdata[$n]['testtime'];


                //进行封装，第一次，同一道题，同一次考试，进行相关数据拼接，除了时间用+，其他的用-，因为时间分隔符也是-，这样重复了。

            }

        }

        //去掉第一个-字符；
        $questiontestarr[$m]['classid']=substr($questiontestarr[$m]['classid'],1);
        $questiontestarr[$m]['g1_w_num']=substr($questiontestarr[$m]['g1_w_num'],1);
        $questiontestarr[$m]['g2_w_num']=substr($questiontestarr[$m]['g2_w_num'],1);
        $questiontestarr[$m]['g3_w_num']=substr($questiontestarr[$m]['g3_w_num'],1);
        $questiontestarr[$m]['other_w_num']=substr($questiontestarr[$m]['other_w_num'],1);
        $questiontestarr[$m]['all_w_num']=substr($questiontestarr[$m]['all_w_num'],1);

        $questiontestarr[$m]['g1_sum']=substr($questiontestarr[$m]['g1_sum'],1);
        $questiontestarr[$m]['g2_sum']=substr($questiontestarr[$m]['g2_sum'],1);
        $questiontestarr[$m]['g3_sum']=substr($questiontestarr[$m]['g3_sum'],1);
        $questiontestarr[$m]['other_sum']=substr($questiontestarr[$m]['other_sum'],1);
        $questiontestarr[$m]['all_sum']=substr($questiontestarr[$m]['all_sum'],1);

        $questiontestarr[$m]['testtime']=substr($questiontestarr[$m]['testtime'],1);

    }



    //获得新的习题数组，查看多少个，进行第二次拼接，相同的习题，不同的考试拼接

    $count=sizeof($questiontestarr);

    for($n=0;$n<$count;$n++)
    {
        $questiontestarr['question_id']=$questiontestarr[$n]['question_id'];
        $questiontestarr['testid']=$questiontestarr['testid'].','.$questiontestarr[$n]['testid'];

        $questiontestarr['schoolidarr']=$questiontestarr['schoolidarr'].','.$questiontestarr[$n]['schoolidarr'];
        $questiontestarr['useridarr']=$questiontestarr['useridarr'].','.$questiontestarr[$n]['useridarr'];
        $questiontestarr['classid']=$questiontestarr['classid'].','.$questiontestarr[$n]['classid'];
        $questiontestarr['g1_w_num']=$questiontestarr['g1_w_num'].','.$questiontestarr[$n]['g1_w_num'];
        $questiontestarr['g2_w_num']=$questiontestarr['g2_w_num'].','.$questiontestarr[$n]['g2_w_num'];
        $questiontestarr['g3_w_num']=$questiontestarr['g3_w_num'].','.$questiontestarr[$n]['g3_w_num'];
        $questiontestarr['other_w_num']=$questiontestarr['other_w_num'].','.$questiontestarr[$n]['other_w_num'];
        $questiontestarr['all_w_num']=$questiontestarr['all_w_num'].','.$questiontestarr[$n]['all_w_num'];

        $questiontestarr['g1_sum']=$questiontestarr['g1_sum'].','.$questiontestarr[$n]['g1_sum'];
        $questiontestarr['g2_sum']=$questiontestarr['g2_sum'].','.$questiontestarr[$n]['g2_sum'];
        $questiontestarr['g3_sum']=$questiontestarr['g3_sum'].','.$questiontestarr[$n]['g3_sum'];
        $questiontestarr['other_sum']=$questiontestarr['other_sum'].','.$questiontestarr[$n]['other_sum'];
        $questiontestarr['all_sum']=$questiontestarr['all_sum'].','.$questiontestarr[$n]['all_sum'];

        $questiontestarr['testtime']=$questiontestarr['testtime'].','.$questiontestarr[$n]['testtime'];
    }


    $question_id=$questiontestarr['question_id'];
    $questionarr['question_id']=$questiontestarr['question_id'];
    $newquestiontestarr['testidarr']=substr($questiontestarr['testid'],1);
    $newquestiontestarr['schoolidarr']=substr($questiontestarr['schoolidarr'],1);
    $newquestiontestarr['useridarr']=substr($questiontestarr['useridarr'],1);
    $newquestiontestarr['classidarr']=substr($questiontestarr['classid'],1);
    $newquestiontestarr['g1_w_num_arr']=substr($questiontestarr['g1_w_num'],1);
    $newquestiontestarr['g2_w_num_arr']=substr($questiontestarr['g2_w_num'],1);
    $newquestiontestarr['g3_w_num_arr']=substr($questiontestarr['g3_w_num'],1);
    $newquestiontestarr['all_w_num_arr']=substr($questiontestarr['all_w_num'],1);
    $newquestiontestarr['other_w_num_arr']=substr($questiontestarr['other_w_num'],1);
    $newquestiontestarr['g1_sum_arr']=substr($questiontestarr['g1_sum'],1);
    $newquestiontestarr['g2_sum_arr']=substr($questiontestarr['g2_sum'],1);
    $newquestiontestarr['g3_sum_arr']=substr($questiontestarr['g3_sum'],1);
    $newquestiontestarr['other_sum_arr']=substr($questiontestarr['other_sum'],1);
    $newquestiontestarr['all_sum_arr']=substr($questiontestarr['all_sum'],1);
    $newquestiontestarr['testtime_arr']=substr($questiontestarr['testtime'],1);

    $question_model->where($questionarr)->save($newquestiontestarr);
}
//因为是错题进入的是字符串，所以对于字符串要做一个拆分，之后按照这个程序循环处理。


function app_func(){
    echo "我是应用函数".__FUNCTION__;
}

function rotatesub($src,$degrees){//图片旋转
    $degrees=(int)$degrees;
    $image_size = getimagesize($src);
    $i=$image_size[2];

    switch ($i)
    {
        case 1:
            $src_img = imagecreatefromgif($src);
            $src=str_replace('.gif', 'o.gif', $src);
            $new_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
//            $x=imagesx($new_img);
            $msg=imagegif($new_img,$src);
            break;
        case 2:
            $src_img = imagecreatefromjpeg($src);
            $src=str_replace('.jpeg', 'o.jpeg', $src);
            $src=str_replace('.jpg', 'o.jpg', $src);
            $new_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
            $msg=imagejpeg($new_img,$src);
            break;
        case 3:
            $src_img = imagecreatefrompng($src);
            $src=str_replace('.png', 'o.png', $src);
            $new_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
            $msg=imagepng($new_img,$src);
            break;
        case 6:
            $src_img = imagecreatefrombmp($src);
            $src=str_replace('.bmp', 'o.bmp', $src);
            $new_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
            $msg=imagewbmp($new_img,$src);
            break;
    }
    echo $msg;

    //1 = GIF，2 = JPG，3 = PNG，4 = SWF，5 = PSD，6 = BMP，7 = TIFF(intel byte order)，8 = TIFF(motorola byte order)，9 = JPC，10 = JP2，11 = JPX，12 = JB2，13 = SWC，14 = IFF，15 = WBMP，16 = XBM

}
//
function rotatesize($src,$reg)
{
    $src_img = imagecreatefrompng($src);
    $new_img = imagerotate($src_img, $reg, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
    echo imagesy($new_img);
}

function usersrc($src)
{
    $src=str_replace('./uploads/', '/uploads/', $src);
    return $src;
}

//kind:'cut',x:x,y:y,width:width,height:height,src:src,x_ratio:x_ratio,y_ratio:y_ratio,reg:reg

function cutsub($kind,$x,$y,$width,$height,$src,$degrees)
{

    $standarddx=420;
    $standarddy=610;

//    return $kind;

    $command = './Public/cfile/cutsub '.$kind.' '.$x.' '.$y.' '.$width.' '.$height.' '.$src.' '.$degrees.' '.$standarddx.' '.$standarddy;


    $result = exec($command);

    // return $result;


    $array = explode(",",$result);

//    return $result;


    switch($kind){
        case 1:
            $imgmsg[1]['reg']=0;
            $imgmsg[1]['x_ratio']=$array[0];
            $imgmsg[1]['y_ratio']=$array[1];
            $imgmsg[1]['src']=changsrc($array[2])."?".mt_rand();

            break;
        case 2:
            $imgmsg[1]['reg']=0;
            $imgmsg[1]['x_ratio']=$array[0];
            $imgmsg[1]['y_ratio']=$array[1];
            $imgmsg[1]['src']=changsrc($array[2])."?".mt_rand();

            $imgmsg[2]['reg']=0;
            $imgmsg[2]['x_ratio']=$array[3];
            $imgmsg[2]['y_ratio']=$array[4];
            $imgmsg[2]['src']=changsrc($array[5])."?".mt_rand();
            break;
        case 3:
            $imgmsg[1]['reg']=0;
            $imgmsg[1]['x_ratio']=$array[1];
            $imgmsg[1]['y_ratio']=$array[2];
            $imgmsg[1]['src']=changsrc($array[3])."?".mt_rand();

            $imgmsg[2]['reg']=0;
            $imgmsg[2]['x_ratio']=$array[4];
            $imgmsg[2]['y_ratio']=$array[5];
            $imgmsg[2]['src']=changsrc($array[6])."?".mt_rand();

            $imgmsg[3]['reg']=0;
            $imgmsg[3]['x_ratio']=$array[7];
            $imgmsg[3]['y_ratio']=$array[8];
            $imgmsg[3]['src']=changsrc($array[9])."?".mt_rand();
            break;
        case 4:
            $imgmsg[1]['reg']=0;
            $imgmsg[1]['x_ratio']=$array[0];
            $imgmsg[1]['y_ratio']=$array[1];
            $imgmsg[1]['src']=changsrc($array[2])."?".mt_rand();

            $imgmsg[2]['reg']=0;
            $imgmsg[2]['x_ratio']=$array[3];
            $imgmsg[2]['y_ratio']=$array[4];
            $imgmsg[2]['src']=changsrc($array[5])."?".mt_rand();
            break;
    }
    return $imgmsg;

}

function png2jpg($srcPathName, $delOri=true)
{
    $srcFile=$srcPathName;
    $srcFileExt=strtolower(trim(substr(strrchr($srcFile,'.'),1)));
    if($srcFileExt=='png')
    {
        $dstFile = str_replace('.png', '.jpg', $srcPathName);
        $photoSize = GetImageSize($srcFile);
        $pw = $photoSize[0];
        $ph = $photoSize[1];
        $dstImage = ImageCreateTrueColor($pw, $ph);
        imagecolorallocate($dstImage, 255, 255, 255);
        //读取图片
        $srcImage = ImageCreateFromPNG($srcFile);
        //合拼图片
        imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $pw, $ph, $pw, $ph);
        imagejpeg($dstImage, $dstFile, 90);
        if ($delOri)
        {
            unlink($srcFile);
        }
        imagedestroy($srcImage);
    }
}

function cutsub1($src,$ox)
{
    echo "helloworld";
    $photoSize = GetImageSize($src);
    $pw = $photoSize[0];
    $ph = $photoSize[1];
    $dstImage = ImageCreateTrueColor($pw / 2, $ph);
    imagecolorallocate($dstImage, 255, 255, 255);
    //读取图片
    $srcImage = ImageCreateFromPNG($src);
//        //合拼图片
    imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $pw / 2, $ph, $pw / 2, $ph);
    imagepng($dstImage, './uploads/inittestimg/2018-03-24/test1.png');

}

function imgxy($src)
{
    $photoSize = GetImageSize($src);
    $imgsize['x']=$photoSize[0];
    $imgsize['y']=$photoSize[1];

    return $imgsize;
}

function imgxymm($src,$dpi)
{
    $photoSize = GetImageSize($src);
    $imgsize['x']=pxtomm($photoSize[0],$dpi);
    $imgsize['y']=pxtomm($photoSize[1],$dpi);

    return $imgsize;
}

function trsrc($src,$num)
{
    if($num==2)//分割两个
    {
        $image_size = getimagesize($src);
        $i=$image_size[2];

        if(strpos($src,'.gif')>-1)
        {
            $src1=str_replace('.gif', '_a.gif', $src);
            $src2=str_replace('.gif', '_b.gif', $src);
        }
        if(strpos($src,'.jpg')>-1 )
        {
            $src1=str_replace('.jpg', '_a.jpg', $src);
            $src2=str_replace('.jpg', '_b.jpg', $src);
        }

        if(strpos($src,'.jpeg')>-1 )
        {
            $src1=str_replace('.jpeg', '_a.jpeg', $src);
            $src2=str_replace('.jpeg', '_b.jpeg', $src);
        }

        if(strpos($src,'.png')>-1)
        {
            $src1=str_replace('.png', '_a.png', $src);
            $src2=str_replace('.png', '_b.png', $src);
        }

        if(strpos($src,'.bmp')>-1)
        {
            $src1=str_replace('.bmp', '_a.bmp', $src);
            $src2=str_replace('.bmp', '_b.bmp', $src);
        }

        $msg[1]=$src1;
        $msg[2]=$src2;
    }
    if($num==3)//分割三个
    {
        $image_size = getimagesize($src);
        $i=$image_size[2];

        if(strpos($src,'.gif')>-1)
        {
            $src1=str_replace('.gif', '_a.gif', $src);
            $src2=str_replace('.gif', '_b.gif', $src);
            $src3=str_replace('.gif', '_c.gif', $src);
        }
        if(strpos($src,'.jpg')>-1 )
        {
            $src1=str_replace('.jpg', '_a.jpg', $src);
            $src2=str_replace('.jpg', '_b.jpg', $src);
            $src3=str_replace('.jpg', '_c.jpg', $src);
        }

        if(strpos($src,'.jpeg')>-1 )
        {
            $src1=str_replace('.jpeg', '_a.jpeg', $src);
            $src2=str_replace('.jpeg', '_b.jpeg', $src);
            $src3=str_replace('.jpeg', '_c.jpeg', $src);
        }

        if(strpos($src,'.png')>-1)
        {
            $src1=str_replace('.png', '_a.png', $src);
            $src2=str_replace('.png', '_b.png', $src);
            $src3=str_replace('.png', '_c.png', $src);
        }

        if(strpos($src,'.bmp')>-1)
        {
            $src1=str_replace('.png', '_a.bmp', $src);
            $src2=str_replace('.png', '_b.bmp', $src);
            $src3=str_replace('.png', '_c.bmp', $src);
        }
        $msg[1]=$src1;
        $msg[2]=$src2;
        $msg[3]=$src3;
    }

    return $msg;

}
//kind:'cut',x:x,y:y,width:width,height:height,src:src,x_ratio:x_ratio,y_ratio:y_ratio,reg:reg
//对于习题进行单个分割
function cut03sub($y,$height,$src)
{
    $folder='./uploads/questionanswer/'.date("Y-m-d");
    if(!file_exists($folder)) {
        mkdir($folder);
    }
    $len=3;
    $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $string=time();
    for(;$len>=1;$len--)
    {
        $position=rand()%strlen($chars);
        $position2=rand()%strlen($string);
        $string=substr_replace($string,substr($chars,$position,1),$position2,0);
    }

    if(stripos($src,'.png')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.png';
    }
    if(stripos($src,'.jpg')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.jpg';

    }
    if(stripos($src,'.jpeg')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.jpeg';
    }


    $command = './Public/cfile/recut03sub '.$y.' '.$height.' '.$src.' '.$nowsrc;
    $result = exec($command);

    if($result==1)
    {
        $htmlfilename=str_replace('./','/',$nowsrc);
    }
    else
    {
        $htmlfilename=0;
    }

    echo $htmlfilename;
}

//对答案进行分割

//对于习题进行单个分割
function cutanswersub($x,$y,$width,$height,$src)
{
    $folder='./uploads/questionanswer/'.date("Y-m-d");
    if(!file_exists($folder)) {
        mkdir($folder);
    }
    $len=3;
    $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $string=time();
    for(;$len>=1;$len--)
    {
        $position=rand()%strlen($chars);
        $position2=rand()%strlen($string);
        $string=substr_replace($string,substr($chars,$position,1),$position2,0);
    }

    if(stripos($src,'.png')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.png';
    }
    if(stripos($src,'.jpg')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.jpg';

    }
    if(stripos($src,'.jpeg')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.jpeg';
    }


    $command = './Public/cfile/answercut '.$x.' '.$y.' '.$width.' '.$height.' '.$src.' '.$nowsrc;
    $result = exec($command);

    if($result==1)
    {
        $htmlfilename=str_replace('./','/',$nowsrc);
    }
    else
    {
        $htmlfilename=0;
    }

    return $htmlfilename;
}

//对于习题进行矩形分割
function cutrectangle($x,$y,$width,$height,$src)
{
    $folder='./uploads/questionanswer/'.date("Y-m-d");
    if(!file_exists($folder)) {
        mkdir($folder);
    }
    $len=3;
    $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $string=time();
    for(;$len>=1;$len--)
    {
        $position=rand()%strlen($chars);
        $position2=rand()%strlen($string);
        $string=substr_replace($string,substr($chars,$position,1),$position2,0);
    }

    if(stripos($src,'.png')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.png';
    }
    if(stripos($src,'.jpg')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.jpg';

    }
    if(stripos($src,'.jpeg')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.jpeg';
    }

    $command = './Public/cfile/cutrectangle '.$x.' '.$y.' '.$width.' '.$height.' '.$src.' '.$nowsrc;
    $result = exec($command);

    if($result==1)
    {
        $htmlfilename=str_replace('./','/',$nowsrc);
    }
    else
    {
        $htmlfilename=0;
    }

    echo $htmlfilename;
}
function recut03sub($y,$height,$src,$nowsrc)
{
    $command = './Public/cfile/recut03sub '.$y.' '.$height.' '.$src.' '.$nowsrc;
    echo $result = exec($command);

}
function addcutimgto($src1,$src2){
    $command = './Public/cfile/addcutimgto '.$src1.' '.$src2;
    return $result = exec($command);

}
function imgcutimg($src,$degrees){

    $msd=123;


    $degrees=(int)$degrees;
    $standx=3000;
    $standy=4564;
    $dstImage = imagecreatetruecolor($standx, $standy);
    $color=imagecolorallocate($dstImage, 255, 255, 255);
    imagecolortransparent($dstImage,$color);
    imagefill($dstImage,0,0,$color);
    $standradio=round(($standx/$standy),2);
    $image_size = getimagesize($src);
    $i=$image_size[2];


    switch ($i)
    {
        case 1:
            $src_img = imagecreatefromgif($src);
            if($degrees!=0) {
                $src_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
            }
            $y=imagesy($src_img);
            $x=imagesx($src_img);
            $radio=round(($y/$x),2);
            $dstImage=changexy($x,$y,$standx,$standy,$radio,$standradio,$dstImage,$src_img);
            $msg=imagegif($dstImage, $src);
            imagedestroy($dstImage);
            imagedestroy($src_img);

            break;
        case 2:
            $src_img = imagecreatefromjpeg($src);
            if($degrees!=0) {
                $src_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
            }
            $y=imagesy($src_img);
            $x=imagesx($src_img);
            $radio=round(($y/$x),2);
            $dstImage=changexy($x,$y,$standx,$standy,$radio,$standradio,$dstImage,$src_img);
            $msg=imagejpeg($dstImage, $src);
            imagedestroy($dstImage);
            imagedestroy($src_img);


            break;
        case 3:


            $src_img = imagecreatefrompng($src);

            return $src;
            if($degrees!=0) {
                $src_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
            }
            $y=imagesy($src_img);
            $x=imagesx($src_img);
            $radio=round(($y/$x),2);
            $dstImage=changexy($x,$y,$standx,$standy,$radio,$standradio,$dstImage,$src_img);
            $msg=imagepng($dstImage, $src);
            imagedestroy($dstImage);
            imagedestroy($src_img);
            break;
        case 6:
            $src_img = imagecreatefrombmp($src);
            if($degrees!=0) {
                $src_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
            }
            $y=imagesy($src_img);
            $x=imagesx($src_img);
            $radio=round(($y/$x),2);
            $dstImage=changexy($x,$y,$standx,$standy,$radio,$standradio,$dstImage,$src_img);
            $msg=imagewbmp($dstImage, $src);
            imagedestroy($dstImage);
            imagedestroy($src_img);
            break;
    }


    //1 = GIF，2 = JPG，3 = PNG，4 = SWF，5 = PSD，6 = BMP，7 = TIFF(intel byte order)，8 = TIFF(motorola byte order)，9 = JPC，10 = JP2，11 = JPX，12 = JB2，13 = SWC，14 = IFF，15 = WBMP，16 = XBM

}
function changexy($x,$y,$standx,$standy,$radio,$standradio,$dstImage,$src_img){
    if($y>$standy || $x>$standx){
        if($radio<$standradio){
            $width=$standx;
            $height=($width/$x)*$y;
        }else
        {
            $height=$standy;
            $width=($height/$y)*$x;
        }
        imagecopyresampled($dstImage, $src_img, 0,0,0,0,$width, $height, $x,$y);
    }
    else{
        imagecopyresampled($dstImage, $src_img, 0,0,0,0, $x,$y, $x,$y);
    }
    imagedestroy($src_img);

    return $dstImage;
}
function regtest($src,$degrees){
    $degrees=(int)$degrees;
    $image_size = getimagesize($src);
    $i=$image_size[2];

    switch ($i)
    {
        case 1:
            $src_img = imagecreatefromgif($src);
            $src=str_replace('.gif', 'o.gif', $src);
            $new_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
//            $x=imagesx($new_img);
            $msg=imagegif($new_img,$src);
            break;
        case 2:
            $src_img = imagecreatefromjpeg($src);
            $src=str_replace('.jpeg', 'o.jpeg', $src);
            $src=str_replace('.jpg', 'o.jpg', $src);
            $new_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
            $msg=imagejpeg($new_img,$src);
            break;
        case 3:
            $src_img = imagecreatefrompng($src);
            $src=str_replace('.png', 'o.png', $src);
            $new_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
            $msg=imagepng($new_img,$src);
            break;
        case 6:
            $src_img = imagecreatefrombmp($src);
            $src=str_replace('.bmp', 'o.bmp', $src);
            $new_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
            $msg=imagewbmp($new_img,$src);
            break;
    }
    return $msg;
}
function changsrc($src){
    $num='';
    if(stripos($src,'.png')>-1)
    {
        $num=stripos($src,'.png');
        $num=$num+4;
        $src=substr($src,0,$num);

    }
    if(stripos($src,'.jpg')>-1)
    {
        $num=stripos($src,'.jpg');
        $num=$num+4;
        $src=substr($src,0,$num);

    }
    if(stripos($src,'.jpeg')>-1)
    {
        $num=stripos($src,'.jpeg');
        $num=$num+5;
        $src=substr($src,0,$num);
    }

    return $src;
}
function rotateimg($src,$degree){
    $command = './Public/cfile/rotateimg '.$src.' '.$degree;
    return $result = exec($command);
}
function htmlpic($testid,$sum,$pic1,$pic2,$pic3,$pic4,$title,$in_ser)
{
    $html='';
    $model = M('img_cuted_data');
    $title=str_replace('T', '', $title);
    $title=str_replace('A', '', $title);
    $title=str_replace('+', '', $title);
    $title=str_replace('()', '', $title);
    if($sum>0){
        $array['id'] = (int)$pic1;
        $src1 = $model->where($array)->field('src')->Find();
        $src1=usersrc($src1[src]);
        $html1='<img id="pic'.$in_ser.'1" onclick="editpic(this.id)" src="'.$src1.'" style="margin-left:16px;margin-top:10px;width: 90px;height: 90px;">';
    }
    if($sum>1){
        $array['id'] = $pic2;
        $src2 = $model->where($array)->field('src')->Find();
        $src2=usersrc($src2[src]);
        $html2='<img id="pic'.$in_ser.'2" onclick="editpic(this.id)" src="'.$src2.'" style="margin-left:16px;margin-top:10px;width: 90px;height: 90px;">';
    }
    if($sum>2){
        $array['id'] = $pic3;
        $src3 = $model->where($array)->field('src')->Find();
        $src3=usersrc($src3[src]);
        $html3='<img id="pic'.$in_ser.'3" onclick="editpic(this.id)" src="'.$src3.'" style="margin-left:16px;margin-top:10px;width: 90px;height: 90px;">';
    }
    if($sum>3){
        $array['id'] = $pic4;
        $src4 = $model->where($array)->field('src')->Find();
        $src4=usersrc($src4[src]);
        $html4='<img id="pic'.$in_ser.'4" onclick="editpic(this.id)" src="'.$src4.'" style="margin-left:16px;margin-top:10px;width: 90px;height: 90px;">';
    }
    if($sum==1){
        $html=$html1;
    }
    if($sum==2){
        $html=$html1.$html2;
    }
    if($sum==3){
        $html=$html1.$html2.$html3;
    }
    if($sum==4){
        $html=$html1.$html2.$html3.$html4;
    }
    $sum=(int)$sum+1;
    // $inputmsg='<input id="inputpic'.$in_ser.'" type="hidden"  name="'.$testid.'"  value="'.$sum.'">';
    $title='<div class="row" id="ctbpicid'.$in_ser.'" style="margin-top:10px;text-align: center;background-color: white;"><span>题&nbsp;'.$title.'&nbsp;图</span></div>';
    $html=$html.$title;
    return $html;
}

//对于删除进行排序
function retestsernum($in_ser,$leng,$filesernum){
    $model = M('test_public_data');
    $array[filesernum]=$filesernum;
    $array[kind]='test';

    $max=$model->where($array)->max('in_ser');
    $data=$model->where($array)->select();
    $count=$model->where($array)->count();

    for($i=0;$i<$count;$i++)
    {
        if($data[$i][in_ser]>$in_ser)
        {
            $arrayid[id]=(int)$data[$i][id];
            $newin_ser['in_ser']=(int)$data[$i][in_ser]-(int)$leng;
            $model->where($arrayid)->save($newin_ser);
        }
    }
}
//单个图片配图处理
function no1testsernum($id,$picsum){
    $model1 = M('test_public_data');
    $model2 = M('img_cuted_data');

    $arrays['id']=$id;
    $ta=$model1->where($arrays)->find();

    $in_ser=$ta[in_ser];
    $filesernum=$ta[filesernum];


//    return $id;
//    return "in_ser:".$in_ser.",filesernum:".$filesernum;

    if($picsum==5){
        $pic1=(int)$ta[pic1];
        $pic2=(int)$ta[pic2];
        $pic3=(int)$ta[pic3];
        $pic4=(int)$ta[pic4];
        $srcid=(int)$ta[srcid];

        $result=$model2->where("id=".$srcid)->select();
        $src=$result[0][src];
        unlink($src);

        $pic1arr=$model2->where("id=".$pic1)->select();
        $pic1src=$pic1arr[0][src];
        unlink($pic1src);
        $pic2arr=$model2->where("id=".$pic2)->select();
        $pic2src=$pic2arr[0][src];
        unlink($pic2src);
        $pic3arr=$model2->where("id=".$pic3)->select();
        $pic3src=$pic3arr[0][src];
        unlink($pic3src);
        $pic4arr=$model2->where("id=".$pic4)->select();
        $pic4src=$pic4arr[0][src];
        unlink($pic4src);

        $model2->delete($pic1);
        $model2->delete($pic2);
        $model2->delete($pic3);
        $model2->delete($pic4);
        $model2->delete($srcid);
        retestsernum($in_ser,1,$filesernum);
        return $model1->delete($id);

    }
    if($picsum==4){
        $pic1=(int)$ta[pic1];
        $pic2=(int)$ta[pic2];
        $pic3=(int)$ta[pic3];
        $srcid=(int)$ta[srcid];


        $result=$model2->where("id=".$srcid)->select();
        $src=$result[0][src];
        unlink($src);

        $pic1arr=$model2->where("id=".$pic1)->select();
        $pic1src=$pic1arr[0][src];
        unlink($pic1src);
        $pic2arr=$model2->where("id=".$pic2)->select();
        $pic2src=$pic2arr[0][src];
        unlink($pic2src);
        $pic3arr=$model2->where("id=".$pic3)->select();
        $pic3src=$pic3arr[0][src];
        unlink($pic3src);


        $model2->delete($pic1);
        $model2->delete($pic2);
        $model2->delete($pic3);
        $model2->delete($srcid);
        retestsernum($in_ser,1,$filesernum);
        return $model1->delete($id);
    }
    if($picsum==3){
        $pic1=(int)$ta[pic1];
        $pic2=(int)$ta[pic2];
        $srcid=(int)$ta[srcid];

        $result=$model2->where("id=".$srcid)->select();
        $src=$result[0][src];
        unlink($src);

        $pic1arr=$model2->where("id=".$pic1)->select();
        $pic1src=$pic1arr[0][src];
        unlink($pic1src);
        $pic2arr=$model2->where("id=".$pic2)->select();
        $pic2src=$pic2arr[0][src];
        unlink($pic2src);


        $model2->delete($pic1);
        $model2->delete($pic2);
        $model2->delete($srcid);
        retestsernum($in_ser,1,$filesernum);
        return $model1->delete($id);
    }
    if($picsum==2){
        $pic1=(int)$ta[pic1];
        $srcid=(int)$ta[srcid];

        $result=$model2->where("id=".$srcid)->select();
        $src=$result[0][src];
        unlink($src);

        $pic1arr=$model2->where("id=".$pic1)->select();
        $pic1src=$pic1arr[0][src];
        unlink($pic1src);

        $model2->delete($pic1);
        $model2->delete($srcid);
        retestsernum($in_ser,1,$filesernum);
        return $model1->delete($id);
    }
    if($picsum==1)
    {
        $srcid=(int)$ta[srcid];
        retestsernum($in_ser,1,$filesernum);

        $result=$model2->where("id=".$srcid)->select();
        $src=$result[0][src];
        unlink($src);

        $model2->delete($srcid);
        return  $model1->delete($id);
    }
}
//向上向下之后排序
function updowntestsernum($in_ser,$upordown,$filesernum){
    $model = M('test_public_data');
    $array[filesernum]=$filesernum;
    $array[kind]='test';

    $max=$model->where($array)->max('in_ser');
    $data=$model->where($array)->select();
    $count=$model->where($array)->count();
    if($upordown=='up')
    {
        $in_ser=$in_ser-1;
    }
    for($i=0;$i<$count;$i++)
    {
        if($data[$i][in_ser]>$in_ser)
        {
            $arrayid[id]=(int)$data[$i][id];
            $newin_ser['in_ser']=(int)$data[$i][in_ser]+1;
            $model->where($arrayid)->save($newin_ser);
        }
    }
    return 1;
}
//插入T之后，进行相应的A的值进行修改
function newtandasernum($in_ser,$max,$tsernum,$filesernum){
    $kind='test';


}
//插入数值
function cuttitlemsg($msg)
{
    $msg=str_replace("T","",$msg);
    $msg=str_replace("A","",$msg);
    $msg=str_replace("+","",$msg);
    $msg=str_replace("()","",$msg);
    return $msg;
}
//答案图片添加
function addanswerimgto($src1,$src2){
    $command = './Public/cfile/addanswerimg '.$src1.' '.$src2;
    return $result = exec($command);
}

//插入数值类型
function savetitlemsg($msg)
{
    if(strpos($msg,"(T+A)",0)>0)
    {
        return  "(T+A)";
    };

    if(strpos($msg,"(A)",0)>0)
    {
        return  "(A)";
    };

    if(strpos($msg,"(T)",0)>0)
    {
        return  "(T)";
    };
}

//橡皮擦功能
function erasesub($x,$y,$width,$height,$src,$r,$g,$b)
{
    $command = './Public/cfile/erasesub '.$x.' '.$y.' '.$width.' '.$height.' '.$src.' '.$r.' '.$g.' '.$b;
    return $result = exec($command);
}

//边缘剪切
function cutsidesub($x,$y,$src,$kind)
{
    $command = './Public/cfile/cutside '.$x.' '.$y.' '.$src.' '.$kind;
    return $result = exec($command);
}



//降噪函数
function publicnoisesub($src)
{
    $command = './Public/cfile/noisesub '.$src;
    $result = exec($command);
}

//修正函数
function publicjustimg($src)
{
    $command = './Public/cfile/justimg '.$src;
    $result = exec($command);
}

//像素在72分辨率情况下，转化成MM
function pxtommsub($pxval){
    $mmval=$pxval*0.371;
    return round($mmval,3);
}
//字符串长度,字符，单个字符长度（英文）
function fontsizesub($msg,$size){
    $sum=mb_strlen($msg);
    $i=0;
    $lenght=0;


    for($i=0;$i<$sum;$i++)
    {
        $nowmsg=mb_substr($msg,$i,1,"utf-8");
        if(preg_match("/^[a-zA-Z\s]+$/",$nowmsg))
        {
            $lenght=$lenght+1;
        }
        else
        {
            if(preg_match("/[\'.,，。:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$nowmsg))
            {
                $lenght=$lenght+1;
            }
            else
            {
                $lenght=$lenght+2;
            }

        }
    }

    return $lenght*$size;
}

function font_img_size_sub($msg,$size,$width)
{
    return fontsizesub($msg,$size)+$width;
}

function adminsaveasfile($oldsrc,$newsrc)
{
    $command = './Public/cfile/saveasfile '.$oldsrc.' '.$newsrc;
    return $result = exec($command);
}



function  testpdf($kind,$scorekind,$outkind,$filesernum,$paper_name,$testnote){
//$kind,试卷种类，原始试卷，二次试卷，$scorekind, 分数样式，$outkind,输出样式(I,预览，D，下载)
  
  
    $dpi=72;

    $wordheight=297;
    //$wordheight=320;
    $wordwidth=210;
    $lineheight=3;
    $margin_top=14;//mm

    $title_font_size=mmtopx(10,$dpi);//dot
    $title_font_height=10;

    $title_line_height=0;
    $title_line_font_size=mmtopx(0,$dpi);

    $note_font_size=mmtopx(3,$dpi);
    $note_font_height=3;

    $note_line_font_size=mmtopx(3,$dpi);
    $note_line_height=3;

    $p1_font_size=mmtopx(4,$dpi);
    $p1_font_height=4;

    $foot_font_size=mmtopx(4,$dpi);
    $foot_height=4;

    $pic_font_size=mmtopx(3,$dpi);
    $pic_height=3;

    $pic_margin=1;

    $pagenum=1;
    $imagescale=4;


    $model_test_public = M('test_public_data');
    $model_img_cuted= M('img_cuted_data');

    //1.从习题数据库中读取数据
    $array[kind]='test';
    $array[filesernum]=$filesernum;
    $data= $model_test_public->where($array)->order('in_ser asc')->select();
    $count=sizeof($data);
//原始试卷
    if($kind==1)
    {
        $dpi=72;

        $wordheight=297;
        //$wordheight=320;
        $wordwidth=210;
        $lineheight=3;
        $margin_top=14;//mm

        $title_font_size=mmtopx(10,$dpi);//dot
        $title_font_height=10;

        $title_line_height=0;
        $title_line_font_size=mmtopx(0,$dpi);

        $note_font_size=mmtopx(3,$dpi);
        $note_font_height=3;

        $note_line_font_size=mmtopx(3,$dpi);
        $note_line_height=3;

        $p1_font_size=mmtopx(4,$dpi);
        $p1_font_height=4;

        $foot_font_size=mmtopx(4,$dpi);
        $foot_height=4;

        $pic_font_size=mmtopx(3,$dpi);
        $pic_height=3;

        $pic_margin=1;

        $pagenum=1;
        $imagescale=4;


        $model_test_public = M('test_public_data');
        $model_img_cuted= M('img_cuted_data');
        $model_types=M('questiontypes');

        //1.从习题数据库中读取数据
        $array['kind']='test';
        $array['filesernum']=$filesernum;
        $data= $model_test_public->where($array)->order('in_ser asc')->select();
        $count=sizeof($data);

        //2.读取习题中的图片信息

        for($i=0;$i<$count;$i++)
        {
            $testimg_data=$model_img_cuted->where('id='.$data[$i]['srcid'])->find();

            $sum=0;
            $maxheight=0;
            $max_o_height=0;
            $pic_all_width=0;
            $pic_all_o_width=0;


            //3.将习题信息存入新数组
            $test[$i]['title']=replacetitlekind($data[$i]['inputval']);
            $test[$i]['kind']=$data[$i]['inputname'];

            if($test[$i]['kind']=='title')
            {
                $typemsg=$model_types->where('id='.$data[$i]['typeid'])->find();

                $test[$i]['typesmsg']=$typemsg['typesmsg'];

                $test[$i]['title']=replacetitlekind($data[$i]['inputval']).$test[$i]['typesmsg'];
            }
            else
            {
                $test[$i]['title']=replacetitlekind($data[$i]['inputval']);

            }



            if($testimg_data['src']=='.')
            {
                $test[$i]['src']='';
                $test[$i]['img_o_x']=0;
                $test[$i]['img_o_y']=0;
                $test[$i]['img_x']=0;
                $test[$i]['img_y']=0;


            }
            else
            {
                $test[$i]['src']=$testimg_data['src'];
                $test[$i]['img_o_x']=imgxymm($testimg_data['src'],$dpi)['x'];
                $test[$i]['img_o_y']=imgxymm($testimg_data['src'],$dpi)['y'];
                $test[$i]['img_x']=round(imgxymm($testimg_data['src'],$dpi)['x']/$imagescale,2);
                $test[$i]['img_y']=round(imgxymm($testimg_data['src'],$dpi)['y']/$imagescale,2);


            }


            //4.判断习题对应图片信息
            if($data[$i]['pic1']!=0)
            {
                $picta=$model_img_cuted->where('id='.$data[$i]['pic1'])->find();
                $test[$i]['pic1_src']=$picta['src'];

                ///计算出来配图的原始宽度和高度及视图中的宽度和高度
                $test[$i]['pic1_img_x']=round(imgxymm($picta['src'],$dpi)['x']/$imagescale,2);
                $test[$i]['pic1_img_y']=round(imgxymm($picta['src'],$dpi)['y']/$imagescale,2);


                $test[$i]['pic1_o_img_x']=imgxymm($picta['src'],$dpi)['x'];
                $test[$i]['pic1_o_img_y']=imgxymm($picta['src'],$dpi)['y'];

                $sum=$sum+1;
                $maxheight=$test[$i]['pic1_img_y'];
                $max_o_height=$test[$i]['pic1_o_img_y'];
                $pic_all_width=$pic_all_width+$test[$i]['pic1_img_x'];
                $pic_all_o_width=$pic_all_o_width+$test[$i]['pic1_o_img_x'];

            }
            else{
                $test[$i]['pic1_src']=0;
                $test[$i]['pic1_img_x']=0;
                $test[$i]['pic1_img_y']=0;

                $test[$i]['pic1_o_img_x']=0;
                $test[$i]['pic1_o_img_y']=0;
            }
            if($data[$i]['pic2']!=0)
            {
                $picta=$model_img_cuted->where('id='.$data[$i]['pic2'])->find();
                $test[$i]['pic2_src']=$picta[src];


                $test[$i]['pic2_img_x']=round(imgxymm($picta['src'],$dpi)['x']/$imagescale,2);
                $test[$i]['pic2_img_y']=round(imgxymm($picta['src'],$dpi)['y']/$imagescale,2);

                $test[$i]['pic2_o_img_x']=imgxymm($picta['src'],$dpi)['x'];
                $test[$i]['pic2_o_img_y']=imgxymm($picta['src'],$dpi)['y'];

                $sum=$sum+1;

                if($test[$i]['pic2_img_y']>$maxheight)
                {
                    $maxheight=$test[$i]['pic2_img_y'];
                };

                if($test[$i]['pic2_o_img_y']>$max_o_height)
                {
                    $max_o_height=$test[$i]['pic2_o_img_y'];
                }

                $pic_all_width=$pic_all_width+$test[$i]['pic2_img_x'];
                $pic_all_o_width=$pic_all_o_width+$test[$i]['pic2_o_img_x'];


            }
            else{
                $test[$i]['pic2_src']=0;
                $test[$i]['pic2_img_x']=0;
                $test[$i]['pic2_img_y']=0;

                $test[$i]['pic2_o_img_x']=0;
                $test[$i]['pic2_o_img_y']=0;
            }
            if($data[$i]['pic3']!=0)
            {
                $picta=$model_img_cuted->where('id='.$data[$i]['pic3'])->find();
                $test[$i]['pic3_src']=$picta['src'];
                $sum=$sum+1;

                $test[$i]['pic3_img_x']=round(imgxymm($picta['src'],$dpi)['x']/$imagescale,2);
                $test[$i]['pic3_img_y']=round(imgxymm($picta['src'],$dpi)['y']/$imagescale,2);

                $test[$i]['pic3_o_img_x']=imgxymm($picta['src'],$dpi)['x'];
                $test[$i]['pic3_o_img_y']=imgxymm($picta['src'],$dpi)['y'];


                if($test[$i]['pic3_img_y']>$maxheight)
                {
                    $maxheight=$test[$i]['pic3_img_y'];
                };

                if($test[$i]['pic3_o_img_y']>$max_o_height)
                {
                    $max_o_height=$test[$i]['pic3_o_img_y'];
                }

                $pic_all_width=$pic_all_width+$test[$i]['pic3_img_x'];
                $pic_all_o_width=$pic_all_o_width+$test[$i]['pic3_o_img_x'];

            }
            else{
                $test[$i]['pic3_src']=0;
                $test[$i]['pic3_img_x']=0;
                $test[$i]['pic3_img_y']=0;

                $test[$i]['pic3_o_img_x']=0;
                $test[$i]['pic3_o_img_y']=0;
            }
            if($data[$i]['pic4']!=0)
            {
                $picta=$model_img_cuted->where('id='.$data[$i]['pic4'])->find();
                $test[$i]['pic4_src']=$picta['src'];
                $test[$i]['pic4_img_x']=round(imgxymm($picta['src'],$dpi)['x']/$imagescale,2);
                $test[$i]['pic4_img_y']=round(imgxymm($picta['src'],$dpi)['y']/$imagescale,2);

                $test[$i]['pic4_o_img_x']=imgxymm($picta['src'],$dpi)['x'];
                $test[$i]['pic4_o_img_y']=imgxymm($picta['src'],$dpi)['y'];
                $sum=$sum+1;


                if($test[$i]['pic4_img_y']>$maxheight)
                {
                    $maxheight=$test[$i]['pic4_img_y'];
                };

                if($test[$i]['pic4_o_img_y']>$max_o_height) {
                    $max_o_height = $test[$i]['pic4_o_img_y'];
                }

                $pic_all_width=$pic_all_width+$test[$i]['pic4_img_x'];
                $pic_all_o_width=$pic_all_o_width+$test[$i]['pic4_o_img_x'];

            }
            else{
                $test[$i]['pic4_src']=0;
                $test[$i]['pic4_img_x']=0;
                $test[$i]['pic4_img_y']=0;

                $test[$i]['pic4_o_img_x']=0;
                $test[$i]['pic4_o_img_y']=0;
            }

            $test[$i]['pic_maxheight']=$maxheight;
            $test[$i]['pic_max_o_height']=$max_o_height;
            $test[$i]['picsum']=$sum;

            $test[$i]['pic_all_o_width']=$pic_all_o_width;
            if($sum>=1)
            {
                $test[$i]['pic_all_width']=$pic_all_width+($sum*$pic_margin);
                $test[$i]['test_all_height']=$test[$i]['pic_maxheight']+$test[$i]['img_y']+$pic_height;
                $test[$i]['test_all_o_height']=$test[$i]['pic_o_maxheight']+$test[$i]['img_o_y']+$pic_height;
            }
            else
            {
                $test[$i]['pic_all_width']=$pic_all_width;
                $test[$i]['test_all_height']=$test[$i]['pic_maxheight']+$test[$i]['img_y'];
                $test[$i]['test_all_o_height']=$test[$i]['pic_o_maxheight']+$test[$i]['img_o_y'];
            }
        }

        // print_r($test);

        // 重新编辑排版结构


        $test_size=sizeof($test);

        $newtest[0]['title']=$paper_name;
        $newtest[0]['kind']='headtitle';
        $newtest[0]['font_size']=$title_font_size;
        $newtest[0]['height']=$title_font_height;
        $newtest[0]['src']=0;
        $newtest[0]['pic1_src']=0;
        $newtest[0]['pic2_src']=0;
        $newtest[0]['pic3_src']=0;
        $newtest[0]['pic4_src']=0;
        $newtest[0]['pic1_img_x']=0;
        $newtest[0]['pic1_img_y']=0;
        $newtest[0]['pic2_img_x']=0;
        $newtest[0]['pic2_img_y']=0;
        $newtest[0]['pic3_img_x']=0;
        $newtest[0]['pic3_img_y']=0;
        $newtest[0]['pic4_img_x']=0;
        $newtest[0]['pic4_img_y']=0;
        $newtest[0]['img_x']=0;
        $newtest[0]['img_y']=0;
        $newtest[0]['picsum']=0;
        $newtest[0]['picswidth']=0;
        $newtest[0]['pic_maxheight']=0;

        $newtest[1]['title']='0';
        $newtest[1]['kind']='title_line_height';
        $newtest[1]['font_size']=$title_line_font_size;
        $newtest[1]['height']=$title_line_height;
        $newtest[1]['src']=0;
        $newtest[1]['pic1_src']=0;
        $newtest[1]['pic2_src']=0;
        $newtest[1]['pic3_src']=0;
        $newtest[1]['pic4_src']=0;
        $newtest[1]['pic1_img_x']=0;
        $newtest[1]['pic1_img_y']=0;
        $newtest[1]['pic2_img_x']=0;
        $newtest[1]['pic2_img_y']=0;
        $newtest[1]['pic3_img_x']=0;
        $newtest[1]['pic3_img_y']=0;
        $newtest[1]['pic4_img_x']=0;
        $newtest[1]['pic4_img_y']=0;
        $newtest[1]['img_x']=0;
        $newtest[1]['img_y']=0;
        $newtest[1]['picsum']=0;
        $newtest[1]['picswidth']=0;
        $newtest[1]['pic_maxheight']=0;


        if($testnote=='null')
        {
            $testnote='';
            $newtest[2]['title']='';
        }
        else
        {
            $newtest[2]['title']=$testnote;
        }

        $newtest[2]['kind']='note';
        $newtest[2]['font_size']=$note_font_size;
        $newtest[2]['height']=$note_font_height;
        $newtest[2]['src']=0;
        $newtest[2]['pic1_src']=0;
        $newtest[2]['pic2_src']=0;
        $newtest[2]['pic3_src']=0;
        $newtest[2]['pic4_src']=0;
        $newtest[2]['pic1_img_x']=0;
        $newtest[2]['pic1_img_y']=0;
        $newtest[2]['pic2_img_x']=0;
        $newtest[2]['pic2_img_y']=0;
        $newtest[2]['pic3_img_x']=0;
        $newtest[2]['pic3_img_y']=0;
        $newtest[2]['pic4_img_x']=0;
        $newtest[2]['pic4_img_y']=0;
        $newtest[2]['img_x']=0;
        $newtest[2]['img_y']=0;
        $newtest[2]['picsum']=0;
        $newtest[2]['picswidth']=0;
        $newtest[2]['pic_maxheight']=0;

        $newtest[3]['title']='0';
        $newtest[3]['kind']='note_line_height';
        $newtest[3]['font_size']=$note_line_font_size;
        $newtest[3]['height']=$note_line_height;
        $newtest[3]['src']=0;
        $newtest[3]['pic1_src']=0;
        $newtest[3]['pic2_src']=0;
        $newtest[3]['pic3_src']=0;
        $newtest[3]['pic4_src']=0;
        $newtest[3]['pic1_img_x']=0;
        $newtest[3]['pic1_img_y']=0;
        $newtest[3]['pic2_img_x']=0;
        $newtest[3]['pic2_img_y']=0;
        $newtest[3]['pic3_img_x']=0;
        $newtest[3]['pic3_img_y']=0;
        $newtest[3]['pic4_img_x']=0;
        $newtest[3]['pic4_img_y']=0;
        $newtest[3]['img_x']=0;
        $newtest[3]['img_y']=0;
        $newtest[3]['picsum']=0;
        $newtest[3]['picswidth']=0;
        $newtest[3]['pic_maxheight']=0;



        $m=4;
        for($j=0;$j<$test_size;$j++)
        {
            $newtest[$m]['title']=$test[$j]['title'];

            if($test[$j]['kind']=='title' && $test[$j]['src']!='')
            {
                $newtest[$m]['kind']='sertitle';
                $newtest[$m]['font_size']=$p1_font_size;
                $newtest[$m]['height']=$test[$j]['test_all_height'];
                $newtest[$m]['img_x']=$test[$j]['img_x'];
                $newtest[$m]['img_y']=$test[$j]['img_y'];

                $newtest[$m]['test_all_height']=$test[$j]['test_all_height'];


                //echo $newtest[$m]['test_all_height'];
                if($newtest[$m]['test_all_height']<$p1_font_height)
                {
                    $newtest[$m]['height']=$p1_font_height;
                }
            }
            else
            {
                $newtest[$m]['kind']='title';
                $newtest[$m]['font_size']=$p1_font_size;
                $newtest[$m]['height']=$p1_font_height;
                $newtest[$m]['img_x']=0;
                $newtest[$m]['img_y']=0;
            }
            if($test[$j]['kind']=='titleanswer')
            {
                $newtest[$m]['kind']='titleanswer';
                $newtest[$m]['font_size']=$p1_font_size;
                $newtest[$m]['height']=$test[$j]['test_all_height'];
                $newtest[$m]['img_x']=$test[$j]['img_x'];
                $newtest[$m]['img_y']=$test[$j]['img_y'];

                $newtest[$m]['test_all_height']=$test[$j]['test_all_height'];

                if($newtest[$m]['test_all_height']<$p1_font_height)
                {
                    $newtest[$m]['height']=$p1_font_height;
                }
            }
            if($test[$j]['kind']=='answer')
            {
                $newtest[$m]['kind']='answer';
                $newtest[$m]['font_size']=$p1_font_size;
                $newtest[$m]['height']=$test[$j]['test_all_height'];
                $newtest[$m]['img_x']=$test[$j]['img_x'];
                $newtest[$m]['img_y']=$test[$j]['img_y'];

                $newtest[$m]['test_all_height']=$test[$j]['test_all_height'];

                if($newtest[$m]['test_all_height']<$p1_font_height)
                {
                    $newtest[$m]['height']=$p1_font_height;
                }
            }



            $newtest[$m]['src']=$test[$j]['src'];
            $newtest[$m]['pic1_src']=$test[$j]['pic1_src'];
            $newtest[$m]['pic2_src']=$test[$j]['pic2_src'];
            $newtest[$m]['pic3_src']=$test[$j]['pic3_src'];
            $newtest[$m]['pic4_src']=$test[$j]['pic4_src'];
            $newtest[$m]['pic1_img_x']=$test[$j]['pic1_img_x'];
            $newtest[$m]['pic1_img_y']=$test[$j]['pic1_img_y'];
            $newtest[$m]['pic2_img_x']=$test[$j]['pic2_img_x'];
            $newtest[$m]['pic2_img_y']=$test[$j]['pic2_img_y'];
            $newtest[$m]['pic3_img_x']=$test[$j]['pic3_img_x'];
            $newtest[$m]['pic3_img_y']=$test[$j]['pic3_img_y'];
            $newtest[$m]['pic4_img_x']=$test[$j]['pic4_img_x'];
            $newtest[$m]['pic4_img_y']=$test[$j]['pic4_img_y'];
            $newtest[$m]['pic_maxheight']=$test[$j]['pic_maxheight'];


            $newtest[$m]['picswidth']=$test[$j]['pic_all_width'];
            $newtest[$m]['pics_sum']=$test[$j]['picsum'];
            $newtest[$m]['page']=0;

            $m=$m+1;

        }

        $newtestlength=sizeof($newtest);

        $sumheight=$margin_top;
        $nextsumheight=0;


        $standheight=$wordheight-$margin_top-$margin_top;
        $m=0;$n=0;
        for($i=0;$i<$newtestlength-1;$i++)
        {
            $m=$i+1;
            $sumheight=$sumheight+$newtest[$i]['height']+$lineheight;
            $nextsumheight=$sumheight+$newtest[$m]['height']+$lineheight;

            if($sumheight<=$standheight && $nextsumheight>=$standheight)
            {
                $newtest[$i]['page']=$pagenum;
                $pagenum=$pagenum+1;
                $sumheight=$margin_top;
                $nextsumheight=0;
            }
            else
            {
                $newtest[$i]['page']=0;
            }

        }

        $newtest[$newtestlength-1]['page']=$pagenum;

        $pagesum=$pagenum;



        $pdf = new \TCPDF('P', 'mm', array($wordwidth,$wordheight), true, 'UTF-8', false);

        //页眉：43，页面高度：1160

// 设置文档信息
        $pdf->SetCreator('hzjoo');
        $pdf->SetAuthor('hzjoo');
        $pdf->SetTitle('好好学习，天天向上！');
        $pdf->SetSubject('hzjoo');
        $pdf->SetKeywords('hzjoo');

// 设置页眉和页脚信息
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(true);
// 设置页眉和页脚字体
        //$pdf->setHeaderFont(Array('stsongstdlight', '', '30'));
        // $pdf->setFooterFont(Array('stsongstdlight', '', '2'));

// 设置默认等宽字体
        $pdf->SetDefaultMonospacedFont('stsongstdlight');
        $pdf->setFontSubsetting(true);

// 设置间距,中间80表示到页面顶端的距离
//        $pdf->SetMargins(0, $margin_top, 0);
//        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(20);
        $pdf->setFooterFont(Array('stsongstdlight', '100', 10));
// 设置分页
        $pdf->SetAutoPageBreak(TRUE, 25);

// set image scale factor
        $pdf->setImageScale($imagescale);

//设置字体

        $pdf->AddPage();
        $pdf->SetMargins(0, 0, 0);

        // 进入循环添加信息

        $page_local=$margin_top;
        $test_size=sizeof($newtest);
        for($j=0;$j<$test_size;$j++)
        {
            if($newtest[$j]['kind']=='headtitle')
            {
                //设置字体
                $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                //进行写入
                $pdf->MultiCell($wordwidth,$newtest[$j]['height'],$newtest[$j]['title'], $border=0, $align='C',$fill=false, $ln=1, $x='0', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                $page_local=$page_local+$newtest[$j]['height']+$lineheight;
            }

            if($newtest[$j]['kind']=='title_line_height')
            {
                $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                $page_local=$page_local+$newtest[$j]['height']+$lineheight;

            }

            if($newtest[$j]['kind']=='note')
            {
                //设置字体
                $pdf->SetFont('stsongstdlight', '',$newtest[$j]['font_size']);
                $pdf->MultiCell(180,$newtest[$j]['font_size'],'<span style="letter-spacing: 3px">'.$newtest[$j]['title'].'</span>', $border=0, $align='C',$fill=false, $ln=1, $x='10', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

                $page_local=$page_local+$newtest[$j]['height']+$lineheight;
            }

            if($newtest[$j]['kind']=='note_line_height')
            {
                $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                $page_local=$page_local+$newtest[$j]['height']+$lineheight;
            }

            if($newtest[$j]['kind']=='title')
            {
                $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                $pdf->MultiCell(180, 20,$newtest[$j]['title'], $border=0, $align='L',$fill=false, $ln=1, $x='10', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                $page_local=$page_local+$newtest[$j]['height'];
                $page_local=$page_local+$lineheight;
            }

            if($newtest[$j]['kind']=='titleanswer'  || $newtest[$j]['kind']=='answer'  || $newtest[$j]['kind']=='sertitle')
            {
                $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.$newtest[$j]['title'].'</span>', $border=0, $align='L',$fill=false, $ln=1, $x='20', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                $pdf->Image($newtest[$j]['src'], 30,$page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);

                if($newtest[$j]['pics_sum']==1)
                {
                    $pic_page_local=$page_local+$newtest[$j]['img_y'];
                    $x=$wordwidth-$newtest[$j]['picswidth']-30;
                    $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pic_x=$x+round($newtest[$j]['pic1_img_x']/2,2)-6;
                    $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                    $title = strtr($newtest[$j]['title'], '.', ' ');
                    $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                }

                if($newtest[$j]['pics_sum']==2)
                {
                    $pic_page_local=$page_local+$newtest[$j]['img_y'];
                    $x=$wordwidth-$newtest[$j]['picswidth'];
                    $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pdf->Image($newtest[$j]['pic2_src'], $x+$newtest[$j]['pic1_img_x']+$pic_margin,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pic_x=$x+round(($newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x'])/2,2)-6;
                    $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                    $title = strtr($newtest[$j]['title'], '.', ' ');
                    $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                }
                if($newtest[$j]['pics_sum']==3) {
                    $pic_page_local=$page_local+$newtest[$j]['img_y'];
                    $x=$wordwidth-$newtest[$j]['picswidth'];
                    $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pdf->Image($newtest[$j]['pic2_src'], $x+$newtest[$j]['pic1_img_x']+$pic_margin,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pdf->Image($newtest[$j]['pic3_src'], $x+$newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$pic_margin*2,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pic_x=$x+round(($newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$newtest[$j]['pic3_img_x'])/2,2)-6;
                    $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                    $title = strtr($newtest[$j]['title'], '.', ' ');
                    $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                }
                if($newtest[$j]['pics_sum']==4)
                {
                    $pic_page_local=$page_local+$newtest[$j]['img_y'];
                    $x=$wordwidth-$newtest[$j]['picswidth'];
                    $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pdf->Image($newtest[$j]['pic2_src'], $x+$newtest[$j]['pic1_img_x']+$pic_margin,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pdf->Image($newtest[$j]['pic3_src'], $x+$newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$pic_margin*2,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pdf->Image($newtest[$j]['pic4_src'], $x+$newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$newtest[$j]['pic3_img_x']+$pic_margin*3,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pic_x=$x+round(($newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$newtest[$j]['pic3_img_x']+$newtest[$j]['pic4_img_x'])/2,2)-6;
                    $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                    $title = strtr($newtest[$j]['title'], '.', ' ');
                    $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                }

                $page_local=$page_local+$newtest[$j]['height'];
                $page_local=$page_local+$lineheight;
            }



            if($newtest[$j]['page']>0 && $newtest[$j]['page']<$pagesum)
            {
                $pdf->AddPage();
                $page_local=$margin_top;
                //  $pdf->MultiCell(50, 10,2323, $border=0, $align='L',$fill=false, $ln=1, $x='20', $y='10',  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
            }

        }
    }
//新生成试卷
    if($kind==2)
    {
      

       if($scorekind==1)
       {
           //2.读取习题中的图片信息

           for($i=0;$i<$count;$i++)
           {
               $testimg_data=$model_img_cuted->where('id='.$data[$i]['srcid'])->find();

               $sum=0;
               $maxheight=0;
               $max_o_height=0;
               $pic_all_width=0;
               $pic_all_o_width=0;

             
            

               //3.将习题信息存入新数组
               $test[$i]['title']=$data[$i]['inputval'];
               $test[$i]['src']=$testimg_data['src'];
               $test[$i]['kind']=$data[$i]['inputname'];
               $test[$i]['img_o_x']=imgxymm($testimg_data['src'],$dpi)['x'];
               $test[$i]['img_o_y']=imgxymm($testimg_data['src'],$dpi)['y'];
               $test[$i]['img_x']=round(imgxymm($testimg_data['src'],$dpi)['x']/$imagescale,2);
               $test[$i]['img_y']=round(imgxymm($testimg_data['src'],$dpi)['y']/$imagescale,2);


               //4.判断习题对应图片信息
               if($data[$i]['pic1']!=0)
               {
                   $picta=$model_img_cuted->where('id='.$data[$i]['pic1'])->find();
                   $test[$i]['pic1_src']=$picta['src'];

                   ///计算出来配图的原始宽度和高度及视图中的宽度和高度
                   $test[$i]['pic1_img_x']=round(imgxymm($picta['src'],$dpi)['x']/$imagescale,2);
                   $test[$i]['pic1_img_y']=round(imgxymm($picta['src'],$dpi)['y']/$imagescale,2);


                   $test[$i]['pic1_o_img_x']=imgxymm($picta['src'],$dpi)['x'];
                   $test[$i]['pic1_o_img_y']=imgxymm($picta['src'],$dpi)['y'];

                   $sum=$sum+1;
                   $maxheight=$test[$i]['pic1_img_y'];
                   $max_o_height=$test[$i]['pic1_o_img_y'];
                   $pic_all_width=$pic_all_width+$test[$i]['pic1_img_x'];
                   $pic_all_o_width=$pic_all_o_width+$test[$i]['pic1_o_img_x'];

               }
               else{
                   $test[$i]['pic1_src']=0;
                   $test[$i]['pic1_img_x']=0;
                   $test[$i]['pic1_img_y']=0;

                   $test[$i]['pic1_o_img_x']=0;
                   $test[$i]['pic1_o_img_y']=0;
               }
               if($data[$i]['pic2']!=0)
               {
                   $picta=$model_img_cuted->where('id='.$data[$i]['pic2'])->find();
                   $test[$i]['pic2_src']=$picta[src];


                   $test[$i]['pic2_img_x']=round(imgxymm($picta['src'],$dpi)['x']/$imagescale,2);
                   $test[$i]['pic2_img_y']=round(imgxymm($picta['src'],$dpi)['y']/$imagescale,2);

                   $test[$i]['pic2_o_img_x']=imgxymm($picta['src'],$dpi)['x'];
                   $test[$i]['pic2_o_img_y']=imgxymm($picta['src'],$dpi)['y'];

                   $sum=$sum+1;

                   if($test[$i]['pic2_img_y']>$maxheight)
                   {
                       $maxheight=$test[$i]['pic2_img_y'];
                   };

                   if($test[$i]['pic2_o_img_y']>$max_o_height)
                   {
                       $max_o_height=$test[$i]['pic2_o_img_y'];
                   }

                   $pic_all_width=$pic_all_width+$test[$i]['pic2_img_x'];
                   $pic_all_o_width=$pic_all_o_width+$test[$i]['pic2_o_img_x'];


               }
               else{
                   $test[$i]['pic2_src']=0;
                   $test[$i]['pic2_img_x']=0;
                   $test[$i]['pic2_img_y']=0;

                   $test[$i]['pic2_o_img_x']=0;
                   $test[$i]['pic2_o_img_y']=0;
               }
               if($data[$i]['pic3']!=0)
               {
                   $picta=$model_img_cuted->where('id='.$data[$i]['pic3'])->find();
                   $test[$i]['pic3_src']=$picta['src'];
                   $sum=$sum+1;

                   $test[$i]['pic3_img_x']=round(imgxymm($picta['src'],$dpi)['x']/$imagescale,2);
                   $test[$i]['pic3_img_y']=round(imgxymm($picta['src'],$dpi)['y']/$imagescale,2);

                   $test[$i]['pic3_o_img_x']=imgxymm($picta['src'],$dpi)['x'];
                   $test[$i]['pic3_o_img_y']=imgxymm($picta['src'],$dpi)['y'];


                   if($test[$i]['pic3_img_y']>$maxheight)
                   {
                       $maxheight=$test[$i]['pic3_img_y'];
                   };

                   if($test[$i]['pic3_o_img_y']>$max_o_height)
                   {
                       $max_o_height=$test[$i]['pic3_o_img_y'];
                   }

                   $pic_all_width=$pic_all_width+$test[$i]['pic3_img_x'];
                   $pic_all_o_width=$pic_all_o_width+$test[$i]['pic3_o_img_x'];

               }
               else{
                   $test[$i]['pic3_src']=0;
                   $test[$i]['pic3_img_x']=0;
                   $test[$i]['pic3_img_y']=0;

                   $test[$i]['pic3_o_img_x']=0;
                   $test[$i]['pic3_o_img_y']=0;
               }
               if($data[$i]['pic4']!=0)
               {
                   $picta=$model_img_cuted->where('id='.$data[$i]['pic4'])->find();
                   $test[$i]['pic4_src']=$picta['src'];
                   $test[$i]['pic4_img_x']=round(imgxymm($picta['src'],$dpi)['x']/$imagescale,2);
                   $test[$i]['pic4_img_y']=round(imgxymm($picta['src'],$dpi)['y']/$imagescale,2);

                   $test[$i]['pic4_o_img_x']=imgxymm($picta['src'],$dpi)['x'];
                   $test[$i]['pic4_o_img_y']=imgxymm($picta['src'],$dpi)['y'];
                   $sum=$sum+1;


                   if($test[$i]['pic4_img_y']>$maxheight)
                   {
                       $maxheight=$test[$i]['pic4_img_y'];
                   };

                   if($test[$i]['pic4_o_img_y']>$max_o_height) {
                       $max_o_height = $test[$i]['pic4_o_img_y'];
                   }

                   $pic_all_width=$pic_all_width+$test[$i]['pic4_img_x'];
                   $pic_all_o_width=$pic_all_o_width+$test[$i]['pic4_o_img_x'];

               }
               else{
                   $test[$i]['pic4_src']=0;
                   $test[$i]['pic4_img_x']=0;
                   $test[$i]['pic4_img_y']=0;

                   $test[$i]['pic4_o_img_x']=0;
                   $test[$i]['pic4_o_img_y']=0;
               }

               $test[$i]['pic_maxheight']=$maxheight;
               $test[$i]['pic_max_o_height']=$max_o_height;
               $test[$i]['picsum']=$sum;

               $test[$i]['pic_all_o_width']=$pic_all_o_width;
               if($sum>=1)
               {
                   $test[$i]['pic_all_width']=$pic_all_width+($sum*$pic_margin);
                   $test[$i]['test_all_height']=$test[$i]['pic_maxheight']+$test[$i]['img_y']+$pic_height;
                   $test[$i]['test_all_o_height']=$test[$i]['pic_o_maxheight']+$test[$i]['img_o_y']+$pic_height;
               }
               else
               {
                   $test[$i]['pic_all_width']=$pic_all_width;
                   $test[$i]['test_all_height']=$test[$i]['pic_maxheight']+$test[$i]['img_y'];
                   $test[$i]['test_all_o_height']=$test[$i]['pic_o_maxheight']+$test[$i]['img_o_y'];
               }
           }


           // 重新编辑排版结构


           $test_size=sizeof($test);

           $newtest[0]['title']=$paper_name;
           $newtest[0]['kind']='headtitle';
           $newtest[0]['font_size']=$title_font_size;
           $newtest[0]['height']=$title_font_height;
           $newtest[0]['src']=0;
           $newtest[0]['pic1_src']=0;
           $newtest[0]['pic2_src']=0;
           $newtest[0]['pic3_src']=0;
           $newtest[0]['pic4_src']=0;
           $newtest[0]['pic1_img_x']=0;
           $newtest[0]['pic1_img_y']=0;
           $newtest[0]['pic2_img_x']=0;
           $newtest[0]['pic2_img_y']=0;
           $newtest[0]['pic3_img_x']=0;
           $newtest[0]['pic3_img_y']=0;
           $newtest[0]['pic4_img_x']=0;
           $newtest[0]['pic4_img_y']=0;
           $newtest[0]['img_x']=0;
           $newtest[0]['img_y']=0;
           $newtest[0]['picsum']=0;
           $newtest[0]['picswidth']=0;
           $newtest[0]['pic_maxheight']=0;

           $newtest[1]['title']='0';
           $newtest[1]['kind']='title_line_height';
           $newtest[1]['font_size']=$title_line_font_size;
           $newtest[1]['height']=$title_line_height;
           $newtest[1]['src']=0;
           $newtest[1]['pic1_src']=0;
           $newtest[1]['pic2_src']=0;
           $newtest[1]['pic3_src']=0;
           $newtest[1]['pic4_src']=0;
           $newtest[1]['pic1_img_x']=0;
           $newtest[1]['pic1_img_y']=0;
           $newtest[1]['pic2_img_x']=0;
           $newtest[1]['pic2_img_y']=0;
           $newtest[1]['pic3_img_x']=0;
           $newtest[1]['pic3_img_y']=0;
           $newtest[1]['pic4_img_x']=0;
           $newtest[1]['pic4_img_y']=0;
           $newtest[1]['img_x']=0;
           $newtest[1]['img_y']=0;
           $newtest[1]['picsum']=0;
           $newtest[1]['picswidth']=0;
           $newtest[1]['pic_maxheight']=0;


           $newtest[2]['title']=$testnote;
           $newtest[2]['kind']='note';
           $newtest[2]['font_size']=$note_font_size;
           $newtest[2]['height']=$note_font_height;
           $newtest[2]['src']=0;
           $newtest[2]['pic1_src']=0;
           $newtest[2]['pic2_src']=0;
           $newtest[2]['pic3_src']=0;
           $newtest[2]['pic4_src']=0;
           $newtest[2]['pic1_img_x']=0;
           $newtest[2]['pic1_img_y']=0;
           $newtest[2]['pic2_img_x']=0;
           $newtest[2]['pic2_img_y']=0;
           $newtest[2]['pic3_img_x']=0;
           $newtest[2]['pic3_img_y']=0;
           $newtest[2]['pic4_img_x']=0;
           $newtest[2]['pic4_img_y']=0;
           $newtest[2]['img_x']=0;
           $newtest[2]['img_y']=0;
           $newtest[2]['picsum']=0;
           $newtest[2]['picswidth']=0;
           $newtest[2]['pic_maxheight']=0;

           $newtest[3]['title']='0';
           $newtest[3]['kind']='note_line_height';
           $newtest[3]['font_size']=$note_line_font_size;
           $newtest[3]['height']=$note_line_height;
           $newtest[3]['src']=0;
           $newtest[3]['pic1_src']=0;
           $newtest[3]['pic2_src']=0;
           $newtest[3]['pic3_src']=0;
           $newtest[3]['pic4_src']=0;
           $newtest[3]['pic1_img_x']=0;
           $newtest[3]['pic1_img_y']=0;
           $newtest[3]['pic2_img_x']=0;
           $newtest[3]['pic2_img_y']=0;
           $newtest[3]['pic3_img_x']=0;
           $newtest[3]['pic3_img_y']=0;
           $newtest[3]['pic4_img_x']=0;
           $newtest[3]['pic4_img_y']=0;
           $newtest[3]['img_x']=0;
           $newtest[3]['img_y']=0;
           $newtest[3]['picsum']=0;
           $newtest[3]['picswidth']=0;
           $newtest[3]['pic_maxheight']=0;



           $m=4;
           for($j=0;$j<$test_size;$j++)
           {
               $newtest[$m]['title']=$test[$j]['title'];

               if($test[$j]['kind']=='title' && $test[$j]['src']!='')
               {
                   $newtest[$m]['kind']='sertitle';
                   $newtest[$m]['font_size']=$p1_font_size;
                   $newtest[$m]['height']=$test[$j]['test_all_height'];
                   $newtest[$m]['img_x']=$test[$j]['img_x'];
                   $newtest[$m]['img_y']=$test[$j]['img_y'];

                   $newtest[$m]['test_all_height']=$test[$j]['test_all_height'];


                   //echo $newtest[$m]['test_all_height'];
                   if($newtest[$m]['test_all_height']<$p1_font_height)
                   {
                       $newtest[$m]['height']=$p1_font_height;
                   }
               }
               else
               {
                   $newtest[$m]['kind']='title';
                   $newtest[$m]['font_size']=$p1_font_size;
                   $newtest[$m]['height']=$p1_font_height;
                   $newtest[$m]['img_x']=0;
                   $newtest[$m]['img_y']=0;
               }
               if($test[$j]['kind']=='titleanswer')
               {
                   $newtest[$m]['kind']='titleanswer';
                   $newtest[$m]['font_size']=$p1_font_size;
                   $newtest[$m]['height']=$test[$j]['test_all_height'];
                   $newtest[$m]['img_x']=$test[$j]['img_x'];
                   $newtest[$m]['img_y']=$test[$j]['img_y'];

                   $newtest[$m]['test_all_height']=$test[$j]['test_all_height'];

                   if($newtest[$m]['test_all_height']<$p1_font_height)
                   {
                       $newtest[$m]['height']=$p1_font_height;
                   }
               }
               if($test[$j]['kind']=='answer')
               {
                   $newtest[$m]['kind']='answer';
                   $newtest[$m]['font_size']=$p1_font_size;
                   $newtest[$m]['height']=$test[$j]['test_all_height'];
                   $newtest[$m]['img_x']=$test[$j]['img_x'];
                   $newtest[$m]['img_y']=$test[$j]['img_y'];

                   $newtest[$m]['test_all_height']=$test[$j]['test_all_height'];

                   if($newtest[$m]['test_all_height']<$p1_font_height)
                   {
                       $newtest[$m]['height']=$p1_font_height;
                   }
               }



               $newtest[$m]['src']=$test[$j]['src'];
               $newtest[$m]['pic1_src']=$test[$j]['pic1_src'];
               $newtest[$m]['pic2_src']=$test[$j]['pic2_src'];
               $newtest[$m]['pic3_src']=$test[$j]['pic3_src'];
               $newtest[$m]['pic4_src']=$test[$j]['pic4_src'];
               $newtest[$m]['pic1_img_x']=$test[$j]['pic1_img_x'];
               $newtest[$m]['pic1_img_y']=$test[$j]['pic1_img_y'];
               $newtest[$m]['pic2_img_x']=$test[$j]['pic2_img_x'];
               $newtest[$m]['pic2_img_y']=$test[$j]['pic2_img_y'];
               $newtest[$m]['pic3_img_x']=$test[$j]['pic3_img_x'];
               $newtest[$m]['pic3_img_y']=$test[$j]['pic3_img_y'];
               $newtest[$m]['pic4_img_x']=$test[$j]['pic4_img_x'];
               $newtest[$m]['pic4_img_y']=$test[$j]['pic4_img_y'];
               $newtest[$m]['pic_maxheight']=$test[$j]['pic_maxheight'];


               $newtest[$m]['picswidth']=$test[$j]['pic_all_width'];
               $newtest[$m]['pics_sum']=$test[$j]['picsum'];
               $newtest[$m]['page']=0;

               $m=$m+1;

           }

           $newtestlength=sizeof($newtest);

           $sumheight=$margin_top;
           $nextsumheight=0;


           $standheight=$wordheight-$margin_top-$margin_top;
           $m=0;$n=0;
           for($i=0;$i<$newtestlength-1;$i++)
           {
               $m=$i+1;
               $sumheight=$sumheight+$newtest[$i]['height']+$lineheight;
               $nextsumheight=$sumheight+$newtest[$m]['height']+$lineheight;

               if($sumheight<=$standheight && $nextsumheight>=$standheight)
               {
                   $newtest[$i]['page']=$pagenum;
                   $pagenum=$pagenum+1;
                   $sumheight=$margin_top;
                   $nextsumheight=0;
               }
               else
               {
                   $newtest[$i]['page']=0;
               }

           }

           $newtest[$newtestlength-1]['page']=$pagenum;

           $pagesum=$pagenum;


         
   

           $pdf = new \TCPDF('P', 'mm', array($wordwidth,$wordheight), true, 'UTF-8', false);

           //页眉：43，页面高度：1160

// 设置文档信息
           $pdf->SetCreator('hzjoo');
           $pdf->SetAuthor('hzjoo');
           $pdf->SetTitle('好好学习，天天向上！');
           $pdf->SetSubject('hzjoo');
           $pdf->SetKeywords('hzjoo');

// 设置页眉和页脚信息
           $pdf->setPrintHeader(false);
           $pdf->setPrintFooter(true);
// 设置页眉和页脚字体
           //$pdf->setHeaderFont(Array('stsongstdlight', '', '30'));
           // $pdf->setFooterFont(Array('stsongstdlight', '', '2'));

// 设置默认等宽字体
           $pdf->SetDefaultMonospacedFont('stsongstdlight');
           $pdf->setFontSubsetting(true);

// 设置间距,中间80表示到页面顶端的距离
//        $pdf->SetMargins(0, $margin_top, 0);
//        $pdf->SetHeaderMargin(5);
           $pdf->SetFooterMargin(20);
           $pdf->setFooterFont(Array('stsongstdlight', '100', 10));
// 设置分页
           $pdf->SetAutoPageBreak(TRUE, 25);

// set image scale factor
           $pdf->setImageScale($imagescale);

//设置字体

           $pdf->AddPage();
           $pdf->SetMargins(0, 0, 0);

           // 进入循环添加信息

           $page_local=$margin_top;
           $test_size=sizeof($newtest);
         
         
  
         
 
         
 
           for($j=0;$j<$test_size;$j++)
           {
            
               if($newtest[$j]['kind']=='headtitle')
               {
                   //设置字体
                   $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                   //进行写入
                   $pdf->MultiCell($wordwidth,$newtest[$j]['height'],$newtest[$j]['title'], $border=0, $align='C',$fill=false, $ln=1, $x='0', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                   $page_local=$page_local+$newtest[$j]['height']+$lineheight;
               }

               if($newtest[$j]['kind']=='title_line_height')
               {
                   $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                   $page_local=$page_local+$newtest[$j]['height']+$lineheight;

               }

               if($newtest[$j]['kind']=='note')
               {
                   //设置字体
                   $pdf->SetFont('stsongstdlight', '',$newtest[$j]['font_size']);
                   $pdf->MultiCell(180,$newtest[$j]['font_size'],'<span style="letter-spacing: 3px">'.$newtest[$j]['title'].'</span>', $border=0, $align='C',$fill=false, $ln=1, $x='10', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

                   $page_local=$page_local+$newtest[$j]['height']+$lineheight;
               }

               if($newtest[$j]['kind']=='note_line_height')
               {
                   $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                   $page_local=$page_local+$newtest[$j]['height']+$lineheight;
               }

               if($newtest[$j]['kind']=='title')
               {
                   $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                   $pdf->MultiCell(180, 20,$newtest[$j]['title'], $border=0, $align='L',$fill=false, $ln=1, $x='10', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                   $page_local=$page_local+$newtest[$j]['height'];
                   $page_local=$page_local+$lineheight;
               }

               if($newtest[$j]['kind']=='titleanswer'  || $newtest[$j]['kind']=='answer'  || $newtest[$j]['kind']=='sertitle')
               {
                 
                 
                   $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                   $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.$newtest[$j]['title'].'</span>', $border=0, $align='L',$fill=false, $ln=1, $x='20', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                   $pdf->Image($newtest[$j]['src'], 30,$page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);

           
                   if($newtest[$j]['pics_sum']==1)
                   {
         
                       $pic_page_local=$page_local+$newtest[$j]['img_y'];
                       $x=$wordwidth-$newtest[$j]['picswidth']-30;
                       $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pic_x=$x+round($newtest[$j]['pic1_img_x']/2,2)-6;
                       $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                       $title = strtr($newtest[$j]['title'], '.', ' ');
                       $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                   }

                   if($newtest[$j]['pics_sum']==2)
                   {
                       $pic_page_local=$page_local+$newtest[$j]['img_y'];
                       $x=$wordwidth-$newtest[$j]['picswidth'];
                       $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic2_src'], $x+$newtest[$j]['pic1_img_x']+$pic_margin,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pic_x=$x+round(($newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x'])/2,2)-6;
                       $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                       $title = strtr($newtest[$j]['title'], '.', ' ');
                       $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                   }
                   if($newtest[$j]['pics_sum']==3) {
                       $pic_page_local=$page_local+$newtest[$j]['img_y'];
                       $x=$wordwidth-$newtest[$j]['picswidth'];
                       $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic2_src'], $x+$newtest[$j]['pic1_img_x']+$pic_margin,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic3_src'], $x+$newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$pic_margin*2,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pic_x=$x+round(($newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$newtest[$j]['pic3_img_x'])/2,2)-6;
                       $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                       $title = strtr($newtest[$j]['title'], '.', ' ');
                       $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                   }
                   if($newtest[$j]['pics_sum']==4)
                   {
                       $pic_page_local=$page_local+$newtest[$j]['img_y'];
                       $x=$wordwidth-$newtest[$j]['picswidth'];
                       $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic2_src'], $x+$newtest[$j]['pic1_img_x']+$pic_margin,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic3_src'], $x+$newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$pic_margin*2,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic4_src'], $x+$newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$newtest[$j]['pic3_img_x']+$pic_margin*3,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pic_x=$x+round(($newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$newtest[$j]['pic3_img_x']+$newtest[$j]['pic4_img_x'])/2,2)-6;
                       $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                       $title = strtr($newtest[$j]['title'], '.', ' ');
                       $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                   }

                   $page_local=$page_local+$newtest[$j]['height'];
                   $page_local=$page_local+$lineheight;
               }



               if($newtest[$j]['page']>0 && $newtest[$j]['page']<$pagesum)
               {
                   $pdf->AddPage();
                   $page_local=$margin_top;
                   //  $pdf->MultiCell(50, 10,2323, $border=0, $align='L',$fill=false, $ln=1, $x='20', $y='10',  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
               }

           }

       }
       if($scorekind==2)
       {
           //2.读取习题中的图片信息

           for($i=0;$i<$count;$i++)
           {
               $testimg_data=$model_img_cuted->where('id='.$data[$i]['srcid'])->find();

               $sum=0;
               $maxheight=0;
               $max_o_height=0;
               $pic_all_width=0;
               $pic_all_o_width=0;


               //3.将习题信息存入新数组
               $test[$i]['title']=$data[$i]['inputval'];
               $test[$i]['src']=$testimg_data['src'];
               $test[$i]['kind']=$data[$i]['inputname'];
               $test[$i]['img_o_x']=imgxymm($testimg_data['src'],$dpi)['x'];
               $test[$i]['img_o_y']=imgxymm($testimg_data['src'],$dpi)['y'];
               $test[$i]['img_x']=round(imgxymm($testimg_data['src'],$dpi)['x']/$imagescale,2);
               $test[$i]['img_y']=round(imgxymm($testimg_data['src'],$dpi)['y']/$imagescale,2);


               //4.判断习题对应图片信息
               if($data[$i]['pic1']!=0)
               {
                   $picta=$model_img_cuted->where('id='.$data[$i]['pic1'])->find();
                   $test[$i]['pic1_src']=$picta['src'];

                   ///计算出来配图的原始宽度和高度及视图中的宽度和高度
                   $test[$i]['pic1_img_x']=round(imgxymm($picta['src'],$dpi)['x']/$imagescale,2);
                   $test[$i]['pic1_img_y']=round(imgxymm($picta['src'],$dpi)['y']/$imagescale,2);


                   $test[$i]['pic1_o_img_x']=imgxymm($picta['src'],$dpi)['x'];
                   $test[$i]['pic1_o_img_y']=imgxymm($picta['src'],$dpi)['y'];

                   $sum=$sum+1;
                   $maxheight=$test[$i]['pic1_img_y'];
                   $max_o_height=$test[$i]['pic1_o_img_y'];
                   $pic_all_width=$pic_all_width+$test[$i]['pic1_img_x'];
                   $pic_all_o_width=$pic_all_o_width+$test[$i]['pic1_o_img_x'];

               }
               else{
                   $test[$i]['pic1_src']=0;
                   $test[$i]['pic1_img_x']=0;
                   $test[$i]['pic1_img_y']=0;

                   $test[$i]['pic1_o_img_x']=0;
                   $test[$i]['pic1_o_img_y']=0;
               }
               if($data[$i]['pic2']!=0)
               {
                   $picta=$model_img_cuted->where('id='.$data[$i]['pic2'])->find();
                   $test[$i]['pic2_src']=$picta[src];


                   $test[$i]['pic2_img_x']=round(imgxymm($picta['src'],$dpi)['x']/$imagescale,2);
                   $test[$i]['pic2_img_y']=round(imgxymm($picta['src'],$dpi)['y']/$imagescale,2);

                   $test[$i]['pic2_o_img_x']=imgxymm($picta['src'],$dpi)['x'];
                   $test[$i]['pic2_o_img_y']=imgxymm($picta['src'],$dpi)['y'];

                   $sum=$sum+1;

                   if($test[$i]['pic2_img_y']>$maxheight)
                   {
                       $maxheight=$test[$i]['pic2_img_y'];
                   };

                   if($test[$i]['pic2_o_img_y']>$max_o_height)
                   {
                       $max_o_height=$test[$i]['pic2_o_img_y'];
                   }

                   $pic_all_width=$pic_all_width+$test[$i]['pic2_img_x'];
                   $pic_all_o_width=$pic_all_o_width+$test[$i]['pic2_o_img_x'];


               }
               else{
                   $test[$i]['pic2_src']=0;
                   $test[$i]['pic2_img_x']=0;
                   $test[$i]['pic2_img_y']=0;

                   $test[$i]['pic2_o_img_x']=0;
                   $test[$i]['pic2_o_img_y']=0;
               }
               if($data[$i]['pic3']!=0)
               {
                   $picta=$model_img_cuted->where('id='.$data[$i]['pic3'])->find();
                   $test[$i]['pic3_src']=$picta['src'];
                   $sum=$sum+1;

                   $test[$i]['pic3_img_x']=round(imgxymm($picta['src'],$dpi)['x']/$imagescale,2);
                   $test[$i]['pic3_img_y']=round(imgxymm($picta['src'],$dpi)['y']/$imagescale,2);

                   $test[$i]['pic3_o_img_x']=imgxymm($picta['src'],$dpi)['x'];
                   $test[$i]['pic3_o_img_y']=imgxymm($picta['src'],$dpi)['y'];


                   if($test[$i]['pic3_img_y']>$maxheight)
                   {
                       $maxheight=$test[$i]['pic3_img_y'];
                   };

                   if($test[$i]['pic3_o_img_y']>$max_o_height)
                   {
                       $max_o_height=$test[$i]['pic3_o_img_y'];
                   }

                   $pic_all_width=$pic_all_width+$test[$i]['pic3_img_x'];
                   $pic_all_o_width=$pic_all_o_width+$test[$i]['pic3_o_img_x'];

               }
               else{
                   $test[$i]['pic3_src']=0;
                   $test[$i]['pic3_img_x']=0;
                   $test[$i]['pic3_img_y']=0;

                   $test[$i]['pic3_o_img_x']=0;
                   $test[$i]['pic3_o_img_y']=0;
               }
               if($data[$i]['pic4']!=0)
               {
                   $picta=$model_img_cuted->where('id='.$data[$i]['pic4'])->find();
                   $test[$i]['pic4_src']=$picta['src'];
                   $test[$i]['pic4_img_x']=round(imgxymm($picta['src'],$dpi)['x']/$imagescale,2);
                   $test[$i]['pic4_img_y']=round(imgxymm($picta['src'],$dpi)['y']/$imagescale,2);

                   $test[$i]['pic4_o_img_x']=imgxymm($picta['src'],$dpi)['x'];
                   $test[$i]['pic4_o_img_y']=imgxymm($picta['src'],$dpi)['y'];
                   $sum=$sum+1;


                   if($test[$i]['pic4_img_y']>$maxheight)
                   {
                       $maxheight=$test[$i]['pic4_img_y'];
                   };

                   if($test[$i]['pic4_o_img_y']>$max_o_height) {
                       $max_o_height = $test[$i]['pic4_o_img_y'];
                   }

                   $pic_all_width=$pic_all_width+$test[$i]['pic4_img_x'];
                   $pic_all_o_width=$pic_all_o_width+$test[$i]['pic4_o_img_x'];

               }
               else{
                   $test[$i]['pic4_src']=0;
                   $test[$i]['pic4_img_x']=0;
                   $test[$i]['pic4_img_y']=0;

                   $test[$i]['pic4_o_img_x']=0;
                   $test[$i]['pic4_o_img_y']=0;
               }

               $test[$i]['pic_maxheight']=$maxheight;
               $test[$i]['pic_max_o_height']=$max_o_height;
               $test[$i]['picsum']=$sum;

               $test[$i]['pic_all_o_width']=$pic_all_o_width;
               if($sum>=1)
               {
                   $test[$i]['pic_all_width']=$pic_all_width+($sum*$pic_margin);
                   $test[$i]['test_all_height']=$test[$i]['pic_maxheight']+$test[$i]['img_y']+$pic_height;
                   $test[$i]['test_all_o_height']=$test[$i]['pic_o_maxheight']+$test[$i]['img_o_y']+$pic_height;
               }
               else
               {
                   $test[$i]['pic_all_width']=$pic_all_width;
                   $test[$i]['test_all_height']=$test[$i]['pic_maxheight']+$test[$i]['img_y'];
                   $test[$i]['test_all_o_height']=$test[$i]['pic_o_maxheight']+$test[$i]['img_o_y'];
               }
           }

           // 重新编辑排版结构


           $test_size=sizeof($test);

           $newtest[0]['title']=$paper_name;
           $newtest[0]['kind']='headtitle';
           $newtest[0]['font_size']=$title_font_size;
           $newtest[0]['height']=$title_font_height;
           $newtest[0]['src']=0;
           $newtest[0]['pic1_src']=0;
           $newtest[0]['pic2_src']=0;
           $newtest[0]['pic3_src']=0;
           $newtest[0]['pic4_src']=0;
           $newtest[0]['pic1_img_x']=0;
           $newtest[0]['pic1_img_y']=0;
           $newtest[0]['pic2_img_x']=0;
           $newtest[0]['pic2_img_y']=0;
           $newtest[0]['pic3_img_x']=0;
           $newtest[0]['pic3_img_y']=0;
           $newtest[0]['pic4_img_x']=0;
           $newtest[0]['pic4_img_y']=0;
           $newtest[0]['img_x']=0;
           $newtest[0]['img_y']=0;
           $newtest[0]['picsum']=0;
           $newtest[0]['picswidth']=0;
           $newtest[0]['pic_maxheight']=0;

           $newtest[1]['title']='0';
           $newtest[1]['kind']='title_line_height';
           $newtest[1]['font_size']=$title_line_font_size;
           $newtest[1]['height']=$title_line_height;
           $newtest[1]['src']=0;
           $newtest[1]['pic1_src']=0;
           $newtest[1]['pic2_src']=0;
           $newtest[1]['pic3_src']=0;
           $newtest[1]['pic4_src']=0;
           $newtest[1]['pic1_img_x']=0;
           $newtest[1]['pic1_img_y']=0;
           $newtest[1]['pic2_img_x']=0;
           $newtest[1]['pic2_img_y']=0;
           $newtest[1]['pic3_img_x']=0;
           $newtest[1]['pic3_img_y']=0;
           $newtest[1]['pic4_img_x']=0;
           $newtest[1]['pic4_img_y']=0;
           $newtest[1]['img_x']=0;
           $newtest[1]['img_y']=0;
           $newtest[1]['picsum']=0;
           $newtest[1]['picswidth']=0;
           $newtest[1]['pic_maxheight']=0;


           $newtest[2]['title']=$testnote;
           $newtest[2]['kind']='note';
           $newtest[2]['font_size']=$note_font_size;
           $newtest[2]['height']=$note_font_height;
           $newtest[2]['src']=0;
           $newtest[2]['pic1_src']=0;
           $newtest[2]['pic2_src']=0;
           $newtest[2]['pic3_src']=0;
           $newtest[2]['pic4_src']=0;
           $newtest[2]['pic1_img_x']=0;
           $newtest[2]['pic1_img_y']=0;
           $newtest[2]['pic2_img_x']=0;
           $newtest[2]['pic2_img_y']=0;
           $newtest[2]['pic3_img_x']=0;
           $newtest[2]['pic3_img_y']=0;
           $newtest[2]['pic4_img_x']=0;
           $newtest[2]['pic4_img_y']=0;
           $newtest[2]['img_x']=0;
           $newtest[2]['img_y']=0;
           $newtest[2]['picsum']=0;
           $newtest[2]['picswidth']=0;
           $newtest[2]['pic_maxheight']=0;

           $newtest[3]['title']='0';
           $newtest[3]['kind']='note_line_height';
           $newtest[3]['font_size']=$note_line_font_size;
           $newtest[3]['height']=$note_line_height;
           $newtest[3]['src']=0;
           $newtest[3]['pic1_src']=0;
           $newtest[3]['pic2_src']=0;
           $newtest[3]['pic3_src']=0;
           $newtest[3]['pic4_src']=0;
           $newtest[3]['pic1_img_x']=0;
           $newtest[3]['pic1_img_y']=0;
           $newtest[3]['pic2_img_x']=0;
           $newtest[3]['pic2_img_y']=0;
           $newtest[3]['pic3_img_x']=0;
           $newtest[3]['pic3_img_y']=0;
           $newtest[3]['pic4_img_x']=0;
           $newtest[3]['pic4_img_y']=0;
           $newtest[3]['img_x']=0;
           $newtest[3]['img_y']=0;
           $newtest[3]['picsum']=0;
           $newtest[3]['picswidth']=0;
           $newtest[3]['pic_maxheight']=0;



           $m=4;
           for($j=0;$j<$test_size;$j++)
           {
               $newtest[$m]['title']=$test[$j]['title'];

               if($test[$j]['kind']=='title' && $test[$j]['src']!='')
               {
                   $newtest[$m]['kind']='sertitle';
                   $newtest[$m]['font_size']=$p1_font_size;
                   $newtest[$m]['height']=$test[$j]['test_all_height']+$lineheight+$p1_font_height;
                   $newtest[$m]['img_x']=$test[$j]['img_x'];
                   $newtest[$m]['img_y']=$test[$j]['img_y'];
               }
               else
               {
                   $newtest[$m]['kind']='title';
                   $newtest[$m]['font_size']=$p1_font_size;
                   $newtest[$m]['height']=$p1_font_height;
                   $newtest[$m]['img_x']=0;
                   $newtest[$m]['img_y']=0;
               }
               if($test[$j]['kind']=='titleanswer')
               {
                   $newtest[$m]['kind']='titleanswer';
                   $newtest[$m]['font_size']=$p1_font_size;
                   $newtest[$m]['height']=$test[$j]['test_all_height']+$lineheight+$p1_font_height;
                   $newtest[$m]['img_x']=$test[$j]['img_x'];
                   $newtest[$m]['img_y']=$test[$j]['img_y'];

               }
               if($test[$j]['kind']=='answer')
               {
                   $newtest[$m]['kind']='answer';
                   $newtest[$m]['font_size']=$p1_font_size;
                   $newtest[$m]['height']=$test[$j]['test_all_height'];
                   $newtest[$m]['img_x']=$test[$j]['img_x'];
                   $newtest[$m]['img_y']=$test[$j]['img_y'];

               }



               $newtest[$m]['src']=$test[$j]['src'];
               $newtest[$m]['pic1_src']=$test[$j]['pic1_src'];
               $newtest[$m]['pic2_src']=$test[$j]['pic2_src'];
               $newtest[$m]['pic3_src']=$test[$j]['pic3_src'];
               $newtest[$m]['pic4_src']=$test[$j]['pic4_src'];
               $newtest[$m]['pic1_img_x']=$test[$j]['pic1_img_x'];
               $newtest[$m]['pic1_img_y']=$test[$j]['pic1_img_y'];
               $newtest[$m]['pic2_img_x']=$test[$j]['pic2_img_x'];
               $newtest[$m]['pic2_img_y']=$test[$j]['pic2_img_y'];
               $newtest[$m]['pic3_img_x']=$test[$j]['pic3_img_x'];
               $newtest[$m]['pic3_img_y']=$test[$j]['pic3_img_y'];
               $newtest[$m]['pic4_img_x']=$test[$j]['pic4_img_x'];
               $newtest[$m]['pic4_img_y']=$test[$j]['pic4_img_y'];
               $newtest[$m]['pic_maxheight']=$test[$j]['pic_maxheight'];


               $newtest[$m]['picswidth']=$test[$j]['pic_all_width'];
               $newtest[$m]['pics_sum']=$test[$j]['picsum'];
               $newtest[$m]['page']=0;

               $m=$m+1;

           }

           $newtestlength=sizeof($newtest);

           $sumheight=$margin_top;
           $nextsumheight=0;


           $standheight=$wordheight-$margin_top-$margin_top;
           $m=0;$n=0;
           for($i=0;$i<$newtestlength-1;$i++)
           {
               $m=$i+1;
               $sumheight=$sumheight+$newtest[$i]['height']+$lineheight;
               $nextsumheight=$sumheight+$newtest[$m]['height']+$lineheight;

               if($sumheight<=$standheight && $nextsumheight>=$standheight)
               {
                   $newtest[$i]['page']=$pagenum;
                   $pagenum=$pagenum+1;
                   $sumheight=$margin_top;
                   $nextsumheight=0;
               }
               else
               {
                   $newtest[$i]['page']=0;
               }

           }

           $newtest[$newtestlength-1]['page']=$pagenum;

           $pagesum=$pagenum;





           $pdf = new \TCPDF('P', 'mm', array($wordwidth,$wordheight), true, 'UTF-8', false);

           //页眉：43，页面高度：1160

// 设置文档信息
           $pdf->SetCreator('hzjoo');
           $pdf->SetAuthor('hzjoo');
           $pdf->SetTitle('好好学习，天天向上！');
           $pdf->SetSubject('hzjoo');
           $pdf->SetKeywords('hzjoo');

// 设置页眉和页脚信息
           $pdf->setPrintHeader(false);
           $pdf->setPrintFooter(true);
// 设置页眉和页脚字体
           //$pdf->setHeaderFont(Array('stsongstdlight', '', '30'));
           // $pdf->setFooterFont(Array('stsongstdlight', '', '2'));

// 设置默认等宽字体
           $pdf->SetDefaultMonospacedFont('stsongstdlight');
           $pdf->setFontSubsetting(true);

// 设置间距,中间80表示到页面顶端的距离
//        $pdf->SetMargins(0, $margin_top, 0);
//        $pdf->SetHeaderMargin(5);
           $pdf->SetFooterMargin(20);
           $pdf->setFooterFont(Array('stsongstdlight', '100', 10));
// 设置分页
           $pdf->SetAutoPageBreak(TRUE, 25);

// set image scale factor
           $pdf->setImageScale($imagescale);

//设置字体

           $pdf->AddPage();
           $pdf->SetMargins(0, 0, 0);

           // 进入循环添加信息

           $page_local=$margin_top;
           $test_size=sizeof($newtest);
           for($j=0;$j<$test_size;$j++)
           {
               if($newtest[$j]['kind']=='headtitle')
               {
                   //设置字体
                   $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                   //进行写入
                   $pdf->MultiCell($wordwidth,$newtest[$j]['height'],$newtest[$j]['title'], $border=0, $align='C',$fill=false, $ln=1, $x='0', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                   $page_local=$page_local+$newtest[$j]['height']+$lineheight;
               }

               if($newtest[$j]['kind']=='title_line_height')
               {
                   $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                   $page_local=$page_local+$newtest[$j]['height']+$lineheight;

               }

               if($newtest[$j]['kind']=='note')
               {
                   //设置字体
                   $pdf->SetFont('stsongstdlight', '',$newtest[$j]['font_size']);
                   $pdf->MultiCell(180,$newtest[$j]['font_size'],'<span style="letter-spacing: 3px">'.$newtest[$j]['title'].'</span>', $border=0, $align='C',$fill=false, $ln=1, $x='10', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

                   $page_local=$page_local+$newtest[$j]['height']+$lineheight;
               }

               if($newtest[$j]['kind']=='note_line_height')
               {
                   $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                   $page_local=$page_local+$newtest[$j]['height']+$lineheight;
               }

               if($newtest[$j]['kind']=='title')
               {
                   $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                   $pdf->MultiCell(180, 20,$newtest[$j]['title'], $border=0, $align='L',$fill=false, $ln=1, $x='10', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                   $page_local=$page_local+$newtest[$j]['height'];
                   $page_local=$page_local+$lineheight;
               }

               if($newtest[$j]['kind']=='titleanswer'  || $newtest[$j]['kind']=='sertitle')
               {
                   $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                   $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.$newtest[$j]['title'].'</span>', $border=0, $align='L',$fill=false, $ln=1, $x='20', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

                   $page_local=$page_local+$p1_font_height;

                   $pdf->Image($newtest[$j]['src'], 23,$page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);

                   if($newtest[$j]['pics_sum']==1)
                   {
                       $pic_page_local=$page_local+$newtest[$j]['img_y'];
                       $x=$wordwidth-$newtest[$j]['picswidth']-30;
                       $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pic_x=$x+round($newtest[$j]['pic1_img_x']/2,2)-6;
                       $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                       $title = strtr($newtest[$j]['title'], '.', ' ');
                       $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                   }

                   if($newtest[$j]['pics_sum']==2)
                   {
                       $pic_page_local=$page_local+$newtest[$j]['img_y'];
                       $x=$wordwidth-$newtest[$j]['picswidth'];
                       $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic2_src'], $x+$newtest[$j]['pic1_img_x']+$pic_margin,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pic_x=$x+round(($newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x'])/2,2)-6;
                       $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                       $title = strtr($newtest[$j]['title'], '.', ' ');
                       $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                   }
                   if($newtest[$j]['pics_sum']==3) {
                       $pic_page_local=$page_local+$newtest[$j]['img_y'];
                       $x=$wordwidth-$newtest[$j]['picswidth'];
                       $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic2_src'], $x+$newtest[$j]['pic1_img_x']+$pic_margin,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic3_src'], $x+$newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$pic_margin*2,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pic_x=$x+round(($newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$newtest[$j]['pic3_img_x'])/2,2)-6;
                       $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                       $title = strtr($newtest[$j]['title'], '.', ' ');
                       $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                   }
                   if($newtest[$j]['pics_sum']==4)
                   {
                       $pic_page_local=$page_local+$newtest[$j]['img_y'];
                       $x=$wordwidth-$newtest[$j]['picswidth'];
                       $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic2_src'], $x+$newtest[$j]['pic1_img_x']+$pic_margin,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic3_src'], $x+$newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$pic_margin*2,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic4_src'], $x+$newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$newtest[$j]['pic3_img_x']+$pic_margin*3,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pic_x=$x+round(($newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$newtest[$j]['pic3_img_x']+$newtest[$j]['pic4_img_x'])/2,2)-6;
                       $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                       $title = strtr($newtest[$j]['title'], '.', ' ');
                       $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                   }

                   $page_local=$page_local+$newtest[$j]['height']-$p1_font_height;
                   $page_local=$page_local+$lineheight;
               }


               if($newtest[$j]['kind']=='answer')
               {
                   $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                   $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.$newtest[$j]['title'].'</span>', $border=0, $align='L',$fill=false, $ln=1, $x='20', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);


                   $pdf->Image($newtest[$j]['src'],30,$page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);

                   if($newtest[$j]['pics_sum']==1)
                   {
                       $pic_page_local=$page_local+$newtest[$j]['img_y'];
                       $x=$wordwidth-$newtest[$j]['picswidth']-30;
                       $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pic_x=$x+round($newtest[$j]['pic1_img_x']/2,2)-6;
                       $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                       $title = strtr($newtest[$j]['title'], '.', ' ');
                       $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                   }

                   if($newtest[$j]['pics_sum']==2)
                   {
                       $pic_page_local=$page_local+$newtest[$j]['img_y'];
                       $x=$wordwidth-$newtest[$j]['picswidth'];
                       $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic2_src'], $x+$newtest[$j]['pic1_img_x']+$pic_margin,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pic_x=$x+round(($newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x'])/2,2)-6;
                       $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                       $title = strtr($newtest[$j]['title'], '.', ' ');
                       $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                   }
                   if($newtest[$j]['pics_sum']==3) {
                       $pic_page_local=$page_local+$newtest[$j]['img_y'];
                       $x=$wordwidth-$newtest[$j]['picswidth'];
                       $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic2_src'], $x+$newtest[$j]['pic1_img_x']+$pic_margin,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic3_src'], $x+$newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$pic_margin*2,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pic_x=$x+round(($newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$newtest[$j]['pic3_img_x'])/2,2)-6;
                       $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                       $title = strtr($newtest[$j]['title'], '.', ' ');
                       $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                   }
                   if($newtest[$j]['pics_sum']==4)
                   {
                       $pic_page_local=$page_local+$newtest[$j]['img_y'];
                       $x=$wordwidth-$newtest[$j]['picswidth'];
                       $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic2_src'], $x+$newtest[$j]['pic1_img_x']+$pic_margin,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic3_src'], $x+$newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$pic_margin*2,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pdf->Image($newtest[$j]['pic4_src'], $x+$newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$newtest[$j]['pic3_img_x']+$pic_margin*3,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                       $pic_x=$x+round(($newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$newtest[$j]['pic3_img_x']+$newtest[$j]['pic4_img_x'])/2,2)-6;
                       $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                       $title = strtr($newtest[$j]['title'], '.', ' ');
                       $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                   }

                   $page_local=$page_local+$newtest[$j]['height'];
                   $page_local=$page_local+$lineheight;
               }

               if($newtest[$j]['page']>0 && $newtest[$j]['page']<$pagesum)
               {
                   $pdf->AddPage();
                   $page_local=$margin_top;
                   //  $pdf->MultiCell(50, 10,2323, $border=0, $align='L',$fill=false, $ln=1, $x='20', $y='10',  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
               }


           }
       }
    }


    if($outkind=='I')
    {
        $pdf->Output('ctbtest.pdf', 'I');
    }
    if($outkind=='D')
    {
        $pdf->Output('ctbtest.pdf', 'D');
    }
}

function pxtomm($px,$dpi)
{
    return round(($px/$dpi)*25.4,2);
}

function mmtopx($mm,$dpi)
{
    return round(($mm/25.4)*$dpi,2);
}

//替换标题类型
function replacetitlekind($msg)
{
    if(strpos($msg,"(T+A)",0)>0)
    {
        return  str_replace("(T+A)"," ",$msg);
    };

    if(strpos($msg,"(A)",0)>0)
    {
        return  str_replace("(A)"," ",$msg);
    };

    if(strpos($msg,"(T)",0)>0)
    {
        return  str_replace("(T)"," ",$msg);
    };
}

//答案转pdf
function preanswerpdf01($paper_name,$filesernum,$operkind){
    $imgscale=0.371;

    $model = M('test_public_data');
    $model1= M('img_cuted_data');
    $model2=M('paper_msg_data');

    $array[kind]='test';
    $array[filesernum]=$filesernum;
    $data= $model->where($array)->order('in_ser asc')->select();
    $count=$model->where($array)->count();

    $array12['filesernum'] =$filesernum;
    $nomsg = $model2->where($array12)->find();
    $title=$nomsg['paper_name'];

    for($i=0;$i<$count;$i++)
    {
        $ta=$model1->where('id='.$data[$i][srcid])->find();
        $answerid=$ta['answerid'];

        if($answerid!=0)
        {
            $aa=$model1->where('id='.$answerid)->find();
            $answer[$i][src]=$aa[src];
        }
        else
        {
            $answer[$i][src]=0;
        }

        if(strpos($answer[$i][src],'uploads')==true) {

            $answer[$i]['kind']=1;
        }
        else
        {
            $answer[$i]['kind']=0;
        }

        $answer[$i]['title']=cuttitlemsg($data[$i][inputval]);
        $answer[$i]['src']=$aa[src];
        $answer[$i]['img_x']=imgxy($aa[src])[x]*$imgscale;
        $answer[$i]['img_y']=imgxy($aa[src])[y]*$imgscale;

    }

    $pdf = new \TCPDF('P', 'mm', array(874.89,1232.25), true, 'UTF-8', false);
// 设置文档信息
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(true);

    $pdf->SetCreator('haohaoCtb');
    $pdf->SetAuthor('haohaoCtb');
    $pdf->SetTitle('好好学习，天天向上！');
    $pdf->SetSubject('错题本');
    $pdf->SetKeywords('错题本答案');

// 设置页眉和页脚信息
    $pdf->SetHeaderData('', '0', '好好错题本——好好学习，天天向上', array(0,64,255), array(0,64,128));
//        $pdf->setFooterData(array(0,64,0), array(0,64,128));
// 设置页眉和页脚字体
    $pdf->setHeaderFont(Array('stsongstdlight', '', '30'));

// 设置默认等宽字体
    $pdf->SetDefaultMonospacedFont('stsongstdlight');
    $pdf->setFontSubsetting(true);

// 设置间距,中间80表示到页面顶端的距离
    $pdf->SetMargins(35, 80, 35);
    $pdf->SetHeaderMargin(5);
    $pdf->SetFooterMargin(25);
    $pdf->setFooterFont(Array('stsongstdlight', '100', 30));
// 设置分页
    $pdf->SetAutoPageBreak(TRUE, 25);

// set image scale factor
    $pdf->setImageScale(0.95);
//设置字体
    $pdf->SetFont('stsongstdlight', '', 80);
    $pdf->AddPage();
    $pdf->Write(0,$title.'答案','', 0, 'C', true, 0, false, false, 0);
    $pdf->SetFont('stsongstdlight', '', 40);

    $height=148;

    $leaveheight=1180;
    $levelwidth=780;

    $between_test_height=10;
    $bottom=0;
    $left=10;


    for($j=0;$j<$count;$j++)
    {


        if($answer[$j][kind]==1)
        {
            $text_img_leng=font_img_size_sub($answer[$j][title],7,(int)$answer[$j]['img_x']);
            $text_leng=fontsizesub($answer[$j][title],6);

            //宽度大于行宽的时候，进行换行

            if($left+$text_img_leng>$levelwidth)
            {
                $left=10;
                $height=$height+$bottom+35;
            }
//总体高度高于整个页面的时候，需要插入下一页
            if($height+(int)$answer[$j]['img_y']>$leaveheight)
            {
                $pdf->AddPage();
                $left=10;
                $height=30;
                $bottom=0;
            }

            $pdf->MultiCell(60, 20,$answer[$j][title], $border=0, $align='R',$fill=false, $ln=1, $x=$left, $y=(int)$height,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

            $img_left=$left+$text_leng;

            $pdf->Image($answer[$j][src], $img_left,$height+1, '', '', '', '', '', false, 300, '', false, false, 0, false, false, false);

            $left=$left+$text_img_leng;

            if($bottom<(int)$answer[$j]['img_y'])
            {
                $bottom=(int)$answer[$j]['img_y'];
            }
            if($bottom<14)
            {
                $bottom=14;
            }
        }

        else
        {
            $text_leng=fontsizesub($answer[$j][title],7);

            if($left+$text_leng>$levelwidth)
            {
                $left=10;
                $height=$height+$bottom+35;
            }

            if($height+14>$leaveheight)
            {
                $pdf->AddPage();
                $left=10;
                $height=30;
                $bottom=0;
            }


            $pdf->MultiCell(60, 20,$answer[$j]['title'], $border=0, $align='R',$fill=false, $ln=1, $x=$left, $y=(int)$height,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

            $left=$left+$text_leng;


            if($bottom<14)
            {
                $bottom=14;
            }
        }
    }


    $pdf->Output($paper_name.'.pdf', $operkind);

}

//数字转化成大些
//数字转化成中文小于10000
function cnnum($num) {
    $num1000='';$num100='';$num10='';$num1='';
    $msg1000='';$msg100='';$msg10='';$msg1='';

    if($num>=0 && $num<10) {
        $num1= $num;
    }

    if($num>=10 && $num<100) {
        $num10 = intval($num / 10);
        $num=$num%10;
        $num1= $num;
    }

    if($num>=100 && $num<1000) {
        $num100 = intval($num / 100);
        $num=$num%100;
        $num10 = intval($num / 10);
        $num=$num%10;
        $num1= $num;
    }

    if($num>=1000 && $num<=9999)
    {
        $num1000=intval($num/1000);
        $num=$num%1000;
        $num100 = intval($num / 100);
        $num=$num%100;
        $num10 = intval($num / 10);
        $num=$num%10;
        $num1= $num;

    }

    switch($num1000)
    {
        case 1:$msg1000="一千";break;
        case 2:$msg1000="二千";break;
        case 3:$msg1000="三千";break;
        case 4:$msg1000="四千";break;
        case 5:$msg1000="五千";break;
        case 6:$msg1000="六千";break;
        case 7:$msg1000="七千";break;
        case 8:$msg1000="八千";break;
        case 9:$msg1000="九千";break;
    }

    switch($num100)
    {
        case 1:$msg100="一百";break;
        case 2:$msg100="二百";break;
        case 3:$msg100="三百";break;
        case 4:$msg100="四百";break;
        case 5:$msg100="五百";break;
        case 6:$msg100="六百";break;
        case 7:$msg100="七百";break;
        case 8:$msg100="八百";break;
        case 9:$msg100="九百";break;
    }

    switch($num10)
    {
        case 1:$msg10="十";break;
        case 2:$msg10="二十";break;
        case 3:$msg10="三十";break;
        case 4:$msg10="四十";break;
        case 5:$msg10="五十";break;
        case 6:$msg10="六十";break;
        case 7:$msg10="七十";break;
        case 8:$msg10="八十";break;
        case 9:$msg10="九十";break;
    }
    switch($num1)
    {
        case 1:$msg1="一";break;
        case 2:$msg1="二";break;
        case 3:$msg1="三";break;
        case 4:$msg1="四";break;
        case 5:$msg1="五";break;
        case 6:$msg1="六";break;
        case 7:$msg1="七";break;
        case 8:$msg1="八";break;
        case 9:$msg1="九";break;
    }

    return $msg=$msg1000.$msg100.$msg10.$msg1;
}



//个人知识点试卷习题转化成标准结构的试题
function mykey_persontest_to_standtest($testid)
{
    //试卷id，试卷是教师生成试卷，还是学生个人生成试卷


    $model=M('key_stumytest');

//调出数据
    $model_test_public=M('test_public_data');
    $data=$model->where('id='.$testid)->find();
  
    $ctbquestionid=$data['questionid'];
    $typeidarr=$data['typeidarr'];


    $ctbquestionarr=explode(',',$ctbquestionid);
    $typeidarr=explode(',',$typeidarr);
    $count=sizeof($ctbquestionarr);

    $typeid=0;
    $m=0;
    for($i=0;$i<$count;$i++)
    {
        if($typeidarr[$i]!=$typeid)
        {
            $oldtestdata[$m]['id']=0;
            $oldtestdata[$m]['typeid']=$typeidarr[$i];
            $oldtestdata[$m]['kind']='t0';
            $oldtestdata[$m]['in_ser']=$m;
            $typeid=$typeidarr[$i];
            $m=$m+1;
        }
        $oldtestdata[$m]['id']=$ctbquestionarr[$i];
        $oldtestdata[$m]['typeid']=$typeidarr[$i];
        $oldtestdata[$m]['kind']='toa';
        $oldtestdata[$m]['in_ser']=$m;
        $m=$m+1;
    }
    //形成新的数组

//    return $oldtestdata;


    $count=$m;

    for($i=0;$i<$count;$i++)
    {
        $id=$oldtestdata[$i]['id'];
        if($id!=0)
        {
            $mydata=$model_test_public->where('id='.$id)->find();
            $testdata[$i]['id']=$oldtestdata[$i]['id'];
            $testdata[$i]['in_ser']=$oldtestdata[$i]['in_ser'];
            $testdata[$i]['typeid']=$oldtestdata[$i]['typeid'];

            $testdata[$i]['srcid']=$mydata['srcid'];
            $testdata[$i]['pic1']=$mydata['pic1'];
            $testdata[$i]['pic2']=$mydata['pic2'];
            $testdata[$i]['pic3']=$mydata['pic3'];
            $testdata[$i]['pic4']=$mydata['pic4'];
            $testdata[$i]['tsernum']=$mydata['tsernum'];
            $testdata[$i]['ctbname']=$mydata['ctbname'];
            $testdata[$i]['kind']=$mydata['kind'];
            $testdata[$i]['picsum']=$mydata['picsum'];
            $testdata[$i]['inputname']=$mydata['inputname'];
            $testdata[$i]['inputval']='';
            $testdata[$i]['filesernum']=$mydata['filesernum'];
            $testdata[$i]['align']=$mydata['align'];
            $testdata[$i]['imgdisplay']=$mydata['imgdisplay'];
            $testdata[$i]['questionscore']=$mydata['questionscore'];

            //srcid, in_ser, pic1, pic2, pic3, pic4, tsernum, ctbname, kind, picsum, inputname, inputval, filesernum, align, imgdisplay, typeid, questionscore

        }
        else
        {
            $testdata[$i]['id']=$oldtestdata[$i]['id'];
            $testdata[$i]['in_ser']=$oldtestdata[$i]['in_ser'];
            $testdata[$i]['typeid']=$oldtestdata[$i]['typeid'];

            $testdata[$i]['srcid']=0;
            $testdata[$i]['pic1']=0;
            $testdata[$i]['pic2']=0;
            $testdata[$i]['pic3']=0;
            $testdata[$i]['pic4']=0;
            $testdata[$i]['tsernum']=0;
            $testdata[$i]['ctbname']='t0';
            $testdata[$i]['kind']='test';
            $testdata[$i]['picsum']=0;
            $testdata[$i]['inputname']='title';
            $testdata[$i]['inputval']='';
            $testdata[$i]['filesernum']='';
            $testdata[$i]['align']='left';
            $testdata[$i]['imgdisplay']='none';
            $testdata[$i]['questionscore']=0;
        }


    }


    //如果有a类型习题，那么需要添加t1类型标题。完形填空，添加完形标题。

    $m=0;
    $tsernum='aa';
    for($i=0;$i<$count;$i++)
    {
        if($testdata[$i]['tsernum']!=0 && $testdata[$i]['ctbname']=='a' && $tsernum!=$testdata[$i]['tsernum'])
        {

//                echo '<hr>'.$m.'<hr>';
            $arr['tsernum']=$testdata[$i]['tsernum'];
            $arr['filesernum']=$testdata[$i]['filesernum'];
            $arr['ctbname']='t1';
            $mydata=$model_test_public->where($arr)->find();

            $newtestdata[$m]['id']=0;
            $newtestdata[$m]['in_ser']=$m;
            $newtestdata[$m]['typeid']=$testdata[$i]['typeid'];



            $newtestdata[$m]['srcid']=$mydata['srcid'];


            $newtestdata[$m]['pic1']=$mydata['pic1'];
            $newtestdata[$m]['pic2']=$mydata['pic2'];
            $newtestdata[$m]['pic3']=$mydata['pic3'];
            $newtestdata[$m]['pic4']=$mydata['pic4'];
            $newtestdata[$m]['tsernum']=$mydata['tsernum'];
            $newtestdata[$m]['ctbname']=$mydata['ctbname'];
            $newtestdata[$m]['kind']=$mydata['kind'];
            $newtestdata[$m]['picsum']=$mydata['picsum'];
            $newtestdata[$m]['inputname']=$mydata['inputname'];
            $newtestdata[$m]['inputval']='';
            $newtestdata[$m]['filesernum']=$mydata['filesernum'];
            $newtestdata[$m]['align']=$mydata['align'];
            $newtestdata[$m]['imgdisplay']=$mydata['imgdisplay'];
            $newtestdata[$m]['questionscore']=$mydata['questionscore'];
            $tsernum=$newtestdata[$i]['tsernum'];
            $m=$m+1;
        }


        $newtestdata[$m]['id']=$testdata[$i]['id'];
        $newtestdata[$m]['in_ser']=$m;
        $newtestdata[$m]['typeid']=$testdata[$i]['typeid'];
        $newtestdata[$m]['srcid']=$testdata[$i]['srcid'];
        $newtestdata[$m]['pic1']=$testdata[$i]['pic1'];
        $newtestdata[$m]['pic2']=$testdata[$i]['pic2'];
        $newtestdata[$m]['pic3']=$testdata[$i]['pic3'];
        $newtestdata[$m]['pic4']=$testdata[$i]['pic4'];
        $newtestdata[$m]['tsernum']=$testdata[$i]['tsernum'];
        $newtestdata[$m]['ctbname']=$testdata[$i]['ctbname'];
        $newtestdata[$m]['kind']=$testdata[$i]['kind'];
        $newtestdata[$m]['picsum']=$testdata[$i]['picsum'];
        $newtestdata[$m]['inputname']=$testdata[$i]['inputname'];
        $newtestdata[$m]['inputval']='';
        $newtestdata[$m]['filesernum']=$testdata[$i]['filesernum'];
        $newtestdata[$m]['align']=$testdata[$i]['align'];
        $newtestdata[$m]['imgdisplay']=$testdata[$i]['imgdisplay'];
        $newtestdata[$m]['questionscore']=$testdata[$i]['questionscore'];
        $m=$m+1;
    };

    //进行添加序号


    $count=$m;
    $k=1;
    $m=1;
    $n=1;
    $tsernum='aa';
    for($i=0;$i<$count;$i++)
    {
        if($newtestdata[$i]['ctbname']=='t0')
        {
            $newtestdata[$i]['inputval']=cnnum($k).'、';
            $k=$k+1;
            $m=1;
            $tsernum='aa';
        }
        else
        {
            if($newtestdata[$i]['ctbname']=='t1' || $newtestdata[$i]['ctbname']=='t-a')
            {
                $newtestdata[$i]['inputval']=$m.'.';
                $m=$m+1;
                $tsernum='aa';
            }

            if($newtestdata[$i]['ctbname']=='a' && $newtestdata[$i]['tsernum']==$tsernum)
            {
                $newtestdata[$i]['inputval']='('.$n.')';
                $tsernum=$newtestdata[$i]['tsernum'];
                $n=$n+1;
            }

            if($newtestdata[$i]['ctbname']=='a' && $newtestdata[$i]['tsernum']!=$tsernum)
            {

                $n=1;
                $newtestdata[$i]['inputval']='('.$n.')';
                $tsernum=$newtestdata[$i]['tsernum'];
                $n=$n+1;
            }

        }
    }

    return $newtestdata;
}







//个人试卷习题转化成标准结构的试题
function persontest_to_standtest($testid,$usertestkind)
{
    //试卷id，试卷是教师生成试卷，还是学生个人生成试卷

    if($usertestkind=='public')
    {
       $model=M('mytest');
       
    }else{
        $model=M('stumytest');
    }
//调出数据
    $model_test_public=M('test_public_data');
    $data=$model->where('id='.$testid)->find();
  
  //print_r($data);
  
  //return;

//    $paper_name=$data['paper_name'];
    if($usertestkind=='public')
    {
        $ctbquestionid=$data['ctbtestid'];
        $typeidarr=$data['typeidarr'];
    }else{
      
        $ctbquestionid=$data['ctbquestionid'];
        $typeidarr=$data['typeidarr'];

    }

    $ctbquestionarr=explode(',',$ctbquestionid);
    $typeidarr=explode(',',$typeidarr);
    $count=sizeof($ctbquestionarr);

    $typeid=0;
    $m=0;
    for($i=0;$i<$count;$i++)
    {
        if($typeidarr[$i]!=$typeid)
        {
            $oldtestdata[$m]['id']=0;
            $oldtestdata[$m]['typeid']=$typeidarr[$i];
            $oldtestdata[$m]['kind']='t0';
            $oldtestdata[$m]['in_ser']=$m;
            $typeid=$typeidarr[$i];
            $m=$m+1;
        }
        $oldtestdata[$m]['id']=$ctbquestionarr[$i];
        $oldtestdata[$m]['typeid']=$typeidarr[$i];
        $oldtestdata[$m]['kind']='toa';
        $oldtestdata[$m]['in_ser']=$m;
        $m=$m+1;
    }
    //形成新的数组

   // return $oldtestdata;


    $count=$m;

    for($i=0;$i<$count;$i++)
    {
        $id=$oldtestdata[$i]['id'];
        if($id!=0)
        {
            $mydata=$model_test_public->where('id='.$id)->find();
            $testdata[$i]['id']=$oldtestdata[$i]['id'];
            $testdata[$i]['in_ser']=$oldtestdata[$i]['in_ser'];
            $testdata[$i]['typeid']=$oldtestdata[$i]['typeid'];

            $testdata[$i]['srcid']=$mydata['srcid'];
            $testdata[$i]['pic1']=$mydata['pic1'];
            $testdata[$i]['pic2']=$mydata['pic2'];
            $testdata[$i]['pic3']=$mydata['pic3'];
            $testdata[$i]['pic4']=$mydata['pic4'];
            $testdata[$i]['tsernum']=$mydata['tsernum'];
            $testdata[$i]['ctbname']=$mydata['ctbname'];
            $testdata[$i]['kind']=$mydata['kind'];
            $testdata[$i]['picsum']=$mydata['picsum'];
            $testdata[$i]['inputname']=$mydata['inputname'];
            $testdata[$i]['inputval']='';
            $testdata[$i]['filesernum']=$mydata['filesernum'];
            $testdata[$i]['align']=$mydata['align'];
            $testdata[$i]['imgdisplay']=$mydata['imgdisplay'];
            $testdata[$i]['questionscore']=$mydata['questionscore'];

            //srcid, in_ser, pic1, pic2, pic3, pic4, tsernum, ctbname, kind, picsum, inputname, inputval, filesernum, align, imgdisplay, typeid, questionscore

        }
        else
        {
            $testdata[$i]['id']=$oldtestdata[$i]['id'];
            $testdata[$i]['in_ser']=$oldtestdata[$i]['in_ser'];
            $testdata[$i]['typeid']=$oldtestdata[$i]['typeid'];

            $testdata[$i]['srcid']=0;
            $testdata[$i]['pic1']=0;
            $testdata[$i]['pic2']=0;
            $testdata[$i]['pic3']=0;
            $testdata[$i]['pic4']=0;
            $testdata[$i]['tsernum']=0;
            $testdata[$i]['ctbname']='t0';
            $testdata[$i]['kind']='test';
            $testdata[$i]['picsum']=0;
            $testdata[$i]['inputname']='title';
            $testdata[$i]['inputval']='';
            $testdata[$i]['filesernum']='';
            $testdata[$i]['align']='left';
            $testdata[$i]['imgdisplay']='none';
            $testdata[$i]['questionscore']=0;
        }


    }
  

  


    //如果有a类型习题，那么需要添加t1类型标题。完形填空，添加完形标题。

    $m=0;
    $tsernum='aa';
    for($i=0;$i<$count;$i++)
    {
        if($testdata[$i]['tsernum']!=0 && $testdata[$i]['ctbname']=='a' && $tsernum!=$testdata[$i]['tsernum'])
        {

//                echo '<hr>'.$m.'<hr>';
            $arr['tsernum']=$testdata[$i]['tsernum'];
            $arr['filesernum']=$testdata[$i]['filesernum'];
            $arr['ctbname']='t1';
            $mydata=$model_test_public->where($arr)->find();

            $newtestdata[$m]['id']=0;
            $newtestdata[$m]['in_ser']=$m;
            $newtestdata[$m]['typeid']=$testdata[$i]['typeid'];



            $newtestdata[$m]['srcid']=$mydata['srcid'];


            $newtestdata[$m]['pic1']=$mydata['pic1'];
            $newtestdata[$m]['pic2']=$mydata['pic2'];
            $newtestdata[$m]['pic3']=$mydata['pic3'];
            $newtestdata[$m]['pic4']=$mydata['pic4'];
            $newtestdata[$m]['tsernum']=$mydata['tsernum'];
            $newtestdata[$m]['ctbname']=$mydata['ctbname'];
            $newtestdata[$m]['kind']=$mydata['kind'];
            $newtestdata[$m]['picsum']=$mydata['picsum'];
            $newtestdata[$m]['inputname']=$mydata['inputname'];
            $newtestdata[$m]['inputval']='';
            $newtestdata[$m]['filesernum']=$mydata['filesernum'];
            $newtestdata[$m]['align']=$mydata['align'];
            $newtestdata[$m]['imgdisplay']=$mydata['imgdisplay'];
            $newtestdata[$m]['questionscore']=$mydata['questionscore'];
            $tsernum=$newtestdata[$i]['tsernum'];
            $m=$m+1;
        }


        $newtestdata[$m]['id']=$testdata[$i]['id'];
        $newtestdata[$m]['in_ser']=$m;
        $newtestdata[$m]['typeid']=$testdata[$i]['typeid'];
        $newtestdata[$m]['srcid']=$testdata[$i]['srcid'];
        $newtestdata[$m]['pic1']=$testdata[$i]['pic1'];
        $newtestdata[$m]['pic2']=$testdata[$i]['pic2'];
        $newtestdata[$m]['pic3']=$testdata[$i]['pic3'];
        $newtestdata[$m]['pic4']=$testdata[$i]['pic4'];
        $newtestdata[$m]['tsernum']=$testdata[$i]['tsernum'];
        $newtestdata[$m]['ctbname']=$testdata[$i]['ctbname'];
        $newtestdata[$m]['kind']=$testdata[$i]['kind'];
        $newtestdata[$m]['picsum']=$testdata[$i]['picsum'];
        $newtestdata[$m]['inputname']=$testdata[$i]['inputname'];
        $newtestdata[$m]['inputval']='';
        $newtestdata[$m]['filesernum']=$testdata[$i]['filesernum'];
        $newtestdata[$m]['align']=$testdata[$i]['align'];
        $newtestdata[$m]['imgdisplay']=$testdata[$i]['imgdisplay'];
        $newtestdata[$m]['questionscore']=$testdata[$i]['questionscore'];
        $m=$m+1;
    };
  
   // return $newtestdata;

    //进行添加序号


    $count=$m;
    $k=1;
    $m=1;
    $n=1;
    $tsernum='aa';
    for($i=0;$i<$count;$i++)
    {
        if($newtestdata[$i]['ctbname']=='t0')
        {
            $newtestdata[$i]['inputval']=cnnum($k).'、';
            $k=$k+1;
            $m=1;
            $tsernum='aa';
        }
        else
        {
            if($newtestdata[$i]['ctbname']=='t1' || $newtestdata[$i]['ctbname']=='t-a')
            {
                $newtestdata[$i]['inputval']=$m.'.';
                $m=$m+1;
                $tsernum='aa';
            }

            if($newtestdata[$i]['ctbname']=='a' && $newtestdata[$i]['tsernum']==$tsernum)
            {
                $newtestdata[$i]['inputval']='('.$n.')';
                $tsernum=$newtestdata[$i]['tsernum'];
                $n=$n+1;
            }

            if($newtestdata[$i]['ctbname']=='a' && $newtestdata[$i]['tsernum']!=$tsernum)
            {

                $n=1;
                $newtestdata[$i]['inputval']='('.$n.')';
                $tsernum=$newtestdata[$i]['tsernum'];
                $n=$n+1;
            }

        }
    }

    return $newtestdata;
}

//个人知识点试卷习题转化成标准结构的试题
function ctb_persontest_to_standtest($testid)
{
    //试卷id，试卷是教师生成试卷，还是学生个人生成试卷

     $model=M('stumytest');
 
//调出数据
    $model_test_public=M('test_public_data');
  
  	$data=$model->where('id='.$testid)->field(array('id','userid','creatime','ctbquestionid'=>'questionid','questionsum','typeidarr','paper_name'))->find();
    

//    $paper_name=$data['paper_name'];

        $ctbquestionid=$data['questionid'];
        $typeidarr=$data['typeidarr'];


//    $ctbquestionid=$data['ctbquestionid'];
//    $typeidarr=$data['typeidarr'];
    $ctbquestionarr=explode(',',$ctbquestionid);
    $typeidarr=explode(',',$typeidarr);
    $count=sizeof($ctbquestionarr);

    $typeid=0;
    $m=0;
    for($i=0;$i<$count;$i++)
    {
        if($typeidarr[$i]!=$typeid)
        {
            $oldtestdata[$m]['id']=0;
            $oldtestdata[$m]['typeid']=$typeidarr[$i];
            $oldtestdata[$m]['kind']='t0';
            $oldtestdata[$m]['in_ser']=$m;
            $typeid=$typeidarr[$i];
            $m=$m+1;
        }
        $oldtestdata[$m]['id']=$ctbquestionarr[$i];
        $oldtestdata[$m]['typeid']=$typeidarr[$i];
        $oldtestdata[$m]['kind']='toa';
        $oldtestdata[$m]['in_ser']=$m;
        $m=$m+1;
    }
    //形成新的数组

//    return $oldtestdata;


    $count=$m;

    for($i=0;$i<$count;$i++)
    {
        $id=$oldtestdata[$i]['id'];
        if($id!=0)
        {
            $mydata=$model_test_public->where('id='.$id)->find();
            $testdata[$i]['id']=$oldtestdata[$i]['id'];
            $testdata[$i]['in_ser']=$oldtestdata[$i]['in_ser'];
            $testdata[$i]['typeid']=$oldtestdata[$i]['typeid'];

            $testdata[$i]['srcid']=$mydata['srcid'];
            $testdata[$i]['pic1']=$mydata['pic1'];
            $testdata[$i]['pic2']=$mydata['pic2'];
            $testdata[$i]['pic3']=$mydata['pic3'];
            $testdata[$i]['pic4']=$mydata['pic4'];
            $testdata[$i]['tsernum']=$mydata['tsernum'];
            $testdata[$i]['ctbname']=$mydata['ctbname'];
            $testdata[$i]['kind']=$mydata['kind'];
            $testdata[$i]['picsum']=$mydata['picsum'];
            $testdata[$i]['inputname']=$mydata['inputname'];
            $testdata[$i]['inputval']='';
            $testdata[$i]['filesernum']=$mydata['filesernum'];
            $testdata[$i]['align']=$mydata['align'];
            $testdata[$i]['imgdisplay']=$mydata['imgdisplay'];
            $testdata[$i]['questionscore']=$mydata['questionscore'];

            //srcid, in_ser, pic1, pic2, pic3, pic4, tsernum, ctbname, kind, picsum, inputname, inputval, filesernum, align, imgdisplay, typeid, questionscore

        }
        else
        {
            $testdata[$i]['id']=$oldtestdata[$i]['id'];
            $testdata[$i]['in_ser']=$oldtestdata[$i]['in_ser'];
            $testdata[$i]['typeid']=$oldtestdata[$i]['typeid'];

            $testdata[$i]['srcid']=0;
            $testdata[$i]['pic1']=0;
            $testdata[$i]['pic2']=0;
            $testdata[$i]['pic3']=0;
            $testdata[$i]['pic4']=0;
            $testdata[$i]['tsernum']=0;
            $testdata[$i]['ctbname']='t0';
            $testdata[$i]['kind']='test';
            $testdata[$i]['picsum']=0;
            $testdata[$i]['inputname']='title';
            $testdata[$i]['inputval']='';
            $testdata[$i]['filesernum']='';
            $testdata[$i]['align']='left';
            $testdata[$i]['imgdisplay']='none';
            $testdata[$i]['questionscore']=0;
        }


    }


    //如果有a类型习题，那么需要添加t1类型标题。完形填空，添加完形标题。

    $m=0;
    $tsernum='aa';
    for($i=0;$i<$count;$i++)
    {
        if($testdata[$i]['tsernum']!=0 && $testdata[$i]['ctbname']=='a' && $tsernum!=$testdata[$i]['tsernum'])
        {

//                echo '<hr>'.$m.'<hr>';
            $arr['tsernum']=$testdata[$i]['tsernum'];
            $arr['filesernum']=$testdata[$i]['filesernum'];
            $arr['ctbname']='t1';
            $mydata=$model_test_public->where($arr)->find();

            $newtestdata[$m]['id']=0;
            $newtestdata[$m]['in_ser']=$m;
            $newtestdata[$m]['typeid']=$testdata[$i]['typeid'];



            $newtestdata[$m]['srcid']=$mydata['srcid'];


            $newtestdata[$m]['pic1']=$mydata['pic1'];
            $newtestdata[$m]['pic2']=$mydata['pic2'];
            $newtestdata[$m]['pic3']=$mydata['pic3'];
            $newtestdata[$m]['pic4']=$mydata['pic4'];
            $newtestdata[$m]['tsernum']=$mydata['tsernum'];
            $newtestdata[$m]['ctbname']=$mydata['ctbname'];
            $newtestdata[$m]['kind']=$mydata['kind'];
            $newtestdata[$m]['picsum']=$mydata['picsum'];
            $newtestdata[$m]['inputname']=$mydata['inputname'];
            $newtestdata[$m]['inputval']='';
            $newtestdata[$m]['filesernum']=$mydata['filesernum'];
            $newtestdata[$m]['align']=$mydata['align'];
            $newtestdata[$m]['imgdisplay']=$mydata['imgdisplay'];
            $newtestdata[$m]['questionscore']=$mydata['questionscore'];
            $tsernum=$newtestdata[$i]['tsernum'];
            $m=$m+1;
        }


        $newtestdata[$m]['id']=$testdata[$i]['id'];
        $newtestdata[$m]['in_ser']=$m;
        $newtestdata[$m]['typeid']=$testdata[$i]['typeid'];
        $newtestdata[$m]['srcid']=$testdata[$i]['srcid'];
        $newtestdata[$m]['pic1']=$testdata[$i]['pic1'];
        $newtestdata[$m]['pic2']=$testdata[$i]['pic2'];
        $newtestdata[$m]['pic3']=$testdata[$i]['pic3'];
        $newtestdata[$m]['pic4']=$testdata[$i]['pic4'];
        $newtestdata[$m]['tsernum']=$testdata[$i]['tsernum'];
        $newtestdata[$m]['ctbname']=$testdata[$i]['ctbname'];
        $newtestdata[$m]['kind']=$testdata[$i]['kind'];
        $newtestdata[$m]['picsum']=$testdata[$i]['picsum'];
        $newtestdata[$m]['inputname']=$testdata[$i]['inputname'];
        $newtestdata[$m]['inputval']='';
        $newtestdata[$m]['filesernum']=$testdata[$i]['filesernum'];
        $newtestdata[$m]['align']=$testdata[$i]['align'];
        $newtestdata[$m]['imgdisplay']=$testdata[$i]['imgdisplay'];
        $newtestdata[$m]['questionscore']=$testdata[$i]['questionscore'];
        $m=$m+1;
    };

    //进行添加序号


    $count=$m;
    $k=1;
    $m=1;
    $n=1;
    $tsernum='aa';
    for($i=0;$i<$count;$i++)
    {
        if($newtestdata[$i]['ctbname']=='t0')
        {
            $newtestdata[$i]['inputval']=cnnum($k).'、';
            $k=$k+1;
            $m=1;
            $tsernum='aa';
        }
        else
        {
            if($newtestdata[$i]['ctbname']=='t1' || $newtestdata[$i]['ctbname']=='t-a')
            {
                $newtestdata[$i]['inputval']=$m.'.';
                $m=$m+1;
                $tsernum='aa';
            }

            if($newtestdata[$i]['ctbname']=='a' && $newtestdata[$i]['tsernum']==$tsernum)
            {
                $newtestdata[$i]['inputval']='('.$n.')';
                $tsernum=$newtestdata[$i]['tsernum'];
                $n=$n+1;
            }

            if($newtestdata[$i]['ctbname']=='a' && $newtestdata[$i]['tsernum']!=$tsernum)
            {

                $n=1;
                $newtestdata[$i]['inputval']='('.$n.')';
                $tsernum=$newtestdata[$i]['tsernum'];
                $n=$n+1;
            }

        }
    }

    return $newtestdata;
}


//个人知识点试卷习题转化成标准结构的试题
function key_persontest_to_standtest($testid)
{
    //试卷id，试卷是教师生成试卷，还是学生个人生成试卷

     $model=M('key_stumytest');
 
//调出数据
    $model_test_public=M('test_public_data');
    $data=$model->where('id='.$testid)->find();

//    $paper_name=$data['paper_name'];

        $ctbquestionid=$data['questionid'];
        $typeidarr=$data['typeidarr'];


//    $ctbquestionid=$data['ctbquestionid'];
//    $typeidarr=$data['typeidarr'];
    $ctbquestionarr=explode(',',$ctbquestionid);
    $typeidarr=explode(',',$typeidarr);
    $count=sizeof($ctbquestionarr);

    $typeid=0;
    $m=0;
    for($i=0;$i<$count;$i++)
    {
        if($typeidarr[$i]!=$typeid)
        {
            $oldtestdata[$m]['id']=0;
            $oldtestdata[$m]['typeid']=$typeidarr[$i];
            $oldtestdata[$m]['kind']='t0';
            $oldtestdata[$m]['in_ser']=$m;
            $typeid=$typeidarr[$i];
            $m=$m+1;
        }
        $oldtestdata[$m]['id']=$ctbquestionarr[$i];
        $oldtestdata[$m]['typeid']=$typeidarr[$i];
        $oldtestdata[$m]['kind']='toa';
        $oldtestdata[$m]['in_ser']=$m;
        $m=$m+1;
    }
    //形成新的数组

//    return $oldtestdata;


    $count=$m;

    for($i=0;$i<$count;$i++)
    {
        $id=$oldtestdata[$i]['id'];
        if($id!=0)
        {
            $mydata=$model_test_public->where('id='.$id)->find();
            $testdata[$i]['id']=$oldtestdata[$i]['id'];
            $testdata[$i]['in_ser']=$oldtestdata[$i]['in_ser'];
            $testdata[$i]['typeid']=$oldtestdata[$i]['typeid'];

            $testdata[$i]['srcid']=$mydata['srcid'];
            $testdata[$i]['pic1']=$mydata['pic1'];
            $testdata[$i]['pic2']=$mydata['pic2'];
            $testdata[$i]['pic3']=$mydata['pic3'];
            $testdata[$i]['pic4']=$mydata['pic4'];
            $testdata[$i]['tsernum']=$mydata['tsernum'];
            $testdata[$i]['ctbname']=$mydata['ctbname'];
            $testdata[$i]['kind']=$mydata['kind'];
            $testdata[$i]['picsum']=$mydata['picsum'];
            $testdata[$i]['inputname']=$mydata['inputname'];
            $testdata[$i]['inputval']='';
            $testdata[$i]['filesernum']=$mydata['filesernum'];
            $testdata[$i]['align']=$mydata['align'];
            $testdata[$i]['imgdisplay']=$mydata['imgdisplay'];
            $testdata[$i]['questionscore']=$mydata['questionscore'];

            //srcid, in_ser, pic1, pic2, pic3, pic4, tsernum, ctbname, kind, picsum, inputname, inputval, filesernum, align, imgdisplay, typeid, questionscore

        }
        else
        {
            $testdata[$i]['id']=$oldtestdata[$i]['id'];
            $testdata[$i]['in_ser']=$oldtestdata[$i]['in_ser'];
            $testdata[$i]['typeid']=$oldtestdata[$i]['typeid'];

            $testdata[$i]['srcid']=0;
            $testdata[$i]['pic1']=0;
            $testdata[$i]['pic2']=0;
            $testdata[$i]['pic3']=0;
            $testdata[$i]['pic4']=0;
            $testdata[$i]['tsernum']=0;
            $testdata[$i]['ctbname']='t0';
            $testdata[$i]['kind']='test';
            $testdata[$i]['picsum']=0;
            $testdata[$i]['inputname']='title';
            $testdata[$i]['inputval']='';
            $testdata[$i]['filesernum']='';
            $testdata[$i]['align']='left';
            $testdata[$i]['imgdisplay']='none';
            $testdata[$i]['questionscore']=0;
        }


    }


    //如果有a类型习题，那么需要添加t1类型标题。完形填空，添加完形标题。

    $m=0;
    $tsernum='aa';
    for($i=0;$i<$count;$i++)
    {
        if($testdata[$i]['tsernum']!=0 && $testdata[$i]['ctbname']=='a' && $tsernum!=$testdata[$i]['tsernum'])
        {

//                echo '<hr>'.$m.'<hr>';
            $arr['tsernum']=$testdata[$i]['tsernum'];
            $arr['filesernum']=$testdata[$i]['filesernum'];
            $arr['ctbname']='t1';
            $mydata=$model_test_public->where($arr)->find();

            $newtestdata[$m]['id']=0;
            $newtestdata[$m]['in_ser']=$m;
            $newtestdata[$m]['typeid']=$testdata[$i]['typeid'];



            $newtestdata[$m]['srcid']=$mydata['srcid'];


            $newtestdata[$m]['pic1']=$mydata['pic1'];
            $newtestdata[$m]['pic2']=$mydata['pic2'];
            $newtestdata[$m]['pic3']=$mydata['pic3'];
            $newtestdata[$m]['pic4']=$mydata['pic4'];
            $newtestdata[$m]['tsernum']=$mydata['tsernum'];
            $newtestdata[$m]['ctbname']=$mydata['ctbname'];
            $newtestdata[$m]['kind']=$mydata['kind'];
            $newtestdata[$m]['picsum']=$mydata['picsum'];
            $newtestdata[$m]['inputname']=$mydata['inputname'];
            $newtestdata[$m]['inputval']='';
            $newtestdata[$m]['filesernum']=$mydata['filesernum'];
            $newtestdata[$m]['align']=$mydata['align'];
            $newtestdata[$m]['imgdisplay']=$mydata['imgdisplay'];
            $newtestdata[$m]['questionscore']=$mydata['questionscore'];
            $tsernum=$newtestdata[$i]['tsernum'];
            $m=$m+1;
        }


        $newtestdata[$m]['id']=$testdata[$i]['id'];
        $newtestdata[$m]['in_ser']=$m;
        $newtestdata[$m]['typeid']=$testdata[$i]['typeid'];
        $newtestdata[$m]['srcid']=$testdata[$i]['srcid'];
        $newtestdata[$m]['pic1']=$testdata[$i]['pic1'];
        $newtestdata[$m]['pic2']=$testdata[$i]['pic2'];
        $newtestdata[$m]['pic3']=$testdata[$i]['pic3'];
        $newtestdata[$m]['pic4']=$testdata[$i]['pic4'];
        $newtestdata[$m]['tsernum']=$testdata[$i]['tsernum'];
        $newtestdata[$m]['ctbname']=$testdata[$i]['ctbname'];
        $newtestdata[$m]['kind']=$testdata[$i]['kind'];
        $newtestdata[$m]['picsum']=$testdata[$i]['picsum'];
        $newtestdata[$m]['inputname']=$testdata[$i]['inputname'];
        $newtestdata[$m]['inputval']='';
        $newtestdata[$m]['filesernum']=$testdata[$i]['filesernum'];
        $newtestdata[$m]['align']=$testdata[$i]['align'];
        $newtestdata[$m]['imgdisplay']=$testdata[$i]['imgdisplay'];
        $newtestdata[$m]['questionscore']=$testdata[$i]['questionscore'];
        $m=$m+1;
    };

    //进行添加序号


    $count=$m;
    $k=1;
    $m=1;
    $n=1;
    $tsernum='aa';
    for($i=0;$i<$count;$i++)
    {
        if($newtestdata[$i]['ctbname']=='t0')
        {
            $newtestdata[$i]['inputval']=cnnum($k).'、';
            $k=$k+1;
            $m=1;
            $tsernum='aa';
        }
        else
        {
            if($newtestdata[$i]['ctbname']=='t1' || $newtestdata[$i]['ctbname']=='t-a')
            {
                $newtestdata[$i]['inputval']=$m.'.';
                $m=$m+1;
                $tsernum='aa';
            }

            if($newtestdata[$i]['ctbname']=='a' && $newtestdata[$i]['tsernum']==$tsernum)
            {
                $newtestdata[$i]['inputval']='('.$n.')';
                $tsernum=$newtestdata[$i]['tsernum'];
                $n=$n+1;
            }

            if($newtestdata[$i]['ctbname']=='a' && $newtestdata[$i]['tsernum']!=$tsernum)
            {

                $n=1;
                $newtestdata[$i]['inputval']='('.$n.')';
                $tsernum=$newtestdata[$i]['tsernum'];
                $n=$n+1;
            }

        }
    }

    return $newtestdata;
}

//个人错题，生成pdf
function  persontestpdf($outkind,$paper_name,$testnote,$data){
//$kind,试卷种类，原始试卷，二次试卷，$scorekind, 分数样式，$outkind,输出样式(I,预览，D，下载)


//原始试卷
  
//  print_r($data);
//  return;
        $dpi=72;

        $wordheight=297;
        //$wordheight=320;
        $wordwidth=210;
        $lineheight=3;
        $margin_top=14;//mm
  
  		if(strlen($paper_name)>18)
        {
                  $title_font_size=mmtopx(6,$dpi);//dot
        }
  		else
 		 {
                  $title_font_size=mmtopx(10,$dpi);//dot     
 		 }
  

     //   $title_font_size=mmtopx(10,$dpi);//dot
        $title_font_height=10;

        $title_line_height=0;
        $title_line_font_size=mmtopx(0,$dpi);

        $note_font_size=mmtopx(3,$dpi);
        $note_font_height=3;

        $note_line_font_size=mmtopx(3,$dpi);
        $note_line_height=3;

        $p1_font_size=mmtopx(4,$dpi);
        $p1_font_height=4;

        $foot_font_size=mmtopx(4,$dpi);
        $foot_height=4;

        $pic_font_size=mmtopx(3,$dpi);
        $pic_height=3;

        $pic_margin=1;

        $pagenum=1;
        $imagescale=4;


        $model_test_public = M('test_public_data');
        $model_img_cuted= M('img_cuted_data');
        $model_types=M('questiontypes');

        //1.从习题数据库中读取数据
        $count=sizeof($data);

      // return $data;

        //2.读取习题中的图片信息

        for($i=0;$i<$count;$i++)
        {
            $testimg_data=$model_img_cuted->where('id='.$data[$i]['srcid'])->find();

            $sum=0;
            $maxheight=0;
            $max_o_height=0;
            $pic_all_width=0;
            $pic_all_o_width=0;


            //3.将习题信息存入新数组
            $test[$i]['title']=$data[$i]['inputval'];
            $test[$i]['kind']=$data[$i]['inputname'];
            $test[$i]['ctbname']=$data[$i]['ctbname'];

            if($test[$i]['kind']=='title' && $test[$i]['ctbname']=='t0')
            {
                $typemsg=$model_types->where('id='.$data[$i]['typeid'])->find();

                $test[$i]['typesmsg']=$typemsg['typesmsg'];

                $test[$i]['title']=$data[$i]['inputval'].$test[$i]['typesmsg'];
            }
            else
            {
                $test[$i]['title']=$data[$i]['inputval'];

            }



            if($testimg_data['src']=='.')
            {
                $test[$i]['src']='';
                $test[$i]['img_o_x']=0;
                $test[$i]['img_o_y']=0;
                $test[$i]['img_x']=0;
                $test[$i]['img_y']=0;


            }
            else
            {
                $test[$i]['src']=$testimg_data['src'];
                $test[$i]['img_o_x']=imgxymm($testimg_data['src'],$dpi)['x'];
                $test[$i]['img_o_y']=imgxymm($testimg_data['src'],$dpi)['y'];
                $test[$i]['img_x']=round(imgxymm($testimg_data['src'],$dpi)['x']/$imagescale,2);
                $test[$i]['img_y']=round(imgxymm($testimg_data['src'],$dpi)['y']/$imagescale,2);


            }


            //4.判断习题对应图片信息
            if($data[$i]['pic1']!=0)
            {
                $picta=$model_img_cuted->where('id='.$data[$i]['pic1'])->find();
                $test[$i]['pic1_src']=$picta['src'];

                ///计算出来配图的原始宽度和高度及视图中的宽度和高度
                $test[$i]['pic1_img_x']=round(imgxymm($picta['src'],$dpi)['x']/$imagescale,2);
                $test[$i]['pic1_img_y']=round(imgxymm($picta['src'],$dpi)['y']/$imagescale,2);


                $test[$i]['pic1_o_img_x']=imgxymm($picta['src'],$dpi)['x'];
                $test[$i]['pic1_o_img_y']=imgxymm($picta['src'],$dpi)['y'];

                $sum=$sum+1;
                $maxheight=$test[$i]['pic1_img_y'];
                $max_o_height=$test[$i]['pic1_o_img_y'];
                $pic_all_width=$pic_all_width+$test[$i]['pic1_img_x'];
                $pic_all_o_width=$pic_all_o_width+$test[$i]['pic1_o_img_x'];

            }
            else{
                $test[$i]['pic1_src']=0;
                $test[$i]['pic1_img_x']=0;
                $test[$i]['pic1_img_y']=0;

                $test[$i]['pic1_o_img_x']=0;
                $test[$i]['pic1_o_img_y']=0;
            }
            if($data[$i]['pic2']!=0)
            {
                $picta=$model_img_cuted->where('id='.$data[$i]['pic2'])->find();
                $test[$i]['pic2_src']=$picta[src];


                $test[$i]['pic2_img_x']=round(imgxymm($picta['src'],$dpi)['x']/$imagescale,2);
                $test[$i]['pic2_img_y']=round(imgxymm($picta['src'],$dpi)['y']/$imagescale,2);

                $test[$i]['pic2_o_img_x']=imgxymm($picta['src'],$dpi)['x'];
                $test[$i]['pic2_o_img_y']=imgxymm($picta['src'],$dpi)['y'];

                $sum=$sum+1;

                if($test[$i]['pic2_img_y']>$maxheight)
                {
                    $maxheight=$test[$i]['pic2_img_y'];
                };

                if($test[$i]['pic2_o_img_y']>$max_o_height)
                {
                    $max_o_height=$test[$i]['pic2_o_img_y'];
                }

                $pic_all_width=$pic_all_width+$test[$i]['pic2_img_x'];
                $pic_all_o_width=$pic_all_o_width+$test[$i]['pic2_o_img_x'];


            }
            else{
                $test[$i]['pic2_src']=0;
                $test[$i]['pic2_img_x']=0;
                $test[$i]['pic2_img_y']=0;

                $test[$i]['pic2_o_img_x']=0;
                $test[$i]['pic2_o_img_y']=0;
            }
            if($data[$i]['pic3']!=0)
            {
                $picta=$model_img_cuted->where('id='.$data[$i]['pic3'])->find();
                $test[$i]['pic3_src']=$picta['src'];
                $sum=$sum+1;

                $test[$i]['pic3_img_x']=round(imgxymm($picta['src'],$dpi)['x']/$imagescale,2);
                $test[$i]['pic3_img_y']=round(imgxymm($picta['src'],$dpi)['y']/$imagescale,2);

                $test[$i]['pic3_o_img_x']=imgxymm($picta['src'],$dpi)['x'];
                $test[$i]['pic3_o_img_y']=imgxymm($picta['src'],$dpi)['y'];


                if($test[$i]['pic3_img_y']>$maxheight)
                {
                    $maxheight=$test[$i]['pic3_img_y'];
                };

                if($test[$i]['pic3_o_img_y']>$max_o_height)
                {
                    $max_o_height=$test[$i]['pic3_o_img_y'];
                }

                $pic_all_width=$pic_all_width+$test[$i]['pic3_img_x'];
                $pic_all_o_width=$pic_all_o_width+$test[$i]['pic3_o_img_x'];

            }
            else{
                $test[$i]['pic3_src']=0;
                $test[$i]['pic3_img_x']=0;
                $test[$i]['pic3_img_y']=0;

                $test[$i]['pic3_o_img_x']=0;
                $test[$i]['pic3_o_img_y']=0;
            }
            if($data[$i]['pic4']!=0)
            {
                $picta=$model_img_cuted->where('id='.$data[$i]['pic4'])->find();
                $test[$i]['pic4_src']=$picta['src'];
                $test[$i]['pic4_img_x']=round(imgxymm($picta['src'],$dpi)['x']/$imagescale,2);
                $test[$i]['pic4_img_y']=round(imgxymm($picta['src'],$dpi)['y']/$imagescale,2);

                $test[$i]['pic4_o_img_x']=imgxymm($picta['src'],$dpi)['x'];
                $test[$i]['pic4_o_img_y']=imgxymm($picta['src'],$dpi)['y'];
                $sum=$sum+1;


                if($test[$i]['pic4_img_y']>$maxheight)
                {
                    $maxheight=$test[$i]['pic4_img_y'];
                };

                if($test[$i]['pic4_o_img_y']>$max_o_height) {
                    $max_o_height = $test[$i]['pic4_o_img_y'];
                }

                $pic_all_width=$pic_all_width+$test[$i]['pic4_img_x'];
                $pic_all_o_width=$pic_all_o_width+$test[$i]['pic4_o_img_x'];

            }
            else{
                $test[$i]['pic4_src']=0;
                $test[$i]['pic4_img_x']=0;
                $test[$i]['pic4_img_y']=0;

                $test[$i]['pic4_o_img_x']=0;
                $test[$i]['pic4_o_img_y']=0;
            }

            $test[$i]['pic_maxheight']=$maxheight;
            $test[$i]['pic_max_o_height']=$max_o_height;
            $test[$i]['picsum']=$sum;

            $test[$i]['pic_all_o_width']=$pic_all_o_width;
            if($sum>=1)
            {
                $test[$i]['pic_all_width']=$pic_all_width+($sum*$pic_margin);
                $test[$i]['test_all_height']=$test[$i]['pic_maxheight']+$test[$i]['img_y']+$pic_height;
                $test[$i]['test_all_o_height']=$test[$i]['pic_o_maxheight']+$test[$i]['img_o_y']+$pic_height;
            }
            else
            {
                $test[$i]['pic_all_width']=$pic_all_width;
                $test[$i]['test_all_height']=$test[$i]['pic_maxheight']+$test[$i]['img_y'];
                $test[$i]['test_all_o_height']=$test[$i]['pic_o_maxheight']+$test[$i]['img_o_y'];
            }
        }


  
 		// return $test;
  
  



        // 重新编辑排版结构


        $test_size=sizeof($test);

        $newtest[0]['title']=$paper_name;
        $newtest[0]['kind']='headtitle';
        $newtest[0]['font_size']=$title_font_size;
        $newtest[0]['height']=$title_font_height;
        $newtest[0]['src']=0;
        $newtest[0]['pic1_src']=0;
        $newtest[0]['pic2_src']=0;
        $newtest[0]['pic3_src']=0;
        $newtest[0]['pic4_src']=0;
        $newtest[0]['pic1_img_x']=0;
        $newtest[0]['pic1_img_y']=0;
        $newtest[0]['pic2_img_x']=0;
        $newtest[0]['pic2_img_y']=0;
        $newtest[0]['pic3_img_x']=0;
        $newtest[0]['pic3_img_y']=0;
        $newtest[0]['pic4_img_x']=0;
        $newtest[0]['pic4_img_y']=0;
        $newtest[0]['img_x']=0;
        $newtest[0]['img_y']=0;
        $newtest[0]['picsum']=0;
        $newtest[0]['picswidth']=0;
        $newtest[0]['pic_maxheight']=0;

        $newtest[1]['title']='0';
        $newtest[1]['kind']='title_line_height';
        $newtest[1]['font_size']=$title_line_font_size;
        $newtest[1]['height']=$title_line_height;
        $newtest[1]['src']=0;
        $newtest[1]['pic1_src']=0;
        $newtest[1]['pic2_src']=0;
        $newtest[1]['pic3_src']=0;
        $newtest[1]['pic4_src']=0;
        $newtest[1]['pic1_img_x']=0;
        $newtest[1]['pic1_img_y']=0;
        $newtest[1]['pic2_img_x']=0;
        $newtest[1]['pic2_img_y']=0;
        $newtest[1]['pic3_img_x']=0;
        $newtest[1]['pic3_img_y']=0;
        $newtest[1]['pic4_img_x']=0;
        $newtest[1]['pic4_img_y']=0;
        $newtest[1]['img_x']=0;
        $newtest[1]['img_y']=0;
        $newtest[1]['picsum']=0;
        $newtest[1]['picswidth']=0;
        $newtest[1]['pic_maxheight']=0;


        if($testnote=='null')
        {
            $testnote='';
            $newtest[2]['title']='';
        }
        else
        {
            $newtest[2]['title']=$testnote;
        }

        $newtest[2]['kind']='note';
        $newtest[2]['font_size']=$note_font_size;
        $newtest[2]['height']=$note_font_height;
        $newtest[2]['src']=0;
        $newtest[2]['pic1_src']=0;
        $newtest[2]['pic2_src']=0;
        $newtest[2]['pic3_src']=0;
        $newtest[2]['pic4_src']=0;
        $newtest[2]['pic1_img_x']=0;
        $newtest[2]['pic1_img_y']=0;
        $newtest[2]['pic2_img_x']=0;
        $newtest[2]['pic2_img_y']=0;
        $newtest[2]['pic3_img_x']=0;
        $newtest[2]['pic3_img_y']=0;
        $newtest[2]['pic4_img_x']=0;
        $newtest[2]['pic4_img_y']=0;
        $newtest[2]['img_x']=0;
        $newtest[2]['img_y']=0;
        $newtest[2]['picsum']=0;
        $newtest[2]['picswidth']=0;
        $newtest[2]['pic_maxheight']=0;

        $newtest[3]['title']='0';
        $newtest[3]['kind']='note_line_height';
        $newtest[3]['font_size']=$note_line_font_size;
        $newtest[3]['height']=$note_line_height;
        $newtest[3]['src']=0;
        $newtest[3]['pic1_src']=0;
        $newtest[3]['pic2_src']=0;
        $newtest[3]['pic3_src']=0;
        $newtest[3]['pic4_src']=0;
        $newtest[3]['pic1_img_x']=0;
        $newtest[3]['pic1_img_y']=0;
        $newtest[3]['pic2_img_x']=0;
        $newtest[3]['pic2_img_y']=0;
        $newtest[3]['pic3_img_x']=0;
        $newtest[3]['pic3_img_y']=0;
        $newtest[3]['pic4_img_x']=0;
        $newtest[3]['pic4_img_y']=0;
        $newtest[3]['img_x']=0;
        $newtest[3]['img_y']=0;
        $newtest[3]['picsum']=0;
        $newtest[3]['picswidth']=0;
        $newtest[3]['pic_maxheight']=0;



        $m=4;
        for($j=0;$j<$test_size;$j++)
        {
            $newtest[$m]['title']=$test[$j]['title'];

            if($test[$j]['kind']=='title' && $test[$j]['src']!='' &&  $test[$j]['src']!=0)
            {
                $newtest[$m]['kind']='sertitle';
                $newtest[$m]['font_size']=$p1_font_size;
                $newtest[$m]['height']=$test[$j]['test_all_height'];
                $newtest[$m]['img_x']=$test[$j]['img_x'];
                $newtest[$m]['img_y']=$test[$j]['img_y'];

                $newtest[$m]['test_all_height']=$test[$j]['test_all_height'];


                //echo $newtest[$m]['test_all_height'];
                if($newtest[$m]['test_all_height']<$p1_font_height)
                {
                    $newtest[$m]['height']=$p1_font_height;
                }
            }
            else
            {
                $newtest[$m]['kind']='title';
                $newtest[$m]['font_size']=$p1_font_size;
                $newtest[$m]['height']=$p1_font_height;
                $newtest[$m]['img_x']=0;
                $newtest[$m]['img_y']=0;
            }
            if($test[$j]['kind']=='titleanswer')
            {
                $newtest[$m]['kind']='titleanswer';
                $newtest[$m]['font_size']=$p1_font_size;
                $newtest[$m]['height']=$test[$j]['test_all_height'];
                $newtest[$m]['img_x']=$test[$j]['img_x'];
                $newtest[$m]['img_y']=$test[$j]['img_y'];

                $newtest[$m]['test_all_height']=$test[$j]['test_all_height'];

                if($newtest[$m]['test_all_height']<$p1_font_height)
                {
                    $newtest[$m]['height']=$p1_font_height;
                }
            }
            if($test[$j]['kind']=='answer')
            {
                $newtest[$m]['kind']='answer';
                $newtest[$m]['font_size']=$p1_font_size;
                $newtest[$m]['height']=$test[$j]['test_all_height'];
                $newtest[$m]['img_x']=$test[$j]['img_x'];
                $newtest[$m]['img_y']=$test[$j]['img_y'];

                $newtest[$m]['test_all_height']=$test[$j]['test_all_height'];

                if($newtest[$m]['test_all_height']<$p1_font_height)
                {
                    $newtest[$m]['height']=$p1_font_height;
                }
            }



            $newtest[$m]['src']=$test[$j]['src'];
            $newtest[$m]['pic1_src']=$test[$j]['pic1_src'];
            $newtest[$m]['pic2_src']=$test[$j]['pic2_src'];
            $newtest[$m]['pic3_src']=$test[$j]['pic3_src'];
            $newtest[$m]['pic4_src']=$test[$j]['pic4_src'];
            $newtest[$m]['pic1_img_x']=$test[$j]['pic1_img_x'];
            $newtest[$m]['pic1_img_y']=$test[$j]['pic1_img_y'];
            $newtest[$m]['pic2_img_x']=$test[$j]['pic2_img_x'];
            $newtest[$m]['pic2_img_y']=$test[$j]['pic2_img_y'];
            $newtest[$m]['pic3_img_x']=$test[$j]['pic3_img_x'];
            $newtest[$m]['pic3_img_y']=$test[$j]['pic3_img_y'];
            $newtest[$m]['pic4_img_x']=$test[$j]['pic4_img_x'];
            $newtest[$m]['pic4_img_y']=$test[$j]['pic4_img_y'];
            $newtest[$m]['pic_maxheight']=$test[$j]['pic_maxheight'];


            $newtest[$m]['picswidth']=$test[$j]['pic_all_width'];
            $newtest[$m]['pics_sum']=$test[$j]['picsum'];
            $newtest[$m]['page']=0;

            $m=$m+1;

        }
  

        $newtestlength=sizeof($newtest);

        $sumheight=$margin_top;
        $nextsumheight=0;


        $standheight=$wordheight-$margin_top-$margin_top-4;
        $m=0;$n=0;
        for($i=0;$i<$newtestlength-1;$i++)
        {
            $m=$i+1;
            $sumheight=$sumheight+$newtest[$i]['height']+$lineheight;
            $nextsumheight=$sumheight+$newtest[$m]['height']+$lineheight;

            if($sumheight<=$standheight && $nextsumheight>=$standheight)
            {
                $newtest[$i]['page']=$pagenum;
                $pagenum=$pagenum+1;
                $sumheight=$margin_top;
                $nextsumheight=0;
            }
            else
            {
                $newtest[$i]['page']=0;
            }

        }
  
 // print_r($newtest);
  
 // return;

        $newtest[$newtestlength-1]['page']=$pagenum;

       $mypagesum=$pagenum;
  //$pagesum=0;
  
$wordheight=$wordheight+20;
        $pdf = new \TCPDF('P', 'mm', array($wordwidth,$wordheight), true, 'UTF-8', false);

        //页眉：43，页面高度：1160

// 设置文档信息
        $pdf->SetCreator('hzjoo');
        $pdf->SetAuthor('hzjoo');
        $pdf->SetTitle('好好学习，天天向上！');
        $pdf->SetSubject('hzjoo');
        $pdf->SetKeywords('hzjoo');

// 设置页眉和页脚信息
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(true);
// 设置页眉和页脚字体
        //$pdf->setHeaderFont(Array('stsongstdlight', '', '30'));
        // $pdf->setFooterFont(Array('stsongstdlight', '', '2'));

// 设置默认等宽字体
        $pdf->SetDefaultMonospacedFont('stsongstdlight');
        $pdf->setFontSubsetting(true);

// 设置间距,中间80表示到页面顶端的距离
//        $pdf->SetMargins(0, $margin_top, 0);
//        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(20);
        $pdf->setFooterFont(Array('stsongstdlight', '100', 10));
// 设置分页
        $pdf->SetAutoPageBreak(TRUE, 25);

// set image scale factor
        $pdf->setImageScale($imagescale);

//设置字体
	 $pdf->SetMargins(0, 0, 0);
        $pdf->AddPage();
       
  


        // 进入循环添加信息
  $addpagenum=1;

        $page_local=$margin_top;
        $test_size=sizeof($newtest);
        for($j=0;$j<$test_size;$j++)
        {
         // echo $newtest[$j]['kind'].'<br>'.$pagesum.'<hr>';
       
            if($newtest[$j]['kind']=='headtitle')
            {
                //设置字体
                $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                //进行写入
                $pdf->MultiCell($wordwidth,$newtest[$j]['height'],$newtest[$j]['title'], $border=0, $align='C',$fill=false, $ln=1, $x='0', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                $page_local=$page_local+$newtest[$j]['height']+$lineheight;
            }

        
            if($newtest[$j]['kind']=='title_line_height')
            {
                $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                $page_local=$page_local+$newtest[$j]['height']+$lineheight;

            }

            if($newtest[$j]['kind']=='note')
            {
                //设置字体
                $pdf->SetFont('stsongstdlight', '',$newtest[$j]['font_size']);
                $pdf->MultiCell(180,$newtest[$j]['font_size'],'<span style="letter-spacing: 3px">'.$newtest[$j]['title'].'</span>', $border=0, $align='C',$fill=false, $ln=1, $x='10', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

                $page_local=$page_local+$newtest[$j]['height']+$lineheight;
            }


            if($newtest[$j]['kind']=='note_line_height')
            {
                $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                $page_local=$page_local+$newtest[$j]['height']+$lineheight;
            }

            if($newtest[$j]['kind']=='title')
            {
                $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                $pdf->MultiCell(180, 20,$newtest[$j]['title'], $border=0, $align='L',$fill=false, $ln=1, $x='10', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                $page_local=$page_local+$newtest[$j]['height'];
                $page_local=$page_local+$lineheight;
            }
          

            if($newtest[$j]['kind']=='titleanswer'  || $newtest[$j]['kind']=='answer'  || $newtest[$j]['kind']=='sertitle')
            {



                $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
                $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.$newtest[$j]['title'].'</span>', $border=0, $align='L',$fill=false, $ln=1, $x='20', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

            //  if($newtest[$j]['src']!=0)
            //  {
                $pdf->Image($newtest[$j]['src'], 30,$page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
             // }
              


                if($newtest[$j]['pics_sum']==1)
                {
                    $pic_page_local=$page_local+$newtest[$j]['img_y'];
                    $x=$wordwidth-$newtest[$j]['picswidth']-30;
                    $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pic_x=$x+round($newtest[$j]['pic1_img_x']/2,2)-6;
                    $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                    $title = strtr($newtest[$j]['title'], '.', ' ');
                    $pdf->MultiCell(150, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                }

                if($newtest[$j]['pics_sum']==2)
                {
                    $pic_page_local=$page_local+$newtest[$j]['img_y'];
                    $x=$wordwidth-$newtest[$j]['picswidth'];
                    $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pdf->Image($newtest[$j]['pic2_src'], $x+$newtest[$j]['pic1_img_x']+$pic_margin,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pic_x=$x+round(($newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x'])/2,2)-6;
                    $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                    $title = strtr($newtest[$j]['title'], '.', ' ');
                    $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                }
                if($newtest[$j]['pics_sum']==3) {
                    $pic_page_local=$page_local+$newtest[$j]['img_y'];
                    $x=$wordwidth-$newtest[$j]['picswidth'];
                    $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pdf->Image($newtest[$j]['pic2_src'], $x+$newtest[$j]['pic1_img_x']+$pic_margin,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pdf->Image($newtest[$j]['pic3_src'], $x+$newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$pic_margin*2,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pic_x=$x+round(($newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$newtest[$j]['pic3_img_x'])/2,2)-6;
                    $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                    $title = strtr($newtest[$j]['title'], '.', ' ');
                    $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                }
                if($newtest[$j]['pics_sum']==4)
                {
                    $pic_page_local=$page_local+$newtest[$j]['img_y'];
                    $x=$wordwidth-$newtest[$j]['picswidth'];
                    $pdf->Image($newtest[$j]['pic1_src'], $x,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pdf->Image($newtest[$j]['pic2_src'], $x+$newtest[$j]['pic1_img_x']+$pic_margin,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pdf->Image($newtest[$j]['pic3_src'], $x+$newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$pic_margin*2,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pdf->Image($newtest[$j]['pic4_src'], $x+$newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$newtest[$j]['pic3_img_x']+$pic_margin*3,$pic_page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                    $pic_x=$x+round(($newtest[$j]['pic1_img_x']+$newtest[$j]['pic2_img_x']+$newtest[$j]['pic3_img_x']+$newtest[$j]['pic4_img_x'])/2,2)-6;
                    $pdf->SetFont('stsongstdlight', '',$pic_font_size);
                    $title = strtr($newtest[$j]['title'], '.', ' ');
                    $pdf->MultiCell(50, 10,'<span style="letter-spacing: 1px;">'.'题'.$title.'图'.'</span>', $border=0, $align='L',$fill=false, $ln=1, $x=$pic_x, $y=$pic_page_local+$newtest[$j]['pic_maxheight'],  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                }

                $page_local=$page_local+$newtest[$j]['height'];
                $page_local=$page_local+$lineheight;
            }



            if($newtest[$j]['page']>0 && $newtest[$j]['page']<$mypagesum)
            {
                $pdf->AddPage();
                $page_local=$margin_top;
                $pagesum=$newtest[$j]['page'];
                $addpagenum=$addpagenum+1;
               //  $pdf->MultiCell(50, 10,2323, $border=0, $align='L',$fill=false, $ln=1, $x='20', $y='10',  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
            }

        }

//
 // echo $mypagesum;
//   return;

    $pdfname='test_'.date('y-m-d h:i:s',time());

    if($outkind=='I')
    {
        $pdf->Output($pdfname, 'I');
    }
    if($outkind=='D')
    {
        $pdf->Output($pdfname.'.pdf', 'D');
    }
}


//个人答案转pdf,对于原始试卷可以，但是可以不用
function personanswerpdf01($paper_name,$data,$operkind){
    $imgscale=0.371;

    $model = M('test_public_data');
    $model1= M('img_cuted_data');
    $model2=M('paper_msg_data');

    $count=sizeof($data);
    $title=$paper_name;

    for($i=0;$i<$count;$i++)
    {
        $ta=$model1->where('id='.$data[$i][srcid])->find();
        $answerid=$ta['answerid'];

        if($answerid!=0)
        {
            $aa=$model1->where('id='.$answerid)->find();
            $answer[$i][src]=$aa[src];
        }
        else
        {
            $answer[$i][src]=0;
        }

        if(strpos($answer[$i][src],'uploads')==true) {

            $answer[$i]['kind']=1;
        }
        else
        {
            $answer[$i]['kind']=0;
        }

        $answer[$i]['title']=cuttitlemsg($data[$i][inputval]);
        $answer[$i]['src']=$aa[src];
        $answer[$i]['img_x']=imgxy($aa[src])[x]*$imgscale;
        $answer[$i]['img_y']=imgxy($aa[src])[y]*$imgscale;

    }

    $pdf = new \TCPDF('P', 'mm', array(874.89,1232.25), true, 'UTF-8', false);
// 设置文档信息
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(true);

    $pdf->SetCreator('haohaoCtb');
    $pdf->SetAuthor('haohaoCtb');
    $pdf->SetTitle('好好学习，天天向上！');
    $pdf->SetSubject('错题本');
    $pdf->SetKeywords('错题本答案');

// 设置页眉和页脚信息
    $pdf->SetHeaderData('', '0', '好好错题本——好好学习，天天向上', array(0,64,255), array(0,64,128));
//        $pdf->setFooterData(array(0,64,0), array(0,64,128));
// 设置页眉和页脚字体
    $pdf->setHeaderFont(Array('stsongstdlight', '', '30'));

// 设置默认等宽字体
    $pdf->SetDefaultMonospacedFont('stsongstdlight');
    $pdf->setFontSubsetting(true);

// 设置间距,中间80表示到页面顶端的距离
    $pdf->SetMargins(35, 80, 35);
    $pdf->SetHeaderMargin(5);
    $pdf->SetFooterMargin(25);
    $pdf->setFooterFont(Array('stsongstdlight', '100', 30));
// 设置分页
    $pdf->SetAutoPageBreak(TRUE, 25);

// set image scale factor
    $pdf->setImageScale(0.95);
//设置字体
    $pdf->SetFont('stsongstdlight', '', 80);
    $pdf->AddPage();
    $pdf->Write(0,$title.'答案','', 0, 'C', true, 0, false, false, 0);
    $pdf->SetFont('stsongstdlight', '', 40);

    $height=148;

    $leaveheight=1180;
    $levelwidth=780;

    $between_test_height=10;
    $bottom=0;
    $left=10;


    for($j=0;$j<$count;$j++)
    {


        if($answer[$j][kind]==1)
        {
            $text_img_leng=font_img_size_sub($answer[$j][title],7,(int)$answer[$j]['img_x']);
            $text_leng=fontsizesub($answer[$j][title],6);

            //宽度大于行宽的时候，进行换行

            if($left+$text_img_leng>$levelwidth)
            {
                $left=10;
                $height=$height+$bottom+35;
            }
//总体高度高于整个页面的时候，需要插入下一页
            if($height+(int)$answer[$j]['img_y']>$leaveheight)
            {
                $pdf->AddPage();
                $left=10;
                $height=30;
                $bottom=0;
            }

            $pdf->MultiCell(60, 20,$answer[$j][title], $border=0, $align='R',$fill=false, $ln=1, $x=$left, $y=(int)$height,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

            $img_left=$left+$text_leng;

            $pdf->Image($answer[$j][src], $img_left,$height+1, '', '', '', '', '', false, 300, '', false, false, 0, false, false, false);

            $left=$left+$text_img_leng;

            if($bottom<(int)$answer[$j]['img_y'])
            {
                $bottom=(int)$answer[$j]['img_y'];
            }
            if($bottom<14)
            {
                $bottom=14;
            }
        }

        else
        {
            $text_leng=fontsizesub($answer[$j][title],7);

            if($left+$text_leng>$levelwidth)
            {
                $left=10;
                $height=$height+$bottom+35;
            }

            if($height+14>$leaveheight)
            {
                $pdf->AddPage();
                $left=10;
                $height=30;
                $bottom=0;
            }


            $pdf->MultiCell(60, 20,$answer[$j]['title'], $border=0, $align='R',$fill=false, $ln=1, $x=$left, $y=(int)$height,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

            $left=$left+$text_leng;


            if($bottom<14)
            {
                $bottom=14;
            }
        }
    }



    $pdfname='answer_'.date('y-m-d h:i:s',time()).'.pdf';

    if($operkind=='I')
    {
        $pdf->Output($pdfname, 'I');
    }
    if($operkind=='D')
    {
        $pdf->Output($pdfname, 'D');
    }

}


//个人习题答案导出pdf
function persontest_to_answerpdf($data,$paper_name,$outkind)
{
    //$testid=174;
//    $paper_name='我的试卷';
    //$data=persontest_to_standtest($testid);
//    $outkind='I';
//    $testnote='110';
//原始试卷
    $dpi=72;

    //$wordheight=307;
    $wordheight=297;
  	$wordwidth=210;
  //$wordwidth=310;
    $lineheight=10;
    $margin_top=14;//mm
    $margin_side=20;//mm

    $title_font_size=mmtopx(6,$dpi);//dot
    $title_font_height=6;

    $title_line_height=0;
    $title_line_font_size=mmtopx(0,$dpi);

    $note_font_size=mmtopx(3,$dpi);
    $note_font_height=3;

    $note_line_font_size=mmtopx(3,$dpi);
    $note_line_height=3;

    $p1_font_size=mmtopx(4,$dpi);
    $p1_font_height=4;
    $p1_font_width=4;


    $foot_font_size=mmtopx(4,$dpi);
    $foot_height=4;

    $pic_font_size=mmtopx(3,$dpi);
    $pic_height=3;

    $pic_margin=1;

    $pagenum=1;
    $imagescale=4;


    $model_test_public = M('test_public_data');
    $model_img_cuted= M('img_cuted_data');
    $model_types=M('questiontypes');

    //1.从习题数据库中读取数据
    $count=sizeof($data);

    //2.读取习题中的答案信息

    for($i=0;$i<$count;$i++)
    {
        if($data[$i]['srcid']=='' || $data[$i]['srcid']==0)
        {
            $test[$i]['answerid']=0;
        }else
        {
            $testimg_data=$model_img_cuted->where('id='.$data[$i]['srcid'])->find();
            $test[$i]['answerid']=$testimg_data['answerid'];
        }
        if($test[$i]['answerid']==0)
        {
            $test[$i]['src']=0;
        }
        else
        {
            $testimg_data=$model_img_cuted->where('id='.$test[$i]['answerid'])->find();
            $test[$i]['src']=$testimg_data['src'];
        }
        //3.将习题信息存入新数组

        if($data[$i]['ctbname']=='t0')
        {
            $typeid=$data[$i]['typeid'];
            $typedata=$model_types->where('id='.$typeid)->find();
            $test[$i]['title']=$data[$i]['inputval'].$typedata['typesmsg'];
        }else
        {
            $test[$i]['title']=$data[$i]['inputval'];
        }

        //$test[$i]['title']=$data[$i]['inputval'];
        $test[$i]['font_width']=mb_strlen($data[$i]['inputval'])*$p1_font_width;
        $test[$i]['kind']=$data[$i]['inputname'];
        $test[$i]['ctbname']=$data[$i]['ctbname'];
        $test[$i]['img_o_x']=imgxymm($test[$i]['src'],$dpi)['x'];
        $test[$i]['img_o_y']=imgxymm($test[$i]['src'],$dpi)['y'];
        $test[$i]['img_x']=round(imgxymm($test[$i]['src'],$dpi)['x']/$imagescale,2);
        $test[$i]['img_y']=round(imgxymm($test[$i]['src'],$dpi)['y']/$imagescale,2);
    }






    // 重新编辑排版结构


    $test_size=sizeof($test);

    $newtest[0]['title']=$paper_name;
    $newtest[0]['kind']='headtitle';
    $newtest[0]['font_size']=$title_font_size;
    $newtest[0]['height']=$title_font_height;
    $newtest[0]['src']=0;
    $newtest[0]['img_x']=0;
    $newtest[0]['img_y']=0;
    $newtest[0]['width']=0;

    $newtest[0]['linenum']=0;
    $newtest[0]['lastlineele']=0;
    $newtest[0]['lastpageele']=0;


    $m=1;
    //计算单个的标题或者图片的宽度和高度值
    for($i=0;$i<$test_size;$i++)
    {
        if($test[$i]['ctbname']=='t0')
        {
            $newtest[$m]['title']=$test[$i]['title'];
            $newtest[$m]['kind']='t0';
            $newtest[$m]['font_size']=$p1_font_size;
            $newtest[$m]['height']=$p1_font_height;
            $newtest[$m]['width']=$test[$i]['font_width'];
            $newtest[$m]['src']=0;
            $newtest[$m]['img_x']=0;
            $newtest[$m]['img_y']=0;

            $newtest[$m]['linenum']=0;
            $newtest[$m]['lastlineele']=0;
            $newtest[$m]['lastpageele']=0;
        }
        if($test[$i]['ctbname']=='t1')
        {
            $newtest[$m]['title']=$test[$i]['title'];
            $newtest[$m]['kind']='t1';
            $newtest[$m]['font_size']=$p1_font_size;
            $newtest[$m]['height']=$p1_font_height;
            $newtest[$m]['width']=$test[$i]['font_width'];
            $newtest[$m]['font_width']=$test[$i]['font_width'];
            $newtest[$m]['src']=0;
            $newtest[$m]['img_x']=0;
            $newtest[$m]['img_y']=0;

            $newtest[$m]['linenum']=0;
            $newtest[$m]['lastlineele']=0;
            $newtest[$m]['lastpageele']=0;
        }
        if($test[$i]['ctbname']=='t-a')
        {
            $newtest[$m]['title']=$test[$i]['title'];
            $newtest[$m]['kind']='t-a';
            $newtest[$m]['font_size']=$p1_font_size;
            $newtest[$m]['font_width']=$test[$i]['font_width'];
            $newtest[$m]['height']=$p1_font_height;
            $newtest[$m]['src']=$test[$i]['src'];
            $newtest[$m]['img_x']=$test[$i]['img_x'];
            $newtest[$m]['img_y']=$test[$i]['img_y'];
            $newtest[$m]['width']=$test[$i]['font_width']+$test[$i]['img_x'];

            if($newtest[$m]['img_y']>$newtest[$m]['height'])
            {
                $newtest[$m]['height']=$newtest[$m]['img_y'];
            }

            $newtest[$m]['linenum']=0;
            $newtest[$m]['lastlineele']=0;
            $newtest[$m]['lastpageele']=0;
        }
        if($test[$i]['ctbname']=='a')
        {
            $newtest[$m]['title']=$test[$i]['title'];
            $newtest[$m]['kind']='a';
            $newtest[$m]['font_size']=$p1_font_size;
            $newtest[$m]['font_width']=$test[$i]['font_width'];
            $newtest[$m]['height']=$p1_font_height;
            $newtest[$m]['src']=$test[$i]['src'];
            $newtest[$m]['img_x']=$test[$i]['img_x'];
            $newtest[$m]['img_y']=$test[$i]['img_y'];
            $newtest[$m]['width']=$test[$i]['font_width']+$test[$i]['img_x'];

            if($newtest[$m]['img_y']>$newtest[$m]['height'])
            {
                $newtest[$m]['height']=$newtest[$m]['img_y'];
            }

            $newtest[$m]['linenum']=0;
            $newtest[$m]['lastlineele']=0;
            $newtest[$m]['lastpageele']=0;
        }

        $m=$m+1;
    }

    $newtestlength=sizeof($newtest);
  
  	//print_r($newtest);

    $sumwidth=$margin_side;
    $nextsumwidth=0;
    $standwidth=$wordwidth-20;
    $max_height=0;
  
 // echo $standwidth.'<hr>';
  
  
    //计算每个元素所在的行
  //需要修改，需要加入换页
    $linenum=1;
    for($i=0;$i<$newtestlength-1;$i++)
    {
        $j=$i+1;
        $sumwidth=$sumwidth+$newtest[$i]['width'];
      //当前元素的总宽度，进入总的宽度
        $nextsumwidth=$sumwidth+$newtest[$j]['width'];
       //当前元素的总宽度+下一个宽度，进入下一个总的宽度
      
      //如果当前宽度<标准宽度<下一个总的宽度

        if($newtest[$i]['kind']=='headtitle')
        {
          //当为大标题时，当前行数，总宽度初始状态，下一个总宽度初始状态
            $newtest[$i]['linenum']=$linenum;
            $sumwidth=$margin_side;
            $nextsumwidth=0;
            continue;
        }


        if($newtest[$i]['kind']=='t0')
        {
           //当前行数，总宽度初始状态，下一个总宽度初始状态，函数加一
   
            $linenum=$linenum+1;
            $newtest[$i]['linenum']=$linenum;
            $linenum=$linenum+1;
            $sumwidth=$margin_side;
            $nextsumwidth=0;
   
            continue;
        }

        if($sumwidth<=$standwidth && $nextsumwidth>=$standwidth)
        {
          //如果当前宽度<标准宽度<下一个总的宽度
            $newtest[$i]['linenum']=$linenum;

            $linenum=$linenum+1;
            $sumwidth=$margin_side;
            $nextsumwidth=0;
        }
        else
        {
          
       if($sumwidth>$standwidth)
        {
          //如果当前宽度<标准宽度<下一个总的宽度
            
            $newtest[$i]['linenum']=$linenum;
 			$linenum=$linenum+1;
            $sumwidth=$margin_side;
            $nextsumwidth=0;
        }
         else
         {
            $newtest[$i]['linenum']=$linenum;

         }

        }
    }

    //最后一个判断，如果下一个宽度超过标准宽度，那么最后一个元素，到下一行。否则的话，就在本行。
  
  
  

    if($nextsumwidth>=$standwidth)
    {
        $newtest[$newtestlength-1]['linenum']=$linenum+1;
    }
    else
    {
        $newtest[$newtestlength-1]['linenum']=$linenum;
    }
    $count=sizeof($newtest);
  
 // print_r($newtest);
  
   // $standheight=$wordheight-$margin_top-$margin_top-30;
  
  //插入页码
  
 // echo $standheight;

    $maxline_height=0;
    $m=1;
   for($i=1;$i<=$linenum;$i++)
    {
        $maxline_height=0;
        for($j=0;$j<$count;$j++)
        {
            if($newtest[$j]['linenum']==$i)
            {
                if($newtest[$j]['height']>$maxline_height)
                {
                    $maxline_height=$newtest[$j]['height'];
                }
            }
        }
        $maxline[$i]['height']=$maxline_height;
    }

    for($i=1;$i<=$linenum;$i++)
    {
        for($j=0;$j<$count;$j++)
        {

            if($newtest[$j]['linenum']==$i)
            {
                $newtest[$j]['height']=$maxline[$i]['height'];
            }
        }
    }

//  print_r($maxline);
//确定页面的高度
    $standheight=$wordheight-$margin_top-$margin_top-20;
    $sumheight=0;$pagenum=1;
    for($i=1;$i<$linenum;$i++)
    {
        $j=$i+1;
        $sumheight=$sumheight+$maxline[$i]['height']+$lineheight;
        $nextsumheight=$sumheight+$maxline[$j]['height']+$lineheight;
      
        if($sumheight<=$standheight && $nextsumheight<=$standheight)
        {
          	//$maxline[$i]['page']
            $maxline[$i]['page']=$pagenum;
        }
        if($sumheight<=$standheight && $nextsumheight>=$standheight)
        {
            $maxline[$i]['page']=$pagenum;
            $pagenum=$pagenum+1;
            $sumheight=0;
            $nextsumheight=0;
        }
        if($sumheight>=$standheight && $nextsumheight>=$standheight)
        {
            $maxline[$i]['page']=$pagenum;
            $pagenum=$pagenum+1;
            $sumheight=0;
            $nextsumheight=0;
        }
    }

    if($nextsumheight>$standheight)
    {
        $maxline[$linenum]['page']=$pagenum+1;
    }
    else
    {
        $maxline[$linenum]['page']=$pagenum;
    }

    for($i=1;$i<=$linenum;$i++)
    {
        for($j=0;$j<$count;$j++)
        {

            if($newtest[$j]['linenum']==$i)
            {
                $newtest[$j]['page']=$maxline[$i]['page'];
            }
        }
    }
  
//width表示标题文字宽度
 // print_r($newtest);
 // return;
  

    $pdf = new \TCPDF('P', 'mm', array($wordwidth,$wordheight), true, 'UTF-8', false);

    //页眉：43，页面高度：1160

// 设置文档信息
    $pdf->SetCreator('hzjoo');
    $pdf->SetAuthor('hzjoo');
    $pdf->SetTitle('好好学习，天天向上！');
    $pdf->SetSubject('hzjoo');
    $pdf->SetKeywords('hzjoo');

// 设置页眉和页脚信息
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(true);
// 设置页眉和页脚字体
    //$pdf->setHeaderFont(Array('stsongstdlight', '', '30'));
    // $pdf->setFooterFont(Array('stsongstdlight', '', '2'));

// 设置默认等宽字体
    $pdf->SetDefaultMonospacedFont('stsongstdlight');
    $pdf->setFontSubsetting(true);

// 设置间距,中间80表示到页面顶端的距离
//        $pdf->SetMargins(0, $margin_top, 0);
//        $pdf->SetHeaderMargin(5);
    $pdf->SetFooterMargin(20);
    $pdf->setFooterFont(Array('stsongstdlight', '100', 10));
// 设置分页
    $pdf->SetAutoPageBreak(TRUE, 25);

// set image scale factor
    $pdf->setImageScale($imagescale);

//设置字体
    $pdf->AddPage();
    $pdf->SetMargins(0, 0, 0);
    // 进入循环添加信息
    $page_local=$margin_top;
    $test_size=sizeof($newtest);
    $nowline=1;
    $nowpage=1;
    $tax=$margin_side;//边距
  
 // print_r();
  
  //写入pdf，这里有问题
  //linenum行数
 // $test_size=19;
    for($j=0;$j<$test_size;$j++)
    {
     // echo $j.'<hr>';
        $linenum=$newtest[$j]['linenum'];//当前行数
        $page=$newtest[$j]['page'];//当前数据页数
   
        if($page!=$nowpage)//如果当前页数，不等于数据页数，那么就插入一个新页
        {
            $page_local=$margin_top;
            $nowpage=$page;
            $pdf->AddPage();
          
            $tax=$margin_side;
            $nowline=$linenum;
        }
      else//否则如果当前行数不等于数据行数
      {
         if($linenum!=$nowline)
        {
            $k=$j-1;//页面的垂直起始位置，加上上一个元素的高度，在加上行间距
            $page_local=$page_local+$newtest[$k]['height'];
            $page_local=$page_local+$lineheight;
            $nowline=$linenum;//当前行数变成当前数据行数
            $tax=$margin_side;//边距初始化
        }
      }



        if($newtest[$j]['kind']=='headtitle')
        {
            //设置字体
            $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
            //进行写入
          	//如果是标题，那么x=0，y=$page_local，居中写入
            $pdf->MultiCell($wordwidth,$newtest[$j]['height'],$newtest[$j]['title'], $border=0, $align='C',$fill=false, $ln=1, $x='0', $y=$page_local,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
          	//$page_local=$page_local+文字高度+行间距  
          	$page_local=$page_local+$newtest[$j]['height']+$lineheight;
          	//当前行+1
            $nowline=$nowline+1;
        }
        if($newtest[$j]['kind']=='t0') {
            $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
           	//如果是副标题，那么x=10，y=$page_local，写入
            $pdf->MultiCell(180, 20, $newtest[$j]['title'], $border = 0, $align = 'L', $fill = false, $ln = 1, $x = '10', $y = $page_local, $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0, $valign = 'T', $fitcell = false); 
            //$page_local=$page_local+文字高度+文字高度+行间距
          	$page_local = $page_local + $newtest[$j]['height'];
            $page_local = $page_local + $lineheight;
          	//当前行+1
            $nowline=$nowline+1;
        }


        if($newtest[$j]['kind']=='t-a')
        {
 
          	//如果是习题，那么x=$tax，y=$page_local，开始写入标题
            $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
            $pdf->MultiCell($newtest[$j]['font_width'], 10,'<span style="letter-spacing: 1px;">'.$newtest[$j]['title'].'</span>', $border=0, $align='L',$fill=false, $ln=1, $tax, $y=$page_local,  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
			//如果习题有图片
            if($newtest[$j]['src']!='0')
            {
              

              
               //左边距=原有左边距+文字宽度，并且进行插入
                $tax=$tax+$newtest[$j]['font_width'];
              	//插入图片
              
              if($newtest[$j]['height']>$standheight-$newtest[$j]['font_size'])
              {
                 $pdf->Image($newtest[$j]['src'], $tax,$page_local, '',$standheight-$newtest[$j]['font_size'], '', '', '', false,300, '', false, false, 0, false, false, false);
              }
              else
              {
                 $pdf->Image($newtest[$j]['src'], $tax,$page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
              }
              
        
              
              
              
              	//恢复到起始位置
                $tax=$tax+$newtest[$j]['width']-$newtest[$j]['font_width'];
            }
            else
            {
              	//左边距为文字边距
                $tax=$tax+$newtest[$j]['font_width'];
            }
        }

        if($newtest[$j]['kind']=='t1')
        {
            $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
            $pdf->MultiCell($newtest[$j]['font_width'], 10,'<span style="letter-spacing: 1px;">'.$newtest[$j]['title'].'</span>', $border=0, $align='L',$fill=false, $ln=1, $tax, $y=$page_local,  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

            if($newtest[$j]['src']!='0')
            {
                $tax=$tax+$newtest[$j]['font_width'];
              //图片源头，x，y，width，height
              
              
              if($newtest[$j]['height']>$standheight-$newtest[$j]['font_size'])
              {
                 $pdf->Image($newtest[$j]['src'], $tax,$page_local, '',$standheight-$newtest[$j]['font_size'], '', '', '', false,300, '', false, false, 0, false, false, false);
              }
              else
              {
                 $pdf->Image($newtest[$j]['src'], $tax,$page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
              }
              
              //  $pdf->Image($newtest[$j]['src'], $tax,$page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
              
              
              
                $tax=$tax+$newtest[$j]['width']-$newtest[$j]['font_width'];
            }
            else
            {
                $tax=$tax+$newtest[$j]['font_width'];
            }
        }
        if($newtest[$j]['kind']=='a')
        {
            $pdf->SetFont('stsongstdlight', '', $newtest[$j]['font_size']);
            $pdf->MultiCell($newtest[$j]['font_width'], 10,'<span style="letter-spacing: 1px;">'.$newtest[$j]['title'].'</span>', $border=0, $align='L',$fill=false, $ln=1, $tax, $y=$page_local,  $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

            if($newtest[$j]['src']!='0')
            {
                $tax=$tax+$newtest[$j]['font_width'];
              
              
               if($newtest[$j]['height']>$standheight-$newtest[$j]['font_size'])
              {
                 $pdf->Image($newtest[$j]['src'], $tax,$page_local, '',$standheight-$newtest[$j]['font_size'], '', '', '', false,300, '', false, false, 0, false, false, false);
              }
              else
              {
                 $pdf->Image($newtest[$j]['src'], $tax,$page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
              }
              
              
             //   $pdf->Image($newtest[$j]['src'], $tax,$page_local, '','', '', '', '', false,300, '', false, false, 0, false, false, false);
                $tax=$tax+$newtest[$j]['width']-$newtest[$j]['font_width'];
            }
            else
            {
                $tax=$tax+$newtest[$j]['font_width'];
            }
        }


      
      
      
    }


    $pdfname='answer_'.date('y-m-d h:i:s',time()).'.pdf';
    if($outkind=='I')
    {
        $pdf->Output($pdfname, 'I');
    }
    if($outkind=='D')
    {
        $pdf->Output($pdfname.'.pdf', 'D');
    }
}

//查找数组中是否包含元素，返回序号
function ctb_in_array($ele,$arr)
{
    for($i=0;$i<sizeof($arr);$i++)
    {
        if($arr[$i]==$ele)
        {
            return $i;
            break;
        }
    }

    return -1;
}

//进行以班级为核心的习题数据统计
function class_statistic($testid,$userid,$questionid_arr)
{
    $model_studentparent_addation=M('user_studentparent_addation_data');
    $model_class_statistic=M('class_statistic');
    $model_paper_msg_data=M('paper_msg_data');

    $datauser=$model_studentparent_addation->where('userid='.$userid)->find();
    $classid=$datauser['classid'];
    $groupid=$datauser['groupid'];

    $datapaper=$model_paper_msg_data->where('id='.$testid)->find();
    $questionsum=$datapaper['questionsum'];

    $data_class=$model_class_statistic->where('classid='.$classid)->find();
    $question_count=sizeof(explode(',',$questionid_arr));
    $wrongratio=round($question_count/$questionsum,3);

    $testidarr=explode(',',$data_class['testidarr']);

    //找到当前习题在班级中的位置，这个位置就是要修改错误率的位置
    $num=ctb_in_array($testid,$testidarr);


    $wrong_ratio_arr_data=explode(',',$data_class['wrong_ratio_arr']);



    if($groupid==1)
    {
        $g1_num_data=explode(',',$data_class['g1_num']);
        $g1_ratio_data=explode(',',$data_class['g1_wrong_ratio_arr']);

        $g1_num=$g1_num_data[$num];
        $g1_wrong_ratio_arr=$g1_ratio_data[$num];
        $g1_new_ratio=round(($g1_num*$g1_wrong_ratio_arr+$wrongratio)/($g1_num+1),3);


        $g2_num_data=explode(',',$data_class['g2_num']);
        $g2_ratio_data=explode(',',$data_class['g2_wrong_ratio_arr']);
        $g2_num=$g2_num_data[$num];
        $g2_wrong_ratio_arr=$g2_ratio_data[$num];

        $g3_num_data=explode(',',$data_class['g3_num']);
        $g3_ratio_data=explode(',',$data_class['g3_wrong_ratio_arr']);
        $g3_num=$g3_num_data[$num];
        $g3_wrong_ratio_arr=$g3_ratio_data[$num];


        $wrong_new_ratio_arr=(($g1_num+1)*$g1_new_ratio+$g2_num*$g2_wrong_ratio_arr+$g3_num*$g3_wrong_ratio_arr)/($g1_num+$g2_num+$g3_num+1);

        $wrong_ratio_arr='';


        $new_num_arr='';
        $new_ratio_arr='';

        for($i=0;$i<sizeof($testidarr);$i++)
        {
            if($i==$num)
            {
                $new_num_arr=$new_num_arr.','.($g1_num+1);
                $new_ratio_arr=$new_ratio_arr.','.$g1_new_ratio;
                $wrong_ratio_arr=$wrong_ratio_arr.','.$wrong_new_ratio_arr;
            }
            else
            {

                $new_num_arr=$new_num_arr.','.$g1_num_data[$i];
                $new_ratio_arr=$new_ratio_arr.','.$g1_ratio_data[$i];
                $wrong_ratio_arr=$wrong_ratio_arr.','.$wrong_ratio_arr_data[$i];
            }
        }


        $new_num_arr=substr($new_num_arr,1);
        $new_ratio_arr=substr($new_ratio_arr,1);
        $wrong_ratio_arr=substr($wrong_ratio_arr,1);



        $arr['g1_num']=$new_num_arr;
        $arr['g1_wrong_ratio_arr']=$new_ratio_arr;
        $arr['wrong_ratio_arr']=$wrong_ratio_arr;


        $model_class_statistic->where('classid='.$classid)->save($arr);



    }
    if($groupid==2)
    {
        $g2_num_data=explode(',',$data_class['g2_num']);
        $g2_ratio_data=explode(',',$data_class['g2_wrong_ratio_arr']);

        $g2_num=$g2_num_data[$num];
        $g2_wrong_ratio_arr=$g2_ratio_data[$num];
        $g2_new_ratio=round(($g2_num*$g2_wrong_ratio_arr+$wrongratio)/($g2_num+1),3);


        $g1_num_data=explode(',',$data_class['g1_num']);
        $g1_ratio_data=explode(',',$data_class['g1_wrong_ratio_arr']);
        $g1_num=$g1_num_data[$num];
        $g1_wrong_ratio_arr=$g1_ratio_data[$num];

        $g3_num_data=explode(',',$data_class['g3_num']);
        $g3_ratio_data=explode(',',$data_class['g3_wrong_ratio_arr']);
        $g3_num=$g3_num_data[$num];
        $g3_wrong_ratio_arr=$g3_ratio_data[$num];


        $wrong_new_ratio_arr=($g1_num*$g1_wrong_ratio_arr+($g2_num+1)*$g2_new_ratio+$g3_num*$g3_wrong_ratio_arr)/($g1_num+$g2_num+$g3_num+1);

        $wrong_ratio_arr_data=explode(',',$data_class['wrong_ratio_arr']);

        $new_num_arr='';
        $new_ratio_arr='';

        for($i=0;$i<sizeof($testidarr);$i++)
        {
            if($i==$num)
            {
                $new_num_arr=$new_num_arr.','.($g2_num+1);
                $new_ratio_arr=$new_ratio_arr.','.$g2_new_ratio;
                $wrong_ratio_arr=$wrong_ratio_arr.','.$wrong_new_ratio_arr;
            }
            else
            {

                $new_num_arr=$new_num_arr.','.$g2_num_data[$i];
                $new_ratio_arr=$new_ratio_arr.','.$g2_ratio_data[$i];
                $wrong_ratio_arr=$wrong_ratio_arr.','.$wrong_ratio_arr_data[$i];
            }
        }
        $new_num_arr=substr($new_num_arr,1);
        $new_ratio_arr=substr($new_ratio_arr,1);
        $wrong_ratio_arr=substr($wrong_ratio_arr,1);


        $arr['g2_num']=$new_num_arr;
        $arr['g2_wrong_ratio_arr']=$new_ratio_arr;
        $arr['wrong_ratio_arr']=$wrong_ratio_arr;


        $model_class_statistic->where('classid='.$classid)->save($arr);
    }
    if($groupid==3)
    {
        $g3_num_data=explode(',',$data_class['g3_num']);
        $g3_ratio_data=explode(',',$data_class['g1_wrong_ratio_arr']);

        $g3_num=$g3_num_data[$num];
        $g3_wrong_ratio_arr=$g3_ratio_data[$num];
        $g3_new_ratio=round(($g3_num*$g3_wrong_ratio_arr+$wrongratio)/($g3_num+1),3);




        $g1_num_data=explode(',',$data_class['g1_num']);
        $g1_ratio_data=explode(',',$data_class['g1_wrong_ratio_arr']);
        $g1_num=$g1_num_data[$num];
        $g1_wrong_ratio_arr=$g1_ratio_data[$num];

        $g2_num_data=explode(',',$data_class['g2_num']);
        $g2_ratio_data=explode(',',$data_class['g2_wrong_ratio_arr']);
        $g2_num=$g2_num_data[$num];
        $g2_wrong_ratio_arr=$g2_ratio_data[$num];




        $wrong_new_ratio_arr=($g1_num*$g1_wrong_ratio_arr+$g2_num*$g2_wrong_ratio_arr+($g3_num+1)*$g3_new_ratio)/($g1_num+$g2_num+$g3_num+1);

        $wrong_ratio_arr_data=explode(',',$data_class['wrong_ratio_arr']);

        $new_num_arr='';
        $new_ratio_arr='';

        for($i=0;$i<sizeof($testidarr);$i++)
        {
            if($i==$num)
            {
                $new_num_arr=$new_num_arr.','.($g3_num+1);
                $new_ratio_arr=$new_ratio_arr.','.$g3_new_ratio;
                $wrong_ratio_arr=$wrong_ratio_arr.','.$wrong_new_ratio_arr;
            }
            else
            {

                $new_num_arr=$new_num_arr.','.$g3_num_data[$i];
                $new_ratio_arr=$new_ratio_arr.','.$g3_ratio_data[$i];
                $wrong_ratio_arr=$wrong_ratio_arr.','.$wrong_ratio_arr_data[$i];
            }
        }
        $new_num_arr=substr($new_num_arr,1);
        $new_ratio_arr=substr($new_ratio_arr,1);
        $wrong_ratio_arr=substr($wrong_ratio_arr,1);


        $arr['g3_num']=$new_num_arr;
        $arr['g3_wrong_ratio_arr']=$new_ratio_arr;
        $arr['wrong_ratio_arr']=$wrong_ratio_arr;


        $model_class_statistic->where('classid='.$classid)->save($arr);
    }

}

//去掉数组中重复数据(通用)
function uniquearr($arr)
{
    $count=sizeof($arr);
    $newarr=$arr;

    for($i=0;$i<$count;$i++)
    {
        $ele=$arr[$i];

        $newcount=sizeof($newarr);

        for($m=$i+1;$m<$newcount;$m++)
        {
            if($ele==$newarr[$m])
            {
                $newarr[$m]='del';
            }
        }
    }

    $k=0;
    for($n=0;$n<$count;$n++)
    {
        if($newarr[$n]!='del')
        {
            $outputarr[$k]=$newarr[$n];
            $k=$k+1;
        }
    }

    return $outputarr;


}
//一个数组中某个数值的数量
function elenum($ele,$arr)
{
    $count=sizeof($arr);
    $num=0;
    for($i=0;$i<$count;$i++)
    {
        if($arr[$i]==$ele)
        {
            $num=$num+1;
        }
    }
    return $num;
}

//将数组对接，将A数组中的数据，与B数组中的数据，做链接,返回$arr数组
function linatob($a_arr,$b_arr)
{
    $a_count=sizeof($a_arr);
    $b_count=sizeof($b_arr);




    for($i=0;$i<$a_count;$i++)
    {
        $id=$a_arr[$i]['id'];
        $ctbname=$a_arr[$i]['ctbname'];
        for($j=0;$j<$b_count;$j++)
        {
            if($id==$b_arr[$j]['id'] && $ctbname!='t0')
            {
                $a_arr[$i]['time']=$b_arr[$j]['time'];
                $a_arr[$i]['num']=$b_arr[$j]['num'];
                $a_arr[$i]['inputval']=cuttitle($a_arr[$i]['inputval']);
                break;
            }else
            {
                $a_arr[$i]['time']=0;
                $a_arr[$i]['num']='none';
                $a_arr[$i]['inputval']=cuttitle($a_arr[$i]['inputval']);
            }
        }
    }

    return $a_arr;
}

//去掉字符串中的题型标准，或者分数部分
function cuttitle($msg)
{


    if(strpos($msg,"(T+A)",0)>0)
    {
        return  str_replace("(T+A)"," ",$msg);
    };

    if(strpos($msg,"(A)",0)>0)
    {
        return  str_replace("(A)"," ",$msg);
    };

    if(strpos($msg,"(T)",0)>0)
    {
        return  str_replace("(T)"," ",$msg);
    };


    $local =mb_strpos($msg,'.');

    if($local>0)
    {
        $msg=mb_substr($msg,0,$local+1);
    }

    return $msg;
}

function getFirstCharter($str)
{
    if (empty($str)) {
        return '';
    }
    $fchar = ord($str{0});
    if ($fchar >= ord('A') && $fchar <= ord('z')) return strtoupper($str{0});
    $s1 = iconv('UTF-8', 'gb2312', $str);
    $s2 = iconv('gb2312', 'UTF-8', $s1);
    $s = $s2 == $str ? $s1 : $str;
    $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
    if ($asc >= -20319 && $asc <= -20284) return 'A';
    if ($asc >= -20283 && $asc <= -19776) return 'B';
    if ($asc >= -19775 && $asc <= -19219) return 'C';
    if ($asc >= -19218 && $asc <= -18711) return 'D';
    if ($asc >= -18710 && $asc <= -18527) return 'E';
    if ($asc >= -18526 && $asc <= -18240) return 'F';
    if ($asc >= -18239 && $asc <= -17923) return 'G';
    if ($asc >= -17922 && $asc <= -17418) return 'H';
    if ($asc >= -17417 && $asc <= -16475) return 'J';
    if ($asc >= -16474 && $asc <= -16213) return 'K';
    if ($asc >= -16212 && $asc <= -15641) return 'L';
    if ($asc >= -15640 && $asc <= -15166) return 'M';
    if ($asc >= -15165 && $asc <= -14923) return 'N';
    if ($asc >= -14922 && $asc <= -14915) return 'O';
    if ($asc >= -14914 && $asc <= -14631) return 'P';
    if ($asc >= -14630 && $asc <= -14150) return 'Q';
    if ($asc >= -14149 && $asc <= -14091) return 'R';
    if ($asc >= -14090 && $asc <= -13319) return 'S';
    if ($asc >= -13318 && $asc <= -12839) return 'T';
    if ($asc >= -12838 && $asc <= -12557) return 'W';
    if ($asc >= -12556 && $asc <= -11848) return 'X';
    if ($asc >= -11847 && $asc <= -11056) return 'Y';
    if ($asc >= -11055 && $asc <= -10247) return 'Z';
    return null;
 
}

//根据首字母，进行排序
function turnArray($array) {
 foreach($array as $k=>&$v) {
  $v['letter']=strtolower(getFirstCharter($v['keynotemsg']));
 }
  
  
 // $last_names = array_column($data,'last_name');
//array_multisort($last_names,SORT_DESC,$data);
  
  array_multisort(array_column($array,'letter'),SORT_ASC,$array);
 return $array;
}

function questiontype($subjectid)
{
     $model_questiontypes=M('questiontypes');
     $question_data=$model_questiontypes->where('subjectid='.$subjectid)->select();
  	 return $question_data;
}
//根据习题id，输出排版结构
function testid_to_publishpaper($test_id)
{
     $model_onekeynote=M('onekeynote');
     $model_key_paper_msg_data=M('key_paper_msg_data');
     $model_test_public_data=M('test_public_data');

 
    $onekeydata=$model_key_paper_msg_data->where('id='.$test_id)->find();
  
    $filesernum=$onekeydata['filesernum'];
    $paper_name=$onekeydata['paper_name'];
    $public_data_arr['filesernum']=$filesernum;
    $public_data_arr['ctbname']  = array('not in',array('t0','t1'));
  
    
    $test_public_data=$model_test_public_data->where($public_data_arr)->field('id,typeid')->select();
 
    for($i=0;$i<sizeof($test_public_data);$i++)
    {
      $testidarr[$i]=$test_public_data[$i]['id'];
      $testtypeid[$i]=$test_public_data[$i]['typeid'];
    }
    

   
    
    $count=count($testidarr);
    $model1=M('img_cuted_data');
    $model2=M('test_public_data');
    
    

        for($i=0;$i<$count;$i++)
        {
            $data2=$model2->where('id='.$testidarr[$i])->find();
            $srcid=$data2[srcid];
            $data1=$model1->where('id='.$srcid)->find();
            $src=$data1[src];

            $pic1id=$data2[pic1];
            $data1=$model1->where('id='.$pic1id)->find();
            $pic1src=$data1[src];

            $pic2id=$data2[pic2];
            $data1=$model1->where('id='.$pic2id)->find();
            $pic2src=$data1[src];

            $pic3id=$data2[pic3];
            $data1=$model1->where('id='.$pic3id)->find();
            $pic3src=$data1[src];

            $pic4id=$data2[pic4];
            $data1=$model1->where('id='.$pic4id)->find();
            $pic4src=$data1[src];

            $test[$i][title]=cuttitlemsg($data2[inputval]);
            $test[$i][id]=$data2[id];
            $test[$i][src]=usersrc($src);
            $test[$i][tsernum]=$data2[tsernum];
            $test[$i][ctbname]=$data2[ctbname];
            $test[$i][filesernum]=$data2[filesernum];
            $test[$i][pic1]=usersrc($pic1src);
            $test[$i][pic2]=usersrc($pic2src);
            $test[$i][pic3]=usersrc($pic3src);
            $test[$i][pic4]=usersrc($pic4src);
            $test[$i][typeid]=$testtypeid[$i];

            $sum=0;
            if($pic1src!='')
            {
                $sum=$sum+1;
            }
            if($pic2src!='')
            {
                $sum=$sum+1;
            }
            if($pic3src!='')
            {
                $sum=$sum+1;
            }
            if($pic4src!='')
            {
                $sum=$sum+1;
            }

            $test[$i][sum]=$sum;

            if($sum!=0)
            {
               // $test[$i][picnote]='题 '.str_replace(array("\r\n", "\r", "\n",".","&nbps;"), '',$test[$i][newtitle]).'图';
               $test[$i][picnote]='';
            }
            else
            {
                $test[$i][picnote]='';
            }
        }
    


        $mycount=count($test);
        $tsernum=0;
        $m=0;
        $no1=1;
        $no2=1;

    

        for($j=0;$j<$mycount;$j++)
        {

            if($test[$j][tsernum]!=$tsernum && $test[$j][tsernum]!='0')//为第一个A的标题
            {
                $no2=1;
                $testarr['ctbname']='t1';
                $testarr['tsernum']=$test[$j][tsernum];
                $testarr['filesernum']=$test[$j][filesernum];
                $tdata=$model2->where($testarr)->find();


                $srcid=$tdata[srcid];
                $data1=$model1->where('id='.$srcid)->find();
                $src=$data1[src];

                $pic1id=$tdata[pic1];
                $data1=$model1->where('id='.$pic1id)->find();
                $pic1src=$data1[src];

                $pic2id=$tdata[pic2];
                $data1=$model1->where('id='.$pic2id)->find();
                $pic2src=$data1[src];

                $pic3id=$tdata[pic3];
                $data1=$model1->where('id='.$pic3id)->find();
                $pic3src=$data1[src];

                $pic4id=$tdata[pic4];
                $data1=$model1->where('id='.$pic4id)->find();
                $pic4src=$data1[src];

                $newtest[$m][title]=cuttitlemsg($tdata[inputval]);
                //$newtest[$m][title]=$j.'.';
                $newtest[$m][typeid]=$test[$j][typeid];
                $newtest[$m][src]=usersrc($src);
                $newtest[$m][tsernum]=$tdata[tsernum];
                $newtest[$m][ctbname]=$tdata[ctbname];
                $newtest[$m][filesernum]=$tdata[filesernum];
                $newtest[$m][pic1]=usersrc($pic1src);
                $newtest[$m][pic2]=usersrc($pic2src);
                $newtest[$m][pic3]=usersrc($pic3src);
                $newtest[$m][pic4]=usersrc($pic4src);
                $newtest[$m][id]=$tdata[id];

                $sum=0;
                if($pic1src!='')
                {
                    $sum=$sum+1;
                }
                if($pic2src!='')
                {
                    $sum=$sum+1;
                }
                if($pic3src!='')
                {
                    $sum=$sum+1;
                }
                if($pic4src!='')
                {
                    $sum=$sum+1;
                }

                $newtest[$m][sum]=$sum;

                if($sum!=0)
                {
                    //$newtest[$m][picnote]='题 '.str_replace(array("\r\n", "\r", "\n",".","&nbps;"), '',$newtest[$m][newtitle]).'图';
                   $newtest[$m][picnote]='';
                }
                else{
                    $newtest[$m][picnote]='';
                }


                $newtest[$m][title]=cuttitlemsg($tdata[inputval]);
                $newtest[$m][src]=usersrc($src);
                $newtest[$m][newtitle]=$no1;
                $no1=$no1+1;


                $m=$m+1;
                $newtest[$m][title]= $test[$j][title];
                $newtest[$m][src]=$test[$j][src];
                $newtest[$m][newtitle]=$no2.'）';
                $newtest[$m][pic1]=$test[$j][pic1];
                $newtest[$m][pic2]=$test[$j][pic2];
                $newtest[$m][pic3]=$test[$j][pic3];
                $newtest[$m][pic4]=$test[$j][pic4];
                $newtest[$m][sum]=$test[$j][sum];
                $newtest[$m][picnote]=$test[$j][picnote];
                $newtest[$m][id]=$test[$j][id];


                $tsernum=$test[$m][tsernum];
                $no2=$no2+1;
                $m=$m+1;
            }
            else
            {
                $newtest[$m][title]= $test[$j][title];
                $newtest[$m][src]=$test[$j][src];
                $newtest[$m][typeid]=$test[$j][typeid];

                $newtest[$m][ctbname]=$test[$j][ctbname];
                $newtest[$m][tsernum]=$test[$j][tsernum];
                $newtest[$m][filesernum]=$test[$j][filesernum];
                $newtest[$m][newtitle]=$no2.'）';
                $newtest[$m][pic1]=$test[$j][pic1];
                $newtest[$m][pic2]=$test[$j][pic2];
                $newtest[$m][pic3]=$test[$j][pic3];
                $newtest[$m][pic4]=$test[$j][pic4];
                $newtest[$m][sum]=$test[$j][sum];
                $newtest[$m][picnote]=$test[$j][picnote];
                $newtest[$m][id]=$test[$j][id];



                if($test[$j][ctbname]=='t-a')
                {
                    $newtest[$m][newtitle]= $no1;
                    $no1=$no1+1;
                }

                if($test[$j][ctbname]=='a')
                {
                    $newtest[$m][newtitle]= $no2.'）';
                    $no2=$no2+1;
                }
                $m=$m+1;
            }


        }
       return $newtest;
}
//学科索引
function subjectdata()
{
  $model_subject_data=M('subject_data');
  $data=$model_subject_data->select();
  return $data;
}

//知识点id变成名称
function keynoteidtomsg($keynoteid)
{
  $model_onekeynote=M('onekeynote');
  $keynote_data=$model_onekeynote->where('id='.$keynoteid)->find();
  return $keynote_data['keynotemsg'];
}

//截取字符串中间字符
 function msg_cut_mid_part($begin,$end,$str){
      $b = mb_strpos($str,$begin) + mb_strlen($begin);
      $e = mb_strpos($str,$end) - $b;
      return mb_substr($str,$b,$e);
 }

//根据数组，返回偶数下标作为，错题，奇数，作为题型
function ctb_arr($data)
{
  $length=sizeof($data);
  $ctb_id_arr=$data[0];
  $ctb_type_arr=$data[1];
  for($i=2;$i<$length;$i++)
  {
    if($i%2==0)
    {
     $ctb_id_arr=$ctb_id_arr.','.$data[$i];
    }
    else
    {
      $ctb_type_arr=$ctb_type_arr.','.$data[$i];
    }
  }
  
  $result[0]=$ctb_id_arr;//错题
  $result[1]=$ctb_type_arr;//题型
  $result[2]=date("Y-m-d H:i:s");//更新时间
  
  
  return $result;
}
//小程序page排版数组转化，从数据库数组，转化成页面参数数组
function mid_wechat_page_arr($arr,$testkind)
{
  $data=$arr;
  
 // return $data;
  
   $model_img_cuted_data=M('img_cuted_data');//表B
   $count=sizeof($data);
    for($i=0;$i<$count;$i++)
    {
      if($testkind=='test' || $testkind=='key')
      {
        $data[$i]['title']=cuttitlemsg($data[$i]['inputval']);
      }

      
      if($data[$i]['test_src']!='.')
      {
       	$data[$i]['test_x']=imgxy($data[$i]['test_src'])['x'];
        $data[$i]['test_y']=imgxy($data[$i]['test_src'])['y'];
        $data[$i]['test_src']=substr($data[$i]['test_src'],2);
      }
      else
      {
       	$data[$i]['test_x']=0;
        $data[$i]['test_y']=0;
      }

      if($data[$i]['pic1']!=0)
      {
        $pic1_src=$model_img_cuted_data->where('id='.$data[$i]['pic1'])->find();
        $data[$i]['pic1_src']=$pic1_src['src'];
       	$data[$i]['pic1_x']=imgxy($pic1_src['src'])['x'];
        $data[$i]['pic1_y']=imgxy($pic1_src['src'])['y'];
        $data[$i]['pic1_src']=substr($data[$i]['pic1_src'],2);
      }
      else
      {
        $data[$i]['pic1_src']=0;
        $data[$i]['pic1_x']=0;
        $data[$i]['pic1_y']=0;
      }
      
      if($data[$i]['pic2']!=0)
      {
        $pic1_src=$model_img_cuted_data->where('id='.$data[$i]['pic2'])->find();
        $data[$i]['pic2_src']=$pic1_src['src'];
        $data[$i]['pic2_x']=imgxy($pic1_src['src'])['x'];
        $data[$i]['pic2_y']=imgxy($pic1_src['src'])['y'];
        $data[$i]['pic2_src']=substr($data[$i]['pic2_src'],2);
      }
      else
      {
        $data[$i]['pic2_src']=0;
        $data[$i]['pic2_x']=0;
        $data[$i]['pic2_y']=0;
      }
      
      if($data[$i]['pic3']!=0)
      {
        $pic1_src=$model_img_cuted_data->where('id='.$data[$i]['pic3'])->find();
        $data[$i]['pic3_src']=$pic1_src['src'];
        $data[$i]['pic3_x']=imgxy($pic1_src['src'])['x'];
        $data[$i]['pic3_y']=imgxy($pic1_src['src'])['y'];
        $data[$i]['pic3_src']=substr($data[$i]['pic3_src'],2);
      }
      else
      {
        $data[$i]['pic3_src']=0;
        $data[$i]['pic3_x']=0;
        $data[$i]['pic3_y']=0;
      }
      
       if($data[$i]['pic4']!=0)
      {
        $pic1_src=$model_img_cuted_data->where('id='.$data[$i]['pic4'])->find();
        $data[$i]['pic4_src']=$pic1_src['src'];
        $data[$i]['pic4_x']=imgxy($pic1_src['src'])['x'];
        $data[$i]['pic4_y']=imgxy($pic1_src['src'])['y'];
        $data[$i]['pic4_src']=substr($data[$i]['pic4_src'],2);
      }
      else
      {
        $data[$i]['pic4_src']=0;
        $data[$i]['pic4_x']=0;
        $data[$i]['pic4_y']=0;
      }
      
      if($data[$i]['answer_id']!=0)
      {
      	$data[$i]['answer_x']=imgxy($data[$i]['answer_src'])['x'];
        $data[$i]['answer_y']=imgxy($data[$i]['answer_src'])['y'];
        $data[$i]['answer_src']=substr($data[$i]['answer_src'],2);
      }
      else
      {
        $data[$i]['answer_x']=0;
        $data[$i]['answer_y']=0;
      }
    }
   
      //$newdata['list']=$data;

    //  return $data;
  		$testnum=1;
      for($i=0;$i<$count;$i++)
      {
        if($data[$i]['ctbname']=='t-a' || $data[$i]['ctbname']=='a' )
        {
          $testnum=$testnum+1;
        }
        $middata[$i]['srcid']=$data[$i]['srcid'];
        $middata[$i]['pic1']=$data[$i]['pic1'];
        $middata[$i]['pic2']=$data[$i]['pic2'];
        $newdata[$i]['pic3']=$data[$i]['pic3'];
        $middata[$i]['pic4']=$data[$i]['pic4'];
        $middata[$i]['ctbname']=$data[$i]['ctbname'];
        $middata[$i]['typeid']=$data[$i]['typeid'];
        $middata[$i]['test_src']=$data[$i]['test_src'];
        $middata[$i]['answer_id']=$data[$i]['answer_id'];
        $middata[$i]['answer_src']=$data[$i]['answer_src'];
        $middata[$i]['title']=$data[$i]['title'];
        
        $middata[$i]['test_x']=$data[$i]['test_x'];
        $middata[$i]['test_y']=$data[$i]['test_y'];
        $middata[$i]['pic1_src']=$data[$i]['pic1_src'];
        $middata[$i]['pic1_x']=$data[$i]['pic1_x'];
        $middata[$i]['pic1_y']=$data[$i]['pic1_y'];
        
        $middata[$i]['pic2_src']=$data[$i]['pic2_src'];
        $middata[$i]['pic2_x']=$data[$i]['pic2_x'];
        $middata[$i]['pic2_y']=$data[$i]['pic2_y'];
        
        $middata[$i]['pic3_src']=$data[$i]['pic3_src'];
        $middata[$i]['pic3_x']=$data[$i]['pic3_x'];
        $middata[$i]['pic3_y']=$data[$i]['pic3_y'];
        
        $middata[$i]['pic4_src']=$data[$i]['pic4_src'];
        $middata[$i]['pic4_x']=$data[$i]['pic4_x'];
        $middata[$i]['pic4_y']=$data[$i]['pic4_y'];
        
        $middata[$i]['answer_x']=$data[$i]['answer_x'];
        $middata[$i]['answer_y']=$data[$i]['answer_y'];

      }
      $newdata['count']=$count;
  	  $newdata['testnum']=$testnum;
      $newdata['paper_name']=$data[0]['paper_name'];
      $newdata['testid']=$testid;
      $newdata['testimage']=$data[0]['testimage'];
      $newdata['answerimage']=$data[0]['answerimage'];
      $newdata['font_size']=$data[0]['font_size'];
      $newdata['list']=$middata;
  
  return $newdata;
  //return $middata;
}

function mid_wechat_choose_arr($arr)
{
  $data=$arr;
      $count=sizeof($data);
    for($i=0;$i<$count;$i++)
    {
      if($data[$i]['ctbname']=='t0')
      {
        $middata[$i]['title']=cuttitlemsg($data[$i]['inputval']).$data[$i]['typesmsg'];
      }
      else
      {
       $middata[$i]['title']=cuttitlemsg($data[$i]['inputval']);
      }
      $middata[$i]['ctbname']=$data[$i]['ctbname'];
      $middata[$i]['typeid']=$data[$i]['typeid'];
      $middata[$i]['test_id']=$data[$i]['test_id'];
    }
      $newdata['count']=$count;
      $newdata['paper_name']=$data[0]['paper_name'];
      $newdata['testid']=$testid;
      $newdata['list']=$middata;
  
     return $newdata;
}
//数字转汉字
function fir_num_to_font($num)
{
  $font;
  switch($num)
  {
    case 1:$font='一';break;
    case 2:$font='二';break;
    case 3:$font='三';break;
    case 4:$font='四';break;
    case 5:$font='五';break;
    case 6:$font='六';break;
    case 7:$font='七';break;
    case 8:$font='八';break;
    case 9:$font='九';break;
    case 10:$font='十';break;
    case 11:$font='十一';break;
    case 12:$font='十二';break;
    case 13:$font='十三';break;
    case 14:$font='十四';break;
    case 15:$font='十五';break;
    case 16:$font='十六';break;
    case 17:$font='十七';break;
    case 18:$font='十八';break;
    case 19:$font='十九';break;
    case 20:$font='二十';break;
    case 21:$font='二十一';break;
    case 22:$font='二十二';break;
    case 23:$font='二十三';break;
    case 24:$font='二十四';break;
    case 25:$font='二十五';break;
    case 26:$font='二十六';break;
    case 27:$font='二十七';break;
    case 28:$font='二十八';break;
    case 29:$font='二十九';break;
    case 30:$font='三十';break;
  }
  return $font;
}

//数字转汉字
function third_num_to_font($num)
{
  $font;
  switch($num)
  {
    case 1:$font='(1)';break;
    case 2:$font='(2)';break;
    case 3:$font='(3)';break;
    case 4:$font='(4)';break;
    case 5:$font='(5)';break;
    case 6:$font='(6)';break;
    case 7:$font='(7)';break;
    case 8:$font='(8)';break;
    case 9:$font='(9)';break;
    case 10:$font='(10)';break;
    case 11:$font='(11)';break;
    case 12:$font='(12)';break;
    case 13:$font='(13)';break;
    case 14:$font='(14)';break;
    case 15:$font='(15)';break;
    case 16:$font='(16)';break;
    case 17:$font='(17)';break;
    case 18:$font='(18)';break;
    case 19:$font='(19)';break;
    case 20:$font='(20)';break;
    case 21:$font='(21)';break;
    case 22:$font='(22)';break;
    case 23:$font='(23)';break;
    case 24:$font='(24)';break;
    case 25:$font='(25)';break;
    case 26:$font='(26)';break;
    case 27:$font='(27)';break;
    case 28:$font='(28)';break;
    case 29:$font='(29)';break;
    case 30:$font='(30)';break;
  }
  return $font;
}
//错题本列表提示信息，题型数量
function ctb_note_msg($msg)
{
    $type_arr=explode(',',$msg);
    
    $arr=array_count_values($type_arr);
    $typemsg='';
    $p=1;
    
    foreach($arr as $k=>$v){ 
      if($p==1)
      {
        $typemsg=$p.'.'.$k."(".$v.")";
        $p=$p+1;
      }
      else
      {
        $typemsg=$typemsg.' '.$p.'.'.$k."(".$v.")";
        $p=$p+1;
      } 
	} 
    
    return $typemsg;
}
//拆分字符串中的年月日
function ymd_sub($datetime,$kind)
{
  if($kind=='y')
  {
    return date('Y',strtotime($datetime));
  }
                
  if($kind=='m')
  {
    return date('m',strtotime($datetime));
  }
                
  if($kind=='d')
  {
    return date('d',strtotime($datetime));
  }
}

//
//去掉习题中重复数据，应用在Wechat中task函数
function unique_exercise_arr($arr)
{
    $count=sizeof($arr);
    $newarr=$arr;

    for($i=0;$i<$count;$i++)
    {
        $ele=$arr[$i]['exerciseid'];

        $newcount=sizeof($newarr);

        for($m=$i+1;$m<$newcount;$m++)
        {
            if($ele==$newarr[$m]['exerciseid'])
            {
                $newarr[$m]['del']='del';
            }
        }
    }

    $k=0;
    for($n=0;$n<$count;$n++)
    {
        if($newarr[$n]['del']!='del')
        {
            $outputarr[$k]['id']=$newarr[$n]['id'];
            $outputarr[$k]['testid']=$newarr[$n]['testid'];
            $outputarr[$k]['exerciseid']=$newarr[$n]['exerciseid'];
            $outputarr[$k]['lastreadtime']=$newarr[$n]['lastreadtime'];
            $outputarr[$k]['keyornot']=$newarr[$n]['keyornot'];
            $outputarr[$k]['name']=$newarr[$n]['name'];
            $outputarr[$k]['kind']=$newarr[$n]['kind'];
            $k=$k+1;
        }
    }

    return $outputarr;
}

//二维码号生成
function number()
{
	$time=date('YmdHis');
	$a=rand(0,9);
	$b=rand(0,9);
	$c=$a+$b;
	    	 
	if(($a+$b)>=10){
	$c=$a+$b-10;
	}
	    
	$str=$a.mt_rand(100,999).$b.mt_rand(10,99).$c.$time;
	return $str;
}

//号码校验算法
function checknumber($str)
{
	//$str="6986220820190522162949";
	//获取第一位和第五位和第八位
	$a=substr($str,0,1);
	$b=substr($str,4,1);
	$c=substr($str,7,1);
	$res=0;
	if($a+$b==$c) {
		$res=1;
	}

	if(($a+$b-10)==$c) {
		$res=1;
	}
	echo $res;
}

//图片二维码生成
function qrcode($str)
{
	require "./ThinkPHP/Library/Org/Util/phpqrcode.php";
	\QRcode::png($str,'./uploads/code/'.$str.'.png',QR_ECLEVEL_L, 10);
	 
	return './uploads/code/'.$str.'.png';
}

//二维码生成和更新
function downloadcode($id)
{
	 
	//校验下 是否已生成
	$code=M('code_msg');
	$codeinfo=$code->find($id);
	 
	 
	//然后生成图片
	$imgstr=qrcode($codeinfo['codemsg']);
 
	 
	//然后下载图片
	 
	//获取要下载的文件名
	$filename = $imgstr;
	//设置头信息
	header('Content-Disposition:attachment;filename='.basename($filename));
	header('Content-Type: application/octet-stream;charset=utf-8');
	header('Content-Length:'.filesize($filename));
	//读取文件并写入到输出缓冲
	readfile($filename);
}

function email($email,$title,$content)
{
	//邮件发送服务器
	$emailHost='smtp.163.com';
	//邮件发送端口
	$emailPort='25';
	
	//邮件发送超时时间
	$emailTimeout='20';
	//发件人邮箱
	$emailUserName='hzjooctb@163.com';
	//发件人邮箱密码
	$emailPassword='fangzheng123456';
	//发件人姓名
	$emailFormName='abc';
	//收件人邮箱
	$toemail=$email;
	//邮件标题
	$subject=$title;
	//邮件内容
	$message=$content;

	vendor('phpmailer.class#phpmailer'); //从PHPMailer目录导class.phpmailer.php类文件
	vendor('SMTP');
	$mailer=new phpmailer();

	//邮件配置
	$mailer->SetLanguage('zh_cn');
	$mailer->Host = $emailHost;
	//$mailer->Port = $emailPort;
	$mailer->SMTPSecure = 'ssl';
	$mailer->Port = 465;
	$mailer->Timeout = $emailTimeout;
	$mailer->ContentType = 'text/html';//设置html格式
	$mailer->SMTPAuth = true;
	$mailer->Username = $emailUserName;
	$mailer->Password = $emailPassword;
	$mailer->IsSMTP();
	$mailer->From = $mailer->Username; // 发件人邮箱
	$mailer->FromName =$emailFormName;
	$mailer->AddReplyTo( $mailer->Username );
	$mailer->CharSet = 'UTF-8';

	// 发送邮件
	$mailer->AddAddress( $toemail );
	$mailer->Subject = $subject;
	$mailer->Body = $message;
	if ($mailer->Send() === true) {
		return true;
	} else {
		$error = $mailer->ErrorInfo;
		return false;
	}
}

?>
