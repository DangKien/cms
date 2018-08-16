ngApp.factory('$newService', function ($http, $httpParamSerializer){

	var service = {
		action: {},
		data: {}
	};

	service.data.filter = function (freetext, orderName, orderBy , page, perPage) {
		return params = {
			'freetext': freetext || '',
			'orderName': orderName || 'id',
			'orderBy': orderBy || 'asc',
			'page': page || 1,
			'perPage': perPage || 20,
		}
	};

	service.action.getNew = function (params) {
		var url = SiteUrl + "/rest/admin/news?" + $httpParamSerializer(params);
        return $http.get(url);
	};

	service.action.deleteNew = function ($id) {
		var url = SiteUrl + "/rest/admin/news/" + $id;
        return $http.delete(url);
	};

	service.action.deleteNewMulti = function (params) {
		var url = SiteUrl + "/rest/admin/news/delete-multi";
        return $http.post(url, params);
	};

	service.action.hotNews = function ($id) {
		var url = SiteUrl + "/rest/admin/news/hot-new/" + $id ;
        return $http.post(url);
	};

	service.action.prioritizeNew = function ($id) {
		var url = SiteUrl + "/rest/admin/news/prioritize-new/" + $id ;
        return $http.post(url);
	};

	return service;
})