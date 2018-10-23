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
                                                            <span class="meta-views"><i class="fa fa-eye" aria-hidden="true"></i> {{ @$new->view }} {{ trans('frontend.view') }}</span>
                                                        </div>
                                                    </div>
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
                                                    </div>
                                                    <hr>
                                                    <div class="entry-tags">
                                                        <h4>Tags</h4>
                                                        <ul class="list-inline">
                                                        	@php
																$tags =  explode(",", @$new->tag);
                                                        	@endphp
                                                           	@if (!empty($tags))
																@foreach ($tags as $tag)
																	@if (!empty($tag))
																	<li><a href="{{ route('search', ['search' => $tag]) }}">{{ @$tag }}</a></li>
																	@endif
                                                           		@endforeach 
															@endif
                                                        </ul>
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

@section ('metaData')
    @php
        $arrMeta['title']            = @$new->title; 
        $arrMeta['meta_title']       = @$new->title; 
        $arrMeta['meta_description'] = @$new->meta_description; 
        $arrMeta['meta_keyword']     = @$new->meta_keyword; 
        $arrMeta['meta_content']     = @$new->meta_content; 
        $arrMeta['meta_image']       = @$new->url_image; 
    @endphp
    @includeif ('Frontend.Layouts._meta', @$arrMeta ?? array() )
@endsection