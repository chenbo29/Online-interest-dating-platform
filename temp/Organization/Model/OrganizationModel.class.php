<?php
namespace Common\Model;
use Think\Model;

class OrganizationModel extends Model {


		//protected $patchValidate = true;

	  protected $_validate=array(
                array('name','require','请您填写您的组织名称！',1),
                array('name','name','该组织名称已经存在，请您换一个试试！',0,'unique',1), 
                array('city','require',"请您填写您的组织所在地区，以便于您的组织吸纳更多本地志趣相同的好友！"),
                array('type','require',"请您选择组织类别，以便于吸纳志趣相同的同城好友！"),

            );
	  protected $_auto = array (          
     			
	  			array('creater','liuyang',1,''),
	  			//array('logo','getpath',1,'callback'),
     			array('create_time','time',1,'function'), // 对name字段在新增和编辑的时候回调getName方法   
	   
	 		);

	public function tocreate($Abspath){


			if (!$this->create()){ // 指定新增数据
				// 如果创建失败 表示验证没有通过 输出错误提示信息
				return $this->getError();
				//$this->error("asdfasfdas");
			}
			else{

					//$this->add();
					//$success='success';
					$this->logo=$Abspath;
					return $this->add();
				//$this->error("asdfasfdas");
			}

	}

}

