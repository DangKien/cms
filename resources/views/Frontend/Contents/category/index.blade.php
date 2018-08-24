@extends('Frontend.Layouts.default')
@section ('title', '')
@section('content')
	@php 
	@endphp
	<div id="main-content" class="site-main-content">
	    <div id="home-main-content" class="site-home-main-content">
			@includeif('Frontend.Layouts._slide')
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
	                      	                <span class="label-title">Fashion</span>
	                      	            </a>
	                      	        </div>
	                      	    </div>
	                      	    @if (@$listCategory)
		                      	    <div class="row">
	                      	    		@foreach ($listCategory as $newModel)
		                      	        <div class="col-md-6">
		                      	            <div class="uni-item">
		                      	                <article class="post type-post">
		                      	                    <div class="content-inner">
		                      	                        <div class="entry-top">
		                      	                            <div class="thumbnail-img"><a href="{{ route('newDetail', 
		                      	                            	[@$newModel['id'], @$newModel['slug'] ]) }}" title=""><img src="{{ url('') }}/{{ @$newModel['url_image'] }}" alt="" title="" class="img-responsive"></a>
		                      	                            </div>
		                      	                        </div>

		                      	                        <div class="entry-content">
		                      	                            <div class="entry-header">
		                      	                                <h2 class="entry-title">
		                      	                                    <a href="{{ route('newDetail', 
		                      	                            	[@$newModel['id'], @$newModel['slug']]) }}" rel="{{ @$newModel['title'] }}" alt="{{ @$newModel['title'] }}">
		                      	                                    	{!! words(strip_tags(@$newModel['title']), 9,'...')  !!}
		                      	                                    </a>
		                      	                                </h2>
		                      	                            </div>
		                      	                            <div class="entry-meta">
		                      	                                <span class="entry-date"><i class="fa fa-calendar" aria-hidden="true"></i> {{ Carbon\Carbon::parse( @$newModel['created_at'])->format('d F Y') }}</span>
		                      	                                <span class="entry-views"><i class="fa fa-eye" aria-hidden="true"></i> {{ @$newModel['view'] }} views</span>
		                      	                            </div>
		                      	                            <div class="entry-summary">
		                      	                                <p>{!! words(strip_tags(@$newModel['description']), 30,'...')  !!}</p>
		                      	                            </div>
		                      	                            <div class="readmore">
		                      	                                <a href="{{ route('newDetail', 
		                      	                            	[@$newModel['id'], @$newModel['slug']]) }}">Read more <i class="fa fa-angle-right" aria-hidden="true"></i></a>
		                      	                            </div>
		                      	                        </div>
		                      	                    </div>
		                      	                </article>
		                      	            </div>
		                      	        </div>
		                      	        @endforeach
			                      	</div>
			                      	@if ($listCategory->lastPage() >= 1)
      			                      	<ul class="loop-pagination">
      			                      		<li class="next page-numbers {{$listCategory->currentPage() == 1 ? 'disabled': ''}}">
      			                      			<a href="{{ url()->current() }}?page={{$listCategory->currentPage() > 1 ? $listCategory->currentPage() - 1 : 1}}"><i class="fa fa-angle-left"></i></a>
      			                      		</li>
      			                      		@for($i = 1; $i <= $listCategory->lastPage(); $i++)
				                      			<li class="{{ ($listCategory->currentPage() == $i) ? 'current' : '' }}">
				                      				<a href="{{ url()->current() }}?page={{$i}}" class="page-numbers" style="cursor: pointer;" href="">{{$i}}</a></li>
				                      		@endfor
      		                      	        <li class="{{$listCategory->currentPage() == $listCategory->lastPage() ? 'disabled': ''}}"><a  class="next page-numbers" href=""><i class="fa fa-angle-right"></i></a></li>
      		                      	    </ul>
			                      	@endif
			                      	 <!-- .pagination -->
			                      	 
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

