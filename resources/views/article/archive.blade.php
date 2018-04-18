@extends('layouts.main')
@section('css')
    <link href="/css/timeline.css" rel="stylesheet">
    @endsection
@section('content')
<div class="first-widget parallax" id="blog">
    <div class="parallax-overlay">
        <div class="container pageTitle">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <h2 class="page-title">Archive</h2>
                </div> <!-- /.col-md-6 -->
                <div class="col-md-6 col-sm-6 text-right">
                    <span class="page-location">Home / Archive</span>
                </div> <!-- /.col-md-6 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.parallax-overlay -->
</div> <!-- /.pageTitle -->

<div class="container">
    <div class="row">

        <div class="col-md-12 blog-posts">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="archive-wrapper" id="articles" style="overflow: hidden">
                        <h3 class="archive-title">好！目前共计 {{ $articles->count()}} 篇博文。 继续努力。</h3>
                        <ul class="content" style="font-size:16px;">
                            <article>
                                <section v-for="(value,index) in articles" v-cloak>
                                    <span class="point-time point-blue"></span>
                                    <time datetime="">
                                        <span>@{{ value.month }}</span>
                                        <span>@{{ value.year }}</span>
                                    </time>
                                    <aside>
                                        <p class="things"><a :href="'/blog/' + value.id " target="_blank">@{{ value.title }}</a></p>
                                        <p class="brief"><span class="text-yellow">@{{ value.day }}</span>@{{ value.hour }}</p>
                                    </aside>
                                </section>
                            </article>
                        </ul>
                        <div class="text-center">
                            <navigation :pages="pages" :current.sync="pageNo" @navpage="msgListView"></navigation>
                        </div>
                    </div>
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
            <div class="elevator pull-right" style="cursor: pointer">
                <img src="/images/elevator.png" alt="elevator">
                Back to Top
            </div>
        </div> <!-- /.col-md-12 -->

    </div> <!-- /.row -->
</div> <!-- /.container -->
<div class="container">

</div> <!-- /.container -->
@endsection
@section('script')
    <script src="/js/elevator/elevator.min.js"></script>
    <script type="text/javascript" src="/js/vue.min.js"></script>
    <script type="text/javascript" src="/js/pagination.js"></script>
    <script>
        $(function() {
            var elementButton = document.querySelector('.elevator');
            var elevator = new Elevator({
                element: elementButton,
                mainAudio: '/js/elevator/music/elevator-music.mp3',//返回过程中播放的声音
                endAudio: '/js/elevator/music/ding.mp3'//到达顶部后的提示音
            });
            new Vue({
                el:"#articles",
                data:{
                    pageNo: 1,
                    pages:1,
                    pagesize:25,
                    articles:[]
                },
                methods:{
                    msgListView:function(curPage){
                        $.getJSON("/archive/json",{
                            'page':curPage,
                            'pagesize':this.pagesize
                        },function (items) {
                            this.articles = items.articles;
                            this.pages = items.pages;
                            this.pageNo = curPage;
                        }.bind(this));
                    }
                },
                created:function(){
                    _this = this;
                    $.getJSON("/archive/json",{
                        'page':this.pageNo,
                        'pagesize':this.pagesize
                    },function (items) {
                        this.articles = items.articles;
                        this.pages = items.pages;
                    }.bind(this));
                }
            });
        })
    </script>
@endsection