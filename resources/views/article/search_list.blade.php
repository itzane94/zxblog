<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H+ 后台主题UI框架 - Bootstrap Table</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
    <link href="/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/admin/css/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="/admin/css/animate.css" rel="stylesheet">
    <link href="/admin/css/style.css?v=4.1.0" rel="stylesheet">
    <script src="/js/list/list.min.js" type="text/javascript" charset="utf-8"></script>
    <style>
        ul li {
            list-style: none;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight" style="padding:0px;">
    <div class="ibox float-e-margins" id="search-list">
        <div class="ibox-content">
                    <div >
                        <input type="text" class="search form-control" style="width:360px" name="title" placeholder="标题/类型/标签"/>
                    </div>
        </div>
        <div class="ibox-content">
            <ul class="list">

            </ul>
        </div>
    </div>


</div>
<!-- 全局js -->
<script src="/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/admin/js/bootstrap.min.js?v=3.3.6"></script>

<!-- 自定义js -->
<script src="/admin/js/content.js?v=1.0.0"></script>
<script>
  $(function(){
      var options = {
          valueNames: [{ name: 'link', attr: 'href' },'title', 'type','tags'],
          item: '<li><a href="#" class="link" target="_blank"><h3 class="title"></h3></a><i class="fa fa-bookmark"></i>&nbsp;<span class="type"></span>&nbsp;&nbsp;&nbsp;<i class="fa fa-tags"></i>&nbsp;<span class="tags"></span><div class="hr-line-dashed"></div></li>'
      };
      var hackerList = new List('search-list', options);
      @foreach($articles as $article)
      hackerList.add( { link:"/blog/{{$article['id']}}",title: "{{$article['title']}}", type:"{{$article['type']}}",tags:"{{$article['tags']}}" });
      @endforeach
  })
</script>
</body>

</html>