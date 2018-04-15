@extends('layouts.main')
@section('content')
<section id="homeIntro" class="parallax first-widget">
    <div class="parallax-overlay">
        <div class="container home-intro-content">
            <div class="row">
                <div class="col-md-12">
                    <p>What's in a name? That which we call a rose
                        By any other name would smell as sweet. <br> William Shakespeare </p>
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.parallax-overlay -->
</section> <!-- /#homeIntro -->
<section class="light-content services">
    <div class="container">
        <div class="row">

            <div class="col-md-4 col-sm-4">
                <div class="service-box-wrap">
                    <div class="service-icon-wrap">
                        <i class="fa fa-umbrella fa-2x"></i>
                    </div> <!-- /.service-icon-wrap -->
                    <div class="service-cnt-wrap">
                        <h3 class="service-title">Friendship</h3>
                        <p>与共</p>
                    </div> <!-- /.service-cnt-wrap -->
                </div> <!-- /.service-box-wrap -->
            </div> <!-- /.col-md-4 -->

            <div class="col-md-4 col-sm-4">
                <div class="service-box-wrap">
                    <div class="service-icon-wrap">
                        <i class="fa fa-mobile-phone fa-2x"></i>
                    </div> <!-- /.service-icon-wrap -->
                    <div class="service-cnt-wrap">
                        <h3 class="service-title">Connection</h3>
                        <p>你我</p>
                    </div> <!-- /.service-cnt-wrap -->
                </div> <!-- /.service-box-wrap -->
            </div> <!-- /.col-md-4 -->

            <div class="col-md-4 col-sm-4">
                <div class="service-box-wrap">
                    <div class="service-icon-wrap">
                        <i class="fa fa-pencil-square-o fa-2x"></i>
                    </div> <!-- /.service-icon-wrap -->
                    <div class="service-cnt-wrap">
                        <h3 class="service-title">Record</h3>
                        <p>拾忆</p>
                    </div> <!-- /.service-cnt-wrap -->
                </div> <!-- /.service-box-wrap -->
            </div> <!-- /.col-md-4 -->

        </div>

        <div class="row">

            <div class="col-md-4 col-sm-4">
                <div class="service-box-wrap">
                    <div class="service-icon-wrap">
                        <i class="fa fa-code fa-2x"></i>
                    </div> <!-- /.service-icon-wrap -->
                    <div class="service-cnt-wrap">
                        <h3 class="service-title">Code</h3>
                        <p>码</p>
                    </div> <!-- /.service-cnt-wrap -->
                </div> <!-- /.service-box-wrap -->
            </div> <!-- /.col-md-4 -->

            <div class="col-md-4 col-sm-4">
                <div class="service-box-wrap">
                    <div class="service-icon-wrap">
                        <i class="fa fa-book fa-2x"></i>
                    </div> <!-- /.service-icon-wrap -->
                    <div class="service-cnt-wrap">
                        <h3 class="service-title">Book</h3>
                        <p>书</p>
                    </div> <!-- /.service-cnt-wrap -->
                </div> <!-- /.service-box-wrap -->
            </div> <!-- /.col-md-4 -->

            <div class="col-md-4 col-sm-4">
                <div class="service-box-wrap">
                    <div class="service-icon-wrap">
                        <i class="fa fa-suitcase fa-2x"></i>
                    </div> <!-- /.service-icon-wrap -->
                    <div class="service-cnt-wrap">
                        <h3 class="service-title">Package</h3>
                        <p>旅人</p>
                    </div> <!-- /.service-cnt-wrap -->
                </div> <!-- /.service-box-wrap -->
            </div> <!-- /.col-md-4 -->

        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section> <!-- /.services -->

<section class="dark-content portfolio">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header">
                    <h2 class="section-title"><i class="fa fa-th-list"></i></h2>
                    <p class="section-desc">Recent Posts</p>
                </div> <!-- /.section-header -->
            </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->

    <div id="portfolio-carousel" class="portfolio-carousel portfolio-holder">
        @foreach($articles as $article)
            <div class="item">
                <div class="thumb-post">
                    <div class="overlay">
                        <div class="overlay-inner">
                            <div class="portfolio-infos">
                                <span class="meta-category">{{$article['type']['name']}}</span>
                                <h3 class="portfolio-title"><a href="project-slideshow.html">{{$article['title']}}</a></h3>
                            </div>
                            <div class="portfolio-expand">
                                <a class="fancybox" href="{{$article['cover']}}" title="{{$article['type']['name']}} | {{$article['title']}}">
                                    <i class="fa fa-expand"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <img src="{{$article['cover']}}" class="img-responsive" style="width:458px;height:344px;"  alt="Visual Admin">
                </div>
            </div> <!-- /.item -->
            @endforeach
    </div> <!-- /#owl-demo -->
</section> <!-- /.portfolio-holder -->

<section class="testimonials-widget">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="bxslider">
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <span class="testimonial-author">Andy Colin - Architect</span>
                            <p class="testimonial-description">Thank you for all your good work in creating theme. They have a ‘presence’ which feels right.</p>
                        </div>
                    </div>
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <span class="testimonial-author">Thomas Teddy - Design Writer</span>
                            <p class="testimonial-description">I love the logo. Particularly how the mark can stand on its own. Nice work! It feels tall and proud and powerful — and I love that. That’s what I was after.</p>
                        </div>
                    </div>
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <span class="testimonial-author">John Willy - Developer</span>
                            <p class="testimonial-description">You’re pretty awesome to work with. Incredibly organized, easy to communicate with, responsive with next iterations, and beautiful work.</p>
                        </div>
                    </div>
                </div> <!-- /.bxslider -->
            </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section> <!-- /.testimonials-widget -->

<section id="blogPosts" class="parallax">
    <div class="parallax-overlay">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header">
                        <h2 class="section-title"><i class="fa fa-link"></i></h2>
                        <p class="section-desc">Friendly Links</p>
                    </div> <!-- /.section-header -->
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
            <div class="row latest-posts">
                <div class="col-md-4 col-sm-6">
                    <div class="blog-post clearfix">
                        <div class="thumb-post">
                            <a href="blog-single.html"><img src="/home/images/includes/blogthumb1.jpg" alt="" class="img-circle"></a>
                        </div>
                        <div class="blog-post-content">
                            <h4 class="post-title"><a href="blog-single.html">Getting Creative With the Google Maps API</a></h4>
                            <span class="meta-post-date">12 February 2084</span>
                        </div>
                    </div> <!-- /.blog-post -->
                </div> <!-- /.col-md-4 -->
                <div class="col-md-4 col-sm-6">
                    <div class="blog-post clearfix">
                        <div class="thumb-post">
                            <a href="blog-single.html"><img src="/home/images/includes/blogthumb2.jpg" alt="" class="img-circle"></a>
                        </div>
                        <div class="blog-post-content">
                            <h4 class="post-title"><a href="blog-single.html">Design Deliverables – easily share project</a></h4>
                            <span class="meta-post-date">10 February 2084</span>
                        </div>
                    </div> <!-- /.blog-post -->
                </div> <!-- /.col-md-4 -->
                <div class="col-md-4 col-sm-6">
                    <div class="blog-post clearfix">
                        <div class="thumb-post">
                            <a href="blog-single.html"><img src="/home/images/includes/blogthumb3.jpg" alt="" class="img-circle"></a>
                        </div>
                        <div class="blog-post-content">
                            <h4 class="post-title"><a href="blog-single.html">Using Templates to Get Your Clients Thinking</a></h4>
                            <span class="meta-post-date">8 February 2084</span>
                        </div>
                    </div> <!-- /.blog-post -->
                </div> <!-- /.col-md-4 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.parallax-overlay -->
</section> <!-- /#blogPosts -->
@endsection
