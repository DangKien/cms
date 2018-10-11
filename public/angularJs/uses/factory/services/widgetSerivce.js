ngApp.factory('$widgetService', function ($http, $httpParamSerializer){

	var service = {
		action: {},
		data: {}
	};

	service.action.getWidget = function (params) {
		var url = SiteUrl + "/rest/admin/widget-item";
        return $http.get(url);
	};

	service.action.getListWidget = function (params) {
		var url = SiteUrl + "/rest/admin/list-widget-item?" + $httpParamSerializer(params);
        return $http.get(url);
	};

	service.action.deleteCategory = function ($id) {
		var url = SiteUrl + "/rest/admin/categories/" + $id;
        return $http.delete(url);
	};

	service.action.addWidget = function (params) {
		var url = SiteUrl + "/rest/admin/add-widget-to-sideBar";
        return $http.post(url, params);
	};

	service.action.updateWidgetItem = function ($id, params) {
		var url = SiteUrl + "/rest/admin/update-widget-item/" + $id;
        return $http.post(url, params);
	};

	service.action.sortWidget = function (params) {
		var url = SiteUrl + "/rest/admin/sort-widget-item";
        return $http.post(url, params);
	};

	return service;
})