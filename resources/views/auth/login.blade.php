@extends('layout.main')

@section('content')
  <h1>Login page</h1>

  @if ($errors->any())
    <div class="arert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="container login-container">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <form class="form-signin" method="POST" >
      @csrf
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="text" id="inputEmail" class="form-control" placeholder="Email address" name="username">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password">
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
  </div>
  <script src="{{ asset('/js/main.js') }}"></script>
@endsection
