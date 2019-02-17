<?php
namespace Home\Controller;
use Think\Controller;
use Think\Image;
//use vendor\crop;

class DownloadController extends Controller
{
   public function index()
   {
   	/*
	班级原始错题 `mytest
	个人班级错题 stumytest
	知识点习题，知识点错题：key_stumytest
	个人知识点错题：stumytest
	我想想加上未处理的总数
	paper_msg_data
	*/
     $userid=cookie('userid');
     $realname=cookie('realname');
     
     $model=M('mytest');
     
   	if(!empty($userid)) {
       
     
	     //未完成习题数和总数
		 $undownload=$model->where('download=1 and userid='.$userid)->count();
		 $downloadcont=$model->where('download=2 and userid='.$userid)->count();
		 $mytesttotalInfo="(".$undownload."|".$downloadcont.")";
	 
		 //个人班级错题
		 $stu=M('stumytest');
		 $stuun=$stu->where('download=1 and userid='.$userid.' and testkind=0')->count();
		 $studo=$stu->where('download=2 and userid='.$userid.' and testkind=0')->count();
		 $stutotalInfo="(".$stuun."|".$studo.")";
		 
		 //知识点习题
		 $stumy=M('key_stumytest');
		 $stumyun=$stumy->where('download=1 and userid='.$userid.' and kind=0')->count();
		 $stumydo=$stumy->where('download=2 and userid='.$userid.' and kind=0')->count();
		 $stumytotalInfo="(".$stumyun."|".$stumydo.")";
		 
		 //知识点错题
		 $stumy=M('key_stumytest');
		 $unmistakes=$stumy->where('download=1 and userid='.$userid.' and kind=1')->count();
		 $mistakesdo=$stumy->where('download=2 and userid='.$userid.' and kind=1')->count();
		 $mistakestotalInfo="(".$unmistakes."|".$mistakesdo.")";
		 
		 //个人知识点错题
		 $stu=M('stumytest');
		 $peryun=$stu->where('download=1 and userid='.$userid.' and testkind=1')->count();
		 $perydo=$stu->where('download=2 and userid='.$userid.' and testkind=1')->count();
		 $pertotalInfo="(".$peryun."|".$perydo.")";
   	 }
     $this->assign('userid',$userid);
     $this->assign('realname',$realname);
     $this->assign('mytesttotalInfo',$mytesttotalInfo);
     $this->assign('stutotalInfo',$stutotalInfo);
     $this->assign('stumytotalInfo',$stumytotalInfo);
     $this->assign('mistakestotalInfo',$mistakestotalInfo);
     $this->assign('pertotalInfo',$pertotalInfo);
     $this->display();
   }
  
   public function phpdata()
   {
   	  $userid=$_POST['userid'];
      $nowpage=$_POST['nowpage'];
      $pagelength=$_POST['pagelength'];
      $kind=$_POST['kind'];
      $newsubjectid=$_POST['subjectid'];
      $grade=$_POST['grade'];
      $download=$_POST['download'];
        
      $beginnum=($nowpage-1)*$pagelength+1;
      $beginpagenum=$beginnum-1;
      
      if(empty($userid)) {
      	echo 0;exit;
      }
      
      //班级原始错题
      if($kind==1) {
	      $model=M('mytest');
	      $paper=M('paper_msg_data');
	      
	      $dataarr=array();
	      $dataarr['userid']=$userid;
	      !empty($download)  && $dataarr['download']=$download;
	
	      $count=$model->where($dataarr)->count();
	      
	      if(!empty($newsubjectid) || !empty($grade)) {
	      	$list=$model->where($dataarr)->order('creatime desc')->select();
	      	foreach($list as $k=>&$v) {
	      		$info=$paper->find($v['testid']);
		      	if(!empty($grade) && $info['gradeid']!=$grade) {
		      		unset($list[$k]);
		      		continue;
		      	}
		        if(!empty($newsubjectid) && $info['subjectid']!=$newsubjectid) {
		      		unset($list[$k]);
		      		continue;
		      	 
		      	}
	      	}
	      	$count=sizeof($list);
	      }
	      $data=$model->where($dataarr)->order('creatime desc')->limit($beginpagenum.','.$pagelength)->select();
	 
	      foreach($data as $k=>&$v) {
	      	$info=$paper->find($v['testid']);
	      	if(!empty($grade) && $info['gradeid']!=$grade) {
	      		unset($data[$k]);
	      		//$count=$count-1;
	      		continue;
	      	}
	        if(!empty($newsubjectid) && $info['subjectid']!=$newsubjectid) {
	      		unset($data[$k]);
	      		//$count=$count-1;
	      		continue;
	      	 
	      	}
	      	$v['wrongsum']=substr_count($v['ctbtestid'],',')+1;
	      	$v['paper_name']=$info['paper_name']."(".$v['wrongsum'].")";
	      	$v['num']=$beginnum;
	      	$beginnum=$beginnum+1;
	      }
	      
	       $data=array_slice($data, 0);
	      
      }
      
       //个人班级错题
      if($kind==2) { 
      	$stu=M('stumytest');
      	
      	$dataarr=array();
	    $dataarr['userid']=$userid;
	    $dataarr['testkind']=0;
	    !empty($download)  && $dataarr['download']=$download;
	    !empty($newsubjectid) && $dataarr['subjectid']=$newsubjectid;
		$count=$stu->where($dataarr)->count();
		$data=$stu->where($dataarr)->order('creatime desc')->limit($beginpagenum.','.$pagelength)->select();
		foreach($data as $k=>&$v) {
		 	$v['num']=$beginnum;
	      	$beginnum=$beginnum+1;
	    }
      }
      
     //知识点习题
      if($kind==3) {
	  	$model=M('key_stumytest');
	    $note=M('onekeynote');
	      
	    $dataarr=array();
	    $dataarr['userid']=$userid;
	    $dataarr['kind']=0;
	    !empty($download)  && $dataarr['download']=$download;
	
	    $count=$model->where($dataarr)->count();
	      
	    if(!empty($newsubjectid) || !empty($grade)) {
	    	$list=$model->where($dataarr)->order('creatime desc')->select();
	    	foreach($list as $k=>&$v) {
		    	$info=$note->find($v['keynote_id']);
				if(!empty($grade) && $info['gradeid']!=$grade) {
					unset($list[$k]);
					continue;
				}
				if(!empty($newsubjectid) && $info['subjectid']!=$newsubjectid) {
				unset($list[$k]);
				continue;
				}
	    	}
	    	$count=sizeof($list);
	    }
	    
	    $data=$model->where($dataarr)->order('creatime desc')->limit($beginpagenum.','.$pagelength)->select();
	 
	    foreach($data as $k=>&$v) {
	    	$info=$note->find($v['keynote_id']);
	    	if(!empty($grade) && $info['gradeid']!=$grade) {
	    		unset($data[$k]);
	    		continue;
	    	}
	    	if(!empty($newsubjectid) && $info['subjectid']!=$newsubjectid) {
	    		unset($data[$k]);
	    		continue;
	    	}
	    $v['num']=$beginnum;
	    $beginnum=$beginnum+1;
	    }
	      
	    $data=array_slice($data, 0);
	      
      }
      
    //知识点错题
      if($kind==4) {
	  	$model=M('key_stumytest');
	    $note=M('onekeynote');
	      
	    $dataarr=array();
	    $dataarr['userid']=$userid;
	    $dataarr['kind']=1;
	    !empty($download)  && $dataarr['download']=$download;
	
	    $count=$model->where($dataarr)->count();
	      
	    if(!empty($newsubjectid) || !empty($grade)) {
	    	$list=$model->where($dataarr)->order('creatime desc')->select();
	    	foreach($list as $k=>&$v) {
		    	$info=$note->find($v['keynote_id']);
				if(!empty($grade) && $info['gradeid']!=$grade) {
					unset($list[$k]);
					continue;
				}
				if(!empty($newsubjectid) && $info['subjectid']!=$newsubjectid) {
				unset($list[$k]);
				continue;
				}
	    	}
	    	$count=sizeof($list);
	    }
	    
	    $data=$model->where($dataarr)->order('creatime desc')->limit($beginpagenum.','.$pagelength)->select();
	 
	    foreach($data as $k=>&$v) {
	    	$info=$note->find($v['keynote_id']);
	    	if(!empty($grade) && $info['gradeid']!=$grade) {
	    		unset($data[$k]);
	    		continue;
	    	}
	    	if(!empty($newsubjectid) && $info['subjectid']!=$newsubjectid) {
	    		unset($data[$k]);
	    		continue;
	    	}
	    $v['num']=$beginnum;
	    $beginnum=$beginnum+1;
	    }
	      
	    $data=array_slice($data, 0);
	      
      }
      
      //个人知识点错题
      if($kind==5) { 
      	$stu=M('stumytest');
      	
      	$dataarr=array();
	    $dataarr['userid']=$userid;
	    $dataarr['testkind']=1;
	    !empty($download)  && $dataarr['download']=$download;
	    !empty($newsubjectid) && $dataarr['subjectid']=$newsubjectid;
		$count=$stu->where($dataarr)->count();
		$data=$stu->where($dataarr)->order('creatime desc')->limit($beginpagenum.','.$pagelength)->select();
		foreach($data as $k=>&$v) {
		 	$v['num']=$beginnum;
	      	$beginnum=$beginnum+1;
	    }
      }
  	 
      $data['length']=sizeof($data);
      $data['pagelength']=$pagelength;
      $data['count']=$count;
   
      $data['pagenum']=ceil($count/$pagelength);
           // $data['kind']=$kind;
      echo json_encode($data);
   }
   
   public function logout()
   {
   		cookie('userid',null);
   		cookie('realname',null);
	 	echo 1;
   }
   
  public function loadsubphp()
  {

     $username=$_POST['username'];
     $pwd=$_POST['pwd'];
    
     $model=M('user_data');
     $data=$model->where(array('username'=>$username,'pwd'=>$pwd,'kind'=>'1'))->find();
    // $id=$data[id];
    // $realname=$data[realname];
    
    // print_r($data);
    

     if($data[id]>0)
     {
	 	cookie('userid',$data[id],60*60*24*7);
	 	cookie('realname',$data[realname],60*60*24*7);
		echo json_encode($data);
     }else{
       echo 0;
    }
    
  }
  
  
}