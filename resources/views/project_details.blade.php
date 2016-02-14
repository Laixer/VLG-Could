<!-- Wrapper-->
<div id="wrapper" ng-controller="projectDetailCtrl">

    <!-- Page wraper -->
    <!-- ng-class with current state name give you the ability to extended customization your view -->
    <div id="page-wrapper" class="gray-bg @{{ $state.current.name }}">

        <!-- Page wrapper -->
        <div ng-include="'/common/header'"></div>

        {{-- Content --}}
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>Project detail</h2>
                <ol class="breadcrumb">
                    <li>
                        <a ui-sref="dashboard">Home</a>
                    </li>
                    <li class="active">
                        <strong>Project detail</strong>
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

                    <div class="dropdown pull-right">
                        <button class="btn btn-white dropdown-toggle" type="button" data-toggle="dropdown">Status <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li ng-if="showStatus(2)"><a href="javascript:void(0);" ng-click="setStatus(2)">Maak concept</a></li>
                            <li ng-if="showStatus(3)"><a href="javascript:void(0);" ng-click="setStatus(3)">Maak definitief</a></li>
                            <li ng-if="showStatus(4)"><a href="javascript:void(0);" ng-click="setStatus(4)">Sluiten</a></li>
                            </ul>
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
                    <dd>-</dd>
                    <dt>Opdrachtgever:</dt>
                    <dd><a href="" class="text-navy"> -</a></dd>
                </dl>
            </div>
            <div class="col-lg-7" id="cluster_info">
                <dl class="dl-horizontal">

                    <dt>Aangemaakt:</dt>
                    <dd>@{{ project.created_at | date: 'd MMMM, yyyy' }}</dd>
                    <dt>Laatst aangepast:</dt>
                    <dd>@{{ project.updated_at | date: 'd MMMM, yyyy' }}</dd>
                    <dt>Betrokkenen:</dt>
                    <dd>
                        <a href="">-</a>
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
                            <div style="width: @{{ project.status.priority * 25 }}%;" class="progress-bar"></div>
                        </div>
                        <small>Project is voor <strong>@{{ project.status.priority * 25 }}%</strong> compleet.</small>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="row m-t-sm">
        <div class="col-lg-12">
        <div class="panel blank-panel ui-tab">

        <tabset>
            <tab heading="Projectbestanden" active="tab.active" ng-controller="reportCtrl" ng-init="init()">

                <div class="forum-title">
                    <h3>@{{ reports.length }} Bestanden beschikbaar</h3>
                </div>

                <div class="forum-item @{{ report.label }}" ng-repeat="report in reports | orderBy: '-updated_at'">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="forum-icon">
                                <i class="fa @{{ report.icon }}"></i>
                            </div>
                            <a ng-click="download( report.id )" class="forum-item-title">@{{ report.name }}</a>
                            <div class="forum-sub-title">@{{ report.created_at | date: 'd MMMM, yyyy' }}</div>
                        </div>
                        <div class="col-md-3 text-right">
                            <button ng-click="download( report.id )" class="btn" type="button"><i class="fa fa-cloud-download"></i>&nbsp;&nbsp;<span class="bold">Download</span></button>
                        </div>
                    </div>
                </div>

            </tab>
            <tab heading="Conversatie" class="dsads" ng-controller="threadCtrl" ng-init="init()">

                <div class="feed-activity-list">
                    <div class="feed-element" ng-repeat="message in thread">
                        <a href="" class="@{{ message.pull }}">
                            <img alt="image" class="img-circle" src="img/a2.jpg">
                        </a>

                        <div class="media-body @{{ message.text }}">
                            <strong>Mark Johnson</strong> voegde het volgende bericht toe <br>
                            <small class="text-muted">@{{ message.created_at | date: 'd MMMM, yyyy' }}</small>
                            <div>
                                @{{ message.message }}
                            </div>
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
            <tab heading="Notities">
                <div summernote class="summernote" on-blur="blur(evt)" ng-model="project.note"></div>
            </tab>
            <tab heading="Todo">

                <div id="vertical-timeline" class="vertical-container light-timeline">
                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-briefcase"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Meeting</h2>
                            <p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products. Below please find the current status of the sale.
                            </p>
                            <a href="#" class="btn btn-sm btn-primary"> More info</a>
                            <span class="vertical-date">
                                Today <br>
                                <small>Dec 24</small>
                            </span>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon blue-bg">
                            <i class="fa fa-file-text"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Send documents to Mike</h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                            <a href="#" class="btn btn-sm btn-success"> Download document </a>
                            <span class="vertical-date">
                                Today <br>
                                <small>Dec 24</small>
                            </span>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon lazur-bg">
                            <i class="fa fa-coffee"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Coffee Break</h2>
                            <p>Go to shop and find some products. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's. </p>
                            <a href="#" class="btn btn-sm btn-info">Read more</a>
                            <span class="vertical-date"> Yesterday <br><small>Dec 23</small></span>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon yellow-bg">
                            <i class="fa fa-phone"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Phone with Jeronimo</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
                            <span class="vertical-date">Yesterday <br><small>Dec 23</small></span>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon lazur-bg">
                            <i class="fa fa-user-md"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Go to the doctor dr Smith</h2>
                            <p>Find some issue and go to doctor. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. </p>
                            <span class="vertical-date">Yesterday <br><small>Dec 23</small></span>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-comments"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Chat with Monica and Sandra</h2>
                            <p>Web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). </p>
                            <span class="vertical-date">Yesterday <br><small>Dec 23</small></span>
                        </div>
                    </div>
                </div>


            </tab>
            <!-- <tab heading="Log">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Status</th>
                        <th>Title</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Comments</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <span class="label label-primary"><i class="fa fa-check"></i> Completed</span>
                        </td>
                        <td>
                            Create project in webapp
                        </td>
                        <td>
                            12.07.2014 10:10:1
                        </td>
                        <td>
                            14.07.2014 10:16:36
                        </td>
                        <td>
                            <p class="small">
                                Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable.
                            </p>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <span class="label label-primary"><i class="fa fa-check"></i> Accepted</span>
                        </td>
                        <td>
                            Various versions
                        </td>
                        <td>
                            12.07.2014 10:10:1
                        </td>
                        <td>
                            14.07.2014 10:16:36
                        </td>
                        <td>
                            <p class="small">
                                Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                            </p>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <span class="label label-primary"><i class="fa fa-check"></i> Sent</span>
                        </td>
                        <td>
                            There are many variations
                        </td>
                        <td>
                            12.07.2014 10:10:1
                        </td>
                        <td>
                            14.07.2014 10:16:36
                        </td>
                        <td>
                            <p class="small">
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which
                            </p>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <span class="label label-primary"><i class="fa fa-check"></i> Reported</span>
                        </td>
                        <td>
                            Latin words
                        </td>
                        <td>
                            12.07.2014 10:10:1
                        </td>
                        <td>
                            14.07.2014 10:16:36
                        </td>
                        <td>
                            <p class="small">
                                Latin words, combined with a handful of model sentence structures
                            </p>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <span class="label label-primary"><i class="fa fa-check"></i> Accepted</span>
                        </td>
                        <td>
                            The generated Lorem
                        </td>
                        <td>
                            12.07.2014 10:10:1
                        </td>
                        <td>
                            14.07.2014 10:16:36
                        </td>
                        <td>
                            <p class="small">
                                The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                            </p>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <span class="label label-primary"><i class="fa fa-check"></i> Sent</span>
                        </td>
                        <td>
                            The first line
                        </td>
                        <td>
                            12.07.2014 10:10:1
                        </td>
                        <td>
                            14.07.2014 10:16:36
                        </td>
                        <td>
                            <p class="small">
                                The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                            </p>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <span class="label label-primary"><i class="fa fa-check"></i> Reported</span>
                        </td>
                        <td>
                            The standard chunk
                        </td>
                        <td>
                            12.07.2014 10:10:1
                        </td>
                        <td>
                            14.07.2014 10:16:36
                        </td>
                        <td>
                            <p class="small">
                                The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.
                            </p>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <span class="label label-primary"><i class="fa fa-check"></i> Completed</span>
                        </td>
                        <td>
                            Lorem Ipsum is that
                        </td>
                        <td>
                            12.07.2014 10:10:1
                        </td>
                        <td>
                            14.07.2014 10:16:36
                        </td>
                        <td>
                            <p class="small">
                                Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable.
                            </p>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <span class="label label-primary"><i class="fa fa-check"></i> Sent</span>
                        </td>
                        <td>
                            Contrary to popular
                        </td>
                        <td>
                            12.07.2014 10:10:1
                        </td>
                        <td>
                            14.07.2014 10:16:36
                        </td>
                        <td>
                            <p class="small">
                                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical
                            </p>
                        </td>

                    </tr>

                    </tbody>
                </table>
            </tab> -->

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
                <h4>Opdrachtgever</h4>
                <img src="img/zender_logo.png" class="img-responsive">

                <p class="small">
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look
                    even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing
                </p>

                <p class="small font-bold">
                    <!-- <span><i class="fa fa-circle text-warning"></i> High priority</span> -->
                    &nbsp;
                </p>
                <h3>Upload bestanden</h3>
                <form action="" class="dropzone" data-id="@{{ project.id }}" drop-zone="" id="file-dropzone">
                   <div class="dz-message text-center" data-dz-message>
                        <span style="font-size:100px;"><i class="fa fa-cloud-upload"></i></span>
                        <div style="font-size:20px;font-weight:lighter;">Sleep of klik</div>
                    </div>
                </form>

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