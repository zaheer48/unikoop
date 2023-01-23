<!DOCTYPE html>
<html>
<head>
    <title>@yield('title') | {{ isset($settings->site_title) ? $settings->site_title : '' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Biruang Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo url('/'); ?>/dhl/css/bootstrap.min.css">
    <link href="<?php echo url('/'); ?>/dhl/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo url('/'); ?>/dhl/font-awesome/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo url('/'); ?>/dhl/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo url('/'); ?>/dhl/owlcarousel/assets/owl.theme.default.min.css">
    <link rel="icon" href="{{ isset($settings->site_fav_icon) ? url('portal/'.$settings->site_fav_icon) : '' }}" type="image/gif" sizes="16x16">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Lato:400,300,900,700);

        .carousel-inner { margin: auto; width: 90%; }
        .carousel-control 			 { width:  4%; }
        .carousel-control.left,
        .carousel-control.right {
            background-image:none;
        }

        .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right {
            margin-top:-10px;
            margin-left: -10px;
            color: #444;
        }

        .carousel-inner {
            img {
                max-height: 150px;
                margin: auto auto;
                max-width: 100%;
            }
        }

        @media (max-width: 767px) {
            .carousel-inner > .item.next,
            .carousel-inner > .item.active.right {
                left: 0;
                -webkit-transform: translate3d(100%, 0, 0);
                transform: translate3d(100%, 0, 0);
            }
            .carousel-inner > .item.prev,
            .carousel-inner > .item.active.left {
                left: 0;
                -webkit-transform: translate3d(-100%, 0, 0);
                transform: translate3d(-100%, 0, 0);
            }

        }
        @media (min-width: 767px) and (max-width: 992px ) {
            .carousel-inner > .item.next,
            .carousel-inner > .item.active.right {
                left: 0;
                -webkit-transform: translate3d(50%, 0, 0);
                transform: translate3d(50%, 0, 0);
            }
            .carousel-inner > .item.prev,
            .carousel-inner > .item.active.left {
                left: 0;
                -webkit-transform: translate3d(-50%, 0, 0);
                transform: translate3d(-50%, 0, 0);
            }
        }
        @media (min-width: 992px ) {

            .carousel-inner > .item.next,
            .carousel-inner > .item.active.right {
                left: 0;
                -webkit-transform: translate3d(16.7%, 0, 0);
                transform: translate3d(16.7%, 0, 0);
            }
            .carousel-inner > .item.prev,
            .carousel-inner > .item.active.left {
                left: 0;
                -webkit-transform: translate3d(-16.7%, 0, 0);
                transform: translate3d(-16.7%, 0, 0);
            }

        }

    </style>
    @yield('css')
</head>
<body>
<header class="page-header" id='headnav'>
    <div class="container relative white">
        <div class="row">
            <div class="col-sm-8">
                <div class="logo">
                    <a href="<?php echo url('/'); ?>"><img src="{{ isset($settings->site_logo) ? asset('portal/'.$settings->site_logo) : '' }}"></a>
                </div>
                <div class="filter"><a href="<?php echo url('/'); ?>/dhl/#">Filter</a></div>
                <form method="get" action="{{ route('site.search') }}" accept-charset="UTF-8">

                    {{ csrf_field() }}

                    <div class="search" style="margin-top:-59px">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Zoken..." aria-label="..." id="search-field" name="search" required>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Bol.com
                                    <span class="glyphicon glyphicon-menu-down ml-10" style="font-size:10px;"></span>
                                </button>

                            </div>
                            <span class="input-group-btn"><button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button></span>

                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-4 desktop">
                <div class="dropdown">
                    <a href="<?php echo url('/'); ?>/dhl/#" class="btn btn-default dropdown-toggle" id="country"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <img src="<?php echo url('/'); ?>/dhl/images/map.png" class="mr-5"> NEDERLANDS <span
                            class="glyphicon glyphicon-menu-down ml-5" style="font-size:10px;"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="country">
                        <li><a href="<?php echo url('/'); ?>/dhl/#">Action</a></li>
                        <li><a href="<?php echo url('/'); ?>/dhl/#">Another action</a></li>
                        <li><a href="<?php echo url('/'); ?>/dhl/#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo url('/'); ?>/dhl/#">Separated link</a></li>
                    </ul>
                </div>

                <a href="<?php echo url('/'); ?>/dhl/{{ url('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                    Logout
                </a>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

                <ul class="links">
                    <li style="padding-bottom: 9px;">
                        <a href="<?php echo url('/'); ?>/dhl/#" style="padding-bottom: 0px; padding-top: 10px; height: auto;">
                            <img src="<?php echo url('/'); ?>/dhl/images/user.png" width="16" class="mr-5" style="margin-top: -8px;">{{ (Auth::user()->username) ?? 'homee' }}
                        </a>
                        <span style="text-align: center; display: block; color: #fff;">
                            &euro;{{ (Auth::user()->credit_limit) ?? '0' }}
                        </span>

                        <style>
                            #settings-drop li {
                                background-color: #fff;
                                border-right: #fff 1px solid;
                                float: none;
                            }
                            #settings-drop li a {
                                height: auto !important;
                                color: #000 !important;
                                padding-bottom: 15px;
                                padding-top: 10px;
                            }
                        </style>
                    <li>
                        <a href="#" class="dropdown-toggle" id="settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-cog" aria-hidden="true" style="font-size: 24px;"></i>
                        </a>
                        <ul class="dropdown-menu pull-right" id="settings-drop" aria-labelledby="settings">
                            <li><a href="{{ url('my-wallet')}}">My Wallet</a></li>
                            <li><a href="{{ url('myprofile-index')}}">My Profile</a></li>
                            <li><a href="{{ route('email-templates.index') }}">Email Templates</a></li>
                            <li><a href="{{ route('invoice-templates.index') }}">Invoice Templates</a></li>
                            <li><a href="{{ route('packinglist-templates.index') }}">Packing List Templates</a></li>
                            <li><a href="{{ route('payment.history')}}">Payment History</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="clear pad-10"></div>
        <div class="alert alert-warning" id="success-alert">
            <a href="<?php echo url('/'); ?>/dhl/#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>You currently have limited acces to unikoop serves!</strong><br> your information is a currently
            being validated. we will contact you if additional information is required.
        </div>
        <ul class="breadcrumb">
            <li style="list-style-type:none;padding:0px 0px 0px 5px;margin:0;"><a href="/dashboard">
                    <i class="fa fa-home" aria-hidden="true"></i> Dashboard</a></li>
            <li style="list-style-type:none;padding:0px 0px 0px 5px;margin:0;"><a href="/bol/all_orders">Bol Sheets</a>
            </li>
            <nav class="navbar navbar-default" id="navbar">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li id='stickylogo' style="display:none;">
                            <a href="<?php echo url('/'); ?>/dhl//" class="navbar-brand">
                                <img src="<?php echo url('/'); ?>/dhl/images/logo.jpeg" style='width: 100px;'></a>
                        </li>
                        <li class="active">
                            <a href="/dashboard"><!-- <i class="fa fa-home" aria-hidden="true"></i> --> Dashboard</a>
                        </li>
                        <li><a href="#">Upload Bol Sheets</a></li>
                        <li><a href="<?php echo url('/'); ?>/bol/all_orders">All BOl sheets</a>
                        </li>
                        <li><a href="<?php echo url('/'); ?>/bol/invoice">Create Invoice</a>
                        <li><a href="<?php echo url('/'); ?>/download">Download label</a>
                        <li>
                            <a href="{{ url('/account-report') }}">Transaction Report</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </ul>
    </div>
</header>
<br>
<div class="container mt-10">
    <div class="row">
        @php
            $settings = \DB::table('website_settings')->first();
        @endphp
        <div class="col-md-2 sidebar">
            <div class="card text-white blue o-hidden f-dir">
                <div class="app-card-body">
                    <div class="app-card-body-icon">
                        <i class="fa fa-cloud-download" aria-hidden="true"></i>
                    </div>
                    <p>Fetch orders from</p>
                    <h4 class="text-center">Bol.com</h4>
                </div>
            </div>
             @if(isset($settings->services_logo) AND $settings->services_logo != null)
                @php
                    $services = explode(",",$settings->services_logo);
                @endphp
                @foreach($services as $services => $value)
                    <div class="card text-white  o-hidden f-dir">
                        <div class="app-card-body">
                            <div class="app-card-body-icon">
                                <i class="fa fa-cloud-download text_blue" aria-hidden="true"></i>
                            </div>
                            <p>Fetch orders from</p>

                            <h4><img src="{{url('/portal/'.$value)}}"></h4>

                        </div>
                    </div>
                 @endforeach
            @endif
        </div>
        @yield('content')
    </div>
</div>
<br>
<footer>
    <style>
        .img-responsive {
            height: 141px !important;
            object-fit: contain !important;
        }
    </style>
    @if(isset($settings->partners_logo) AND $settings->partners_logo != null)
        <div class="container white">
            @php
                $files = explode(",",$settings->partners_logo);
                $i = 1;
            @endphp
            <div class="row" style="padding: 25px;">
                <div class="col-md-12">
                    <div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="3000" id="myCarousel">
                        <div class="carousel-inner">
                            @foreach($files as $files => $value)
                                @if($i == 1)
                                    <div class="item active">
                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                            <img src="{{url('/portal/'.$value)}}" class="img-responsive">
                                        </div>
                                    </div>
                                    <?php $i = 2; ?>
                                @else
                                    <div class="item">
                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                            <img src="{{url('/portal/'.$value)}}" class="img-responsive">
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</footer>
<br>
<!-- Bootstrap core JavaScript  -->
<script src="{{url('/dhl')}}/js/jquery.js"></script>
<script src="{{url('/dhl')}}/js/bootstrap.min.js"></script>
<script>
    $('.carousel[data-type="multi"] .item').each(function(){
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        for (var i=0;i<4;i++) {
            next=next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }

            next.children(':first-child').clone().appendTo($(this));
        }
    });
</script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function searchMember() {

        var search = $('#search-field').val();
        if (search == '') {
            document.getElementById('search-field').style.border = "1px solid #CC3333";
            document.getElementById('search-field').focus();
        } else {
            document.getElementById('search-field').style.border = "1px solid #ced4da";
            var data = "search=" + search;
            // alert(data);
            $.ajax({
                type: "GET",
                url: '{{ URL::to('searching') }}',
                data: data,
                success: function (data) {
                    // alert(data);
                    $('#main_section').hide();
                    document.getElementById('result-element').innerHTML = data;
                    document.getElementById('search-field').value = '';

                }
            });
        }
    }

    function downloadPDF(id,label) {
        var data = "id=" + id + "&label=" + label;
        $('#downLabels').modal('show');
        $.ajax({
            type: "GET",
            url: '{{ URL::to('/download-pdf') }}',
            data: data,
            success: function (data) {
                $('#downLabels').modal('hide');
            }
        });
    }

</script>
<!--<script src="{{url('/dhl')}}/owlcarousel/jquery.min.js"></script>-->
<script src="{{url('/dhl')}}/owlcarousel/owl.carousel.min.js"></script>
<script type="text/javascript">

    // new WOW().init();
    $('.carousel').carousel({
        interval: 3000 //changes the speed
    });

</script>
<script type="text/javascript">
    $('.owl-carousel').owlCarousel({
        rtl: true,
        loop: true,
        margin: 10,
        dots: false,
        nav: true,
        autoWidth: true,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

</script>
@yield('js')
</body>
</html>