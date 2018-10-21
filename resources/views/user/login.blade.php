
<!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="shortcut icon" href="/home/images/favicon.ico" type="image/x-icon" />
    <title>zane'Blog</title>
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/login.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>
    <script type="text/javascript" src="/js/jquery.supersized.min.js" ></script>
    <script type="text/javascript" src="/js/jquery.progressBar.js"></script>
    <script type="text/javascript" src="/js/layer/layer.js"></script>
    <script type="text/javascript" src="/js/login.js"></script>
    <script type="text/javascript">
        var loginHandleUrl = "{{ url('/admin/login') }}";
        var homeUrl = "{{url('/admin/home')}}";
        var _token = "{{csrf_token()}}";
    </script>
</head>
<body>
<!--v3-v12-->
<div class="login-layout">
    <div class="top">
        <h5><em></em></h5>
        <h2>hi zane</h2>
    </div>
    <form method="post" id="form_login" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="lock-holder">
            <div class="form-group pull-left input-username">
                <label for="admin_name">账号</label>
                <input id="admin_name" type="email" class="form-control input-text" name="email" value="" tabindex='1' required autofocus title="请输入登陆账号">
            </div>
            <i class="fa fa-ellipsis-h dot-left"></i>
            <i class="fa fa-ellipsis-h dot-right"></i>
            <div class="form-group pull-right input-password-box">
                <label>密码</label>
                <input id="admin_password" type="password" class="form-control input-text" name="password" required autocomplete="off" tabindex='2' pattern="[\S]{6}[\S]*" title="密码不少于6个字符">
            </div>
        </div>
        <div class="avatar"><img src="/images/admin.png" alt=""></div>
        <div class="submit"> 
            <span>
                <div class="code">
                    <div class="arrow"></div>
                    <div class="code-img">
                        <img src="{{captcha_src()}}" name="codeimage" id="codeimage" onclick="verifyimage()" border="0"/>
                    </div>
                    <a href="JavaScript:void(0);" id="hide" class="close" title="关闭"><i></i></a>
                    <a href="JavaScript:void(0);" onclick="verifyimage()" class="change" title="看不清,点击更换验证码"><i></i></a> 
                </div>
                <input name="captcha" type="text" required class="input-code" tabindex='3' id="captcha" placeholder="输入验证" pattern="[A-z0-9]{4}" title="验证码为4个字符" autocomplete="off" value="" >
            </span>
            <span>
              <input name="" class="input-button btn-submit" type="button" value="登录">
            </span>
        </div>
        <div class="submit2"></div>
    </form>
    <div class="bottom">
    </div>
</div>
<script>
    $(function(){
        $.supersized({
            // 功能
            slide_interval     : 4000,
            transition         : 1,
            transition_speed   : 1000,
            performance        : 1,

            // 大小和位置
            min_width          : 0,
            min_height         : 0,
            vertical_center    : 1,
            horizontal_center  : 1,
            fit_always         : 0,
            fit_portrait       : 1,
            fit_landscape      : 0,

            // 组件
            slide_links        : 'blank',
            slides             : [
                {image : '/images/1.jpg'},
                {image : '/images/2.jpg'},
                {image : '/images/3.jpg'},
                {image : '/images/4.jpg'},
                {image : '/images/5.jpg'}
            ]
        });
        //显示隐藏验证码
        $("#hide").click(function(){
            $(".code").fadeOut("slow");
        });
        $("#captcha").focus(function(){
            $(".code").fadeIn("fast");
        });
        //跳出框架在主窗口登录
        if(top.location!=this.location)	top.location=this.location;
        $('#admin_name').focus();
        if ($.browser.msie && ($.browser.version=="6.0" || $.browser.version=="7.0")){
            window.location.href='/';
        }
        $("#captcha").nc_placeholder();
        //动画登录
    });
    var verifyUrl = "{{captcha_src()}}";
    function verifyimage(){
        $('#codeimage').attr('src', verifyUrl+'&r='+Math.random());
    }
</script>
</body>
</html>