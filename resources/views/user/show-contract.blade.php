@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mt-5">
    <h1 class="text-center">Review Your Contract</h1>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Contract Details</h5>
            <p><strong>Vehicle:</strong> {{ $contract['vehicle']['make'] . " " . $contract['vehicle']['model']}}</p>
            <p><strong>Customer:</strong> {{$contract->user['name']}}</p>
            <p><strong>Customer email:</strong> {{$contract->user['email']}}</p>

            <p><strong>Contract Length:</strong> {{$contract['contract_months']}} months</p>
            <p><strong>Annual Miles:</strong> {{$contract['annual_miles']}} miles</p>
            <p><strong>Initial Payment:</strong> {{$contract['initial_payment']}} $</p>
            <p><strong>Total Price:</strong> {{$contract['total_price']}} $</p>
            <p><strong>Price Per Month:</strong> {{$contract['price_per_month']}} $</p>
            <p><strong>Valid Until:</strong> {{$contract['valid_until']}}</p>
        </div>
    </div>

    <div class="text-center mt-4">
        @admin
        <a href="" class="btn btn-danger">Brake Contract</a>
        @endadmin

        <a href="{{ url()->previous() }}" class="btn btn-secondary">Go Back</a>
    </div>
</div>
@endsection
