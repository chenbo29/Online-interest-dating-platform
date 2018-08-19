<?php
namespace Common\Model;
use Think\Model;

class OrganizationModel extends Model {


		//protected $patchValidate = true;

	  protected $_validate=array(
                array('name','require','请您填写您的组织名称！',1),
                array('name','/^[a-zA-Z0-9_\x{4e00}-\x{9fa5}]{4,20}+$/u','您的组织名称应该为4-20位只包含汉字，字母，数字或下划线！',0,'regex'),
                array('name','name','该组织名称已经存在，请您换一个试试！',0,'unique',1), 
                array('introduction','0,300','简介过长！',0,'length'),
                array('city','require',"请您填写您的组织所在地区，以便于您的组织吸纳更多本地志趣相同的好友！"),
                array('type','require',"请您选择组织类别，以便于吸纳志趣相同的同城好友！"),
                array('size','require',"请您选择组织规模！"),

            );
	  protected $_auto = array (          
     			
	  			//array('creator','sp_get_current_userid()',1,'function'),
	  			//array('logo','getpath',1,'callback'),
     			array('create_time','time',1,'function'), // 对name字段在新增和编辑的时候回调getName方法   
	   
	 		);

	public function tocreate($data){

			if (!$this->create()){ // 指定新增数据
				// 如果创建失败 表示验证没有通过 输出错误提示信息
				return $this->getError();
				//$this->error("asdfasfdas");
			}
			else{

					//$this->add();
					//$success='success';
					$this->current=1;//人数
					$this->status=1;//组织状态
					if(!sp_get_current_userid()){

						$nologin="您还没有登陆，请您先登陆！";
						return $nologin;
		
					}
					$userid=sp_get_current_userid();
					$this->creator=$userid;
					$this->all_hits=1;//访问总量
					$orgid=$this->add();
					if(!empty($orgid))
					{

						$user_orgmodel=M('UserOrg');
	
						$data['user_id']=$userid;
						$data['ORG_ID']=$orgid;
						$data['now_city']=$data['city'];//post过来的写法
						$data['identify']=1;//组织创始人，超级管理员
						$data['status']=1;//正常状态
						$data['createtime']=time();

						$status=$user_orgmodel->add($data);

						$info=array(
							'status'=>'1',
							'info'=>'create successful!',
							);
						if(!empty($status)){
							return $info;
						}
						else{
							$user_orgmodel->where('ORG_ID=$orgid' AND 'user_id=$userid')->delete();
							$errorinfo="超级管理员信息创建失败，请您刷新页面重新创建！";
							return $errorinfo;
						}
					}
					else{
						$errorinfo="创建失败！";
						return $errorinfo;
					}	
				//$this->error("asdfasfdas");
			}

	}

}

