<?php
namespace Common\Model;
use Think\Model\ViewModel;
class OrgUserViewModel extends  ViewModel{
	
	public $viewFields=array(
		'Users'=>array('id'=>'userid','user_login','user_pass','user_nicename','user_email','tel'),
		'UserOrg'=>array('id','user_id','ORG_ID','introduction','picture','nicename','tel','signature','identify','status','createtime','last_ip','last_login_time','_on'=>'Users.id=UserOrg.user_id'),

	);

	
}