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
			} else {
				$info=$model->where("openid='".$openid."'")->find(); 
				$result['id']=$info['id'];
              	$result['st']=$info['st'];
              	$result['nd']=$info['nd'];
              	$result['rd']=$info['rd'];
                $result['nickName']=$info['nickname'];
			}
		}
      
		echo json_encode($result);
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
    	$Model=M();
    	if($keyword!='')
    	{
     	  $querymsg="select a.exerciseid,b.name,a.lastreadtime from mytest as a INNER JOIN book_exercises b on a.exerciseid=b.id where (a.userid=".$userid." and a.finishornot=0 and a.deleted=0 and b.name like '%".$keyword."%') group by a.exerciseid  order by a.lastreadtime desc  LIMIT ".$startnum.",".$pagesize;
          
          $countmsg="select count(a.id) from mytest as a INNER JOIN book_exercises b on a.exerciseid=b.id where (a.userid=".$userid." and a.finishornot=0 and a.deleted=0 and b.name like '%".$keyword."%') group by a.exerciseid";
          $count=$Model->query($countmsg);
        }
    	else
    	{
     	  $querymsg='select a.exerciseid,b.name,a.lastreadtime from mytest as a INNER JOIN book_exercises b on a.exerciseid=b.id where a.userid='.$userid.' and finishornot=0 and a.deleted=0 group by a.exerciseid  order by a.lastreadtime desc  LIMIT '.$startnum.','.$pagesize; 
            
          $countmsg="select count(id) from mytest  where (userid=".$userid." and finishornot=0 and deleted=0) group by exerciseid";
          $count=$Model->query($countmsg);
        }
        $exercise_data=$Model->query($querymsg);
         			
        $data=$Model->query('select c.id,c.testid,c.exerciseid,c.lastreadtime,c.keyornot,c.kind,m.name from mytest c INNER JOIN  ('.$querymsg.') d ON c.exerciseid=d.exerciseid,book_exercises m where c.exerciseid=m.id');
    	
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
   // $codemsg='<exercises_id>12302</exercises_id><code>abc3</code><kind>1</kind><status>1</status><name>习题册8</name>';
    //$userid=15;
    
    $codemsg=$_GET['code'];
    $userid=$_GET['userid'];
    
    $exercises_id=msg_cut_mid_part('<exercises_id>','</exercises_id>',$codemsg);
    $code=msg_cut_mid_part('<code>','</code>',$codemsg);
    $kind=msg_cut_mid_part('<kind>','</kind>',$codemsg);
    $status=msg_cut_mid_part('<status>','</status>',$codemsg);
    $name=msg_cut_mid_part('<name>','</name>',$codemsg);
   
    //$return_num 0 无效二维码。1 可用二维码 2，已经存在二维码
    
    //kind 1 一对一码。2 一对多码（可以变换的）
    
    $return_num=0;
    //状态可用
    if($status==1)
    {
      $data_code['codemsg']=$code;
      $data_num=$model_code->where($data_code)->count();     
      if($data_num>=1)
      {
        
        $data_mytest['userid']=$userid;
        $data_mytest['exerciseid']=$exercises_id;
        $data_num=$model_mytest->where($data_mytest)->count();
        
        if($data_num>=1)
        {
          $return_num=2;
        }
        else
        {
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
            $model_mytest->add($data_add);
          }
             
          $data_key_paper_msg_data['exerciseid']=$exercises_id;
          $data_result_key_paper_msg=$model_key_paper_msg_data->where($data_key_paper_msg_data)->select();
          $count=sizeof($data_result_key_paper_msg);
          for($i=0;$i<$count;$i++)
          {
            $data_key_add['userid']=$userid;
            $data_key_add['testid']=$data_result_key_paper_msg[$i]['id'];
            $data_key_add['creatime']=$data_add['creatime'];
            $data_key_add['lastreadtime']=$data_key_add['creatime'];
            $data_key_add['exerciseid']=$data_result_key_paper_msg[$i]['exerciseid'];
            $data_key_add['name']=$name;
            $data_key_add['kind']=0;
            $data_key_add['questionsum']=$data_result_key_paper_msg[$i]['questionsum'];
            $data_key_add['download']=1;
            $data_key_add['deleted']=0;    
            $data_key_add['orderid']=$data_result_key_paper_msg[$i]['orderid'];
            $data_key_add['keyornot']=1;
            $model_mytest->add($data_key_add);
          }
          $return_num=1;
        }
      }
      else
      {
         $return_num=0;
      }
    }
    else
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
    
    $model_book_exercises=M('book_exercises');
    $model_publish_name=M('publish_name');
    $model_mytest=M('mytest');

    
    $book_data['id']=$exerciseid;
    $data_book_exercises=$model_book_exercises->where($book_data)->find();
    $publishid=$data_book_exercises['publishid'];
    $data_publish=$model_publish_name->where('id='.$publishid)->find(); 
    $publishname=$data_publish['name'];
    $data_book_exercises['publishname']=$publishname;
    
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
    //$exerciseid=123;
    //$userid=15;
    //$keyornot=0;
    //$page=1;
    //$pagesize=4;
     
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
           	 if($data[$i]['shareornot']==0 && $buyornot==0)
             {
               $data[$i]['lock']='bottom_view_lock';
             }
           else
           {
              $data[$i]['lock']='';
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
          
            if($data[$i]['shareornot']==0  && $buyornot==0)
             {
               $data[$i]['lock']='bottom_view_lock';
             }
           else
           {
              $data[$i]['lock']='';
           }
          
          // $data[$i]['lock']='bottom_view_lock';
          
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
       // echo $maxpage;
     //print_r($result_data);
     echo json_encode($result_data);
    
    
    //print_r($data);
   // print_r($data_mytest);
    
   // echo $publishname;
   
    
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
    

    $Model = M();
     
    if($testkind=='test')
    {
   	$data=$Model->query('SELECT a.paper_name,a.testimage,a.answerimage,a.font_size,a.filesernum,b.id as test_id,b.srcid,b.pic1,b.pic2,b.pic3,b.pic4,b.ctbname,b.inputval,b.typeid,c.src as test_src,d.id as answer_id,d.src as answer_src FROM ((paper_msg_data a INNER JOIN test_public_data b on a.filesernum=b.filesernum) INNER JOIN img_cuted_data c on b.srcid=c.id)  INNER JOIN img_cuted_data d ON c.answerid=d.id where a.id='.$testid.' order by in_ser asc');   
    }
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
    //$testid=1555;
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
    }
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
    
    //1556 179 15
    
   // $ctbid=179;
   // $userid=15;
    
    $count=$model_mytest->where('id='.$ctbid.' and kind=1')->count();
    

    if($count==0)
    {
    $newdata['nowtesttime']=date('Y-m-d', strtotime ($st, strtotime(date("y-m-d",time()))));
    $msg=$model_mytest->where('id='.$ctbid)->save($newdata);
      
      
    $tnewdata['testid']=$ctbid;
    $tnewdata['status']=1;
    if($timeset==1)
    {
    		 $tnewdata['nowstatus']=1;
     		 $tnewdata['testkind']=$testkind;
   			 $tnewdata['testtime']=date("y-m-d",time());
   			 $tnewdata['lastreadtime']=date("ymd",time());
  			 $tnewdata['testtime']=date('Y-m-d', strtotime ($st, strtotime($tnewdata['testtime'])));     
 			 echo $model_testtime->add($tnewdata);
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
    		echo $model_testtime->add($tnewdata);   
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
    		echo $model_testtime->add($tnewdata);
    }
      
      echo 12;


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
    
    //$userid=15;
    
    $startnum=$_GET['startnum'];
    $endnum=$_GET['endnum'];
    
    //$startnum=0;
    //$endnum=4;  
      
      
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
    
    
    $data=$Model->query('Select id,testid,lastreadtime,keyornot,nowtesttime,nowtestnum, case keyornot  when 0 then (select paper_name from paper_msg_data where id=a.testid) when 1 then (select paper_name from key_paper_msg_data where id=a.testid) end as paper_name,1 testkindnum  From  mytest as a  where userid='.$userid.' and finishornot=0 and kind=1 union all select id,id as testid,lastreadtime,keyornot,nowtesttime,nowtestnum,paper_name,2 testkindnum from stumytest  where userid='.$userid.' and finishornot=0 and kind=1 order by nowtesttime asc LIMIT '.$startnum.','.$endnum);
    
    
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
    
 //   $testkind='testctb';
   // $userid=15;
   // $startnum=0;
   // $lengthnum=14;
    
    $testdata['userid']=$userid;
    $testdata['kind']=1;

    $Model=M();
    if($testkind=='testctb')
    {
       $keyornot=0;   
       $testdata['keyornot']=$keyornot;
       $Model_mytest=M('mytest');
       $allcount=$Model_mytest->where($testdata)->count(); 

      
       $data=$Model->query('select a.id as ctbid,b.paper_name as paper_name,b.id as testid,a.ctbtestid as ctbquestionid,a.typeidarr,a.nowtestnum,a.nowtesttime from mytest as a INNER JOIN paper_msg_data b on a.testid=b.id where a.userid='.$userid.' and a.keyornot='.$keyornot.' and a.kind=1 and a.deleted=0 order by a.nowtestnum asc limit '.$startnum.','.$lengthnum);   
    
    }
    
    if($testkind=='keyctb')
    {
       $keyornot=1;     
       $testdata['keyornot']=$keyornot;
       $Model_mytest=M('mytest');
       $allcount=$Model_mytest->where($testdata)->count();
      
       $data=$Model->query('select a.id as ctbid,b.paper_name as paper_name,b.id as testid,a.ctbtestid as ctbquestionid,a.typeidarr,a.nowtestnum,a.nowtesttime from mytest as a INNER JOIN key_paper_msg_data b on a.testid=b.id where a.userid='.$userid.' and a.keyornot='.$keyornot.' and a.kind=1 and a.deleted=0  order by a.nowtestnum asc limit '.$startnum.','.$lengthnum);  
    }
    
    if($testkind=='sectestctb')
    {
       $keyornot=0;
       $testdata['keyornot']=$keyornot;
       $Model_stumytest=M('stumytest');
       $allcount=$Model_stumytest->where($testdata)->count();
      
       $data=$Model->query('select id as ctbid,paper_name,ctbquestionid,typeidarr,nowtestnum,nowtesttime from stumytest as a  where userid='.$userid.' and keyornot='.$keyornot.' and kind=1  and deleted=0 order by lastreadtime asc limit '.$startnum.','.$lengthnum);  
    }
    
    if($testkind=='seckeyctb')
    {
       $keyornot=1;
      
       $testdata['keyornot']=$keyornot;
       $Model_stumytest=M('stumytest');
       $allcount=$Model_stumytest->where($testdata)->count();
      
       $data=$Model->query('select id as ctbid,paper_name,ctbquestionid,typeidarr,nowtestnum,nowtesttime from stumytest as a  where userid='.$userid.' and keyornot='.$keyornot.' and kind=1  and deleted=0 order by lastreadtime asc  limit '.$startnum.','.$lengthnum);    
    }
  
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
   

   
   $j=$startnum+1;
   for($i=0;$i<sizeof($data);$i++)
   {
     
     $data[$i]['num']=$j;
     $j=$j+1;
     
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
  
  public function del_ctbdata_one(){
    $testkind=$_GET['testkind'];
    $ctbid=$_GET['ctbid'];
    
    if($testkind=='testctb' || $testkind=='keyctb')
    {
      $Model=M('mytest');
    }
    
   if($testkind=='sectestctb' || $testkind=='seckeyctb')
    {
      $Model=M('stumytest');
    }
    
   $data['deleted']=1;
   $Model->where('id='.$ctbid)->save($data);  
    
    echo 1;
    
  }
 
 
}