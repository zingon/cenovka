{{!--<!DOCTYPE html>
<html lang="{{ Lang::locale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cenová nabídka</title>

    <!-- Bootstrap core CSS -->
   {{HTML::style('css/bootstrap.min.css')}}

    <!-- Custom styles for this template -->
    {{HTML::style('css/starter-template.css')}}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    {{HTML::style('css/style.css')}}
    {{HTML::style('css/jquery-ui.min.css')}}
    <style type="text/css">
    .modal{
        visibility: visible;
        display:block;
        overflow-y: auto;
    }
    .table {
       overflow-x: auto; 
    }
    </style>
 @yield('css')
</head>
<body>
<div id="modal"></div>
@include('layout.navigation')
<!-- tělo -->
<div class="container mainContent">
@if(Session::has('global'))
<div class="alert alert-success" role="alert">{{ Session::get('global') }}</div>
@endif
@if(Session::has('warning'))
<div class="alert alert-warning" role="alert">{{ Session::get('warning') }}</div>
@endif
@if(!empty($errors))
@foreach($errors->all() as $error)
<div class="alert alert-danger" role="alert">{{ $error }}</div>
@endforeach
@endif
    <!-- menu -->
    <nav id="sideNav">
    </nav>

    @yield('content')

</div>
{{ HTML::script('js/jquery.min.js')}}
{{ HTML::script('js/jquery-ui.min.js')}}
{{ HTML::script('js/jquery.form.min.js')}}
{{ HTML::script('js/bootstrap.min.js')}}
{{ HTML::script('js/script.js')}}
@yield('script')
</body>
</html>--}}