<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/thinkcmfx/statics/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/thinkcmfx/statics/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/thinkcmfx/statics/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/thinkcmfx/statics/simpleboot/font-awesome/4.2.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		.length_3{width: 180px;}
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/thinkcmfx/statics/simpleboot/font-awesome/4.2.0/css/font-awesome-ie7.min.css">
	<![endif]-->
<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/thinkcmfx/",
    JS_ROOT: "statics/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/thinkcmfx/statics/js/jquery.js"></script>
    <script src="/thinkcmfx/statics/js/wind.js"></script>
    <script src="/thinkcmfx/statics/simpleboot/bootstrap/js/bootstrap.min.js"></script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
</head>
<body class="J_scroll_fixed">
	<div class="wrap J_check_wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo U('slide/index',array('orgid'=>$orgid));?>">所有风采</a></li>
			<li><a href="<?php echo U('slide/add',array('orgid'=>$orgid));?>">添加首页宣传图片</a></li>
			<li><a href="<?php echo U('slide/addvideo',array('orgid'=>$orgid));?>">添加宣传视频</a></li>
		</ul>
		<form class="well form-search" method="post" action="<?php echo u('slide/index',array('orgid'=>$orgid));?>"id="cid_form">
			<div class="search_type cc mb10">
				<div class="mb10">
					<select class="select_2" name="cid" style="width: 140px;" id="selected_cid">
						<!--<option value=''>全部</option>-->
						<?php if(is_array($categorys)): foreach($categorys as $key=>$vo): $cid_select=$vo['cid']===$slide_cid ? "selected":""; ?>
						<option value="<?php echo ($vo["cid"]); ?>"<?php echo ($cid_select); ?>><?php echo ($vo["cat_name"]); ?></option><?php endforeach; endif; ?>
					</select>
					<!--input type="hidden" name="orgid" id="orgid" value="<?php echo ($orgid); ?>"-->
				</div>
			</div>
		</form>
		<form class="J_ajaxForm" action="" method="post">
			<h3>宣传视频</h3>
			<table class="table table-hover table-bordered table-list" >
				<thead>
					<tr >
						<th width="20">ID</th>
						<th width="100">本组织宣传视频</th>
						<th width="200">预览</th>
						<th width="80">操作</th>
					</tr>
				</thead>
				<?php if($video['slide_id'] != null): ?><tr>
					<td><?php echo ($video['slide_id']); ?></td>
					<td><?php echo ($video['slide_name']); ?></td>
					<input type="hidden"id="video"value="<?php echo ($video['slide_video']); ?>">
					<td><a id="previewbtn" href="#" >预览</a></td>

					<td>
						
						<a href="<?php echo U('slide/deletevideo',array('id'=>$video['slide_id'],'orgid'=>$orgid));?>" class="J_ajax_del">删除</a>

<!-- 					<?php if(empty($vo['slide_status']) == 1): ?><a href="<?php echo U('slide/cancelban',array('id'=>$vo['slide_id'],'orgid'=>$orgid));?>" class="J_ajax_dialog_btn" data-msg="确定显示此幻灯片吗？">显示</a>
						<?php else: ?> 
							<a href="<?php echo U('slide/ban',array('id'=>$vo['slide_id'],'orgid'=>$orgid));?>" class="J_ajax_dialog_btn" data-msg="确定隐藏此幻灯片吗？">隐藏</a><?php endif; ?> -->
					</td>
				</tr>
				<?php else: ?>
				<tr>
					<td >
					暂无上传视频！
					</td>
				</tr><?php endif; ?>
			</table>

			<h3>风采展示图片</h3>
			<div class="table-actions">
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo u('slide/listorders',array('orgid'=>$orgid));?>">排序</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo u('slide/toggle',array('display'=>1,'orgid'=>$orgid));?>" data-subcheck="true">显示</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo u('slide/toggle',array('hide'=>1,'orgid'=>$orgid));?>" data-subcheck="true">隐藏</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('slide/delete',array('orgid'=>$orgid));?>" data-subcheck="true">删除</button>
			</div>
			<?php $status=array("1"=>"显示","0"=>"隐藏"); ?>

			<table class="table table-hover table-bordered table-list" >
				<thead>
					<tr >
						<th width="15"><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label></th>
						<th width="20">排序</th>
						<th width="20">ID</th>
						<th width="100">标题</th>
						<th width="300">描述</th>
						<!--th width="100">链接</th-->
						<th width="30">图片</th>
						<th width="30">状态</th>
						<th width="80">操作</th>
					</tr>
				</thead>
				<?php if(is_array($slides)): foreach($slides as $key=>$vo): ?><tr>
					<td><input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="ids[]" value="<?php echo ($vo["slide_id"]); ?>"></td>
					<td><input name='listorders[<?php echo ($vo["slide_id"]); ?>]' class="input input-order mr5" type='text' size='3' style="width:20px"value='<?php echo ($vo["listorder"]); ?>'></td>
					<td><?php echo ($vo["slide_id"]); ?></td>
					<td><?php echo ($vo["slide_name"]); ?></td>
					<td><?php echo ($slide_content = mb_substr($vo['slide_content'], 0, 100,'utf-8')); ?></td>
					<!--td><?php echo ($vo["slide_url"]); ?></td-->
					<td>
						<?php if(!empty($vo['slide_pic'])): ?><a href="<?php echo sp_get_asset_upload_path($vo['slide_pic']);?>" target="_blank">查看</a><?php endif; ?>
					</td>
					<td><?php echo ($status[$vo['slide_status']]); ?></td>
					<td>
						<a href="<?php echo U('slide/edit',array('id'=>$vo['slide_id'],'orgid'=>$orgid));?>">修改</a>
						<a href="<?php echo U('slide/delete',array('id'=>$vo['slide_id'],'orgid'=>$orgid));?>" class="J_ajax_del">删除</a>
						<?php if(empty($vo['slide_status']) == 1): ?><a href="<?php echo U('slide/cancelban',array('id'=>$vo['slide_id'],'orgid'=>$orgid));?>" class="J_ajax_dialog_btn" data-msg="确定显示此幻灯片吗？">显示</a>
						<?php else: ?> 
							<a href="<?php echo U('slide/ban',array('id'=>$vo['slide_id'],'orgid'=>$orgid));?>" class="J_ajax_dialog_btn" data-msg="确定隐藏此幻灯片吗？">隐藏</a><?php endif; ?>
					</td>
				</tr><?php endforeach; endif; ?>
				<?php if($vo['slide_id'] != null): else: ?>
				<tr>
					<td width="300">
					暂时没有添加风采展示图片
					</td>
				</tr><?php endif; ?>

			</table>

		</form>
	</div>

<script src="/thinkcmfx/statics/js/common.js"></script>
<script type="text/javascript" src="/thinkcmfx/statics/js/layer/layer.js"></script>
<script>
	setCookie('refersh_time', 0);
	function refersh_window() {
		var refersh_time = getCookie('refersh_time');
		if (refersh_time == 1) {
			window.location.reload();
		}
	}
	setInterval(function() {
		refersh_window()
	}, 3000);
	$(function() {
		$("#selected_cid").change(function() {
			$("#cid_form").submit();
		});
	});
$('#previewbtn').on('click', function(){
   var videoid=document.getElementById('video').value;
   var path="/thinkcmfx/data/upload/"+videoid;
  // if(videoid==null){
  //   alert('您还未上传视频！');
  // }
  layer.open({
      type: 1,
      title: false,
      area: ['700px', '500px'],
      shade: 0.3,
      closeBtn: false,
      shadeClose: true,
      content: '<video id="media"class="edui-upload-video  vjs-default-skin video-js" controls="" preload="none" width="700" height="500" src="'+path+'" data-setup="{}"></video>'
  });

});
</script>
</body>
</html>