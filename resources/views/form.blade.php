@extends('layout')

@section('content')
    <form action="{{ route('show-result')  }}" method="get">
        Loan Amount:
        <input type="text" name="amount"/><br/>
        Interest rate:
        <input type="text" name="percent"/><br/>
        Amount of payments:
        <input type="text" name="months"/><br/>
        <input type="submit"/>
    </form>
@endsection