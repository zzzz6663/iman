<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>
        @auth

            {{auth()->user()->role  }}
        @endauth
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/manager/dist/css/tabler.min.css?1666304673" rel="stylesheet"/>
    <link href="/manager/dist/css/tabler-flags.min.css?1666304673" rel="stylesheet"/>
    <link href="/manager/dist/css/tabler-payments.min.css?1666304673" rel="stylesheet"/>
    <link href="/manager/dist/css/tabler-vendors.min.css?1666304673" rel="stylesheet"/>
    <link href="/manager/dist/css/demo.min.css?1666304673" rel="stylesheet"/>
    <link href="/css/select2.min.css" rel="stylesheet"/>



    <script type="text/javascript" src="/home/js/jquery-2.2.0.min.js"></script>

</head>
<body class="antialiased ">
<div class="page">

    @include('admin.section.sidebar')
    <div class="page-wrapper">
        @include('admin.section.navbar')
        <div class="page-body">
            <div class="container-xl">
                @yield('content')
            </div>
        @include('admin.section.footer')

        </div>
    </div>
</div>
<script src="/manager/dist/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="/manager/dist/js/tabler.min.js"></script>
<script src="/home/js/fun.js"></script>
<script type="text/javascript" src="/home/js/iziModal.min.js"></script>
<script type="text/javascript" src="/home/js/lightbox.min.js"></script>
<script type="text/javascript" src="/home/js/persian-date.min.js"></script>
<script type="text/javascript" src="/home/js/persian-datepicker.min.js"></script>
<script type="text/javascript" src="/home/js/plyr.js"></script>
<script type="text/javascript" src="/home/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/home/js/fun.js"></script>

{{-- <script type="text/javascript" src="/home/js/videopopup.js"></script> --}}
<script type="text/javascript" src="/home/js/home1.js"></script>
<script src="/manager/dist/js/admin.js"></script>

<script src="/js/select2.full.min.js"></script>

<script src="{{asset('/js/js.js')}}"></script>
<script src="{{asset('/js/app.js')}}"></script>
@include('sweetalert::alert')
</body>
</html>
