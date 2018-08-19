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
<style type="text/css">
.col-auto { overflow: auto; _zoom: 1;_float: left;}
.col-right { float: right; width: 210px; overflow: hidden; margin-left: 6px; }
.table th, .table td {vertical-align: middle;}
.btn{position: relative;overflow: hidden;margin-right: 4px;display:inline-block; 
*display:inline;padding:4px 10px 4px;font-size:14px;line-height:18px; 
*line-height:20px;color:#fff; 
text-align:center;vertical-align:middle;cursor:pointer;background:#5bb75b; 
border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf; 
border-bottom-color:#b3b3b3;-webkit-border-radius:4px; 
-moz-border-radius:4px;border-radius:4px;} 
.btn input{position: absolute;top: 0; right: 0;margin: 0;border:solid transparent; 
opacity: 0;filter:alpha(opacity=0); cursor: pointer;} 
.progress{position:relative; margin-left:100px; margin-top:-24px;  
width:200px;padding: 1px; border-radius:3px; display:none} 
.bar {background-color: green; display:block; width:0%; height:20px;  
border-radius:3px; } 
.percent{position:absolute; height:20px; display:inline-block;  
top:3px; left:2%; color:#fff } 
.files{height:22px; line-height:22px; margin:10px 0} 
.delimg{margin-left:20px; color:#090; cursor:pointer} 

</style>
<link href="/thinkcmfx/statics/js/datejs/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <ul class="nav nav-tabs">
     <li><a href="<?php echo U('OrganizationAdmin/notice',array('orgid'=>$orgid));?>">所有公告</a></li>
     <li class="active"><a href="<?php echo U('OrganizationAdmin/launchnotice',array('orgid'=>$orgid));?>">发布公告</a></li>
  </ul>
  <form name="myform" id="myform" action="<?php echo U('OrganizationAdmin/launchnotice',array('orgid'=>$orgid));?>" method="post" class="form-horizontal J_ajaxForms" enctype="multipart/form-data">
  <div class="col-right">
    <div class="table_full">

    </div>
  </div>
  <div class="col-auto">
    <div class="table_full">
      <table class="table table-bordered">
            <tr>
              <th width="130">公告标题</th>
              <td>
              	<input name="title" style="width:50%"type="text" placeholder="请输入公告标题……">
          	<!--
              <select name="theme" class="normal_select">
                  <option value="0">默认分类</option>
                  <?php if(is_array($categorys)): foreach($categorys as $key=>$vo): ?><option value="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["cat_name"]); ?></option><?php endforeach; endif; ?>
                </select>
            -->
              </td>
            </tr>
             <tr>
              <th width="80">公告内容:</th>
              <td>
               <div id='content_tip'></div>
                <script type="text/plain" id="content" name="content"></script>
                <script type="text/javascript">
                //编辑器路径定义
                var editorURL = GV.DIMAUB;
                </script>
                <script type="text/javascript"  src="/thinkcmfx/statics/js/ueditor/ueditor.config.js"></script>
                <script type="text/javascript"  src="/thinkcmfx/statics/js/ueditor/ueditor.all.min.js"></script>

<!--               <td>
              	
              	<textarea name='content' id='description' style='width:98%;height:150px;'placeholder="……"  ></textarea>
               </td>-->
             </td>
            </tr>
            <tr> 
              <th width="70">是否公开:</th>
              <td>
                <div class="controls">
                  <label class="radio inline"style="float:left">
                    <input type="radio" name="permission" value="1" checked>公开
                  </label>
                  <label class="radio inline" style="float:left">
                    <input type="radio" value="0"name="permission">不公开
                  </label>
                  <p style= "margin-left:180px;font-size:14px">公开后，不是您组织的成员也可以看到这个公告。
                  </p>
                </div>
              </td>
            </tr>
                        
      </table>
    </div>
  </div>
  	<div class="form-actions" style="margin-top:0px">
           <input class="btn btn-primary btn_submit J_ajax_submit_btn"type="submit"value="发布">
      		<a class="btn" href="<?php echo U('OrganizationAdmin/notice',array('orgid'=>$orgid));?>">返回</a>
    </div>
 </form>
</div>
<script type="text/javascript" src="/thinkcmfx/statics/js/common.js"></script>
<script type="text/javascript" src="/thinkcmfx/statics/js/content_addtop.js"></script>
<!-- <script type="text/javascript" src="/thinkcmfx/statics/js/datejs/bootstrap-datetimepicker.js"></script> -->

<script type="text/javascript"> 
//bootstrap里的时间插件
/*$('#deadline').datetimepicker();
$('#begin_time').datetimepicker();*/
var editorOption = {

serverUrl: "",
//这里可以选择自己需要的工具按钮名称,此处仅选择如下五个
toolbars: [['fullscreen',  'undo', 'redo', 
      '|', 'bold','spechars', 'forecolor', 'fontfamily', 'fontsize','paragraph', 'formatmatch','indent',
        'forecolor', 'justifyleft','justifyright','justifycenter', 'justifyjustify', 'autotypeset','charts', 'time','date',
 
]],
initialFrameWidth:'100%' ,//初始化编辑框宽高
initialFrameHeight:300,
initialContent:'',
};
editorcontent = new baidu.editor.ui.Editor(editorOption);
editorcontent.render( 'content' );
try{editorcontent.sync();}catch(err){};


</script>

</body>
</html>