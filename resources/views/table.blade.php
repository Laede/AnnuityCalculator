@extends('layout')

@section('content')
    <table border="1" class="table">
        <tr  class="thead-dark">
            <th>Payments</th>
            <th>Date</th>
            <th>Remaining amount</th>
            <th>Principal payment</th>
            <th>Interest payment</th>
            <th>Total payment</th>
            <th>Interest Rate</th>
        </tr>
        @foreach($schedule as $row)
        <tr>
            <td>{{ $row['payment_number'] }}</td>
            <td>{{ $row['date'] }}</td>
            <td>{{ $row['balance'] }}</td>
            <td>{{ $row['credit'] }}</td>
            <td>{{ $row['interest'] }}</td>
            <td>{{ $row['payment'] }}</td>
            <td>{{ $row['percent'] }}</td>
        </tr>
        @endforeach
    </table>
    <a class="btn btn-primary" href="{{ route('download-result',$get_parameters) }}">Download CSV</a>
@endsection