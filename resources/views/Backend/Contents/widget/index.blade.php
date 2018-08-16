@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
@php
	$languages = app('Language')->getLanguage();
	$list_location  = App\Libs\Configs\ArrayConfig::locationMenu();
@endphp
	<div id="content-container">
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
	        <div class="panel">
	            <div class="panel-heading">
	            </div>
	            <div class="panel-body">
	            	<div class="col-md-4">
	            		<ul>
	            		    <li id="draggable" data-type="category" class="ui-state-highlight">Drag me down</li>
	            		</ul>
	            	</div>
	            	<div class="col-md-8">
	            		<ul id="sortable">
	            		    <li data-id="1" data-type="category" class="ui-state-default">Item 1</li>
	            		    <li data-id="2" data-type="post" class="ui-state-default">Item 2</li>
	            		    <li data-id="3" data-type="post" class="ui-state-default">Item 3</li>
	            		    <li data-id="4" data-type="cemrima" class="ui-state-default">Item 4</li>
	            		    <li data-id="5" data-type="cemrima" class="ui-state-default">Item 5</li>
	            		</ul>
	            	</div>
	            </div>
	        </div>
		</div>
	</div>
@endsection

@section ('myJs') 
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
		var arrWidget = [];
		var idMax = 0;

		$("#sortable").find('li').map(function (value, key) {
			if (idMax < $(this).attr('data-id')) {
				idMax = $(this).attr('data-id');
			}
  			arrWidget.push({
  				dataId: $(this).attr('data-id'),
  				attribute: $(this).attr('data-type')
  			})
  		});

		$( function() {
			$("#sortable").sortable({
			  	revert: true,
			  	receive: function(event, ui) {
			  		var html = [];
  		            $(this).find('div').each(function() {
  		                html.push('<li class="ui-state-default">' + $(this).attr('category') + '</li>');
  		            });
  		            $(this).find('div').replaceWith(html.join(''));
	  	        },
			  	update: function () {
			  		arrWidget = [];
			  		updateData($(this));
			  		console.log(arrWidget);
			  	},

			});

			$( "#draggable" ).draggable({
			  	connectToSortable: "#sortable",
			  	helper: "clone",
			  	revert: "invalid",
			});
			$( "ul, li" ).disableSelection();

			function updateData ($sortable) {
				$($sortable).find('li').map(function (value, key) {
					arrWidget.push({
						dataId: $(this).attr('data-id'),
						attribute: $(this).attr('data-type')
					})
				}); 
			}
		} );
	</script>
	@endsection
@section ('myCss')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<style type="text/css" media="screen">
		
	</style>
@endsection

