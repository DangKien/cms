@extends('Frontend.Layouts.default')
@section('content')
	@php 
	@endphp
	<div id="main-content" class="site-main-content">
        <div id="home-main-content" class="site-home-main-content">
            <div class="uni-image-post">
              	<!-- @includeif('Frontend.Layouts._slide') -->
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
                                                            <h1 class="entry-title">{{ @$magazine->title }}</h1>
                                                        </header><!-- .entry-header -->

                                                        <div class="entry-meta">
                                                            <span class="entry-date"><i class="fa fa-calendar" aria-hidden="true"></i> {{ Carbon\Carbon::parse( @$magazineModel['created_at'])->format('d F Y') }}</span>
                                                            <span class="meta-views"><i class="fa fa-eye" aria-hidden="true"></i> {{ @$magazine->view }} {{ trans('frontend.view') }}</span>
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
                                                        <span class="title">{{ trans('frontend.share') }}</span>
                                                        
                                                        <span class="fb">
                                                            <div class="fb-share-button" data-href="{{ url()->full() }}" data-layout="button" data-size="small" data-mobile-iframe="true">
                                                                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}%2F&amp;src=sdkpreparse" onclick="return !window.open(this.href, 'Facebook', 'width=640,height=580')">
                                                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                        </span>
                                                        <span class="wc"><a href="#"><i class="fa fa-wechat" aria-hidden="true"></i></a></span>
                                                        <span class="gp">
                                                            <a href="https://plus.google.com/share?url={{ url()->full() }}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                                                            <i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                                        </span> 

                                                        <!-- <span class="pt"><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></span> -->
                                                    </div>
                                                    <hr>
                                                    <div class="entry-content">
                                                        <div class="entry-description">
                                                            <iframe style="width: 100%; height: 800px;" src="{{ asset($magazine->url_flipbook) }}">
                                                                
                                                            </iframe>
                                                        </div>
                                                    </div><!-- .entry-content -->

                                                    <div class="entry-tag-share">
                                                        <div class="share-click">
                                                            <ul class="thim-social-share row">
                                                                <li class="facebook"></li>
                                                            </ul>
                                                        </div>
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
	<!-- <div id="fb-root"></div> -->
    <!-- <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.1&appId=1888948631430030&autoLogAppEvents=1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <g:plus action="share"></g:plus> -->
@endsection

@section ('myCss')
	
@endsection



@section ('metaData')
    @php
        $arrMeta['title']            = @$magazine->title; 
        $arrMeta['meta_title']       = @$magazine->title; 
        $arrMeta['meta_description'] = @$magazine->meta_description; 
        $arrMeta['meta_keyword']     = @$magazine->meta_keyword; 
        $arrMeta['meta_content']     = @$magazine->meta_content; 
        $arrMeta['meta_image']       = @$magazine->url_image; 
    @endphp
    @includeif ('Frontend.Layouts._meta', @$arrMeta ?? array() )
@endsection
