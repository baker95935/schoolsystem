<?php
namespace Home\Controller;
use Think\Controller;

class WechatController extends Controller
{
	public function index()
	{
		$data=array(
			1=>array('title'=>'1.初中物理练习册第一卷11','time'=>'* 2/23 2019-12-23 12:12'),
			2=>array('title'=>'2.初中物理练习册第一卷22','time'=>'* 2/23 2019-12-23 12:12'),
			3=>array('title'=>'3.初中物理练习册第一卷33','time'=>'* 2/23 2019-12-23 12:12'),
		);
		echo json_encode($data);
	}
	
	public function register()
	{
      
      
		$openid=$_GET['openid'];
		$nickName=$_GET['nickName'];
		$avatarUrl=$_GET['avatarUrl'];
      
      //$openid='oFSQR5ZwLmBNxsaF2s6V9End7eb0';
      //$nickName='Founder';
		
		$country=$_GET['country'];
		$city=$_GET['city'];
		$province=$_GET['province'];
		$gender=$_GET['gender'];
		
		$model=M('weixin_users');
		$data=array();
		$data['openid']=$openid;
		$data['nickName']=$nickName;
		$data['avatarUrl']=$avatarUrl;
		$data['gender']=$gender;
		$data['province']=$province;
		$data['city']=$city;
		$data['country']=$country;
		$data['create_time']=time();
		
		if($openid && $nickName) {
			//校验数据
			$count=$model->where("openid='".$openid."'")->count();
			if($count==0) {
				$result=$model->add($data);
                $returnresult['id']=$result;
                $returnresult['email']=0;
              	$returnresult['testsum']=0;
              	$returnresult['create_time']=date('Y-m-d', time());
			} else {
				$info=$model->where("openid='".$openid."'")->find(); 
				$result['id']=$info['id'];
              //	$result['st']=$info['st'];
              //	$result['nd']=$info['nd'];
              //	$result['rd']=$info['rd'];
                $result['nickName']=$info['nickname'];
              	$result['email']=$info['email'];
              	$result['testsum']=$info['testsum'];
              	$result['create_time']=date('Y-m-d', strtotime($info['create_time']));
              	$returnresult=$result;
			}
		}
      
      
      
		echo json_encode($returnresult);
	}
	
	public function task1()
	{
		//mytest表内容分页
        $keyword=$_GET['keyword'];
		$pagesize=$_GET['pagesize'];
		$page=$_GET['page']?$_GET['page']:1;
      	$model_mytest=M('mytest');
		$model_paper=M('paper_msg_data');
		$model_exercise=M('book_exercises');
      	$newkeyword='%'.$keyword.'%';
		$begin=$page*$pagesize;
		$userid=$_GET['userid'];
      
     //	$userid=15;
      //	$begin=10;
      
		$datalist=array();
      	if($userid){  
          	$data_where['userid']=$userid;
         	$data_where['deleted']=0;
          if($keyword!='')
          {
           $data_where['name']= array('like',$newkeyword);
          }
			$page_item_data=$model_mytest->where($data_where)->field('exerciseid')->group('exerciseid')->select();
          	$datalist=$model_mytest->where($data_where)->field('exerciseid,creatime,kind,lastreadtime,name,keyornot')->limit(0,$begin)->group('exerciseid')->order('lastreadtime desc')->select();
        }    
      
      
    //  print_r($page_item_data);
    //  print_r($datalist);
    //  return;
      $itemcount=$page_item_data;
      $pagecount=sizeof($page_item_data);    
      $count=sizeof($datalist); 
      
      
      for($i=0;$i<$count;$i++)
      {
        $exerciseid_arr[$i]=$datalist[$i]['exerciseid'];

      }
      
      $new_exerciseid_arr=array_values(array_unique($exerciseid_arr, SORT_REGULAR));
      $count=sizeof($new_exerciseid_arr);
      
   
      $classnum=1;
      $k=0;
      for($i=0;$i<$count;$i++)
      {

        $data[$i]['classnum']=$classnum;  
      	$done_num=0;
      	$undo_num=0;
        $key_undo_num=0;
      	$test_undo_num=0;
        $lastreadtime=0;
        $creatime=0;
        
        $data_item_num['exerciseid']=$datalist[$i]['exerciseid'];
        $data_item_num['userid']=$userid;
        $data_item_num['keyornot']=0;
        $data_item_num['kind']=0;
        $data_item_num['deleted']=0;
        $lastreadtime=$datalist[$i]['lastreadtime'];
        $creatime=$datalist[$i]['creatime'];
        
        
        $test_undo_num=$model_mytest->where($data_item_num)->count();       
        $data_item_num['keyornot']=1;
        $key_undo_num=$model_mytest->where($data_item_num)->count();
        
        $data_item_all['exerciseid']=$datalist[$i]['exerciseid'];
        $data_item_all['userid']=$userid;
        $data_item_all['deleted']=0;
        
        $item_sum_num=$model_mytest->where($data_item_all)->count();
        
        $data[$i]['notemsg']='('.$test_undo_num.'+'.$key_undo_num.')'.'/'.($item_sum_num).' '.$lastreadtime;  

        
        if($creatime==$lastreadtime)
        {
           $data[$i]['notemsg']= '*'.$data[$i]['notemsg'];
        }
        
   
        $newdata[$k]['id']=$new_exerciseid_arr[$i];
        $newdata[$k]['name']=$datalist[$i]['name'];
        $newdata[$k]['classnum']=$data[$i]['classnum'];
        $newdata[$k]['notemsg']= $data[$i]['notemsg'];
        $k=$k+1;
          
        if($classnum==1)
        {
          $classnum=2;
        }
        else
        {
          $classnum=1;
        }
        
        
        
        $undo_num=0;
        $done_num=0;
        $test_undo_num=0;
        $key_undo_num=0;
        $lastreadtime=0;
        
       }  

  
      
  
     $intpagesize=floor($pagecount/$pagesize);
     $dotpagesize=$pagecount%$pagesize;
      
      if($dotpagesize>0)
      {
        $maxpage=$intpagesize+1;
      }
      else
      {
        $maxpage=$intpagesize;
      }
     
     $data['list']=$newdata;
     $data['maxpage']=$maxpage;
     $data['page']=$page;
     $data['itemcount']=$itemcount;     
     echo json_encode($data);
	}
  
  
  public function task()
	{
		//mytest表内容分页
        $keyword=$_GET['keyword'];
		$pagesize=$_GET['pagesize'];
    	$startnum=$_GET['startnum'];
    	$userid=$_GET['userid'];
    
      	$model_mytest=M('mytest');
		$model_paper=M('paper_msg_data');
		$model_exercise=M('book_exercises');
    
    
    //	$userid=15;
    //	$startnum=0;
    //	$pagesize=10;
    //	$keyword='';
    
    	$Model=M();
    	if($keyword!='')
    	{
     	  $querymsg="select a.exerciseid,b.name,a.lastreadtime from mytest as a INNER JOIN book_exercises b on a.exerciseid=b.id where (a.userid=".$userid." and a.finishornot=0 and a.deleted=0  and a.kind=0 and b.name like '%".$keyword."%') group by a.exerciseid  order by a.lastreadtime desc  LIMIT ".$startnum.",".$pagesize;
          
          $countmsg="select count(a.id) from mytest as a INNER JOIN book_exercises b on a.exerciseid=b.id where (a.userid=".$userid." and a.finishornot=0 and a.deleted=0 and b.name like '%".$keyword."%') group by a.exerciseid";
          $count=$Model->query($countmsg);
        }
    	else
    	{
     	  $querymsg='select a.exerciseid,b.name,a.lastreadtime from mytest as a INNER JOIN book_exercises b on a.exerciseid=b.id where a.userid='.$userid.' and a.finishornot=0 and a.deleted=0 and a.kind=0 group by a.exerciseid  order by a.lastreadtime desc  LIMIT '.$startnum.','.$pagesize; 
            
          $countmsg="select count(id) from mytest  where (userid=".$userid." and finishornot=0 and deleted=0) group by exerciseid";
          $count=$Model->query($countmsg);
        }
    
    
    
    //	print_r($count);
    
    	//return;
        $exercise_data=$Model->query($querymsg);
         			
        $data=$Model->query('select c.id,c.testid,c.exerciseid,c.lastreadtime,c.keyornot,c.kind,m.name from mytest c INNER JOIN  ('.$querymsg.') d ON c.exerciseid=d.exerciseid,book_exercises m where c.exerciseid=m.id and c.userid='.$userid);
    	
   // print_r($data);
    
        $mycount=sizeof($count);
    
        $middata=array_values(array_sort($data,'lastreadtime',1));
        $exerciseid_arr=unique_exercise_arr($middata);
    	$m=1;
    	for($i=0;$i<sizeof($exercise_data);$i++)
        {
          $undotestnum=0;
          $undokeynum=0;
          $sum=0;

           for($j=0;$j<sizeof($middata);$j++)
           {
              if($exercise_data[$i]['exerciseid']==$middata[$j]['exerciseid'])
              {
                if($middata[$j]['kind']==0)
                {
                  if($middata[$j]['keyornot']=='0')
                	{
                      $undotestnum=$undotestnum+1;
                	}
                	else
                	{
                      $undokeynum=$undokeynum+1;        
                	}
                }
                
                $sum=$sum+1;
              }
           }       
          $exercise_data[$i]['undotestnum']=$undotestnum;
          $exercise_data[$i]['undokeynum']=$undokeynum;
          $exercise_data[$i]['sum']=$sum;
          $exercise_data[$i]['classnum']=$m;
          $exercise_data[$i]['lastreadtime']=ymd_sub($exercise_data[$i]['lastreadtime'],'y').'-'.ymd_sub($exercise_data[$i]['lastreadtime'],'m').'-'.ymd_sub($exercise_data[$i]['lastreadtime'],'d');
          if($m==1)
          {
            $m=2;
          }
          else
          {
           $m=1;
          }
        }
     $returndata['itemcount']=sizeof($exercise_data);
     $returndata['count']=$mycount;
     $returndata['list']=$exercise_data;
    
   // print_r($returndata);
     echo json_encode($returndata);
	}
	
	//删除
	public function oper_task()
	{
		$exerciseid=$_GET['exerciseid'];
      	$userid=$_GET['userid'];
      	$operkind=$_GET['operkind'];
      
		$res=0;
		$data=array();
		if($operkind=='delete') {
			$mytest=M('mytest');
			$data['deleted']=1;
			$res=$mytest->where("exerciseid=".$exerciseid." and userid=".$userid. " and finishornot<>1 and kind=0")->save($data);
		}
      	if($operkind=='finish') {
			$mytest=M('mytest');
			$data['finishornot']=1;
			$res=$mytest->where("exerciseid=".$exerciseid." and userid=".$userid. "  and kind=0 and deleted=0")->save($data);
		}
		echo $res;	
	}
  
  	//标示完成任务
	public function finish_task()
	{
		$taskid=$_GET['taskid'];
      	$userid=$_GET['userid'];
      
		$res=0;
		$data=array();
		if($taskid) {
			$mytest=M('mytest');
			$data['finishornot']=1;
          	$data['kind']=1;
			$res=$mytest->where("exerciseid=".$taskid." and userid=".$userid)->save($data);
		}
		echo $res;	
	}
  
  //添加书籍
  public function add_book_exercises()
  {
    
    $model_code=M('code_msg');
    $model_mytest=M('mytest');
    $model_paper_msg_data=M('paper_msg_data');
    $model_key_paper_msg_data=M('key_paper_msg_data');
    
    
    $codemsg=$_GET['codemsg'];
    $userid=$_GET['userid'];
    
    
    //$codemsg='3785963220195222249';
    //$userid=15;
    

    
   // echo $userid;
    
    $onecode['codemsg']=$codemsg;
    
    $CodeData=$model_code->where($onecode)->find();
    
    
    $kind=$CodeData['kind'];//种类，0为多次码1对多，1为一对一
    $exercises_id_data=$CodeData['exercises_id'];//练习册id
    $testsum_data=$CodeData['testsum'];//练习册id
    $keysum_data=$CodeData['keysum'];//练习册id
    
    $status=$CodeData['status'];//状态，1可用，0不可用
    $publishid=$CodeData['publishid'];//出版社id
    $creattime=$CodeData['creattime'];//创建时间
    $endtime=$CodeData['endtime'];//终止时间
    $codename=$CodeData['codename'];//二维码名称
    $codenote=$CodeData['codenote'];//二维码提示
    $free_test_arr_data=$CodeData['free_test_arr'];//免费的习题册
    $free_key_arr_data=$CodeData['free_key_arr'];//免费的知识点
    $userednum=$CodeData['userednum'];//使用者使用次数
    $price=$CodeData['price'];//单价
    $publishdate_data=$CodeData['publishdate'];//发布时间，暂时不用
    $nownum=$CodeData['nownum'];//当前编辑的信息
    
       
    
    
    if($kind==0)
    {
      $exercises_id_data=explode(",", $exercises_id_data);
      $testsum_data=explode(",", $testsum_data);
      $keysum_data=explode(",", $keysum_data);
      
      
      $free_test_arr_data=explode("#", $free_test_arr_data);
      $free_key_arr_data=explode("#", $free_key_arr_data);
      $publishdate_data=explode(",", $publishdate_data);
      $exercises_id=$exercises_id_data[$nownum];
      $testsum=$testsum_data[$nownum];
      $keysum=$keysum_data[$nownum];
      $free_test_arr=explode(",",$free_test_arr_data[$nownum]);
      $free_key_arr=explode(",",$free_key_arr_data[$nownum]);
      $publishdate=$publishdate_data[$nownum];
    }
    else
    {
      $exercises_id=$exercises_id_data;
      $testsum=$testsum_data;
      $keysum=$keysum_data;
      $free_test_arr=explode(",",$free_test_arr_data);
      $free_key_arr=explode(",",$free_key_arr_data);
      $publishdate=$publishdate_data;
    }
    
    
    if($free_test_arr[0]==0)
    {
      $freetestsum=0;
    }
    else
    {
      $freetestsum=sizeof($free_test_arr);
    }
    
    if($free_key_arr[0]==0)
    {
      $freekeysum=0;
    }
    else
    {
       $freekeysum=sizeof($free_test_arr);
    }
    
   // echo $freetestsum.'<hr>'.$freekeysum.'<hr>';
   //    return;
    
 
    //`codemsg`, `kind`, `exercises_id`, `status`, `publishid`, `creattime`, `endtime`, `codename`, `codenote`, `free_test_arr`, `free_key_arr`, `userednum`,`price`, `publishdate`, `nownum`
 /*  */
   
    //$return_num 0 无效二维码。1 可用二维码 2，已经存在二维码
    
    //kind 1 一对一码。2 一对多码（可以变换的）
    //验证二维码是否还有效，开始用return_num=0,如果有效，就修改return_num>0
    

    $return_num=0;
    
    
    //状态可用
    if($status==1)
    {
        $data_mytest['userid']=$userid;
        $data_mytest['exerciseid']=$exercises_id;
        $data_num=$model_mytest->where($data_mytest)->count();
        
        $data_delmytest['deleted']=0;
        $data_delmytest['userid']=$userid;
        $data_delmytest['exerciseid']=$exercises_id;
        
        $delete_num=$model_mytest->where($data_delmytest)->count();
      
        $data_num=0;
      
        //判断是否有数据
        if($data_num>=1)
        {
          //如果数据中，存在未被删除的数据，表示已经有这种习题
          if($delete_num>0)
          {
             $return_num=2;
          }
          else
          {
            //如果数据中，数据被删除，则进行更新
            $deleted_data['deleted']=0;
            $model_mytest->where($data_mytest)->save($deleted_data);
            $return_num=1;
          }
        }
         
        else
        {   
          //插入习题
          $data_paper_msg_data['exerciseid']=$exercises_id;
          $data_result_paper_msg=$model_paper_msg_data->where($data_paper_msg_data)->select();
          $count=sizeof($data_result_paper_msg);
          
         
          for($i=0;$i<$count;$i++)
          {
            $data_add['userid']=$userid;
            $data_add['testid']=$data_result_paper_msg[$i]['id'];
            $data_add['creatime']=date('y-m-d h:i:s',time());
            $data_add['lastreadtime']=date('y-m-d h:i:s',time());
            $data_add['exerciseid']=$exercises_id;
            $data_add['name']=$name;
            $data_add['kind']=0;
            $data_add['questionsum']=$data_result_paper_msg[$i]['questionsum'];
            $data_add['download']=1;
            $data_add['deleted']=0;    
            $data_add['orderid']=$data_result_paper_msg[$i]['orderid'];
            $data_add['keyornot']=0;
            
            $free=ctb_in_array($data_add['testid'],$free_test_arr);
            
            
            if($free>-1 || $price==0)
            {
              $free=1;
            }
            else
            {
              $free=0;
            }
              
            $data_add['free']=$free;    
            $model_mytest->add($data_add);
          }
          
         
             
         // $data_key_paper_msg_data['exerciseid']=$exercises_id;
         // $data_result_key_paper_msg=$model_key_paper_msg_data->where($data_key_paper_msg_data)->select();
          //echo $exercises_id;
          //插入知识点习题
          $model=M('');
          $data_result_key_paper_msg=$model->query('select key_paper_msg_data.* from key_paper_msg_data left join exercise_relation_test on exercise_relation_test.paper_id=key_paper_msg_data.id where exercise_relation_test.exercise_id='.$exercises_id.' order by exercise_relation_test.orderid asc');
          

          $count=sizeof($data_result_key_paper_msg);
          for($i=0;$i<$count;$i++)
          {
            $data_key_add['userid']=$userid;
            $data_key_add['testid']=$data_result_key_paper_msg[$i]['id'];
            $data_key_add['creatime']=$data_add['creatime'];
            $data_key_add['lastreadtime']=$data_key_add['creatime'];
            $data_key_add['exerciseid']=$exercises_id;
            $data_key_add['name']=$name;
            $data_key_add['kind']=0;
            $data_key_add['questionsum']=$data_result_key_paper_msg[$i]['questionsum'];
            $data_key_add['download']=1;
            $data_key_add['deleted']=0;    
            $data_key_add['orderid']=$data_result_key_paper_msg[$i]['orderid'];
            $data_key_add['keyornot']=1;
            
                 
            $free=ctb_in_array($data_key_add['testid'],$free_key_arr);
            
            
            if($free>-1 || $price==0)
            {
              $free=1;
            }
            else
            {
              $free=0;
            }
            
            $data_key_add['free']=$free;
            $model_mytest->add($data_key_add);
          }
          $return_num=1;
          
           $Model_user_code=M('user_code');
           $user_code['codemsg']=$codemsg;
           $user_code['creattime']=date("y-m-d",time());
           $user_code['price']=$price;
           $user_code['userid']=$userid;
           $user_code['testsum']=$testsum;
           $user_code['keysum']=$keysum;
           $user_code['exerciseid']=$exercises_id;
           $user_code['freetestsum']=$freetestsum;
           $user_code['freekeysum']=$freekeysum;
           $Model_user_code->add($user_code);  
        }
    }
    else
    {
      $return_num=0;
    }
    
    if($nownum==-1)
    {
      $return_num=0;
    }
    $data_return['num']=$return_num;
    echo json_encode($data_return);
  }
  
  
  //图书详情
  public function task_detail_note()
  {
    $exerciseid=$_GET['exerciseid'];
    $userid=$_GET['userid'];
    
  //  $exerciseid=12307;
   // $userid=15;
    
    $model_book_exercises=M('book_exercises');
    $model_publish_name=M('publish_name');
    $model_mytest=M('mytest');
    $model_user_code=M('user_code');
    
    $user_code_data=$model_user_code->where('exerciseid='.$exerciseid.' and userid='.$userid)->find(); 
    
    
   // print_r($user_code_data);
    
    
    $price=$user_code_data['price'];
    $testsum=$user_code_data['testsum'];
    $keysum=$user_code_data['keysum'];
    $freetestsum=$user_code_data['freetestsum'];
    $freekeysum=$user_code_data['freekeysum'];
    
    

    
    $book_data['id']=$exerciseid;
    $data_book_exercises=$model_book_exercises->where($book_data)->find();
    $publishid=$data_book_exercises['publishid'];
    $data_publish=$model_publish_name->where('id='.$publishid)->find(); 
    $publishname=$data_publish['name'];
    $data_book_exercises['publishname']=$publishname;
    $data_book_exercises['price']=$price;
    $data_book_exercises['test_sum']=$testsum;
    $data_book_exercises['keynote_sum']=$keysum;
    $data_book_exercises['test_free_sum']=$freetestsum;
    $data_book_exercises['key_free_sum']=$freekeysum;
    
    if($price==0)
    {
    $data_book_exercises['test_free_sum']=$testsum;
    $data_book_exercises['key_free_sum']=$keysum;
    }
    
    //print_r($data_book_exercises);
    
   echo json_encode($data_book_exercises);
  }
  
  //图书练习册
  
   public function task_detail_test()
  {
    $model_mytest=M('mytest');
    $model_paper_msg_data=M('paper_msg_data');
    $model_key_paper_msg_data=M('key_paper_msg_data');
    $model_onekeynote=M('onekeynote');
    $exerciseid=$_GET['exerciseid'];
    $userid=$_GET['userid'];
    $keyornot=$_GET['keyornot'];
    $page=$_GET['page'];
    $pagesize=$_GET['pagesize'];
     
  /*   
    $exerciseid=12307;
    $userid=15;
    $keyornot=0;
    $page=1;
    $pagesize=5;
    */
     
    $endnum=$page*$pagesize;
        
    $mytest_data['userid']=$userid;
    $mytest_data['exerciseid']=$exerciseid;
    $mytest_data['keyornot']=$keyornot;
    $mytest_data['deleted']=0;
    $mytest_data['kind']=0;
    $data_mytest=$model_mytest->where($mytest_data)->order("orderid asc")->limit(0,$endnum)->select();   
    $data_all_mytest=$model_mytest->where($mytest_data)->order("orderid asc")->select();   
     
    $count=sizeof($data_mytest);
    $all_count=sizeof($data_all_mytest);
      
    $intpagesize=floor($all_count/$pagesize);
    $dotpagesize=$all_count%$pagesize;
      
      if($dotpagesize>0)
      {
        $maxpage=$intpagesize+1;
      }
      else
      {
        $maxpage=$intpagesize;
      }
     
  
    $buymsg=0;

    for($i=0;$i<$count;$i++)
    {
      $buyornot=$data_mytest[$i]['buyornot'];
      
      if($buyornot==1)
      {
         $buymsg='已购买';
      }
      
      
         if($keyornot==0)
    	{
     		 $data_paper=$model_paper_msg_data->where('id='.$data_mytest[$i]['testid'])->find();
           	 $data[$i]['paper_name']=$data_paper['paper_name'];
           	 $data[$i]['keynote']='';
           	 $data[$i]['shareornot']=$data_paper['shareornot'];
             $data[$i]['testid']=$data_mytest[$i]['testid'];
           	 $data[$i]['num']=($i+1).'/'.$all_count;
           	 $data[$i]['id']=$data_mytest[$i]['id'];
           
           //修改此处
           
           if($data_mytest[$i]['free']==0 && $buyornot==0)
           {
               $data[$i]['lock']='bottom_view_lock';
               $data[$i]['free']=0;
           }
           else
           {
              $data[$i]['lock']='';
              $data[$i]['free']=1;
           }

           
           
           $bgnum=$i%3;
           if($bgnum==0)
           {
             $data[$i]['bgclass']='0'.'1';
           }
           if($bgnum==1)
           {
              $data[$i]['bgclass']='0'.'2';
           }
           if($bgnum==2)
           {
              $data[$i]['bgclass']='0'.'3';
           }
           
           
   		 }
    	else
    	{
       		$data_paper=$model_key_paper_msg_data->where('id='.$data_mytest[$i]['testid'])->find();
            $data[$i]['paper_name']=$data_paper['paper_name'];
            $data[$i]['shareornot']=$data_paper['shareornot'];
            $data[$i]['testid']=$data_mytest[$i]['testid'];
          
          
          	$keynote_id=$data_paper['keynote_id'];
          	$data_onekeynote=$model_onekeynote->where('id='.$keynote_id)->find();
          	$data[$i]['num']=($i+1).'/'.$all_count;
          	$data[$i]['paper_name']=$data_paper['paper_name'];
          	$data[$i]['keynote']='('.$data_onekeynote['keynotemsg'].')';
            $data[$i]['id']=$data_mytest[$i]['id'];
          
          
          //修改此处
          
           if($data_mytest[$i]['free']==0 && $buyornot==0)
           {
               $data[$i]['lock']='bottom_view_lock';
               $data[$i]['free']=0;
           }
           else
           {
              $data[$i]['lock']='';
              $data[$i]['free']=1;
           }
          
          $bgnum=$i%3;
           if($bgnum==0)
           {
              $data[$i]['bgclass']='0'.'1';
           }
           if($bgnum==1)
           {
              $data[$i]['bgclass']='0'.'2';
           }
           if($bgnum==2)
           {
              $data[$i]['bgclass']='0'.'3';
           }
          
          
    	} 
    }
     
     $result_data['list']=$data;   
     $result_data['maxpage']=$maxpage;
     $result_data['all_count']=$all_count;
     $result_data['buymsg']=$buymsg;
     
     echo json_encode($result_data);
    
    
   
    
  }
  
 	public function testser()
    {

        $testid=$_GET['testid'];
       
     
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
        	$j=$i+1;
            $testdata[$i]['inputval']=cuttitle($testdata[$i][inputval]);
            $testdata[$i]['div']='';
            
        	if($testdata[$i]['ctbname']=='t1' || $testdata[$i]['ctbname']=='t0')
			{
				$testdata[$i]['div']=$testdata[$i]['inputval'];
			}
			
        	if($testdata[$i]['ctbname']=='a' || $testdata[$i]['ctbname']=='t-a')
			{
				$testdata[$i]['mid']=$testdata[$i]['inputval'];
			}
 
        }
        
        var_dump($testdata);exit;
        
        
        echo json_encode($testdata);
       

    }
  
  
  public function sendsms()
  {
  	$appid = 1400202683; 
  	$appkey = "b5fabd6b2053e37c170746e184ce924f";
  	$templateId = 313778;
  	$smsSign = "好助教错题本";
  	
  	//需要发送短信的手机号码
  	$phoneNumbers = $_GET['phone'];
  	$userid=$_GET['userid'];
    $num=$_GET['num'];
 
	
	$res=array();
	//验证码到sesson
    if($phoneNumbers) {
    	
    	//校验是否有记录，如果有 那么返回验证码和提取码
		require "./ThinkPHP/Library/Org/Qcloud/Sms/index.php";		    	 
	    $ssender = new \Qcloud\Sms\SmsSingleSender($appid, $appkey);
	    $params[] = $num;//数组具体的元素个数和模板中变量个数必须一致，例如事例中 templateId:5678对应一个变量，参数数组中元素个数也必须是一个
	    $result = $ssender->sendWithParam("86", $phoneNumbers, $templateId,$params, $smsSign, "", ""); 
	    $rsp = json_decode($result);
	    if($rsp->result==0) {
	    //if(1) {
	    	echo $res;
	    } else {
	    	echo 0;
	    }
    }
  }
  
  public function userdo()
  {
  	$phone=$_GET['phone'];
  	$seccode=$_GET['seccode'];
  	$userid=$_GET['userid'];
   
    
	$user=M('weixin_users');
	$data['phone']=$phone;
	$data['seccode']=$seccode;
	$result=$user->where('id='.$userid)->save($data);
  	echo $result;
  }
  //列表详情页，原始习题展示,区分试卷类型 $testkind
   public function alltestdetail()
  {
    $ctbid=$_GET['ctbid'];
    $testid=$_GET['testid'];
    $testkind=$_GET['testkind'];
    
     //1,test,1
     
   //  $ctbid=1;
     
   //  $testkind='test';
     
   //  $testid=1;

    $Model = M();
     
    if($testkind=='test')
    {
   	$data=$Model->query('SELECT a.paper_name,a.testimage,a.answerimage,a.font_size,a.filesernum,b.id as test_id,b.srcid,b.pic1,b.pic2,b.pic3,b.pic4,b.ctbname,b.inputval,b.typeid,c.src as test_src,d.id as answer_id,d.src as answer_src FROM ((paper_msg_data a INNER JOIN test_public_data b on a.filesernum=b.filesernum) INNER JOIN img_cuted_data c on b.srcid=c.id)  INNER JOIN img_cuted_data d ON c.answerid=d.id where a.id='.$testid.' order by in_ser asc');   
    }
     
   //  print_r($data);
     
   //  return;
    if($testkind=='key')
    {
   	$data=$Model->query('SELECT a.paper_name,a.testimage,a.answerimage,a.font_size,a.filesernum,b.id as test_id,b.srcid,b.pic1,b.pic2,b.pic3,b.pic4,b.ctbname,b.inputval,b.typeid,c.src as test_src,d.id as answer_id,d.src as answer_src FROM ((key_paper_msg_data a INNER JOIN test_public_data b on a.filesernum=b.filesernum) INNER JOIN img_cuted_data c on b.srcid=c.id)  INNER JOIN img_cuted_data d ON c.answerid=d.id where a.id='.$testid.' order by in_ser asc');   
    }
     
    if($testkind=='testctb')
    {      
      $testid_data=$Model->query('SELECT ctbtestid from mytest where id='.$ctbid);
      $testid_arr=$testid_data[0]['ctbtestid'];
      $data=$Model->query('select a.paper_name,a.testimage,a.answerimage,a.font_size,a.filesernum,b.id as test_id,b.srcid,b.pic1,b.pic2,b.pic3,b.pic4,b.ctbname,b.inputval,b.typeid,c.src as test_src,d.id as answer_id,d.src as answer_src,f.typesmsg FROM paper_msg_data as a,((test_public_data b INNER JOIN img_cuted_data c on b.srcid=c.id)  INNER JOIN img_cuted_data d ON c.answerid=d.id )INNER JOIN questiontypes f on b.typeid=f.id  where a.id='.$testid.' and b.id in ('.$testid_arr.')');
    
    }
     
   if($testkind=='keyctb')
    {      
     
      $testid_data=$Model->query('SELECT ctbtestid from mytest where id='.$ctbid);
      $testid_arr=$testid_data[0]['ctbtestid'];
      $data=$Model->query('select a.paper_name,a.testimage,a.answerimage,a.font_size,a.filesernum,b.id as test_id,b.srcid,b.pic1,b.pic2,b.pic3,b.pic4,b.ctbname,b.inputval,b.typeid,c.src as test_src,d.id as answer_id,d.src as answer_src,f.typesmsg FROM key_paper_msg_data as a,((test_public_data b INNER JOIN img_cuted_data c on b.srcid=c.id)  INNER JOIN img_cuted_data d ON c.answerid=d.id )INNER JOIN questiontypes f on b.typeid=f.id  where a.id='.$testid.' and b.id in ('.$testid_arr.')');
    
   }
     
   if($testkind=='seckeyctb' || $testkind=='sectestctb')
    {      
     
      $testid_data=$Model->query('SELECT ctbquestionid from stumytest where id='.$ctbid);
      $testid_arr=$testid_data[0]['ctbquestionid'];
      $data=$Model->query('select a.paper_name,a.testimage,a.answerimage,a.font_size,a.font_size as filesernum,b.id as test_id,b.srcid,b.pic1,b.pic2,b.pic3,b.pic4,b.ctbname,b.inputval,b.typeid,c.src as test_src,d.id as answer_id,d.src as answer_src,f.typesmsg FROM stumytest as a,((test_public_data b INNER JOIN img_cuted_data c on b.srcid=c.id)  INNER JOIN img_cuted_data d ON c.answerid=d.id )INNER JOIN questiontypes f on b.typeid=f.id  where a.id='.$ctbid.' and b.id in ('.$testid_arr.')');
    
   }
     
   //  print_r($data);
    // return;
      if($testkind=='test' || $testkind=='key')
      {
        $middata=$data;
      }

 
         
     if($testkind=='testctb' || $testkind=='keyctb')
     {
       	$pretypeid=0;
        $count=sizeof($data);
       	$k=0;
       	$first=1;
       	$second=1;
       	$third=1;
    	for($i=0;$i<$count;$i++)
        {
        	if($data[$i]['typeid']!=$pretypeid)
            {
               $second=1;
               $third=1;
               $middata[$k]['title']=fir_num_to_font($first).'、'.$data[$i]['typesmsg'];
               $middata[$k]['ctbname']='t0';
               $middata[$k]['typesmsg']=$data[$i]['typesmsg'];
               $middata[$k]['typeid']=$data[$i]['typeid'];
               $middata[$k]['test_id']=$data[$i]['test_id'];
               $middata[$k]['paper_name']=$data[$i]['paper_name'];
               $middata[$k]['testimage']=$data[$i]['testimage'];
               $middata[$k]['answerimage']=$data[$i]['answerimage'];
               $middata[$k]['font_size']=$data[$i]['font_size'];
               $middata[$k]['filesernum']=0;
               $middata[$k]['srcid']=0;
               $middata[$k]['pic1']=0;
               $middata[$k]['pic2']=0;
               $middata[$k]['pic3']=0;
               $middata[$k]['pic4']=0;
               $middata[$k]['test_src']=0;
               $middata[$k]['answer_id']=0;
               $middata[$k]['answer_src']=0;
               $k=$k+1;
              if($data[$i]['ctbname']=='t-a' || $data[$i]['ctbname']=='t1' )
              { 
               $middata[$k]['title']=$second.'.';
               $middata[$k]['ctbname']=$data[$i]['ctbname'];
               $middata[$k]['typesmsg']=$data[$i]['typesmsg'];
               $middata[$k]['typeid']=$data[$i]['typeid'];
               $middata[$k]['test_id']=$data[$i]['test_id'];
               $middata[$k]['paper_name']=$data[$i]['paper_name'];
               $middata[$k]['testimage']=$data[$i]['testimage'];
               $middata[$k]['answerimage']=$data[$i]['answerimage'];
               $middata[$k]['font_size']=$data[$i]['font_size'];
               $middata[$k]['filesernum']=$data[$i]['filesernum'];
               $middata[$k]['srcid']=$data[$i]['srcid'];
               $middata[$k]['pic1']=$data[$i]['pic1'];
               $middata[$k]['pic2']=$data[$i]['pic2'];
               $middata[$k]['pic3']=$data[$i]['pic3'];
               $middata[$k]['pic4']=$data[$i]['pic4'];
               $middata[$k]['test_src']=$data[$i]['test_src'];
               $middata[$k]['answer_id']=$data[$i]['answer_id'];
               $middata[$k]['answer_src']=$data[$i]['answer_src'];   
               $k=$k+1;
               $pretypeid=$data[$i]['typeid'];
               $first=$first+1;
               $second=$second+1;  
               $third=1;
              }

              if($data[$i]['ctbname']=='a')
              { 
               $middata[$k]['title']=third_num_to_font($third);
               $middata[$k]['ctbname']=$data[$i]['ctbname'];
               $middata[$k]['typesmsg']=$data[$i]['typesmsg'];
               $middata[$k]['typeid']=$data[$i]['typeid'];
               $middata[$k]['test_id']=$data[$i]['test_id'];
               $middata[$k]['paper_name']=$data[$i]['paper_name'];
               $middata[$k]['testimage']=$data[$i]['testimage'];
               $middata[$k]['answerimage']=$data[$i]['answerimage'];
               $middata[$k]['font_size']=$data[$i]['font_size'];
               $middata[$k]['filesernum']=$data[$i]['filesernum'];
               $middata[$k]['srcid']=$data[$i]['srcid'];
               $middata[$k]['pic1']=$data[$i]['pic1'];
               $middata[$k]['pic2']=$data[$i]['pic2'];
               $middata[$k]['pic3']=$data[$i]['pic3'];
               $middata[$k]['pic4']=$data[$i]['pic4'];
               $middata[$k]['test_src']=$data[$i]['test_src'];
               $middata[$k]['answer_id']=$data[$i]['answer_id'];
               $middata[$k]['answer_src']=$data[$i]['answer_src'];   
               $k=$k+1;
               $pretypeid=$data[$i]['typeid'];
               $third=$third+1; 
              }
            }
          else
          {
              if($data[$i]['ctbname']=='t-a' || $data[$i]['ctbname']=='t1' )
              { 
               $middata[$k]['title']=$second.'.';
               $middata[$k]['ctbname']=$data[$i]['ctbname'];
               $middata[$k]['typesmsg']=$data[$i]['typesmsg'];
               $middata[$k]['typeid']=$data[$i]['typeid'];
               $middata[$k]['test_id']=$data[$i]['test_id'];
               $middata[$k]['paper_name']=$data[$i]['paper_name'];
               $middata[$k]['testimage']=$data[$i]['testimage'];
               $middata[$k]['answerimage']=$data[$i]['answerimage'];
               $middata[$k]['font_size']=$data[$i]['font_size'];
               $middata[$k]['filesernum']=$data[$i]['filesernum'];
               $middata[$k]['srcid']=$data[$i]['srcid'];
               $middata[$k]['pic1']=$data[$i]['pic1'];
               $middata[$k]['pic2']=$data[$i]['pic2'];
               $middata[$k]['pic3']=$data[$i]['pic3'];
               $middata[$k]['pic4']=$data[$i]['pic4'];
               $middata[$k]['test_src']=$data[$i]['test_src'];
               $middata[$k]['answer_id']=$data[$i]['answer_id'];
               $middata[$k]['answer_src']=$data[$i]['answer_src'];   
               $k=$k+1;
               $pretypeid=$data[$i]['typeid'];
               $second=$second+1;
               $third=1;
              }
              if($data[$i]['ctbname']=='a')
              { 
               $middata[$k]['title']=third_num_to_font($third);
               $middata[$k]['ctbname']=$data[$i]['ctbname'];
               $middata[$k]['typesmsg']=$data[$i]['typesmsg'];
               $middata[$k]['typeid']=$data[$i]['typeid'];
               $middata[$k]['test_id']=$data[$i]['test_id'];
               $middata[$k]['paper_name']=$data[$i]['paper_name'];
               $middata[$k]['testimage']=$data[$i]['testimage'];
               $middata[$k]['answerimage']=$data[$i]['answerimage'];
               $middata[$k]['font_size']=$data[$i]['font_size'];
               $middata[$k]['filesernum']=$data[$i]['filesernum'];
               $middata[$k]['srcid']=$data[$i]['srcid'];
               $middata[$k]['pic1']=$data[$i]['pic1'];
               $middata[$k]['pic2']=$data[$i]['pic2'];
               $middata[$k]['pic3']=$data[$i]['pic3'];
               $middata[$k]['pic4']=$data[$i]['pic4'];
               $middata[$k]['test_src']=$data[$i]['test_src'];
               $middata[$k]['answer_id']=$data[$i]['answer_id'];
               $middata[$k]['answer_src']=$data[$i]['answer_src'];   
               $k=$k+1;
               $pretypeid=$data[$i]['typeid'];
               $third=$third+1; 
              }
          }    
        }
     }
     
     
        if($testkind=='sectestctb' || $testkind=='seckeyctb')
     {
       	$pretypeid=0;
        $count=sizeof($data);
       	$k=0;
       	$first=1;
       	$second=1;
       	$third=1;
    	for($i=0;$i<$count;$i++)
        {
        	if($data[$i]['typeid']!=$pretypeid)
            {
               $second=1;
               $third=1;
               $middata[$k]['title']=fir_num_to_font($first).'、'.$data[$i]['typesmsg'];
               $middata[$k]['ctbname']='t0';
               $middata[$k]['typesmsg']=$data[$i]['typesmsg'];
               $middata[$k]['typeid']=$data[$i]['typeid'];
               $middata[$k]['test_id']=$data[$i]['test_id'];
               $middata[$k]['paper_name']=$data[$i]['paper_name'];
               $middata[$k]['testimage']=$data[$i]['testimage'];
               $middata[$k]['answerimage']=$data[$i]['answerimage'];
               $middata[$k]['font_size']=$data[$i]['font_size'];
               $middata[$k]['filesernum']=0;
               $middata[$k]['srcid']=0;
               $middata[$k]['pic1']=0;
               $middata[$k]['pic2']=0;
               $middata[$k]['pic3']=0;
               $middata[$k]['pic4']=0;
               $middata[$k]['test_src']=0;
               $middata[$k]['answer_id']=0;
               $middata[$k]['answer_src']=0;
               $k=$k+1;
              if($data[$i]['ctbname']=='t-a' || $data[$i]['ctbname']=='t1' )
              { 
               $middata[$k]['title']=$second.'.';
               $middata[$k]['ctbname']=$data[$i]['ctbname'];
               $middata[$k]['typesmsg']=$data[$i]['typesmsg'];
               $middata[$k]['typeid']=$data[$i]['typeid'];
               $middata[$k]['test_id']=$data[$i]['test_id'];
               $middata[$k]['paper_name']=$data[$i]['paper_name'];
               $middata[$k]['testimage']=$data[$i]['testimage'];
               $middata[$k]['answerimage']=$data[$i]['answerimage'];
               $middata[$k]['font_size']=$data[$i]['font_size'];
               $middata[$k]['filesernum']=$data[$i]['filesernum'];
               $middata[$k]['srcid']=$data[$i]['srcid'];
               $middata[$k]['pic1']=$data[$i]['pic1'];
               $middata[$k]['pic2']=$data[$i]['pic2'];
               $middata[$k]['pic3']=$data[$i]['pic3'];
               $middata[$k]['pic4']=$data[$i]['pic4'];
               $middata[$k]['test_src']=$data[$i]['test_src'];
               $middata[$k]['answer_id']=$data[$i]['answer_id'];
               $middata[$k]['answer_src']=$data[$i]['answer_src'];   
               $k=$k+1;
               $pretypeid=$data[$i]['typeid'];
               $first=$first+1;
               $second=$second+1;  
               $third=1;
              }

              if($data[$i]['ctbname']=='a')
              { 
               $middata[$k]['title']=third_num_to_font($third);
               $middata[$k]['ctbname']=$data[$i]['ctbname'];
               $middata[$k]['typesmsg']=$data[$i]['typesmsg'];
               $middata[$k]['typeid']=$data[$i]['typeid'];
               $middata[$k]['test_id']=$data[$i]['test_id'];
               $middata[$k]['paper_name']=$data[$i]['paper_name'];
               $middata[$k]['testimage']=$data[$i]['testimage'];
               $middata[$k]['answerimage']=$data[$i]['answerimage'];
               $middata[$k]['font_size']=$data[$i]['font_size'];
               $middata[$k]['filesernum']=$data[$i]['filesernum'];
               $middata[$k]['srcid']=$data[$i]['srcid'];
               $middata[$k]['pic1']=$data[$i]['pic1'];
               $middata[$k]['pic2']=$data[$i]['pic2'];
               $middata[$k]['pic3']=$data[$i]['pic3'];
               $middata[$k]['pic4']=$data[$i]['pic4'];
               $middata[$k]['test_src']=$data[$i]['test_src'];
               $middata[$k]['answer_id']=$data[$i]['answer_id'];
               $middata[$k]['answer_src']=$data[$i]['answer_src'];   
               $k=$k+1;
               $pretypeid=$data[$i]['typeid'];
               $third=$third+1; 
              }
            }
          else
          {
              if($data[$i]['ctbname']=='t-a' || $data[$i]['ctbname']=='t1' )
              { 
               $middata[$k]['title']=$second.'.';
               $middata[$k]['ctbname']=$data[$i]['ctbname'];
               $middata[$k]['typesmsg']=$data[$i]['typesmsg'];
               $middata[$k]['typeid']=$data[$i]['typeid'];
               $middata[$k]['test_id']=$data[$i]['test_id'];
               $middata[$k]['paper_name']=$data[$i]['paper_name'];
               $middata[$k]['testimage']=$data[$i]['testimage'];
               $middata[$k]['answerimage']=$data[$i]['answerimage'];
               $middata[$k]['font_size']=$data[$i]['font_size'];
               $middata[$k]['filesernum']=$data[$i]['filesernum'];
               $middata[$k]['srcid']=$data[$i]['srcid'];
               $middata[$k]['pic1']=$data[$i]['pic1'];
               $middata[$k]['pic2']=$data[$i]['pic2'];
               $middata[$k]['pic3']=$data[$i]['pic3'];
               $middata[$k]['pic4']=$data[$i]['pic4'];
               $middata[$k]['test_src']=$data[$i]['test_src'];
               $middata[$k]['answer_id']=$data[$i]['answer_id'];
               $middata[$k]['answer_src']=$data[$i]['answer_src'];   
               $k=$k+1;
               $pretypeid=$data[$i]['typeid'];
               $second=$second+1;
               $third=1;
              }
              if($data[$i]['ctbname']=='a')
              { 
               $middata[$k]['title']=third_num_to_font($third);
               $middata[$k]['ctbname']=$data[$i]['ctbname'];
               $middata[$k]['typesmsg']=$data[$i]['typesmsg'];
               $middata[$k]['typeid']=$data[$i]['typeid'];
               $middata[$k]['test_id']=$data[$i]['test_id'];
               $middata[$k]['paper_name']=$data[$i]['paper_name'];
               $middata[$k]['testimage']=$data[$i]['testimage'];
               $middata[$k]['answerimage']=$data[$i]['answerimage'];
               $middata[$k]['font_size']=$data[$i]['font_size'];
               $middata[$k]['filesernum']=$data[$i]['filesernum'];
               $middata[$k]['srcid']=$data[$i]['srcid'];
               $middata[$k]['pic1']=$data[$i]['pic1'];
               $middata[$k]['pic2']=$data[$i]['pic2'];
               $middata[$k]['pic3']=$data[$i]['pic3'];
               $middata[$k]['pic4']=$data[$i]['pic4'];
               $middata[$k]['test_src']=$data[$i]['test_src'];
               $middata[$k]['answer_id']=$data[$i]['answer_id'];
               $middata[$k]['answer_src']=$data[$i]['answer_src'];   
               $k=$k+1;
               $pretypeid=$data[$i]['typeid'];
               $third=$third+1; 
              }
          }    
        }
     }
     
     $newdata=mid_wechat_page_arr($middata,$testkind);
   echo json_encode($newdata);
  }
  
  
  //更新最后一次读取时间，下载使用
     public function updata_php_test()
    {
     
     $ctbid=$_GET['ctbid'];
     $testid=$_GET['testid'];
     $userid=$_GET['userid'];
     $testkind=$_GET['testkind'];
     $timetestkind=$_GET['timetestkind'];
       
     $nowtestnum='';
     $nowtesttime='';
       
     $model_mytest=M('mytest'); 
     $model_stumytest=M('stumytest'); 
     $model_testtime=M('testtime'); 
       
     if(($testkind!='test' || $testkind!='key') && $timetestkind==1)
     {
       
     	$testtime_data=$model_testtime->field('status,nowstatus,testtime')->where('testid='.$ctbid)->order('status asc')->select();
     	$mytest_data=$model_mytest->field('nowtestnum,nowtesttime')->where('id='.$ctbid)->find();  
     	$nowtestnum=$mytest_data['nowtestnum'];
     	$count=sizeof($testtime_data);  
             
     if($nowtestnum==$count)
     {
         $finishornot=1;
     }
     else
     {
         $finishornot=0;
         $nowtesttime=$testtime_data[$nowtestnum]['testtime'];
         $nowtestnum=$testtime_data[$nowtestnum]['status'];
     }
       
            $data['nowtestnum']=$nowtestnum;
      		$data['nowtesttime']=$nowtesttime;
      		$data['finishornot']=$finishornot;
         
     }
   
        
     if($testkind=='test' || $testkind=='key')
     {
      $model_mytest=M('mytest');
      $test_data['id']=$ctbid;
      $data['lastreadtime']=date("Y-m-d H:i:s");
     }
       
     if($testkind=='testctb' || $testkind=='keyctb')
     {
      $model_mytest=M('mytest');      
      $test_data['id']=$ctbid;
      $data['lastreadtime']=date("Y-m-d H:i:s");  
     }
       
     if($testkind=='sectestctb' || $testkind=='seckeyctb')
     {
      $model_mytest=M('stumytest');       
      $test_data['id']=$ctbid; 
      $data['lastreadtime']=date("Y-m-d H:i:s");
       
     }

     $res=$model_mytest->where($test_data)->save($data);
     echo $res;      
    }
  //设定页面,区分试卷类型 $testkind
    public function setpage()
  {
     $testid=$_GET['testid'];
     $answerimage=$_GET['answerimage'];
     $testimage=$_GET['testimage'];
     $font_size=$_GET['font_size'];
     $testkind=$_GET['testkind'];
    
   // $testid=1555;
    //$answerimage=1745;
    //$testimage=1745;
    //$font_size=27;
    
     $model_paper_msg_data=M('paper_msg_data');
     $model_key_paper_msg_data=M('key_paper_msg_data');
     $test_data['font_size']=$font_size;
     $test_data['testimage']=$testimage;
     $test_data['answerimage']=$answerimage;
     $data['id']=$testid;
     if($testkind=='test')
      {
     $res=$model_paper_msg_data->where($data)->save($test_data);
      }
      
      if($testkind=='key')
      {
     $res=$model_key_paper_msg_data->where($data)->save($test_data);
      }
     echo $res;
  }
  //选择原始题错题,区分试卷类型 $testkind
  public function choose()
  {
    $testid=$_GET['testid'];
    $testkind=$_GET['testkind'];
    
    
    $testid=2;
    $testkind='key';
    
    
    $model_paper_msg_data=M('paper_msg_data');
    $model_test_public_data=M('test_public_data');
    $model_img_cuted_data=M('img_cuted_data');//表B
    $Model = M();
    if($testkind=='test')
    {
      	$data=$Model->query('SELECT b.id as test_id,b.ctbname,b.inputval,b.typeid,c.typesmsg FROM (paper_msg_data a INNER JOIN test_public_data b on a.filesernum=b.filesernum) INNER JOIN questiontypes c on b.typeid=c.id where a.id='.$testid.' order by in_ser asc');   
    }
    
    if($testkind=='key')
    {
      	$data=$Model->query('SELECT b.id as test_id,b.ctbname,b.inputval,b.typeid,c.typesmsg FROM (key_paper_msg_data a INNER JOIN test_public_data b on a.filesernum=b.filesernum) INNER JOIN questiontypes c on b.typeid=c.id where a.id='.$testid.' order by in_ser asc');   
   
    	//$data=$Model->query('SELECT b.id as test_id,b.ctbname,b.inputval,b.typeid FROM key_paper_msg_data a INNER JOIN test_public_data b on a.filesernum=b.filesernum  where a.id='.$testid);   
   
    }
    
   // print_r($data);
    
    $newdata=mid_wechat_choose_arr($data);  
    echo json_encode($newdata);
  }
  
  //插入错题本
  public function submitdata()
  {
    $model_testtime=M('testtime');
    $testid=$_GET['testid'];
    $timeset=$_GET['timeset'];
    $ctbid=$_GET['ctbid'];
    $testkind=$_GET['testkind'];
    $arr=$_GET['arr'];
    $userid=$_GET['userid'];
    $st='+'.$_GET['st'].' day';
    $nd='+'.$_GET['nd'].' day';
    $rd='+'.$_GET['rd'].' day';
    
    $model_mytest=M('mytest'); 
    $data = explode(",", $arr);
	$result=ctb_arr($data);
    $newdata['ctbtestid']=$result[0];
    $newdata['typeidarr']=$result[1];
    $newdata['lastreadtime']=$result[2];
    $newdata['kind']=1;
    $newdata['nowtestnum']=1;
    
    //16，499,test
    
   // $ctbid=777;
   // $userid=15;
   // $testkind='test';
   // $timeset=0;
    
    if($testkind=='testctb')
    {
      $keyornot=0;
      $model_paper=M('paper_msg_data');
    }
    else
    {
      $keyornot=1;
      $model_paper=M('key_paper_msg_data');
    }
    
    $nextdata=$model_mytest->field('id,testid,keyornot,free')->where("id >".$ctbid." and userid=".$userid." and keyornot=".$keyornot.' and deleted=0 and finishornot=0')->order("id", "asc")->find();
    

    
    if($nextdata['id']>0)
    {
      $nexttestid=$nextdata['testid'];
   	  $paper_data=$model_paper->field('paper_name,shareornot')->where("id=".$nexttestid)->find();
    }

    
    $nextdata['paper_name']=$paper_data['paper_name'];
    $nextdata['shareornot']=$paper_data['shareornot'];
    

    
    //print_r($nextdata);
    //print_r($paper_data);
    
    //return;
    
    $count=$model_mytest->where('id='.$ctbid.' and kind=1')->count();
    

    if($count==0)
    {
    $newdata['nowtesttime']=date('Y-m-d', strtotime ($st, strtotime(date("y-m-d",time()))));
    $msg=$model_mytest->where('id='.$ctbid)->save($newdata);
      
    $model_weixin_users=M('weixin_users');
	$model_weixin_users->where('id='.$userid)->setInc('testsum');
      
      
    $tnewdata['testid']=$ctbid;
    $tnewdata['status']=1;
    if($timeset==1)
    {
    		 $tnewdata['nowstatus']=1;
     		 $tnewdata['testkind']=$testkind;
   			 $tnewdata['testtime']=date("y-m-d",time());
   			 $tnewdata['lastreadtime']=date("ymd",time());
  			 $tnewdata['testtime']=date('Y-m-d', strtotime ($st, strtotime($tnewdata['testtime'])));     
 			 $model_testtime->add($tnewdata);
    }
      
    if($timeset==2)
    {
             $tnewdata['nowstatus']=1;
     		 $tnewdata['testkind']=$testkind;
   			 $tnewdata['testtime']=date("y-m-d",time());
   			 $tnewdata['lastreadtime']=date("ymd",time());
  			 $tnewdata['testtime']=date('Y-m-d', strtotime ($st, strtotime($tnewdata['testtime'])));     
 			 $model_testtime->add($tnewdata); 
      
            $tnewdata['nowstatus']=0; 
   			$tnewdata['status']=2;
    		$tnewdata['testtime']=date('Y-m-d', strtotime ($nd, strtotime($tnewdata['testtime'])));
    		 $model_testtime->add($tnewdata);   
    }
      
          if($timeset==3)
    {
             $tnewdata['nowstatus']=1;
     		 $tnewdata['testkind']=$testkind;
   			 $tnewdata['testtime']=date("y-m-d",time());
   			 $tnewdata['lastreadtime']=date("ymd",time());
  			 $tnewdata['testtime']=date('Y-m-d', strtotime ($st, strtotime($tnewdata['testtime'])));     
 			 $model_testtime->add($tnewdata); 
      
            $tnewdata['nowstatus']=0; 
   			$tnewdata['status']=2;
    		$tnewdata['testtime']=date('Y-m-d', strtotime ($nd, strtotime($tnewdata['testtime'])));
    		$model_testtime->add($tnewdata);  
            
            $tnewdata['nowstatus']=0; 
    		$tnewdata['status']=3;
    		$tnewdata['testtime']=date('Y-m-d', strtotime ($rd, strtotime($tnewdata['testtime'])));
    		$model_testtime->add($tnewdata);
    }
      
      echo json_encode($nextdata);


    }
    else
    {
       echo 0;
    }

  }
  //查询错题连表
  public function ctbdata_all()
  {
    $Model=M();
    $model_mytest=M('mytest'); 
    $model_stumytest=M('stumytest'); 
    $testkind='all';
    $userid=$_GET['userid'];
    
  // $userid=15;
    
    $startnum=$_GET['startnum'];
    $endnum=$_GET['endnum'];
    
  //  $startnum=0;
  //  $endnum=4;  
      
      
    $arr['userid']=$userid;
    $arr['kind']=1;
    $test=0;$key=0;$testctb=0;$keyctb=0;$allcount=0;
    $data_mytest=$model_mytest->field('keyornot')->where($arr)->select();
    $data_stumytest=$model_stumytest->field('keyornot')->where($arr)->select();
    
    if(sizeof($data_mytest)!=0)
    {
        for($i=0;$i<sizeof($data_mytest);$i++)
      {
        if($data_mytest[$i]['keyornot']==0)
        {
         $test=$test+1;
        }
         else
        {
        $key=$key+1;
        }
     }
       $allcount=sizeof($data_mytest);
    }
    
    if(sizeof($data_stumytest)!=0)
    {
       for($i=0;$i<sizeof($data_stumytest);$i++)
    	{
       		if($data_stumytest[$i]['keyornot']==0)
       		{
         		$testctb=$testctb+1;
       		}
      		else
      		{
        		$keyctb=$keyctb+1;
      		}
    	}
         $allcount=$allcount+sizeof($data_stumytest);
    } 
    
    
    $data=$Model->query('Select id,testid,lastreadtime,keyornot,nowtesttime,nowtestnum, case keyornot  when 0 then (select paper_name from paper_msg_data where id=a.testid) when 1 then (select paper_name from key_paper_msg_data where id=a.testid) end as paper_name,1 testkindnum  From  mytest as a  where userid='.$userid.' and finishornot=0 and kind=1 and deleted=0 union all select id,id as testid,lastreadtime,keyornot,nowtesttime,nowtestnum,paper_name,2 testkindnum from stumytest  where userid='.$userid.' and finishornot=0 and kind=1 and deleted=0  order by lastreadtime desc LIMIT '.$startnum.','.$endnum);
    
    
    $count=sizeof($data);
    
    if($count==0)
    {
      $nullornot='null';
      goto ctbend;
    }
    else
    {
      $nullornot='data';
    }
    
    $j=$startnum+1;
    for($i=0;$i<$count;$i++)
    {
      if($data[$i]['testkindnum']==1 && $data[$i]['keyornot']==0)
      {
        $newdata[$i]['id']=$data[$i]['id'];
        $newdata[$i]['testid']=$data[$i]['testid'];
        $newdata[$i]['lastreadtime']=$data[$i]['lastreadtime'];
        $newdata[$i]['nowtesttime']=$data[$i]['nowtesttime'];
        $newdata[$i]['nowtestnum']=$data[$i]['nowtestnum'];
        $newdata[$i]['paper_name']=$j.'.'.$data[$i]['paper_name'];
        $newdata[$i]['testkind']='testctb';
        $newdata[$i]['thisclass']='square_view_01';         
      }
      if($data[$i]['testkindnum']==1 && $data[$i]['keyornot']==1)
      {
        $newdata[$i]['id']=$data[$i]['id'];
        $newdata[$i]['testid']=$data[$i]['testid'];
        $newdata[$i]['lastreadtime']=$data[$i]['lastreadtime'];
        $newdata[$i]['nowtesttime']=$data[$i]['nowtesttime'];
        $newdata[$i]['nowtestnum']=$data[$i]['nowtestnum'];
        $newdata[$i]['paper_name']=$j.'.'.$data[$i]['paper_name'];
        $newdata[$i]['testkind']='keyctb';
        $newdata[$i]['thisclass']='square_view_03';         
      }
      if($data[$i]['testkindnum']==2 && $data[$i]['keyornot']==0)
      {
        $newdata[$i]['id']=$data[$i]['id'];
        $newdata[$i]['testid']=$data[$i]['testid'];
        $newdata[$i]['lastreadtime']=$data[$i]['lastreadtime'];
        $newdata[$i]['nowtesttime']=$data[$i]['nowtesttime'];
        $newdata[$i]['nowtestnum']=$data[$i]['nowtestnum'];
        $newdata[$i]['paper_name']=$j.'.'.$data[$i]['paper_name'];
        $newdata[$i]['testkind']='sectestctb';
        $newdata[$i]['thisclass']='square_view_02';         
      }
      if($data[$i]['testkindnum']==2 && $data[$i]['keyornot']==1)
      {
        $newdata[$i]['id']=$data[$i]['id'];
        $newdata[$i]['testid']=$data[$i]['testid'];
        $newdata[$i]['lastreadtime']=$data[$i]['lastreadtime'];
        $newdata[$i]['nowtesttime']=$data[$i]['nowtesttime'];
        $newdata[$i]['nowtestnum']=$data[$i]['nowtestnum'];
        $newdata[$i]['paper_name']=$j.'.'.$data[$i]['paper_name'];
        $newdata[$i]['testkind']='seckeyctb';
        $newdata[$i]['thisclass']='square_view_04';           
      }   
        if($newdata[$i]['nowtestnum']==1)
        {
          $newdata[$i]['ser']='1st';
        }
       if($newdata[$i]['nowtestnum']==2)
        {
          $newdata[$i]['ser']='2nd';
        }
        if($newdata[$i]['nowtestnum']==3)
        {
          $newdata[$i]['ser']='3rd';
        }
      
      $newdata[$i]['lastreadtime']=date("Y-m-d",strtotime($newdata[$i]['lastreadtime']));
      $j=$j+1;
    }

    ctbend:
    $returndata['nullornot']=$nullornot;
    $returndata['nowcount']=$count;
    $returndata['count']=$allcount;
    $returndata['testctb']=$test;
    $returndata['keyctb']=$key;
    $returndata['sectestctb']=$testctb;
    $returndata['seckeyctb']=$keyctb;
    $returndata['list']=$newdata;   
    
  // print_r($returndata);
    echo json_encode($returndata); 
  }
  //获取单个类型的错题
  public function ctbdata_one()
  {
    $testkind=$_GET['testkind'];
    $userid=$_GET['userid'];
    $startnum=$_GET['startnum'];
    $lengthnum=$_GET['lengthnum'];
    
    $papermsg=$_GET['papermsg'];
    $exercisemsg=$_GET['exercisemsg'];
    $keynotemsg=$_GET['keynotemsg'];
    $subjectmsg=$_GET['subjectmsg'];
    $subjectid=$_GET['subjectid'];
    $startmsg=$_GET['startmsg'];
    $endmsg=$_GET['endmsg'];
    
    
    
    
	$papermsg='初中';
    $testkind='testctb';
    $userid=15;
    $startnum=0;
    $lengthnum=14;
  //  $startmsg='2019-1-1';
   // $endmsg='2021-1-1';



    
    $testdata['userid']=$userid;
    $testdata['kind']=1;
    $testdata['deleted']=0;

    $Model=M();
    if($testkind=='testctb')
    {
       $keyornot=0;   
       $testdata['keyornot']=$keyornot;
       $Model_mytest=M('mytest');
       $allcount=$Model_mytest->where($testdata)->count(); 
      
      if($papermsg!='')
      {
        $search_sql="b.paper_name like '%".$papermsg."%'";
      }
      
      if($exercisemsg!='')
      {
         $search_sql=$search_sql." and c.name like '%".$exercisemsg."%'";
      }
      
       if($startmsg!='' && $endmsg!='')
      {
         $search_sql=$search_sql.' and (a.lastreadtime between'.$startmsg.' and '.$endmsg.')';
      }
      
      if($search_sql!='')
      {
        $search_sql=' and '.$search_sql;
      }
      
      echo $search_sql;
      
 
   //   $data=$Model->query('select a.id as ctbid,b.paper_name as paper_name,b.id as testid,a.ctbtestid as ctbquestionid,a.typeidarr,a.nowtestnum,a.nowtesttime,a.lastreadtime,c.name,c.classify,d.subjectmsg from ((mytest as a INNER JOIN paper_msg_data b on a.testid=b.id) INNER JOIN book_exercises as c on a.exerciseid=c.id) INNER JOIN subject_data as d on c.classify=d.id where a.userid='.$userid.' and a.keyornot='.$keyornot.' and a.kind=1 and a.deleted=0 order by a.lastreadtime desc limit '.$startnum.','.$lengthnum);   
      $data=$Model->query('select a.id as ctbid,b.paper_name as paper_name,b.id as testid,a.ctbtestid as ctbquestionid,a.typeidarr,a.nowtestnum,a.nowtesttime,a.lastreadtime,c.name,c.classify,d.subjectmsg from ((mytest as a INNER JOIN paper_msg_data b on a.testid=b.id) INNER JOIN book_exercises as c on a.exerciseid=c.id) INNER JOIN subject_data as d on c.classify=d.id where a.userid='.$userid.' and a.keyornot='.$keyornot.' and a.kind=1 and a.deleted=0 '.$search_sql.' order by a.lastreadtime desc limit '.$startnum.','.$lengthnum);   
    
    }
    

    print_r($data);
    return;

    
    if($testkind=='keyctb')
    {
       $keyornot=1;     
       $testdata['keyornot']=$keyornot;
       $Model_mytest=M('mytest');
       $allcount=$Model_mytest->where($testdata)->count();
       $data=$Model->query('select a.id as ctbid,b.paper_name as paper_name,b.keynote_id,c.keynotemsg as name,b.id as testid,a.ctbtestid as ctbquestionid,a.typeidarr,a.nowtestnum,a.nowtesttime,a.lastreadtime,c.subjectid,d.subjectmsg from ((mytest as a INNER JOIN key_paper_msg_data b on a.testid=b.id) INNER JOIN onekeynote as c on b.keynote_id=c.id) INNER JOIN subject_data as d on c.subjectid=d.id where a.userid='.$userid.' and a.keyornot='.$keyornot.' and a.kind=1 and a.deleted=0  order by a.lastreadtime desc limit '.$startnum.','.$lengthnum);  
   
    }
    
    if($testkind=='sectestctb')
    {
       $keyornot=0;
       $testdata['keyornot']=$keyornot;
       $Model_stumytest=M('stumytest');
       $allcount=$Model_stumytest->where($testdata)->count();
      
    //   $data=$Model->query('select id as ctbid,paper_name,paper_name_arr as name,ctbquestionid,typeidarr,nowtestnum,nowtesttime,lastreadtime,b.subjectmsg from stumytest as a INNER JOIN subject_data as b on a.subjectid=b.id    where userid='.$userid.' and keyornot='.$keyornot.' and kind=1  and deleted=0 order by lastreadtime desc limit '.$startnum.','.$lengthnum);  
   
      $data=$Model->query('select a.id as ctbid,paper_name,paper_name_arr as name,ctbquestionid,typeidarr,nowtestnum,nowtesttime,lastreadtime,a.subjectid,b.subjectmsg from stumytest as a  INNER JOIN subject_data as b on a.subjectid=b.id   where userid='.$userid.' and keyornot='.$keyornot.' and kind=1  and deleted=0 order by lastreadtime desc limit '.$startnum.','.$lengthnum);  
   
    
    }
    

    
    if($testkind=='seckeyctb')
    {
       $keyornot=1;
      
       $testdata['keyornot']=$keyornot;
       $Model_stumytest=M('stumytest');
       $allcount=$Model_stumytest->where($testdata)->count();
      
       $data=$Model->query('select a.id as ctbid,paper_name,ctbquestionid,typeidarr,nowtestnum,nowtesttime,lastreadtime,a.subjectid,b.subjectmsg,a.keynote_arr as name from stumytest as a  INNER JOIN subject_data as b on a.subjectid=b.id    where userid='.$userid.' and keyornot='.$keyornot.' and kind=1  and deleted=0 order by lastreadtime desc  limit '.$startnum.','.$lengthnum);    
    }
    
   //print_r($data);
    
   //return;
  
    $ctbquestionid_s='';
    $typeidarr_s='';
    $startnum=$startnum+1;
    $j=$startnum;
    
    if(sizeof($data)==0)
    {
      $nullornot='null';
      goto ctbend;
    }
    else
    {
      $nullornot='data';
    }
    

    
       for($i=0;$i<sizeof($data);$i++)
       {
         
         $data[$i]['paper_name']=$data[$i]['paper_name'];
         
         if($testkind=='testctb')
         {
            $data[$i]['item_icon']='square_view_01';
         }
         
         if($testkind=='keyctb')
         {
            $data[$i]['item_icon']='square_view_03';
         }
         
         if($testkind=='sectestctb')
         {
            $data[$i]['item_icon']='square_view_02';
         }
         
         if($testkind=='seckeyctb')
         {
            $data[$i]['item_icon']='square_view_04';
         }
         
          $data[$i]['item_msg_class']='item_msg_01';
        
         
         if($data[$i]['nowtestnum']==1)
         {
           $data[$i]['nowtestnum']='1st';
         }
         if($data[$i]['nowtestnum']==2)
         {
           $data[$i]['nowtestnum']='2nd';
         }
         if($data[$i]['nowtestnum']==3)
         {
           $data[$i]['nowtestnum']='3rd';
         }
         
       //  echo $data[$i]['typeidarr'].'<hr>';
         
         if($i==0 || $typeidarr_s=='')
         {
           if($data[$i]['typeidarr']!='' && $data[$i]['typeidarr']!=',')
           {
              $typeidarr_s=$data[$i]['typeidarr'];
           }

         }
         else
         {
           
           if($data[$i]['typeidarr']!='' && $data[$i]['typeidarr']!=',')
           {
              $typeidarr_s=$typeidarr_s.','.$data[$i]['typeidarr'];
           }

         }
         
         $j=$j+1;
       	$data[$i]['lastreadtime']=date("Y-m-d",strtotime($data[$i]['lastreadtime']));
       }
    
    //   echo '<hr>'.$typeidarr_s;
    
    //return;


    
   	 if(str_replace(",","",$typeidarr_s)=='')
    	{
       	   $data[$i]['typemsg']='--';
           $data[$i]['notemsg']='--';
          goto ctbend;
    	}
    
 
    
    $typemsg_data=$Model->query('select id,typesmsg from questiontypes where id in ('.$typeidarr_s.')');
    
   // print_r($typemsg_data);
    
   // return;
    
    for($i=0;$i<sizeof($data);$i++)
    {
        $ctbquestionid_s=$data[$i]['ctbquestionid'];
        $typeidarr_s=$data[$i]['typeidarr'];
    	$typeidarr=explode(',',$typeidarr_s);
      	$data[$i]['ctbsum']=sizeof($typeidarr);
    	$type_count=sizeof($typeidarr);
    	for($j=0;$j<$type_count;$j++)
        {
          for($k=0;$k<sizeof($typemsg_data);$k++)
          {
             if($typeidarr[$j]==$typemsg_data[$k]['id'])
             {
               if($j==0)
               {
                 $typemsg=$typemsg_data[$k]['typesmsg'];
               }
               else
               {
                 $typemsg=$typemsg.','.$typemsg_data[$k]['typesmsg'];
               }
             }
          }
         }
      
  
   	   $data[$i]['typemsg']=$typemsg;
       $data[$i]['notemsg']=ctb_note_msg($typemsg);
 
    }
    
   // print_r($data);
    
    ctbend:
     $newdata['nullornot']=$nullornot;
     $count=sizeof($data);
     $newdata['nowcount']=$count;
     $newdata['count']=$allcount;
     $newdata['list']=$data;
    
  //  print_r($newdata);
 	echo json_encode($newdata);  
  }
  //添加错题
  public function ctbdata_add()
  {
     $userid=$_GET['userid'];
     $testkind=$_GET['testkind'];
     $ctbdata_add=$_GET['ctbdata_add'];
     $question_sum=$_GET['question_sum'];
     $question_arr=$_GET['question_arr'];
     $type_arr=$_GET['type_arr'];
     $paper_name=$_GET['paper_name'];
     $paper_name_arr=$_GET['paper_name_arr'];
     $subjectid=$_GET['subjectid'];
     $keynote_msg=$_GET['keynote_msg'];
    
     $keynote_msg=implode(',',uniquearr (explode(',', $keynote_msg)));

    
    //16,499
    
    
     $st='+'.$_GET['st'].' day';
     $nd='+'.$_GET['nd'].' day';
     $rd='+'.$_GET['rd'].' day';
    
    //$st='+7 day';
    //$nd='+31 day';
    //$rd='+120 day';
     
    //$paper_name='错题11932616';  
    //$userid=15;
    //$testkind='test';
    //$question_sum=24;
    //$question_arr='133,138,143,48,53,147,148,63,66,48,53,76,81,85,63,66,90,93,94,97,98,99,101,102';
    //$type_arr='1,1,1,1,1,2,2,2,2,1,1,1,1,1,2,2,2,2,2,3,3,3,3,3';
    
    $question_arr_data=explode(',',$question_arr);
    $type_arr_data=explode(',',$type_arr);
    
    for($i=0;$i<sizeof($question_arr_data);$i++)
    {
      $data[$i]['questionid']=$question_arr_data[$i];
      $data[$i]['typeid']=$type_arr_data[$i];
    }
    
    $newdata=array_sort($data,'typeid',1);
    $newdata=array_values($newdata);
    $ctbquestionid='';
    $typeidarr='';
    for($i=0;$i<sizeof($newdata);$i++)
    {
      if($i==0)
      {
            $ctbquestionid=$newdata[$i]['questionid'];
    		$typeidarr=$newdata[$i]['typeid'];;
      }
      else
      {
            $ctbquestionid=$ctbquestionid.','.$newdata[$i]['questionid'];
    		$typeidarr=$typeidarr.','.$newdata[$i]['typeid'];;
      }
    }
    
    if($testkind=='sectestctb')
    {
      $stumytest_data['keyornot']=0;
    }
    if($testkind=='seckeyctb')
    {
      $stumytest_data['keyornot']=1;
    }
    
    $model_stumytest=M('stumytest'); 
    $model_testtime=M('testtime');
    $stumytest_data['ctbquestionid']=$ctbquestionid;
    $stumytest_data['typeidarr']=$typeidarr;
    $stumytest_data['lastreadtime']=date("Y-m-d H:i:s",time());
    $stumytest_data['creatime']=date("Y-m-d H:i:s",time());
    $stumytest_data['kind']=1;
    $stumytest_data['nowtestnum']=1;
    $stumytest_data['paper_name']=$paper_name;
    $stumytest_data['questionsum']=$question_sum;
    $stumytest_data['testkind']=$testkind;
    $stumytest_data['userid']=$userid;
    $stumytest_data['subjectid']=$subjectid;
    $stumytest_data['paper_name_arr']=$paper_name_arr;
    $stumytest_data['keynote_arr']=$keynote_msg;
    
    
   
      
    
    $stumytest_data['nowtesttime']=date('Y-m-d', strtotime ($st, strtotime(date("y-m-d",time()))));
    $ctbid=$model_stumytest->add($stumytest_data);
      
    $tnewdata['testid']=$ctbid;
    $tnewdata['lastreadtime']=date("ymd",time());
    $tnewdata['testkind']=$testkind;
    $tnewdata['testtime']=date("y-m-d",time());
    
    if($ctbdata_add==1)
    {
      $tnewdata['status']=1;
      $tnewdata['nowstatus']=1; 
      $tnewdata['testtime']=date('Y-m-d', strtotime ($st, strtotime($tnewdata['testtime'])));
      echo $model_testtime->add($tnewdata);
    }
    
    if($ctbdata_add==2)
    {
      $tnewdata['status']=1;
      $tnewdata['nowstatus']=1; 
      $tnewdata['testtime']=date('Y-m-d', strtotime ($st, strtotime($tnewdata['testtime'])));
      $model_testtime->add($tnewdata);
      
      $tnewdata['nowstatus']=0; 
      $tnewdata['status']=2;
      $tnewdata['testtime']=date('Y-m-d', strtotime ($nd, strtotime($tnewdata['testtime'])));
      echo $model_testtime->add($tnewdata);
    }
    
    if($ctbdata_add==3)
    {
      $tnewdata['status']=1;
      $tnewdata['nowstatus']=1; 
      $tnewdata['testtime']=date('Y-m-d', strtotime ($st, strtotime($tnewdata['testtime'])));
      $model_testtime->add($tnewdata);
      
      $tnewdata['nowstatus']=0; 
      $tnewdata['status']=2;
      $tnewdata['testtime']=date('Y-m-d', strtotime ($nd, strtotime($tnewdata['testtime'])));
      $model_testtime->add($tnewdata);
      
      $tnewdata['nowstatus']=0; 
      $tnewdata['status']=3;
      $tnewdata['testtime']=date('Y-m-d', strtotime ($rd, strtotime($tnewdata['testtime'])));
      echo $model_testtime->add($tnewdata);  
    }





  }
  
    public function testapi(){
    $appid=$_GET['appid'];
    $secret=$_GET['secret'];
    $code=$_GET['code'];
    $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$appid.'&secret='.$secret.'&js_code='.$code.'&grant_type=authorization_code';
	$html = file_get_contents($url);
    echo $html; 
  }
  
  
  public function downloadsub()
  {
    $userid=$_GET['userid'];
    //$userid=15;
    $Model=M('weixin_users');
    $data=$Model->field('phone,seccode')->where('id='.$userid)->find();
  	echo json_encode($data);
  }
  
  public function timesetmsg()
  {
    $ctbid=$_GET['ctbid'];
    $testkind=$_GET['testkind'];
    $userid=$_GET['userid'];
   // $ctbid=177;
   // $userid=15;
   // $testkind='testctb';
    
   
    
    $Model=M();
    $Model_testtime=M('testtime');

    if($testkind=='testctb')
    {
      $data=$Model->query('select a.id,a.testid,b.paper_name,a.remindornot,a.nowtesttime,a.nowtestnum,a.finishornot from mytest as a INNER JOIN paper_msg_data b on a.testid=b.id where a.id='.$ctbid);    
    }
    
    if($testkind=='keyctb')
    {
       $data=$Model->query('select a.id,a.testid,b.paper_name,a.remindornot,a.nowtesttime,a.nowtestnum,a.finishornot from mytest as a INNER JOIN key_paper_msg_data b on a.testid=b.id where a.id='.$ctbid);    
    }
    
    if($testkind=='sectestctb' || $testkind=='seckeyctb')
    {
       $data=$Model->query('select id,paper_name,remindornot,nowtesttime,nowtestnum,finishornot from stumytest where id='.$ctbid);    
    }
   
    
   // print_r($data);

   // return;
    
    $remindornot=$data[0]['remindornot'];
    $finishornot=$data[0]['finishornot'];
    $nowtestnum=$data[0]['nowtestnum'];
    
    $newdata['remindornot']=$remindornot;
    $newdata['finishornot']=$finishornot;
    $newdata['nowtestnum']=$nowtestnum;
    
   // echo $remindornot;
    
   // print_r($data);
    if($remindornot==1)
    {
      $newdata['paper_name']=$data[0]['paper_name'];
      
      
      $data_testtime['testid']=$ctbid;
      $data_testtime['userid']=$userid;
      $data_testtime['testkind']=$testkind;
      
      $timedata=$Model_testtime->where($data_testtime)->order('status asc')->select();
      
      
      if(sizeof($timedata)==1)
      {
        //=date('Y',strtotime($timedata[0]['testtime']));
        $newdata['testtime']=1;
        //$newdata['checked']='true';
        
        $newdata['st']=$timedata[0]['testtime'];
        $newdata['year1']=ymd_sub($timedata[0]['testtime'],'y');
        $newdata['month1']=ymd_sub($timedata[0]['testtime'],'m');
        $newdata['day1']=ymd_sub($timedata[0]['testtime'],'d');
        
        $newdata['year2']=ymd_sub($timedata[0]['testtime'],'y');
        $newdata['month2']=ymd_sub($timedata[0]['testtime'],'m');
        $newdata['day2']=ymd_sub($timedata[0]['testtime'],'d');
        
        $newdata['year3']=ymd_sub($timedata[0]['testtime'],'y');
        $newdata['month3']=ymd_sub($timedata[0]['testtime'],'m');
        $newdata['day3']=ymd_sub($timedata[0]['testtime'],'d');
       //添加完成状态 
      $newdata['st_checked']='';
      $newdata['nd_checked']='';
      $newdata['rd_checked']='';
      }
      if(sizeof($timedata)==2)
      {
        $newdata['testtime']=2;
        $newdata['checked']='true';
        
        $newdata['st']=$timedata[0]['testtime'];
        $newdata['year1']=ymd_sub($timedata[0]['testtime'],'y');
        $newdata['month1']=ymd_sub($timedata[0]['testtime'],'m');
        $newdata['day1']=ymd_sub($timedata[0]['testtime'],'d');
        
        $newdata['year2']=ymd_sub($timedata[1]['testtime'],'y');
        $newdata['month2']=ymd_sub($timedata[1]['testtime'],'m');
        $newdata['day2']=ymd_sub($timedata[1]['testtime'],'d');
        
        $newdata['year3']=ymd_sub($timedata[1]['testtime'],'y');
        $newdata['month3']=ymd_sub($timedata[1]['testtime'],'m');
        $newdata['day3']=ymd_sub($timedata[1]['testtime'],'d');
      //添加完成状态 
        if($nowtestnum==1)
        {
            $newdata['st_checked']='';
      		$newdata['nd_checked']='';
      		$newdata['rd_checked']='';
        }
        
        if($nowtestnum==2)
        {
            $newdata['st_checked']='checked';
      		$newdata['nd_checked']='';
      		$newdata['rd_checked']='';
        }
        

      }
      if(sizeof($timedata)==3)
      {
        $newdata['testtime']=3;
        $newdata['checked']='true';
        $newdata['st']=$timedata[0]['testtime'];
        $newdata['year1']=ymd_sub($timedata[0]['testtime'],'y');
        $newdata['month1']=ymd_sub($timedata[0]['testtime'],'m');
        $newdata['day1']=ymd_sub($timedata[0]['testtime'],'d');
        
        $newdata['year2']=ymd_sub($timedata[1]['testtime'],'y');
        $newdata['month2']=ymd_sub($timedata[1]['testtime'],'m');
        $newdata['day2']=ymd_sub($timedata[1]['testtime'],'d');
        
        $newdata['year3']=ymd_sub($timedata[2]['testtime'],'y');
        $newdata['month3']=ymd_sub($timedata[2]['testtime'],'m');
        $newdata['day3']=ymd_sub($timedata[2]['testtime'],'d');
        //添加完成状态 
        $newdata['st_checked']='checked';
        $newdata['nd_checked']='checked';
        $newdata['rd_checked']='false';
        
        if($nowtestnum==1)
        {
            $newdata['st_checked']='';
      		$newdata['nd_checked']='';
      		$newdata['rd_checked']='';
        }
        
        if($nowtestnum==2)
        {
            $newdata['st_checked']='checked';
      		$newdata['nd_checked']='';
      		$newdata['rd_checked']='';
        }
        
        if($nowtestnum==3)
        {
            $newdata['st_checked']='checked';
      		$newdata['nd_checked']='checked';
      		$newdata['rd_checked']='';
        }
        
      }
      
      
      
    }
    else
    {
      $newdata['paper_name']=$data[0]['paper_name'];
      $newdata['testtime']=0;
      $newdata['st']='0-0-0';
      $newdata['nd']='0-0-0';
      $newdata['rd']='0-0-0';
      
      
      $newdata['year1']=date('Y',time());;
      $newdata['month1']=date('m',time());;
      $newdata['day1']=date('d',time());;
        
      $newdata['year2']=date('Y',time());;
      $newdata['month2']=date('m',time());;
      $newdata['day2']=date('d',time());;
        
      $newdata['year3']=date('Y',time());;
      $newdata['month3']=date('m',time());;
      $newdata['day3']=date('d',time());;
      
      //添加完成状态 
      $newdata['st_checked']='';
      $newdata['nd_checked']='';
      $newdata['rd_checked']='';
    }  
    


  //如果为完成状态，重新修正  
    if($finishornot==1)
    {
      $newdata['testtime']='完成';
       if(sizeof($timedata)==1)
        {
            //添加完成状态 
            $newdata['st_checked']='checked';
      		$newdata['nd_checked']='';
      		$newdata['rd_checked']='';
        }
        if(sizeof($timedata)==2)
        {
            //添加完成状态 
            $newdata['st_checked']='checked';
      		$newdata['nd_checked']='checked';
      		$newdata['rd_checked']='';
        }
        if(sizeof($timedata)==3)
        {       
            //添加完成状态 
            $newdata['st_checked']='checked';
      		$newdata['nd_checked']='checked';
      		$newdata['rd_checked']='checked';
        }

    }
    
  // print_r($newdata);

    echo json_encode($newdata);
  }
  
  public function updata_testtime()
  {
      $userid=$_GET['userid'];
      $testkind=$_GET['testkind'];
      $ctbid=$_GET['ctbid'];
      $testtime01=$_GET['testtime01'];
      $testtime02=$_GET['testtime02'];
      $testtime03=$_GET['testtime03'];
      $arr=$_GET['arr'];
      $time_num=$_GET['time_num'];
      $insertornot=$_GET['insertornot'];
      $finishornot=$_GET['finishornot'];
    
      $Model_mytest=M('mytest');
      $model_testtime=M('testtime');
      $Model_stumytest=M('stumytest');
    
    //  $userid=15;
    //  $testkind='test';
    //  $ctbid=180;
    //  $testtime01='20190503';
    //  $testtime02='20190903';
    //  $testtime03='20191106';
    //  $arr='';
    //  $time_num='2';
    //  $insertornot=1;
    //  $finishornot=0;
    
    //判断当前测试次数及时间。
     
       $lastreadtime=date('y-m-d h:i:s',time());
       $num=strlen($arr)/2+1;
       if($num<=$time_num)
       {
         $nowtestnum=$num;
       }
       else
       {
         $finishornot=1;
       }
    
       	if($time_num==0)
    	{
     	 $remindornot=0;
         $finishornot=0;
    	}
   	     else
    	{
     	 $remindornot=1;
    	}
    
    	if($num==1)
   		 {
         $nowtestnum=$num;
         $nowtesttime=$testtime01;
  		 }
        if($num==2)
   		 {
         $nowtestnum=$num;
         $nowtesttime=$testtime02;
   		 }
        if($num==3)
   		 {
         $nowtestnum=$num;
         $nowtesttime=$testtime03;
   		 }
       
       if($time_num==1)
       {
         $newtimedata[0]['testid']=$ctbid;
      	 $newtimedata[0]['testkind']=$testkind;
         $newtimedata[0]['lastreadtime']=$lastreadtime;
         $newtimedata[0]['userid']=$userid;
         
         $newtimedata[0]['status']=1;
         $newtimedata[0]['testtime']=$testtime01;
       }
       if($time_num==2)
       {      
         $newtimedata[0]['testid']=$ctbid;
      	 $newtimedata[0]['testkind']=$testkind;
         $newtimedata[0]['lastreadtime']=$lastreadtime;
         $newtimedata[0]['userid']=$userid;
         
         $newtimedata[0]['status']=1;
         $newtimedata[0]['testtime']=$testtime01;
          
         $newtimedata[1]['testid']=$ctbid;
      	 $newtimedata[1]['testkind']=$testkind;
         $newtimedata[1]['lastreadtime']=$lastreadtime;
         $newtimedata[1]['userid']=$userid;
         
         $newtimedata[1]['status']=2;
         $newtimedata[1]['testtime']=$testtime02;
       }
       if($time_num==3)
       {
         
         $newtimedata[0]['testid']=$ctbid;
      	 $newtimedata[0]['testkind']=$testkind;
         $newtimedata[0]['lastreadtime']=$lastreadtime;
         $newtimedata[0]['userid']=$userid;
         
         $newtimedata[0]['status']=1;
         $newtimedata[0]['testtime']=$testtime01;        
         
         $newtimedata[1]['testid']=$ctbid;
      	 $newtimedata[1]['testkind']=$testkind;
         $newtimedata[1]['lastreadtime']=$lastreadtime;
         $newtimedata[1]['userid']=$userid;
         
         $newtimedata[1]['status']=2;
         $newtimedata[1]['testtime']=$testtime02;
         
         
         $newtimedata[2]['testid']=$ctbid;
      	 $newtimedata[2]['testkind']=$testkind;
         $newtimedata[2]['lastreadtime']=$lastreadtime;
         $newtimedata[2]['userid']=$userid;
         
         $newtimedata[2]['status']=3;
         $newtimedata[2]['testtime']=$testtime03;
       }
     	 $data['finishornot']=$finishornot;
     	 $data['nowtesttime']=$nowtesttime;
     	 $data['nowtestnum']=$nowtestnum;
     	 $data['remindornot']=$remindornot;
    
     if($testkind=='testctb' || $testkind=='keyctb' )
     { 
		$Model_mytest->where('id='.$ctbid)->save($data);
       	$model_testtime->where('userid='.$userid.' and testid='.$ctbid)->delete();
       
       if($remindornot==1)
       {
         $model_testtime->addAll($newtimedata);
       }
     }
    
    if($testkind=='sectestctb' || $testkind=='seckeyctb' )
     { 
		$Model_stumytest->where('id='.$ctbid)->save($data);
       	$model_testtime->where('userid='.$userid.' and testid='.$ctbid)->delete();
       
       if($remindornot==1)
       {
         $model_testtime->addAll($newtimedata);
       }
     }
    
    echo 1;
    
  }
  
 public function finishtestsub()
 {
    $Model=M('');
    //$data=$Model->query('select * from mytest as a INNER JOIN paper_msg_data b on a.testid=b.id   where userid=15 and finishornot=1 UNION select * from stumytest where userid=15 and finishornot=1 ');
   $userid=$_GET['userid'];
   $startnum=$_GET['startnum'];
   $endnum=$_GET['endnum'];
   $operkind=$_GET['operkind'];
   
  // $userid=15;
  // $startnum=1;
  // $endnum=14;
  // $operkind='delete';
   
   if($operkind=='finish')
    {
       $datacount=$Model->query('Select id  From  mytest  where userid='.$userid.' and finishornot=1 and kind=1  and deleted=0  union all select id from stumytest  where userid='.$userid.' and finishornot=1 and kind=1  and deleted<>2 ');  
   	   $data=$Model->query('Select id,testid,exerciseid,lastreadtime,keyornot,nowtesttime,nowtestnum, case keyornot  when 0 then (select paper_name from paper_msg_data where id=a.testid) when 1 then (select paper_name from key_paper_msg_data where id=a.testid) end as paper_name,1 testkindnum,(select name from book_exercises where id=a.exerciseid) as bookname From  mytest as a  where userid='.$userid.' and finishornot=1 and kind=1  and deleted=0  union all select id,0 exerciseid,id as testid,lastreadtime,keyornot,nowtesttime,nowtestnum,paper_name,2 testkindnum,2 bookname from stumytest  where userid='.$userid.' and finishornot=1 and kind=1  and deleted<>2  order by lastreadtime desc LIMIT '.$startnum.','.$endnum);
    }
   
    if($operkind=='delete')
    {
       $datacount=$Model->query('Select id  From  mytest  where userid='.$userid.' and deleted=1 union all select id from stumytest  where userid='.$userid.' and deleted=1');  
   	   $data=$Model->query('Select id,testid,exerciseid,lastreadtime,keyornot,nowtesttime,nowtestnum, case keyornot  when 0 then (select paper_name from paper_msg_data where id=a.testid) when 1 then (select paper_name from key_paper_msg_data where id=a.testid) end as paper_name,1 testkindnum,(select name from book_exercises where id=a.exerciseid) as bookname From  mytest as a  where userid='.$userid.' and a.deleted=1  union all select id,0 exerciseid,id as testid,lastreadtime,keyornot,nowtesttime,nowtestnum,paper_name,2 testkindnum,2 bookname from stumytest as m  where userid='.$userid.' and m.deleted=1 order by lastreadtime desc LIMIT '.$startnum.','.$endnum);
    }
   
    $paper=M('paper_msg_data');
    $key=M('key_paper_msg_data');
   
   $j=$startnum+1;
   for($i=0;$i<sizeof($data);$i++)
   {
     
     $data[$i]['num']=$j;
     $j=$j+1;
     
     //计算各种的 试卷和知识点数量
     $data[$i]['papernum']=$paper->where('exerciseid='.$data[$i]['exerciseid'])->count();
     $data[$i]['keynum']=$key->where('exerciseid='.$data[$i]['exerciseid'])->count();
     
     if($data[$i]['testkindnum']==1)
     {
       if($data[$i]['keyornot']==1)
       {
         $data[$i]['testkind']='keyctb';
         $data[$i]['itemclass']='item_icon_03';
       }
       else
       {
          $data[$i]['testkind']='testctb';
          $data[$i]['itemclass']='item_icon_01';
       }
  	 }
    
     if($data[$i]['testkindnum']==2)
     {
       if($data[$i]['keyornot']==0)
       {
         $data[$i]['testkind']='seckeyctb';
         $data[$i]['itemclass']='item_icon_02';
       }
       else
       {
         $data[$i]['testkind']='sectestctb';
         $data[$i]['itemclass']='item_icon_04';
       }
  	 }
     
     if($operkind=='finish')
     {
        $data[$i]['time']= $data[$i]['nowtesttime'];
     }
     else
     {  
       //echo $data[$i]['lastreadtime'].'<br>';
        $data[$i]['time']= date('y-m-d',strtotime($data[$i]['lastreadtime']));
     }
     
     if($data[$i]['bookname']==2)
     {
       if($data[$i]['keyornot']==0)
       {
           $data[$i]['bookname']='个人错题本';
       }
       else
       {
           $data[$i]['bookname']='个人知识点错题本';
       }
     }
  }
  
   $count=sizeof($datacount);
   $returndata['count']=$count;
   $returndata['list']=$data;
   //print_r($returndata);
   echo json_encode($returndata);
 }
  
  public function operrf()
  {
     $ctbid=$_GET['ctbid'];
     $exerciseid=$_GET['exerciseid'];
     $dataname=$_GET['dataname'];
     $kind=$_GET['kind'];
     $operkind=$_GET['operkind'];
    
    if($dataname=='mytest')
    {
  		$Model=M('mytest');    
    }
    if($dataname=='stumytest')
    {
        $Model=M('stumytest');   
    }
    
    if($operkind=='del')
    {
      $data['deleted']=1;
      $Model->where('id='.$ctbid)->save($data);
      
    }
    
    if($operkind=='del0')
    {
      $data['deleted']=2;
      $Model->where('id='.$ctbid)->save($data);
      
    }
    if($operkind=='restore')
    {
      $data['finishornot']=0;
      $data['deleted']=0;
      $data['kind']=0;
      $data['lastreadtime']=date('y-m-d h:i:s',time());
      $Model->where('id='.$ctbid)->save($data);  
    }
    
    echo 1;
  }
  
  public function my_mailbox()
  {
     $userid=$_GET['userid'];
     $email=$_GET['email'];
     $model=M('weixin_users');
    
    $data['email']=$email;
    $msg=$model->where('id='.$userid)->save($data);
    
    echo $msg;
  }
  
  public function sendemail()
 {
 	
 	$email=$_GET['email'];
    $paper_name=$_GET['paper_name'];
    $userid=$_GET['userid'];
    $testkind=$_GET['testkind'];
    $testid=$_GET['testid'];
    $ctbid=$_GET['ctbid'];
 	$title=$paper_name;
    /*
    $email='151201050@qq.com';
    $paper_name='河西区2017-2018学年度第二学期八年级期末质量调研物理试卷(26)';
    $userid=15;
    $testkind='test';
    $testid='72';
    $ctbid='779';
    $title=$paper_name;
    */
    
    if($testkind=='test' || $testkind=='key')
    {
      $paperkind='init';
      $testkind=$testkind.'ctb';
    }
    else
    {
      $paperkind='ctb'; 
    }
    $testurl='http://file.hzjoo.com/index.php/home/Download/phpmanagepaperdetailpdf/';
    $testpdf=$testurl.'testid/'.$ctbid.'/inittestid/'.$testid.'/outkind/D/paper_name/'.$paper_name.'/testkind/'.$testkind.'/paperkind/'.$paperkind;
    
    //php_managepaperanswerpdf
    $answerurl='http://file.hzjoo.com/index.php/home/Download/php_managepaperanswerpdf/';
    $answerpdf=$answerurl.'testid/'.$ctbid.'/inittestid/'.$testid.'/outkind/D/paper_name/'.$paper_name.'/testkind/'.$testkind.'/paperkind/'.$paperkind;
 	$content='<div><span>Hi,同学</span><br><span>&nbsp;&nbsp;&nbsp;&nbsp;整理好你的错题，你就离胜利近了一步。加油！加油！</span><br><hr><span>'.$paper_name.'</span><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><a href="'.$testpdf.'">习题pdf</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><a href="'.$answerpdf.'">答案pdf</a><hr></div>';
    
   // echo $testpdf;
    
 	email($email,$title,$content);
    
    echo 1;
 }
  
  public function updata_remind()
  {
    $userid=$_GET['userid'];
    $semester_num=$_GET['semester_num'];
    $input_day=$_GET['input_day'];
    $last_semester=$_GET['last_semester'];
    $next_semester=$_GET['next_semester'];
    
   // $userid=15;
   // $semester_num=1;
   // $input_day=13;
   // $last_semester=17;
   // $next_semester=12;
    
    if($semester_num==0)
    {
      $data['input_day']=$input_day;
      $data['last_semester_a']=$last_semester;
      $data['next_semester_a']=$next_semester;
    }
    else
    {
      $data['input_day']=$input_day;
      $data['last_semester_b']=$last_semester;
      $data['next_semester_b']=$next_semester;
    }
    
    
    $model=M('weixin_users');
    
    echo $model->where('id='.$userid)->save($data);
    
    
    
  }
  
  
  public function oper_ctbdata_one()
  {
    $testkind=$_GET['testkind'];
    $ctbid=$_GET['ctbid'];
    $operkind=$_GET['operkind'];
    
    if($testkind=='testctb' || $testkind=='keyctb')
    {
      $model=M('mytest');
    }
    if($testkind=='sectestctb' || $testkind=='seckeyctb')
    {
      $model=M('stumytest');
    }
    
    if($operkind=='back')
    {
      $data['kind']=0; 
    }
    if($operkind=='finish')
    {
      $data['finishornot']=1;
    }
    if($operkind=='del')
    {
      $data['deleted']=1; 
    }
    
    echo $model->where('id='.$ctbid.' and kind=1')->save($data);
   
  }
  
  public function subjectmsg()
  {
    $model=M('subject_data');
    $data=$model->select();
    $middata[0]['id']=0;
    $middata[0]['subjectmsg']='全部';
    
    for($i=0;$i<sizeof($data);$i++)
    {
      $j=$i+1;
      $middata[$j]['id']=$data[$i]['id'];
      $middata[$j]['subjectmsg']=$data[$i]['subjectmsg'];
    }
    
    for($i=0;$i<sizeof($middata);$i++)
    {
      $subjectid[$i]=$middata[$i]['id'];
      $subjectmsg[$i]=$middata[$i]['subjectmsg'];
    }
    
    
    $newdata['id']=$subjectid;
    $newdata['subjectmsg']=$subjectmsg;
    
    echo json_encode($newdata);
    
  }
  
  
 
 
}