function projectService() {
    var projectList = [];

    var addProject = function(newObj) {

        newObj.updated_at = new Date(newObj.updated_at);
        newObj.created_at = new Date(newObj.created_at);
        
        if (newObj.status.priority < 3)
            newObj.status.label = 'label-default';
        else
            newObj.status.label = 'label-primary';

        projectList.push(newObj);
    };

    var getProjects = function(){
        return projectList;
    };

    return {
        addProject: addProject,
        getProjects: getProjects
    };
};

function reportService() {
    var reportList = [];

    var addReport = function(newObj) {

        /* Convert dates */
        newObj.updated_at = new Date(newObj.updated_at);
        newObj.created_at = new Date(newObj.created_at);

        /* Set label */
        if (newObj.done > 0)
            newObj.label = 'active';
        else
            newObj.label = '';

        /* Icon */
        switch(newObj.mime) {
            case "application/x-compressed":
            case "application/x-zip-compressed":
            case "application/zip":
            case "multipart/x-zip":
                newObj.icon = "fa-file-archive-o";
                break;

            case "application/vnd.ms-office":
            case "application/vnd.ms-excel":
            case "application/x-msexcel":
            case "application/excel":
                newObj.icon = "fa-file-excel-o";
                break;

            case "application/pdf":
                newObj.icon = "fa-file-pdf-o";
                break;

            case "application/msword":
                newObj.icon = "fa-file-word-o";
                break;

            default:
                newObj.icon = "fa-file-text-o";
        }

        reportList.push(newObj);
    };

    var getReport = function(){
        return reportList;
    };

    var clear = function(){
        reportList = [];
    };

    var update = function(obj){
        for (var i in reportList) {
            if (reportList[i].id == obj.id) {
                if (obj.done > 0)
                    reportList[i].label = 'active';
                reportList[i].version = obj.version;
                reportList[i].name = obj.name;
            }
        }
    };

    return {
        addReport: addReport,
        getReport: getReport,
        clear: clear,
        update: update,
    };
};

function todoService() {
    var todoList = [];

    var addTodo = function(newObj) {

        if (newObj.done > 0)
            newObj.checked = true;

        todoList.push(newObj);
    };

    var getTodos = function(){
        return todoList;
    };

    var getUnattachedCount = function(){
        var count = 0;

        for (var i in todoList) {
            if (!todoList[i].report) {
                count++;
            }
        }

        return count;
    };

    var attach = function(id, report) {
        for (var i in todoList) {
            if (todoList[i].id == id) {
                todoList[i].report = report;
            }
        }
    }

    return {
        addTodo: addTodo,
        getTodos: getTodos,
        getUnattachedCount: getUnattachedCount,
        attach: attach
    };
};

function authService() {
    var name;
    var write = false;
    var admin = false;
};

/**
 *
 * Pass all functions into module
 */
angular
    .module('inspinia')
    .service('projectService', projectService)
    .service('reportService', reportService)
    .service('todoService', todoService)
    .service('authService', authService);
