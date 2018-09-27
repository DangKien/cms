ngApp.factory('$widgetService', function ($http, $httpParamSerializer){

	var service = {
		action: {},
		data: {}
	};

	service.action.getWidget = function (params) {
		var url = SiteUrl + "/rest/admin/widget-item";
        return $http.get(url);
	};

	service.action.deleteCategory = function ($id) {
		var url = SiteUrl + "/rest/admin/categories/" + $id;
        return $http.delete(url);
	};

	return service;
})