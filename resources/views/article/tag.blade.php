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
<body class="gray-bg" >
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins" id="tags">
                <div class="ibox-title">
                    <h5>标签 (Labels)</h5>
                </div>
                <div class="ibox-content">
                    <div>
                        <div class="btn btn-outline"  v-for="(item,key) in tags"><input type="radio" :id="item.id" :value="item.id" v-model="checkedValue" name="tags"/>&nbsp;<label :for="item.id" class="label label-primary"><i class="fa fa-tag"></i>@{{item.name}}</label></div>
                    </div>
                 </div>
                <div class="ibox-content">
                    <button  type="button" @click="addTags();" class="btn btn-outline btn-default" title="新增标签">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </button>
                    <button id="btn_delete" @click="editTags();" type="button" class="btn btn-outline btn-default" title="修改标签">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </button>
                    <button id="btn_delete" @click="delTags();" type="button" class="btn btn-outline btn-default" title="删除标签">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- 全局js -->
<script src="/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script type="text/javascript" src="/js/vue.min.js"></script>
<script src="/admin/js/plugins/layer/layer.min.js"></script>
<!-- 自定义js -->
<!--统计代码，可删除-->
<script>
    $(function(){
        layer.config({extend: 'extend/layer.ext.js'});
        var vm = new Vue({
            el:'#tags',
            data:{
                'checkedValue':'',
                'tags':''
            },
            methods:{
                addTags:function(){
                     _this = this;
                    var prom = layer.prompt({
                        title:'添加标签',
                        offset:['20%','40%']
                    },function(value, index, elem){
                        layer.close(prom);
                        if(value && value.length > 0){
                            $.get(
                                '/admin/tag/add',
                                {
                                    'name':value

                                },
                                function(response){
                                    if(response.status == 'success'){
                                        layer.msg('添加标签成功',{
                                            time:2000,
                                            offset:['20%','40%']
                                        });
                                        _this.tags.push({
                                            'id':response.id,
                                            'name':value
                                        });
                                    }else{
                                        layer.msg('添加标签失败!',{
                                            time:2000,
                                            offset:['20%','40%']
                                        });
                                    }
                                },
                                'json'
                            );
                        }
                    });
                },
                editTags:function(){
                    _this = this;
                    if(_this.checkedValue){
                        var prom = layer.prompt({
                            title:'编辑标签',
                            offset:['20%','40%']
                        },function(value, index, elem){
                            layer.close(prom);
                            if(value && value.length > 0){
                                $.get(
                                    '/admin/tag/edit/'+_this.checkedValue,
                                    {
                                        'name':value
                                    },
                                    function(response){
                                        if(response.status == 'success'){
                                            layer.msg('修改标签成功',{
                                                time:2000,
                                                offset:['20%','40%']
                                            });
                                            for(var idx in _this.tags){
                                                if(_this.tags[idx].id == _this.checkedValue)
                                                    _this.tags[idx].name = value;
                                            }
                                        }else{
                                            layer.msg('修改标签失败!',{
                                                time:2000,
                                                offset:['20%','40%']
                                            });
                                        }
                                    },
                                    'json'
                                );
                            }
                        });
                    }else{
                        layer.msg('请先选择待编辑的标签!',{
                            time:2000,
                            offset:['20%','40%']
                        });
                        return;
                    }
                },
                delTags:function(){
                    _this = this;
                    if(_this.checkedValue){
                        for(var idx in _this.tags){
                            if(_this.tags[idx].id == _this.checkedValue)
                                 index = idx;
                        }
                        var confirm = layer.confirm('您确定要删除标签 [ '+ _this.tags[index].name +' ] 吗?',{
                            title:'删除标签',
                            offset:['20%','40%'],
                            btn:['毫无疑问','容我想想'],
                        },function(){
                            layer.close(confirm);
                            $.get(
                                "/admin/tag/delete/"+_this.checkedValue,
                                function(response){
                                    if(response.status == 'success'){
                                        layer.msg('删除标签成功!',{
                                            time:2000,
                                            offset:['20%','40%']
                                        });
                                        _this.tags.splice(index,1);
                                    }else{
                                     layer.msg('删除标签失败!',{
                                            time:2000,
                                            offset:['20%','40%']
                                        });
                                    }
                                },
                                'json'
                            );
                        });
                    }else{
                        layer.msg('请先选择待编辑的标签!',{
                            time:2000,
                            offset:['20%','40%']
                        });
                        return;
                    }
                }
            },
            created:function(){
                $.getJSON("{{url('/admin/tag/json')}}",function (items) {
                    this.tags=items;
                }.bind(this));
            }
        });
    });
</script>
</body>
</html>