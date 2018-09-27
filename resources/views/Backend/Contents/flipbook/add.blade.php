@extends('Backend.Layouts.default')
@section ('title', '')
@section('content')
	<div id="content-container">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{!! trans('backend.magazine.magazine') !!}</h1>
            </div>
            <ol class="breadcrumb">
			<li><a href="#"><i class="demo-pli-home"></i></a></li>
			<li><a href="#">
				{{ isset($magazine) ? trans('backend.actions.update') : trans('backend.actions.create') }}
				</a></li>
            </ol>
        </div>
		<div id="page-content">
	        <div class="panel">
	            <div class="panel">
		            <div class="panel-heading">
		            </div>
		            @if (!isset($magazine)) 
						<form action="{{ route('magazines.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
							@method ('POST')
		            @else
						<form action="{{ route('magazines.update', $magazine->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
							@method ('PUT')	
		            @endif
			            	@csrf
			                <div class="panel-body col-sm-offset-1">
			                    <div class="row">
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label text-bold">
			                                	{!! trans('backend.magazine.title') !!} <span class="text-danger"> (*)</span>
			                                </label>
			                                <input type="text" name="title" class="form-control" value="{{ @$magazine->title ? $magazine->title : @old('title') }}" required>
			                                @if ($errors->has('title'))
				                            	<p class="text-left text-danger">{{ $errors->first('title') }}</p>
				                            @endif
			                            </div>
			                        </div> 

			                    	<div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label text-bold">
			                                	{!! trans('backend.magazine.meta_title') !!}
			                                </label>
			                                <input type="text" name="meta_title" class="form-control" value="{{ @$magazine->meta_title ? $magazine->meta_title : @old('meta_title') }}" required>
			                                @if ($errors->has('meta_title'))
				                            	<p class="text-left text-danger">{{ $errors->first('meta_title') }}</p>
				                            @endif
			                            </div>
			                        </div> 

	    	                        <div class="col-sm-10">
	    	                            <div class="form-group">
	    	                                <label class="control-label text-bold">
	    	                                	{!! trans('backend.magazine.meta_content') !!} 
	    	                                </label>
	    	                                <textarea name="meta_content" id="meta-content">{!! @$magazine->meta_content ? $magazine->meta_content : @old('meta_content') !!}</textarea>
	    	                                @if ($errors->has('url_link'))
	    		                            	<p class="text-left text-danger">{{ $errors->first('url_link') }}</p>
	    		                            @endif
	    	                            </div>
	    	                        </div>

	    	                        <div class="col-sm-10">
	    	                            <div class="form-group">
	    	                                <label class="control-label text-bold">
	    	                                	{!! trans('backend.magazine.meta_description') !!} 
	    	                                </label>
	    	                                <textarea name="meta_description" id="meta-description">{!! @$magazine->meta_description ? $magazine->meta_description : @old('meta_description') !!}</textarea>
	    	                                @if ($errors->has('url_link'))
	    		                            	<p class="text-left text-danger">{{ $errors->first('url_link') }}</p>
	    		                            @endif
	    	                            </div>
	    	                        </div> 

	    	                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label text-bold">
			                                	{!! trans('backend.magazine.image') !!} <span class="text-danger"> (*)</span>
			                                </label>
			                                 <div class="input-group">
												<span class="input-group-btn">
													<a data-input="thumbnail" data-preview="holder" class="btn btn-primary my-lfm" type="'image'">
														<i class="fa fa-picture-o"></i> Choose
													</a>
												</span>
												<input id="thumbnail" class="form-control" type="text" name="url_image" value="{{ @$magazine->url_image ? $magazine->url_image: @old('url_image') }}">
											</div>
											<img id="holder" 
												@if (@$magazine->url_image || @old('url_image'))
    			                            	 	src="{{ url('') }}/{{ @$magazine->url_image ? $magazine->url_image : @old('url_image') }}" 
												@endif style="margin-top:15px;max-height:100px;">
			                                @if ($errors->has('url_image'))
				                            	<p class="text-left text-danger">{{ $errors->first('url_image') }}</p>
				                            @endif
			                            </div>
			                        </div>

			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label text-bold">
			                                	{!! trans('backend.magazine.magazine') !!} <span class="text-danger"> (*)</span>
			                                </label>
			                                 <div class="input-group">
												<span class="input-group-btn">
													<a data-input="magazine_url" data-preview="holder_magazine" class="btn btn-primary my-lfm" type="'file'">
														<i class="fa fa-picture-o"></i> Choose
													</a>
												</span>
												<input id="magazine_url" class="form-control" type="text" name="url_flipbook" value="{{ @old('url_flipbook') }}">
											</div>
			                            </div>
			                        </div>

			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">
			                                	{!! trans('backend.magazine.sort_by') !!} <span class="text-danger"> (*)</span>
			                                </label>

			                                <select class="selectpicker" data-width="100%" name="sort_by">
			                                    @foreach ($sort_bys as $sort_by) 
													<option value="{{ @$sort_by->sort_by }}"
														@if (@$magazine->sort_by == $sort_by->sort_by) 
															selected
														@endif
														> 
														{{ $sort_by->sort_by }}
													</option>
			                                    @endforeach
			                                    @if (!isset($magazine))
													<option selected value="{{ count($sort_bys) + 1  }}">
														{{ count($sort_bys) + 1 }}
													</option>
			                                    @endif
			                                </select>
			                                @if ($errors->has('sort_by'))
				                            	<p class="text-left text-danger">{{ $errors->first('sort_by') }}</p>
				                            @endif
			                            </div>
			                        </div>	

			                        <div class="col-sm-10" style="margin-bottom: 15px;">	
	                                    <div class="form-group row">
	        	                            <label class="col-sm-2 control-label text-bold text-bold" style="padding-top: 10px;">{!! trans('backend.status.status') !!}
	        	                            </label>
	        	                            <div class="col-sm-7">
	        	                                <div class="radio">
	        	                                    <input id="AVAILABLE" class="magic-radio" type="radio" name="status" value="{{ App\Libs\Configs\StatusConfig::CONST_AVAILABLE }}" 
	        	                                    @if (statusAvailable(old('status')) || statusAvailable(@$magazine->status) )
														checked
	        	                                    @endif
	        	                                    checked 
	        	                                    >
	        	                                    <label for="AVAILABLE">{!! trans('backend.status.available') !!}</label>
	        	
	        	                                    <input id="DISABLE" class="magic-radio" type="radio" name="status" value="{{ App\Libs\Configs\StatusConfig::CONST_DISABLE }}"
            	                                    @if (statusDisable(old('status')) || statusDisable(@$magazine->status) )
    													checked
            	                                    @endif>
	        	                                    <label for="DISABLE"> {!! trans('backend.status.disable') !!}</label>
	        	                                </div>
	        	                        	</div>
	                                	</div>
	                            	</div>
			                    </div>
                            	<div class="row">
                                	<button class="btn btn-primary btn-icon btn-form-submit">
            	                    	<i class="fa fa-save icon-lg"></i>
            	                    </button>
                                </div>
			                </div>
				   		</form>
		        </div>
	        </div>
		</div>
	</div>
@endsection

@section ('myJs')
	<script>
		toolbar = [
               [ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
               [ 'FontSize', 'TextColor', 'BGColor' ]
           ];
		CKEDITOR.replace('meta-description', {toolbar: toolbar});
		CKEDITOR.replace('meta-content', {toolbar: toolbar});
	</script>
@endsection

@section ('myCss')
	
@endsection

