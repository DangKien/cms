@php 
	$menus = app('Menu')->getMenu();
@endphp

<!-- Mobile nav -->
<nav class="visible-sm visible-xs mobile-menu-container mobile-nav">
    <div class="menu-mobile-nav navbar-toggle">
        <span class="icon-search-mobile"><i class="fa fa-search" aria-hidden="true"></i></span>
        <span class="icon-bar"><i class="fa fa-bars" aria-hidden="true"></i></span>
    </div>
    <div id="cssmenu" class="animated">
        <div class="uni-icons-close"><i class="fa fa-times" aria-hidden="true"></i></div>
        <ul class="nav navbar-nav animated">
            <li class="home-icon">
                <a href="{{ route('home') }}">
                Home
                </a>
            </li>
                {{ showMenuTop(@$menus->data_menu) }}          

        </ul>
        <div class="uni-nav-mobile-bottom">
            <div class="form-search-wrapper-mobile">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-addon success"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</nav>
<!-- End mobile menu -->
<header>
    <div class="vk-header-default">
        <div class="container-fluid">
            <div class="row">
                <div class="vk-top-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="vk-top-header-1">
                                    <ul>
                                        <li><a href="#">Contact</a></li>
                                        <li><a href="#">Purchase Now</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="vk-top-header-2">
                                    <ul>
                                        <li><span id="datetime-current"></span></li>
                                        <li>-</li>
                                        <li><span id="year-current"></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="vk-top-header-3">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="vk-between-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="vk-between-header-logo">
                                    <a href="{{ route('home') }}"><img src="{{ url('Frontend') }}/image/logo_24.png" alt="" class="img-responsive"></a>
                                </div>
                            </div>
                            <div class="col-md-8 col-md-offset-1">
                                <div class="vk-between-header-banner">
                                    <a href="#"><img src="{{ url('Frontend') }}/image/ad-header.jpg" alt="" class="img-responsive"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="visible-md visible-lg vk-bottom-header uni-sticky">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-11">
                                <div class="cssmenu">
                                    <ul>
                                        <li class="has-sub home-icon"><a href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true"></i></a>
                                        </li>
                                        {{ showMenuTop(@$menus->data_menu) }}
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="uni-search-des">
                                    <div class="vk-bottom-header-search toggle-form">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Form search-->
                        <div class="form-search-wrapper">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="input-group-addon success"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
