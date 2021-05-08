@extends('layouts.app')

@section('title', 'Processing Loan')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Loan Payment</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>


    <!-- Content Row -->

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Processing a Loan Payment for {{ $client->first_name. ' ' .$client->last_name }}</h6>
        </div>
        <div class="card-body">
            <form class="user" method="POST" action="{{ route('payment-store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Client ID</label>
                            <input type="text" class="form-control @error('client_id') is-invalid @enderror"
                                readonly name="client_id" value="{{ $clientt }}" required autocomplete="client_id">
                                @error('client_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Loan ID</label>
                            <input type="text" class="form-control @error('loan_id') is-invalid @enderror"
                                 name="loan_id" readonly value="{{ $loan }}" required autocomplete="loan_id">
                                @error('loan_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Balance after Last Payment</label>
                            <input type="text" class="form-control @error('balance') is-invalid @enderror"
                                name="balance" readonly id="balance" value="UGX {{ number_format($balance) }}" required autocomplete="balance">
                                @error('balance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Amount</label>
                            <input max="{{ $balance }}" type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" onkeyup="calculator()"
                                placeholder="Enter Payment Amount..." name="amount" value="{{ old('amount') }}" required autocomplete="amount">
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Total Balance Will Be</label>
                            <input readonly type="text" class="form-control" id="final_balance"
                            name="final_balance" value="" required autocomplete="final_balance">

                        </div>
                    </div>
                </div>

                <div class="row float-right">
                    <div class="col-md-12 justify-content-between">
                        <button class="btn btn-primary" type="submit">Save and Continue</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
<script>
    function calculator(){
        var balance = document.getElementById('balance').value;
        balance = balance.replace(/\D/g, '');
        var amount = document.getElementById('amount').value;
        var final_balance = document.getElementById('final_balance');
        // final_balance.value =  parseInt(balance, 10) - parseInt(amount, 10);
        final_balance.value = "UGX " + (parseInt(balance, 10) - parseInt(amount, 10)).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        // final_balance = final_balance.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        // final_balance.value = "UGX " + final_balance;
    }
</script>
@endsection
