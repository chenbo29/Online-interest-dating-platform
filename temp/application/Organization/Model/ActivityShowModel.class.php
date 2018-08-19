<?php
namespace Common\Model;
use Think\Model;

class ActivityShowModel extends Model {


		//protected $patchValidate = true;

	  protected $_validate=array(
                array('theme','require','请您填写活动名称！',1),
                array('people','/^[0-9]*[1-9][0-9]*$/','您输入的人数非法！',0,'regex'),
                //array('name','name','该组织名称已经存在，请您换一个试试！',0,'unique',1), 
                array('content','0,2000','活动简介过长！',0,'length'),
                array('addr','require',"地址不能为空，但您可以填写待定等字样！"),
                array('content','require',"内容不能为空，但您可以填写无等字样！"),                
                //array('type','require',"请您选择组织类别，以便于吸纳志趣相同的同城好友！"),
                //array('size','require',"请您选择组织规模！"),

            );
	  protected $_auto = array (          
     			
	  			//array('creator','sp_get_current_userid()',1,'function'),
	  			//array('logo','getpath',1,'callback'),
     			//array('create_time','time',1,'function'), // 对name字段在新增和编辑的时候回调getName方法   
	   
	 		);

	public function uploadpastact($relpath){

			if (!$this->create()){ // 指定新增数据
				// 如果创建失败 表示验证没有通过 输出错误提示信息
				return $this->getError();
				//$this->error("asdfasfdas");
			}
			else{
				$this->cover_picture=$relpath;//相对data/upload的路径
				$this->createtime=date('y-m-d H:i:s',time());
				$id=$this->add();
				if(!empty($id))
				{
					$info=array(
						'status'=>'1',
						'id'=>$id,
						'info'=>'create successful!',
						);
					return $info;
				}
				else{

					$errorinfo="创建失败!";
					return $errorinfo;
				}
			//$this->error("asdfasfdas");
			}

	}

}

