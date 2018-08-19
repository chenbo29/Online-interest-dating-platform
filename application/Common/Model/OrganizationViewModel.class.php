<?php
namespace Common\Model;
use Think\Model\ViewModel;
class OrganizationViewModel extends ViewModel 
{
	
	public $viewFields = array(     
		'Users'=>array('id'=>'userId'), 
		'User_org'=>array('_on'=>'Users.id=User_org.user_id','ORG_ID'),   
		'Organization'=>array('id'=>'stId','name'=>'stname', 'logo','introduction','creator','create_time','mem_num','_on'=>'Organization.id=User_org.ORG_ID'),     
	);
	
	//获取当前用户所关注的社团
	public function getStList()
	{	
		$where['userId']=sp_get_current_userid();
		$orgIds=$this->where($where)->select();
		if(empty($orgIds)){
			/*防止查询出错！*/
			return null;
		}
		$newArray = array();
		
		/*解决组织表中统计人数字段mem_num没有更新，前台无法获取问题*/
		$userorgmodel=M('UserOrg');
		$Organization=M('Organization');
		
		foreach ($orgIds as  $value) {
			$orgid=$value['org_id'];
			/*获取该组织当前人数*/
			$count=$userorgmodel->where("ORG_ID=$orgid")->count();
			/*保存当前人数到组织表*/
			$currentcount=$Organization->where("id=$orgid")->getField('mem_num');
			/*人数变化时才更新*/
			if($currentcount<$count){
				$Organization->where("id=$orgid")->setField('mem_num',$count);		
			}				
			array_push($newArray,$value['org_id']);
		}
		

		$where['stid']=array('in',$newArray);
		$rs=M('orgcreatorview')->where($where)->select();
		// var_dump($rs);die;
		return $rs;
		 

		
		// return $this->where($where)->select();

	}

	
}

