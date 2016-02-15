/**
 * MainCtrl - controller
 * Contains severals global data used in diferent view
 *
 */
function MainCtrl($interval, $http) {

    /**
     * initial run for random stacked value
     */
    $interval(function() {
        $http.get("/api/v1/auth/check").then(function(response) {
            console.log(response);
        });
    }, 30000);

};

/**
 * modalDemoCtrl - Controller used to run modal view
 * used in Basic form view
 */
function modalDemoCtrl($scope, $modal) {

    $scope.open = function () {

        var modalInstance = $modal.open({
            templateUrl: 'views/modal_example.html',
            controller: ModalInstanceCtrl
        });
    };

    $scope.open1 = function () {
        var modalInstance = $modal.open({
            templateUrl: 'views/modal_example1.html',
            controller: ModalInstanceCtrl
        });
    };

    $scope.open2 = function () {
        var modalInstance = $modal.open({
            templateUrl: 'views/modal_example2.html',
            controller: ModalInstanceCtrl,
            windowClass: "animated fadeIn"
        });
    };

    $scope.open3 = function (size) {
        var modalInstance = $modal.open({
            templateUrl: 'views/modal_example3.html',
            size: size,
            controller: ModalInstanceCtrl
        });
    };

    $scope.open4 = function () {
        var modalInstance = $modal.open({
            templateUrl: 'views/modal_example2.html',
            controller: ModalInstanceCtrl,
            windowClass: "animated flipInY"
        });
    };
};

function ModalInstanceCtrl($scope, $modalInstance, $http, toaster, projectService) {

    $http.get("/api/v1/project_fields").then(function(response) {
        $scope.fields = response.data;
    });

    $scope.ok = function () {
        data = {
            name: $scope.name,
            number: $scope.number,
            reference: $scope.reference,
            field: parseInt($scope.wordfield),
        };

        $http.post("/api/v1/new_project", data).then(function(response) {
            if (response.data.id > 0) {
                projectService.addProject(response.data);
                toaster.success({ body: "Project " + response.data.name + " is aangemaakt."});
                $modalInstance.close();
            }
        }); //TODO handle err

    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

};

function ModalAttachTodoCtrl($scope, $modalInstance, $http, file) {

    console.log(file);
    $scope.report = file;

    $http.get("/api/v1/project/" + file.project_id + "/todo_available").then(function(response) {
        $scope.todos = response.data;
    });

    $scope.ok = function () {
        data = {
            report: file.id,
            todo: parseInt($scope.todo),
        };

        $http.post("/api/v1/update_report", data).then(function(response) {
            $modalInstance.close();
        });

    };

    $scope.cancel = function () {
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

/**
 * sweetAlertCtrl - Function for Sweet alerts
 */
function sweetAlertCtrl($scope, SweetAlert) {

    $scope.demo1 = function () {
        SweetAlert.swal({
            title: "Welcome in Alerts",
            text: "Lorem Ipsum is simply dummy text of the printing and typesetting industry."
        });
    }

    $scope.demo2 = function () {
        SweetAlert.swal({
            title: "Good job!",
            text: "You clicked the button!",
            type: "success"
        });
    }

    $scope.demo3 = function () {
        SweetAlert.swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function () {
                SweetAlert.swal("Ok!");
            });
    }

    $scope.demo4 = function () {
        SweetAlert.swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false },
            function (isConfirm) {
                if (isConfirm) {
                    SweetAlert.swal("Deleted!", "Your imaginary file has been deleted.", "success");
                } else {
                    SweetAlert.swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
    }

}

function toastrCtrl($scope, toaster){

    $scope.demo1 = function(){
        toaster.success({ body:"Hi, welcome to Inspinia. This is example of Toastr notification box."});
    };

    $scope.demo2 = function(){
        toaster.warning({ title: "Title example", body:"This is example of Toastr notification box."});
    };

    $scope.demo3 = function(){
        toaster.pop({
            type: 'info',
            title: 'Title example',
            body: 'This is example of Toastr notification box.',
            showCloseButton: true

        });
    };

    $scope.demo4 = function(){
        toaster.pop({
            type: 'error',
            title: 'Title example',
            body: 'This is example of Toastr notification box.',
            showCloseButton: true,
            timeout: 600
        });
    };

}

function loadingCtrl($scope, $timeout){

    // Demo purpose actions
    $scope.runLoading1 = function () {
        // start loading
        $scope.loading1 = true;

        $timeout(function () {
            // Simulate some service
            $scope.loading1 = false;
        }, 2000)
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

        console.log(projectService.getProjects());
        });
    };

    $scope.projects = projectService.getProjects();
};

function projectDetailCtrl($scope,$stateParams,$http,$window,$modal,reportService) {

    $scope.isActive = [{active:true},{active:false},{active:false},{active:false}];

    $scope.gotoReport = function(id) {
        $scope.isActive[0].active = true;

        angular.forEach(reportService.getReport(), function(value, key) {
            if (value.id == id) {
                console.log(value);
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
        var modalInstance = $modal.open({
            templateUrl: '/attach_todo_window',
            controller: ModalAttachTodoCtrl,
            resolve: {
                file: function(){
                    return json;
                }
            }
        });
        reportService.addReport(json);
    }

    $scope.blur = function(e) {
        data = {
            project: $scope.project.id,
            note: $scope.project.note,
        };

        $http.post("/api/v1/update_note", data);
    };

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
                            console.log(ex);
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
                            console.log(ex);
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
            console.log("Request failed with status: " + status);

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
                value.pull = 'pull-left';
                value.text = '';

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
            $scope.thread.push(response.data);
        });

        $scope.message = '';        
    }

}

function todoCtrl($scope,$stateParams,$http) {

    $scope.init = function() {
        $http.get("/api/v1/project/" + $stateParams.id + "/todo").then(function(response) {

            $scope.todos = response.data;
            angular.forEach($scope.todos, function(value, key) {
                if (value.done > 0)
                    value.checked = true;
            });

        });
    };

    $scope.addItem = function() {
        data = {
            project: $stateParams.id,
            message: $scope.item,
        };

        $http.post("/api/v1/new_todo", data).then(function(response) {
            console.log(response);
            $scope.todos.push(response.data);
        });

        $scope.item = '';
    }

    $scope.showTodo = function(id) {
        if (id == 2)
            return true;

        if (!$scope.todos)
            return false;

        if ($scope.todos.length > 0)
            return true;

        return false;
    }

}

/**
 *
 * Pass all functions into module
 */
angular
    .module('inspinia')
    .controller('MainCtrl', MainCtrl)
    .controller('modalDemoCtrl', modalDemoCtrl)
    .controller('loadingCtrl', loadingCtrl)
    .controller('formValidation', formValidation)
    .controller('sweetAlertCtrl', sweetAlertCtrl)
    .controller('toastrCtrl', toastrCtrl)
    .controller('projectCtrl', projectCtrl)
    .controller('projectDetailCtrl', projectDetailCtrl)
    .controller('reportCtrl', reportCtrl)
    .controller('threadCtrl', threadCtrl)
    .controller('todoCtrl', todoCtrl);
