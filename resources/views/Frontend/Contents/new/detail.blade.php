@extends('Frontend.Layouts.default')
@section ('title', '')
@section('content')
	@php 
	@endphp
	<div id="main-content" class="site-main-content">
        <div id="home-main-content" class="site-home-main-content">
            <div class="uni-image-post">
              	@includeif('Frontend.Layouts._slide')
                <div class="uni-image-post-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="uni-image-post-left">
                                    <main id="main" class="site-main alignleft">
                                        <div class="page-content" style="line-height: 40px;">
                                            <article class="post-92 post type-post has-post-thumbnail">
                                                <div class="content-inner">
                                                    <div class="entry-content">
                                                        <header class="entry-header">
                                                            <h1 class="entry-title">{{ @$new->title }}</h1>
                                                        </header><!-- .entry-header -->

                                                        <div class="entry-meta">
                                                            <span class="author vcard"><a href="" rel="author"><i class="fa fa-user" aria-hidden="true"></i> {{ @$new->user_creates->name }}</a></span>
                                                            <span class="entry-date"><i class="fa fa-calendar" aria-hidden="true"></i> {{ Carbon\Carbon::parse( @$newModel['created_at'])->format('d F Y') }}</span>
                                                            <span class="meta-views"><i class="fa fa-eye" aria-hidden="true"></i> {{ @$new->view }} views</span>
                                                        </div>
                                                    </div>
                                                    <div class="entry-top">
                                                        <div class="post-formats-wrapper">
                                                            <a class="post-image" href="">
                                                                <img src="image/03_02_01_image_post/img1.jpg" class="attachment-full size-full wp-post-image img-responsive" alt="" >
                                                            </a>
                                                        </div>
                                                    </div><!-- .entry-top -->
                                                    <div class="entry-share">
                                                        <span class="title">Share</span>
                                                        <span class="fb"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></span>
                                                        <span class="tw"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></span>
                                                        <span class="gp"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></span>
                                                        <span class="pt"><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></span>
                                                    </div>
                                                    <hr>
                                                    <div class="entry-content">
                                                        <div class="entry-description">
                                                            {!! @$new->description !!}
                                                            <div class="row">
                                                                {!! @$new->content !!}
                                                             
                                                            </div>
                                                        </div>
                                                    </div><!-- .entry-content -->

                                                    <div class="entry-tag-share">
                                                        <div class="share-click">
                                                            <ul class="thim-social-share row">
                                                                <li class="facebook"></li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <hr>
                                                    <div class="entry-share">
                                                        <span class="title">Share</span>
                                                        <span class="fb"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></span>
                                                        <span class="tw"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></span>
                                                        <span class="gp"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></span>
                                                        <span class="pt"><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></span>
                                                    </div>
                                                    <hr>
                                                    <div class="entry-tags">
                                                        <h4>Tags</h4>
                                                        <ul class="list-inline">
                                                        	@php
																$tags =  explode(",", @$new->tag);
                                                        	@endphp
                                                           	@foreach ($tags as $tag)
																<li><a href="#">{{ @$tag }}</a></li>
                                                           	@endforeach 
                                                        </ul>
                                                    </div>

                                                    <div class="uni-post-pagination">
                                                        <div class="col-md-6 col-sm-6 col-xs-6 clear-padding">
                                                            <div class="uni-post-pagination-left">
                                                                <a href="#">PREVIOUS POST</a>
                                                                <div class="uni-pagination-latest">
                                                                    <div class="thumbnail-img">
                                                                        <a href="03_01_02_right_sidebar.html">
                                                                            <img src="image/03_02_01_image_post/pagination/img.jpg" alt="" title="" class="img-responsive">
                                                                        </a>
                                                                    </div>
                                                                    <div class="rel-post-text">
                                                                        <h5 class="entry-title">
                                                                            <a href="03_01_02_right_sidebar.html">Pellentesque habitant morbi tristi senectus et netus</a>
                                                                        </h5>
                                                                        <div class="entry-meta">
                                                                            <span class="entry-date"><i class="fa fa-calendar" aria-hidden="true"></i>June 21, 2017</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 col-xs-6 clear-padding">
                                                            <div class="uni-post-pagination-right">
                                                                <a href="#">NEXT POST</a>
                                                                <div class="uni-pagination-latest">
                                                                    <div class="thumbnail-img">
                                                                        <a href="03_01_02_right_sidebar.html">
                                                                            <img src="image/03_02_01_image_post/pagination/img-1.jpg" alt="" title="" class="img-responsive">
                                                                        </a>
                                                                    </div>
                                                                    <div class="rel-post-text">
                                                                        <h5 class="entry-title">
                                                                            <a href="03_01_02_right_sidebar.html" title="Futurethon – Explore the future">Pellentesque habitant morbi tristi senectus et netus</a>
                                                                        </h5>
                                                                        <div class="entry-meta">
                                                                            <span class="entry-date"><i class="fa fa-calendar" aria-hidden="true"></i>June 21, 2017</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div><!-- .content-inner -->
                                            </article><!-- #post-## -->
                                        </div><!-- .page-conten t-->

                                    </main>
                                </div>
                            </div>
                     		@includeif('Frontend.Layouts._sidebar')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
	
@section ('myJs')
	
@endsection

@section ('myCss')
	
@endsection

