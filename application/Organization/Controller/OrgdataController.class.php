<?php

/**
 * 
 */
namespace Organization\Controller;
use Common\Controller\HomeBaseController;
class OrgdataController extends HomeBaseController {
    
	function logo(){
		
		$org_model=M("Organization");
		$stid=I("get.stid",0,"intval");
		
		$orgdata=$org_model->field('logo')->where(array("id"=>$stid))->find();
		//dump($orgdata);
		$logo=$orgdata['logo'];
		$should_show_default=false;
		
		if(empty($logo)){
			$should_show_default=true;
		}else{
			if(strpos($logo,"http")===0){
				header("Location: $logo");exit();
			}else{
				$logo_dir=C("UPLOADPATH");
				$logo=$logo_dir.$logo;
				if(file_exists($logo)){
					$imageInfo = getimagesize($logo);
					if ($imageInfo !== false) {
						$mime=$imageInfo['mime'];
						header("Content-type: $mime");
						
						echo file_get_contents($logo);
					}else{
						$should_show_default=true;
					}
				}else{
					$should_show_default=true;
				}
			}
			
			
		}
		
		if($should_show_default){
			$imageInfo = getimagesize("data/upload/orglogo/default.jpg");
			if ($imageInfo !== false) {
				$mime=$imageInfo['mime'];
				//header("Content-type: $mime");
				echo file_get_contents("data/upload/orglogo/default.jpg");
			}
			
		}
		exit();
		
	}

    

    
}
