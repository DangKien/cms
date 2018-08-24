@php
	$prioritizeNews = app('Home')->getHotNew(4);
@endphp
<div id="vk-home-default-slide">
    <div class="container-fluid">
        <div class="row">
			<div id="uni-home-defaults-slide">
			    <div id="vk-owl-demo-singer-slider" class="owl-carousel owl-theme">
			    	@foreach ($prioritizeNews as $priortizeNew) 
			        <div class="item">
			            <div class="uni-item-img-3" style="background: url({{ url('') }}{{ @$priortizeNew->url_image  }})"></div>
			            <div class="vk-item-caption">
			                <div class="vk-item-caption-top">
			                    <div class="ribbon">
			                        <span class="border-ribbon"><img src="{{ url('Frontend') }}/image/homepage1/icon/fire.png" alt="" class="img-responsive"></span>
			                    </div>
			                    <ul>
			                        <li>{{  @$priortizeNew->view }} views</li>
			                    </ul>
			                    <div class="clearfix"></div>
			                </div>
			                <div class="vk-item-caption-text">
			                    <h2><a href="{{ route('newDetail', [@$priortizeNew->id, @$priortizeNew->slug]) }}">{{ @$priortizeNew->title  }}</a></h2>
			                </div>
			                <div class="vk-item-caption-time">
			                    <span class="time"> {{ Carbon\Carbon::parse($priortizeNew->updated_at)->format('d F Y') }}</span>
			                </div>
			            </div>
			        </div>
			        @endforeach
			    </div>
			</div>
		</div>
	</div>
</div>