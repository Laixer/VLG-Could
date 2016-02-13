<!DOCTYPE html>
<html ng-app="inspinia">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- Page title set in pageTitle directive --}}
    <title page-title></title>

    {{-- Bootstrap --}}
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font awesome --}}
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">

    {{-- Main Inspinia CSS files --}}
    <link href="/css/animate.css" rel="stylesheet">
    <link id="loadBefore" href="/css/style.css" rel="stylesheet">

</head>

{{-- ControllerAs syntax --}}
{{-- Main controller with serveral data used in Inspinia theme on diferent view --}}
<body ng-controller="MainCtrl as main" class="@{{ $state.current.data.specialClass }}" landing-scrollspy id="page-top">

{{-- Main view  --}}
<div ui-view></div>

{{-- jQuery and Bootstrap --}}
<script src="/js/jquery/jquery-2.1.1.min.js"></script>
<script src="/js/plugins/jquery-ui/jquery-ui.js"></script>
<script src="/js/bootstrap/bootstrap.min.js"></script>

{{-- MetsiMenu -}}
<script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>

{{-- SlimScroll -}}
<script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

{{-- Peace JS -}}
<script src="/js/plugins/pace/pace.min.js"></script>

{{-- Custom and plugin javascript -}}
<script src="/js/cloud.js"></script>

{{-- Main Angular scripts--}}
<script src="/js/angular/angular.min.js"></script>
<script src="/js/angular/angular-sanitize.js"></script>
<script src="/js/plugins/oclazyload/dist/ocLazyLoad.min.js"></script>
<script src="/js/angular-translate/angular-translate.min.js"></script>
<script src="/js/ui-router/angular-ui-router.min.js"></script>
<script src="/js/bootstrap/ui-bootstrap-tpls-0.12.0.min.js"></script>
<script src="/js/plugins/angular-idle/angular-idle.js"></script>

{{-- Anglar App Script --}}
<script src="/js/app.js"></script>
<script src="/js/config.js"></script>
<script src="/js/translations.js"></script>
<script src="/js/directives.js"></script>
<script src="/js/controllers.js"></script>
<script src="/js/services.js"></script>

</body>
</html>
