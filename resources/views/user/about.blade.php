@extends("layouts.main")
@section("content")
<div class="first-widget parallax" id="blog">
    <div class="parallax-overlay">
        <div class="container pageTitle">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <h2 class="page-title">About</h2>
                </div> <!-- /.col-md-6 -->
                <div class="col-md-6 col-sm-6 text-right">
                    <span class="page-location">Home / About</span>
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
                    <div class="contact-wrapper">
                        <h3>Get In Touch With Us</h3>
                        <p>Nihil, aperiam, ad molestiae ut enim reprehenderit rem repudiandae ducimus dolorum obcaecati rerum accusamus provident atque eos cum. Reiciendis, modi, sint, vel, eligendi veniam esse qui quasi voluptas recusandae eum accusamus error animi expedita amet rem ad quos.</p>
                        <div class="contact-map">
                            <div class="google-map-canvas" id="map-canvas" style="height: 320px;">
                            </div>
                        </div>
                    </div> <!-- /.contact-wrapper -->
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.col-md-12 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->
@endsection