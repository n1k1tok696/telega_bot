@extends('layout.main')

@section('title-block', 'Home Page')

@section('content')
  <h1>Home</h1>
  <form action="{{ route('getdata') }}" method="POST">
    @csrf
    <button type="submit">Get</button>
  </form>
@endsection