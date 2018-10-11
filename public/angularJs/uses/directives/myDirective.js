ngApp.directive('myDatepicker', function($apply) {
    return {
        restrict: 'C',
        link: function(scope, element, attrs) {
            $apply(function () {
                $('.datepicker').datepicker();
                $('#sandbox-container input').datepicker({
                    language: "vi"
                });
            });
        }
    };
});

ngApp.directive('myCkeditor', function($apply, $timeout) {
    return {
        restrict: 'C',
        require: '?ngModel',
        link: function(scope, element, attrs, ngModel) {
            $apply (function () {
                var ck = CKEDITOR.replace(element[0], {
                    language: 'vi',
                    extraPlugins: 'codesnippet',
                    codeSnippet_theme: 'monokai_sublime',
                    filebrowserImageBrowseUrl: SiteUrl + '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: SiteUrl + '/laravel-filemanager/upload?type=Images&_token=',
                    filebrowserBrowseUrl: SiteUrl + '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: SiteUrl + '/laravel-filemanager/upload?type=Files&_token=',
                }); 
                if (!ngModel) return;
                ck.on('instanceReady', function () {
                    ck.setData(ngModel.$viewValue);
                });
                function updateModel() {
                    scope.$apply(function () {
                        ngModel.$setViewValue(ck.getData());
                    });
                }
                ck.on('change', updateModel);
                ck.on('key', updateModel);
                ck.on('dataReady', updateModel);

                ngModel.$render = function (value) {
                    ck.setData(ngModel.$viewValue);
                };
            })
        }
    }
});

ngApp.directive('myLfm', function($apply) {
    return {
        restrict: 'C',
        scope: {
            type: "=type"
        },
        link: function(scope, element, attrs) {
            var domain = SiteUrl + '/admin/laravel-filemanager';
            $(element).filemanager(scope.type, {prefix: domain});
        }
    };
});

ngApp.directive('myRenderImage', function () {
    var link = function(scope, element, attrs) {
        $(element).change(function () {
            if (element[0].files && element[0].files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    element.parent().parent().find('img').attr('src', e.target.result);
                };
            reader.readAsDataURL(element[0].files[0]);
                }
            });
    }
    return {
       restrict: 'C',
       link: link,
    };
});

ngApp.directive('selectpicker', function ($apply) {

    var link = function(scope, element, attrs, ngModel) {
        if (!ngModel) return;

        element.selectpicker();

        function loadEl() {
            element.selectpicker('refresh');
        }

        $apply (function () {
            ngModel.$setViewValue(element.val());
        })

        scope.$watchCollection('ngDataChange', function(newVal, oldVal) {
            scope.$evalAsync(loadEl);
        });
    }

    return {
       restrict: 'C',
       link: link,
       require: "?ngModel",
       scope: {
            ngDataChange: '=ngData'
       }
    };
});
