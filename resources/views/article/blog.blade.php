@extends("layouts.main")
@section("content")
<div class="first-widget parallax" id="blog">
    <div class="parallax-overlay">
        <div class="container pageTitle">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <h2 class="page-title">Blog</h2>
                </div> <!-- /.col-md-6 -->
                <div class="col-md-6 col-sm-6 text-right">
                    <span class="page-location">Home / Blog</span>
                </div> <!-- /.col-md-6 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.parallax-overlay -->
</div> <!-- /.pageTitle -->

<div class="container">
    <div class="row">

        <div class="col-md-8 blog-posts">
            <div class="row">
                <div class="col-md-12">
                    @foreach($articles as $article)
                    <div class="post-blog">
                        <div class="blog-content">
                            <span class="meta-date"><i class="fa fa-calendar"></i>&nbsp;{{$article['created_at']->format('F jS  Y')}}</span>
                            <span class="meta-author"><i class="fa fa-bookmark"></i>&nbsp;{{$article['type']['name']}}</span>
                            <h3><a href="/blog/{{$article['id']}}" target="_blank">{{$article['title']}}</a></h3>
                            <p id="content"><a href="/blog/{{$article['id']}}" target="_blank">Read More...</a></p>
                            <div class="tag-items">
                                <span class="small-text"><i class="fa fa-tags"></i>&nbsp;标签:</span>
                                @foreach($article->tags as $tag)
                                    <a href="/blog?tag_id={{$tag['id']}}" rel="tag">{{$tag['name']}}</a>
                                @endforeach
                            </div>
                        </div> <!-- /.blog-content -->
                    </div> <!-- /.post-blog -->
                        @endforeach
                </div> <!-- /.col-md-12 -->
                <div class="col-md-12">
                    <!--<ul class="pages">
                        <li><a href="#" class="active">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">...</a></li>
                        <li><a href="#">13</a></li>
                    </ul>-->
                    {!! $articles->appends($articles->filter)->links() !!}
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.col-md-8 -->

        <div class="col-md-4">
            <div class="sidebar">
                <div class="sidebar-widget">
                    <button onclick="searchList();" class="btn btn-danger"><i class="fa fa-search"></i></button>&nbsp;search...
                </div>
                <div class="sidebar-widget">
                    <h5 class="widget-title">Categories</h5>
                    <div class="row categories">
                        <div class="col-md-12">
                            <ul>
                                @foreach($types as $type)
                                <li class="col-md-6"><a href="/blog?type_id={{$type['id']}}">{{$type['name']}}</a></li>
                                    @endforeach
                            </ul>
                        </div>
                    </div> <!-- /.row -->
                </div> <!-- /.sidebar-widget -->
                <div class="sidebar-widget">
                    <h5 class="widget-title">Tags</h5>
                    <div class="row categories">
                        <div class="col-md-12">
                            <ul>
                                @foreach($tags as $tag)
                                <li class="col-md-6"><a href="/blog?tag_id={{$tag['id']}}">{{$tag['name']}}</a></li>
                                    @endforeach
                            </ul>
                        </div>
                    </div> <!-- /.row -->
                </div> <!-- /.sidebar-widget -->
            </div> <!-- /.sidebar -->
        </div> <!-- /.col-md-4 -->

    </div> <!-- /.row -->
</div> <!-- /.container -->
 @endsection
@section('script')
    <script src="/admin/js/plugins/layer/layer.min.js"></script>
    <script src="/js/list/list.min.js"></script>
    <script>
        function searchList(){
            layer.open({
                type: 2,
                title: '搜索博文',
                shadeClose: true,
                shade: 0.8,
                move:false,
                area: ['480px', '90%'],
                content:"{{url('/blog/list')}}"
            });
        }
    </script>
    @endsection