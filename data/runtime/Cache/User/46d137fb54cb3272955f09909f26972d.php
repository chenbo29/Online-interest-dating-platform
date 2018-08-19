<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
<title>上社团，您身边的兴趣圈</title>
<meta charset="utf-8">
<link href="/thinkcmfx/tpl/test/Public/css/stcss/home.css?v=2" rel="stylesheet" type="text/css" />
<script src="/thinkcmfx/statics/js/jquery.js"></script>
<style type="text/css">
#forgetpwd{
margin-top: 12px;

float:right;
font-size: 14px;
color: #1B66C7;
}
p{
font-size:20px;
color: red;
}
</style>
</head>

<body>

<div class="wrap">
	<div class="banner-show" id="js_ban_content">
		<div class="cell bns-01">
			<div class="con">
			</div>
		</div>
		<div class="cell bns-02" style="display:none;">
			<div class="con">
				  </div>
		</div>
		<div class="cell bns-03" style="display:none;">
			<div class="con">
				<!-- <a href="http://sc.chinaz.com" target="_blank" class="banner-link">
				<i>企业云</i></a>  --></div>
		</div>
	</div>
	<div class="banner-control" id="js_ban_button_box">
		<a href="javascript:;" class="left">左</a>
		<a href="javascript:;" class="right">右</a> </div>

	<div class="container">
		<div class="register-box">
			<div class="reg-slogan">
				用户登录</div>
			<div class="reg-form" id="js-form-mobile">
				<br>
				<br>
				<div class="cell">
				<form id="homeform"class="form-horizontal J_ajaxForms" action="<?php echo U('user/login/dologin');?>" method="post">
					
					<input type="text" name="username" id="username" class="text" maxlength="11" placeholder="请输入用户名或者邮箱" />
				</div>
                <p id="usernameerror"></p>
				<div class="cell">
					<input type="password" name="password" id="password" class="text" placeholder="请输入密码"/>
					
				</div>
			 <p id="passworderror"></p>
				<div class="cell vcode">
					<input type="text" id="input_verify" name="verify"  class="span3" placeholder="请输入验证码">
				<?php echo sp_verifycode_img();?> 

                    <a id="forgetpwd"href="<?php echo U('user/login/forgot_password');?>">忘记密码</a>

                </div>
                    <p id="verifyerror"></p>

				<div class="bottom">
					<input type="button" id="login"  class="button btn-green"value='登录'>
					
                </div>
                </form>
				<div class="bottom">
					<button  onclick="register()" class="button btn-blue">
					注册</button>
                </div>
				

			</div>
		</div>
	</div>
</div>
<div class="footer">
	<div class="con">
		<div class="copy-right">
			<div class="cell">
				<div style="text-align:center;margin:50px 0; font:normal 14px/24px 'MicroSoft YaHei';">
					<p>留作社团推荐图片</p>
					<p><a href="#" target="_blank">留作社团推荐图片</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">


    function register(){
        window.location.href="<?php echo U('User/Register/index');?>";
    }

;(function(){

    $('#login').click(function(){
        var $username=$('#username').val();
        var $password=$('#password').val();
        var $verify=$('#input_verify').val();
        var $action=$('#homeform').attr('action');

        $.post($action,{username:$username,password:$password,verify:$verify},function(data){

            $('#usernameerror').html('');
            $('#passworderror').html('');
            $('#verifyerror').html('');

            if(data['username']){
                $('#usernameerror').html(data['username']);
            }
            if(data['password']){
                $('#passworderror').html(data['password']);
            }
            if(data['statu']==-1)
            {
                $('#verifyerror').html(data['info']);
            }
            if(data['statu']==-2)
            {
                $('#passworderror').html(data['info']);
            }
            if(data['statu']==-3)
            {
                $('#usernameerror').html(data['info']);
            }if(data.status==1){
                window.location.href=data.url;
            }
        });
    })





    var defaultInd = 0;
    var list = $('#js_ban_content').children();
    var count = 0;
    var change = function(newInd, callback){
        if(count) return;
        count = 2;
        $(list[defaultInd]).fadeOut(400, function(){
            count--;
            if(count <= 0){
                if(start.timer) window.clearTimeout(start.timer);
                callback && callback();
            }
        });
        $(list[newInd]).fadeIn(400, function(){
            defaultInd = newInd;
            count--;
            if(count <= 0){
                if(start.timer) window.clearTimeout(start.timer);
                callback && callback();
            }
        });
    }

    var next = function(callback){
        var newInd = defaultInd + 1;
        if(newInd >= list.length){
            newInd = 0;
        }
        change(newInd, callback);
    }

    var start = function(){
        if(start.timer) window.clearTimeout(start.timer);
        start.timer = window.setTimeout(function(){
            next(function(){
                start();
            });
        }, 8000);
    }

    start();

    $('#js_ban_button_box').on('click', 'a', function(){
        var btn = $(this);
        if(btn.hasClass('right')){
            //next
            next(function(){
                start();
            });
        }
        else{
            //prev
            var newInd = defaultInd - 1;
            if(newInd < 0){
                newInd = list.length - 1;
            }
            change(newInd, function(){
                start();
            });
        }
        return false;
    });

})();
</script>
</body>

</html>