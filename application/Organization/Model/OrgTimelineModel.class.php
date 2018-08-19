<?php
namespace Common\Model;
use Think\Model;

class OrgTimelineModel extends Model {


		//protected $patchValidate = true;

	  protected $_validate=array(
                array('title','require','请您填写时光标题！',1),
                //array('name','name','该组织名称已经存在，请您换一个试试！',0,'unique',1), 
                array('content','0,255','时光内容不得超过255字！',0,'length'),
                array('content','require',"时光内容不能为空！"),
                array('timepoint','require',"时光节点不能为空！"),
                array('ORG_ID','require',"时光节点不能为空！"),                
                //array('type','require',"请您选择组织类别，以便于吸纳志趣相同的同城好友！"),
                //array('size','require',"请您选择组织规模！"),

            );
	  protected $_auto = array (          
     			
	  			//array('creator','sp_get_current_userid()',1,'function'),
	  			//array('logo','getpath',1,'callback'),
     			//array('create_time','time',1,'function'), // 对name字段在新增和编辑的时候回调getName方法   
	   
	 		);


}

