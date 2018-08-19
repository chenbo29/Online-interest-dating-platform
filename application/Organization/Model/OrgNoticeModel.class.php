<?php
namespace Common\Model;
use Think\Model;

class OrgNoticeModel extends Model {


		//protected $patchValidate = true;

	  protected $_validate=array(
                array('title','require','请您填写公告标题！',1),
                //array('name','name','该组织名称已经存在，请您换一个试试！',0,'unique',1), 
                array('content','0,5000','公告内容不得超过5000字！',0,'length'),
                array('content','require',"内容不能为空，但您可以填写无等字样！"),                
                //array('type','require',"请您选择组织类别，以便于吸纳志趣相同的同城好友！"),
                //array('size','require',"请您选择组织规模！"),

            );
	  protected $_auto = array (          
     			
	  			//array('creator','sp_get_current_userid()',1,'function'),
	  			//array('logo','getpath',1,'callback'),
     			//array('create_time','time',1,'function'), // 对name字段在新增和编辑的时候回调getName方法   
	   
	 		);


}

