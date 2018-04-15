<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台主题UI框架 - 树形视图</title>

    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/admin/css/plugins/jsTree/style.min.css" rel="stylesheet">
    <link href="/admin/css/animate.css" rel="stylesheet">
    <link href="/admin/css/style.css?v=4.1.0" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>分类结构树</h5>
                </div>
                <div class="ibox-content" style="overflow:hidden">
                    <div id="Ttree"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- 全局js -->
<script src="/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/admin/js/plugins/layer/layer.min.js"></script>

<script>
    $(document).ready(function () {
        // 添加全局站点信息
        layer.config({extend: 'extend/layer.ext.js'});
        var tree = $('#Ttree').jstree({
            'core': {
                'data': [
                    {
                        'id':'ajson0',
                        'parent':'#',
                        'text':'根分类',
                        'icon':'fa fa-folder',
                        'state':{
                            'opened':'true'
                        }
                    },
                    @foreach($typeJson as $type)
                    {!! $type !!},
                    @endforeach
                ]
            },
            "plugins" : [
                "contextmenu", //选中右键文本内容
                "unique"
            ],
            "contextmenu":{
                // select_node:false,
                show_at_node:true,
                "items":{
                    "create":{
                        "label":"新增分类",
                        "icon":"glyphicon glyphicon-plus",
                        "action":function(data){
                            var inst = $.jstree.reference(data.reference),
                                obj = inst.get_node(data.reference);
                            var id = (obj.id).substr(5);
                            layer.prompt({
                                title:'新增 '+obj.text+' 子分类',
                                offset:['20%','40%']
                            },function(value, index, elem){
                                if(value && value.length > 0){
                                    $.get(
                                        '/admin/type/add',
                                        {
                                            'pid':id,
                                            'name':value

                                        },
                                        function(response){
                                            if(response.status == 'success'){
                                                parent.parent.parent.layer.msg('新增分类成功,正在为您刷新界面!',{
                                                    time:2000
                                                });
                                                setTimeout(function(){
                                                    location.reload();
                                                },2000);
                                            }else{
                                                parent.parent.parent.layer.msg('新增分类失败!',{
                                                    time:2000
                                                });
                                            }
                                        },
                                        'json'
                                    );
                                }
                            });
                        }
                    },
                    "编辑":{
                        "label":"编辑分类",
                        "icon":"glyphicon glyphicon-edit",
                        "action":function(data){
                            var inst = $.jstree.reference(data.reference),
                                obj = inst.get_node(data.reference);
                            var id = (obj.id).substr(5);
                            if(obj.parent =="#")
                                return;
                            layer.prompt({
                                title:'编辑分类 '+obj.text,
                                offset:['20%','40%']
                            },function(value, index, elem){
                                if(value && value.length > 0){
                                    $.get(
                                        '/admin/type/edit/'+id,
                                        {
                                            'name':value
                                        },
                                        function(response){
                                            if(response.status == 'success'){
                                                parent.parent.parent.layer.msg('编辑分类成功,正在为您刷新界面!',{
                                                    time:2000
                                                });
                                                setTimeout(function(){
                                                    location.reload();
                                                },2000);
                                            }else{
                                                parent.parent.parent.layer.msg('编辑分类失败!',{
                                                    time:2000
                                                });
                                            }
                                        },
                                        'json'
                                    );
                                }
                            });

                        }
                    },
                    "删除":{
                        "label":"删除分类",
                        "icon":"glyphicon glyphicon-trash",
                        "action":function(data){
                            var inst = $.jstree.reference(data.reference),
                                obj = inst.get_node(data.reference);
                            var id = (obj.id).substr(5);
                            if(obj.parent =="#" || obj.children.length > 0)
                                return;
                            var confirm = layer.confirm('您确定要删除分类'+obj.text+'吗?',{
                                title:'删除分类',
                                offset:['20%','40%'],
                                btn:['毫无疑问','容我想想'],
                            },function(){
                                layer.close(confirm);
                                $.get(
                                    "/admin/type/delete/"+id,
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
                            });
                        }
                    }
                }
            }
        });
    });
</script>
<!-- 自定义js -->
<script src="/admin/js/content.js?v=1.0.0"></script>
<!-- jsTree plugin javascript -->
<script src="/admin/js/plugins/jsTree/jstree.min.js"></script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
<!--统计代码，可删除-->
</body>

</html>