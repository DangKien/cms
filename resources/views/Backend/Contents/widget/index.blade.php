@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
@php
	$languages = app('Language')->getLanguage();
	$list_location  = App\Libs\Configs\ArrayConfig::locationMenu();
@endphp
	<div id="content-container" ng-controller="widgetCtrl">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{!! trans('backend.widget.widget') !!}</h1>
            </div>
            <ol class="breadcrumb">
				<li><a href="#"><i class="demo-pli-home"></i></a></li>
				<li><a href="#">{!! trans('backend.actions.list') !!}</a></li>
            </ol>
        </div>
		<div id="page-content">
			<div class="col-sm-4">
		        <div class="panel">
		            <div class="panel-heading">
		            	<h3 class="panel-title">{{ trans('backend.widget.available_widgets') }}</h3>
		            </div>
		            <div class="panel-body">
	        			<div class="list-group widget" ng-repeat="(key, item) in data.widgetItems">
                            @{{ item.name }}
		                    <div class="list-group-item widget-item" ng-drag="true" ng-drag-success="actions.onDragComplete($data, $event)" ng-drag-handle="actions.handle" ng-drag-data="item.key" data-allow-transform="true">@{{ item.name }}</div>
		                </div>
		            </div>
			    </div>
	        </div>
            <div class="list-group widget-clone" ng-drag-clone="" >
                <span>@{{ clonedData.name }}</span>
                <a class="widget-icon" href=""><i class="fa fa-lg fa-sort-down"></i></a>
            </div>
	        <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel" ng-drop="true" class="wap-widget" ng-drop-success="actions.dropCompleteWidgetCenters($data, $event)" ng-drag-stop="actions.startWidget($data, $event)"  ng-drag-end="actions.dropCompleteWidgetCenters($data, $event)">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ trans('backend.widget.center') }}</h3>
                            </div>
                            <div class="panel-body">
                                <div >
                                    <div ui-sortable="data.sortableOptionsCenter" ng-model="data.widgetCenters">
                                        <div ng-repeat="(key, itemWidget) in data.widgetCenters">

                                            <div class="list-group" ng-if="itemWidget.key === config.post">
                                                <post-widget widget-center-data="itemWidget"> </post-widget>
                                            </div>

                                            <div class="list-group" ng-if="itemWidget.key === config.category">
                                                <category-widget widget-center-data="itemWidget" list-categories="data.listCategories"> </category-widget>
                                            </div>

                                            <div class="list-group" ng-if="itemWidget.key === config.banner">
                                                <banner-widget widget-center-data="itemWidget"> </banner-widget>
                                            </div>

                                            <div class="list-group" ng-if="itemWidget.key === config.tag">
                                                <tag-widget widget-center-data="itemWidget"> </tag-widget>
                                            </div>

                                            <div class="list-group" ng-if="itemWidget.key === config.video">
                                                <video-widget widget-center-data="itemWidget"> </video-widget>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel" ng-drop="true" class="wap-widget" ng-drop-success="actions.dropCompleteWidgetFooters($data, $event)" ng-drag-stop="actions.startWidget($data, $event)"  ng-drag-end="actions.dropCompleteWidgetFooters($data, $event)">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ trans('backend.widget.footer') }}</h3>
                            </div>
                            <div class="panel-body">
                                <div >
                                    <div ui-sortable="data.sortableOptionsFooter" ng-model="data.widgetFooters">
                                        <div ng-repeat="(key, itemWidget) in data.widgetFooters">

                                            <div class="list-group" ng-if="itemWidget.key === config.post">
                                                <post-widget widget-center-data="itemWidget"> </post-widget>
                                            </div>

                                            <div class="list-group" ng-if="itemWidget.key === config.category">
                                                <category-widget widget-center-data="itemWidget" list-categories="data.listCategories"> </category-widget>
                                            </div>

                                            <div class="list-group" ng-if="itemWidget.key === config.banner">
                                                <banner-widget widget-center-data="itemWidget"> </banner-widget>
                                            </div>

                                            <div class="list-group" ng-if="itemWidget.key === config.tag">
                                                <tag-widget widget-center-data="itemWidget"> </tag-widget>
                                            </div>

                                            <div class="list-group" ng-if="itemWidget.key === config.video">
                                                <video-widget widget-center-data="itemWidget"> </video-widget>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
		        
		        <div class="row">
                    <div class="col-sm-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ trans('backend.widget.sidebar_left') }}</h3>
                            </div>
                            <div class="panel-body">
                                <div ng-drop="true" class="wap-widget">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ trans('backend.widget.sidebar_right') }}</h3>
                            </div>
                            <div class="panel-body">
                                <div ng-drop="true" class="wap-widget">
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
	<script src="{{ url('angularJs/uses/ctrls/widgetCtrl.js') }}"></script>
	<script src="{{ url('angularJs/uses/factory/services/widgetSerivce.js') }}"></script>
    <script src="{{ url('angularJs/uses/directives/modals/widget.js') }}"></script>

    <script src="{{ url('angularJs/uses/factory/services/categoryService.js') }}"></script>
@endsection

@section ('myCss')
    <style type="text/css">
        .app {
            background-color: rgba(245, 245, 245, 0.86);
            position: relative;
            min-height: 40px;
            text-align: left;
            font-weight: 600;
            padding: 11px 16px;
            width: 303px;
            border: 2px dashed #444;
            border-radius: 5px;
            font-size: 1.1em;
            font-weight: bold;
            text-align: center;
            cursor: move;
        }

        .widget-border {
            border: 1px solid #e5e5e5;
            border-top: none;
            box-shadow: 0 1px 1px rgba(0,0,0,.04);
            width: 100%;
        }
    </style>
@endsection

