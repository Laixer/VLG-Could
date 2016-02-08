<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Mijn Projecten</h2>
        <ol class="breadcrumb">
            <li>
                <a ui-sref="dashboards.dashboard_1">Home</a>
            </li>
            <li class="active">
                <strong>Mijn Projecten</strong>
            </li>
        </ol>
    </div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="wrapper wrapper-content animated fadeInUp">

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
        @foreach(App\Project::all() as $project)
        <tr>
            <td class="project-status">
                <span class="label label-default">{{ $project->status->name }}</span>
            </td>
            <td class="project-title">
                <a ui-sref="project_detail">{{ $project->name }}</a>
                <br/>
                <small>{{ $project->number }} ({{ $project->reference }})</small>
            </td>
            <td class="project-completion">
                <small>Voortgang: 2/4</small>
                <div class="progress progress-mini">
                    <div style="width: 50%;" class="progress-bar"></div>
                </div>
            </td>
            <td class="text-right">
                <small>Gemaakt op: {{ $project->created_at->format('d M Y') }}</small><br />
                <small>Gewijzigd op: {{ $project->updated_at->format('d M Y') }}</small>
            </td>
            <td class="project-actions">
                <a ui-sref="app.project_detail({ name: '{{ $project->name }}' })" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> Project details </a>
            </td>
        </tr>
        @endforeach
        <!-- <tr>
            <td class="project-status">
                <span class="label label-primary">Definitief</span>
            </td>
            <td class="project-title">
                <a ui-sref="project_detail">2015-034</a>
                <br/>
                <small>Gemaakt op: 3-2-2016</small>
            </td>
            <td>
                <small>MVB15036</small>
            </td>
            <td class="project-completion">
                <small>Voortgang: 1/4</small>
                <div class="progress progress-mini">
                    <div style="width: 25%;" class="progress-bar"></div>
                </div>
            </td>
            <td class="project-actions">
                <a href="" class="btn btn-white btn-sm"><i class="fa fa-cloud-download"></i> Download </a>
                <a href="" class="btn btn-white btn-sm"><i class="fa fa-comment"></i> Opmerkingen </a>
            </td>
        </tr> -->
    </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
