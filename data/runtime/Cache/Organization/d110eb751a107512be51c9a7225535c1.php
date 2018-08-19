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
     <li><a href="<?php echo U('ActivityAdmin/currentactivity',array('orgid'=>$orgid));?>">当前活动</a></li>
     <li class="active"><a href="<?php echo U('ActivityAdmin/launchactivity',array('orgid'=>$orgid));?>">发布活动</a></li>
  </ul>
  <form name="myform" id="myform" action="<?php echo U('ActivityAdmin/launchactivity',array('orgid'=>$orgid));?>" method="post" class="form-horizontal J_ajaxForms" enctype="multipart/form-data">
  <div class="col-right">
    <div class="table_full">
      <table class="table table-bordered">
         <tr>
          <td><b>宣传图片预览</b></td>
        </tr>
        <tr >
          <td height=350>
        	<input type="hidden" name="ORG_ID" value="<?php echo ($orgid); ?>"/>
        	<input type="hidden" name="launcher" value="<?php echo ($adminid); ?>"/>
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
              <th width="130">活动主题</th>
              <td>
              	<input name="theme" type="text" placeholder="请输入活动主题……">
          	<!--
              <select name="theme" class="normal_select">
                  <option value="0">默认分类</option>
                  <?php if(is_array($categorys)): foreach($categorys as $key=>$vo): ?><option value="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["cat_name"]); ?></option><?php endforeach; endif; ?>
                </select>
            -->
              </td>
            </tr>
            <tr>
              <th >上传活动宣传海报：</th>
              <td>
              <!--
              	<input type="text" style="width:400px;" name="slide_name" id="title" value="" style="color:" class="input input_hd J_title_color" placeholder="请输入幻灯片名称" onkeyup="strlen_verify(this, 'title_len', 160)" />
              	<span class="must_red">*</span>
              -->
               
			<div class="btn"> 
     			<span>添加图片</span> 		
   				<input id="fileupload" type="file" name="picload" onchange='PreviewImage(this)'>

			</div>
				<label style="float:right;margin-right:200px;margin-top:5px;font-size:15px">
					为了达到最佳显示效果，您的图片尺寸比例应该为5:7
				</label> 
            </td>
            </tr>
            <tr>
              <th width="80">参加人数上限:</th>
              <td>
              	<input type="number" style="width:80px;" name="require" placeholder="" />
              	<span class="must_red">人  *</span>
              </td>
            </tr>
            <tr>
              <th width="80">报名截止时间：</th>
              <td><input type="text"name="deadline" value="<?php echo ($data['deadline']); ?>" id="deadline" data-date-format="yyyy-mm-dd hh:ii"></td>
            </tr>

            <tr>
              <th width="80">活动时间：</th>
              <td>
              <input type="text" name="begin_time"value="<?php echo ($data['begin_time']); ?>" id="begin_time" data-date-format="yyyy-mm-dd hh:ii">
              </td>
            </tr>
        	<!---->
        	<tr>
              <th width="80">活动地点：</th>
              <td><input type='text' name='addr'  value='' style='width:400px' class='input  input_hd J_title_color'></td>
            </tr>
             <tr>
              <th width="80">活动内容简介:</th>
              <td>
              	
              	<textarea name='content' id='description' style='width:98%;height:150px;'placeholder="在这里，您可以进行活动相关事宜的说明……"  ></textarea>
              </td>
            </tr>
            
                        
        </tbody>
      </table>
    </div>
  </div>
  	<div class="form-actions" style="margin-top:0px">
           <input class="btn btn-primary btn_submit J_ajax_submit_btn"type="submit"value="发布">
      		<a class="btn" href="<?php echo U('ActivityAdmin/lookactivity',array('orgid'=>$orgid));?>">返回</a>
    </div>
 </form>
</div>
<script type="text/javascript" src="/thinkcmfx/statics/js/common.js"></script>
<script type="text/javascript" src="/thinkcmfx/statics/js/content_addtop.js"></script>
<script type="text/javascript" src="/thinkcmfx/statics/js/datejs/bootstrap-datetimepicker.js"></script>

<script type="text/javascript"> 
//bootstrap里的时间插件
$('#deadline').datetimepicker();
$('#begin_time').datetimepicker();

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