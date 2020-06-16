@extends('layout.main')

@section('title-block', 'Expense')

@section('content')
  <h1>Expense</h1>

  @if (count($expenseData))
    @foreach ($expenseData as $userReceipt)
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