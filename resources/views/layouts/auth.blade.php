<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2019-04-04 16:55:45 +0200 -->
    <title>{{ config('app.name', 'Tadreeb') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <!-- Dashboard Core -->
    <link href="/assets/css/dashboard.css" rel="stylesheet" />
    <script src="/assets/js/dashboard.js"></script>
  </head>
  <body class="">
    <div class="page">
      <div class="flex-fill">

           @yield('content')
      
      </div>
    </div>
    <!-- Javascript -->
    <script src="/assets/js/vendors/jquery-3.2.1.min.js"></script>
    <script src="/assets/js/vendors/bootstrap.bundle.min.js"></script>
  </body>
</html>