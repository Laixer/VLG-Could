{{-- Wrapper--}}
<div id="wrapper" ng-controller="projectDetailCtrl">

    {{-- Page wraper --}}
    {{-- ng-class with current state name give you the ability to extended customization your view --}}
    <div id="page-wrapper" class="gray-bg @{{ $state.current.name }}">

        {{-- Page wrapper --}}
        <div ng-include="'/common/header'"></div>

        {{-- Content --}}
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>Project details</h2>
                <ol class="breadcrumb">
                    <li>
                        <a ui-sref="dashboard">Home</a>
                    </li>
                    <li class="active">
                        <strong>Project details</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
        <div class="col-lg-9">
        <div class="wrapper wrapper-content">
        <div class="ibox">
        <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="m-b-md">

                    <div class="dropdown pull-right" ng-if="showStatus(5) && auth.write">
                        <button class="btn btn-white dropdown-toggle" type="button" data-toggle="dropdown">Status <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li ng-if="showStatus(2)"><a href="javascript:void(0);" ng-click="setStatus(2)">Verzoek om informatie</a></li>
                            <li ng-if="showStatus(3)"><a href="javascript:void(0);" ng-click="setStatus(3)">Maak concept</a></li>
                            <li ng-if="showStatus(4)"><a href="javascript:void(0);" ng-click="setStatus(4)">Maak definitief</a></li>
                            <li><a href="javascript:void(0);" ng-click="setStatus(5)">Sluiten</a></li>
                            </ul>
                    </div>
                    <div class="pull-right" ng-if="canCloseProject() && !auth.write" >
                        <button ng-click="setProjectClose()" class="btn btn-primary" type="button"><span class="bold">Project sluiten</span></button>
                    </div>
                    <h2>Project @{{ project.name }}</h2>

                </div>
                <dl class="dl-horizontal">
                    <dt>Status:</dt>
                    <dd><span class="label @{{ project.status.label }}">@{{ project.status.name }}</span></dd>
                </dl>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <dl class="dl-horizontal">

                    <dt>Nummer:</dt>
                    <dd>@{{ project.number }}</dd>
                    <dt>Referentie:</dt>
                    <dd>@{{ project.reference }}</dd>
                    <dt>Eigenaar:</dt>
                    <dd>@{{ project.owner }}</dd>
                    <dt>Opdrachtgever:</dt>
                    <dd><span class="text-navy">@{{ project.client }}</span></dd>
                    <dt>Contact:</dt>
                    <dd><span class="text-navy">@{{ project.contact }}</span></dd>
                </dl>
            </div>
            <div class="col-lg-7" id="cluster_info">
                <dl class="dl-horizontal">
                    <dt>Werkveld:</dt>
                    <dd>@{{ project.field.name }}</dd>
                    <dt>Aangemaakt:</dt>
                    <dd>@{{ project.created_at | date: 'd MMMM, yyyy' }}</dd>
                    <dt>Laatst aangepast:</dt>
                    <dd>@{{ project.updated_at | date: 'd MMMM, yyyy' }}</dd>
                    <dt>Betrokkenen:</dt>
                    <dd>
                        <span class="text-navy">@{{ project.involved.join(", ") }}</span>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <dl class="dl-horizontal">
                    <dt>Voortgang:</dt>
                    <dd>
                        <div class="progress active m-b-sm">
                            <div style="width: @{{ project.status.priority * 20 }}%;" class="progress-bar"></div>
                        </div>
                        <small>Project is voor <strong>@{{ project.status.priority * 20 }}%</strong> compleet.</small>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="row m-t-sm">
        <div class="col-lg-12">
        <div class="panel blank-panel ui-tab">

        <tabset>
            <tab heading="Projectbestanden" active="isActive[0].active" ng-controller="reportCtrl" ng-init="init()">

                <div class="forum-title">
                    <h3>@{{ reports.length }} Bestanden beschikbaar</h3>
                </div>

                <div class="forum-item @{{ report.label }} @{{ report.highlight }}" ng-repeat="report in reports | orderBy: '-updated_at'" ng-mouseenter="report.highlight=''">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="forum-icon">
                                <i class="fa @{{ report.icon }}"></i>
                            </div>
                            <a ng-click="download( report.id )" class="forum-item-title">@{{ report.name }} <span ng-show="report.version" class="text-navy">(revisie @{{ report.version }})</span></a>
                            <div class="forum-sub-title">@{{ report.created_at | date: 'd MMMM, yyyy' }}</div>
                        </div>
                        <div class="col-md-3 text-right">
                            <button ng-click="download( report.id )" class="btn" type="button"><i class="fa fa-cloud-download"></i>&nbsp;&nbsp;<span class="bold">Download</span></button>
                        </div>
                    </div>
                </div>

            </tab>
            <tab heading="Conversatie" active="isActive[1].active" ng-controller="threadCtrl" ng-init="init()">

                <div class="feed-activity-list">
                    <div class="feed-element" ng-repeat="message in thread">
                        <a href="" class="@{{ message.pull }}">
                            <img alt="image" class="img-circle" src="img/default-user-icon-profile.png">
                        </a>

                        <div class="media-body @{{ message.text }}">
                            <strong>@{{ message.name }}</strong> voegde het volgende bericht toe <br>
                            <small class="text-muted">@{{ message.created_at | date: 'd MMMM, yyyy' }}</small>
                            <div>@{{ message.message }}</div>
                        </div>
                    </div>
                </div>

                <div class="chat-form">
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" ng-model="message" placeholder="Bericht..."></textarea>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-primary" ng-click="post()">Plaats</button>
                        </div>
                    </form>
                </div>
            </tab>
            <tab heading="Notities" active="isActive[2].active" ng-show="auth.write">
                <div summernote class="summernote" on-blur="blur(evt)" ng-model="project.note"></div>
            </tab>
            <tab heading="Opgevraagde informatie" active="isActive[3].active" ng-controller="todoCtrl" ng-init="init()" ng-show="showTodo(project.status.id)">
                <ul class="todo-list m-t">
                    <li ng-repeat="todo in todos">
                        <input icheck type="checkbox" ng-disabled="todo.checked || !auth.write" data-id="@{{ todo.id }}" ng-model="todo.checked">
                        <span class="m-l-xs">@{{ todo.message }}</span>
                        <a ng-show="todo.report" href="javascript:void(0);" ng-click="gotoReport(todo.report.id)" class="label label-warning"><i class="fa fa-file-o"></i> @{{ todo.report.name }}</a>
                    </li>
                    <li ng-show="auth.write">
                        <form ng-submit="addItem()">
                            <div class="input-group">
                                <input type="text" class="form-control" ng-model="item" placeholder="Nieuw item...">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Opslaan</button>
                                </span>
                            </div>
                        </form>
                    </li>
                </ul>
            </tab>

            <tab heading="Acties" active="isActive[4].active" ng-controller="auditCtrl" ng-init="init()" ng-show="auth.admin">

                <h3>Laatste 25 acties</h3>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Gebruiker</th>
                            <th>Actie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="action in audits">
                            <td>@{{ action.created_at | date: 'd MMMM, yyyy HH:mm:ss' }}</td>
                            <td>@{{ action.name }}</td>
                            <td>@{{ action.action }}</td>
                        </tr>
                    </tbody>
                </table>
            </tab>

        </tabset>

        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <div class="col-lg-3">
            <div class="wrapper wrapper-content project-manager animated fadeInUp">
                <h3>Upload bestanden</h3>
                <form action="" class="dropzone" projectid="@{{ project.id }}" drop-zone="" id="file-dropzone">
                   <div class="dz-message text-center" data-dz-message>
                        <span style="font-size:100px;"><i class="fa fa-cloud-upload"></i></span>
                        <div style="font-size:20px;font-weight:lighter;">Sleep of klik</div>
                    </div>
                </form>

            </div>
        </div>
        </div>
        {{-- /Content --}}

        {{-- Footer --}}
        <div ng-include="'/common/footer'"></div>

    </div>
    {{-- End page wrapper--}}

</div>
{{-- End wrapper --}}