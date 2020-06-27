<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-alpha.7
* @link https://github.com/tabler/tabler
* Copyright 2018-2019 The Tabler Authors
* Copyright 2018-2019 codecalm.net Paweł Kuna
* Licensed under MIT (https://tabler.io/license)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Masuk - Portal MUBK</title>

    <meta name="robots" content="noindex,nofollow,noarchive"/>
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"/>
    <!-- CSS files -->
    <link href="/assets/css/tabler.css" rel="stylesheet"/>
    <style>
      body {
      	display: none;
      }
    </style>
  </head>
  <body class="antialiased border-top-wide border-primary d-flex flex-column">
    <div class="flex-fill d-flex flex-column justify-content-center">
      <div class="container-tight py-6">
        <div class="text-center mb-4">
          <img src="/assets/img/logo.svg" height="70" alt="">
        </div>

        @if($errors->any())
        <div class="alert alert-danger">
            Username atau password salah
        </div>
        @endif

        <form class="card card-md" action="{{ route('login') }}" method="post">
            @csrf

          <div class="card-body">
            <h2 class="mb-2 text-center">Masuk ke Portal MUBK</h2>
            <div class="mb-3">
              <label class="form-label">Usernamme</label>
              <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username Anda" autocomplete="off">
            </div>
            <div class="mb-2">
              <label class="form-label">
                Password
              </label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
              </div>
            </div>
            
            <div class="form-footer">
              <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </div>
          </div>
        </form>
        <div class="text-center text-muted">
          
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <script src="/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Tabler Core -->
    <script src="/assets/js/tabler.min.js"></script>
    <script>
      document.body.style.display = "block"
    </script>
  </body>
</html>