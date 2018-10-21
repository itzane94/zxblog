<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico"> <link href="/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/admin/css/plugins/jsTree/style.min.css" rel="stylesheet">
    <link href="/admin/css/animate.css" rel="stylesheet">
    <link href="/admin/css/style.css?v=4.1.0" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/admin/css/plugins/webuploader/webuploader.css">
    <link rel="stylesheet" type="text/css" href="/admin/css/demo/webuploader-demo.css">
    <script type="text/javascript">
        var upload_url = "{{url('/admin/picture/upload')}}";
        var _token = "{{csrf_token()}}";
    </script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>图片目录</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content" style="overflow:hidden">
                    <div id="ptree"></div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>图片上传</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="page-container">
                        <div id="uploader" class="wu-example">
                            <div class="queueList">
                                <div id="dndArea" class="placeholder">
                                    <div id="filePicker" class="webuploader-container"><div class="webuploader-pick">点击选择图片</div><div id="rt_rt_1cagdci1ncu1rjbah610p03ma1" style="position: absolute; top: 0px; left: 667.5px; width: 168px; height: 44px; overflow: hidden; bottom: auto; right: auto;"><input type="file" name="file" class="webuploader-element-invisible" multiple="multiple" accept="image/*"><label style="opacity: 0; width: 100%; height: 100%; display: block; cursor: pointer; background: rgb(255, 255, 255);"></label></div></div>
                                    <p>或将照片拖到这里，单次最多可选300张</p>
                                </div>
                                <ul class="filelist"></ul></div>
                            <div class="statusBar" style="display:none;">
                                <div class="progress" style="display: none;">
                                    <span class="text">0%</span>
                                    <span class="percentage" style="width: 0%;"></span>
                                </div>
                                <div class="info">共0张（0B），已上传0张</div>
                                <div class="btns">
                                    <div id="filePicker2" class="webuploader-container"><div class="webuploader-pick">继续添加</div><div id="rt_rt_1cagdci1q1n8m1c2shi6lt19oi6" style="position: absolute; top: 0px; left: 0px; width: 1px; height: 1px; overflow: hidden;"><input type="file" name="file" class="webuploader-element-invisible" multiple="multiple" accept="image/*"><label style="opacity: 0; width: 100%; height: 100%; display: block; cursor: pointer; background: rgb(255, 255, 255);"></label></div></div>
                                    <div class="uploadBtn state-pedding">开始上传</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 全局js -->
<script src="/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script type="text/javascript" src="/js/layer/layer.js"></script>

<script>
    $(document).ready(function () {
        // 添加全局站点信息
        BASE_URL = '/admin/js/plugins/webuploader';
        $('#ptree').jstree({
            'core': {
                'data': [
                    {
                        'text': '图片归档',
                        'state': {
                            'opened': true
                        },
                        'children': [
                            @foreach($children as $child)
                            {!! $child!!},
                            @endforeach
                        ]
                    }
                ]
            },
            "plugins" : [
                "contextmenu", //选中右键文本内容
            ],
            "contextmenu":{
                // select_node:false,
                show_at_node:true,
                "items":{
                    "预览":{
                        "label":"预览图片",
                        "icon":"glyphicon glyphicon-picture",
                        "action":function(data){
                            var inst = $.jstree.reference(data.reference),
                                obj = inst.get_node(data.reference);
                            if(obj.parent == "j1_1" || obj.parent =="#")
                                return;
                            parent.parent.parent.layer.open({
                                type: 1,
                                title: false,
                                closeBtn: 0,
                                area: ['630px', '360px'],
                                skin: '#ccc', //没有背景色
                                shadeClose: true,
                                content: "<img src='/"+obj.text+"'/>"
                            });
                        }
                    },
                    "复制":{
                        "label":"复制路径",
                        "icon":"glyphicon glyphicon-duplicate",
                        "action":function(data){
                            var inst = $.jstree.reference(data.reference),
                                obj = inst.get_node(data.reference);
                            if(obj.parent == "j1_1" || obj.parent =="#")
                                return;
                            parent.parent.parent.layer.open({
                                content: '<textarea cols="36" style="resize:none" >/'+obj.text+'</textarea>',
                                scrollbar: false,
                                title:false,
                                btn:false,
                                closeBtn:true
                            });

                        }
                    },
                    "删除":{
                        "label":"删除图片",
                        "icon":"glyphicon glyphicon-trash",
                        "action":function(data){
                            var inst = $.jstree.reference(data.reference),
                                obj = inst.get_node(data.reference);
                            if(obj.parent == "j1_1" || obj.parent =="#")
                                return;
                            $.get(
                                "/admin/picture/delete",
                                {
                                    'filename':obj.text
                                },
                                function(response){
                                    if(response.status == 'success'){
                                        parent.parent.parent.layer.msg('删除成功,正在为您刷新界面!',{
                                            time:2000
                                        });
                                        setTimeout(function(){
                                            location.reload();
                                        },2000);
                                    }else{
                                        parent.parent.parent.layer.msg('删除失败!',{
                                            time:2000
                                        });
                                    }
                                },
                                'json'
                            );
                        }
                    }
                }
            }
        });
    });
</script>
<!-- 自定义js -->
<!-- Web Uploader -->
<script src="/admin/js/plugins/webuploader/webuploader.min.js"></script>
<script src="/admin/js/demo/webuploader-demo.js"></script>
<!-- jsTree plugin javascript -->
<script src="/admin/js/plugins/jsTree/jstree.min.js"></script>
<!--统计代码，可删除-->
</body>
</html>