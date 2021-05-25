<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title')</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
    @yield('css')
    @stack('css')

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="{{ URL::asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ URL::asset('css/adminlte.min.css') }}">

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }
        
        /* Firefox */
        input[type=number] {
          -moz-appearance: textfield;
        }
        </style>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">

        @include('_layouts.navbar')
        @include('_layouts.sidebar')

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1>@yield('header-content')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @yield('breadcumb')
                            </ol>
                        </div>
                    </div>
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>

        @include('_layouts.footer')

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    </div>

    <!-- jQuery -->
    <script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jquery-ui/jquery-ui.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    @yield('js')
    @stack('js')

    {{-- @include('sweetalert::alert') --}}    
    @include('sweetalert::alert')

    <script src="{{ URL::asset('js/adminlte.min.js') }}"></script>
    <script src="{{ URL::asset('js/main.js') }}"></script>
</body>

</html>
