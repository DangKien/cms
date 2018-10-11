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
                    if (value.key == 'LOGO') {
                        $scope.data.logo = value.setting
                    }
                    if (value.key == 'BANNER_HOME') {
                        $scope.data.banner_home = value.setting
                    }
                    if (value.key == 'CONTACT') {
                        $scope.data.contact = value.setting
                    }
                    if (value.key == 'OUR_SERVICE') {
                        $scope.data.service = value.setting
                    }
                    if (value.key == 'REVIEW_HOME') {
                        $scope.data.review = value.setting
                        console.log($scope.data.review.home_image);
                    }
                    if (value.key == 'ADVANTAGE_HOME') {
                        $scope.data.advantage = value.setting
                    }
                });
            }, function (error) {
            })
        },

        changeLogo: function () {
            let params = {
                'setting': JSON.stringify({'url_image': $scope.data.logo.url_image}),
                'key' : 'LOGO'
            }
            $settingService.action.insertSetting(params).then(function (resp){
                if (resp) {
                    $myNotify.success('Success')
                }
            }, function (error) {
                $myNotify.error('Error')
            });
        },

        changeImageservcie: function () {
            let params = {
                'setting': JSON.stringify({'tool': $scope.data.service.tool, 'pp': $scope.data.service.pp}),
                'key' : 'OUR_SERVICE'
            }
            $settingService.action.insertSetting(params).then(function (resp){
                if (resp) {
                    $myNotify.success('Success')
                }
            }, function (error) {
                $myNotify.error('Error')
            });
        },

        changeBannerHome: function () {
            let params = {
                'setting': JSON.stringify(
                    {'url_image': $scope.data.banner_home.url_image || '',
                        'intro': $scope.data.banner_home.intro || '',
                        'title': $scope.data.banner_home.title || '' }),
                'key' : 'BANNER_HOME'
            }
            $settingService.action.insertSetting(params).then(function (resp){
                if (resp) {
                    $myNotify.success('Success')
                }
            }, function (error) {
                $myNotify.error('Error')
            });
        },

        changeImageReview: function () {
            var arrayVal = [];

            $('.value-image').each(function () {
                if ($(this).val() != "") {
                    arrayVal.push($(this).val());
                }
            })
            let params = {
                'setting': JSON.stringify(
                    {'home_image': arrayVal || ''}),
                'key' : 'REVIEW_HOME'
            }
            $settingService.action.insertSetting(params).then(function (resp){
                if (resp) {
                    $myNotify.success('Success')
                }
            }, function (error) {
                $myNotify.error('Error')
            });
        },

        changeImageAdvantage: function () {
            let params = {
                'setting': JSON.stringify(
                    {
                        'home_image': $scope.data.advantage.home_image || '',
                        'pp_image' : $scope.data.advantage.pp_image || ''
                    }),
                'key' : 'ADVANTAGE_HOME'
            }
            $settingService.action.insertSetting(params).then(function (resp){
                if (resp) {
                    $myNotify.success('Success')
                }
            }, function (error) {
                $myNotify.error('Error')
            });
        },

        saveBanner: function () {
            let params = {
                'setting': JSON.stringify(
                    {
                        'right_banner': $scope.data.banner.right_banner || '',
                        'top_banner' : $scope.data.banner.top_banner || ''
                    }),
                'key' : 'BANNER'
            }
            $settingService.action.insertSetting(params).then(function (resp){
                if (resp) {
                    $myNotify.success('Success')
                }
            }, function (error) {
                $myNotify.error('Error')
            });
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
                        'youtube'  : $scope.data.contact.youtube || '',
                        'instagram' : $scope.data.contact.instagram || '',
                        'zalo' : $scope.data.contact.zalo || '',
                        'google_map' : $scope.data.contact.google_map || '',
                        'google_analytic': $scope.data.contact.google_analytic || '',
                        'fb_pixel' : $scope.data.contact.fb_pixel
                    }
                ),
                'key' : 'CONTACT'
            }
            console.log(params)
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