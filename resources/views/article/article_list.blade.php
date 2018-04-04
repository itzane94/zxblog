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
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="col-sm-12">
        <div id="toolbar" class="btn-group">
            <button id="btn_add" type="button" class="btn btn-outline btn-default" title="新增">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>
            <button id="btn_delete" type="button" class="btn btn-outline btn-default" title="删除">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </button>
        </div>
        <!-- Example Events -->
        <table id="art_Table">
        <tbody>
        </tbody>
        </table>
        <!-- End Example Events -->
    </div>

</div>

<!-- 全局js -->
<script src="/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/admin/js/bootstrap.min.js?v=3.3.6"></script>

<!-- 自定义js -->
<script src="/admin/js/content.js?v=1.0.0"></script>


<!-- Bootstrap table -->
<script src="/admin/js/plugins/bootstrap-table/bootstrap-table.min.js"></script>
<script src="/admin/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
<script src="/admin/js/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
<script src="/admin/js/plugins/layer/layer.min.js"></script>
<!--统计代码，可删除-->
<script>
    $(function(){
         $table = $("#art_Table").bootstrapTable({
            url: "{{url('/admin/article/list_data')}}",
            method:'get',
            dataType:'json',
            undefinedText:'空',
            cache: true,
            toolbar: '#toolbar',//工具按钮用哪个容器
            search: true,
            //  strictSearch: true,
            pagination: true,
            pageSize: 10,
            pageList: [5, 10, 15, 20],
            showColumns: true,
            showRefresh: false,
            showToggle: false,
            locale: "zh-CN",
            striped: true,
            sortable: true,                     //是否启用排序
            //  sortOrder: "asc",                   //排序方式
            sidePagination:'server',
            queryParams:function(params){
                return {
                    start:params.offset,
                    pagesize:params.limit,
                    // page: (params.offset / params.limit) + 1,   //页码
                    keyword:params.search,
                    ordername: params.sort,  //排名
                    sortorder: params.order //排位命令（desc，asc）
                }
            },
            idField:'id',
            silent : true,
            columns:[
                {
                    checkbox: true,
                    field:'',
                    align:'center',

                },
                {
                    title:'ID',
                    field:'id',
                    align:'center',
                    sortable: true

                },
                {
                    title:'标题',
                    field:'title',
                    align:'center'
                },
                {
                    title:'封面',
                    field:'cover',
                    align:'center'
                },
                {
                    title:'类型',
                    field:'type',
                    align:'center',
                    formatter:function(value,row,index){
                        return row.type.name;
                    }
                },
                {
                    title:'创建时间',
                    field:'created_at',
                    align:'center',
                    sortable: true
                },
                {
                    title:'操作',
                    align:'center',
                    formatter:function (value,row,index) {
                        var edit = '<button type="button" class="btn btn-outline btn-default" title="编辑">'+
                            '<span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>'+
                            '</button>';
                        return edit;
                    }
                }
            ]
        });
        $('#btn_delete').click(function(){
            parent.layer.confirm('您确认要删除所选的文章吗？', {
                title:'删除文章',
                btn: ['确定','取消'], //按钮
                offset:['30%','50%'],
            }, function(){
                var ids = [];//得到用户选择的数据的ID
                var rows = $table.bootstrapTable('getSelections');

                for (var i = 0; i < rows.length; i++) {
                    ids.push(rows[i].id);
                }
                console.log(ids);
            }, function(){

            });
        });
    });
</script>

</body>

</html>