<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ $title }} - Portal MUBK</title>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <meta name="msapplication-TileColor" content="#206bc4"/>
    <meta name="theme-color" content="#206bc4"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="mobile-web-app-capable" content="yes"/>
    <meta name="HandheldFriendly" content="True"/>
    <meta name="MobileOptimized" content="320"/>
    <meta name="robots" content="noindex,nofollow,noarchive"/>
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"/>
    <!-- CSS files -->
    <link href="/assets/css/tabler.css" rel="stylesheet"/>
    <!-- Arabic Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Aref+Ruqaa:wght@400;700&family=Cairo:wght@200;300;400;600;700;900&family=Lateef&family=Markazi+Text:wght@400;500;600;700&family=Scheherazade:wght@400;700&display=swap" rel="stylesheet"> 
    <!-- jQuery -->
    <script src="/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- MomentJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js" integrity="sha256-ZsWP0vT+akWmvEMkNYgZrPHKU9Ke8nYBPC3dqONp1mY=" crossorigin="anonymous"></script>
    <!-- CKEditor -->
    <script src="/assets/ckeditor/ckeditor.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/c62b0f450b.js" crossorigin="anonymous"></script>
    <style>
      body {
      	display: none;
      }
    </style>
  </head>
  <body class="antialiased">
    <div class="page">
      @hasSection('header-nav')
        @yield('header-nav')
      @endif  

          @yield('content')
    
      @hasSection('footer')
        @yield('footer')
      @endif
    </div>
    <!-- Libs JS -->
    <script src="/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Tabler Core -->
    <script src="/assets/js/tabler.min.js"></script>
    <script>
      document.body.style.display = "block"
    </script>

    <!-- CKEditor -->
    <script>
        CKEDITOR.replaceAll();
    </script>
  </body>
</html>