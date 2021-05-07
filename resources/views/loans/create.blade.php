@extends('layouts.app')

@section('title', 'Processing Loan')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">New Loan</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>


    <!-- Content Row -->

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Processing a New Loan</h6>
        </div>
        <div class="card-body">
            <form class="user" method="POST" action="{{ route('loan-store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Client Name</label>
                            <input type="text" class="form-control @error('client_id') is-invalid @enderror"
                                readonly name="client_id" value="{{ $id }}" required autocomplete="client_id">
                                @error('client_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Amount</label>
                            <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" onkeyup="calculator()"
                                placeholder="Enter Loan Amount..." name="amount" value="{{ old('amount') }}" required autocomplete="amount">
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Interest Rate</label>
                            <input type="text" class="form-control @error('interest') is-invalid @enderror"
                                 name="interest" readonly value="15%" required autocomplete="interest">
                                @error('interest')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Payment</label>
                            <input readonly type="number" class="form-control" id="payment"
                                placeholder="Enter Interest Rate..." name="payment" value="" required autocomplete="interest">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Loan Security</label>
                            <input type="text" class="form-control @error('security') is-invalid @enderror"
                                placeholder="Enter Loan Security..." name="security" value="{{ old('security') }}" required autocomplete="security">
                                @error('security')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                              <label for="">Select Payment Period</label>
                              <select class="form-control custom-select @error('period') is-invalid @enderror" name="period" id="period">
                                <option value="7">One Week</option>
                                <option value="14">Two Weeks</option>
                                <option value="30">One Month</option>
                                <option value="60">Two Months</option>
                              </select>
                                @error('period')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Guarantor's Full Names</label>
                            <input type="text" class="form-control @error('guarantor_names') is-invalid @enderror"
                                placeholder="Enter Guarantor Full Names..." name="guarantor_names" value="{{ old('guarantor_names') }}" required autocomplete="guarantor_names">
                                @error('guarantor_names')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Guarantor's Phone Number</label>
                            <input type="text" class="form-control @error('guarantor_phone') is-invalid @enderror"
                                placeholder="Enter Guarantor Phone number..." name="guarantor_phone" value="{{ old('guarantor_phone') }}" required autocomplete="guarantor_phone">
                                @error('guarantor_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
        var amount = document.getElementById('amount').value;
        var payment = document.getElementById('payment');
        payment.value = parseInt(amount * 0.15, 10)+ parseInt(amount);
    }
</script>
@endsection
