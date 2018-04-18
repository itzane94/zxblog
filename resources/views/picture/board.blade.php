<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/admin/css/plugins/jsTree/style.min.css" rel="stylesheet">
    <link href="/admin/css/animate.css" rel="stylesheet">
    <link href="/admin/css/style.css?v=4.1.0" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight" style="padding:0px;">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content" style="overflow:hidden">
                    <div id="ptree"></div>
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
                    }
                }
            }
        });
    });
</script>
<!-- 自定义js -->
<!-- jsTree plugin javascript -->
<script src="/admin/js/plugins/jsTree/jstree.min.js"></script>
<!--统计代码，可删除-->
</body>
</html>