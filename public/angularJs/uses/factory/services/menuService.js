ngApp.factory('$menuService', function ($http, $httpParamSerializer){

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

	service.data.params = function (name) {
		return {
			name: name || ''
		}
	}

	service.action.insertMenu = function (params) {
		var url = SiteUrl + "/admin/menu";
        return $http.post(url, params);
	};

	service.action.updateMenu = function (params, id) {
		var url = SiteUrl + "/admin/menu/" + id;
        return $http.put(url, params);
	};

	service.action.deleteMenu = function (id) {
		var url = SiteUrl + "/rest/admin/menu/" + id;
        return $http.delete(url);
	};

	

	return service;
})