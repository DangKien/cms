@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container" ng-controller="newCtrl">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{!! trans('backend.new.new') !!}</h1>
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
			                <div class="col-sm-6 table-toolbar-left">
			                   <a href="{{ route('news.create') }}" id="demo-btn-addrow" class="btn btn-purple"><i class="demo-pli-add"></i> {!! trans('backend.actions.create') !!}</a>
			                </div>
			                <div class="col-sm-6 table-toolbar-right">
			                    <div class="form-group col-sm-12">
			                        <input id="demo-input-search2" type="text" placeholder="{{ trans('backend.actions.search')  }}" class="form-control col-sm-
			                        8" autocomplete="off" ng-change="actions.filter()" ng-model="filter.freetext">
			                    </div>
			                </div>
			            </div>
            	        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                               <a ng-click="actions.actionCheckAll()" id="demo-btn-addrow" class="btn btn-danger"><i class="ti-minus"></i> {!! trans('backend.actions.delete') !!}</a>
                            </div>
                        </div>
			        </div>
	                <div class="table-responsive">
	                    <table id="new-table" class="table table-bordered table-hover table-vcenter">
	                        <thead>
	                            <tr>
	                            	<th class="text-center">
                        		        <input type="checkbox" ng-model="checker.btnCheckAll" 
                        		        ng-click="actions.checkAll(data.news)">
	                            	</th>
	                                <th class="text-center">#</th>
	                                <th 
	                                ng-class="(filter.orderName =='title' && filter.order) ? 'sorting_desc' : (filter.orderName =='title' && !filter.order) ? 'sorting_asc' : 'sorting'" 
	                                ng-click="actions.orderBy('title')">{!! trans('backend.new.title') !!}</th>
	                                <th class="sorting" 
	                                ng-class="(filter.orderName =='vote' && filter.order) ? 'sorting_desc' : (filter.orderName =='vote' && !filter.order) ? 'sorting_asc' : 'sorting'"
	                                ng-click="actions.orderBy('vote')">{!! trans('backend.new.vote') !!}</th>
	                                <th class="sorting" 
	                                ng-class="(filter.orderName =='view' && filter.order) ? 'sorting_desc' : (filter.orderName =='view' && !filter.order) ? 'sorting_asc' : 'sorting'"
	                                ng-click="actions.orderBy('view')">{!! trans('backend.new.view') !!}</th>
	                                <th class="sorting" 
	                                ng-class="(filter.orderName =='status' && filter.order) ? 'sorting_desc' : (filter.orderName =='status' && !filter.order) ? 'sorting_asc' : 'sorting'"
	                                ng-click="actions.orderBy('status')">{!! trans('backend.status.status') !!}</th>
	                                <th>{!! trans('backend.actions.action') !!}</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <tr ng-repeat="(key, new) in data.news">
	                            	<td style="width: 50px" class="text-center"> 
                        		        <input type="checkbox" ng-click="actions.checkOrUncheck(checker.checkedAll[new.id])" ng-model="checker.checkedAll[new.id]">
	                            	</td>
	                                <td style="width: 50px"  class="text-center"> @{{ (data.page.current_page - 1) * data.page.per_page + key + 1 }} </td>
	                                <td > @{{ new.title }} </td>
	                                <td class="text-center" style="width: 70px"> @{{ new.vote }} </td>
	                                <td class="text-center" style="width: 70px"> @{{ new.view }} </td>
	                                <td style="width: 100px;">
	                                	<span class="label label-danger" ng-if="(new.status == '{{ App\Libs\Configs\StatusConfig::CONST_DISABLE }}')">
	                                	{!! trans('backend.status.disable') !!}</span>

	                                	<span class="label label-success" ng-if="(new.status == '{{ App\Libs\Configs\StatusConfig::CONST_AVAILABLE }}')">
	                                	{!! trans('backend.status.available') !!}</span>
	                                </td>
	                                <td style="width: 180px">
	                                	<button class="btn btn-sm btn-icon" ng-class="(new.hot == 1 ? 'btn-danger' : 'btn-default')" ng-click="actions.hotNews(new.id)">
	                                		<i class="fa fa-fire" title="{{ trans('backend.actions.hot') }}"></i> 
	                                	</button>
	                                	<button class="btn btn-sm btn-icon" ng-class="(new.prioritize == 1 ? 'btn-success' : 'btn-default')" ng-click="actions.prioritizeNew(new.id)">
	                                		<i class="ti-pin-alt" title="{{ trans('backend.actions.hot') }}"></i> 
	                                	</button>
	                                	<a href="{{ url('admin/news') }}/@{{ new.id }}/edit" class="btn btn-info btn-icon btn-sm" >
	                                		<i class="ti-pencil-alt" title="{{ trans('backend.actions.edit') }}"></i> 
	                                	</a>
	                                	<button class="btn btn-danger btn-sm btn-icon" ng-click="actions.delete(new.id)">
	                                		<i class="ti-trash" title="{{ trans('backend.actions.delete') }}"></i> 
	                                	</button>
	                                </td>
	                            </tr>
	                        </tbody>
	                    </table>
	                    <div class="text-center"> 
		                    <div paging
		                      page="data.page.current_page"  
    						  show-first-last="true"
		                      page-size="data.page.per_page" 
		                      total="data.page.total"
		                      paging-action="actions.changePage(page)">
		                    </div> 
	                    </div>
	                </div>
	            </div>
	        </div>
		</div>
	</div>
@endsection

@section ('myJs')
	<script src="{{ url('angularJs/uses/factory/services/newService.js') }}"></script>
	<script src="{{ url('angularJs/uses/ctrls/newCtrl.js') }}"></script>

	@if (Session::has('new') && Session::get('new') == 'success')
	<script>
		$.toast({
		    heading: '{!! trans("confirm.success") !!}',
		    text: '{!! trans("backend.new.success_message") !!}',
		    showHideTransition: 'fade',
		    position: 'top-right',
		    icon: 'success'
		})
	</script>
	@endif
@endsection
@section ('myCss')
<style type="text/css" media="screen">


</style>
@endsection

