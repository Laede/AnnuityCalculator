@extends('layout')

@section('content')
    <form class="form-group" action="{{ route('show-result')  }}" method="get">
        <label for="months">Loan Amount:</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">€</span>
            </div>
            <input type="text" class="form-control" name="loan">
        </div>
        <label for="months">Interest rate:</label>
        <div class="form-group">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">%</span>
                </div>
                <input type="text" class="form-control" name="percent">
            </div>
        </div>
        <div class="form-group">
            <label for="months">Amount of payments:</label>
            <select class="form-control" id="months" name="months">
                @for ($i = 0; $i < 27; $i++)
                    <option>{{ $i }}</option>
                @endfor
            </select>
        </div>
        Beginning of payments: <br/>
        <div class="form-group">
            <div class="input-group mb-3">
                <input type="date" class="carbon" name="date"/><br/>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection