<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico"> <link href="/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/admin/css/animate.css" rel="stylesheet">
    <link href="/admin/css/style.css?v=4.1.0" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight" style="padding:0px;">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <form id="admin" method="post" class="form-horizontal">
                <div class="form-group checkForm">
                    <label class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-10">
                        <input type="text" id="username" class="form-control" value="{{Auth::guard('admin')->user()->name}}">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group checkForm">
                    <label class="col-sm-2 control-label">邮箱</label>
                    <div class="col-sm-10">
                        <input type="email" id="email" class="form-control" name="email" required value="{{Auth::guard('admin')->user()->email}}" placeholder="邮箱">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group checkForm">
                    <label class="col-sm-2 control-label">签名</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" required id="autograph" name="autograph" value="{{Auth::guard('admin')->user()->autograph}}" placeholder="个人签名">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">封面图片</label>

                    <div class="col-sm-6">
                        <label><img id="gravatar" src="{{Auth::guard('admin')->user()->gravatar}}" alt="no images" width="120" height="90" class="img-thumbnail"><span style="padding:0 20px;"><label class="btn btn-outline" onclick="setCover()"><i class="glyphicon glyphicon-plus"></i></label></span></label>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group checkForm">
                    <label class="col-sm-2 control-label">描述</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" required id="description" name="description"  placeholder="说说自己">{{Auth::guard('admin')->user()->description}}</textarea>
                    </div>
                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">更改密码</label>
                    <div class="col-sm-10">
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" class="onoffswitch-checkbox" id="confirm">
                                <label class="onoffswitch-label" for="confirm">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="pwd-toggle" hidden>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group checkForm">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="password" style="display:none;">
                            <input type="password" autoComplete="off" class="form-control" id="password" name="password">
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-info" type="button" onclick="submitInfo();">确认修改</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div style="position:absolute;top:40%;right:5px;z-index:2;"><button class="btn btn-danger" onclick="imgList()"><i class="glyphicon glyphicon-bookmark"></i></button></div>
<!-- 全局js -->
<script src="/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/admin/js/plugins/layer/layer.min.js"></script>
<script src="/admin/js/plugins/validate/jquery.validate.min.js"></script>
<script>
    $(function(){
        layer.config({extend: 'extend/layer.ext.js'});
    });
    function submitInfo(){
        var name = $('#username').val();
        var email = $('#email').val();
        var autograph = $('#autograph').val();
        var gravatar = $('#gravatar').attr('src');
        var password = $('#password').val();
        var description = $('#description').val();
        var flag = true;
        if(name.length<=0){
            $('.checkForm').eq(0).addClass('has-error');
            flag = false;
        }else{
            $('.checkForm').eq(0).removeClass('has-error');
        }
        if(email.length<=0){
            $('.checkForm').eq(1).addClass('has-error');
            flag = false;
        }else{
            $('.checkForm').eq(1).removeClass('has-error');
        }
        if(autograph.length<=0){
            $('.checkForm').eq(2).addClass('has-error');
            flag = false;
        }else{
            $('.checkForm').eq(2).removeClass('has-error');
        }
        if(!flag)
            return;
        $.post(
            '/admin/edit',
            {
                _token:"{{csrf_token()}}",
                name:name,
                email:email,
                autograph:autograph,
                gravatar:gravatar,
                password:password,
                description:description
            },
            function(response){
                if(response.status == 'success'){
                    parent.parent.layer.msg('修改成功,为您刷新登个人信息',{
                        time:2000
                    });
                    setTimeout(function(){
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                    },2000);
                }else{
                    parent.parent.layer.msg('修改个人信息失败',{
                        time:2000
                    });
                    setTimeout(function(){
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                    },2000);

                }
            },
            'json'
        );

    }
    function imgList() {
        layer.open({
            type: 2,
            title: '图片列表',
            shadeClose: true,
            shade: false,
            offset:['4%','70%'],
            area: ['30%', '90%'],
            content: "{{url('/admin/picture/board')}}", //iframe的url
        });
    }
    function setCover(){
        layer.prompt({
            title:'url路径'
        },function(value, index, elem){
            $('#gravatar').attr('src',value);
            layer.close(index);
        });
    }
    $('#confirm').change(function(){
        if($(this).is(':checked')){
            $("#pwd-toggle").fadeIn();
        }else{
            $("#pwd-toggle").fadeOut();
            $('#password').val('');
        }
    });
</script>
</body>

</html>