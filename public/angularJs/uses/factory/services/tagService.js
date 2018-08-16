ngApp.factory('$tagService', function ($http, $httpParamSerializer){

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

	service.action.getTag = function (params) {
		var url = SiteUrl + "/rest/admin/tags?" + $httpParamSerializer(params);
        return $http.get(url);
	};

	service.action.deleteTag = function ($id) {
		var url = SiteUrl + "/rest/admin/tags/" + $id;
        return $http.delete(url);
	};

	service.action.deleteTagMulti = function (params) {
		var url = SiteUrl + "/rest/admin/tags/delete-multi";
        return $http.post(url, params);
	};

	

	return service;
})