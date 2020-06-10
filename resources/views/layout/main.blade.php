<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/app.css">
  <title>@yield('title-block')</title>
</head>
<body>
  @include('includes.header')

  <div class="container">
    @yield('content')
  </div>

  @include('includes.footer')
</body>
</html>