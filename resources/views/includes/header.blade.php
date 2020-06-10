<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">Test login</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="/">Home</a>
    <a class="p-2 text-dark" href="/income">Income</a>
    <a class="p-2 text-dark" href="/expense">Expense</a>
    @if (Auth::check())
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
      </form>
    @endif
  </nav>
  <a class="btn btn-outline-primary" href="{{ route('login') }}">Sign up</a>
</div>