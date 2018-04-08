<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台主题UI框架 - Bootstrap Table</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/admin/css/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="/admin/css/animate.css" rel="stylesheet">
    <link href="/admin/css/style.css?v=4.1.0" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/admin/css/plugins/markdown/bootstrap-markdown.min.css" />
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight" style="padding:0px;">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <form method="post" class="form-horizontal">
                    <div class="form-group checkForm">
                        <label class="col-sm-2 control-label">文章标题</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" placeholder="文章标题">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group checkForm">
                        <label class="col-sm-2 control-label">类型</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="type">
                                <option>请选择文章类型</option>
                                @foreach($types as $type)
                                <option value="{{$type['id']}}"> @for($i=0;$i<$type['level'];$i++)&nbsp;&nbsp;@endfor{{$type['name']}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">作者</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" disabled value="{{Auth::guard('admin')->user()->name}}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">显示</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" checked="" value="1" id="optionsRadios1" name="optionsRadios">显示</label>
                            <label class="radio-inline">
                                <input type="radio" value="2" id="optionsRadios2" name="optionsRadios">隐藏</label>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">封面图片</label>

                        <div class="col-sm-6">
                            <label><img id="cover" src="/images/placeholder.png" alt="no images" width="120" height="90" class="img-thumbnail"><span style="padding:0 20px;"><label class="btn btn-outline">更换</label></span></label>
                        </div>
                    </div>
                    <!--edit-->
                        <label class="col-sm-12 control-label">
                            <div class="ibox-content checkForm">
                                <textarea name="content" id="content" data-provide="markdown" rows="12"></textarea>
                            </div>
                        </label>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-info" type="button" onclick="addForm();">保存文章</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


</div>

<!-- 全局js -->
<script src="/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/admin/js/bootstrap.min.js?v=3.3.6"></script>

<!-- 自定义js -->
<script src="/admin/js/content.js?v=1.0.0"></script>

<!-- simditor -->
<script type="text/javascript" src="/admin/js/plugins/markdown/markdown.js"></script>
<script type="text/javascript" src="/admin/js/plugins/markdown/to-markdown.js"></script>
<script type="text/javascript" src="/admin/js/plugins/markdown/bootstrap-markdown.js"></script>
<script type="text/javascript" src="/admin/js/plugins/markdown/bootstrap-markdown.zh.js"></script>

<script src="/admin/js/plugins/layer/layer.min.js"></script>
<!--统计代码，可删除-->
<script>
    function addForm(){
        $.post(
            "{{url('/admin/article/add')}}",
            {
            "title":$(":input[name='title']").val(),
                "type_id":$('select').val(),
                "cover":$('#cover').attr('src'),
                "display":$(':radio').val(),
                "content":$('#content').val(),
            "_token":"{{csrf_token()}}"
            },
            function(response){
                if(response.status == 200){
                    parent.parent.layer.msg('添加成功',{
                        time:1000
                    });
                    setTimeout(function(){
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                    },2000);
                }else{
                    if(response.title){
                        $('.checkForm').eq(0).addClass('has-error');
                    }else{
                        $('.checkForm').eq(0).removeClass('has-error');
                    }
                    if(response.type_id){
                        $('.checkForm').eq(1).addClass('has-error');
                    }else{
                        $('.checkForm').eq(1).removeClass('has-error');
                    }

                }
            },
            'json'
        );
        return false;
    }
</script>

</body>

</html>