ngApp.controller('newCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $newService, $apply) {

	$scope.data = {
		news: {},
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
		getNew: function () {
			var params = $newService.data.filter($scope.filter.freetext, $scope.filter.orderName, $scope.filter.orderBy,
											 $scope.data.page.current_page, $scope.data.page.per_page);
			$newService.action.getNew(params).then(function (resp) {
				if (resp) {
					$apply(function () {
						$scope.data.news = resp.data.data;
						$scope.data.page    = resp.data;
						if ($scope.data.page.current_page > resp.data.last_page) {
							$scope.data.page.current_page = resp.data.last_page;
							$scope.actions.getNew();
						}
					})
				}
			}, function (error) {
			})
		},

		changePage: function (page) {
			$scope.data.page.current_page = page;
			$scope.actions.getNew();
		},

		delete: function ($id) {
			if ($id) {
				$myBootbox.confirm('Bạn có muốn xóa？', function (resp) {
					if (resp) {
					$newService.action.deleteNew($id).then(function (resp) {
						if (resp) {
							$myNotify.success();
							$scope.actions.getNew();
						}
						}, function (error) {
							$myNotify.error();
						})
					}
				})
			}
		},

		filter: function () {
			$scope.actions.getNew();
		},

		orderBy: function(propertyName) {
			$scope.filter.order = ($scope.filter.orderName == propertyName) ? !$scope.filter.order : false;
			$scope.filter.orderName = propertyName;
			$scope.filter.orderBy = $scope.filter.order ? 'desc' : 'asc'
			$scope.actions.getNew();
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
					$newService.action.deleteNewMulti(params).then(function (resp) {
						if (resp) {
							$myNotify.success();
							$scope.actions.getNew();
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

		hotNews: function($id) {
			$myBootbox.confirm('',function (resp) {
				if (resp) {
				$newService.action.hotNews($id).then(function (resp) {
					if (resp) {
						$myNotify.success();
						$scope.actions.getNew();
					}
					}, function (error) {
						$myNotify.error();
					})
				}
			})
		},

		prioritizeNew: function ($id) {
			$myBootbox.confirm('',function (resp) {
				if (resp) {
				$newService.action.prioritizeNew($id).then(function (resp) {
					if (resp) {
						$myNotify.success();
						$scope.actions.getNew();
					}
					}, function (error) {
						$myNotify.error();
					})
				}
			})
		}

	}

	$scope.actions.getNew();
});