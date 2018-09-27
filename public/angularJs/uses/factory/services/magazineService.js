ngApp.factory('$magazineService', function ($http, $httpParamSerializer){

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

	service.action.getMagazine = function (params) {
		var url = SiteUrl + "/rest/admin/magazines?" + $httpParamSerializer(params);
        return $http.get(url);
	};

	service.action.deleteMagazine = function ($id) {
		var url = SiteUrl + "/rest/admin/magazines/" + $id;
        return $http.delete(url);
	};

	service.action.deleteMagazineMulti = function (params) {
		var url = SiteUrl + "/rest/admin/magazines/delete-multi";
	    return $http.post(url, params);
	};

	return service;
})