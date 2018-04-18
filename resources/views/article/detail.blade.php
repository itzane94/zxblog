@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="/css/font-awesome.min.css">
@endsection
@section('content')
<div class="first-widget parallax" id="blogId">
    <div class="parallax-overlay">
        <div class="container pageTitle">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <h2 class="page-title">Blog Single</h2>
                </div> <!-- /.col-md-6 -->
                <div class="col-md-6 col-sm-6 text-right">
                    <span class="page-location">Home / Blog Single</span>
                </div> <!-- /.col-md-6 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.parallax-overlay -->
</div> <!-- /.pageTitle -->

<div class="container">
    <div class="row">

        <div class="col-md-12 blog-posts">
            <div class="row">
                <div class="col-md-12">
                    <div class="post-blog">
                        <div class="blog-content">
                            <span class="meta-date"><a href="#">{{$article['created_at']->format('Y-m-d')}}</a></span>
                            <span class="meta-author"><a href="#">{{$article['type']['name']}}</a></span>
                            <h3>{{$article['title']}}</h3>
                            <div id="content" data-provide="markdown-editable">{{$article['content'] }}</div>
                            <blockquote>
                                <ul style="list-style:none; padding:0px;">
                                    <li>本文作者： itzane</li>
                                    <li>本文链接： {{url('/blog/'.$article['id'])}}</li>
                                    <li>版权声明： 本博客所有文章除特别声明外，均采用 CC BY-NC-SA 3.0 许可协议。转载请注明出处！</li>
                                </ul>
                            </blockquote>
                            <div class="tag-items">
                                <span class="small-text">标签:</span>
                                @foreach($article->tags as $tag)
                                <a href="/blog?tag_id={{$tag['id']}}" rel="tag">{{$tag['name']}}</a>
                                    @endforeach
                            </div>
                        </div> <!-- /.blog-content -->
                    </div> <!-- /.post-blog -->
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
            <div id="comment">
            <div class="row">
                <div class="col-md-12">
                    <div id="blog-comments" class="blog-post-comments">
                        <h3><i class="fa fa-comments-o"></i> Comments</h3>
                        <div class="blog-comments-content">
                            <div v-if="comments.length >0" v-cloak>
                            <div class="media" v-for="(value,index) in comments" v-cloak>
                                <div class="pull-left">
                                    <img class="media-object img-thumbnail" src="/images/gravatar.jpg" width="64" alt="gravatar">
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <h4>@{{ value.username }}</h4>
                                        <span>@{{ value.created_at }}</span>
                                    </div>
                                    <p>@{{ value.content }}</p>
                                </div>
                            </div>
                            <div id="app" class="text-center">
                                <navigation :pages="pages" :current.sync="pageNo" @navpage="msgListView"></navigation>
                            </div>
                            </div>
                            <div v-else>没有人评论，抢沙发吧~</div>
                        </div> <!-- /.blog-comments-content -->
                    </div> <!-- /.blog-post-comments -->
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="comment-form">
                        <h3><i class="fa fa-paw"></i> Leave a comment</h3>
                        <div class="widget-inner">
                            <form action="#" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" :class="{ 'has-error' : check.username }">
                                            <label for="name-id">名字:</label>
                                            <input type="text"  class="form-control" v-model="username" name="name-id">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" :class="{ 'has-error' : check.email }">
                                            <label for="email-id">邮箱:</label>
                                            <input type="text" class="form-control" v-model="email" name="email-id">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="site-id">网址:</label>
                                            <input type="text" class="form-control" v-model="site" name="site-id">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" :class="{ 'has-error' : check.content }">
                                            <label for="comment">评论:</label>
                                            <textarea v-model = "content" class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="mainBtn"  @click="addComment" class="btn btn-info" style="cursor:pointer"><i class="fa fa-paw"></i>&nbsp 留</label>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- /.widget-inner -->
                    </div> <!-- /.widget-main -->
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
            </div> <!--/#comment-->
        </div> <!-- /.col-md-12 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->
@endsection
@section('script')
    <script type="text/javascript" src="/home/js/marked.min.js"></script>
    <script type="text/javascript" src="/js/vue.min.js"></script>
    <script type="text/javascript" src="/js/pagination.js"></script>
    <script src="/admin/js/plugins/layer/layer.min.js"></script>
    <script>
        $(function(){
            var html = $('#content').text();
            $('#content').html(marked(html));
            new Vue({
                el:"#comment",
                data:{
                    pageNo: 1,
                    pages:1,
                    pagesize:5,
                    username:'',
                    email:'',
                    site:'',
                    content:'',
                    bool:false,
                    check:{
                        username:false,
                        email:false,
                        content:false
                    },
                    comments:[]
                },
                methods:{
                    msgListView:function(curPage){
                        $.getJSON("/comment/json/{{$article['id']}}",{
                            'page':curPage,
                            'pagesize':this.pagesize
                        },function (items) {
                            this.comments = items.comments;
                            this.pages = items.pages;
                            this.pageNo = curPage;
                        }.bind(this));
                    },
                    addComment:function(){
                        var _this = this;
                        var flag = true;
                        if(!this.username || this.username.length > 20){
                            this.check.username = true;
                            flag = false;
                        }else{
                            this.check.username = false;
                        }
                        if(this.email.match(/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/)){
                            this.check.email = false;
                        }else{
                            this.check.email = true;
                            flag = false;
                        }
                        if(!this.content || this.content.length > 500){
                            this.check.content = true;
                            flag = false;
                        }else{
                            this.check.content = false;
                        }
                        if(flag){ //提交数据
                            $.post(
                                '/comment/add',
                                {
                                    'article_id':"{{ $article['id'] }}",
                                    'username':this.username,
                                    'email':this.email,
                                    'site':this.site,
                                    'content':this.content,
                                    '_token':"{{csrf_token()}}"
                                },
                                function (response){
                                    if(response.status == 'success'){
                                        $.getJSON("/comment/json/{{$article['id']}}",{
                                            'page':_this.pageNo,
                                            'pagesize':_this.pagesize
                                        },function (items) {
                                            _this.comments = items.comments;
                                            _this.pages = items.pages;
                                        }.bind(_this));
                                        layer.msg('评论成功',{
                                            'offset':'30%',
                                            'time':2000
                                        });
                                        _this.username='';
                                        _this.email = '';
                                        _this.site = '';
                                        _this.content = '';
                                    }else{
                                        layer.msg('添加失败',{
                                            'offset':'30%',
                                            'time':2000
                                        });
                                    }
                                },
                                'json'
                            );
                        }
                    }
                },
                created:function(){
                    $.getJSON("/comment/json/{{$article['id']}}",{
                        'page':this.pageNo,
                        'pagesize':this.pagesize
                    },function (items) {
                        this.comments = items.comments;
                        this.pages = items.pages;
                    }.bind(this));
                }
            });
        });
    </script>
    @endsection
