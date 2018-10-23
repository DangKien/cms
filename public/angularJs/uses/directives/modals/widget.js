ngApp.directive('postWidget', function ($widgetService) {
	var url = SiteUrl + "/rest/admin/widget-modal/PostWidget" ;
	return {
		restrict: 'E',
		scope: {
			postData: '=widgetCenterData',
		},
		templateUrl: url,
		link: function (scope, element, attrs) {

			scope.infoWidget;

			scope.$watchCollection('postData', function(newVal, oldVal, scope) {
				scope.infoWidget      = angular.copy(newVal);
				scope.infoWidget.data = JSON.parse(newVal.data);
			});

			scope.actions = {
				updateWidget: function () {
					var params = {
						location: scope.infoWidget.location,
						data: {
							name: scope.infoWidget.data.name,
						}
					}
					console.log(scope.infoWidget.id)
					$widgetService.action.updateWidgetItem(scope.infoWidget.id, params).then(function () {

					}, function () {

					});
				}
			}
		}
	};
})

ngApp.directive('categoryWidget', function ($widgetService) {
	var url = SiteUrl + "/rest/admin/widget-modal/CategoryWidget" ;
	return {
		restrict: 'E',
		scope: {
			categoryData: '=widgetCenterData',
			listCategories: '=',
		},
		templateUrl: url,
		link: function (scope, element, attrs) {

			scope.infoWidget;

			scope.$watchCollection('categoryData', function(newVal, oldVal, scope) {
				scope.infoWidget      = angular.copy(newVal);
				scope.infoWidget.data = JSON.parse(newVal.data);

				scope.infoWidget.data.id = (scope.infoWidget.data.id) ? scope.infoWidget.data.id : '';

			});

			scope.$watchCollection('listCategories', function(newVal, oldVal, scope) {
				scope.listCategories  = newVal;
			});


			scope.actions = {

				updateWidget: function () {
					var params = {
						location: scope.infoWidget.location,
						data: {
							name: scope.infoWidget.data.name || "",
							id: scope.infoWidget.data.id || 0,
							cate_widget: scope.infoWidget.data.cate_widget || 0
						}
					}
					$widgetService.action.updateWidgetItem(scope.infoWidget.id, params).then(function (resp) {

					}, function (error) {

					});
				}
			}
		}
	};
})

ngApp.directive('bannerWidget', function ($widgetService) {
	var url = SiteUrl + "/rest/admin/widget-modal/BannerWidget" ;
	return {
		restrict: 'E',
		scope: {
			scope: {
				postData: '=widgetCenterData',
			},
		},
		templateUrl: url,
		link: function (scope, element, attrs) {

			// scope.infoWidget;

			// scope.$watchCollection('postData', function(newVal, oldVal, scope) {
			// 	scope.infoWidget      = angular.copy(newVal);
			// 	scope.infoWidget.data = JSON.parse(newVal.data);
			// 	console.log(scope.infoWidget )
			// });

		}
	};
})


ngApp.directive('tagWidget', function ($widgetService) {
	var url = SiteUrl + "/rest/admin/widget-modal/TagWidget" ;
	return {
		restrict: 'E',
		scope: {
			tagData: '=widgetCenterData',
		},
		templateUrl: url,
		link: function (scope, element, attrs) {

			scope.infoWidget;

			scope.$watchCollection('tagData', function(newVal, oldVal, scope) {
				scope.infoWidget      = angular.copy(newVal);
				scope.infoWidget.data = JSON.parse(newVal.data);
			});

			scope.actions = {
				updateWidget: function () {
					var params = {
						location: scope.infoWidget.location,
						data: {
							name: scope.infoWidget.data.name,
							tag_number: scope.infoWidget.data.tag_number
						}
					}
					$widgetService.action.updateWidgetItem(scope.infoWidget.id, params).then(function () {

					}, function () {

					});
				}
			}
		}
	};
})

ngApp.directive('videoWidget', function ($widgetService) {
	var url = SiteUrl + "/rest/admin/widget-modal/VideoWidget" ;
	return {
		restrict: 'E',
		scope: {
			videoData: '=widgetCenterData',
		},
		templateUrl: url,
		link: function (scope, element, attrs) {
			scope.infoWidget;

			scope.$watchCollection('videoData', function(newVal, oldVal, scope) {
				scope.infoWidget      = angular.copy(newVal);
				scope.infoWidget.data = JSON.parse(newVal.data);
			});

			scope.actions = {
				updateWidget: function () {
					var params = {
						location: scope.infoWidget.location,
						data: {
							name: scope.infoWidget.data.name,
							url_video: scope.infoWidget.data.url_video
						}
					}
					$widgetService.action.updateWidgetItem(scope.infoWidget.id, params).then(function () {

					}, function () {

					});
				}
			}
		}
	};
})