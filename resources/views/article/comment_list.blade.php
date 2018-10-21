<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <button id="btn_delete" type="button" class="btn btn-outline btn-default" title="删除">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </button>
        </div>
        <!-- Example Events -->
        <table id="comment_Table">
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
        layer.config({extend: 'extend/layer.ext.js'});
        $table = $("#comment_Table").bootstrapTable({
            url: "{{url('/admin/comment/comment_list')}}",
            method:'get',
            dataType:'json',
            undefinedText:'空',
            cache: true,
            toolbar: '#toolbar',//工具按钮用哪个容器
            search: true,
            //  strictSearch: true,
            cardView: true,
            pagination: true,
            pageSize: 5,
            pageList: [5, 10, 15, 20],
            showColumns: true,
            showRefresh: false,
            showToggle: true,
            locale: "zh-CN",
            striped: true,
            sortable: false,                     //是否启用排序
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

                },

		{
                    title:'文章标题',
                    field:'article.title',
                    align:'center',

                },
                {
                    title:'用户名',
                    field:'username',
                    align:'center'
                },
                {
                    title:'邮箱',
                    field:'email',
                    align:'center',
                },
                {
                    title:'评论内容',
                    field:'content',
                    align:'center',
                },
                {
                    title:'创建时间',
                    field:'created_at',
                    align:'center',
                },
                {
                    title:'操作',
                    align:'center',
                    formatter:function (value,row,index) {
                        var edit = '<button type="button" class="btn btn-outline btn-default" onclick="void(0);" title="回复">'+
                            '<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>'+
                            '</button>';
                        return edit;
                    }
                }
            ]
        });
        $('#btn_delete').click(function(){
            var ids = [];//得到用户选择的数据的ID
            var rows = $table.bootstrapTable('getSelections');

            for (var i = 0; i < rows.length; i++) {
                ids.push(rows[i].id);
            }
            if(ids.length){
                var confirm = parent.layer.confirm('您确认要删除所选的评论吗？', {
                    title:'删除评论',
                    btn: ['确定','取消'], //按钮
                    offset:['30%','50%'],
                }, function(){
                    $.post(
                        "{{url('/admin/comment/delete')}}",
                        {
                            '_token':"{{csrf_token()}}",
                            'dels':ids.join(',')
                        },
                        function(response){
                            parent.layer.close(confirm);
                            if(response.status == 200){
                                parent.layer.msg('您已成功删除'+response.msg+'条数据');
                                setTimeout(function(){
                                    $("#comment_Table").bootstrapTable('refresh');
                                },2000);
                            }else{

                            }
                        },
                        'json'
                    );
                }, function(){

                });
            }else{
                parent.layer.msg('没有选中可删除的选项！',{
                    offset:['30%','50%']
                });
            }
        });
    });
</script>

</body>

</html>
