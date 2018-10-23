@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container" ng-controller="categoryCtrl">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{!! trans('backend.category.category') !!}</h1>
            </div>
            <ol class="breadcrumb">
				<li><a href="#"><i class="demo-pli-home"></i></a></li>
				<li><a href="#">{!! trans('backend.category.list') !!}</a></li>
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
			                   <a href="{{ route('categories.create') }}" id="demo-btn-addrow" class="btn btn-purple"><i class="demo-pli-add"></i> {!! trans('backend.category.create') !!}</a>
			                </div>
			                <div class="col-sm-6 table-toolbar-right">
			                    <div class="form-group col-sm-12">
			                        <input id="demo-input-search2" type="text" placeholder="{{ trans('backend.actions.search')  }}" class="form-control col-sm-
			                        8" autocomplete="off" ng-change="actions.filter()" ng-model="filter.freetext">
			                    </div>
			                </div>
			            </div>
			        </div>
	                <div class="table-responsive">
	                    <table id="category-table" class="table table-bordered table-hover table-vcenter">
	                        <thead>
	                            <tr>
	                            	<th class="text-center">
                        		        <input type="checkbox" ng-model="checker.btnCheckAll" 
                        		        ng-click="actions.checkAll(data.categories)">
	                            	</th>
	                                <th class="text-center">#</th>
	                                <th class="sorting" 
	                                ng-class="scope.filter.orderBy =='name' && filter.reverse ? 'sorting-desc' : 'sorting-asc' " 
	                                ng-click="actions.orderBy('name')">{!! trans('backend.category.name') !!}</th>
	                                <th class="sorting" 
	                                ng-class="scope.filter.orderBy =='status' && filter.reverse ? 'sorting-desc' : 'sorting-asc' " 
	                                ng-click="actions.orderBy('status')">{!! trans('backend.category.status') !!}</th>
	                                <th>{!! trans('backend.category.action') !!}</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <tr ng-repeat="(key, category) in data.categories">
	                            	<td style="width: 50px" class="text-center"> 
                        		        <input type="checkbox" ng-click="actions.checkOrUncheck(checker.checkedAll[category.id])" ng-model="checker.checkedAll[category.id]">
	                            	</td>
	                                <td style="width: 50px"  class="text-center"> @{{ (data.page.current_page - 1) * data.page.per_page + key + 1 }} </td>
	                                <td> @{{ actions.findParent(data.categories, category.depth) }} </td>
	                                <td>
	                                	<span class="label label-danger" ng-if="(category.status == '{{ App\Libs\Configs\StatusConfig::CONST_DISABLE }}')">
	                                	{!! trans('backend.category.disable') !!}</span>

	                                	<span class="label label-success" ng-if="(category.status == '{{ App\Libs\Configs\StatusConfig::CONST_AVAILABLE }}')">
	                                	{!! trans('backend.category.available') !!}</span>
	                                </td>
	                                <td style="width: 100px">
	                                	<a href="{{ url('admin/categories') }}/@{{ category.id }}/edit" class="btn btn-info btn-icon btn-sm" title="{{ trans('backend.actions.edit') }}">
	                                		<i class="ti-pencil-alt"></i> 
	                                	</a>

	                                	<button class="btn btn-danger btn-sm btn-icon add-tooltip" data-toggle="tooltip" data-container="body" data-placement="bottom" title="{{ trans('backend.actions.delete') }}" ng-click="actions.delete(category.id)">
	                                		<i class="ti-trash"></i> 
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
	<script src="{{ url('angularJs/uses/factory/services/categoryService.js') }}"></script>
	<script src="{{ url('angularJs/uses/ctrls/categoryCtrl.js') }}"></script>
	@if (Session::has('category') && Session::get('category') == 'success')
	<script>
		$.toast({
		    heading: '{!! trans("confirm.success") !!}',
		    text: '{!! trans("backend.category.success_message") !!}',
		    showHideTransition: 'fade',
		    position: 'top-right',
		    icon: 'success'
		})
	</script>
	@endif
@endsection
@section ('myCss')
@endsection

