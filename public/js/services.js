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

    return {
        addReport: addReport,
        getReport: getReport,
        clear: clear
    };
};

/**
 *
 * Pass all functions into module
 */
angular
    .module('inspinia')
    .service('projectService', projectService)
    .service('reportService', reportService);
