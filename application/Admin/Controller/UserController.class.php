<?php
namespace Admin\Controller;
use Common\Controller\AdminbaseController;
class UserController extends AdminbaseController{
	protected $users_model,$role_model;
	
	function _initialize() {
		parent::_initialize();
		$this->users_model = D("Common/Users");
		$this->role_model = D("Common/Role");
	}
	function index(){
		
		$orgid=$_GET['orgid'];
		if(empty($orgid)){
			
			$this->error("组织id传递失败！");
		}
		$org_user_viewmodel=D("OrgUserView");//用户组织视图
		$map['ORG_ID']=array('eq',$orgid);
		$map['identify']=array('in','1,2,0');//禁用，管理，超级管理员都显示
        $count=$org_user_viewmodel->where($map)->count();
        $page = $this->page($count, 9);
        $users=$org_user_viewmodel
        ->where($map)
    	->order("createtime DESC")
        ->limit($page->firstRow.','.$page->listRows)
        ->select();
        $this->assign('users',$users);
        $this->assign("page",$page->show('Admin'));
        $this->assign('orgid',$orgid);
		/*
		$count=$this->users_model->where(array("user_type"=>1))->count();
		$page = $this->page($count, 9);
		$users = $this->users_model
		->where(array("user_type"=>1))
		->order("create_time DESC")
		->limit($page->firstRow . ',' . $page->listRows)
		->select();
		
		$roles_src=$this->role_model->select();
		$roles=array();
		foreach ($roles_src as $r){
			$roleid=$r['id'];
			$roles["$roleid"]=$r;
		}
		$this->assign("page", $page->show('Admin'));
		$this->assign("roles",$roles);
		$this->assign("users",$users);*/
		$this->assign("orgid",$orgid);
		$this->display();
	}
	
	
	function add(){//后台添管理员获取角色列表
		$orgid=$_GET['orgid'];
		
		$roles=$this->role_model->where("status=1")->order("id desc")->select();
		$this->assign("roles",$roles);
		$this->assign("orgid",$orgid);//传递前台
		$this->display();
	}
	
	function add_post(){//执行添加管理员
		if(IS_POST){
			if(!empty($_POST['user_login'])){
				if(!empty($_POST['role_id']) && is_array($_POST['role_id'])){
					$username=$_POST['user_login'];
					$orgid=$_GET['orgid'];//传入组织id
					if(empty($orgid)){
						$this->error("传入组织id失败！");
					}
					$org_user_viewmodel=D("OrgUserView");
					$where['user_login']=$username;
					$where['ORG_ID']=$orgid;

					$fd=$org_user_viewmodel->where($where)->find();//根据用户名和所在组织获取用户id
					if($fd!==false){
						if($fd['identify']==1||$fd['identify']==2||$fd['identify']==0){
							
							$this->error("该用户已经是管理员，您可以返回修改该用户权限。");
						}
						$org_user_viewmodel->where($where)->setField('identify',2);//设置身份为管理员
						$role_ids=$_POST['role_id'];
						unset($_POST['role_id']);
	
						$role_user_model=M("RoleUser");
						foreach ($role_ids as $role_id){
							$role_user_model->add(array("role_id"=>$role_id,"user_id"=>$fd['user_id'],"ORG_ID"=>$orgid));
							}
						$this->success("添加成功！", U("user/index",array('orgid'=>$orgid)));

					}else{
						$this->error("您输入的用户不存在！");
					}
				}else{
					$this->error("请为此用户指定角色！");
				}
			}else{
					$this->error("请输入用户名！");
			}
		}
	}
	
	
	function edit(){
		$orgid=$_GET['orgid'];
		$uid= intval(I("get.uid"));
		
		$roles=$this->role_model->where("status=1")->order("id desc")->select();
		$this->assign("roles",$roles);
		
		$role_user_model=M("RoleUser");
		$where['user_id']=$uid;
		$where['ORG_ID']=$orgid;
		$role_ids=$role_user_model->where($where)->getField("role_id",true);
		$this->assign("role_ids",$role_ids);
			
		//$user=$this->users_model->where(array("id"=>$id))->find();
		$this->assign("uid",$uid);//还是要加上第一个参数的
		$this->assign("orgid",$orgid);
		$this->display();
	}
	
	function edit_post(){
		if (IS_POST) {
			if(!empty($_POST['role_id']) && is_array($_POST['role_id'])){
				
				$role_ids=$_POST['role_id'];
				unset($_POST['role_id']);

				$uid=intval($_POST['uid']);
				$orgid=$_GET['orgid'];
				
				$role_user_model=M("RoleUser");
				$where['user_id']=$uid;
				$where['ORG_ID']=$orgid;
				$role_user_model->where($where)->delete();
						
				foreach ($role_ids as $role_id){
					$role_user_model->add(array("role_id"=>$role_id,"user_id"=>$uid,"ORG_ID"=>$orgid));
				}
				$this->success("保存成功！");


			}else{
				$this->error("请为此用户指定角色！");
			}
			
		}
	}
	
	/**
	 *  删除
	 */
	function delete(){
		$uid = intval(I("get.uid"));
		$orgid=I("get.orgid");
		$identify=I("get.identify");
		if($identify==1){
			$this->error("最高管理员不能删除！");
		}
		$where['user_id']=$uid;
		$where['ORG_ID']=$orgid;
		$role_user_model=M("RoleUser");
		$user_org_model=M("UserOrg");
		$user_org=$user_org_model->where($where)->setField('identify',3);//还原为普通用户身份
		$user_role=$role_user_model->where($where)->delete();
		
		if ($user_org!==false ) {
			if($user_role!==false){
				$this->success("删除成功，管理员成功降级为普通用户！");
			}else{
				$this->error("管理员成功降级为普通用户，但数据未清除！");
			}

		} else {
			$this->error("删除失败！");
		}
	}
	
	
	function userinfo(){
		$id=get_current_admin_id();
		$user=$this->users_model->where(array("id"=>$id))->find();
		$this->assign($user);
		$this->display();
	}
	
	function userinfo_post(){
		if (IS_POST) {
			$_POST['id']=get_current_admin_id();
			$create_result=$this->users_model
			->field("user_login,user_email,last_login_ip,last_login_time,create_time,user_activation_key,user_status,role_id,score,user_type",true)//排除相关字段
			->create();
			if ($create_result) {
				if ($this->users_model->save()!==false) {
					$this->success("保存成功！");
				} else {
					$this->error("保存失败！");
				}
			} else {
				$this->error($this->users_model->getError());
			}
		}
	}
	
	    function ban(){
        $id=intval($_GET['id']);
    	if ($id) {
			$user_org_model=M("UserOrg");
			$where['id']=$id;
			$rst=$user_org_model->where($where)->setField('identify',0);
    		if ($rst) {
    			$this->success("管理员停用成功！");//ajax提交，没有必要跳转
    		} else {
    			$this->error('管理员停用失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }
    
    function cancelban(){
    	$id=intval($_GET['id']);
    	if ($id) {
			$user_org_model=M("UserOrg");
			$where['id']=$id;
			$rst=$user_org_model->where($where)->setField('identify',2);
			/*2是普通管理员,查看其拥有的角色时需要对照用户角色表*/
    		if ($rst) {
    			$this->success("管理员启用成功！");//ajax提交，没有必要跳转
    		} else {
    			$this->error('管理员启用失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }
	
	
	
}