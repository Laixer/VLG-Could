<!-- Wrapper-->
<div id="wrapper">

    <!-- Page wraper -->
    <div id="page-wrapper" class="gray-bg @{{ $state.current.name }}">

        <!-- Page wrapper -->
        <div ng-include="'/common/header'"></div>

        <!-- Content -->
        <toaster-container></toaster-container>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>Dashboard</h2>
                <ol class="breadcrumb">
                    <li class="active">
                        <strong>Home</strong>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
        <div class="col-lg-12">
        <div class="wrapper wrapper-content" ng-controller="projectCtrl" ng-init="init()">
        <div class="row">

            <div class="ibox">
            <div class="ibox-title">
                <h5>Alle projecten</h5>

                <div class="ibox-tools">
                    <button class="btn btn-primary btn-xs" ng-show="auth.write" ng-click="open1()">Nieuw project</button>
                </div>
            </div>
            <div class="ibox-content">
            <div class="row m-b-sm m-t-sm">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" placeholder="Zoek in projecten" ng-model="query" class="input-sm form-control">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-primary"> Zoeken</button>
                        </span>
                    </div>
                </div>
            </div>

            <div class="project-list">

            <table class="table table-hover">
                <tbody>
                    <tr ng-repeat="project in projects | filter: query | orderBy: '-updated_at' as resultsx">
                        <td class="project-status">
                            <span class="label @{{ project.status.label }}">@{{ project.status.name }}</span>
                        </td>
                        <td class="project-title">
                            <a ui-sref="project({ name: project.name, id: project.id })">@{{ project.name }}</a>
                            <br/>
                            <small>@{{ project.number }} (@{{ project.reference }})</small>
                        </td>
                        <td class="project-completion">
                            <small>Voortgang: @{{ project.status.priority }}/5</small>
                            <div class="progress progress-mini">
                                <div style="width: @{{ project.status.priority * 20 }}%;" class="progress-bar"></div>
                            </div>
                        </td>
                        <td>
                            <small>@{{ project.field.name }}</small>
                        </td>
                        <td class="text-right">
                            <small>Gemaakt op: @{{ project.created_at | date: 'd MMMM, yyyy' }}</small><br />
                            <small>Gewijzigd op: @{{ project.updated_at | date: 'd MMMM, yyyy' }}</small>
                        </td>
                        <td class="project-actions">
                            <a ui-sref="project({ name: project.name, id: project.id })" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> Project details </a>
                        </td>
                    </tr>
                    <tr ng-if="resultsx.length == 0">
                        <td colspan="5"> Geen projecten gevonden</td>
                    </tr>
                </tbody>
            </table>
            </div>
            </div>
            </div>

        </div>
        </div>

        </div>

        </div>
        <!-- /Content -->

        <!-- Footer -->
        <div ng-include="'/common/footer'"></div>

    </div>
    <!-- End page wrapper-->

</div>
<!-- End wrapper