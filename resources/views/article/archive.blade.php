@extends('layouts.main')
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
                <div class="col-md-12">
                    <div class="archive-wrapper">
                        <h3 class="archive-title">Archives by Month:</h3>
                        <ul class="archive-list">
                            <li><a href="#">January 2084</a></li>
                            <li><a href="#">December 2083</a></li>
                            <li><a href="#">November 2083</a></li>
                            <li><a href="#">October 2083</a></li>
                            <li><a href="#">September 2083</a></li>
                            <li><a href="#">August 2083</a></li>
                            <li><a href="#">July 2083</a></li>
                        </ul>
                    </div>
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.col-md-12 -->

    </div> <!-- /.row -->
</div> <!-- /.container -->



<div class="container">

</div> <!-- /.container -->
@endsection