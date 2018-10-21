@extends('layouts.main')
@section('content')
<section id="homeIntro" class="parallax first-widget">
    <div class="parallax-overlay">
        <div class="container home-intro-content">
            <div class="row">
                <div class="col-md-12">
                    <p> {{ $tip['wisdom'] }} <br>  {{ $tip['author'] }} </p>
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
                    </div> <!-- /.service-cnt-wrap -->
                </div> <!-- /.service-box-wrap -->
            </div> <!-- /.col-md-4 -->

        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section> <!-- /.services -->


<section class="testimonials-widget">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="bxslider">
                    @foreach($tips as $tip)
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <span class="testimonial-author">{{ $tip['author'] }}</span>
                            <p class="testimonial-description">{{ $tip['wisdom'] }}</p>
                        </div>
                    </div>
                        @endforeach
                </div> <!-- /.bxslider -->
            </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section> <!-- /.testimonials-widget -->
@endsection
