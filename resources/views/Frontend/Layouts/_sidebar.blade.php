@php
	$listTags = app('TagFrontend')->listTag();
    $listCategory = app ('Home')->getCategory();

    $listPeriods  = app('Home')->getPeriod();
@endphp
<aside class="col-md-4">
    <aside class="widget-area">
        <aside class="widget">
            <div class="widget-content">
                <div class="vk-home-default-right-ad">
                    <a href="#">
                        <img src="{{ url('Frontend') }}/image/ad-sidebar.jpg" alt="ad-sidebar" class="img-responsive">
                    </a>
                </div>
            </div>
        </aside>

        <aside class="widget">
            <h3 class="widget-title">{{ trans('frontend.category') }}</h3>
            <div class="widget-content">
                <div class="vk-home-default-right-ep">
                    <div id="vk-owl-ep-slider" class="uni-owl-sidebar-default owl-carousel owl-theme">
                        <div class="item">
                            <ul class="category-item">
                                
                                @foreach ($listCategory as $cateItem)
                                <li>
                                    <div class="vk-item-ep">
                                        <div>
                                            <a href="{{ route('category', [@$cateItem->id, @$cateItem->slug]) }}">{!! showCategoriesSidebar($cateItem) !!}
                                                <i class="fa fa-angle-double-right"></i>&nbsp;&nbsp;{{ @$cateItem->name }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <aside class="widget">
            <h3 class="widget-title">{{ trans('frontend.period') }}</h3>
            <div class="widget-content">
                <div class="vk-home-default-right-ep">
                    <div id="vk-owl-ep-slider" class="uni-owl-sidebar-default owl-carousel owl-theme">
                        <div class="item">
                            <ul class="category-item">
                                @foreach ($listPeriods as $item)
                                <li>
                                    <div class="vk-item-ep">
                                        <div>
                                            <a href="#">
                                                <i class="fa fa-angle-double-right"></i>&nbsp;&nbsp;{{ @$item->year.trans('frontend.year').@$item->month.trans('frontend.month') }} 
                                            </a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <aside class="widget">
            <h3 class="widget-title">{{ trans('frontend.tag_clound') }}</h3>
            <div class="widget-content">
                <div class="vk-home-default-right-tags">
                    <ul>
                    	@foreach ($listTags as $tag)
							<li><a href="{{ route('search', ['search' => $tag->name]) }}">{{ @$tag->name }}</a></li>
                    	@endforeach
                        
                    </ul>
                </div>
            </div>
        </aside>

    </aside>
</aside>