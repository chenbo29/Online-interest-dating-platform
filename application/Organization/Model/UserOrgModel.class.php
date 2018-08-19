<?php
namespace Common\Model;
use Think\Model;

class UserOrgModel extends Model {


		//protected $patchValidate = true;

	  protected $_validate=array(
                //array('nicename','require','请您填写您的组织名称！',1),
	  			array('nicename','0,20','昵称字数超出限制！',0,'length'),
                array('tel','/^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/i','请填写正确的手机号，否则您将无法更新资料！',0,'regex'),
                //array('name','name','该组织名称已经存在，请您换一个试试！',0,'unique',1), 
                array('introduction','0,300','介绍过长！',0,'length'),
                array('signature','0,50','个性签名字数超出限制！',0,'length'),
                //array('city','require',"请您填写您的组织所在地区，以便于您的组织吸纳更多本地志趣相同的好友！"),
                //array('type','require',"请您选择组织类别，以便于吸纳志趣相同的同城好友！"),
                //array('size','require',"请您选择组织规模！"),

            );
	  protected $_auto = array (          
     			
	  			//array('creator','sp_get_current_userid()',1,'function'),
	  			//array('logo','getpath',1,'callback'),
     			//array('create_time','time',1,'function'), // 对name字段在新增和编辑的时候回调getName方法   
	   
	 		);

	

}

