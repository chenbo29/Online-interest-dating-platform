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
	<div class="wrap">
		<ul class="nav nav-tabs">
     		<li class="active"><a href="<?php echo U('ActivityAdmin/pastactivity',array('orgid'=>$orgid));?>">往期活动</a></li>
     		<li ><a href="<?php echo U('ActivityAdmin/uploadpastact',array('orgid'=>$orgid));?>">发布往期活动</a></li>
		</ul>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="50">ID</th>
					<th>活动主题</th>
					<th>参与人数</th>
					<th>活动时间</th>
					<th>结束时间</th>
					<th>活动地点</th>
					<th>活动图片</th>
					<th>活动视频</th>
					<th width="120">管理操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($data)): foreach($data as $key=>$vo): ?><tr>
					<td><?php echo ($vo["id"]); ?></td>
					<td><?php echo ($vo["theme"]); ?></td>
					<td><?php echo ($vo["people"]); ?></td>
					<td>
						<?php if($vo['begin_time'] == null): ?>无
						<?php else: ?>
							<?php echo ($vo["begin_time"]); endif; ?>
					</td>
					<td>
						<?php if($vo['begin_time'] == null): ?>无
						<?php else: ?>
							<?php echo ($vo["over_time"]); endif; ?>
					</td>
					<td><?php echo ($vo['addr']); ?></td>
					<td>

						<?php if(empty($vo['cover_picture'])): ?>无
						<?php else: ?>
						<img width="25" height="25" src="<?php echo sp_get_asset_upload_path($vo['cover_picture']);?>" class="headicon"/><?php endif; ?>
					</td>
					<td>
						<?php if(empty($vo['video'])): ?>无
						<?php else: ?>
							<input type="hidden" id="video" value="<?php echo ($vo['video']); ?>">
							<a class="preview" href="#" onclick="fun(this)"title="<?php echo ($vo['video']); ?>">预览</a><?php endif; ?>
					</td>
					<td>
						<!--a href='<?php echo U("ActivityAdmin/pastactivityedit",array("id"=>$vo["id"],"orgid"=>$orgid));?>'>修改</a|-->  
						<a class="J_ajax_del" href="<?php echo U('ActivityAdmin/pastactivitydelete',array('id'=>$vo['id'],'orgid'=>$orgid));?>">删除</a>

					</td>
				</tr><?php endforeach; endif; ?>

			</tbody>

		</table>
		<div class="pagination"><?php echo ($page); ?></div>
	</div>
<script src="/thinkcmfx/statics/js/common.js"></script>
<script type="text/javascript" src="/thinkcmfx/statics/js/layer/layer.js"></script>
<script type="text/javascript">

/*
$('.preview').on('click', function(){
var videoid=document.getElementById('video').value;
layer.open({
  type: 2,
  title: false,
  area: ['630px', '360px'],
  shade: 0.8,
  closeBtn: false,
  shadeClose: true,
  content: 'http://player.youku.com/embed/'+videoid
});

});*/
	function fun (btn) {
		// body...
		/*不能用id*/
		var videoid=$(btn).attr('title');
		//alert(value);
		layer.open({
			  type: 2,
			  title: false,
			  area: ['630px', '360px'],
			  shade: 0.8,
			  closeBtn: false,
			  shadeClose: true,
			  content: 'http://player.youku.com/embed/'+videoid
			});

	}

	</script>
</body>
</html>