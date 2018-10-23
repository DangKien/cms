ngApp.controller('magazineCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $magazineService, $apply) {

	$scope.data = {
		magazines: {},
		page: {},
	}
	$scope.filter = {
		freetext: "",
		orderBy: "",
		orderByCheck: '',
		order: false,
	}

	$scope.checker = {
		btnCheckAll: false,
		checkedAll: []
	}
	$scope.actions = {
		getMagazine: function () {
			var params = $magazineService.data.filter($scope.filter.freetext, $scope.filter.orderName, $scope.filter.orderBy,
											 $scope.data.page.current_page, $scope.data.page.per_page);
			$magazineService.action.getMagazine(params).then(function (resp) {
				if (resp) {
					$apply(function () {
						$scope.data.magazines = resp.data.data;
						$scope.data.page    = resp.data;
						if ($scope.data.page.current_page > resp.data.last_page) {
							$scope.data.page.current_page = resp.data.last_page;
							$scope.actions.getMagazine();
						}
					})
				}
			}, function (error) {
			})
		},

		changePage: function (page) {
			$scope.data.page.current_page = page;
			$scope.actions.getMagazine();
		},

		delete: function ($id) {
			if ($id) {
				$myBootbox.confirm('Bạn có muốn xóa？', function (resp) {
					if (resp) {
					$magazineService.action.deleteMagazine($id).then(function (resp) {
						if (resp) {
							$myNotify.success();
							$scope.actions.getMagazine();
						}
						}, function (error) {
							$myNotify.error();
						})
					}
				})
			}
		},

		filter: function () {
			$scope.actions.getMagazine();
		},

		orderBy: function(propertyName) {
			$scope.filter.order = ($scope.filter.orderName == propertyName) ? !$scope.filter.order : false;
			$scope.filter.orderName = propertyName;
			$scope.filter.orderBy = $scope.filter.order ? 'desc' : 'asc'
			$scope.actions.getMagazine();
		},

		checkAll: function(data) {
			$apply(function () {
				angular.forEach(data, function(val, key){
					$scope.checker.checkedAll[val.id] = $scope.checker.btnCheckAll;
				});
			});
		}, 

		actionCheckAll: function () {
			var ids = [];
			angular.forEach($scope.checker.checkedAll, function(val, key){
				if(val == true) {
					ids.push(key);
				}
			});
			if (ids.length != 0 ) {
				var params = {
					ids: ids
				};
				$myBootbox.confirm('',function (resp) {
					if (resp) {
					$magazineService.action.deleteMagazineMulti(params).then(function (resp) {
						if (resp) {
							$myNotify.success();
							$scope.actions.getMagazine();
						}
						}, function (error) {
							$myNotify.error();
						})
					}
				})
			}
		},

		checkOrUncheck: function (check) {
			if (!check && $scope.checker.btnCheckAll) {
				$scope.checker.btnCheckAll = ! $scope.checker.btnCheckAll;
			}
		},

	}

	$scope.actions.getMagazine();
});