<?php
namespace Organization\Controller;
use Common\Controller\AdminbaseController;
class OrganizationAdminController extends AdminbaseController {
	
	function _initialize() {
		parent::_initialize();
	}

/***************************组织资料模块***********************************************************/	
	public function orgbasedata(){//获取组织资料
		if(IS_POST){
			$org_model=D('Organization');
			if(!$org_model->create()){
				$this->error($org_model->getError());
			}
			if($org_model->save()!==false){
				$this->success('更新成功！');
			}else{
				$this->error('更新失败！');
			}
		}else{
			$orgid=$_GET['orgid'];
			/*$orgid=2;*/
			if(empty($orgid)){
				$this->error('组织id接受失败！');
			}
			$org_model=M('Organization');
			$where['id']=$orgid;
			$result=$org_model->where($where)->find();
			if(empty($result)){
				$this->error('获取组织资料失败！');		
			}
			$where1['id']=$result['creator'];
			$where2['id']=$result['city'];
			$user_model=M('Users');
			/*获取创始人用户名*/
			$user_login=$user_model->where($where1)->getField('user_login');
			$district_model=M('Plugindistrict');
			/*获取城市名称*/
			$city=$district_model->where($where2)->getField('name');
			/*获取人数*/
			$user_orgmodel=M('UserOrg');
			$count=$user_orgmodel->where("ORG_ID=$orgid")->count();
			$this->assign('count',$count);
			$this->assign('city',$city);
			$this->assign('creator',$user_login);
			$this->assign('data',$result);
			$this->assign('orgid',$orgid);
			$this->display();	
		}
	}
	function requirement(){
		if(IS_POST){
			$org_model=D('Organization');
			if(!$org_model->create()){
				$this->error($org_model->getError());
			}
			$org_model->requirements=htmlspecialchars_decode(I('post.requirements'));
			if($org_model->save()!==false){
				$this->success('更新成功！');
			}else{
				$this->error('更新失败！');
			}
		}else{
			$orgid=$_GET['orgid'];
			/*$orgid=2;*/
			if(empty($orgid)){
				$this->error('组织id接受失败！');
			}
			$org_model=M('Organization');
			$where['id']=$orgid;
			$result=$org_model->where($where)->find();
			if(empty($result)){
				$this->error('获取招募要求失败！');		
			}
			$this->assign('data',$result);
			$this->assign('orgid',$orgid);
			$this->display();	
		}
	}
/*	function editbasedata(){
		$orgid=$_GET['orgid'];
		if(empty($orgid)){
			$this->error('组织id接受失败！');
		}
	}*/
	function logo(){
		$orgid=$_GET['orgid'];
		//$orgid=2;
		if(empty($orgid)){
			$this->error('组织id接受失败！');
		}
		$org_model=M('Organization');
		$where['id']=$orgid;
		$logo=$org_model->where($where)->getField('logo');
		$this->assign('logo',$logo);
		$this->assign('orgid',$orgid);
		$this->display();
	}

	function uploadlogo(){
		/****************上传文件先放到缓存文件夹下，当完成更新操作后，再移动到目的文件夹*********/
		$orgid=$_GET['orgid'];
		/*$orgid=2;*/
		if(empty($orgid)){
			$this->error('组织id接受失败！');
		}
    	$config=array(
		'FILE_UPLOAD_TYPE' => sp_is_sae()?"Sae":'Local',//TODO 其它存储类型暂不考虑
		'rootPath' => './'.C("UPLOADPATH"),
		'savePath' => './orglogo/cache/',
		'maxSize' => 512000,//500K
		'saveName'   =>    array('uniqid',''),
		'exts'       =>    array('jpg', 'png', 'jpeg','bmp'),
		'autoSub'    =>    false,
    	);
    	$upload = new \Think\Upload($config);//
    	$info=$upload->upload();
    	//开始上传
    	if ($info) {
    	//上传成功
    	//写入附件数据库信息
    		$first=array_shift($info);
    		$file=$first['savename'];
    		$_SESSION['avatar']=$file;
    		$this->ajaxReturn(sp_ajax_return(array("file"=>$file),"upload success!!!",1),"AJAX_UPLOAD");
    	} else {
    		//上传失败，返回错误
    		dump("error12345");
    		$this->ajaxReturn(sp_ajax_return(array(),$upload->getError(),0),"AJAX_UPLOAD");
    	}
	}
	  function updatelogo(){
/***************完成剪切，成功更新数据库后，删除以前的logo，将新logo从缓存移到目标文件夹************/
    	if(!empty($_SESSION['avatar'])){
    		$orgid=$_GET['orgid'];
			/*$orgid=2;*/
			if(empty($orgid)){
				$this->error('组织id接受失败！');
			}
    		$targ_w = intval($_POST['w']);
    		$targ_h = intval($_POST['h']);
    		$x = $_POST['x'];
    		$y = $_POST['y'];
    		$jpeg_quality = 90;
    		
    		$avatar=$_SESSION['avatar'];
    		$avatar_dir=C("UPLOADPATH")."orglogo/cache/";
    		if(sp_is_sae()){//TODO 其它存储类型暂不考虑
    			$src=C("TMPL_PARSE_STRING.__UPLOAD__")."orglogo/cache/$avatar";
    		}else{
    			$src = $avatar_dir.$avatar;
    		}
    		
    		$avatar_path=$avatar_dir.$avatar;
    		
    		
    		if(sp_is_sae()){//TODO 其它存储类型暂不考虑
    			$img_data = sp_file_read($avatar_path);
    			$img = new \SaeImage();
    			$size=$img->getImageAttr();
    			$lx=$x/$size[0];
            	$rx=$x/$size[0]+$targ_w/$size[0];
            	$ty=$y/$size[1];
            	$by=$y/$size[1]+$targ_h/$size[1];
    			
    			$img->crop($lx, $rx,$ty,$by);
    			$img_content=$img->exec('png');
    			sp_file_write($avatar_dir.$avatar, $img_content);
    		}else{
				
    			$image = new \Think\Image();
    			$image->open($src);
    			$image->crop($targ_w, $targ_h,$x,$y);
    			/*裁剪9：5 缩放为270X150*/
    			$image->thumb(270, 150);
    			$image->save($src);
				//$this->error("success");
    		}
    		
    		$org_model=M('Organization');
			$where['id']=$orgid;
			$oldlogo=$org_model->where($where)->getField('logo');
			$Abspath="data/upload/".$oldlogo;/*旧logo绝对路径*/
			/*以组织编号为文件夹,相对于data/upload文件夹*/
			$logo="orglogo/".$orgid.'/'.$avatar;
			$result=$org_model->where($where)->save(array("logo"=>$logo));

    		if($result){
    			/*将logo从缓存文件夹cache移动到组织文件夹*/
    			$orgpath="data/upload/orglogo/".$orgid;
    			if(!file_exists($orgpath)){
    				mkdir($orgpath);
    			}
    			$newlogoAbspath=$orgpath.'/'.$avatar;
    			copy($src,$newlogoAbspath);/*将logo从缓存文件移动到目标文件夹*/
    			unlink($src);		/*删除缓存文件*/
    			unlink($Abspath);	/*删除之前的logo*/
    			$this->success("组织logo更新成功！");
    		}else{
    			$this->error("组织logo更新失败！");
    		}
    		
    	}
    }
    /***************************以上是组织资料模块**************************************************/


    /***************************天外来客模块**************************************************/

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
		if(empty($orgid)){
			$this->error('组织id接受失败！');
		}
		$register_model=D('UserRegister');
		$result=$register_model->where("id=$id")->find();

		$data['nicename']=$result['user_nicename'];
		$data['user_id']=intval($result['user_id']);
		$data['ORG_ID']=intval($orgid);
		$data['identify']=3;/*普通用户*/
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
			/*组织人数+1*/
			$organization_model=M('Organization');
			$organization_model->save(array('id'=>$orgid,"mem_num"=>array('exp'=>"mem_num+1")));
			$register_model->delete($id);
			$this->success('已经同意该用户加入，您可以进入用户管理来管理此用户！',U('OrganizationAdmin/lookapply',array('orgid'=>$orgid)));

		}

	}
	public function disagree(){//拒绝加入

		$id=intval($_GET['id']);//int化也很重要
		//dump($id);
		$orgid=$_GET['orgid'];
		if(empty($orgid)){
			$this->error('组织id接受失败！');
		}
		$register_model=D('UserRegister');
		$result=$register_model->delete($id);
		$this->success('已经拒绝该用户加入！',U('OrganizationAdmin/lookapply',array('orgid'=>$orgid)));

	}
 /***************************以上是天外来客模块**************************************************/




 /***************************公告模块**************************************************/


	function launchnotice(){/*管理员发布公告*/
		if(IS_POST){
			$orgid=$_GET['orgid'];
			if(empty($orgid)){
				$this->error('组织id接受失败！');
			}
			$notice_model=D('OrgNotice');
			if(!$notice_model->create()){
				$this->error($notice_model->getError());
			}else{
				$notice_model->content=htmlspecialchars_decode(I('post.content'));
				$notice_model->time=date('y-m-d H:i:s',time());/*写入发布时间*/
				$notice_model->author=sp_get_current_admin_id();/*写入作者*/
				$notice_model->ORG_ID=$orgid;/*写入组织id*/
				$info=$notice_model->add();
				if(!empty($info)){
					$this->success('发布成功！',U('OrganizationAdmin/notice',array('orgid'=>$orgid)));
				}else{
					$this->error('发布失败！');
				}

			}
		}else{
			$orgid=$_GET['orgid'];
			/*$orgid=2;*/
			if(empty($orgid)){
				$this->error('组织id接受失败！');
			}

			$this->assign('orgid',$orgid);

			$this->display();
		}
	}
	function notice(){
		$orgid=$_GET['orgid'];
		if(empty($orgid)){
			$this->error('组织id接受失败！');
		}
		$notice_model=M('OrgNotice');
		$map['ORG_ID']=array('eq',$orgid);
        $count=$notice_model->where($map)->count();
        $page = $this->page($count, 9);
        $result=$notice_model
        ->where($map)
    	->order("time ASC")
        ->limit($page->firstRow.','.$page->listRows)
        ->select();
        //dump($result);
        $this->assign('data',$result);
        $this->assign("page",$page->show());
        $this->assign('orgid',$orgid);
        $this->display();
	}
	function editnotice(){
		if(IS_POST){
			$orgid=$_GET['orgid'];
			if(empty($orgid)){
				$this->error('组织id接受失败！');
			}
			$notice_model=D('OrgNotice');
			if(!$notice_model->create()){
				$this->error($notice_model->getError());
			}else{
				$notice_model->content=htmlspecialchars_decode(I('post.content'));
				$notice_model->time=date('y-m-d H:i:s',time());/*写入发布时间*/
				$notice_model->author=sp_get_current_admin_id();/*写入作者*/
				$info=$notice_model->save();
				if($info!==false){
					$this->success('修改成功！',U('OrganizationAdmin/notice',array('orgid' => $orgid)));
				}else{
					$this->error('修改失败！');
				}

			}
		}else{
			$orgid=$_GET['orgid'];
			/*$orgid=2;*/
			if(empty($orgid)){
				$this->error('组织id接受失败！');
			}
			$id=$_GET['id'];
			$notice_model=D('OrgNotice');
			$result=$notice_model->where("id=$id")->find();
			$this->assign($result);
			$this->assign('orgid',$orgid);

			$this->display();
		}
	}
	function deletenotice(){
			$orgid=$_GET['orgid'];
			/*$orgid=2;*/
			if(empty($orgid)){
				$this->error('组织id接受失败！');
			}
			$id=$_GET['id'];
			$notice_model=D('OrgNotice');
			$info=$notice_model->where("id=$id")->delete();
			if($info>0){
				$this->success('删除成功！',U('OrganizationAdmin/notice',array('orgid' => $orgid)));
			}elseif($info===false){
				$this->error('删除遇到错误！');
			}elseif($info==0){
				$this->error('未删除任何数据！');
			}
	}
	function looknotice(){
		$orgid=$_GET['orgid'];
		/*$orgid=2;*/
		if(empty($orgid)){
			$this->error('组织id接受失败！');
		}
		$id=$_GET['id'];
		$notice_model=M('OrgNotice');
		$notice=$notice_model->where("id=$id")->find();
		/**获取用户名******************************************************/
		$adminid=$notice['author'];
		$org_user_model=D("OrgUserView");
		$where['user_id']=$adminid;
		$where["ORG_ID"]=$orgid;
		$result=$org_user_model->where($where)->find();
		//dump($result);
		$authorname="";
		if(!empty($result['nicename'])){
			$authorname=$result['nicename'];/*在该组织是否有昵称*/
		}else{
			$authorname=$result['user_login'];/*若没有昵称，取用户名*/
		}
		$this->assign('authorname',$authorname);
		$this->assign('orgid',$orgid);
		$this->assign($notice);
		$this->display();
	}
	
 /***************************以上是公告模块**************************************************/

/***************************时间轴模块**************************************************/
 	function timeline(){
 		$orgid=$_GET['orgid'];
		/*$orgid=2;*/
		if(empty($orgid)){
			$this->error('组织id接受失败！');
		}
 		$timeline_model=M('OrgTimeline');
 		$map['ORG_ID']=array('eq',$orgid);
        $count=$timeline_model->where($map)->count();
        $page = $this->page($count, 10);
        $result=$timeline_model
        ->where($map)
    	->order("timepoint ASC")
        ->limit($page->firstRow.','.$page->listRows)
        ->select();
        //dump($result);
        $this->assign('data',$result);
        $this->assign("page",$page->show("Admin"));
        $this->assign('orgid',$orgid);
        $this->display();
 	}
 	function addtimeline(){
 		if(IS_POST){
 			$orgid=$_GET['orgid'];
 			$timeline_model=D('OrgTimeline');
 			if(!$timeline_model->create()){
 				$this->error($timeline_model->getError());
 			}
 			$timeline_model->author=sp_get_current_admin_id();
 			$timeline_model->time=date('y-m-d H:i:s',time());
 			$info=$timeline_model->add();
 			if(!empty($info)){
 				$this->success("成功添加了一条时光！",U('OrganizationAdmin/timeline',array('orgid' => $orgid)));
 			}else{
 				$this->error('添加时光失败！');
 			}
 		}else{
	 		$orgid=$_GET['orgid'];
			/*$orgid=2;*/
			if(empty($orgid)){
				$this->error('组织id接受失败！');
			}

			$this->assign('orgid',$orgid);
			$this->display();
 		}

 	}
 	function edittimeline(){
 		if(IS_POST){
			$orgid=$_GET['orgid'];
			if(empty($orgid)){
				$this->error('组织id接受失败！');
			}
			$timeline_model=D('OrgTimeline');
			if(!$timeline_model->create()){
				$this->error($timeline_model->getError());
			}else{
				
				$timeline_model->time=date('y-m-d H:i:s',time());/*写入发布时间*/
				$timeline_model->author=sp_get_current_admin_id();/*写入作者*/
				$info=$timeline_model->save();
				if($info!==false){
					$this->success('修改时光成功！',U('OrganizationAdmin/timeline',array('orgid' => $orgid)));
				}else{
					$this->error('修改失败，时光不容篡改！');
				}

			}
		}else{
			$orgid=$_GET['orgid'];
			/*$orgid=2;*/
			if(!isset($orgid)){
				$this->error('组织id接受失败！');
			}
			$id=$_GET['id'];
			if(!isset($id)){
				$this->error('key传递失败！');
			}
			$timeline_model=M('OrgTimeline');
			$result=$timeline_model->where("id=$id")->find();
			$this->assign($result);
			$this->assign('id',$id);
			$this->assign('orgid',$orgid);

			$this->display();
		}
 	}
 	function deletetimeline(){
 			$id=$_GET['id'];
			if(!isset($id)){
				$this->error('key传递失败！');
			}
			$timeline_model=M('OrgTimeline');
			$result=$timeline_model->where("id=$id")->delete();
			if(!empty($result)){
				$this->success('删除了时光，却删不掉时光！');
			}else{
				$this->error('时光不想删除，时光想留下！');
			}

 	}
/***************************以上是时间轴模块**************************************************/




	
}