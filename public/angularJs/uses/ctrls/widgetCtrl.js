ngApp.controller('widgetCtrl',function($scope, $widgetService) {

	$scope.data = {
		widgetItem: {},
		page: {},
		widgetCenters: [{key: 'POST', data: { name: 'Bai viet', id: 1} }, 
						{key: 'CATEGORY', data: { name: 'Loai tin', id: 2} }],
		sortableOptions: {
		    placeholder: "app list-group",
		    connectWith: ".apps-container",
		    start: function(){
		      	$scope.$apply(function(){$scope.isDragging = true;});
		    },
		    stop: function() {

		      	$scope.isDragging = false;
		    }
		},

	},



	$scope.actions = {
		getWidgetItem: function () {
			$widgetService.action.getWidget().then(function (resp) {
				$scope.data.widgetItems = resp.data;
			}, function (error) {
				console.log(error)
			});
		},

		dropCompleteWidgetCenters: function (value, event) {
			let params = {
				key: value,
				data: {
					name: "New " + value,
				}
			};
			$scope.data.widgetCenters.push(params);
		},

	} 
		
	$scope.actions.getWidgetItem();


});