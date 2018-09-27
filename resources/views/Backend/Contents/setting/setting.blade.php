@extends('Backend.Layouts.default')
@section ('title', '')
@section('content')
	<div id="content-container" ng-controller="settingCtrl">
		<div id="page-content">
		    <div class="panel" style="background-color: #ecf0f5">
		        <div class="panel-body">
					<div class="tab-base tab-stacked-left tab-setting">
			            <ul class="nav nav-tabs">
			                <li class="active">
			                    <a data-toggle="tab" href="#tab-1">{!! trans('backend.setting.contact') !!}</a>
			                </li>
			                <li>
			                    <a data-toggle="tab" href="#tab-2">{!! trans('backend.setting.google_analytic') !!}</a>
			                </li>
			                <li>
			                    <a data-toggle="tab" href="#tab-3">{!! trans('backend.setting.seo_default') !!}</a>
			                </li>
			            </ul>
			            <div class="tab-content">
			                <div id="tab-1" class="tab-pane fade active in">
			                    <div class="row">
	        		                <div class="col-sm-12">
	        		                    <form>
	        		                        <div class="panel-body">
	        		                        	<div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.description') !!}</label>
	 					                                <textarea rows="6" type="text" class="form-control" ng-model="data.contact.description"
	 					                                required></textarea> 
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.address') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.address"
	 					                                required>
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.phone') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.phone"
	 					                                required>
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.work_time') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.worktime"
	 					                                required>
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.fax') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.fax"
	 					                                required>
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.email') !!}</label>
	 					                                <input type="email" class="form-control" ng-model="data.contact.email"
	 					                                required>
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.facebook') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.fb"
	 					                                required>
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.google_plus') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.google_plus"
	 					                                required>
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.youtube') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.youtube"
	 					                                required>
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.instagram') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.instagram"
	 					                                required>
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.zalo') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.zalo"
	 					                                required>
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.coppyright') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.coppyright"
	 					                                required>
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.google_map') !!}</label>
	 					                                <textarea rows="6" type="text" class="form-control" ng-model="data.contact.google_map"
	 					                                required></textarea> 
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                        	 <button type="button" ng-click="actions.saveContact()" class="btn btn-primary btn-block">{!! trans('backend.actions.submit') !!}</button>
	 					                        </div>
		 					                </div>
	        		                    </form>
	        		                </div>
	        		            </div>
			                </div>

			                <div id="tab-2" class="tab-pane fade">
			                    <div class="row">
	        		                <div class="col-sm-12">
	        		                	<div class="col-sm-12">
				                            <div class="form-group">
				                                <label class="control-label">{!! trans('backend.setting.google_analytic') !!}</label>
				                                <textarea rows="6" type="text" class="form-control" ng-model="data.googleApi.google_analytic" placeholder="{!! trans('backend.setting.google_analytic') !!}" 
				                                required></textarea> 
				                            </div>
				                        </div>
				                        <div class="col-sm-12">
				                        	 <button type="button" ng-click="actions.saveGgAnalytic()" class="btn btn-primary btn-block">{!! trans('backend.actions.submit') !!}</button>
				                        </div>
	        		                </div>
	        		            </div>
	        		        </div>

	        		        <div id="tab-3" class="tab-pane fade">
			                    <div class="row">
	        		                <div class="col-sm-12">
	        		                	<div class="col-sm-12">
				                            <div class="form-group">
				                                <label class="control-label">{!! trans('backend.setting.title') !!}</label>
				                                <textarea rows="6" type="text" class="form-control" ng-model="data.meta.title" placeholder="{!! trans('backend.setting.meta.title') !!}" 
				                                required></textarea> 
				                            </div>
				                        </div>

            		                	<div class="col-sm-12">
    			                            <div class="form-group">
    			                                <label class="control-label">{!! trans('backend.setting.meta_title') !!}</label>
    			                                <textarea rows="6" type="text" class="form-control" ng-model="data.meta.meta_title" placeholder="{!! trans('backend.setting.meta.meta_title') !!}" 
    			                                required></textarea> 
    			                            </div>
    			                        </div>

    			                        <div class="col-sm-12">
    			                            <div class="form-group">
    			                                <label class="control-label">{!! trans('backend.setting.meta_description') !!}</label>
    			                                <textarea rows="6" type="text" class="form-control" ng-model="data.meta.meta_description" placeholder="{!! trans('backend.setting.meta.meta_description') !!}" 
    			                                required></textarea> 
    			                            </div>
    			                        </div>

    			                        <div class="col-sm-12">
    			                            <div class="form-group">
    			                                <label class="control-label">{!! trans('backend.setting.meta_keyword') !!}</label>
    			                                <textarea rows="6" type="text" class="form-control" ng-model="data.meta.meta_keyword" placeholder="{!! trans('backend.setting.meta.meta_keyword') !!}" 
    			                                required></textarea> 
    			                            </div>
    			                        </div>

				                        <div class="col-sm-12">
				                        	 <button type="button" ng-click="actions.saveMeta()" class="btn btn-primary btn-block">{!! trans('backend.actions.submit') !!}</button>
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
@endsection

@section ('myJs')
	<script src="{{ url('angularJs/uses/factory/services/settingService.js') }}"></script>
	<script src="{{ url('angularJs/uses/ctrls/settingCtrl.js') }}"></script>
	<script>
		$(document).ready(function(){ 

		});
	</script>
@endsection