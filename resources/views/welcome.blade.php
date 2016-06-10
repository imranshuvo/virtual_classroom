@extends('layouts.app')

@section('content')
<!-- Header -->
    <a name="about"></a>
    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Best Courses. Learn anytime, anywhere.</h1>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <a href="{{ url('courses') }}" class="btn btn-default btn-lg"><i class="fa fa-search fa-fw"></i> <span class="network-name">View All Courses!</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->

    <!-- Page Content -->

    <a  name="services"></a>
    <div class="content-section-a">

        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Earn a Valuable Certificate</h2>
                    <p class="lead">Select the Verified Certificate course option and receive an instructor-signed certificate with the institution's logo to verify your achievement and increase your job prospects. </p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="img/ipad.png" alt="">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->




    <a  name="contact"></a>
    <div class="banner">

        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <h2>Start Learning Today</h2>
                </div>
                <div class="col-lg-6">
                    <ul class="list-inline banner-social-buttons">
                        <li>
                            <a href="{{ url('/login') }}" class="btn btn-default btn-lg"><span class="network-name">Login</span></a>
                        </li>
                        <li>
                            <a href="{{ url('/register') }}" class="btn btn-default btn-lg"><span class="network-name">Register</span></a>
                        </li>
                      
                    </ul>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.banner -->

    

    
@endsection
