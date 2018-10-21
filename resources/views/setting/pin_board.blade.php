<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台主题UI框架 - 标签墙</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="/admin/css/animate.css" rel="stylesheet">
    <link href="/admin/css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="row" id="tips">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <button  type="button" @click="addTips();" class="btn btn-outline btn-default" title="新增tips">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </button>
                    <span> #最多可添加10个标签，第①个标签将在顶部展示# </span>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="wrapper wrapper-content animated fadeInUp">
                <ul class="notes">

                    <li v-for="(item,key) in tips">
                        <div @dblclick="editTips(item.id);">
                            <h4>@{{item.author}}</h4>
                            <p>@{{item.wisdom}}</p>
                            <span>
                                 <label style="display:none" class="btn btn-primary" @click="saveTips($event);"><i class="fa fa-check "></i></label>
                                 <label class="btn btn-danger"  @click="deleteTips(item.id);"><i class="fa fa-trash "></i></label>
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- 全局js -->
    <script src="/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/admin/js/bootstrap.min.js?v=3.3.6"></script>

    <!-- 自定义js -->
    <script src="/admin/js/content.js?v=1.0.0"></script>
    <script type="text/javascript" src="/js/vue.min.js"></script>
    <script src="/admin/js/plugins/layer/layer.min.js"></script>
    <!--统计代码，可删除-->
    <script>
        $(function(){
            var vm = new Vue({
                el:'#tips',
                data:{
                    tips:'',
                    created:false,
                    id:0,
                    wisdom:'爱拼才会赢',
                    author:'zx',
                    edited:false

                },
                methods:{
                    addTips:function(){
                        if($('.notes').children('li').length >= 10){
                            layer.msg('添加的个数不能超过10个哦～',{
                                time:2000,
                                offset:['20%','40%']
                            });
                            return;
                        }
                        if(this.created) return;
                        this.tips.push({
                            'id': this.id,
                            'wisdom': this.wisdom,
                            'author':this.author
                        });
                        this.created = true;

                    },
                    editTips:function(id){
                        if(this.edited) return;
                      var that = event.currentTarget;
                      var author = $(that).find('h4').text();
                      var wisdom = $(that).find('p').text();
                      $(that).find('h4').replaceWith('<input type="text" value="'+author+'"/>');
                      $(that).find('p').replaceWith('<textarea ref="textarea">'+wisdom+'</textarea>');
                      $(that).find('label').eq(0).show();
                      this.id = id;
                      this.edited = true;
                    },
                    saveTips:function(e){
                        var _this = this;
                        var that = event.currentTarget;
                        var author = $(that).parent().parent().find('input').val();
                        var wisdom = $(that).parent().parent().find('textarea').val();
                   if(_this.id==0){
                       $.post("{{url('/admin/setting/tips/add')}}",
                           {
                               wisdom:wisdom,
                               author:author,
                               _token:"{{csrf_token()}}"
                           },
                           function(r){
                              if(r.status == 200){
                                  for(var k in _this.tips){
                                      if(_this.tips[k].id == 0){
                                       _this.tips[k].id = r.id;
                                          $(that).parent().parent().find('input').replaceWith('<h4>'+author+'</h4>');
                                          $(that).parent().parent().find('textarea').replaceWith('<p>'+wisdom+'</p>');
                                          break;
                                      }
                                  }
                              }else{
                                  layer.msg('添加失败!',{
                                      time:2000,
                                      offset:['20%','40%']
                                  });
                              }
                           },
                           'json'
                       );
                       this.created = false;
                   }else{
                       $.post("/admin/setting/tips/save/"+_this.id,
                           {
                               wisdom:wisdom,
                               author:author,
                               _token:"{{csrf_token()}}"
                           },
                           function(r){
                               if(r.status == 200){
                                   $(that).parent().parent().find('input').replaceWith('<h4>'+author+'</h4>');
                                   $(that).parent().parent().find('textarea').replaceWith('<p>'+wisdom+'</p>');
                               }else{
                                   layer.msg('修改失败!',{
                                       time:2000,
                                       offset:['20%','40%']
                                   });
                               }
                           },
                           'json'
                       );
                       this.created = false;

                   }
                   this.edited = false;
                   $(that).parent().find('label').eq(0).hide();
                    },
                    deleteTips:function(id){
                        var _this = this;
                        var confirm = layer.confirm('您确定要删除?',{
                            title:'删除名言',
                            offset:['20%','40%'],
                            btn:['毫无疑问','容我想想'],
                        },function(){
                            layer.close(confirm);
                            $.get(
                                "/admin/setting/tips/delete/"+id,
                                function(response){
                                    if(response.status == 'success'){
                                        layer.msg('删除成功!',{
                                            time:2000,
                                            offset:['20%','40%']
                                        });
                                        for(var k in _this.tips){
                                            if(_this.tips[k].id == id){
                                                _this.tips.splice(k,1);
                                                break;
                                            }
                                        }
                                    }else{
                                        layer.msg('删除失败!',{
                                            time:2000,
                                            offset:['20%','40%']
                                        });
                                    }
                                },
                                'json'
                            );
                        });
                    }

                },
                created:function(){
                    $.getJSON("{{url('/admin/setting/tips/json')}}",function (items) {
                        this.tips=items;
                    }.bind(this));
                }

            });

        });
    </script>

</body>

</html>
