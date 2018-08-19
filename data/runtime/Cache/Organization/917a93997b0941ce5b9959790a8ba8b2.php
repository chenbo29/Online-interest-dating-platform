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
			<li class="active"><a href="<?php echo U('OrganizationAdmin/lookapply',array('orgid'=>$orgid));?>" >天外来客</a>
			</li>
		</ul>
		<form method="post" class="J_ajaxForm" action="#">
			<div class="table_list">
				<table class="table table-hover table-bordered table-layout:fixed; ">
					<thead>
						<tr>
							<th width="45">申请人</th>
							<th>昵称</th>
							<th width="40">头像</th>
							<th>E-mail</th>
							<th>申请时间</th>
							<th width="41">所在城市</th>
							<th>电话</th>
							<th>性别</th>
							<th>加入原因</th>
							<th align='center' width="60">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($info)): foreach($info as $key=>$vo): ?><tr>
							<td><?php echo ((isset($vo["user_login"]) && ($vo["user_login"] !== ""))?($vo["user_login"]):'第三方用户'); ?></td>
							<td><?php echo ((isset($vo["user_nicename"]) && ($vo["user_nicename"] !== ""))?($vo["user_nicename"]):'无'); ?></td>
							<td><img width="25" height="25" src="<?php echo U('user/public/avatar',array('id'=>$vo['user_id']));?>" /></td>
							<td><?php echo ($vo["user_email"]); ?></td>
							<td><?php echo (date("Y-m-d",$vo["createtime"])); ?></td>
							<td><?php echo ($vo["city"]); ?></td>
							<td><?php echo ($vo["tel"]); ?></td>
							<td><?php echo ($vo["sex"]); ?></td>
							<td><?php echo ($vo["whyjoin"]); ?></td>
							<td align='center'>
								<a href="<?php echo U('OrganizationAdmin/agreeapply',array('id'=>$vo['id'],'orgid'=>$orgid));?>" class="J_ajax_dialog_btn" data-msg="您确定要加入此用户吗？">同意</a>|
								<a href="<?php echo U('OrganizationAdmin/disagree',array('id'=>$vo['id'],'orgid'=>$orgid));?>" class="J_ajax_dialog_btn" data-msg="您确定要拒绝申请吗？">拒绝</a>
							</td>
						</tr><?php endforeach; endif; ?>
					<?php if($vo['user_login'] == null): ?><tr>

							<td width="450">
								<span style="color:red;">暂无申请加入我们的用户,您可以通过丰富您组织的的资料以吸纳更多同城兴趣好友！
								</span>
							</td>

						</tr><?php endif; ?>

					</tbody>
				</table>
				<div class="pagination"><?php echo ($page); ?></div>
			</div>
		</form>
	</div>
	<script src="/thinkcmfx/statics/js/common.js"></script>
</body>
</html>