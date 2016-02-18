function config($stateProvider, $urlRouterProvider, $ocLazyLoadProvider) {

    $urlRouterProvider.otherwise("/dashboard");

    $ocLazyLoadProvider.config({
        debug: false
    });

    $stateProvider
        .state('dashboard', {
            url: "/dashboard",
            templateUrl: "/dashboard",
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            insertBefore: '#loadBefore',
                            name: 'toaster',
                            files: ['js/plugins/toastr/toastr.min.js', 'css/plugins/toastr/toastr.min.css']
                        }
                    ]);
                }
            }
        })
        .state('project', {
            url: "/project/:id/:name",
            templateUrl: "/project_details",
            data: { pageTitle: 'Project details' },
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            name: 'summernote',
                            files: ['css/plugins/summernote/summernote.css','css/plugins/summernote/summernote-bs3.css','js/plugins/summernote/summernote.min.js','js/plugins/summernote/angular-summernote.min.js','css/plugins/dropzone/basic.css','css/plugins/dropzone/dropzone.css','js/plugins/dropzone/dropzone.js']
                        },
                        {
                            files: ['css/plugins/iCheck/custom.css','js/plugins/iCheck/icheck.min.js']
                        }
                    ]);
                }
            }
        })
}

angular
    .module('inspinia')
    .config(config)
    .run(function($rootScope, $state) {
        $rootScope.$state = $state;
    });
