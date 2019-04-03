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
		
		if($openid && $nickName) {
			//校验数据
			$count=$model->where("openid='".$openid."'")->count();
			if($count==0) {
				$result=$model->add($data);
			}
		}
		echo $result;
	}
}