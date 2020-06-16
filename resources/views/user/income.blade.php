@extends('layout.main')

@section('title-block', 'Income')

@section('content')
  <h1>Income</h1>

  @if (count($incomeData))
    @foreach ($incomeData as $userReceipt)
      <div class="user-receipt">
        <span>{{ $userReceipt->id }}</span>
        <span>{{ $userReceipt->type }}</span>
        <span>{{ $userReceipt->category }}</span>
        <span>{{ $userReceipt->name }}</span>
        <span>{{ $userReceipt->amount }}</span>
        <span>{{ $userReceipt->dateTime }}</span>
      </div>
    @endforeach
  @else
    <div class="user-receipt">
      <span>Your data is empty</span>
    </div>
  @endif

@endsection