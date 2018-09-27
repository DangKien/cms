ngApp.controller('settingCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $settingService, $apply) {

	$scope.data = {
		users: {},
		page: {},
		logo: {},
		banner_home: {},
		contact: {},
		service: {},
		review: {
			home_image: []
		},
		advantage: {}
	}
	$scope.filter = {
		freetext: ""
	}

	$scope.actions = {
		getLogo: function () {
			$settingService.action.getSetting().then(function (resp) {
				angular.forEach(resp.data, function(value, key){
					if (value.key == 'CONTACT') {
						$scope.data.contact = value.setting
					}
					if (value.key == 'GOOGLE_ANALYTIC') {
						$scope.data.googleApi = value.setting
					}
					if (value.key == 'META') {
						$scope.data.meta = value.setting
					}
				});
			}, function (error) {
			})
		},
		saveContact: function () {
			let params = {
				'setting': JSON.stringify(
					{
						'address': $scope.data.contact.address || '',
						'phone'  : $scope.data.contact.phone || '',
						'worktime' : $scope.data.contact.worktime || '',
						'fax' : $scope.data.contact.fax || '',
						'email': $scope.data.contact.email || '',
						'fb': $scope.data.contact.fb || '',
						'google_plus': $scope.data.contact.google_plus || '',
						'youtube'  : $scope.data.contact.youtube || '',
						'instagram' : $scope.data.contact.instagram || '',
						'zalo' : $scope.data.contact.zalo || '',
						'google_map' : $scope.data.contact.google_map || '',
						'description' : $scope.data.contact.description || '',
						'coppyright'  : $scope.data.contact.coppyright || '',
						
					}
				),
				'key' : 'CONTACT'
			}
			$settingService.action.insertSetting(params).then(function (resp){
				if (resp) {
					$myNotify.success('Success')
				}
			}, function (error) {
				$myNotify.error('Error')
			});
		},

		saveMeta: function () {
			let params = {
				'setting': JSON.stringify(
					{
						'title': $scope.data.meta.title || '',
						'meta_title'  : $scope.data.meta.meta_title || '',
						'meta_desciption' : $scope.data.meta.meta_description || '',
						'meta_keyword' : $scope.data.meta.meta_keyword || '',
					}
				),
				'key' : 'META'
			}
			$settingService.action.insertSetting(params).then(function (resp){
				if (resp) {
					$myNotify.success('Success')
				}
			}, function (error) {
				$myNotify.error('Error')
			});
		},

		saveGgAnalytic: function () {
			let params = {
				'setting': JSON.stringify(
					{
						'google_analytic': $scope.data.googleApi.google_analytic || '',
					}
				),
				'key' : 'GOOGLE_ANALYTIC'
			}
			$settingService.action.insertSetting(params).then(function (resp){
				if (resp) {
					$myNotify.success('Success')
				}
			}, function (error) {
				$myNotify.error('Error')
			});
		},

		delete: function ($id) {
			if ($id) {
				$myBootbox.confirm('Are you sure?', function (resp) {
					if (resp) {
					$settingService.action.deleteUser($id).then(function (resp) {
						if (resp) {
							$myNotify.success('Sure!');
							$scope.actions.getAboutTeam();
						}
						}, function (error) {
							$myNotify.error('No!');
						})
					}
				})
			}
		},

	}

	$scope.actions.getLogo();
});