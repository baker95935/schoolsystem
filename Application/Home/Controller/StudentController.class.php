<?php
/**
 * Created by PhpStorm.
 * User: fangzheng
 * Date: 2018/1/29
 * Time: 下午7:22
 */
namespace Home\Controller;
use Think\Controller;
require 'Public/tcpdf/tcpdf.php';

class StudentController extends Controller{

    public function index()
    {
        echo "hello student!!";
    }
    public function home()
    {
        $realname=$_GET['realname'];
        $username=$_GET['username'];
        $userid=$_GET['userid'];

        $this->assign('realname',$realname);
        $this->assign('username',$username);
        $this->assign('userid',$userid);
      
      	$this->assign('datemsg', date("Y-m-d") );
      
      
        $model=M('mytest');
        $dataarr['userid']=$userid;
        $dataarr['kind']=0;
        $count=$model->where($dataarr)->count();
        $this->assign('count',$count);
      
        $this->display();
    }

    public function task0101()
    {
        $userid=$_GET['userid'];
        $username=$_GET['username'];
        $realname=$_GET['realname'];
        $kind=$_GET['kind'];
        
        $subjectList=subjectdata();
        
        $this->assign('userid',$userid);
        $this->assign('username',$username);
        $this->assign('realname',$realname);
        $this->assign('kind',$kind);
        $this->assign('subjectList',$subjectList);
        $this->display();
    }
    public function task0102()
    {
        $userid=$_GET['userid'];
        $this->assign('userid',$userid);
        $this->display();
    }


    public function phptask0101()
    {
        $userid=$_POST['userid'];
        $nowpage=$_POST['nowpage'];
        $pagelength=$_POST['pagelength'];
        $kind=$_POST['kind'];
        $newsubjectid=$_POST['subjectid'];
 
        if($kind==0)
        {
            $beginnum=($nowpage-1)*$pagelength+1;
            $beginpagenum=$beginnum-1;
            $model=M('mytest');
            $model1=M('paper_msg_data');
            $model2=M('grade_data');
            $model3=M('subject_data');
            $model4=M('test_public_data');
            $dataarr['userid']=$userid;
            $dataarr['kind']=$kind;

            $count=$model->where($dataarr)->count();
   
            $data=$model->where($dataarr)->order('creatime desc')->limit($beginpagenum.','.$pagelength)->select();
            for($i=0;$i<sizeof($data);$i++)
            {
                $testdata=$model1->where('id='.$data[$i]['testid'])->find();
                $subjectid=$testdata['subjectid'];
                if(!empty($newsubjectid) && $newsubjectid!=$subjectid) { //如果学科不一致 对应的数组变量注销
                	unset($data[$i]);
                	$count=$count-1;
                	continue;
                }
                $gradeid=$testdata['gradeid'];
                $gradedata=$model2->where('id='.$gradeid)->find();
                $subjectdata=$model3->where('id='.$subjectid)->find();
                $data[$i]['grade']=$gradedata['grademsg'];
                $data[$i]['subject']=$subjectdata['subjectmsg'];
                $data[$i]['paper_name']=$testdata['paper_name'];
                $data[$i]['id']=$data[$i]['testid'];
                $data[$i]['userid']=$userid;
                $data[$i]['sum']=$testdata['questionsum'];
                $data[$i]['num']=$beginnum;
              	$data[$i]['subjectid']=$subjectid;
                $beginnum=$beginnum+1;

                if($data[$i]['kind']==0)
                {
                    $data[$i]['status']='未完成';
                }
                else
                {
                    $data[$i]['status']='已完成';
                }
            }
            $data['length']=sizeof($data);
            $data['pagelength']=$pagelength;
            $data['count']=$count;
            $data['pagenum']=ceil($count/$pagelength);
            $data['kind']=$kind;

            echo json_encode($data);
        }else
        {
            $beginnum=($nowpage-1)*$pagelength+1;
            $beginpagenum=$beginnum-1;
            $model=M('mytest');
            $model1=M('paper_msg_data');
            $model2=M('grade_data');
            $model3=M('subject_data');
            $model4=M('test_public_data');
            $dataarr['userid']=$userid;
            $dataarr['kind']=$kind;
            


            $count=$model->where($dataarr)->count();
            $data=$model->where($dataarr)->order('creatime desc')->limit($beginpagenum.','.$pagelength)->select();


            for($i=0;$i<sizeof($data);$i++)
            {
                $testdata=$model1->where('id='.$data[$i]['testid'])->find();

                $subjectid=$testdata['subjectid'];
                
               if(!empty($newsubjectid) && $newsubjectid!=$subjectid) { //如果学科不一致 对应的数组变量注销
                	unset($data[$i]);
                	$count=$count-1;
                	continue;
                }
                
                $gradeid=$testdata['gradeid'];
                $gradedata=$model2->where('id='.$gradeid)->find();
                $subjectdata=$model3->where('id='.$subjectid)->find();
                $data[$i]['grade']=$gradedata['grademsg'];
                $data[$i]['subject']=$subjectdata['subjectmsg'];
                $data[$i]['paper_name']=$testdata['paper_name'];
                $data[$i]['id']=$data[$i]['testid'];
                $data[$i]['userid']=$userid;
                $arr=explode(',',$data[$i]['ctbtestid']);
                if($arr[0]=='')
                {
                    $data[$i]['sum']=0;
                }else
                {
                    $data[$i]['sum']=sizeof($arr);
                }

                $data[$i]['num']=$beginnum;
                $beginnum=$beginnum+1;

                if($data[$i]['kind']==0)
                {
                    $data[$i]['status']='未完成';
                }
                else
                {
                    $data[$i]['status']='已完成';
                }
            }
            $data['length']=sizeof($data);
            $data['pagelength']=$pagelength;
            $data['count']=$count;
            $data['pagenum']=ceil($count/$pagelength);
            $data['kind']=$kind;


            echo json_encode($data);
        }

    }
  
      public function key_phptaskrewrite(){
        $userid=$_POST['userid'];
        $testid=$_POST['testid'];
        $keynote_id=$_POST['keynote_id'];
        $model_key_stumytest=M('key_stumytest');
        $model_key_statistic=M('key_statistic');
        
        //$keynote_id=41;
        //$userid=152;
        //$testid=208;
            
        
        $stumytest_data=$model_key_stumytest->where('id='.$testid)->find();   
        $ctbsum=sizeof(explode(',',$stumytest_data['ctbtestid']));
        
        //key_statistic
           
        $statistic_data['keynote_id']=$keynote_id;
        $statistic_data['userid']=$userid;
        $model_key_statistic->where($statistic_data)->setDec('question_w',$ctbsum);
        
        
        $key_arr['kind']=0;
        $key_arr['ctbtestid']='';
        $key_arr['ctbarr']='';
        $key_arr['lastreadtime']=date('y-m-d h:i:s',time());
        $model_key_stumytest->where('id='.$testid)->save($key_arr); 
        
        $stumytest_max_data['kind']=1;
        $stumytest_max_data['keynote_id']=$keynote_id;
        $stumytest_max_data['userid']=$userid;
        
        $maxlastreadtime=$model_key_stumytest->where($stumytest_max_data)->max('lastreadtime');      
        $key_last_data['lasttime']=$maxlastreadtime;
        $model_key_statistic->where($statistic_data)->save($key_last_data);
            
        echo 1;
      }

    public function phptaskrewrite(){
        $userid=$_POST['userid'];
        $testid=$_POST['testid'];

        $model_mytest=M('mytest');
        $model_class_statistic=M('class_statistic');
        $question_statistic=M('question_statistic');
        $model_paper_msg_data=M('paper_msg_data');
        $model_user_stu_data=M('user_studentparent_addation_data');
        $model_class_data=M('class_data');




        //提取出来班级id和群组id
        $stu_data=$model_user_stu_data->where('userid='.$userid)->find();
        $classid=$stu_data['classid'];
        $groupid=$stu_data['groupid'];

        //获取错题的序号
        $mytest_arr['userid']=$userid;
        $mytest_arr['testid']=$testid;


        $mytest_data=$model_mytest->where($mytest_arr)->find();
        $question_arr=$mytest_data['ctbtestid'];


        //获得试题总数
        $paper_data=$model_paper_msg_data->where('id='.$testid)->find();
        $questionsum=$paper_data['questionsum'];

        //进行修改mytest中的数据，变成未录入数据
        $mytest_save_arr['kind']=0;
        $mytest_save_arr['ctbtestid']='';
        $mytest_save_arr['typeidarr']='';



      $model_mytest->where($mytest_arr)->save($mytest_save_arr);

        //修改班级的统计数据
        $class_statistic_data=$model_class_statistic->where('classid='.$classid)->find();

        $testidarr=explode(',',$class_statistic_data['testidarr']);
        $testidarr_msg='';


        //通过classid查询出来，g1,g2,g3的总人数

        $class_data=$model_class_data->where('id='.$classid)->find();
        $g1_sum=$class_data['g1_sum'];
        $g2_sum=$class_data['g2_sum'];
        $g3_sum=$class_data['g3_sum'];



//        $time_arr=explode(',',$class_statistic_data['time_arr']);
//        $year_time=$class_statistic_data['year_time'];


        $wrong_ratio_arr=explode(',',$class_statistic_data['wrong_ratio_arr']);
        $wrong_ratio_arr_msg='';

//        $subject_arr=explode(',',$class_statistic_data['subject_arr']);
        $classnum=explode(',',$class_statistic_data['classnum']);
//        $group_arr=explode(',',$class_statistic_data['group_arr']);


        $g1_num=explode(',',$class_statistic_data['g1_num']);
        $g1_num_msg='';

        $g2_num=explode(',',$class_statistic_data['g2_num']);
        $g2_num_msg='';

        $g3_num=explode(',',$class_statistic_data['g3_num']);
        $g3_num_msg='';

        $g1_wrong_ratio_arr=explode(',',$class_statistic_data['g1_wrong_ratio_arr']);
        $g1_wrong_ratio_arr_msg='';

        $g2_wrong_ratio_arr=explode(',',$class_statistic_data['g2_wrong_ratio_arr']);
        $g2_wrong_ratio_arr_msg='';

        $g3_wrong_ratio_arr=explode(',',$class_statistic_data['g3_wrong_ratio_arr']);
        $g3_wrong_ratio_arr_msg='';

        for($i=0;$i<sizeof($testidarr);$i++)
        {

            if($testidarr[$i]==$testid)
            {

                if($groupid==1)
                {
                    $g1_num[$i]=$g1_num[$i]-1;
                    $g1_wrong_ratio_arr[$i]=round($g1_num[$i]/$g1_sum,3);
                }
                if($groupid==2)
                {
                    $g2_num[$i]=$g2_num[$i]-1;
                    $g2_wrong_ratio_arr[$i]=round($g2_num[$i]/$g2_sum,3);
                }
                if($groupid==3)
                {
                    $g3_num[$i]=$g3_num[$i]-1;
                    $g3_wrong_ratio_arr[$i]=round($g3_num[$i]/$g3_sum,3);
                }
                $wrong_ratio_arr[$i]=round(($g1_num[$i]+$g1_num[$i]+$g1_num[$i])/$classnum[$i],2);
            }
        }


        $wrong_ratio_arr_msg=implode(",",$wrong_ratio_arr);
        $g1_wrong_ratio_arr_msg=implode(",",$g1_wrong_ratio_arr);
        $g2_wrong_ratio_arr_msg=implode(",",$g2_wrong_ratio_arr);
        $g3_wrong_ratio_arr_msg=implode(",",$g3_wrong_ratio_arr);

        $g1_num_msg=implode(",",$g1_num);
        $g2_num_msg=implode(",",$g2_num);
        $g3_num_msg=implode(",",$g3_num);

        $class_arr['wrong_ratio_arr']= $wrong_ratio_arr_msg;
        $class_arr['g1_wrong_ratio_arr']=$g1_wrong_ratio_arr_msg;
        $class_arr['g2_wrong_ratio_arr']=$g2_wrong_ratio_arr_msg;
        $class_arr['g3_wrong_ratio_arr']=$g3_wrong_ratio_arr_msg;

        $class_arr['g1_num']=$g1_num_msg;
        $class_arr['g2_num']=$g2_num_msg;
        $class_arr['g3_num']=$g3_num_msg;

        $model_class_statistic->where('classid='.$classid)->save($class_arr);


        //修改习题中的统计数据
//        echo $classid.'<br>';
//        echo $question_arr.'<br>';
//        echo $testid.'<br>';

        $g1_w_num_arr_msg='';
        $g2_w_num_arr_msg='';
        $g3_w_num_arr_msg='';
        $all_w_num_arr_msg='';

        $question_arr=explode(',',$question_arr);

        print_r($question_arr);

        for($i=0;$i<sizeof($question_arr);$i++)
        {
            $thisquestionid=$question_arr[$i];
            $questiondata=$question_statistic->where('question_id='.$thisquestionid)->find();

//           print_r($questiondata);

            $testidarr_01=explode(',',$questiondata['testidarr']);
            $classidarr_01=explode(',',$questiondata['classidarr']);
            $g1_w_num_arr_01=explode(',',$questiondata['g1_w_num_arr']);
            $g2_w_num_arr_01=explode(',',$questiondata['g2_w_num_arr']);
            $g3_w_num_arr_01=explode(',',$questiondata['g3_w_num_arr']);
            $all_w_num_arr_01=explode(',',$questiondata['all_w_num_arr']);

//           print_r($testidarr_01);

            for($j=0;$j<sizeof($testidarr_01);$j++)
            {
                if($testidarr_01[$j]==$testid)
                {

                    $classidarr_02=explode('-',$classidarr_01[$j]);
                    $g1_w_num_arr_02=explode('-',$g1_w_num_arr_01[$j]);
                    $g2_w_num_arr_02=explode('-',$g2_w_num_arr_01[$j]);
                    $g3_w_num_arr_02=explode('-',$g3_w_num_arr_01[$j]);
                    $all_w_num_arr_02=explode('-',$all_w_num_arr_01[$j]);

                 //   print_r($classidarr_02);



                    for($m=0;$m<sizeof($classidarr_02);$m++)
                    {
                        if($classidarr_02[$m]==$classid)
                        {
                            if($groupid==1)
                            {
                                $g1_w_num_arr_02[$m]=$g1_w_num_arr_02[$m]-1;
                            }
                            if($groupid==2)
                            {
                                $g2_w_num_arr_02[$m]=$g2_w_num_arr_02[$m]-1;
                            }
                            if($groupid==3)
                            {
                                $g3_w_num_arr_02[$m]=$g3_w_num_arr_02[$m]-1;
                            }
                            $all_w_num_arr_02[$m]=$all_w_num_arr_02[$m]-1;

                        }
                    }

                    $g1_w_num_arr_01[$j]=implode("-",$g1_w_num_arr_02);
                    $g2_w_num_arr_01[$j]=implode("-",$g2_w_num_arr_02);
                    $g3_w_num_arr_01[$j]=implode("-",$g3_w_num_arr_02);
                    $all_w_num_arr_01[$j]=implode("-",$all_w_num_arr_02);

                }

                $g1_w_num_arr_msg=$g1_w_num_arr_msg.','.$g1_w_num_arr_01[$j];
                $g2_w_num_arr_msg=$g2_w_num_arr_msg.','.$g2_w_num_arr_01[$j];
                $g3_w_num_arr_msg=$g3_w_num_arr_msg.','.$g3_w_num_arr_01[$j];
                $all_w_num_arr_msg=$all_w_num_arr_msg.','.$all_w_num_arr_01[$j];
//

            }


                $question_save_arr['g1_w_num_arr']=substr($g1_w_num_arr_msg,1);
                $question_save_arr['g2_w_num_arr']=substr($g2_w_num_arr_msg,1);
                $question_save_arr['g3_w_num_arr']=substr($g3_w_num_arr_msg,1);
                $question_save_arr['all_w_num_arr']=substr($all_w_num_arr_msg,1);


            $g1_w_num_arr_msg='';
            $g2_w_num_arr_msg='';
            $g3_w_num_arr_msg='';
            $all_w_num_arr_msg='';

            $question_statistic->where('question_id='.$thisquestionid)->save($question_save_arr);



        }





echo 1;


     // echo $question_arr.'<hr>'.$questionsum.'<br>';




    }

    public function testchecked0102()
    {
        $testid=$_GET[testid];
        $userid=$_GET[userid];
        $username=$_GET[username];
        $realname=$_GET[realname];
        $paper_name=$_GET[paper_name];
        $testkind=$_GET[testkind];
        $keynote_id=$_GET[keynote_id];
        $subjectid=$_GET[subjectid];
      
      if($testkind=='stu')
      {
        $this->assign('titlekind','班级');
      }
      else
      {
        $this->assign('titlekind','知识点');
      }



        $this->assign('testid',$testid);
        $this->assign('subjectid',$subjectid);
        $this->assign('testkind',$testkind);
        $this->assign('userid',$userid);
        $this->assign('username',$username);
        $this->assign('realname',$realname);
        $this->assign('paper_name',$paper_name);
        $this->assign('keynote_id',$keynote_id);


        $this->display();

    }



    public function testser()
    {

        $testid=$_POST[testid];
        $userid=$_POST[userid];
        $testkind=$_POST[testkind];
      
      if($testkind=='stu')
      {
        $model=M('mytest');
        $model1=M('paper_msg_data');
        $model2=M('test_public_data');

        $data=$model1->where('id='.$testid)->find();
        $filesernum1=$data[filesernum];
        $array['filesernum']=$filesernum1;
        $testdata=$model2->where($array)->order('in_ser asc')->select();
        $testcount=$model2->where($array)->order('in_ser asc')->count();
        $testdata['count']=$testcount;

        for($i=0;$i<$testcount;$i++)
        {
            $testdata[$i]['inputval']=cuttitle($testdata[$i][inputval]);
        }
        echo json_encode($testdata);
      }
      else
      {
        $testdata=key_persontest_to_standtest($testid);
        $testdata['count']=sizeof($testdata);
        echo json_encode($testdata);
      }


    }

    public function phpsubmittest()
    {
        $questionarr=$_POST[questionarr];
        $testid=$_POST[testid];
        $keynote_id=$_POST[keynote_id];
        $userid=$_POST[userid];
        $typeidarr=$_POST[typeidarr];
        $subjectid=$_POST[subjectid];

        class_statistic($testid,$userid,$questionarr);

        $model_addation=M('user_studentparent_addation_data');
        $data=$model_addation->where('userid='.$userid)->find();
        $myclassid=$data['classid'];

        $model=M('mytest');
        $ctb['ctbtestid']=$questionarr;
        $ctb['typeidarr']=$typeidarr;
        $ctb['kind']=1;
        $ctb['userid']=$userid;
        $ctb['classid']=$myclassid;
        $ctb['publish_time']=date('y-m-d h:i:s',time());
        $ctb['subjectid']=$subjectid;


        $ctbarray['testid']=$testid;
        $ctbarray['userid']=$userid;


        $data=$model->where($ctbarray)->find();
        $count=sizeof($data);


        if($count>0)
        {
            $model->where($ctbarray)->save($ctb);
        }
        else
        {
            $newarray['subjectid']=$subjectid;
          	$newarray['testid']=$testid;
            $newarray['userid']=$userid;
            $newarray['userkind']=0;
            $newarray['ctbtestid']=$questionarr;
            $newarray['typeidarr']=$typeidarr;
            $newarray['publish_time']=date('y-m-d h:i:s',time());
            $newarray['kind']=1;
            $newarray['classid']=$myclassid;
            $model->add($newarray);


        }

        $stuid=$userid;
        $operkind=1;

        $model_addation=M('user_studentparent_addation_data');
        $data=$model_addation->where('userid='.$stuid)->find();

        $myclassid=$data['classid'];
        $question_id_arr=explode(',',$questionarr);
        $count=sizeof($question_id_arr);


        //更新单个习题统计的数据库
        for($i=0;$i<$count;$i++)
        {
            $question_id=$question_id_arr[$i];
            questioninsertstatictis($question_id,$stuid,$testid,$myclassid,$operkind);

        }

        echo 1;
    }
  
  
  
    public function key_phpsubmittest()
    {
        $questionarr=$_POST[questionarr];
        $testid=$_POST[testid];
        $userid=$_POST[userid];
        $typeidarr=$_POST[typeidarr];
        $keynote_id=$_POST[keynote_id];
      
      //testid:217,userid:152,questionarr:1301,1300,1299,typeidarr:23,23,23,keynote_id:41
      
      // $userid=152;
      // $keynote_id=41;
      // $questionarr='1301,1300,1299';
      
      
      
        $model_key_stumytest=M('key_stumytest');
      
        $key_data['kind']=1;
      	$key_data['ctbarr']=$typeidarr;
      	$key_data['ctbtestid']=$questionarr;
        $key_data['lastreadtime']=date('y-m-d h:i:s',time());
      
		$model_key_stumytest->where('id='.$testid)->save($key_data);
      
      
      //这里
      
      
        $model_key_statistic=M('key_statistic');
        $question_w=sizeof(explode(',',$questionarr)); 
        $statistic_data['keynote_id']=$keynote_id;
        $statistic_data['userid']=$userid;
      
        $key_statistic_data['lasttime']=date('y-m-d h:i:s',time());
      
        $model_key_statistic->where($statistic_data)->setInc('question_w',$question_w);
        $model_key_statistic->where($statistic_data)->save($key_statistic_data);
      
        echo 1;
    }
//修改classid的数据
    public function test()
    {
        $testid=1523;
        $userid=136;
        $questionid_arr='1029,1034,1041,1046,1049,1060,1064,1065';

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

//函数作用，学生修改错题的时候，如果题目原来选择，这次没有选择，进行修改统计数据
    public function phpreducesub()
    {
        $testarr=$_POST[testarr];
        $testid=$_POST[testid];
        $userid=$_POST[userid];
        $model_statistic=M('question_statistic');


        $model=M('user_studentparent_addation_data');
        $modelclass=M('class_data');
        $studata=$model->where('userid='.$userid)->find();
        $classid=$studata['classid'];

        $classdata=$modelclass->where('id='.$classid)->find();
        $schoolid=$classdata['school_id'];
        $grouplevel=$studata['groupid'];
        $testarr=explode(',',$testarr);
        $count=sizeof($testarr);

        for($i=0;$i<$count;$i++)
        {
            $array2['question_id']=$testarr[$i];
            $array2['statisticyear']=date("Y");
            $data2=$model_statistic->where($array2)->find();

            $data_all_test_wrong_msg=$data2['all_test_wrong_num'];
            $data_class_msg=$data2['classid'];
            $data_school_msg=$data2['schoolid'];
            $data_test_msg=$data2['test_id'];

            $data_all_test_wrong_msg_arr=explode(',',$data_all_test_wrong_msg);
            $data_class_msg_arr=explode(',',$data_class_msg);
            $data_school_msg_arr=explode(',',$data_school_msg);
            $data_test_msg_arr=explode(',',$data_test_msg);

            $count2=sizeof($data_all_test_wrong_msg_arr);

            for($m=0;$m<$count2;$m++)
            {

                if($data_school_msg_arr[$m]==$schoolid && $data_test_msg_arr[$m]==$testid && $data_class_msg_arr[$m]=$classid)
                {
                    $nowtime=$data_all_test_wrong_msg_arr[$m];

                    if($nowtime==1)
                    {
                        //减去当前值
                        unset($data_all_test_wrong_msg_arr[$m]);
                        unset($data_all_test_wrong_msg_arr[$m]);
                        unset($data_class_msg_arr[$m]);
                        unset($data_school_msg_arr[$m]);
                        unset($data_test_msg_arr[$m]);
                    }
                    else
                    {
                        $data_all_test_wrong_msg_arr[$m]=(int)$data_all_test_wrong_msg_arr[$m]-1;
                    }
                }
            }

            $data_all_test_wrong_msg=implode(',',$data_all_test_wrong_msg_arr);
            $data_class_msg=implode(',',$data_class_msg_arr);
            $data_school_msg=implode(',',$data_school_msg_arr);
            $data_test_msg=implode(',',$data_test_msg_arr);

            $newdata['all_test_wrong_num']=$data_all_test_wrong_msg;
            $newdata['classid']=$data_class_msg;
            $newdata['schoolid']=$data_school_msg;
            $newdata['test_id']=$data_test_msg;

            $model_statistic->where($array2)->save($newdata);
        }



    }

    public function checkedpaper0202()
    {
      	$testkind=$_GET['testkind'];
      	$username=$_GET['username'];
      	$realname=$_GET['realname'];
      
       $this->assign('paper_name',$_GET['paper_name']);
     // $testkind='stu';

      if($testkind=='stu')
      {
        //$testid=1544;
        //$userid=152;
        $testid=$_GET['testid'];
        $userid=$_GET['userid'];

        $username=$_GET['username'];
        $realname=$_GET['realname'];
        $paper_name=$_GET['paper_name'];
        
        $array[testid]=$testid;
        $array[userid]=$userid;
        
        

        $model=M('mytest');
        $model1=M('img_cuted_data');
        $model2=M('test_public_data');
        $data=$model->where($array)->find();
      


        $testidarr=explode(",",$data[ctbtestid]);
        $count=count($testidarr);

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
                $test[$i][picnote]='题 '.str_replace(array("\r\n", "\r", "\n",".","&nbps;"), '',$test[$i][title]).'图';
            }
            else
            {
                $test[$i][picnote]='';
            }
          $test[$i][picnote]='';
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
                    $newtest[$m][picnote]='题 '.str_replace(array("\r\n", "\r", "\n",".","&nbps;"), '',$newtest[$m][title]).'图';
                }
                else{
                    $newtest[$m][picnote]='';
                }


//                echo $m.'<br>';
//                echo $newtest[$m][title].'<br>';
//                echo '<br><br>';


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

//                echo $m.'<br>';
//                echo $newtest[$m][title].'<br>';
//                echo '<br><br>';


                $tsernum=$test[$m][tsernum];
                $no2=$no2+1;
                $m=$m+1;
            }
            else
            {
                $newtest[$m][title]= $test[$j][title];
                $newtest[$m][src]=$test[$j][src];

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


//                echo $m.'<br>';
//                echo $newtest[$m][title].'<br>';
//                echo '<br><br>';


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


        $testarr=$data[ctbtestid];
        $this->assign('testarr',$testarr);
        $this->assign('testdata',$newtest);
        $this->assign('testid',$testid);
        $this->assign('userid',$userid);
        $this->assign('username',$username);
        $this->assign('realname',$realname);
      
      
//echo '123';


       $this->display();
      }
      else
      {
        $testid=$_GET['testid'];
        $userid=$_GET['userid'];
        $username=$_GET['username'];
        $realname=$_GET['realname'];
        $paper_name=$_GET['paper_name'];
       // $keynote_msg=$_GET['keynote_msg'];
//
//		$testid=212;
  //      $userid=152;
    //    $username='13311094190';
    	//$realname='方正';
    	//$paper_name='系统测试wqw2018-09-12';



        $array['id']=$testid;
        $array['userid']=$userid;

        $model=M('key_stumytest');
        $model1=M('img_cuted_data');
        $model2=M('test_public_data');
        $data=$model->where($array)->find();

  
        $testidarr=explode(",",$data['ctbtestid']);
        $count=count($testidarr);

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
                $test[$i][picnote]='题 '.str_replace(array("\r\n", "\r", "\n",".","&nbps;"), '',$test[$i][title]).'图';
            }
            else
            {
                $test[$i][picnote]='';
            }
          $test[$i][picnote]='';
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
                    $newtest[$m][picnote]='题 '.str_replace(array("\r\n", "\r", "\n",".","&nbps;"), '',$newtest[$m][title]).'图';
                }
                else{
                    $newtest[$m][picnote]='';
                }
              $test[$i][picnote]='';


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
   

    
        $testarr=$data['questionid'];
        $this->assign('testarr',$testarr);
        $this->assign('testdata',$newtest);
        $this->assign('testid',$testid);
        $this->assign('userid',$userid);
        $this->assign('username',$username);
        $this->assign('realname',$realname);
        $this->assign('paper_name',$paper_name);
    	$this->assign('keynote_msg',$keynote_msg);
        
       // echo 'hello';
        
       // print_r($newtest);

        $this->display();
      
      
      }
      
      
    //  echo $username.','.$realname;
      



    }

    public function test_checkpage_downpdf()
    {
        $testarr=$_POST[testarr];
        echo $testarr;
    }

    public function answersql()
    {
        $id=$_POST['id'];
        $model=M('test_public_data');
        $model1=M('img_cuted_data');


        $data=$model->where('id='.$id)->find();
        $srcid=$data[srcid];

        $tdata=$model1->where('id='.$srcid)->find();
        $answerid=$tdata[answerid];

        if($answerid!=0)
        {
            $adata=$model1->where('id='.$answerid)->find();
            $src=usersrc($adata[src]);
        }
        else
        {
            $src=0;
        }
        echo $src;
    }

    public function managetest0201()
    {
      $userid=$_GET['userid'];
      $username=$_GET['username'];
      $realname=$_GET['realname'];
      
      
      $this->assign('userid',$userid);
      $this->assign('username',$username);
      $this->assign('realname',$realname);
      
      $selectsubjectid=1;
      $this->assign('selectsubjectid',$selectsubjectid);

      $model=M('questiontypes');
      $typelist=$model->where('subjectid='.$selectsubjectid)->select();
      $this->assign('typelist',$typelist);
      
 
      
      $subjectdata=subjectdata();
      $this->assign('subjectList',$subjectdata);
      $this->display();
    }

    public function managelist0202()
    {
        $userid=$_GET['userid'];
       $username=$_GET['username'];
       $realname=$_GET['realname'];
        $this->assign('userid',$userid);
       $this->assign('username',$username);
       $this->assign('realname',$realname);

       $subjectdata=subjectdata();
       $this->assign('subjectList',$subjectdata);
      
        $this->display();
    }

    public function phpmanagetestdata0201()
    {
        $userid=$_POST['userid'];
        $nowpage=$_POST['nowpage'];
        $pagelength=$_POST['pagelength'];
        $newsubjectid=$_POST['subjectid'];
        $gradeid=$_POST['gradeid'];
        $questionid=$_POST['questionid'];
      
       // $userid=152;
       // $nowpage=1;
       // $pagelength=5;


        $beginnum=($nowpage-1)*$pagelength+1;
        $beginpagenum=$beginnum-1;
        $model=M('mytest');
        $model1=M('paper_msg_data');
        $model2=M('grade_data');
        $model3=M('subject_data');
        $model4=M('test_public_data');
        $dataarr['userid']=$userid;
        $dataarr['kind']=1;
        //!empty($questionid) && $dataarr['typeidarr']=array('in',$questionid);
    

        $count=$model->where($dataarr)->count();
        $data=$model->where($dataarr)->order('creatime desc')->limit($beginpagenum.','.$pagelength)->select();
      
      
        for($i=0;$i<sizeof($data);$i++)
        {
        	
        	$data[$i]['wrongsum']=substr_count($data[$i]['ctbtestid'],',')+1;
        	//查找符合条件的题型的数量
        	if(!empty($questionid) && !empty($data[$i]['typeidarr'])) {
        		$jj=0;
        		 $typeAry=explode(',',$data[$i]['typeidarr']);
     
        		 foreach($typeAry as $k=>$v) {
        		 	if($questionid==$v) {
        		 		$jj++;
        		 	}
        		 }
        		 $data[$i]['wrongsum']=$jj;
        	}
        	
            $testdata=$model1->where('id='.$data[$i]['testid'])->find();
            
            $subjectid=$testdata['subjectid'];
            if(!empty($newsubjectid) && $newsubjectid!=$subjectid) { //如果学科不一致 对应的数组变量注销
            	unset($data[$i]);
                $count=$count-1;
                continue;
            }
     
           if(!empty($gradeid) && $gradeid!=$testdata['gradeid']) { //如果年级不一致 对应的数组变量注销
            	unset($data[$i]);
                $count=$count-1;
                continue;
            }
            
            
            $data[$i]['paper_name']=$testdata['paper_name'];
            $data[$i]['num']=$beginnum;
            $beginnum=$beginnum+1;

        }
        $data['length']=sizeof($data);
        $data['pagelength']=$pagelength;
        $data['count']=$count;
        $data['pagenum']=ceil($count/$pagelength);
      

     // print_r($data);
        echo json_encode($data);
    }
   
  public function questiontype()
   {
 
        $subjectid=$_POST['subjectid'];
        
        $model=M('questiontypes');
        $list=$model->where('subjectid='.$subjectid)->select();
      
   		$data='<select class="blackselect" onclick="searchdatatype();" name="questionid" id="questionid"><option value="0">全部</option>';
   		foreach($list as $k=>$v) {
   			$data.="<option value=".$v['id'].">".$v['typesmsg']."</option>";	
   		}
   		$data.="</select>";
  
        echo json_encode($data);
    }
  
  public function phpkeymanagetestdata0201()
  {
        $userid=$_POST['userid'];
        $nowpage=$_POST['nowpage'];
        $pagelength=$_POST['pagelength'];
        $newsubjectid=$_POST['subjectid'];
        $gradeid=$_POST['gradeid'];
        $questionid=$_POST['questionid'];
      
        //$userid=152;
        //$nowpage=1;
        //$pagelength=5;


        $beginnum=($nowpage-1)*$pagelength+1;
        $beginpagenum=$beginnum-1;
    
        $model=M('key_stumytest');
    	$model_onekeynote=M('onekeynote');
    
        $dataarr['userid']=$userid;
        $dataarr['kind']=1;

        $count=$model->where($dataarr)->count();
        $data=$model->where($dataarr)->field(['id','ctbtestid','paper_name','ctbarr'=>'typeidarr','keynote_id','creatime'=>'publish_time','lastreadtime'=>'lastreadtime'])->order('lastreadtime desc')->limit($beginpagenum.','.$pagelength)->select();
      
        for($i=0;$i<sizeof($data);$i++)
        {
            $data[$i]['wrongsum']=substr_count($data[$i]['ctbtestid'],',')+1;
            
        	//查找符合条件的题型的数量
        	if(!empty($questionid) && !empty($data[$i]['typeidarr'])) {
        		$jj=0;
        		 $typeAry=explode(',',$data[$i]['typeidarr']);
     
        		 foreach($typeAry as $k=>$v) {
        		 	if($questionid==$v) {
        		 		$jj++;
        		 	}
        		 }
        		 $data[$i]['wrongsum']=$jj;
        	}
        	
           $testdata=$model_onekeynote->where('id='.$data[$i]['keynote_id'])->find();
            
            $subjectid=$testdata['subjectid'];
            if(!empty($newsubjectid) && $newsubjectid!=$subjectid) { //如果学科不一致 对应的数组变量注销
            	unset($data[$i]);
                $count=$count-1;
                continue;
            }
     
           if(!empty($gradeid) && $gradeid!=$testdata['gradeid']) { //如果年级不一致 对应的数组变量注销
            	unset($data[$i]);
                $count=$count-1;
                continue;
            }
            
            
            $data[$i]['num']=$beginnum;
            $key_data=$model_onekeynote->where('id='.$data[$i]['keynote_id'])->find();
            $data[$i]['keynote_msg']=$key_data['keynotemsg'];
            $beginnum=$beginnum+1;
        }
        $data['length']=sizeof($data);
        $data['pagelength']=$pagelength;
        $data['count']=$count;
        $data['pagenum']=ceil($count/$pagelength);
        echo json_encode($data);
  }
  
  public function thistest()
  {
     $testid=2;
    
	$newtestdata=ctb_persontest_to_standtest($testid);
    persontestpdf($outkind='D',$paper_name='12',$testtime='',$newtestdata);
   // print_r($data);
    


    
  }
  
      public function phpkeytask0101()
    {
        $userid=$_POST['userid'];
        $nowpage=$_POST['nowpage'];
        $pagelength=$_POST['pagelength'];
        $kind=$_POST['kind'];
        $subjectid=$_POST['subjectid'];

      //  $userid='152';
        //$nowpage=1;
        //$pagelength=5;
        //$kind=1;
        
        $beginnum=($nowpage-1)*$pagelength+1;
        $beginpagenum=$beginnum-1;
        $model=M('key_stumytest');
        $model_onekeynote=M('onekeynote');

        $dataarr['userid']=$userid;
        $dataarr['kind']=$kind;

        $count=$model->where($dataarr)->count();
        
        
       // echo $beginpagenum.$pagelength.'<hr>';
        
        $data=$model->where($dataarr)->order('lastreadtime desc')->limit($beginpagenum.','.$pagelength)->select();
        
       for($i=0;$i<sizeof($data);$i++)
        {
         if($kind==0)
         {
           $data[$i]['sum']=substr_count($data[$i]['questionid'],',')+1;
         }
         else
         {
           $data[$i]['sum']=substr_count($data[$i]['ctbtestid'],',')+1;
         }
            
            $data[$i]['num']=$beginnum;
         
         	$key_data=$model_onekeynote->where('id='.$data[$i]['keynote_id'])->find();
            $data[$i]['keynotemsg']=$key_data['keynotemsg'];
            if(!empty($subjectid) && $subjectid!=$key_data['subjectid']) {
            	unset( $data[$i]);
            	$count=$count-1;
            	continue;
            }
          //  $data[$i]['keynote_id']=$key_data['keynote_id'];
         
         if($kind==0)
         {
           $data[$i]['status']='未完成';
         }
         else
         {
           $data[$i]['status']='已完成';
         }

            $beginnum=$beginnum+1;
       }
        $data['kind']=$kind;
        $data['length']=sizeof($data)-1;
        $data['pagelength']=$pagelength;
        $data['count']=$count;
        $data['pagenum']=ceil($count/$pagelength);
        
       // print_r($data);
        
        echo json_encode($data);
    }


    public function managepaperdetail0202()
    {
        $testid=$_GET[testid];
        $userid=$_GET[userid];
        $username=$_GET[username];
        $realname=$_GET[realname];
        $paper_name=$_GET[paper_name];
        $testkind=$_GET[testkind];
        $typeid=$_GET[typeid];
      
      
        //echo $typeid;
        //return;


        $array['id']=$testid;
        $array['userid']=$userid;

      if($testkind==0)
      {
        $model=M('mytest');
      }
      else
      {
        $model=M('key_stumytest');
      }
      
        $model1=M('img_cuted_data');
        $model2=M('test_public_data');
        $data=$model->where($array)->find();


        $testidarr=explode(",",$data[ctbtestid]);
        $count=count($testidarr);
 

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
            $test[$i][typeid]=$data2[typeid];
            $test[$i][ctbname]=$data2[ctbname];
            $test[$i][filesernum]=$data2[filesernum];
            $test[$i][pic1]=usersrc($pic1src);
            $test[$i][pic2]=usersrc($pic2src);
            $test[$i][pic3]=usersrc($pic3src);
            $test[$i][pic4]=usersrc($pic4src);
          
          
         	// print_r($data2);
          
         //    echo '<hr>';

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
                $newtest[$m][src]=usersrc($src);
                $newtest[$m][tsernum]=$tdata[tsernum];
                $newtest[$m][ctbname]=$tdata[ctbname];
                $newtest[$m][filesernum]=$tdata[filesernum];
                $newtest[$m][pic1]=usersrc($pic1src);
                $newtest[$m][pic2]=usersrc($pic2src);
                $newtest[$m][pic3]=usersrc($pic3src);
                $newtest[$m][pic4]=usersrc($pic4src);
                $newtest[$m][id]=$tdata[id];
                $newtest[$m][typeid]=$tdata[typeid];

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
                $newtest[$m][typeid]=$test[$j][typeid];


                $tsernum=$test[$m][tsernum];
                $no2=$no2+1;
                $m=$m+1;
            }
            else
            {
                $newtest[$m][title]= $test[$j][title];
                $newtest[$m][src]=$test[$j][src];

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
                $newtest[$m][typeid]=$test[$j][typeid];



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
      

 
      $g=0;
      for($k=0;$k<$m;$k++)
      {   
 
        if($newtest[$k][typeid]==$typeid && $typeid!=0)
        {
         $mnewtest[$g][title]=$newtest[$k][title];
         $mnewtest[$g][src]=$newtest[$k][src];
         $mnewtest[$g][tsernum]=$newtest[$k][tsernum];
         $mnewtest[$g][ctbname]=$newtest[$k][ctbname];
         $mnewtest[$g][filesernum]=$newtest[$k][filesernum];
         $mnewtest[$g][newtitle]=$g+1;
          
         $mnewtest[$g][pic1]=$newtest[$k][pic1];
         $mnewtest[$g][pic2]=$newtest[$k][pic2];
         $mnewtest[$g][pic3]=$newtest[$k][pic3];
         $mnewtest[$g][pic4]=$newtest[$k][pic4];
         $mnewtest[$g][sum]=$newtest[$k][sum];       
         $mnewtest[$g][picnote]=$newtest[$k][picnote];
         $mnewtest[$g][id]=$newtest[$k][id];
                       
         $mnewtest[$g][typeid]=$newtest[$k][typeid];
         $g=$g+1;
          
        }
       
      }
  
      if($typeid==0)
      {
          $this->assign('testdata',$newtest);
      }
      else
      {
         $this->assign('testdata',$mnewtest);
      }



        $testarr=$data['ctbtestid'];
        $this->assign('paper_name',$paper_name);
        $this->assign('testarr',$testarr);
     
        $this->assign('testkind',$testkind);
        $this->assign('testid',$testid);
        $this->assign('userid',$userid);
        $this->assign('username',$username);
        $this->assign('realname',$realname);



      $this->display();


    }

    public function phpstumytestdata(){

        $userid=$_POST['userid'];
        $testidarr=$_POST['testidarr'];
        $questionsum=$_POST['questionsum'];
        $paper_name=$_POST['paper_name'];
        $testkind=$_POST['testkind'];
        $typequestion=$_POST['typequestion'];
      
      	$userid=6;
      	$testidarr='3,1';
      	$questionsum=3;
      	$paper_name='填空题119121-3';
      	$testkind=0;
      	$typequestion=2;
      	$subjectid=1;
     
        $typeidarr='';
      
       $model_stumytest=M('stumytest');
      
       $testidarr=explode(',',$testidarr);
       $count=sizeof($testidarr);
       $questionarr='';
       $typearr='';
      
      if($testkind==0)
      {
        $model_mytest=M('mytest');
      }
      else
      {
        $model_mytest=M('key_stumytest');
      }
        
        $arr['userid']=$userid;
      
        for($i=0;$i<$count;$i++)
        {
            $arr['id']=$testidarr[$i];
            $data=$model_mytest->where($arr)->find();
          
            $questionarr=$questionarr.','.$data['ctbtestid'];
          
          if($testkind==0)
          {
            $typearr=$typearr.','.$data['typeidarr'];
          }
          else
          {
            $typearr=$typearr.','.$data['ctbarr'];
          }
          
        }
      
      
      

        $questionarr=substr($questionarr,1);
        $typearr=substr($typearr,1);

        $oldmidquestionarr=explode(',',$questionarr);
        $oldmidtypearr=explode(',',$typearr);
      
      print_r($oldmidtypearr);
      
 		echo $typequestion.'<hr>';
      
      $k=0;
      
      for($m=0;$m<sizeof($oldmidquestionarr);$m++)
      {
        if($typequestion==0)
        {
          $oldquestionarr[$k]=$oldmidquestionarr[$m];
          $oldtypearr[$k]=$oldmidtypearr[$m];
          $k=$k+1;
        }
        else
        {
        if($typequestion==$oldmidtypearr[$m])
        {
          $oldquestionarr[$k]=$oldmidquestionarr[$m];
          $oldtypearr[$k]=$oldmidtypearr[$m];
          $k=$k+1;
        }
        }
        

      }


      
        $count=sizeof($oldquestionarr);

        for($i=0;$i<$count;$i++)
        {
            $cttestdata[$i]['ctbquestionid']=$oldquestionarr[$i];
            $cttestdata[$i]['ctbtypeid']=$oldtypearr[$i];
        }

        $typearr=explode(',',$typearr);
        $typearr=array_unique($typearr);
        $i=0;
        $k=0;
        foreach($typearr as $typevalue){
            if($typevalue!='')
            {
                for($j=0;$j<$count;$j++)
                {
                    if($cttestdata[$j]['ctbtypeid']==$typevalue)
                    {
                        $newtestdata[$k]['ctbquestionid']=$cttestdata[$j]['ctbquestionid'];
                        $newtestdata[$k]['ctbtypeid']=$cttestdata[$j]['ctbtypeid'];
                        $k=$k+1;
                    }
                }
                $i=$i+1;
            }
        }

        $ctbquestionarr='';
        $typeidarr='';
        $i=0;
        for($i=0;$i<$count;$i++)
        {
            $ctbquestionarr=$ctbquestionarr.','.$newtestdata[$i]['ctbquestionid'];
            $typeidarr=$typeidarr.','.$newtestdata[$i]['ctbtypeid'];
        }

        $ctbquestionarr=substr($ctbquestionarr,1);
        $typeidarr=substr($typeidarr,1);
        $questionsum=$count;
      
        $array['testkind']=$testkind;
        $array['userid']=$userid;
        $array['creatime']=date('y-m-d h:i:s',time());
        $array['ctbquestionid']=$ctbquestionarr;
        $array['questionsum']=$questionsum;
        $array['typeidarr']=$typeidarr;
        $array['lastreadtime']=date('y-m-d h:i:s',time());
        $array['paper_name']=$paper_name;
      
        print_r($array);
      
        //echo $model_stumytest->add($array);
    }

  
  //这里需要完成
      public function phpkeystumytestdata(){

        $userid=$_POST['userid'];
        $questionid=$_POST['questionid'];
        $typeidarr=$_POST['typeidarr'];
        $questionsum=$_POST['questionsum'];
        $paper_name=$_POST['paper_name'];
        $keynote_id=$_POST['keynote_id'];
        
       // $paper_name='测试排序';
        //$keynote_id='41';
        //$userid=152;
        //$questionsum=38;
        //$questionid='1323,1324,1325,1322,1321,1318,1319,1320,1326,1327,1333,1334,1335,1332,1331,1328,1329,1330,1317,1316,1304,1305,1306,1303,1302,1298,1300,1301,1307,1308,1313,1314,1315,1312,1311,1309,1310,1299';
		//$typeidarr='25,23,23,25,25,24,24,25,23,23,25,25,25,23,23,23,23,23,24,24,24,24,24,24,23,23,23,23,24,24,24,24,24,24,24,24,24,23';

          
        $questionidarr=explode(',',$questionid);  
        $typeidarr=explode(',',$typeidarr);
        $count=sizeof($questionidarr);    
        
      
        
        for($i=0;$i<$count;$i++)
        {
          $newdata[$i]['testid']=$questionidarr[$i];
          $newdata[$i]['typeid']=(int)$typeidarr[$i];
        }
        
        $newdata=array_sort($newdata,'typeid',1);
        $newdata=array_values($newdata);
        
        
      //  print_r($newdata);
        
        $newquestionid='';
        $newtypeid='';
        
        for($i=0;$i<$count;$i++)
        {
          $newquestionid=$newquestionid.','.$newdata[$i]['testid'];
          $newtypeid=$newtypeid.','.$newdata[$i]['typeid'];
        }
        
        $newquestionid=substr($newquestionid,1);
        $newtypeid=substr($newtypeid,1);
        
       // echo $newquestionid.'<hr>';
       // echo $newtypeid.'<hr>';

        $array['userid']=$userid;
        $array['creatime']=date('y-m-d h:i:s',time());
        $array['questionid']=$newquestionid;
        $array['questionsum']=$questionsum;
        $array['typeidarr']=$newtypeid;
        $array['lastreadtime']=date('y-m-d h:i:s',time());
        $array['paper_name']=$paper_name;
        $array['keynote_id']=(int)$keynote_id;
        
        $model_stumytest=M('key_stumytest');
        $model_key_statistic=M('key_statistic');
        
        $key_arr['userid']=$userid;
        $key_arr['keynote_id']=$keynote_id;
        
        $model_key_statistic->where($key_arr)->setInc('question_sum',$questionsum);
        
        echo $model_stumytest->add($array);
        
    }
  
  
  
    public function phpmanagelist0201()
    {
        $userid=$_POST['userid'];
        $nowpage=$_POST['nowpage'];
        $pagelength=$_POST['pagelength'];
        
        $kind=$_POST['kind'];
        $subjectid=$_POST['subjectid'];

        $beginnum=($nowpage-1)*$pagelength+1;
        $beginpagenum=$beginnum-1;
        $model=M('stumytest');
        $model1=M('paper_msg_data');
        $dataarr['userid']=$userid;
        
        !empty($kind) && $dataarr['testkind']=$kind;
        $kind==2 && $dataarr['testkind']=0;
        !empty($subjectid) && $dataarr['subjectid']=$subjectid;
		
  
        $count=$model->where($dataarr)->count();
  
        $data=$model->where($dataarr)->order('lastreadtime desc')->limit($beginpagenum.','.$pagelength)->select();
        for($i=0;$i<sizeof($data);$i++)
        {
            $data[$i]['num']=$beginnum;
          if($data[$i]['testkind']==0)
          {
            $data[$i]['testkind']='stu';
          }
          else
          {
             $data[$i]['testkind']='key';
          }
          
            $beginnum=$beginnum+1;

        }
        $data['length']=sizeof($data);
        $data['pagelength']=$pagelength;
        $data['count']=$count;
        $data['pagenum']=ceil($count/$pagelength);
        echo json_encode($data);

    }


    public function managelistdetail0203()
    {
        $testid=$_GET['testid'];
        $userid=$_GET['userid'];
        $username=$_GET['username'];
        $realname=$_GET['realname'];
        $paper_name=$_GET['paper_name'];





        $array['id']=$testid;
        $array['userid']=$userid;

        $model=M('stumytest');
        $model1=M('img_cuted_data');
        $model2=M('test_public_data');
        $data=$model->where($array)->find();



        $testidarr=explode(",",$data['ctbquestionid']);
        $count=count($testidarr);

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
                $test[$i][picnote]='题 '.str_replace(array("\r\n", "\r", "\n",".","&nbps;"), '',$test[$i][title]).'图';
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
                    $newtest[$m][picnote]='题 '.str_replace(array("\r\n", "\r", "\n",".","&nbps;"), '',$newtest[$m][title]).'图';
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


        $testarr=$data['ctbtestid'];
        $this->assign('testarr',$testarr);
        $this->assign('testdata',$newtest);
        $this->assign('testid',$testid);
        $this->assign('userid',$userid);
        $this->assign('username',$username);
        $this->assign('realname',$realname);
        $this->assign('paper_name',$paper_name);




        $this->display();


    }

//个人试卷生成pdf
    public function phpmanagelistdownloadpdf()
    {
        $testid=$_GET['testid'];
        $outkind=$_GET['outkind'];
        $paper_name=$_GET['paper_name'];
        $testtime=$_GET['$testtime'];//试卷种类
        $testkind=$_GET['$testkind'];

     //  $testid=11;
     // $outkind='D';
     // $paper_name='习题119119-3(key)';
     // $testtime='2019';
     // $testkind='key';
      
        $testtime='生成时间：'.date('y-m-d h:i:s',time());
      
     // echo '12345';
      

       $newtestdata=ctb_persontest_to_standtest($testid);

     // print_r($newtestdata);
       
        
      
      persontestpdf($outkind,$paper_name,$testtime,$newtestdata);

    }
//个人知识点试卷生成pdf
    public function phpkey_managelistdownloadpdf()
    {
        $testid=$_GET['testid'];
        $outkind=$_GET['outkind'];
        $paper_name=$_GET['paper_name'];
        $testtime=$_GET['$testtime'];//试卷种类
        $keynote_msg=$_GET['keynote_msg'];
      
       $testid=11;
      $outkind='D';
      $paper_name='习题119119-3(key)';
      $testtime='2019';
      $testkind='key';

        $testtime='知识点：'.$keynote_msg.' 生成时间：'.date('y-m-d h:i:s',time());
      
      
        $newtestdata=key_persontest_to_standtest($testid);
        
      
        persontestpdf($outkind,$paper_name,$testtime,$newtestdata);

    }  
 
 
  
      public function key_phpmanagelistdownloadanswerpdf()
    {
        $testid=$_GET['testid'];
        $outkind=$_GET['outkind'];
        $paper_name=$_GET['paper_name'].'答案';
      
      	//$testid=210;
       // $outkind='I';
       // $paper_name='测试答案';
      
        $testtime=$_GET['$testtime'];//试卷种类
        $testtime='生成时间：'.date('y-m-d h:i:s',time());
        $data=key_persontest_to_standtest($testid);
        
       // print_r($data);
        persontest_to_answerpdf($data,$paper_name,$outkind);
    }
  
//个人试卷生成答案pdf
    public function phpmanagelistdownloadanswerpdf()
    {
        $testid=$_GET['testid'];
        $outkind=$_GET['outkind'];
        $paper_name=$_GET['paper_name'].'答案';
      
        $testtime=$_GET['$testtime'];//试卷种类
        $testtime='生成时间：'.date('y-m-d h:i:s',time());
        $data=persontest_to_standtest($testid,'stu');
        persontest_to_answerpdf($data,$paper_name,$outkind);
    }
//个人试卷生成pdf
    public function phpmanagepaperdetailpdf()
    {
        $testid=$_GET['testid'];
        $outkind=$_GET['outkind'];
        $paper_name=$_GET['paper_name'];
        $testkind=$_GET['testkind'];
        $testtime=$_GET['$testtime'];//试卷种类
        $testtime='生成时间：'.date('y-m-d h:i:s',time());
      
       if($testkind==0)
        {
           $newtestdata=persontest_to_standtest($testid,'tec');
        }
        else
        {
        $newtestdata=key_persontest_to_standtest($testid);
        }
       
        persontestpdf($outkind,$paper_name,$testtime,$newtestdata);
    }

//个人试卷生成答案pdf
    public function phpmanagepaperanswerpdf()
    {
        $testid=$_GET['testid'];
        $outkind=$_GET['outkind'];
        $paper_name=$_GET['paper_name'].'答案';
        $testtime=$_GET['$testtime'];//试卷种类
        $testtime='生成时间：'.date('y-m-d h:i:s',time());
        $testkind=$_GET['testkind'].'答案';
      
      if($testkind==0)
      {
        $data=persontest_to_standtest($testid,'tec');
      }
      else
      {
        $data=key_persontest_to_standtest($testid,'tec');
      }
 
        
  
        persontest_to_answerpdf($data,$paper_name,$outkind);
    }
    
    public function sharepdf()
    {
    	$testid=$_GET['testid'];
        $outkind=$_GET['outkind'];
        $paper_name=$_GET['paper_name'].'答案';
        $paper_name=urlencode($paper_name);

        $testtime=$_GET['$testtime'];//试卷种类
        $url=U("Home/Student/phpmanagepaperanswerpdf/testid/".$testid."/outkind/".$outkind."/paper_name/".$paper_name);
       
        //echo "<a href='".$url."'>查看下载</a>";
         $this->assign('url',$url);
        $this->display();
    }

//测试生成答案
    public  function mytest(){
        $testid=75;
        $paper_name='daan'.'答案';
        $outkind='I';
        $data=persontest_to_standtest($testid,'tec');
        persontest_to_answerpdf($data,$paper_name,$outkind);
        }

//删除个人试卷
    public function phpmanagelistdelsub()
    {
        $testid=$_POST['testid'];
        $model=M('stumytest');
        $model->where('id='.$testid)->delete();
        echo 1;
    }

    public function managemsg0301()
    {
        $userid=$_GET['userid'];
        $username=$_GET['username'];

        $model_stu_add=M('user_studentparent_addation_data');
        $model_class=M('class_data');

        $model=M('user_data');
        $data=$model->where('id='.$userid)->find();
        $realname=$data['realname'];

        $stu_add_data=$model_stu_add->where('userid='.$userid)->find();
        $classid=$stu_add_data['classid'];

        $class_data=$model_class->where('id='.$classid)->find();
        $classname=$class_data['classname'];

        $this->assign('userid',$userid);
        $this->assign('username',$username);
        $this->assign('realname',$realname);
        $this->assign('classname',$classname);

        $this->display();
    }

    public function phppwdsub()
    {
        $userid=$_POST['userid'];
        $oldpwd=$_POST['oldpwd'];
        $newpwd=$_POST['newpwd'];
        $realname=$_POST['realname'];

//        $userid=136;
//        $oldpwd=2;
//        $newpwd=1;

        $model=M('user_data');
        $arr['id']=$userid;
        $arr['pwd']=$oldpwd;

        $data=$model->where($arr)->find();
        $count=sizeof($data);

        if($count==0)
        {
            echo 0;
        }else
        {
            $newarr['pwd']=$newpwd;
            $newarr['realname']=$realname;
            $model->where($arr)->save($newarr);
            echo 1;
        }



    }
  
  public function stu_keylist0401() 
  {
     $subject_id=1;
     $stu_id=$_GET['userid'];
     $username=$_GET['username'];
     $realname=$_GET['realname'];
 
 
    
    
    $model_subject_data=M('subject_data');
    $subject_data=$model_subject_data->select();
   
	$this->assign('subject_data',$subject_data);
    $this->assign('subject_id',$subject_id);
    $this->assign('userid',$stu_id); 
    $this->assign('username',$username); 
    $this->assign('realname',$realname); 
 
    $this->display();
  }
  
  
  public function phpstukeylist0401() 
  {
 
     $stu_id=$_POST['userid'];
     $username=$_POST['username'];
     $realname=$_POST['realname'];
     $subjectid=$_POST['subjectid'];
     $status=$_POST['status'];
     $order=$_POST['order'];
     
 
 
     $order=$_POST['order']?$_POST['order']:'asc';
     $nowpage=$_POST['nowpage'];
     $pagelength=$_POST['pagelength'];
        


     $beginnum=($nowpage-1)*$pagelength;
     $beginpagenum=$beginnum-1;
     
     $model_key_statistic=M('key_statistic');
     $model_onekeynote=M('onekeynote');
    
     !empty($subjectid) && $key_arr['subject_id']=$subjectid;
     $key_arr['userid']=$stu_id;
     $key_arr['kind']=1;
     $status==1 &&  $key_arr['question_sum']=array('gt',0);
     $status==2 &&  $key_arr['question_sum']=0;
     
     $count=$model_key_statistic->where($key_arr)->count();
     $key_data=$model_key_statistic->where($key_arr)->order('lasttime '.$order)->limit($beginnum,$pagelength)->select();
    
    
     for($i=0;$i<sizeof($key_data);$i++)
     {
       $id=$key_data[$i]['keynote_id'];
       $onekeydata=$model_onekeynote->where('id='.$id)->find();
       
       $key_data[$i]['keynotemsg']=$onekeydata['keynotemsg'];
       $key_data[$i]['all_question_sum']=$onekeydata['question_sum'];
       
       if($key_data[$i]['creattime']!='')
       {
          $timestrap=strtotime($key_data[$i]['creattime']);
          $key_data[$i]['creattime']=date("Y-m-d",$timestrap);
       }
       
       if($key_data[$i]['lasttime']!='')
       {
          $timestrap=strtotime($key_data[$i]['lasttime']);
          $key_data[$i]['lasttime']=date("Y-m-d",$timestrap);
       }
       
       if($key_data[$i]['question_sum']==0)
       {
         $key_data[$i]['ratio']=0;
       }
       else
       {
         $key_data[$i]['ratio']=round(($key_data[$i]['question_w']/$key_data[$i]['question_sum'])*100);
       } 
     }
    
   // print_r($key_data);
      $key_data['length']=sizeof($key_data);
      $key_data['pagelength']=$pagelength;
      $key_data['count']=$count;
      $key_data['pagenum']=ceil($count/$pagelength);
    
    echo json_encode($key_data);
  }
  
  public function stu_key_test0402()
  {
     $keynote_id=$_GET['keynote_id'];
     $subjectid=$_GET['subject_id'];
    // $keynote_id=41;
     $model_onekeynote=M('onekeynote');
     $model_key_paper_msg_data=M('key_paper_msg_data');
     $model_test_public_data=M('test_public_data');
    
     $questiondata=questiontype($subjectid);
     $this->assign('questiondata',$questiondata);
    
     $keytest_data=$model_onekeynote->where('id='.$keynote_id)->find();
     $testid_arr=explode(',',$keytest_data['testid_arr']);
     $count=sizeof($testid_arr);
    
     $this->assign('maxnum',$count-1);
    
    


    if($count!=0)
     {
      $m=0;
      for($i=0;$i<$count;$i++)
      {
          $testid=$testid_arr[$i];
          $key_paper_msg_data[$i]=$model_key_paper_msg_data->where('id='.$testid)->find();
          $key_note_arr=$key_paper_msg_data[$i]['keynote_id'];
          $key_note_arr=explode(',',$key_note_arr);
          $keynotemsg='';
          for($j=0;$j<sizeof($key_note_arr);$j++)
          {
             $key_id=$key_note_arr[$j];
             $keynotemsgdata=$model_onekeynote->where('id='.$key_id)->find();
            if($j==0)
            {
                 $keynotemsg=$keynotemsgdata['keynotemsg'];
            }
            else
            {
                 $keynotemsg=$keynotemsg.','.$keynotemsgdata['keynotemsg'];
            }
          
          }
        
        $key_paper_msg_data[$i]['keynote_msg']=$keynotemsg;
       
      }
     }
    
    $this->assign('key_paper_msg',$key_paper_msg_data); 
    $this->assign('keynotemsg',$_GET['keynotemsg']); 
   
	$test_id=$testid_arr[0];
    $newtest=testid_to_publishpaper($test_id);
    
    $onekeydata=$model_key_paper_msg_data->where('id='.$test_id)->find();
    $paper_name=$onekeydata['paper_name'].'（'.sizeof($newtest).'）';
    
    $this->assign('testid_arr',$keytest_data['testid_arr']);
    
    $this->assign('paper_name',$paper_name);
    $this->assign('testdata',$newtest);
    $this->assign('test_id',$test_id);   
    $this->assign('keynote_id',$keynote_id);  
    $this->assign('keynotemsg',$_GET['keynote_msg']); 
    
    

    $this->assign('userid',$_GET['userid']); 
    $this->assign('username',$_GET['username']); 
    $this->assign('realname',$_GET['realname']); 
    
    $this->display();
  }
  
  public function testid0402()
  {
    
    $test_id=$_POST['test_id'];
    $onekeydata=$model_key_paper_msg_data->where('id='.$test_id)->find();
    $filesernum=$onekeydata['filesernum'];
    $paper_name=$onekeydata['paper_name'];
    $public_data_arr['filesernum']=$filesernum;
    $public_data_arr['ctbname']  = array('not in',array('t0','t1'));
    
    $test_public_data=$model_test_public_data->where($public_data_arr)->field('id')->select();
    
    for($i=0;$i<sizeof($test_public_data);$i++)
    {
      $testidarr[$i]=$test_public_data[$i]['id'];
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

    
   // print_r($test);
    //return;

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
    
       $newtest['paper_name']=$paper_name;
       $newtest['testid']=$testid;   
       echo json_encode($newtest);
  }
  
  public function phpkeynotetest0402()
  {
    $test_id=$_POST['testid'];
        $test_id=$_POST['testid'];
        $test_id=$_POST['testid'];
    
    //$test_id=1559;
    
    $testdata=testid_to_publishpaper($test_id);
    $model_key_paper_msg_data=M('key_paper_msg_data');
    $onekeydata=$model_key_paper_msg_data->where('id='.$test_id)->find();
    $paper_name=$onekeydata['paper_name'].'（'.sizeof($testdata).'）';
    
    if($onekeydata['paper_name']=='')
    {
       $testdata['count']=0;
    }
    else
    {
       $testdata['count']=sizeof($testdata);
    }
    $testdata['paper_name']=$paper_name;
    $testdata['testid']=$test_id;
    echo json_encode($testdata);
  }
  
  public function stu_keytestlist0403()
  {
        $userid=$_GET['userid'];
    	$realname=$_GET['realname'];
        $username=$_GET['username'];
    	$model_key_stumytest=M('key_stumytest');
    
        $subject_data=subjectdata();
    
       //数学为默认学科，可以修改数字，进行对应的类型
    	$question_data=questiontype(2);
    
    	//$userid=152;
    
    	$key_arr['userid']=$userid;
        $key_arr['kind']=0;
        $key_data=$model_key_stumytest->where($key_arr)->order('creatime desc')->select();
    
       for($i=0;$i<sizeof($key_data);$i++)
       {
          $newdata[$i]['id']=$key_data[$i]['id'];
          $newdata[$i]['creatime']=date("Y-m-d",strtotime($key_data[$i]['creatime']));
          $newdata[$i]['questionid']=$key_data[$i]['questionid'];
          $newdata[$i]['questionsum']=$key_data[$i]['questionsum'];
          $newdata[$i]['typeidar']=$key_data[$i]['typeidar'];
          $newdata[$i]['lastreadtime']=date("Y-m-d",strtotime($key_data[$i]['lastreadtime']));
          $newdata[$i]['paper_name']=$key_data[$i]['paper_name'];
          $newdata[$i]['keynote_id]']=$key_data[$i]['keynote_id'];
          $newdata[$i]['keynote_msg']=keynoteidtomsg($key_data[$i]['keynote_id']);
       }
    
      $this->assign('userid',$userid);
      $this->assign('username',$username);
      $this->assign('realname',$realname);
      $this->assign('test_data',$newdata);
      $this->assign('questiontype',$question_data);
      $this->assign('subject_data',$subject_data);
    
      $this->display();
    
    

  }
  
  public function phpkeytest0403()
  {
    $userid=$_POST['userid'];
    $nowpage=$_POST['nowpage'];
    $pagelength=$_POST['pagelength'];
    $beginnum=($nowpage-1)*$pagelength+1;
    $beginpagenum=$beginnum-1;
    
    $subjectid=$_POST['subjectid'];
    $gradeid=$_POST['gradeid'];
    $order=$_POST['order']?$_POST['order']:'asc';
    
    $key_arr['userid']=$userid;
    $key_arr['kind']=0;
    
    $model_key_stumytest=M('key_stumytest');
    $one_key_note=M('onekeynote');
    
    $count=$model_key_stumytest->where($key_arr)->count();
    $key_data=$model_key_stumytest->where($key_arr)->order('lastreadtime '.$order)->limit($beginpagenum.','.$pagelength)->select();
    
    
    for($i=0;$i<sizeof($key_data);$i++)
    {
    	!empty($key_data[$i]['keynote_id']) && $noteInfo=$one_key_note->find($key_data[$i]['keynote_id']);
    	if(!empty($noteInfo)) {
    		if(!empty($subjectid) && $noteInfo['subjectid']!=$subjectid) {
    			unset($key_data[$i]);
    			$count=$count-1;
    			continue;
    		}
    	    if(!empty($gradeid) && $noteInfo['gradeid']!=$gradeid) {
    			unset($key_data[$i]);
    			$count=$count-1;
    			continue;
    		}
    	}
    	
	    $newdata[$i]['id']=$key_data[$i]['id'];
	    $newdata[$i]['creatime']=date("Y-m-d",strtotime($key_data[$i]['creatime']));
	    $newdata[$i]['questionid']=$key_data[$i]['questionid'];
	    $newdata[$i]['questionsum']=$key_data[$i]['questionsum'];
	    $newdata[$i]['typeidar']=$key_data[$i]['typeidar'];
	    $newdata[$i]['lastreadtime']=date("Y-m-d",strtotime($key_data[$i]['lastreadtime']));
	    $newdata[$i]['paper_name']=$key_data[$i]['paper_name'];
	    $newdata[$i]['keynote_id]']=$key_data[$i]['keynote_id'];
	    $newdata[$i]['keynote_msg']=keynoteidtomsg($key_data[$i]['keynote_id']);
	    $newdata[$i]['ratio']='-%';
	    $newdata[$i]['num']=$beginnum;
	    $beginnum=$beginnum+1;

    }
    
    $data=$newdata;
    $data['length']=sizeof($key_data);
    $data['pagelength']=$pagelength;
    $data['count']=$count;
    $data['pagenum']=ceil($count/$pagelength);
    
    echo json_encode($data);
    

  }
  
  public function test02()
  {
     $model_key_stumytest=M('key_stumytest');
     $max_lastreadtime=$model_key_stumytest->max('lastreadtime');
    
     echo $max_lastreadtime;
  }
  
  public function managekeylistdetail0404()
  {
        $testid=$_GET['testid'];
        $userid=$_GET['userid'];
        $username=$_GET['username'];
        $realname=$_GET['realname'];
        $paper_name=$_GET['paper_name'];
        $keynote_msg=$_GET['keynote_msg'];

		//$testid=207;
        //$userid=152;
        //$username='13311094190';
    	//$realname='方正';
    	//$paper_name='系统测试2018-09-12';



        $array['id']=$testid;
        $array['userid']=$userid;

        $model=M('key_stumytest');
        $model1=M('img_cuted_data');
        $model2=M('test_public_data');
        $data=$model->where($array)->find();

  
        $testidarr=explode(",",$data['questionid']);
        $count=count($testidarr);

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
                $test[$i][picnote]='题 '.str_replace(array("\r\n", "\r", "\n",".","&nbps;"), '',$test[$i][title]).'图';
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
                    $newtest[$m][picnote]='题 '.str_replace(array("\r\n", "\r", "\n",".","&nbps;"), '',$newtest[$m][title]).'图';
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
   

    
        $testarr=$data['questionid'];
        $this->assign('testarr',$testarr);
        $this->assign('testdata',$newtest);
        $this->assign('testid',$testid);
        $this->assign('userid',$userid);
        $this->assign('username',$username);
        $this->assign('realname',$realname);
        $this->assign('paper_name',$paper_name);
    	$this->assign('keynote_msg',$keynote_msg);

        $this->display();
  }
  
  
  
}
?>