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
                    if (value.key == 'BANNER') {
                        $scope.data.banner = value.setting;
                    }
                    if (value.key == 'META_SEO') {
                        $scope.data.meta = value.setting
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


        saveBanner: function () {
            let params = {
                'setting': JSON.stringify(
                    {
                        'right_banner': $scope.data.banner.right_banner || '',
                        'top_banner' : $scope.data.banner.top_banner || '',
                        'top_banner_url' : $scope.data.banner.top_banner_url || '',
                        'right_banner_url': $scope.data.banner.right_banner_url || ''
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
                        'keyword': $scope.data.meta.keyword || '',
                        'description': $scope.data.meta.description || '',
                    }),
                'key' : 'META_SEO'
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