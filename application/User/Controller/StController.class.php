<?php 
namespace User\Controller;
use Common\Controller\MemberbaseController;
class StController extends MemberbaseController {



	public function likest(){
		if(sp_is_user_login()){

	    $st=D('OrganizationView');
		$likeStList=$st->getStList();
		// var_dump($likeStList);die;
		$this->assign("likeStList",$likeStList);
		
		/*$create=M('orgcreatorview');*/
		/**********获取组织人数****************************/

		$this->display();
	    
	    }else{
	        redirect(__ROOT__."/");
	    }
	}
	/*网站首页*/
/*	public function index(){
		
			$this->display();
		
	}*/

	/*public function enroll()
	{	
		
		$where['user_id']=sp_get_current_userid();
		$where['activity_id']=$_GET['id'];
	
		$enroll=M('activity_enroll');
	
		if($enroll->where($where)->find())
		{
			$this->error("您已报名！");
		}
		else {
			$where['ORG_ID']=$_REQUEST['stid'];
			$enroll->add($where);
			$this->success("报名成功！");
		}
		
	}*/
	public function searchst()
	{
		if(sp_is_user_login()){
				
			$province=I("param.province",0,"int");
			$city=I("param.city",0,"int");
			
			// dump($province);
			// dump($city);die;

			if($province ==0 && $city==0)
			{
				$this->redirect('User/St/joinst');
			}	

			elseif ($city==0) 
			{
				//所有记录
				$org=M('allorgview');
				$where['province']=$province;
				
				//分页
				$count = $org->where("upid='{$where['province']}'")->count();// 查询满足要求的总记录数
				$Page  = new \Think\Page($count,6);// 实例化分页类 传入总记录数和每页显示的记录数

				foreach($where as $key=>$val) {
				    $Page->parameter[$key]   =   urlencode($val);
				}

				$allSt=M('allorgview')->where("upid='{$where['province']}'")->limit($Page->firstRow.','.$Page->listRows)->select();
				$this->assign("allSt",$allSt);

				$show  = $Page->show();// 分页显示输出
				$this->assign('page',$show);// 赋值分页输出
/*				$org=M('allorgview');
				$where['upid']=$province;
				
				//分页
				$count = $org->where($where)->count();// 查询满足要求的总记录数
		        $page = $this->page($count, 1);
		        $allSt=$org
		        ->where($where)
		        ->limit($page->firstRow.','.$page->listRows)
		        ->select();
		        $this->assign('allSt',$allSt);
		        $this->assign("page",$page->show('Admin'));*/

				$this->display("joinst");

			}
			else
			{
				//所有记录
				$org=M('allorgview');
				$map['city']=$city;
				
				//分页
				$count = $org->where($map)->count();// 查询满足要求的总记录数
				$Page  = new \Think\Page($count,6);  // 实例化分页类 传入总记录数和每页显示的记录数
			
				foreach($map as $key=>$val) {
				    $Page->parameter[$key]  = urlencode($val);
				}

				$allSt=M('allorgview')->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
				$this->assign("allSt",$allSt);

				$show  = $Page->show();// 分页显示输出
				$this->assign('page',$show);// 赋值分页输出
				$this->display("joinst");
			}
	    }
	    else{
	        redirect(__ROOT__."/");
	    }
	}
	
	public function joinst()
	{
		if(sp_is_user_login()){

			//所有记录
			$org=M('allorgview');
			$allSt=M('allorgview')->select();
			$this->assign("allSt",$allSt);
			//分页
			$count      = $org->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
			$show       = $Page->show();// 分页显示输出
			$this->assign('page',$show);// 赋值分页输出
			$this->display();

		}
		else
		{
			redirect(__ROOT__."/");
		}
	}

	public function timeline()
	{	
		$stid=I('get.stid','','int');
		$timeline=M('Timelineview');
		$timelineList=$timeline->where("ORG_ID='{$stid}'")->order('timepoint desc')->select();
		$this->assign("timelineList",$timelineList);
		$this->display("Portal@:timeline");
	}


}
?>