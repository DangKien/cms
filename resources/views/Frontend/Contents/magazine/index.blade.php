@extends('Frontend.Layouts.default')
@section ('title', '')
@section('content')
    @php 
        $magazines = app('Home')->getListMagazine(); 
    @endphp
    <div id="main-content" class="site-main-content">
        <div id="home-main-content" class="site-home-main-content">
            <!-- @includeif('Frontend.Layouts._slide') -->
            <div id="vk-home-default-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="uni-category-grid-2-columns-left">

                                <!--sticker label-->
                                <div class="uni-sticker-label">
                                    <div class="label-info">
                                        <a href="">
                                            <img src="{{ url('Frontend') }}/image/homepage1/icon/fashion.png" alt="" class="img-responsive img-gen">
                                            <img src="{{ url('Frontend') }}/image/fas-red.png" alt="" class="img-responsive img-hover">
                                            <span class="label-title">{{ trans('frontend.magazine') }}</span>
                                        </a>
                                    </div>
                                </div>
                                @if (@$magazines)
                                    <div class="row">
                                        @foreach ($magazines as $magazine)
                                        <div class="col-md-6">
                                            <div class="uni-item">
                                                <article class="post type-post">
                                                    <div class="content-inner">
                                                        <div class="entry-top">
                                                            <div class="thumbnail-img"><a href="{{ route('magazine.detail', 
                                                                [@$magazine->id, @$magazine->slug ]) }}" title=""><img src="{{ url('') }}/{{ @$magazine->url_image }}" alt="" title="" class="img-responsive"></a>
                                                            </div>
                                                        </div>

                                                        <div class="entry-content">
                                                            <div class="entry-header">
                                                                <h2 class="entry-title">
                                                                    <a href="{{ route('magazine.detail', 
                                                                [@$magazine->id, @$magazine->slug]) }}" rel="{{ @$magazine->title }}" alt="{{ @$magazine->title }}">
                                                                        {!! words(strip_tags(@$magazine->title), 9,'...')  !!}
                                                                    </a>
                                                                </h2>
                                                            </div>
                                                            <div class="entry-meta">
                                                                <span class="entry-date"><i class="fa fa-calendar" aria-hidden="true"></i> {{ Carbon\Carbon::parse( @$magazine->created_at)->format('d F Y') }}</span>
                                                                <span class="entry-views"><i class="fa fa-eye" aria-hidden="true"></i> {{ @$magazine->view }} {{ trans('frontend.view') }}</span>
                                                            </div>
                                                            <div class="entry-summary">
                                                                <p>{!! words(strip_tags(@$magazine->description), 30,'...')  !!}</p>
                                                            </div>
                                                            <div class="readmore">
                                                                <a href="{{ route('magazine.detail', 
                                                                [@$magazine->id, @$magazine->slug]) }}">{{ trans('frontend.readmore') }}<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    {{ @$magazines->links() }}
                                @endif
                            </div>
                        </div>
                        @includeif('Frontend.Layouts._sidebar')
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
    @includeif ('Frontend.Layouts._meta', @$arrMeta ?? array() )
@endsection