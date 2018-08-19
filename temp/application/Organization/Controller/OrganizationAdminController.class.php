<?php
namespace Organization\Controller;
use Common\Controller\AdminbaseController;
class OrganizationAdminController extends AdminbaseController {
	
	function _initialize() {
		parent::_initialize();
	}
	
	public function index(){//管理员获取组织资料
		
		$orgid=$_GET['orgid'];
		if(empty($orgid)){
			$this->error('组织id接受失败！');
		}
		$orgid_model=M('Organization');
		$where['id']=$orgid;
		$result=$orgid_model->where($where)->find();
		if(!empty($result)){
			
			$this->assign('orginfo',$result);
			$this->display();
			
		}else{
			
			$this->error('获取组织资料失败！');
		}

	}
	public function lookapply(){//管理员获取申请人信息

		$orgid=$_GET['orgid'];
		$register_model=D('UserRegister');
		$where['ORG_ID']=$orgid;

		$count=$register_model->where($where)->count();

		$page = $this->page($count, 9);
		$result=$register_model->where($where)
		->order("createtime DESC")
		->limit($page->firstRow.','.$page->listRows)
        ->select();

        $this->assign('info',$result);
        $this->assign('page',$page->show());
        $this->assign('orgid',$orgid);
        $this->display();

	}
	public function agreeapply(){//同意申请
		$id=intval($_GET['id']);//int化也很重要
		$orgid=$_GET['orgid'];

		$register_model=D('UserRegister');
		$result=$register_model->where("id=$id")->find();

		$nicename=$result['user_nicename'];
		$data['user_id']=intval($result['user_id']);
		$data['ORG_ID']=intval($orgid);
		$data['identify']=3;
		$data['status']=1;
		$data['createtime']=time();
		$where['user_id']=intval($result['user_id']);
		$where['ORG_ID']=intval($orgid);

		$user_orgmodel=D('UserOrg');
		$et=$user_orgmodel->where($where)->find();
		if(!empty($et)){
			$this->success('该用户已经加入该组织，无需再次添加！',U('OrganizationAdmin/lookapply',array('orgid'=>$orgid)));

		}
		//dump($data);
		$status=$user_orgmodel->add($data);
		//如果主键是自动增长型 成功后返回值就是最新插入的值
		if(!empty($status)){
			$register_model->delete($id);
			$this->success('已经拒绝该用户加入！',U('OrganizationAdmin/lookapply',array('orgid'=>$orgid)));

		}

	}
	public function disagree(){//拒绝加入

		$id=intval($_GET['id']);//int化也很重要
		//dump($id);
		$orgid=$_GET['orgid'];
		$register_model=D('UserRegister');
		$result=$register_model->delete($id);
		$this->success('已经拒绝该用户加入！',U('OrganizationAdmin/lookapply',array('orgid'=>$orgid)));

	}

	
	
	
	
}