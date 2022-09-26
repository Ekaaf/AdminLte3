<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Dashboard 3</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{URL::to('public/adminlte3/fontawesome-free/css/all.min.css')}}">
        <!-- IonIcons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{URL::to('public/adminlte3/css/adminlte.min.css')}}">
    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            @include('admin.layout.header')
            @include('admin.layout.sidebar')
            @yield('content')
            @include('admin.layout.footer')
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="{{URL::to('public/adminlte3/js/jquery.min.js')}}"></script>
        <!-- Bootstrap -->
        <script src="{{URL::to('public/adminlte3/js/bootstrap.bundle.min.js')}}"></script>
        <!-- AdminLTE -->
        <script src="{{URL::to('public/adminlte3/js/adminlte.js')}}"></script>

        <!-- OPTIONAL SCRIPTS -->
        <script src="{{URL::to('public/adminlte3/js/Chart.min.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{URL::to('public/adminlte3/js/demo.js')}}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!-- <script src="{{URL::to('public/adminlte3/js/dashboard3.js')}}"></script> -->

    @yield('script')
    </body>
</html>
