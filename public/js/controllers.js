/**
 * MainCtrl - controller
 * Contains severals global data used in diferent view
 *
 */
function MainCtrl($scope, $interval, $http, $ocLazyLoad, $injector, $window, authService) {

    $ocLazyLoad.load([
        {
            files: ['js/plugins/sweetalert/sweetalert.min.js', 'css/plugins/sweetalert/sweetalert.css']
        },
        {
            name: 'oitozero.ngSweetAlert',
            files: ['js/plugins/sweetalert/angular-sweetalert.min.js']
        },
    ]).then(function(){
        $scope.SweetAlert = $injector.get('SweetAlert');
    });

    function checkLogin() {
        $http.get("/api/v1/auth/check").then(function(response){
            $scope.auth = response.data;
            authService.name = response.data.name;
            authService.write = response.data.write;
        },
        function(response){
            $interval.cancel($scope.checkAuth);
            if (response.status == 401) {
                $scope.SweetAlert.swal({
                    title: "Sessie verlopen",
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Opnieuw inloggen",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function () {
                    $window.location.href = '/auth';
                });
            } else if (response.status == 403) {
                $scope.SweetAlert.swal({
                    title: "Geen toegang",
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Naar Portal",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function () {
                    $window.location.href = 'https://portal.rotterdam-vlg.com/';
                });
            } else {
                $scope.SweetAlert.swal({
                    title: "Applicatiefout",
                    type: "error",
                    "text": "Er is een fout ontstaan in de applicatie",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Probeer opnieuw",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function () {
                    $window.location.href = '/';
                });
            }
        });
    };

    checkLogin();

    /**
     * initial run for random stacked value
     */
    $scope.checkAuth = $interval(checkLogin, 60000);
};

function ModalInstanceCtrl($scope, $modalInstance, $http, toaster, projectService) {

    $http.get("/api/v1/project_fields").then(function(response) {
        $scope.fields = response.data;
    });

    $http.get("/api/v1/project_companies").then(function(response) {
        $scope.companies = response.data;
    });

    $scope.ok = function () {

        data = {
            name: $scope.name,
            number: $scope.number,
            reference: $scope.reference,
            field: parseInt($scope.workfield),
            client: parseInt($scope.client),
        };

        $http.post("/api/v1/new_project", data).then(function(response) {
            if (response.data.id > 0) {
                projectService.addProject(response.data);
                toaster.success({ body: "Project " + response.data.name + " is aangemaakt."});
                $modalInstance.close();
            }
        }, function(response){
            if (response.data.name)
              $scope.newproject.name.used = true;
        });

    };

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    };

};

function ModalAttachTodoCtrl($scope, $modalInstance, $http, file, todoService, authService) {

    $scope.report = file;

    $scope.write = authService.write;

    $http.get("/api/v1/project/" + file.project_id + "/todo_available").then(function(response) {
        $scope.todos = response.data;
    });

    $scope.ok = function() {
        var todo_id = parseInt($scope.todo);

        data = {
            report: file.id,
            todo: todo_id,
            done: $scope.done,
            version: $scope.version,
        };

        $http.post("/api/v1/update_report", data).then(function(response) {
            todoService.attach(todo_id, response.data);
            $modalInstance.close();
        });

    };

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    };

};

/**
 * formValidation - Controller for validation example
 */
function formValidation($scope) {

    $scope.signupForm = function() {
        if ($scope.signup_form.$valid) {
            // Submit as normal
        } else {
            $scope.signup_form.submitted = true;
        }
    }

    $scope.signupForm2 = function() {
        if ($scope.signup_form.$valid) {
            // Submit as normal
        }
    }

};

function loadingCtrl($scope, $timeout){

    $scope.runLoading1 = function () {
        $scope.loading1 = true;

        $timeout(function () {
            $scope.loading1 = false;
        }, 2000);
    };
}

function projectCtrl($scope,$modal,$http,projectService) {

    $scope.open1 = function() {
        var modalInstance = $modal.open({
            templateUrl: '/new_project_window',
            controller: ModalInstanceCtrl
        });
    };

    $scope.init = function() {
        $scope.projects.splice(0,$scope.projects.length);

        $http.get("/api/v1/projects").then(function(response) {

            angular.forEach(response.data, function(value, key) {
                projectService.addProject(value);
            });

        });
    };

    $scope.projects = projectService.getProjects();

    function fix_height() {
        var heightWithoutNavbar = $("body > #wrapper").height() - 61;
        $(".sidebard-panel").css("min-height", heightWithoutNavbar + "px");

        var navbarHeigh = $('nav.navbar-default').height();
        var wrapperHeigh = $('#page-wrapper').height();

        if (navbarHeigh > wrapperHeigh) {
            $('#page-wrapper').css("min-height", navbarHeigh + "px");
        }

        if (navbarHeigh < wrapperHeigh) {
            $('#page-wrapper').css("min-height", $(window).height() + "px");
        }

        if ($('body').hasClass('fixed-nav')) {
            if (navbarHeigh > wrapperHeigh) {
                $('#page-wrapper').css("min-height", navbarHeigh - 60 + "px");
            } else {
                $('#page-wrapper').css("min-height", $(window).height() - 60 + "px");
            }
        }

    }

    fix_height();
};

function projectDetailCtrl($scope,$stateParams,$http,$window,$modal,reportService,todoService) {

    $scope.isActive = [{active:true},{active:false},{active:false},{active:false}];

    $scope.gotoReport = function(id) {
        $scope.isActive[0].active = true;

        angular.forEach(reportService.getReport(), function(value, key) {
            if (value.id == id) {
                value.highlight = 'forum-highlight';
            }
        });

    };

    $http.get("/api/v1/project/" + $stateParams.id).then(function(response) {
        $scope.project = response.data;

        if (!$scope.project.id)
            $window.location.href = '/#/dashboard';
        
        $scope.project.updated_at = new Date($scope.project.updated_at);
        $scope.project.created_at = new Date($scope.project.created_at);
        
        if ($scope.project.status.priority < 4)
            $scope.project.status.label = 'label-default';
        else
            $scope.project.status.label = 'label-primary';    
    });

    $scope.setStatus = function(code) {
        data = {
            project: $scope.project.id,
            status: code,
        };

        $http.post("/api/v1/update_status", data).then(function(response) {
            $scope.project.status = response.data;

            if ($scope.project.status.priority < 4)
                $scope.project.status.label = 'label-default';
            else
                $scope.project.status.label = 'label-primary';
        });
    }

    $scope.showStatus = function(status) {
        if (!$scope.project)
            return false;

        if ($scope.project.status.priority < status)
            return true;

        return false;
    }

    $scope.addReport = function(json) {
        if (todoService.getUnattachedCount() > 0) {
            var modalInstance = $modal.open({
                templateUrl: '/attach_todo_window',
                controller: ModalAttachTodoCtrl,
                resolve: {
                    file: function(){
                        return json;
                    }
                }
            });
        }

        reportService.addReport(json);
    }

    $scope.blur = function(e) {
        data = {
            project: $scope.project.id,
            note: $scope.project.note,
        };

        $http.post("/api/v1/update_note", data);
    };

    function fix_height() {
        var heightWithoutNavbar = $("body > #wrapper").height() - 61;
        $(".sidebard-panel").css("min-height", heightWithoutNavbar + "px");

        var navbarHeigh = $('nav.navbar-default').height();
        var wrapperHeigh = $('#page-wrapper').height();

        if (navbarHeigh > wrapperHeigh) {
            $('#page-wrapper').css("min-height", navbarHeigh + "px");
        }

        if (navbarHeigh < wrapperHeigh) {
            $('#page-wrapper').css("min-height", $(window).height() + "px");
        }

        if ($('body').hasClass('fixed-nav')) {
            if (navbarHeigh > wrapperHeigh) {
                $('#page-wrapper').css("min-height", navbarHeigh - 60 + "px");
            } else {
                $('#page-wrapper').css("min-height", $(window).height() - 60 + "px");
            }
        }

    }

    fix_height();
};

function reportCtrl($scope,$stateParams,$http,reportService) {

    $scope.init = function() {

        $scope.reports.splice(0,$scope.reports.length);

        $http.get("/api/v1/project/" + $stateParams.id + "/reports").then(function(response) {

            angular.forEach(response.data, function(value, key) {
                reportService.addReport(value);
            });

        });

    };

    $scope.reports = reportService.getReport();

    // Based on an implementation here: web.student.tuwien.ac.at/~e0427417/jsdownload.html
    $scope.downloadFile = function(httpPath) {
        // Use an arraybuffer
        $http.get(httpPath, { responseType: 'arraybuffer' })
        .success( function(data, status, headers) {

            var octetStreamMime = 'application/octet-stream';
            var success = false;

            // Get the headers
            headers = headers();

            // Get the filename from the x-filename header or default to "download.bin"
            var filename = headers['x-filename'] || 'download.bin';

            // Determine the content type from the header or default to "application/octet-stream"
            var contentType = headers['content-type'] || octetStreamMime;

            try {
                // Try using msSaveBlob if supported
                var blob = new Blob([data], { type: contentType });
                if(navigator.msSaveBlob)
                    navigator.msSaveBlob(blob, filename);
                else {
                    // Try using other saveBlob implementations, if available
                    var saveBlob = navigator.webkitSaveBlob || navigator.mozSaveBlob || navigator.saveBlob;
                    if(saveBlob === undefined) throw "Not supported";
                    saveBlob(blob, filename);
                }
                success = true;
            } catch(ex) {
                // console.log(ex);
            }

            if(!success) {
                // Get the blob url creator
                var urlCreator = window.URL || window.webkitURL || window.mozURL || window.msURL;
                if(urlCreator) {
                    // Try to use a download link
                    var link = document.createElement('a');
                    if('download' in link) {
                        // Try to simulate a click
                        try {
                            // Prepare a blob URL
                            var blob = new Blob([data], { type: contentType });
                            var url = urlCreator.createObjectURL(blob);
                            link.setAttribute('href', url);

                            // Set the download attribute (Supported in Chrome 14+ / Firefox 20+)
                            link.setAttribute("download", filename);

                            // Simulate clicking the download link
                            var event = document.createEvent('MouseEvents');
                            event.initMouseEvent('click', true, true, window, 1, 0, 0, 0, 0, false, false, false, false, 0, null);
                            link.dispatchEvent(event);
                            success = true;

                        } catch(ex) {
                            // console.log(ex);
                        }
                    }

                    if(!success) {
                        // Fallback to window.location method
                        try {
                            // Prepare a blob URL
                            // Use application/octet-stream when using window.location to force download
                            var blob = new Blob([data], { type: octetStreamMime });
                            var url = urlCreator.createObjectURL(blob);
                            window.location = url;
                            success = true;
                        } catch(ex) {
                            // console.log(ex);
                        }
                    }

                }
            }

            if(!success) {
                // Fallback to window.open method
                window.open(httpPath, '_blank', '');
            }
        })
        .error(function(data, status) {
            // Optionally write the error out to scope
            $scope.errorDetails = "Request failed with status: " + status;
        });
    };

    $scope.download = function ($id) {
        $scope.downloadFile('/api/v1/report/' + $id + '/download');
    }

};

function threadCtrl($scope,$stateParams,$http) {

    $scope.init = function() {
        $http.get("/api/v1/project/" + $stateParams.id + "/thread").then(function(response) {

            $scope.thread = response.data;
            angular.forEach($scope.thread, function(value, key) {
                value.updated_at = new Date(value.updated_at);
                value.created_at = new Date(value.created_at);
                if (value.isme){
                    value.pull = 'pull-right';
                    value.text = 'text-right';
                } else {
                    value.pull = 'pull-left';
                    value.text = '';
                }
            });

        });
    };

    $scope.post = function() {
        var data = {
            project: $stateParams.id,
            message: $scope.message,
        };

        $http.post("/api/v1/new_message", data).then(function(response) {
            response.data.pull = 'pull-right';
            response.data.text = 'text-right';
            response.data.name = 'Ik'
            $scope.thread.push(response.data);
        });

        $scope.message = '';        
    };

}

function todoCtrl($scope,$stateParams,$http,todoService) {

    $scope.init = function() {
        $scope.todos.splice(0,$scope.todos.length);

        $http.get("/api/v1/project/" + $stateParams.id + "/todo").then(function(response) {
            angular.forEach(response.data, function(value, key) {
                todoService.addTodo(value);
            });

        });
    };

    $scope.todos = todoService.getTodos();

    $scope.addItem = function() {
        data = {
            project: $stateParams.id,
            message: $scope.item,
        };

        $http.post("/api/v1/new_todo", data).then(function(response) {
            $scope.todos.push(response.data);
        });

        $scope.item = '';
    };

    $scope.showTodo = function(id) {
        if (id == 2)
            return true;

        if (!$scope.todos)
            return false;

        if ($scope.todos.length > 0)
            return true;

        return false;
    };

}

/**
 *
 * Pass all functions into module
 */
angular
    .module('inspinia')
    .controller('MainCtrl', MainCtrl)
    .controller('loadingCtrl', loadingCtrl)
    .controller('formValidation', formValidation)
    .controller('projectCtrl', projectCtrl)
    .controller('projectDetailCtrl', projectDetailCtrl)
    .controller('reportCtrl', reportCtrl)
    .controller('threadCtrl', threadCtrl)
    .controller('todoCtrl', todoCtrl);
