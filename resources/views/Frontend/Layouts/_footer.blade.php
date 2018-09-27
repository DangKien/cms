@php
    $contact = app('Setting')->getContact();
    $news    = app('Home')->getHotNew(3);
    $magazines = app('Home')->getMagazine(3); 
@endphp

<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="vk-sec-footer">
                <div class="container">
                    <div class="row">
                        <div class="vk-footer">
                            <div class="footer-main-content-element col-sm-4">
                                <aside class="widget">
                                    <div class="widget-title">
                                        <a href="{{ route('home') }}"><img src="{{ url('Frontend') }}/image/logo_2.png" alt="" class="img-responsive"></a>
                                    </div>
                                    <div class="widget-content">
                                        <div class="vk-footer-1">

                                            <div class="vk-footer-1-content">
                                                <p>
                                                    {{ @$contact->setting->description }}
                                                </p>
                                                <div class="vk-footer-1-address">
                                                    <ul>
                                                        <li><i class="fa fa-map-marker" aria-hidden="true"></i> <span>{{ @$contact->setting->address }}</span></li>
                                                        <li><i class="fa fa-envelope-o" aria-hidden="true"></i> <span><a href="#">{{ @$contact->setting->email }}</a></span></li>
                                                        <li><i class="fa fa-headphones" aria-hidden="true"></i> <span> {{ @$contact->setting->phone }}</span></li>
                                                    </ul>
                                                </div>
                                                <div class="vk-footer-1-icon">
                                                    <ul>
                                                        <li><a href="{{ @$contact->setting->fb }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                                        <li><a href="{{ @$contact->setting->twitter }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                                        <li><a href="{{ @$contact->setting->google_plus }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                                        <li><a href="{{ @$contact->setting->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                                        <li><a href="{{ @$contact->setting->youtube }}"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                                        <li><a href="{{ @$contact->setting->fb }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                            <div class="footer-main-content-element col-sm-4">
                                <aside class="widget">
                                    <h3 class="widget-title"> {{ trans('frontend.lasternew') }}</h3>
                                    <div class="widget-content">
                                        <div class="vk-footer-2">
                                            <div class="vk-footer-2-content">
                                                <ul>
                                                    @foreach ($news as $new)
                                                    <li>
                                                        <div class="vk-footer-img">
                                                            <a href="{{ route('newDetail', 
                                                                [@$new['id'], @$new['slug']]) }}"><img src="{{ url('') }}{{ $new->url_image }}" alt="" class="img-responsive"></a>
                                                        </div>
                                                        <div class="vk-footer-content">
                                                            <div class="vk-footer-title">
                                                                <h2><a href="{{ route('newDetail', 
                                                                [@$new['id'], @$new['slug']]) }}">{!! words(strip_tags(@$new['title']), 9,'...')  !!}</a></h2>
                                                            </div>
                                                            <div class="vk-footer-time">
                                                                <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i> {{ Carbon\Carbon::parse( @$new['created_at'])->format('d F Y') }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                            <div class="footer-main-content-element col-sm-4">
                                <aside class="widget">
                                    <h3 class="widget-title">{{ trans('frontend.magazine_new') }}</h3>
                                    <div class="widget-content">
                                        <div class="vk-footer-3">
                                            <div class="vk-footer-3-content">
                                                @foreach ($magazines as $magazine)
                                                <p>
                                                    <span>
                                                        <a href="{{ route('magazine.detail', [$magazine->id, $magazine->slug]) }}">
                                                         {{ $magazine->title }}</a>
                                                    </span>
                                                </p>
                                                <div class="time">Created_at: {{ Carbon\Carbon::parse( @$magazine->created_at)->format('d F Y') }}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </aside>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="vk-sub-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="vk-sub-footer-1 text-center">
                                    <p>
                                        {{ @$contact->setting->coppyright }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>