<?php
namespace Organization\Controller;
use Common\Controller\HomeBaseController;
class OrganizationController extends HomeBaseController{
	
	//coded by liu
	
	function _initialize() {

		parent::_initialize();
		//$this->check_login();
		//$this->check_user();
		//$this->_model=D("Organization");
	}
	
	
	
	
/* 	function index(){
        
        $a=1;
		$b=3;
		$c=2;
		$e=5;
		$this->add($a,$b);
		
	}
	function add($aa,$bb,$cc=6,$gg=9){
		$dd=$aa+$cc;
		$this->error($dd);
	} */
	function index(){

   		//$this->display();
		
	}

	function create(){/*创建组织，涉及到的表：user_org    user*/
		if(!empty($_SESSION['user'])){ /*创建组织前判断是否登陆*/

			$this->display();
			
		}
		else{
            $this->error("您还未登录！！！",U("user/login/index"));
            //$this->display();
        }

	}

	function docreate(){
        //if(!sp_check_verify_code()){
        //  $this->error("验证码错误！"); //by liuyang 开发阶段省去验证码输入
        //}
        if(IS_POST)//是否仍要加用户登录判断
        {
            $data=I('post.');
            $reback=D('Organization')->tocreate($data);
                   // $this->error($Abspath);
            if($reback['status']=='1')//注册组织成功
            {
                $this->success($reback['info'],U("Organization/Organization/create"),'5');

            }else{

                $this->error($reback);

                }

        }
        else{

            $this->error('未成功提交,请您重新填写资料！',U("Organization/Organization/create"));
        }

		
	}

	// function applytojoin(){

	// 	if(!empty($_SESSION['user'])){ /*申请加入组织前判断是否登陆*/

	// 		$this->display();
			
	// 	}
	// 	else{
 //            $this->error("您还未登录！！！",U("user/login/index"));
 //            //$this->display();
 //        }
	//	}
	function doapply(){ /*提交申请*/
		if(IS_POST){
			$orgid=$_GET['orgid'];
			$orgid=2;
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
	  		//$orgid=$_GET['orgid'];
			$orgid=2;
	        $org_model=D('Organization');
	        $result=$org_model->where("id=$orgid")->find();
	        //dump($result);
	        $this->assign('info',$result);
	  		$this->display();
	  		}

	}
	function updateorguser(){
		if(IS_POST){
			//dump($_GET['id']);
			$id=$_GET['id'];
			if(empty($id)){//未获取id
				 $this->error("参数传递失败！");
			}
			if(empty($_SESSION['user'])){ /*申请加入组织前判断是否登陆*/
	  			 $this->error("您还未登录！！！",U("user/login/index"));
				}else{
					$user_orgmodel=D('UserOrg');
					$oldpicture=$user_orgmodel->where("id=$id")->getField('picture');
					$newpic=I('post.picture');
					if($oldpicture!==$newpic){//如果更新了图片，删除老图片
						$oldsiglepic=explode('+',$oldpicture);
						$count=count($oldsiglepic);						
						for($temp=0;$temp<$count;$temp++){
							$Abspath='data/upload/orguser/trueupload/'.$oldsiglepic[$temp];
							//dump($Abspath);
							unlink($Abspath);
						}
						//将图片从缓存区移动到保存区
						$newsiglepic=explode('+', $newpic);
						$count=count($newsiglepic);	
						for($temp=0;$temp<$count;$temp++){
							$newpath='data/upload/orguser/trueupload/'.$newsiglepic[$temp];
							//dump($Abspath);
							$cachepath='data/upload/orguser/upload_cache/'.$newsiglepic[$temp];
							copy($cachepath,$newpath);
							unlink($cachepath);
						}
					}
					if ($user_orgmodel->create()) {

						if ($user_orgmodel->save()!==false) {

							$this->success("更新成功！");
						} else {
							$this->error("更新失败！");
						}
					} else {
						$this->error($user_orgmodel->getError());
					}
				}
		}else{
			$orgid=$_GET['orgid'];
			$orgid=2;
			$userid=sp_get_current_userid();
			//dump($userid);
			if(empty($orgid)){
				$this->error("参数获取失败！！！");
			}
			if(empty($userid)){
				$this->error("您还未登录！！！");
			}
			//session('orgid',$orgid);
			$org_user_viewmodel=D("OrgUserView");//用户组织视图
			$where['user_id']=$userid;
			$where['ORG_ID']=$orgid;
			$result=$org_user_viewmodel->where($where)->find();
			$this->assign($result);
			$this->assign('orgid',$orgid);
			$this->display();
		}
	}
	
}