@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
@php
	$languages = app('Language')->getLanguage();
	$list_location  = App\Libs\Configs\ArrayConfig::locationMenu();
@endphp
	<div id="content-container" ng-controller="menuCtrl">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{!! trans('backend.menu.menu') !!}</h1>
            </div>
            <ol class="breadcrumb">
				<li><a href="#"><i class="demo-pli-home"></i></a></li>
				<li><a href="#">{!! trans('backend.actions.list') !!}</a></li>
            </ol>
        </div>
		<div id="page-content">
	        <div class="panel">
	            <div class="panel-heading">
	            </div>
	            <div class="panel-body">
	            	<div class="pad-btm form-inline">
			            <div class="row">
			                <div class="col-sm-6 table-toolbar-left pull-left">
			                   <a data-target="#demo-default-modal" data-toggle="modal" id="demo-btn-addrow" class="btn btn-purple"><i class="demo-pli-add"></i> {!! trans('backend.actions.create') !!}</a>
			                </div>
			            </div>
			            <div class="row">
		            		<form class="form-horizontal">
			            		<div class="row">
				            		<div class="form-group col-md-6" style="margin-bottom: 10px;">
				                        <label class="col-sm-4" for="select-menu">{!! trans("backend.menu.select_menu") !!}: </label>
				                        <div class="col-sm-8">
		            			            <select class="selectpicker" id="select-menu" name="select-menu-edit" data-width="100%">
		            			            	<option value="-1">{!! trans("backend.menu.select_menu") !!}</option>
		                                        @foreach ($menus as $key => $menu_item)
													<option @if(request()->has('menu_id') && request()->get('menu_id') == @$menu_item->id) selected @endif

													value="{{ @$menu_item->id }}">{{ @$menu_item->name }}</option>
		                                        @endforeach
		                                    </select>
				                        </div>
				                    </div>

				                    <div class="form-group col-md-6">
				                        <label class="col-sm-4" for="select-menu">{!! trans("backend.menu.location") !!}: </label>
					                    <div class="col-sm-8">
				                        	<select data-width="100%" class="selectpicker" data-width="100%" name="menu_location">
		        			            		@foreach ($list_location as $key => $location) 
													<option 
													@if (@$menu->location == @$location['key'])
														selected
													@endif
													value="{{ @$location['key'] }}">{!! @$location['name'] !!}</option>
		        			            		@endforeach
		                                    </select>
				                        </div>
				                    </div>
			            		</div>
			                    <!-- <div class="row">
    			                    <div class="form-group col-md-6">
    			                        <label class="col-sm-4" for="select-menu">{!! trans("backend.menu.language") !!}: </label>
    				                    <div class="col-sm-8">
    			                        	<select data-width="100%" class="selectpicker" data-width="100%" name="menu-locale">
    	        			            		@foreach ($languages as $key => $language) 
    												<option 
    												@if (request()->has('locale') && request()->get('locale') == @$language->locale)
    													selected
    												@endif
    												value="{{ @$language->locale }}">{!! @$language->name_display !!}</option>
    	        			            		@endforeach
    	                                    </select>
    			                        </div>
    			                    </div>
			                    </div> -->
		            		</form>
			            </div>
			        </div>
	            </div>
	        </div>
	        <div class="row">
		    	<div class="col-sm-4">
		    		<div class="panel-group accordion" id="pick-menu">
			            <div class="panel panel-purple">
			                <div class="panel-heading">
			                    <h4 class="panel-title">
			                        <a data-parent="#pick-menu" data-toggle="collapse" href="#demo-acd-purple-1">
			                        	{!! trans("backend.category.category") !!}
			                        </a>
			                    </h4>
			                </div>
			                <div class="panel-collapse collapse" id="demo-acd-purple-1">
			                    <div class="panel-body">
                                	<form>
                	                    <div class="form-group">
                	                        <label class="control-label" for="demo-hor-inputemail">{!! trans("backend.menu.category") !!}</label>
                	                        <div id="about" class="nano" style="height: 150px;">
                	                            <div class="nano-content"> 
                	                            	{{ showCategoriesMenu($categories, 0) }}
                	                        	</div>
                	                        </div>
            	                            <p class="text-danger" ng-repeat="(key, value) in data.errors.name">@{{ value }}</p>
                	                    </div>
                	                    <div class="pull-right">
                	                    	<button id="add-category" class="btn btn-default">{!! trans("backend.menu.select_category") !!}</button>
                	                    </div>
                		            </form>
			                    </div>
			                </div>
			            </div>
			            <div class="panel panel-purple">
			
			                <!-- Accordion title -->
			                <!-- <div class="panel-heading">
			                    <h4 class="panel-title">
			                        <a data-parent="#pick-menu" data-toggle="collapse" href="#demo-acd-purple-2">
			                        {!! trans("backend.new.new") !!}</a>
			                    </h4>
			                </div> -->
			
			                <!-- Accordion content -->
			                <!-- <div class="panel-collapse collapse" id="demo-acd-purple-2">
			                    <div class="panel-body">
			                        
			                    </div>
			                </div> -->
			            </div>
			            <div class="panel panel-purple">
			                <div class="panel-heading">
			                    <h4 class="panel-title">
			                        <a data-parent="#pick-menu" data-toggle="collapse" href="#demo-acd-purple-3">
			                        {{ trans("backend.menu.link") }}</a>
			                    </h4>
			                </div>
			                <div class="panel-collapse collapse" id="demo-acd-purple-3">
			                    <div class="panel-body">
			                        <div class="form-group">
            	                        <label class="control-label" for="link_url">{!! trans("backend.menu.url") !!}</label>
        	                            <input name="link_url" type="text" placeholder="{!! trans('backend.menu.url') !!}" class="form-control" autocomplete="off">
        	                            <p class="text-danger" ng-repeat="(key, value) in data.errors.name">@{{ value }}</p>
            	                    </div>
            	                    <div class="form-group">
            	                        <label class="control-label" for="url_name">{!! trans("backend.menu.url_name") !!}</label>
        	                            <input name="url_name" id="url_name" type="text" placeholder="{!! trans('backend.menu.url') !!}"class="form-control" autocomplete="off">
            	                    </div>
            	                    <div class="pull-right">
            	                    	<button id="add-link" class="btn btn-default">{!! trans("backend.menu.add_link") !!}</button>
            	                    </div>
			                    </div>
			                </div>
			            </div>
			        </div>
		    	</div>
		    	<div class="col-sm-8">
    		        <div class="panel">
						@if (isset($menu))
    		            <div class="panel-heading panel-heading-bg">
							<div class="col-sm-9 col-xs-12">
								<input name="edit_name" type="text" placeholder="{!! trans('backend.menu.name') !!}" id="demo-hor-inputemail" class="form-control input-margin" autocomplete="off" value="{{ @$menu->name }}">
								<p style="margin-left: 10px;" class="text-danger" ng-repeat="(key, value) in data.errors.name">@{{ value }}</p>
							</div>
							<div class="col-sm-3 col-xs-12 pull-right">
								<button ng-click="actions.saveUpdate({{ @$menu->id }})" class="btn btn-sm btn-info input-margin"> <i class="fa-lg ti-pencil"></i> {!! trans("backend.actions.save") !!}</button>
								<button ng-click="actions.delete({{ @$menu->id }})" class="btn btn-sm btn-danger input-margin"><i class="fa-lg ti-trash"></i> {!! trans("backend.actions.delete") !!}</button>
							</div>
    		            </div>
    		            <div class="panel-body" >
    		            	<div class="row">
    		            	    <div class="col-md-9" style="margin-top: 30px;">
    		            	        <div id="nestable" class="dd">
		            	            	@php
											$listDetails = @$menu->data_menu ? json_decode($menu->data_menu) : array(); 
		            	            	@endphp
										@php
											showItemMenu($listDetails);
										@endphp
    		            	        </div>
    		            	    </div>
    		            	</div>
    		            </div>
    		            <div class="panel-footer text-right">
    		            	<button class="btn btn-sm btn-info input-margin btn-save-menu"> 
		            			<i class="fa-lg ti-pencil "></i> {!! trans("backend.actions.save") !!}
		            		</button>
    		            </div>
						@endif
    		        </div>
		    	</div>
		    </div>


		    <div class="modal fade" id="demo-default-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
		                    <h4 class="modal-title">{!! trans("backend.actions.create") !!}</h4>
		                </div>
		                <div class="modal-body">
		                	<form class="form-horizontal">
			                    <div class="form-group">
			                        <label class="col-sm-3 control-label" for="demo-hor-inputemail">{!! trans("backend.menu.name") !!}</label>
			                        <div class="col-sm-9">
			                            <input type="text" placeholder="{!! trans('backend.menu.name') !!}" id="demo-hor-inputemail" class="form-control" ng-model="data.name">
			                            <p class="text-danger" ng-repeat="(key, value) in data.errors.name">@{{ value }}</p>
			                        </div>
			                    </div>
				            </form>
		                </div>
		                <div class="modal-footer">
		                    <button data-dismiss="modal" class="btn btn-default" type="button">{!! trans('backend.actions.close') !!}</button>
		                    <button class="btn btn-primary" ng-click="actions.saveInsert()" >{!! trans('backend.actions.save') !!}</button>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
@endsection

@section ('myJs') 
	<script src="{{ url('Nifty') }}/plugins/nestable-list/jquery.nestable.js"></script>
	<script src="{{ url('angularJs/uses/factory/services/menuService.js') }}"></script>
	<script src="{{ url('angularJs/uses/ctrls/menuCtrl.js') }}"></script>
	
	<script>
		var data_menu_id  = '{{ request()->get("menu_id") }}';
		var type_category = 'Category';
		var type_post     = 'Post';
		var type_url      = 'Url';

		$(document).ready(function () {
			$(".nano").nanoScroller();
			//selected change menu item
			$('select[name*="select-menu-edit"]').on('changed.bs.select', function (e, clickedIndex, newValue, oldValue) {
			    var selected = $(e.currentTarget).val();
			    if (selected == '-1') {
			    	window.location = SiteUrl + '/admin/menu';
			    } else {
			    	window.location = SiteUrl + '/admin/menu?actions=edit&menu_id=' + selected + '&locale={{ app()->getLocale() }}';
			    }
			    
			});

			@if (request()->has("menu_id") && request()->has("actions") == 'edit')
				$('select[name*="menu-locale"]').on('changed.bs.select', function (e, clickedIndex, newValue, oldValue) {
				    var selected = $(e.currentTarget).val();
				    window.location = SiteUrl + '/admin/menu?actions=edit&menu_id=' + '{{ request()->get("menu_id") }}' + '&locale=' + selected;	
				});
			@endif

		})
	</script>
	<script src="{{ url('Backend/js/menu.js') }}"></script>
	@if (Session::has('menus') && Session::get('menus') == 'success')
	<script>
		$.toast({
		    heading: '{!! trans("confirm.success") !!}',
		    heading: '{!! trans("menu.success_message") !!}',
		    showHideTransition: 'fade',
		    position: 'top-right',
		    icon: 'success'
		})
	</script>
	@endif
@endsection
@section ('myCss')
	<link href="{{ url('Nifty') }}/plugins/nestable-list/nestable-list.min.css" rel="stylesheet">
@endsection

