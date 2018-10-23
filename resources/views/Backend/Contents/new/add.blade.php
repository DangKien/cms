@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
<div id="content-container">
	<div id="page-head">
        <div id="page-title">
            <h1 class="page-header text-overflow"> {!! trans('backend.new.new') !!} </h1>
        </div>
        <ol class="breadcrumb">
			<li><a href="#"><i class="demo-pli-home"></i></a></li>
			<li><a href="#">{{ isset($new) ? trans('backend.actions.update') : trans('backend.actions.create') }}</a></li>
        </ol>
    </div>
    @php
		$languages = app('Language')->getLanguage();
    @endphp
	<div id="page-content">
        <div class="panel">
            <div class="panel">
	            <div class="panel-heading">
	               	<div class="panel-heading">
		                <h3 class="panel-title text-main text-bold mar-no">
		                	<i class="ti-pencil"></i> {{ isset($new) ? trans('backend.actions.update') : trans('backend.actions.create') }} 
		                </h3>
		            </div>
	            </div>

                <div class="panel-body">
                	<div class="col-md-12">
                		<div class="tab-base">
                		    <!--Nav Tabs-->
                		    <ul class="nav nav-tabs tabs-border">
                		        <li class="active">
                		            <a data-toggle="tab" href="#demo-lft-tab-1">{!! trans('backend.new.garena') !!}</a>
                		        </li>
                		        <li>
                		            <a data-toggle="tab" href="#demo-lft-tab-2">{!! trans('backend.new.detail') !!}</a>
                		        </li>
                		    </ul>
                			@if (isset($new))
								<form action="{{ route('news.update', @$new->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
									@method('PUT')
                			@else 
                				<form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
                					@method('POST')
                			@endif
    		                @csrf
	                		    <!--Tabs Content-->
	                		    <div class="tab-content">
	                		    	<!-- Tab language -->
	                		        <div id="demo-lft-tab-1" class="tab-pane fade active in">
	                		        	<div class="panel-body col-sm-offset-1">
	                		        		<div class="tab-base">
	                		        		    <!--Nav Tabs-->
	                		        		    <ul class="nav nav-tabs tabs-border">
													@foreach (@$languages as $key => $languageTab)
	                		        		        <li class="{{ $key == 0 ? 'active' : '' }}">
	                		        		            <a data-toggle="tab" href="#language-tab-{{ @$languageTab->id }}">
	                		        		            	{{ @$languageTab->name_display }}
	                		        		            </a>
	                		        		        </li>
	                		        		        @endforeach
	                		        		    </ul>
	                		        		    <div class="tab-content">
	                		                        @foreach (@$languages as $key => $languageTab)
	                		                        	@if (isset($new))
		                		                        	@php
																$recordNew = app('NewsBackend')->recordNew(@$new->id, @$languageTab->locale);
		                		                        	@endphp
		                		                        @endif
	                		                        <div id="language-tab-{{ @$languageTab->id }}" 
	                		                        	class="tab-pane {{ $key == 0 ? 'fade active in' : '' }}">
														<!-- Title -->
								                        <div class="col-sm-11">
								                            <div class="form-group">
								                                <label class="control-label text-bold">
								                                	{!! trans('backend.new.title') !!}
								                                	<span class="text-danger">*</span>
								                                </label>

								                                <input  type="text" name="title[{{ @$languageTab->id }}]" class="form-control" 
								                                value="{{ @$recordNew->title ? $recordNew->title : old('title.'.@$languageTab->id) }}">

								                                @if ($errors->has('title.'.@$languageTab->id))
									                            	<p class="text-left text-danger">{{ $errors->first('title.'.@$languageTab->id) }}</p>
									                            @endif
								                            </div>
								                        </div> 
								                        <!-- description -->
								                        <div class="col-sm-11">
						                                    <div class="form-group">
						                                        <label class="control-label text-bold">
						                                        	{!! trans('backend.new.description') !!}
						                                        </label>

						                                        <textarea class="my-ckeditor" name="description[{{ @$languageTab->id }}]" placeholder="{!! trans('backend.new.description') !!}" rows="5" class="form-control">{{ @$recordNew->description ? $recordNew->description : old('description.'.@$languageTab->id) }}</textarea>
						                                    </div>
						                                </div>
														<!-- content -->
						                                <div class="col-sm-11">
						                                    <div class="form-group">
						                                        <label class="control-label text-bold">
						                                        	{!! trans('backend.new.content') !!}
						                                        </label>

						                                        <textarea class="my-ckeditor" name="content[{{ @$languageTab->id }}]" placeholder="{!! trans('backend.new.content') !!}" rows="5" class="form-control">{{ @$recordNew->content ? $recordNew->content : old('content.'.@$languageTab->id) }}</textarea>
						                                    </div>
						                                </div>
														<!-- tag -->
														<div class="col-sm-11">
						                                    <div class="form-group">
						                                        <label class="control-label text-bold">
						                                        	{!! trans('backend.new.tag') !!}
						                                        </label>
																<input type="text" class="form-control" placeholder="Type to add a tag" data-role="tagsinput"  value="{{ @$recordNew->tag ? $recordNew->tag : old('tag.'.@$languageTab->id) }}" name="tag[{{ @$languageTab->id }}]" >
						                                    </div>
						                                </div>

														<!-- meta_title -->
						                                <div class="col-sm-11">
						                                    <div class="form-group">
						                                        <label class="control-label text-bold">
						                                        	{!! trans('backend.new.meta_title') !!}
						                                        </label>

						                                        <input type="text" name="meta_title[{{ @$languageTab->id }}]" class="form-control" value="{{ @$recordNew->meta_title ? $recordNew->meta_title : old('meta_title.'.@$languageTab->id) }}">
						                                    </div>
						                                </div>
								                        <div class="col-sm-11">
								                            <div class="form-group">
								                                <label class="control-label text-bold">
								                                	{!! trans('backend.new.meta_description') !!} 
								                                </label>
								                                <textarea name="meta_description[{{ @$languageTab->id }}]" placeholder="{!! trans('backend.new.meta_description') !!}" rows="5" class="form-control">{{ @$recordNew->meta_description ? $recordNew->meta_description : old('meta_description.'.@$languageTab->id) }}</textarea>
								                            </div>
								                        </div>
						                                <div class="col-sm-11">
						                                    <div class="form-group">
						                                        <label class="control-label text-bold">
						                                        	{!! trans('backend.new.meta_content') !!}
						                                        </label>
						                                        <textarea name="meta_content[{{ @$languageTab->id }}]" placeholder="{!! trans('backend.new.meta_content') !!}" rows="5" class="form-control">{{ @$recordNew->meta_content ? @$recordNew->meta_content : old('meta_content.'.@$languageTab->id)}}</textarea>
						                                    </div>
						                                </div>
					                            	</div>
	                		                        @endforeach
                		                    	</div>
	                		        		</div>
                		                    
                		                </div>
            		                </div>
	                		        <!-- Tab detail -->
	                		        <div id="demo-lft-tab-2" class="tab-pane fade">
	                		            <div class="panel-body col-sm-offset-1">
	                					<!-- data-parsley-validate -->
			    		                    <div class="row">
			    		                        <div class="col-sm-11">
			    		                            <div class="form-group">
			    		                                <label class="control-label text-bold">
			    		                                	{!! trans('backend.new.category') !!}
			    		                                	<span class="text-danger">*</span>
			    		                                </label>
	    	    		                                <select multiple="multiple" data-live-search="true" class="form-control selected-2" data-width="100%" name="categories[]">
    					                                    {{ showCategoriesNew($categories, 0, "--", @$new->categories ? @$new->categories : ( old('categories') ?  old('categories') : array() ) )}}
	    				                            	</select>
			    		                                @if ($errors->has('parent_id'))
			    			                            	<p class="text-left text-danger">{{ $errors->first('parent_id') }}</p>
			    			                            @endif
			    		                            </div>
			    		                        </div> 

            			                        <div class="col-sm-10">
        				                            <div class="form-group">
        				                                <label class="control-label text-bold">
        				                                	{!! trans('backend.new.image') !!} <span class="text-danger"> (*)</span>
        				                                </label>
        				                                 <div class="input-group">
        													<span class="input-group-btn">
        														<a data-input="thumbnail" data-preview="holder" class="btn btn-primary my-lfm" type="'image'">
        															<i class="fa fa-picture-o"></i> Choose
        														</a>
        													</span>
        													<input id="thumbnail" class="form-control" type="text" name="url_image" value="{{ @$new->url_image ? $new->url_image: @old('url_image') }}">
        												</div>
        												<img id="holder" 
        													@if (@$new->url_image || @old('url_image'))
        	    			                            	 	src="{{ url('') }}/{{ @$new->url_image ? $new->url_image : @old('url_image') }}" 
        													@endif style="margin-top:15px;max-height:100px;">
        				                                @if ($errors->has('url_image'))
        					                            	<p class="text-left text-danger">{{ $errors->first('url_image') }}</p>
        					                            @endif
        				                            </div>
        				                        </div>

				                                <div class="col-sm-11"  style="margin-bottom: 15px;">
				                                	
				                                    <div class="form-group has-feedback row">
				        	                            <label class="col-sm-3 control-label text-bold" style="padding-top: 11px;">{!! trans('backend.new.status') !!}
				        	                            </label>
				        	                            <div class="col-sm-7">
				        	                                <div class="radio">
				        	                                    <input id="AVAILABLE" class="magic-radio" type="radio" name="status" value="{{ App\Libs\Configs\StatusConfig::CONST_AVAILABLE }}" 
				        	                                    @if (statusAvailable(old('status')) || statusAvailable(@$new->status) )
																	checked
				        	                                    @endif
				        	                                    checked 
				        	                                    >
				        	                                    <label for="AVAILABLE">{!! trans('backend.new.available') !!}</label>
				        	
				        	                                    <input id="DISABLE" class="magic-radio" type="radio" name="status" value="{{ App\Libs\Configs\StatusConfig::CONST_DISABLE }}"
			            	                                    @if (statusDisable(old('status')) || statusDisable(@$new->status) )
			    													checked
			            	                                    @endif>
				        	                                    <label for="DISABLE"> {!! trans('backend.new.disable') !!}</label>
				        	                                </div>
				        	                        	</div>
				                                	</div>
				                            	</div>
			    		                    </div>
					                		
						                </div>
	                		        </div>
	                		    </div>
	                		    <button type="submit" class="btn btn-primary btn-block btn-form-submit"><i class="ti-save"></i></button>
	                		</form>
                		</div>
                	</div>
                </div>
	        </div>
        </div>
	</div>
</div>
@endsection

@section ('myJs')
	<script>
		$(document).ready(function() {
		    $('.selected-2').select2();
		});
	</script>
@endsection

@section ('myCss')
	
@endsection

