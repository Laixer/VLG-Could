<!-- Wrapper-->
<div id="wrapper">

    <!-- Page wraper -->
    <!-- ng-class with current state name give you the ability to extended customization your view -->
    <div id="page-wrapper" class="gray-bg @{{$state.current.name}}">

        <!-- Page wrapper -->
        <div ng-include="'/common/header'"></div>

        <!-- Content -->
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
        <div class="wrapper wrapper-content ">
        <div class="ibox">
        <div class="ibox-content">
        <div class="row" ng-controller="projectCtrl">
            <div class="col-lg-12">
                <div class="m-b-md">
                    <h2>Project @{{ name }}</h2>
                </div>
                <dl class="dl-horizontal">
                    <dt>Status:</dt>
                    <dd><span class="label label-primary">Definitief</span></dd>
                </dl>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <dl class="dl-horizontal">

                    <dt>Nummer:</dt>
                    <dd>2016-34</dd>
                    <dt>Referentie:</dt>
                    <dd>98735-45S</dd>
                    <dt>Eigenaar:</dt>
                    <dd>Alex Smith</dd>
                    <dt>Opdrachtgever:</dt>
                    <dd><a href="" class="text-navy"> Zender Company</a></dd>
                </dl>
            </div>
            <div class="col-lg-7" id="cluster_info">
                <dl class="dl-horizontal">

                    <dt>Aangemaakt:</dt>
                    <dd>4 Feb, 2016</dd>
                    <dt>Laatst aangepast:</dt>
                    <dd>6 Feb, 2016</dd>
                    <dt>Betrokkenen:</dt>
                    <dd>
                        <a href="">Henk</a>, 
                        <a href="">Sjaak</a>,
                        <a href="">Piet</a>
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
                            <div style="width: 50%;" class="progress-bar"></div>
                        </div>
                        <small>Project is voor <strong>50%</strong> compleet.</small>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="row m-t-sm">
        <div class="col-lg-12">
        <div class="panel blank-panel ui-tab">

        <tabset>
            <tab heading="Projectbestanden" active="tab.active">

                <div class="forum-title">
                    <h3>3 Bestanden beschikbaar</h3>
                </div>

                <div class="forum-item active">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="forum-icon">
                                <i class="fa fa-file-pdf-o"></i>
                            </div>
                            <a ui-sref="miscellaneous.forum_post_view" class="forum-item-title">Rapport 2016-23</a>
                            <div class="forum-sub-title">Talk about sports, entertainment, music, movies, your favorite color, talk about enything.</div>
                        </div>
                        <div class="col-md-3 text-right">
                            <button class="btn" type="button"><i class="fa fa-cloud-download"></i>&nbsp;&nbsp;<span class="bold">Download</span></button>
                        </div>
                    </div>
                </div>
                <div class="forum-item">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="forum-icon">
                                <i class="fa fa-file-excel-o"></i>
                            </div>
                            <a ui-sref="miscellaneous.forum_post_view" class="forum-item-title">Resultaten 1</a>
                            <div class="forum-sub-title">New to the community? Please stop by, say hi and tell us a bit about yourself. </div>
                        </div>
                        <div class="col-md-3 text-right">
                            <button class="btn" type="button"><i class="fa fa-cloud-download"></i>&nbsp;&nbsp;<span class="bold">Download</span></button>
                        </div>
                    </div>
                </div>
                <div class="forum-item">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="forum-icon">
                                <i class="fa fa-file-word-o"></i>
                            </div>
                            <a ui-sref="miscellaneous.forum_post_view" class="forum-item-title">Concept opzet 5</a>
                            <div class="forum-sub-title">This forum features announcements from the community staff. If there is a new post in this forum, please check it out. </div>
                        </div>
                        <div class="col-md-3 text-right">
                            <button class="btn" type="button"><i class="fa fa-cloud-download"></i>&nbsp;&nbsp;<span class="bold">Download</span></button>
                        </div>
                    </div>
                </div>

            </tab>
            <tab heading="Conversatie" class="dsads">
                <div class="feed-activity-list">
                    <div class="feed-element">
                        <a href="" class="pull-left">
                            <img alt="image" class="img-circle" src="img/a2.jpg">
                        </a>

                        <div class="media-body ">
                            <small class="pull-right">2h ago</small>
                            <strong>Mark Johnson</strong> posted message on <strong>Monica Smith</strong> site. <br>
                            <small class="text-muted">Today 2:10 pm - 12.06.2014</small>
                            <div>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                            </div>
                        </div>
                    </div>
                    <div class="feed-element">
                        <a href="" class="pull-left">
                            <img alt="image" class="img-circle" src="img/a3.jpg">
                        </a>

                        <div class="media-body ">
                            <small class="pull-right">2h ago</small>
                            <strong>Janet Rosowski</strong> add 1 photo on <strong>Monica Smith</strong>. <br>
                            <small class="text-muted">2 days ago at 8:30am</small>
                            <div>Oke</div>
                        </div>
                    </div>
                    <div class="feed-element">
                        <a href="" class="pull-left">
                            <img alt="image" class="img-circle" src="img/a4.jpg">
                        </a>

                        <div class="media-body ">
                            <small class="pull-right text-navy">5h ago</small>
                            <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                            <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                            <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                        </div>
                    </div>
                    <div class="feed-element">
                        <a href="" class="pull-left">
                            <img alt="image" class="img-circle" src="img/a5.jpg">
                        </a>

                        <div class="media-body ">
                            <small class="pull-right">2h ago</small>
                            <strong>Kim Smith</strong> posted message on <strong>Monica Smith</strong> site. <br>
                            <small class="text-muted">Yesterday 5:20 pm - 12.06.2014</small>
                            <div>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                            </div>
                        </div>
                    </div>
                    <div class="feed-element">
                        <a href="" class="pull-left">
                            <img alt="image" class="img-circle" src="img/profile.jpg">
                        </a>

                        <div class="media-body ">
                            <small class="pull-right">23h ago</small>
                            <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                            <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                            <div>Gaan we doen</div>
                        </div>
                    </div>
                </div>
                <div class="chat-form">
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Bericht..."></textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-sm btn-primary m-t-n-xs"><strong>Versturen</strong></button>
                        </div>
                    </form>
                </div>
            </tab>
            <tab heading="Notities">
                <div summernote class="summernote"  ng-model="main.summernoteText">
                    <h3>Hello Jonathan! </h3>
                    dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the industry's</strong> standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                    typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                    <br/>
                    <br/>

                </div>
            </tab>
            <tab heading="Log">
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
                <form action="" class="dropzone dz-message" drop-zone="" id="file-dropzone">
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
<!-- End wrapper-->