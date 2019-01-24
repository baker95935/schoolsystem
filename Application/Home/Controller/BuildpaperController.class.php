<?php
namespace Home\Controller;
use Think\Controller;
use Think\Image;
require 'Public/tcpdf/tcpdf.php';
//use vendor\crop;

class BuildpaperController extends Controller
{

    public function index()
    {
        $this->display();
    }

    public function phpuserupload()
    {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $model = M('user_data');
            $data = $model->where(array('username' => $username, 'pwd' => $password))->find();
            $id=$data['id'];
            $userdata['username']=$username;

                if($id>0)
                {
                   $userdata['id']=$id;
                   echo  json_encode($userdata);
                }
                else
                {
                    $userdata['id']=0;
                    echo  json_encode($userdata);
                }
    }

    public function buildpage01()
    {
        $userid=$_GET['userid'];
        $this->assign('userid',$userid);
        $this->display();
    }

    public function gradelevelsub()
    {
        $id=$_POST[id];
        $model_user=M('user_data');
        $model_grade=M('grade_data');
        $model_school=M('school_data');
        $User_Data=$model_user->where('id='.$id)->find();
        $schoolid=$User_Data['schoolid'];
        $school_Data=$model_school->where('school_id='.$schoolid)->find();
        $schoollevel=$school_Data['levelnum'];
        $grade_Data=$model_grade->where('levelnum='.$schoollevel)->select();
        $grade_Data['count']=sizeof($grade_Data);
        echo json_encode($grade_Data);


    }

    public function phpsubjectsub()
    {
        $model_subject=M('subject_data');
        $subjectdata=$model_subject->select();
        $subjectdata['count']=sizeof($subjectdata);

        echo json_encode($subjectdata);

    }

    public function phpgradesub(){
        $gradeid=$_POST[checkgradeid];
        $subjectid=$_POST[subjectid];
        $model_grade=M('grade_data');
        $model_chapter=M('chapter_msg');
        //$grade_data

        $gradeidarr=explode(',',$gradeid);
        $count=sizeof($gradeidarr);


        $newchapter='';

        $n=0;
        for($m=0;$m<$count;$m++)
        {
            $gradedata=$model_grade->where('id='.$gradeidarr[$m])->find();


            $gradeid=$gradeidarr[$m];

            $grademsg=$gradedata['grademsg'];
            $newchapter[$n]['chaptermsg']=$grademsg;
            $newchapter[$n]['kind']='grade';
            $newchapter[$n]['id']='999';

            $arr['gradeid']=$gradeid;
            $arr['subjectid']=$subjectid;
            $arr['displayornot']=1;

            $chapterdata=$model_chapter->where($arr)->select();
            $chaptercount=sizeof($chapterdata);
            $n=$n+1;

            for($k=0;$k<$chaptercount;$k++)
            {
                $newchapter[$n]['chaptermsg']=$chapterdata[$k]['chaptermsg'];
                $newchapter[$n]['kind']='chapter';
                $newchapter[$n]['id']=$chapterdata[$k]['id'];
                $n=$n+1;
            }

        }

        $newchapter['count']=sizeof($newchapter);
        echo json_encode($newchapter);

    }

    public function phpclasssub()
    {
        $userid=$_POST['id'];
//        $userid=79;


        $model=M('user_teacher_addation_data');
        $model_class=M('class_data');
        $classid=$model->where('userid='.$userid)->find();

        $classarr=explode(',',$classid['classarray']);
        $count=sizeof($classarr);

        for($i=0;$i<$count;$i++)
        {
            $classdata=$model_class->where('id='.$classarr[$i])->find();
            $newclassarr[$i]['id']=$classarr[$i];
            $newclassarr[$i]['classname']=$classdata['classname'];
        }

        $newclassarr['count']=sizeof($newclassarr);

        echo json_encode($newclassarr);

    }

    public function phpquestionsub()
    {
        $subjectid=$_POST['subjectid'];
        $question_model=M('questiontypes');
        $questiondata=$question_model->where('subjectid='.$subjectid)->order('orderid asc')->select();
        $questiondata['count']=sizeof($questiondata);

        echo json_encode($questiondata);
    }

    public function phpnextquestionsub()
    {
        $subjectid=$_POST['subjectid'];
        $questionidarr=$_POST['questionidarr'];
        $question_model=M('questiontypes');

        $questionidarr=explode(',',$questionidarr);
        $qcount=sizeof($questionidarr);

        $questiondata=$question_model->where('subjectid='.$subjectid)->order('orderid asc')->select();
        $count=sizeof($questiondata);



        $m=0;

        $kind=0;

        for($i=0;$i<$count;$i++)
        {
            for($j=0;$j<$qcount;$j++)
            {
                if($questionidarr[$j]==$questiondata[$i]['id'])
                {
                    $kind=1;
                    continue;
                }

            }

            if($kind==0)
            {
                $newdata[$m]['id']=$questiondata[$i]['id'];
                $newdata[$m]['typesmsg']=$questiondata[$i]['typesmsg'];
                $m=$m+1;
            }
            $j=0;
            $kind=0;
        }


        $newdata['count']=sizeof($newdata);
        echo json_encode($newdata);

    }

    public function phpchaptersub(){
        $checkchapter=$_POST['checkchapter'];

        $chapterarr=explode(',',$checkchapter);
        $length=sizeof($chapterarr);

        $keynoteid='';
        $keynotemsg='';
        $model=M('keynote_data');

        for($i=0;$i<$length;$i++)
        {
            $keynotedata=$model->where('chapter='.$chapterarr[$i])->select();


            $keynotelength=sizeof($keynotedata);


            for($j=0;$j<$keynotelength;$j++)
            {

                $keynotedata[$j]['akeynote_id']=trimall($keynotedata[$j]['akeynote_id']);

                if($keynotedata[$j]['akeynote_id']!='')
                {
                    if($j==0)
                    {
                        $keynoteid=$keynoteid.$keynotedata[$j]['akeynote_id'];
                        $keynotemsg=$keynotemsg.$keynotedata[$j]['akeynotemsg'];
                    }
                    else
                    {

                        $keynoteid=$keynoteid.','.$keynotedata[$j]['akeynote_id'];
                        $keynotemsg=$keynotemsg.','.$keynotedata[$j]['akeynotemsg'];
                    }

                }

            }

        }


        $keynoteid=array_unique(explode(',',$keynoteid));
        $keynotemsg=array_unique(explode(',',$keynotemsg));

        $keynoteid=implode(',',$keynoteid);
        $keynotemsg=implode(',',$keynotemsg);

        $keynoteid=explode(',',$keynoteid);
        $keynotemsg=explode(',',$keynotemsg);

        $length=sizeof($keynoteid);

        for($m=0;$m<$length;$m++)
        {
            $keynotearr[$m]['id']=$keynoteid[$m];
            $keynotearr[$m]['msg']=$keynotemsg[$m];
        }

        $keynotearr['count']=sizeof($keynotearr);


        echo json_encode($keynotearr);
    }
//进行考试习题索引
    public function phptestsearch()
    {

        $id=$_POST['userid'];
        $subjectid=$_POST['subjectid'];
        $begintime=$_POST['begintime'];
        $endtime=$_POST['endtime'];
        $testtypekind=$_POST['testtypekind'];
        $keyword=$_POST['keyword'];
        $testchapterarr=$_POST['testchapterarr'];
        $typeid=$_POST['typeid'];
        $nowpage=$_POST['nowpage'];
        $pagelength=$_POST['pagelength'];


//
//        $id=135;
//        $subjectid=2;
//        $begintime='';
//        $endtime='';
//        $testtypekind='';
//        $keyword='';
//        $testchapterarr='36,37,38,45,39,40,41,42,43,44,0';
//        $typeid=20;
//        $nowpage=2;
//        $pagelength=5;

        $model_test=M('test_statistic');
        $all_arr['userid']=$id;
        $all_arr['subjectid']=$subjectid;
        $all_data=$model_test->where($all_arr)->field('id,testid,classidarr,groupidarr,testtime,testkind,chapterarr,paper_name,filesernum')->select();

        $all_count=sizeof($all_data);

        $m=0;
        for($i=0;$i<$all_count;$i++)
        {

            $classidarr=explode(',',$all_data[$i]['classidarr']);
            $groupidarr=explode(',',$all_data[$i]['groupidarr']);
            $testtime=explode(',',$all_data[$i]['testtime']);
            $testkind=explode(',',$all_data[$i]['testkind']);
            $chapterarr=explode(',',$all_data[$i]['chapterarr']);

            $class_count=sizeof($classidarr);

            for($n=0;$n<$class_count;$n++)
            {

                $newdata[$m]['id']=$all_data[$i]['id'];
                $newdata[$m]['testid']=$all_data[$i]['testid'];
                $newdata[$m]['paper_name']=$all_data[$i]['paper_name'];
                $newdata[$m]['filesernum']=$all_data[$i]['filesernum'];

                $newdata[$m]['classidarr']=$classidarr[$n];
                $newdata[$m]['groupidarr']=$groupidarr[$n];
                $newdata[$m]['testtime']=$testtime[$n];
                $newdata[$m]['testkind']=$testkind[$n];
                $newdata[$m]['chapterarr']=$chapterarr[$n];
                $m=$m+1;
            }
        }


        $count=sizeof($newdata);


        //通过时间进行索引

        if($begintime=='' && $endtime!='')
        {
            $m=0;
            for($k=0;$k<$count;$k++)
            {
                if($endtime>=date($newdata[$k]['testtime']))
                {
                    $timedata[$m]['id']=$newdata[$k]['id'];
                    $timedata[$m]['paper_name']=$newdata[$k]['paper_name'];
                    $timedata[$m]['testid']=$newdata[$k]['testid'];
                    $timedata[$m]['classidarr']=$newdata[$k]['classidarr'];
                    $timedata[$m]['groupidarr']=$newdata[$k]['groupidarr'];
                    $timedata[$m]['testtime']=$newdata[$k]['testtime'];
                    $timedata[$m]['testkind']=$newdata[$k]['testkind'];
                    $timedata[$m]['chapterarr']=$newdata[$k]['chapterarr'];
                    $timedata[$m]['filesernum']=$newdata[$k]['filesernum'];
                    $m=$m+1;
                }

            }
        }

        if($begintime!='' && $endtime=='' )
        {
            $m=0;
            for($k=0;$k<$count;$k++)
            {
                if($begintime<=date($newdata[$k]['testtime']))
                {
                    $timedata[$m]['id']=$newdata[$k]['id'];
                    $timedata[$m]['paper_name']=$newdata[$k]['paper_name'];
                    $timedata[$m]['testid']=$newdata[$k]['testid'];
                    $timedata[$m]['classidarr']=$newdata[$k]['classidarr'];
                    $timedata[$m]['groupidarr']=$newdata[$k]['groupidarr'];
                    $timedata[$m]['testtime']=$newdata[$k]['testtime'];
                    $timedata[$m]['testkind']=$newdata[$k]['testkind'];
                    $timedata[$m]['chapterarr']=$newdata[$k]['chapterarr'];
                    $timedata[$m]['filesernum']=$newdata[$k]['filesernum'];
                    $m=$m+1;
                }

            }
        }


        if($begintime!='' && $endtime!='' )
        {
            $m=0;
            for($k=0;$k<$count;$k++)
            {
                if($begintime<=date($newdata[$k]['testtime']) && $endtime>=date($newdata[$k]['testtime']))
                {
                    $timedata[$m]['id']=$newdata[$k]['id'];
                    $timedata[$m]['paper_name']=$newdata[$k]['paper_name'];
                    $timedata[$m]['testid']=$newdata[$k]['testid'];
                    $timedata[$m]['classidarr']=$newdata[$k]['classidarr'];
                    $timedata[$m]['groupidarr']=$newdata[$k]['groupidarr'];
                    $timedata[$m]['testtime']=$newdata[$k]['testtime'];
                    $timedata[$m]['testkind']=$newdata[$k]['testkind'];
                    $timedata[$m]['chapterarr']=$newdata[$k]['chapterarr'];
                    $timedata[$m]['filesernum']=$newdata[$k]['filesernum'];
                    $m=$m+1;
                }

            }
        }

        if($begintime=='' && $endtime=='')
        {
            $m=0;
            for($k=0;$k<$count;$k++)
            {

                    $timedata[$m]['id']=$newdata[$k]['id'];
                    $timedata[$m]['paper_name']=$newdata[$k]['paper_name'];
                    $timedata[$m]['testid']=$newdata[$k]['testid'];
                    $timedata[$m]['classidarr']=$newdata[$k]['classidarr'];
                    $timedata[$m]['groupidarr']=$newdata[$k]['groupidarr'];
                    $timedata[$m]['testtime']=$newdata[$k]['testtime'];
                    $timedata[$m]['testkind']=$newdata[$k]['testkind'];
                    $timedata[$m]['chapterarr']=$newdata[$k]['chapterarr'];
                    $timedata[$m]['filesernum']=$newdata[$k]['filesernum'];
                    $m=$m+1;

            }
        }


        $count=sizeof($timedata);

        if($keyword=='')
        {
            $m=0;
            for($k=0;$k<$count;$k++)
            {

                    $keydata[$m]['id']=$timedata[$k]['id'];
                    $keydata[$m]['paper_name']=$timedata[$k]['paper_name'];
                    $keydata[$m]['testid']=$timedata[$k]['testid'];
                    $keydata[$m]['classidarr']=$timedata[$k]['classidarr'];
                    $keydata[$m]['groupidarr']=$timedata[$k]['groupidarr'];
                    $keydata[$m]['testtime']=$timedata[$k]['testtime'];
                    $keydata[$m]['testkind']=$timedata[$k]['testkind'];
                    $keydata[$m]['chapterarr']=$timedata[$k]['chapterarr'];
                    $keydata[$m]['filesernum']=$timedata[$k]['filesernum'];
                    $m=$m+1;
            }
        }
        else
        {
            $m=0;
            for($k=0;$k<$count;$k++)
            {
                if(strstr($timedata[$k]['paper_name'],$keyword)!='')
                {
                    $keydata[$m]['id']=$timedata[$k]['id'];
                    $keydata[$m]['paper_name']=$timedata[$k]['paper_name'];
                    $keydata[$m]['testid']=$timedata[$k]['testid'];
                    $keydata[$m]['classidarr']=$timedata[$k]['classidarr'];
                    $keydata[$m]['groupidarr']=$timedata[$k]['groupidarr'];
                    $keydata[$m]['testtime']=$timedata[$k]['testtime'];
                    $keydata[$m]['testkind']=$timedata[$k]['testkind'];
                    $keydata[$m]['chapterarr']=$timedata[$k]['chapterarr'];
                    $keydata[$m]['filesernum']=$timedata[$k]['filesernum'];
                    $m=$m+1;
                }
            }
        }




        //考试类型索引
        $count=sizeof($keydata);


        if($testtypekind==0)
        {
            $m=0;
            for($k=0;$k<$count;$k++)
            {

                    $testkinddata[$m]['id']=$keydata[$k]['id'];
                    $testkinddata[$m]['paper_name']=$keydata[$k]['paper_name'];
                    $testkinddata[$m]['testid']=$keydata[$k]['testid'];
                    $testkinddata[$m]['classidarr']=$keydata[$k]['classidarr'];
                    $testkinddata[$m]['groupidarr']=$keydata[$k]['groupidarr'];
                    $testkinddata[$m]['testtime']=$keydata[$k]['testtime'];
                    $testkinddata[$m]['testkind']=$keydata[$k]['testkind'];
                    $testkinddata[$m]['chapterarr']=$keydata[$k]['chapterarr'];
                    $testkinddata[$m]['filesernum']=$keydata[$k]['filesernum'];
                    $m=$m+1;
            }
        }
        else
        {
            $m=0;
            for($k=0;$k<$count;$k++)
            {
                if($keydata[$k]['testkind']==$testtypekind)
                {
                    $testkinddata[$m]['id']=$keydata[$k]['id'];
                    $testkinddata[$m]['paper_name']=$keydata[$k]['paper_name'];
                    $testkinddata[$m]['testid']=$keydata[$k]['testid'];
                    $testkinddata[$m]['classidarr']=$keydata[$k]['classidarr'];
                    $testkinddata[$m]['groupidarr']=$keydata[$k]['groupidarr'];
                    $testkinddata[$m]['testtime']=$keydata[$k]['testtime'];
                    $testkinddata[$m]['testkind']=$keydata[$k]['testkind'];
                    $testkinddata[$m]['chapterarr']=$keydata[$k]['chapterarr'];
                    $testkinddata[$m]['filesernum']=$keydata[$k]['filesernum'];
                    $m=$m+1;
                }
            }
        }



        $count=sizeof($testkinddata);
        $m=0;



        if($testchapterarr!='')
        {
            for($k=0;$k<$count;$k++)
            {
                if(arraysub($testchapterarr,$testkinddata[$k]['chapterarr'])==1)
                {
                    $chapterdata[$m]['id']=$testkinddata[$k]['id'];
                    $chapterdata[$m]['paper_name']=$testkinddata[$k]['paper_name'];
                    $chapterdata[$m]['testid']=$testkinddata[$k]['testid'];
                    $chapterdata[$m]['classidarr']=$testkinddata[$k]['classidarr'];
                    $chapterdata[$m]['groupidarr']=$testkinddata[$k]['groupidarr'];
                    $chapterdata[$m]['testtime']=$testkinddata[$k]['testtime'];
                    $chapterdata[$m]['testkind']=$testkinddata[$k]['testkind'];
                    $chapterdata[$m]['chapterarr']=$testkinddata[$k]['chapterarr'];
                    $chapterdata[$m]['filesernum']=$testkinddata[$k]['filesernum'];
                    $m=$m+1;
                }
            }
        }



        //进行排重处理
        $chapterdata=uniquetestarray($chapterdata);




        $count=sizeof($chapterdata);
        $modelpublicdata=M('test_public_data');

        $m=0;

        for($i=0;$i<$count;$i++)
        {
                $filesernum=$chapterdata[$i]['filesernum'];
                $sernumarr['filesernum']=$filesernum;
                $sernumarr['ctbname'] = array('in','t-a,a');
                //这里完成图片或者连带标题标示，比如完形填空。
                $testdata=$modelpublicdata->where($sernumarr)->field('id,filesernum,typeid')->select();
                $test_count=sizeof($testdata);
                 for($j=0;$j<$test_count;$j++)
                 {
                     if($typeid==$testdata[$j]['typeid'])
                     {
                         $testmsg[$m]['testname']=$chapterdata[$i]['paper_name'];
                         $testmsg[$m]['testid']=$chapterdata[$i]['testid'];
                         $testmsg[$m]['id']=$testdata[$j]['id'];
                         $testmsg[$m]['filesernum']=$testdata[$j]['filesernum'];
                         $testmsg[$m]['typeid']=$testdata[$j]['typeid'];

                         $m=$m+1;
                     }

                }
        }

        $data=uniquearray($testmsg);

//        print_r($data);


//
//        print_r($data);

        $count=sizeof($data);
        $beginnum=($nowpage-1)*$pagelength;
        $endnum=$beginnum+$pagelength;

        $m=0;

        for($i=0;$i<$count;$i++)
        {
            if($i>=$beginnum && $i<$endnum)
            {
                $outdata[$m]['id']=$data[$i]['id'];
                $outdata[$m]['testid']=$data[$i]['testid'];
                $outdata[$m]['testname']=$data[$i]['testname'];
                $outdata[$m]['filesernum']=$data[$i]['filesernum'];
                $outdata[$m]['typeid']=$data[$i]['typeid'];
                $outdata[$m]['num']=$beginnum;
                $beginnum=$beginnum+1;
                $m=$m+1;


            }
        }

        $outdata['count']=sizeof($outdata);
        $outdata['typeid']=$typeid;
        $outdata['nowpage']=$nowpage;
        $outdata['pagenum']=ceil($count/$pagelength);

       echo json_encode($outdata);

        //print_r($outdata);


    }

//单个习题的错题率统计
    public function test_question_statistic()
    {
        $question_id=1444;
        $classid=65;
        $kind='1';

        $question_model=M('question_statistic');
        $question_arr['question_id']=$question_id;

        $question_data=$question_model->where($question_arr)->select();
        $all_count=sizeof($question_data);

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

        $data['group']=$kind;

        $count=sizeof($classdata);

        $num1=$count-1;
        $num2=$count-2;


        $mydata['num']=$count;


        if($count>=2)
        {


            if($kind=='1')
            {

                $data['one']=round($data[$num1]['g1_w_num']/$data[$num1]['g1_sum']*100,2)."%";
                $data['two']=round($data[$num2]['g1_w_num']/$data[$num2]['g1_sum']*100,2)."%";

                $data['ratio']=($data['one']-$data['two']);

                $num=(int)$data['ratio'];


                if($num>0)
                {
                    $data['ratio']='Down:'.$data['ratio'].'%';
                    $data['kind']='Down';
                }
                if($num<0)
                {
                    $data['ratio']='Up:'.$data['ratio']*(-1).'%';
                    $data['kind']='Up';
                }
                if($num==0)
                {
                    $data['ratio']='0';
                    $data['kind']='0';
                }

            }
            if($kind=='2')
            {
                $data['one']=round($data[$num1]['g2_w_num']/$data[$num1]['g2_sum']*100,2)."%";
                $data['two']=round($data[$num2]['g2_w_num']/$data[$num2]['g2_sum']*100,2)."%";

                $data['ratio']=($data['one']-$data['two']);

                $num=(int)$data['ratio'];


                if($num>0)
                {
                    $data['ratio']='Down:'.$data['ratio'].'%';
                    $data['kind']='Down';
                }
                if($num<0)
                {
                    $data['ratio']='Up:'.$data['ratio']*(-1).'%';
                    $data['kind']='Up';
                }
                if($num==0)
                {
                    $data['ratio']='0';
                    $data['kind']='0';
                }

            }
            if($kind=='3')
            {
                $data['one']=round($data[$num1]['g3_w_num']/$data[$num1]['g3_sum']*100,2)."%";
                $data['two']=round($data[$num2]['g3_w_num']/$data[$num2]['g3_sum']*100,2)."%";

                $data['ratio']=($data['one']-$data['two']);

                $num=(int)$data['ratio'];


                if($num>0)
                {
                    $data['ratio']='Down:'.$data['ratio'].'%';
                    $data['kind']='Down';
                }
                if($num<0)
                {
                    $data['ratio']='Up:'.$data['ratio']*(-1).'%';
                    $data['kind']='Up';
                }
                if($num==0)
                {
                    $data['ratio']='0';
                    $data['kind']='0';
                }
            }
            if($kind=='4')
            {
                $data['one']=round($data[$num1]['other_w_num']/$data[$num1]['other_sum']*100,2)."%";
                $data['two']=round($data[$num2]['other_w_num']/$data[$num2]['other_sum']*100,2)."%";

                $data['ratio']=($data['one']-$data['two']);

                $num=(int)$data['ratio'];


                if($num>0)
                {
                    $data['ratio']='Down:'.$data['ratio'].'%';
                }
                if($num<0)
                {
                    $data['ratio']='Up:'.$data['ratio']*(-1).'%';
                }
                if($num==0)
                {
                    $data['ratio']='0';
                }
            }
            if($kind=='5')
            {
                $data['one']=round($data[$num1]['all_w_num']/$data[$num1]['all_sum']*100,2)."%";
                $data['two']=round($data[$num2]['all_w_num']/$data[$num2]['all_sum']*100,2)."%";

                $data['ratio']=($data['one']-$data['two']);

                $num=(int)$data['ratio'];


                if($num>0)
                {
                    $data['ratio']='Down:'.$data['ratio'].'%';
                }
                if($num<0)
                {
                    $data['ratio']='Up:'.$data['ratio']*(-1).'%';
                }
                if($num==0)
                {
                    $data['ratio']='0';
                }
            }

        }
        //计算到这里
        if($count==1)
        {
            $num=$count-1;
            if($kind=='g1') {
                $data['one'] = round($data[$num1]['g1_w_num'] / $data[$num]['g1_sum'] * 100, 2) . "%";
                $data['two'] = "-%";
                $data['ratio']='-%';
            }
            if($kind=='g2') {
                $data['one'] = round($data[$num1]['g2_w_num'] / $data[$num]['g2_sum'] * 100, 2) . "%";
                $data['two'] = "-%";
                $data['ratio']='-%';
            }
            if($kind=='g3') {
                $data['one'] = round($data[$num1]['g3_w_num'] / $data[$num]['g3_sum'] * 100, 2) . "%";
                $data['two'] = "-%";
                $data['ratio']='-%';
            }
            if($kind=='other') {
                $data['one'] = round($data[$num1]['other_w_num'] / $data[$num]['other_sum'] * 100, 2) . "%";
                $data['two'] = "-%";
                $data['ratio']='-%';
            }
            if($kind=='all') {
                $data['one'] = round($data[$num1]['all_w_num'] / $data[$num]['all_sum'] * 100, 2) . "%";
                $data['two'] = "-%";
                $data['ratio']='-%';
            }
        }

        if($count==0)
        {
            $staticdata['one'] = "-%";
            $data['two'] = "-%";
            $data['ratio']='-%';

        }

       print_r($data);


    }

    public function phpbindtestsub(){
        $id=$_POST['id'];
        $subjectid=$_POST['subjectid'];
        $typeid=$_POST['typeid'];

        $modelpapermsg=M('paper_msg_data');
        $modelpublicdata=M('test_public_data');


//        $id=135;
//        $subjectid=2;
//        $typeid=20;


        $paperarr['userid']=$id;
        $paperarr['subjectid']=$subjectid;


        $paperdata=$modelpapermsg->where($paperarr)->select();
        $paper_count=sizeof($paperdata);

        $m=0;

        for($i=0;$i<$paper_count;$i++)
        {
            $filearr['filesernum']=$paperdata[$i]['filesernum'];
            $filearr['ctbname'] = array('in','t-a,a');

            $testdata=$modelpublicdata->where($filearr)->field('id,filesernum,typeid,pic1,pic2,pic3,pic4')->select();
            $test_count=sizeof($testdata);
            for($j=0;$j<$test_count;$j++)
            {
                $testmsg[$m]['testname']=$paperdata[$i]['paper_name'];
                $testmsg[$m]['testid']=$paperdata[$i]['id'];
                $testmsg[$m]['id']=$testdata[$j]['id'];
                $testmsg[$m]['filesernum']=$testdata[$j]['filesernum'];
                $testmsg[$m]['typeid']=$testdata[$j]['typeid'];

                $m=$m+1;
            }
        }

        $data=uniquearray($testmsg);
        $data['count']=sizeof($data);
        $data['typeid']=$typeid;

//        print_r($data);

        echo json_encode($data);
    }
//绑定习题具体信息,没有用
//    public function phpbindtestdetail1()
//    {
//        $testid=$_POST['testid'];
//        $typeid=$_POST['typeid'];
//
//        $groupid=$_POST['groupid'];
//        $classid=$_POST['classid'];
//
//        $model_paper=M('paper_msg_data');
//        $model_public=M('test_public_data');
//        $model_img=M('img_cuted_data');
//
//        $paper_data=$model_paper->where('id='.$testid)->find();
//        $filesernum=$paper_data['filesernum'];
//        $arr['filesernum']=$filesernum;
//        $arr['typeid']=$typeid;
//        $arr['ctbname']=array('in','t-a,a');
//        $public_data=$model_public->where($arr)->order('in_ser asc')->select();
//        $count=sizeof($public_data);
//
//        for($i=0;$i<$count;$i++)
//        {
//            $srcid=$public_data[$i]['srcid'];
//            $src_data=$model_img->where('id='.$srcid)->find();
//            $src=$src_data['src'];
//            $newdata[$i]['srcid']=$srcid;
//            $newdata[$i]['src']=appusersrc($src);
//
//            $test_data=test_question_statistic($srcid,$classid,$groupid);
//
//            $newdata[$i]['group']=$test_data['group'];
//            $newdata[$i]['one']=$test_data['one'];
//            $newdata[$i]['two']=$test_data['two'];
//            $newdata[$i]['ratio']=$test_data['ratio'];
//            $newdata[$i]['kind']=$test_data['kind'];
//
//        }
//
//        $newdata['count']=sizeof($newdata);
//        $newdata['typeid']=$typeid;
//
//        echo json_encode($newdata);
//
//
//    }
//插入习题统计信息
    public function teststatic()
    {
        $testid=149;
        $groupidarr='g1-g2-g3';
        $classidarr='123-234-244';
        $testtime='2018-09-18';
        $testkind=2;
        $userid=135;
        $papername='测试试卷新';
        $subjectid=2;


        $filesernum='a1001201885224431';
        $keynote_msg='23,34,23';
        $schoolid=123;
        $gradeid=234;


        $model_test=M('test_statistic');
        $all_arr['userid']=$userid;
        $all_arr['subjectid']=$subjectid;
        $all_data=$model_test->where($all_arr)->field('id,testid,classidarr,groupidarr,testtime,testkind,chapterarr,paper_name,filesernum')->select();

        $all_count=sizeof($all_data);



        $m=0;
        for($i=0;$i<$all_count;$i++)
        {

            $classidarr=explode(',',$all_data[$i]['classidarr']);
            $groupidarr=explode(',',$all_data[$i]['groupidarr']);
            $testtime=explode(',',$all_data[$i]['testtime']);
            $testkind=explode(',',$all_data[$i]['testkind']);
            $chapterarr=explode(',',$all_data[$i]['chapterarr']);

            $class_count=sizeof($classidarr);

            for($n=0;$n<$class_count;$n++) {

                $inewdata[$m]['id'] = $all_data[$i]['id'];
                $inewdata[$m]['testid'] = $all_data[$i]['testid'];
                $inewdata[$m]['paper_name'] = $all_data[$i]['paper_name'];
                $inewdata[$m]['filesernum'] = $all_data[$i]['filesernum'];

                $inewdata[$m]['testtime'] = $testtime[$n];
                $inewdata[$m]['testkind'] = $testkind[$n];
                $inewdata[$m]['chapterarr'] = $chapterarr[$n];
                $inewdata[$m]['classidarr'] = '-' . $classidarr[$n] . '-';
                $inewdata[$m]['groupidarr'] = '-' . $groupidarr[$n] . '-';
                $m = $m + 1;
            }
        }


        $addgroupid=explode('-',$groupidarr);
        $addgroupid_count=sizeof($addgroupid);

        $m=0;
            for($d=0;$d<$addgroupid_count;$d++)
            {
                $adddata[$m]['testid']=$testid;
                $adddata[$m]['classid']=$classidarr;
                $adddata[$m]['groupid']=$addgroupid[$d];
                $adddata[$m]['testtime']=$testtime;
                $m=$m+1;
                opertestsub($testid,$testtime,$classidarr,$addgroupid[$d],$papername,$testkind,$subjectid,$userid,$filesernum,$keynote_msg,$schoolid,$gradeid,$inewdata);
            }


    }
//插入习题统计信息，正式使用的时候进行完善
    public function test()
    {
        $question_id='1443,1444,110';
        $testidarr=150;
        $classidarr=12;
        $userid=136;

        $stuid=136;
        $testid=151;


        $testid=1520;
        $testtime='2018-09-20';
        $myclassid=65;

        $question_id=1443;
        $testkind='';

        $operkind=1;

        $question_model=M('question_statistic_new');

        $question_arr=explode(',',$question_id);
        $myquestion_count=sizeof($question_arr);

        //需要根据习题进行循环
//        for($i=0;$i<$myquestion_count;$i++)
//        {
//
//        }



        $myarr['question_id']=$question_id;
        $question_data=$question_model->where($myarr)->select();
        $count=sizeof($question_data);

        print_r($question_data);

        if($count==0)
        {
            $testkind='add';
        }
        else
        {
            $testkind='update';
        }

        if($testkind=='update')
        {

            $testidarr=explode(',',$question_data[0]['testidarr']);
            $classidarr=explode(',',$question_data[0]['classidarr']);

            $g1_w_num_arr=explode(',',$question_data[0]['g1_w_num_arr']);
            $g2_w_num_arr=explode(',',$question_data[0]['g2_w_num_arr']);
            $g3_w_num_arr=explode(',',$question_data[0]['g3_w_num_arr']);
            $other_w_num_arr=explode(',',$question_data[0]['other_w_num_arr']);

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
            }
            else
            {
                if($questiontimenotekind==1)
                {
                    $updatequestionkind='addtimenote';
                }
                else
                {
                    if($questionclassnotekind==1)
                    {
                        $updatequestionkind='addclassnote';
                    }
                    else
                    {
                        if($questiontimeclassnotekind==1)
                        {
                            $updatequestionkind='addtimeclassnote';
                        }
                        else
                        {
                            $updatequestionkind='addtest';
                        }

                    }
                }
            }
        }

        $model_user=M('user_data');
        $model_user_add=M('user_studentparent_addation_data');
        $model_group=M('group_data');
        $model_class=M('class_data');
        $model_paper=M('paper_msg_data');

        $user_data=$model_user->where('id='.$stuid)->find();
        $user_add_data=$model_user_add->where('userid='.$stuid)->find();

        $groupid=$user_add_data['groupid'];
        $groupdata=$model_group->where('id='.$groupid)->find();
        $groupmsg=$groupdata['groupname'];

        $myclassid=$user_add_data['classid'];
        $class_data=$model_class->where('id='.$myclassid)->find();

        $g1sum=$class_data['g1_sum'];
        $g2sum=$class_data['g2_sum'];
        $g3sum=$class_data['g3_sum'];
        $othersum=$class_data['other_sum'];
        $allsum=$class_data['classnum'];
        $schoolid=$class_data['school_id'];


        $paper_data=$model_paper->where('id='.$testid)->find();
        $testtime=$paper_data['publish_time'];
        $userid=$paper_data['userid'];

        $userid=123;
        $testtime='2018-09-12';


       // print_r($paper_data);




        if($testkind=='add')
        {

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


            if($updatequestionkind=='updategroup')
            {
                for($m=0;$m<$testclass_count;$m++)
                {

                    if( $testclassdata[$m]['testid']==$testid &&  $testclassdata[$m]['classid']==$myclassid && $testclassdata[$m]['testtime']==$testtime)
                    {

                        if($operkind==1)
                        {
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
                            $testclassdata[$m]['all_w_num_arr']=$testclassdata[$m]['all_w_num_arr']+1;
                        }
                        else
                        {
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

                            $testclassdata[$m]['all_w_num_arr']=$testclassdata[$m]['all_w_num_arr']-1;
                        }
                    }
                }

            }


            print_r($testclassdata);

            if($updatequestionkind=='addtimeclassnote' || $updatequestionkind=='addclassnote' || $updatequestionkind=='addtimenote')
            {
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
               // echo 234;

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

//                $count=sizeof($onlyquestionarr);
//
//                $onlyquestionarr[$count]['question_id']=$question_id;

                $count=sizeof($questiontestarr);

                $questiontestarr[$count]['question_id']=$question_id;
                $questiontestarr[$count]['testid']=$testid;


            }

            }

            $questiontest_size=sizeof($questiontestarr);
            $all_count=sizeof($testclassdata);

        echo $questiontest_size;

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

                        $questiontestarr[$m]['g1_sum']=$questiontestarr[$m]['g1_sum'].'-'.$testclassdata[$n]['g1_sum'];
                        $questiontestarr[$m]['g2_sum']=$questiontestarr[$m]['g2_sum'].'-'.$testclassdata[$n]['g2_sum'];
                        $questiontestarr[$m]['g3_sum']=$questiontestarr[$m]['g3_sum'].'-'.$testclassdata[$n]['g3_sum'];
                        $questiontestarr[$m]['all_sum']=$questiontestarr[$m]['all_sum'].'-'.$testclassdata[$n]['all_sum'];

                        $questiontestarr[$m]['testtime']=$questiontestarr[$m]['testtime'].'+'.$testclassdata[$n]['testtime'];




                    }

                }


                $questiontestarr[$m]['classid']=substr($questiontestarr[$m]['classid'],1);
                $questiontestarr[$m]['g1_w_num']=substr($questiontestarr[$m]['g1_w_num'],1);
                $questiontestarr[$m]['g2_w_num']=substr($questiontestarr[$m]['g2_w_num'],1);
                $questiontestarr[$m]['g3_w_num']=substr($questiontestarr[$m]['g3_w_num'],1);
                $questiontestarr[$m]['other_w_num']=substr($questiontestarr[$m]['other_w_num'],1);

                $questiontestarr[$m]['g1_sum']=substr($questiontestarr[$m]['g1_sum'],1);
                $questiontestarr[$m]['g2_sum']=substr($questiontestarr[$m]['g2_sum'],1);
                $questiontestarr[$m]['g3_sum']=substr($questiontestarr[$m]['g3_sum'],1);
                $questiontestarr[$m]['all_sum']=substr($questiontestarr[$m]['all_sum'],1);

                $questiontestarr[$m]['testtime']=substr($questiontestarr[$m]['testtime'],1);

            }

            print_r($questiontestarr);

            $count=sizeof($questiontestarr);

            for($n=0;$n<$count;$n++)
            {
                $questiontestarr['question_id']=$questiontestarr[$n]['question_id'];
                $questiontestarr['testid']=$questiontestarr['testid'].','.$questiontestarr[$n]['testid'];

                $questiontestarr['schoolidarr']=$questiontestarr['schoolidarr'].','.$questiontestarr[$n]['schoolidarr'];
                $questiontestarr['useridarr']=$testclassdata['useridarr'].','.$questiontestarr[$n]['useridarr'];
                $questiontestarr['classid']=$questiontestarr['classid'].','.$questiontestarr[$n]['classid'];
                $questiontestarr['g1_w_num']=$questiontestarr['g1_w_num'].','.$questiontestarr[$n]['g1_w_num'];
                $questiontestarr['g2_w_num']=$questiontestarr['g2_w_num'].','.$questiontestarr[$n]['g2_w_num'];
                $questiontestarr['g3_w_num']=$questiontestarr['g3_w_num'].','.$questiontestarr[$n]['g3_w_num'];
                $questiontestarr['other_w_num']=$questiontestarr['other_w_num'].','.$questiontestarr[$n]['other_w_num'];

                $questiontestarr['g1_sum']=$questiontestarr['g1_sum'].','.$questiontestarr[$n]['g1_sum'];
                $questiontestarr['g2_sum']=$questiontestarr['g2_sum'].','.$questiontestarr[$n]['g2_sum'];
                $questiontestarr['g3_sum']=$questiontestarr['g3_sum'].','.$questiontestarr[$n]['g3_sum'];
                $questiontestarr['all_sum']=$questiontestarr['all_sum'].','.$questiontestarr[$n]['all_sum'];

                $questiontestarr['testtime']=$questiontestarr['testtime'].','.$questiontestarr[$n]['testtime'];
            }


//
        $questiontestarr['testid']=substr($questiontestarr['testid'],1);

        $questiontestarr['schoolidarr']=substr($questiontestarr['schoolidarr'],1);
        $questiontestarr['useridarr']=substr($questiontestarr['useridarr'],1);

        $questiontestarr['classid']=substr($questiontestarr['classid'],1);
        $questiontestarr['g1_w_num']=substr($questiontestarr['g1_w_num'],1);
        $questiontestarr['g2_w_num']=substr($questiontestarr['g2_w_num'],1);
        $questiontestarr['g3_w_num']=substr($questiontestarr['g3_w_num'],1);
        $questiontestarr['other_w_num']=substr($questiontestarr['other_w_num'],1);

        $questiontestarr['g1_sum']=substr($questiontestarr['g1_sum'],1);
        $questiontestarr['g2_sum']=substr($questiontestarr['g2_sum'],1);
        $questiontestarr['g3_sum']=substr($questiontestarr['g3_sum'],1);
        $questiontestarr['all_sum']=substr($questiontestarr['all_sum'],1);

        $questiontestarr['testtime']=substr($questiontestarr['testtime'],1);

        //差更新数据库，加上就行。单个循环，要等到正式对接的时候在添加

    }


    public function test1()
    {
        $classid='-12-13-14';

       echo substr($classid,1);
    }


    //绑定习题具体信息
    public function phpbindtestdetail()
    {
        $testid=$_POST['testid'];
        $typeid=$_POST['typeid'];

        $groupid=$_POST['groupid'];
        $classid=$_POST['classid'];

        $no1ration=$_POST['no1ration'];
        $no2ration=$_POST['no2ration'];

        $no1testtime=$_POST['no1testtime'];
        $no2testtime=$_POST['no2testtime'];

        $questionorder=$_POST['questionorder'];

//        $testid=1523;
//        $typeid=20;
//        $classid=65;
//        $groupid=1;
//        $questionorder=2;
//        $no1testtime='';
//        $no2testtime='';

        $model_paper=M('paper_msg_data');
        $model_public=M('test_public_data');
        $model_img=M('img_cuted_data');

        $paper_data=$model_paper->where('id='.$testid)->find();
        $filesernum=$paper_data['filesernum'];
        $arr['filesernum']=$filesernum;
        $arr['typeid']=$typeid;
        $arr['ctbname']=array('in','t-a,a');
        $public_data=$model_public->where($arr)->order('in_ser asc')->select();
        $count=sizeof($public_data);

        for($i=0;$i<$count;$i++)
        {
            $srcid=$public_data[$i]['srcid'];
            $pic1=$public_data[$i]['pic1'];
            $pic2=$public_data[$i]['pic2'];
            $pic3=$public_data[$i]['pic3'];
            $pic4=$public_data[$i]['pic4'];
            $tsernum=$public_data[$i]['tsernum'];


            if($tsernum>0)
            {
                $tsernumarr['tsernum']=$tsernum;
                $tsernumarr['ctbname']='t1';
                $tsernum_data=$model_public->where($tsernumarr)->find();
                $t1_img_id=$tsernum_data['srcid'];
                $t1_data=$model_img->where('id='.$t1_img_id)->find();
                $t1_src=$t1_data['src'];

                $newdata[$i]['t1_id']=$t1_img_id;
                $newdata[$i]['t1_width']=getimagesize($t1_data['src'])[0];
                $newdata[$i]['t1_height']=getimagesize($t1_data['src'])[1];
                $newdata[$i]['t1_src']=appusersrc($t1_data['src']);
                $newdata[$i]['t1_sernum']=$tsernum;
            }
            else
            {
                $newdata[$i]['t1_width']=0;
                $newdata[$i]['t1_height']=0;
                $newdata[$i]['t1_src']=0;
                $newdata[$i]['t1_sernum']=0;
                $newdata[$i]['t1_id']=0;
            }


            $src_data=$model_img->where('id='.$srcid)->find();
            $src=$src_data['src'];


            $pic_src_data=$model_img->where('id='.$pic1)->find();
            $newdata[$i]['pic1_width']=getimagesize($pic_src_data['src'])[0];
            $newdata[$i]['pic1_height']=getimagesize($pic_src_data['src'])[1];
            $newdata[$i]['pic1_src']=appusersrc($pic_src_data['src']);
            $newdata[$i]['pic1_id']=$pic1;

            if($newdata[$i]['pic1_width']=='')
            {
                $newdata[$i]['pic1_width']='0';
            }

            if($newdata[$i]['pic1_height']=='')
            {
                $newdata[$i]['pic1_height']='0';
            }

            if($newdata[$i]['pic1_src']=='')
            {
                $newdata[$i]['pic1_src']='0';
            }

            $pic_src_data=$model_img->where('id='.$pic2)->find();
            $newdata[$i]['pic2_width']=getimagesize($pic_src_data['src'])[0];
            $newdata[$i]['pic2_height']=getimagesize($pic_src_data['src'])[1];
            $newdata[$i]['pic2_src']=appusersrc($pic_src_data['src']);
            $newdata[$i]['pic2_id']=$pic2;

            if($newdata[$i]['pic2_width']=='')
            {
                $newdata[$i]['pic2_width']='0';
            }

            if($newdata[$i]['pic2_height']=='')
            {
                $newdata[$i]['pic2_height']='0';
            }

            if($newdata[$i]['pic2_src']=='')
            {
                $newdata[$i]['pic2_src']='0';
            }


            $pic_src_data=$model_img->where('id='.$pic3)->find();
            $newdata[$i]['pic3_width']=getimagesize($pic_src_data['src'])[0];
            $newdata[$i]['pic3_height']=getimagesize($pic_src_data['src'])[1];
            $newdata[$i]['pic3_src']=appusersrc($pic_src_data['src']);
            $newdata[$i]['pic3_id']=$pic3;

            if($newdata[$i]['pic3_width']=='')
            {
                $newdata[$i]['pic3_width']='0';
            }

            if($newdata[$i]['pic3_height']=='')
            {
                $newdata[$i]['pic3_height']='0';
            }

            if($newdata[$i]['pic3_src']=='')
            {
                $newdata[$i]['pic3_src']='0';
            }



            $pic_src_data=$model_img->where('id='.$pic4)->find();
            $newdata[$i]['pic4_width']=getimagesize($pic_src_data['src'])[0];
            $newdata[$i]['pic4_height']=getimagesize($pic_src_data['src'])[1];
            $newdata[$i]['pic4_src']=appusersrc($pic_src_data['src']);
            $newdata[$i]['pic4_id']=$pic4;


            if($newdata[$i]['pic4_width']=='')
            {
                $newdata[$i]['pic4_width']='0';
            }

            if($newdata[$i]['pic4_height']=='')
            {
                $newdata[$i]['pic4_height']='0';
            }

            if($newdata[$i]['pic4_src']=='')
            {
                $newdata[$i]['pic4_src']='0';
            }

            if($pic1=='')
            {
                $pic1='0';
                $newdata[$i]['pic1_id']='0';
            }
            if($pic2=='')
            {
                $pic2='0';
                $newdata[$i]['pic2_id']='0';
            }
            if($pic3=='')
            {
                $pic3='0';
                $newdata[$i]['pic3_id']='0';
            }
            if($pic4=='')
            {
                $pic4='0';
                $newdata[$i]['pic4_id']='0';
            }

            $newdata[$i]['pic1']=$pic1;
            $newdata[$i]['pic2']=$pic2;
            $newdata[$i]['pic3']=$pic3;
            $newdata[$i]['pic4']=$pic4;

            $pnum=0;


            if($pic1>0)
            {
                $pnum=$pnum+1;
            }

            if($pic2>0)
            {
                $pnum=$pnum+1;
            }

            if($pic3>0)
            {
                $pnum=$pnum+1;
            }

            if($pic4>0)
            {
                $pnum=$pnum+1;
            }



            $newdata[$i]['srcid']=$srcid;
            $newdata[$i]['src']=appusersrc($src);
            $newdata[$i]['answerid']=$src_data['answerid'];
            $newdata[$i]['picsum']=$pnum;

            $answer_data=$model_img->where('id='.$src_data['answerid'])->find();
            $newdata[$i]['answersrc']=usersrc($answer_data['src']);
            $newdata[$i]['width']=getimagesize($answer_data['src'])[0];
            $newdata[$i]['height']=getimagesize($answer_data['src'])[1];

            if($newdata[$i]['answersrc']=='')
            {
                $newdata[$i]['answersrc']='0';
                $newdata[$i]['width']='0';
                $newdata[$i]['height']='0';
            }

            $test_data=test_question_statistic($srcid,$classid,$groupid);
            $newdata[$i]['group']=$test_data['group'];
            $newdata[$i]['one']=$test_data['one'];
            $newdata[$i]['two']=$test_data['two'];
            $newdata[$i]['ratio']=$test_data['ratio'];
            $newdata[$i]['kind']=$test_data['kind'];
            $newdata[$i]['sum']=$test_data['sum'];
            $newdata[$i]['classid']=$test_data['classid'];
            $newdata[$i]['ctone']=str_replace("%","",$test_data['one']);
        }


        $newdata = seekarr($newdata,'ctone',$no1ration,$no2ration);
        $newdata = seekarr($newdata,'sum',$no1testtime,$no2testtime);


        if($questionorder==1)
        {
            $newdata=array_sort($newdata,'ctone',1);
        }
        if($questionorder==2)
        {
            $newdata=array_sort($newdata,'ctone',0);
        }
        if($questionorder==3)
        {
            $newdata=array_sort($newdata,'sum',1);
        }
        if($questionorder==4)
        {
            $newdata=array_sort($newdata,'sum',0);
        }

        $newdata=array_values($newdata);
        $newdata['count']=sizeof($newdata);
        $newdata['typeid']=$typeid;
        $newdata['testid']=$testid;

        echo  json_encode($newdata);

    }

    public function phpchooseimgsub()
    {
        $src=$_POST['src'];
        $ratio=$_POST['ratio'];
        $typeid=$_POST['typeid'];
        $premsg=$_POST['premsg'];
        $picmsg=explode(',',$_POST['picmsg']);
        $tsermsg=explode(',',$_POST['tsermsg']);


        $newdata['t1_sernum']=$tsermsg[0];

        $newdata['t1_src']=$tsermsg[1];
        $newdata['t1_width']=round($tsermsg[2]*$ratio);
        $newdata['t1_height']=round($tsermsg[3]*$ratio);



        $newdata['picsum']=$picmsg[0];

        $newdata['pic1_src']=$picmsg[1];
        $newdata['pic1_width']=round($picmsg[2]*$ratio);
        $newdata['pic1_height']=round($picmsg[3]*$ratio);

        $newdata['pic2_src']=$picmsg[4];
        $newdata['pic2_width']=round($picmsg[5]*$ratio);
        $newdata['pic2_height']=round($picmsg[6]*$ratio);

        $newdata['pic3_src']=$picmsg[7];
        $newdata['pic3_width']=round($picmsg[8]*$ratio);
        $newdata['pic3_height']=round($picmsg[9]*$ratio);

        $newdata['pic4_src']=$picmsg[10];
        $newdata['pic4_width']=round($picmsg[11]*$ratio);
        $newdata['pic4_height']=round($picmsg[12]*$ratio);


        $newsrc='.'.$src;
        $arr = getimagesize($newsrc);
        $newdata['width']=round($arr[0]*$ratio);
        $newdata['height']=round($arr[1]*$ratio);
        $newdata['typeid']=$typeid;
        $newdata['premsg']=$premsg;



        $newdata['src']=$src;
        echo json_encode($newdata);

    }

    public function testsavesub()
    {
        $title=$_POST[title];
        $testdate=$_POST[testdate];
        $testtime=$_POST[testtime];
        $subjectid=$_POST[subjectid];
        $testkindid=$_POST[testkindid];
        $filesernum=$_POST[filesernum];
        $userid=$_POST[userid];

        $testgrade_arr=$_POST[testgrade_arr];
        $testchapter_arr=$_POST[testchapter_arr];
        $testkeynote_arr=$_POST[testkeynote_arr];

        $testlevel=$_POST[testlevel];
        $myclassobject_arr=$_POST[myclassobject_arr];
        $groupobject_arr=$_POST[groupobject_arr];
        $other_note=$_POST[other_note];
        $testnote=$_POST[testnote];
        $questionsum=$_POST[questionsum];
        $score_kind=$_POST[score_kind];





        $model_paper_msg_data=M('paper_msg_data');
        //插入试卷信息
        $model_test_send_class=M('test_send_class');
        //插入发布班级
        $model_test_public_data=M('test_public_data');
        //插入试卷排版信息

        $paper_msg_arr['kind']=$testkindid;
        $paper_msg_arr['publish_time']=$testdate;
        $paper_msg_arr['testtime']=$testtime;

        $paper_msg_arr['paper_name']=$title;
        $paper_msg_arr['keynote_id']=$testkeynote_arr;


        $paper_msg_arr['statusmsg']=2;
        $paper_msg_arr['creat_time']=date('y-m-d h:i:s',time());
        $paper_msg_arr['filesernum']=$filesernum;

        $paper_msg_arr['userid']=$userid;
        $paper_msg_arr['operatorid']=$userid;
        $paper_msg_arr['nolevel']=3;

        $paper_msg_arr['no1']='';
        $paper_msg_arr['no2']='';
        $paper_msg_arr['no3']='t12';
        $paper_msg_arr['no4']='t14';
        $paper_msg_arr['no5']='t16';

        $paper_msg_arr['submittime']=date('y-m-d h:i:s',time());
        $paper_msg_arr['subjectid']=$subjectid;
        $paper_msg_arr['gradeid']=$testgrade_arr;
//        $paper_msg_arr['settime']='';
        $paper_msg_arr['chapterid']=$testchapter_arr;
        $paper_msg_arr['shareornot']=1;
        $paper_msg_arr['editornot']=0;
        $paper_msg_arr['othernote']=$other_note;
        $paper_msg_arr['testnote']=$testnote;
        $paper_msg_arr['questionsum']=$questionsum;
        $paper_msg_arr['score_kind']=$score_kind;





        $testid=$model_paper_msg_data->add($paper_msg_arr);

        $test_send_class_arr['testid']=$testid;
        $test_send_class_arr['classid_arr']=$myclassobject_arr;
        $test_send_class_arr['groupid_arr']=$groupobject_arr;
        $test_send_class_arr['kind']=1;
        echo $model_test_send_class->add($test_send_class_arr);


    }

    public function questionsavesub()
    {
        $testdetailmsg=$_POST[testdetailmsg];
        //$testdetailmsg="0,1,0,0,0,0,0,t0,test,0,title,一、选择题,123,left,none,1,,20,1,0#1443,2,0,0,0,0,0,t-a,test,0,titleanswer,1.10',123,left,block,1,,20,1,10#1444,3,0,0,0,0,0,t-a,test,0,titleanswer,2.10',123,left,block,1,,20,1,10#1657,4,0,0,0,0,1536988710414,t1,test,0,title,3. 10×2=20',123,left,block,1,,20,1,20#1657,5,0,0,0,0,1536988710414,a,test,0,answer,(1),123,left,block,1,,20,1,10#1657,6,0,0,0,0,1536988710414,a,test,0,answer,(2),123,left,block,1,,20,1,10#0,7,0,0,0,0,0,t0,test,0,title,二、填空题,123,left,none,1,,21,1,0#1576,8,1590,1591,1592,1593,0,t-a,test,4,titleanswer,1.5',123,left,block,1,,21,1,5#1577,9,1591,0,0,0,0,t-a,test,1,titleanswer,2.5',123,left,block,1,,21,1,5#1626,10,0,0,0,0,1536988333236,t1,test,0,title,3. 5×3=15',123,left,block,1,,21,1,15#1626,11,0,0,0,0,1536988333236,a,test,0,answer,(1),123,left,block,1,,21,1,5#1626,12,0,0,0,0,1536988333236,a,test,0,answer,(2),123,left,block,1,,21,1,5#1626,13,0,0,0,0,1536988333236,a,test,0,answer,(3),123,left,block,1,,21,1,5";
        $testarr=explode('#',$testdetailmsg);
        $length=sizeof($testarr);

        $model=M('test_public_data');

        for($i=0;$i<$length;$i++)
        {
            $questionarr=explode(',',$testarr[$i]);
            $thislength=sizeof($questionarr);
            $newdata['srcid']=$questionarr[0];
            $newdata['in_ser']=$questionarr[1];
            $newdata['pic1']=$questionarr[2];
            $newdata['pic2']=$questionarr[3];
            $newdata['pic3']=$questionarr[4];
            $newdata['pic4']=$questionarr[5];
            $newdata['tsernum']=$questionarr[6];
            $newdata['ctbname']=$questionarr[7];
            $newdata['kind']=$questionarr[8];
            $newdata['picsum']=$questionarr[9];
            $newdata['inputname']=$questionarr[10];
            $newdata['inputval']=$questionarr[11];
            $newdata['filesernum']=$questionarr[12];
            $newdata['align']=$questionarr[13];
            $newdata['imgdisplay']=$questionarr[14];
            $newdata['pagenum']=$questionarr[15];
            $newdata['typeid']=$questionarr[17];
            $newdata['questionnum']=$questionarr[18];
            $newdata['questionscore']=$questionarr[19];
            $model->add($newdata);
        }
        echo 1;
    }

    public function buildlist02(){
        $userid=$_GET['userid'];
        $this->assign('userid',$userid);
        $this->display();
    }

    public function phptestlist()
    {
        $userid=$_POST['userid'];
        $nowpage=$_POST['nowpage'];
        $pagelength=$_POST['pagelength'];

        $beginnum=($nowpage-1)*$pagelength+1;
        $beginpagenum=$beginnum-1;

        $model=M('paper_msg_data');
        $count=$model->where('userid='.$userid)->count();
        $data = $model->where('userid='.$userid)->limit($beginpagenum.','.$pagelength)->select();

        for($i=0;$i<sizeof($data);$i++)
        {
            $data[$i]['num']=$beginnum;
            $beginnum=$beginnum+1;
        }
        $data['length']=sizeof($data);
        $data['pagelength']=$pagelength;
        $data['count']=$count;
        $data['pagenum']=ceil($count/$pagelength);
        echo json_encode($data);
    }

    public  function pretestpdf01()
    {
        $filesernum=$_GET['filesernum'];
        $paper_name=$_GET['paper_name'];
        $testnote=$_GET['testnote'];
        $operkind=$_GET['operkind'];
        $testid=$_GET['testid'];
        $kind=$_GET['kind'];

//        echo $filesernum.'#'.$paper_name.'#'.$testnote.'#'.$operkind.'#'.$testid;
//
//
//        return;
//
//        $filesernum='a1001201885224431';
//        $paper_name='图形的相似';
//        $testnote='';
//        $operkind='I';
//        $testid=149;
//        $kind=1;




        if($kind==1)
        {
            $score_kind=1;
        }
        else
        {
            $model_test=M('paper_msg_data');
            $data=$model_test->where('id='.$testid)->find();
            $score_kind=$data['score_kind'];
        }

    //  echo $kind.','.$score_kind.','.$operkind.','.$filesernum.','.$paper_name.','.$testnote;

        testpdf($kind,$score_kind,$operkind,$filesernum,$paper_name,$testnote);

        //print_r($data);


    }

    public  function preanswerpdf01(){
        $filesernum=$_GET['filesernum'];
        $paper_name=$_GET['paper_name'];
        $testnote=$_GET['testnote'];
        $operkind=$_GET['operkind'];
        $testid=$_GET['testid'];

        preanswerpdf01($paper_name,$filesernum,$operkind);


    }


}