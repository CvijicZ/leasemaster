@extends('layouts.app')

@section('content')

    @if ($contracts->isEmpty())
        <p class="text-center text-custom-primary">You don't have any contracts history.</p>
    @else
        <ul>
            @foreach ($contracts as $contract)
                <div class="container mt-4">
                    <div class="row">
                        @foreach ($contracts as $contract)
                            <div class="col-md-4 mb-4">
                                <div class="card bg-custom text-custom-primary shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Contract Details</h5>

                                        <p class="card-text"><strong>Contract Months:</strong>
                                            {{ $contract->contract_months }}</p>

                                        <p class="card-text"><strong>Annual Miles:</strong>
                                            {{ number_format($contract->annual_miles) }}</p>

                                        <p class="card-text"><strong>Initial Payment:</strong>
                                            ${{ number_format($contract->initial_payment, 2) }}</p>

                                        <p class="card-text"><strong>Total Price:</strong>
                                            ${{ number_format($contract->total_price, 2) }}</p>

                                        <p class="card-text"><strong>Price Per Month:</strong>
                                            ${{ number_format($contract->price_per_month, 2) }}</p>

                                        <p class="card-text"><strong>Valid Until:</strong>
                                            {{ \Carbon\Carbon::parse($contract->valid_until)->format('M d, Y') }}</p>

                                        <!-- Contract Action Buttons -->
                                        <div class="mt-3">
                                            <a href="{{ route('contract.show', $contract->id) }}"
                                                class="btn btn-secondary btn-sm"><i class="fa-solid fa-eye"></i> View
                                                Contract</a>
                                        </div>

                                        <!-- Vehicle Information -->
                                        @if ($contract->vehicle)
                                            <hr>
                                            <h6 class="card-subtitle mb-2">Vehicle Details</h6>
                                            <p class="card-text"><strong>Vehicle:</strong>
                                                {{ $contract->vehicle->make . ' ' . $contract->vehicle->model }}</p>
                                            <p class="card-text"><strong>Year:</strong> {{ $contract->vehicle->year }}</p>
                                            <p class="card-text"><strong>Engine:</strong> {{ $contract->vehicle->engine }}
                                            </p>

                                            <!-- Vehicle Action Buttons -->
                                            <div class="mt-3">
                                                <a href="{{ route('vehicles.show', $contract->vehicle->id) }}"
                                                    class="btn btn-secondary btn-sm"><i class="fa-solid fa-eye"></i>
                                                    Details</a>
                                            </div>
                                        @else
                                            <p class="card-text text-danger">No vehicle information available.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </ul>
    @endif

@endsection
