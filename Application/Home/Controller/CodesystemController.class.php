<?php
namespace Home\Controller;

use Think\Controller;

class CodesystemController extends Controller
{
   public function Code_01()
   {
   	 $nowtime=date('Y-m-d');
  	 $this->assign('nowtime',$nowtime);
     $this->display();
   }
  
  
  public function phpaddCodeSub()
  {
  	$res=array();
  	
    $code_name=$_POST['code_name'];
    $code_note=$_POST['code_note'];
    $code_price=$_POST['price'];
    $end_time=$_POST['endtime'];
    $publishid=$_POST['publishid'];
    $exerciseid=$_POST['exerciseid'];
    $free_test_arr=$_POST['free_test_arr'];
    $free_key_arr=$_POST['free_key_arr'];
    $codeid=$_POST['codeid'];
    
    //处理下字符串
    
    $data['price']=$code_price;
    $data['codename']=$code_name;
    $data['codenote']=$code_note;
    $data['kind']=2;
    $data['status']=1;
    $data['creattime']= date("Y-m-d h:i:s");
    $data['endtime']= $end_time;
    $data['userednum']=0;
    $data['publishid']=$publishid;   
    $data['exercises_id']=$exerciseid;
    $data['free_test_arr']=$free_test_arr;
    $data['free_key_arr']=$free_key_arr;
     
    $Model=M('code_msg');
    
    $Model_publish_name=M('publish_name');
    
    $Model_publish_name->where('id='.$publishid)->setInc('sum');
    if($codeid) {
    	$data['id']=$codeid;
    	$Model->save($data);
    } else {
    	//校验下 pid和eid必须唯一
 		$codeinfo=$Model->where('publishid='.$data['publishid'].' and exercises_id='.$data['exercises_id'])->find();
 		if(empty($codeinfo)) {
 			$res['codemsg']=$data['codemsg']=number();
    		$res['codeid']=$Model->add($data);
 		} else {
 			$data['id']=$codeinfo['id'];
 			$Model->save($data);
 			$res['codemsg']=$codeinfo['codemsg'];
    		$res['codeid']=$data['id'];
 		}
    }
    echo json_encode($res);
  }
  
  //出版社无刷新加载列表和搜索
  public function php_publish_sql()
  {
  	$nowpage=$_POST['nowpage'];
  	$pagelength=$_POST['pagelength'];
  	$keywords=$_POST['keywords'];
  	
  	 
  	$beginnum=($nowpage-1)*$pagelength+1;
  	$beginpagenum=$beginnum-1;
  	
  	$model=M('publish_name');
  	$code=M('code_msg');	 
  	
  	$dataarr=array();
  	!empty($keywords) && $dataarr['name']=['like',"%".$keywords."%"];
  	$count=$model->where($dataarr)->count();
  	$data=$model->where($dataarr)->order('createtime desc')->limit($beginpagenum.','.$pagelength)->select();
  	foreach($data as $k=>&$v) {
  		$v['num']=$beginnum;
  		$beginnum=$beginnum+1;
   		
  		//统计出版社绑定的二维码数量
  		$v['codenum']=$code->where('publishid='.$v['id'])->count();
  	}
  	
  	
  	$data['length']=sizeof($data);
  	$data['pagelength']=$pagelength;
  	$data['count']=$count;
  	 
  	$data['pagenum']=ceil($count/$pagelength);
  	echo json_encode($data);
  	
  }

  //试题列表
  public function php_exercise_sql()
  {
  	$nowpage=$_POST['nowpage'];
  	$pagelength=$_POST['pagelength'];
  	$keywords=$_POST['keywords'];
  	$publishid=$_POST['publishid'];
  	
  	 
  	$beginnum=($nowpage-1)*$pagelength+1;
  	$beginpagenum=$beginnum-1;
  	
  	$model=M('book_exercises');
  	$publish=M('publish_name');
  	
  	$paper=M('paper_msg_data');
  	$key=M('key_paper_msg_data');
  	 
  	$dataarr=array();
  	!empty($keywords) && $dataarr['name']=['like',"%".$keywords."%"];
  	 
  	//查找出版社的名字
  	if($publishid) {
  		$dataarr['publishid']=array('in',$publishid);
  	}  
  	
  	
  	$count=$model->where($dataarr)->count();
  	$data=$model->where($dataarr)->order('createtime desc')->limit($beginpagenum.','.$pagelength)->select();
  	foreach($data as $k=>&$v) {
  		$v['num']=$beginnum;
  		$beginnum=$beginnum+1;
  		
  		//计算各种的 试卷和知识点数量
  		$v['papernum']=$paper->where('exerciseid='.$v['id'])->count();
  		$v['keynum']=$key->where('exerciseid='.$v['id'])->count();
  		
  	}
  	
  	
  	$data['length']=sizeof($data);
  	$data['pagelength']=$pagelength;
  	$data['count']=$count;
  	
  	//获取出版社数据
  	if($publishid) {
  		$tmp=$publish->find($publishid);
  		$data['publishname']=$tmp['name'];
  	}
  	 
  	$data['pagenum']=ceil($count/$pagelength);
  	echo json_encode($data);
  }
  
  //普通二维码页面
  public function Code_02()
  {
  	$nowtime=date('Y-m-d');
  	
  	$this->assign('nowtime',$nowtime);
  	$this->display();
  }
  
  //二维码列表
  public function phpcodeList()
  {
    //$publishid=10;
 	$nowpage=$_POST['nowpage'];
  	$pagelength=$_POST['pagelength'];
  	$keywords=$_POST['keywords'];
  	$publishid=$_POST['publishid'];   
  	
  	$beginnum=($nowpage-1)*$pagelength+1;
  	$beginpagenum=$beginnum-1;
 
  	 
  	$dataarr=array();
  	!empty($keywords) && $dataarr['codename']=['like',"%".$keywords."%"];
 	!empty($publishid) && $dataarr['publishid']=$publishid;
 
  	$publish=M('publish_name');
  	$model=M('code_msg');
    $count=$model->where($dataarr)->count();
  	$data['list']=$model->where($dataarr)->order('creattime desc')->limit($beginpagenum.','.$pagelength)->select();
   
  	
  	
  	$data['length']=sizeof($data['list']);
  	$data['pagelength']=$pagelength;
  	$data['count']=$count;
  	
  	//获取出版社数据
  	if($publishid) {
  		$tmp=$publish->find($publishid);
  		$data['publishname']=$tmp['name'];
  	}
  	 
  	$data['pagenum']=ceil($count/$pagelength);
  	
    echo json_encode($data);
  }
  //
    public function phpexerciseList()
  {
    //$publishid=10;
    $publishid=$_POST['publishid'];
    $Model=M('');
    $data=$Model->query('select * from book_exercises where publishid='.$publishid.' order by createtime desc');
    $data['count']=sizeof($data);
    echo json_encode($data);
  }
  
  
  //习题册对应的试卷和知识点
  public function detailexerciseinfo()
  {
  	$res=array();
  	$exerciseid=$_POST['exerciseid'];
  	
  	$paper=M('paper_msg_data');
  	$key=M('key_paper_msg_data');
  	$model=M('book_exercises');
  	
  	//计算各种的 试卷和知识点数量
  	$res['paperlist']=$paper->where('exerciseid='.$exerciseid)->select();
  	$res['papernum']=$paper->where('exerciseid='.$exerciseid)->count();
  	$res['keylist']=$key->where('exerciseid='.$exerciseid)->select();
  	$res['keynum']=$key->where('exerciseid='.$exerciseid)->count();
  	$res['exerciseinfo']=$model->find($exerciseid);
 
  	echo json_encode($res);
  }

  //二维码信息
  public function detailcodemsg()
  {
  	$res=array();
  	$publishid=$_POST['publishid'];
  	$exerciseid=$_POST['exerciseid'];
  	$code=M('code_msg');
  	
  	$res=$code->where('publishid='.$publishid.' and exercises_id='.$exerciseid)->find();
 
  	echo json_encode($res);
  }
  
  //根据ID获得二维码信息
  public function detailexercisebycodeid()
  {
  	$res=array();
 	$codeid=$_POST['codeid'];
  	$code=M('code_msg');
  	$exercise=M('book_exercises');
  	
  	$info=$code->find($codeid);
  	if($info['exercises_id']) {
  		$res=$exercise->find($res['exercises_id']);
  	}
 
  	echo json_encode($res);
  }
  
  //单个选中试题信息
  public function phpChooseExercise()
  {
    $exerciseid=$_POST['exerciseid'];
    
   // $exerciseid=123;
    
    $paper=M('paper_msg_data');
  	$key=M('key_paper_msg_data');
    
   	$res['test_num']=$paper->where('exerciseid='.$exerciseid)->count();
  	$res['key_num']=$key->where('exerciseid='.$exerciseid)->count();
    
   echo json_encode($res);  
  }
  
  //二维码下载
  public function downloadcode()
  {
  	$id=$_GET['codeid'];
  	downloadcode($id);
  }
  
  public function phpupdatacode()
  {
    $codeid=$_POST['codeid'];
    $exerciseid=$_POST['exerciseid'];
    $test_arr=$_POST['test_arr'];
    $key_arr=$_POST['key_arr'];
    
   // $codeid=19;
   // $exerciseid=123;
   // $test_arr='1554,1555,1557';
   // $key_arr='1,25,27';
    
    $Model_code_msg=M('code_msg');
    $data=$Model_code_msg->where('id='.$codeid)->find();  
    
    
    //`codename`, `codenote`, `free_test_arr`, `free_key_arr`, `userednum`, `price`, `publishdate`, `nownum`
    
    
    $data['publishdate']=$data['publishdate'].','.date("Y-m-d");
    $data['free_test_arr']= $data['free_test_arr'].'#'.$test_arr;    
    $data['free_key_arr']= $data['free_key_arr'].'#'.$key_arr;
    $data['userednum']= $data['userednum'].','.'0';
    $data['nownum']= $data['nownum']+1;
    
    
    $Model_code_msg->where('id='.$codeid)->save($data);
    
   echo 1; 
    
  }
  
  
 
  
 
}