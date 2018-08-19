<?php
namespace Common\Model;
use Common\Model\CommonModel;
class PostsModel extends CommonModel {
	/*
	 * 表结构
	 * id:post的自增id
	 * post_author:用户的id
	 * post_date:发布时间
	 * post_content
	 * post_title
	 * post_excerpt:发表内容的摘录
	 * post_status:发表的状态,可以有多个值,分别为publish->发布,delete->删除,...
	 * comment_status:
	 * post_password
	 * post_name
	 * post_modified:更新时间
	 * post_content_filtered
	 * post_parent:为父级的post_id,就是这个表里的ID,一般用于表示某个发表的自动保存，和相关媒体而设置
	 * post_type:可以为多个值,image->表示某个post的附件图片;audio->表示某个post的附件音频;video->表示某个post的附件视频;...
	 */
	//post_type,post_status注意变量定义格式;
		protected $_validate = array(
			//array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
			array('post[post_content]','0,5000','内容说明过长！',0,'length'),
			array('post[post_keywords]','0,3','关键字过长！',0,'length'),
	);
	protected $_auto = array (
		array ('post_date', 'mGetDate', 1, 'callback' ), 	// 增加的时候调用回调函数
		//array ('post_modified', 'mGetDate', 2, 'callback' ) 
	);
	// 获取当前时间
	function mGetDate() {
		return date ( 'Y-m-d H:i:s' );
	}
	
	protected function _before_write(&$data) {
		parent::_before_write($data);
	}
}