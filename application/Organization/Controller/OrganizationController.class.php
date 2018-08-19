<?php
namespace Organization\Controller;
use Common\Controller\HomeBaseController;
class OrganizationController extends HomeBaseController{
	
	//coded by liu
	
	function _initialize() {

		parent::_initialize();
		$this->check_login();/*检查是否登陆*/
		$this->check_user();/*检查用户身份禁用或未激活*/
		//$this->_model=D("Organization");
	}

	function index(){

   		//$this->display();
		
	}
/***************创建组织*****************************************/
	function create(){
        //if(!sp_check_verify_code()){
        //  $this->error("验证码错误！"); //by liu 开发阶段省去验证码输入
        //}
        if(IS_POST)//是否仍要加用户登录判断
        {
            $data=I('post.');
            $reback=D('Organization')->tocreate($data);
                   // $this->error($Abspath);
            if($reback['status']=='1')//注册组织成功
            {
                $this->success($reback['info'],U("User/st/likest"),'5');

            }else{
                $this->error($reback);
                }

        }
        else{
			$this->display();
        }

		
	}
	function allorguser(){
		$stid=$_GET['stid'];
		if(!isset($stid)){
			$this->error("获取组织参数失败！");
		}
		$org_user_viewmodel=D("OrgUserView");//用户组织视图
		$map['ORG_ID']=array('eq',$stid);
		//$map['identify']=array('in','1,2,0');//禁用，管理，超级管理员都显示
		$count=$orgusers=$org_user_viewmodel->where($map)->count();

        $orgusers=$org_user_viewmodel
        ->where($map)
    	->order("createtime DESC")
        ->select();
        $this->assign('orguser',$orgusers);
        $this->assign('orgusercount',$count);
    	$this->display();
	}
	function detailorguser(){
		$id=$_GET['id'];
		//$id=15;
		if(!isset($id)){
			$this->error("用户id获取失败！");
		}
		$org_user_viewmodel=D("OrgUserView");

		$where['id']=$id;
		$data=$org_user_viewmodel->where($where)->find();
		if(empty($data)){
			$this->error("获取用户数据失败");

		}
		$allpicture=$data['picture'];
        $picture=explode('+', $allpicture);
        $count=count($picture);
        $this->assign('count',$count);
        $this->assign('orgid',$data['org_id']);
        $this->assign('data',$data);
        $this->assign('picture',$picture);
		//$relpath='activityshow/'.$orgid.'/'.$siglepics[0];
		$this->display();
	}

	function doapply(){ /*提交申请*/
		if(IS_POST){
			$orgid=$_GET['orgid'];
			/*$orgid=2;*/
			if(empty($orgid)){
				$this->error("组织id传递失败！");
			}
			$userid=sp_get_current_userid();
			if(empty($userid)){
				$this->error("用户id获取失败！");
			}
			$user_orgmodel=D('UserOrg');
			$user_register_model=D('UserRegister');
			$where['user_id']=$userid;
			$where['ORG_ID']=$orgid;
			$join=$user_orgmodel->where($where)->find();
			if(!empty($join)){
				$info=array(
					'statu'=>0,
					'info'=>"您已经是该组织成员，请勿重复添加！",
					);
				$this->Ajaxreturn($info);

			}
			$fd=$user_register_model->where($where)->find();
			if(!empty($fd)){
				$info=array(
					'statu'=>0,
					'info'=>"您已经提交了申请，请勿重复提交！",
					);
				$this->Ajaxreturn($info);
			}else{
			$user_model=M('Users');
			$result=$user_model->where("id=$userid")->field('id',true)->find();
			if(!empty($result)){
				
				$result['ORG_ID']=$orgid;
				$result['user_id']=$userid;
				$result['createtime']=time();
				$result['whyjoin']=I('post.whyjoin');
				$user_register_model->add($result);
				$info=array(
					'statu'=>1,
					'info'=>"申请提交成功,等待该组织管理员处理！",
					);
				$this->Ajaxreturn($info);
				}
			}
	  	}else{

	  		if(empty($_SESSION['user'])){ /*申请加入组织前判断是否登陆*/
	  			 $this->error("您还未登录！！！",U("user/login/index"));
			
				}
	  		$orgid=$_GET['orgid'];
			/*$orgid=2;*//*保留接口*/
	        $org_model=D('Organization');
	        $result=$org_model->where("id=$orgid")->find();
	        //dump($result);
	        $this->assign('orgid',$orgid);
	        $this->assign('info',$result);
	  		$this->display();
	  		}

	}
	function updateorguser(){
		if(IS_POST){
			//dump($_GET['id']);
			$id=$_GET['id'];
			if(empty($id)){//未获取id
				 $this->error("user参数传递失败！");
			}
			$stid=$_GET['stid'];
			if(empty($stid)){
				$this->error("组织获取失败！！！");
			}
			$newpic=I('post.picture');
			$newsiglepic=explode('+', $newpic);
			$newcount=count($newsiglepic);
			$uploadpath='data/upload/orguser/'.$stid;
			$user_orgmodel=D('UserOrg');
			if ($user_orgmodel->create()) {
				$oldpicture=$user_orgmodel->where("id=$id")->getField('picture');
				/*如果更新了图片，删除老图片*/
				if($oldpicture!==$newpic){
					if(!file_exists($uploadpath)){
						mkdir($uploadpath);
					}
					$oldsiglepic=explode('+',$oldpicture);
					$oldcount=count($oldsiglepic);						
					for($temp=0;$temp<$oldcount;$temp++){
						$Abspath=$uploadpath.'/'.$oldsiglepic[$temp];
						//dump($Abspath);
						unlink($Abspath);
					}
					/******************************************************************/
					/*先将图片上传的公共缓存区，在这里将图片从缓存区移动到保存区*/
					for($temp=0;$temp<$newcount;$temp++){

						$Abspath=$uploadpath.'/'.$newsiglepic[$temp];
						//dump($Abspath);
						$cachepath='data/upload/orguser/upload_cache/'.$newsiglepic[$temp];
						copy($cachepath,$Abspath);
						unlink($cachepath);
					}
				}
				if ($user_orgmodel->save()!==false) {

					$this->success("更新成功！");
				}else{
					$this->error("更新失败！");
				}
			}else{
				for($temp=0;$temp<$newcount;$temp++){
					$cachepath='data/upload/orguser/upload_cache/'.$newsiglepic[$temp];
					unlink($cachepath);
				}
				$this->error($user_orgmodel->getError());
			}

		}else{
			$stid=$_GET['stid'];
			/*$orgid=2;*//*保留组织id接口*/
			$userid=sp_get_current_userid();
			//dump($userid);
			if(empty($stid)){
				$this->error("参数获取失败！！！");
			}

			//session('orgid',$orgid);
			$org_user_viewmodel=D("OrgUserView");//用户组织视图
			$where['user_id']=$userid;
			$where['ORG_ID']=$stid;/*用户当前所在的组织*/
			$result=$org_user_viewmodel->where($where)->find();
			if(empty($result)){
				$this->error("组织无该用户！！！");
			}
			$this->assign($result);
			$this->assign('stid',$stid);
			$this->display();
		}
	}
	
}