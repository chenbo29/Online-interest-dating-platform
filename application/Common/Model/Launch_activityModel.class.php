<?php
namespace Common\Model;
use Common\Model\CommonModel;
class Launch_activityModel extends CommonModel 
{
	
	/*public $viewFields = array(     
		'Users'=>array('id'=>'userId'), 
		'User_org'=>array('_on'=>'Users.id=User_org.user_id'),   
		'Organization'=>array('id'=>'stId','name'=>'stname', 'logo','introduction','creator','create_time','mem_num','_on'=>'Organization.id=User_org.ORG_ID'),     
	);*/
	
	//获取当前社团公告列表
	public function getList($stid,$limit,$page)
	{	

		$where['org_id']=$stid;
	
		$rs['lists'] = $this->where($where)->order('id desc')->page($page . ',' . $limit)->select();
		// echo $this->_sql();die;
		$rs['count'] = $this->where($where)->count();

		$Page = new \Think\Page($rs['count'], $limit);
		$rs['page'] = $Page->show();
		return $rs;
	}

	public function getDetail($id)
	{
		return $this->where("id='{$id}'")->find();
	}
	
}

