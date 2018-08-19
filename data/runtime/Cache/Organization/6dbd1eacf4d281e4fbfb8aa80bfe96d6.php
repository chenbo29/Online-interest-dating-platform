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

<link href="/thinkcmfx/statics/js/datejs/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<link href="/thinkcmfx/statics/diyUpload/css/webuploader.css" rel="stylesheet" type="text/css">
<link href="/thinkcmfx/statics/diyUpload/css/diyUpload.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="/thinkcmfx/statics/diyUpload/js/webuploader.html5only.min.js"></script>
<script type="text/javascript" src="/thinkcmfx/statics/diyUpload/js/diyUpload.js"></script>

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

.files{height:22px; line-height:22px; margin:10px 0} 
.delimg{margin-left:20px; color:#090; cursor:pointer} 
#box{
       
        width: 770px;
        min-height: 200px;
         background: #DDDDDD;
    }
.uploadfile{width:150px;height: 14px;vertical-align: top;} 
</style>
</head>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <ul class="nav nav-tabs">
     <li><a href="<?php echo U('ActivityAdmin/pastactivity',array('orgid'=>$orgid));?>">往期活动</a></li>
     <li class="active"><a href="<?php echo U('ActivityAdmin/uploadpastact',array('orgid'=>$orgid));?>">上传往期活动</a></li>
  </ul>
  <form name="myform" id="myform" action="<?php echo U('ActivityAdmin/uploadpastact',array('orgid'=>$orgid));?>" method="post" class="form-horizontal J_ajaxForms" enctype="multipart/form-data">
  <div class="col-right">
    <div class="table_full">
      <table class="table table-bordered">
         <tr>
          <td>
            <div class="btn"> 
              <span>上传封面</span>     
              <input id="fileupload" type="file" name="picload" onchange='PreviewImage(this)'>
            </div>
            </br><b>封面预览(5x7为最佳比例)</b>
          </td>
        </tr>
        <tr >
          <td height=350>
        	   <input type="hidden" name="ORG_ID" value="<?php echo ($orgid); ?>"/>
        	   

            <div id="imgPreview" style="width:200px;">
			       <img id="img"   src=""/>
			      </div>	
		      </td>
        </tr>
        
      </table>
    </div>
  </div>
  <div class="col-auto">
    <div class="table_full">
      <table class="table table-bordered">
            <tr>
              <th width="100">活动主题</th>
              <td>
              	<input name="theme" id="theme" type="text" placeholder="请输入活动主题……">

              </td>
            </tr>

            <tr>
              <th width="70">参加人数:</th>
              <td>
              	<input type="number" style="width:80px;" name="people" placeholder="" />
              	<span class="must_red">人  *</span>
              </td>
            </tr>
            <tr>
              <th width="70">活动时间：</th>
              <td>
              <input type="text" name="begin_time"value="" id="begin_time" data-date-format="yyyy-mm-dd hh:ii">
              </td>
            </tr>

            <tr>
              <th width="70">结束时间：</th>
              <td><input type="text"name="over_time" value="" id="deadline" data-date-format="yyyy-mm-dd hh:ii"></td>
            </tr>

        	<tr>
              <th width="70">活动地点：</th>
              <td><input type='text' name='addr'  value='' style='width:400px' class='input  input_hd J_title_color'></td>
            </tr>
          <tr>
              <th width="80">活动编辑说明：</th>
              <td><span style="color:red">在下方的编辑框中，您可以使用强大的Ueditor编辑器，对活动内容进行图文并茂的排版，为节省您的空间，建议视频可上传第三方视频网站（如优酷），在要插入视频处使用<img src="/thinkcmfx/statics/images/icon/movie.png">添加视频链接即可。</span></td>
          </tr>
             <tr>
              <th width="70">活动内容:</th>
              <td>
              	
              	<!-- <textarea name='content' id='description' style='width:98%;height:150px;'placeholder="在这里，您可以进行活动内容的描述……"  ></textarea> -->
                <div id='content_tip'></div>
              <script type="text/plain" id="content" name="content"></script>
                <script type="text/javascript">
                //编辑器路径定义
                var editorURL = GV.DIMAUB;
                </script>
                <script type="text/javascript"  src="/thinkcmfx/statics/js/ueditor/ueditor.config.js"></script>
                <script type="text/javascript"  src="/thinkcmfx/statics/js/ueditor/ueditor.all.min.js"></script>
              </td>
            </tr>
            <tr>
              <th >活动精彩组图：</th>
              <td>
                <div id="box">
                   <div id="test"></div>
                  <input type="hidden" name="picture"id="picture" value=""/>
                </div>
              </td>
            </tr>
<!-- 
            <tr>
              <th width="70"><a class="btn" style="font-weight:normal"id="uploadbtn">上传活动视频</a></th>
             <td>
                 <input id="youkuid" type="hidden" name="video" >
                 <a class="btn" style="font-weight:normal"id="previewbtn">预览视频</a>
                 <lable style= "font-size:14px">请不要重复上传视频，否则我们会以您最后一次上传的视频为准！</label>
             </td>
            </tr>-->
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
                  <p style= "margin-left:180px;font-size:14px">公开后，不是您组织的成员也可以欣赏到这个精彩的活动。
                  </p>
                </div>

              </td>
            </tr>
                        
        </tbody>
      </table>

    </div>
  </div>

  	<div class="form-actions" style="margin-top:0px">
        <input class="btn" id="postform"type="button"value="发布">
      	<a id="asdfg"class="btn" href="<?php echo U('ActivityAdmin/pastactivity',array('orgid'=>$orgid));?>">返回</a>

    </div>
 </form>
</div>

<script type="text/javascript" src="/thinkcmfx/statics/js/common.js"></script>
<script type="text/javascript" src="/thinkcmfx/statics/js/content_addtop.js"></script>
<script type="text/javascript" src="/thinkcmfx/statics/js/datejs/bootstrap-datetimepicker.js"></script>

<script type="text/javascript" src="/thinkcmfx/statics/js/layer/layer.js"></script>
<script type="text/javascript"> 

$('#uploadbtn').on('click', function(){
    layer.open({
        type: 2,
        area: ['700px', '600px'],
        shadeClose: true, //点击遮罩关闭
        content: '/thinkcmfx/youkuupload/upload.html',

        success: function(layero,index){
    }

    });
});
$('#previewbtn').on('click', function(){
   var videoid=document.getElementById('youkuid').value;
  // if(videoid==null){
  //   alert('您还未上传视频！');
  // }
  layer.open({
      type: 2,
      title: false,
      area: ['630px', '360px'],
      shade: 0.8,
      closeBtn: false,
      shadeClose: true,
      content: 'http://player.youku.com/embed/'+videoid
  });

});
$('#postform').on('click', function(){
layer.confirm('您是否确认发布，提交后您将不能修改内容?',{
    btn: ['发布','返回修改']
}, function(){
    document.getElementById("myform").submit();
    
    //layer.close(index);
  });
});
//bootstrap里的时间插件
$('#deadline').datetimepicker();//日期插件
$('#begin_time').datetimepicker();

var allname="";
var flag=1;
//批量上传图片
$('#test').diyUpload({
	// url:'/thinkcmfx/application/Common/Common/fileupload.php',
	url:"<?php echo U('Pastactpicupload/index');?>",
	success:function( data ) {
    if(flag==1){
      allname=data['_raw'];
      flag=0;
    }else{
		  allname=allname+'+'+data['_raw'];
    }
		document.getElementById('picture').value=allname;

		console.info( allname );
	},
	error:function( err ) {
		console.info( err );	
	}
});
/*百度Ueditor编辑器*/
var editorOption = {

serverUrl: "<?php echo U('Asset/UeditorPastactivity/upload',array('orgid'=>$orgid));?>",
//这里可以选择自己需要的工具按钮名称,此处仅选择如下五个
toolbars: [['fullscreen',  'undo', 'redo', 
      '|', 'emotion','bold','spechars', 'forecolor', 'fontfamily', 'fontsize','paragraph', 'formatmatch','indent',
        'forecolor', 'justifyleft','justifyright','justifycenter', 'justifyjustify', 'autotypeset','charts', 
      '|','map', 
      'link', 'simpleupload', 'insertimage', 'imageleft', 'imageright', 'imagecenter',  'insertvideo', 'music',
      '|','time','date','help',
]],

};
editorcontent = new baidu.editor.ui.Editor(editorOption);
editorcontent.render( 'content' );
try{editorcontent.sync();}catch(err){};

/*//增加编辑器验证规则
jQuery.validator.addMethod('editorcontent',function(){
  try{editorcontent.sync();}catch(err){};
  return editorcontent.hasContents();
});
*/

function PreviewImage(imgFile)
{
     var filextension=imgFile.value.substring(imgFile.value.lastIndexOf("."),imgFile.value.length);
     filextension=filextension.toLowerCase();
     if ((filextension!='.jpg')&&(filextension!='.gif')&&(filextension!='.jpeg')&&(filextension!='.png')&&(filextension!='.bmp'))
     {
         alert("对不起，系统仅支持标准格式的照片，请您调整格式后重新上传，谢谢 !");
         imgFile.focus();
     }
     else
     {
         var path;
         if(document.all)//IE
         {
             imgFile.select();
             path = document.selection.createRange().text;
             document.getElementById("imgPreview").innerHTML="";
             document.getElementById("imgPreview").style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='scale',src=\"" + path + "\")";//使用滤镜效果 
            //  alert(path);     
         }
         else//FF
         {
         	 document.getElementById("imgPreview").innerHTML="";
             path=window.URL.createObjectURL(imgFile.files[0]);// FF 7.0以上
             //path = imgFile.files[0].getAsDataURL();// FF 3.0

             document.getElementById("imgPreview").innerHTML = "<img id='img1'  src='"+path+"'/>";
            	// alert(path); 
             //document.getElementById("img1").src = path;
         }
     }
}

</script>

</body>
</html>