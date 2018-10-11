ngApp.controller('widgetCtrl',function($scope, $widgetService, $apply, $categoryService) {

	$scope.config = {
		post: "POST",
		category: "CATEGORY", 
		banner: "BANNER",
		tag: "TAG",
		video: "VIDEO",
		locationCenter: 'CENTER',
		locationSidebarLeft: 'SIDEBAR_LEFT',
		locationSidebarRight: 'SIDEBAR_RIGHT',
		locationFooter: 'FOOTER',
	}

	$scope.data = {
		widgetItem: {},
		listWidgets: {},
		listCategories: {},
		page: {},
		widgetCenters: [],
		widgetFooters: [],
		widgetRights: [],
		widgetLefts: [],
		sortableOptionsCenter: {
		    placeholder: "app list-group",
		    connectWith: ".apps-container",
		    delay: 150,
		    start: function() {
		      	$scope.$apply(function(){
		      		$scope.isDragging = true;
		      	});
		    },
		    stop: function() {
		    	$scope.actions.sortBy($scope.config.locationCenter);
		      	$scope.isDragging = false;
		    }
		},
		sortableOptionsFooter: {
			placeholder: "app list-group",
			connectWith: ".apps-container",
			delay: 150,
			start: function() {
			  	$scope.$apply(function(){
			  		$scope.isDragging = true;
			  	});
			},
			stop: function() {
				$scope.actions.sortBy($scope.config.locationFooter);
			  	$scope.isDragging = false;
			}
		}

	},



	$scope.actions = {
		getWidgetItem: function () {
			$widgetService.action.getWidget().then(function (resp) {
				$scope.data.widgetItems = resp.data;
			}, function (error) {
				console.log(error)
			});
		},

		getAllCategory: function () {
			$categoryService.action.getCategory().then(function (resp) {
				$apply (function () {
					$scope.data.listCategories= resp.data;
				});
				
			}, function (error) {

			});
		},

		getListWidget: function () {
			$widgetService.action.getListWidget().then(function (resp) {
				$scope.data.listWidgets = resp.data;
				angular.forEach(resp.data, function(value, key) {
					if (value.location === $scope.config.locationCenter) {
						$scope.data.widgetCenters.push(value);
					}

					else if (value.location === $scope.config.locationFooter) {
						$scope.data.widgetFooters.push(value);
					}

					else if (value.location === $scope.config.locationSidebarRight) {
						$scope.data.widgetRights.push(value);
					}

					else if (value.location === $scope.config.locationSidebarLeft) {
						$scope.data.widgetLefts.push(value);
					}
				});

				$apply(function () {
					$scope.data.widgetCenters.sort(function (a, b) {
					  	return a.sort_by - b.sort_by;
					});

					$scope.data.widgetFooters.sort(function (a, b) {
					  	return a.sort_by - b.sort_by;
					});

					$scope.data.widgetRights.sort(function (a, b) {
					  	return a.sort_by - b.sort_by;
					});

					$scope.data.widgetLefts.sort(function (a, b) {
					  	return a.sort_by - b.sort_by;
					});
				})

			}, function (error) {
				console.log(error)
			});
		},

		dropCompleteWidgetCenters: function (value, event) {
			
			let params = {
				key: value,
				data: {
					name: "New " + value,
				},
				location: $scope.config.locationCenter,
			};

			$widgetService.action.addWidget(params).then(function (resp) {
				if (resp.data.status) {
					$scope.data.widgetCenters.push(resp.data.widget);
				}
			}, function () {

			})
		},

		dropCompleteWidgetFooters: function (value, event) {
			let params = {
				key: value,
				data: {
					name: "New " + value,
				},
				location: $scope.config.locationFooter,
			};

			$widgetService.action.addWidget(params).then(function (resp) {
				if (resp.data.status) {
					$scope.data.widgetFooters.push(resp.data.widget);
				}
			}, function () {

			})
		},

		sortBy: function (location) {
			var params = {
				data: {}
			}	

			switch (location){
				case $scope.config.locationCenter:
					params.data = $scope.data.widgetCenters;
					break;

				case $scope.config.locationFooter:
					params.data = $scope.data.widgetFooters;
					break;

				case $scope.config.locationSidebarLeft:
					params.data = $scope.data.widgetCenters;
					break;
				case $scope.config.locationSidebarRight:
					params.data = $scope.data.widgetCenters;
					break;
				default:
				    params.data = {};
			}

			$widgetService.action.sortWidget(params).then(function (resp) {
				if (resp.data.status) {

				}
			}, function () {

			})
		}

	} 
		
	$scope.actions.getWidgetItem();
	$scope.actions.getListWidget();
	$scope.actions.getAllCategory();


});