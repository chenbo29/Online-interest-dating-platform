<?php
// +---------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +---------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +---------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +---------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +---------------------------------------------------------------------

namespace Common\Lib;

/**
 * ThinkCMF权限认证类
 */
class iAuth{

    //默认配置
    protected $_config = array(
    );

    public function __construct() {
    }

    /**
      * 检查权限
      * @param name string|array  需要验证的规则列表,支持逗号分隔的权限规则或索引数组
      * @param uid  int           认证用户的id
      * @param relation string    如果为 'or' 表示满足任一条规则即通过验证;如果为 'and'则表示需满足所有规则才能通过验证
      * @return boolean           通过验证返回true;失败返回false
     */
    public function check($uid,$name,$relation='or',$orgid=null) {
    	if(empty($uid)||empty($orgid)){
    		return false;
    	}
        $user_orgmodel=M('UserOrg');
        $where['user_id']=$uid;
        $where['ORG_ID']=$orgid;
        $result=$user_orgmodel->where($where)->find();

    	/*if($uid==1){
    		return true;
    	}*/
        //如果是组织超级管理员，所有应用直接通过
        if($result['identify']==1){
            return true;
        }
        if (is_string($name)) {
            $name = strtolower($name);
            if (strpos($name, ',') !== false) {
                $name = explode(',', $name);
            } else {
                $name = array($name);
            }
        }
        $list = array(); //保存验证通过的规则名
        
        $role_user_model=M("RoleUser");
        
        $role_user_join = C('DB_PREFIX').'role as b on a.role_id =b.id';
        //根据用户id和组织id 获取用户在这个组织里都有哪些角色
        $where1['user_id']=$uid;
        $where1['status']=1;
        $where1['ORG_ID']=$orgid;
        //$groups=$role_user_model->alias("a")->join($role_user_join)->where(array("user_id"=>$uid,"status"=>1，"ORG_ID"=>$orgid))->getField("role_id",true);
        $groups=$role_user_model->alias("a")->join($role_user_join)->where($where1)->getField("role_id",true);

        //查看该用户有没有角色 role_ID
        if(in_array(1, $groups)){
        	return true;//角色id包含1，返回真,表示拥有所有权限
        }

        if(empty($groups)){
            
        	return false;
        }
        
        $auth_access_model=M("AuthAccess");
        
        $join = C('DB_PREFIX').'auth_rule as b on a.rule_name =b.name';
        //authrule 和authacess表连接，  根据角色id获取拥有功能模块
        $rules=$auth_access_model->alias("a")->join($join)->where(array("a.role_id"=>array("in",$groups),"b.name"=>array("in",$name)))->select();
        
        foreach ($rules as $rule){
        	if (!empty($rule['condition'])) { //根据condition进行验证
        		$user = $this->getUserInfo($uid);//获取用户信息,一维数组
        	
        		$command = preg_replace('/\{(\w*?)\}/', '$user[\'\\1\']', $rule['condition']);
        		//dump($command);//debug
        		@(eval('$condition=(' . $command . ');'));
        		if ($condition) {
        			$list[] = strtolower($rule['name']);
        		}
        	}else{
                
        		$list[] = strtolower($rule['name']);
        	}
        }
        //dump($relation);
        if ($relation == 'or' and !empty($list)) {

            return true; 
        }

        $diff = array_diff($name, $list);//name里面有的list里要全都有

        if ($relation == 'and' and empty($diff)) {
            return true;
        }
        return false;
    }
    
    /*
     * 获得用户资料
     */
    private function getUserInfo($uid) {
    	static $userinfo=array();
    	if(!isset($userinfo[$uid])){
    		$userinfo[$uid]=M("Users")->where(array('id'=>$uid))->find();
    	}
    	return $userinfo[$uid];
    }

}
