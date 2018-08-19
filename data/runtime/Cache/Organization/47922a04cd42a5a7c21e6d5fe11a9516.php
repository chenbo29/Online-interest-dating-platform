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
<script type="text/javascript" src="/thinkcmfx/statics/js/layer/layer.js"></script>
</head>
<body class="J_scroll_fixed">
	<div class="wrap J_check_wrap">
		<ul class="nav nav-tabs">
     		<li class="active"><a href="<?php echo U('OrganizationAdmin/notice',array('orgid'=>$orgid));?>">所有公告</a></li>
     		<li ><a href="<?php echo U('OrganizationAdmin/launchnotice',array('orgid'=>$orgid));?>">发布公告</a></li>
		</ul>

		<table class="table table-hover table-bordered" style="">
			<thead>
				<tr >
					<th width="50">ID</th>
					<th>标题</th>
					<th>发布时间</th>
					<th width="">公告内容</th>
					<th>点击量</th>
					<th width="60">游客可见</th>
					<th width="120">管理操作</th>
				</tr>
			</thead>
			<tbody>
				<?php $permission=array("0"=>"不可见","1"=>"可见"); ?>
				<?php if(is_array($data)): foreach($data as $key=>$vo): ?><tr>
					<td><?php echo ($vo["id"]); ?></td>
					<td><?php echo ($vo["title"]); ?></td>
					<td><?php echo ($vo["time"]); ?></td>
					<td >
					<a href='<?php echo U("OrganizationAdmin/looknotice",array("id"=>$vo["id"],"orgid"=>$orgid));?>' title="">详细</a>
					</td>
					<td><?php echo ($vo['hits']); ?></td>
					<td>
						<?php echo ($perimission[$vo['permission']]); ?>
					</td>

					<td>
						<a href='<?php echo U("OrganizationAdmin/editnotice",array("id"=>$vo["id"],"orgid"=>$orgid));?>'>修改</a> | 
						<a href='<?php echo U("OrganizationAdmin/looknotice",array("id"=>$vo["id"],"orgid"=>$orgid));?>'>详细</a> | 
						<a class="J_ajax_del" href="<?php echo U('OrganizationAdmin/deletenotice',array('id'=>$vo['id'],'orgid'=>$orgid));?>">删除</a>

					</td>
				</tr><?php endforeach; endif; ?>

			</tbody>
			<tr>
				<label>对于过期的公告，请您尽快清除，这样可以方便您更快的查看有效的内容。</label>
			</tr>
		</table>
		<div class="pagination"><?php echo ($page); ?></div>
	</div>
<script src="/thinkcmfx/statics/js/common.js"></script>

</body>
</html>