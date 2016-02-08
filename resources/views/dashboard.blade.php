<!-- Wrapper-->
<div id="wrapper">

    <!-- Page wraper -->
    <!-- ng-class with current state name give you the ability to extended customization your view -->
    <div id="page-wrapper" class="gray-bg @{{$state.current.name}}">

        <!-- Page wrapper -->
        <div ng-include="'/common/header'"></div>

        <!-- Content -->
        <div class="row  border-bottom white-bg dashboard-header">
            <div class="col-sm-3">
                <h2>Haai Kaas</h2>
                <small>@{{ 'MESSAGEINFO' | translate }}</small>
                <ul class="list-group clear-list m-t">
                    <li class="list-group-item fist-item">
                                        <span class="pull-right">09:00 pm</span>
                        <span class="label label-success">1</span> <a ui-sref="modal_window">Modal</a>
                    </li>
                    <li class="list-group-item">
                                        <span class="pull-right">
                                            10:16 am
                                        </span>
                        <span class="label label-info">2</span> <a ui-sref="sweet_alert">Sweet alerts</a>
                    </li>
                    <li class="list-group-item">
                                        <span class="pull-right">
                                            08:22 pm
                                        </span>
                        <span class="label label-primary">3</span> <a ui-sref="validation">Validation</a>
                    </li>
                    <li class="list-group-item">
                                        <span class="pull-right">
                                            11:06 pm
                                        </span>
                        <span class="label label-default">4</span> <a ui-sref="toastr">Notify</a>
                    </li>
                    <li class="list-group-item">
                                        <span class="pull-right">
                                            12:00 am
                                        </span>
                        <span class="label label-primary">5</span> <a ui-sref="loading_buttons">Buttons</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6">
                <div class="flot-chart dashboard-chart" ng-controller="dashboardFlotOne as chart">
                    <div flot class="flot-chart-content" dataset="chart.flotData" options="chart.flotOptions"></div>
                </div>
                <div class="row text-left">
                    <div class="col-xs-4">
                        <div class=" m-l-md">
                            <span class="h4 font-bold m-t block">$ 406,100</span>
                            <small class="text-muted m-b block">Sales marketing report</small>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <span class="h4 font-bold m-t block">$ 150,401</span>
                        <small class="text-muted m-b block">Annual sales revenue</small>
                    </div>
                    <div class="col-xs-4">
                        <span class="h4 font-bold m-t block">$ 16,822</span>
                        <small class="text-muted m-b block">Half-year revenue margin</small>
                    </div>

                </div>
            </div>
            <div class="col-sm-3">
                <div class="statistic-box">
                    <h4>
                        Project Beta progress
                    </h4>

                    <p>
                        You have two project with not compleated task.
                    </p>

                    <div class="row text-center" ng-controller="chartJsCtrl as chart">
                        <div class="col-lg-6" >
                                <canvas polarchart options="chart.polarOptions" data="chart.polarData" width="80" height="80"></canvas>
                            <h5>Kolter</h5>
                        </div>
                        <div class="col-lg-6">
                                <canvas doughnutchart options="chart.doughnutOptions" data="chart.doughnutData" width="78" height="78"></canvas>
                            <h5>Maxtor</h5>
                        </div>
                    </div>
                    <div class="m-t">
                        <small>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                    </div>

                </div>
            </div>

        </div>
        <div class="row">
        <div class="col-lg-12">
        <div class="wrapper wrapper-content">
        <div class="row">

            <!-- <div class="col-lg-12"> -->
            <!-- <div class="wrapper wrapper-content animated fadeInUp"> -->

            <div class="ibox">
            <div class="ibox-title">
                <h5>Alle projecten</h5>

                <div class="ibox-tools">
                    <a href="" class="btn btn-primary btn-xs">Nieuw project</a>
                </div>
            </div>
            <div class="ibox-content">
            <div class="row m-b-sm m-t-sm">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" placeholder="Zoek in projecten" class="input-sm form-control">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-primary"> Zoeken</button>
                        </span>
                    </div>
                </div>
            </div>

            <div class="project-list">

            <table class="table table-hover">
                <tbody>
                    <tr>
                        <td class="project-status">
                            <span class="label label-default">$project->status->name</span>
                        </td>
                        <td class="project-title">
                            <a ui-sref="project_detail">$project->name</a>
                            <br/>
                            <small>$project->number ($project->reference)</small>
                        </td>
                        <td class="project-completion">
                            <small>Voortgang: 2/4</small>
                            <div class="progress progress-mini">
                                <div style="width: 50%;" class="progress-bar"></div>
                            </div>
                        </td>
                        <td class="text-right">
                            <small>Gemaakt op: $project->created_at->format('d M Y')</small><br />
                            <small>Gewijzigd op: $project->updated_at->format('d M Y')</small>
                        </td>
                        <td class="project-actions">
                            <a ui-sref="project({ name: '$project->name' })" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> Project details </a>
                        </td>
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
<!-- End wrapper-->