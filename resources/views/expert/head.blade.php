<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <!--favicon-->
  <link rel="icon" href="{{ asset('/favicon/'.$settingsinfo->favicon)}}" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('/expert/assets/css/bootstrap.min.css') }}" rel="stylesheet"/>

  <!--Select Plugins-->
  <link href="{{ asset('/expert/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
  
  <!--Bootstrap Datepicker-->
  <link href="{{ asset('/expert/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
  <!--Data Tables -->
  <link href="{{ asset('/expert/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
  
  <!-- animate CSS-->
  <link href="{{ asset('/expert/assets/css/animate.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{ asset('/expert/assets/css/icons.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="{{ asset('/expert/assets/css/app-style.css') }}" rel="stylesheet"/>

  <!-- Vector CSS -->
  <link href="{{ asset('/expert/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="{{ asset('/expert/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>
  <!-- Sidebar CSS-->
  <link href="{{ asset('/expert/assets/css/sidebar-menu.css') }}" rel="stylesheet"/>
  <!-- notifications css -->
  <link rel="stylesheet" href="{{ asset('/expert/assets/plugins/notifications/css/lobibox.min.css') }}"/>

  <link href="{{ asset('/expert/assets/css/custom.css') }}" rel="stylesheet"/>
  <link href="{{ asset('/expert/assets/plugins/summernote/dist/summernote-bs4.css') }}" rel="stylesheet"/>


    @yield('script')  
    @yield('css')  
</head>

<body>