ngApp.controller('menuCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $menuService, $apply) {

	$scope.data = {
		slides: {},
		page: {},
		errors: {}
	}
	$scope.actions = {
		saveInsert: function () {
			var params = $menuService.data.params($scope.data.name);
			$menuService.action.insertMenu(params).then(function (resp) {
					if (resp) {
						window.location = SiteUrl + '/admin/menu?actions=edit&menu_id=' + resp.data.id;
					}
			}, function (error) {
				$scope.data.errors = error.data.errors;
			})
		},
		saveUpdate: function (id) {
			var name = $('input[name*="edit_name"]').val();
			var params = $menuService.data.params(name);
			$menuService.action.updateMenu(params, id).then(function (resp) {
					if (resp) {
						$myNotify.success();
						$scope.data.errors = {};
					}
			}, function (error) {
				$scope.data.errors = error.data.errors;
				console.log($scope.data.errors);
			})
		},

		delete: function ($id) {
			if ($id) {
				$myBootbox.confirm('Bạn có muốn xóa？', function (resp) {
					if (resp) {
					$menuService.action.deleteMenu($id).then(function (resp) {
						if (resp) {
							$myNotify.success();
							window.location = SiteUrl + '/admin/menu';
						}
						}, function (error) {
							$myNotify.error();
						})
					}
				})
			}
		},
	}
});