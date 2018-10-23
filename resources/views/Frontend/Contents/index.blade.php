@extends('Frontend.Layouts.default')
@section ('title', '')
@section('content')
	@php
		$listHotNews = app('Home')->getHotNew(6);
		$listNews    = app('Home')->getNew(6);
		$seo         = app('Setting')->getMeta();
	@endphp
	<div id="main-content" class="site-main-content">
		<div id="home-main-content" class="site-home-main-content">
			@includeif('Frontend.Layouts._slide')

			<div id="vk-home-default-body">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<div id="vk-home-default-left">

								<!--HOME DEFAULT HOT NEWS-->
								<div class="vk-home-section-hotnews">
									<div class="tab-default tabbable-panel">
										<div class="tabbable-line">
											<div class="uni-sticker-label">
												<div class="label-info">
													<a href="#">
														<img src="{{ url('Frontend') }}/image/homepage1/icon/fire.png" alt="" class="img-responsive img-gen">
														<img src="{{ url('Frontend') }}/image/fire-red.png" alt="" class="img-responsive img-hover">
														<span class="label-title">{{ trans('frontend.hotview') }}</span>
													</a>
												</div>
												<!--Tab show mobiles-->
												<div class="clearfix"></div>
											</div>
											<div class="tab-content">
												<div class="tab-pane active" id="tab_default_1">
													<div class="vk-section1-eco">
														<div id="uni-home-default-hotnews-economy-slide" class="uni-home-default-tabs owl-carousel owl-theme">
															<div class="item">
																@foreach ($listHotNews as $hotNew)
																	<div class="vk-section1-eco-item" style="padding-top: 20px;">
																		<ul>
																			<li>
																				<div class="vk-section1-eco-img">
																					<a href="{{ route('newDetail',
		                      	                            	[@$hotNew['id'], @$hotNew['slug']]) }}">
																						<img src="{{ url('') }}/{{ @$hotNew->url_image }}" alt="" class="img-responsive"></a>
																				</div>
																			</li>
																			<li>
																				<div class="vk-section-content">
																					<div class="vk-section1-eco-title">
																						<h2><a href="{{ route('newDetail',
		                      	                            	[@$hotNew['id'], @$hotNew['slug']]) }}">
																								{!! words(strip_tags(@$hotNew->title), 15,'...')  !!}
																							</a></h2>
																					</div>
																					<div class="vk-section1-eco-time">
																						<ul>
																							<li><i class="fa fa-calendar" aria-hidden="true"></i>{{ \Carbon\Carbon::parse( @$hotNew->created_at)->format('d F Y') }}</li>
																							<li><i class="fa fa-eye-slash" aria-hidden="true"></i> {{ @$hotNew['view'] }} {{ trans('frontend.view') }}</li>
																						</ul>
																					</div>
																					<div class="vk-section1-eco-text">
																						<p>
																							{!! words(strip_tags(@$hotNew['description']), 50,'...')  !!}
																						</p>
																					</div>
																				</div>

																			</li>
																		</ul>
																		<div class="clearfix"></div>
																	</div>
																@endforeach
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="vk-home-section-economy">
									<div class="tab-default tabbable-panel">
										<div class="tabbable-line">
											<div class="uni-sticker-label">
												<div class="label-info">
													<a href="#">
														<img src="{{ url('Frontend') }}/image/homepage1/icon/data.png" alt="" class="img-responsive img-gen">
														<img src="{{ url('Frontend') }}/image/eco-red.png" alt="" class="img-responsive img-hover">
														<span class="label-title">{{ trans('frontend.new') }}</span>
													</a>
												</div>
												<div class="btn btn-select btn-select-light">
													<input type="hidden" class="btn-select-input" name="economy-input" value="" />
													<span class="btn-select-value"></span>
													<span class='btn-select-arrow'><i class="fa fa-angle-down" aria-hidden="true"></i></span>
													<div class="clearfix"></div>
												</div>
												<div class="clearfix"></div>
											</div>

											<div class="tab-content">
												<div id="uni-home-default-economy-newest-slide" class="uni-home-default-tabs owl-carousel owl-theme">
													<div class="item">
														<div class="row">
															@if (count($listNews) > 1 && $newItem = $listNews->first())
																<div class="col-md-6">
																	<div class="vk-home-section-2-left">
																		<div class="vk-sec-2-left-img">
																			<a href="">
																				<img src="{{ url('') }}/{{ @$newItem->url_image }}">
																			</a>
																		</div>
																		<div class="vk-sec-2-left-content">
																			<h2><a href="">{!! words(strip_tags(@$newItem['title']), 15,'...')  !!}</a></h2>
																			<div class="vk-sec-2-left-time">
																				<ul>
																					<li><i class="fa fa-calendar" aria-hidden="true"></i> {{ Carbon\Carbon::parse( @$newItem['created_at'])->format('d F Y') }}</li>
																					<li><i class="fa fa-eye-slash" aria-hidden="true"></i> {{ @$newItem['view'] }} {{ trans('frontend.view') }}</li>
																				</ul>
																			</div>
																			<div class="vk-sec-2-left-text">
																				<p>
																					{!! words(strip_tags(@$newItem['description']), 50,'...')  !!}
																				</p>
																			</div>
																		</div>
																	</div>
																</div>
															@endif
															<div class="col-md-6">
																@foreach ($listNews as $key => $newItem)
																	@if ($key != 0)
																		<div class="vk-home-section-2-right">
																			<ul>
																				<li>
																					<div class="vk-sec-2-eco-img">
																						<a href="03_02_01_image_post.html"><img src="{{ url('') }}/{{ $newItem->url_image }}" alt="" class="img-responsive"></a>
																					</div>
																				</li>
																				<li>
																					<div class="vk-sec-2-content">
																						<div class="vk-sec-2-title">
																							<h2><a href="03_02_01_image_post.html">
																									{!! words(strip_tags(@$newItem['title']), 10,'...')  !!}
																								</a></h2>
																						</div>
																						<div class="vk-sec-2-time">
																							<span class="time"><i class="fa fa-calendar" aria-hidden="true"></i>{{ Carbon\Carbon::parse( @$newItem['created_at'])->format('d F Y') }}</span>
																						</div>
																					</div>

																				</li>
																			</ul>
																			<div class="clearfix"></div>
																		</div>
																	@endif
																@endforeach
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

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
	@php
<<<<<<< HEAD
		$arrMeta['title'] = @$seo->setting->title;
=======
		$arrMeta['title'] = @$seo->setting->meta_title;
>>>>>>> bcb538fb98ef3a05284e1cbc978fa3f9d722c37c
	@endphp
	@includeif ('Frontend.Layouts._meta', @$arrMeta ?? array() )
@endsection

