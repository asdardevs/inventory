<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Inventory  </title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

            <!-- Font Awesome -->
        <link rel="stylesheet" href="{{url('lte')}}/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

      
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{url('lte')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{url('lte')}}/dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <!-- css custom -->
        <link rel="stylesheet" href="{{url('lte')}}/dist/css/landing.css">
       
     
        @routes

    <script src="{{ mix('js/app.js') }}" defer></script>


        <!-- jQuery -->
        <script src="{{url('lte')}}/plugins/jquery/jquery.min.js"></script>
        <!-- DataTables -->
        <link rel="stylesheet" href="{{url('lte')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{url('lte')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
           <!-- Scripts -->
    </head>
    <body class="font-sans antialiased sidebar-mini control-sidebar-slide-openi" >
        @inertia

        @env ('local')
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        @endenv


        
      
 
    <!-- Bootstrap 4 -->
    <script src="{{url('lte')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{url('lte')}}/dist/js/adminlte.min.js"></script>
     <!-- DataTables -->
     <script src="{{url('lte')}}/plugins/datatables/jquery.dataTables.min.js"></script>
     <script src="{{url('lte')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
     <script src="{{url('lte')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
     <script src="{{url('lte')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
 
    {{-- sweetalert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11">
  

    </script>
    </body>
</html>
