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
		
		$country=$_GET['country'];
		$city=$_GET['city'];
		$province=$_GET['province'];
		$gender=$_GET['gender'];
		
		$model=M('weixin_users');
		
		$result=0;
		
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
				$result=$info['id'];
			}
		}
		echo $result;
	}
	
	public function task()
	{
		//mytest表内容分页
		$pagesize=5;
		$page=$_GET['page']?$_GET['page']:1;
		$begin=$page*$pagesize;
		$userid=$_GET['userid'];
 
		$exercise_name=$_GET['exercise_name']?$_GET['exercise_name']:'';
 
		
		$datalist=array();
		if($userid) {
			$mytest=M('mytest');
			$paper=M('paper_msg_data');
			$exercise=M('book_exercises');
 
			$datalist=$mytest->where('userid='.$userid.' and deleted=0')->limit(0,$begin)->order('id desc')->select();
 
			$count=$mytest->where('userid='.$userid)->count();
			foreach($datalist as $k=>&$v) {
				$tmp=$paper->find($v['testid']);
				$v['paper_name']=$tmp['paper_name'];
				$tmp_e=$exercise->find($v['exerciseid']);
				$v['exercise_name']='';
				$v['exercise_name']=$tmp_e['name'];
 
				if(!empty($exercise_name) && $exercise_name!=$tmp_e['name']) {
					unset($datalist[$k]);
				}
 
				$v['kk']==2;
				if(($k+1)%2==0) {
					$v['kk']==1;
				}
				
			}
		}
		
		//算出总页数
		$totalPage=0;
		$totalPage=ceil($count/$pagesize);
		
		//是否有下一页
		$hasNext=$nextpage=0;
		if($page<$totalPage) {
			$hasNext=1;
			$nextpage=$page+1;
		}
		
		$data=array();
		$data['haxNext']=$hasNext;
		$data['nextpage']=$nextpage;
		$data['list']=$datalist;
		$data['count']=count($datalist);
 
		$data['totalPage']=$totalPage;
		
		echo json_encode($data);
	}
	
	//删除
	public function del_task()
	{
		$taskid=$_GET['taskid'];
		
		$res=0;
 
		$data=array();
		if($taskid) {
			$mytest=M('mytest');
			$data['deleted']=1;
			$res=$mytest->where("id=".$taskid)->save($data);
		}
		echo $res;	
	}
	
 
 
}