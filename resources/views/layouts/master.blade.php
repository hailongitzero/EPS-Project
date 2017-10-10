<!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title> <!--insert your title here-->
    <meta name="title" content="@yield('meta-title')"> <!--insert your title here-->
    <meta name="description" content="@yield('description')"> <!--insert your description here-->
    <meta name="keywords" content="@yield('keywords')"> <!--insert your keywords here-->
    <meta name="author" content="@yield('author')"> <!--insert your name here-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!--begin::Web font -->
    <script src="/resources/assets/js/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    {{--<link href="/resources/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="/resources/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="/resources/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />--}}
    <link href="/resources/assets/css/vendors.bundle.css" rel="stylesheet" type="text/css" />
    {{--<link href="/resources/assets/css/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />--}}


    {{--<link href="/resources/assets/jstree/dist/themes/default/style.min.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="/resources/assets/css/components.min.css" rel="stylesheet" type="text/css" />--}}
    <link href="/resources/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    {{--<link href="/resources/assets/css/plugins.min.css" rel="stylesheet" type="text/css" />--}}
    <link href="/resources/assets/css/custom.css" rel="stylesheet" type="text/css" />

    <!--end::Base Styles -->
    <link rel="shortcut icon" href="/resources/assets/images/logo/favicon.ico" />
</head>
<!-- end::Head -->
<!-- end::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
@section('dashboard-content')
@show
<!-- begin::Quick Nav -->
<!--begin::Base Scripts -->
<script src="/resources/assets/js/vendors.bundle.js" type="text/javascript"></script>
<script src="/resources/assets/js/scripts.bundle.js" type="text/javascript"></script>
<!--end::Base Scripts -->
<!--begin::Page Snippets -->
{{--<script src="/resources/assets/datatables/datatables.min.js" type="text/javascript"></script>--}}
{{--<script src="/resources/assets/datatables/data-ajax.js" type="text/javascript"></script>--}}
{{--<script src="/resources/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>--}}
<script src="/resources/assets/js/custom/jstree.js" type="text/javascript"></script>
<script src="/resources/assets/js/dashboard.js" type="text/javascript"></script>

<script src="/resources/assets/js/custom/custom.js" type="text/javascript"></script>
<!--end::Page Snippets -->
</body>
<!-- end::Body -->
</html>

